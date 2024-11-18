<?php

include "../config.php";
require "../mc_table.php";
require "../fungsi.php";

$bulan = $_GET['bln'];
$tahun = $_GET['thn'];

if ($bulan == 1) {
    $bln = 'Januari';
} else if ($bulan == 2) {
    $bln = 'Februari';
} else if ($bulan == 3) {
    $bln = 'Maret';
} else if ($bulan == 4) {
    $bln = 'April';
} else if ($bulan == 5) {
    $bln = 'Mei';
} else if ($bulan == 6) {
    $bln = 'Juni';
} else if ($bulan == 7) {
    $bln = 'Juli';
} else if ($bulan == 8) {
    $bln = 'Agustus';
} else if ($bulan == 9) {
    $bln = 'September';
} else if ($bulan == 10) {
    $bln = 'Oktober';
} else if ($bulan == 11) {
    $bln = 'November';
} else if ($bulan == 12) {
    $bln = 'Desember';
}

$query_telat = mysqli_query($con, "SELECT jml_denda FROM tb_denda WHERE nama_denda = 'TELAT'");
$denda       = mysqli_fetch_array($query_telat);

$query_telat_ob = mysqli_query($con, "SELECT jml_denda FROM tb_denda WHERE nama_denda = 'TELAT OB'");
$denda_ob       = mysqli_fetch_array($query_telat_ob);

$query          = mysqli_query($con, "SELECT a.nama, a.jabatan, a.tgl_1, a.tgl_2, a.tgl_3, a.tgl_4, a.tgl_5, a.tgl_6, a.tgl_7, 
        a.tgl_8, a.tgl_9, a.tgl_10, a.tgl_11, a.tgl_12, a.tgl_13, a.tgl_14, a.tgl_15,
        a.tgl_16, a.tgl_17, a.tgl_18, a.tgl_19, a.tgl_20, a.tgl_21, a.tgl_22, a.tgl_23,
        a.tgl_24, a.tgl_25, a.tgl_26, a.tgl_27, a.tgl_28, a.tgl_29, a.tgl_30, a.tgl_31, a.total
        FROM (
        
SELECT DISTINCT a.nama, a.jabatan, a.total, b.jam AS tgl_1, c.jam AS tgl_2, d.jam AS tgl_3, e.jam AS tgl_4, f.jam AS tgl_5, g.jam AS tgl_6, h.jam AS tgl_7, 
        i.jam AS tgl_8, j.jam AS tgl_9, k.jam AS tgl_10, l.jam AS tgl_11, m.jam AS tgl_12, n.jam AS tgl_13, o.jam AS tgl_14, p.jam AS tgl_15,
        q.jam AS tgl_16, r.jam AS tgl_17, s.jam AS tgl_18, t.jam AS tgl_19, u.jam AS tgl_20, v.jam AS tgl_21, w.jam AS tgl_22, aa.jam AS tgl_23,
        ab.jam AS tgl_24, ac.jam AS tgl_25, ad.jam AS tgl_26, ae.jam AS tgl_27, af.jam AS tgl_28, ag.jam AS tgl_29, ah.jam AS tgl_30, ai.jam AS tgl_31 
        FROM (
          SELECT a.nama, a.jabatan, IFNULL(b.total,0) AS total FROM (
      SELECT a.nama, a.jabatan, c.telat FROM tb_absensi_detail a, tb_keterangan b, tb_absensi c, tb_karyawan d WHERE a.id_keterangan = b.id_keterangan 
      AND c.id_karyawan = d.id_karyawan AND d.username = a.nama AND YEAR(a.tanggal) = '$tahun' AND c.tahun = '$tahun' GROUP BY a.nama DESC
    ) AS a LEFT OUTER JOIN (
    SELECT a.nama, COUNT(a.jam) AS total FROM tb_absensi_detail a, tb_keterangan b, tb_absensi c, tb_karyawan d WHERE a.id_keterangan = b.id_keterangan 
    AND b.keterangan = 'TELAT' AND c.id_karyawan = d.id_karyawan AND d.username = a.nama AND MONTH(a.tanggal) = '$bulan' AND YEAR(a.tanggal) = '$tahun' AND c.tahun = '$tahun' GROUP BY a.nama DESC
    ) AS b ON a.nama = b.nama
        ) AS a LEFT JOIN (
        
        SELECT a.jam, a.nama FROM tb_absensi_detail a, tb_keterangan b
        WHERE a.id_keterangan = b.id_keterangan AND DAY(a.tanggal) = '1' AND MONTH(a.tanggal) = '$bulan' AND YEAR(a.tanggal) = '$tahun' 
        AND b.keterangan = 'TELAT'
        
        ) AS b ON a.nama = b.nama LEFT JOIN (
        SELECT a.jam, a.nama FROM tb_absensi_detail a, tb_keterangan b
        WHERE a.id_keterangan = b.id_keterangan AND DAY(a.tanggal) = '2' AND MONTH(a.tanggal) = '$bulan' AND YEAR(a.tanggal) = '$tahun' 
        AND b.keterangan = 'TELAT'
    ) AS c ON a.nama = c.nama LEFT JOIN (
        SELECT a.jam, a.nama FROM tb_absensi_detail a, tb_keterangan b
        WHERE a.id_keterangan = b.id_keterangan AND DAY(a.tanggal) = '3' AND MONTH(a.tanggal) = '$bulan' AND YEAR(a.tanggal) = '$tahun' 
        AND b.keterangan = 'TELAT'
    ) AS d ON a.nama = d.nama LEFT JOIN (
        SELECT a.jam, a.nama FROM tb_absensi_detail a, tb_keterangan b
        WHERE a.id_keterangan = b.id_keterangan AND DAY(a.tanggal) = '4' AND MONTH(a.tanggal) = '$bulan' AND YEAR(a.tanggal) = '$tahun' 
        AND b.keterangan = 'TELAT'
    ) AS e ON a.nama = e.nama LEFT JOIN (
        SELECT a.jam, a.nama FROM tb_absensi_detail a, tb_keterangan b
        WHERE a.id_keterangan = b.id_keterangan AND DAY(a.tanggal) = '5' AND MONTH(a.tanggal) = '$bulan' AND YEAR(a.tanggal) = '$tahun' 
        AND b.keterangan = 'TELAT'
    ) AS f ON a.nama = f.nama LEFT JOIN (
        SELECT a.jam, a.nama FROM tb_absensi_detail a, tb_keterangan b
        WHERE a.id_keterangan = b.id_keterangan AND DAY(a.tanggal) = '6' AND MONTH(a.tanggal) = '$bulan' AND YEAR(a.tanggal) = '$tahun' 
        AND b.keterangan = 'TELAT'
    ) AS g ON a.nama = g.nama LEFT JOIN (
        SELECT a.jam, a.nama FROM tb_absensi_detail a, tb_keterangan b
        WHERE a.id_keterangan = b.id_keterangan AND DAY(a.tanggal) = '7' AND MONTH(a.tanggal) = '$bulan' AND YEAR(a.tanggal) = '$tahun' 
        AND b.keterangan = 'TELAT'
    ) AS h ON a.nama = h.nama LEFT JOIN (   
        SELECT a.jam, a.nama FROM tb_absensi_detail a, tb_keterangan b
        WHERE a.id_keterangan = b.id_keterangan AND DAY(a.tanggal) = '8' AND MONTH(a.tanggal) = '$bulan' AND YEAR(a.tanggal) = '$tahun' 
        AND b.keterangan = 'TELAT'
    ) AS i ON a.nama = i.nama LEFT JOIN (   
        SELECT a.jam, a.nama FROM tb_absensi_detail a, tb_keterangan b
        WHERE a.id_keterangan = b.id_keterangan AND DAY(a.tanggal) = '9' AND MONTH(a.tanggal) = '$bulan' AND YEAR(a.tanggal) = '$tahun' 
        AND b.keterangan = 'TELAT'
    ) AS j ON a.nama = j.nama LEFT JOIN (   
        SELECT a.jam, a.nama FROM tb_absensi_detail a, tb_keterangan b
        WHERE a.id_keterangan = b.id_keterangan AND DAY(a.tanggal) = '10' AND MONTH(a.tanggal) = '$bulan' AND YEAR(a.tanggal) = '$tahun' 
        AND b.keterangan = 'TELAT'
    ) AS k ON a.nama = k.nama LEFT JOIN (   
        SELECT a.jam, a.nama FROM tb_absensi_detail a, tb_keterangan b
        WHERE a.id_keterangan = b.id_keterangan AND DAY(a.tanggal) = '11' AND MONTH(a.tanggal) = '$bulan' AND YEAR(a.tanggal) = '$tahun' 
        AND b.keterangan = 'TELAT'
    ) AS l ON a.nama = l.nama LEFT JOIN (   
        SELECT a.jam, a.nama FROM tb_absensi_detail a, tb_keterangan b
        WHERE a.id_keterangan = b.id_keterangan AND DAY(a.tanggal) = '12' AND MONTH(a.tanggal) = '$bulan' AND YEAR(a.tanggal) = '$tahun' 
        AND b.keterangan = 'TELAT'
    ) AS m ON a.nama = m.nama LEFT JOIN (
        SELECT a.jam, a.nama FROM tb_absensi_detail a, tb_keterangan b
        WHERE a.id_keterangan = b.id_keterangan AND DAY(a.tanggal) = '13' AND MONTH(a.tanggal) = '$bulan' AND YEAR(a.tanggal) = '$tahun' 
        AND b.keterangan = 'TELAT'
    ) AS n ON a.nama = n.nama LEFT JOIN (
        SELECT a.jam, a.nama FROM tb_absensi_detail a, tb_keterangan b
        WHERE a.id_keterangan = b.id_keterangan AND DAY(a.tanggal) = '14' AND MONTH(a.tanggal) = '$bulan' AND YEAR(a.tanggal) = '$tahun' 
        AND b.keterangan = 'TELAT'
    ) AS o ON a.nama = o.nama LEFT JOIN (
        SELECT a.jam, a.nama FROM tb_absensi_detail a, tb_keterangan b
        WHERE a.id_keterangan = b.id_keterangan AND DAY(a.tanggal) = '15' AND MONTH(a.tanggal) = '$bulan' AND YEAR(a.tanggal) = '$tahun' 
        AND b.keterangan = 'TELAT'
    ) AS p ON a.nama = p.nama LEFT JOIN (
        SELECT a.jam, a.nama FROM tb_absensi_detail a, tb_keterangan b
        WHERE a.id_keterangan = b.id_keterangan AND DAY(a.tanggal) = '16' AND MONTH(a.tanggal) = '$bulan' AND YEAR(a.tanggal) = '$tahun' 
        AND b.keterangan = 'TELAT'
    ) AS q ON a.nama = q.nama LEFT JOIN (
        SELECT a.jam, a.nama FROM tb_absensi_detail a, tb_keterangan b
        WHERE a.id_keterangan = b.id_keterangan AND DAY(a.tanggal) = '17' AND MONTH(a.tanggal) = '$bulan' AND YEAR(a.tanggal) = '$tahun' 
        AND b.keterangan = 'TELAT'
    ) AS r ON a.nama = r.nama LEFT JOIN (
        SELECT a.jam, a.nama FROM tb_absensi_detail a, tb_keterangan b
        WHERE a.id_keterangan = b.id_keterangan AND DAY(a.tanggal) = '18' AND MONTH(a.tanggal) = '$bulan' AND YEAR(a.tanggal) = '$tahun' 
        AND b.keterangan = 'TELAT'
    ) AS s ON a.nama = s.nama LEFT JOIN (
        SELECT a.jam, a.nama FROM tb_absensi_detail a, tb_keterangan b
        WHERE a.id_keterangan = b.id_keterangan AND DAY(a.tanggal) = '19' AND MONTH(a.tanggal) = '$bulan' AND YEAR(a.tanggal) = '$tahun' 
        AND b.keterangan = 'TELAT'
    ) AS t ON a.nama = t.nama LEFT JOIN (   
        SELECT a.jam, a.nama FROM tb_absensi_detail a, tb_keterangan b
        WHERE a.id_keterangan = b.id_keterangan AND DAY(a.tanggal) = '20' AND MONTH(a.tanggal) = '$bulan' AND YEAR(a.tanggal) = '$tahun' 
        AND b.keterangan = 'TELAT'
    ) AS u ON a.nama = u.nama LEFT JOIN (
        SELECT a.jam, a.nama FROM tb_absensi_detail a, tb_keterangan b
        WHERE a.id_keterangan = b.id_keterangan AND DAY(a.tanggal) = '21' AND MONTH(a.tanggal) = '$bulan' AND YEAR(a.tanggal) = '$tahun' 
        AND b.keterangan = 'TELAT'
    ) AS v ON a.nama = v.nama LEFT JOIN (
        SELECT a.jam, a.nama FROM tb_absensi_detail a, tb_keterangan b
        WHERE a.id_keterangan = b.id_keterangan AND DAY(a.tanggal) = '22' AND MONTH(a.tanggal) = '$bulan' AND YEAR(a.tanggal) = '$tahun' 
        AND b.keterangan = 'TELAT'
    ) AS w ON a.nama = w.nama LEFT JOIN (
        SELECT a.jam, a.nama FROM tb_absensi_detail a, tb_keterangan b
        WHERE a.id_keterangan = b.id_keterangan AND DAY(a.tanggal) = '23' AND MONTH(a.tanggal) = '$bulan' AND YEAR(a.tanggal) = '$tahun' 
        AND b.keterangan = 'TELAT'
    ) AS aa ON a.nama = aa.nama LEFT JOIN (
        SELECT a.jam, a.nama FROM tb_absensi_detail a, tb_keterangan b
        WHERE a.id_keterangan = b.id_keterangan AND DAY(a.tanggal) = '24' AND MONTH(a.tanggal) = '$bulan' AND YEAR(a.tanggal) = '$tahun' 
        AND b.keterangan = 'TELAT'
    ) AS ab ON a.nama = ab.nama LEFT JOIN (
        SELECT a.jam, a.nama FROM tb_absensi_detail a, tb_keterangan b
        WHERE a.id_keterangan = b.id_keterangan AND DAY(a.tanggal) = '25' AND MONTH(a.tanggal) = '$bulan' AND YEAR(a.tanggal) = '$tahun' 
        AND b.keterangan = 'TELAT'
    ) AS ac ON a.nama = ac.nama LEFT JOIN (
        SELECT a.jam, a.nama FROM tb_absensi_detail a, tb_keterangan b
        WHERE a.id_keterangan = b.id_keterangan AND DAY(a.tanggal) = '26' AND MONTH(a.tanggal) = '$bulan' AND YEAR(a.tanggal) = '$tahun' 
        AND b.keterangan = 'TELAT'
    ) AS ad ON a.nama = ad.nama LEFT JOIN (
        SELECT a.jam, a.nama FROM tb_absensi_detail a, tb_keterangan b
        WHERE a.id_keterangan = b.id_keterangan AND DAY(a.tanggal) = '27' AND MONTH(a.tanggal) = '$bulan' AND YEAR(a.tanggal) = '$tahun' 
        AND b.keterangan = 'TELAT'
    ) AS ae ON a.nama = ae.nama LEFT JOIN (
        SELECT a.jam, a.nama FROM tb_absensi_detail a, tb_keterangan b
        WHERE a.id_keterangan = b.id_keterangan AND DAY(a.tanggal) = '28' AND MONTH(a.tanggal) = '$bulan' AND YEAR(a.tanggal) = '$tahun' 
        AND b.keterangan = 'TELAT'
    ) AS af ON a.nama = af.nama LEFT JOIN (
        SELECT a.jam, a.nama FROM tb_absensi_detail a, tb_keterangan b
        WHERE a.id_keterangan = b.id_keterangan AND DAY(a.tanggal) = '29' AND MONTH(a.tanggal) = '$bulan' AND YEAR(a.tanggal) = '$tahun' 
        AND b.keterangan = 'TELAT'
    ) AS ag ON a.nama = ag.nama LEFT JOIN (
        SELECT a.jam, a.nama FROM tb_absensi_detail a, tb_keterangan b
        WHERE a.id_keterangan = b.id_keterangan AND DAY(a.tanggal) = '30' AND MONTH(a.tanggal) = '$bulan' AND YEAR(a.tanggal) = '$tahun' 
        AND b.keterangan = 'TELAT'
    ) AS ah ON a.nama = ah.nama LEFT JOIN (
        SELECT a.jam, a.nama FROM tb_absensi_detail a, tb_keterangan b
        WHERE a.id_keterangan = b.id_keterangan AND DAY(a.tanggal) = '31' AND MONTH(a.tanggal) = '$bulan' AND YEAR(a.tanggal) = '$tahun' 
        AND b.keterangan = 'TELAT'
    ) AS ai ON a.nama = ai.nama
    ) AS a ORDER BY a.total DESC");

$total = mysqli_num_rows($query);

$pdf = new PDF_MC_Table('L', 'mm', 'A4');
$pdf->AliasNbPages();
//$pdf->SetAutoPageBreak(true); 
$pdf->AddPage();
$pdf->SetX(3);

//Fields Name position
$Y_Fields_Name_position = 10;

$pdf->SetFont('Times', 'B', 10);
$pdf->SetY($Y_Fields_Name_position);
$pdf->Cell(130);
$pdf->Cell(10, 7, 'Daftar Karyawan Telat');

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
$pdf->Cell(10, 7, 'Bulan : ' . $bln . ' ' . $tahun);

//Fields Name position
$Y_Fields_Name_position = 30;

$pdf->SetFillColor(255, 255, 255);
$pdf->SetFont('Times', 'B', 8);

$pdf->SetY($Y_Fields_Name_position);
$pdf->SetX(3);
$pdf->Cell(6, 10, 'No', 1, 0, 'C', 1);
$pdf->SetX(9);
$pdf->Cell(14, 10, 'Nama', 1, 0, '', 1);
$pdf->SetX(271);
$pdf->Cell(8, 10, 'Tot', 1, 0, 'C', 1);
$pdf->SetX(279);
$pdf->Cell(15, 10, 'Tot Bayar', 1, 0, 'C', 1);
$pdf->SetX(23);
$pdf->Cell(248, 5, 'Tanggal', 1, 0, 'C', 1);
$pdf->Ln();

$Y_Fields_Name_position = 30;

$pdf->SetWidths(array(8, 8, 8, 8, 8, 8, 8, 8, 8, 8, 8, 8, 8, 8, 8, 8, 8, 8, 8, 8, 8, 8, 8, 8, 8, 8, 8, 8, 8, 8, 8));
$pdf->SetAligns(array('C', 'C', 'C', 'C', 'C', 'C', 'C', 'C', 'C', 'C', 'C', 'C', 'C', 'C', 'C', 'C', 'C', 'C', 'C', 'C', 'C', 'C', 'C', 'C', 'C', 'C', 'C', 'C', 'C', 'C', 'C'));

$pdf->SetFillColor(255, 255, 255);
//Bold Font for Field Name
$pdf->SetFont('Times', '', 8);
$pdf->SetX(23);
$pdf->Row(array('1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12', '13', '14', '15', '16', '17', '18', '19', '20', '21', '22', '23', '24', '25', '26', '27', '28', '29', '30', '31'));

$Y_Fields_Name_position = 35;

$pdf->SetWidths(array(6, 14, 8, 8, 8, 8, 8, 8, 8, 8, 8, 8, 8, 8, 8, 8, 8, 8, 8, 8, 8, 8, 8, 8, 8, 8, 8, 8, 8, 8, 8, 8, 8, 8, 15));
$pdf->SetAligns(array('C', 'L', 'C', 'C', 'C', 'C', 'C', 'C', 'C', 'C', 'C', 'C', 'C', 'C', 'C', 'C', 'C', 'C', 'C', 'C', 'C', 'C', 'C', 'C', 'C', 'C', 'C', 'C', 'C', 'C', 'C', 'C', 'C', 'C', 'L'));

$pdf->SetFillColor(255, 255, 255);
//Bold Font for Field Name
$pdf->SetFont('Times', '', 7);

$no  = 1;
$tot = 0;
$tot_ob = 0;

while ($d = mysqli_fetch_array($query)) {

    $pdf->SetX(3);

    if ($d['total'] > '1') {

        if ($d['jabatan'] == 'OB / Kurir') {
            $tot_bayar_ob = ($d['total'] * $denda_ob['jml_denda']) - $denda_ob['jml_denda'];
            $pdf->Row(array('' . $no . '', '' . $d['nama'] . '', '' . substr($d['tgl_1'], 0, 5) . '', '' . substr($d['tgl_2'], 0, 5) . '', '' . substr($d['tgl_3'], 0, 5) . '', '' . substr($d['tgl_4'], 0, 5) . '', '' . substr($d['tgl_5'], 0, 5) . '', '' . substr($d['tgl_6'], 0, 5) . '', '' . substr($d['tgl_7'], 0, 5) . '', '' . substr($d['tgl_8'], 0, 5) . '', '' . substr($d['tgl_9'], 0, 5) . '', '' . substr($d['tgl_10'], 0, 5) . '', '' . substr($d['tgl_11'], 0, 5) . '', '' . substr($d['tgl_12'], 0, 5) . '', '' . substr($d['tgl_13'], 0, 5) . '', '' . substr($d['tgl_14'], 0, 5) . '', '' . substr($d['tgl_15'], 0, 5) . '', '' . substr($d['tgl_16'], 0, 5) . '', '' . substr($d['tgl_17'], 0, 5) . '', '' . substr($d['tgl_18'], 0, 5) . '', '' . substr($d['tgl_19'], 0, 5) . '', '' . substr($d['tgl_20'], 0, 5) . '', '' . substr($d['tgl_21'], 0, 5) . '', '' . substr($d['tgl_22'], 0, 5) . '', '' . substr($d['tgl_23'], 0, 5) . '', '' . substr($d['tgl_24'], 0, 5) . '', '' . substr($d['tgl_25'], 0, 5) . '', '' . substr($d['tgl_26'], 0, 5) . '', '' . substr($d['tgl_27'], 0, 5) . '', '' . substr($d['tgl_28'], 0, 5) . '', '' . substr($d['tgl_29'], 0, 5) . '', '' . substr($d['tgl_30'], 0, 5) . '', '' . substr($d['tgl_31'], 0, 5) . '', '' . $d['total'] . '', 'Rp.' . rupiah($tot_bayar_ob) . ''));
            $tot_ob += $tot_bayar_ob;
        } else {

            $tot_bayar = ($d['total'] * $denda['jml_denda']) - $denda['jml_denda'];
            $pdf->Row(array('' . $no . '', '' . $d['nama'] . '', '' . substr($d['tgl_1'], 0, 5) . '', '' . substr($d['tgl_2'], 0, 5) . '', '' . substr($d['tgl_3'], 0, 5) . '', '' . substr($d['tgl_4'], 0, 5) . '', '' . substr($d['tgl_5'], 0, 5) . '', '' . substr($d['tgl_6'], 0, 5) . '', '' . substr($d['tgl_7'], 0, 5) . '', '' . substr($d['tgl_8'], 0, 5) . '', '' . substr($d['tgl_9'], 0, 5) . '', '' . substr($d['tgl_10'], 0, 5) . '', '' . substr($d['tgl_11'], 0, 5) . '', '' . substr($d['tgl_12'], 0, 5) . '', '' . substr($d['tgl_13'], 0, 5) . '', '' . substr($d['tgl_14'], 0, 5) . '', '' . substr($d['tgl_15'], 0, 5) . '', '' . substr($d['tgl_16'], 0, 5) . '', '' . substr($d['tgl_17'], 0, 5) . '', '' . substr($d['tgl_18'], 0, 5) . '', '' . substr($d['tgl_19'], 0, 5) . '', '' . substr($d['tgl_20'], 0, 5) . '', '' . substr($d['tgl_21'], 0, 5) . '', '' . substr($d['tgl_22'], 0, 5) . '', '' . substr($d['tgl_23'], 0, 5) . '', '' . substr($d['tgl_24'], 0, 5) . '', '' . substr($d['tgl_25'], 0, 5) . '', '' . substr($d['tgl_26'], 0, 5) . '', '' . substr($d['tgl_27'], 0, 5) . '', '' . substr($d['tgl_28'], 0, 5) . '', '' . substr($d['tgl_29'], 0, 5) . '', '' . substr($d['tgl_30'], 0, 5) . '', '' . substr($d['tgl_31'], 0, 5) . '', '' . $d['total'] . '', 'Rp.' . rupiah($tot_bayar) . ''));
            $tot += $tot_bayar;
        }
    }

    $no++;
}

$total = $tot + $tot_ob;

$pdf->SetWidths(array(268, 23));
$pdf->SetAligns(array('L', 'C'));

$pdf->SetFont('Times', 'B', 10);
$pdf->SetX(3);
$pdf->Row(array('Total Denda', 'Rp. ' . rupiah($total) . ''));

$pdf->Output();

