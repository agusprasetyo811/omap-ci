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

// Fungsi Untuk menghapus File
function delete_file($file) {
	return unlink($file);
}

// Fungsi Untuk menghapus File
function delete_dir($dir) {
	if (!file_exists($dir)) return true;
	if (!is_dir($dir)) return unlink($dir);
	foreach (scandir($dir) as $item) {
		if ($item == '.' || $item == '..') continue;
		if (!delete_dir($dir.DIRECTORY_SEPARATOR.$item)) return false;
	}
	return rmdir($dir);
}

// Fungsi Untuk membaca direktori
function read_dir($system_dir) {
	$file_type = 'file';
	if (is_dir($system_dir)) {
		if ($dir = opendir($system_dir)) {
			while (($file = readdir($dir)) !== false) {
				if ($file != "." && $file != "..") {
					$dir_name[]['file'] = $file;
				}
			}
			$data['data'] = @$dir_name;
			return json_encode($data);
			closedir($dir);
		}
	}
}

// Fungsi untuk mendapatkan content dengan curl
function get_content_curl($url) {
	$ch = curl_init($url);
	curl_setopt($ch, CURLOPT_COOKIEJAR, "cookies.txt");
	curl_setopt($ch, CURLOPT_COOKIEFILE, "cookies.txt");
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_REFERER, "");
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	$result = curl_exec($ch);
	curl_close($ch);
	return $result;
}