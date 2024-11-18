<?php
//if (!defined('website')) {include("index.php");die();}   

$tglawal      = mysqli_real_escape_string($con, $_POST["tglawal"]);
$tglakhir     = mysqli_real_escape_string($con, $_POST["tglakhir"]);
$nama         = mysqli_real_escape_string($con, $_POST["nama"]);

$tgl_awal     = explode("/", $tglawal);
$new_awal     = $tgl_awal[2] . "-" . $tgl_awal[1] . "-" . $tgl_awal[0];

$tgl_akhir    = explode("/", $tglakhir);
$new_akhir    = $tgl_akhir[2] . "-" . $tgl_akhir[1] . "-" . $tgl_akhir[0];

$tgl_awal2    = explode("-", $new_awal);
$new_awal2    = $tgl_awal2[2] . "." . $tgl_awal2[1] . "." . $tgl_awal2[0];

$tgl_akhir2   = explode("-", $new_akhir);
$new_akhir2   = $tgl_akhir2[2] . "." . $tgl_akhir2[1] . "." . $tgl_akhir2[0];

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

if (!empty($nama)) {
    $fltr .= "AND a.nama = '" . $nama . "'";
    $paramm .= 'bulan=' . $new_awal . '&tahun=' . $new_akhir . '&nama=' . $nama . '';
} else {
    $paramm .= 'bulan=' . $new_awal . '&tahun=' . $new_akhir . '';
}

$query_cat  = mysqli_query($con, "SELECT jml_denda FROM tb_denda WHERE nama_denda = 'CATERING'");
$cat        = mysqli_fetch_array($query_cat);

$query = mysqli_query($con, "SELECT DISTINCT c.`nama_lengkap`, COUNT(a.id_keterangan) AS jml FROM tb_absensi_detail a, tb_keterangan b, tb_karyawan c WHERE
a.id_keterangan = b.id_keterangan AND a.nama = c.username AND c.status = '1' AND b.`keterangan` NOT IN ('LUAR KOTA','CUTI','SAKIT') AND a.tanggal BETWEEN '" . $new_awal . "' AND '" . $new_akhir . "' $fltr GROUP BY c.`nama_lengkap`");
?>

<div style="background:#fff;height:400px;overflow:scroll">
    <a href="<?php echo $BaseUrl; ?>/models/print-laporan-catering.php?<?php echo $paramm; ?>" target="_blank" style="float:right;margin-right:10px"><button class="btn btn-primary btn-sm"><i class="fa fa-print"></i> Print</button></a>
    <br>
    <hr>
    <center>
        <h3 style="font-size:18px;">Daftar Uang Catering</h3>
        <h2 style="font-size:20px;font-weight:bold;line-height: 0;">Nama Perusahaan Anda</h2>
        <p style="line-height:2">Alamat Lengkap Kantor Anda, Jakarta</p>
    </center>
    <hr size="5" background="red" width="60%">
    <b>Tanggal : </b><?php echo $new_awal2 . ' <i>s/d</i> ' . $new_akhir2; ?>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <b>Total : </b><?php echo mysqli_num_rows($query); ?>
    <table class="table">
        <tr>
            <th>Nama Lengkap</th>
            <th>Jumlah Absen</th>
            <th>Total</th>
        </tr>

        <?php

        if (mysqli_num_rows($query) > 0) {
            while ($data = mysqli_fetch_array($query)) {

                echo '
                    <tr>
                    <td>' . $data['nama_lengkap'] . '</td>
                    <td>' . $data['jml'] . '</td>
                    <td>Rp. ' . rupiah($data['jml'] * $cat['jml_denda']) . '</td>
                    </tr>
                    ';
            }

            echo '<tr><td></td></tr>';
        } else {
            echo '<tr><td colspan="3" style="text-align:center">Daftar Karyawan tidak ada </td></tr>';
        }
        ?>
    </table>
</div>
