<?php
if (!defined('website')) {include("index.php");die();}
?>

<div class="content-wrapper">
    <div class="row">
        <br>
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="padding-left: 20px; padding-right: 20px">
            <div>
                <ol class="breadcrumb" style="background-color: #3c8dbc">
                  <li class="active" style="color: #fff"><a style="color: #fff" href=""><i class="fa fa-cube"></i> Master Data /</a> Import</li>
                </ol>
            </div>
        </div>
            
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="padding-left: 20px; padding-right: 20px">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <i class="fa fa-pencil"></i> Import Data Master 
                    <a href="<?php echo $BaseUrl; ?>/master-data.php"><button type="button" class="btn btn-sm" style="float:right;background-color:#ffffff;color:#000;line-height:0.8">
                      <i class="fa fa-chevron-circle-left"></i> Kembali
                    </button></a>
                </div>
                <div class="panel-body" id="panel-body">
                    <form class="form-horizontal" name="myform" role="form" action="" method="POST" enctype="multipart/form-data">
                        <div class="box-body">
                            <blockquote>
                                <p>Gunakan atau isi Template file master excel sesuai dengan pilihan yang tersedia </small></b>
                                <b><small> Download contoh file import <a href="<?php echo $BaseUrl; ?>/contoh-import-absensi.xlsx" target="_blank" download><i class"fa fa-download"></i>Download here</a></small></b>
                            </blockquote>
                        </div>
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-2 control-label">Tanggal</label>
                                        <div class="col-sm-3">
                                            <input type="text" class="form-control datepickeradd" name="tanggal" id="tanggal" placeholder="Tanggal">
                                            <p id="pesan"></p>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-2 control-label">File Excel</label>
                                        <div class="col-sm-6">
                                            <input type="file" name="file" class="form-control" accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel" required>
                                        </div>
                                    </div>

                                    <div class="box-footer">
                                        <button type="reset" class="btn btn-default btn-sm pull-right"><i class="fa fa-refresh"></i> Reset</button>
                                        <button type="submit" name="import" class="btn btn-primary btn-sm pull-right" style="margin-right:10px"><i class="fa fa-save"></i> Simpan</button>
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

<script src="<?php echo $BaseUrl; ?>/js/ajax/jquery.min.js" type="text/javascript"></script>

<script type="text/javascript">
    $(function(){
        $('#tanggal').change(function(){
        $('#pesan').after('<span class="loading"></span>');
        $('#pesan').load('proses-tgl.php?tanggal=' + $(this).val(),function(responseTxt,statusTxt,xhr)
        {
            if(statusTxt=="success")
                $('.loading').remove();
            });
            return false;
        });
    });
</script>