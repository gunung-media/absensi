<?php

// Copyright (c) 2017 http://aasaepul.com/
// Written by Saepul Anwar (aasaepul7@gmail.com);

include "config.php";
global $con;

if (mysqli_connect_error()) {
	echo 'gagal melakukan koneksi ke database ;
    ' . mysqli_connect_error();
}

$tanggal = $_GET['tanggal'];

$tmp_tgl = explode("/", $tanggal);
$new_tgl = $tmp_tgl[2] . '-' . $tmp_tgl[1] . '-' . $tmp_tgl[0];

$sql = "SELECT DISTINCT tanggal FROM tb_absensi_detail WHERE tanggal = '$new_tgl'";

$process = mysqli_query($con, $sql);
$num = mysqli_num_rows($process);

if ($num == 0) {

	echo "";
} else {

	echo '<div class="alert alert-warning" style="margin-top: 5px;margin-bottom: 0;">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <i class="icon fa fa-ban"></i> Tanggal ini sudah ada, Apakah Anda ingin mengganti nya ?
          	</div>';
}

