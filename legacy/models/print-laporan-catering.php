<?php

include "../config.php";
require "../mc_table.php";
require "../fungsi.php";

$bulan  = $_GET['bulan'];
$tahun  = $_GET['tahun'];

$tgl_skr = date('Y-m-d');

$tgl_sekarang = explode("-", $tgl_skr);
$tgl_hari     = $tgl_sekarang[2];
$tgl_bulan    = $tgl_sekarang[1];
$tgl_tahun    = $tgl_sekarang[0];

if ($tgl_bulan == '1') {
	$bln = 'Januari';
} else if ($tgl_bulan == '2') {
	$bln = 'Februari';
} else if ($tgl_bulan == '3') {
	$bln = 'Maret';
} else if ($tgl_bulan == '4') {
	$bln = 'April';
} else if ($tgl_bulan == '5') {
	$bln = 'Mei';
} else if ($tgl_bulan == '6') {
	$bln = 'Juni';
} else if ($tgl_bulan == '7') {
	$bln = 'Juli';
} else if ($tgl_bulan == '8') {
	$bln = 'Agustus';
} else if ($tgl_bulan == '9') {
	$bln = 'September';
} else if ($tgl_bulan == '10') {
	$bln = 'Oktober';
} else if ($tgl_bulan == '11') {
	$bln = 'November';
} else if ($tgl_bulan == '12') {
	$bln = 'Desember';
}

$fltr   = "";
$paramm = "";

if (!empty($_GET['nama'])) {
	$nama   = $_GET['nama'];
	$fltr .= "AND a.nama = '" . $nama . "'";
}

$tgl_awal   = explode("-", $bulan);
$new_awal   = $tgl_awal[2] . "." . $tgl_awal[1] . "." . $tgl_awal[0];

$tgl_akhir  = explode("-", $tahun);
$new_akhir  = $tgl_akhir[2] . "." . $tgl_akhir[1] . "." . $tgl_akhir[0];

$query_cat  = mysqli_query($con, "SELECT jml_denda FROM tb_denda WHERE nama_denda = 'CATERING'");
$cat        = mysqli_fetch_array($query_cat);

$query = mysqli_query($con, "SELECT nama_lengkap, username, jml FROM( SELECT DISTINCT c.`nama_lengkap`, c.`username`, COUNT(a.id_keterangan) AS jml FROM tb_absensi_detail a, tb_keterangan b, tb_karyawan c WHERE
a.id_keterangan = b.id_keterangan AND a.nama = c.username AND c.status = '1' AND b.`keterangan` NOT IN ('LUAR KOTA','CUTI','SAKIT') AND a.tanggal BETWEEN '" . $bulan . "' AND '" . $tahun . "' $fltr GROUP BY c.`nama_lengkap`) as v ORDER BY username ASC ");

$total = mysqli_num_rows($query);

$pdf = new PDF_MC_Table('P', 'mm', array(210, 297));
$pdf->AliasNbPages();
//$pdf->SetAutoPageBreak(true); 
$pdf->AddPage();

//Fields Name position
$Y_Fields_Name_position = 10;

$pdf->SetFont('Times', 'B', 10);
$pdf->SetY($Y_Fields_Name_position);
$pdf->Cell(130);
$pdf->Cell(10, 7, 'Daftar Uang Catering');

$Y_Fields_Name_position = 15;
$pdf->SetFont('Times', 'B', 10);
$pdf->SetY($Y_Fields_Name_position);
$pdf->Cell(132);
$pdf->Cell(10, 7, 'NAMA PERUSAHAAN ANDA');

$Y_Fields_Name_position = 20;
$pdf->SetFont('Times', '', 8);
$pdf->SetY($Y_Fields_Name_position);
$pdf->Cell(132);
$pdf->Cell(10, 7, 'Alamat Lengkap Perusahaan Anda, Jakarta');

//Fields Name position
$Y_Fields_Name_position = 24;

$pdf->SetFont('Times', 'B', 8);
$pdf->SetY($Y_Fields_Name_position);
$pdf->Cell(10, 7, 'Tanggal :' . $new_awal . ' s/d ' . $new_akhir);
$pdf->SetX(70);
$pdf->Cell(10, 7, 'Total :' . $total);

$Y_Fields_Name_position = 30;

$pdf->SetFillColor(255, 255, 255);
//Bold Font for Field Name
$pdf->SetFont('Times', 'B', 10);
$pdf->SetY($Y_Fields_Name_position);
$pdf->SetX(10);
$pdf->Cell(10, 6, 'No', 1, 0, 'C', 1);
$pdf->SetX(20);
$pdf->Cell(60, 6, 'Nama Karyawan', 1, 0, 'L', 1);
$pdf->SetX(80);
$pdf->Cell(40, 6, 'Jumlah Absen', 1, 0, 'C', 1);
$pdf->SetX(120);
$pdf->Cell(80, 6, 'Total Bayar', 1, 0, 'C', 1);
$pdf->Ln();

$pdf->SetFillColor(255, 255, 255);
//Bold Font for Field Name
$pdf->SetFont('Times', '', 10);

$pdf->SetWidths(array(10, 60, 40, 80));
$pdf->SetAligns(array('C', 'L', 'C', 'C'));

$no = 1;
$tot = 0;
while ($d = mysqli_fetch_array($query)) {

	$tot_bayar = $d['jml'] * $cat['jml_denda'];

	$pdf->SetX(10);
	$pdf->Row(array('' . $no . '', '' . $d['nama_lengkap'] . '', '' . $d['jml'] . '', 'Rp. ' . rupiah($d['jml'] * $cat['jml_denda']) . ''));
	$no++;

	$tot += $tot_bayar;
}

$pdf->SetFont('Times', 'B', 10);

$total = $tot;
$pdf->SetWidths(array(110, 80));
$pdf->SetAligns(array('C', 'C'));
$pdf->SetX(10);
$pdf->Row(array('Total', 'Rp. ' . rupiah($total) . ''));

$pdf->Ln(10);

$pdf->Cell(25);
$pdf->Cell(10, 7, 'Jakarta, ' . $tgl_hari . ' ' . $bln . ' ' . $tgl_tahun);

$pdf->Ln(10);

//$pdf->Line(35, 140, 70, 140);
//$pdf->Line(135, 140, 170, 140);

$pdf->Cell(33);
$pdf->Cell(10, 7, 'Mengetahui');

$pdf->Cell(92);
$pdf->Cell(10, 7, 'Disetujui');

$pdf->Ln(24);
$pdf->Cell(32);
$pdf->Cell(10, 7, 'Aulya Sukma');

$pdf->Cell(89);
$pdf->Cell(10, 7, 'Renny A.Sandi');

$pdf->Ln(15);

$pdf->SetFont('Times', 'I', 10);
$pdf->Cell(5);
$pdf->Cell(10, 7, '*) Rekap Absensi Terlampir Pada Lembar Terpisah');

$pdf->Output();

