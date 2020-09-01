<?php
    

    $db   = new Resto();
    $auth = $id->AuthPelanggan($_SESSION['username']);
    $auth2  = $id->AuthUser($_SESSION['username']);
    $table = "tb_kategori";
    $data  = $db->select($table);


    /*if ($_SESSION['username']=='') {
        ?><script><?php echo("location.href = '".BASE_URL."index_waiter.php';");?></script><?php
    }*/
?>
<section class="p-b-55">
    <div hidden class="row align-items-center" style="height: 600px; background: linear-gradient( rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5) ), url('images/bg3.jpg') no-repeat; background-size: cover;">
        <div class="col text-center">
            <h1 class="text-white" style="font-size: 60px;">Leker Baper</h1>
            <!-- <p class="text-white" style="font-size: 25px;">Lorem ipsum dolor sit amet, consectetur adipiscing elit</ -->
            </div>
        </div>
    </section>
    <!-- END WELCOME-->
    <!-- PAGE CONTENT-->
    <div class="container">
        <section>
            <div class="row">
                <div class="col-md-4">
                    <h1 class="h1-white">Kategori</h1>
                </div>
            </div>
            <!-- <br>
            <h3 class="float-right"><i>Tamu : <?=$auth2['name']?> <br> No Meja : <?=$auth['no_meja']?></i></h3>
            <br>
            <br> -->
        </section>
    </div>
    <div class="container m-t-20">
        <div class="row">
            <div class="col-md-12">
                <ul class="list-group">
            <?php
            foreach ($data as $data2) {
            ?>

                <li class="list-group-item">
                    <div class="row">
                        <div class="col-md-2">
                            <img class="card-img-top" style="width: 80px;height: 80px" src="img/<?=$data2['photo']?>" alt="Card image cap">
                        </div>
                        <div class="col-md-6">
                           <?=$data2['name_kategori']?> 
                            <!-- <p class="card-text" style=""><?=$data2['description']?></p> -->
                        </div>
                        <div class="col-md-4">
                            <a href="?page=order_menu&kategori&menu&kd=<?=$data2['kd_kategori']?>&meja=<?=$_GET['meja']?>&cust=<?=$_GET['cust']?>" class="btn btn-primary float-right">Lihat Menu</a>
                        </div>
                    </div>
                </li>

            <!-- <ul class="list-group">
                <li class="list-group-item active"><?=$data2['name_kategori']?> 
                    <a href="?page=order_menu&kategori&menu&kd=<?=$data2['kd_kategori']?>" class="btn btn-primary float-right">Lihat Menu</a>
                </li>

                <?php
                    $table_menu  = "tb_menu";
                    $data_menu    = $db->edit($table_menu, "kategori_id", $data2['kd_kategori']);
                    // var_dump($data_menu);
                ?>

                <?php foreach ($data_menu as $key): ?>
                    <li class="list-group-item"><?=$key['kd_menu']?></li>
                <?php endforeach ?>
            </ul> -->

            <!-- <div class="col-md-4 mb-3">
                <div class="card">
                    <img class="card-img-top" style="height: 220px;" src="img/<?=$data2['photo']?>" alt="Card image cap">
                    <div class="card-body">
                        <h5 class="card-title"><?=$data2['name_kategori']?></h5>
                        <p class="card-text"><?=$data2['description']?></p>
                    </div>
                    <div class="card-footer">
                        <a href="?page=order_menu&kategori&menu&kd=<?=$data2['kd_kategori']?>" class="btn btn-primary">Lihat Menu</a>
                    </div>
                </div>
            </div> -->
            <?php }?>
            </ul>
            </div>
        </div>
    </div>