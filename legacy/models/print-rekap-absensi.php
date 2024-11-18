<?php

include "../config.php";

if ($_GET['jml'] == 3) {

    require "../mc_table.php";
    require "../fungsi.php";

    $tahun = $_GET['thn'];

    $fltr   = "";

    if (!empty($_GET['nama']) && empty($_GET['jabatan']) && empty($_GET['departemen'])) {
        $fltr .= "AND a.nama = '" . $_GET['nama'] . "'";
    } else if (!empty($_GET['nama']) && !empty($_GET['jabatan']) && empty($_GET['departemen'])) {
        $fltr .= "AND a.nama = '" . $_GET['nama'] . "' AND d.nama_jabatan = '" . $_GET['jabatan'] . "'";
    } else if (!empty($_GET['nama']) && !empty($_GET['jabatan']) && !empty($_GET['departemen'])) {
        $fltr .= "AND a.nama = '" . $_GET['nama'] . "' AND d.nama_jabatan = '" . $_GET['jabatan'] . "' AND e.nama_departemen = '" . $_GET['departemen'] . "'";
    } else if (empty($_GET['nama']) && !empty($_GET['jabatan']) && !empty($_GET['departemen'])) {
        $fltr .= "AND d.nama_jabatan = '" . $_GET['jabatan'] . "' AND e.nama_departemen = '" . $_GET['departemen'] . "'";
    } else if (empty($_GET['nama']) && empty($_GET['jabatan']) && !empty($_GET['departemen'])) {
        $fltr .= "AND e.nama_departemen = '" . $_GET['departemen'] . "'";
    } else if (empty($_GET['nama']) && !empty($_GET['jabatan']) && empty($_GET['departemen'])) {
        $fltr .= "AND d.nama_jabatan = '" . $_GET['jabatan'] . "'";
    } else if (!empty($_GET['nama']) && empty($_GET['jabatan']) && !empty($_GET['departemen'])) {
        $fltr .= "AND a.nama = '" . $_GET['nama'] . "' AND e.nama_departemen = '" . $_GET['departemen'] . "'";
    }

    $param = "";

    if (!empty($_GET['c']) && !empty($_GET['t']) && !empty($_GET['s'])) {
        $param1 = array($_GET['c']);
        $param2 = array($_GET['t']);
        $param3 = array($_GET['s']);
    } else if (!empty($_GET['c']) && !empty($_GET['t']) && !empty($_GET['i'])) {
        $param1 = array($_GET['c']);
        $param2 = array($_GET['t']);
        $param3 = array($_GET['i']);
    } else if (!empty($_GET['c']) && !empty($_GET['t']) && !empty($_GET['v'])) {
        $param1 = array($_GET['c']);
        $param2 = array($_GET['t']);
        $param3 = array($_GET['v']);
    } else if (!empty($_GET['c']) && !empty($_GET['t']) && !empty($_GET['lk'])) {
        $param1 = array($_GET['c']);
        $param2 = array($_GET['t']);
        $param3 = array($_GET['lk']);
    } else if (!empty($_GET['c']) && !empty($_GET['v']) && !empty($_GET['lk'])) {
        $param1 = array($_GET['c']);
        $param2 = array($_GET['v']);
        $param3 = array($_GET['lk']);
    } else if (!empty($_GET['t']) && !empty($_GET['s']) && !empty($_GET['i'])) {
        $param1 = array($_GET['t']);
        $param2 = array($_GET['s']);
        $param3 = array($_GET['i']);
    } else if (!empty($_GET['t']) && !empty($_GET['s']) && !empty($_GET['v'])) {
        $param1 = array($_GET['t']);
        $param2 = array($_GET['s']);
        $param3 = array($_GET['v']);
    } else if (!empty($_GET['t']) && !empty($_GET['s']) && !empty($_GET['lk'])) {
        $param1 = array($_GET['t']);
        $param2 = array($_GET['s']);
        $param3 = array($_GET['lk']);
    } else if (!empty($_GET['s']) && !empty($_GET['i']) && !empty($_GET['v'])) {
        $param1 = array($_GET['s']);
        $param2 = array($_GET['i']);
        $param3 = array($_GET['v']);
    } else if (!empty($_GET['s']) && !empty($_GET['v']) && !empty($_GET['lk'])) {
        $param1 = array($_GET['s']);
        $param2 = array($_GET['v']);
        $param3 = array($_GET['lk']);
    } else if (!empty($_GET['c']) && !empty($_GET['s']) && !empty($_GET['i'])) {
        $param1 = array($_GET['c']);
        $param2 = array($_GET['s']);
        $param3 = array($_GET['i']);
    } else if (!empty($_GET['c']) && !empty($_GET['i']) && !empty($_GET['lk'])) {
        $param1 = array($_GET['c']);
        $param2 = array($_GET['i']);
        $param3 = array($_GET['lk']);
    } else if (!empty($_GET['c']) && !empty($_GET['i']) && !empty($_GET['v'])) {
        $param1 = array($_GET['c']);
        $param2 = array($_GET['i']);
        $param3 = array($_GET['v']);
    } else if (!empty($_GET['i']) && !empty($_GET['s']) && !empty($_GET['lk'])) {
        $param1 = array($_GET['i']);
        $param2 = array($_GET['s']);
        $param3 = array($_GET['lk']);
    } else if (!empty($_GET['i']) && !empty($_GET['v']) && !empty($_GET['lk'])) {
        $param1 = array($_GET['i']);
        $param2 = array($_GET['v']);
        $param3 = array($_GET['lk']);
    }

    $ket    = array_merge($param1, $param2, $param3);

    $query  = mysqli_query($con, "SELECT a.nama, a.nama_departemen, a.masa_kerja,

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

SELECT a.nama, a.nama_jabatan, a.nama_departemen, a.masa_kerja, b.cut_1, c.cut_2, d.cut_3, e.cut_4, f.cut_5, g.cut_6, h.cut_7, 
i.cut_8, j.cut_9, k.cut_10, l.cut_11, m.cut_12, ((o.total_cuti-IFNULL(n.total,0)) - o.cuti_diambil) AS tot_cut, o.total_cuti AS hak_cuti
    FROM (
    
    SELECT a.nama, e.nama_departemen, c.nama_lengkap, d.nama_jabatan, c.masa_kerja FROM tb_absensi_detail a, tb_keterangan b, tb_karyawan c, tb_jabatan d, tb_departemen e 
    WHERE a.id_keterangan = b.id_keterangan AND 
    a.nama = c.username AND c.id_jabatan = d.id_jabatan AND c.id_departemen = e.id_departemen AND e.nama_departemen NOT IN ('PLANT') $fltr
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
    
SELECT DISTINCT a.nama, a.nama_jabatan, a.nama_departemen, b.tel_1, c.tel_2, d.tel_3, e.tel_4, f.tel_5, g.tel_6, h.tel_7, 
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
    
    ) AS b ON a.nama = b.nama LEFT OUTER JOIN(

SELECT DISTINCT a.nama, a.nama_jabatan, a.nama_departemen, b.sak_1, c.sak_2, d.sak_3, e.sak_4, f.sak_5, g.sak_6, h.sak_7, i.sak_8, j.sak_9, k.sak_10, l.sak_11, 
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
    
    ) AS c ON a.nama = c.nama LEFT OUTER JOIN (

SELECT DISTINCT a.nama, a.nama_jabatan, a.nama_departemen, b.izi_1, c.izi_2, d.izi_3, e.izi_4, f.izi_5, g.izi_6, h.izi_7, i.izi_8, j.izi_9, k.izi_10, l.izi_11, 
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
    
    ) AS d ON a.nama = d.nama LEFT OUTER JOIN (
 
SELECT DISTINCT a.nama, a.nama_jabatan, a.nama_departemen, b.vis_1, c.vis_2, d.vis_3, e.vis_4, f.vis_5, g.vis_6, h.vis_7, i.vis_8, j.vis_9, k.vis_10, l.vis_11, 
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
    
    ) AS e ON a.nama = e.nama LEFT OUTER JOIN (
    
SELECT DISTINCT a.nama, a.nama_jabatan, a.nama_departemen, b.lk_1, c.lk_2, d.lk_3, e.lk_4, f.lk_5, g.lk_6, h.lk_7, i.lk_8, j.lk_9, k.lk_10, l.lk_11, 
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
    ) AS o ON a.nama = o.nama ORDER BY a.nama_departemen
    ) AS f ON a.nama = f.nama ORDER BY a.nama_departemen ASC");

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
    $pdf->Cell(10, 7, 'Daftar Absensi Karyawan / Tahun');

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
    $pdf->SetX(3);
    $pdf->Cell(6, 10, 'No', 1, 0, 'C', 1);
    $pdf->SetX(9);
    $pdf->Cell(14, 10, 'Nama', 1, 0, '', 1);
    $pdf->SetX(23);
    $pdf->Cell(15, 10, 'Masa Kerja', 1, 0, 'C', 1);
    $pdf->SetX(38);
    $pdf->Cell(15, 10, 'Saldo Cuti', 1, 0, 'C', 1);

    $kolom = 0;
    for ($i = 0; $i < count($ket); $i++) {

        if ($ket[$i] == 'cut') {
            $pdf->SetX(53);
            $pdf->Cell(91, 5, 'Cuti', 1, 0, 'C', 1);
        } else if ($ket[$i] == 'tel') {
            $pdf->SetX(53 + $kolom);
            $pdf->Cell(91, 5, 'Telat', 1, 0, 'C', 1);
        } else if ($ket[$i] == 'sak') {
            $pdf->SetX(53 + $kolom);
            $pdf->Cell(91, 5, 'Sakit', 1, 0, 'C', 1);
        } else if ($ket[$i] == 'izi') {
            $pdf->SetX(53 + $kolom);
            $pdf->Cell(91, 5, 'Izin Siang', 1, 0, 'C', 1);
        } else if ($ket[$i] == 'vis') {
            $pdf->SetX(53 + $kolom);
            $pdf->Cell(91, 5, 'Visit', 1, 0, 'C', 1);
        } else if ($ket[$i] == 'lk') {
            $pdf->SetX(53 + $kolom);
            $pdf->Cell(91, 5, 'Luar Kota', 1, 0, 'C', 1);
        }

        $kolom += 91;
    }

    $pdf->Ln(5);

    $kolom_2 = 0;

    for ($b = 0; $b < count($ket); $b++) {

        if ($ket[$b] == 'cut') {
            $pdf->SetX(53 + $kolom_2);
            $pdf->Cell(7, 5, 'Jan', 1, 0, 'C', 1);
            $kolom_2 += 7;
            $pdf->SetX(53 + $kolom_2);
            $pdf->Cell(7, 5, 'Feb', 1, 0, 'C', 1);
            $kolom_2 += 7;
            $pdf->SetX(53 + $kolom_2);
            $pdf->Cell(7, 5, 'Mar', 1, 0, 'C', 1);
            $kolom_2 += 7;
            $pdf->SetX(53 + $kolom_2);
            $pdf->Cell(7, 5, 'Apr', 1, 0, 'C', 1);
            $kolom_2 += 7;
            $pdf->SetX(53 + $kolom_2);
            $pdf->Cell(7, 5, 'Mei', 1, 0, 'C', 1);
            $kolom_2 += 7;
            $pdf->SetX(53 + $kolom_2);
            $pdf->Cell(7, 5, 'Jun', 1, 0, 'C', 1);
            $kolom_2 += 7;
            $pdf->SetX(53 + $kolom_2);
            $pdf->Cell(7, 5, 'Jul', 1, 0, 'C', 1);
            $kolom_2 += 7;
            $pdf->SetX(53 + $kolom_2);
            $pdf->Cell(7, 5, 'Agu', 1, 0, 'C', 1);
            $kolom_2 += 7;
            $pdf->SetX(53 + $kolom_2);
            $pdf->Cell(7, 5, 'Sep', 1, 0, 'C', 1);
            $kolom_2 += 7;
            $pdf->SetX(53 + $kolom_2);
            $pdf->Cell(7, 5, 'Okt', 1, 0, 'C', 1);
            $kolom_2 += 7;
            $pdf->SetX(53 + $kolom_2);
            $pdf->Cell(7, 5, 'Nov', 1, 0, 'C', 1);
            $kolom_2 += 7;
            $pdf->SetX(53 + $kolom_2);
            $pdf->Cell(7, 5, 'Des', 1, 0, 'C', 1);
            $kolom_2 += 7;
            $pdf->SetX(53 + $kolom_2);
            $pdf->Cell(7, 5, 'Sisa', 1, 0, 'C', 1);
        } else if ($ket[$b] == 'tel') {
            $pdf->SetX(53 + $kolom_2);
            $pdf->Cell(7, 5, 'Jan', 1, 0, 'C', 1);
            $kolom_2 += 7;
            $pdf->SetX(53 + $kolom_2);
            $pdf->Cell(7, 5, 'Feb', 1, 0, 'C', 1);
            $kolom_2 += 7;
            $pdf->SetX(53 + $kolom_2);
            $pdf->Cell(7, 5, 'Mar', 1, 0, 'C', 1);
            $kolom_2 += 7;
            $pdf->SetX(53 + $kolom_2);
            $pdf->Cell(7, 5, 'Apr', 1, 0, 'C', 1);
            $kolom_2 += 7;
            $pdf->SetX(53 + $kolom_2);
            $pdf->Cell(7, 5, 'Mei', 1, 0, 'C', 1);
            $kolom_2 += 7;
            $pdf->SetX(53 + $kolom_2);
            $pdf->Cell(7, 5, 'Jun', 1, 0, 'C', 1);
            $kolom_2 += 7;
            $pdf->SetX(53 + $kolom_2);
            $pdf->Cell(7, 5, 'Jul', 1, 0, 'C', 1);
            $kolom_2 += 7;
            $pdf->SetX(53 + $kolom_2);
            $pdf->Cell(7, 5, 'Agu', 1, 0, 'C', 1);
            $kolom_2 += 7;
            $pdf->SetX(53 + $kolom_2);
            $pdf->Cell(7, 5, 'Sep', 1, 0, 'C', 1);
            $kolom_2 += 7;
            $pdf->SetX(53 + $kolom_2);
            $pdf->Cell(7, 5, 'Okt', 1, 0, 'C', 1);
            $kolom_2 += 7;
            $pdf->SetX(53 + $kolom_2);
            $pdf->Cell(7, 5, 'Nov', 1, 0, 'C', 1);
            $kolom_2 += 7;
            $pdf->SetX(53 + $kolom_2);
            $pdf->Cell(7, 5, 'Des', 1, 0, 'C', 1);
            $kolom_2 += 7;
            $pdf->SetX(53 + $kolom_2);
            $pdf->Cell(7, 5, 'Tot', 1, 0, 'C', 1);
        } else if ($ket[$b] == 'sak') {
            $pdf->SetX(53 + $kolom_2);
            $pdf->Cell(7, 5, 'Jan', 1, 0, 'C', 1);
            $kolom_2 += 7;
            $pdf->SetX(53 + $kolom_2);
            $pdf->Cell(7, 5, 'Feb', 1, 0, 'C', 1);
            $kolom_2 += 7;
            $pdf->SetX(53 + $kolom_2);
            $pdf->Cell(7, 5, 'Mar', 1, 0, 'C', 1);
            $kolom_2 += 7;
            $pdf->SetX(53 + $kolom_2);
            $pdf->Cell(7, 5, 'Apr', 1, 0, 'C', 1);
            $kolom_2 += 7;
            $pdf->SetX(53 + $kolom_2);
            $pdf->Cell(7, 5, 'Mei', 1, 0, 'C', 1);
            $kolom_2 += 7;
            $pdf->SetX(53 + $kolom_2);
            $pdf->Cell(7, 5, 'Jun', 1, 0, 'C', 1);
            $kolom_2 += 7;
            $pdf->SetX(53 + $kolom_2);
            $pdf->Cell(7, 5, 'Jul', 1, 0, 'C', 1);
            $kolom_2 += 7;
            $pdf->SetX(53 + $kolom_2);
            $pdf->Cell(7, 5, 'Agu', 1, 0, 'C', 1);
            $kolom_2 += 7;
            $pdf->SetX(53 + $kolom_2);
            $pdf->Cell(7, 5, 'Sep', 1, 0, 'C', 1);
            $kolom_2 += 7;
            $pdf->SetX(53 + $kolom_2);
            $pdf->Cell(7, 5, 'Okt', 1, 0, 'C', 1);
            $kolom_2 += 7;
            $pdf->SetX(53 + $kolom_2);
            $pdf->Cell(7, 5, 'Nov', 1, 0, 'C', 1);
            $kolom_2 += 7;
            $pdf->SetX(53 + $kolom_2);
            $pdf->Cell(7, 5, 'Des', 1, 0, 'C', 1);
            $kolom_2 += 7;
            $pdf->SetX(53 + $kolom_2);
            $pdf->Cell(7, 5, 'Tot', 1, 0, 'C', 1);
        } else if ($ket[$b] == 'izi') {
            $pdf->SetX(53 + $kolom_2);
            $pdf->Cell(7, 5, 'Jan', 1, 0, 'C', 1);
            $kolom_2 += 7;
            $pdf->SetX(53 + $kolom_2);
            $pdf->Cell(7, 5, 'Feb', 1, 0, 'C', 1);
            $kolom_2 += 7;
            $pdf->SetX(53 + $kolom_2);
            $pdf->Cell(7, 5, 'Mar', 1, 0, 'C', 1);
            $kolom_2 += 7;
            $pdf->SetX(53 + $kolom_2);
            $pdf->Cell(7, 5, 'Apr', 1, 0, 'C', 1);
            $kolom_2 += 7;
            $pdf->SetX(53 + $kolom_2);
            $pdf->Cell(7, 5, 'Mei', 1, 0, 'C', 1);
            $kolom_2 += 7;
            $pdf->SetX(53 + $kolom_2);
            $pdf->Cell(7, 5, 'Jun', 1, 0, 'C', 1);
            $kolom_2 += 7;
            $pdf->SetX(53 + $kolom_2);
            $pdf->Cell(7, 5, 'Jul', 1, 0, 'C', 1);
            $kolom_2 += 7;
            $pdf->SetX(53 + $kolom_2);
            $pdf->Cell(7, 5, 'Agu', 1, 0, 'C', 1);
            $kolom_2 += 7;
            $pdf->SetX(53 + $kolom_2);
            $pdf->Cell(7, 5, 'Sep', 1, 0, 'C', 1);
            $kolom_2 += 7;
            $pdf->SetX(53 + $kolom_2);
            $pdf->Cell(7, 5, 'Okt', 1, 0, 'C', 1);
            $kolom_2 += 7;
            $pdf->SetX(53 + $kolom_2);
            $pdf->Cell(7, 5, 'Nov', 1, 0, 'C', 1);
            $kolom_2 += 7;
            $pdf->SetX(53 + $kolom_2);
            $pdf->Cell(7, 5, 'Des', 1, 0, 'C', 1);
            $kolom_2 += 7;
            $pdf->SetX(53 + $kolom_2);
            $pdf->Cell(7, 5, 'Tot', 1, 0, 'C', 1);
        } else if ($ket[$b] == 'vis') {
            $pdf->SetX(53 + $kolom_2);
            $pdf->Cell(7, 5, 'Jan', 1, 0, 'C', 1);
            $kolom_2 += 7;
            $pdf->SetX(53 + $kolom_2);
            $pdf->Cell(7, 5, 'Feb', 1, 0, 'C', 1);
            $kolom_2 += 7;
            $pdf->SetX(53 + $kolom_2);
            $pdf->Cell(7, 5, 'Mar', 1, 0, 'C', 1);
            $kolom_2 += 7;
            $pdf->SetX(53 + $kolom_2);
            $pdf->Cell(7, 5, 'Apr', 1, 0, 'C', 1);
            $kolom_2 += 7;
            $pdf->SetX(53 + $kolom_2);
            $pdf->Cell(7, 5, 'Mei', 1, 0, 'C', 1);
            $kolom_2 += 7;
            $pdf->SetX(53 + $kolom_2);
            $pdf->Cell(7, 5, 'Jun', 1, 0, 'C', 1);
            $kolom_2 += 7;
            $pdf->SetX(53 + $kolom_2);
            $pdf->Cell(7, 5, 'Jul', 1, 0, 'C', 1);
            $kolom_2 += 7;
            $pdf->SetX(53 + $kolom_2);
            $pdf->Cell(7, 5, 'Agu', 1, 0, 'C', 1);
            $kolom_2 += 7;
            $pdf->SetX(53 + $kolom_2);
            $pdf->Cell(7, 5, 'Sep', 1, 0, 'C', 1);
            $kolom_2 += 7;
            $pdf->SetX(53 + $kolom_2);
            $pdf->Cell(7, 5, 'Okt', 1, 0, 'C', 1);
            $kolom_2 += 7;
            $pdf->SetX(53 + $kolom_2);
            $pdf->Cell(7, 5, 'Nov', 1, 0, 'C', 1);
            $kolom_2 += 7;
            $pdf->SetX(53 + $kolom_2);
            $pdf->Cell(7, 5, 'Des', 1, 0, 'C', 1);
            $kolom_2 += 7;
            $pdf->SetX(53 + $kolom_2);
            $pdf->Cell(7, 5, 'Tot', 1, 0, 'C', 1);
        } else if ($ket[$b] == 'lk') {
            $pdf->SetX(53 + $kolom_2);
            $pdf->Cell(7, 5, 'Jan', 1, 0, 'C', 1);
            $kolom_2 += 7;
            $pdf->SetX(53 + $kolom_2);
            $pdf->Cell(7, 5, 'Feb', 1, 0, 'C', 1);
            $kolom_2 += 7;
            $pdf->SetX(53 + $kolom_2);
            $pdf->Cell(7, 5, 'Mar', 1, 0, 'C', 1);
            $kolom_2 += 7;
            $pdf->SetX(53 + $kolom_2);
            $pdf->Cell(7, 5, 'Apr', 1, 0, 'C', 1);
            $kolom_2 += 7;
            $pdf->SetX(53 + $kolom_2);
            $pdf->Cell(7, 5, 'Mei', 1, 0, 'C', 1);
            $kolom_2 += 7;
            $pdf->SetX(53 + $kolom_2);
            $pdf->Cell(7, 5, 'Jun', 1, 0, 'C', 1);
            $kolom_2 += 7;
            $pdf->SetX(53 + $kolom_2);
            $pdf->Cell(7, 5, 'Jul', 1, 0, 'C', 1);
            $kolom_2 += 7;
            $pdf->SetX(53 + $kolom_2);
            $pdf->Cell(7, 5, 'Agu', 1, 0, 'C', 1);
            $kolom_2 += 7;
            $pdf->SetX(53 + $kolom_2);
            $pdf->Cell(7, 5, 'Sep', 1, 0, 'C', 1);
            $kolom_2 += 7;
            $pdf->SetX(53 + $kolom_2);
            $pdf->Cell(7, 5, 'Okt', 1, 0, 'C', 1);
            $kolom_2 += 7;
            $pdf->SetX(53 + $kolom_2);
            $pdf->Cell(7, 5, 'Nov', 1, 0, 'C', 1);
            $kolom_2 += 7;
            $pdf->SetX(53 + $kolom_2);
            $pdf->Cell(7, 5, 'Des', 1, 0, 'C', 1);
            $kolom_2 += 7;
            $pdf->SetX(53 + $kolom_2);
            $pdf->Cell(7, 5, 'Tot', 1, 0, 'C', 1);
        }

        $kolom_2 += 7;
    }

    //Fields Name position
    $Y_Fields_Name_position = 35;

    $pdf->SetFillColor(255, 255, 255);
    $pdf->SetFont('Times', '', 8);
    $pdf->SetY($Y_Fields_Name_position);

    if (mysqli_num_rows($query) > 0) {

        $no     = 1;
        $row    = 0;

        while ($data = mysqli_fetch_array($query)) {

            $pdf->Ln(5 + $row);

            $tmp_maja = explode("-", $data['masa_kerja']);
            $masa_kerja = $tmp_maja[2] . '/' . $tmp_maja[1] . '/' . $tmp_maja[0];

            $pdf->SetX(3);
            $pdf->Cell(6, 5, '' . $no . '', 1, 0, 'C', 1);
            $pdf->SetX(9);
            $pdf->Cell(14, 5, '' . $data['nama'] . '', 1, 0, '', 1);
            $pdf->SetX(23);
            $pdf->Cell(15, 5, '' . $masa_kerja . '', 1, 0, 'C', 1);
            $pdf->SetX(38);
            $pdf->Cell(15, 5, '' . $data['hak_cuti'] . '', 1, 0, 'C', 1);

            $kolom_data = 0;

            for ($c = 0; $c < count($ket); $c++) {
                if ($ket[$c] == 'cut') {
                    $pdf->SetX(53 + $kolom_data);
                    $pdf->Cell(7, 5, '' . $data['' . $ket[$c] . '_1'] . '', 1, 0, 'C', 1);
                    $kolom_data += 7;
                    $pdf->SetX(53 + $kolom_data);
                    $pdf->Cell(7, 5, '' . $data['' . $ket[$c] . '_2'] . '', 1, 0, 'C', 1);
                    $kolom_data += 7;
                    $pdf->SetX(53 + $kolom_data);
                    $pdf->Cell(7, 5, '' . $data['' . $ket[$c] . '_3'] . '', 1, 0, 'C', 1);
                    $kolom_data += 7;
                    $pdf->SetX(53 + $kolom_data);
                    $pdf->Cell(7, 5, '' . $data['' . $ket[$c] . '_4'] . '', 1, 0, 'C', 1);
                    $kolom_data += 7;
                    $pdf->SetX(53 + $kolom_data);
                    $pdf->Cell(7, 5, '' . $data['' . $ket[$c] . '_5'] . '', 1, 0, 'C', 1);
                    $kolom_data += 7;
                    $pdf->SetX(53 + $kolom_data);
                    $pdf->Cell(7, 5, '' . $data['' . $ket[$c] . '_6'] . '', 1, 0, 'C', 1);
                    $kolom_data += 7;
                    $pdf->SetX(53 + $kolom_data);
                    $pdf->Cell(7, 5, '' . $data['' . $ket[$c] . '_7'] . '', 1, 0, 'C', 1);
                    $kolom_data += 7;
                    $pdf->SetX(53 + $kolom_data);
                    $pdf->Cell(7, 5, '' . $data['' . $ket[$c] . '_8'] . '', 1, 0, 'C', 1);
                    $kolom_data += 7;
                    $pdf->SetX(53 + $kolom_data);
                    $pdf->Cell(7, 5, '' . $data['' . $ket[$c] . '_9'] . '', 1, 0, 'C', 1);
                    $kolom_data += 7;
                    $pdf->SetX(53 + $kolom_data);
                    $pdf->Cell(7, 5, '' . $data['' . $ket[$c] . '_10'] . '', 1, 0, 'C', 1);
                    $kolom_data += 7;
                    $pdf->SetX(53 + $kolom_data);
                    $pdf->Cell(7, 5, '' . $data['' . $ket[$c] . '_11'] . '', 1, 0, 'C', 1);
                    $kolom_data += 7;
                    $pdf->SetX(53 + $kolom_data);
                    $pdf->Cell(7, 5, '' . $data['' . $ket[$c] . '_12'] . '', 1, 0, 'C', 1);
                    $kolom_data += 7;
                    $pdf->SetX(53 + $kolom_data);
                    $pdf->Cell(7, 5, '' . $data['tot_' . $ket[$c] . ''] . '', 1, 0, 'C', 1);
                    $kolom_data += 7;
                } else if ($ket[$c] == 'tel') {
                    $pdf->SetX(53 + $kolom_data);
                    $pdf->Cell(7, 5, '' . $data['' . $ket[$c] . '_1'] . '', 1, 0, 'C', 1);
                    $kolom_data += 7;
                    $pdf->SetX(53 + $kolom_data);
                    $pdf->Cell(7, 5, '' . $data['' . $ket[$c] . '_2'] . '', 1, 0, 'C', 1);
                    $kolom_data += 7;
                    $pdf->SetX(53 + $kolom_data);
                    $pdf->Cell(7, 5, '' . $data['' . $ket[$c] . '_3'] . '', 1, 0, 'C', 1);
                    $kolom_data += 7;
                    $pdf->SetX(53 + $kolom_data);
                    $pdf->Cell(7, 5, '' . $data['' . $ket[$c] . '_4'] . '', 1, 0, 'C', 1);
                    $kolom_data += 7;
                    $pdf->SetX(53 + $kolom_data);
                    $pdf->Cell(7, 5, '' . $data['' . $ket[$c] . '_5'] . '', 1, 0, 'C', 1);
                    $kolom_data += 7;
                    $pdf->SetX(53 + $kolom_data);
                    $pdf->Cell(7, 5, '' . $data['' . $ket[$c] . '_6'] . '', 1, 0, 'C', 1);
                    $kolom_data += 7;
                    $pdf->SetX(53 + $kolom_data);
                    $pdf->Cell(7, 5, '' . $data['' . $ket[$c] . '_7'] . '', 1, 0, 'C', 1);
                    $kolom_data += 7;
                    $pdf->SetX(53 + $kolom_data);
                    $pdf->Cell(7, 5, '' . $data['' . $ket[$c] . '_8'] . '', 1, 0, 'C', 1);
                    $kolom_data += 7;
                    $pdf->SetX(53 + $kolom_data);
                    $pdf->Cell(7, 5, '' . $data['' . $ket[$c] . '_9'] . '', 1, 0, 'C', 1);
                    $kolom_data += 7;
                    $pdf->SetX(53 + $kolom_data);
                    $pdf->Cell(7, 5, '' . $data['' . $ket[$c] . '_10'] . '', 1, 0, 'C', 1);
                    $kolom_data += 7;
                    $pdf->SetX(53 + $kolom_data);
                    $pdf->Cell(7, 5, '' . $data['' . $ket[$c] . '_11'] . '', 1, 0, 'C', 1);
                    $kolom_data += 7;
                    $pdf->SetX(53 + $kolom_data);
                    $pdf->Cell(7, 5, '' . $data['' . $ket[$c] . '_12'] . '', 1, 0, 'C', 1);
                    $kolom_data += 7;
                    $pdf->SetX(53 + $kolom_data);
                    $pdf->Cell(7, 5, '' . $data['tot_' . $ket[$c] . ''] . '', 1, 0, 'C', 1);
                    $kolom_data += 7;
                } else if ($ket[$c] == 'sak') {
                    $pdf->SetX(53 + $kolom_data);
                    $pdf->Cell(7, 5, '' . $data['' . $ket[$c] . '_1'] . '', 1, 0, 'C', 1);
                    $kolom_data += 7;
                    $pdf->SetX(53 + $kolom_data);
                    $pdf->Cell(7, 5, '' . $data['' . $ket[$c] . '_2'] . '', 1, 0, 'C', 1);
                    $kolom_data += 7;
                    $pdf->SetX(53 + $kolom_data);
                    $pdf->Cell(7, 5, '' . $data['' . $ket[$c] . '_3'] . '', 1, 0, 'C', 1);
                    $kolom_data += 7;
                    $pdf->SetX(53 + $kolom_data);
                    $pdf->Cell(7, 5, '' . $data['' . $ket[$c] . '_4'] . '', 1, 0, 'C', 1);
                    $kolom_data += 7;
                    $pdf->SetX(53 + $kolom_data);
                    $pdf->Cell(7, 5, '' . $data['' . $ket[$c] . '_5'] . '', 1, 0, 'C', 1);
                    $kolom_data += 7;
                    $pdf->SetX(53 + $kolom_data);
                    $pdf->Cell(7, 5, '' . $data['' . $ket[$c] . '_6'] . '', 1, 0, 'C', 1);
                    $kolom_data += 7;
                    $pdf->SetX(53 + $kolom_data);
                    $pdf->Cell(7, 5, '' . $data['' . $ket[$c] . '_7'] . '', 1, 0, 'C', 1);
                    $kolom_data += 7;
                    $pdf->SetX(53 + $kolom_data);
                    $pdf->Cell(7, 5, '' . $data['' . $ket[$c] . '_8'] . '', 1, 0, 'C', 1);
                    $kolom_data += 7;
                    $pdf->SetX(53 + $kolom_data);
                    $pdf->Cell(7, 5, '' . $data['' . $ket[$c] . '_9'] . '', 1, 0, 'C', 1);
                    $kolom_data += 7;
                    $pdf->SetX(53 + $kolom_data);
                    $pdf->Cell(7, 5, '' . $data['' . $ket[$c] . '_10'] . '', 1, 0, 'C', 1);
                    $kolom_data += 7;
                    $pdf->SetX(53 + $kolom_data);
                    $pdf->Cell(7, 5, '' . $data['' . $ket[$c] . '_11'] . '', 1, 0, 'C', 1);
                    $kolom_data += 7;
                    $pdf->SetX(53 + $kolom_data);
                    $pdf->Cell(7, 5, '' . $data['' . $ket[$c] . '_12'] . '', 1, 0, 'C', 1);
                    $kolom_data += 7;
                    $pdf->SetX(53 + $kolom_data);
                    $pdf->Cell(7, 5, '' . $data['tot_' . $ket[$c] . ''] . '', 1, 0, 'C', 1);
                    $kolom_data += 7;
                } else if ($ket[$c] == 'izi') {
                    $pdf->SetX(53 + $kolom_data);
                    $pdf->Cell(7, 5, '' . $data['' . $ket[$c] . '_1'] . '', 1, 0, 'C', 1);
                    $kolom_data += 7;
                    $pdf->SetX(53 + $kolom_data);
                    $pdf->Cell(7, 5, '' . $data['' . $ket[$c] . '_2'] . '', 1, 0, 'C', 1);
                    $kolom_data += 7;
                    $pdf->SetX(53 + $kolom_data);
                    $pdf->Cell(7, 5, '' . $data['' . $ket[$c] . '_3'] . '', 1, 0, 'C', 1);
                    $kolom_data += 7;
                    $pdf->SetX(53 + $kolom_data);
                    $pdf->Cell(7, 5, '' . $data['' . $ket[$c] . '_4'] . '', 1, 0, 'C', 1);
                    $kolom_data += 7;
                    $pdf->SetX(53 + $kolom_data);
                    $pdf->Cell(7, 5, '' . $data['' . $ket[$c] . '_5'] . '', 1, 0, 'C', 1);
                    $kolom_data += 7;
                    $pdf->SetX(53 + $kolom_data);
                    $pdf->Cell(7, 5, '' . $data['' . $ket[$c] . '_6'] . '', 1, 0, 'C', 1);
                    $kolom_data += 7;
                    $pdf->SetX(53 + $kolom_data);
                    $pdf->Cell(7, 5, '' . $data['' . $ket[$c] . '_7'] . '', 1, 0, 'C', 1);
                    $kolom_data += 7;
                    $pdf->SetX(53 + $kolom_data);
                    $pdf->Cell(7, 5, '' . $data['' . $ket[$c] . '_8'] . '', 1, 0, 'C', 1);
                    $kolom_data += 7;
                    $pdf->SetX(53 + $kolom_data);
                    $pdf->Cell(7, 5, '' . $data['' . $ket[$c] . '_9'] . '', 1, 0, 'C', 1);
                    $kolom_data += 7;
                    $pdf->SetX(53 + $kolom_data);
                    $pdf->Cell(7, 5, '' . $data['' . $ket[$c] . '_10'] . '', 1, 0, 'C', 1);
                    $kolom_data += 7;
                    $pdf->SetX(53 + $kolom_data);
                    $pdf->Cell(7, 5, '' . $data['' . $ket[$c] . '_11'] . '', 1, 0, 'C', 1);
                    $kolom_data += 7;
                    $pdf->SetX(53 + $kolom_data);
                    $pdf->Cell(7, 5, '' . $data['' . $ket[$c] . '_12'] . '', 1, 0, 'C', 1);
                    $kolom_data += 7;
                    $pdf->SetX(53 + $kolom_data);
                    $pdf->Cell(7, 5, '' . $data['tot_' . $ket[$c] . ''] . '', 1, 0, 'C', 1);
                    $kolom_data += 7;
                } else if ($ket[$c] == 'vis') {
                    $pdf->SetX(53 + $kolom_data);
                    $pdf->Cell(7, 5, '' . $data['' . $ket[$c] . '_1'] . '', 1, 0, 'C', 1);
                    $kolom_data += 7;
                    $pdf->SetX(53 + $kolom_data);
                    $pdf->Cell(7, 5, '' . $data['' . $ket[$c] . '_2'] . '', 1, 0, 'C', 1);
                    $kolom_data += 7;
                    $pdf->SetX(53 + $kolom_data);
                    $pdf->Cell(7, 5, '' . $data['' . $ket[$c] . '_3'] . '', 1, 0, 'C', 1);
                    $kolom_data += 7;
                    $pdf->SetX(53 + $kolom_data);
                    $pdf->Cell(7, 5, '' . $data['' . $ket[$c] . '_4'] . '', 1, 0, 'C', 1);
                    $kolom_data += 7;
                    $pdf->SetX(53 + $kolom_data);
                    $pdf->Cell(7, 5, '' . $data['' . $ket[$c] . '_5'] . '', 1, 0, 'C', 1);
                    $kolom_data += 7;
                    $pdf->SetX(53 + $kolom_data);
                    $pdf->Cell(7, 5, '' . $data['' . $ket[$c] . '_6'] . '', 1, 0, 'C', 1);
                    $kolom_data += 7;
                    $pdf->SetX(53 + $kolom_data);
                    $pdf->Cell(7, 5, '' . $data['' . $ket[$c] . '_7'] . '', 1, 0, 'C', 1);
                    $kolom_data += 7;
                    $pdf->SetX(53 + $kolom_data);
                    $pdf->Cell(7, 5, '' . $data['' . $ket[$c] . '_8'] . '', 1, 0, 'C', 1);
                    $kolom_data += 7;
                    $pdf->SetX(53 + $kolom_data);
                    $pdf->Cell(7, 5, '' . $data['' . $ket[$c] . '_9'] . '', 1, 0, 'C', 1);
                    $kolom_data += 7;
                    $pdf->SetX(53 + $kolom_data);
                    $pdf->Cell(7, 5, '' . $data['' . $ket[$c] . '_10'] . '', 1, 0, 'C', 1);
                    $kolom_data += 7;
                    $pdf->SetX(53 + $kolom_data);
                    $pdf->Cell(7, 5, '' . $data['' . $ket[$c] . '_11'] . '', 1, 0, 'C', 1);
                    $kolom_data += 7;
                    $pdf->SetX(53 + $kolom_data);
                    $pdf->Cell(7, 5, '' . $data['' . $ket[$c] . '_12'] . '', 1, 0, 'C', 1);
                    $kolom_data += 7;
                    $pdf->SetX(53 + $kolom_data);
                    $pdf->Cell(7, 5, '' . $data['tot_' . $ket[$c] . ''] . '', 1, 0, 'C', 1);
                    $kolom_data += 7;
                } else if ($ket[$c] == 'lk') {
                    $pdf->SetX(53 + $kolom_data);
                    $pdf->Cell(7, 5, '' . $data['' . $ket[$c] . '_1'] . '', 1, 0, 'C', 1);
                    $kolom_data += 7;
                    $pdf->SetX(53 + $kolom_data);
                    $pdf->Cell(7, 5, '' . $data['' . $ket[$c] . '_2'] . '', 1, 0, 'C', 1);
                    $kolom_data += 7;
                    $pdf->SetX(53 + $kolom_data);
                    $pdf->Cell(7, 5, '' . $data['' . $ket[$c] . '_3'] . '', 1, 0, 'C', 1);
                    $kolom_data += 7;
                    $pdf->SetX(53 + $kolom_data);
                    $pdf->Cell(7, 5, '' . $data['' . $ket[$c] . '_4'] . '', 1, 0, 'C', 1);
                    $kolom_data += 7;
                    $pdf->SetX(53 + $kolom_data);
                    $pdf->Cell(7, 5, '' . $data['' . $ket[$c] . '_5'] . '', 1, 0, 'C', 1);
                    $kolom_data += 7;
                    $pdf->SetX(53 + $kolom_data);
                    $pdf->Cell(7, 5, '' . $data['' . $ket[$c] . '_6'] . '', 1, 0, 'C', 1);
                    $kolom_data += 7;
                    $pdf->SetX(53 + $kolom_data);
                    $pdf->Cell(7, 5, '' . $data['' . $ket[$c] . '_7'] . '', 1, 0, 'C', 1);
                    $kolom_data += 7;
                    $pdf->SetX(53 + $kolom_data);
                    $pdf->Cell(7, 5, '' . $data['' . $ket[$c] . '_8'] . '', 1, 0, 'C', 1);
                    $kolom_data += 7;
                    $pdf->SetX(53 + $kolom_data);
                    $pdf->Cell(7, 5, '' . $data['' . $ket[$c] . '_9'] . '', 1, 0, 'C', 1);
                    $kolom_data += 7;
                    $pdf->SetX(53 + $kolom_data);
                    $pdf->Cell(7, 5, '' . $data['' . $ket[$c] . '_10'] . '', 1, 0, 'C', 1);
                    $kolom_data += 7;
                    $pdf->SetX(53 + $kolom_data);
                    $pdf->Cell(7, 5, '' . $data['' . $ket[$c] . '_11'] . '', 1, 0, 'C', 1);
                    $kolom_data += 7;
                    $pdf->SetX(53 + $kolom_data);
                    $pdf->Cell(7, 5, '' . $data['' . $ket[$c] . '_12'] . '', 1, 0, 'C', 1);
                    $kolom_data += 7;
                    $pdf->SetX(53 + $kolom_data);
                    $pdf->Cell(7, 5, '' . $data['tot_' . $ket[$c] . ''] . '', 1, 0, 'C', 1);
                    $kolom_data += 7;
                }
            }

            $no++;
        }
    }

    $pdf->Output();
} else {

    echo '<script>alert("INGAT : Keterangan Tidak boleh kurang dari 3 atau lebih dari 3, silahkan cek kembali !!!");window.history.go(0);</script>';
}

