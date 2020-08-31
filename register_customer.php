<?php
    include 'config/config.php';
    include "config/controller.php";
    $rg       = new Resto();
    $table    = "tb_pelanggan";
    $autokode = $rg->autokode($table, "kd_pelanggan", "CU");
    $getLevel = $rg->select("tb_level");
    if (isset($_POST['btnRegister'])) {
        $kd_user   = $_POST['kd_user'];
        $nama_user = $_POST['nama_user'];
        $email     = $_POST['email'];
        $username  = $_POST['username'];
        $password  = $_POST['password'];
        $confirm   = $_POST['confirm'];
        // $level     = $_POST['level'];
        $redirect  = BASE_URL."login.php";
        if ($nama_user == "" || $email == "" || $username == "" || $password == "" || $confirm == "") {
        $response = ['response' => 'negative', 'alert' => 'Lengkapi Field !!!'];
        } else {
        $response = $rg->registerCustomer($kd_user, $nama_user, $email, $username, $password, $confirm, $redirect);
        }
    }
    $header_title = 'register customer';
?>

<?php include "layouts/header.php";?>

        <div class="page-wrapper">
            <div class="container">
                <div class="login-wrap">
                    <div class="login-content">
                        <div class="login-logo">
                            <!-- <a href="#">
                                <img src="images/icon/logo.png" alt="CoolAdmin">
                            </a> -->
                            <h2>Daftar Sekarang</h2>
                        </div>
                        <div class="login-form">
                            <form action="" method="post">
                                <div class="form-group d-none">
                                    <label>Kode User</label>
                                    <input style="color: red; font-weight: bold;" class="au-input au-input--full" type="text" name="kd_user" readonly value="<?=$autokode;?>">
                                </div>
                                <div class="form-group">
                                    <label>Nama</label>
                                    <input class="au-input au-input--full" type="text" name="nama_user" value="<?php echo @$_POST['nama_user'] ?>" placeholder="Nama">
                                </div>
                                <div class="form-group">
                                    <label>Email</label>
                                    <input class="au-input au-input--full" type="email" name="email" placeholder="Email" value="<?php echo @$_POST['email'] ?>">
                                </div>
                                <div class="form-group">
                                    <label>Username</label>
                                    <input class="au-input au-input--full" type="text" name="username" placeholder="Username" value="<?php echo @$_POST['username'] ?>">
                                </div>
                                <div class="form-group">
                                    <label>Password</label>
                                    <input class="au-input au-input--full" type="password" name="password" placeholder="Password" value="<?php echo @$_POST['password'] ?>">
                                </div>
                                <div class="form-group">
                                    <label>Confirm Password</label>
                                    <input class="au-input au-input--full" type="password" name="confirm" placeholder="Confirm Password" value="<?php echo @$_POST['confirm'] ?>">
                                </div>
                                <br>
                                <button name="btnRegister" class="au-btn au-btn--block au-btn--green m-b-20" type="submit">register</button>
                            </form>
                            <div class="register-link">
                                <p>
                                    Already have account?
                                    <a href="<?=BASE_URL?>login.php">Sign In</a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <br>
        <br>
        <br>


<?php include "layouts/footer.php";?>