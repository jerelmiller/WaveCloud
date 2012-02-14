<?php 
	session_start();
	//require_once('includes/recaptchalib.php');

	// Used for error messaging
	$_SESSION['error'] = '';
	$error = false;

	// reCAPTCHA private key
	//$private_key = "6LfIdMsSAAAAAAR27Ep9A-X4XNmWKnTfGO3rsnME";

	/*$resp = recaptcha_check_answer ($private_key,
																$_SERVER["REMOTE_ADDR"],
																$_POST["recaptcha_challenge_field"],
																$_POST["recaptcha_response_field"]);

	if (!$resp->is_valid) {
			// What happens when the CAPTCHA was entered incorrectly
			$_SESSION['error'] .= "The reCAPTCHA wasn't entered correctly. Go back and try it again.<br/>";
			$error = true;
	}*/

	$email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';
	if(!preg_match($email_exp, $_POST['email'])) {
		$_SESSION['error'] .= "Your email address does not appear to be valid<br/>";
		$error = true;
	}

	/*if(strlen($_POST['message']) < 2) {
		$_SESSION['error'] .= "Please enter a message that is greater than a length of 2 characters<br/>";
	}*/

	if(strlen($_POST['first_name']) > 0 && strlen($_POST['last_name']) > 0 && strlen($_POST['email']) > 0 /*&& strlen($_POST['message']) > 0*/) {
		$email_to = 'contact@WaveCloud.com';
		$email_subject = "Email from WaveCloud Contact Form";


		$first_name = $_POST['first_name'];
		$last_name = $_POST['last_name'];
		$email_from = $_POST['email'];
		$message = $_POST['message'];

		if($_POST['books'] == '1_or_fewer') {
			$books = 'Have published 1 or fewer books';
		} else if($_POST['books'] == '2_or_more') {
			$books = 'Have published 2 or more books';
		} else {
			$books = '';
		}

		function clean_string($string) {
			$bad = array("content-type","bcc:","to:","cc:","href");
			return str_replace($bad,"",$string);
		}

		$email_message = '';
		$email_message .= "First Name: ". clean_string($first_name)."\n";
		$email_message .= "Last Name: ". clean_string($last_name)."\n";
		$email_message .= "Email: ". clean_string($email_from)."\n";
		$email_message .= "Books: ". clean_string($books)."\n";
		$email_message .= "Message: ". clean_string($message)."\n";


		$headers = 'From: '.$email_from."\r\n".
		'Reply-To: '.$email_from."\r\n";

	} else {
		$error = true;
		$_SESSION['error'] .= "Please fill out all of the required information<br/>";
	}

	if(!$error) {
		$_SESSION['success'] = "Your email was sent successfully. Thank you for your response!";
		mail($email_to, $email_subject, $email_message, $headers); 
	} else {
		// Grab the form information if there is an error so the user doesn't have to reinput
		$_SESSION['first_name'] = $_POST['first_name'];
		$_SESSION['last_name'] = $_POST['last_name'];
		$_SESSION['email'] = $_POST['email'];
		$_SESSION['books'] = $_POST['books'];
		$_SESSION['message'] = $_POST['message'];
	}

	header('Location: contact.php');
 ?>