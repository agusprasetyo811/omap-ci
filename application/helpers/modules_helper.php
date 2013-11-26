<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/***********************************************************************
 * By Agus Prasetyo
 * email : agusprasetyo811@gmail.com
 ***********************************************************************/

# Build modules definition
function mod($modules, $return_data = FALSE) {
	$OCI =& get_instance();
	$get_method = explode('__', $modules);
	if ($return_data == TRUE) {
		require_once 'application/controllers/'.$get_method[0].'.php';
		if (count($get_method) != 1) {
			$data = new $get_method[0]();
			$get_modules_data = $data->$get_method[1]();
			$OCI->session->set_userdata('session_mod_data_'.$modules, $get_modules_data);
		} else {
			$data = new $get_method[0]();
			$get_modules_data = $data->index();
			$OCI->session->set_userdata('session_mod_data_'.$modules, $get_modules_data);
		}
		return $modules;
	} else {
		return $modules;
	}
}

# Build all modules from definition
function build_modules($modules) {
	return $modules;
}
