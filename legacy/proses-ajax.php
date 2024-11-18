<?php

// Deklarasi variable untuk koneksi ke database.
include "config.php";
global $con;

$year = date('Y');

$query = mysqli_query($con, "SELECT a.nama_lengkap, a.nama_jabatan, a.nama_departemen, (a.cuti - b.diambil) AS sisa_cuti, b.diambil FROM (

SELECT DISTINCT a.nama_lengkap, b.nama_jabatan, c.nama_departemen, IFNULL(f.hak_cuti,0) AS cuti FROM 
tb_karyawan a 
LEFT JOIN tb_jabatan b ON a.id_jabatan = b.id_jabatan
LEFT JOIN tb_departemen c ON a.id_departemen = c.id_departemen 
LEFT JOIN tb_absensi_detail e ON a.`username` = e.`nama`
LEFT JOIN tb_keterangan d ON d.`id_keterangan` = e.`id_keterangan`  
LEFT JOIN tb_absensi f ON a.`id_karyawan` = f.`id_karyawan` 
WHERE a.nama_lengkap = '" . mysqli_escape_string($con, $_POST['nama_lengkap']) . "' AND YEAR(e.`tanggal`) = '" . $year . "' AND f.tahun = '" . $year . "'
) AS a LEFT OUTER JOIN (
SELECT  COUNT(e.id_keterangan) AS diambil  FROM 
tb_karyawan a 
LEFT JOIN tb_jabatan b ON a.id_jabatan = b.id_jabatan
LEFT JOIN tb_departemen c ON a.id_departemen = c.id_departemen 
LEFT JOIN tb_absensi_detail e ON a.`username` = e.`nama`
LEFT JOIN tb_keterangan d ON d.`id_keterangan` = e.`id_keterangan`  
LEFT JOIN tb_absensi f ON a.`id_karyawan` = f.`id_karyawan` 
WHERE a.nama_lengkap = '" . mysqli_escape_string($con, $_POST['nama_lengkap']) . "' AND d.`keterangan` = 'CUTI' AND YEAR(e.`tanggal`) = '" . $year . "' AND f.tahun = '" . $year . "'

) AS b ON 1=1");
$data = mysqli_fetch_array($query);

echo json_encode($data);

