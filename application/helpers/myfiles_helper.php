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