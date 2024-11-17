<?php

include "config.php";
global $con;

$year = date('Y');

$query = mysqli_query($con, "SELECT a.username, b.nama_departemen, c.nama_jabatan FROM tb_karyawan a, tb_departemen b, tb_jabatan c WHERE a.id_departemen = b.id_departemen AND a.id_jabatan = c.id_jabatan AND id_karyawan = '" . mysqli_escape_string($con, $_POST['nama_lengkap']) . "'");
$data = mysqli_fetch_array($query);

echo json_encode($data);
