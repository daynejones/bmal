<?php

$uri = $_SERVER['REQUEST_URI'];
$uri = preg_replace('/\//','',$uri);

// The URI should be 3 characters but we won't bother checking now

if ($uri == '')
	header('Location: http://www.beermealink.com');

require("../models/bmal_model.php");

$bmal = new Bmal();

$response = $bmal->getURLFromCode($uri);

if (!$response['error'])
	header('Location: ' . $response['url']);
else 
	$message = 'This url does not exist!';

?>


<html>
<head>
<title>BMAL</title>
</head>
<body>
<?= $message; ?>
</body>
</html>
