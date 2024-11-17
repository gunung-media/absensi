<?php
if (!defined('website')) {include("index.php");die();}

if(!empty($karyawan)) {
    if($karyawan)
    {
        echo '
        <script>
            swal({
                text: "Data karyawan berhasil di tambahkan !!",
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
                text: "Data karyawan gagal di tambahkan, Mungkin karyawanname sudah ada yang menggunakan !!",
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
                    <i class="fa fa-pencil"></i> Form Input Karyawan 
                    <a href="<?php echo $BaseUrl; ?>/karyawan.php"><button type="button" class="btn btn-sm" style="float:right;background-color:#ffffff;color:#000;line-height:0.8">
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
                                        <div class="col-sm-4">
                                            <input type="text" name="nama_lengkap" class="form-control" placeholder="Masukkan Nama" required>
                                            <p id="pesan"></p>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-2 control-label">Username</label>
                                        <div class="col-sm-4">
                                            <input type="text" name="username" class="form-control" placeholder="Masukkan Username" required>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-2 control-label">Email</label>
                                        <div class="col-sm-4">
                                            <input type="email" name="email" class="form-control" placeholder="Masukkan Email" required>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-2 control-label">No Handphone</label>
                                        <div class="col-sm-4">
                                            <input type="text" name="no_hp" class="form-control" placeholder="Masukkan No HP">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-2 control-label">Tanggal Lahir</label>
                                        <div class="col-sm-4">
                                            <input type="text" name="tgl_lahir" class="form-control tglawal" placeholder="Masukkan Tgl Lahir">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-2 control-label">Masa Kerja</label>
                                        <div class="col-sm-4">
                                            <input type="text" name="masa_kerja" class="form-control tglakhir" placeholder="Masukkan Masa Kerja">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-2 control-label">Jabatan</label>
                                        <div class="col-sm-4">
                                            <select class="form-control" name="jabatan" required />
                                                <option value=""> -- Pilih Jabatan -- </option>
                                                <?php
                                                    $tampil_jab = $database -> tampilJabatanKaryawan($con);
                                                    foreach($tampil_jab as $jab)
                                                    {
                                                     
                                                        echo '<option value="'.$jab['id_jabatan'].'"> '.$jab['nama_jabatan'].' </option>';

                                                    }
                                                ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-2 control-label">Departemen</label>
                                        <div class="col-sm-4">
                                            <select class="form-control" name="departemen" required />
                                                <option value=""> -- Pilih Departemen -- </option>
                                                <?php
                                                    $tampil_dep = $database -> tampilDepartemenKaryawan($con);
                                                    foreach($tampil_dep as $dep)
                                                    {
                                                     
                                                        echo '<option value="'.$dep['id_departemen'].'"> '.$dep['nama_departemen'].' </option>';

                                                    }
                                                ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-2 control-label">Status</label>
                                        <div class="col-sm-4">
                                            <select class="form-control" name="status" required />
                                                <option value="1"> Aktif </option>
                                                <option value="0"> Non Aktif </option>
                                            </select>
                                        </div>
                                    </div>     

                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-2 control-label">Hak Cuti</label>
                                        <div class="col-sm-4">
                                            <input type="text" name="hak_cuti" class="form-control" placeholder="Masukkan Hak Cuti">
                                        </div>
                                    </div>                              

                                    <div class="box-footer">
                                        <button type="reset" class="btn btn-default btn-sm pull-right"><i class="fa fa-refresh"></i> Reset</button>
                                        <button type="submit" name="simpan" class="btn btn-primary btn-sm pull-right" style="margin-right:10px"><i class="fa fa-save"></i> Simpan</button>
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