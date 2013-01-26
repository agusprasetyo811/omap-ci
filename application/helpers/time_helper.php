<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/***********************************************************************
 * By Agus Prasetyo
 * email : agusprasetyo811@gmail.com
 ***********************************************************************/

function get_jam() {
	// Bikin Format jam
	for ($i = 0; $i<=24;$i++){
		$set_jam = ($i<10) ? '0'.$i : $i;
		$jam[] = $set_jam.':00';
	}
	return array_combine($jam,$jam);
}

function time_sum($time1, $time2) {
	$times = array($time1, $time2);
	$seconds = 0;
	foreach ($times as $time)
	{
		list($hour,$minute,$second) = explode(':', $time);
		$seconds += $hour*3600;
		$seconds += $minute*60;
		$seconds += $second;
	}
	$hours = floor($seconds/3600);
	$seconds -= $hours*3600;
	$minutes  = floor($seconds/60);
	$seconds -= $minutes*60;
	// return "{$hours}:{$minutes}:{$seconds}";
	return sprintf('%02d:%02d:%02d', $hours, $minutes, $seconds);
}

function date_deadline($tgl_now, $deadline = 3, $deadline_bulan = 0, $deadline_tahun = 0) {

	$tanggal = date('j', strtotime($tgl_now));
	$hari = date('w',strtotime($tgl_now));
	$bulan = date('n',strtotime($tgl_now)) - 1;
	$tahun = date('Y',strtotime($tgl_now));
	$j_hari = date('t',strtotime($tgl_now));

	$nama_hari  = array("Minggu","Senin","Selasa","Rabu","Kamis","Jumat","Sabtu");
	$nama_bulan = array("Januari","Februari","Maret","April","Mey","Juni","Juli","Agustus","September","Oktober","November","Desember");

	//menentukan penambahan tanggal bulan dan tahun
	$tambah_tanggal = $deadline;
	$tambah_bulan   = $deadline_bulan;
	$tambah_tahun   = $deadline_tahun;

	$hari_ini  = $nama_hari[$hari];
	$bulan_ini = $nama_bulan[$bulan];

	@$hari_nanti = $nama_hari[$hari+$tambah_tanggal];
	if($hari_nanti == null && @hari_ini == "Jumat") {
		$hari_nanti == "Rabu";
	} else {
		if($hari_nanti == null && @hari_ini == "Sabtu") {
			$hari_nanti == "Kamis";
		}
	}

	$tanggal_nanti = $tanggal + $tambah_tanggal;
	if ($j_hari == 31) {
		if ($tanggal_nanti > 31) {
			$tanggal_nanti = $tanggal_nanti - 31;
			$tambah_bulan = 1;
		}
	} elseif ($j_hari == 30) {
		$tanggal_nanti = $tanggal_nanti - 30;
		$tambah_bulan = 1;
	} elseif($j_hari == 28) {
		$tanggal_nanti = $tanggal_nanti - 28;
		$tambah_bulan = 1;
	} else {
		if($j_hari == 29) {
			$tanggal_nanti = $tanggal_nanti -29;
			$tambah_bulan = 1;
		}
	}

	$bulan_nanti = $nama_bulan[$bulan + $tambah_bulan];
	$bulan_nanti_angka = $bulan + $tambah_bulan + 1;
	if($bulan_nanti == null) {
		$bulan_nanti ="Januari";
		$tambah_tahun = 1;
	}
	
	$tahun_nanti = $tahun + $tambah_tahun;
	
	$tgl  = (strlen($tanggal_nanti) == 1 ) ? '0'.$tanggal_nanti : $tanggal_nanti;
	$bln  = (strlen($bulan_nanti_angka) == 1 ) ? '0'.$bulan_nanti_angka : $bulan_nanti_angka; 
	
	return  $hari_deadline = $tahun_nanti.'-'.$bln.'-'.$tgl;
	exit();
}