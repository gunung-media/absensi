<?php
//if (!defined('website')) {include("index.php");die();}   

$tahun          = mysqli_real_escape_string($con, $_POST["tahun"]);
$nama           = mysqli_real_escape_string($con, $_POST["nama"]);
$jabatan        = mysqli_real_escape_string($con, $_POST["jabatan"]);
$departemen     = mysqli_real_escape_string($con, $_POST["departemen"]);

$fltr   = "";
$paramm = "";

if (!empty($nama) && empty($jabatan) && empty($departemen)) {
    $fltr .= "AND b.nama_lengkap = '" . $nama . "'";
    $paramm .= '&nama=' . $nama . '';
} else if (!empty($nama) && !empty($jabatan) && empty($departemen)) {
    $fltr .= "AND b.nama_lengkap = '" . $nama . "' AND d.nama_jabatan = '" . $jabatan . "'";
    $paramm .= '&nama=' . $nama . '&jabatan=' . $jabatan . '';
} else if (!empty($nama) && !empty($jabatan) && !empty($departemen)) {
    $fltr .= "AND b.nama_lengkap = '" . $nama . "' AND d.nama_jabatan = '" . $jabatan . "' AND c.nama_departemen = '" . $departemen . "'";
    $paramm .= '&nama=' . $nama . '&jabatan=' . $jabatan . '&departemen=' . $departemen . '';
} else if (empty($nama) && !empty($jabatan) && !empty($departemen)) {
    $fltr .= "AND d.nama_jabatan = '" . $jabatan . "' AND c.nama_departemen = '" . $departemen . "'";
    $paramm .= '&jabatan=' . $jabatan . '&departemen=' . $departemen . '';
} else if (empty($nama) && empty($jabatan) && !empty($departemen)) {
    $fltr .= "AND c.nama_departemen = '" . $departemen . "'";
    $paramm .= '&departemen=' . $departemen . '';
} else if (empty($nama) && !empty($jabatan) && empty($departemen)) {
    $fltr .= "AND d.nama_jabatan = '" . $jabatan . "'";
    $paramm .= '&jabatan=' . $jabatan . '';
} else if (!empty($nama) && empty($jabatan) && !empty($departemen)) {
    $fltr .= "AND a.nama = '" . $nama . "' AND c.nama_departemen = '" . $departemen . "'";
    $paramm .= '&nama=' . $nama . '&departemen=' . $departemen . '';
}

$query = mysqli_query($con, "SELECT a.nama_lengkap, a.nama_jabatan, a.masa_kerja, a.hak_cuti, a.jan,a.feb,a.mar,a.apr,a.mei,.a.jun,a.jul,a.agt,a.sep,a.okt,a.nov,a.des, (a.hak_cuti-b.total) AS tot_sisa FROM (
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

?>

<div style="background:#fff;height:400px;overflow:scroll;width:auto">
    <a href="<?php echo $BaseUrl; ?>/models/print-rekap-plant.php?thn=<?php echo $tahun . '' . $param . '' . $paramm; ?>" target="_blank" style="float:right;margin-right:10px"><button class="btn btn-primary btn-sm"><i class="fa fa-print"></i> Print</button></a>
    <br>
    <hr>
    <center>
        <h3 style="font-size:18px;">Daftar Absensi Karyawan Plant / Tahun</h3>
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
            <th colspan="13" style="background:orange;color:#fff;vertical-align:middle;text-align:center">Cuti</th>
        <tr>
            <th style="background:orange;color:#fff;text-align:center">Jan</th>
            <th style="background:orange;color:#fff;text-align:center">Feb</th>
            <th style="background:orange;color:#fff;text-align:center">Mar</th>
            <th style="background:orange;color:#fff;text-align:center">Apr</th>
            <th style="background:orange;color:#fff;text-align:center">Mei</th>
            <th style="background:orange;color:#fff;text-align:center">Jun</th>
            <th style="background:orange;color:#fff;text-align:center">Jul</th>
            <th style="background:orange;color:#fff;text-align:center">Agu</th>
            <th style="background:orange;color:#fff;text-align:center">Sep</th>
            <th style="background:orange;color:#fff;text-align:center">Okt</th>
            <th style="background:orange;color:#fff;text-align:center">Nov</th>
            <th style="background:orange;color:#fff;text-align:center">Des</th>
            <th style="background:orange;color:#fff;text-align:center">Sisa Cuti</th>
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
                        <td>' . $data['nama_jabatan'] . '</td>
                        <td style="font-size:12px;text-align:center">' . $masa_kerja . '</td>
                        <td style="font-size:12px;text-align:center">' . $data['hak_cuti'] . '</td>
                        <td style="font-size:12px;text-align:center">' . $data['jan'] . '</td>
                        <td style="font-size:12px;text-align:center">' . $data['feb'] . '</td>
                        <td style="font-size:12px;text-align:center">' . $data['mar'] . '</td>
                        <td style="font-size:12px;text-align:center">' . $data['apr'] . '</td>
                        <td style="font-size:12px;text-align:center">' . $data['mei'] . '</td>
                        <td style="font-size:12px;text-align:center">' . $data['jun'] . '</td>
                        <td style="font-size:12px;text-align:center">' . $data['jul'] . '</td>
                        <td style="font-size:12px;text-align:center">' . $data['agt'] . '</td>
                        <td style="font-size:12px;text-align:center">' . $data['sep'] . '</td>
                        <td style="font-size:12px;text-align:center">' . $data['okt'] . '</td>
                        <td style="font-size:12px;text-align:center">' . $data['nov'] . '</td>
                        <td style="font-size:12px;text-align:center">' . $data['des'] . '</td>
                        <td style="font-size:12px;text-align:center">' . $data['tot_sisa'] . '</td></tr>';
                $no++;
            }
        } else {
            echo '<tr><td colspan="18" style="text-align:center">Daftar Karyawan tidak ada </td></tr>';
        }
        ?>
    </table>
</div>
