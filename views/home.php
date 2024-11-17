<div class="content-wrapper">
	<div class="row">
		<br>
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="padding-left: 20px; padding-right: 20px">
			<div>
				<ol class="breadcrumb" style="background-color: #3c8dbc">
					<li class="active" style="color: #000"><a style="color: #fff" href="?tampil=beranda"><i class="fa fa-dashboard"></i> Dashboard</a></li>
				</ol>
			</div>
		</div>

		<!-- content -->
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="padding-left: 20px; padding-right: 20px">
			<div class="panel panel-default">
				<div class="panel-body" id="panel-body">
					<center><h2>SELAMAT DATANG DI APLIKASI e-ABSENSI BPTD XVI KALTENG</h2></center>
					<hr>
		 			<!-- Main content -->
		 
		 			<section class="content">
      					<p align="justify"><b>e-ABSENSI BPTD XVI KALTENG</b> Silahkan melakukan manajemen absensi dengan klik pada setiap menu yang tersedia. Apabila ada kendala mohon menghubungi Developer Gunung Media</p>
					</section>
        		</div>
      		</div>
    	</div>
    	<!-- akhir content -->
  	</div>

  	<!-- Main content -->
    <section class="content">
      	<!-- Info boxes -->
      	<div class="row">
        	<div class="col-md-3 col-sm-6 col-xs-12">
          		<div class="info-box">
            		<span class="info-box-icon bg-aqua"><i class="fa fa-user"></i></span>

            		<div class="info-box-content">
              			<span class="info-box-text">Admin Aktif</span>
              			<span class="info-box-number">
                      <?php
                          $user    = mysqli_query($con, "SELECT COUNT(*) as jmlUser FROM tb_login");
                          $jmluser = mysqli_fetch_array($user);

                          echo $jmluser['jmlUser'];
                      ?>
                    </span>
            		</div>
            		<!-- /.info-box-content -->
          		</div>
          	<!-- /.info-box -->
        	</div>
			
			<!-- /.col -->
        	<div class="col-md-3 col-sm-6 col-xs-12">
          		<div class="info-box">
            		<span class="info-box-icon bg-red"><i class="fa fa-database"></i></span>

            		<div class="info-box-content">
              			<span class="info-box-text">Data Karyawan</span>
              			<span class="info-box-number">
                      <?php
                          $karyawan    = mysqli_query($con, "SELECT COUNT(*) as jmlKaryawan FROM tb_karyawan");
                          $jmlkaryawan = mysqli_fetch_array($karyawan);

                          echo $jmlkaryawan['jmlKaryawan'];
                      ?>
                    </span>
            		</div>
            		<!-- /.info-box-content -->
          		</div>
          		<!-- /.info-box -->
        	</div>
        	<!-- /.col -->

        	<!-- fix for small devices only -->
        	<div class="clearfix visible-sm-block"></div>

        	<div class="col-md-3 col-sm-6 col-xs-12">
          		<div class="info-box">
            		<span class="info-box-icon bg-green"><i class="fa fa-briefcase"></i></span>

            		<div class="info-box-content">
              			<span class="info-box-text">Data Jabatan</span>
              			<span class="info-box-number">
                      <?php
                          $jabatan    = mysqli_query($con, "SELECT COUNT(*) as jmlJabatan FROM tb_jabatan");
                          $jmljabatan = mysqli_fetch_array($jabatan);

                          echo $jmljabatan['jmlJabatan'];
                      ?>
                    </span>
            		</div>
            		<!-- /.info-box-content -->
          		</div>
          		<!-- /.info-box -->
        	</div>
			
			<!-- /.col -->
        	<div class="col-md-3 col-sm-6 col-xs-12">
          		<div class="info-box">
            		<span class="info-box-icon bg-yellow"><i class="fa fa-file-text-o"></i></span>

            		<div class="info-box-content">
              			<span class="info-box-text">Data Absensi</span>
              			<span class="info-box-number">
                      <?php
                          $absensi    = mysqli_query($con, "SELECT COUNT(*) as jmlAbsensi FROM tb_absensi_detail");
                          $jmlabsensi = mysqli_fetch_array($absensi);

                          echo rupiah($jmlabsensi['jmlAbsensi']);;
                      ?>
                    </span>
            		</div>
            		<!-- /.info-box-content -->
          		</div>
          	<!-- /.info-box -->
        	</div>
        <!-- /.col -->
      	</div>
	<!-- /.row -->
	</section>
</div>
<div class="control-sidebar-bg"></div>



