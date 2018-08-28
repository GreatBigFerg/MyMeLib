<?php
include_once('config.php');
$error='';
if (isset($_POST['submit'])) {
	if (empty($_POST['username']) || empty($_POST['password'])) {
		$error = "Username or Password is invalid";
	}
	else {
		// Get the username & password input values from the user
		$username = $_POST['username'];
		$password = $_POST['password'];
		$username = $username;
		$password = $password;
		// Connect to SQL database //
		$conn = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
		// Find record with matching username & password in existing user records
		$query = mysqli_query($conn, "select * from user_data where UserName='$username' AND UserActive = 'true'");
		$rows = mysqli_num_rows($query);
		if ($rows == 1) {
			$rows = mysqli_fetch_array($query);
            // If username & password are valid the user is redirected to the site's homepage //
            if (password_verify($password, $rows['UserPassword'])) {
                $name = $rows['RealName'];
			    $_SESSION["usr"] = $username;
			    $_SESSION["name"] = $name;
			    header("location: pages/index.php");		
            } else {
			    $error = "<br /><br />Username or Password is invalid";
		    }	
		} else {
			$error = "<br /><br />Username or Password is invalid";
		}
		mysqli_close($conn);
	}
}