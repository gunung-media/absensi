<?php

include "../config.php";

$id     = $_POST["id_absensi_detail"];
$detail = mysqli_query($con,"SELECT a.id_absensi_detail,a.tanggal,a.jam,a.id_keterangan, b.nama_lengkap, a.nama, c.nama_jabatan, d.nama_departemen,e.keterangan,a.alasan FROM tb_absensi_detail a
                      LEFT JOIN tb_karyawan b ON a.nama = b.username
                      LEFT JOIN tb_jabatan c ON b.id_jabatan = c.id_jabatan
                      LEFT JOIN tb_departemen d ON b.id_departemen = d.id_departemen
                      LEFT JOIN tb_keterangan e ON a.id_keterangan = e.id_keterangan WHERE a.id_absensi_detail = '$id'");
$data   = mysqli_fetch_array($detail);

$tmp_tgl    = explode("-", $data['tanggal']);
$format_tgl = $tmp_tgl[2]."/".$tmp_tgl[1]."/".$tmp_tgl[0];

echo '
<div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
            <h4 class="modal-title" id="myModalLabel"><i class="fa fa-pencil"></i> Edit Keterangan Absensi</h4>
        </div>
        <div class="modal-body">
            <div class="row">
                <form class="form-horizontal" action="'.$BaseUrl.'/absensi&edit=true&token='.$token.'.php" method="POST">
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-3 control-label">Tanggal</label>
                    <div class="col-sm-7">
                        <input type="text" id="username" name="tanggal" class="form-control" value="'.$format_tgl.'" required readonly>
                        <input type="hidden" name="id_absensi_detail" value="'.$data['id_absensi_detail'].'">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-3 control-label">Nama Lengkap</label>
                    <div class="col-sm-7">
                        <input type="text" id="username" name="nama_lengkap" class="form-control" value="'.$data['nama_lengkap'].'" required readonly>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-3 control-label">Username</label>
                    <div class="col-sm-7">
                        <input type="text" id="username" name="username" class="form-control" value="'.$data['nama'].'" required readonly>
                    </div>
                </div>

                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-3 control-label">Keterangan</label>
                    <div class="col-sm-7"><select class="form-control" name="keterangan">';
                        echo '<option value="'.$data['id_keterangan'].'">'.$data['keterangan'].'</option>';
                        echo '<option value="">-- Pilih Keterangan --</option>';
                        $keterangan = mysqli_query($con, "SELECT * FROM tb_keterangan ORDER BY id_keterangan ASC");
                        while($ket = mysqli_fetch_array($keterangan))
                        {
                            echo '<option value="'.$ket['id_keterangan'].'">'.$ket['keterangan'].'</option>';
                        }
                echo '  </select></div>
                </div>
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-3 control-label">Waktu</label>
                    <div class="col-sm-7">
                        <input type="time" name="jam" class="form-control" value="'.$data['jam'].'">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-3 control-label">Alasan</label>
                    <div class="col-sm-7">
                        <textarea id="username" name="alasan" class="form-control" placeholder="Optional">'.$data['alasan'].'</textarea>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-10">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal" style="float:right;margin-right:10px;">Close</button>
                        <button type="submit" class="btn btn-success" style="float:right;margin-right:10px;""><i class="fa fa-edit"></i> Edit</button> 
                    </div>
                </div>
            </div>
        </div>
        </form>
    </div>
</div>';

?>
                 