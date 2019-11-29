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
            <img class="navbar-brand-logo" src="../admin/assets/images/identitas/<?php echo $w['identitas_favicon'] ?>" title="Remark">
            <span class="navbar-brand-text">
               Kurir
            </span>
        </div>
    </div>

    <div class="navbar-container container-fluid">
        <div class="collapse navbar-collapse navbar-collapse-toolbar" id="site-navbar-collapse">
            <ul class="breadcrumb">
                <li>
                    <a href="media.php?module=home">Home</a>
                </li>
                <?php include "breadcrumbtop.php"; ?>
            </ul>
            <ul class="nav navbar-toolbar navbar-right navbar-toolbar-right">
                <li class="dropdown">
                    <a class="navbar-avatar dropdown-toggle" data-toggle="dropdown" href="" aria-expanded="false" data-animation="slide-bottom"
                        role="button">
                        <span class="avatar avatar-online">
                            <img src="../admin/assets/images/avatar/avatar.jpg" alt="...">
                            <i></i>
                        </span>
                    </a>
                    <ul class="dropdown-menu" role="menu">
                        <li role="presentation">
                            <a href="media.php?module=driver" role="menuitem">
                                <i class="icon wb-user" aria-hidden="true"></i> Profile</a>
                        </li>
                        <li class="divider" role="presentation"></li>
                        <li role="presentation">
                            <a href="session/logout.php" role="menuitem">
                                <i class="icon wb-power" aria-hidden="true"></i> Logout</a>
                        </li>
                    </ul>
                </li>
                <li class="hidden-xs" id="toggleFullscreen">
                    <a class="icon icon-fullscreen" data-toggle="fullscreen" href="" role="button">
                        <span class="sr-only">Toggle fullscreen</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<?php include "sidebar.php"; ?>