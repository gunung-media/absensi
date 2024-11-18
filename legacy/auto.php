<?php
// Set header type konten.
header("Content-Type: application/json; charset=UTF-8");

include "config.php";
global $db;
//get search term
$searchTerm = $_GET['term'];
//get matched data from skills table
$query = $db
    ->query("SELECT a.nama_lengkap, b.nama_jabatan, c.nama_departemen  FROM tb_karyawan a, tb_jabatan b, tb_departemen c WHERE a.nama_lengkap LIKE '%" . $searchTerm . "%' AND a.id_jabatan = b.id_jabatan AND a.id_departemen = c.id_departemen ORDER BY a.id_karyawan ASC LIMIT 10");

$data = [];

while ($row = $query->fetch_assoc()) {
    $data[] = $row['nama_lengkap'];
}
//return json data
echo json_encode($data);
