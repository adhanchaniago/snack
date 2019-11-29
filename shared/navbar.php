<nav class="site-navbar navbar navbar-default navbar-fixed-top" role="navigation">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle hamburger hamburger-close navbar-toggle-left hided" data-toggle="menubar">
            <span class="sr-only">Toggle navigation</span>
            <span class="hamburger-bar"></span>
        </button>
        <button type="button" class="navbar-toggle collapsed" data-target="#site-navbar-collapse" data-toggle="collapse">
            <i class="icon wb-more-horizontal" aria-hidden="true"></i>
        </button>
        <div class="navbar-brand navbar-brand-center site-gridmenu-toggle">
            <img class="navbar-brand-logo" src="admin/assets/images/identitas/<?php echo $w['identitas_favicon'] ?>" title="Remark">
            <span class="navbar-brand-text">
                <?php echo $w['identitas_website']?>
            </span>
        </div>
    </div>

    <div class="navbar-container container-fluid">
        <div class="collapse navbar-collapse navbar-collapse-toolbar" id="site-navbar-collapse">
            <ul class="nav navbar-toolbar navbar-right navbar-toolbar-right">
                <?php include "menu.php"; ?>
            </ul>
        </div>
    </div>
</nav>