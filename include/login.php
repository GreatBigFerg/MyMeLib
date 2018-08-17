<?php
$error='';
if (isset($_POST['submit'])) {
	if (empty($_POST['username']) || empty($_POST['password'])) {
		$error = "Username or Password is invalid";
	}
	else {
		// Define $username and $password
		$username = $_POST['username'];
		$password = $_POST['password'];
		$username = stripslashes($username);
		//$password = addslashes(md5($password));
		$password = addslashes(password_hash($password));
		// Connect to SQL database //
		define('DB_SERVER', 'localhost');
		define('DB_USER', '***');
		define('DB_PASS', '***');
		define('DB_NAME', '***');
		$conn = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
		// SQL query to fetch information of registerd users and finds user match.
		$query = mysqli_query($conn, "select * from user_data where UserPassword='$password' AND UserName='$username' AND UserActive = 'true'");
		$rows = mysqli_num_rows($query);
		if ($rows == 1) {
			$rows = mysqli_fetch_array($query);
			$name = $rows['RealName'];
			$_SESSION["usr"] = $username;
			$_SESSION["name"] = $name;
			header("location: www.google.com");				
		} else {
			$error = "Username or Password is invalid";
		}
		mysqli_close($conn);
	}
}