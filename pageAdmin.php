<?php
    include "config/config.php";
    include "config/controller.php";
    include "controller/listing.php";
    $function = new Resto();
    session_start();
    $auth = $function->AuthUser($_SESSION['username']);
    $response = $function->sessionCheck();
    if ($response == "false") {
    header("Location:loginMulti.php");
    }
    if ($_SESSION['level'] != "Admin") {
    header("Location:loginMulti.php");
    }
    // if(isset($_GET['logout'])){
    //     $function->logoutCrew();
    // }
?>

<?php include 'layouts/crew-header.php' ?>
                
                
            
                <!-- <aside class="menu-sidebar2 js-right-sidebar d-block d-lg-none">
                    <div class="logo">
                        <a href="#">
                            <img src="images/icon/logo-white.png" alt="Cool Admin" />
                        </a>
                    </div>
                    <div class="menu-sidebar2__content js-scrollbar2">
                        <div class="account2">
                            <div class="image img-cir img-120">
                                <img src="images/avatar.png" alt="John Doe" />
                            </div>
                            <h4 class="name"><?=$auth['name']?></h4>
                        </div>
                        <nav class="navbar-sidebar2">
                            <ul class="list-unstyled navbar__list">
                                <li>
                                    <a href="?page">
                                    <i class="zmdi zmdi-view-dashboard zmdi-hc-lg"></i>Dashboard</a>
                                </li>
                                <li>
                                    <a href="?page=indexLevel">
                                    <i class="zmdi zmdi-account zmdi-hc-lg"></i>Level</a>
                                </li>
                                <li>
                                    <a href="?page=indexKategori">
                                    <i class="zmdi zmdi-widgets zmdi-hc-lg"></i>Kategori</a>
                                </li>
                                <li>
                                    <a href="?page=indexMenu">
                                    <i class="zmdi zmdi-local-dining zmdi-hc-lg"></i>Menu</a>
                                </li>
                                <li>
                                    <a href="?page=indexMeja">
                                    <i class="zmdi zmdi-chart zmdi-hc-lg"></i>Meja</a>
                                </li>
                                <li>
                                    <a href="?page=indexOrder">
                                    <i class="zmdi zmdi-shopping-cart zmdi-hc-lg"></i>Order</a>
                                </li>
                                <li>
                                    <a href="?page=indexTransaksi">
                                    <i class="zmdi zmdi-card zmdi-hc-lg"></i>Transaksi</a>
                                </li>
                                <li>
                                    <a href="?page=indexLaporan">
                                    <i class="zmdi zmdi-book zmdi-hc-lg"></i>Laporan</a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </aside> -->
                <?php
                @$page = $_GET['page'];
                switch ($page) {
                    case 'indexLevel':
                    include "page/admin/level/index.php";
                    break;
                    /*Pengguna*/
                    case 'indexPengguna':
                    include "page/admin/users/index.php";
                    break;
                    case 'createPengguna':
                    include "page/admin/users/create.php";
                    break;
                    case 'updatePengguna':
                    include "page/admin/users/update.php";
                    break;

                    case 'indexKategori':
                    include "page/admin/kategori/index.php";
                    break;
                    case 'createKategori':
                    include "page/admin/kategori/create.php";
                    break;
                    case 'editKategori':
                    include "page/admin/kategori/edit.php";
                    break;
                    case 'indexMenu':
                    include "page/admin/menu/index.php";
                    break;
                    case 'createMenu':
                    include "page/admin/menu/create.php";
                    break;
                    case 'editMenu':
                    include "page/admin/menu/edit.php";
                    break;
                    case 'indexMeja':
                    include "page/admin/meja/index.php";
                    break;
                    case 'indexLaporan':
                    include "page/kasir/laporan/laporan_transaksi.php";
                    break;
                    case 'order_periode':
                    include "page/admin/laporan/order_periode.php";
                    break;
                    case 'order_periode_print':
                    include "page/admin/laporan/order_periode_print.php";
                    break;
                    case 'indexTransaksi':
                    // include "page/admin/transaksi/index.php";
                    include "page/kasir/transaksi/transaksi.php";
                    break;
                    case 'struk_transaksi':
                    include "page/admin/transaksi/struk_transaksi.php";
                   default:
                    $page = "dashboard";
                    include "page/admin/dashboard/index.php";
                    break;
                }
                ?>
            </div>

<?php include 'layouts/crew-footer.php' ?>