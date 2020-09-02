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