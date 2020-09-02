<head>
    
      <meta http-equiv="cache-control" content="no-cache, must-revalidate, post-check=0, pre-check=0" />
  <meta http-equiv="cache-control" content="max-age=0" />
  <meta http-equiv="expires" content="0" />
  <meta http-equiv="expires" content="Tue, 01 Jan 1980 1:00:00 GMT" />
  <meta http-equiv="pragma" content="no-cache" />
  
</head>

<?php

    include "config/config.php";
    include "config/controller.php";

    header("Location: ".BASE_URL."login.php?page=customer");
    exit;

    session_start();
    $lg            = new resto();
    $table         = "tb_user";
    $autokode      = $lg->autokode($table, "kd_user", "US");
    $autokode2     = $lg->autokode("tb_pelanggan", "kd_pelanggan", "PG");
    $autokodeOrder = $lg->autokode("tb_order", "kd_order", "TR");
    $date          = date("Y-m-d");
    if ($lg->sessionCheck() == "true") {
    // if (@$_SESSION['level'] == "Admin") {
    // header("location:pageAdmin.php");
    // }
    }
    if (isset($_POST['btnLogin'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $kd_pelanggan = $autokode2;
        $kd_user      = $autokode;
        $nama_user    = $username;
        $email        = "pelanggan@gmail.com";
        $username2    = strtolower($username);
        $level        = "Pelanggan";
        $status       = "belum_beli";
        $redirect     = "pageWaiterOrder.php";
        if ($username == "" || $password == "") {
        $response = ['response' => 'negative', 'alert' => 'Lengkapi Field !!!'];
        } else {
        $_SESSION['username'] = $_POST['username'];
        $select               = $lg->selectWhere2("tb_meja", "no_meja", $password, "status", "active");
        $select2              = $lg->selectWhere2("tb_meja", "no_meja", $password, "status", "non-active");
            if ($select == 1) {
                $response = ['response' => 'negative', 'alert' => 'No meja ini telah digunakan'];
            } elseif ($select2 == 1) {
                $response = $lg->register_pelanggan($kd_user, $nama_user, $email, $username2, $password, $level, $redirect);
                $value    = "'$kd_pelanggan', '$username', '$password'";
                $response = $lg->insert("tb_pelanggan", $value, $redirect);
                $valueOrder = "'$autokodeOrder', '$password', null, '$nama_user', '$kd_user', '', '$status', '$date'";
                $response   = $lg->insert("tb_order", $valueOrder, $redirect);
                $status_meja = "active";
                $valueMeja   = "user_kd='$kd_user', status='$status_meja'";
                $response    = $lg->update("tb_meja", $valueMeja, "no_meja", $password, $redirect);
            } elseif ($select == 0) {
                $response = ['response' => 'negative', 'alert' => 'No meja tidak terdaftar, silahkan cek no meja kembali'];
            }
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <!-- Required meta tags-->
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="au theme template">
        <meta name="author" content="Hau Nguyen">
        <meta name="keywords" content="au theme template">
        <!-- Title Page-->
        <title>Pesan Makanan</title>
        <!-- Fontfaces CSS-->
        <link href="css/font-face.css" rel="stylesheet" media="all">
        <link href="vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">
        <link href="vendor/font-awesome-5/css/fontawesome-all.min.css" rel="stylesheet" media="all">
        <link href="vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">
        <!-- Bootstrap CSS-->
        <link href="vendor/bootstrap-4.1/bootstrap.min.css" rel="stylesheet" media="all">
        <!-- Vendor CSS-->
        <link href="vendor/animsition/animsition.min.css" rel="stylesheet" media="all">
        <link href="vendor/bootstrap-progressbar/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet" media="all">
        <link href="vendor/wow/animate.css" rel="stylesheet" media="all">
        <link href="vendor/css-hamburgers/hamburgers.min.css" rel="stylesheet" media="all">
        <link href="vendor/slick/slick.css" rel="stylesheet" media="all">
        <link href="vendor/select2/select2.min.css" rel="stylesheet" media="all">
        <link href="vendor/perfect-scrollbar/perfect-scrollbar.css" rel="stylesheet" media="all">
        <!-- Main CSS-->
        <link href="css/theme.css" rel="stylesheet" media="all">
        <link rel="stylesheet" href="css/sweet-alert.css">
    </head>
    <body class="animsition" style="background: linear-gradient( rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5) ), url('images/bg4.jpg') no-repeat; background-size: cover;">
        <div class="page-wrapper">
            <div class="container">
                <br><br><br>
                <div class="login-wrap">
                    <div class="login-content">
                        <div class="login-logo">
                            <a href="#">
                                <!-- <img src="images/icon/logo.png" alt="CoolAdmin"> -->
                                <h2>Pesan Makanan</h2>
                            </a>
                        </div>
                        <div class="login-form">
                            <form action="" method="post">
                                <div class="form-group">
                                    <label>Nama Pelanggan</label>
                                    <input autocomplete="off" value="<?=@$_POST['username']?>" class="au-input au-input--full" type="text" name="username" placeholder="Input Nama Pelanggan">
                                </div>
                                <div class="form-group">
                                    <label>No Meja</label>
                                    <input class="au-input au-input--full" type="number" name="password" placeholder="Input Nomor Meja">
                                </div>
                                <div class="login-checkbox" hidden>
                                    <label>
                                        <input type="checkbox" name="remember">Remember Me
                                    </label>
                                    <label>
                                        <a href="#">Forgotten Password?</a>
                                    </label>
                                </div>
                                <br>
                                <button name="btnLogin" class="au-btn au-btn--block au-btn--green m-b-20" type="submit">Mulai Pesan</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Jquery JS-->
        <script src="vendor/jquery-3.2.1.min.js"></script>
        <!-- Bootstrap JS-->
        <script src="vendor/bootstrap-4.1/popper.min.js"></script>
        <script src="vendor/bootstrap-4.1/bootstrap.min.js"></script>
        <!-- Vendor JS       -->
        <script src="vendor/slick/slick.min.js">
        </script>
        <script src="vendor/wow/wow.min.js"></script>
        <script src="vendor/animsition/animsition.min.js"></script>
        <script src="vendor/bootstrap-progressbar/bootstrap-progressbar.min.js">
        </script>
        <script src="vendor/counter-up/jquery.waypoints.min.js"></script>
        <script src="vendor/counter-up/jquery.counterup.min.js">
        </script>
        <script src="vendor/circle-progress/circle-progress.min.js"></script>
        <script src="vendor/perfect-scrollbar/perfect-scrollbar.js"></script>
        <script src="vendor/chartjs/Chart.bundle.min.js"></script>
        <script src="vendor/select2/select2.min.js">
        </script>
        <script src="js/sweetalert.min.js"></script>
        <!-- Main JS-->
        <script src="js/main.js"></script>
        <?php include "config/alert.php";?>
    </body>
</html>
<!-- end document-->


<!-- Load font awesome icons -->
<link rel="stylesheet" href="css/font-awesome.css">

<!-- The social media icon bar -->
<div class="icon-bar">
    <a href="<?=BASE_URL?>login.php" class="facebook">
        <i class="fa fa-sign-in"></i>
    </a>
</div>

<style type="text/css">
    /* Fixed/sticky icon bar (vertically aligned 50% from the top of the screen) */
.icon-bar {
  position: fixed;
  top: 50%;
  -webkit-transform: translateY(-50%);
  -ms-transform: translateY(-50%);
  transform: translateY(-50%);
}
/* Style the icon bar links */
.icon-bar a {
  display: block;
  text-align: center;
  padding: 16px;
  transition: all 0.3s ease;
  color: white;
  font-size: 20px;
}

.icon-bar a:hover {
  background-color: #000;
}

.facebook {
  background: #3B5998;
  color: white;
}
</style>