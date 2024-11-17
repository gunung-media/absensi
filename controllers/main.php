<?php
if (!defined('website')) {
	include("index.php");
	die();
}

date_default_timezone_set("Asia/Jakarta");

//CONTROLLERS
if (isset($_GET["modul"])) {
	$modul = addslashes(mysqli_real_escape_string($con, strtoupper($_GET["modul"])));

	//MODUL DATABASE
	$database = new database;

	//MODUL POPUP ALERT JAVASCRIPT
	$message = new message;

	//TOKEN 
	$token = md5(md5("saepulanwar007itpgk"));

	//SUBMENU
	$menu = explode("/", $modul);
	$modul = $menu[0];
	if (!empty($menu[1])) {
		$submenu = $menu[1];
	} else {
		$submenu = "";
	}
	/////////////////////////////////////////////////////////////////////////////////////////

	//ALUR SISTEM

	if ($modul == 'LOGIN') {
		session_start();
		if (isset($_POST["login"])) {

			$username = addslashes(mysqli_real_escape_string($con, $_POST["username"]));
			$password = addslashes(mysqli_real_escape_string($con, md5($_POST["password"])));
			$login    = $database->login($con, $username, $password);
		}

		include("views/login.php");
	} else if ($modul == 'HOME') {
		session_start();

		if ($_SESSION['adminwebsite123']) {

			include("views/header.php");
			include("views/sidebar.php");
			include("views/home.php");
			include("views/footer.php");
		} else {

			header("location: login.php");
		}
	} else if ($modul == 'MASTER-DATA') {

		session_start();

		if ($_SESSION['adminwebsite123']) {

			include("views/header.php");
			include("views/sidebar.php");

			if ($_SESSION['role'] == 'SA' || $_SESSION['role'] == 'USER') {

				include("views/master-data.php");
			} else {

				include("views/error.php");
			}

			include("views/footer.php");
		} else {

			header("location: login.php");
		}
	}

	// ADMIN

	else if ($modul == 'ADMIN') {
		session_start();

		if (!empty($_GET["tambah"]) && $_GET["tambah"] == "true" && $_GET["token"] == "$token") {
			if ($_SESSION['adminwebsite123']) {

				if (isset($_POST["simpan"])) {
					$username 		= mysqli_real_escape_string($con, $_POST["username"]);
					$password 		= mysqli_real_escape_string($con, md5($_POST["password"]));
					$role   		= mysqli_real_escape_string($con, $_POST["role"]);
					$status   		= mysqli_real_escape_string($con, $_POST["status"]);

					$admin 			= $database->simpan_admin($con, $username, $password, $role, $status, $token);
				}

				include("views/header.php");
				include("views/sidebar.php");
				include("views/admin-tambah.php");
				include("views/footer.php");
			} else {

				header("location: login.php");
			}
		} else if (!empty($_GET["edit"]) && $_GET["token"] == "$token") {
			if ($_SESSION['adminwebsite123']) {

				$kode = $_GET["edit"];

				if (isset($_POST["ganti"])) {
					$username 		= mysqli_real_escape_string($con, $_POST["username"]);
					$role   		= mysqli_real_escape_string($con, $_POST["role"]);
					$status   		= mysqli_real_escape_string($con, $_POST["status"]);

					$admin 			= $database->edit_admin($con, $kode, $username, $role, $status, $token);
				}

				include("views/header.php");
				include("views/sidebar.php");
				include("views/admin-edit.php");
				include("views/footer.php");
			} else {

				header("location: login.php");
			}
		} else if (!empty($_GET["hapus"])) {

			$kode  = $_GET["hapus"];
			$hapus = $database->hapusAdmin($con, $kode);
		} else {

			if ($_SESSION['adminwebsite123']) {

				include("views/header.php");
				include("views/sidebar.php");
				include("views/admin.php");
				include("views/footer.php");
			} else {

				header("location: login.php");
			}
		}
	}

	// KARYAWAN

	else if ($modul == 'KARYAWAN') {
		session_start();

		if (!empty($_GET["tambah"]) && $_GET["tambah"] == "true" && $_GET["token"] == "$token") {
			if ($_SESSION['adminwebsite123']) {

				if (isset($_POST["simpan"])) {
					$nama_lengkap 	= mysqli_real_escape_string($con, $_POST["nama_lengkap"]);
					$username 		= mysqli_real_escape_string($con, $_POST["username"]);
					$email 			= mysqli_real_escape_string($con, $_POST["email"]);
					$no_hp   		= mysqli_real_escape_string($con, $_POST["no_hp"]);
					$tgl_lahir 		= mysqli_real_escape_string($con, $_POST["tgl_lahir"]);
					$masa_kerja		= mysqli_real_escape_string($con, $_POST["masa_kerja"]);
					$jabatan 		= mysqli_real_escape_string($con, $_POST["jabatan"]);
					$departemen		= mysqli_real_escape_string($con, $_POST["departemen"]);
					$status   		= mysqli_real_escape_string($con, $_POST["status"]);
					$hak_cuti 		= mysqli_real_escape_string($con, $_POST["hak_cuti"]);

					$karyawan 		= $database->simpan_karyawan($con, $nama_lengkap, $username, $email, $no_hp, $tgl_lahir, $masa_kerja, $jabatan, $departemen, $status, $hak_cuti, $token);
				}

				include("views/header.php");
				include("views/sidebar.php");
				include("views/karyawan-tambah.php");
				include("views/footer.php");
			} else {

				header("location: login.php");
			}
		} else if (!empty($_GET["edit"]) && $_GET["token"] == "$token") {
			if ($_SESSION['adminwebsite123']) {

				$kode = $_GET["edit"];

				if (isset($_POST["ganti"])) {
					$nama_lengkap 	= mysqli_real_escape_string($con, $_POST["nama_lengkap"]);
					$username 		= mysqli_real_escape_string($con, $_POST["username"]);
					$email 			= mysqli_real_escape_string($con, $_POST["email"]);
					$no_hp   		= mysqli_real_escape_string($con, $_POST["no_hp"]);
					$tgl_lahir 		= mysqli_real_escape_string($con, $_POST["tgl_lahir"]);
					$masa_kerja		= mysqli_real_escape_string($con, $_POST["masa_kerja"]);
					$jabatan 		= mysqli_real_escape_string($con, $_POST["jabatan"]);
					$departemen		= mysqli_real_escape_string($con, $_POST["departemen"]);
					$status   		= mysqli_real_escape_string($con, $_POST["status"]);
					$hak_cuti 		= mysqli_real_escape_string($con, $_POST["hak_cuti"]);
					$cuti_diambil	= mysqli_real_escape_string($con, $_POST["cuti_diambil"]);
					$telat 			= mysqli_real_escape_string($con, $_POST["telat"]);
					$izin_siang 	= mysqli_real_escape_string($con, $_POST["izin_siang"]);
					$sakit 			= mysqli_real_escape_string($con, $_POST["sakit"]);
					$visit 			= mysqli_real_escape_string($con, $_POST["visit"]);
					$luar_kota 		= mysqli_real_escape_string($con, $_POST["luar_kota"]);

					$jan 		= mysqli_real_escape_string($con, $_POST["jan"]);
					$feb 		= mysqli_real_escape_string($con, $_POST["feb"]);
					$mar 		= mysqli_real_escape_string($con, $_POST["mar"]);
					$apr 		= mysqli_real_escape_string($con, $_POST["apr"]);
					$mei 		= mysqli_real_escape_string($con, $_POST["mei"]);
					$jun 		= mysqli_real_escape_string($con, $_POST["jun"]);
					$jul 		= mysqli_real_escape_string($con, $_POST["jul"]);
					$agt 		= mysqli_real_escape_string($con, $_POST["agt"]);
					$sep 		= mysqli_real_escape_string($con, $_POST["sep"]);
					$okt 		= mysqli_real_escape_string($con, $_POST["okt"]);
					$nov 		= mysqli_real_escape_string($con, $_POST["nov"]);
					$des 		= mysqli_real_escape_string($con, $_POST["des"]);

					$karyawan 		= $database->edit_karyawan($con, $kode, $nama_lengkap, $username, $email, $no_hp, $tgl_lahir, $masa_kerja, $jabatan, $departemen, $status, $hak_cuti, $cuti_diambil, $telat, $izin_siang, $sakit, $visit, $luar_kota, $jan, $feb, $mar, $apr, $mei, $jun, $jul, $agt, $sep, $okt, $nov, $des, $token);
				}

				include("views/header.php");
				include("views/sidebar.php");
				include("views/karyawan-edit.php");
				include("views/footer.php");
			} else {

				header("location: login.php");
			}
		} else if (!empty($_GET["hapus"])) {

			$kode  = $_GET["hapus"];
			$hapus = $database->hapusKaryawan($con, $kode);
		} else {

			if ($_SESSION['adminwebsite123']) {

				include("views/header.php");
				include("views/sidebar.php");
				include("views/karyawan.php");
				include("views/footer.php");
			} else {

				header("location: login.php");
			}
		}
	}

	// JABATAN 

	else if ($modul == 'JABATAN') {

		session_start();

		if (!empty($_GET["tambah"]) && $_GET["tambah"] == "true" && $_GET["token"] == "$token") {
			if ($_SESSION['adminwebsite123']) {

				if (isset($_POST["simpan"])) {
					$nama_jabatan   = mysqli_real_escape_string($con, $_POST["nama_jabatan"]);
					$status    		= mysqli_real_escape_string($con, $_POST["status"]);

					$jabatan      	= $database->simpan_jabatan($con, $nama_jabatan, $status, $token);
				}

				include("views/header.php");
				include("views/sidebar.php");
				include("views/jabatan-tambah.php");
				include("views/footer.php");
			} else {

				header("location: login.php");
			}
		} else if (!empty($_GET["edit"]) && $_GET["token"] == "$token") {
			if ($_SESSION['adminwebsite123']) {

				$kode = $_GET["edit"];

				if (isset($_POST["ganti"])) {
					$nama_jabatan   = mysqli_real_escape_string($con, $_POST["nama_jabatan"]);
					$status    		= mysqli_real_escape_string($con, $_POST["status"]);

					$jabatan      	= $database->edit_jabatan($con, $kode, $nama_jabatan, $status, $token);
				}

				include("views/header.php");
				include("views/sidebar.php");
				include("views/jabatan-edit.php");
				include("views/footer.php");
			} else {

				header("location: login.php");
			}
		} else if (!empty($_GET["hapus"])) {

			$kode  = $_GET["hapus"];
			$hapus = $database->hapusJabatan($con, $kode);
		} else {

			if ($_SESSION['adminwebsite123']) {

				include("views/header.php");
				include("views/sidebar.php");
				include("views/jabatan.php");
				include("views/footer.php");
			} else {

				header("location: login.php");
			}
		}
	}

	// DEPARTEMEN 

	else if ($modul == 'DEPARTEMEN') {

		session_start();

		if (!empty($_GET["tambah"]) && $_GET["tambah"] == "true" && $_GET["token"] == "$token") {
			if ($_SESSION['adminwebsite123']) {

				if (isset($_POST["simpan"])) {
					$nama_departemen  	= mysqli_real_escape_string($con, $_POST["nama_departemen"]);
					$status    			= mysqli_real_escape_string($con, $_POST["status"]);

					$departemen    	= $database->simpan_departemen($con, $nama_departemen, $status, $token);
				}

				include("views/header.php");
				include("views/sidebar.php");
				include("views/departemen-tambah.php");
				include("views/footer.php");
			} else {

				header("location: login.php");
			}
		} else if (!empty($_GET["edit"]) && $_GET["token"] == "$token") {
			if ($_SESSION['adminwebsite123']) {

				$kode = $_GET["edit"];

				if (isset($_POST["ganti"])) {
					$nama_departemen   	= mysqli_real_escape_string($con, $_POST["nama_departemen"]);
					$status    			= mysqli_real_escape_string($con, $_POST["status"]);

					$departemen      	= $database->edit_departemen($con, $kode, $nama_departemen, $status, $token);
				}

				include("views/header.php");
				include("views/sidebar.php");
				include("views/departemen-edit.php");
				include("views/footer.php");
			} else {

				header("location: login.php");
			}
		} else if (!empty($_GET["hapus"])) {

			$kode  = $_GET["hapus"];
			$hapus = $database->hapusDepartemen($con, $kode);
		} else {

			if ($_SESSION['adminwebsite123']) {

				include("views/header.php");
				include("views/sidebar.php");
				include("views/departemen.php");
				include("views/footer.php");
			} else {

				header("location: login.php");
			}
		}
	}

	// KETERANGAN 

	else if ($modul == 'KETERANGAN') {

		session_start();

		if (!empty($_GET["tambah"]) && $_GET["tambah"] == "true" && $_GET["token"] == "$token") {
			if ($_SESSION['adminwebsite123']) {

				if (isset($_POST["simpan"])) {
					$nm_keterangan  = mysqli_real_escape_string($con, $_POST["keterangan"]);
					$kode 		    = mysqli_real_escape_string($con, $_POST["kode"]);

					$keterangan     = $database->simpan_keterangan($con, $nm_keterangan, $kode, $token);
				}

				include("views/header.php");
				include("views/sidebar.php");
				include("views/keterangan-tambah.php");
				include("views/footer.php");
			} else {

				header("location: login.php");
			}
		} else if (!empty($_GET["edit"]) && $_GET["token"] == "$token") {
			if ($_SESSION['adminwebsite123']) {

				$id = $_GET["edit"];

				if (isset($_POST["ganti"])) {
					$nm_keterangan  = mysqli_real_escape_string($con, $_POST["keterangan"]);
					$kode 		    = mysqli_real_escape_string($con, $_POST["kode"]);

					$keterangan     = $database->edit_keterangan($con, $id, $nm_keterangan, $kode, $token);
				}

				include("views/header.php");
				include("views/sidebar.php");
				include("views/keterangan-edit.php");
				include("views/footer.php");
			} else {

				header("location: login.php");
			}
		} else if (!empty($_GET["hapus"])) {

			$kode  = $_GET["hapus"];
			$hapus = $database->hapusKeterangan($con, $kode);
		} else {

			if ($_SESSION['adminwebsite123']) {

				include("views/header.php");
				include("views/sidebar.php");
				include("views/keterangan.php");
				include("views/footer.php");
			} else {

				header("location: login.php");
			}
		}
	}

	// DENDA 

	else if ($modul == 'DENDA') {

		session_start();

		if (!empty($_GET["tambah"]) && $_GET["tambah"] == "true" && $_GET["token"] == "$token") {
			if ($_SESSION['adminwebsite123']) {

				if (isset($_POST["simpan"])) {
					$nm_denda 	 = mysqli_real_escape_string($con, $_POST["nm_denda"]);
					$jml_denda   = mysqli_real_escape_string($con, $_POST["jml_denda"]);

					$denda  = $database->simpan_denda($con, $nm_denda, $jml_denda, $token);
				}

				include("views/header.php");
				include("views/sidebar.php");
				include("views/denda-tambah.php");
				include("views/footer.php");
			} else {

				header("location: login.php");
			}
		} else if (!empty($_GET["edit"]) && $_GET["token"] == "$token") {
			if ($_SESSION['adminwebsite123']) {

				$id = $_GET["edit"];

				if (isset($_POST["ganti"])) {
					$nm_denda 	 = mysqli_real_escape_string($con, $_POST["nm_denda"]);
					$jml_denda   = mysqli_real_escape_string($con, $_POST["jml_denda"]);

					$denda  	 = $database->edit_denda($con, $id, $nm_denda, $jml_denda, $token);
				}

				include("views/header.php");
				include("views/sidebar.php");
				include("views/denda-edit.php");
				include("views/footer.php");
			} else {

				header("location: login.php");
			}
		} else if (!empty($_GET["hapus"])) {

			$kode  = $_GET["hapus"];
			$hapus = $database->hapusDenda($con, $kode);
		} else {

			if ($_SESSION['adminwebsite123']) {

				include("views/header.php");
				include("views/sidebar.php");
				include("views/denda.php");
				include("views/footer.php");
			} else {

				header("location: login.php");
			}
		}
	}

	// ABSENSI 

	else if ($modul == 'ABSENSI') {

		session_start();

		if (!empty($_GET["tambah"]) && $_GET["tambah"] == "true" && $_GET["token"] == "$token") {
			if ($_SESSION['adminwebsite123']) {

				if (isset($_POST["aksi-edit"])) {
					$check 		= $_POST['absen'];
					$alasan 	= $_POST['alasan'];
					$jam 		= $_POST['jam'];

					$edit = $database->edit_keterangan_absen_user($con, $check, $alasan, $jam, $token);
				}

				include("views/header.php");
				include("views/sidebar.php");
				include("views/absensi-edit.php");
				include("views/footer.php");
			} else {

				header("location: login.php");
			}
		} else if (!empty($_GET["input"]) && $_GET["input"] == "true" && $_GET["token"] == "$token") {
			if ($_SESSION['adminwebsite123']) {

				if (isset($_POST["aksi-tambah"])) {
					$tanggal 	 	= mysqli_real_escape_string($con, $_POST["tanggal"]);
					$jam 	 		= mysqli_real_escape_string($con, $_POST["jam"]);
					$username 	    = mysqli_real_escape_string($con, $_POST["username"]);
					$departemen     = mysqli_real_escape_string($con, $_POST["departemen"]);
					$jabatan      	= mysqli_real_escape_string($con, $_POST["jabatan"]);
					$alasan      	= mysqli_real_escape_string($con, $_POST["alasan"]);
					$keterangan    	= mysqli_real_escape_string($con, $_POST["keterangan"]);

					$simpan 		= $database->simpan_absensi($con, $tanggal, $jam, $username, $departemen, $jabatan, $alasan, $keterangan, $token);
				}

				include("views/header.php");
				include("views/sidebar.php");
				include("views/absensi-tambah.php");
				include("views/footer.php");
			} else {

				header("location: login.php");
			}
		} else if (!empty($_GET["luar"]) && $_GET["luar"] == "true" && $_GET["token"] == "$token") {
			if ($_SESSION['adminwebsite123']) {

				if (isset($_POST["aksi-edit"])) {
					$check 		= $_POST['absen'];
					$alasan 	= $_POST['alasan'];
					$jam 		= $_POST['jam'];

					$edit = $database->edit_keterangan_absen_user($con, $check, $alasan, $jam, $token);
				}

				include("views/header.php");
				include("views/sidebar.php");
				include("views/luar-kota.php");
				include("views/footer.php");
			} else {

				header("location: login.php");
			}
		} else if (!empty($_GET["edit"]) && $_GET["edit"] == "true" && $_GET["token"] == "$token") {
			if ($_SESSION['adminwebsite123']) {

				$kode  			= mysqli_real_escape_string($con, $_POST["id_absensi_detail"]);
				$nm_keterangan  = mysqli_real_escape_string($con, $_POST["keterangan"]);
				$alasan         = mysqli_real_escape_string($con, $_POST["alasan"]);
				$jam         	= mysqli_real_escape_string($con, $_POST["jam"]);

				$keterangan     = $database->edit_absensi_keterangan($con, $kode, $nm_keterangan, $alasan, $jam, $token);
			} else {

				header("location: index.php");
			}
		} else {

			if ($_SESSION['adminwebsite123']) {

				include("views/header.php");
				include("views/sidebar.php");
				include("views/absensi.php");
				include("views/footer.php");
			} else {

				header("location: login.php");
			}
		}
	}

	// HISTORY

	else if ($modul == "HISTORY") {
		session_start();

		if ($_SESSION['adminwebsite123']) {

			include("views/header.php");
			include("views/sidebar.php");
			include("views/history.php");
			include("views/footer.php");
		} else {

			header("location: login.php");
		}
	}

	// PERMOHONAN CUTI

	else if ($modul == "PERMOHONAN-CUTI") {
		session_start();

		if ($_SESSION['adminwebsite123']) {

			include("views/header.php");
			include("views/sidebar.php");
			include("views/permohonan-cuti.php");
			include("views/footer.php");
		} else {

			header("location: login.php");
		}
	} else if ($modul == "KONTAK") {
		session_start();

		if ($_SESSION['adminwebsite123']) {

			include("views/header.php");
			include("views/sidebar.php");
			include("views/kontak.php");
			include("views/footer.php");
		} else {

			header("location: login.php");
		}
	} else if ($modul == "PASSWORD") {
		session_start();

		if ($_SESSION['adminwebsite123']) {

			include("views/header.php");
			include("views/sidebar.php");
			include("views/password.php");
			include("views/footer.php");
		} else {

			header("location: login.php");
		}
	}

	// IMPORT

	else if ($modul == 'IMPORT') {

		session_start();

		require_once('vendor/php-excel-reader/excel_reader2.php');
		require_once('vendor/SpreadsheetReader.php');
		require_once('fungsi.php');

		if (isset($_POST["import"])) {

			$allowedFileType = ['application/vnd.ms-excel', 'text/xls', 'text/xlsx', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'];

			if (in_array($_FILES["file"]["type"], $allowedFileType)) {

				$file_name  = $_FILES['file']['name'];
				$file_size  = $_FILES['file']['size'];
				$tgl_upload = mysqli_real_escape_string($con, $_POST['tanggal']);

				$tmp_tgl  	= explode('/', $tgl_upload);
				$new_tgl    = $tmp_tgl[2] . "-" . $tmp_tgl[1] . "-" . $tmp_tgl[0];

				//cari extensi file dengan menggunakan fungsi explode
				$explode  = explode('.', $file_name);
				$extensi  = $explode[count($explode) - 1];

				$filenamedif = random(6) . '.' . $extensi;

				$targetPath = 'uploads/' . $filenamedif;
				move_uploaded_file($_FILES['file']['tmp_name'], $targetPath);

				$_SESSION['target']    = $targetPath;
				$_SESSION['username']  = $_SESSION['adminwebsite123'];

				$Reader = new SpreadsheetReader($targetPath);

				$sheetCount = count($Reader->sheets());

				$truncate = mysqli_query($con, "DELETE FROM tb_absensi_detail WHERE tanggal = '$new_tgl'");

				foreach ($Reader as $Row) {
					$banding = mysqli_query($con, "SELECT nama FROM tb_absensi_detail WHERE nama = '" . $Row[5] . "' AND tanggal = '" . $new_tgl . "'");
					$data_banding = mysqli_fetch_array($banding);

					if ($data_banding['nama'] == $Row[5]) {
						continue;
					}

					$kol_tgl 		= mysqli_real_escape_string($con, $Row[0]);

					$tmp_kol_tgl    = explode(" ", $kol_tgl);
					$tgl_input      = $tmp_kol_tgl[0];
					$wkt_input 		= $tmp_kol_tgl[1];

					$new_kol_tgl    = explode("-", $tgl_input);
					$kolom_tgl      = $new_kol_tgl[2] . '-' . $new_kol_tgl[1] . '-' . $new_kol_tgl[0];

					$new_kolom1 		= $kolom_tgl . ' ' . $wkt_input;

					$kolom1 = "";
					if (isset($Row[0])) {
						$kolom1 = $new_kolom1;
					}

					$kolom2 = "";
					if (isset($Row[1])) {
						$tgl 	 		= mysqli_real_escape_string($con, $Row[1]);
						$tmp_tanggal_2  = explode('-', $tgl);
						$kolom2    		= $tmp_tanggal_2[2] . "-" . $tmp_tanggal_2[1] . "-" . $tmp_tanggal_2[0];
					}

					$kolom3 = "";
					if (isset($Row[2])) {
						$kolom3 		= $wkt_input;
					}

					$kolom4 = "";
					if (isset($Row[3])) {
						$kolom4 = mysqli_real_escape_string($con, $Row[3]);
					}

					$kolom5 = "";
					if (isset($Row[4])) {
						$kolom5 = mysqli_real_escape_string($con, $Row[4]);
					}

					$kolom6 = "";
					if (isset($Row[5])) {
						$kolom6 = mysqli_real_escape_string($con, $Row[5]);
					}

					$kolom7 = "";
					if (isset($Row[6])) {
						$kolom7 = mysqli_real_escape_string($con, $Row[6]);
					}

					$kolom8 = "";
					if (isset($Row[7])) {
						$kolom8 = mysqli_real_escape_string($con, $Row[7]);
					}

					$kolom9 = "";
					if (isset($Row[8])) {
						$kolom9 = mysqli_real_escape_string($con, $Row[8]);
					}

					$kolom10 = "";
					if (isset($Row[9])) {
						$kolom10 = mysqli_real_escape_string($con, $Row[9]);
					}

					$kolom11 = "";
					if (isset($Row[10])) {
						$kolom11 = mysqli_real_escape_string($con, $Row[10]);
					}

					$kolom12 = "";
					if (isset($Row[11])) {
						$kolom12 = mysqli_real_escape_string($con, $Row[11]);
					}

					$kolom13 = "";
					if (isset($Row[12])) {
						$kolom13 = mysqli_real_escape_string($con, $Row[12]);
					}

					$kolom14 = "";
					if (isset($Row[13])) {
						$kolom14 = mysqli_real_escape_string($con, $Row[13]);
					}

					if (!empty($kolom1) || !empty($kolom2)) {

						if ($kolom3 > '08:35:59' && $kolom7 !== 'OB / Kurir') {

							$query = "INSERT INTO tb_absensi_detail VALUES (null,'" . $new_kolom1 . "','" . $kolom2 . "','" . $kolom3 . "','" . $kolom4 . "','" . $kolom5 . "','" . $kolom6 . "','" . $kolom7 . "','" . $kolom8 . "','" . $kolom9 . "','" . $kolom10 . "','" . $kolom11 . "','" . $kolom12 . "','" . $kolom13 . "','" . $kolom14 . "','3','','$new_tgl')";
						} else if ($kolom3 > '07:15:59' && $kolom7 == 'OB / Kurir') {

							$query = "INSERT INTO tb_absensi_detail VALUES (null,'" . $new_kolom1 . "','" . $kolom2 . "','" . $kolom3 . "','" . $kolom4 . "','" . $kolom5 . "','" . $kolom6 . "','" . $kolom7 . "','" . $kolom8 . "','" . $kolom9 . "','" . $kolom10 . "','" . $kolom11 . "','" . $kolom12 . "','" . $kolom13 . "','" . $kolom14 . "','3','','$new_tgl')";
						} else {

							$query = "INSERT INTO tb_absensi_detail VALUES (null,'" . $new_kolom1 . "','" . $kolom2 . "','" . $kolom3 . "','" . $kolom4 . "','" . $kolom5 . "','" . $kolom6 . "','" . $kolom7 . "','" . $kolom8 . "','" . $kolom9 . "','" . $kolom10 . "','" . $kolom11 . "','" . $kolom12 . "','" . $kolom13 . "','" . $kolom14 . "','1','','$new_tgl')";
						}

						$result = mysqli_query($con, $query);
					}
				}

				$delete = mysqli_query($con, "DELETE FROM tb_absensi_detail WHERE nip = '0' AND pin = '0'");

				$karyawan = mysqli_query($con, "SELECT DISTINCT a.username, b.nama_jabatan,c.nama_departemen FROM tb_karyawan a 
							LEFT JOIN tb_jabatan b ON a.id_jabatan = b.id_jabatan
							LEFT JOIN tb_departemen c ON a.id_departemen = c.id_departemen WHERE a.username NOT IN
							(SELECT nama FROM tb_absensi_detail WHERE tanggal = '$new_tgl') GROUP BY a.id_karyawan
							ORDER BY a.id_karyawan DESC");

				while ($list = mysqli_fetch_array($karyawan)) {

					$simpan = mysqli_query($con, "INSERT INTO tb_absensi_detail (tanggal,pin,nip,nama,jabatan,departemen,verifikasi,io,workcode,sn,mesin,id_keterangan,tgl_upload) VALUES ('$new_tgl','1','1','$list[username]','$list[nama_jabatan]','$list[nama_departemen]','1','1','0','2147483647','Mesin 1','0','$new_tgl')");
				}

				$username		= "$_SESSION[adminwebsite123]";
				$ipmu 			= $_SERVER['REMOTE_ADDR'];
				$waktuini 		= date("Y-m-d");
				$log 			= mysqli_query($con, "INSERT INTO log VALUES(null,'$username $ipmu','$waktuini','IMPORT DATA KARYAWAN $new_tgl');");


				if ($result) {

					echo '<script>alert("Data berhasil di Import");</script>';
				} else {


					echo '<script>alert("Data gagal di Import");</script>';
				}
			} else {
				$type = "error";
				$message = "Invalid File Type. Upload Excel File.";
			}
		}

		include("views/header.php");
		include("views/sidebar.php");

		if ($_SESSION['role'] == 'SA' || $_SESSION['role'] == 'USER') {
			include("views/import.php");
		} else {
			include("views/error.php");
		}
		include("views/footer.php");
	}

	// LAPORAN

	else if ($modul == 'LAPORAN') {

		session_start();

		if (!empty($_GET["rekap-absensi"]) && $_GET["rekap-absensi"] == "true" && $_GET["token"] == "$token") {
			if ($_SESSION['adminwebsite123']) {

				include("views/header.php");
				include("views/sidebar.php");
				include("views/rekap-absensi.php");
				include("views/footer.php");
			} else {

				header("location: login.php");
			}
		} else if (!empty($_GET["rekap-plant"]) && $_GET["rekap-plant"] == "true" && $_GET["token"] == "$token") {
			if ($_SESSION['adminwebsite123']) {

				include("views/header.php");
				include("views/sidebar.php");
				include("views/rekap-plant.php");
				include("views/footer.php");
			} else {

				header("location: login.php");
			}
		} else if (!empty($_GET["rekap-karyawan"]) && $_GET["rekap-karyawan"] == "true" && $_GET["token"] == "$token") {
			if ($_SESSION['adminwebsite123']) {

				if (isset($_POST["ganti"])) {
					$nm_keterangan  = mysqli_real_escape_string($con, $_POST["keterangan"]);
					$kode 		    = mysqli_real_escape_string($con, $_POST["kode"]);

					$keterangan     = $database->edit_keterangan($con, $id, $nm_keterangan, $kode, $token);
				}

				include("views/header.php");
				include("views/sidebar.php");
				include("views/keterangan-edit.php");
				include("views/footer.php");
			} else {

				header("location: login.php");
			}
		} else if (!empty($_GET["laporan-catering"]) && $_GET["laporan-catering"] == "true" && $_GET["token"] == "$token") {
			if ($_SESSION['adminwebsite123']) {

				include("views/header.php");
				include("views/sidebar.php");
				include("views/laporan-catering.php");
				include("views/footer.php");
			} else {

				header("location: login.php");
			}
		} else if (!empty($_GET["rekap-catering"]) && $_GET["rekap-catering"] == "true" && $_GET["token"] == "$token") {
			if ($_SESSION['adminwebsite123']) {

				include("views/header.php");
				include("views/sidebar.php");
				include("views/rekap-catering.php");
				include("views/footer.php");
			} else {

				header("location: login.php");
			}
		} else if (!empty($_GET["laporan-telat"]) && $_GET["laporan-telat"] == "true" && $_GET["token"] == "$token") {
			if ($_SESSION['adminwebsite123']) {

				include("views/header.php");
				include("views/sidebar.php");
				include("views/laporan-telat.php");
				include("views/footer.php");
			} else {

				header("location: login.php");
			}
		} else if (!empty($_GET["rekap-bulanan"]) && $_GET["rekap-bulanan"] == "true" && $_GET["token"] == "$token") {
			if ($_SESSION['adminwebsite123']) {

				include("views/header.php");
				include("views/sidebar.php");
				include("views/rekap-bulanan.php");
				include("views/footer.php");
			} else {

				header("location: login.php");
			}
		} else if (!empty($_GET["aksi-laporan-catering"]) && $_GET["aksi-laporan-catering"] == "true" && $_GET["token"] == "$token") {
			if ($_SESSION['adminwebsite123']) {

				include("models/laporan-catering.php");
			} else {

				header("location: login.php");
			}
		} else if (!empty($_GET["aksi-laporan-telat"]) && $_GET["aksi-laporan-telat"] == "true" && $_GET["token"] == "$token") {
			if ($_SESSION['adminwebsite123']) {

				include("models/laporan-telat.php");
			} else {

				header("location: login.php");
			}
		} else if (!empty($_GET["aksi-laporan-bulanan"]) && $_GET["aksi-laporan-bulanan"] == "true" && $_GET["token"] == "$token") {
			if ($_SESSION['adminwebsite123']) {

				include("models/rekap-bulanan.php");
			} else {

				header("location: login.php");
			}
		} else if (!empty($_GET["aksi-rekap-catering"]) && $_GET["aksi-rekap-catering"] == "true" && $_GET["token"] == "$token") {
			if ($_SESSION['adminwebsite123']) {

				include("models/rekap-catering.php");
			} else {

				header("location: login.php");
			}
		} else if (!empty($_GET["aksi-rekap-absensi"]) && $_GET["aksi-rekap-absensi"] == "true" && $_GET["token"] == "$token") {
			if ($_SESSION['adminwebsite123']) {

				include("models/rekap-absensi.php");
			} else {

				header("location: login.php");
			}
		} else if (!empty($_GET["aksi-rekap-plant"]) && $_GET["aksi-rekap-plant"] == "true" && $_GET["token"] == "$token") {
			if ($_SESSION['adminwebsite123']) {

				include("models/rekap-plant.php");
			} else {

				header("location: login.php");
			}
		} else {

			if ($_SESSION['adminwebsite123']) {

				include("views/header.php");
				include("views/sidebar.php");

				if ($_SESSION['role'] == 'SA' || $_SESSION['role'] == 'USER') {
					include("views/laporan.php");
				} else {
					include("views/error.php");
				}
				include("views/footer.php");
			} else {

				header("location: login.php");
			}
		}
	} else if ($modul == 'LOGOUT') {
		session_start();
		session_destroy();

		unset($_SESSION['adminwebsite123']);

		header("location: login.php");
	} else if ($modul == 'CUTI') {
		if (isset($_POST['submit'])) {

			$nama_lengkap 		= addslashes(mysqli_real_escape_string($con, $_POST["nama_lengkap"]));
			$departemen 		= addslashes(mysqli_real_escape_string($con, $_POST["departemen"]));
			$jabatan 			= addslashes(mysqli_real_escape_string($con, $_POST["jabatan"]));
			$tgl_dari 			= addslashes(mysqli_real_escape_string($con, $_POST["tgl_dari"]));
			$tgl_sampai 		= addslashes(mysqli_real_escape_string($con, $_POST["tgl_sampai"]));
			$tgl_masuk 			= addslashes(mysqli_real_escape_string($con, $_POST["tgl_masuk"]));
			$keperluan_cuti 	= addslashes(mysqli_real_escape_string($con, $_POST["keperluan_cuti"]));
			$tentacles 			= addslashes(mysqli_real_escape_string($con, $_POST["tentacles"]));

			$simpan  			= $database->simpan_cuti($con, $nama_lengkap, $departemen, $jabatan, $tgl_dari, $tgl_sampai, $tgl_masuk, $keperluan_cuti, $tentacles, $token);
		}

		include("views/cuti.php");
	}
} else {
	header("location: cuti.php");
}
