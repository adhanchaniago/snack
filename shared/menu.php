<li>
    <a href="?module=home">
        Makanan
    </a>
</li>

<li>
    <a href="?module=payment">
        Pembayaran
    </a>
</li>

<li>
    <a href="?module=cart">
        Keranjang
    </a>
</li>

<li>
    <a href="?module=checkout">
        Checkout
    </a>
</li>

<li>
    <a href="?module=resi">
    Lacak Pesanan
    </a>
</li>

<li>
    <a href="?module=driver">
        Driver
    </a>
</li>
<?php 
    if (empty($_SESSION['pelanggan_username']) AND empty($_SESSION['pelanggan_password'])){
?>
<li>
    <a href="?module=login">
        Masuk
    </a>
</li>

<li>
    <a href="?module=register&act=add">
        Daftar
    </a>
</li>

<?php } else { ?>

<li class="dropdown">
    <a style="min-width: 120px !important; text-align: left !important;" class="navbar-avatar dropdown-toggle" data-toggle="dropdown" href="" aria-expanded="false" data-animation="slide-bottom"
        role="button">
        <span class="avatar avatar-online">
            <img src="assets/images/avatar/avatar.jpg" alt="...">
            - <?php echo $_SESSION['pelanggan_name']; ?>
        </span>
    </a>
    <ul class="dropdown-menu" role="menu">
        <li role="presentation">
            <a href="media.php?module=user" role="menuitem">
                <i class="icon wb-user" aria-hidden="true"></i> Profile</a>
        </li>
        <li role="presentation">
            <a href="media.php?module=saldoprocess" role="menuitem">
                <i class="fa fa-money" aria-hidden="true"></i> &nbsp; Saldo</a>
        </li>
         <?php 
                                                    $result2 = mysqli_query($connect, "SELECT * FROM toko WHERE pelanggan_username='$_SESSION[pelanggan_username]'");
                                                    $toko      = mysqli_fetch_array($result2);
                                                    if ($toko['toko_id']) {
                                                    ?>
        <li role="presentation">
            <a href="media.php?module=toko" role="menuitem">
                <i class="icon wb-file" aria-hidden="true"></i> Kelola Toko</a>
        </li>
                                                    <?php } else {?>
                                                        <li role="presentation">
            <a href="media.php?module=toko&act=add" role="menuitem">
                <i class="icon wb-file" aria-hidden="true"></i> Buka Toko</a>
        </li>
                                                        <?php } ?>
        <li role="presentation">
            <a href="media.php?module=invoiceprocess" role="menuitem">
                <i class="icon wb-file" aria-hidden="true"></i> Histori Pemesanan</a>
        </li>

        <li class="divider" role="presentation"></li>
        <li role="presentation">
            <a href="modul/login/logout.php" role="menuitem">
                <i class="icon wb-power" aria-hidden="true"></i> Logout</a>
        </li>
    </ul>
</li>

<?php } ?>
<li class="hidden-xs" id="toggleFullscreen">
    <a class="icon icon-fullscreen" data-toggle="fullscreen" href="" role="button">
        <span class="sr-only">Toggle fullscreen</span>
    </a>
</li>