<?php
if (!defined('website')) {include("index.php");die();}
?>

<div class="control-sidebar-bg"></div>
<footer class="main-footer">
        <div class="pull-right hidden-xs">
          <b>Version</b> 1.0
        </div>
        <strong>Copyright &copy; 2024 - <a href="#"> BPTD XVI KALTENG</a></strong>
    </footer>
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
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 3.3.7 -->
<script src="<?php echo $BaseUrl; ?>/themes/server/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- DataTables -->
<script src="<?php echo $BaseUrl; ?>/themes/server/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?php echo $BaseUrl; ?>/themes/server/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>

<!-- datepicker -->
<script src="<?php echo $BaseUrl; ?>/themes/server/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>

<!-- AdminLTE App -->
<script src="<?php echo $BaseUrl; ?>/themes/server/dist/js/adminlte.min.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="<?php echo $BaseUrl; ?>/themes/server/dist/js/pages/dashboard.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?php echo $BaseUrl; ?>/themes/server/dist/js/demo.js"></script>
<!-- CK Editor -->
<script src="<?php echo $BaseUrl; ?>/themes/server/bower_components/ckeditor/ckeditor.js"></script>

<!-- Select2 -->
<script src="<?php echo $BaseUrl; ?>/themes/server/bower_components/select2/dist/js/select2.full.min.js"></script>

<script type="text/javascript" src="<?php echo $BaseUrl; ?>/moment-timepicker.js"></script>
<script type="text/javascript" src="<?php echo $BaseUrl; ?>/bootstrap-material-datetimepicker.js"></script>

<script>
    $('#time').bootstrapMaterialDatePicker
    ({
        date: false,
        shortTime: false,
        format: 'HH:mm'
    });
</script>
<script>
    function formatCurrency(num) {
    num = num.toString().replace(/\$|\,/g,'');
    if(isNaN(num))
        num = "0";
        sign = (num == (num = Math.abs(num)));
        num = Math.floor(num*100+0.50000000001);
        cents = num%100;
        num = Math.floor(num/100).toString();
    if(cents<10)
        cents = "0" + cents;
        for (var i = 0; i < Math.floor((num.length-(1+i))/3); i++)
        num = num.substring(0,num.length-(4*i+3))+'.'+
        num.substring(num.length-(4*i+3));
        return (((sign)?'':'-') + 'Rp. ' + num);
    }
</script>
    
<script>
    $(function () {
        $('#example1').DataTable({
            'scrollX': true
        });
    });

    $('.example2').DataTable({
        order: [],
        columnDefs: [{orderable: false, targets: 'no-sort'}],
        bSort: false,
    });
</script>

<script>
    $("#datepicker").datepicker( {
        format: "yyyy",
        viewMode: "years", 
        minViewMode: "years",
    }).on('change', function (ev) {
        $(this).datepicker('hide');
    });

    $(function () {
        var now = new Date();
        $("#datepicker").datepicker();
        $("#datepicker").datepicker("setDate", now);
    });
</script>

<script>
    $(function() {
        $(".datepickeredit").datepicker({
            format: 'dd/mm/yy'
        }).on('change', function (ev) {
            $(this).datepicker('hide');
        });
    });
</script>

<script>
    $(".datepickeradd").datepicker({
        format: 'dd/mm/yyyy'
    }).on('change', function (ev) {
        $(this).datepicker('hide');
    });

    $(function () {
        var now = new Date();
        $(".datepickeradd").datepicker();
        $(".datepickeradd").datepicker("setDate", now);
    });
</script>

<script>
    $(function() {
        $(".tglawal").datepicker({
            format: 'dd/mm/yyyy'
        }).on('change', function (ev) {
            $(this).datepicker('hide');
        });
    });
</script>

<script>
    $(function() {
        $(".tglakhir").datepicker({
            format: 'dd/mm/yyyy'
        }).on('change', function (ev) {
            $(this).datepicker('hide');
        });
    });
</script>

<script>
    $(function () {
        //Initialize Select2 Elements
        $('.select2').select2();
    });
</script>

<script type="text/javascript">
    $(function() {
        $(".checkbox").click(function(){
            $('#delete').prop('disabled',$('input.checkbox:checked').length == 0);
        });
    });
</script>

<script>
    $(function() {
        $("#nama_lengkap").change(function(){
            var nama_lengkap = $("#nama_lengkap").val();

            $.ajax({
                url: '<?php echo $BaseUrl; ?>/proses-ajax-absensi.php',
                type: 'POST',
                dataType: 'json',
                data: {
                    'nama_lengkap': nama_lengkap
                },
                success: function (akun) {
                    $("#jabatan").val(akun['nama_jabatan']);
                    $("#departemen").val(akun['nama_departemen']);
                    $("#username").val(akun['username']);
                }
            });
        });
    });
</script>

</body>
</html>