<html>
<title>Bullet Secret Letter - Biu-LI</title>
<head>
  <link rel="stylesheet" href="./css/hack.css" />
  <link rel="stylesheet" href="./css/dark-grey.css" />
</head>

<body class="hack dark-grey">
  <div class="main container">
    <h1>Bullet Secret Letter</h1>
    <h2>One-time encrypted message self-destruct after reading</h2>
    <?php
include_once("sql.php");
include_once("function.php");
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
  echo '<div class="alert alert-info">'.str_replace("\r\n","<br>",$data).'</div><p>© 2021 <a href="https://idc.moe">IDC.MOE</a> All Rights Reserved.</p>';
} else {
    ?>
      </form>
      <hr>
    <p>© 2021 <a href="https://idc.moe">IDC.MOE</a> All Rights Reserved.</p>
      <?php
}
?>
  </div>
</body>

</html>