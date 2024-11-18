<?php

$table = 'tb_absensi_detail';
$primaryKey = 'id_absensi_detail';

$columns = array(
    array(
        'db' => 'tanggal',
        'dt' => 0,
        'formatter' => function ($d, $row) {
            return date('d/m/Y', strtotime($d));
        }
    ),
    array('db' => 'jam', 'dt' => 1),
    array('db' => 'nama_lengkap', 'dt' => 2),
    /*array( 'db' => 'nm_customer','dt' => 3,
        'formatter' => function( $d, $row ) {
            return substr( $d, 0,15);
        }
    ),*/
    array('db' => 'nama', 'dt' => 3),
    array('db' => 'nama_departemen', 'dt' => 4),
    array('db' => 'keterangan', 'dt' => 5),
    array('db' => 'alasan', 'dt' => 6)
);

include "config.php";
global $sql_details;
require('ssp.php');

echo json_encode(
    SSP::complex($_GET, $sql_details, $table, $primaryKey, $columns)
);
