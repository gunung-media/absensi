<?php
//if (!defined('website')) {include("index.php");die();}   

$bulan = mysqli_real_escape_string($con, $_POST["bulan"]);
$tahun = mysqli_real_escape_string($con, $_POST["tahun"]);

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

$query_telat = mysqli_query($con, "SELECT jml_denda FROM tb_denda WHERE nama_denda = 'TELAT'");
$denda       = mysqli_fetch_array($query_telat);

$query_telat_ob = mysqli_query($con, "SELECT jml_denda FROM tb_denda WHERE nama_denda = 'TELAT OB'");
$denda_ob       = mysqli_fetch_array($query_telat_ob);

$query = mysqli_query($con, "SELECT DISTINCT a.nama, a.jabatan, a.tgl_1, a.tgl_2, a.tgl_3, a.tgl_4, a.tgl_5, a.tgl_6, a.tgl_7, 
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
?>

<div style="background:#fff;height:400px;overflow:scroll">
    <a href="<?php echo $BaseUrl; ?>/models/print-laporan-telat.php?bln=<?php echo $bulan; ?>&thn=<?php echo $tahun; ?>" target="_blank" style="float:right;margin-right:10px"><button class="btn btn-primary btn-sm"><i class="fa fa-print"></i> Print</button></a>
    <br>
    <hr>
    <center>
        <h3 style="font-size:18px;">Daftar Karyawan Telat</h3>
        <h2 style="font-size:20px;font-weight:bold;line-height: 0;">Nama Perusahaan Anda</h2>
        <p style="line-height:2">Alamat Lengkap Kantor Anda, Jakarta</p>
        <hr size="5" background="red" width="60%">
        <b>Bulan : </b><?php echo $bln . ' ' . $tahun; ?>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <b>Total : </b><?php echo mysqli_num_rows($query); ?>
        <table class="table table-bordered nowrap">
            <tr>
                <th style="background:#333;color:#fff;vertical-align:middle;text-align:center" rowspan="2">No</th>
                <th style="background:#333;color:#fff;vertical-align:middle;text-align:center" rowspan="2">Nama</th>
                <th colspan="<?php echo $tanggal; ?>" style="background:#333;color:#fff;vertical-align:middle;text-align:center">Tanggal</th>
                <th style="background:#333;color:#fff;vertical-align:middle;text-align:center" rowspan="2">Total Telat</th>
                <th style="background:#333;color:#fff;vertical-align:middle;text-align:center" rowspan="2">Total Denda</th>
            </tr>
            <tr>
                <?php
                for ($i = 1; $i < $tanggal + 1; $i++) {

                    echo '<th style="background:#bb7c08;color:#fff;text-align:center">' . $i . '</th>';
                }

                ?>
            </tr>

            <?php

            if (mysqli_num_rows($query) > 0) {

                $no = 1;

                while ($data = mysqli_fetch_array($query)) {

                    echo '
                        <tr>
                        <td>' . $no . '</td>
                        <td>' . $data['nama'] . '</td>';
                    for ($i = 1; $i < $tanggal + 1; $i++) {
                        if ($data['tgl_' . $i . ''] == "") {
                            echo '<td>-</td>';
                        } else {
                            echo '<td style="background:yellow;font-size:12px">' . $data['tgl_' . $i . ''] . '</td>';
                        }
                    }

                    echo '<td style="text-align:center">' . $data['total'] . '</td>';

                    if ($data['total'] <= '1') {
                        echo '<td style="text-align:center">-</td>';
                    } else {

                        if ($data['jabatan'] == 'OB / Kurir') {
                            echo '<td style="text-align:center" width="100px">Rp. ' . rupiah(($data['total'] * $denda_ob['jml_denda']) - $denda_ob['jml_denda']) . '</td>';
                        } else {
                            echo '<td style="text-align:center" width="100px">Rp. ' . rupiah(($data['total'] * $denda['jml_denda']) - $denda['jml_denda']) . '</td>';
                        }
                    }
                    echo '</tr>';

                    $no++;
                }
            } else {
                echo '<tr><td colspan="33" style="text-align:center">Daftar Karyawan tidak ada </td></tr>';
            }
            ?>
        </table>
</div>
