<?php 
    if (!defined('website')) {include("index.php");die();}

    $profil = $database->tampilPenggunaDetail($con,$_SESSION['adminwebsite123']);

    $query  = mysqli_query($con, "SELECT COUNT(a.id_cuti) AS jml, b.username FROM tb_cuti a, tb_karyawan b WHERE a.nama_lengkap = b.nama_lengkap AND a.status = 'Tidak Ambil' ORDER BY a.id_cuti ASC");
    $info   = mysqli_fetch_array($query);
    
    //load time website
    $time = microtime();
    $time = explode(' ', $time);
    $time = $time[1] + $time[0];
    $start = $time;

    date_default_timezone_set("Asia/Jakarta"); 
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>e-Absensi Dashboard</title>
    <!-- favicon
    ============================================ -->
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="shortcut icon" type="image/x-icon" href="">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="<?php echo $BaseUrl; ?>/themes/server/bower_components/bootstrap/dist/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?php echo $BaseUrl; ?>/themes/server/bower_components/font-awesome/css/font-awesome.min.css">

    <!-- DataTables -->
    <link rel="stylesheet" href="<?php echo $BaseUrl; ?>/themes/server/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo $BaseUrl; ?>/themes/server/dist/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="<?php echo $BaseUrl; ?>/themes/server/dist/css/skins/_all-skins.min.css">

    <!-- Date Picker -->
    <link rel="stylesheet" href="<?php echo $BaseUrl; ?>/themes/server/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
    
    <!-- Google Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
  
    <!-- SWEET ALERT -->
    <link rel="stylesheet" type="text/css" href="<?php echo $BaseUrl; ?>/sweetalert/src/sweetalert.css">
    <script type="text/javascript" src="<?php echo $BaseUrl; ?>/sweetalert/src/sweetalert.min.js"></script>

    <link rel="stylesheet" href="<?php echo $BaseUrl; ?>/bootstrap-material-datetimepicker.css" />

    <!--<link rel="stylesheet" href="<?php //echo $BaseUrl; ?>/include/ui-1.10.0/ui-lightness/jquery-ui-1.10.0.custom.min.css" type="text/css" />
    <link rel="stylesheet" href="<?php //echo $BaseUrl; ?>/jquery.ui.timepicker.css" type="text/css" />

    <script type="text/javascript" src="<?php //echo $BaseUrl; ?>/include/jquery-1.9.0.min.js"></script>
    <script type="text/javascript" src="<?php //echo $BaseUrl; ?>/jquery.ui.timepicker.js"></script>
    <script type="text/javascript" src="<?php //echo $BaseUrl; ?>/include/ui-1.10.0/jquery.ui.core.min.js"></script>
    <script type="text/javascript" src="<?php //echo $BaseUrl; ?>/include/ui-1.10.0/jquery.ui.widget.min.js"></script>
    <script type="text/javascript" src="<?php //echo $BaseUrl; ?>/include/ui-1.10.0/jquery.ui.tabs.min.js"></script>
    <script type="text/javascript" src="<?php //echo $BaseUrl; ?>/include/ui-1.10.0/jquery.ui.position.min.js"></script>-->

    <!-- Select2 -->
    <link rel="stylesheet" href="<?php echo $BaseUrl; ?>/themes/server/bower_components/select2/dist/css/select2.min.css">
    </head>

    <body class="hold-transition skin-blue sidebar-mini">
        <div class="wrapper">
            <header class="main-header">
                <a href="garuda.php" class="logo">
                    <span class="logo-lg"><b><small>e-Absensi</small></b></span>
                </a>
                <nav class="navbar navbar-static-top">
                    <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                        <span class="sr-only">Toggle navigation</span>
                    </a>  
                    <div class="navbar-custom-menu">
                        <ul class="nav navbar-nav">
                            <li class="dropdown messages-menu">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                  <i class="fa fa-envelope-o"></i>
                                  <span class="label label-success"><?php echo $info['jml']; ?></span>
                                </a>
                                <ul class="dropdown-menu">
                                    <li class="header">Permohonan Cuti</li>
                                    <li>
                                        <!-- inner menu: contains the actual data -->
                                        <ul class="menu">
                                            <?php
                                            if($info['jml'] > 0) {

                                                $cuti = $database->tampilCuti($con);
                                                foreach ($cuti as $ct) {

                                                    $tgl_ex     = explode(" ", $ct['created']);
                                                    $new_tgl    = $tgl_ex[0];
                                                    $new_time   = $tgl_ex[1];

                                                    $tgl        = explode("-", $new_tgl);
                                                    $new_tgl_v  = $tgl[2].'/'.$tgl[1].'/'.$tgl[0];
                                            ?>

                                                <li>
                                                    <a href="#">
                                                        <div class="pull-left">
                                                            <img src="<?php echo $BaseUrl; ?>/themes/server/img/pesan2.png" class="img-circle" alt="User Image">
                                                        </div>
                                                        <h4>
                                                        <?php echo $ct['username']; ?>
                                                        <small><i class="fa fa-clock-o"></i> <?php echo $new_tgl_v; ?></small>
                                                        </h4>
                                                        <p><?php echo $ct['keperluan_cuti']; ?></p>
                                                    </a>
                                                </li>
                                            <?php } } else { ?>
                                                <li>
                                                    <center><p> Pesan Kosong </p></center>
                                                </li>
                                            <?php } ?>
                                        </ul>
                                    </li>
                                    <?php
                                        if($info['jml'] > 0) {
                                    ?>
                                    <li class="footer"><a href="<?php echo $BaseUrl; ?>/permohonan-cuti.php">Lihat semua pesan</a></li>
                                    <?php } ?>
                                </ul>
                            </li>
                            <li class="dropdown user user-menu"> 
                                <a href="history.php" style="background:#2573a0;">
                                    <span class="fa fa-history"></span>
                                </a>
                            </li>
                            <li class="dropdown user user-menu">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <span class="hidden-xs glyphicon glyphicon-log-out"> </span>Hallo, <?php echo strtoupper($_SESSION['adminwebsite123']);?>
                                </a>
                                <ul class="dropdown-menu">
                                    <li class="user-header">
                                        <img src="<?php echo $BaseUrl; ?>/themes/server/user.jpg" class="img-circle" alt="">
                                        <p>Administrator <small>PGK</small></p>
                                    </li>
                                    <li class="user-footer">
                                        <div class="pull-left">
                                            <a href="password.php" class="btn btn-default btn-flat"><i class="fa fa-key"></i> Ubah Password</a>
                                        </div>
                                        <div class="pull-right">
                                            <a href="javascript:;" data-id="0019" data-toggle="modal" data-target="#modal-logout" class="btn btn-default btn-flat"><i class="fa fa-sign-out"></i> Keluar</a>
                                        </div>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </nav>
            </header>

            <!-- modal konfirmasi-->
            <div id="modal-logout" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title"> <span class="glyphicon glyphicon-exclamation-sign"></span> Konfirmasi</h4>
                        </div>
                        <div class="modal-body">
                            Apakah anda yakin ingin keluar dari aplikasi e-Absensi ?
                        </div>
                        <div class="modal-footer">
                            <a href="<?php echo $BaseUrl; ?>/logout.php" class="btn btn-info"><i class="glyphicon glyphicon-ok"></i> Ya</a>
                            <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="glyphicon glyphicon-remove"></i> Tidak</button>
                        </div>
                    </div>
                </div>
            </div>