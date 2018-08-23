<?php
// Set TimeZone //
ini_set('date.timezone', 'America/New_York');
error_reporting(E_ALL);// Display errors //
ini_set('display_errors', 1);// Display errors //

// Database credentials //
define('DB_SERVER', 'localhost');
define('DB_USER', 'mymelib-tmp');
define('DB_PASS', 'mml@TMS69');
define('DB_NAME', 'mymelib_dev');

// FTP credentials //
define('FTP_HOST', 'localhost');
define('FTP_USER', '***');
define('FTP_PASS', '***');


// The full path & filename of the program you want to use to open your video files //     // Note: file positions WILL NOT WORK if you're not using MPC with "remember position" enabled
$videoPlayerPathname = 'C:\Program Files (x86)\MPC-HC\mpc-hc-gpu.exe';
// Optional switches for opening files //
$videoPlayerSwitches = '/play /fullscreen';

$upload_dir = "tmp/";

$video_dir = "C:/FergShare/Public_Content/Video";
$video_ext = ['avi','mkv','mp4','mov','wmv'];
$audio_dir = "C:/FergShare/Public_Content/Audio";
$audio_ext = ['mp3','wma','m4a','wav'];

$email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9._%-]+.[A-Za-z0-9._%-]+$/';
$phone_exp = '/^\(?([0-9]{3})\)?[-. ]?([0-9]{3})[-. ]?([0-9]{4})+$/';
$string_exp = "/^[A-Za-z .'-]+$/";

$from_email = "noreply@tenmore.solutions";
$reply_email = "noreply@tenmore.solutions";

// Establish connection with MySQL database //
$conn = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
if (!$conn) {
	die("Connection failed: " . mysqli_connect_error());
}

// Get configuration info from database //
/*
$config = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM configurationdata"));
if ($config['AdminEmail'] != "") {
	$admin_email = $config['AdminEmail'];
} else {
    $admin_email = "bryceferguson.css@gmail.com";
}
*/

/*
 //  //
$a_genres = array();
$query = mysqli_query($conn, "SELECT genre FROM audiodata WHERE exists = 'true'");
while ($rows = mysqli_fetch_array($query)) {
	$a_genres[$rows['genre']];
}	
//  //
$v_genres = array();
$query = mysqli_query($conn, "SELECT genre FROM videodata WHERE exists = 'true'");
while ($rows = mysqli_fetch_array($query)) {
	$v_genres[$rows['genre']];
}



//  //
$a_artists = array();
$query = mysqli_query($conn, "SELECT artist FROM audiodata WHERE artist IS NOT NULL AND exists = 'true'");
while ($rows = mysqli_fetch_array($query)) {
	$a_artists[$rows['artist']];
}
*/

	









mysqli_close($conn);