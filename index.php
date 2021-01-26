<html>
<title>Bullet Secret Letter - Biu-LI - Simple Encrypted Message Service</title>
<head>
  <link rel="stylesheet" href="./css/hack.css" />
  <link rel="stylesheet" href="./css/dark-grey.css" />
</head>

<body class="hack dark-grey">
  <div class="main container">
    <h1>Bullet Secret Letter</h1>
    <h2>One-time encrypted message self-destruct after reading</h2>
        <h2>how to use?</h2>
        <ol>
         <li>Click [Create Now!], Create a note you want to send and set an encrypted password</li>
         <li>Copy the created link to the person who wants to whom you want to read the note</li>
         <li>If the note is ared, the note will self-destruct and the link will expire after reading</li>
        </ol>
    <?php
include_once("sql.php");
include_once("function.php");
if (isset($_POST["message"],$_POST["password"])){
    $id_message = rtrim(base64_encode(md5(microtime())),"=");
	$password = $_POST["password"];
    if ($password==""){
        $password=rtrim(base64_encode(microtime()),"=");
    }
	$message_link = "https://".$_SERVER['HTTP_HOST']."/link.php?id=".$id_message."&password=".$password;
    saveMessage($connection, $id_message, $_POST["message"],$password);
    echo '<h2>Note link ready</h2><div class="alert alert-info">'.htmlspecialchars($message_link).'</div><p>© 2021 <a href="https://idc.moe">IDC.MOE</a> All Rights Reserved.</p>';
} else if (isset($_GET["id"])){
  if (isset($_GET["password"])){
    $data = getMessage($connection,$_GET["id"],$_GET["password"]);
  } else {
    $data = "parameter Password not set";
  }
  $data=htmlspecialchars($data);
  echo '<div class="alert alert-info">'.str_replace("\r\n","<br>",$data).'</div><p>© 2021 <a href="https://idc.moe">IDC.MOE</a> All Rights Reserved.</p>';
} else {
    ?>
    <form method="get" action="/create.php">
    <button type="submit" class="btn btn-primary btn-block">Create Now!</button>
    </form>
      </form>
      <hr>
    <h2>Tip: All messages are stored on Biu.LI through AES256 algorithm, so you don't need to worry about information leakage.</h2>
    <p>© 2021 <a href="https://idc.moe">IDC.MOE</a> All Rights Reserved.</p>
      <?php
}
?>
  </div>
</body>

</html>