<?php
if (!defined('website')) {include("index.php");die();}

if(!empty($departemen)) {
    if($departemen)
    {
        echo '
        <script>
            swal({
                text: "Data Departemen berhasil di tambahkan !!",
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
                text: "Data Departemen gagal di tambahkan, Mungkin adminname sudah ada yang menggunakan !!",
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
                  <li class="active" style="color: #fff"><a style="color: #fff" href=""><i class="fa fa-cube"></i> Master Data /</a> Departemen</li>
                </ol>
            </div>
        </div>
            
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="padding-left: 20px; padding-right: 20px">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <i class="fa fa-pencil"></i> Form Input Departemen 
                    <a href="<?php echo $BaseUrl; ?>/departemen.php"><button type="button" class="btn btn-sm" style="float:right;background-color:#ffffff;color:#000;line-height:0.8">
                      <i class="fa fa-chevron-circle-left"></i> Kembali
                    </button></a>
                </div>
                <div class="panel-body" id="panel-body">
                    <form class="form-horizontal" name="myform" role="form" action="" method="POST" enctype="multipart/form-data">
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-12">

                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-2 control-label">Nama Departemen</label>
                                        <div class="col-sm-4">
                                            <input type="text" name="nama_departemen" class="form-control" placeholder="Masukkan departemen" required>
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