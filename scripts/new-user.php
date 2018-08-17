<?php
session_start();
//include_once('../include/auth.php');
include_once('../include/config.php');
include_once('../include/mailer.php');

//if ($_SESSION['type'] != 'admin') {
//    echo "<meta http-equiv='refresh' content='0'>";
//    echo "<script>alert('This area is restricted to Administrator users only.'); window.history.go(-1);</script>";
//}

//else {

	if (!isset($_POST['submitok'])) {
    
	?>
	<!DOCTYPE html PUBLIC "-//W3C/DTD XHTML 1.0 Transitional//EN"
	  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
	<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
	    <title>MRP | New User Registration </title>
	    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	    <meta name="viewport" content="width=device-width, initial-scale=1" />
	    <meta http-equiv="x-ua-compatible" content="IE=edge">
		<link rel="icon" type="image/png" href="favicon.png" />
	</head>
	<body>

	<h3>New User Registration Form</h3>
	<p><font color="orangered" size="+1"><tt><b>*</b></tt></font>
	   indicates a required field</p>
	<form method="post" action="<?=$_SERVER['PHP_SELF']?>">
	<table border="0" cellpadding="0" cellspacing="5">
		<tr>
			<td align="right">
				<p>Full Name</p>
			</td>
			<td>
				<input name="newname" type="text" maxlength="100" size="25" />
				<font color="orangered" size="+1"><tt><b>*</b></tt></font>
			</td>
		</tr>
		<tr>
			<td align="right">
				<p>E-Mail Address</p>
			</td>
			<td>
				<input name="newemail" type="text" maxlength="100" size="25" />
				<font color="orangered" size="+1"><tt><b>*</b></tt></font>
			</td>
		</tr>
			<tr>
			<td align="right">
				<p>User-Name</p>
			</td>
			<td>
				<input name="newusername" type="text" maxlength="100" size="25" />
				<font color="orangered" size="+1"><tt><b>*</b></tt></font>
			</td>
		</tr>
		<tr>	    
			<td align="right">
				<p>Password</p>
			</td>
			<td>
				<input name="newpassword1" type="password" maxlength="100" size="25" />            
			</td>
		</tr>
		<tr>	    
			<td align="right">
				<p>Verify Password</p>
			</td>
			<td>
				<input name="newpassword2" type="password" maxlength="100" size="25" />            
			</td>
		</tr>    
		<tr>
			<td align="right">
				<p>Generate temporary password for user's first login</p>
			</td>
			<td>
				<input type="hidden" name="generate-pass" value="0" />
				<input type="checkbox" name="generate-pass" value="1" />
			</td>
		</tr>
		<tr>
			<td align="center" colspan="2">
				<hr noshade="noshade" />
				<input type="reset" value="Reset Form" />
				<input type="submit" name="submitok" value="   OK   " />
			</td>
		</tr>
	</table>
	</form>

	</body>
	</html>

	<?php
	} 
	else {
		$success = false;
		// Connect to SQL database //
		$conn = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
		//  //
		function died($error) {
			echo "<div class='w3-row'>
			<table width='65%' height='unset' align='center'>
			<tr>
			<td align='center'><p color='black' font-size='34px'>
			We're sorry, but there were error(s) found with the form you submitted. These errors appear below.<br /></p>
			<p color='black' font-size='24px'><b>", $error."</b><br /></p>
			<p color='black' font-size='34px'>Please go back and fix these errors.<br /><br /></p>
			</td>
			</tr>
			</table>
			</div>
			<div class='w3-row'><table width='25%' height='20%' align='center'>
			<tr><td align='center'><button onclick='history.back()' style='width:75%; height:75%;'>Okay</button></td></tr>
			</table></div>";        
			die();
		}

		$usernames = array();
		$emails = array();
	
        $minlen = 4;

        //$config = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM configurationdata"));
        //$minlen = $config['MinPasswordLength'];
        //$admin_email = $config['AdminEmail'];

		$sql = "SELECT UserName, UserEmail FROM user_data WHERE UserActive = 'true'";
		$query = mysqli_query($conn, $sql);
		while ($rows = mysqli_fetch_array($query)) {
			$usernames[] = $rows['UserName'];
			$emails[] = $rows['UserEmail'];
		}

		// Process signup submission
		$new_username = filter_var($_POST['newusername'], FILTER_SANITIZE_STRING);
		$new_realname = filter_var($_POST['newname'], FILTER_SANITIZE_STRING);
		$new_email = filter_var($_POST['newemail'], FILTER_SANITIZE_EMAIL);
		$set_temp_pass = filter_var($_POST['generate-pass'], FILTER_SANITIZE_NUMBER_INT);
		$new_password = $_POST['newpassword1'];
		$new_password_verify = $_POST['newpassword2'];	
		$error = "";
		$string_exp = "/^[A-Za-z .'-]+$/";
		$email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9._%-]+.[A-Za-z0-9._%-]+$/';

		if (!preg_match($string_exp,$new_realname)) {
			$error .= 'The Name you entered does not appear to be valid.<br /><br />';
		}		
		if (!preg_match($email_exp,$new_email)) {
			$error .= 'invalid email address.<br /><br />';
		}
		if ($set_temp_pass != 1) {
			if ($new_password != $new_password_verify) {
				$error .= 'passwords do not match.<br /><br />';
			}
			if (strlen($new_password) < $minlen) {
				$error .= 'password must be at least '.$minlen.' characters in length.<br /><br />';
			}
			if (!preg_match("#[0-9]+#", $new_password)) {
				$error .= 'password must contain at least one number.<br /><br />';
			}
			if (!preg_match("#[a-zA-Z]+#", $new_password)) {
				$error .= 'password must contain at least one letter.<br /><br />';
			}
			if (!preg_match("#[A-Z]+#", $new_password)) {
				$error .= 'password must contain at least one capital letter.<br /><br />';
			}
			if (!preg_match("#\W+#", $new_password)) {
				$error .= 'password must contain at least one special character.<br /><br />';
			}
			$new_password = addslashes(password_hash($new_password, PASSWORD_DEFAULT));
			$tmp_pswd = false;
			$new_change_password = "false";
		} else {
			//$new_password = substr(md5(uniqid()),0,10);  // First 10 characters of an MD5 hashed uniqueID generated from timestamp
			$new_password = substr(password_hash(uniqid(), PASSWORD_DEFAULT),0,10);  // First 10 characters of an MD5 hashed uniqueID generated from timestamp
			$tmp_pswd = true;
			$new_change_password = "true";
		}
        /*
		if (in_array($new_username, $usernames)) {
			$error .= '<b>The UserName [ '.$new_username.' ] is already in use.</b><br /><br />';
		}
		if (in_array($new_email, $emails)) {
			$error .= '<b>The email address [ '.$new_email.' ] is already registered to an account.</b><br /><br />';
		}
        */
		if(strlen($error) > 0) {
			died($error);
		} 
		else {
			//$new_type = "standard";		
			$new_isactive = "true";
			$sql = "INSERT INTO user_data (UserName, UserPassword, RealName, UserEmail, UserActive) VALUES ('$new_username', '$new_password', '$new_realname', '$new_email', '$new_isactive')";
			$query = mysqli_query($conn, $sql);
			if(!$query){die(mysqli_error($conn));}
			else {
				$message = "Hello ".$new_realname.", you have successfully created a new account for MyMeLib!<br />";
				$message .= "The following information was added to your user record in our database.<br />"."<br />";
				$message .= "Name: ".$new_realname."<br />";
				$message .= "Email: ".$new_email."<br />";
				$message .= "UserName: ".$new_username."<br />";
				if ($tmp_pswd) {
					$message .= "A temporary password has been created for you to login. Please change this after logging in for your first time."."<br />";
					$message .= "Temporary Password: ".$new_password."<br />";
				} else {
                    $message .= "Password: ".$new_password."<br />";
                    $message .= "Hashed Password: ".$new_password."<br />";
                }
				$message .= "";
				$mailer = new email();
				$mailer->to_email = $new_email;
				$mailer->from_email = $from_email;
				$mailer->reply_email = $reply_email;
				$mailer->subject = "MyMeLib - New Account Registration";
				$mailer->body = $message;
			
				if ($mailer->process_email(date('m-d-Y'))) {
					$success = true;
					return true;
				} else {
					echo $mailer->error_message;
				}
			}
			$success = true;
		}
		if ($success) {
			echo "<meta http-equiv='refresh' content='0'>";
			echo "<script>alert('Successfully added new user to database records.'); window.location('tenmore.solutions');</script>";
		} else {
			echo "<meta http-equiv='refresh' content='0'>";
			echo "<script>alert('An error was encountered adding new user to database records.'); window.history.go(-1);</script>";
		}
			

	}
//}
