<!DOCTYPE html>
<html class="no-js before-run" lang="en">
<?php
    session_start();
    if (!empty($_SESSION['username']) AND !empty($_SESSION['password'])){
    header("location: ../../admin/media.php?module=home");
    } else { 
        include "../../config/include.php";
        $website = mysqli_query($connect, "SELECT * FROM identitas WHERE identitas_id=1");
        while ($w = mysqli_fetch_array($website)) { ?>

        <head>
            <meta charset="utf-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">

            <title>LOGIN -
                <?php echo $w['identitas_website'] ?>
            </title>
            <meta name="description" content="<?php echo $w['identitas_deskripsi'] ?>" />
            <meta name="keywords" content="<?php echo $w['identitas_keyword'] ?>" />
            <meta name="author" content="<?php echo $w['identitas_author'] ?>" />

            <link rel="apple-touch-icon" href="../assets/images/identitas/<?php echo $w['identitas_favicon'] ?>">
            <link rel="shortcut icon" href="../assets/images/identitas/<?php echo $w['identitas_favicon'] ?>">

            <!-- Bootstrap CSS -->
            <link rel="stylesheet" href="../assets/css/bootstrap/bootstrap.min.css">
            <link rel="stylesheet" href="../assets/css/bootstrap/bootstrap-extend.min.css">
            <!-- Style CSS -->
            <link rel="stylesheet" href="../assets/css/style.css">
            <link rel="stylesheet" href="../assets/css/app.css">
            <!-- Libs CSS -->
            <link rel="stylesheet" href="../assets/libs/animsition/animsition.css">
            <link rel="stylesheet" href="../assets/libs/asscrollable/asScrollable.css">
            <link rel="stylesheet" href="../assets/libs/switchery/switchery.css">
            <link rel="stylesheet" href="../assets/libs/intro-js/introjs.css">
            <link rel="stylesheet" href="../assets/libs/slidepanel/slidePanel.css">
            <link rel="stylesheet" href="../assets/libs/flag-icon-css/flag-icon.css">
            <!-- Fonts -->
            <link rel="stylesheet" href="../assets/fonts/web-icons/web-icons.min.css">
            <link rel="stylesheet" href="../assets/fonts/brand-icons/brand-icons.min.css">
            <link rel="stylesheet" href="../assets/fonts/font-awesome/4.5.0/css/font-awesome.min.css">
            <!-- Page -->
            <link rel="stylesheet" href="../assets/css/login.css">

            <!--[if lt IE 9]>
        <script src="../assets/libs/html5shiv/html5shiv.min.js"></script>
        <![endif]-->

            <!--[if lt IE 10]>
        <script src="../assets/libs/media-match/media.match.min.js"></script>
        <script src="../assets/libs/respond/respond.min.js"></script>
        <![endif]-->

            <!-- Scripts -->
            <script src="../assets/libs/modernizr/modernizr.js"></script>
            <script src="../assets/libs/breakpoints/breakpoints.js"></script>
            <script>
                Breakpoints();
            </script>
        </head>

        <body class="page-login layout-full">
            <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->

            <!-- Page -->
            <div class="page animsition vertical-align text-center" data-animsition-in="fade-in" data-animsition-out="fade-out">>
                <div class="page-content vertical-align-middle">
                    <div class="brand">
                        <img class="brand-img" src="../assets/images/identitas/<?php echo $w['identitas_favicon'] ?>" alt="..." style="width: 100px">
                        <h2 class="brand-text">
                            <?php echo $w['identitas_website'] ?>
                        </h2>
                    </div>

                    <form method="post" action="check_login.php" name="formLogin" id="form" parsley-validate novalidate>
                        <div class="form-group">
                            <label class="sr-only" for="username">Name</label>
                            <input type="text" class="form-control" name="username" id="username" placeholder="Username">
                        </div>
                        <div class="form-group">
                            <label class="sr-only" for="password">Password</label>
                            <input type="password" class="form-control" name="password" id="password" placeholder="Password">
                        </div>
                        <input type="submit" class="btn btn-primary btn-block" name="masuk" value="Login">
                    </form>
                    <footer class="page-copyright">
                        <p>
                            Design and Development by
                            <?php echo $w['identitas_author']?>
                        </p>
                        <p>© 2018
                            <?php echo $w['identitas_website']?>
                        </p>
                    </footer>
                </div>
            </div>
            <!-- End Page -->

            <?php error_reporting(0); ?>
            <!-- Core  -->
            <script src="../assets/libs/jquery/jquery.js"></script>
            <script src="../assets/libs/bootstrap/bootstrap.js"></script>
            <script src="../assets/libs/animsition/jquery.animsition.js"></script>
            <script src="../assets/libs/asscroll/jquery-asScroll.js"></script>
            <script src="../assets/libs/mousewheel/jquery.mousewheel.js"></script>
            <script src="../assets/libs/asscrollable/jquery.asScrollable.all.js"></script>
            <script src="../assets/libs/ashoverscroll/jquery-asHoverScroll.js"></script>
            <!-- Plugins -->
            <script src="../assets/libs/switchery/switchery.min.js"></script>
            <script src="../assets/libs/intro-js/intro.js"></script>
            <script src="../assets/libs/screenfull/screenfull.js"></script>
            <script src="../assets/libs/slidepanel/jquery-slidePanel.js"></script>
            <script src="../assets/libs/jquery-placeholder/jquery.placeholder.js"></script>
            <!-- Scripts -->
            <script src="../assets/js/core/core.js"></script>
            <script src="../assets/js/site/site.js"></script>
            <script src="../assets/js/sections/menu.js"></script>
            <script src="../assets/js/sections/menubar.js"></script>
            <script src="../assets/js/sections/sidebar.js"></script>
            <script src="../assets/js/configs/config-colors.js"></script>
            <script src="../assets/js/configs/config-tour.js"></script>
            <script src="../assets/js/components/asscrollable.js"></script>
            <script src="../assets/js/components/animsition.js"></script>
            <script src="../assets/js/components/slidepanel.js"></script>
            <script src="../assets/js/components/switchery.js"></script>
            <script src="../assets/js/components/jquery-placeholder.js"></script>
            <script src="../assets/js/components/material.js"></script>
            <script>
                (function (document, window, $) {
                    'use strict';

                    var Site = window.Site;
                    $(document).ready(function () {
                        Site.run();
                    });
                })(document, window, jQuery);
            </script>
        </body>
        <?php } ?>
    <?php } ?>
</html>