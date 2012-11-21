<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
/**
 * Constants
 */
$formats = array( 'json' );
$format_funcitons = array( 'json' => 'json_encode' );

// Determine the format function to be used
if ( !isset( $_REQUEST['format'] ) || !in_array( strtolower($_REQUEST['format']), $formats ) ) {
	$format = 'json';
	$format_function = $format_funcitons['json'];
} else {
	$format = strtolower($_REQUEST['format']);
	$format_function = $format_funcitons[$format];
}


// Make sure the url is passed
if (!isset($_REQUEST['url'])) {
	echo $format_function( array( "error" => "You must post a url" ) );
	die;
}

$the_url = urldecode($_REQUEST['url']);

// Ensure a protocol is used
if ( !preg_match( '/(http:\/\/|https:\/\/)/is', $the_url ) ) {
	$the_url = 'http://'.$the_url;
}

require_once("../models/bmal_model.php");

$bmal = new Bmal();

$response = $bmal->addLink($the_url);

if ($response['error']) {
        echo $format_function( array( "error" => "Failed to add link" ) );
}
else {
        echo $format_function( array( "link" => "http://bmal.me/".$response['link_code'] ) );
}

?>
