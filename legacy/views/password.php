<?php
if (!defined('website')) {include("index.php");die();}

if(isset($_POST["ganti"])){

    $passBaru   = md5($_POST["passBaru"]);
    $passLama1  = md5($_POST["passLama"]);
    
    $passLama2 = $profil["password"];
    
    if($passLama1 == $passLama2){
        
        $ipmu       = $_SERVER['REMOTE_ADDR'];
        $username   = "$_SESSION[adminwebsite123] $ipmu";
        $waktuini   = date("Y-m-d H:i:s");

        $log        = mysqli_query($con,"INSERT INTO log VALUES(null,'$username','$waktuini','GANTI PASSWORD UNTUK USERNAME $_SESSION[adminwebsite123]');");    
        
        $edit       = mysqli_query($con,"UPDATE tb_login SET password = '$passBaru' WHERE username = '$_SESSION[adminwebsite123]';");

        if($edit){
            echo '
        <script>
            swal({
                text: "Password berhasil di ubah !!",
                icon: "success",
                type: "success"
            });
        </script>
        ';
        }
    }

    else {
        echo '
        <script>
            swal({
                text: "Password gagal di ubah !!",
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
                  <li class="active" style="color: #fff"><a style="color: #fff" href=""><i class="fa fa-cube"></i> User /</a> Password</li>
                </ol>
            </div>
        </div>
            
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="padding-left: 20px; padding-right: 20px">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <i class="fa fa-pencil"></i> Form Ubah Password 
                    <a href="<?php echo $BaseUrl; ?>/home.php"><button type="button" class="btn btn-sm" style="float:right;background-color:#ffffff;color:#000;line-height:0.8">
                      <i class="fa fa-chevron-circle-left"></i> Kembali
                    </button></a>
                </div>
                <div class="panel-body" id="panel-body">
                    <form class="form-horizontal" name="myform" role="form" action="" method="POST" enctype="multipart/form-data">
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-2 control-label">Password Lama</label>
                                        <div class="col-sm-4">
                                            <input type="password" name="passLama" class="form-control" required>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-2 control-label">Password Baru</label>
                                        <div class="col-sm-4">
                                            <input type="password" name="passBaru" class="form-control" required>
                                        </div>
                                    </div>                               

                                    <div class="box-footer">
                                        <button type="reset" class="btn btn-default btn-sm pull-right"><i class="fa fa-refresh"></i> Reset</button>
                                        <button type="submit" name="ganti" class="btn btn-primary btn-sm pull-right" style="margin-right:10px"><i class="fa fa-edit"></i> Ubah Password</button>
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