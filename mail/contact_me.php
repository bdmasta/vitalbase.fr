<?php
// Check for empty fields

$emails =['france@avnet.com', 'belgique@avnet.com', 'espagne@avnet.com'];

if(empty($_POST['name'])  		||
   empty($_POST['email']) 		||
   empty($_POST['company']) 		||
   empty($_POST['routing']) && !isset($emails[$_POST['routing']]) ||
   empty($_POST['message'])	||
   !empty($_POST['address'])	||
   !filter_var($_POST['email'],FILTER_VALIDATE_EMAIL))
   {
	echo "No arguments Provided!";
	return false;
   }

$name = htmlspecialchars($_POST['name']);
$email_address = htmlspecialchars($_POST['email']);
$company = htmlspecialchars($_POST['company']);
$routing = htmlspecialchars($emails[$_POST['routing']]);
$message = htmlspecialchars($_POST['message']);
$address = htmlspecialchars($_POST['address']);

// Create the email and send the message
$to = $routing ; // Add your email address inbetween the '' replacing yourname@yourdomain.com - This is where the form will send a message to.
$email_subject = "Website Contact Form:  $name";
$email_body = "You have received a new message from your website contact form.\n\n"."Here are the details:\n\nName: $name\n\nEmail: $email_address\n\nCompany: $company\n\nMessage:\n$message";
$headers = "From: noreply@yourdomain.com\n"; // This is the email address the generated message will be from. We recommend using something like noreply@yourdomain.com.
$headers .= "Reply-To: $email_address";
mail($to,$email_subject,$email_body,$headers);
return true;
?>
