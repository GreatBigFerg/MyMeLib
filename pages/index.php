<?php
session_start();
include_once('../include/config.php');
include_once('../include/auth.php');
include_once('../include/common.php');

$usr = $_SESSION["usr"];
$name = $_SESSION["name"];

$audio = new audio();

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

        form {
			display: grid;
			grid-template-columns: 50px 1fr;
			grid-gap: 6px;
		}
		.form-row {
			display: grid;
			margin: 8px 12px;
			grid-column: 1 / 2;
		}
		
		label {
			grid-column: 1 / 2;
			grid-row: 1 / 2;
			width: 50px;
		}
 
		input, button {
			grid-column: 2 / 3;
			
		}
        .upload-form-container {
            border-radius: 25px;
			box-shadow: 1px 1px 6px 2px rgba(0, 0, 0, 0.75);
			margin-bottom: 45px;
			margin-top: 25px;
            background-color: darkgray;
        }
	</style>
</head>
<body>
<!-- Header & Navigation Menu -->
<?php include("header.php"); ?>
<!--  -->
<div id="music-library">
	<div>
		<div class="column column-label title">Title</div>
		<div class="column column-label artist">Artist</div>
		<div class="column column-label album">Album</div>
		<div class="column column-label genre">Genre</div>
	</div>
	<div>
		<?php 
		foreach($audio->get_music_list() as $song) { ?>
			<div class="row">
				<div class="column title"> <?php echo $song['title']; ?></div>
				<div class="column artist"> <?php echo $song['artist']; ?></div>
				<div class="column album"> <?php echo $song['album']; ?></div>
				<div class="column genre"> <?php echo $song['genre']; ?></div>
			</div>
		<?php } ?>
	</div>
    <!--  -->
    <div class="upload-form-container">
        <?php include("../pages/upload.php"); ?>
    </div>
</div>

<!--  -->
<div id="video-library">
	<div>
		<div class="column column-label title">Title</div>
		<div class="column column-label artist">Artist</div>
		<div class="column column-label album">Album</div>
		<div class="column column-label genre">Genre</div>
	</div>
	<div>
		<?php 
		if (!get_video_list()) { ?>
			<div class="row"><div class="column no-records"></div></div>
		<?php } else {
		foreach(get_video_list() as $vid) { ?>
			<div class="row">
				<div class="column title"> <?php echo $song['title']; ?></div>
				<div class="column artist"> <?php echo $song['artist']; ?></div>
				<div class="column album"> <?php echo $song['album']; ?></div>
				<div class="column genre"> <?php echo $song['genre']; ?></div>
			</div>
		<?php } } ?>
	</div>
</div>
</body>
</html>
<?php

