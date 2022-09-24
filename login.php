<?php
    include "config/config.php";
    include "config/controller.php";
    $header_title = 'Halaman Login';
    session_start();

    /*captcha*/
    include_once './library/securimage/securimage.php';
    $securimage = new Securimage();

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
        /*captcha*/
        // var_dump($_POST);
        if ($securimage->check($_POST['captcha_code']) == true) {
          $captchaMsg = "The security code entered was incorrect.<br /><br />";
          // echo "Please go <a href='javascript:history.go(-1)'>back</a> and try again.";
        } else if ($_GET['page']=='crew') {
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
        $logo = '<i class="fas fa-users text-center fa-2x color-shade-black" style="font-size:70px;"></i>';
        $logoU = '<img src="images/lekerbaper-logo-transparent.png" width="100" alt="LekerBaper">';
        // $bg_url = 'data:image/gif;base64,R0lGODlhAQABAIAAAAUEBAAAACwAAAAAAQABAAACAkQBADs=';
    } else {
        $title = 'Hi, Customer';
        $leftButton = 'fa-users';
        $urlLogin = BASE_URL.'login.php?page=crew';
        $signUpButton = '';
        $logo = '<img src="images/lekerbaper-logo-transparent.png" width="100" alt="LekerBaper">';
    }

    /*deisable customer, login to crew*/
    if ($_GET['page']!='crew') {
        header('Location: '.BASE_URL.'login.php?page=crew');
    }
?>
<script type="text/javascript">
    function refreshCaptcha(){
    var img = document.images['captchaimg'];
    img.src = img.src.substring(0,img.src.lastIndexOf("?"))+"?rand="+Math.random()*1000;
}
</script>
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
            .color-shade-black{
                color:#3c3c3c;
            }
        </style>

        <div class="crewloginsticky d-none">
            <div class="bodys">
                <a href="<?=$urlLogin?>">
                    <i class="fas <?=$leftButton?> text-center fa-2x color-shade-black"></i>
                </a>
            </div>
        </div>
        <div class="page-wrapper pt-5">
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
                            <!-- warning -->
                            <?php if (isset($captchaMsg)): ?>
                                <div class="alert alert-danger mt-2">
                                  <strong>Error!</strong> <?=$captchaMsg?>
                                </div>
                            <?php endif ?>
                            <form action="" method="post">
                                <div class="form-group">
                                    <label>Username</label>
                                    <input required class="form-control val-alphanum" type="text" name="username" placeholder="Username" value="<?= @$_POST['username'] ?>">
                                </div>
                                <div class="form-group">
                                    <label>Password</label>
                                    <input required class="form-control" type="password" name="password" placeholder="Password" value="<?= @$_POST['password'] ?>">
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

                                <div class="form-group">
                                    <label>Captcha</label>
                                    <img id="captcha" src="./library/securimage/securimage_show.php" alt="CAPTCHA Image" />
                                    <a href="#" onclick="document.getElementById('captcha').src = './library/securimage/securimage_show.php?' + Math.random(); return false">[ Refresh ]</a>
                                    <br>
                                    <input required class="form-control" type="text" name="captcha_code" size="10" maxlength="6" autocomplete="off">
                                </div>

                                <button name="btnLogin" class="au-btn au-btn--block au-btn--green m-b-20" type="submit">sign in</button>
                                <a href="<?=BASE_URL.'register_customer.php'?>" class="btn btn-danger au-btn--block <?=$signUpButton?>">Sign Up</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php include "layouts/footer.php";?>

        