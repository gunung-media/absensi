<?php
if (!defined('website')) {include("index.php");die();}

if(!empty($simpan)) {
    if($simpan)
    {
        echo '
        <script>
            swal({
                text: "Data absensi berhasil di tambahkan !!",
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
                text: "Data absensi gagal di tambahkan, Mungkin karyawanname sudah ada yang menggunakan !!",
                icon: "error",
                type: "error"
            });
        </script>
        ';
    }
}

?>

<div class="content-wrapper">
    <div class="row">
        <br>
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="padding-left: 20px; padding-right: 20px">
            <div>
                <ol class="breadcrumb" style="background-color: #3c8dbc">
                  <li class="active" style="color: #fff"><a style="color: #fff" href=""><i class="fa fa-cube"></i> Master Data /</a> Karyawan</li>
                </ol>
            </div>
        </div>
            
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="padding-left: 20px; padding-right: 20px">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <i class="fa fa-pencil"></i> Form Input Absensi 
                    <a href="<?php echo $BaseUrl; ?>/absensi.php"><button type="button" class="btn btn-sm" style="float:right;background-color:#ffffff;color:#000;line-height:0.8">
                      <i class="fa fa-chevron-circle-left"></i> Kembali
                    </button></a>
                </div>
                <div class="panel-body" id="panel-body">
                    <form class="form-horizontal" name="myform" role="form" action="" method="POST" enctype="multipart/form-data">
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-2 control-label">Nama Lengkap</label>
                                        <div class="col-sm-10">
                                            <select name="nama_lengkap" class="form-control select2" id="nama_lengkap">
                                            <?php
                                                echo "<option>-- Pilih Karyawan --</option>";
                                                $sql_karyawan = mysqli_query($con, "SELECT * FROM tb_karyawan ORDER BY nama_lengkap ASC");
                                                while ($list_karyawan = mysqli_fetch_array($sql_karyawan)) {
                                                    
                                                    echo "<option value='".$list_karyawan['id_karyawan']."'>".$list_karyawan['nama_lengkap']."</option>";
                                                }
                                            ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-2 control-label"></label>
                                        <div class="col-sm-4">
                                            <input type="text" name="departemen" class="form-control" placeholder="Departemen" id="departemen" readonly>
                                        </div>
                                        <div class="col-sm-3">
                                            <input type="text" name="jabatan" class="form-control" placeholder="Jabatan" id="jabatan" readonly>
                                        </div>
                                        <div class="col-sm-3">
                                            <input type="text" name="username" class="form-control" placeholder="Username" id="username" readonly>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-2 control-label">Tanggal</label>
                                        <div class="col-sm-3">
                                            <input type="text" class="form-control datepickeradd" name="tanggal" id="tanggal" placeholder="Tanggal">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-2 control-label">Jam</label>
                                        <div class="col-sm-3">
                                            <input type="text" name="jam" id="time" class="form-control floating-label" placeholder="Masukkan Jam">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-2 control-label">Keterangan</label>
                                        <div class="col-sm-4">
                                            <select name="keterangan" class="form-control">
                                                <?php
                                                    echo "<option>-- Pilih Keterangan --</option>";
                                                    $sql_keterangan = mysqli_query($con, "SELECT * FROM tb_keterangan ORDER BY id_keterangan ASC");
                                                    while ($list_keterangan = mysqli_fetch_array($sql_keterangan)) {
                                                        
                                                        echo "<option value='".$list_keterangan['id_keterangan']."'>".$list_keterangan['keterangan']."</option>";
                                                    }
                                                ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-2 control-label">Alasan</label>
                                        <div class="col-sm-4">
                                            <textarea name="alasan" class="form-control" placeholder="Opsional"></textarea>
                                        </div>
                                    </div>                            

                                    <div class="box-footer">
                                        <button type="reset" class="btn btn-default btn-sm pull-right"><i class="fa fa-refresh"></i> Reset</button>
                                        <button type="submit" name="aksi-tambah" class="btn btn-primary btn-sm pull-right" style="margin-right:10px"><i class="fa fa-save"></i> Simpan</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="control-sidebar-bg"></div>
</div>
