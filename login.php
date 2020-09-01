<?php
    include "config/config.php";
    include "config/controller.php";
    $header_title = 'Halaman Login';
    session_start();
    $lg = new Resto();
    if ($lg->sessionCheck() == "true") {
    if (@$_SESSION['level'] == "Admin") {
    header("location:pageAdmins.php");
    } else if (@$_SESSION['level'] == "Waiter") {
    header("location:pageWaiter.php");
    } else if (@$_SESSION['level'] == "Kasir") {
    header("location:pageKasir.php");
    } else if (@$_SESSION['level'] == "Owner") {
    header("location:pageOwner.php");
    } else if (@$_SESSION['level'] == "Koki") {
    header("location:pageKoki.php");
    }
    }
    if (isset($_POST['btnLogin'])) {
        $username = strtolower($_POST['username']); // mengambil value username dan memaksa menjadi huruf kecil
        $password = $_POST['password']; // mengambil value password
        // menggunakan function login yang ada di controller

        if ($_GET['page']=='crew') {
            // Jika Login Crew
            if ($response = $lg->login($username, $password)) {
                if ($response['response'] == "positive") {
                    $_SESSION['username'] = $_POST['username'];
                    $_SESSION['level']    = $response['level'];
                    $_SESSION['kd_user'] = $response['kd_user'];
                    if ($response['level'] == "Admin") {
                    $response = $lg->redirect("pageAdmin.php");
                    } else if ($response['level'] == "Waiter") {
                    $response = $lg->redirect("pageWaiter.php");
                    } else if ($response['level'] == "Kasir") {
                    $response = $lg->redirect("pageKasir.php");
                    } else if ($response['level'] == "Owner") {
                    $response = $lg->redirect("pageOwner.php");
                    } else if ($response['level'] == "Koki") {
                    $response = $lg->redirect("pageKoki.php");
                    }
                }
            }
        } else {
            // JIka login customer
            if ($response = $lg->loginCustomer($username, $password)) {
                if ($response['response'] == "positive") {
                    $_SESSION['nama_pelanggan'] = $response['nama_pelanggan'];
                    $_SESSION['kd_pelanggan'] = $response['kd_pelanggan'];
                    $red = "menu.php?cust=".$response['nama_pelanggan'];
                    $response = $lg->redirect($red);
                }
            }
        }
    }

    /*Login split*/
    if ($_GET['page']=='crew') {
        $title = 'Login Crew';
        $leftButton = 'fa-user';
        $urlLogin = BASE_URL.'login.php?page=customer';
        $signUpButton = 'd-none';
        $logo = '<i class="fas fa-users text-center fa-2x" style="font-size:70px"></i>';
        $logoU = '<img src="images/lekerbaper-logo-transparent.png" width="100" alt="LekerBaper">';
        $bg_url = 'data:image/gif;base64,R0lGODlhAQABAIAAAAUEBAAAACwAAAAAAQABAAACAkQBADs=';
    } else {
        $title = 'Hi, Customer';
        $leftButton = 'fa-users';
        $urlLogin = BASE_URL.'login.php?page=crew';
        $signUpButton = '';
        $logo = '<img src="images/lekerbaper-logo-transparent.png" width="100" alt="LekerBaper">';
    }
?>

<?php include "layouts/header.php";?>

        <style type="text/css">
            div.crewloginsticky {
              position: -webkit-sticky; /* Safari */
              position: sticky;
              top: 50%;
              left: 0;
              /*background-color: green;*/
              /*border: 2px solid #4CAF50;*/
            }
            .crewloginsticky>.bodys{
                border-top-right-radius: 10px;
                /*background: #63c76a;*/
                background: white;
                width: 50px;
                height: 50px;
                display: flex;
              justify-content: center;
              align-items: center;
            }
        </style>

        <div class="crewloginsticky">
            <div class="bodys">
                <a href="<?=$urlLogin?>">
                    <i class="fas <?=$leftButton?> text-center fa-2x"></i>
                </a>
            </div>
        </div>
        <div class="page-wrapper">
            <div class="container">
                <div class="text-center"><?=$logoU?></div>
                <div class="login-wrap">
                    <div class="login-content">
                        <div class="login-logo">
                            <a href="#">
                                <?=$logo?>
                            </a>
                        </div>
                        <div class="text-center"><h3><?=$title?></h3></div>
                        <div class="login-form">
                            <form action="" method="post">
                                <div class="form-group">
                                    <label>Username</label>
                                    <input required class="au-input au-input--full" type="text" name="username" placeholder="Username" value="<?= @$_POST['username'] ?>">
                                </div>
                                <div class="form-group">
                                    <label>Password</label>
                                    <input required class="au-input au-input--full" type="password" name="password" placeholder="Password" value="<?= @$_POST['password'] ?>">
                                </div>
                                <div class="login-checkbox d-none">
                                    <label>
                                        <input type="checkbox" name="remember">Remember Me
                                    </label>
                                    <label>
                                        <a href="#">Forgotten Password?</a>
                                    </label>
                                </div>
                                <br>
                                <button name="btnLogin" class="au-btn au-btn--block au-btn--green m-b-20" type="submit">sign in</button>
                                <a href="<?=BASE_URL.'register_customer.php'?>" class="btn btn-danger au-btn--block <?=$signUpButton?>">Sign Up</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php include "layouts/footer.php";?>

        