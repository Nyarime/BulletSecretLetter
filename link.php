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
    <title>Bullet Secret Letter Viewer by NMQU.COM</title>
    <link rel="shortcut icon" href="https://blog.naixi.net/usr/nya/favicon.ico">
    <link rel="stylesheet" href="./css/hack.css" />
    <link rel="stylesheet" href="./css/dark-grey.css" />
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
    <meta itemprop="name" content="BSLViewer"/>
    <meta itemprop="image" content="https://blog.naixi.net/usr/nya/logo_black.png" />
    <meta name="description" itemprop="description" content="One-time encrypted message self-destruct after reading." />
    <script src="js/clipboard.min.js"></script>
</head>

<body class="hack dark-grey">
  <div class="main container">
    <h1>Bullet Secret Letter Viewer</h1>
    <h2>An encrypted message can be readable in NMQU.COM</h2>
    <?php
    include_once("sql.php");
include_once("function.php");
if (isset($_GET["id"])){
  if (isset($_GET["password"])){
     
        echo '<h2>Hey, this is an encrypted message：</h2><div id="warning" class="alert alert-info">****<br>*************<br>**********************</div>';
        echo '<button type="submit" id="BSL" >Open it!</button>';
        echo '<p> <p/>';
        echo '<p>This message can only be read once after opening.</p>';
        echo '<p>For your safety, please check Server Host('.$_SERVER['HTTP_HOST'].'), browser domain are nmqu.com before you open this message!!!</p>';
        echo '<p>When you opening, this message will disappear forever!</p>';
        echo '<p>© 2024 <a href="https://naixi.net">Nyarime</a>. All Rights Reserved. <a href="https://nmqu.com/create.php">Create New Message</a> - <a href="https://github.com/Nyarime/BulletSecretLetter">GitHub</a></p>';
         
    
      
  } else {
    $data = "Oops, this message password is missing!";
    $data=htmlspecialchars($data);
    echo '<h2>Hey, you have a message：</h2><div id="warning" class="alert alert-info">'.str_replace("\r\n","<br>",$data).'</div><hr>Warning! This message will be self-destructed after reading.<p>© 2024 <a href="https://naixi.net">Nyarime</a>. All Rights Reserved. <a href="https://nmqu.com/create.php">Create New Message</a> - <a href="https://github.com/Nyarime/BulletSecretLetter">GitHub</a></p>';
      
  }
  
} else {
    ?>
      <hr>
      <p></p>
      <p>© <?php echo date("Y");?> <a href="https://naixi.net">Nyarime</a>. All Rights Reserved. <a href="https://nmqu.com">NMQU.COM</a></p>
      <?php
}
?>
  </div>
</body>
<script>
    var user = document.getElementById('BSL');  //获取用户控件
    user.onclick = function () {  //当用户离开当前文本框的时行验证
        //1.创建Ajax对象
        var xhr = new XMLHttpRequest();
        //2.创建请求事件的监听
        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4 && xhr.status == 200) {
                
                    var warning = document.getElementById('warning');
                    warning.innerHTML = xhr.responseText ;
                   document.getElementById('BSL').disabled = true;
                   //按钮 不可点
               var change_cancel = document.getElementById("BSL");
                   change_cancel.style.display = "none";
                   //按钮 block可见 none 不可见
                   
                   }

            }
         //3.初始化一个url请求
        var user = document.getElementById('BSL').value;
        //var password = document.getElementById('password').value;
       // var data = 'icp='+user+'&password='+password; //生成post请求数据
        var data = 'BSL='+user;
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
