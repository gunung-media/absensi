<?php
if (!defined('website')) {include("index.php");die();}

if(!empty($edit)) {
    if($edit)
    {
        echo '
        <script>
            swal({
                text: "Data Keterangan Absensi Karyawan berhasil di edit !!",
                icon: "success",
                type: "success"
            });
        </script>
        ';
    }
    else    
    {
        echo '
        <script>
            swal({
                text: "Data Keterangan Absensi Karyawan gagal di edit!!",
                icon: "error",
                type: "error"
            });
        </script>
        ';
    }
}

?>

<script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>

<div class="content-wrapper">
    <div class="row">
        <br>
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="padding-left: 20px;padding-right: 20px">
            <div>
            <ol class="breadcrumb" style="background-color: #3c8dbc">
                        <li class="active" style="color: #000">
                            <a style="color: #fff" href="">
                            <i class="fa fa-chevron-circle-right"></i> Absensi</a> 
                            <a style="color: #fff" href="">
                            / Belum Absen</a>
                        </li>
                    </ol>
            </div>
        </div>
        <br>

        <!-- content -->
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="padding-left: 20px;padding-right: 20px">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">List Data Karyawan Belum Absen</h3>
                    <a href="<?php echo $BaseUrl; ?>/absensi.php"><button type="button" class="btn btn-sm" style="float:right;background-color:#ffffff;color:#000;line-height:0.8">
                      <i class="fa fa-chevron-circle-left"></i> Kembali
                    </button></a>
                </div>
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-12" >
                            <form action="" method="POST">
                            <button type="submit" name="aksi-edit" class="btn btn-danger btn-sm" id="delete" disabled="disabled"><i class="fa fa-pencil"></i> Submit</button>
                            
                            <br><br>
                            <div class="table-responsive" style="overflow-x:auto;">
                                <table class="table table-bordered table-responsive nowrap example2" id="tableMain">
                                    <thead>
                                        <tr>
                                            <th style="background:#444;color:#fff;">NO</th>
                                            <th style="background:#444;color:#fff;">TANGGAL</th>
                                            <th style="background:#444;color:#fff;">NAMA</th>
                                            <th style="background:green;color:#fff;text-align:center;">TEPAT</th>
                                            <th style="background:blue;color:#fff;text-align:center;">TELAT</th>
                                            <th style="background:purple;color:#fff;text-align:center;">IZIN SIANG</th>
                                            <th style="background:grey;color:#fff;text-align:center;">CUTI</th>
                                            <th style="background:red;color:#fff;text-align:center;">SAKIT</th>
                                            <th style="background:orange;color:#fff;text-align:center;">VISIT</th>
                                            <th style="background:#444;color:#fff;text-align:center;">LUAR KOTA</th>
                                            <th style="background:brown;color:#fff;text-align:center;">JAM</th>
                                            <th style="background:#444;color:#fff;text-align:center;">ALASAN</th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php

                                        $no=1;
                                        $tampil = $database -> tampilKaryawanKehadiran($con);
                                        foreach($tampil as $real)
                                        {
                                            $tmp_tgl = explode("-", $real['tanggal']);
                                            $new_tgl = $tmp_tgl[2].'/'.$tmp_tgl[1].'/'.$tmp_tgl[0];
                                        echo '
                                        <tr>
                                            <td style="text-align:center;">'.$no.'</td>
                                            <td style="text-align:center;">'.$new_tgl.'</td>
                                            <td style="text-align:left;">'.$real['nama'].'</td> 
                                            <td style="text-align:center;"><input type="checkbox" name="absen[]" value="1 '.$real['id_absensi_detail'].'" id="'.$real['id_absensi_detail'].'" class="checkbox checkbox'.$real['id_absensi_detail'].'"></td>
                                            <td style="text-align:center;"><input type="checkbox" name="absen[]" value="3 '.$real['id_absensi_detail'].'" id="'.$real['id_absensi_detail'].'" class="checkbox checkbox'.$real['id_absensi_detail'].'"></td>
                                            <td style="text-align:center;"><input type="checkbox" name="absen[]" value="6 '.$real['id_absensi_detail'].'" id="'.$real['id_absensi_detail'].'" class="checkbox checkbox'.$real['id_absensi_detail'].'"></td>';
                                            
                                            $cuti = mysqli_query($con, "SELECT a.keperluan_cuti, a.created, b.username, a.tgl_dari, a.tgl_sampai, a.tgl_masuk FROM tb_cuti a, tb_karyawan b WHERE a.nama_lengkap = b.nama_lengkap AND a.status = 'Tidak Ambil' AND b.username = '".$real['nama']."' ORDER BY a.id_cuti ASC");
                                            $ct   = mysqli_fetch_array($cuti);
                                            $tgl_skr = date('Y-m-d');

                                            if($ct['username'] == $real['nama'] && $real['tanggal'] < $ct['tgl_masuk'] && $ct['tgl_masuk'] > $tgl_skr) {
                                                echo '<td style="text-align:center;"><input type="checkbox" name="absen[]" value="4 '.$real['id_absensi_detail'].'" id="'.$real['id_absensi_detail'].'" class="checkbox checkbox'.$real['id_absensi_detail'].'" checked></td>';
                                            } else {
                                                echo '<td style="text-align:center;"><input type="checkbox" name="absen[]" value="4 '.$real['id_absensi_detail'].'" id="'.$real['id_absensi_detail'].'" class="checkbox checkbox'.$real['id_absensi_detail'].'"></td>';
                                            }
                                            
                                        echo '
                                            <td style="text-align:center;"><input type="checkbox" name="absen[]" value="2 '.$real['id_absensi_detail'].'" id="'.$real['id_absensi_detail'].'" class="checkbox checkbox'.$real['id_absensi_detail'].'"></td>
                                            <td style="text-align:center;"><input type="checkbox" name="absen[]" value="7 '.$real['id_absensi_detail'].'" id="'.$real['id_absensi_detail'].'" class="checkbox checkbox'.$real['id_absensi_detail'].'"></td>
                                            <td style="text-align:center;"><input type="checkbox" name="absen[]" value="5 '.$real['id_absensi_detail'].'" id="'.$real['id_absensi_detail'].'" class="checkbox checkbox'.$real['id_absensi_detail'].'"></td>
                                            <td style="text-align:center;"><input type="time" name="jam[]" value="00:00" required></td>
                                            <td style="text-align:center;"><input type="text" name="alasan[]" class="form-control" placeholder="..."></td>
                                            
                                        </tr>
                                        ';

                                        $no++;
                                        ?>

                                        <script>
                                            $(document).ready(function() {

                                                $(".checkbox<?php echo $real['id_absensi_detail']; ?>").on("click", function() {
                                                    var numberOfChecked = $('input.checkbox<?php echo $real['id_absensi_detail']; ?>:checkbox:checked').length;
                                                    if (numberOfChecked > 1) {
                                                        $(this).prop('checked', false);
                                                    }
                                                });

                                            });
                                            </script>

                                        <?php
                                        }
                                    ?>
                                    </tbody>
                                </table>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <!-- akhir content -->
    </div>
    <div class="control-sidebar-bg"></div>
</div>                                                                                                                                                                                                        