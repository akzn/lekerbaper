<?php
    include "config/controller.php";
    $function = new resto();
    session_start();
    $auth = $function->AuthUser($_SESSION['username']);
    $response = $function->sessionCheck();
    if ($response == "false") {
    header("Location:index.php");
    }
    if (isset($_GET['logout'])) {
    $function->logout();
    }
?>
<?php include 'layouts/crew-header.php' ?>

                    <!-- <nav class="navbar-sidebar2">
                        <ul class="list-unstyled navbar__list">
                            <li>
                                <a href="?page">
                                <i class="zmdi zmdi-view-dashboard zmdi-hc-lg"></i>Dashboard</a>
                            </li>
                            <li>
                                <a href="pageWaiterOrder.php" target="_blank">
                                <i class="zmdi zmdi-shopping-cart zmdi-hc-lg"></i>Order</a>
                            </li>
                            <li>
                                <a href="?page=order_laporan">
                                <i class="zmdi zmdi-book zmdi-hc-lg"></i>Laporan</a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </aside> -->
           <!--  <div class="page-container2">
                <header class="header-desktop2">
                    <div class="section__content section__content--p30">
                        <div class="container-fluid">
                            <div class="header-wrap2">
                                <div class="logo d-block d-lg-none">
                                    <a href="#">
                                        <img src="images/icon/logo-white.png" alt="CoolAdmin" />
                                    </a>
                                </div>
                                <div class="header-button2"> -->
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
                                    <!-- <div class="header-button-item mr-0 js-sidebar-btn">
                                        <i class="zmdi zmdi-menu"></i>
                                    </div>
                                    <div class="setting-menu js-right-sidebar d-none d-lg-block">
                                        <div class="account-dropdown__body"> -->
                                            <!-- <div class="account-dropdown__item">
                                                <a href="?page=profile">
                                                <i class="zmdi zmdi-account"></i>Account</a>
                                            </div>
                                            <div class="account-dropdown__item">
                                                <a href="#">
                                                <i class="zmdi zmdi-settings"></i>Setting</a>
                                            </div> -->
                                           <!--  <div class="account-dropdown__item">
                                                <a href="homepage.php?logout" id="forLogout">
                                                <i class="zmdi zmdi-power"></i>Logout</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </header> -->
                <aside class="menu-sidebar2 js-right-sidebar d-block d-lg-none">
                    <div class="logo">
                        <a href="#">
                            <img src="images/icon/logo-white.png" alt="Cool Admin" />
                        </a>
                    </div>
                    <div class="menu-sidebar2__content js-scrollbar2">
                        <div class="account2">
                            <div class="image img-cir img-120">
                                <img src="img/<?=$auth['foto_user']?>" alt="John Doe" />
                            </div>
                            <h4 class="name"><?=$auth['nama_user']?></h4>
                            <a href="#">Sign out</a>
                        </div>
                        <nav class="navbar-sidebar2">
                            <ul class="list-unstyled navbar__list">
                                <li>
                                    <a href="?page">
                                    <i class="zmdi zmdi-view-dashboard zmdi-hc-lg"></i>Dashboard</a>
                                </li>
                                <li>
                                    <a href="index_waiter.php" target="_blank">
                                    <i class="zmdi zmdi-shopping-cart zmdi-hc-lg"></i>Order</a>
                                </li>
                                <li>
                                    <a href="?page=order_laporan">
                                    <i class="zmdi zmdi-book zmdi-hc-lg"></i>Laporan</a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </aside>
                <?php
                @$page = $_GET['page'];
                switch ($page) {
                    case "laporan_waiter":
                    include "page/waiter/laporan_waiter.php";
                    break;
                    case "order_laporan":
                    include "page/waiter/laporan_waiter.php";
                    break;
                    default:
                    $page = "dashboard";
                    include "page/waiter/dashboard.php";
                    break;
                }
                ?>
            </div>
<?php include 'layouts/crew-footer.php' ?>

<script>
        $(document).ready(function(){

        function preview(input){
        if(input.files && input.files[0]){
        var reader = new FileReader();
        reader.onload = function (e){
        $('#pict').attr('src', e.target.result);
        }
        reader.readAsDataURL(input.files[0]);
        }
        }
        $('#gambar').change(function(){
        preview(this);
        })
        });
        
        </script>
        <script>
        $(document).ready(function(){
        function preview(input){
        if(input.files && input.files[0]){
        var reader = new FileReader();
        reader.onload = function (e){
        $('#pict2').attr('src', e.target.result);
        }
        reader.readAsDataURL(input.files[0]);
        }
        }
        $('#gambar2').change(function(){
        preview(this);
        })
        });
        </script>