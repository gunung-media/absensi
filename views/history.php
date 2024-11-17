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
                            / History</a>
                        </li>
                    </ol>
            </div>
        </div>
        <br>

        <!-- content -->
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="padding-left: 20px;padding-right: 20px">
            <div class="panel panel-primary">
                <div class="panel-heading">
                  <i class="fa fa-th"></i> List Data History
                </div>
                <div class="panel-body" id="panel-body">
                    <table id="example_log" class="table table-bordered table-striped table-responsive nowrap">
                        <thead>
                            <tr>
                                <th style="background:#f39c12;">USERNAME</th>
                                <th style="background:#f39c12;">WAKTU</th>
                                <th style="background:#f39c12;">KETERANGAN</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    <!-- akhir content -->
    </div>
    <div class="control-sidebar-bg"></div>
</div>

<!-- jquery -->
<script type="text/javascript" src="<?php echo $BaseUrl; ?>/themes/server/js/jquery.min.js"></script>
<!-- AKSI HAPUS -->
<script src="<?php echo $BaseUrl; ?>/themes/server/js/hapus.js"></script>
<!-- jQuery 3 -->
<script src="<?php echo $BaseUrl; ?>/themes/server/bower_components/jquery/dist/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="<?php echo $BaseUrl; ?>/themes/server/bower_components/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->

<!-- DataTables -->
<script src="<?php echo $BaseUrl; ?>/themes/server/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?php echo $BaseUrl; ?>/themes/server/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>


<script>

    $(document).ready(function() {
        $('#example_log').DataTable( {
            order: [],
            columnDefs: [{orderable: false, targets: 'no-sort'}],
            bSort: false,
            "processing": true,
            "serverSide": true,
            "ajax": "<?php echo $BaseUrl; ?>/ajaxLog.php"
        });
    });
</script>
