<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>Login &mdash; Animalia PetShop</title>

    <!-- General CSS Files -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>/public/assets/modules/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>/public/assets/modules/fontawesome/css/all.min.css">

    <!-- CSS Libraries -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>/public/assets/modules/bootstrap-social/bootstrap-social.css">

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
        <section class="section">
            <div class="container mt-5">
                <div class="row">
                    <div
                        class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
                        <div class="login-brand">
                            <img src="<?php echo base_url(); ?>/public/assets/img/logo.png" alt="logo"
                                width="150" class="shadow-light rounded-circle">
                        </div>

                        <div class="card card-primary">
                            <div class="card-header">
                                <h4>Login</h4>
                            </div>

                            <?php if ($pesan != null) { ?>
                                <div class="alert alert-danger" role="alert">
                                    <?php echo $pesan; ?>
                                </div>
                            <?php } ?>

                            <div class="card-body">
                                <form id="formAuthentication" class="mb-3 needs-validation"
                                    action="<?php echo base_url(); ?>public/login/cek" method="POST" novalidate="">
                                    <div class="form-group">
                                        <label for="email" class="form-label">Email or Username</label>
                                        <input id="email" type="text" class="form-control" name="email" tabindex="1"
                                            placeholder="Enter your email or username" required autofocus>
                                        <div class="invalid-feedback">
                                            Please fill in your email
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="d-block">
                                            <label for="password" class="control-label">Password</label>
                                        </div>
                                        <input id="password" type="password" class="form-control" name="password"
                                            placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                            tabindex="2" required>
                                        <div class="invalid-feedback">
                                            Please fill in your password
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                                            Login
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="mt-5 text-muted text-center">
                            Don't have an account? <a href="<?php echo base_url("public/register"); ?>">Create One</a>
                        </div>
                        <div class="simple-footer">
                            Copyright &copy; Animalia 2024
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <!-- General JS Scripts -->
    <script src="<?php echo base_url(); ?>/public/assets/modules/jquery.min.js"></script>
    <script src="<?php echo base_url(); ?>/public/assets/modules/popper.js"></script>
    <script src="<?php echo base_url(); ?>/public/assets/modules/tooltip.js"></script>
    <script src="<?php echo base_url(); ?>/public/assets/modules/bootstrap/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url(); ?>/public/assets/modules/nicescroll/jquery.nicescroll.min.js"></script>
    <script src="<?php echo base_url(); ?>/public/assets/modules/moment.min.js"></script>
    <script src="<?php echo base_url(); ?>/public/assets/js/stisla.js"></script>

    <!-- JS Libraies -->

    <!-- Page Specific JS File -->

    <!-- Template JS File -->
    <script src="<?php echo base_url(); ?>/public/assets/js/scripts.js"></script>
    <script src="<?php echo base_url(); ?>/public/assets/js/custom.js"></script>
</body>

</html>