<?php

$table = 'log';
$primaryKey = 'id_log';

$columns = array(
    array('db' => 'username', 'dt' => 0),
    array('db' => 'waktu', 'dt' => 1),
    array('db' => 'keterangan', 'dt' => 2)
);

include "config.php";
global $sql_details;
require('ssp.php');

echo json_encode(
    SSP::simple($_GET, $sql_details, $table, $primaryKey, $columns)
);
