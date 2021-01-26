<html>

<title>子弹</title>

<head>
  <link rel="stylesheet" href="./css/hack.css" />
  <link rel="stylesheet" href="./css/dark-grey.css" />
</head>

<body class="hack dark-grey">
  <div class="main container">
    <h1>private Note</h1>
    <?php
include_once("sql.php");
include_once("func.php");
if (isset($_POST["message"],$_POST["password"])){
    $id_message = rtrim(base64_encode(md5(microtime())),"=");
	$password = $_POST["password"];
    if ($password==""){
        $password=rtrim(base64_encode(microtime()),"=");
    }
	$message_link = "http://".$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF']."?id=".$id_message."&password=".$password;
    saveMessage($connection, $id_message, $_POST["message"],$password);
    echo '<h2>Note link ready</h2><div class="alert alert-info">'.htmlspecialchars($message_link).'</div><hr>The note will self-destruct after reading it.';
} else if (isset($_GET["id"])){
  if (isset($_GET["password"])){
    $data = getMessage($connection,$_GET["id"],$_GET["password"]);
  } else {
    $data = "parameter Password not set";
  }
  $data=htmlspecialchars($data);
  echo '<div class="alert alert-info">'.str_replace("\r\n","<br>",$data).'</div>';
} else {
    ?>
    <h2>New note</h2>
      <form class="form" action="." method="post">
        <fieldset class="form-group form-textarea">
          <label for="message">MESSAGE:</label>
          <textarea name="message" rows="10" placeholder="Write your note here..." class="form-control" required></textarea>
        </fieldset>
        <fieldset class="form-group">
          <label for="password">PASSWORD:</label>
          <input name="password" type="text" class="form-control">
        </fieldset>
        <div class="form-actions">
          <button type="submit" class="btn btn-primary btn-block">Submit</button>
        </div>
      </form>
      <hr>
      <ol>
        <li>Create a note and get a link</li>
        <li>Copy the link and send it to whom you want to read the note</li>
        <li>The note will self-destruct after being read</li>
      </ol>
      <?php
}
?>
  </div>
</body>

</html>