<?php
    session_start();
    $menu_id = $_POST['menu_id'];
    $qty = $_POST['qty'];

    if(isset($_SESSION['cart'][$menu_id]))
    {
        if ($qty > 0) {
        $_SESSION['cart'][$menu_id] = $qty;
            echo "<script>alert('Menu telah ditambah ke Keranjang Belanja!');</script>";
            echo "<script>location='../../media.php?module=cart';</script>";
        } else {
            echo "<script>alert('Stock pembelian kurang dari 1!');</script>";
            echo "<script>location='../../media.php?module=cart';</script>";
        }
    }
    else
    {
        if ($qty > 0) {
        $_SESSION['cart'][$menu_id] = $qty;
            echo "<script>alert('Menu telah ditambah ke Keranjang Belanja!');</script>";
            echo "<script>location='../../media.php?module=cart';</script>";
        } else {
            echo "<script>alert('Stock pembelian kurang dari 1!');</script>";
            echo "<script>location='../../media.php?module=cart';</script>";
        }
    }
?>