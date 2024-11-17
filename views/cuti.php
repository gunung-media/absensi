<?php

include '../config.php';
global $BaseUrl;

?>

<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<title>Form Permohonan</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<!-- MATERIAL DESIGN ICONIC FONT -->
	<link rel="stylesheet" href="<?php echo $BaseUrl; ?>/themes/cuti/fonts/material-design-iconic-font/css/material-design-iconic-font.min.css">

	<!-- STYLE CSS -->
	<link rel="stylesheet" href="<?php echo $BaseUrl; ?>/themes/cuti/css/style.css">

	<!-- SWEET ALERT -->
	<link rel="stylesheet" type="text/css" href="<?php echo $BaseUrl; ?>/sweetalert/src/sweetalert.css">
	<script type="text/javascript" src="<?php echo $BaseUrl; ?>/sweetalert/src/sweetalert.min.js"></script>

	<style type="text/css">
		.form-group.diambil input::-webkit-input-placeholder {
			/* Edge */
			color: #000;
			font-weight: bold;
		}

		.form-group.diambil input:-ms-input-placeholder {
			/* Internet Explorer 10-11 */
			color: #000;
			font-weight: bold;
		}

		.form-group.diambil input::placeholder {
			color: #000;
			font-weight: bold;
		}
	</style>
</head>

<body>

	<?php

	if (!empty($simpan)) {
		if ($simpan) {
			echo '
			        <script>
			            swal({
			                text: "Surat Permohonan Cuti Berhasil Dibuat !!t",
			                icon: "success",
			                type: "success",
			                title: "Berhasil"
			            }).then(function() {
			                window.open("print-cuti.php?id=' . $_SESSION['lastId'] . '", "_blank");
			            });
			        </script>
			        ';

			unset($_SESSION['lastId']);
		} else {
			echo '
			        <script>
			            swal({
			                text: "Surat Permohonan Cuti Gagal Dibuat !!!!",
			                icon: "error",
			                type: "error"
			            });
			        </script>
			        ';
		}
	}

	?>

	<div class="wrapper" style="background:#ddd;">
		<div class="inner">
			<div class="image-holder">
				<?php include "kalendar.php"; ?>
				<img src="<?php echo $BaseUrl; ?>/themes/cuti/images/alone.gif" alt="">
				<center>
					<p style="font-weight:bold">2020 &copy; Sistem Absensi</p>
				</center>
			</div>
			<form action="" method="POST">
				<h3 style="font-size:20px">Form Permohonan Cuti</h3>
				<div class="form-wrapper">
					<input type="text" placeholder="Nama Lengkap" name="nama_lengkap" id="nama_lengkap" class="form-control" required>
					<i class="zmdi zmdi-account"></i>
				</div>
				<div class="form-group">
					<input type="text" placeholder="Bagian" id="departemen" name="departemen" class="form-control" required readonly>
					<input type="text" placeholder="Jabatan" id="jabatan" name="jabatan" class="form-control" required readonly>
				</div>
				<div class="form-group diambil">
					<input type="text" placeholder="Tgl Pengambilan Cuti" readonly required style="border:none">
				</div>
				<div class="form-group">
					<input type="text" placeholder="Dari Tgl" name="tgl_dari" class="form-control tglambil" id="tglambil" required>
					<input type="text" placeholder="Sampai Tgl" name="tgl_sampai" class="form-control tglambil" id="tglsampai" required>
				</div>
				<div class="form-wrapper">
					<input type="text" placeholder="Tgl Masuk Kembali" name="tgl_masuk" class="form-control tglmasuk" required>
					<i class="zmdi zmdi-calendar"></i>
				</div>
				<div class="form-wrapper">
					<textarea type="text" placeholder="Keperluan Cuti" name="keperluan_cuti" class="form-control" required></textarea>
					<i class="zmdi zmdi-edit"></i>
				</div>
				<div class="form-group diambil">
					<input type="text" placeholder="Cuti sudah diambil" class="diambil" readonly required style="border:none">
					<input type="text" placeholder="Cuti akan diambil" class="diambil" readonly required style="border:none">
				</div>
				<div class="form-group">
					<input type="text" value="0" id="diambil" class="form-control" readonly required>
					<button type="button" class="carousel-control-prev control-galelah control-categories"
						role="button" data-slide="prev" onclick="minusFunction(12)" style="cursor: pointer;background:transparent" id="minusbtn">
						<span class="carousel-control-prev-icon" aria-hidden="true"></span>
						<span class="sr-only" style="margin:5px;color:#fff;background:red;padding: 5px;border-radius:10px">-</span>
					</button>
					<input type="text" value="0" class="form-control" name="tentacles" id="tentacles" required style="text-align:center;width:38%" readonly>
					<button type="button" class="carousel-control-next control-galelah control-categories"
						role="button" data-slide="next" onclick="plusFunction(12)" style="cursor: pointer;background:transparent" id="plusbtn">
						<span class="carousel-control-next-icon" aria-hidden="true"></span>
						<span class="sr-only" style="margin:5px;color:#fff;background:red;padding: 5px;border-radius:10px">+</span>
					</button>
				</div>
				<div class="form-group diambil">
					<input type="text" placeholder="Sisa Cuti Sekarang" class="diambil" readonly required style="border:none">
					<input type="text" placeholder="Sisa Cuti" class="diambil" readonly required style="border:none">
				</div>
				<div class="form-group">
					<textarea type="text" placeholder="Sisa Cuti" id="sisa_cuti" name="sisa_cuti" class="form-control sisa_cuti" readonly style="width:46%"></textarea>
					<textarea type="text" placeholder="Sisa Cuti" id="nilai" name="price" class="form-control" readonly style="width:46%;margin-left: 8%;"></textarea>
				</div>

				<button type="submit" name="submit">Submit
					<i class="zmdi zmdi-arrow-right"></i>
				</button>
			</form>
		</div>
	</div>

	<!-- jquery -->
	<script type="text/javascript" src="<?php echo $BaseUrl; ?>/themes/server/js/jquery.min.js"></script>
	<!-- datepicker -->
	<script src="<?php echo $BaseUrl; ?>/themes/server/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>


	<link rel="stylesheet" href="<?php echo $BaseUrl; ?>/themes/server/autocomplete/jquery-ui.min.css">
	<script src="<?php echo $BaseUrl; ?>/themes/server/autocomplete/jquery-ui.min.js"></script>

	<script>
		$(function() {
			$("#nama_lengkap").autocomplete({
				source: '<?php echo $BaseUrl; ?>/auto.php'
			});
		});
	</script>

	<script>
		$(function() {
			$("#nama_lengkap").change(function() {
				var nama_lengkap = $("#nama_lengkap").val();

				$.ajax({
					url: '<?php echo $BaseUrl; ?>/proses-ajax.php',
					type: 'POST',
					dataType: 'json',
					data: {
						'nama_lengkap': nama_lengkap
					},
					success: function(akun) {
						$("#jabatan").val(akun['nama_jabatan']);
						$("#departemen").val(akun['nama_departemen']);
						$("#diambil").val(akun['diambil']);
						$(".sisa_cuti").val(akun['sisa_cuti']);
					}
				});
			});
		});
	</script>

	<!--
		<script>
		    $(function() {
		        $("#tglambil").change(function(){
		            var tglambil = $("#tglambil").val();

		            var tglsampai = document.getElementById("tglambil").value ;

		            $.ajax({

		                success: function (akun) {
		                    $("#tglsampai").val(tglsampai);
		                }
		            });
		        });
		    });
		</script>
	-->

	<script>
		$(function() {

			$(".tglambil").datepicker({
				dateFormat: 'dd/mm/yy',
				minDate: new Date(),
				beforeShowDay: $.datepicker.noWeekends
			})
		});
	</script>

	<script>
		$(function() {

			var button = $('#plusbtn');
			var buttonmns = $('#minusbtn');

			$(button).attr('disabled', 'disabled');
			$(buttonmns).attr('disabled', 'disabled');

			$("#tglsampai").change(function() {
				var tglambil = $("#tglsampai").val();
				var tglsampai = document.getElementById("tglsampai").value;

				if ($(button).attr('disabled')) $(button).removeAttr('disabled');
				else $(button).attr('disabled', 'disabled');

				if ($(buttonmns).attr('disabled')) $(buttonmns).removeAttr('disabled');
				else $(buttonmns).attr('disabled', 'disabled');

				$(".tglmasuk").datepicker({
					dateFormat: 'dd/mm/yy',
					minDate: tglsampai,
					beforeShowDay: $.datepicker.noWeekends
				})
			})
		});
	</script>

	<script>
		function plusFunction(nilai) {
			let value = parseInt(document.getElementById("tentacles").value);
			value++;
			document.getElementById("tentacles").value = value;

			var nilai = document.getElementById("sisa_cuti").value;

			let total = nilai - value;
			let num_parts = total.toString().split(".");
			num_parts[0] = num_parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ".");
			document.getElementById("nilai").innerHTML = `${num_parts.join()}`;
		}

		function minusFunction(nilai) {
			let value = parseInt(document.getElementById("tentacles").value);
			if (value <= 1) {
				document.getElementById("tentacles").value = 1;
			} else {
				value--;
				document.getElementById("tentacles").value = value;
			}

			var nilai = document.getElementById("sisa_cuti").value;

			let total = nilai - value;
			let num_parts = total.toString().split(".");
			num_parts[0] = num_parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ".");
			document.getElementById("nilai").innerHTML = `${num_parts.join()}`;
		}
	</script>

</body><!-- This templates was made by Colorlib (https://colorlib.com) -->

</html>
