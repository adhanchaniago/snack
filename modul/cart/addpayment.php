<?php
    session_start();
    $invoice_payment = $_POST['invoice_payment'];

    $_SESSION['payment'] = $invoice_payment;
    echo "<script>alert('Jenis Pembayaran telah dipilih!');</script>";
    echo "<script>location='../../media.php?module=checkout';</script>";
?>