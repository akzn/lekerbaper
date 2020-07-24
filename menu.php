<?php
exit();
    include "config/controller.php";
    include "config/config.php";
    $id = new Resto();
    session_start();
    $auth     = $id->AuthUser($_SESSION['username']);
    $auth2    = $id->AuthPelanggan($_SESSION['username']);
    $response = $id->sessionCheck();

    # Nama pelanggan dan meja 
    $customer = 'Masih Kosong';
    if ($auth['name'] != '') {
        $customer = $auth['name'];
    }

    $meja = "Belum Dipilih";
    if ($auth2['no_meja'] != '') {
        $meja = $auth2['no_meja'];
    }
    

    // if ($response == "false") {
    // header("Location:index.php");
    // }
    $no_meja = $auth2['no_meja'];
    $sql2    = "SELECT kd_order FROM tb_order WHERE no_meja='$no_meja'";
    $exe2    = mysqli_query($con, $sql2);
    $num2    = mysqli_num_rows($exe2);
    $dta2    = mysqli_fetch_assoc($exe2);
    $data_kd = $dta2['kd_order'];
    $sql3     = "SELECT status_detail FROM tb_detail_order_temporary WHERE order_kd='$data_kd'";
    $exe3     = mysqli_query($con, $sql3);
    $num3     = mysqli_num_rows($exe3);
    $dta3     = mysqli_fetch_assoc($exe3);
    $data_kd2 = $dta3['status_detail'];
    $sql4     = "SELECT status_order FROM tb_order WHERE kd_order='$data_kd'";
    $exe4     = mysqli_query($con, $sql4);
    $num4     = mysqli_num_rows($exe4);
    $dta4     = mysqli_fetch_assoc($exe4);
    $data_kd3 = $dta4['status_order'];
    if (isset($_GET['delete'])) {
    if ($data_kd3 == "belum_beli") {
    ?>
        <script src="vendor/jquery-3.2.1.min.js"></script>
            <script>
            $(document).ready(function(){
            swal({
            title: "Tidak Order?",
            text: "Anda belum membeli apapun",
            type: "warning",
            showCancelButton: true,
            confirmButtonText: "Ya, Tidak Beli",
            cancelButtonText: "Beli",
            closeOnConfirm: false,
            closeOnCancel: true
            }, function(isConfirm) {
            if (isConfirm) {
            <?php
            $response = $id->delete("tb_order", "kd_order", $_GET['kd'], "?page=dashboard");
            $id->logout2();
            ?>
            }else if(!isConfirm){
            window.location.href="?";
            }
            });
            })
        </script>
    <?php
    } elseif ($data_kd2 == "pending" || $data_kd2 == "dimasak") {
    $response = ['response' => 'negative', 'alert' => 'Pesanan anda belum sampai'];
    } elseif ($data_kd2 == "siap" || $data_kd2 == "diambil") {
    $response = $id->delete("tb_detail_order_temporary", "order_kd", $_GET['kd'], "?page=dashboard");
    $id->logout2();
    }
    }


    //For view keranjang
    $dm                 = new Resto();
    $authPelanggan      = $dm->AuthPelanggan($_SESSION['username']);
    $authUser           = $dm->AuthUser($_SESSION['username']);
    $no_meja2           = $authPelanggan['no_meja'];

    $sql3     = "SELECT kd_order FROM tb_order WHERE no_meja='$no_meja2'";
    $exe3     = mysqli_query($con, $sql3);
    $num3     = mysqli_num_rows($exe3);
    $dta3     = mysqli_fetch_assoc($exe3);
    $data_kd2 = $dta3['kd_order'];
    $kduser = $authUser['kd_user'];
    // $data = $dm->editWhere("detail_order", 'order_kd', $data_kd2, 'user_kd', $kduser);

    $data_keranjang = $dm->getKeranjang("tb_detail_order_temporary", 'order_kd', $data_kd2, 'user_kd', $kduser);

    //Sum total
    // $sql   = "SELECT SUM(sub_total) as sub FROM tb_detail_order_temporary WHERE order_kd = '$data_kd2'";
    $sql   = "SELECT SUM(sub_total) as sub FROM tb_detail_order WHERE order_kd = '$data_kd2'";
    $exec  = mysqli_query($con, $sql);
    $assoc = mysqli_fetch_assoc($exec);
    $no_meja = $authPelanggan['no_meja'];
    $sql2    = "SELECT kd_order FROM tb_order WHERE no_meja='$no_meja'";
    $exe2    = mysqli_query($con, $sql2);
    $num2    = mysqli_num_rows($exe2);
    $dta2    = mysqli_fetch_assoc($exe2);
    $data_kd = $dta2['kd_order'];

?>
<!DOCTYPE html>
<html>
    <head>
        <!-- Required meta tags-->
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="au theme template">
        <meta name="author" content="Hau Nguyen">
        <meta name="keywords" content="au theme template">
        <!-- Title Page-->
        <title>Admin</title>
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
        <link href="vendor/vector-map/jqvmap.min.css" rel="stylesheet" media="all">
        <link rel="stylesheet" href="vendor/dropify/dist/css/dropify.css">
        <link rel="stylesheet" href="css/sweet-alert.css">
        <!-- Main CSS-->
        <link href="css/theme.css" rel="stylesheet" media="all">
        <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">
    </head>
    <body style="background-color: #F2F2F2;">
        <div class="page-wrapper">
            <header class="header-desktop4">
                <div class="container">
                    <div class="header4-wrap">
                        <div class="header__logo">
                            <a href="#">
                                <img src="images/logo1.jpg" alt="Leker Baper" width="80"/>
                            </a>
                        </div>
                        <div class="header__tool">
                            <div class="header-button-item js-item-menu" style="color:black; font-size: 20px">
                                <!-- <a style="color: white;" id="btdelete" class="btn btn-primary btn-md">Selesai Order <i class="fa fa-check"></i></a> -->
                                Customer : <?=$customer?> <br>
                                Meja : <?=$meja?>

                                <a style="color: white;" id="btdelete" class="btn btn-danger btn-md">Pilih Meja</a>
                            </div>
                            <div class="account-wrap">
                                <div class="account-item account-item--style2 clearfix js-item-menu">
                                    <br>
                                    <div class="content">
                                        <!-- <a class="js-acc-btn"><?=$auth['name']?> (<?=$auth2['no_meja']?>) -->
                                    </div>
                                        <div class="account-dropdown">
                                            <div class="info clearfix">
                                                <div class="image">
                                                    <a href="#">
                                                        <img src="images/icon/avatar-01.jpg" alt="John Doe" />
                                                    </a>
                                                </div>
                                                <div class="content">
                                                    <h5 class="name">
                                                    <a href="#">john doe</a>
                                                    </h5>
                                                    <span class="email">johndoe@example.com</span>
                                                </div>
                                            </div>
                                            <div class="account-dropdown__body">
                                                <div class="account-dropdown__item">
                                                    <a href="#">
                                                    <i class="zmdi zmdi-account"></i>Account</a>
                                                </div>
                                                <div class="account-dropdown__item">
                                                    <a href="#">
                                                    <i class="zmdi zmdi-settings"></i>Setting</a>
                                                </div>
                                                <div class="account-dropdown__item">
                                                    <a href="#">
                                                    <i class="zmdi zmdi-money-box"></i>Billing</a>
                                                </div>
                                            </div>
                                            <div class="account-dropdown__footer">
                                                <a href="#" id="forLogout">
                                                <i class="zmdi zmdi-power"></i>Logout</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- <div style="padding-left: 10px;"></div> -->
                                <div class="au-breadcrumb-right">
                                    <button data-toggle="modal" data-target="#keranjangModal" class="btn btn-lg btn-warning btn-fab">
                                        <i class="fa fa-shopping-basket">
                                        </i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </header>
                <?php
                @$page = $_GET['page'];
                switch ($page) {
                case "order_menu";
                include "page/waiter/order_menu.php";
                break;
                case "detail_menu":
                include "page/waiter/detail_menu.php";
                break;
                default:
                $page = "dashboard";
                include "page/waiter/dashboard_order.php";
                break;
                }
                ?>
                <section class="p-t-20">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="copyright">
                                    <!-- <p>Copyright © 2018 Colorlib. All rights reserved. Template by <a href="https://colorlib.com">Colorlib</a>.</p> -->
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <script src="vendor/jquery-3.2.1.min.js"></script>
                <script>
                $('#btdelete').click(function(e){
                e.preventDefault();
                swal({
                title: "Selesai",
                text: "Yakin Selesai Mengorder?",
                type: "warning",
                showCancelButton: true,
                confirmButtonText: "Yes",
                cancelButtonText: "Cancel",
                closeOnConfirm: false,
                closeOnCancel: true
                }, function(isConfirm) {
                if (isConfirm) {
                window.location.href="?page=dashboard&delete&kd=<?php echo $data_kd; ?>";
                }else if(!isConfirm){
                window.location.href="?";
                }
                });
                });
                </script>
            </div>
        </div>

        <div class="modal fade" id="keranjangModal" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form method="post">
                <div class="modal-header">
                    <h3 class="modal-title" id="mediumModalLabel">Pesanan Anda</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Menu</th>
                                        <th>Jumlah</th>
                                        <th>Sub total</th>
                                        <th>Status Orderan</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if (count($data_keranjang) > 0) {
                                    $no = 1;
                                    foreach ($data_keranjang as $datas) {
                                    ?>
                                    <tr>
                                        <td><?=$no;?></td>
                                        <td><?=$datas['name_menu']?></td>
                                        <td><?=$datas['total']?></td>
                                        <td>Rp. <?=$datas['sub_total']?></td>
                                        <td>
                                            <?php
                                            $status_d = $datas['status_detail'];
                                            if ($status_d == "pending") {
                                            ?>
                                            <span style="padding: 10px;" class="badge badge-pill badge-dark"><?=$status_d?></span>
                                            <?php
                                            } elseif ($status_d == "dimasak") {
                                            ?>
                                            <span style="padding: 10px;" class="badge badge-pill badge-info"><?=$status_d?></span>
                                            <?php
                                            } elseif ($status_d == "siap") {
                                            ?>
                                            <span style="padding: 10px;" class="badge badge-pill badge-success"><?=$status_d?></span>
                                            <?php
                                            } elseif ($status_d == "diambil") {
                                            ?>
                                            <span style="padding: 10px;" class="badge badge-pill badge-danger"><?=$status_d?></span>
                                            <?php
                                            }
                                            ?>
                                        </td>
                                        <td>
                                            <button id="bthapus2<?=$no;?>" class="btn btn-danger btn-sm">Batal Beli</button>
                                        </td>
                                    </tr>
                                    <script src="../../vendor/jquery-3.2.1.min.js"></script>
                                    <script>
                                    $("#bthapus2<?php echo $no; ?>").click(function(){
                                    swal({
                                    title: "Hapus",
                                    text: "Yakin Hapus?",
                                    type: "warning",
                                    showCancelButton: true,
                                    confirmButtonText: "Yes",
                                    cancelButtonText: "Cancel",
                                    closeOnConfirm: false,
                                    closeOnCancel: true
                                    },function(isConfirm){
                                    if (isConfirm) {
                                    window.location.href="?page=detail_menu&hapus2&kd=<?=$datas['kd_detail'];?>";
                                    }
                                    })
                                    })
                                    </script>
                                    <?php $no++;}?>
                                    <td colspan="3" class="text-right">Total Bayar</td>
                                    <td>Rp. <?=$assoc['sub'];?></td>
                                    <td></td>
                                    <td></td>
                                    <?php } else {?>
                                    <br>
                                    <td colspan="6" class="text-center"><h3>Anda belum pernah order</h3></td>
                                    <?php }?>
                                </tbody>
                            </table>
                        </div>
                        <br>
                        <div class="form-group" hidden>
                            <label for="">Tambahkan catatan untuk koki (bagian dapur) (Opsional)</label>
                            <h6 style="color: red;">Cat : Pastikan nama menu tercantum ketika ingin menambah catatan</h6>
                            <br>
                            <?php
                            @$dk = $dkt;
                            foreach ($data as $dk) {}
                            ?>
                            <textarea class="form-control" name="keterangan" rows="3" placeholder="Contoh : Untuk gado gado ga pake mentimun, ayam serundeng banyakin bumbunya"><?=$dk['keterangan']?></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <?php
                    $st = @$dk['status_keterangan'];
                    if ($st == "S") {
                    ?>
                    <span style="padding: 10px;" class="badge badge-pill badge-success"><i class="fa fa-check"></i> Catatan anda telah dikonfirmasi</span>
                    <?php
                    } elseif ($st == "T") {
                    ?>
                    <span style="padding: 10px;" class="badge badge-pill badge-danger">Catatan anda tidak dikonfirmasi dikarenakan <span>Bumbu telah habis</span></span>
                    <?php
                    }
                    ?>
                    <button name="kirimCatatan" class="btn btn-primary">Kirim catatan</button>
                </div>
            </form>
        </div>
    </div>
</div>

        <!-- Jquery JS-->
        <script src="vendor/jquery-3.2.1.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
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
        <script src="vendor/vector-map/jquery.vmap.js"></script>
        <script src="vendor/vector-map/jquery.vmap.min.js"></script>
        <script src="vendor/vector-map/jquery.vmap.sampledata.js"></script>
        <script src="vendor/vector-map/jquery.vmap.world.js"></script>
        <script src="vendor/dropify/dist/js/dropify.min.js"></script>
        <!-- Main JS-->
        <script src="js/jquery.input-counter.min.js"></script>
        <script src="js/main.js"></script>
        <script src="js/sweetalert.min.js"></script>
        <script src="js/bootstrap-datepicker.min.js"></script>
        <script>
        $(document).ready(function() {
        $('#example').DataTable();
        } );
        $('.dropify').dropify();
        var options = {
        selectors: {
        addButtonSelector: '.btn-add',
        subtractButtonSelector: '.btn-subtract',
        inputSelector: '.counter',
        },
        settings: {
        checkValue: true,
        isReadOnly: true,
        },
        };
        $(".input-counter").inputCounter(options);
        </script>
        <?php include "config/alert.php";?>
    </body>
</html>