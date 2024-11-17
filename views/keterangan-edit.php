<?php
if (!defined('website')) {include("index.php");die();}

$kode = mysqli_real_escape_string($con,$_GET["edit"]);
$data = $database -> detailKeterangan($con,$kode);

if(!empty($keterangan)) {
    if($keterangan)
    {
        echo '
        <script>
            swal({
                text: "Data Keterangan berhasil di tambahkan !!",
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
                text: "Data Keterangan gagal di tambahkan, Mungkin adminname sudah ada yang menggunakan !!",
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
                  <li class="active" style="color: #fff"><a style="color: #fff" href=""><i class="fa fa-cube"></i> Master Data /</a> Keterangan</li>
                </ol>
            </div>
        </div>
            
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="padding-left: 20px; padding-right: 20px">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <i class="fa fa-pencil"></i> Form Edit Keterangan 
                    <a href="<?php echo $BaseUrl; ?>/keterangan.php"><button type="button" class="btn btn-sm" style="float:right;background-color:#ffffff;color:#000;line-height:0.8">
                      <i class="fa fa-chevron-circle-left"></i> Kembali
                    </button></a>
                </div>
                <div class="panel-body" id="panel-body">
                    <form class="form-horizontal" name="myform" role="form" action="" method="POST" enctype="multipart/form-data">
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-12">

                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-2 control-label">Keterangan</label>
                                        <div class="col-sm-4">
                                            <input type="text" name="keterangan" class="form-control" value="<?php echo $data['keterangan']; ?>" required>
                                        </div>
                                    </div>    

                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-2 control-label">Kode</label>
                                        <div class="col-sm-4">
                                            <input type="text" name="kode" class="form-control" value="<?php echo $data['kode']; ?>" required>
                                        </div>
                                    </div>                               

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