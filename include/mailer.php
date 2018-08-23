<?php
ini_set('date.timezone', 'America/New_York');
//ini_set('SMTP','smtp.cescomputers.net');
//ini_set('smtp_port',25);

//error_reporting(E_ALL);
//ini_set('display_errors', 1);

/*
require("mailer.php");
$mailer = new email();
$mailer->to_email = *STRING*;
$mailer->from_email = *STRING*;
$mailer->reply_email = *STRING*;
$mailer->subject = *STRING*;
$mailer->body = *STRING*;
if ($mailer->process_email(date('Y-m-d G:i:s'))) {echo "Email was successfully sent";}
else {$msg = $mailer->error_message; echo "Email failed to send:: ".$msg;}
*/

class email {
    // Establish public variables used to define & configure the email //
    public $to_email = '';
    public $from_email = '';
	public $reply_email = '';
    public $subject = '';
    public $body = '';
	public $priority = 3; // (1=HIGH, 3=NORMAL, 5=LOW) //
	public $sms = false;
	//public $content_type = "Content-Type: text/html; charset='UTF-8'"."\r\n";
	public $bad_values = array("content-type","bcc:","to:","cc:","href");
	public $error_message = '';
    // Connects to specified SMTP server and attempt to send the email //
	function send_email($t, $s, $b, $h) {
		try {$attempt_send = @mail($t, $s, $b, $h);}
		catch (Exception $err) {
			$this->error_message .= $err->getMessage()."\r\n";
			return False;
		}
		finally {
			if (!$attempt_send) {
				$err = error_get_last()["message"];
				if (substr($err, 0, 39) == "mail(): Failed to connect to mailserver") {
					$this->error_message .= "Failed to connect to SMTP mailserver, could not send email.";
				} else {
					$this->error_message .= $err;
				}
				return False;
			}
			else {return True;}
		}
	}
    // Strip unwanted characters, such as linebreaks, from the email headers //
	function sanitize_header($str) {
		$str = trim($str);
		$str = str_replace("\r", "", $str);
		$str = str_replace("\n", "", $str);
		return $str;
	}
    // Function called on by external scripts to validate/sanitize each field of the email and then call upon the send_email function to actually connect to SMTP server and send the Email //
	function process_email($timestamp) {
        if ($this->reply_email == '') {$this->reply_email = $this->from_email;}
		$formal_address = htmlspecialchars(str_replace($this->bad_values,"",$this->sanitize_header($this->to_email)));
		$formal_subject = $this->sanitize_header($this->subject);
		$formal_body = $this->body;
		if (!$this->sms) {
			$formal_header = "From: ".$this->sanitize_header($this->from_email)."\r\n Reply-To: ".$this->sanitize_header($this->reply_email)."\r\n Content-Type: text/html; charset='UTF-8' \r\n X-Mailer: PHP/".phpversion();
		} else {
			$formal_header = "From: ".$this->sanitize_header($this->from_email)."\r\n Reply-To: ".$this->sanitize_header($this->reply_email)."\r\n X-Mailer: PHP/".phpversion();
		}
		
		return $this->send_email($formal_address, $formal_subject, $formal_body, $formal_header);
	}
}