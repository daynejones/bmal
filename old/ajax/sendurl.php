<?php

// Required $_POST keys
if (!isset($_POST['to']) || !isset($_POST['long_url']) || !isset($_POST['short_url'])) {
	echo json_encode(array(
		'error' => true,
		'message' => 'Missing parameters.'
	));
	die;
}



$to = $_POST['to'];
$long_url = $_POST['long_url'];
$short_url = $_POST['short_url'];

$headers = 'From: beered@beermealink.com' . "\r\n".
'Reply-To: beered@beermealink.com'. "\r\n".
'Return-Path: beered@beermealink.com' . "\r\n".
'X-Mailer: PHP/' . phpversion();

$subject = "You've been beered. Here's your URL.";
$body = <<<EMAIL

Hello good sir or madam,

Consider yourself beered. Here's your shortened URL:

$short_url

Original url:

$long_url

EMAIL;
 
if (mail($to, $subject, $body, $headers)) {
	echo json_encode(array(
		'error' => false,
		'message' => 'It worked.' 
	));
} else {
   echo json_encode(array(
   		'error' => true,
   		'message' => 'Could not send email.'
   ));
}