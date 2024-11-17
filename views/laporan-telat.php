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
                            / Laporan Karyawan Telat</a>
                        </li>
                    </ol>
            </div>
        </div>
        <br>

        <!-- content -->
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="padding-left: 20px;padding-right: 20px">
            <div class="panel panel-primary">
                <div class="panel-heading">
                  <i class="fa fa-th"></i> Daftar Karyawan Telat
                </div>
                <div class="panel-body" id="panel-body">
                    <form action="<?php echo $BaseUrl; ?>/laporan&aksi-laporan-telat=true&token=<?php echo $token; ?>.php" class="form-horizontal row-form" id="myForm">
                    <table cellspacing="5" cellpadding="5" border="0">
                        <tbody>
                            <tr>
                                <td>
                                    <select class="form-control" name="bulan" id="bulan">
                                        <option>-- Pilih Bulan --</option>
                                        <option value="1">JAN</option>
                                        <option value="2">FEB</option>
                                        <option value="3">MAR</option>
                                        <option value="4">APR</option>
                                        <option value="5">MEI</option>
                                        <option value="6">JUN</option>
                                        <option value="7">JUL</option>
                                        <option value="8">AGT</option>
                                        <option value="9">SEP</option>
                                        <option value="10">OKT</option>
                                        <option value="11">NOV</option>
                                        <option value="12">DES</option>
                                    </select>
                                </td>
                                <td>&nbsp;</td>
                                <td><input type="text" id="datepicker" class="form-control" name="tahun"></td>
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