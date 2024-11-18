<?php
//if (!defined('website')) {include("index.php");die();}   

$tanggal_1  = mysqli_real_escape_string($con, $_POST["tglawal"]);
$tanggal_2  = mysqli_real_escape_string($con, $_POST["tglakhir"]);
$nama       = mysqli_real_escape_string($con, $_POST["nama"]);

$tgl_info_1         = explode("/", $tanggal_1);
$tgl_info_out       = $tgl_info_1[0] . "." . $tgl_info_1[1] . "." . $tgl_info_1[2];
$tgl_info_2         = explode("/", $tanggal_2);
$tgl_info_out_2     = $tgl_info_2[0] . "." . $tgl_info_2[1] . "." . $tgl_info_2[2];

$tgl_info_in1       = explode("/", $tanggal_1);
$tanggal_new_1      = $tgl_info_in1[2] . "-" . $tgl_info_in1[1] . "-" . $tgl_info_in1[0];

$tgl_info_in2       = explode("/", $tanggal_2);
$tanggal_new_2      = $tgl_info_in2[2] . "-" . $tgl_info_in2[1] . "-" . $tgl_info_in2[0];

$tgl_1              = date('d', strtotime($tanggal_new_1));
$tgl_2              = date('d', strtotime($tanggal_new_2));

$bln_1              = date('m', strtotime($tanggal_new_1));
$bln_2              = date('m', strtotime($tanggal_new_2));

$thn_1              = date('Y', strtotime($tanggal_new_1));
$thn_2              = date('Y', strtotime($tanggal_new_2));

$new_date_1         = cal_days_in_month(CAL_GREGORIAN, $bln_1, $thn_1);
$new_date_2         = cal_days_in_month(CAL_GREGORIAN, $bln_2, $thn_2);

for ($i = $tgl_1; $i < $new_date_1 + 1; $i++) {

    $arr_tgl_1[]    = $i;
    $arr_bln_1[]    = $bln_1;
    $arr_thn_1[]    = $thn_1;
    $implode_tgl_1  = implode(',', $arr_tgl_1);
    $implode_thn_1  = implode(',', $arr_thn_1);
}

for ($i = 1; $i < $tgl_2 + 1; $i++) {

    $arr_tgl_2[]    = $i;
    $arr_bln_2[]    = $bln_2;
    $arr_thn_2[]    = $thn_2;
    $implode_tgl_2  = implode(',', $arr_tgl_2);
    $implode_thn_2  = implode(',', $arr_thn_2);
}

$arr_merge          = array_merge($arr_tgl_1, $arr_tgl_2);
$implode_merge      = implode(",", $arr_merge);

$arr_merge_bln      = array_merge($arr_bln_1, $arr_bln_2);
$implode_merge_bln  = implode(",", $arr_merge_bln);

$arr_merge_thn      = array_merge($arr_thn_1, $arr_thn_2);
$implode_merge_thn  = implode(",", $arr_merge_thn);

$fltr   = "";
$paramm = "";

if (!empty($nama)) {
    $fltr .= "AND a.nama = '" . $nama . "'";
    $paramm .= 'tglawal=' . $tanggal_new_1 . '&tglakhir=' . $tanggal_new_2 . '&nama=' . $nama . '';
} else {
    $paramm .= 'tglawal=' . $tanggal_new_1 . '&tglakhir=' . $tanggal_new_2 . '';
}

$query = mysqli_query($con, "SELECT a.nama_lengkap, a.nama, a.nama_departemen, a.tgl_1, a.tgl_2, a.tgl_3, a.tgl_4, a.tgl_5, a.tgl_6, a.tgl_7, 
        a.tgl_8, a.tgl_9, a.tgl_10, a.tgl_11, a.tgl_12, a.tgl_13, a.tgl_14, a.tgl_15,
        a.tgl_16, a.tgl_17, a.tgl_18, a.tgl_19, a.tgl_20, a.tgl_21, a.tgl_22, a.tgl_23,
        a.tgl_24, a.tgl_25,b.tgl_26,b.tgl_27,b.tgl_28,b.tgl_29,b.tgl_30,b.tgl_31,b.tgl_32,b.tgl_33,b.tgl_34,b.tgl_35  
        FROM (
        
        SELECT a.nama_lengkap, a.nama, a.nama_departemen, tgl_1, tgl_2, tgl_3, tgl_4, tgl_5, tgl_6, tgl_7, 
        tgl_8, tgl_9, tgl_10, tgl_11, tgl_12, tgl_13, tgl_14, tgl_15,
        tgl_16, tgl_17, tgl_18, tgl_19, tgl_20, tgl_21, tgl_22, tgl_23,
        tgl_24,tgl_25 
        FROM (
 
    SELECT a.nama, d.nama_departemen, c.nama_lengkap FROM tb_absensi_detail a, tb_keterangan b, tb_karyawan c, tb_departemen d WHERE a.id_keterangan = b.id_keterangan AND a.nama = c.username 
    AND c.id_departemen = d.id_departemen AND a.tanggal BETWEEN '$tanggal_new_1' AND '$tanggal_new_2' AND c.status = '1' AND d.nama_departemen NOT IN ('PLANT') $fltr GROUP BY a.nama
        
        ) AS a LEFT JOIN(
        
        SELECT b.kode AS tgl_1, a.nama FROM tb_absensi_detail a, tb_keterangan b
        WHERE a.id_keterangan = b.id_keterangan AND DAY(a.tanggal) = '$arr_merge[0]' AND a.tanggal BETWEEN '$tanggal_new_1' AND '$tanggal_new_2' AND MONTH(a.tanggal) = '$arr_merge_bln[0]' AND YEAR(a.tanggal) = '$arr_merge_thn[0]' $fltr  
        ) AS b ON a.nama = b.nama LEFT JOIN (
        SELECT b.kode AS tgl_2, a.nama FROM tb_absensi_detail a, tb_keterangan b
        WHERE a.id_keterangan = b.id_keterangan AND DAY(a.tanggal) = '$arr_merge[1]' AND a.tanggal BETWEEN '$tanggal_new_1' AND '$tanggal_new_2' AND MONTH(a.tanggal) = '$arr_merge_bln[1]' AND YEAR(a.tanggal) = '$arr_merge_thn[1]' $fltr
    ) AS c ON a.nama = c.nama LEFT JOIN (
        SELECT b.kode AS tgl_3, a.nama FROM tb_absensi_detail a, tb_keterangan b
        WHERE a.id_keterangan = b.id_keterangan AND DAY(a.tanggal) = '$arr_merge[2]' AND a.tanggal BETWEEN '$tanggal_new_1' AND '$tanggal_new_2' AND MONTH(a.tanggal) = '$arr_merge_bln[2]' AND YEAR(a.tanggal) = '$arr_merge_thn[2]' $fltr 
    ) AS d ON a.nama = d.nama LEFT JOIN (
        SELECT b.kode AS tgl_4, a.nama FROM tb_absensi_detail a, tb_keterangan b
        WHERE a.id_keterangan = b.id_keterangan AND DAY(a.tanggal) = '$arr_merge[3]' AND a.tanggal BETWEEN '$tanggal_new_1' AND '$tanggal_new_2' AND MONTH(a.tanggal) = '$arr_merge_bln[3]' AND YEAR(a.tanggal) = '$arr_merge_thn[3]' $fltr
    ) AS e ON a.nama = e.nama LEFT JOIN (
        SELECT b.kode tgl_5, a.nama FROM tb_absensi_detail a, tb_keterangan b
        WHERE a.id_keterangan = b.id_keterangan AND DAY(a.tanggal) = '$arr_merge[4]' AND a.tanggal BETWEEN '$tanggal_new_1' AND '$tanggal_new_2' AND MONTH(a.tanggal) = '$arr_merge_bln[4]' AND YEAR(a.tanggal) = '$arr_merge_thn[4]' $fltr 
    ) AS f ON a.nama = f.nama LEFT JOIN (
        SELECT b.kode AS tgl_6, a.nama FROM tb_absensi_detail a, tb_keterangan b
        WHERE a.id_keterangan = b.id_keterangan AND DAY(a.tanggal) = '$arr_merge[5]' AND a.tanggal BETWEEN '$tanggal_new_1' AND '$tanggal_new_2' AND MONTH(a.tanggal) = '$arr_merge_bln[5]' AND YEAR(a.tanggal) = '$arr_merge_thn[5]' $fltr
    ) AS g ON a.nama = g.nama LEFT JOIN (
        SELECT b.kode AS tgl_7, a.nama FROM tb_absensi_detail a, tb_keterangan b
        WHERE a.id_keterangan = b.id_keterangan AND DAY(a.tanggal) = '$arr_merge[6]' AND a.tanggal BETWEEN '$tanggal_new_1' AND '$tanggal_new_2' AND MONTH(a.tanggal) = '$arr_merge_bln[6]' AND YEAR(a.tanggal) = '$arr_merge_thn[6]' $fltr
    ) AS h ON a.nama = h.nama LEFT JOIN (   
        SELECT b.kode AS tgl_8, a.nama FROM tb_absensi_detail a, tb_keterangan b
        WHERE a.id_keterangan = b.id_keterangan AND DAY(a.tanggal) = '$arr_merge[7]' AND a.tanggal BETWEEN '$tanggal_new_1' AND '$tanggal_new_2' AND MONTH(a.tanggal) = '$arr_merge_bln[7]' AND YEAR(a.tanggal) = '$arr_merge_thn[7]' $fltr
    ) AS i ON a.nama = i.nama LEFT JOIN (   
        SELECT b.kode AS tgl_9, a.nama FROM tb_absensi_detail a, tb_keterangan b
        WHERE a.id_keterangan = b.id_keterangan AND DAY(a.tanggal) = '$arr_merge[8]' AND a.tanggal BETWEEN '$tanggal_new_1' AND '$tanggal_new_2' AND MONTH(a.tanggal) = '$arr_merge_bln[8]' AND YEAR(a.tanggal) = '$arr_merge_thn[8]' $fltr 
    ) AS j ON a.nama = j.nama LEFT JOIN (   
        SELECT b.kode AS tgl_10, a.nama FROM tb_absensi_detail a, tb_keterangan b
        WHERE a.id_keterangan = b.id_keterangan AND DAY(a.tanggal) = '$arr_merge[9]' AND a.tanggal BETWEEN '$tanggal_new_1' AND '$tanggal_new_2' AND MONTH(a.tanggal) = '$arr_merge_bln[9]' AND YEAR(a.tanggal) = '$arr_merge_thn[9]' $fltr
    ) AS k ON a.nama = k.nama LEFT JOIN (   
        SELECT b.kode AS tgl_11, a.nama FROM tb_absensi_detail a, tb_keterangan b
        WHERE a.id_keterangan = b.id_keterangan AND DAY(a.tanggal) = '$arr_merge[10]' AND a.tanggal BETWEEN '$tanggal_new_1' AND '$tanggal_new_2' AND MONTH(a.tanggal) = '$arr_merge_bln[10]' AND YEAR(a.tanggal) = '$arr_merge_thn[10]' $fltr
    ) AS l ON a.nama = l.nama LEFT JOIN (   
        SELECT b.kode AS tgl_12, a.nama FROM tb_absensi_detail a, tb_keterangan b
        WHERE a.id_keterangan = b.id_keterangan AND DAY(a.tanggal) = '$arr_merge[11]' AND a.tanggal BETWEEN '$tanggal_new_1' AND '$tanggal_new_2' AND MONTH(a.tanggal) = '$arr_merge_bln[11]' AND YEAR(a.tanggal) = '$arr_merge_thn[11]' $fltr
    ) AS m ON a.nama = m.nama LEFT JOIN (
        SELECT b.kode AS tgl_13, a.nama FROM tb_absensi_detail a, tb_keterangan b
        WHERE a.id_keterangan = b.id_keterangan AND DAY(a.tanggal) = '$arr_merge[12]' AND a.tanggal BETWEEN '$tanggal_new_1' AND '$tanggal_new_2' AND MONTH(a.tanggal) = '$arr_merge_bln[12]' AND YEAR(a.tanggal) = '$arr_merge_thn[12]' $fltr
    ) AS n ON a.nama = n.nama LEFT JOIN (
        SELECT b.kode AS tgl_14, a.nama FROM tb_absensi_detail a, tb_keterangan b
        WHERE a.id_keterangan = b.id_keterangan AND DAY(a.tanggal) = '$arr_merge[13]' AND a.tanggal BETWEEN '$tanggal_new_1' AND '$tanggal_new_2' AND MONTH(a.tanggal) = '$arr_merge_bln[13]' AND YEAR(a.tanggal) = '$arr_merge_thn[13]' $fltr 
    ) AS o ON a.nama = o.nama LEFT JOIN (
        SELECT b.kode AS tgl_15, a.nama FROM tb_absensi_detail a, tb_keterangan b
        WHERE a.id_keterangan = b.id_keterangan AND DAY(a.tanggal) = '$arr_merge[14]' AND a.tanggal BETWEEN '$tanggal_new_1' AND '$tanggal_new_2' AND MONTH(a.tanggal) = '$arr_merge_bln[14]' AND YEAR(a.tanggal) = '$arr_merge_thn[14]' $fltr
    ) AS p ON a.nama = p.nama LEFT JOIN (
        SELECT b.kode AS tgl_16, a.nama FROM tb_absensi_detail a, tb_keterangan b
        WHERE a.id_keterangan = b.id_keterangan AND DAY(a.tanggal) = '$arr_merge[15]' AND a.tanggal BETWEEN '$tanggal_new_1' AND '$tanggal_new_2' AND MONTH(a.tanggal) = '$arr_merge_bln[15]' AND YEAR(a.tanggal) = '$arr_merge_thn[15]' $fltr
    ) AS q ON a.nama = q.nama LEFT JOIN (
        SELECT b.kode AS tgl_17, a.nama FROM tb_absensi_detail a, tb_keterangan b
        WHERE a.id_keterangan = b.id_keterangan AND DAY(a.tanggal) = '$arr_merge[16]' AND a.tanggal BETWEEN '$tanggal_new_1' AND '$tanggal_new_2' AND MONTH(a.tanggal) = '$arr_merge_bln[16]' AND YEAR(a.tanggal) = '$arr_merge_thn[16]' $fltr 
    ) AS r ON a.nama = r.nama LEFT JOIN (
        SELECT b.kode AS tgl_18, a.nama FROM tb_absensi_detail a, tb_keterangan b
        WHERE a.id_keterangan = b.id_keterangan AND DAY(a.tanggal) = '$arr_merge[17]' AND a.tanggal BETWEEN '$tanggal_new_1' AND '$tanggal_new_2' AND MONTH(a.tanggal) = '$arr_merge_bln[17]' AND YEAR(a.tanggal) = '$arr_merge_thn[17]' $fltr 
    ) AS s ON a.nama = s.nama LEFT JOIN (
        SELECT b.kode AS tgl_19, a.nama FROM tb_absensi_detail a, tb_keterangan b
        WHERE a.id_keterangan = b.id_keterangan AND DAY(a.tanggal) = '$arr_merge[18]' AND a.tanggal BETWEEN '$tanggal_new_1' AND '$tanggal_new_2' AND MONTH(a.tanggal) = '$arr_merge_bln[18]' AND YEAR(a.tanggal) = '$arr_merge_thn[18]' $fltr
    ) AS t ON a.nama = t.nama LEFT JOIN (   
        SELECT b.kode AS tgl_20, a.nama FROM tb_absensi_detail a, tb_keterangan b
        WHERE a.id_keterangan = b.id_keterangan AND DAY(a.tanggal) = '$arr_merge[19]' AND a.tanggal BETWEEN '$tanggal_new_1' AND '$tanggal_new_2' AND MONTH(a.tanggal) = '$arr_merge_bln[19]' AND YEAR(a.tanggal) = '$arr_merge_thn[19]' $fltr
    ) AS u ON a.nama = u.nama LEFT JOIN (
        SELECT b.kode AS tgl_21, a.nama FROM tb_absensi_detail a, tb_keterangan b
        WHERE a.id_keterangan = b.id_keterangan AND DAY(a.tanggal) = '$arr_merge[20]' AND a.tanggal BETWEEN '$tanggal_new_1' AND '$tanggal_new_2' AND MONTH(a.tanggal) = '$arr_merge_bln[20]' AND YEAR(a.tanggal) = '$arr_merge_thn[20]' $fltr
    ) AS v ON a.nama = v.nama LEFT JOIN (
        SELECT b.kode AS tgl_22, a.nama FROM tb_absensi_detail a, tb_keterangan b
        WHERE a.id_keterangan = b.id_keterangan AND DAY(a.tanggal) = '$arr_merge[21]' AND a.tanggal BETWEEN '$tanggal_new_1' AND '$tanggal_new_2' AND MONTH(a.tanggal) = '$arr_merge_bln[21]' AND YEAR(a.tanggal) = '$arr_merge_thn[21]' $fltr
    ) AS w ON a.nama = w.nama LEFT JOIN (
        SELECT b.kode AS tgl_23, a.nama FROM tb_absensi_detail a, tb_keterangan b
        WHERE a.id_keterangan = b.id_keterangan AND DAY(a.tanggal) = '$arr_merge[22]' AND a.tanggal BETWEEN '$tanggal_new_1' AND '$tanggal_new_2' AND MONTH(a.tanggal) = '$arr_merge_bln[22]' AND YEAR(a.tanggal) = '$arr_merge_thn[22]' $fltr
    ) AS aa ON a.nama = aa.nama LEFT JOIN (
        SELECT b.kode AS tgl_24, a.nama FROM tb_absensi_detail a, tb_keterangan b
        WHERE a.id_keterangan = b.id_keterangan AND DAY(a.tanggal) = '$arr_merge[23]' AND a.tanggal BETWEEN '$tanggal_new_1' AND '$tanggal_new_2' AND MONTH(a.tanggal) = '$arr_merge_bln[23]' AND YEAR(a.tanggal) = '$arr_merge_thn[23]' $fltr
    ) AS ab ON a.nama = ab.nama LEFT JOIN (
        SELECT b.kode AS tgl_25, a.nama FROM tb_absensi_detail a, tb_keterangan b
        WHERE a.id_keterangan = b.id_keterangan AND DAY(a.tanggal) = '$arr_merge[24]' AND a.tanggal BETWEEN '$tanggal_new_1' AND '$tanggal_new_2' AND MONTH(a.tanggal) = '$arr_merge_bln[24]' AND YEAR(a.tanggal) = '$arr_merge_thn[24]' $fltr 
    ) AS ac ON a.nama = ac.nama ORDER BY a.nama ASC
    
    ) AS a LEFT OUTER JOIN (
    
    SELECT a.nama,tgl_26,tgl_27,tgl_28,tgl_29,tgl_30,tgl_31,tgl_32,tgl_33,tgl_34,tgl_35
        FROM (
 
    SELECT a.nama, d.nama_departemen, c.nama_lengkap FROM tb_absensi_detail a, tb_keterangan b, tb_karyawan c, tb_departemen d WHERE a.id_keterangan = b.id_keterangan AND a.nama = c.username 
    AND c.id_departemen = d.id_departemen AND a.tanggal BETWEEN '$tanggal_new_1' AND '$tanggal_new_2' AND c.status = '1' AND d.nama_departemen NOT IN ('PLANT') $fltr GROUP BY a.nama
        
        ) AS a LEFT JOIN(
        SELECT b.kode AS tgl_26, a.nama FROM tb_absensi_detail a, tb_keterangan b
        WHERE a.id_keterangan = b.id_keterangan AND DAY(a.tanggal) = '$arr_merge[25]' AND a.tanggal BETWEEN '$tanggal_new_1' AND '$tanggal_new_2' AND MONTH(a.tanggal) = '$arr_merge_bln[25]' AND YEAR(a.tanggal) = '$arr_merge_thn[25]' $fltr
    ) AS ad ON a.nama = ad.nama LEFT JOIN (
        SELECT b.kode AS tgl_27, a.nama FROM tb_absensi_detail a, tb_keterangan b
        WHERE a.id_keterangan = b.id_keterangan AND DAY(a.tanggal) = '$arr_merge[26]' AND a.tanggal BETWEEN '$tanggal_new_1' AND '$tanggal_new_2' AND MONTH(a.tanggal) = '$arr_merge_bln[25]' AND YEAR(a.tanggal) = '$arr_merge_thn[26]' $fltr
    ) AS ae ON a.nama = ae.nama LEFT JOIN (
        SELECT b.kode AS tgl_28, a.nama FROM tb_absensi_detail a, tb_keterangan b
        WHERE a.id_keterangan = b.id_keterangan AND DAY(a.tanggal) = '$arr_merge[27]' AND a.tanggal BETWEEN '$tanggal_new_1' AND '$tanggal_new_2' AND MONTH(a.tanggal) = '$arr_merge_bln[27]' AND YEAR(a.tanggal) = '$arr_merge_thn[27]' $fltr
    ) AS af ON a.nama = af.nama LEFT JOIN (
        SELECT b.kode AS tgl_29, a.nama FROM tb_absensi_detail a, tb_keterangan b
        WHERE a.id_keterangan = b.id_keterangan AND DAY(a.tanggal) = '$arr_merge[28]' AND a.tanggal BETWEEN '$tanggal_new_1' AND '$tanggal_new_2' AND MONTH(a.tanggal) = '$arr_merge_bln[28]' AND YEAR(a.tanggal) = '$arr_merge_thn[28]' $fltr
    ) AS ag ON a.nama = ag.nama LEFT JOIN (
        SELECT b.kode AS tgl_30, a.nama FROM tb_absensi_detail a, tb_keterangan b
        WHERE a.id_keterangan = b.id_keterangan AND DAY(a.tanggal) = '$arr_merge[29]' AND a.tanggal BETWEEN '$tanggal_new_1' AND '$tanggal_new_2' AND MONTH(a.tanggal) = '$arr_merge_bln[29]' AND YEAR(a.tanggal) = '$arr_merge_thn[29]' $fltr 
    ) AS ah ON a.nama = ah.nama LEFT JOIN (
        SELECT b.kode AS tgl_31, a.nama FROM tb_absensi_detail a, tb_keterangan b
        WHERE a.id_keterangan = b.id_keterangan AND DAY(a.tanggal) = '$arr_merge[30]' AND a.tanggal BETWEEN '$tanggal_new_1' AND '$tanggal_new_2' AND MONTH(a.tanggal) = '$arr_merge_bln[30]' AND YEAR(a.tanggal) = '$arr_merge_thn[30]' $fltr
    ) AS ai ON a.nama = ai.nama LEFT JOIN (
        SELECT b.kode AS tgl_32, a.nama FROM tb_absensi_detail a, tb_keterangan b
        WHERE a.id_keterangan = b.id_keterangan AND DAY(a.tanggal) = '$arr_merge[31]' AND a.tanggal BETWEEN '$tanggal_new_1' AND '$tanggal_new_2' AND MONTH(a.tanggal) = '$arr_merge_bln[31]' AND YEAR(a.tanggal) = '$arr_merge_thn[31]' $fltr
    ) AS aj ON a.nama = aj.nama LEFT JOIN (
        SELECT b.kode AS tgl_33, a.nama FROM tb_absensi_detail a, tb_keterangan b
        WHERE a.id_keterangan = b.id_keterangan AND DAY(a.tanggal) = '$arr_merge[32]' AND a.tanggal BETWEEN '$tanggal_new_1' AND '$tanggal_new_2' AND MONTH(a.tanggal) = '$arr_merge_bln[32]' AND YEAR(a.tanggal) = '$arr_merge_thn[32]' $fltr 
    ) AS ak ON a.nama = ak.nama LEFT JOIN (
        SELECT b.kode AS tgl_34, a.nama FROM tb_absensi_detail a, tb_keterangan b
        WHERE a.id_keterangan = b.id_keterangan AND DAY(a.tanggal) = '$arr_merge[33]' AND a.tanggal BETWEEN '$tanggal_new_1' AND '$tanggal_new_2' AND MONTH(a.tanggal) = '$arr_merge_bln[33]' AND YEAR(a.tanggal) = '$arr_merge_thn[33]' $fltr 
    ) AS am ON a.nama = am.nama LEFT JOIN (
        SELECT b.kode AS tgl_35, a.nama FROM tb_absensi_detail a, tb_keterangan b
        WHERE a.id_keterangan = b.id_keterangan AND DAY(a.tanggal) = '$arr_merge[34]' AND a.tanggal BETWEEN '$tanggal_new_1' AND '$tanggal_new_2' AND MONTH(a.tanggal) = '$arr_merge_bln[34]' AND YEAR(a.tanggal) = '$arr_merge_thn[34]' $fltr 
    ) AS an ON a.nama = an.nama ORDER BY a.nama ASC
    ) AS b ON a.nama = b.nama");
?>

<div style="background:#fff;height:400px;overflow:scroll;width:auto">
    <a href="<?php echo $BaseUrl; ?>/models/print-rekap-catering.php?<?php echo $paramm; ?>" target="_blank" style="float:right;margin-right:10px"><button class="btn btn-primary btn-sm"><i class="fa fa-print"></i> Print</button></a>
    <br>
    <hr>
    <center>
        <h3 style="font-size:18px;">Daftar Absensi Karyawan / Bulan</h3>
        <h2 style="font-size:20px;font-weight:bold;line-height: 0;">Nama Perusahaan Anda</h2>
        <p style="line-height:2">Alamat Lengkap Kantor Anda, Jakarta</p>
    </center>
    <hr size="5" background="red" width="60%">
    <b>Bulan : </b><?php echo $tgl_info_out . ' s/d ' . $tgl_info_out_2; ?>

    <table class="table table-bordered table-sm">
        <tr>
            <th style="background:#333;color:#fff;vertical-align:middle;text-align:center" rowspan="3">No</th>
            <th style="background:#333;color:#fff;vertical-align:middle;text-align:center" rowspan="3" width="50%">Nama</th>
            <th colspan="<?php echo count($arr_merge); ?>" style="background:#333;color:#fff;vertical-align:middle;text-align:center">Hari/Tanggal</th>
            <th style="background:#333;color:#fff;vertical-align:middle;text-align:center" colspan="6" rowspan="2">Total</th>
        </tr>
        <tr>
            <?php
            for ($i = 0; $i < count($arr_merge); $i++) {

                $tgl = $arr_merge_thn[$i] . '-' . $arr_merge_bln[$i] . '-' . $arr_merge[$i] . '';

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
                    echo '<th style="background:red;color:#fff;vertical-align:middle;text-align:center;"><i style="transform: rotate(90deg);transform-origin: top left;">' . $dayList[$day] . '</i></th>';
                } else {
                    echo '<th style="background:#333;color:#fff;vertical-align:middle;text-align:center;"><i style="transform: rotate(90deg);transform-origin: top left;">' . $dayList[$day] . '</i></th>';
                }
            }
            ?>
        </tr>
        <tr>
            <?php
            for ($i = 0; $i < count($arr_merge); $i++) {

                $tgl = $arr_merge_thn[$i] . '-' . $arr_merge_bln[$i] . '-' . $arr_merge[$i] . '';

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
                    echo '<th style="background:red;color:#fff;text-align:center">' . $arr_merge[$i] . '</th>';
                } else {
                    echo '<th style="background:#bb7c08;color:#fff;text-align:center">' . $arr_merge[$i] . '</th>';
                }
            }

            ?>
            <th style="background:#333;color:#fff;vertical-align:middle;text-align:center">Telat</th>
            <th style="background:#333;color:#fff;vertical-align:middle;text-align:center">Siang</th>
            <th style="background:#333;color:#fff;vertical-align:middle;text-align:center">Cuti</th>
            <th style="background:#333;color:#fff;vertical-align:middle;text-align:center">Sakit</th>
            <th style="background:#333;color:#fff;vertical-align:middle;text-align:center">Visit</th>
            <th style="background:#333;color:#fff;vertical-align:middle;text-align:center">LK</th>
        </tr>

        <?php

        if (mysqli_num_rows($query) > 0) {

            $no = 1;

            while ($data = mysqli_fetch_array($query)) {

                echo '
                        <tr>
                        <td>' . $no . '</td>
                        <td>' . $data['nama_lengkap'] . '</td>';
                $num = 1;
                for ($j = 0; $j < count($arr_merge); $j++) {

                    $tgl = $arr_merge_thn[$j] . '-' . $arr_merge_bln[$j] . '-' . $arr_merge[$j] . '';

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

                    if ($data['tgl_' . $num . ''] == "" && $dayList[$day] == 'Min' || $dayList[$day] == 'Sab') {
                        echo '<td style="background:red;color:#fff;text-align:center"></td>';
                    } else if ($data['tgl_' . $num . ''] == "") {
                        echo '<td style="font-size:12px;text-align:center">-</td>';
                    } else {
                        if ($data['tgl_' . $num . ''] == 'T') {
                            echo '<td style="font-size:12px;background:orange;text-align:center">' . $data['tgl_' . $num . ''] . '</td>';
                        } else if ($data['tgl_' . $num . ''] == 'SG') {
                            echo '<td style="font-size:12px;background:#a5e5f2;text-align:center">' . $data['tgl_' . $num . ''] . '</td>';
                        } else if ($data['tgl_' . $num . ''] == 'C') {
                            echo '<td style="font-size:12px;background:#d9d5d7;text-align:center">' . $data['tgl_' . $num . ''] . '</td>';
                        } else if ($data['tgl_' . $num . ''] == 'S') {
                            echo '<td style="font-size:12px;background:#f2a4cc;text-align:center">' . $data['tgl_' . $num . ''] . '</td>';
                        } else if ($data['tgl_' . $num . ''] == 'P') {
                            echo '<td style="font-size:12px;background:#c7d91f;text-align:center">' . $data['tgl_' . $num . ''] . '</td>';
                        } else if ($data['tgl_' . $num . ''] == 'LK') {
                            echo '<td style="font-size:12px;background:#1fd95b;text-align:center">' . $data['tgl_' . $num . ''] . '</td>';
                        } else {
                            echo '<td style="font-size:12px;text-align:center">' . $data['tgl_' . $num . ''] . '</td>';
                        }
                    }

                    $num++;
                }

                $query_spek = mysqli_query($con, "SELECT a.nama,IFNULL(b.total_telat,0) AS telat,
                    IFNULL(c.total_izin,0) AS izin, IFNULL(d.total_cuti,0) AS cuti, IFNULL(e.total_sakit,0) AS sakit, IFNULL(f.total_visit,0) AS visit,
                    IFNULL(g.total_lk,0) AS luar_kota,
                    IFNULL(h.total_tepat,0) AS masuk FROM (
                
                SELECT a.nama, d.nama_departemen, c.nama_lengkap FROM tb_absensi_detail a, tb_keterangan b, tb_karyawan c, tb_departemen d WHERE a.id_keterangan = b.id_keterangan AND a.nama = c.username 
                AND c.id_departemen = d.id_departemen AND a.tanggal BETWEEN '$tanggal_new_1' AND '$tanggal_new_2' AND a.nama = '" . $data['nama'] . "' AND c.status = '1'  GROUP BY a.nama
                    
                    ) AS a LEFT JOIN(
                    SELECT a.nama, COUNT(a.id_keterangan) AS total_telat FROM tb_absensi_detail a, tb_keterangan b WHERE a.id_keterangan = b.id_keterangan 
                    AND a.tanggal BETWEEN '$tanggal_new_1' AND '$tanggal_new_2' AND a.nama = '" . $data['nama'] . "' AND b.keterangan = 'TELAT'  GROUP BY a.nama
                    ) AS b ON a.nama = b.nama LEFT JOIN (
                    SELECT a.nama, COUNT(a.id_keterangan) AS total_izin FROM tb_absensi_detail a, tb_keterangan b WHERE a.id_keterangan = b.id_keterangan 
                    AND a.tanggal BETWEEN '$tanggal_new_1' AND '$tanggal_new_2' AND a.nama = '" . $data['nama'] . "' AND b.keterangan = 'IZIN SIANG'  GROUP BY a.nama
                    ) AS c ON a.nama = c.nama LEFT JOIN (
                    SELECT a.nama, COUNT(a.id_keterangan) AS total_cuti FROM tb_absensi_detail a, tb_keterangan b WHERE a.id_keterangan = b.id_keterangan 
                    AND a.tanggal BETWEEN '$tanggal_new_1' AND '$tanggal_new_2' AND a.nama = '" . $data['nama'] . "' AND b.keterangan = 'CUTI'  GROUP BY a.nama
                    ) AS d ON a.nama = d.nama LEFT JOIN (
                    SELECT a.nama, COUNT(a.id_keterangan) AS total_sakit FROM tb_absensi_detail a, tb_keterangan b WHERE a.id_keterangan = b.id_keterangan 
                    AND a.tanggal BETWEEN '$tanggal_new_1' AND '$tanggal_new_2' AND a.nama = '" . $data['nama'] . "' AND b.keterangan = 'SAKIT'  GROUP BY a.nama
                    ) AS e ON a.nama = e.nama LEFT JOIN (
                    SELECT a.nama, COUNT(a.id_keterangan) AS total_visit FROM tb_absensi_detail a, tb_keterangan b WHERE a.id_keterangan = b.id_keterangan 
                    AND a.tanggal BETWEEN '$tanggal_new_1' AND '$tanggal_new_2' AND a.nama = '" . $data['nama'] . "' AND b.keterangan = 'VISIT'  GROUP BY a.nama
                    ) AS f ON a.nama = f.nama LEFT JOIN(
                    SELECT a.nama, COUNT(a.id_keterangan) AS total_lk FROM tb_absensi_detail a, tb_keterangan b WHERE a.id_keterangan = b.id_keterangan 
                    AND a.tanggal BETWEEN '$tanggal_new_1' AND '$tanggal_new_2' AND a.nama = '" . $data['nama'] . "' AND b.keterangan = 'LUAR KOTA'  GROUP BY a.nama
                    ) AS g ON a.nama = g.nama LEFT JOIN(
                    SELECT a.nama, COUNT(a.id_keterangan) AS total_tepat FROM tb_absensi_detail a, tb_keterangan b WHERE a.id_keterangan = b.id_keterangan 
                    AND a.tanggal BETWEEN '$tanggal_new_1' AND '$tanggal_new_2' AND a.nama = '" . $data['nama'] . "' AND b.keterangan NOT IN ('LUAR KOTA','CUTI','SAKIT') GROUP BY a.nama
                    ) AS h ON a.nama = h.nama ORDER BY a.nama ASC");

                $d = mysqli_fetch_array($query_spek);

                echo '<td style="font-size:12px;text-align:center">' . $d['telat'] . '</td>';
                echo '<td style="font-size:12px;text-align:center">' . $d['izin'] . '</td>';
                echo '<td style="font-size:12px;text-align:center">' . $d['cuti'] . '</td>';
                echo '<td style="font-size:12px;text-align:center">' . $d['sakit'] . '</td>';
                echo '<td style="font-size:12px;text-align:center">' . $d['visit'] . '</td>';
                echo '<td style="font-size:12px;text-align:center">' . $d['luar_kota'] . '</td>';
                echo '</tr>';

                $no++;
            }
        } else {
            echo '<tr><td colspan="' . count($arr_merge) . '" style="text-align:center">Daftar Karyawan tidak ada </td></tr>';
        }
        ?>
    </table>
</div>
