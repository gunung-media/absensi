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

		<style type="text/css"> 

			.form-group.diambil input::-webkit-input-placeholder { /* Edge */
			  color: #000;
			  font-weight: bold;
			}

			.form-group.diambil input:-ms-input-placeholder { /* Internet Explorer 10-11 */
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

		<div class="wrapper" style="background:#ddd;">
			<div class="inner">
				<div class="image-holder">
					<img src="<?php echo $BaseUrl; ?>/themes/cuti/images/back-2.jpg" alt="">
				</div>
				<form action="" method="POST">
					<h3>Permohonan Cuti</h3>
					<div class="form-wrapper">
						<input type="text" placeholder="Nama Lengkap" id="nama_lengkap" class="form-control" required>
						<i class="zmdi zmdi-account"></i>
					</div>
					<div class="form-group">
						<input type="text" placeholder="Bagian" id="departemen" class="form-control" required readonly>
						<input type="text" placeholder="Jabatan" id="jabatan" class="form-control" required readonly>
					</div>

					<div class="form-wrapper">
						<input type="text" placeholder="Tgl Pengambilan Cuti" class="form-control tglambil" required>
						<i class="zmdi zmdi-calendar"></i>
					</div>
					<div class="form-wrapper">
						<input type="text" placeholder="Tgl Masuk Kembali" class="form-control tglmasuk" required>
						<i class="zmdi zmdi-calendar"></i>
					</div>
					<div class="form-wrapper">
						<textarea type="text" placeholder="Keperluan Cuti" class="form-control" required></textarea>
						<i class="zmdi zmdi-edit"></i>
					</div>
					<div class="form-group diambil">
						<input type="text" placeholder="Cuti sudah diambil" class="diambil" readonly required style="border:none">
						<input type="text" placeholder="Cuti akan diambil" class="diambil" readonly required style="border:none">
						
					</div>
					<?php
						$index = 0;
					?>
					<div class="form-group">
						<input type="text" value="0" id="diambil" class="form-control" readonly required>
						<span class="carousel-control-prev control-galelah control-categories"
                                            role="button" data-slide="prev" id="remove" onclick="remove_quantity('#cart-quantity-<?php echo $index; ?>');" style="cursor: pointer;">
                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                        <span class="sr-only" style="margin:5px">-</span>
                                    </span>
						<input type="text" value="0" class="form-control" name="tentacles" id="cart-quantity-<?php echo $index; ?>" readonly="readonly" value="<?php echo $cart['quantity']; ?>" required style="text-align:center;width:38%">
						<span class="carousel-control-next control-galelah control-categories"
                                            role="button" data-slide="next" id="add" onclick="add_quantity('#cart-quantity-<?php echo $index; ?>');" style="cursor: pointer;">
                                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                        <span class="sr-only" style="margin:5px">+</span>
                                    </span>
					</div>
					<div class="form-group diambil">
						<input type="text" placeholder="Sisa Cuti" class="diambil" readonly required style="border:none">	
					</div>
					<div class="form-group">
						<textarea type="text" placeholder="Sisa Cuti" id="sisa_cuti" name="sisa_cuti" class="form-control" readonly></textarea>

						<textarea type="text" placeholder="Sisa Cuti" name="sisa_cuti" class="form-control jml" readonly></textarea>
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
		    function add_quantity(qty){
		        var quantity = $(qty);
		        quantity.val(eval(quantity.val()) + 1);
		        
		        total();
		    }

		    function remove_quantity(qty){
		        var quantity = $(qty);
		        if(quantity.val() < 2){
		            quantity.val(1);
		        } else {
		            quantity.val(eval(quantity.val()) - 1);
		        }

		        total();
		    }

		    function total(){

		    	var sisa_cuti = document.getElementById("sisa_cuti").value ;
		        var total = sisa_cuti-1;
		        var count = <?php echo $index; ?>;
		        $('.jml').html(total);

		    }
		</script>

		<script>
		  $(function() {
		    $( "#nama_lengkap" ).autocomplete({
		      source: '<?php echo $BaseUrl; ?>/auto.php'
		    });
		  });
		</script>

		<script>
		    $(function() {
		        $("#nama_lengkap").change(function(){
		            var nama_lengkap = $("#nama_lengkap").val();

		            $.ajax({
		                url: '<?php echo $BaseUrl; ?>/proses-ajax.php',
		                type: 'POST',
		                dataType: 'json',
		                data: {
		                    'nama_lengkap': nama_lengkap
		                },
		                success: function (akun) {
		                    $("#jabatan").val(akun['nama_jabatan']);
		                    $("#departemen").val(akun['nama_departemen']);
		                    $("#diambil").val(akun['diambil']);
		                    $("#sisa_cuti").val(akun['sisa_cuti']);
		                }
		            });
		        });
		    });
		</script>

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
		        $(".tglmasuk").datepicker({
		            dateFormat: 'dd/mm/yy',
		            minDate: new Date(),
		            beforeShowDay: $.datepicker.noWeekends
		        })
		    });
		</script>
		
	</body><!-- This templates was made by Colorlib (https://colorlib.com) -->
</html>