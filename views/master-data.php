<?php
if (!defined('website')) {include("index.php");die();}
?>

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
                        / Master Data</a>
                    </li>
                </ol>
            </div>
        </div>

        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="padding-left: 20px;padding-right: 20px">

            <!-- PRODUCT LIST -->
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Master Data</h3>

                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    </div>
                </div>

                <!-- /.box-header -->
                <div class="box-body">

                    <?php
                    if($_SESSION['role'] == 'SA') {
                    ?>
                    <div class="col-md-2 col-sm-2 col-xs-12">
                        <a href="<?php echo $BaseUrl; ?>/admin.php" style="color:#000">
                            <div class="info-box" style="border:1px solid #ddd">
                                <div style="margin-top:15px">
                                <center>
                                <i class="fa fa-user fa-2x"></i>
                                <span class="info-box-text">Admin</span>
                                </center>
                                </div>
                            </div>
                        </a>
                    <!-- /.info-box -->
                    </div>

                    <div class="col-md-2 col-sm-2 col-xs-12">
                        <a href="<?php echo $BaseUrl; ?>/karyawan.php" style="color:#000">
                            <div class="info-box" style="border:1px solid #ddd">
                                <div style="margin-top:15px">
                                <center>
                                <i class="fa fa-group fa-2x"></i>
                                <span class="info-box-text">Karyawan</span>
                                </center>
                                </div>
                            </div>
                        </a>
                    <!-- /.info-box -->
                    </div>

                    <div class="col-md-2 col-sm-2 col-xs-12">
                        <a href="<?php echo $BaseUrl; ?>/jabatan.php" style="color:#000">
                            <div class="info-box" style="border:1px solid #ddd">
                                <div style="margin-top:15px">
                                <center>
                                <i class="fa fa-briefcase fa-2x"></i>
                                <span class="info-box-text">Jabatan</span>
                                </center>
                                </div>
                            </div>
                        </a>
                    <!-- /.info-box -->
                    </div>

                    <div class="col-md-2 col-sm-2 col-xs-12">
                        <a href="<?php echo $BaseUrl; ?>/departemen.php" style="color:#000">
                            <div class="info-box" style="border:1px solid #ddd">
                                <div style="margin-top:15px">
                                <center>
                                <i class="fa fa-building fa-2x"></i>
                                <span class="info-box-text">Satuan Kerja</span>
                                </center>
                                </div>
                            </div>
                        </a>
                    <!-- /.info-box -->
                    </div>

                    <div class="col-md-2 col-sm-2 col-xs-12">
                        <a href="<?php echo $BaseUrl; ?>/keterangan.php" style="color:#000">
                            <div class="info-box" style="border:1px solid #ddd">
                                <div style="margin-top:15px">
                                <center>
                                <i class="fa fa-tags fa-2x"></i>
                                <span class="info-box-text">Keterangan</span>
                                </center>
                                </div>
                            </div>
                        </a>
                    <!-- /.info-box -->
                    </div>
                    
                     <div class="col-md-2 col-sm-2 col-xs-12">
                        <a href="<?php echo $BaseUrl; ?>/denda.php" style="color:#000">
                            <div class="info-box" style="border:1px solid #ddd">
                                <div style="margin-top:15px">
                                <center>
                                <i class="fa fa-gear fa-2x"></i>
                                <span class="info-box-text">Mesin FingerPrint</span>
                                </center>
                                </div>
                            </div>
                        </a>
                    <!-- /.info-box -->
                    </div>


                    <?php 

                    } else {
                    ?>

                    <div class="col-md-2 col-sm-2 col-xs-12">
                        <div class="info-box" style="border:1px solid #ddd;cursor:not-allowed;opacity: 0.5;background:#ddd">
                            <div style="margin-top:15px">
                            <center>
                            <i class="fa fa-user fa-2x"></i>
                            <span class="info-box-text">Admin</span>
                            </center>
                            </div>
                        </div>
                    <!-- /.info-box -->
                    </div>

                    <div class="col-md-2 col-sm-2 col-xs-12">
                        <a href="<?php echo $BaseUrl; ?>/karyawan.php" style="color:#000">
                            <div class="info-box" style="border:1px solid #ddd">
                                <div style="margin-top:15px">
                                <center>
                                <i class="fa fa-group fa-2x"></i>
                                <span class="info-box-text">Karyawan</span>
                                </center>
                                </div>
                            </div>
                        </a>
                    <!-- /.info-box -->
                    </div>

                    <div class="col-md-2 col-sm-2 col-xs-12">
                        <div class="info-box" style="border:1px solid #ddd;cursor:not-allowed;opacity: 0.5;background:#ddd">
                            <div style="margin-top:15px">
                            <center>
                            <i class="fa fa-briefcase fa-2x"></i>
                            <span class="info-box-text">Jabatan</span>
                            </center>
                            </div>
                        </div>
                    <!-- /.info-box -->
                    </div>

                    <div class="col-md-2 col-sm-2 col-xs-12">
                        <div class="info-box" style="border:1px solid #ddd;cursor:not-allowed;opacity: 0.5;background:#ddd">
                            <div style="margin-top:15px">
                            <center>
                            <i class="fa fa-building fa-2x"></i>
                            <span class="info-box-text">Satuan Kerja</span>
                            </center>
                            </div>
                        </div>
                    <!-- /.info-box -->
                    </div>

                    <div class="col-md-2 col-sm-2 col-xs-12">
                        <div class="info-box" style="border:1px solid #ddd;cursor:not-allowed;opacity: 0.5;background:#ddd">
                            <div style="margin-top:15px">
                            <center>
                            <i class="fa fa-tags fa-2x"></i>
                            <span class="info-box-text">Keterangan</span>
                            </center>
                            </div>
                        </div>
                    <!-- /.info-box -->
                    </div>
                    
                    <div class="col-md-2 col-sm-2 col-xs-12">
                        <div class="info-box" style="border:1px solid #ddd;cursor:not-allowed;opacity: 0.5;background:#ddd;">
                            <div style="margin-top:15px">
                            <center>
                            <i class="fa fa-money fa-2x"></i>
                            <span class="info-box-text">Mesin FingerPrint</span>
                            </center>
                            </div>
                        </div>
                    <!-- /.info-box -->
                    </div>


                    <?php
                    } 
                    ?>

                </div>
                <!-- /.box -->
            </div>
        </div>
    </div>
</div>