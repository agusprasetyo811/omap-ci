<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/***********************************************************************
 * By Agus Prasetyo
* email : agusprasetyo811@gmail.com
***********************************************************************/

function do_upload($files,$path) {
	// Format gambar yang diupload keserver dalam bentuk array
	$format_gambar = array(	'image/jpg',
			'image/jpeg',
			'image/pjpeg',
			'image/png',
			'image/x-png',
			'image/gif'
	);
	
	@$pic_name = $files['name'];
	@$pic_type = $files['type'];
	@$pic_size = $files['size'] . " kb";
	@$pic_temp_name = $files['tmp_name'];
	
	// Melakukan pengkondisian
	if ($files['error'] > 0) {
		return 'err_file';
	} else if(!in_array((@$pic_type),$format_gambar)) {
		return 'err_format';
	} else if(($pic_size =!0) && ($pic_size > 8000000)) {
		return 'err_size';
	} else {
		// Membuat direktory folder dan menggenerate file name location
		$oldmask = umask(0);
		@mkdir($path, 0777);
		@umask($oldmask);
		$picture = $path.'/'.str_replace(' ', '__', $pic_name);
		@img_resize($pic_temp_name , 800 , $path , str_replace(' ', '__', $pic_name));
		@img_resize($pic_temp_name , 500 , $path , 'med_'.str_replace(' ', '__', $pic_name));
		@img_resize($pic_temp_name , 200 , $path , 'small_'.str_replace(' ', '__', $pic_name));
		//unlink($pic_temp_name);
		
		// Mengembalikan nilai picture yaitu berupa nama gambar yang diupload
		return str_replace(' ', '__', $pic_name);
	}
}

function multi_do_upload($files,$path) {
	// Format gambar yang diupload keserver dalam bentuk array
	$format_gambar = array(	'image/jpg',
			'image/jpeg',
			'image/pjpeg',
			'image/png',
			'image/x-png',
			'image/gif'
	);

	// Membuat direktory folder
	$oldmask = umask(0);
	@mkdir($path, 0777);
	@umask($oldmask);

	for($i = 0; $i < count($files['name']); $i++) {
		@$pic_name = $files['name'][$i];
		@$pic_type = $files['type'][$i];
		@$pic_size = $files['size'][$i] . " kb";
		@$pic_temp_name = $files['tmp_name'][$i];
		
		// Melakukan pengkondisian
		if ($files['error'][$i] > 0) {
			return 'err_file';
			break;
		} else if(!in_array((@$pic_type),$format_gambar)) {
			return 'err_format';
			break;
		} else if(($pic_size =! 0) && ($pic_size > 8000000)) {
			return 'err_size';
			break;
		} else {				
			// Menggenerate file name location
			$picture = $path.'/'. str_replace(' ', '__', $pic_name);
			@img_resize($pic_temp_name , 800 , $path , str_replace(' ', '__', $pic_name));
			@img_resize($pic_temp_name , 500 , $path , 'med_'.str_replace(' ', '__', $pic_name));
			@img_resize($pic_temp_name , 200 , $path , 'small_'.str_replace(' ', '__', $pic_name));
			/* copy($pic_temp_name, $picture); */
			@unlink($pic_temp_name);
			$pic_names[] = str_replace(' ', '__', $pic_name);
		}
	}
	return $pic_names;
		
}

/**
 * Make thumbs from JPEG, PNG, GIF source file
 *
 * $tmpname = $_FILES['source']['tmp_name'];
 * $size - max width size
 * $save_dir - destination folder
 * $save_name - tnumb new name
 *
 * Author:  LEDok - http://www.citadelavto.ru/
 */

/**
 * Example :
 *
 * $tmpname  = $_FILES['pic']['tmp_name'];
 * @img_resize( $tmpname , 600 , "../album" , "album_".$id.".jpg");
 * @img_resize( $tmpname , 120 , "../album" , "album_".$id."_small.jpg");
 * @img_resize( $tmpname , 60 , "../album" , "album_".$id."verysmall.jpg");
 *
 */
function img_resize($tmpname, $size, $save_dir, $save_name) {
	$save_dir .= ( substr($save_dir,-1) != "/") ? "/" : "";
	$gis = GetImageSize($tmpname);
	$type = $gis[2];
	switch($type)
	{
		case "1": $imorig = imagecreatefromgif($tmpname); break;
		case "2": $imorig = imagecreatefromjpeg($tmpname);break;
		case "3": $imorig = imagecreatefrompng($tmpname); break;
		default:  $imorig = imagecreatefromjpeg($tmpname);
	}

	$x = imageSX($imorig);
	$y = imageSY($imorig);
	if($gis[0] <= $size) {
		$av = $x;
		$ah = $y;
	} else {
		$yc = $y*1.3333333;
		$d = $x>$yc?$x:$yc;
		$c = $d>$size ? $size/$d : $size;
		$av = $x*$c;
		$ah = $y*$c;
	}
	$im = imagecreate($av, $ah);
	$im = imagecreatetruecolor($av,$ah);
	if (imagecopyresampled($im,$imorig , 0,0,0,0,$av,$ah,$x,$y))
		if (imagejpeg($im, $save_dir.$save_name))
		return true;
	else
		return false;
}
