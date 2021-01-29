<?php

if(isset($_GET["ready"])){
include_once("sql.php");
include_once("function.php");
$data = getMessage($connection,$_GET["id"],$_GET["password"]);
$data=htmlspecialchars($data);
$aaa= str_replace("\r\n","<br>",$data);
echo $aaa;
return ;  
}
      
?>

<html>

<head>
    <title>Bullet Secret Letter - Biu.LI - Simple Encrypted Message Service</title>
    <link rel="stylesheet" href="./css/hack.css" />
    <link rel="stylesheet" href="./css/dark-grey.css" />
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
    <meta itemprop="name" content="Biu.Li"/>
    <meta itemprop="image" content="https://idc.moe/idcmoe.png" />
    <meta name="description" itemprop="description" content="One-time encrypted message self-destruct after reading." />
    <script src="js/clipboard.min.js"></script>
</head>
<body class="hack dark-grey">
    <div class="main container">
    <h1>Bullet Secret Letter</h1>
    <h2>One-time encrypted message self-destruct after reading <a href="https://github.com/Nyarime/BulletSecretLetter">[Code]</a></h2>
        <h2>how to use?</h2>
        <ol>
         <li>Click [Create Now!], Create a message and set a password</li>
         <li>Copy the created link to whom you want to read the note</li>
         <li>If the message is read, the message will self-destruct</li>
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
    echo '<h2>Bullet Secret Letter link created：<button class="btn">Copy</button></h2><div class="alert alert-info">'.htmlspecialchars($message_link).'</div><h2>QRCode：Save the QR code to share with friends!</h2><div class="alert alert-info"><img src="https://idc.moe/qrcode/api.php?url='.htmlspecialchars($message_link).'"></div><hr>The created link will be self-destructed after reading.<p>© 2021 <a href="https://idc.moe">IDC.MOE</a> All Rights Reserved. <a href="https://biu.li/create.php">Create New Message</a> - <a href="https://github.com/Nyarime/BulletSecretLetter">GitHub</a></p>';
} else if (isset($_GET["id"])){
  if (isset($_GET["password"])){
     
        echo '<h2>Hey, you have a message：</h2><div id="warning" class="alert alert-info">****<br>*************<br>**********************</div>';
        echo '<button type="submit" id="NO1" >Open it!</button>';
        echo '<p> <p/>';
        echo '<p>This message can only be read once after opening.</p>';
        echo '<p>If you left after opening, this message will disappear forever!</p>';
        echo '<p>© 2021 <a href="https://idc.moe">IDC.MOE</a> All Rights Reserved. <a href="https://biu.li/create.php">Create New Message</a> - <a href="https://github.com/Nyarime/BulletSecretLetter">GitHub</a></p>';
         
    
      
  } else {
    $data = "Oops, this message password is missing!";
    $data=htmlspecialchars($data);
    echo '<h2>Hey, you have a message：</h2><div id="warning" class="alert alert-info">'.str_replace("\r\n","<br>",$data).'</div><hr>Warning! This message will be self-destructed after reading.<p>© 2021 <a href="https://idc.moe">IDC.MOE</a> All Rights Reserved. <a href="https://biu.li/create.php">Create New Message</a> - <a href="https://github.com/Nyarime/BulletSecretLetter">GitHub</a></p>';
      
  }
  
} else {
    ?>
        <form method="get" action="/create.php">
        <button type="submit" class="btn btn-primary btn-block">Create Now!</button>
        </form>
      <hr>
      <h2>Tip: All messages are stored on Biu.LI through AES256 algorithm, so you don't need to worry about information leakage.</h2>
      <p>This project follows the MIT License, visit the <a href="https://github.com/Nyarime/BulletSecretLetter">GitHub</a> page.</p>
      <p>© 2021 <a href="https://idc.moe">IDC.MOE</a> All Rights Reserved. <a href="https://biu.li">Biu.LI</a></p>
      <?php
}
?>
  </div>
</body>
<script>
    var user = document.getElementById('NO1');  //获取用户控件
    user.onclick = function () {  //当用户离开当前文本框的时行验证
        //1.创建Ajax对象
        var xhr = new XMLHttpRequest();
        //2.创建请求事件的监听
        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4 && xhr.status == 200) {
                
                    var warning = document.getElementById('warning');
                    warning.innerHTML = xhr.responseText ;
                   document.getElementById('NO1').disabled = true;
                   //按钮 不可点
               var change_cancel = document.getElementById("NO1");
                   change_cancel.style.display = "none";
                   //按钮 block可见 none 不可见
                   
                   }

            }
         //3.初始化一个url请求
        var user = document.getElementById('NO1').value;
        //var password = document.getElementById('password').value;
       // var data = 'icp='+user+'&password='+password; //生成post请求数据
        var data = 'NO1='+user;
        var url = window.location.href+"&ready=yes";
        //var url = '/sms.php';
        
        xhr.open('post',url,true); //请求类型为post，交互方式为异步
 
        //4.设置请求头
        xhr.setRequestHeader('content-type','application/x-www-form-urlencoded');
 
        //5.发送url请求,需要传入参数
        xhr.send(data);
     
    }
</script>
<script>
    var clipboard = new ClipboardJS('.btn', {
        text: function() {
            return "<?php echo($message_link) ?>";
        }
    });

    clipboard.on('success', function(e) {
        console.log(e);
        alert("Copy messages link successfully!");
        
    });

    clipboard.on('error', function(e) {
        console.log(e);
        alert("The current browser does not support it, please copy the link manually.");
    });
</script>
</html>