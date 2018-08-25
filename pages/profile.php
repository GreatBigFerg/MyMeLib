<?php
session_start();
include_once('../include/config.php');
include_once('../include/auth.php');
include_once('../include/common.php');

$usr = $_SESSION["usr"];
$name = $_SESSION["name"];

$profile = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM user_data WHERE UserName = '$usr'"));

?>
<!DOCTYPE html PUBLIC "-//W3C/DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv='Content-Type' content='text/html; charset=utf-8'/>
    <title>MyMeLib | HOME</title>
    <link rel="icon" type="image/png" href="favicon.png" />
	<meta http-equiv="x-ua-compatible" content="IE=edge">
	<style>
		#header {
			position: sticky;
			top: 0px;
			right: 0px;
			left: 0px;
			background-color: rgba(0, 204, 0, 0.65);
			padding: 5px;
			margin: 0px 0px 8px 0px;
		}
		#logout {
			position: absolute;
			top: 0px;
			right: 0px;
			padding: 8px;
			font-size: 16px;
			font-weight: 700;
			color: firebrick;
			background-color: black;
			border: none;
			cursor: pointer;
			box-shadow: 2px 2px 2px 2px rgba(0, 0, 0, 0.75);
		}
		#music-library {
			border-radius: 25px;
			box-shadow: 1px 1px 6px 2px rgba(0, 0, 0, 0.75);
			margin-bottom: 45px;
			margin-top: 25px;
		}
		#music-library::before {			
			content: "MUSIC";
			font-size: 25px;
			display: block;
			margin:4px auto;
			margin-bottom: 6px;
			text-align:center;
		}		
		.row {
			margin: 6px auto;
			border: 0px solid black;
			background-color: white;
		}
		.row:nth-child(even) {
			background: gainsboro;
		}
		.column {
			display: inline-block;
			border: 1px solid black;
			border-top: none;
			border-bottom: none;
			padding: 2px 4px;
			font-size: 18px;
		}
		.column-label {
			border: 1px solid black;
			border-top: none;
			border-bottom: none;
			margin-bottom: 2px;
			font-weight: 700;
			font-size: 21px;
			text-align: center;
		}
		.title {
			width: 150px;			
		}
		.artist {
			width: 150px;
		}
		.album {
			width: 100px;			
		}
		.genre {
			width: 100px;
		}
		#video-library {
			border-radius: 25px;
			box-shadow: 1px 1px 6px 2px rgba(0, 0, 0, 0.75);
		}
		#video-library::before {			
			content: "VIDEOS";
			font-size: 25px;
			display: block;
			margin:4px auto;
			margin-bottom: 6px;
			text-align:center;
		}
		.no-records {
			width: 500px;
			text-align: center;
			font-weight: bold;			
		}
		.no-records::after {
			content: "NO RECORDS FOUND!";
		}
		.section {
			background-color: gainsboro;
		}
		.section div {
			display: inline-block;
		}
	</style>
</head>
<body>
<!--  -->
<div id="header">
	<h2>Welcome to MyMeLib, <i style="text-decoration:underline; font-size:28px;"><?php echo $name;?></i></h2>
	<button id="logout" onclick="location.href='../scripts/logout.php'">LOGOUT <br /> [ <i><?php echo $usr;?></i> ]</button>
</div>
<!--  -->
<div id="profile-container">
	<div class="section">
		<div>Name</div>
		<div>
			<?php echo $profile['RealName'] ?>
		</div>
	</div>
	<div class="section">
		<div>Icon</div>
		<div>
			<?php echo $profile['id'] ?>
		</div>
	</div>
	<div class="section">
		<div>UserName</div>
		<div>
			<?php echo $profile['UserName'] ?>
		</div>
	</div>
	<div class="section">
		<div>Email</div>
		<div>
			<?php echo $profile['UserEmail'] ?>
		</div>
	</div>
	<div class="section">
		<div>Password</div>
		<div>
			<?php echo $profile['id'] ?>
		</div>
	</div>
	<div class="section">
		<div>Family</div>
		<div>
			<?php echo $profile['id'] ?>
		</div>
	</div>
	<div class="section">
		<div></div>
		<div></div>
	</div>
	<div class="section">
		<div></div>
		<div></div>
	</div>
</div>

</body>
</html>
<?php

