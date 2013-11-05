<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/***********************************************************************
 * By Agus Prasetyo
 * email : agusprasetyo811@gmail.com
 ***********************************************************************/

# Build Javascript script tag
function js($link) {
	//$search = array('/\>[^\S ]+/s', '/[^\S ]+\</s','/(\s)+/s');
	//$replace = array('>','<','\\1');
	//$temp_body_data = preg_replace($search, $replace, $temp_field);
	return '<script src="'.$link.'"></script>';
}

# Build Style script tag
function style($link) {
	return '<link href="'.$link.'" rel="stylesheet" type="text/css" />';
}

# Build meta
function meta($name, $content) {
	return '<meta name="'.$name.'" content="'.$content.'/>';
}

# Build Javascript Link
function build_script($link) {
	if (is_array($link)) {
		return implode('', $link);
	} else {
		return $link;
	}
}

# Build Stylesheet Link
function build_style($link) {
	if (is_array($link)) {
		return implode('', $link);
	} else {
		return $link;
	}
}

# Build All Reference Link Head
function build_head($link) {
	if (is_array($link)) {
		return implode('', $link);
	} else {
		return $link;
	}
}