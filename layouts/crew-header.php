
<?php
    if(isset($_GET['logout'])){
        $function->logoutCrew();
    }
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
        <link rel="stylesheet" href="css/main.css">
        <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">
        <style type="text/css">
            .navbar-sidebar2 .navbar__sub-list li {
                    background: #e8e8e8;
                }
            .navbar-sidebar2 > ul > li.has-sub > a::after{
                content:"\25C0";
                float:right;
            }

            .navbar-sidebar2 > ul > li.has-sub > a.open::after{
                content:"\25BC";
                float:right;
            }

        </style>
        <script src="vendor/jquery-3.2.1.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
        
    </head>
    <body>
        <div class="page-wrapper">
            <aside class="menu-sidebar2">
                <div class="logo">
                    <a href="#">
                        <!-- <img src="images/icon/logo-white.png" alt="Cool Admin" /> -->
                        <p style="color:white">Leker Baper</p>
                    </a>
                </div>
                <div class="menu-sidebar2__content js-scrollbar1">
                    <div class="account2">
                        <div class="image img-cir img-120">
                            <img src="images/avatar.png" />
                        </div>
                        <h4 class="name"><?=$auth['name'];?></h4>
                        <span><?= $auth['level'] ?></span>
                    </div>


                    <!-- NAV -->
                    <nav class="navbar-sidebar2">
                        <ul class="list-unstyled navbar__list">
                            <?php if (($auth['level'] == "Admin") || $auth['level'] == "Waiter" || $auth['level'] == "Owner" ): ?>
                            <li>
                                <a href="?page">
                                <i class="zmdi zmdi-view-dashboard zmdi-hc-lg"></i>Dashboard</a>
                            </li>
                             <?php endif ?>

                            <?php if ($auth['level'] == "Admin"): ?>
                                <li class="has-sub">
                                    <a class="js-arrow" href="#">
                                        <i class="zmdi zmdi-account zmdi-hc-lg"></i>Pengguna
                                        <!-- <i class="fas fa-caret-down"></i> -->
                                    </a>
                                    <ul class="list-unstyled navbar__sub-list js-sub-list">
                                        <li>
                                            <a href="?page=createPengguna">
                                            Tambah Pengguna</a>
                                        </li>
                                        <li>
                                            <a href="?page=indexPengguna">
                                            <!-- <i class="zmdi zmdi-local-dining zmdi-hc-lg"></i> -->
                                            Pengguna</a>
                                        </li>
                                    </ul>
                                </li>
                            <?php endif ?>
                            
                            <?php if ($auth['level'] == "Admin"): ?>
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
                            <?php endif ?>

                            <?php if ($auth['level'] == "Admin"): ?>
                            <li>
                                <a href="?page=indexMeja">
                                <i class="zmdi zmdi-chart zmdi-hc-lg"></i>Meja</a>
                            </li>
                            <?php endif ?>
                            <!-- <li>
                                <a href="index_admin.php" target="_blank">
                                <i class="zmdi zmdi-shopping-cart zmdi-hc-lg"></i>Order</a>
                            </li> -->


                            <?php if ($auth['level'] == "Admin" || $auth['level'] == "Kasir"): ?>
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
                            <?php endif ?>

                            <?php if ($auth['level'] == "Waiter"): ?>
                            <li>
                                <a href="pageWaiterOrder.php" target="_blank">
                                <i class="zmdi zmdi-shopping-cart zmdi-hc-lg"></i>Order</a>
                            </li>
                            <?php endif ?>
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
                                    
                                    <div class="header-button-item mr-0 js-sidebar-btn">
                                        <i class="zmdi zmdi-menu"></i>
                                    </div>
                                    <div class="setting-menu js-right-sidebar d-none d-lg-block">
                                        <div class="account-dropdown__body">
                                            
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