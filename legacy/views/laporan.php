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
                        / Laporan</a>
                    </li>
                </ol>
            </div>
        </div>

        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="padding-left: 20px;padding-right: 20px">
            <!-- PRODUCT LIST -->
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Laporan</h3>

                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    </div>
                </div>

                <!-- /.box-header -->
                <div class="box-body">
                    <div class="col-md-2 col-sm-2 col-xs-12">
                        <a href="<?php echo $BaseUrl; ?>/laporan&rekap-absensi=true&token=<?php echo $token; ?>.php" style="color:#000">
                            <div class="info-box" style="border:1px solid #ddd">
                                <div style="margin-top:15px">
                                <center>
                                <i class="fa fa-file-text fa-2x"></i>
                                <span class="info-box-text">Rekap Absensi</span>
                                </center>
                                </div>
                            </div>
                        </a>
                    <!-- /.info-box -->
                    </div>

                    <div class="col-md-2 col-sm-2 col-xs-12">
                        <a href="<?php echo $BaseUrl; ?>/laporan&rekap-bulanan=true&token=<?php echo $token; ?>.php" style="color:#000">
                            <div class="info-box" style="border:1px solid #ddd">
                                <div style="margin-top:15px">
                                <center>
                                <i class="fa fa-fax fa-2x"></i>
                                <span class="info-box-text">Rekap Absensi Bulanan</span>
                                </center>
                                </div>
                            </div>
                        </a>
                    <!-- /.info-box -->
                    </div>


                    <div class="col-md-2 col-sm-2 col-xs-12">
                        <a href="<?php echo $BaseUrl; ?>/laporan&laporan-telat=true&token=<?php echo $token; ?>.php" style="color:#000">
                            <div class="info-box" style="border:1px solid #ddd">
                                <div style="margin-top:15px">
                                <center>
                                <i class="fa fa-clock-o fa-2x"></i>
                                <span class="info-box-text">Rekap Karyawan Telat</span>
                                </center>
                                </div>
                            </div>
                        </a>
                    <!-- /.info-box -->
                    </div>

                    <div class="col-md-2 col-sm-2 col-xs-12">
                        <a href="<?php echo $BaseUrl; ?>/laporan&rekap-plant=true&token=<?php echo $token; ?>.php" style="color:#000">
                            <div class="info-box" style="border:1px solid #ddd">
                                <div style="margin-top:15px">
                                <center>
                                <i class="fa fa-building fa-2x"></i>
                                <span class="info-box-text">Rekap Cuti</span>
                                </center>
                                </div>
                            </div>
                        </a>
                    <!-- /.info-box -->
                    </div>
                </div>
                <!-- /.box -->
            </div>
        </div>
    </div>
</div>