<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/***********************************************************************
 * By Agus Prasetyo
 * email : agusprasetyo811@gmail.com
 ***********************************************************************/

# Read column in database
function show_table_column($query) {
	$field = json_decode(json_encode($query), true);
	return array_keys($field);
}

# Read column in json data
function show_json_column($json) {
	$field = json_decode($json, true);
	return array_keys($field);
}

# Convert Json to String
function show_json_column_text($json, $sparator, $sort_desc) {
	$field = json_decode($json, true);
	if ($sort_desc == false) {
		return implode($sparator, array_keys($field));	
	} else {
		return implode($sparator, array_reverse(array_keys($field)));
	}
	
}