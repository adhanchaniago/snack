<?php
    session_start();
    $menu_id=$_GET["id"];
    unset($_SESSION["cart"][$menu_id]);

    echo "<script>alert('Menu telah dihapus ke Keranjang Belanja!');</script>";
    echo "<script>location='../../media.php?module=cart';</script>";
?>