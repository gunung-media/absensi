<?php
if (!defined('website')) {include("index.php");die();}

$kode = mysqli_real_escape_string($con,$_GET["edit"]);
$data = $database -> detailAdmin($con,$kode);

if(!empty($admin)) {
    if($admin)
    {
        echo '
        <script>
            swal({
                text: "Data Admin berhasil di edit !!",
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
                text: "Data Admin gagal di edit, Mungkin adminname sudah ada yang menggunakan !!",
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
                  <li class="active" style="color: #fff"><a style="color: #fff" href=""><i class="fa fa-cube"></i> Master Data /</a> Admin</li>
                </ol>
            </div>
        </div>
            
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="padding-left: 20px; padding-right: 20px">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <i class="fa fa-pencil"></i> Form Edit Admin 
                    <a href="<?php echo $BaseUrl; ?>/admin.php"><button type="button" class="btn btn-sm" style="float:right;background-color:#ffffff;color:#000;line-height:0.8">
                      <i class="fa fa-chevron-circle-left"></i> Kembali
                    </button></a>
                </div>
                <div class="panel-body" id="panel-body">
                    <form class="form-horizontal" name="myform" role="form" action="" method="POST" enctype="multipart/form-data">
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-2 control-label">Username</label>
                                        <div class="col-sm-4">
                                            <input type="text" id="username" name="username" class="form-control" value="<?php echo $data['username']; ?>" readonly>
                                            <p id="pesan"></p>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-2 control-label">Role</label>
                                        <div class="col-sm-4">
                                            <select class="form-control" name="role" required />
                                                <option value="<?php echo $data['role']; ?>"><?php echo $data['role']; ?></option>
                                                <option value=""> -- Pilih Role -- </option>
                                                <option value="SA"> SA </option>
                                                <option value="USER"> USER </option>
                                                <option value="GA"> GA </option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-2 control-label">Status</label>
                                        <div class="col-sm-4">
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

<script src="<?php echo $BaseUrl; ?>/js/ajax/jquery.min.js" type="text/javascript"></script>

<script type="text/javascript">
    $(function(){
        $('#username').change(function(){
        $('#pesan').after('<span class="loading"></span>');
        $('#pesan').load('proses.php?username=' + $(this).val(),function(responseTxt,statusTxt,xhr)
        {
            if(statusTxt=="success")
                $('.loading').remove();
            });
            return false;
        });
    });
</script>