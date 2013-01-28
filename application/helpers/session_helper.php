<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/***********************************************************************
 * By Agus Prasetyo
 * email : agusprasetyo811@gmail.com
 ***********************************************************************/

// Cek if user get access login
function get_access_login($session_name) {
	$CI =&get_instance();
	$user = $CI->session->userdata($session_name);
	if ($user == "" || !isset($user)) {
		return FALSE;
	} else {
		return TRUE;
	}
}

// Get Access data in controller when pages that included sending data
function get_modules_access_data($modules_data) {
	$new_modules_data = str_replace(';','&',$modules_data);
	parse_str($new_modules_data, $output_modules_data);
	if (is_array($output_modules_data)) {
		return $output_modules_data;
	}
}

// Isset Switch to cek is data available or not
function isset_switch($data_a, $data_b) {
	return $data = (isset($data_a)) ? $data_a : $data_b;
}
