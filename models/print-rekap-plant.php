<?php

include "../config.php";

require "../mc_table.php";
require "../fungsi.php";

$tahun          = $_GET['thn'];

$fltr   = "";

if (!empty($_GET['nama']) && empty($_GET['jabatan']) && empty($_GET['departemen'])) {
        $fltr .= "AND b.nama_lengkap = '" . $_GET['nama'] . "'";
} else if (!empty($_GET['nama']) && !empty($_GET['jabatan']) && empty($_GET['departemen'])) {
        $fltr .= "AND b.nama_lengkap = '" . $_GET['nama'] . "' AND d.nama_jabatan = '" . $_GET['jabatan'] . "'";
} else if (!empty($_GET['nama']) && !empty($_GET['jabatan']) && !empty($_GET['departemen'])) {
        $fltr .= "AND b.nama_lengkap = '" . $_GET['nama'] . "' AND d.nama_jabatan = '" . $_GET['jabatan'] . "' AND c.nama_departemen = '" . $_GET['departemen'] . "'";
} else if (empty($_GET['nama']) && !empty($_GET['jabatan']) && !empty($_GET['departemen'])) {
        $fltr .= "AND d.nama_jabatan = '" . $_GET['jabatan'] . "' AND c.nama_departemen = '" . $_GET['departemen'] . "'";
} else if (empty($_GET['nama']) && empty($_GET['jabatan']) && !empty($_GET['departemen'])) {
        $fltr .= "AND c.nama_departemen = '" . $_GET['departemen'] . "'";
} else if (empty($_GET['nama']) && !empty($_GET['jabatan']) && empty($_GET['departemen'])) {
        $fltr .= "AND d.nama_jabatan = '" . $_GET['jabatan'] . "'";
} else if (!empty($_GET['nama']) && empty($_GET['jabatan']) && !empty($_GET['departemen'])) {
        $fltr .= "AND a.nama = '" . $_GET['nama'] . "' AND c.nama_departemen = '" . $_GET['departemen'] . "'";
}

$query  = mysqli_query($con, "SELECT a.nama_lengkap, a.nama_jabatan, a.masa_kerja, a.hak_cuti, a.jan,a.feb,a.mar,a.apr,a.mei,a.jun,a.jul,a.agt,a.sep,a.okt,a.nov,a.des, (a.hak_cuti-b.total) AS tot_sisa FROM (
                SELECT a.id_karyawan,b.nama_lengkap,d.nama_jabatan,b.masa_kerja, a.hak_cuti,a.jan,a.feb,a.mar,a.apr,a.mei,.a.jun,a.jul,a.agt,a.sep,a.okt,a.nov,a.des FROM tb_absensi a
                LEFT JOIN tb_karyawan b ON a.id_karyawan = b.id_karyawan
                LEFT JOIN tb_departemen c ON b.id_departemen = c.id_departemen
                LEFT JOIN tb_jabatan d ON b.id_jabatan = d.id_jabatan
                WHERE c.nama_departemen = 'Plant' AND a.tahun = '$tahun' $fltr
                ) AS a LEFT OUTER JOIN (
                SELECT SUM(a.jan+a.feb+a.mar+a.apr+a.mei+a.jun+a.jul+a.agt+a.sep+a.okt+a.nov+a.des) AS total, b.nama_lengkap FROM tb_absensi a
                LEFT JOIN tb_karyawan b ON a.id_karyawan = b.id_karyawan
                LEFT JOIN tb_departemen c ON b.id_departemen = c.id_departemen
                LEFT JOIN tb_jabatan d ON b.id_jabatan = d.id_jabatan
                WHERE c.nama_departemen = 'Plant' AND a.tahun = '$tahun' $fltr GROUP BY b.nama_lengkap
                ) AS b ON a.nama_lengkap = b.nama_lengkap");

$total = mysqli_num_rows($query);

$pdf = new PDF_MC_Table('L', 'mm', array(210, 330));
$pdf->AliasNbPages();
//$pdf->SetAutoPageBreak(true); 
$pdf->AddPage();
$pdf->SetX(3);

//Fields Name position
$Y_Fields_Name_position = 10;

$pdf->SetFont('Times', 'B', 10);
$pdf->SetY($Y_Fields_Name_position);
$pdf->Cell(130);
$pdf->Cell(10, 7, 'Daftar Absensi Karyawan Plant / Tahun');

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
$pdf->Cell(10, 7, 'Tahun : ' . $tahun);

//Fields Name position
$Y_Fields_Name_position = 30;

$pdf->SetFillColor(255, 255, 255);
$pdf->SetFont('Times', 'B', 8);

$pdf->SetY($Y_Fields_Name_position);
$pdf->SetX(7);
$pdf->Cell(6, 10, 'No', 1, 0, 'C', 1);
$pdf->SetX(13);
$pdf->Cell(50, 10, 'Nama Lengkap', 1, 0, '', 1);
$pdf->SetX(63);
$pdf->Cell(20, 10, 'Jabatan', 1, 0, 'C', 1);
$pdf->SetX(83);
$pdf->Cell(20, 10, 'Masa Kerja', 1, 0, 'C', 1);
$pdf->SetX(103);
$pdf->Cell(15, 10, 'Saldo Cuti', 1, 0, 'C', 1);

$pdf->SetX(118);
$pdf->Cell(195, 5, 'Cuti', 1, 0, 'C', 1);

$pdf->Ln(5);

$kolom_2 = 0;
$pdf->SetX(118 + $kolom_2);
$pdf->Cell(15, 5, 'Jan', 1, 0, 'C', 1);
$kolom_2 += 15;
$pdf->SetX(118 + $kolom_2);
$pdf->Cell(15, 5, 'Feb', 1, 0, 'C', 1);
$kolom_2 += 15;
$pdf->SetX(118 + $kolom_2);
$pdf->Cell(15, 5, 'Mar', 1, 0, 'C', 1);
$kolom_2 += 15;
$pdf->SetX(118 + $kolom_2);
$pdf->Cell(15, 5, 'Apr', 1, 0, 'C', 1);
$kolom_2 += 15;
$pdf->SetX(118 + $kolom_2);
$pdf->Cell(15, 5, 'Mei', 1, 0, 'C', 1);
$kolom_2 += 15;
$pdf->SetX(118 + $kolom_2);
$pdf->Cell(15, 5, 'Jun', 1, 0, 'C', 1);
$kolom_2 += 15;
$pdf->SetX(118 + $kolom_2);
$pdf->Cell(15, 5, 'Jul', 1, 0, 'C', 1);
$kolom_2 += 15;
$pdf->SetX(118 + $kolom_2);
$pdf->Cell(15, 5, 'Agu', 1, 0, 'C', 1);
$kolom_2 += 15;
$pdf->SetX(118 + $kolom_2);
$pdf->Cell(15, 5, 'Sep', 1, 0, 'C', 1);
$kolom_2 += 15;
$pdf->SetX(118 + $kolom_2);
$pdf->Cell(15, 5, 'Okt', 1, 0, 'C', 1);
$kolom_2 += 15;
$pdf->SetX(118 + $kolom_2);
$pdf->Cell(15, 5, 'Nov', 1, 0, 'C', 1);
$kolom_2 += 15;
$pdf->SetX(118 + $kolom_2);
$pdf->Cell(15, 5, 'Des', 1, 0, 'C', 1);
$kolom_2 += 15;
$pdf->SetX(118 + $kolom_2);
$pdf->Cell(15, 5, 'Sisa', 1, 0, 'C', 1);

//Fields Name position
$Y_Fields_Name_position = 35;

$pdf->SetFillColor(255, 255, 255);
$pdf->SetFont('Times', '', 8);
$pdf->SetY($Y_Fields_Name_position);

$no     = 1;
$row    = 0;

while ($data = mysqli_fetch_array($query)) {

        $pdf->Ln(5 + $row);

        $tmp_maja = explode("-", $data['masa_kerja']);
        $masa_kerja = $tmp_maja[2] . '/' . $tmp_maja[1] . '/' . $tmp_maja[0];

        $pdf->SetX(7);
        $pdf->Cell(6, 5, '' . $no . '', 1, 0, 'C', 1);
        $pdf->SetX(13);
        $pdf->Cell(50, 5, '' . $data['nama_lengkap'] . '', 1, 0, '', 1);
        $pdf->SetX(63);
        $pdf->Cell(20, 5, '' . $data['nama_jabatan'] . '', 1, 0, 'C', 1);
        $pdf->SetX(83);
        $pdf->Cell(20, 5, '' . $masa_kerja . '', 1, 0, 'C', 1);
        $pdf->SetX(103);
        $pdf->Cell(15, 5, '' . $data['hak_cuti'] . '', 1, 0, 'C', 1);

        $kolom_2 = 0;
        $pdf->SetX(118 + $kolom_2);
        $pdf->Cell(15, 5, '' . $data['jan'] . '', 1, 0, 'C', 1);
        $kolom_2 += 15;
        $pdf->SetX(118 + $kolom_2);
        $pdf->Cell(15, 5, '' . $data['feb'] . '', 1, 0, 'C', 1);
        $kolom_2 += 15;
        $pdf->SetX(118 + $kolom_2);
        $pdf->Cell(15, 5, '' . $data['mar'] . '', 1, 0, 'C', 1);
        $kolom_2 += 15;
        $pdf->SetX(118 + $kolom_2);
        $pdf->Cell(15, 5, '' . $data['apr'] . '', 1, 0, 'C', 1);
        $kolom_2 += 15;
        $pdf->SetX(118 + $kolom_2);
        $pdf->Cell(15, 5, '' . $data['mei'] . '', 1, 0, 'C', 1);
        $kolom_2 += 15;
        $pdf->SetX(118 + $kolom_2);
        $pdf->Cell(15, 5, '' . $data['jun'] . '', 1, 0, 'C', 1);
        $kolom_2 += 15;
        $pdf->SetX(118 + $kolom_2);
        $pdf->Cell(15, 5, '' . $data['jul'] . '', 1, 0, 'C', 1);
        $kolom_2 += 15;
        $pdf->SetX(118 + $kolom_2);
        $pdf->Cell(15, 5, '' . $data['agt'] . '', 1, 0, 'C', 1);
        $kolom_2 += 15;
        $pdf->SetX(118 + $kolom_2);
        $pdf->Cell(15, 5, '' . $data['sep'] . '', 1, 0, 'C', 1);
        $kolom_2 += 15;
        $pdf->SetX(118 + $kolom_2);
        $pdf->Cell(15, 5, '' . $data['okt'] . '', 1, 0, 'C', 1);
        $kolom_2 += 15;
        $pdf->SetX(118 + $kolom_2);
        $pdf->Cell(15, 5, '' . $data['nov'] . '', 1, 0, 'C', 1);
        $kolom_2 += 15;
        $pdf->SetX(118 + $kolom_2);
        $pdf->Cell(15, 5, '' . $data['des'] . '', 1, 0, 'C', 1);
        $kolom_2 += 15;
        $pdf->SetX(118 + $kolom_2);
        $pdf->Cell(15, 5, '' . $data['tot_sisa'] . '', 1, 0, 'C', 1);

        $no++;
}


$pdf->Output();

