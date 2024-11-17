<?php
if (!defined('website')) {include("index.php");die();}

$kode  = mysqli_real_escape_string($con,$_GET["edit"]);
$tahun = date('Y');
$data = $database -> detailKaryawan($con,$kode,$tahun);

$tgl_awal   = explode("-", $data['tgl_lahir']);
$new_lahir  = $tgl_awal[2]."/".$tgl_awal[1]."/".$tgl_awal[0];

$tgl_akhir  = explode("-", $data['masa_kerja']);
$new_masuk  = $tgl_akhir[2]."/".$tgl_akhir[1]."/".$tgl_akhir[0];

if(!empty($karyawan)) {
    if($karyawan)
    {
        echo '
        <script>
            swal({
                text: "Data Karyawan berhasil di edit !!",
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
                text: "Data Karyawan gagal di edit, Mungkin karyawanname sudah ada yang menggunakan !!",
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
                    <i class="fa fa-pencil"></i> Form Edit Karyawan 
                    <a href="<?php echo $BaseUrl; ?>/karyawan.php"><button type="button" class="btn btn-sm" style="float:right;background-color:#ffffff;color:#000;line-height:0.8">
                      <i class="fa fa-chevron-circle-left"></i> Kembali
                    </button></a>
                </div>
                <div class="panel-body" id="panel-body">
                    <form class="form-horizontal" name="myform" role="form" action="" method="POST" enctype="multipart/form-data">
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-3 control-label">Nama Lengkap</label>
                                        <div class="col-sm-8">
                                            <input type="text" name="nama_lengkap" class="form-control" value="<?php echo $data['nama_lengkap']; ?>" required>
                                            <p id="pesan"></p>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-3 control-label">Username</label>
                                        <div class="col-sm-8">
                                            <input type="text" name="username" class="form-control" value="<?php echo $data['username']; ?>" required>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-3 control-label">Email</label>
                                        <div class="col-sm-8">
                                            <input type="email" name="email" class="form-control" value="<?php echo $data['email']; ?>" required>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-3 control-label">No Handphone</label>
                                        <div class="col-sm-8">
                                            <input type="text" name="no_hp" class="form-control" value="<?php echo $data['no_hp']; ?>">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-3 control-label">Tanggal Lahir</label>
                                        <div class="col-sm-8">
                                            <input type="text" name="tgl_lahir" class="form-control tglawal" value="<?php echo $new_lahir; ?>">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-3 control-label">Masa Kerja</label>
                                        <div class="col-sm-8">
                                            <input type="text" name="masa_kerja" class="form-control tglakhir" value="<?php echo $new_masuk; ?>">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-3 control-label">Jabatan</label>
                                        <div class="col-sm-8">
                                            <select class="form-control" name="jabatan" required />
                                                <option value="<?php echo $data['id_jabatan']; ?>"><?php echo $data['nama_jabatan']; ?></option>
                                                <option value=""> -- Pilih Jabatan -- </option>
                                                <?php
                                                    $tampil = $database -> tampilJabatanKaryawan($con);
                                                    foreach($tampil as $jab)
                                                    {
                                                     
                                                        echo '<option value="'.$jab['id_jabatan'].'"> '.$jab['nama_jabatan'].' </option>';

                                                    }
                                                ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-3 control-label">Departemen</label>
                                        <div class="col-sm-8">
                                            <select class="form-control" name="departemen" required/>
                                            <option value="<?php echo $data['id_departemen']; ?>"><?php echo $data['nama_departemen']; ?></option>
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
                                        <label for="inputEmail3" class="col-sm-3 control-label">Status</label>
                                        <div class="col-sm-8">
                                            <select class="form-control" name="status" required />
                                                <?php

                                                    if($data['status'] == '1') {
                                                        echo '<option value="'.$data['status'].'">Aktif</option>';
                                                    } else {
                                                        echo '<option value="'.$data['status'].'">Non Aktif</option>';
                                                    } 
                                                ?>
                                                <option value=""> -- Pilih Status -- </option>
                                                <option value="1"> Aktif </option>
                                                <option value="0"> Non Aktif </option>
                                            </select>
                                        </div>
                                    </div>  
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-3 control-label">Hak Cuti</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="hak_cuti" class="form-control" value="<?php echo $data['hak_cuti']; ?>">
                                        </div>
                                    </div>

                                    <?php if ($data['nama_departemen'] == 'Plant') { ?>

                                        <div class="form-group">
                                            <label for="inputEmail3" class="col-sm-4 control-label">Cuti Diambil :</label>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputEmail3" class="col-sm-3 control-label">Jan</label>
                                            <div class="col-sm-3">
                                                <input type="text" name="jan" class="form-control" value="<?php echo $data['jan']; ?>">
                                            </div>
   
                                            <label for="inputEmail3" class="col-sm-3 control-label">Feb</label>
                                            <div class="col-sm-3">
                                                <input type="text" name="feb" class="form-control" value="<?php echo $data['feb']; ?>">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="inputEmail3" class="col-sm-3 control-label">Mar</label>
                                            <div class="col-sm-3">
                                                <input type="text" name="mar" class="form-control" value="<?php echo $data['mar']; ?>">
                                            </div>
                                        
                                            <label for="inputEmail3" class="col-sm-3 control-label">Apr</label>
                                            <div class="col-sm-3">
                                                <input type="text" name="apr" class="form-control" value="<?php echo $data['apr']; ?>">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="inputEmail3" class="col-sm-3 control-label">Mei</label>
                                            <div class="col-sm-3">
                                                <input type="text" name="mei" class="form-control" value="<?php echo $data['mei']; ?>">
                                            </div>
          
                                            <label for="inputEmail3" class="col-sm-3 control-label">Jun</label>
                                            <div class="col-sm-3">
                                                <input type="text" name="jun" class="form-control" value="<?php echo $data['jun']; ?>">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="inputEmail3" class="col-sm-3 control-label">Jul</label>
                                            <div class="col-sm-3">
                                                <input type="text" name="jul" class="form-control" value="<?php echo $data['jul']; ?>">
                                            </div>
          
                                            <label for="inputEmail3" class="col-sm-3 control-label">Agu</label>
                                            <div class="col-sm-3">
                                                <input type="text" name="agt" class="form-control" value="<?php echo $data['agt']; ?>">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="inputEmail3" class="col-sm-3 control-label">Sep</label>
                                            <div class="col-sm-3">
                                                <input type="text" name="sep" class="form-control" value="<?php echo $data['sep']; ?>">
                                            </div>
          
                                            <label for="inputEmail3" class="col-sm-3 control-label">Okt</label>
                                            <div class="col-sm-3">
                                                <input type="text" name="okt" class="form-control" value="<?php echo $data['okt']; ?>">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="inputEmail3" class="col-sm-3 control-label">Nov</label>
                                            <div class="col-sm-3">
                                                <input type="text" name="nov" class="form-control" value="<?php echo $data['nov']; ?>">
                                            </div>
          
                                            <label for="inputEmail3" class="col-sm-3 control-label">Des</label>
                                            <div class="col-sm-3">
                                                <input type="text" name="des" class="form-control" value="<?php echo $data['des']; ?>">
                                            </div>
                                        </div>
                                    <?php } else { ?>

                                        <div class="form-group">
                                            <label for="inputEmail3" class="col-sm-3 control-label">Cuti Diambil</label>
                                            <div class="col-sm-8">
                                                <input type="text" name="cuti_diambil" class="form-control" value="<?php echo $data['cuti_diambil']; ?>">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="inputEmail3" class="col-sm-3 control-label">Telat</label>
                                            <div class="col-sm-8">
                                                <input type="text" name="telat" class="form-control" value="<?php echo $data['telat']; ?>">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="inputEmail3" class="col-sm-3 control-label">Izin Siang</label>
                                            <div class="col-sm-8">
                                                <input type="text" name="izin_siang" class="form-control" value="<?php echo $data['izin_siang']; ?>">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="inputEmail3" class="col-sm-3 control-label">Sakit</label>
                                            <div class="col-sm-8">
                                                <input type="text" name="sakit" class="form-control" value="<?php echo $data['sakit']; ?>">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="inputEmail3" class="col-sm-3 control-label">Visit</label>
                                            <div class="col-sm-8">
                                                <input type="text" name="visit" class="form-control" value="<?php echo $data['visit']; ?>">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="inputEmail3" class="col-sm-3 control-label">Luar Kota</label>
                                            <div class="col-sm-8">
                                                <input type="text" name="luar_kota" class="form-control" value="<?php echo $data['luar_kota']; ?>">
                                            </div>
                                        </div>
                                    <?php } ?>

                                    <div class="box-footer">
                                        <button type="reset" class="btn btn-default btn-sm pull-right"><i class="fa fa-refresh"></i> Reset</button>
                                        <button type="submit" name="ganti" class="btn btn-primary btn-sm pull-right" style="margin-right:10px"><i class="fa fa-edit"></i> Edit</button>
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