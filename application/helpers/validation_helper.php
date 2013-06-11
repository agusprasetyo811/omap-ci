<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/***********************************************************************
 * By Agus Prasetyo
 * email : agusprasetyo811@gmail.com
 ***********************************************************************/ 

function email_match($email){
	return @eregi( "^[0-9a-z]([-_.]?[0-9a-z])*@[0-9a-z]([-.]?[0-9a-z])*\\.[a-z]{2,3}$", $email );
}

function number_match($key){
	return @!eregi( "^[0-9]+$", $key);
}

function phone_match($key){
	return @!eregi( "^\+[0-9]{2}[0-9]{10,13}+$", $key);
}

function word_match($key){
	return @eregi( "^[0-9a-z]([-/]?[0-9a-z])+$", $key);
}