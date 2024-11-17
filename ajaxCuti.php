<?php

$table = 'tb_cuti';
$primaryKey = 'id_cuti';

$columns = array(
    array('db' => 'nama_lengkap', 'dt' => 0),
    array(
        'db' => 'tgl_dari',
        'dt' => 1,
        'formatter' => function ($d, $row) {
            return date('d/m/Y', strtotime($d));
        }
    ),
    array(
        'db' => 'tgl_sampai',
        'dt' => 2,
        'formatter' => function ($d, $row) {
            return date('d/m/Y', strtotime($d));
        }
    ),
    array(
        'db' => 'tgl_masuk',
        'dt' => 3,
        'formatter' => function ($d, $row) {
            return date('d/m/Y', strtotime($d));
        }
    ),
    array('db' => 'keperluan_cuti', 'dt' => 4),
    array('db' => 'status', 'dt' => 5)
);

include "config.php";
global $sql_details;
require('ssp.php');

echo json_encode(
    SSP::simple($_GET, $sql_details, $table, $primaryKey, $columns)
);
