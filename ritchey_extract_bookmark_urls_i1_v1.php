<?php
//Name: Ritchey Extract Bookmark URLS i1 v1
//Description: Extract bookmark URLs from a Mozilla Firefox bookmark JSON export. On success returns an array of URLs, or "TRUE" if no URLs were found. Returns "FALSE" on failure.
//Notes: Optional arguments can be "NULL" to skip them in which case they will use default values.
//Arguments: 'source' (required) is the path to the JSON bookmark file. 'display_errors' (optional) indicates if errors should be displayed.
//Arguments (Script Friendly):source:path:required,display_errors:bool:optional
//Content:
//<value>
if (function_exists('ritchey_extract_bookmark_urls_i1_v1') === FALSE){
function ritchey_extract_bookmark_urls_i1_v1($source_file, $display_errors = NULL){
	# Check Variables
	$errors = array();
	$location = realpath(dirname(__FILE__));
	if (@is_file($source_file) === FALSE){
		$errors[] = 'source';
	}
	if ($display_errors === NULL){
		$display_errors = FALSE;
	} else if ($display_errors === TRUE){
		#Do Nothing
	} else if ($display_errors === FALSE){
		#Do Nothing
	} else {
		$errors[] = "display_errors";
	}
	# Task
	if (@empty($errors) === TRUE){
		## Import the bookmarks
		$data = file_get_contents($source_file);
		## Extract URLs
		preg_match_all('/"uri":"(.*?)"}/', $data, $result);
		array_filter($result);
		$result = $result[1];
	}
	result:
	# Display Errors
	if ($display_errors === TRUE){
		if (@empty($errors) === FALSE){
			$message = @implode(", ", $errors);
			if (function_exists('ritchey_extract_bookmark_urls_i1_v1_format_error') === FALSE){
				function ritchey_extract_bookmark_urls_i1_v1_format_error($errno, $errstr){
					echo $errstr;
				}
			}
			set_error_handler("ritchey_extract_bookmark_urls_i1_v1_format_error");
			trigger_error($message, E_USER_ERROR);
		}
	}
	# Return
	if (@empty($errors) === TRUE){
		if (@empty($result) === TRUE){
			return TRUE;
		} else {
			return $result;
		}
	} else {
		return FALSE;
	}
}
}
//</value>
?>