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
    if(isset($_GET['logout'])){
        $function->logout();
    }
?>

<?php include 'layouts/crew-header.php' ?>

                    <nav class="navbar-sidebar2">
                        <ul class="list-unstyled navbar__list">
                            <li>
                                <a href="?page">
                                <i class="zmdi zmdi-view-dashboard zmdi-hc-lg"></i>Dashboard</a>
                            </li>

                            <li class="has-sub">
                            <a class="js-arrow" href="#">
                                <i class="zmdi zmdi-account zmdi-hc-lg"></i>Pengguna
                                <!-- <i class="fas fa-caret-down"></i> -->
                            </a>
                                <ul class="list-unstyled navbar__sub-list js-sub-list">
                                    <li>
                                        <a href="?page=indexLevel">
                                        Level</a>
                                    </li>
                                    <li>
                                        <a href="?page=indexPengguna">
                                        <!-- <i class="zmdi zmdi-local-dining zmdi-hc-lg"></i> -->
                                        Pengguna</a>
                                    </li>
                                </ul>
                            </li>

                            <li class="has-sub">
                            <a class="js-arrow" href="#">
                                <i class="zmdi zmdi-local-dining zmdi-hc-lg"></i>Menu
                                <!-- <i class="fas fa-caret-down"></i> -->
                            </a>
                                <ul class="list-unstyled navbar__sub-list js-sub-list">
                                    <li>
                                        <a href="?page=indexKategori">
                                        <!-- <i class="zmdi zmdi-widgets zmdi-hc-lg"></i> -->
                                        Kategori Menu</a>
                                    </li>
                                    <li>
                                        <a href="?page=indexMenu">
                                        <!-- <i class="zmdi zmdi-local-dining zmdi-hc-lg"></i> -->
                                        Daftar Menu</a>
                                    </li>
                                </ul>
                            </li>
                        
                            <li>
                                <a href="?page=indexMeja">
                                <i class="zmdi zmdi-chart zmdi-hc-lg"></i>Meja</a>
                            </li>
                            <!-- <li>
                                <a href="index_admin.php" target="_blank">
                                <i class="zmdi zmdi-shopping-cart zmdi-hc-lg"></i>Order</a>
                            </li> -->
                            <li>
                                <a href="?page=indexTransaksi">
                                <i class="zmdi zmdi-card zmdi-hc-lg"></i>Transaksi</a>
                            </li>
                            <li class="has-sub">
                                <a class="js-arrow" href="#">
                                <i class="fas fa-archive"></i>Laporan<!-- <i class="fas fa-caret-down"></i> --></a>
                                <!-- <ul class="navbar-mobile-sub__list list-unstyled js-sub-list"> -->
                                <ul class="list-unstyled navbar__sub-list js-sub-list">
                                    <li>
                                        <a href="?page=indexLaporan">Kelola Transaksi</a>
                                    </li>
                                    <li>
                                        <a href="?page=order_periode">Orderan per Periode</a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </nav>
                </div>
            </aside>
            <div class="page-container2">
                <header class="header-desktop2">
                    <div class="section__content section__content--p30">
                        <div class="container-fluid">
                            <div class="header-wrap2">
                                <div class="logo d-block d-lg-none">
                                    <a href="#">
                                        <img src="images/icon/logo-white.png" alt="CoolAdmin" />
                                    </a>
                                </div>
                                <div class="header-button2">
                                    <!-- <div class="header-button-item js-item-menu">
                                        <i class="zmdi zmdi-search"></i>
                                        <div class="search-dropdown js-dropdown">
                                            <form action="">
                                                <input class="au-input au-input--full au-input--h65" type="text" placeholder="Search for datas &amp; reports..." />
                                                <span class="search-dropdown__icon">
                                                    <i class="zmdi zmdi-search"></i>
                                                </span>
                                            </form>
                                        </div>
                                    </div>
                                    <div class="header-button-item has-noti js-item-menu">
                                        <i class="zmdi zmdi-notifications"></i>
                                        <div class="notifi-dropdown js-dropdown">
                                            <div class="notifi__title">
                                                <p>You have 3 Notifications</p>
                                            </div>
                                            <div class="notifi__item">
                                                <div class="bg-c1 img-cir img-40">
                                                    <i class="zmdi zmdi-email-open"></i>
                                                </div>
                                                <div class="content">
                                                    <p>You got a email notification</p>
                                                    <span class="date">April 12, 2018 06:50</span>
                                                </div>
                                            </div>
                                            <div class="notifi__item">
                                                <div class="bg-c2 img-cir img-40">
                                                    <i class="zmdi zmdi-account-box"></i>
                                                </div>
                                                <div class="content">
                                                    <p>Your account has been blocked</p>
                                                    <span class="date">April 12, 2018 06:50</span>
                                                </div>
                                            </div>
                                            <div class="notifi__item">
                                                <div class="bg-c3 img-cir img-40">
                                                    <i class="zmdi zmdi-file-text"></i>
                                                </div>
                                                <div class="content">
                                                    <p>You got a new file</p>
                                                    <span class="date">April 12, 2018 06:50</span>
                                                </div>
                                            </div>
                                            <div class="notifi__footer">
                                                <a href="#">All notifications</a>
                                            </div>
                                        </div>
                                    </div> -->
                                    <div class="header-button-item mr-0 js-sidebar-btn">
                                        <i class="zmdi zmdi-menu"></i>
                                    </div>
                                    <div class="setting-menu js-right-sidebar d-none d-lg-block">
                                        <div class="account-dropdown__body">
                                            <!-- <div class="account-dropdown__item">
                                                <a href="?page=profile">
                                                <i class="zmdi zmdi-account"></i>Account</a>
                                            </div>
                                            <div class="account-dropdown__item">
                                                <a href="#">
                                                <i class="zmdi zmdi-settings"></i>Setting</a>
                                            </div> -->
                                            <div class="account-dropdown__item">
                                                <a href="homepage.php?logout" id="forLogout">
                                                <i class="zmdi zmdi-power"></i>Logout</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </header>
                <aside class="menu-sidebar2 js-right-sidebar d-block d-lg-none">
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
                </aside>
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
                    include "page/admin/laporan/laporan_transaksi.php";
                    break;
                    case 'order_periode':
                    include "page/admin/laporan/order_periode.php";
                    break;
                    case 'indexTransaksi':
                    include "page/admin/transaksi/index.php";
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