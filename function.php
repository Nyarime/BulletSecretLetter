<?php

function saveMessage($connection, $id, $message, $password){ // OK
    $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length('aes-256-cbc'));
    $encrypted = openssl_encrypt($message, 'aes-256-cbc', $password, 0, $iv);
    $message = base64_encode($encrypted . '::' . $iv);
    $sql = "INSERT INTO `note` (`id`, `message`)
    VALUES (:id, :message);";
    $sth = $connection->prepare($sql);
    $sth->execute(array(':id' => $id, ':message' => $message));
}

function getMessage($connection, $id, $password){ // OK
    $sql = "SELECT `message` FROM `note`
    WHERE `id` = :id";
    $sth = $connection->prepare($sql);
    $sth->execute(array(':id' => $id));
    $enregistrements = $sth->fetchObject();
    if(!$enregistrements) return 'This note was read and destroyed';
    list($encrypted_data, $iv) = explode('::', base64_decode($enregistrements->message), 2);
    $message = openssl_decrypt($encrypted_data, 'aes-256-cbc', $password, 0, $iv);
    if (!$message) return 'Password incorrect.';
    deleteMessage($connection, $id);
    return openssl_decrypt($encrypted_data, 'aes-256-cbc', $password, 0, $iv);
}

function deleteMessage($connection, $id){
    $sql = "DELETE FROM `note`
    WHERE `id` = :id";
    $sth = $connection->prepare($sql);
    $sth->execute(array(':id' => $id));
}

?>