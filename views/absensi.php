<?php
if (!defined('website')) {include("index.php");die();}

if(!empty($hapus)) {
    if($hapus)
    {
        echo '
        <script>
            swal({
                text: "Data berhasil di hapus",
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
                text: "Data gagal di hapus",
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
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="padding-left: 20px;padding-right: 20px">
            <div>
            <ol class="breadcrumb" style="background-color: #3c8dbc">
                        <li class="active" style="color: #000">
                            <a style="color: #fff" href="">
                            <i class="fa fa-chevron-circle-right"></i> Home</a> 
                            <a style="color: #fff" href="">
                            / Absensi</a>
                        </li>
                    </ol>
            </div>
        </div>
        <br>

        <!-- content -->
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="padding-left: 20px;padding-right: 20px">
            <a href="<?php echo $BaseUrl; ?>/absensi&input=true&token=<?php echo $token; ?>.php"><button type="button" class="btn btn-default btn-sm"><i class="fa fa-group"></i> Input Absen</button></a>
            &nbsp;&nbsp;
            <a href="<?php echo $BaseUrl; ?>/absensi&tambah=true&token=<?php echo $token; ?>.php"><button type="button" class="btn btn-default btn-sm"><i class="fa fa-group"></i> Karyawan Belum Absen</button></a>
            &nbsp;&nbsp;
            <br><br>
            <div class="panel panel-primary">
                <div class="panel-heading">
                  <i class="fa fa-th"></i> List Data Absensi
                </div>
                <div class="panel-body" id="panel-body">
                    <table cellspacing="5" cellpadding="5" border="0">
                        <tbody>
                            <tr>
                                <td><input type="text" id="keyword4" class="form-control datepickeradd" name="tanggal"></td>
                                <td>&nbsp;</td>
                                <td><input type="text" id="keyword" class="form-control" placeholder="Masukkan Nama"></td>
                                <td>&nbsp;</td>
                                <td>
                                    <select name="departemen" class="form-control" id="keyword2">
                                        <option value="">-- Pilih Departemen --</option>
                                        <?php
                                        $SQLPlant = mysqli_query($con,"SELECT nama_departemen FROM tb_departemen ORDER BY nama_departemen ASC");
                                        while($dPlant = mysqli_fetch_array($SQLPlant)){

                                            echo '<option value="'.$dPlant['nama_departemen'].'">'.$dPlant['nama_departemen'].'</option>';
                                        }
                                        ?>
                                    </select>
                                </td>
                                <td>&nbsp;</td>
                                <td>
                                    <select name="keterangan" class="form-control" id="keyword3">
                                        <option value="">-- Pilih Keterangan --</option>
                                        <?php
                                        $SQLPlant = mysqli_query($con,"SELECT keterangan FROM tb_keterangan ORDER BY keterangan ASC");
                                        while($dPlant = mysqli_fetch_array($SQLPlant)){

                                            echo '<option value="'.$dPlant['keterangan'].'">'.$dPlant['keterangan'].'</option>';
                                        }
                                        ?>
                                    </select>
                                </td>
                                <td>&nbsp;</td>
                                <td><button class="btn btn-success" type="button" id="btn-search"><i class="fa fa-search"></i> CARI</button></td>
                            </tr>
                        </tbody>
                    </table>
                    <hr>

                    <div id="view">
                        <?php include "view.php"; ?>
                    </div>
                </div>
            </div>
        </div>
    <!-- akhir content -->
    </div>
    <div class="control-sidebar-bg"></div>
</div>

<!-- modal konfirmasi-->
<div id="modal-hapus-absensi" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
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
    // Setup - add a text input to each footer cell

    $('#example tfoot th').each( function () {

        var title = $(this).text();

        $(this).html( '</i><input type="text" class="form-control" placeholder="Cari" size="10"/>' );

    });

    // DataTable

    /* Custom filtering function which will search data in column four between two values */
    $.fn.dataTable.ext.search.push(
        function( settings, data, dataIndex ) {
            var min = parseInt( $('#min').val(), 10 );
     
            if (min)
            {
                return true;
            }
            return false;
        }
    );
     

    var table = $('#example').DataTable({ 
        order: [],
        columnDefs: [{orderable: false, targets: 'no-sort'}],
        bSort: false,
        /*dom: 'Bfrtip',
        buttons: [
            {
                text: 'My button',
                action: function ( e, dt, node, config ) {
                    alert( 'Button activated' );
                }
            }
        ],*/
        "scrollX": false,
        "autoWidth"   : true,
        "processing": true,
        "serverSide": true,
        "searching": false,
        "ajax": "<?php echo $BaseUrl; ?>/ajaxTable.php"
        /*"columnDefs": [{
            "targets": -1,
            "data": null,
            "defaultContent": "<center><div class='btn-group'><select class='btn btn-default'><option>Pilih Ket</option><option>Hadir</option><option>Cuti</option><option>Sakit</option><option>Telat</option><option>Luar Kota</option></select></div></center>"
         }]
         */
    });

    // Event listener to the two range filtering inputs to redraw on input
    $('#min, #max').keyup( function() {
        table.draw();
    });

    $('#example tbody').on( 'click', '.tblHapus', function () {
        var data = table.row( $(this).parents('tr') ).data();
        var ask = window.confirm('Apakah Anda yakin menghapus data ini ?');
        if (ask) {
            window.location.href = "absensi&hapus="+ data[7]+".php";
        }
    });

    $('#example tbody').on( 'click', '.tblEdit', function () {
        var data = table.row( $(this).parents('tr') ).data();
        window.location.href = "absensi&edit=true&id="+ data[7]+"&token=<?php echo $token ?>.php";
    });

    // Apply the search

    table.columns().every( function () {

        var that = this;

        $( 'input', this.footer() ).on( 'keyup change', function () {
            if ( that.search() !== this.value ) {
                that
                .search( this.value )
                .draw();
            }
        });
    });
});
</script>

<script>
    $(document).ready(function(){
        $("#btn-search").click(function(){ // Ketika tombol simpan di klik
            // Ubah text tombol search menjadi SEARCHING... 
            // Dan tambahkan atribut disable pada tombol nya agar tidak bisa diklik lagi
            $(this).html("PENCARIAN...").attr("disabled", "disabled");
            
            $.ajax({
                url: '<?php echo $BaseUrl; ?>/search.php', // File tujuan
                type: 'POST', // Tentukan type nya POST atau GET
                data: {
                    keyword: $("#keyword").val(),
                    keyword2: $("#keyword2").val(),
                    keyword3: $("#keyword3").val(),
                    keyword4: $("#keyword4").val()
                    }, // Set data yang akan dikirim
                dataType: "json",
                beforeSend: function(e) {
                    if(e && e.overrideMimeType) {
                        e.overrideMimeType("application/json;charset=UTF-8");
                    }
                },
                success: function(response){ // Ketika proses pengiriman berhasil
                    // Ubah kembali text button search menjadi SEARCH
                    // Dan hapus atribut disabled untuk meng-enable kembali button search nya
                    $("#btn-search").html("CARI").removeAttr("disabled");
                    
                    // Ganti isi dari div view dengan view yang diambil dari search.php
                    $("#view").html(response.hasil);
                },
                error: function (xhr, ajaxOptions, thrownError) { // Ketika terjadi error
                    alert(xhr.responseText); // munculkan alert
                }
            });
        });
    });
</script>