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
                            / Departemen</a>
                        </li>
                    </ol>
            </div>
        </div>
        <br>

        <!-- content -->
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="padding-left: 20px;padding-right: 20px">
            <a href="<?php echo $BaseUrl; ?>/departemen&tambah=true&token=<?php echo $token; ?>.php"><button type="button" class="btn btn-default btn-sm"><i class="fa fa-plus"></i> Tambah</button></a>
            <br><br>
            <div class="panel panel-primary">
                <div class="panel-heading">
                  <i class="fa fa-th"></i> List Data Departemen
                </div>
                <div class="panel-body" id="panel-body">
                    <div class="table-responsive" style="overflow-x:auto;">
                        <table class="table table-bordered table-striped table-responsive nowrap example2">
                            <thead>
                                <tr>
                                    <th style="background:#f39c12;">NO</th>
                                    <th style="background:#f39c12;">NAMA DEPARTEMEN</th>
                                    <th style="background:#f39c12;">STATUS</th>
                                    <th style="background:#f39c12;">PERINTAH</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                                $no=1;
                                $tampil = $database -> tampilDepartemen($con);
                                foreach($tampil as $data)
                                {
                                    echo '
                                    <tr>
                                        <td style="text-align:center;">'.$no.'</td>
                                        <td>'.$data["nama_departemen"].'</td>';
                                        if($data['status'] == '1') {
                                            echo '<td style="text-align:left;">Aktif</td>';
                                        } else {
                                            echo '<td style="text-align:left;">Non Aktif</td>';
                                        }
                                        echo '
                                        <td>
                                            <a href="'.$BaseUrl.'/departemen&edit='.$data["id_departemen"].'&token='.$token.'.php" class="btn btn-success btn-sm">
                                            <span class="glyphicon glyphicon-edit" aria-hidden="true"></span> Edit</a>
                                            <a href="javascript:;" data-id="'.$data['id_departemen'].'" data-toggle="modal" data-target="#modal-hapus-departemen" class="btn btn-danger btn-sm">
                                            <span class="glyphicon glyphicon-trash" aria-hidden="true"></span> Hapus</a>';
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

<!-- modal konfirmasi-->
<div id="modal-hapus-departemen" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"> <span class="glyphicon glyphicon-exclamation-sign"></span> Konfirmasi</h4>
            </div>
            <div class="modal-body">
                Apakah Anda yakin ingin menghapus data ini ?
            </div>
            <div class="modal-footer">
                <a href="javascript:;" class="btn btn-info" id="hapus-true-data"><i class="glyphicon glyphicon-ok"></i> Ya</a>
                <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="glyphicon glyphicon-remove"></i> Tidak</button>
            </div>
        </div>
    </div>
</div>