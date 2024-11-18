<?php

// Copyright (c) 2017 http://aasaepul.com/
// Written by Saepul Anwar (aasaepul7@gmail.com);

include "config.php";
global $con;

if (mysqli_connect_error()) {
	echo 'gagal melakukan koneksi ke database ;
    ' . mysqli_connect_error();
}

$username = $_GET['username'];

$sql = "SELECT * FROM tb_login WHERE username = '$username'";

$process = mysqli_query($con, $sql);
$num = mysqli_num_rows($process);

if ($num == 0) {

	echo "";
} else {

	echo '<div class="alert alert-danger" style="margin-top: 5px;margin-bottom: 0;">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <i class="icon fa fa-ban"></i> Maaf Username tidak tersedia
          	</div>';
}

