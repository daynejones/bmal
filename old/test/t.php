<?php
ini_set('display_errors',1);
error_reporting(E_ALL);

function generateCode($last) {
	
	$next = false;

	$letters = array();

	// Populate the letters array

	foreach (range('a', 'z') as $letter) {
        	$letters[] = $letter;
	}

	foreach (range('A', 'Z') as $letter) {
	        $letters[] = $letter;
	}


	foreach ($letters as $k1 => $v1) {
	        foreach ($letters as $k2 => $v2) {
	                foreach ($letters as $k3 => $v3) {
	                        $code =  $v1 . $v2 . $v3;
				if ($next) 
					return $code;
				if ($code == $last)
					$next = true;
	                }
	        }
	
	}

}

echo generateCode('ZZa');

?>
