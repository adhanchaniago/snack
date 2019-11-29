<?php
    session_start();
    unset($_SESSION["payment"]);
  

    echo "<script>alert('Jenis Pembayaran sudah dihapus!');</script>";
    echo "<script>location='../../media.php?module=checkout';</script>";
?>