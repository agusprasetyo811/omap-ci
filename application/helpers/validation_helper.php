<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/***********************************************************************
 * By Agus Prasetyo
 * email : agusprasetyo811@gmail.com
 ***********************************************************************/ 

function val_email($email){
	return @eregi( "^[0-9a-z]([-_.]?[0-9a-z])*@[0-9a-z]([-.]?[0-9a-z])*\\.[a-z]{2,3}$", $email );
}

function val_no($key){
	return @eregi( "^[0-9]+$", $key);
}

function val_phone($key){
	return @eregi( "^\+[0-9]{2}[0-9]{10,13}+$", $key);
}

function val_word($key){
	return @eregi( "^[0-9a-z]([-/]?[0-9a-z])+$", $key);
}

function val_comment($key){
	return @eregi( "^[A-Za-z0-9-\_\.\,\:\/\'\ ]+$", $key);
}

function val_quote($key){
	return @eregi( "^[A-Za-z0-9_\.\,\-\:\/\']+$", $key);
}

function var_userlog($key){
	return @eregi( "^[A-Za-z0-9]+$", $key);
}

function limit_validation($key,$start_limit, $end_limit){
	return @eregi( "^.{".$start_limit.",".$end_limit."}$", $key);
}

function replace($karakter, $string) {
	return str_replace($karakter,'\/'.$string,$string);
}