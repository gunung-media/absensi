<?php
if (!defined('website')) {include("index.php");die();}
?>

<script type="text/javascript" src="<?php echo $BaseUrl; ?>/themes/server/js/jquery.js"></script>
<script type="text/javascript" src="<?php echo $BaseUrl; ?>/themes/server/js/jquery-1.2.3.js"></script>
<script type="text/javascript">
$(document).ready(function() {

  $('#myForm').submit(function() {
    $.ajax({
      type: 'POST',
      url: $(this).attr('action'),
      data: $(this).serialize(),
      beforeSend: function(){
        // Show image container
        $("#loader").show();
       },
      success: function(data) {
        $('#result').html(data);
      },
      complete:function(data){
        // Hide image container
        $("#loader").hide();
       }
    })
    return false;
  });
})
</script>

<div class="content-wrapper">
    <div class="row">
        <br>
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="padding-left: 20px;padding-right: 20px">
            <div>
            <ol class="breadcrumb" style="background-color: #3c8dbc">
                        <li class="active" style="color: #000">
                            <a style="color: #fff" href="">
                            <i class="fa fa-chevron-circle-right"></i> Home</a> 
                            <a style="color: #fff" href="">
                            / Laporan Absensi Karyawan Plant Per Tahun</a>
                        </li>
                    </ol>
            </div>
        </div>
        <br>

        <!-- content -->
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="padding-left: 20px;padding-right: 20px">
            <div class="panel panel-primary">
                <div class="panel-heading">
                  <i class="fa fa-th"></i> Rekap Absensi Karyawan Plant Per Tahun
                </div>
                <div class="panel-body" id="panel-body">
                    <form action="<?php echo $BaseUrl; ?>/laporan&aksi-rekap-plant=true&token=<?php echo $token; ?>.php" class="form-horizontal row-form" id="myForm">
                    <table cellspacing="5" cellpadding="5" border="0">
                        <tbody>
                            <tr>
                                <td>Tahun</td>
                                <td>&nbsp;</td>
                                <td>:</td>
                                <td>&nbsp;</td>
                                <td><input type="text" id="datepicker" class="form-control" name="tahun"></td>
                                <td>&nbsp;</td>
                                <td>
                                    <select class="form-control select2" name="departemen" id="departemen">
                                    <?php
                                        
                                        echo "<option value=''> -- Pilih Departemen -- </option>";
                                        
                                        $tampil = $database -> tampilDepartemen($con);
                                        foreach($tampil as $data)
                                        {
                                         
                                            echo '<option value="'.$data['nama_departemen'].'"> '.$data['nama_departemen'].' </option>';

                                        }
                                    ?>
                                    </select>
                                </td>
                                <td>&nbsp;</td>
                                <td>
                                    <select class="form-control select2" name="jabatan" id="jabatan">
                                    <?php
                                        
                                        echo "<option value=''> -- Pilih Jabatan -- </option>";
                                        
                                        $tampil = $database -> tampilJabatan($con);
                                        foreach($tampil as $data)
                                        {
                                         
                                            echo '<option value="'.$data['nama_jabatan'].'"> '.$data['nama_jabatan'].' </option>';

                                        }
                                    ?>
                                    </select>
                                </td>
                                <td>&nbsp;</td>
                                <td>
                                    <select class="form-control select2" name="nama" id="nama">
                                    <?php
                                        
                                        echo "<option value=''> -- Pilih Nama Lengkap -- </option>";
                                        
                                        $tampil = $database -> tampilKaryawan($con);
                                        foreach($tampil as $data)
                                        {
                                         
                                            echo '<option value="'.$data['username'].'"> '.$data['nama_lengkap'].' ('.$data['username'].') </option>';

                                        }
                                    ?>
                                    </select>
                                </td>
                                
                                <td>&nbsp;</td>
                                <td><button class="btn btn-success" type="submit" id="btn-search"><i class="fa fa-refresh"></i> LIHAT</button></td>
                            </tr>
                        </tbody>
                    </table>
                    </form>
                    <hr>

                    <!-- result -->
                    <div id="result"></div>
                    <center>
                    <div id='loader' style='display: none;'>
                      <img src='reload.gif' width='32px' height='32px'>
                    </div>
                    </center>
                    
                </div>
            </div>
        </div>
    <!-- akhir content -->
    </div>
    <div class="control-sidebar-bg"></div>
</div>