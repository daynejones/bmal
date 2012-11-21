<?php
ini_set('display_errors',1);
error_reporting(E_ALL);

require_once("../models/bmal_model.php");

$the_url = $_POST['the_url'];

$bmal = new Bmal();

$response = $bmal->addLink($the_url);

if ($response['error']) {
	echo json_encode($response);
}
else {
	echo json_encode(array("link_code" => $response['link_code']));
}
?>
