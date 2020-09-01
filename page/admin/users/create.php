<?php
    // include "config/controller.php";
    $rg       = new Resto();
    $table    = "tb_user";
    $autokode = $rg->autokode($table, "kd_user", "US");
    $getLevel = $rg->select("tb_level");
    if (isset($_POST['btnRegister'])) {
        $kd_user   = $_POST['kd_user'];
        $nama_user = $_POST['nama_user'];
        $email     = $_POST['email'];
        $username  = $_POST['username'];
        $password  = $_POST['password'];
        $confirm   = $_POST['confirm'];
        $level     = $_POST['level'];
        $redirect  = "loginMulti.php";
        if ($nama_user == "" || $email == "" || $username == "" || $password == "" || $confirm == "" || $level == "") {
        $response = ['response' => 'negative', 'alert' => 'Lengkapi Field !!!'];
        } else {
        $response = $rg->register($kd_user, $nama_user, $email, $username, $password, $confirm, $level, $redirect);
        }
    }
?>

<section class="au-breadcrumb m-t-75">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="au-breadcrumb-content">
                        <div class="au-breadcrumb-left">
                            <ul class="list-unstyled list-inline au-breadcrumb__list">
                                <li class="list-inline-item active">
                                    <a href="?page">Home</a>
                                </li>
                                <li class="list-inline-item seprate">
                                    <span>/</span>
                                </li>
                                <li class="list-inline-item"><a href="?page=indexLevel">Buat Pengguna</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<div class="main-content" style="margin-top: -60px;">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header" >
                            <strong class="card-title mb-3">Buat Pengguna</strong>
                        </div>
                        <div class="card-body">
                            <form action="" method="post">
                                <div class="form-group">
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
                                <div class="form-group">
                                    <label for="level" class="control-label mb-1">Level</label>
                                    <select name="level" class="form-control mb-1">
                                        <option value="">Pilih Level</option>
                                        <?php foreach ($getLevel as $level) {?>
                                        <option value="<?=$level['name']?>"><?=$level['name']?></option>
                                        <?php }?>
                                    </select>
                                </div>
                                <br>
                                <button name="btnRegister" class="au-btn au-btn--block au-btn--green m-b-20" type="submit">register</button>
                            </form>
                        </div>
                    </div>
                    </div>
                </div>
                </div>
            </div>
  