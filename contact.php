<?php
	session_start();
	$error = false;
	if(isset($_SESSION['error'])) {
		$error = true;
	} 

	session_destroy();
	$public_key = "6LfIdMsSAAAAAKwPX4_rAHJnKZGKvTuyUvHbZspS";
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-frameset.dtd">
<html dir="ltr" lang="en">
<head>
<link rel="stylesheet" type="text/css" href="css/screen.css">
<title>Contact Us</title>
<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-28671906-1']);
  _gaq.push(['_setDomainName', 'wavecloud.com']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
</head>
<body>
	<div class="main_container">
		<?php require_once('includes/header.php'); ?>
		<div class="content_header">
			<div class="title">
				<span class="title_text">Contact Us</span>
				<hr>
			</div>
			<div class="saying">Send us an <span class="big italic">Email</span></div>
		</div>
		<div class="content">
			<span class="text_large">Fill out the form</span></br>
			<div id="error_message">
				<span class="red"><?php echo $_SESSION['error']; ?></span>
			</div>
			<div id="success_message">
				<span class="green text_medium text_left"><?php echo $_SESSION['success']; ?></span>
			</div>
			<form action="email.php" name="contact_form" method="post">
				<label for="first_name">First Name </label><span class="red">*</span><br/>
				<input type="text" name="first_name" value="<?php echo ($error ? $_SESSION['first_name'] : ''); ?>" /><br/>
				<label for="last_name">Last Name </label><span class="red">*</span><br/>
				<input type="text" name="last_name" value="<?php echo ($error ? $_SESSION['last_name'] : ''); ?>" /><br/>
				<label for="email" >Email Address </label><span class="red">*</span><br/>
				<input type="text" name="email" value="<?php echo ($error ? $_SESSION['email'] : ''); ?>" /><br/><br/>
				<input type="radio" name="books" value="1_or_fewer" <?php echo (($error && $_SESSION['books'] == '1_or_fewer') ? 'checked' : '') ?> /> Have published 1 or fewer books &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<input type="radio" name="books" value="2_or_more" <?php echo (($error && $_SESSION['books'] == '2_or_more') ? 'checked' : '') ?> /> Have published 2 or more books<br/><br/>
				<label for="message">Message </label><br/>
				<textarea name="message" row="20"><?php echo ($error ? $_SESSION['message'] : ''); ?></textarea><br/>
				<?php
					//require('includes/recaptchalib.php');
  					//echo recaptcha_get_html($public_key);
				?>
				<input type="submit" />
			</form>
			<br/>
			<p><span class="text_large">...or contact us directly</span></p>
			<p class="indent">
				<span class="bold">WaveCloud Corporation</span><br/>
				8055 E. Tufts Ave, Suite 250<br/>
				Denver, CO.  80237
			</p>
			<p class="indent">
				<span class="bold">Email</span><br/>
				General questions, comments, or concerns - <a class="email" href="mailto:contact@WaveCloud.com">contact@WaveCloud.com</a><br/>
			</p>
		</div>
	</div>
</body>
</html>