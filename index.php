<?php

//KONEKSI KE mysqli
include "config.php";

include "fungsi.php";

//LOAD MODELS
include("models/main.php");

//LOAD CONTROLLERS
include("controllers/main.php");

//HALAMAN ERROR
if (!empty($error)) include("views/error.php");

ob_end_flush();
mysqli_close($con);

