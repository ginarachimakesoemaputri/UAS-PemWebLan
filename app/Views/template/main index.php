<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>Dashboard &mdash; Animalia</title>

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="<?php echo base_url(); ?>/public/assets/img/logo.png" />

    <!-- Icons. Uncomment required icon fonts -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>/public/assets/vendor/fonts/boxicons.css" />

    <!-- General CSS Files -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>/public/assets/modules/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>/public/assets/modules/fontawesome/css/all.min.css">

    <!-- CSS Libraries -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>/public/assets/modules/jqvmap/dist/jqvmap.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>/public/assets/modules/summernote/summernote-bs4.css">
    <link rel="stylesheet"
        href="<?php echo base_url(); ?>/public/assets/modules/owlcarousel2/dist/assets/owl.carousel.min.css">
    <link rel="stylesheet"
        href="<?php echo base_url(); ?>/public/assets/modules/owlcarousel2/dist/assets/owl.theme.default.min.css">

    <!-- Core CSS -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>/public/assets/vendor/css/core.css"
        class="template-customizer-core-css" />
    <link rel="stylesheet" href="<?php echo base_url(); ?>/public/assets/vendor/css/theme-default.css"
        class="template-customizer-theme-css" />
    <link rel="stylesheet" href="<?php echo base_url(); ?>/public/assets/css/demo.css" />

    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.css" />

    <script src="<?php echo base_url(); ?>/public/assets/vendor/libs/jquery/jquery.js"></script>

    <!-- Helpers -->
    <script src="<?php echo base_url(); ?>/public/assets/vendor/js/helpers.js"></script>
    <script src="<?php echo base_url(); ?>/public/assets/js/config.js"></script>

    <!-- Template CSS -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>/public/assets/css/style.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>/public/assets/css/components.css">
    <!-- Start GA -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-94034622-3"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag() { dataLayer.push(arguments); }
        gtag('js', new Date());

        gtag('config', 'UA-94034622-3');
    </script>
    <!-- /END GA -->
</head>

<body>
    <div id="app">
        <div class="main-wrapper main-wrapper-1">
            <div class="navbar-bg"></div>
            <nav class="navbar navbar-expand-lg main-navbar">
                <form class="form-inline mr-auto">
                    <ul class="navbar-nav mr-3">
                        <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i
                                    class="fas fa-bars"></i></a></li>
                    </ul>
                </form>
                <ul class="navbar-nav navbar-right">
                    <li class="dropdown"><a href="#" data-toggle="dropdown"
                            class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                            <img alt="image" src="<?php echo base_url(); ?>/public/assets/img/avatar/avatar-1.png"
                                class="rounded-circle mr-1">
                            <div class="d-sm-none d-lg-inline-block">Hi,
                                <?php echo $user ?>
                            </div>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <!-- <div class="dropdown-divider"></div> -->
                            <a href="<?php echo base_url("/public/home/logout"); ?>"
                                class="dropdown-item has-icon text-danger">
                                <i class="fas fa-sign-out-alt"></i> Logout
                            </a>
                        </div>
                    </li>
                </ul>
            </nav>
            <div class="main-sidebar sidebar-style-2">
                <aside id="sidebar-wrapper">
                    <div class="sidebar-brand">
                        <a href="<?php echo base_url(); ?>public/home">Animalia</a>
                    </div>
                    <div class="sidebar-brand sidebar-brand-sm">
                        <a href="<?php echo base_url(); ?>public/home">AM</a>
                    </div>
                    <ul class="sidebar-menu">
                        <li class="menu-header">Dashboard</li>
                        <li><a class="nav-link" href="<?php echo base_url(); ?>public/home"><i class="fas fa-coins"></i>
                                <span>Transaksi</span></a></li>

                        <li class=active><a class="nav-link" href="<?php echo base_url(); ?>public/home/barang"><i
                                    class="fas fa-warehouse"></i>
                                <span>Barang</span></a></li>

                        <!-- <li class="menu-header">Table</li>
                        <li class="dropdown">
                            <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i
                                    class="fas fa-columns"></i> <span>Layout</span></a>
                            <ul class="dropdown-menu">
                                <li><a class="nav-link" href="layout-default.html">Default Layout</a></li>
                                <li><a class="nav-link" href="layout-transparent.html">Transparent Sidebar</a></li>
                                <li><a class="nav-link" href="layout-top-navigation.html">Top Navigation</a></li>
                            </ul>
                        </li> -->
                </aside>
            </div>

            <!-- Main Content -->
            <div class="main-content">
                <?= $this->renderSection("contentBarang"); ?>
            </div>
            <footer class="main-footer">
                <div class="footer-left">
                    Copyright &copy; Animalia 2024
                </div>
                <div class="footer-right">

                </div>
            </footer>
        </div>
    </div>

    <!-- General JS Scripts -->
    <script src="<?php echo base_url(); ?>/public/assets/modules/popper.js"></script>
    <script src="<?php echo base_url(); ?>/public/assets/modules/tooltip.js"></script>
    <script src="<?php echo base_url(); ?>/public/assets/modules/bootstrap/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url(); ?>/public/assets/modules/nicescroll/jquery.nicescroll.min.js"></script>
    <script src="<?php echo base_url(); ?>/public/assets/modules/moment.min.js"></script>
    <script src="<?php echo base_url(); ?>/public/assets/js/stisla.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="<?php echo base_url(); ?>/public/assets/vendor/js/menu.js"></script>

    <script src="<?php echo base_url(); ?>/public/assets/js/main.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.js"></script>

    <!-- JS Libraies -->
    <script src="<?php echo base_url(); ?>/public/assets/modules/jquery.sparkline.min.js"></script>
    <script src="<?php echo base_url(); ?>/public/assets/modules/chart.min.js"></script>
    <script src="<?php echo base_url(); ?>/public/assets/modules/owlcarousel2/dist/owl.carousel.min.js"></script>
    <script src="<?php echo base_url(); ?>/public/assets/modules/summernote/summernote-bs4.js"></script>
    <script src="<?php echo base_url(); ?>/public/assets/modules/chocolat/dist/js/jquery.chocolat.min.js"></script>

    <!-- Template JS File -->
    <script src="<?php echo base_url(); ?>/public/assets/js/scripts.js"></script>
    <script src="<?php echo base_url(); ?>/public/assets/js/custom.js"></script>
</body>

</html>