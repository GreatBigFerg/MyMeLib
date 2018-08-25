<?php
session_start();
include_once('../include/config.php');
include_once('../include/auth.php');
include_once('../include/common.php');

$usr = $_SESSION["usr"];
$name = $_SESSION["name"];

?>
<!DOCTYPE html PUBLIC "-//W3C/DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv='Content-Type' content='text/html; charset=utf-8'/>
    <title>MyMeLib | Upload</title>
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
		#upload-form {
			border-radius: 25px;
			box-shadow: 1px 1px 6px 2px rgba(0, 0, 0, 0.75);
			margin-bottom: 45px;
			margin-top: 25px;
			padding: 8px;
		}
		#upload-form::before {			
			content: " ";
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
	</style>
</head>
<body>
<!--  -->
<div id="header">
	<h2>Welcome to MyMeLib, <i style="text-decoration:underline; font-size:28px;"><?php echo $name;?></i></h2>
	<button id="logout" onclick="location.href='../scripts/logout.php'">LOGOUT <br /> [ <i><?php echo $usr;?></i> ]</button>
</div>
<!--  -->
<div id="upload-form">
    <form enctype="multipart/form-data" action="" method="post">          
		<div class="form-row">
			<input type="file" name="uploaded_file">
		</div>
        <div class="form-row">
			<label>Title</label>
			<input name="title" type="text" maxlength="100" size="15" />
		</div>
        <div class="form-row">
			<label>Artist</label>
			<input name="artist" type="text" maxlength="100" size="15" />
		</div>
        <div class="form-row">
			<label>Album</label>
			<input name="album" type="text" maxlength="100" size="15" />
		</div>
        <div class="form-row">
			<label>Genre</label>
			<input name="genre" type="text" maxlength="100" size="15" />
		</div>		
        <div class="form-row">
			<input style="grid-column:1/2; margin-right:16px;" type="reset" value="Reset Form" />		
			<input style="grid-column:2/3;" type="submit" value="Upload">
		</div>
    </form>
</div>
</body>
</html>
<?php


if (!empty($_FILES['uploaded_file'])) {

	$title = filter_var($_POST['title'], FILTER_SANITIZE_STRING);	
	$artist = filter_var($_POST['artist'], FILTER_SANITIZE_STRING);
	$album = filter_var($_POST['album'], FILTER_SANITIZE_STRING);
	$genre = filter_var($_POST['genre'], FILTER_SANITIZE_STRING);

	$upload = $_FILES["uploaded_file"];
	$name = preg_replace("/[^A-Z0-9._-]/i", "_", $upload["name"]);	
	$fp = $upload_dir . $name;
	$success = move_uploaded_file($upload["tmp_name"], $fp);

	$fileinfo = pathinfo($fp);
	$filedir = $fileinfo['dirname'];
	$extension = $fileinfo['extension'];

	$conn = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
	$sql = "INSERT INTO audio_data (Title, Artist, Album, Genre, FileName, FilePath, FileFormat, FileExists) VALUES ('$title', '$artist', '$album', '$genre', '$name', '$filedir', '$extension', 'true')";
	$query = mysqli_query($conn, $sql);
	if (!$query) {
		echo mysqli_error($conn);
	}
	mysqli_close($conn);

   
    if ($upload["error"] !== UPLOAD_ERR_OK) {
        echo "<p>An error occurred.</p>";
        exit;
    }    
    
    
    if ($success) {
        $msg = "File uploaded successfully!";
    } else {
        $msg = "An error was encountered while uploading your file, please try again.";
    }
	echo "<meta http-equiv='refresh' content='0'>";
	echo "<script> alert('".$msg."');</script>";
}

