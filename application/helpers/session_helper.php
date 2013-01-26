<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/***********************************************************************
 * By Agus Prasetyo
 * email : agusprasetyo811@gmail.com
 ***********************************************************************/ 

function get_access_login($session_name) {
    $CI =& get_instance();
    $user = $CI->session->userdata($session_name);
    if (!isset($user)) { 
    	return false; 
    } else { 
    	return true; 
    }
}