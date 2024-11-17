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
                            <i class="fa fa-chevron-circle-right"></i> Master Data</a> 
                            <a style="color: #fff" href="">
                            / Karyawan</a>
                        </li>
                    </ol>
            </div>
        </div>
        <br>

        <!-- content -->
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="padding-left: 20px;padding-right: 20px">
            <?php 
            if($_SESSION['role'] == 'SA') {
            ?>
            <a href="<?php echo $BaseUrl; ?>/karyawan&tambah=true&token=<?php echo $token; ?>.php"><button type="button" class="btn btn-default btn-sm"><i class="fa fa-plus"></i> Tambah</button></a>
            <?php 
            } else {
            ?>
            <button type="button" class="btn btn-default btn-sm" style="border:1px solid #ddd;cursor:not-allowed;opacity: 0.5;background:#ddd"><i class="fa fa-plus"></i> Tambah</button>
            <?php  
            }
            ?>
            <br><br>
            <div class="panel panel-primary">
                <div class="panel-heading">
                  <i class="fa fa-th"></i> List Data Karyawan
                </div>
                <div class="panel-body" id="panel-body">
                    <div class="table-responsive" style="overflow-x:auto;">
                        <table class="table table-bordered table-striped table-responsive nowrap example2">
                            <thead>
                                <tr>
                                    <th style="background:#f39c12;">NO</th>
                                    <th style="background:#f39c12;">NAMA LENGKAP</th>
                                    <th style="background:#f39c12;">USERNAME</th>
                                    <th style="background:#f39c12;">TGL LAHIR</th>
                                    <th style="background:#f39c12;">EMAIL</th>
                                    <th style="background:#f39c12;">JABATAN</th>
                                    <th style="background:#f39c12;">DEPARTEMEN</th>
                                    <th style="background:#f39c12;">MASA KERJA</th>
                                    <th style="background:#f39c12;">STATUS</th>
                                    <th style="background:#f39c12;">PERINTAH</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                                $no=1;
                                $tampil = $database -> tampilKaryawan($con);
                                foreach($tampil as $data)
                                {
                                    $tgl_awal   = explode("-", $data['tgl_lahir']);
                                    $new_lahir  = $tgl_awal[2]."/".$tgl_awal[1]."/".$tgl_awal[0];

                                    $tgl_akhir  = explode("-", $data['masa_kerja']);
                                    $new_masuk  = $tgl_akhir[2]."/".$tgl_akhir[1]."/".$tgl_akhir[0];

                                    echo '
                                    <tr>
                                        <td style="text-align:center;">'.$no.'</td>
                                        <td>'.$data["nama_lengkap"].'</td>
                                        <td>'.$data["username"].'</td>
                                        <td>'.$new_lahir.'</td>
                                        <td>'.$data["email"].'</td>
                                        <td style="text-align:center;">'.$data["nama_jabatan"].'</td>
                                        <td>'.$data["nama_departemen"].'</td>
                                        <td>'.$new_masuk.'</td>';
                                        if($data['status_karyawan'] == '1') {
                                            echo '<td style="text-align:left;">Aktif</td>';
                                        } else {
                                            echo '<td style="text-align:left;">Non Aktif</td>';
                                        }
                                        if($_SESSION['role'] == 'USER' && $data['nama_departemen'] == 'Plant') {
                                        echo '
                                        <td>
                                            <a href="'.$BaseUrl.'/karyawan&edit='.$data["id_karyawan"].'&token='.$token.'.php" class="btn btn-success btn-sm">
                                            <span class="glyphicon glyphicon-edit" aria-hidden="true"></span> Edit</a>';
                                        
                                        } else if($_SESSION['role'] == 'SA') {
                                        echo '
                                        <td>
                                            <a href="'.$BaseUrl.'/karyawan&edit='.$data["id_karyawan"].'&token='.$token.'.php" class="btn btn-success btn-sm">
                                            <span class="glyphicon glyphicon-edit" aria-hidden="true"></span> Edit</a>';
                                        
                                        } else {
                                        echo '
                                        <td>
                                            <button class="btn btn-success btn-sm" style="border:1px solid #ddd;cursor:not-allowed;opacity: 0.5;background:#ddd">
                                            <span class="glyphicon glyphicon-edit" aria-hidden="true"></span> Edit</button>';  
                                        }
                                          echo '
                                        </td>
                                    </tr>
                                    ';
                                    $no++;
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    <!-- akhir content -->
    </div>
    <div class="control-sidebar-bg"></div>
</div>