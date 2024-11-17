<?php
//if (!defined('website')) {include("index.php");die();}   

$tahun          = mysqli_real_escape_string($con, $_POST["tahun"]);
$nama           = mysqli_real_escape_string($con, $_POST["nama"]);
$jabatan        = mysqli_real_escape_string($con, $_POST["jabatan"]);
$departemen     = mysqli_real_escape_string($con, $_POST["departemen"]);
$ket            = $_POST['ket'];

$param = "";
for ($i = 0; $i < count($ket); $i++) {

    if ($ket[$i] == 'cut') {
        $param .= '&c=cut';
    } else if ($ket[$i] == 'tel') {
        $param .= '&t=tel';
    } else if ($ket[$i] == 'sak') {
        $param .= '&s=sak';
    } else if ($ket[$i] == 'izi') {
        $param .= '&i=izi';
    } else if ($ket[$i] == 'vis') {
        $param .= '&v=vis';
    } else if ($ket[$i] == 'lk') {
        $param .= '&lk=lk';
    }
}



$jml    = count($ket);

$fltr   = "";
$paramm = "";

if (!empty($nama) && empty($jabatan) && empty($departemen)) {
    $fltr .= "AND a.nama = '" . $nama . "'";
    $paramm .= '&nama=' . $nama . '';
} else if (!empty($nama) && !empty($jabatan) && empty($departemen)) {
    $fltr .= "AND a.nama = '" . $nama . "' AND d.nama_jabatan = '" . $jabatan . "'";
    $paramm .= '&nama=' . $nama . '&jabatan=' . $jabatan . '';
} else if (!empty($nama) && !empty($jabatan) && !empty($departemen)) {
    $fltr .= "AND a.nama = '" . $nama . "' AND d.nama_jabatan = '" . $jabatan . "' AND e.nama_departemen = '" . $departemen . "'";
    $paramm .= '&nama=' . $nama . '&jabatan=' . $jabatan . '&departemen=' . $departemen . '';
} else if (empty($nama) && !empty($jabatan) && !empty($departemen)) {
    $fltr .= "AND d.nama_jabatan = '" . $jabatan . "' AND e.nama_departemen = '" . $departemen . "'";
    $paramm .= '&jabatan=' . $jabatan . '&departemen=' . $departemen . '';
} else if (empty($nama) && empty($jabatan) && !empty($departemen)) {
    $fltr .= "AND e.nama_departemen = '" . $departemen . "'";
    $paramm .= '&departemen=' . $departemen . '';
} else if (empty($nama) && !empty($jabatan) && empty($departemen)) {
    $fltr .= "AND d.nama_jabatan = '" . $jabatan . "'";
    $paramm .= '&jabatan=' . $jabatan . '';
} else if (!empty($nama) && empty($jabatan) && !empty($departemen)) {
    $fltr .= "AND a.nama = '" . $nama . "' AND e.nama_departemen = '" . $departemen . "'";
    $paramm .= '&nama=' . $nama . '&departemen=' . $departemen . '';
}

$query = mysqli_query($con, "SELECT a.nama_lengkap, a.nama_departemen, a.masa_kerja,

a.hak_cuti, a.cut_1, a.cut_2, a.cut_3, a.cut_4, a.cut_5, a.cut_6, a.cut_7, 
a.cut_8, a.cut_9, a.cut_10, a.cut_11, a.cut_12, a.tot_cut,

b.tel_1, b.tel_2, b.tel_3, b.tel_4, b.tel_5, b.tel_6, b.tel_7, 
b.tel_8, b.tel_9, b.tel_10, b.tel_11, b.tel_12, b.tot_tel,

c.sak_1, c.sak_2, c.sak_3, c.sak_4, c.sak_5, c.sak_6, c.sak_7, 
c.sak_8, c.sak_9, c.sak_10, c.sak_11, c.sak_12, c.tot_sak,

d.izi_1, d.izi_2, d.izi_3, d.izi_4, d.izi_5, d.izi_6, d.izi_7, 
d.izi_8, d.izi_9, d.izi_10, d.izi_11, d.izi_12, d.tot_izi,

e.vis_1, e.vis_2, e.vis_3, e.vis_4, e.vis_5, e.vis_6, e.vis_7, 
e.vis_8, e.vis_9, e.vis_10, e.vis_11, e.vis_12, e.tot_vis,

f.lk_1, f.lk_2, f.lk_3, f.lk_4, f.lk_5, f.lk_6, f.lk_7, 
f.lk_8, f.lk_9, f.lk_10, f.lk_11, f.lk_12, f.tot_lk

FROM (   

SELECT a.nama_lengkap, a.nama_jabatan, a.nama_departemen, a.masa_kerja, b.cut_1, c.cut_2, d.cut_3, e.cut_4, f.cut_5, g.cut_6, h.cut_7, 
i.cut_8, j.cut_9, k.cut_10, l.cut_11, m.cut_12, ((o.total_cuti-IFNULL(n.total,0)) - o.cuti_diambil) AS tot_cut, o.total_cuti AS hak_cuti
    FROM (
    
    SELECT a.nama, e.nama_departemen, c.nama_lengkap, d.nama_jabatan, c.masa_kerja FROM tb_absensi_detail a, tb_keterangan b, tb_karyawan c, tb_jabatan d, tb_departemen e 
    WHERE a.id_keterangan = b.id_keterangan AND 
    a.nama = c.username AND c.id_jabatan = d.id_jabatan AND c.id_departemen = e.id_departemen $fltr
    AND YEAR(a.tanggal) = '$tahun' AND c.status = '1' GROUP BY a.nama
    ) AS a LEFT JOIN(
        SELECT COUNT(a.id_keterangan) AS cut_1, a.nama FROM tb_absensi_detail a, tb_keterangan b
        WHERE a.id_keterangan = b.id_keterangan AND MONTH(a.tanggal) = '1' AND YEAR(a.tanggal) = '$tahun' AND b.keterangan = 'CUTI' GROUP BY a.nama 
    ) AS b ON a.nama = b.nama LEFT JOIN (
        SELECT COUNT(a.id_keterangan) AS cut_2, a.nama FROM tb_absensi_detail a, tb_keterangan b
        WHERE a.id_keterangan = b.id_keterangan AND MONTH(a.tanggal) = '2' AND YEAR(a.tanggal) = '$tahun' AND b.keterangan = 'CUTI' GROUP BY a.nama
    ) AS c ON a.nama = c.nama LEFT JOIN (
        SELECT COUNT(a.id_keterangan) AS cut_3, a.nama FROM tb_absensi_detail a, tb_keterangan b
        WHERE a.id_keterangan = b.id_keterangan AND MONTH(a.tanggal) = '3' AND YEAR(a.tanggal) = '$tahun' AND b.keterangan = 'CUTI' GROUP BY a.nama
    ) AS d ON a.nama = d.nama LEFT JOIN (
        SELECT COUNT(a.id_keterangan) AS cut_4, a.nama FROM tb_absensi_detail a, tb_keterangan b
        WHERE a.id_keterangan = b.id_keterangan AND MONTH(a.tanggal) = '4' AND YEAR(a.tanggal) = '$tahun' AND b.keterangan = 'CUTI' GROUP BY a.nama
    ) AS e ON a.nama = e.nama LEFT JOIN (
        SELECT COUNT(a.id_keterangan) AS cut_5, a.nama FROM tb_absensi_detail a, tb_keterangan b
        WHERE a.id_keterangan = b.id_keterangan AND MONTH(a.tanggal) = '5' AND YEAR(a.tanggal) = '$tahun' AND b.keterangan = 'CUTI' GROUP BY a.nama  
    ) AS f ON a.nama = f.nama LEFT JOIN (
        SELECT COUNT(a.id_keterangan) AS cut_6, a.nama FROM tb_absensi_detail a, tb_keterangan b
        WHERE a.id_keterangan = b.id_keterangan AND MONTH(a.tanggal) = '6' AND YEAR(a.tanggal) = '$tahun' AND b.keterangan = 'CUTI' GROUP BY a.nama
    ) AS g ON a.nama = g.nama LEFT JOIN (
        SELECT COUNT(a.id_keterangan) AS cut_7, a.nama FROM tb_absensi_detail a, tb_keterangan b
        WHERE a.id_keterangan = b.id_keterangan AND MONTH(a.tanggal) = '7' AND YEAR(a.tanggal) = '$tahun' AND b.keterangan = 'CUTI' GROUP BY a.nama
    ) AS h ON a.nama = h.nama LEFT JOIN (   
        SELECT COUNT(a.id_keterangan) AS cut_8, a.nama FROM tb_absensi_detail a, tb_keterangan b
        WHERE a.id_keterangan = b.id_keterangan AND MONTH(a.tanggal) = '8' AND YEAR(a.tanggal) = '$tahun' AND b.keterangan = 'CUTI' GROUP BY a.nama
    ) AS i ON a.nama = i.nama LEFT JOIN (   
        SELECT COUNT(a.id_keterangan) AS cut_9, a.nama FROM tb_absensi_detail a, tb_keterangan b
        WHERE a.id_keterangan = b.id_keterangan AND MONTH(a.tanggal) = '9' AND YEAR(a.tanggal) = '$tahun' AND b.keterangan = 'CUTI' GROUP BY a.nama  
    ) AS j ON a.nama = j.nama LEFT JOIN (   
        SELECT COUNT(a.id_keterangan) AS cut_10, a.nama FROM tb_absensi_detail a, tb_keterangan b
        WHERE a.id_keterangan = b.id_keterangan AND MONTH(a.tanggal) = '10' AND YEAR(a.tanggal) = '$tahun' AND b.keterangan = 'CUTI' GROUP BY a.nama 
    ) AS k ON a.nama = k.nama LEFT JOIN (   
        SELECT COUNT(a.id_keterangan) AS cut_11, a.nama FROM tb_absensi_detail a, tb_keterangan b
        WHERE a.id_keterangan = b.id_keterangan AND MONTH(a.tanggal) = '11' AND YEAR(a.tanggal) = '$tahun' AND b.keterangan = 'CUTI' GROUP BY a.nama 
    ) AS l ON a.nama = l.nama LEFT JOIN (   
        SELECT COUNT(a.id_keterangan) AS cut_12, a.nama FROM tb_absensi_detail a, tb_keterangan b
        WHERE a.id_keterangan = b.id_keterangan AND MONTH(a.tanggal) = '12' AND YEAR(a.tanggal) = '$tahun' AND b.keterangan = 'CUTI' GROUP BY a.nama 
    ) AS m ON a.nama = m.nama LEFT JOIN (
    SELECT a.nama, b.total FROM (
    SELECT DISTINCT nama FROM tb_absensi_detail ) AS a LEFT OUTER JOIN (
    SELECT a.nama, COUNT(a.id_keterangan) AS total FROM tb_absensi_detail a LEFT JOIN tb_keterangan b ON a.id_keterangan = b.id_keterangan 
    WHERE YEAR(a.tanggal) = '$tahun' AND b.keterangan = 'CUTI' GROUP BY a.nama
        ) AS b ON a.nama = b.nama 
    )AS n ON a.nama = n.nama LEFT JOIN (
    SELECT DISTINCT a.nama, c.hak_cuti AS total_cuti, c.cuti_diambil FROM tb_absensi_detail a, tb_karyawan b, tb_absensi c 
    WHERE a.nama = b.username AND b.id_karyawan = c.id_karyawan 
    AND YEAR(a.tanggal) = '$tahun' AND c.tahun = '$tahun'
    ) AS o ON a.nama = o.nama ORDER BY a.nama_departemen
    
    ) AS a LEFT OUTER JOIN (
    
SELECT DISTINCT a.nama_lengkap, a.nama_jabatan, a.nama_departemen, b.tel_1, c.tel_2, d.tel_3, e.tel_4, f.tel_5, g.tel_6, h.tel_7, 
i.tel_8, j.tel_9, k.tel_10, l.tel_11, m.tel_12, o.total_telat+IFNULL(n.total,0) AS tot_tel
    FROM (
    SELECT a.nama, e.nama_departemen, c.nama_lengkap, d.nama_jabatan FROM tb_absensi_detail a, tb_keterangan b, tb_karyawan c, tb_jabatan d, tb_departemen e WHERE a.id_keterangan = b.id_keterangan AND
    a.nama = c.username AND c.id_jabatan = d.id_jabatan AND c.id_departemen = e.id_departemen $fltr
    AND YEAR(a.tanggal) = '$tahun' AND c.status = '1' GROUP BY a.nama
    ) AS a LEFT JOIN(
        SELECT COUNT(a.id_keterangan) AS tel_1, a.nama FROM tb_absensi_detail a, tb_keterangan b
        WHERE a.id_keterangan = b.id_keterangan AND MONTH(a.tanggal) = '1' AND YEAR(a.tanggal) = '$tahun' AND b.keterangan = 'TELAT' GROUP BY a.nama 
    ) AS b ON a.nama = b.nama LEFT JOIN (
        SELECT COUNT(a.id_keterangan) AS tel_2, a.nama FROM tb_absensi_detail a, tb_keterangan b
        WHERE a.id_keterangan = b.id_keterangan AND MONTH(a.tanggal) = '2' AND YEAR(a.tanggal) = '$tahun' AND b.keterangan = 'TELAT' GROUP BY a.nama
    ) AS c ON a.nama = c.nama LEFT JOIN (
        SELECT COUNT(a.id_keterangan) AS tel_3, a.nama FROM tb_absensi_detail a, tb_keterangan b
        WHERE a.id_keterangan = b.id_keterangan AND MONTH(a.tanggal) = '3' AND YEAR(a.tanggal) = '$tahun' AND b.keterangan = 'TELAT' GROUP BY a.nama
    ) AS d ON a.nama = d.nama LEFT JOIN (
        SELECT COUNT(a.id_keterangan) AS tel_4, a.nama FROM tb_absensi_detail a, tb_keterangan b
        WHERE a.id_keterangan = b.id_keterangan AND MONTH(a.tanggal) = '4' AND YEAR(a.tanggal) = '$tahun' AND b.keterangan = 'TELAT' GROUP BY a.nama
    ) AS e ON a.nama = e.nama LEFT JOIN (
        SELECT COUNT(a.id_keterangan) AS tel_5, a.nama FROM tb_absensi_detail a, tb_keterangan b
        WHERE a.id_keterangan = b.id_keterangan AND MONTH(a.tanggal) = '5' AND YEAR(a.tanggal) = '$tahun' AND b.keterangan = 'TELAT' GROUP BY a.nama  
    ) AS f ON a.nama = f.nama LEFT JOIN (
        SELECT COUNT(a.id_keterangan) AS tel_6, a.nama FROM tb_absensi_detail a, tb_keterangan b
        WHERE a.id_keterangan = b.id_keterangan AND MONTH(a.tanggal) = '6' AND YEAR(a.tanggal) = '$tahun' AND b.keterangan = 'TELAT' GROUP BY a.nama
    ) AS g ON a.nama = g.nama LEFT JOIN (
        SELECT COUNT(a.id_keterangan) AS tel_7, a.nama FROM tb_absensi_detail a, tb_keterangan b
        WHERE a.id_keterangan = b.id_keterangan AND MONTH(a.tanggal) = '7' AND YEAR(a.tanggal) = '$tahun' AND b.keterangan = 'TELAT' GROUP BY a.nama
    ) AS h ON a.nama = h.nama LEFT JOIN (   
        SELECT COUNT(a.id_keterangan) AS tel_8, a.nama FROM tb_absensi_detail a, tb_keterangan b
        WHERE a.id_keterangan = b.id_keterangan AND MONTH(a.tanggal) = '8' AND YEAR(a.tanggal) = '$tahun' AND b.keterangan = 'TELAT' GROUP BY a.nama
    ) AS i ON a.nama = i.nama LEFT JOIN (   
        SELECT COUNT(a.id_keterangan) AS tel_9, a.nama FROM tb_absensi_detail a, tb_keterangan b
        WHERE a.id_keterangan = b.id_keterangan AND MONTH(a.tanggal) = '9' AND YEAR(a.tanggal) = '$tahun' AND b.keterangan = 'TELAT' GROUP BY a.nama  
    ) AS j ON a.nama = j.nama LEFT JOIN (   
        SELECT COUNT(a.id_keterangan) AS tel_10, a.nama FROM tb_absensi_detail a, tb_keterangan b
        WHERE a.id_keterangan = b.id_keterangan AND MONTH(a.tanggal) = '10' AND YEAR(a.tanggal) = '$tahun' AND b.keterangan = 'TELAT' GROUP BY a.nama 
    ) AS k ON a.nama = k.nama LEFT JOIN (   
        SELECT COUNT(a.id_keterangan) AS tel_11, a.nama FROM tb_absensi_detail a, tb_keterangan b
        WHERE a.id_keterangan = b.id_keterangan AND MONTH(a.tanggal) = '11' AND YEAR(a.tanggal) = '$tahun' AND b.keterangan = 'TELAT' GROUP BY a.nama 
    ) AS l ON a.nama = l.nama LEFT JOIN (   
        SELECT COUNT(a.id_keterangan) AS tel_12, a.nama FROM tb_absensi_detail a, tb_keterangan b
        WHERE a.id_keterangan = b.id_keterangan AND MONTH(a.tanggal) = '12' AND YEAR(a.tanggal) = '$tahun' AND b.keterangan = 'TELAT' GROUP BY a.nama 
    ) AS m ON a.nama = m.nama LEFT JOIN (
    SELECT DISTINCT a.nama, COUNT(a.id_keterangan) AS total FROM tb_absensi_detail a, tb_keterangan b WHERE a.id_keterangan = b.id_keterangan 
        AND YEAR(a.tanggal) = '$tahun' AND b.keterangan = 'TELAT' GROUP BY a.nama
    )AS n ON a.nama = n.nama LEFT JOIN (
    SELECT DISTINCT a.nama, c.telat AS total_telat FROM tb_absensi_detail a, tb_karyawan b, tb_absensi c WHERE a.nama = b.username AND b.id_karyawan = c.id_karyawan 
    AND YEAR(a.tanggal) = '$tahun' AND c.tahun = '$tahun'
    ) AS o ON a.nama = o.nama ORDER BY a.nama_departemen
    
    ) AS b ON a.nama_lengkap = b.nama_lengkap LEFT OUTER JOIN(

SELECT DISTINCT a.nama_lengkap, a.nama_jabatan, a.nama_departemen, b.sak_1, c.sak_2, d.sak_3, e.sak_4, f.sak_5, g.sak_6, h.sak_7, i.sak_8, j.sak_9, k.sak_10, l.sak_11, 
m.sak_12, o.total_sakit+IFNULL(n.total,0) AS tot_sak
    FROM (
    SELECT DISTINCT a.nama, e.nama_departemen, c.nama_lengkap, d.nama_jabatan FROM tb_absensi_detail a, tb_keterangan b, tb_karyawan c, tb_jabatan d, tb_departemen e WHERE a.id_keterangan = b.id_keterangan AND
    a.nama = c.username AND c.id_jabatan = d.id_jabatan AND c.id_departemen = e.id_departemen $fltr
    AND YEAR(a.tanggal) = '$tahun' AND c.status = '1' GROUP BY a.nama
    ) AS a LEFT JOIN(
        SELECT COUNT(a.id_keterangan) AS sak_1, a.nama FROM tb_absensi_detail a, tb_keterangan b
        WHERE a.id_keterangan = b.id_keterangan AND MONTH(a.tanggal) = '1' AND YEAR(a.tanggal) = '$tahun' AND b.keterangan = 'SAKIT' GROUP BY a.nama 
    ) AS b ON a.nama = b.nama LEFT JOIN (
        SELECT COUNT(a.id_keterangan) AS sak_2, a.nama FROM tb_absensi_detail a, tb_keterangan b
        WHERE a.id_keterangan = b.id_keterangan AND MONTH(a.tanggal) = '2' AND YEAR(a.tanggal) = '$tahun' AND b.keterangan = 'SAKIT' GROUP BY a.nama
    ) AS c ON a.nama = c.nama LEFT JOIN (
        SELECT COUNT(a.id_keterangan) AS sak_3, a.nama FROM tb_absensi_detail a, tb_keterangan b
        WHERE a.id_keterangan = b.id_keterangan AND MONTH(a.tanggal) = '3' AND YEAR(a.tanggal) = '$tahun' AND b.keterangan = 'SAKIT' GROUP BY a.nama
    ) AS d ON a.nama = d.nama LEFT JOIN (
        SELECT COUNT(a.id_keterangan) AS sak_4, a.nama FROM tb_absensi_detail a, tb_keterangan b
        WHERE a.id_keterangan = b.id_keterangan AND MONTH(a.tanggal) = '4' AND YEAR(a.tanggal) = '$tahun' AND b.keterangan = 'SAKIT' GROUP BY a.nama
    ) AS e ON a.nama = e.nama LEFT JOIN (
        SELECT COUNT(a.id_keterangan) AS sak_5, a.nama FROM tb_absensi_detail a, tb_keterangan b
        WHERE a.id_keterangan = b.id_keterangan AND MONTH(a.tanggal) = '5' AND YEAR(a.tanggal) = '$tahun' AND b.keterangan = 'SAKIT' GROUP BY a.nama  
    ) AS f ON a.nama = f.nama LEFT JOIN (
        SELECT COUNT(a.id_keterangan) AS sak_6, a.nama FROM tb_absensi_detail a, tb_keterangan b
        WHERE a.id_keterangan = b.id_keterangan AND MONTH(a.tanggal) = '6' AND YEAR(a.tanggal) = '$tahun' AND b.keterangan = 'SAKIT' GROUP BY a.nama
    ) AS g ON a.nama = g.nama LEFT JOIN (
        SELECT COUNT(a.id_keterangan) AS sak_7, a.nama FROM tb_absensi_detail a, tb_keterangan b
        WHERE a.id_keterangan = b.id_keterangan AND MONTH(a.tanggal) = '7' AND YEAR(a.tanggal) = '$tahun' AND b.keterangan = 'SAKIT' GROUP BY a.nama
    ) AS h ON a.nama = h.nama LEFT JOIN (   
        SELECT COUNT(a.id_keterangan) AS sak_8, a.nama FROM tb_absensi_detail a, tb_keterangan b
        WHERE a.id_keterangan = b.id_keterangan AND MONTH(a.tanggal) = '8' AND YEAR(a.tanggal) = '$tahun' AND b.keterangan = 'SAKIT' GROUP BY a.nama
    ) AS i ON a.nama = i.nama LEFT JOIN (   
        SELECT COUNT(a.id_keterangan) AS sak_9, a.nama FROM tb_absensi_detail a, tb_keterangan b
        WHERE a.id_keterangan = b.id_keterangan AND MONTH(a.tanggal) = '9' AND YEAR(a.tanggal) = '$tahun' AND b.keterangan = 'SAKIT' GROUP BY a.nama  
    ) AS j ON a.nama = j.nama LEFT JOIN (   
        SELECT COUNT(a.id_keterangan) AS sak_10, a.nama FROM tb_absensi_detail a, tb_keterangan b
        WHERE a.id_keterangan = b.id_keterangan AND MONTH(a.tanggal) = '10' AND YEAR(a.tanggal) = '$tahun' AND b.keterangan = 'SAKIT' GROUP BY a.nama 
    ) AS k ON a.nama = k.nama LEFT JOIN (   
        SELECT COUNT(a.id_keterangan) AS sak_11, a.nama FROM tb_absensi_detail a, tb_keterangan b
        WHERE a.id_keterangan = b.id_keterangan AND MONTH(a.tanggal) = '11' AND YEAR(a.tanggal) = '$tahun' AND b.keterangan = 'SAKIT' GROUP BY a.nama 
    ) AS l ON a.nama = l.nama LEFT JOIN (   
        SELECT COUNT(a.id_keterangan) AS sak_12, a.nama FROM tb_absensi_detail a, tb_keterangan b
        WHERE a.id_keterangan = b.id_keterangan AND MONTH(a.tanggal) = '12' AND YEAR(a.tanggal) = '$tahun' AND b.keterangan = 'SAKIT' GROUP BY a.nama 
    ) AS m ON a.nama = m.nama LEFT JOIN (
    SELECT DISTINCT a.nama, COUNT(a.id_keterangan) AS total FROM tb_absensi_detail a, tb_keterangan b WHERE a.id_keterangan = b.id_keterangan 
        AND YEAR(a.tanggal) = '$tahun' AND b.keterangan = 'SAKIT' GROUP BY a.nama
    )AS n ON a.nama = n.nama LEFT JOIN (
    SELECT DISTINCT a.nama, c.sakit AS total_sakit FROM tb_absensi_detail a, tb_karyawan b, tb_absensi c WHERE a.nama = b.username AND b.id_karyawan = c.id_karyawan 
    AND YEAR(a.tanggal) = '$tahun' AND c.tahun = '$tahun'
    ) AS o ON a.nama = o.nama ORDER BY a.nama_departemen
    
    ) AS c ON a.nama_lengkap = c.nama_lengkap LEFT OUTER JOIN (

SELECT DISTINCT a.nama_lengkap, a.nama_jabatan, a.nama_departemen, b.izi_1, c.izi_2, d.izi_3, e.izi_4, f.izi_5, g.izi_6, h.izi_7, i.izi_8, j.izi_9, k.izi_10, l.izi_11, 
m.izi_12, o.total_siang+IFNULL(n.total,0) AS tot_izi
    FROM (
    SELECT DISTINCT a.nama, e.nama_departemen, c.nama_lengkap, d.nama_jabatan FROM tb_absensi_detail a, tb_keterangan b, tb_karyawan c, tb_jabatan d, tb_departemen e WHERE a.id_keterangan = b.id_keterangan AND
    a.nama = c.username AND c.id_jabatan = d.id_jabatan AND c.id_departemen = e.id_departemen $fltr
    AND YEAR(a.tanggal) = '$tahun' AND c.status = '1' GROUP BY a.nama
    ) AS a LEFT JOIN(
        SELECT COUNT(a.id_keterangan) AS izi_1, a.nama FROM tb_absensi_detail a, tb_keterangan b
        WHERE a.id_keterangan = b.id_keterangan AND MONTH(a.tanggal) = '1' AND YEAR(a.tanggal) = '$tahun' AND b.keterangan = 'IZIN SIANG' GROUP BY a.nama 
    ) AS b ON a.nama = b.nama LEFT JOIN (
        SELECT COUNT(a.id_keterangan) AS izi_2, a.nama FROM tb_absensi_detail a, tb_keterangan b
        WHERE a.id_keterangan = b.id_keterangan AND MONTH(a.tanggal) = '2' AND YEAR(a.tanggal) = '$tahun' AND b.keterangan = 'IZIN SIANG' GROUP BY a.nama
    ) AS c ON a.nama = c.nama LEFT JOIN (
        SELECT COUNT(a.id_keterangan) AS izi_3, a.nama FROM tb_absensi_detail a, tb_keterangan b
        WHERE a.id_keterangan = b.id_keterangan AND MONTH(a.tanggal) = '3' AND YEAR(a.tanggal) = '$tahun' AND b.keterangan = 'IZIN SIANG' GROUP BY a.nama
    ) AS d ON a.nama = d.nama LEFT JOIN (
        SELECT COUNT(a.id_keterangan) AS izi_4, a.nama FROM tb_absensi_detail a, tb_keterangan b
        WHERE a.id_keterangan = b.id_keterangan AND MONTH(a.tanggal) = '4' AND YEAR(a.tanggal) = '$tahun' AND b.keterangan = 'IZIN SIANG' GROUP BY a.nama
    ) AS e ON a.nama = e.nama LEFT JOIN (
        SELECT COUNT(a.id_keterangan) AS izi_5, a.nama FROM tb_absensi_detail a, tb_keterangan b
        WHERE a.id_keterangan = b.id_keterangan AND MONTH(a.tanggal) = '5' AND YEAR(a.tanggal) = '$tahun' AND b.keterangan = 'IZIN SIANG' GROUP BY a.nama  
    ) AS f ON a.nama = f.nama LEFT JOIN (
        SELECT COUNT(a.id_keterangan) AS izi_6, a.nama FROM tb_absensi_detail a, tb_keterangan b
        WHERE a.id_keterangan = b.id_keterangan AND MONTH(a.tanggal) = '6' AND YEAR(a.tanggal) = '$tahun' AND b.keterangan = 'IZIN SIANG' GROUP BY a.nama
    ) AS g ON a.nama = g.nama LEFT JOIN (
        SELECT COUNT(a.id_keterangan) AS izi_7, a.nama FROM tb_absensi_detail a, tb_keterangan b
        WHERE a.id_keterangan = b.id_keterangan AND MONTH(a.tanggal) = '7' AND YEAR(a.tanggal) = '$tahun' AND b.keterangan = 'IZIN SIANG' GROUP BY a.nama
    ) AS h ON a.nama = h.nama LEFT JOIN (   
        SELECT COUNT(a.id_keterangan) AS izi_8, a.nama FROM tb_absensi_detail a, tb_keterangan b
        WHERE a.id_keterangan = b.id_keterangan AND MONTH(a.tanggal) = '8' AND YEAR(a.tanggal) = '$tahun' AND b.keterangan = 'IZIN SIANG' GROUP BY a.nama
    ) AS i ON a.nama = i.nama LEFT JOIN (   
        SELECT COUNT(a.id_keterangan) AS izi_9, a.nama FROM tb_absensi_detail a, tb_keterangan b
        WHERE a.id_keterangan = b.id_keterangan AND MONTH(a.tanggal) = '9' AND YEAR(a.tanggal) = '$tahun' AND b.keterangan = 'IZIN SIANG' GROUP BY a.nama  
    ) AS j ON a.nama = j.nama LEFT JOIN (   
        SELECT COUNT(a.id_keterangan) AS izi_10, a.nama FROM tb_absensi_detail a, tb_keterangan b
        WHERE a.id_keterangan = b.id_keterangan AND MONTH(a.tanggal) = '10' AND YEAR(a.tanggal) = '$tahun' AND b.keterangan = 'IZIN SIANG' GROUP BY a.nama 
    ) AS k ON a.nama = k.nama LEFT JOIN (   
        SELECT COUNT(a.id_keterangan) AS izi_11, a.nama FROM tb_absensi_detail a, tb_keterangan b
        WHERE a.id_keterangan = b.id_keterangan AND MONTH(a.tanggal) = '11' AND YEAR(a.tanggal) = '$tahun' AND b.keterangan = 'IZIN SIANG' GROUP BY a.nama 
    ) AS l ON a.nama = l.nama LEFT JOIN (   
        SELECT COUNT(a.id_keterangan) AS izi_12, a.nama FROM tb_absensi_detail a, tb_keterangan b
        WHERE a.id_keterangan = b.id_keterangan AND MONTH(a.tanggal) = '12' AND YEAR(a.tanggal) = '$tahun' AND b.keterangan = 'IZIN SIANG' GROUP BY a.nama 
    ) AS m ON a.nama = m.nama LEFT JOIN (
    SELECT DISTINCT a.nama, COUNT(a.id_keterangan) AS total FROM tb_absensi_detail a, tb_keterangan b WHERE a.id_keterangan = b.id_keterangan 
        AND YEAR(a.tanggal) = '$tahun' AND b.keterangan = 'IZIN SIANG' GROUP BY a.nama
    )AS n ON a.nama = n.nama LEFT JOIN (
    SELECT DISTINCT a.nama, c.izin_siang AS total_siang FROM tb_absensi_detail a, tb_karyawan b, tb_absensi c WHERE a.nama = b.username AND b.id_karyawan = c.id_karyawan 
    AND YEAR(a.tanggal) = '$tahun' AND c.tahun = '$tahun'
    ) AS o ON a.nama = o.nama ORDER BY a.nama_departemen
    
    ) AS d ON a.nama_lengkap = d.nama_lengkap LEFT OUTER JOIN (
 
SELECT DISTINCT a.nama_lengkap, a.nama_jabatan, a.nama_departemen, b.vis_1, c.vis_2, d.vis_3, e.vis_4, f.vis_5, g.vis_6, h.vis_7, i.vis_8, j.vis_9, k.vis_10, l.vis_11, 
m.vis_12, o.total_visit+IFNULL(n.total,0) AS tot_vis
    FROM (
    SELECT DISTINCT a.nama, e.nama_departemen, c.nama_lengkap, d.nama_jabatan FROM tb_absensi_detail a, tb_keterangan b, tb_karyawan c, tb_jabatan d, tb_departemen e WHERE a.id_keterangan = b.id_keterangan AND
    a.nama = c.username AND c.id_jabatan = d.id_jabatan AND c.id_departemen = e.id_departemen $fltr
    AND YEAR(a.tanggal) = '$tahun' AND c.status = '1' GROUP BY a.nama
    ) AS a LEFT JOIN(
        SELECT COUNT(a.id_keterangan) AS vis_1, a.nama FROM tb_absensi_detail a, tb_keterangan b
        WHERE a.id_keterangan = b.id_keterangan AND MONTH(a.tanggal) = '1' AND YEAR(a.tanggal) = '$tahun' AND b.keterangan = 'VISIT' GROUP BY a.nama 
    ) AS b ON a.nama = b.nama LEFT JOIN (
        SELECT COUNT(a.id_keterangan) AS vis_2, a.nama FROM tb_absensi_detail a, tb_keterangan b
        WHERE a.id_keterangan = b.id_keterangan AND MONTH(a.tanggal) = '2' AND YEAR(a.tanggal) = '$tahun' AND b.keterangan = 'VISIT' GROUP BY a.nama
    ) AS c ON a.nama = c.nama LEFT JOIN (
        SELECT COUNT(a.id_keterangan) AS vis_3, a.nama FROM tb_absensi_detail a, tb_keterangan b
        WHERE a.id_keterangan = b.id_keterangan AND MONTH(a.tanggal) = '3' AND YEAR(a.tanggal) = '$tahun' AND b.keterangan = 'VISIT' GROUP BY a.nama
    ) AS d ON a.nama = d.nama LEFT JOIN (
        SELECT COUNT(a.id_keterangan) AS vis_4, a.nama FROM tb_absensi_detail a, tb_keterangan b
        WHERE a.id_keterangan = b.id_keterangan AND MONTH(a.tanggal) = '4' AND YEAR(a.tanggal) = '$tahun' AND b.keterangan = 'VISIT' GROUP BY a.nama
    ) AS e ON a.nama = e.nama LEFT JOIN (
        SELECT COUNT(a.id_keterangan) AS vis_5, a.nama FROM tb_absensi_detail a, tb_keterangan b
        WHERE a.id_keterangan = b.id_keterangan AND MONTH(a.tanggal) = '5' AND YEAR(a.tanggal) = '$tahun' AND b.keterangan = 'VISIT' GROUP BY a.nama  
    ) AS f ON a.nama = f.nama LEFT JOIN (
        SELECT COUNT(a.id_keterangan) AS vis_6, a.nama FROM tb_absensi_detail a, tb_keterangan b
        WHERE a.id_keterangan = b.id_keterangan AND MONTH(a.tanggal) = '6' AND YEAR(a.tanggal) = '$tahun' AND b.keterangan = 'VISIT' GROUP BY a.nama
    ) AS g ON a.nama = g.nama LEFT JOIN (
        SELECT COUNT(a.id_keterangan) AS vis_7, a.nama FROM tb_absensi_detail a, tb_keterangan b
        WHERE a.id_keterangan = b.id_keterangan AND MONTH(a.tanggal) = '7' AND YEAR(a.tanggal) = '$tahun' AND b.keterangan = 'VISIT' GROUP BY a.nama
    ) AS h ON a.nama = h.nama LEFT JOIN (   
        SELECT COUNT(a.id_keterangan) AS vis_8, a.nama FROM tb_absensi_detail a, tb_keterangan b
        WHERE a.id_keterangan = b.id_keterangan AND MONTH(a.tanggal) = '8' AND YEAR(a.tanggal) = '$tahun' AND b.keterangan = 'VISIT' GROUP BY a.nama
    ) AS i ON a.nama = i.nama LEFT JOIN (   
        SELECT COUNT(a.id_keterangan) AS vis_9, a.nama FROM tb_absensi_detail a, tb_keterangan b
        WHERE a.id_keterangan = b.id_keterangan AND MONTH(a.tanggal) = '9' AND YEAR(a.tanggal) = '$tahun' AND b.keterangan = 'VISIT' GROUP BY a.nama  
    ) AS j ON a.nama = j.nama LEFT JOIN (   
        SELECT COUNT(a.id_keterangan) AS vis_10, a.nama FROM tb_absensi_detail a, tb_keterangan b
        WHERE a.id_keterangan = b.id_keterangan AND MONTH(a.tanggal) = '10' AND YEAR(a.tanggal) = '$tahun' AND b.keterangan = 'VISIT' GROUP BY a.nama 
    ) AS k ON a.nama = k.nama LEFT JOIN (   
        SELECT COUNT(a.id_keterangan) AS vis_11, a.nama FROM tb_absensi_detail a, tb_keterangan b
        WHERE a.id_keterangan = b.id_keterangan AND MONTH(a.tanggal) = '11' AND YEAR(a.tanggal) = '$tahun' AND b.keterangan = 'VISIT' GROUP BY a.nama 
    ) AS l ON a.nama = l.nama LEFT JOIN (   
        SELECT COUNT(a.id_keterangan) AS vis_12, a.nama FROM tb_absensi_detail a, tb_keterangan b
        WHERE a.id_keterangan = b.id_keterangan AND MONTH(a.tanggal) = '12' AND YEAR(a.tanggal) = '$tahun' AND b.keterangan = 'VISIT' GROUP BY a.nama 
    ) AS m ON a.nama = m.nama LEFT JOIN (
    SELECT DISTINCT a.nama, COUNT(a.id_keterangan) AS total FROM tb_absensi_detail a, tb_keterangan b WHERE a.id_keterangan = b.id_keterangan 
        AND YEAR(a.tanggal) = '$tahun' AND b.keterangan = 'VISIT' GROUP BY a.nama
    )AS n ON a.nama = n.nama LEFT JOIN (
    SELECT DISTINCT a.nama, c.visit AS total_visit FROM tb_absensi_detail a, tb_karyawan b, tb_absensi c WHERE a.nama = b.username AND b.id_karyawan = c.id_karyawan 
    AND YEAR(a.tanggal) = '$tahun' AND c.tahun = '$tahun'
    ) AS o ON a.nama = o.nama ORDER BY a.nama_departemen
    
    ) AS e ON a.nama_lengkap = e.nama_lengkap LEFT OUTER JOIN (
    
SELECT DISTINCT a.nama_lengkap, a.nama_jabatan, a.nama_departemen, b.lk_1, c.lk_2, d.lk_3, e.lk_4, f.lk_5, g.lk_6, h.lk_7, i.lk_8, j.lk_9, k.lk_10, l.lk_11, 
m.lk_12, o.total_lk+IFNULL(n.total,0) AS tot_lk
    FROM (
    SELECT DISTINCT a.nama, e.nama_departemen, c.nama_lengkap, d.nama_jabatan FROM tb_absensi_detail a, tb_keterangan b, tb_karyawan c, tb_jabatan d, tb_departemen e WHERE a.id_keterangan = b.id_keterangan AND
    a.nama = c.username AND c.id_jabatan = d.id_jabatan AND c.id_departemen = e.id_departemen $fltr
    AND YEAR(a.tanggal) = '$tahun' AND c.status = '1' GROUP BY a.nama
    ) AS a LEFT JOIN(
        SELECT COUNT(a.id_keterangan) AS lk_1, a.nama FROM tb_absensi_detail a, tb_keterangan b
        WHERE a.id_keterangan = b.id_keterangan AND MONTH(a.tanggal) = '1' AND YEAR(a.tanggal) = '$tahun' AND b.keterangan = 'LUAR KOTA' GROUP BY a.nama 
    ) AS b ON a.nama = b.nama LEFT JOIN (
        SELECT COUNT(a.id_keterangan) AS lk_2, a.nama FROM tb_absensi_detail a, tb_keterangan b
        WHERE a.id_keterangan = b.id_keterangan AND MONTH(a.tanggal) = '2' AND YEAR(a.tanggal) = '$tahun' AND b.keterangan = 'LUAR KOTA' GROUP BY a.nama
    ) AS c ON a.nama = c.nama LEFT JOIN (
        SELECT COUNT(a.id_keterangan) AS lk_3, a.nama FROM tb_absensi_detail a, tb_keterangan b
        WHERE a.id_keterangan = b.id_keterangan AND MONTH(a.tanggal) = '3' AND YEAR(a.tanggal) = '$tahun' AND b.keterangan = 'LUAR KOTA' GROUP BY a.nama
    ) AS d ON a.nama = d.nama LEFT JOIN (
        SELECT COUNT(a.id_keterangan) AS lk_4, a.nama FROM tb_absensi_detail a, tb_keterangan b
        WHERE a.id_keterangan = b.id_keterangan AND MONTH(a.tanggal) = '4' AND YEAR(a.tanggal) = '$tahun' AND b.keterangan = 'LUAR KOTA' GROUP BY a.nama
    ) AS e ON a.nama = e.nama LEFT JOIN (
        SELECT COUNT(a.id_keterangan) AS lk_5, a.nama FROM tb_absensi_detail a, tb_keterangan b
        WHERE a.id_keterangan = b.id_keterangan AND MONTH(a.tanggal) = '5' AND YEAR(a.tanggal) = '$tahun' AND b.keterangan = 'LUAR KOTA' GROUP BY a.nama  
    ) AS f ON a.nama = f.nama LEFT JOIN (
        SELECT COUNT(a.id_keterangan) AS lk_6, a.nama FROM tb_absensi_detail a, tb_keterangan b
        WHERE a.id_keterangan = b.id_keterangan AND MONTH(a.tanggal) = '6' AND YEAR(a.tanggal) = '$tahun' AND b.keterangan = 'LUAR KOTA' GROUP BY a.nama
    ) AS g ON a.nama = g.nama LEFT JOIN (
        SELECT COUNT(a.id_keterangan) AS lk_7, a.nama FROM tb_absensi_detail a, tb_keterangan b
        WHERE a.id_keterangan = b.id_keterangan AND MONTH(a.tanggal) = '7' AND YEAR(a.tanggal) = '$tahun' AND b.keterangan = 'LUAR KOTA' GROUP BY a.nama
    ) AS h ON a.nama = h.nama LEFT JOIN (   
        SELECT COUNT(a.id_keterangan) AS lk_8, a.nama FROM tb_absensi_detail a, tb_keterangan b
        WHERE a.id_keterangan = b.id_keterangan AND MONTH(a.tanggal) = '8' AND YEAR(a.tanggal) = '$tahun' AND b.keterangan = 'LUAR KOTA' GROUP BY a.nama
    ) AS i ON a.nama = i.nama LEFT JOIN (   
        SELECT COUNT(a.id_keterangan) AS lk_9, a.nama FROM tb_absensi_detail a, tb_keterangan b
        WHERE a.id_keterangan = b.id_keterangan AND MONTH(a.tanggal) = '9' AND YEAR(a.tanggal) = '$tahun' AND b.keterangan = 'LUAR KOTA' GROUP BY a.nama  
    ) AS j ON a.nama = j.nama LEFT JOIN (   
        SELECT COUNT(a.id_keterangan) AS lk_10, a.nama FROM tb_absensi_detail a, tb_keterangan b
        WHERE a.id_keterangan = b.id_keterangan AND MONTH(a.tanggal) = '10' AND YEAR(a.tanggal) = '$tahun' AND b.keterangan = 'LUAR KOTA' GROUP BY a.nama 
    ) AS k ON a.nama = k.nama LEFT JOIN (   
        SELECT COUNT(a.id_keterangan) AS lk_11, a.nama FROM tb_absensi_detail a, tb_keterangan b
        WHERE a.id_keterangan = b.id_keterangan AND MONTH(a.tanggal) = '11' AND YEAR(a.tanggal) = '$tahun' AND b.keterangan = 'LUAR KOTA' GROUP BY a.nama 
    ) AS l ON a.nama = l.nama LEFT JOIN (   
        SELECT COUNT(a.id_keterangan) AS lk_12, a.nama FROM tb_absensi_detail a, tb_keterangan b
        WHERE a.id_keterangan = b.id_keterangan AND MONTH(a.tanggal) = '12' AND YEAR(a.tanggal) = '$tahun' AND b.keterangan = 'LUAR KOTA' GROUP BY a.nama 
    ) AS m ON a.nama = m.nama LEFT JOIN (
    SELECT DISTINCT a.nama, COUNT(a.id_keterangan) AS total FROM tb_absensi_detail a, tb_keterangan b WHERE a.id_keterangan = b.id_keterangan 
        AND YEAR(a.tanggal) = '$tahun' AND b.keterangan = 'LUAR KOTA' GROUP BY a.nama
    )AS n ON a.nama = n.nama LEFT JOIN (
    SELECT DISTINCT a.nama, c.luar_kota AS total_lk FROM tb_absensi_detail a, tb_karyawan b, tb_absensi c WHERE a.nama = b.username AND b.id_karyawan = c.id_karyawan 
    AND YEAR(a.tanggal) = '$tahun' AND c.tahun = '$tahun'
    ) AS o ON a.nama = o.nama 

    ) AS f ON a.nama_lengkap = f.nama_lengkap ORDER BY a.nama_departemen ASC");

?>

<div style="background:#fff;height:400px;overflow:scroll;width:auto">
    <a href="<?php echo $BaseUrl; ?>/models/print-rekap-absensi.php?thn=<?php echo $tahun . '' . $param . '&jml=' . $jml . '' . $paramm; ?>" target="_blank" style="float:right;margin-right:10px"><button class="btn btn-primary btn-sm"><i class="fa fa-print"></i> Print</button></a>
    <br>
    <hr>
    <center>
        <h3 style="font-size:18px;">Daftar Absensi Karyawan / Tahun</h3>
        <h2 style="font-size:20px;font-weight:bold;line-height: 0;">Nama Perusahaan Anda</h2>
        <p style="line-height:2">Alamat Lengkap Kantor Anda, Jakarta</p>
    </center>
    <hr size="5" background="red" width="60%">
    <b>Tahun : </b><?php echo $tahun; ?>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <b>Total : </b><?php echo mysqli_num_rows($query); ?>
    <table class="table table-bordered table-sm">
        <tr>
            <th style="background:#333;color:#fff;vertical-align:middle;text-align:center" rowspan="2">No</th>
            <th style="background:#333;color:#fff;vertical-align:middle;text-align:center" rowspan="2">Nama</th>
            <th style="background:#333;color:#fff;vertical-align:middle;text-align:center" rowspan="2">Jabatan</th>
            <th style="background:#333;color:#fff;vertical-align:middle;text-align:center" rowspan="2">Masa Kerja</th>
            <th style="background:#333;color:#fff;vertical-align:middle;text-align:center" rowspan="2">Saldo Cuti</th>
            <?php

            for ($i = 0; $i < count($ket); $i++) {

                if ($ket[$i] == 'cut') {
                    echo '<th colspan="13" style="background:orange;color:#fff;vertical-align:middle;text-align:center">Cuti</th>';
                } else if ($ket[$i] == 'tel') {
                    echo '<th colspan="13" style="background:red;color:#fff;vertical-align:middle;text-align:center">Telat</th>';
                } else if ($ket[$i] == 'sak') {
                    echo '<th colspan="13" style="background:#7d7b7b;color:#fff;vertical-align:middle;text-align:center">Sakit</th>';
                } else if ($ket[$i] == 'izi') {
                    echo '<th colspan="13" style="background:#3c8dbc;color:#fff;vertical-align:middle;text-align:center">Izin Siang</th>';
                } else if ($ket[$i] == 'vis') {
                    echo '<th colspan="13" style="background:#40ca31;color:#fff;vertical-align:middle;text-align:center">Visit</th>';
                } else if ($ket[$i] == 'lk') {
                    echo '<th colspan="13" style="background:#821014;color:#fff;vertical-align:middle;text-align:center">Luar Kota</th>';
                }
            }
            ?>
        </tr>
        <tr>
            <?php

            for ($b = 0; $b < count($ket); $b++) {

                if ($ket[$b] == 'cut') {
                    for ($i = 1; $i <= 13; $i++) {
                        if ($i == 1) {
                            echo '<th style="background:orange;color:#fff;text-align:center">Jan</th>';
                        } else if ($i == 2) {
                            echo '<th style="background:orange;color:#fff;text-align:center">Feb</th>';
                        } else if ($i == 3) {
                            echo '<th style="background:orange;color:#fff;text-align:center">Mar</th>';
                        } else if ($i == 4) {
                            echo '<th style="background:orange;color:#fff;text-align:center">Apr</th>';
                        } else if ($i == 5) {
                            echo '<th style="background:orange;color:#fff;text-align:center">Mei</th>';
                        } else if ($i == 6) {
                            echo '<th style="background:orange;color:#fff;text-align:center">Jun</th>';
                        } else if ($i == 7) {
                            echo '<th style="background:orange;color:#fff;text-align:center">Jul</th>';
                        } else if ($i == 8) {
                            echo '<th style="background:orange;color:#fff;text-align:center">Agu</th>';
                        } else if ($i == 9) {
                            echo '<th style="background:orange;color:#fff;text-align:center">Sep</th>';
                        } else if ($i == 10) {
                            echo '<th style="background:orange;color:#fff;text-align:center">Okt</th>';
                        } else if ($i == 11) {
                            echo '<th style="background:orange;color:#fff;text-align:center">Nov</th>';
                        } else if ($i == 12) {
                            echo '<th style="background:orange;color:#fff;text-align:center">Des</th>';
                        } else {
                            echo '<th style="background:orange;color:#fff;text-align:center">Sisa Cuti</th>';
                        }
                    }
                } else if ($ket[$b] == 'tel') {
                    for ($i = 1; $i <= 13; $i++) {
                        if ($i == 1) {
                            echo '<th style="background:red;color:#fff;text-align:center">Jan</th>';
                        } else if ($i == 2) {
                            echo '<th style="background:red;color:#fff;text-align:center">Feb</th>';
                        } else if ($i == 3) {
                            echo '<th style="background:red;color:#fff;text-align:center">Mar</th>';
                        } else if ($i == 4) {
                            echo '<th style="background:red;color:#fff;text-align:center">Apr</th>';
                        } else if ($i == 5) {
                            echo '<th style="background:red;color:#fff;text-align:center">Mei</th>';
                        } else if ($i == 6) {
                            echo '<th style="background:red;color:#fff;text-align:center">Jun</th>';
                        } else if ($i == 7) {
                            echo '<th style="background:red;color:#fff;text-align:center">Jul</th>';
                        } else if ($i == 8) {
                            echo '<th style="background:red;color:#fff;text-align:center">Agu</th>';
                        } else if ($i == 9) {
                            echo '<th style="background:red;color:#fff;text-align:center">Sep</th>';
                        } else if ($i == 10) {
                            echo '<th style="background:red;color:#fff;text-align:center">Okt</th>';
                        } else if ($i == 11) {
                            echo '<th style="background:red;color:#fff;text-align:center">Nov</th>';
                        } else if ($i == 12) {
                            echo '<th style="background:red;color:#fff;text-align:center">Des</th>';
                        } else {
                            echo '<th style="background:red;color:#fff;text-align:center">Total</th>';
                        }
                    }
                } else if ($ket[$b] == 'sak') {
                    for ($i = 1; $i <= 13; $i++) {
                        if ($i == 1) {
                            echo '<th style="background:#7d7b7b;color:#fff;text-align:center">Jan</th>';
                        } else if ($i == 2) {
                            echo '<th style="background:#7d7b7b;color:#fff;text-align:center">Feb</th>';
                        } else if ($i == 3) {
                            echo '<th style="background:#7d7b7b;color:#fff;text-align:center">Mar</th>';
                        } else if ($i == 4) {
                            echo '<th style="background:#7d7b7b;color:#fff;text-align:center">Apr</th>';
                        } else if ($i == 5) {
                            echo '<th style="background:#7d7b7b;color:#fff;text-align:center">Mei</th>';
                        } else if ($i == 6) {
                            echo '<th style="background:#7d7b7b;color:#fff;text-align:center">Jun</th>';
                        } else if ($i == 7) {
                            echo '<th style="background:#7d7b7b;color:#fff;text-align:center">Jul</th>';
                        } else if ($i == 8) {
                            echo '<th style="background:#7d7b7b;color:#fff;text-align:center">Agu</th>';
                        } else if ($i == 9) {
                            echo '<th style="background:#7d7b7b;color:#fff;text-align:center">Sep</th>';
                        } else if ($i == 10) {
                            echo '<th style="background:#7d7b7b;color:#fff;text-align:center">Okt</th>';
                        } else if ($i == 11) {
                            echo '<th style="background:#7d7b7b;color:#fff;text-align:center">Nov</th>';
                        } else if ($i == 12) {
                            echo '<th style="background:#7d7b7b;color:#fff;text-align:center">Des</th>';
                        } else {
                            echo '<th style="background:#7d7b7b;color:#fff;text-align:center">Total</th>';
                        }
                    }
                } else if ($ket[$b] == 'izi') {
                    for ($i = 1; $i <= 13; $i++) {
                        if ($i == 1) {
                            echo '<th style="background:#3c8dbc;color:#fff;text-align:center">Jan</th>';
                        } else if ($i == 2) {
                            echo '<th style="background:#3c8dbc;color:#fff;text-align:center">Feb</th>';
                        } else if ($i == 3) {
                            echo '<th style="background:#3c8dbc;color:#fff;text-align:center">Mar</th>';
                        } else if ($i == 4) {
                            echo '<th style="background:#3c8dbc;color:#fff;text-align:center">Apr</th>';
                        } else if ($i == 5) {
                            echo '<th style="background:#3c8dbc;color:#fff;text-align:center">Mei</th>';
                        } else if ($i == 6) {
                            echo '<th style="background:#3c8dbc;color:#fff;text-align:center">Jun</th>';
                        } else if ($i == 7) {
                            echo '<th style="background:#3c8dbc;color:#fff;text-align:center">Jul</th>';
                        } else if ($i == 8) {
                            echo '<th style="background:#3c8dbc;color:#fff;text-align:center">Agu</th>';
                        } else if ($i == 9) {
                            echo '<th style="background:#3c8dbc;color:#fff;text-align:center">Sep</th>';
                        } else if ($i == 10) {
                            echo '<th style="background:#3c8dbc;color:#fff;text-align:center">Okt</th>';
                        } else if ($i == 11) {
                            echo '<th style="background:#3c8dbc;color:#fff;text-align:center">Nov</th>';
                        } else if ($i == 12) {
                            echo '<th style="background:#3c8dbc;color:#fff;text-align:center">Des</th>';
                        } else {
                            echo '<th style="background:#3c8dbc;color:#fff;text-align:center">Total</th>';
                        }
                    }
                } else if ($ket[$b] == 'vis') {
                    for ($i = 1; $i <= 13; $i++) {
                        if ($i == 1) {
                            echo '<th style="background:#40ca31;color:#fff;text-align:center">Jan</th>';
                        } else if ($i == 2) {
                            echo '<th style="background:#40ca31;color:#fff;text-align:center">Feb</th>';
                        } else if ($i == 3) {
                            echo '<th style="background:#40ca31;color:#fff;text-align:center">Mar</th>';
                        } else if ($i == 4) {
                            echo '<th style="background:#40ca31;color:#fff;text-align:center">Apr</th>';
                        } else if ($i == 5) {
                            echo '<th style="background:#40ca31;color:#fff;text-align:center">Mei</th>';
                        } else if ($i == 6) {
                            echo '<th style="background:#40ca31;color:#fff;text-align:center">Jun</th>';
                        } else if ($i == 7) {
                            echo '<th style="background:#40ca31;color:#fff;text-align:center">Jul</th>';
                        } else if ($i == 8) {
                            echo '<th style="background:#40ca31;color:#fff;text-align:center">Agu</th>';
                        } else if ($i == 9) {
                            echo '<th style="background:#40ca31;color:#fff;text-align:center">Sep</th>';
                        } else if ($i == 10) {
                            echo '<th style="background:#40ca31;color:#fff;text-align:center">Okt</th>';
                        } else if ($i == 11) {
                            echo '<th style="background:#40ca31;color:#fff;text-align:center">Nov</th>';
                        } else if ($i == 12) {
                            echo '<th style="background:#40ca31;color:#fff;text-align:center">Des</th>';
                        } else {
                            echo '<th style="background:#40ca31;color:#fff;text-align:center">Total</th>';
                        }
                    }
                } else if ($ket[$b] == 'lk') {
                    for ($i = 1; $i <= 13; $i++) {
                        if ($i == 1) {
                            echo '<th style="background:#821014;color:#fff;text-align:center">Jan</th>';
                        } else if ($i == 2) {
                            echo '<th style="background:#821014;color:#fff;text-align:center">Feb</th>';
                        } else if ($i == 3) {
                            echo '<th style="background:#821014;color:#fff;text-align:center">Mar</th>';
                        } else if ($i == 4) {
                            echo '<th style="background:#821014;color:#fff;text-align:center">Apr</th>';
                        } else if ($i == 5) {
                            echo '<th style="background:#821014;color:#fff;text-align:center">Mei</th>';
                        } else if ($i == 6) {
                            echo '<th style="background:#821014;color:#fff;text-align:center">Jun</th>';
                        } else if ($i == 7) {
                            echo '<th style="background:#821014;color:#fff;text-align:center">Jul</th>';
                        } else if ($i == 8) {
                            echo '<th style="background:#821014;color:#fff;text-align:center">Agu</th>';
                        } else if ($i == 9) {
                            echo '<th style="background:#821014;color:#fff;text-align:center">Sep</th>';
                        } else if ($i == 10) {
                            echo '<th style="background:#821014;color:#fff;text-align:center">Okt</th>';
                        } else if ($i == 11) {
                            echo '<th style="background:#821014;color:#fff;text-align:center">Nov</th>';
                        } else if ($i == 12) {
                            echo '<th style="background:#821014;color:#fff;text-align:center">Des</th>';
                        } else {
                            echo '<th style="background:#821014;color:#fff;text-align:center">Total</th>';
                        }
                    }
                }
            }
            ?>
        </tr>

        <?php

        if (mysqli_num_rows($query) > 0) {

            $no     = 1;
            while ($data = mysqli_fetch_array($query)) {
                $tmp_maja = explode("-", $data['masa_kerja']);
                $masa_kerja = $tmp_maja[2] . '/' . $tmp_maja[1] . '/' . $tmp_maja[0];
                echo '
                        <tr>
                        <td style="font-size:12px;text-align:center">' . $no . '</td>
                        <td>' . $data['nama_lengkap'] . '</td>
                        <td>' . $data['nama_departemen'] . '</td>
                        <td style="font-size:12px;text-align:center">' . $masa_kerja . '</td>
                        <td style="font-size:12px;text-align:center">' . $data['hak_cuti'] . '</td>';

                for ($b = 0; $b < count($ket); $b++) {
                    echo '
                            <td style="font-size:12px;text-align:center">' . $data['' . $ket[$b] . '_1'] . '</td>
                            <td style="font-size:12px;text-align:center">' . $data['' . $ket[$b] . '_2'] . '</td>
                            <td style="font-size:12px;text-align:center">' . $data['' . $ket[$b] . '_3'] . '</td>
                            <td style="font-size:12px;text-align:center">' . $data['' . $ket[$b] . '_4'] . '</td>
                            <td style="font-size:12px;text-align:center">' . $data['' . $ket[$b] . '_5'] . '</td>
                            <td style="font-size:12px;text-align:center">' . $data['' . $ket[$b] . '_6'] . '</td>
                            <td style="font-size:12px;text-align:center">' . $data['' . $ket[$b] . '_7'] . '</td>
                            <td style="font-size:12px;text-align:center">' . $data['' . $ket[$b] . '_8'] . '</td>
                            <td style="font-size:12px;text-align:center">' . $data['' . $ket[$b] . '_9'] . '</td>
                            <td style="font-size:12px;text-align:center">' . $data['' . $ket[$b] . '_10'] . '</td>
                            <td style="font-size:12px;text-align:center">' . $data['' . $ket[$b] . '_11'] . '</td>
                            <td style="font-size:12px;text-align:center">' . $data['' . $ket[$b] . '_12'] . '</td>
                            <td style="font-size:12px;text-align:center">' . $data['tot_' . $ket[$b] . ''] . '</td>';
                }

                echo '</tr>';
                $no++;
            }
        } else {
            echo '<tr><td colspan="44" style="text-align:center">Daftar Karyawan tidak ada </td></tr>';
        }
        ?>
    </table>
</div>
