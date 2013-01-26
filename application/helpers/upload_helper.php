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
							// Melakukan pengkondisian
							if ($files['error'] > 0) {
								return -1;
							} else {
								@$pic_name = $files['name'];
								@$pic_type = $files['type'];
								@$pic_size = $files['size'] . " kb";
								@$pic_temp_name = $files['tmp_name'];
							}

							// Jika file tidak sesuai dengan format dan ukuranya terlalu besar
							if(!in_array((@$pic_type),$format_gambar)) {
								echo -2;
								exit;
							} else if(($pic_size =!0) && ($pic_size > 30000)) {
								echo -3;
								exit;
							}

							// Membuat direktory folder dan menggenerate file name location
							$oldmask = umask(0);
							@mkdir($path, 0777);
							umask($oldmask);
							$picture = $path.'/'.$pic_name;
							copy($pic_temp_name, $picture);
							unlink($pic_temp_name);

							// Mengembalikan nilai picture yaitu berupa nama gambar yang diupload
							return $pic_name;
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
							umask($oldmask);
								
							for($i = 0; $i<count($files['name']); $i++) {
								// Melakukan pengkondisian
								if ($files['error'][$i] > 0) {
									return -1;
								} else {
									@$pic_name = $files['name'][$i];
									@$pic_type = $files['type'][$i];
									@$pic_size = $files['size'][$i] . " kb";
									@$pic_temp_name = $files['tmp_name'][$i];
								}

								// Jika file tidak sesuai dengan format dan ukuranya terlalu besar
								if(!in_array((@$pic_type),$format_gambar)) {
									echo -2;
									exit;
								} else if(($pic_size =!0) && ($pic_size > 30000)) {
									echo -3;
									exit;
								}

								// Menggenerate file name location
								$picture = $path.'/'.$pic_name;
								copy($pic_temp_name, $picture);
								unlink($pic_temp_name);
								$pic_names[] = $pic_name;
							}
							return $pic_names;
}
