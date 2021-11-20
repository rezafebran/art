<?php
if(isset($_POST['send'])) {
    $email = $_POST['email'];
	$header	= $_POST['header'];
	$message = $_POST['message'];
	$sender	= 'From: '.$email;
	
	if(mail('smtpssip72@gmail.com', $header, $message, $sender)) {
		echo "<script type='text/javascript'>alert('Thank you for contacting us');</script>";
	}
    
    else{
		echo "<script type='text/javascript'>alert('Error');</script>";
	}
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Contact</title>
</head>
<body>
	<h2>Contact Us</h2>
	<form method="POST">
        <label for="email">Your Email</label>
        <p><input type="text" name="email" placeholder="Email" size="30" required /></p>
        <label for="email">Name</label>
		<p><input type="text" name="header" placeholder="Subject" size="30" required /></p>
        <label for="email">Message</label>
		<p><textarea name="message" placeholder="Message" rows="6" cols="40" required></textarea>
		<p><input type="submit" name="send" value="Send" /> 
	</form>	
</body>
</html>