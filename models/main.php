<?php
if (!defined('website')) {
	include("index.php");
	die();
}

//TOKEN 
$token = md5(md5("saepulanwar007itpgk"));

//MODELS
class database

{

	function login($con, $username, $password)
	{
		$query = mysqli_query($con, "SELECT * FROM tb_login WHERE username = '$username' AND password = '$password' AND status = '1'");
		$data  = mysqli_fetch_array($query);

		if (mysqli_num_rows($query)) {
			//Session
			session_start();
			$_SESSION['adminwebsite123'] = htmlspecialchars($username); // htmlspecialchars() sanitises XSS
			$_SESSION['role'] 	 		 = htmlspecialchars($data['role']); // htmlspecialchars() sanitises XSS
			$_SESSION['status'] 	 	 = htmlspecialchars($data['status']); // htmlspecialchars() sanitises XSS

			$ipmu = $_SERVER['REMOTE_ADDR'];
			$message = "true";
			$waktuini = date("Y-m-d H:i:s");
			$log = mysqli_query($con, "INSERT INTO log VALUES(null,'$username $ipmu','$waktuini','LOGIN');");
		} else {

			$message = "false";
		}
		return $message;
	}

	// HISTORY

	function tampilHistory($con)
	{
		$list = array();
		$query = mysqli_query($con, "SELECT * FROM log order by id_log DESC");
		while ($data = mysqli_fetch_array($query)) {
			$list[] = $data;
		}
		return $list;
	}

	function tampilPenggunaDetail($con, $username)
	{
		$query = mysqli_query($con, "SELECT * FROM tb_login WHERE username = '$username'");
		$data = mysqli_fetch_array($query);
		return $data;
	}


	function tampilAdmin($con)
	{
		$list = array();
		$query = mysqli_query($con, "SELECT * FROM tb_login order by id_login DESC");
		while ($data = mysqli_fetch_array($query)) {
			$list[] = $data;
		}
		return $list;
	}

	function detailAdmin($con, $kode)
	{
		$query = mysqli_query($con, "SELECT *
		FROM tb_login WHERE id_login = '$kode';");
		$data = mysqli_fetch_array($query);
		return $data;
	}

	function hapusAdmin($con, $kode)
	{
		$message = new message;
		$query = mysqli_query($con, "DELETE FROM tb_login WHERE id_login='$kode';");
		if ($query) {
			$ipmu = $_SERVER['REMOTE_ADDR'];
			$username = "$_SESSION[adminwebsite123] $ipmu";
			$waktuini = date("Y-m-d H:i:s");
			$log = mysqli_query($con, "INSERT INTO log VALUES(null,'$username','$waktuini','HAPUS DATA USER');");
			$message->alert("Hapus data berhasil !!", "admin.php");
		} else {
			$message->alert("Hapus data gagal !!", "admin.php");
		}
	}

	// USER

	function simpan_admin($con, $username, $password, $role, $status, $token)
	{

		$ipmu 			= $_SERVER['REMOTE_ADDR'];
		$waktuini 		= date("Y-m-d H:i:s");
		$username_ip	= "$_SESSION[adminwebsite123]";
		$waktuini 		= date("Y-m-d H:i:s");

		$sql 	 = "SELECT * FROM tb_login WHERE username = '$username'";

		$process = mysqli_query($con, $sql);
		$num 	 = mysqli_num_rows($process);

		if ($num > 0) {

			$message = "false";
		} else {

			$log    = mysqli_query($con, "INSERT INTO log VALUES(null,'$username_ip','$waktuini','TAMBAH USER $username');");

			//inject ke tbl_mahasiswa
			$add    = mysqli_query($con, "INSERT INTO tb_login values('','$username', '$password', '$role', '$status');");

			if ($add) {
				$message = "true";
			} else {
				$message = "false";
			}
		}

		return $message;
	}

	function simpan_absensi($con, $tanggal, $jam, $username, $departemen, $jabatan, $alasan, $keterangan, $token)
	{

		$ipmu 			= $_SERVER['REMOTE_ADDR'];
		$waktuini 		= date("Y-m-d H:i:s");
		$username_ip	= "$_SESSION[adminwebsite123]";
		$waktuini 		= date("Y-m-d H:i:s");

		$explode = explode("/", $tanggal);
		$tgl_new = $explode[2] . "-" . $explode[1] . "-" . $explode[0];

		$waktu   = $jam . ":00";

		$tgl_jam = $tgl_new . " " . $waktu;

		$log    = mysqli_query($con, "INSERT INTO log VALUES(null,'$username_ip','$waktuini','TAMBAH ABSENSI $username');");

		//inject ke tbl_mahasiswa
		$add    = mysqli_query($con, "INSERT INTO tb_absensi_detail values(null,'$tgl_jam', '$tgl_new', '$waktu', '1','1','$username','$jabatan','$departemen','','1','1','0','2147483647','Mesin 1','$keterangan','$alasan',now());");

		if ($add) {
			$message = "true";
		} else {
			$message = "false";
		}

		return $message;
	}

	function edit_admin($con, $kode, $username, $role, $status, $token)
	{

		$ipmu 			= $_SERVER['REMOTE_ADDR'];
		$waktuini 		= date("Y-m-d H:i:s");
		$username_ip 	= "$_SESSION[adminwebsite123]";

		$log = mysqli_query($con, "INSERT INTO log VALUES(null,'$username_ip','$waktuini','EDIT USER $username');");

		$edit  = mysqli_query($con, "UPDATE tb_login SET username = '$username', role = '$role', status = '$status' WHERE id_login = '$kode';");

		if ($edit) {

			$message = "true";
		} else {

			$message = "false";
		}

		return $message;
	}

	// KARYAWAN

	function tampilKaryawan($con)
	{
		$list = array();
		$query = mysqli_query($con, "SELECT DISTINCT a.id_karyawan,a.nama_lengkap,a.email,a.no_hp,a.id_jabatan,a.id_departemen,a.username,a.tgl_lahir,a.masa_kerja,a.status as status_karyawan, b.*,c.* FROM tb_karyawan a 
				LEFT JOIN tb_jabatan b ON a.id_jabatan = b.id_jabatan
				LEFT JOIN tb_departemen c ON a.id_departemen = c.id_departemen GROUP BY a.id_karyawan
				ORDER BY a.status DESC");
		while ($data = mysqli_fetch_array($query)) {
			$list[] = $data;
		}
		return $list;
	}

	function tampilKaryawanKehadiran($con)
	{
		$list = array();
		$query = mysqli_query($con, "SELECT a.id_absensi_detail,a.tanggal,a.jam, b.nama_lengkap, a.nama, c.nama_jabatan, d.nama_departemen,e.keterangan FROM tb_absensi_detail a
		LEFT JOIN tb_karyawan b ON a.nama = b.username
		LEFT JOIN tb_jabatan c ON b.id_jabatan = c.id_jabatan
		LEFT JOIN tb_departemen d ON b.id_departemen = d.id_departemen
		LEFT JOIN tb_keterangan e ON a.id_keterangan = e.id_keterangan WHERE a.id_keterangan = '0' AND d.nama_departemen NOT IN ('Plant') AND b.status = '1' ORDER BY a.nama, a.tanggal ASC");
		while ($data = mysqli_fetch_array($query)) {
			$list[] = $data;
		}
		return $list;
	}

	function detailKaryawan($con, $kode, $tahun)
	{
		$query = mysqli_query($con, "SELECT a.nama_lengkap,a.email,a.no_hp,a.id_jabatan,a.id_departemen,a.username,a.status, a.tgl_lahir,a.masa_kerja, b.nama_jabatan, c.nama_departemen, d.* FROM tb_karyawan a 
				LEFT JOIN tb_jabatan b ON a.id_jabatan = b.id_jabatan
				LEFT JOIN tb_departemen c ON a.id_departemen = c.id_departemen
				LEFT JOIN tb_absensi d ON a.id_karyawan = d.id_karyawan 
				WHERE d.tahun = '$tahun' AND a.id_karyawan = '$kode';");
		$data = mysqli_fetch_array($query);
		return $data;
	}

	function hapusKaryawan($con, $kode)
	{
		$message = new message;
		$query = mysqli_query($con, "DELETE FROM tb_karyawan WHERE id_karyawan='$kode';");
		if ($query) {
			$ipmu = $_SERVER['REMOTE_ADDR'];
			$username = "$_SESSION[adminwebsite123] $ipmu";
			$waktuini = date("Y-m-d H:i:s");
			$log = mysqli_query($con, "INSERT INTO log VALUES(null,'$username','$waktuini','HAPUS DATA KARYAWAN');");
			$message->alert("Hapus data berhasil !!", "karyawan.php");
		} else {
			$message->alert("Hapus data gagal !!", "karyawan.php");
		}
	}

	function simpan_karyawan($con, $nama_lengkap, $username, $email, $no_hp, $tgl_lahir, $masa_kerja, $jabatan, $departemen, $status, $hak_cuti, $token)
	{

		$ipmu 			= $_SERVER['REMOTE_ADDR'];
		$waktuini 		= date("Y-m-d H:i:s");
		$username_ip	= "$_SESSION[adminwebsite123]";
		$waktuini 		= date("Y-m-d H:i:s");
		$tahun 			= date('Y');

		$tgl_awal 	= explode("/", $tgl_lahir);
		$new_lahir  = $tgl_awal[2] . "-" . $tgl_awal[1] . "-" . $tgl_awal[0];

		$tgl_akhir 	= explode("/", $masa_kerja);
		$new_masuk 	= $tgl_akhir[2] . "-" . $tgl_akhir[1] . "-" . $tgl_akhir[0];

		$log    	= mysqli_query($con, "INSERT INTO log VALUES(null,'$username_ip','$waktuini','TAMBAH KARYAWAN $nama_lengkap');");

		//inject ke tbl_mahasiswa
		$add    	= mysqli_query($con, "INSERT INTO tb_karyawan values('','$nama_lengkap', '$email', '$no_hp', '$new_lahir','$new_masuk', '$username', '$jabatan', '$departemen', '$status');");

		$last_id 	= mysqli_query($con, "SELECT MAX(id_karyawan) as id FROM tb_karyawan");
		$list_id 	= mysqli_fetch_array($last_id);
		$id 		= $list_id['id'];

		$add_absen 	= mysqli_query($con, "INSERT INTO tb_absensi (hak_cuti,tahun,id_karyawan) VALUES ('$hak_cuti','$tahun','$id')");

		if ($add) {
			$message = "true";
		} else {
			$message = "false";
		}

		return $message;
	}

	function edit_karyawan($con, $kode, $nama_lengkap, $username, $email, $no_hp, $tgl_lahir, $masa_kerja, $jabatan, $departemen, $status, $hak_cuti, $cuti_diambil, $telat, $izin_siang, $sakit, $visit, $luar_kota, $jan, $feb, $mar, $apr, $mei, $jun, $jul, $agt, $sep, $okt, $nov, $des, $token)
	{

		$ipmu 			= $_SERVER['REMOTE_ADDR'];
		$waktuini 		= date("Y-m-d H:i:s");
		$username_ip 	= "$_SESSION[adminwebsite123]";
		$tahun 			= date('Y');

		$tgl_awal 	= explode("/", $tgl_lahir);
		$new_lahir  = $tgl_awal[2] . "-" . $tgl_awal[1] . "-" . $tgl_awal[0];

		$tgl_akhir 	= explode("/", $masa_kerja);
		$new_masuk 	= $tgl_akhir[2] . "-" . $tgl_akhir[1] . "-" . $tgl_akhir[0];

		$log 		= mysqli_query($con, "INSERT INTO log VALUES(null,'$username_ip','$waktuini','EDIT KARYAWAN $nama_lengkap');");

		$edit  		= mysqli_query($con, "UPDATE tb_karyawan SET nama_lengkap = '$nama_lengkap', email = '$email', no_hp = '$no_hp', tgl_lahir = '$new_lahir', masa_kerja = '$new_masuk', username = '$username', id_jabatan = '$jabatan', id_departemen = '$departemen', status = '$status' WHERE id_karyawan = '$kode';");

		$tampil 	= mysqli_query($con, "SELECT COUNT(id_karyawan) as jml FROM tb_absensi WHERE tahun = '$tahun' AND id_karyawan = '$kode'");
		$jml        = mysqli_fetch_array($tampil);

		if ($jml['jml'] < 1) {

			$delete 	= mysqli_query($con, "DELETE FROM tb_absensi WHERE tahun = '$tahun' AND id_karyawan = '$kode'");

			$add_absen 	= mysqli_query($con, "INSERT INTO tb_absensi (hak_cuti,cuti_diambil,telat,sakit,izin_siang,visit,luar_kota,tahun,id_karyawan) VALUES ('$hak_cuti','$cuti_diambil','$telat','$sakit','$izin_siang','$visit','$luar_kota','$tahun','$kode')");
		} else {

			$add_absen 	= mysqli_query($con, "UPDATE tb_absensi SET hak_cuti = '$hak_cuti',cuti_diambil='$cuti_diambil',telat='$telat',sakit='$sakit',izin_siang='$izin_siang',visit='$visit',luar_kota='$luar_kota', jan='$jan', feb='$feb', mar='$mar', apr='$apr', mei='$mei', jun='$jun',jul='$jul',agt='$agt',sep='$sep',okt='$okt',nov='$nov',des='$des' WHERE tahun = '$tahun' AND id_karyawan = '$kode' ");
		}

		if ($add_absen) {

			$message = "true";
		} else {

			$message = "false";
		}

		return $message;
	}

	// JABATAN

	function tampilJabatan($con)
	{
		$list = array();
		$query = mysqli_query($con, "SELECT * FROM tb_jabatan ORDER BY id_jabatan DESC");
		while ($data = mysqli_fetch_array($query)) {
			$list[] = $data;
		}
		return $list;
	}

	function tampilJabatanKaryawan($con)
	{
		$list = array();
		$query = mysqli_query($con, "SELECT * FROM tb_jabatan WHERE status = '1' ORDER BY id_jabatan DESC");
		while ($data = mysqli_fetch_array($query)) {
			$list[] = $data;
		}
		return $list;
	}

	function detailJabatan($con, $kode)
	{
		$query = mysqli_query($con, "SELECT *
		FROM tb_jabatan WHERE id_jabatan = '$kode';");
		$data = mysqli_fetch_array($query);
		return $data;
	}

	function hapusJabatan($con, $kode)
	{
		$message = new message;
		$query = mysqli_query($con, "DELETE FROM tb_jabatan WHERE id_jabatan='$kode';");
		if ($query) {
			$ipmu = $_SERVER['REMOTE_ADDR'];
			$username = "$_SESSION[adminwebsite123] $ipmu";
			$waktuini = date("Y-m-d H:i:s");
			$log = mysqli_query($con, "INSERT INTO log VALUES(null,'$username','$waktuini','HAPUS DATA JABATAN');");
			$message->alert("Hapus data berhasil !!", "jabatan.php");
		} else {
			$message->alert("Hapus data gagal !!", "jabatan.php");
		}
	}

	function simpan_jabatan($con, $nama_jabatan, $status, $token)
	{

		$ipmu 			= $_SERVER['REMOTE_ADDR'];
		$waktuini 		= date("Y-m-d H:i:s");
		$username_ip	= "$_SESSION[adminwebsite123]";
		$waktuini 		= date("Y-m-d H:i:s");

		$log    = mysqli_query($con, "INSERT INTO log VALUES(null,'$username_ip','$waktuini','TAMBAH JABATAN $nama_jabatan');");

		//inject ke tbl_mahasiswa
		$add    = mysqli_query($con, "INSERT INTO tb_jabatan values('','$nama_jabatan', '$status');");

		if ($add) {
			$message = "true";
		} else {
			$message = "false";
		}

		return $message;
	}

	function edit_jabatan($con, $kode, $nama_jabatan, $status, $token)
	{

		$ipmu 			= $_SERVER['REMOTE_ADDR'];
		$waktuini 		= date("Y-m-d H:i:s");
		$username_ip 	= "$_SESSION[adminwebsite123]";

		$log = mysqli_query($con, "INSERT INTO log VALUES(null,'$username_ip','$waktuini','EDIT JABATAN $nama_jabatan');");

		$edit  = mysqli_query($con, "UPDATE tb_jabatan SET nama_jabatan = '$nama_jabatan', status = '$status' WHERE id_jabatan = '$kode';");

		if ($edit) {

			$message = "true";
		} else {

			$message = "false";
		}

		return $message;
	}

	// DEPARTEMEN

	function tampilDepartemen($con)
	{
		$list = array();
		$query = mysqli_query($con, "SELECT * FROM tb_departemen ORDER BY id_departemen DESC");
		while ($data = mysqli_fetch_array($query)) {
			$list[] = $data;
		}
		return $list;
	}

	function tampilDepartemenKaryawan($con)
	{
		$list = array();
		$query = mysqli_query($con, "SELECT * FROM tb_departemen WHERE status = '1' ORDER BY id_departemen DESC");
		while ($data = mysqli_fetch_array($query)) {
			$list[] = $data;
		}
		return $list;
	}

	function detailDepartemen($con, $kode)
	{
		$query = mysqli_query($con, "SELECT *
		FROM tb_departemen WHERE id_departemen = '$kode';");
		$data = mysqli_fetch_array($query);
		return $data;
	}

	function hapusDepartemen($con, $kode)
	{
		$message = new message;
		$query = mysqli_query($con, "DELETE FROM tb_departemen WHERE id_departemen='$kode';");
		if ($query) {
			$ipmu = $_SERVER['REMOTE_ADDR'];
			$username = "$_SESSION[adminwebsite123] $ipmu";
			$waktuini = date("Y-m-d H:i:s");
			$log = mysqli_query($con, "INSERT INTO log VALUES(null,'$username','$waktuini','HAPUS DATA DEPARTEMEN');");
			$message->alert("Hapus data berhasil !!", "departemen.php");
		} else {
			$message->alert("Hapus data gagal !!", "departemen.php");
		}
	}

	function simpan_departemen($con, $nama_departemen, $status, $token)
	{

		$ipmu 			= $_SERVER['REMOTE_ADDR'];
		$waktuini 		= date("Y-m-d H:i:s");
		$username_ip	= "$_SESSION[adminwebsite123]";
		$waktuini 		= date("Y-m-d H:i:s");

		$log    = mysqli_query($con, "INSERT INTO log VALUES(null,'$username_ip','$waktuini','TAMBAH DEPARTEMEN $nama_departemen');");

		//inject ke tbl_mahasiswa
		$add    = mysqli_query($con, "INSERT INTO tb_departemen values('','$nama_departemen', '$status');");

		if ($add) {
			$message = "true";
		} else {
			$message = "false";
		}

		return $message;
	}

	function edit_departemen($con, $kode, $nama_departemen, $status, $token)
	{

		$ipmu 			= $_SERVER['REMOTE_ADDR'];
		$waktuini 		= date("Y-m-d H:i:s");
		$username_ip 	= "$_SESSION[adminwebsite123]";

		$log = mysqli_query($con, "INSERT INTO log VALUES(null,'$username_ip','$waktuini','EDIT DEPARTEMEN $nama_departemen');");

		$edit  = mysqli_query($con, "UPDATE tb_departemen SET nama_departemen = '$nama_departemen', status = '$status' WHERE id_departemen = '$kode';");

		if ($edit) {

			$message = "true";
		} else {

			$message = "false";
		}

		return $message;
	}

	// KETERANGAN

	function tampilKeterangan($con)
	{
		$list = array();
		$query = mysqli_query($con, "SELECT * FROM tb_keterangan ORDER BY id_keterangan DESC");
		while ($data = mysqli_fetch_array($query)) {
			$list[] = $data;
		}
		return $list;
	}

	function detailKeterangan($con, $kode)
	{
		$query = mysqli_query($con, "SELECT *
		FROM tb_keterangan WHERE id_keterangan = '$kode';");
		$data = mysqli_fetch_array($query);
		return $data;
	}

	function hapusKeterangan($con, $kode)
	{
		$message = new message;
		$query = mysqli_query($con, "DELETE FROM tb_keterangan WHERE id_keterangan='$kode';");
		if ($query) {
			$ipmu = $_SERVER['REMOTE_ADDR'];
			$username = "$_SESSION[adminwebsite123] $ipmu";
			$waktuini = date("Y-m-d H:i:s");
			$log = mysqli_query($con, "INSERT INTO log VALUES(null,'$username','$waktuini','HAPUS DATA KETERANGAN');");
			$message->alert("Hapus data berhasil !!", "keterangan.php");
		} else {
			$message->alert("Hapus data gagal !!", "keterangan.php");
		}
	}

	function simpan_keterangan($con, $nm_keterangan, $kode, $token)
	{

		$ipmu 			= $_SERVER['REMOTE_ADDR'];
		$waktuini 		= date("Y-m-d H:i:s");
		$username_ip	= "$_SESSION[adminwebsite123]";
		$waktuini 		= date("Y-m-d H:i:s");

		$log    = mysqli_query($con, "INSERT INTO log VALUES(null,'$username_ip','$waktuini','TAMBAH KETERANGAN $nm_keterangan');");

		//inject ke tbl_mahasiswa
		$add    = mysqli_query($con, "INSERT INTO tb_keterangan values('','$nm_keterangan','$kode');");

		if ($add) {
			$message = "true";
		} else {
			$message = "false";
		}

		return $message;
	}

	function edit_keterangan($con, $id, $nm_keterangan, $kode, $token)
	{

		$ipmu 			= $_SERVER['REMOTE_ADDR'];
		$waktuini 		= date("Y-m-d H:i:s");
		$username_ip 	= "$_SESSION[adminwebsite123]";

		$log = mysqli_query($con, "INSERT INTO log VALUES(null,'$username_ip','$waktuini','EDIT KETERANGAN $nm_keterangan');");

		$edit  = mysqli_query($con, "UPDATE tb_keterangan SET keterangan = '$nm_keterangan', kode = '$kode' WHERE id_keterangan = '$id';");

		if ($edit) {

			$message = "true";
		} else {

			$message = "false";
		}

		return $message;
	}

	// DENDA

	function tampilDenda($con)
	{
		$list = array();
		$query = mysqli_query($con, "SELECT * FROM tb_denda ORDER BY id_denda DESC");
		while ($data = mysqli_fetch_array($query)) {
			$list[] = $data;
		}
		return $list;
	}

	function detailDenda($con, $kode)
	{
		$query = mysqli_query($con, "SELECT *
		FROM tb_denda WHERE id_denda = '$kode';");
		$data = mysqli_fetch_array($query);
		return $data;
	}

	function hapusDenda($con, $kode)
	{
		$message = new message;
		$query = mysqli_query($con, "DELETE FROM tb_denda WHERE id_denda='$kode';");
		if ($query) {
			$ipmu = $_SERVER['REMOTE_ADDR'];
			$username = "$_SESSION[adminwebsite123] $ipmu";
			$waktuini = date("Y-m-d H:i:s");
			$log = mysqli_query($con, "INSERT INTO log VALUES(null,'$username','$waktuini','HAPUS DATA DENDA');");
			$message->alert("Hapus data berhasil !!", "denda.php");
		} else {
			$message->alert("Hapus data gagal !!", "denda.php");
		}
	}

	function simpan_denda($con, $nm_denda, $jml_denda, $token)
	{

		$ipmu 			= $_SERVER['REMOTE_ADDR'];
		$waktuini 		= date("Y-m-d H:i:s");
		$username_ip	= "$_SESSION[adminwebsite123]";
		$waktuini 		= date("Y-m-d H:i:s");

		$log    = mysqli_query($con, "INSERT INTO log VALUES(null,'$username_ip','$waktuini','TAMBAH DENDA $nm_keterangan');");

		//inject ke tbl_mahasiswa
		$add    = mysqli_query($con, "INSERT INTO tb_denda values('','$nm_denda','$jml_denda');");

		if ($add) {
			$message = "true";
		} else {
			$message = "false";
		}

		return $message;
	}

	function edit_denda($con, $id, $nm_denda, $jml_denda, $token)
	{

		$ipmu 			= $_SERVER['REMOTE_ADDR'];
		$waktuini 		= date("Y-m-d H:i:s");
		$username_ip 	= "$_SESSION[adminwebsite123]";

		$log = mysqli_query($con, "INSERT INTO log VALUES(null,'$username_ip','$waktuini','EDIT KETERANGAN $nm_keterangan');");

		$edit  = mysqli_query($con, "UPDATE tb_denda SET nama_denda = '$nm_denda', jml_denda = '$jml_denda' WHERE id_denda = '$id';");

		if ($edit) {

			$message = "true";
		} else {

			$message = "false";
		}

		return $message;
	}

	// ABSENSI

	function edit_absensi_keterangan($con, $kode, $nm_keterangan, $alasan, $jam, $token)
	{
		$message = new message;
		$query = mysqli_query($con, "UPDATE tb_absensi_detail SET id_keterangan = '$nm_keterangan', alasan = '$alasan', jam = '$jam' WHERE id_absensi_detail='$kode';");
		if ($query) {
			$ipmu = $_SERVER['REMOTE_ADDR'];
			$username = "$_SESSION[adminwebsite123] $ipmu";
			$waktuini = date("Y-m-d H:i:s");
			$log = mysqli_query($con, "INSERT INTO log VALUES(null,'$username','$waktuini','UBAH DATA KETERANGAN ABSENSI $kode');");
			$message->alert("Keterangan berhasil di edit !!", "absensi.php");
		} else {
			$message->alert("Keterangan gagal di edit !!", "absensi.php");
		}
	}

	function edit_keterangan_absen_user($con, $check, $alasan, $jam, $token)
	{

		for ($i = 0; $i < count($check); $i++) {

			$tmp 		= $check[$i];
			$new_tmp	= explode(" ", $tmp);
			$id_keterangan 		= $new_tmp[0];
			$id_absensi_detail  = $new_tmp[1];

			$tmp_jam     = $jam[$i];
			$new_tmp_jam = explode(".", $tmp_jam);
			$arr_jam     = $new_tmp_jam[0];
			$arr_menit   = $new_tmp_jam[1];
			$new_jam     = $arr_jam . ':' . $arr_menit . ':00';

			$query = mysqli_query($con, "UPDATE tb_absensi_detail SET id_keterangan = '$id_keterangan', alasan = '$alasan[$i]', jam = '$new_jam' WHERE id_absensi_detail='$id_absensi_detail';");
		}

		if ($query) {

			$ipmu 		= $_SERVER['REMOTE_ADDR'];
			$username 	= "$_SESSION[adminwebsite123]";
			$waktuini 	= date("Y-m-d H:i:s");
			$log 		= mysqli_query($con, "INSERT INTO log VALUES(null,'$username','$waktuini','EDIT KETERANGAN ABSEN USER');");

			$message = "true";
		} else {

			$message = "false";
		}

		return $message;
	}

	function detailEditKeteranganAbsensi($con, $id)
	{

		$query = mysqli_query($con, "SELECT a.id_absensi_detail,a.tanggal,a.jam,a.id_keterangan, b.nama_lengkap, a.nama, c.nama_jabatan, d.nama_departemen,e.keterangan FROM tb_absensi_detail a
                      LEFT JOIN tb_karyawan b ON a.nama = b.username
                      LEFT JOIN tb_jabatan c ON b.id_jabatan = c.id_jabatan
                      LEFT JOIN tb_departemen d ON b.id_departemen = d.id_departemen
                      LEFT JOIN tb_keterangan e ON a.id_keterangan = e.id_keterangan WHERE a.id_absensi_detail = '$id'");
		$data = mysqli_fetch_array($query);
		return $data;
	}

	function simpan_cuti($con, $nama_lengkap, $departemen, $jabatan, $tgl_dari, $tgl_sampai, $tgl_masuk, $keperluan_cuti, $tentacles, $token)
	{

		$tgl_awal 	= explode("/", $tgl_dari);
		$new_awal   = $tgl_awal[2] . "-" . $tgl_awal[1] . "-" . $tgl_awal[0];

		$tgl_akhir 	= explode("/", $tgl_sampai);
		$new_akhir 	= $tgl_akhir[2] . "-" . $tgl_akhir[1] . "-" . $tgl_akhir[0];

		$tgl_msk 	= explode("/", $tgl_masuk);
		$new_masuk 	= $tgl_msk[2] . "-" . $tgl_msk[1] . "-" . $tgl_msk[0];

		$ipmu 			= $_SERVER['REMOTE_ADDR'];
		$waktuini 		= date("Y-m-d H:i:s");

		$log 		= mysqli_query($con, "INSERT INTO log VALUES(null,'$nama_lengkap','$waktuini','TAMBAH CUTI USER $nama_lengkap');");

		$simpan  	= mysqli_query($con, "INSERT INTO tb_cuti (nama_lengkap,bagian,jabatan,tgl_dari,tgl_sampai,tgl_masuk,keperluan_cuti,jml,created) VALUES ('$nama_lengkap','$departemen','$jabatan','$new_awal','$new_akhir','$new_masuk','$keperluan_cuti','$tentacles','$waktuini')");

		$sql 				= "SELECT max(id_cuti) AS lastu_id FROM tb_cuti LIMIT 1";
		$hasil 				= mysqli_query($con, $sql);
		$row 				= mysqli_fetch_array($hasil);
		$_SESSION['lastId'] = $row['lastu_id'];

		if ($simpan) {

			$message = "true";
		} else {

			$message = "false";
		}

		return $message;
	}

	function tampilCuti($con)
	{
		$list = array();
		$query = mysqli_query($con, "SELECT a.keperluan_cuti, a.created, b.username, a.tgl_dari, a.tgl_sampai, a.tgl_masuk FROM tb_cuti a, tb_karyawan b WHERE a.nama_lengkap = b.nama_lengkap AND a.status = 'Tidak Ambil' ORDER BY a.id_cuti ASC");
		while ($data = mysqli_fetch_array($query)) {
			$list[] = $data;
		}
		return $list;
	}
}

class message
{
	function alert($pesan, $link)
	{
		echo '
		<script>
			alert("' . $pesan . '");
			window.location.href="' . $link . '";
		</script>
		';
	}
}

