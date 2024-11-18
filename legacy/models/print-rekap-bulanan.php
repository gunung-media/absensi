<?php

include "../config.php";
require "../mc_table.php";
require "../fungsi.php";

$bulan = $_GET['bln'];
$tahun = $_GET['thn'];

$tanggal = cal_days_in_month(CAL_GREGORIAN, $bulan, $tahun);

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

$fltr   = "";
$paramm = "";

if (!empty($_GET['nama'])) {
    $nama = $_GET['nama'];
    $fltr .= "AND a.nama = '" . $nama . "'";
}

$query          = mysqli_query($con, "SELECT a.nama_lengkap, a.nama, a.nama_departemen, a.tgl_1, a.tgl_2, a.tgl_3, a.tgl_4, a.tgl_5, a.tgl_6, a.tgl_7, 
        a.tgl_8, a.tgl_9, a.tgl_10, a.tgl_11, a.tgl_12, a.tgl_13, a.tgl_14, a.tgl_15,
        a.tgl_16, a.tgl_17, a.tgl_18, a.tgl_19, a.tgl_20, a.tgl_21, a.tgl_22, a.tgl_23,
        a.tgl_24, a.tgl_25,b.tgl_26,b.tgl_27,b.tgl_28,b.tgl_29,b.tgl_30,b.tgl_31  
        FROM (
        
        SELECT a.nama_lengkap, a.nama, a.nama_departemen, tgl_1, tgl_2, tgl_3, tgl_4, tgl_5, tgl_6, tgl_7, 
        tgl_8, tgl_9, tgl_10, tgl_11, tgl_12, tgl_13, tgl_14, tgl_15,
        tgl_16, tgl_17, tgl_18, tgl_19, tgl_20, tgl_21, tgl_22, tgl_23,
        tgl_24,tgl_25 
        FROM (
 
    SELECT a.nama, d.nama_departemen, c.nama_lengkap FROM tb_absensi_detail a, tb_keterangan b, tb_karyawan c, tb_departemen d WHERE a.id_keterangan = b.id_keterangan AND a.nama = c.username 
    AND c.id_departemen = d.id_departemen AND MONTH(a.tanggal) = '$bulan' AND YEAR(a.tanggal) = '$tahun' AND c.status = '1' AND d.nama_departemen NOT IN ('PLANT') $fltr GROUP BY a.nama
        
        ) AS a LEFT JOIN(
        
        SELECT b.kode AS tgl_1, a.nama FROM tb_absensi_detail a, tb_keterangan b
        WHERE a.id_keterangan = b.id_keterangan AND DAY(a.tanggal) = '1' AND MONTH(a.tanggal) = '$bulan' AND YEAR(a.tanggal) = '$tahun' $fltr  
        ) AS b ON a.nama = b.nama LEFT JOIN (
        SELECT b.kode AS tgl_2, a.nama FROM tb_absensi_detail a, tb_keterangan b
        WHERE a.id_keterangan = b.id_keterangan AND DAY(a.tanggal) = '2' AND MONTH(a.tanggal) = '$bulan' AND YEAR(a.tanggal) = '$tahun' $fltr
    ) AS c ON a.nama = c.nama LEFT JOIN (
        SELECT b.kode AS tgl_3, a.nama FROM tb_absensi_detail a, tb_keterangan b
        WHERE a.id_keterangan = b.id_keterangan AND DAY(a.tanggal) = '3' AND MONTH(a.tanggal) = '$bulan' AND YEAR(a.tanggal) = '$tahun' $fltr 
    ) AS d ON a.nama = d.nama LEFT JOIN (
        SELECT b.kode AS tgl_4, a.nama FROM tb_absensi_detail a, tb_keterangan b
        WHERE a.id_keterangan = b.id_keterangan AND DAY(a.tanggal) = '4' AND MONTH(a.tanggal) = '$bulan' AND YEAR(a.tanggal) = '$tahun' $fltr
    ) AS e ON a.nama = e.nama LEFT JOIN (
        SELECT b.kode tgl_5, a.nama FROM tb_absensi_detail a, tb_keterangan b
        WHERE a.id_keterangan = b.id_keterangan AND DAY(a.tanggal) = '5' AND MONTH(a.tanggal) = '$bulan' AND YEAR(a.tanggal) = '$tahun' $fltr 
    ) AS f ON a.nama = f.nama LEFT JOIN (
        SELECT b.kode AS tgl_6, a.nama FROM tb_absensi_detail a, tb_keterangan b
        WHERE a.id_keterangan = b.id_keterangan AND DAY(a.tanggal) = '6' AND MONTH(a.tanggal) = '$bulan' AND YEAR(a.tanggal) = '$tahun' $fltr
    ) AS g ON a.nama = g.nama LEFT JOIN (
        SELECT b.kode AS tgl_7, a.nama FROM tb_absensi_detail a, tb_keterangan b
        WHERE a.id_keterangan = b.id_keterangan AND DAY(a.tanggal) = '7' AND MONTH(a.tanggal) = '$bulan' AND YEAR(a.tanggal) = '$tahun' $fltr
    ) AS h ON a.nama = h.nama LEFT JOIN (   
        SELECT b.kode AS tgl_8, a.nama FROM tb_absensi_detail a, tb_keterangan b
        WHERE a.id_keterangan = b.id_keterangan AND DAY(a.tanggal) = '8' AND MONTH(a.tanggal) = '$bulan' AND YEAR(a.tanggal) = '$tahun' $fltr
    ) AS i ON a.nama = i.nama LEFT JOIN (   
        SELECT b.kode AS tgl_9, a.nama FROM tb_absensi_detail a, tb_keterangan b
        WHERE a.id_keterangan = b.id_keterangan AND DAY(a.tanggal) = '9' AND MONTH(a.tanggal) = '$bulan' AND YEAR(a.tanggal) = '$tahun' $fltr 
    ) AS j ON a.nama = j.nama LEFT JOIN (   
        SELECT b.kode AS tgl_10, a.nama FROM tb_absensi_detail a, tb_keterangan b
        WHERE a.id_keterangan = b.id_keterangan AND DAY(a.tanggal) = '10' AND MONTH(a.tanggal) = '$bulan' AND YEAR(a.tanggal) = '$tahun' $fltr
    ) AS k ON a.nama = k.nama LEFT JOIN (   
        SELECT b.kode AS tgl_11, a.nama FROM tb_absensi_detail a, tb_keterangan b
        WHERE a.id_keterangan = b.id_keterangan AND DAY(a.tanggal) = '11' AND MONTH(a.tanggal) = '$bulan' AND YEAR(a.tanggal) = '$tahun' $fltr
    ) AS l ON a.nama = l.nama LEFT JOIN (   
        SELECT b.kode AS tgl_12, a.nama FROM tb_absensi_detail a, tb_keterangan b
        WHERE a.id_keterangan = b.id_keterangan AND DAY(a.tanggal) = '12' AND MONTH(a.tanggal) = '$bulan' AND YEAR(a.tanggal) = '$tahun' $fltr
    ) AS m ON a.nama = m.nama LEFT JOIN (
        SELECT b.kode AS tgl_13, a.nama FROM tb_absensi_detail a, tb_keterangan b
        WHERE a.id_keterangan = b.id_keterangan AND DAY(a.tanggal) = '13' AND MONTH(a.tanggal) = '$bulan' AND YEAR(a.tanggal) = '$tahun' $fltr
    ) AS n ON a.nama = n.nama LEFT JOIN (
        SELECT b.kode AS tgl_14, a.nama FROM tb_absensi_detail a, tb_keterangan b
        WHERE a.id_keterangan = b.id_keterangan AND DAY(a.tanggal) = '14' AND MONTH(a.tanggal) = '$bulan' AND YEAR(a.tanggal) = '$tahun' $fltr 
    ) AS o ON a.nama = o.nama LEFT JOIN (
        SELECT b.kode AS tgl_15, a.nama FROM tb_absensi_detail a, tb_keterangan b
        WHERE a.id_keterangan = b.id_keterangan AND DAY(a.tanggal) = '15' AND MONTH(a.tanggal) = '$bulan' AND YEAR(a.tanggal) = '$tahun' $fltr
    ) AS p ON a.nama = p.nama LEFT JOIN (
        SELECT b.kode AS tgl_16, a.nama FROM tb_absensi_detail a, tb_keterangan b
        WHERE a.id_keterangan = b.id_keterangan AND DAY(a.tanggal) = '16' AND MONTH(a.tanggal) = '$bulan' AND YEAR(a.tanggal) = '$tahun' $fltr
    ) AS q ON a.nama = q.nama LEFT JOIN (
        SELECT b.kode AS tgl_17, a.nama FROM tb_absensi_detail a, tb_keterangan b
        WHERE a.id_keterangan = b.id_keterangan AND DAY(a.tanggal) = '17' AND MONTH(a.tanggal) = '$bulan' AND YEAR(a.tanggal) = '$tahun' $fltr 
    ) AS r ON a.nama = r.nama LEFT JOIN (
        SELECT b.kode AS tgl_18, a.nama FROM tb_absensi_detail a, tb_keterangan b
        WHERE a.id_keterangan = b.id_keterangan AND DAY(a.tanggal) = '18' AND MONTH(a.tanggal) = '$bulan' AND YEAR(a.tanggal) = '$tahun' $fltr 
    ) AS s ON a.nama = s.nama LEFT JOIN (
        SELECT b.kode AS tgl_19, a.nama FROM tb_absensi_detail a, tb_keterangan b
        WHERE a.id_keterangan = b.id_keterangan AND DAY(a.tanggal) = '19' AND MONTH(a.tanggal) = '$bulan' AND YEAR(a.tanggal) = '$tahun' $fltr
    ) AS t ON a.nama = t.nama LEFT JOIN (   
        SELECT b.kode AS tgl_20, a.nama FROM tb_absensi_detail a, tb_keterangan b
        WHERE a.id_keterangan = b.id_keterangan AND DAY(a.tanggal) = '20' AND MONTH(a.tanggal) = '$bulan' AND YEAR(a.tanggal) = '$tahun' $fltr
    ) AS u ON a.nama = u.nama LEFT JOIN (
        SELECT b.kode AS tgl_21, a.nama FROM tb_absensi_detail a, tb_keterangan b
        WHERE a.id_keterangan = b.id_keterangan AND DAY(a.tanggal) = '21' AND MONTH(a.tanggal) = '$bulan' AND YEAR(a.tanggal) = '$tahun' $fltr
    ) AS v ON a.nama = v.nama LEFT JOIN (
        SELECT b.kode AS tgl_22, a.nama FROM tb_absensi_detail a, tb_keterangan b
        WHERE a.id_keterangan = b.id_keterangan AND DAY(a.tanggal) = '22' AND MONTH(a.tanggal) = '$bulan' AND YEAR(a.tanggal) = '$tahun' $fltr
    ) AS w ON a.nama = w.nama LEFT JOIN (
        SELECT b.kode AS tgl_23, a.nama FROM tb_absensi_detail a, tb_keterangan b
        WHERE a.id_keterangan = b.id_keterangan AND DAY(a.tanggal) = '23' AND MONTH(a.tanggal) = '$bulan' AND YEAR(a.tanggal) = '$tahun' $fltr
    ) AS aa ON a.nama = aa.nama LEFT JOIN (
        SELECT b.kode AS tgl_24, a.nama FROM tb_absensi_detail a, tb_keterangan b
        WHERE a.id_keterangan = b.id_keterangan AND DAY(a.tanggal) = '24' AND MONTH(a.tanggal) = '$bulan' AND YEAR(a.tanggal) = '$tahun' $fltr
    ) AS ab ON a.nama = ab.nama LEFT JOIN (
        SELECT b.kode AS tgl_25, a.nama FROM tb_absensi_detail a, tb_keterangan b
        WHERE a.id_keterangan = b.id_keterangan AND DAY(a.tanggal) = '25' AND MONTH(a.tanggal) = '$bulan' AND YEAR(a.tanggal) = '$tahun' $fltr 
    ) AS ac ON a.nama = ac.nama ORDER BY a.nama ASC
    
    ) AS a LEFT OUTER JOIN (
    
    SELECT a.nama,tgl_26,tgl_27,tgl_28,tgl_29,tgl_30,tgl_31
        FROM (
 
    SELECT a.nama, d.nama_departemen, c.nama_lengkap FROM tb_absensi_detail a, tb_keterangan b, tb_karyawan c, tb_departemen d WHERE a.id_keterangan = b.id_keterangan AND a.nama = c.username 
    AND c.id_departemen = d.id_departemen AND MONTH(a.tanggal) = '$bulan' AND YEAR(a.tanggal) = '$tahun' AND c.status = '1' AND d.nama_departemen NOT IN ('PLANT') $fltr GROUP BY a.nama
        
        ) AS a LEFT JOIN(
        SELECT b.kode AS tgl_26, a.nama FROM tb_absensi_detail a, tb_keterangan b
        WHERE a.id_keterangan = b.id_keterangan AND DAY(a.tanggal) = '26' AND MONTH(a.tanggal) = '$bulan' AND YEAR(a.tanggal) = '$tahun' $fltr
    ) AS ad ON a.nama = ad.nama LEFT JOIN (
        SELECT b.kode AS tgl_27, a.nama FROM tb_absensi_detail a, tb_keterangan b
        WHERE a.id_keterangan = b.id_keterangan AND DAY(a.tanggal) = '27' AND MONTH(a.tanggal) = '$bulan' AND YEAR(a.tanggal) = '$tahun' $fltr
    ) AS ae ON a.nama = ae.nama LEFT JOIN (
        SELECT b.kode AS tgl_28, a.nama FROM tb_absensi_detail a, tb_keterangan b
        WHERE a.id_keterangan = b.id_keterangan AND DAY(a.tanggal) = '28' AND MONTH(a.tanggal) = '$bulan' AND YEAR(a.tanggal) = '$tahun' $fltr
    ) AS af ON a.nama = af.nama LEFT JOIN (
        SELECT b.kode AS tgl_29, a.nama FROM tb_absensi_detail a, tb_keterangan b
        WHERE a.id_keterangan = b.id_keterangan AND DAY(a.tanggal) = '29' AND MONTH(a.tanggal) = '$bulan' AND YEAR(a.tanggal) = '$tahun' $fltr
    ) AS ag ON a.nama = ag.nama LEFT JOIN (
        SELECT b.kode AS tgl_30, a.nama FROM tb_absensi_detail a, tb_keterangan b
        WHERE a.id_keterangan = b.id_keterangan AND DAY(a.tanggal) = '30' AND MONTH(a.tanggal) = '$bulan' AND YEAR(a.tanggal) = '$tahun' $fltr 
    ) AS ah ON a.nama = ah.nama LEFT JOIN (
        SELECT b.kode AS tgl_31, a.nama FROM tb_absensi_detail a, tb_keterangan b
        WHERE a.id_keterangan = b.id_keterangan AND DAY(a.tanggal) = '31' AND MONTH(a.tanggal) = '$bulan' AND YEAR(a.tanggal) = '$tahun' $fltr
    ) AS ai ON a.nama = ai.nama ORDER BY a.nama ASC
    ) AS b ON a.nama = b.nama");

$total = mysqli_num_rows($query);

$pdf = new PDF_MC_Table('L', 'mm', array(210, 320));
$pdf->AliasNbPages();
//$pdf->SetAutoPageBreak(true); 
$pdf->AddPage();
$pdf->SetX(3);

//Fields Name position
$Y_Fields_Name_position = 10;

$pdf->SetFont('Times', 'B', 10);
$pdf->SetY($Y_Fields_Name_position);
$pdf->Cell(130);
$pdf->Cell(10, 7, 'Daftar Absensi Karyawan / Bulan');

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
$pdf->Cell(6, 15, 'No', 1, 0, 'C', 1);
$pdf->SetX(9);
$pdf->Cell(14, 15, 'Nama', 1, 0, '', 1);
$pdf->SetX(23);
$pdf->Cell(248, 5, 'Tanggal', 1, 0, 'C', 1);
$pdf->SetX(271);
$pdf->Cell(28, 5, 'Total', 1, 0, 'C', 1);
$pdf->Ln();

//Fields Name position
$Y_Fields_Name_position = 40;
$pdf->SetX(271);
$pdf->Cell(4, 10, 'C', 1, 0, 'C', 1);
$pdf->SetX(275);
$pdf->Cell(4, 10, 'T', 1, 0, 'C', 1);
$pdf->SetX(279);
$pdf->Cell(4, 10, 'S', 1, 0, 'C', 1);
$pdf->SetX(283);
$pdf->Cell(4, 10, 'I', 1, 0, 'C', 1);
$pdf->SetX(287);
$pdf->Cell(4, 10, 'V', 1, 0, 'C', 1);
$pdf->SetX(291);
$pdf->Cell(4, 10, 'K', 1, 0, 'C', 1);
$pdf->SetX(295);
$pdf->Cell(4, 10, 'M', 1, 0, 'C', 1);

$Y_Fields_Name_position = 30;

$kolom = 0;
for ($i = 1; $i <= 31; $i++) {

    $tgl = $tahun . '-' . $bulan . '-' . $i . '';

    $day = date('D', strtotime($tgl));
    $dayList = array(
        'Sun' => 'Min',
        'Mon' => 'Sen',
        'Tue' => 'Sel',
        'Wed' => 'Rab',
        'Thu' => 'Kam',
        'Fri' => 'Jum',
        'Sat' => 'Sab'
    );

    if ($dayList[$day] == 'Min' || $dayList[$day] == 'Sab') {
        $pdf->SetFillColor(220, 24, 24, 1);
        $pdf->SetX(23 + $kolom);
        $pdf->Cell(8, 5, '' . $dayList[$day] . '', 1, 0, 'C', 1);
    } else {
        $pdf->SetFillColor(255, 255, 255);
        $pdf->SetX(23 + $kolom);
        $pdf->Cell(8, 5, '' . $dayList[$day] . '', 1, 0, 'C', 1);
    }

    $kolom += 8;
}


$pdf->Ln(5);

$kolom = 0;
for ($i = 1; $i <= 31; $i++) {

    $tgl = $tahun . '-' . $bulan . '-' . $i . '';

    $day = date('D', strtotime($tgl));
    $dayList = array(
        'Sun' => 'Min',
        'Mon' => 'Sen',
        'Tue' => 'Sel',
        'Wed' => 'Rab',
        'Thu' => 'Kam',
        'Fri' => 'Jum',
        'Sat' => 'Sab'
    );

    if ($dayList[$day] == 'Min' || $dayList[$day] == 'Sab') {
        $pdf->SetFillColor(220, 24, 24, 1);
        $pdf->SetX(23 + $kolom);
        $pdf->Cell(8, 5, '' . $i . '', 1, 0, 'C', 1);
    } else {
        $pdf->SetFillColor(255, 255, 255);
        $pdf->SetX(23 + $kolom);
        $pdf->Cell(8, 5, '' . $i . '', 1, 0, 'C', 1);
    }

    $kolom += 8;
}

$no     = 1;
$row    = 0;

while ($data = mysqli_fetch_array($query)) {

    $query_spek = mysqli_query($con, "SELECT a.nama,IFNULL(b.total_telat,0) AS telat,
        IFNULL(c.total_izin,0) AS izin, IFNULL(d.total_cuti,0) AS cuti, IFNULL(e.total_sakit,0) AS sakit, IFNULL(f.total_visit,0) AS visit,
        IFNULL(g.total_lk,0) AS luar_kota,
        IFNULL(h.total_tepat,0) AS masuk FROM (
    
    SELECT a.nama, d.nama_departemen, c.nama_lengkap FROM tb_absensi_detail a, tb_keterangan b, tb_karyawan c, tb_departemen d WHERE a.id_keterangan = b.id_keterangan AND a.nama = c.username 
    AND c.id_departemen = d.id_departemen AND MONTH(a.tanggal) = '$bulan' AND a.nama = '" . $data['nama'] . "' AND YEAR(a.tanggal) = '$tahun' AND c.status = '1'  GROUP BY a.nama
        
        ) AS a LEFT JOIN(
    SELECT a.nama, COUNT(a.id_keterangan) AS total_telat FROM tb_absensi_detail a, tb_keterangan b WHERE a.id_keterangan = b.id_keterangan 
    AND MONTH(a.tanggal) = '$bulan' AND YEAR(a.tanggal) = '$tahun' AND a.nama = '" . $data['nama'] . "' AND b.keterangan = 'TELAT'  GROUP BY a.nama
    ) AS b ON a.nama = b.nama LEFT JOIN (
    SELECT a.nama, COUNT(a.id_keterangan) AS total_izin FROM tb_absensi_detail a, tb_keterangan b WHERE a.id_keterangan = b.id_keterangan 
    AND MONTH(a.tanggal) = '$bulan' AND YEAR(a.tanggal) = '$tahun' AND a.nama = '" . $data['nama'] . "' AND b.keterangan = 'IZIN SIANG'  GROUP BY a.nama
    ) AS c ON a.nama = c.nama LEFT JOIN (
    SELECT a.nama, COUNT(a.id_keterangan) AS total_cuti FROM tb_absensi_detail a, tb_keterangan b WHERE a.id_keterangan = b.id_keterangan 
    AND MONTH(a.tanggal) = '$bulan' AND YEAR(a.tanggal) = '$tahun' AND a.nama = '" . $data['nama'] . "' AND b.keterangan = 'CUTI'  GROUP BY a.nama
    ) AS d ON a.nama = d.nama LEFT JOIN (
    SELECT a.nama, COUNT(a.id_keterangan) AS total_sakit FROM tb_absensi_detail a, tb_keterangan b WHERE a.id_keterangan = b.id_keterangan 
    AND MONTH(a.tanggal) = '$bulan' AND YEAR(a.tanggal) = '$tahun' AND a.nama = '" . $data['nama'] . "' AND b.keterangan = 'SAKIT'  GROUP BY a.nama
    ) AS e ON a.nama = e.nama LEFT JOIN (
    SELECT a.nama, COUNT(a.id_keterangan) AS total_visit FROM tb_absensi_detail a, tb_keterangan b WHERE a.id_keterangan = b.id_keterangan 
    AND MONTH(a.tanggal) = '$bulan' AND YEAR(a.tanggal) = '$tahun' AND a.nama = '" . $data['nama'] . "' AND b.keterangan = 'VISIT'  GROUP BY a.nama
    ) AS f ON a.nama = f.nama LEFT JOIN(
    SELECT a.nama, COUNT(a.id_keterangan) AS total_lk FROM tb_absensi_detail a, tb_keterangan b WHERE a.id_keterangan = b.id_keterangan 
    AND MONTH(a.tanggal) = '$bulan' AND YEAR(a.tanggal) = '$tahun' AND a.nama = '" . $data['nama'] . "' AND b.keterangan = 'LUAR KOTA'  GROUP BY a.nama
    ) AS g ON a.nama = g.nama LEFT JOIN(
    SELECT a.nama, COUNT(a.id_keterangan) AS total_tepat FROM tb_absensi_detail a, tb_keterangan b WHERE a.id_keterangan = b.id_keterangan 
    AND MONTH(a.tanggal) = '$bulan' AND YEAR(a.tanggal) = '$tahun' AND a.nama = '" . $data['nama'] . "' AND b.keterangan NOT IN ('LUAR KOTA','CUTI','SAKIT') GROUP BY a.nama
    ) AS h ON a.nama = h.nama ORDER BY a.nama ASC");

    $d = mysqli_fetch_array($query_spek);

    $pdf->Ln(5 + $row);
    $pdf->SetFillColor(255, 255, 255);
    $pdf->SetX(3);
    $pdf->Cell(6, 5, '' . $no . '', 1, 0, 'C', 1);
    $pdf->SetX(9);
    $pdf->Cell(14, 5, '' . $data['nama'] . '', 1, 0, 'L', 1);

    $kolom  = 0;
    for ($i = 1; $i <= 31; $i++) {

        $tgl = $tahun . '-' . $bulan . '-' . $i . '';

        $day = date('D', strtotime($tgl));
        $dayList = array(
            'Sun' => 'Min',
            'Mon' => 'Sen',
            'Tue' => 'Sel',
            'Wed' => 'Rab',
            'Thu' => 'Kam',
            'Fri' => 'Jum',
            'Sat' => 'Sab'
        );

        if ($data['tgl_' . $i . ''] == "" && $dayList[$day] == 'Min' || $dayList[$day] == 'Sab') {

            $pdf->SetFillColor(220, 24, 24, 1);
            $pdf->SetX(23 + $kolom);
            $pdf->Cell(8, 5, '', 1, 0, 'C', 1);
        } else if ($data['tgl_' . $i . ''] == "") {
            $pdf->SetFillColor(255, 255, 255);
            $pdf->SetX(23 + $kolom);
            $pdf->Cell(8, 5, '', 1, 0, 'C', 1);
        } else {
            if ($data['tgl_' . $i . ''] == 'T') {
                $pdf->SetFillColor(220, 142, 24, 1);
                $pdf->SetX(23 + $kolom);
                $pdf->Cell(8, 5, '' . $data['tgl_' . $i . ''] . '', 1, 0, 'C', 1);
            } else if ($data['tgl_' . $i . ''] == 'SG') {
                $pdf->SetFillColor(24, 204, 220, 1);
                $pdf->SetX(23 + $kolom);
                $pdf->Cell(8, 5, '' . $data['tgl_' . $i . ''] . '', 1, 0, 'C', 1);
            } else if ($data['tgl_' . $i . ''] == 'C') {
                $pdf->SetFillColor(206, 206, 208, 1);
                $pdf->SetX(23 + $kolom);
                $pdf->Cell(8, 5, '' . $data['tgl_' . $i . ''] . '', 1, 0, 'C', 1);
            } else if ($data['tgl_' . $i . ''] == 'S') {
                $pdf->SetFillColor(226, 187, 210, 1);
                $pdf->SetX(23 + $kolom);
                $pdf->Cell(8, 5, '' . $data['tgl_' . $i . ''] . '', 1, 0, 'C', 1);
            } else if ($data['tgl_' . $i . ''] == 'P') {
                $pdf->SetFillColor(30, 235, 160, 1);
                $pdf->SetX(23 + $kolom);
                $pdf->Cell(8, 5, '' . $data['tgl_' . $i . ''] . '', 1, 0, 'C', 1);
            } else if ($data['tgl_' . $i . ''] == 'LK') {
                $pdf->SetFillColor(76, 205, 82, 1);
                $pdf->SetX(23 + $kolom);
                $pdf->Cell(8, 5, '' . $data['tgl_' . $i . ''] . '', 1, 0, 'C', 1);
            } else {
                $pdf->SetFillColor(255, 255, 255);
                $pdf->SetX(23 + $kolom);
                $pdf->Cell(8, 5, '' . $data['tgl_' . $i . ''] . '', 1, 0, 'C', 1);
            }
        }

        $kolom += 8;
    }

    $pdf->SetFillColor(255, 255, 255);
    $pdf->SetX(271);
    $pdf->Cell(4, 5, '' . $d['cuti'] . '', 1, 0, 'C', 1);
    $pdf->SetX(275);
    $pdf->Cell(4, 5, '' . $d['telat'] . '', 1, 0, 'C', 1);
    $pdf->SetX(279);
    $pdf->Cell(4, 5, '' . $d['sakit'] . '', 1, 0, 'C', 1);
    $pdf->SetX(283);
    $pdf->Cell(4, 5, '' . $d['izin'] . '', 1, 0, 'C', 1);
    $pdf->SetX(287);
    $pdf->Cell(4, 5, '' . $d['visit'] . '', 1, 0, 'C', 1);
    $pdf->SetX(291);
    $pdf->Cell(4, 5, '' . $d['luar_kota'] . '', 1, 0, 'C', 1);
    $pdf->SetX(295);
    $pdf->Cell(4, 5, '' . $d['masuk'] . '', 1, 0, 'C', 1);

    $no++;
}

$pdf->Ln(10);
$pdf->SetFont('Times', 'B', 10);
$pdf->SetX(207);
$pdf->Cell(4, 4, 'Keterangan', 0, 0, 'C', 1);

$pdf->Ln(5);
$pdf->SetFillColor(220, 142, 24, 1);
$pdf->SetX(200);
$pdf->Cell(4, 4, 'T', 0, 0, 'C', 1);
$pdf->SetFillColor(255, 255, 255);
$pdf->SetFont('Times', '', 10);
$pdf->SetX(210);
$pdf->Cell(4, 4, ': Telat', 0, 0, 'C', 1);

$pdf->SetFillColor(24, 204, 220, 1);
$pdf->SetX(240);
$pdf->Cell(10, 4, 'SG/I', 0, 0, 'C', 1);
$pdf->SetFillColor(255, 255, 255);
$pdf->SetFont('Times', '', 10);
$pdf->SetX(260);
$pdf->Cell(4, 4, ': Izin Siang', 0, 0, 'C', 1);

$pdf->Ln(5);
$pdf->SetFillColor(206, 206, 208, 1);
$pdf->SetX(200);
$pdf->Cell(4, 4, 'C', 0, 0, 'C', 1);
$pdf->SetFillColor(255, 255, 255);
$pdf->SetFont('Times', '', 10);
$pdf->SetX(210);
$pdf->Cell(4, 4, ': Cuti', 0, 0, 'C', 1);

$pdf->SetFillColor(30, 235, 160, 1);
$pdf->SetX(240);
$pdf->Cell(10, 4, 'P/V', 0, 0, 'C', 1);
$pdf->SetFillColor(255, 255, 255);
$pdf->SetFont('Times', '', 10);
$pdf->SetX(261);
$pdf->Cell(4, 4, ': Visit / Plant', 0, 0, 'C', 1);

$pdf->Ln(5);
$pdf->SetFillColor(226, 187, 210, 1);
$pdf->SetX(200);
$pdf->Cell(4, 4, 'S', 0, 0, 'C', 1);
$pdf->SetFillColor(255, 255, 255);
$pdf->SetFont('Times', '', 10);
$pdf->SetX(210);
$pdf->Cell(4, 4, ': Sakit', 0, 0, 'C', 1);

$pdf->SetFillColor(76, 205, 82, 1);
$pdf->SetX(240);
$pdf->Cell(10, 4, 'LK/K', 0, 0, 'C', 1);
$pdf->SetFillColor(255, 255, 255);
$pdf->SetFont('Times', '', 10);
$pdf->SetX(260);
$pdf->Cell(4, 4, ': Luar Kota', 0, 0, 'C', 1);

$pdf->Output();

