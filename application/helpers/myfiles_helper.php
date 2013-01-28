<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/***********************************************************************
 * By Agus Prasetyo
 * email : agusprasetyo811@gmail.com
 ***********************************************************************/

// Fungsi untuk menuliskan file
function write_to_file($file_txt,$data){
	$data_txt = $file_txt;
	if(!file_exists($data_txt)){
		$open = fopen($data_txt, "w");
		fputs($open,' ');
		fclose($open);
	}else{
		$open = fopen($data_txt, "w");
		fwrite($open,$data);
		fclose($open);
	}
}

// Fungsi untuk membaca file
function reading_file($file_txt){
	$data_txt = $file_txt;
	$fh = fopen($data_txt, "r");
	$file = file_get_contents($data_txt);
	return $file;
}

// Fungsi untuk mendapatkan content dengan curl
function get_content_curl($url) {
	session_start();
	$ch = curl_init($url);
	curl_setopt($ch, CURLOPT_COOKIESESSION, true);
	curl_setopt($ch, CURLOPT_COOKIEFILE, $strCookie);
	curl_setopt($ch, CURLOPT_COOKIEJAR, $strCookie);
	curl_setopt($ch, CURLOPT_COOKIE, session_name()."=".session_id().";");
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_AUTOREFERER, true);
	$data = curl_exec($ch);
	curl_close($ch);
	return $data;
}