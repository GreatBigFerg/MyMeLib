<?php
session_start();
include_once('../include/config.php');
include_once('../include/auth.php');
include_once('../include/common.php');

$usr = $_SESSION["usr"];
$name = $_SESSION["name"];

$audio = new audio();
$video = new video();
$ui = new gui();

$ui->get_mode();

?>
<!DOCTYPE html PUBLIC "-//W3C/DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>MyMeLib | HOME</title>
	<meta http-equiv='Content-Type' content='text/html; charset=utf-8'/>
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<meta http-equiv="x-ua-compatible" content="IE=edge">
	<link rel="icon" type="image/png" href="favicon.png" />
	<link href='../css/main.css' rel='stylesheet'>
</head>
<body class="<?php echo $ui->mode ?>">
	<!-- Header & Navigation Menu -->
	<?php include("header.php"); ?>
	<!-- BROWSE MUSIC -->
	<?php include("browse.php"); ?>
	<!-- UPLOAD MUSIC 
	<div class="upload-form-container">
		<?php /* include("upload.php"); */ ?>
	</div>
	-->
</body>
</html>
<?php
