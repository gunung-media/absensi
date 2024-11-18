<!DOCTYPE html>
<html>
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>e-Absensi Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="main.css">
    <link rel="stylesheet" type="text/css" href="login/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="login/css/themify-icons.css">
    <link rel="stylesheet" type="text/css" href="login/css/style.css">

    <!-- SWEET ALERT -->
    <link rel="stylesheet" type="text/css" href="sweetalert/src/sweetalert.css">
    <script type="text/javascript" src="sweetalert/src/sweetalert.min.js"></script>

</head>
<body>
    <?php
        if(!empty($login))
        {
            if($login=="true")
            {
                session_start();
                $_SESSION['adminwebsite123'] = htmlspecialchars($username); // htmlspecialchars() sanitises XSS
                header("location: home.php");
            }

            if($login=="false")
            {
                ?>
                <script>
                    swal({
                        text: "Username dan password tidak cocok",
                        icon: "error",
                        type: 'error'
                    });
                </script>
            <?php
            }
        }
    ?>
    <div class="container">
        <div class="row justify-content-md-center mt-12">
            <div class="col-sm-8">
                <div class="row border-box">
                    <div class="col-sm-6 p-0">
                        <img src="login/img/login.jpg" class="d-block w-100" alt="Plant I">
                    </div>
                    <div class="col-sm-6 p-0">
                        <div class="card">
                            <div class="card-header">
                                <div class="sub-title">
                                    Masuk e-Absensi
                                </div>
                            </div>
                            <div class="card-body">
                                <form action="" method="post">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="ti-user"></i></span>
                                        </div>
                                        <input type="text" name="username" class="form-control input-login" placeholder="Username">
                                    </div>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="ti-lock"></i></span>
                                        </div>
                                        <input type="password" name="password" class="form-control input-login" placeholder="Password">
                                    </div>
                                  <button type="submit" name="login" class="btn btn-danger float-right">Masuk <i class="ti-angle-double-right" style="font-size: 12px"></i></button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mt-4 text-center">
                    <small>2019 &copy; Sistem Absensi</small>
                </div>
            </div>
        </div>
    </div>
    <script src="login/js/jquery-3.4.1.min.js"></script>
    <script src="login/js/bootstrap.min.js"></script>
</body>
</html>