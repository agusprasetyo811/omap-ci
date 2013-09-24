<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/***********************************************************************
 * By Agus Prasetyo
 * email : agusprasetyo811@gmail.com
 ***********************************************************************/

# Build modules definition
function mod($modules) {
	return $modules;
}

# Build all modules from definition
function build_modules($modules) {
	if (is_array($modules)) {
		return implode(', ', $modules);
	} else {
		return $modules;
	}
}

