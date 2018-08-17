<?php
ini_set('date.timezone', 'America/New_York');

if (!isset($_SESSION["usr"])) {
	$_SESSION["usr"] = "";
}
if (!$_SESSION["usr"] == "") {
	$uid = $_SESSION["usr"];
}

$time = $_SERVER['REQUEST_TIME'];
// for a 30 minute timeout, specified in seconds (1880=30min,3600=1hr)
$timeout_duration = 43200;
if (isset($_SESSION['LAST_ACTIVITY']) && 
   ($time - $_SESSION['LAST_ACTIVITY']) > $timeout_duration) {
    session_unset();
    session_destroy();
    session_start();
}
$_SESSION['LAST_ACTIVITY'] = $time;

if (!isset($uid)) { 
	unset($_SESSION["usr"]);
	?>
	<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
	<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
	<title> Access Denied </title>
	<meta http-equiv="Content-Type"
	content="text/html; charset=utf-8" />
	</head>
	<body>
	<h1> Access Denied </h1>
	<p>Your user ID or password is incorrect, or you are not a
	registered user on this site. To try logging in again, click
	<a href="../index.php">here</a>.</p>
	</body>
	</html>
	<?php
	exit;
}