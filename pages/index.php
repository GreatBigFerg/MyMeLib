<?php
session_start();
include_once('../include/config.php');
include_once('../include/auth.php');
include_once('../include/common.php');

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
	<style>		
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
		
	</style>
</head>
<body>
<h1>Welcome to MyMeLib, <?php echo $name ?> </h1>
<h3>You have successfully logged in!</h3>
<div>
	<button onclick="location.href='../scripts/logout.php'">LOGOUT</button>
</div>
<div>
	<div>
		<div class="column column-label title">Title</div>
		<div class="column column-label artist">Artist</div>
		<div class="column column-label album">Album</div>
		<div class="column column-label genre">Genre</div>
	</div>
	<div>
		<?php 
		foreach(get_music_list() as $song) { ?>
			<div class="row">
				<div class="column title"> <?php echo $song['title']; ?></div>
				<div class="column artist"> <?php echo $song['artist']; ?></div>
				<div class="column album"> <?php echo $song['album']; ?></div>
				<div class="column genre"> <?php echo $song['genre']; ?></div>
			</div>
		<?php } ?>
	</div>
</div>
</body>
</html>
<?php
}
