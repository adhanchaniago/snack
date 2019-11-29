<?php date_default_timezone_set('Asia/Jakarta'); ?>

<!DOCTYPE html>
<html class="no-js before-run" lang="en">
<?php
        include "config/includeSession.php";
        $website = mysqli_query($connect, "SELECT * FROM identitas WHERE identitas_id=1");
        while ($w = mysqli_fetch_array($website)) { ?>

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
        <title>ADMINISTRATOR -
            <?php echo $w['identitas_website']?>
        </title>
        <meta name="description" content="<?php echo $w['identitas_deskripsi']?>" />
        <meta name="keywords" content="<?php echo $w['identitas_keyword']?>" />
        <meta name="author" content="<?php echo $w['identitas_author']?>" />

        <link rel="apple-touch-icon" href="admin/assets/images/identitas/<?php echo $w['identitas_favicon'] ?>">
        <link rel="shortcut icon" href="admin/assets/images/identitas/<?php echo $w['identitas_favicon'] ?>">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="assets/css/bootstrap/bootstrap.min.css">
        <link rel="stylesheet" href="assets/css/bootstrap/bootstrap-extend.min.css">

        <!-- Style CSS -->
        <link rel="stylesheet" href="assets/css/style.css">
        <link rel="stylesheet" href="assets/css/app.css">

        <!-- Libs CSS -->
        <link rel="stylesheet" href="assets/libs/animsition/animsition.css">
        <link rel="stylesheet" href="assets/libs/asscrollable/asScrollable.css">
        <link rel="stylesheet" href="assets/libs/switchery/switchery.css">
        <link rel="stylesheet" href="assets/libs/intro-js/introjs.css">
        <link rel="stylesheet" href="assets/libs/slidepanel/slidePanel.css">
        <link rel="stylesheet" href="assets/libs/flag-icon-css/flag-icon.css">

        <link rel="stylesheet" href="assets/libs/formvalidation/formValidation.css">

        <!-- Fonts -->
        <link rel="stylesheet" href="assets/fonts/web-icons/web-icons.min.css">
        <link rel="stylesheet" href="assets/fonts/brand-icons/brand-icons.min.css">
        <link rel="stylesheet" href="assets/fonts/font-awesome/4.5.0/css/font-awesome.min.css">

        <script src="assets/libs/jquery/jquery.js"></script>
        <!--[if lt IE 9]>
            <script src="../../assets/libs/html5shiv/html5shiv.min.js"></script>
            <![endif]-->

        <!--[if lt IE 10]>
            <script src="../../assets/libs/media-match/media.match.min.js"></script>
            <script src="../../assets/libs/respond/respond.min.js"></script>
            <![endif]-->

        <!-- Scripts -->
        <script src="assets/libs/modernizr/modernizr.js"></script>
        <script src="assets/libs/breakpoints/breakpoints.js"></script>
        <script>
            Breakpoints();
        </script>
    </head>

	<body>
        <!-- Navbar -->
        <?php include "shared/navbar.php"; ?>
        <!-- End Navbar -->

        <!-- Content -->
            <?php include "shared/breadcrumb.php"; ?>
            <div style="min-height: 428px;">
                <?php include "shared/content.php"; ?>
            </div>
        <!-- End Content -->

        <!-- Footer -->
        <?php include "shared/footer.php"; ?>
        <!-- End Footer -->

        <!-- Core  -->
        
        <script>
            $('#modal-konfirmasi').on('show.bs.modal', function (event) {
                var div = $(event.relatedTarget);
                var id = div.data('id');
                var modal = $(this);
                modal.find('#delete-pelanggan').attr("href",
                    "modul/pelanggan/action.php?module=pelanggan&act=delete&id=" + id);
                modal.find('#delete-ongkoskirim').attr("href",
                    "modul/ongkoskirim/action.php?module=ongkoskirim&act=delete&id=" + id);
                modal.find('#delete-menu').attr("href", "modul/menu/action.php?module=menu&act=delete&id=" + id);
                modal.find('#accept-invoice').attr("href",
                    "modul/invoiceprocess/action.php?module=invoiceprocess&act=accept&id=" + id);
                        modal.find('#cod-invoice').attr("href", "modul/invoicecod/action.php?module=invoicecod&act=accept&id=" + id);
            });
        </script>
        
        <script>
                    $('#modal-konfirmasi2').on('show.bs.modal', function (event) {
                        var div = $(event.relatedTarget);
                        var id = div.data('id');
                        var modal = $(this);
                        modal.find('#cod2-invoice').attr("href", "modul/invoicecod/action.php?module=invoicecod&act=accept2&id=" + id);
                    });
                </script>
                

        <script src="assets/libs/bootstrap/bootstrap.js"></script>
        <script src="assets/libs/animsition/jquery.animsition.js"></script>
        <script src="assets/libs/asscroll/jquery-asScroll.js"></script>
        <script src="assets/libs/mousewheel/jquery.mousewheel.js"></script>
        <script src="assets/libs/asscrollable/jquery.asScrollable.all.js"></script>
        <script src="assets/libs/ashoverscroll/jquery-asHoverScroll.js"></script>
        <!-- Plugins -->
        <script src="assets/libs/switchery/switchery.min.js"></script>
        <script src="assets/libs/intro-js/intro.js"></script>
        <script src="assets/libs/screenfull/screenfull.js"></script>
        <script src="assets/libs/slidepanel/jquery-slidePanel.js"></script>
        <script src="assets/libs/jquery-placeholder/jquery.placeholder.js"></script>
        <script src="assets/libs/formvalidation/formValidation.min.js"></script>
        <script src="assets/libs/formvalidation/framework/bootstrap.min.js"></script>
        <!-- Scripts -->
        <script src="assets/js/core/core.js"></script>
        <script src="assets/js/site/site.js"></script>
        <script src="assets/js/sections/menu.js"></script>
        <script src="assets/js/sections/menubar.js"></script>
        <script src="assets/js/sections/sidebar.js"></script>
        <script src="assets/js/configs/config-colors.js"></script>
        <script src="assets/js/configs/config-tour.js"></script>
        <script src="assets/js/components/asscrollable.js"></script>
        <script src="assets/js/components/animsition.js"></script>
        <script src="assets/js/components/slidepanel.js"></script>
        <script src="assets/js/components/switchery.js"></script>
        <script src="assets/js/components/jquery-placeholder.js"></script>
        <script src="assets/js/components/material.js"></script>

        
    <?php } ?>

        <script>
            (function (document, window, $) {
                'use strict';
                var Site = window.Site;
                $(document).ready(function ($) {
                    Site.run();
                });

                (function () {
                    $('#exampleStandardForm').formValidation({
                        framework: "bootstrap",
                        button: {
                            selector: '#validateButton2',
                            disabled: 'disabled'
                        },
                        icon: null,
                    });
                })();

                (function () {
                    $('.summary-errors').hide()
                })();
            })(document, window, jQuery);
        </script>
    </body>

</html>