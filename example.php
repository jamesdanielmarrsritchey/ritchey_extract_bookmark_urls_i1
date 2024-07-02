<?php
$location = realpath(dirname(__FILE__));
require_once $location . '/ritchey_extract_bookmark_urls_i1_v1.php';
$return = ritchey_extract_bookmark_urls_i1_v1("{$location}/temporary/bookmarks-2024-07-02.json", FALSE);
if (is_array($return) === TRUE){
	//print_r($return) . PHP_EOL;
	$return = implode(PHP_EOL, $return);
	echo $return;
} else if ($return === TRUE) {
	echo "TRUE" . PHP_EOL;
} else {
	echo "FALSE" . PHP_EOL;
}
?>