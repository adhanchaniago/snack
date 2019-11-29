<?php
    session_start();
    unset($_SESSION["cart"]);
    unset($_SESSION["payment"]);
  

    echo "<script>alert('Keranjang belanja telah kosong!');</script>";
    echo "<script>location='../../media.php?module=cart';</script>";
?>