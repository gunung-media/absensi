<?php

ob_start();
set_time_limit(0);
define('website', microtime());
error_reporting(0);

$dbhost = 'localhost';
$dbname = 'absensi_legacy';
$dbuser = 'root';
$dbpass = '1133';

$sql_details = array(
    'host' => 'localhost',
    'db'   => 'absensi_legacy',
    'user' => 'root',
    'pass' => '1133',
);

$con = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
$db = new mysqli($dbhost, $dbuser, $dbpass, $dbname);

//TOKEN
$token    = md5(md5("saepulanwar007itpgk"));
$BaseUrl  = 'http://127.0.0.1:8001';
