<?php
session_start();
include_once('../include/config.php');
include_once('../include/auth.php');

$usr = $_SESSION["usr"];
$name = $_SESSION["name"];

if (!isset($_POST['submitok'])) {
    
?>
<!DOCTYPE html PUBLIC "-//W3C/DTD XHTML 1.0 Transitional//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv='Content-Type' content='text/html; charset=utf-8'/>
    <title>MyMeLib | HOME</title>
    <link rel="icon" type="image/png" href="favicon.png" />
	<meta http-equiv="x-ua-compatible" content="IE=edge">
</head>
<body>
<h1>Welcome to MyMeLib, <?php echo $name ?> </h1>
<h3>You have successfully logged in!</h3>
</body>
</html>
<?php
}
