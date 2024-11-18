<?php

include "config.php";
global $con;
require "mc_table.php";

$id   = $_GET['id'];
$year = date('Y');

$query = mysqli_query($con, "SELECT * FROM tb_cuti WHERE id_cuti = '$id'");
$data  = mysqli_fetch_array($query);

$detail = mysqli_query($con, "SELECT a.nama_lengkap, a.username, a.nama_jabatan, a.nama_departemen, a.cuti, (a.cuti - b.diambil) AS sisa_cuti, b.diambil FROM (

SELECT DISTINCT a.nama_lengkap, a.username, b.nama_jabatan, c.nama_departemen, IFNULL(f.hak_cuti,0) AS cuti FROM 
tb_karyawan a 
LEFT JOIN tb_jabatan b ON a.id_jabatan = b.id_jabatan
LEFT JOIN tb_departemen c ON a.id_departemen = c.id_departemen 
LEFT JOIN tb_absensi_detail e ON a.`username` = e.`nama`
LEFT JOIN tb_keterangan d ON d.`id_keterangan` = e.`id_keterangan`  
LEFT JOIN tb_absensi f ON a.`id_karyawan` = f.`id_karyawan` 
WHERE a.nama_lengkap = '" . $data['nama_lengkap'] . "' AND YEAR(e.`tanggal`) = '" . $year . "' AND f.tahun = '" . $year . "'
) AS a LEFT OUTER JOIN (
SELECT  COUNT(e.id_keterangan) AS diambil  FROM 
tb_karyawan a 
LEFT JOIN tb_jabatan b ON a.id_jabatan = b.id_jabatan
LEFT JOIN tb_departemen c ON a.id_departemen = c.id_departemen 
LEFT JOIN tb_absensi_detail e ON a.`username` = e.`nama`
LEFT JOIN tb_keterangan d ON d.`id_keterangan` = e.`id_keterangan`  
LEFT JOIN tb_absensi f ON a.`id_karyawan` = f.`id_karyawan` 
WHERE a.nama_lengkap = '" . $data['nama_lengkap'] . "' AND d.`keterangan` = 'CUTI' AND YEAR(e.`tanggal`) = '" . $year . "' AND f.tahun = '" . $year . "'

) AS b ON 1=1");

$d = mysqli_fetch_array($detail);

$total = mysqli_num_rows($query);

$tgl_awal   = explode("-", $data['tgl_dari']);
$new_awal   = $tgl_awal[2] . "." . $tgl_awal[1] . "." . $tgl_awal[0];

$tgl_akhir  = explode("-", $data['tgl_sampai']);
$new_akhir  = $tgl_akhir[2] . "." . $tgl_akhir[1] . "." . $tgl_akhir[0];

$tgl_masuk  = explode("-", $data['tgl_masuk']);
$new_masuk  = $tgl_masuk[2] . "." . $tgl_masuk[1] . "." . $tgl_masuk[0];

$pdf = new PDF_MC_Table('P', 'mm', 'A4');
$pdf->AliasNbPages();
$pdf->SetAutoPageBreak(true);
$pdf->AddPage();

//Fields Name position
$Y_Fields_Name_position = 10;

$pdf->SetFont('Times', 'B', 10);
$pdf->SetY($Y_Fields_Name_position);
$pdf->Cell(75);

$Y_Fields_Name_position = 15;
$pdf->SetFont('Times', 'B', 7);
$pdf->SetY($Y_Fields_Name_position);
$pdf->Cell(15);
$pdf->Cell(10, 7, 'NAMA PERUSAHAAN ANDA - JAKARTA');

$Y_Fields_Name_position = 25;
$pdf->SetFont('Times', 'BU', 11);
$pdf->SetY($Y_Fields_Name_position);
$pdf->Cell(65);
$pdf->Cell(10, 7, 'PERMOHONAN PENGAMBILAN CUTI');


//Fields Name position
$Y_Fields_Name_position = 35;

$pdf->SetFont('Times', '', 9);
$pdf->SetY($Y_Fields_Name_position);
$pdf->Cell(15);
$pdf->Cell(10, 7, 'Nama');
$pdf->Cell(25);
$pdf->Cell(10, 7, ': ' . $data['nama_lengkap']);

//Fields Name position
$Y_Fields_Name_position = 40;

$pdf->SetFont('Times', '', 9);
$pdf->SetY($Y_Fields_Name_position);
$pdf->Cell(15);
$pdf->Cell(10, 7, 'Bagian');
$pdf->Cell(25);
$pdf->Cell(10, 7, ': ' . $data['bagian']);

$Y_Fields_Name_position = 45;

$pdf->SetFont('Times', '', 9);
$pdf->SetY($Y_Fields_Name_position);
$pdf->Cell(15);
$pdf->Cell(10, 7, 'Jabatan');
$pdf->Cell(25);
$pdf->Cell(10, 7, ': ' . $data['jabatan']);

$Y_Fields_Name_position = 50;

$pdf->SetFont('Times', '', 9);
$pdf->SetY($Y_Fields_Name_position);
$pdf->Cell(15);
$pdf->Cell(10, 7, 'Tgl Pengambilan Cuti');
$pdf->Cell(25);
$pdf->Cell(10, 7, ': ' . $new_awal . ' s/d ' . $new_akhir);

$Y_Fields_Name_position = 55;

$pdf->SetFont('Times', '', 9);
$pdf->SetY($Y_Fields_Name_position);
$pdf->Cell(15);
$pdf->Cell(10, 7, 'Tgl Masuk Kembali');
$pdf->Cell(25);
$pdf->Cell(10, 7, ': ' . $new_masuk);

$Y_Fields_Name_position = 60;

$pdf->SetFont('Times', '', 9);
$pdf->SetY($Y_Fields_Name_position);
$pdf->Cell(15);
$pdf->Cell(10, 7, 'Keperluan Cuti');
$pdf->Cell(25);
$pdf->Cell(10, 7, ': ' . $data['keperluan_cuti']);

$Y_Fields_Name_position = 75;

$pdf->SetFont('Times', '', 9);
$pdf->SetY($Y_Fields_Name_position);
$pdf->Cell(15);
$pdf->Cell(10, 7, 'Hak Cuti Tahun ' . date('Y'));
$pdf->Cell(25);
$pdf->Cell(10, 7, ': ' . $d['cuti']);

$Y_Fields_Name_position = 80;

$pdf->SetFont('Times', '', 9);
$pdf->SetY($Y_Fields_Name_position);
$pdf->Cell(15);
$pdf->Cell(10, 7, 'Cuti yang sudah diambil');
$pdf->Cell(25);
$pdf->Cell(10, 7, ': ' . $d['diambil'] . ' Hari');

$Y_Fields_Name_position = 85;

$pdf->SetFont('Times', '', 9);
$pdf->SetY($Y_Fields_Name_position);
$pdf->Cell(15);
$pdf->Cell(10, 7, 'Cuti yang akan diambil');
$pdf->Cell(25);
$pdf->Cell(10, 7, ': ' . $data['jml'] . ' Hari');

$Y_Fields_Name_position = 90;

$pdf->SetFont('Times', '', 9);
$pdf->SetY($Y_Fields_Name_position);
$pdf->Cell(15);
$pdf->Cell(10, 7, 'Sisa Cuti');
$pdf->Cell(25);
$pdf->Cell(10, 7, ': ' . ($d['sisa_cuti'] - $data['jml']) . ' Hari');

$Y_Fields_Name_position = 100;

$pdf->SetFont('Times', '', 9);
$pdf->SetY($Y_Fields_Name_position);
$pdf->Cell(15);
$pdf->Cell(10, 7, 'Jakarta, ' . date('d F Y'));

$Y_Fields_Name_position = 110;

$pdf->SetFont('Times', 'B', 9);
$pdf->SetY($Y_Fields_Name_position);
$pdf->Cell(25);
$pdf->Cell(10, 7, 'Pemohon');

$Y_Fields_Name_position = 110;

$pdf->SetFont('Times', 'B', 9);
$pdf->SetY($Y_Fields_Name_position);
$pdf->Cell(82);
$pdf->Cell(10, 7, 'Menyetujui');

$Y_Fields_Name_position = 110;

$pdf->SetFont('Times', 'B', 9);
$pdf->SetY($Y_Fields_Name_position);
$pdf->Cell(140);
$pdf->Cell(10, 7, 'Mengetahui');

$pdf->Line(25, 140, 60, 140);
$pdf->Line(120, 140, 80, 140);
$pdf->Line(180, 140, 140, 140);


$Y_Fields_Name_position = 139;

$pdf->SetFont('Times', 'B', 9);
$pdf->SetY($Y_Fields_Name_position);

$pdf->Cell(25);
$pdf->MultiCell(30, 7, $d['username']);

$Y_Fields_Name_position = 139;

$pdf->SetFont('Times', 'B', 9);
$pdf->SetY($Y_Fields_Name_position);
$pdf->Cell(83);
$pdf->Cell(10, 7, 'Manager');
$pdf->Cell(43);
$pdf->Cell(10, 7, 'General Manager');


$pdf->Output();

