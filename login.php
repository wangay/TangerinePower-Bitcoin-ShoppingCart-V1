<?php
require_once('config.php');

//session 
session_start();

if(!isset($_SESSION['lasttime'])){
  $_SESSION['lasttime'] = 0;
}

//deny SESSION after 5 invalid logins
if($_SESSION['lasttime'] > 4){
die("Too many invalid logins");
}

if(isset($_POST['submit'])){
  $hashedPW = md5($adminPW);
  $pw =  md5($_POST['pw']);
  if($pw === $hashedPW){
  $_SESSION['logged'] = 1;
  header('Location: admin.php');
    exit();
  } else {
  $message = "Invalid password";
  $_SESSION['lasttime']++;
  //slow down brute force
  sleep(3);
  }
}

?>

<!DOCTYPE html>
<html>
<head>
<title>LogIn</title>
<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<h1><?php echo $storeName; ?></h1>
<div id="viewCart">
  <span id="viewTitle">Admin</span><br>
  
  Login to access the admin page. <br>
 <form method="post">
 <input type="password" name="pw"><br>
 <input type="submit" name="submit" value="Log In">
 </form>
  <br><?php if(isset($message)){ echo $message; } ?>
  
</div>
<br>
    <?php include('footer.php'); ?>
</body>
</html>