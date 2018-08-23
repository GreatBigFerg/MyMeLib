<?php
session_start();
include('../include/login.php');

if(isset($_SESSION["usr"])){
	header("location: pages/index.php");
} else {
?>
<!DOCTYPE html>
<html>
<head>
<title>MyMeLib | Login</title>
<link href="style.css" rel="stylesheet" type="text/css">
</head>
<body>
<div id="main">
<h1>MyMeLib Login</h1>
<div id="login">
<h2>Login Form</h2>
<form action="" method="post">
<label>UserName :</label>
<input id="name" name="username" placeholder="username" type="text">
<label>Password :</label>
<input id="password" name="password" placeholder="**********" type="password">
<input name="submit" type="submit" value=" Login ">
<span><?php echo $error; ?></span>
</form>
</div>
</div>
</body>
</html>

<?php
}