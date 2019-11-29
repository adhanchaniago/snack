<?php
    include "../../config/include.php";

    session_start();
$module=$_GET['module'];

// Checkout
if ($module=='checkout'){

    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < 8; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }

    $array = array();
    foreach ($_SESSION["cart"] as $menu_id => $qty):
    $result = mysqli_query($connect, "SELECT * FROM menu WHERE menu_id='$menu_id'");
    $r      = mysqli_fetch_array($result);
    if (count($array) > 0) {
        foreach ($array as $toko_id => $a): 
            if ($a != $r['toko_id']) {
                array_push($array, $r['toko_id']);
            }
        endforeach;
    } else {
        array_push($array, $r['toko_id']);
    }
    endforeach;

    
  $arrays = $array;
  $arrays = implode(',',$arrays);

    if ($_SESSION['payment'] == 'Transfer Bank') {

        if($_POST['invoice_ongkir'] != 1) {
        $ongkir = $_POST['invoice_totaltoko'] * $_POST['invoice_ongkir'];
        $total = $ongkir + $_POST['invoice_total'];
        $status= 'process';
        $statustoko= 'process';
    } else {

        $website = mysqli_query($connect, "SELECT * FROM identitas WHERE identitas_id=1");
        while ($w = mysqli_fetch_array($website)) {
            $ongkos = $w['identitas_cod'];
        $ongkir = $_POST['invoice_totaltoko'] * $ongkos;
        $total = $ongkir + $_POST['invoice_total'];
        $status= 'process';
        $statustoko= 'selectdriver';
        }
    }

    $sql = "INSERT INTO invoice (
            invoice_id,
            toko_id,
            pelanggan_username,
            invoice_payment,
            invoice_totaltoko,
            invoice_ongkir,
            invoice_item,
            invoice_weight,
            invoice_total,
            invoice_address,
            invoice_status,
            invoice_statustoko)
          VALUES (
            '$randomString',
            '$arrays',
            '$_POST[pelanggan_username]',
            'Transfer Bank',
            '$_POST[invoice_totaltoko]',
            '$ongkir',
            '$_POST[invoice_item]',
            '$_POST[invoice_weight]',
            '$total',
            '$_POST[invoice_address]',
            '$status',
            '$statustoko')";

    foreach ($_SESSION["cart"] as $menu_id => $qty):
        $result = mysqli_query($connect, "SELECT * FROM menu WHERE menu_id='$menu_id'");
        $r      = mysqli_fetch_array($result);
        $result2 = mysqli_query($connect, "SELECT * FROM toko WHERE toko_id='$r[toko_id]'");
        $toko      = mysqli_fetch_array($result2);
        $menu_totalprice=($qty*$r['menu_price']);
        $sql2 = "INSERT INTO transaction (
            invoice_id,
            toko_id,
            transaction_name,
            transaction_qty,
            transaction_payment,
            transaction_price,
            transaction_totalprice,
            transaction_status,
            transaction_statustoko)
          VALUES (
            '$randomString',
            '$toko[toko_id]',
            '$r[menu_name]',
            '$qty',
            'Transfer Bank',
            '$r[menu_price]',
            '$menu_totalprice',
            '$status',
            '$statustoko')";
        mysqli_query($connect, $sql2);
    endforeach;

  if (mysqli_query($connect, $sql)) {
    echo "<script>alert('Pemesanan berhasil, silahkan Upload Bukti Pembayaran');</script>";
    echo "<script>location='../../media.php?module=invoiceprocess';</script>";
    unset($_SESSION["cart"]);
    unset($_SESSION["payment"]);
  }
}
else if ($_SESSION['payment'] == 'COD') {
    if ($_POST['invoice_totaltoko'] == 1) {
            $total = $_POST['invoice_total'];
            $status= 'process';
            $statustoko= 'processcod';
    
        $sql = "INSERT INTO invoice (
                invoice_id,
                toko_id,
                pelanggan_username,
                invoice_payment,
                invoice_totaltoko,
                invoice_item,
                invoice_weight,
                invoice_total,
                invoice_address,
                invoice_date,
                invoice_clock,
                invoice_status,
                invoice_statustoko)
              VALUES (
                '$randomString',
                '$arrays',
                '$_POST[pelanggan_username]',
                'COD',
                '$_POST[invoice_totaltoko]',
                '$_POST[invoice_item]',
                '$_POST[invoice_weight]',
                '$total',
                '$_POST[invoice_address]',
                '$_POST[invoice_date]',
                '$_POST[invoice_clock]',
                '$status',
                '$statustoko')";
    
        foreach ($_SESSION["cart"] as $menu_id => $qty):
            $result = mysqli_query($connect, "SELECT * FROM menu WHERE menu_id='$menu_id'");
            $r      = mysqli_fetch_array($result);
            $result2 = mysqli_query($connect, "SELECT * FROM toko WHERE toko_id='$r[toko_id]'");
            $toko      = mysqli_fetch_array($result2);
            $menu_totalprice=($qty*$r['menu_price']);
            $sql2 = "INSERT INTO transaction (
                invoice_id,
                toko_id,
                transaction_name,
                transaction_qty,
                transaction_payment,
                transaction_price,
                transaction_totalprice,
                transaction_status,
                transaction_statustoko)
              VALUES (
                '$randomString',
                '$toko[toko_id]',
                '$r[menu_name]',
                '$qty',
                'COD',
                '$r[menu_price]',
                '$menu_totalprice',
                '$status',
                '$statustoko')";
            mysqli_query($connect, $sql2);
        endforeach;
    
      if (mysqli_query($connect, $sql)) {
        echo "<script>alert('Pemesanan berhasil, tunggu proses dari Toko!');</script>";
        echo "<script>location='../../media.php?module=invoiceprocess';</script>";
        unset($_SESSION["cart"]);
        unset($_SESSION["payment"]);
      }
    } else {
        echo "<script>alert('Untuk COD, silahkan pilih menu dari Satu Toko Saja!');</script>";
        echo "<script>location='../../media.php?module=invoiceprocess';</script>";
    }
    }
     else {
  
    if($_POST['invoice_ongkir'] != 1) {
        $ongkir = $_POST['invoice_totaltoko'] * $_POST['invoice_ongkir'];
        $total = $ongkir + $_POST['invoice_total'];
        $status= 'process';
        $statustoko= 'processaccept';
    } else {

        $website = mysqli_query($connect, "SELECT * FROM identitas WHERE identitas_id=1");
        while ($w = mysqli_fetch_array($website)) {
            $ongkos = $w['identitas_cod'];
        $ongkir = $_POST['invoice_totaltoko'] * $ongkos;
        $total = $ongkir + $_POST['invoice_total'];
        $status= 'process';
        $statustoko= 'selectdriveraccept';
        }
    }

    $saldo = $_SESSION['payment'];

    $result = mysqli_query($connect, "SELECT * FROM pelanggan WHERE pelanggan_username='$_SESSION[pelanggan_username]'");
    $p      = mysqli_fetch_array($result);
    $saldo = $p['pelanggan_saldo'] - $saldo;
    
  $sqlpelanggan = "UPDATE pelanggan SET
  pelanggan_saldo  = '$saldo'
WHERE pelanggan_username = '$p[pelanggan_username]'";
        mysqli_query($connect, $sqlpelanggan);

    $sql = "INSERT INTO invoice (
            invoice_id,
            toko_id,
            pelanggan_username,
            invoice_payment,
            invoice_totaltoko,
            invoice_ongkir,
            invoice_item,
            invoice_weight,
            invoice_total,
            invoice_address,
            invoice_status,
            invoice_statustoko,
            invoice_photo)
          VALUES (
            '$randomString',
            '$arrays',
            '$_POST[pelanggan_username]',
            'Saldo',
            '$_POST[invoice_totaltoko]',
            '$ongkir',
            '$_POST[invoice_item]',
            '$_POST[invoice_weight]',
            '$total',
            '$_POST[invoice_address]',
            '$status',
            '$statustoko',
            'Saldo')";

    foreach ($_SESSION["cart"] as $menu_id => $qty):
        $result = mysqli_query($connect, "SELECT * FROM menu WHERE menu_id='$menu_id'");
        $r      = mysqli_fetch_array($result);
        $result2 = mysqli_query($connect, "SELECT * FROM toko WHERE toko_id='$r[toko_id]'");
        $toko      = mysqli_fetch_array($result2);
        $menu_totalprice=($qty*$r['menu_price']);
        $sql2 = "INSERT INTO transaction (
            invoice_id,
            toko_id,
            transaction_name,
            transaction_qty,
            transaction_payment,
            transaction_price,
            transaction_totalprice,
            transaction_status,
            transaction_statustoko)
          VALUES (
            '$randomString',
            '$toko[toko_id]',
            '$r[menu_name]',
            '$qty',
            'Saldo',
            '$r[menu_price]',
            '$menu_totalprice',
            '$status',
            '$statustoko')";
        mysqli_query($connect, $sql2);
    endforeach;

  if (mysqli_query($connect, $sql)) {
    echo "<script>alert('Pemesanan berhasil, tunggu proses pengiriman pesanan!');</script>";
    echo "<script>location='../../media.php?module=invoiceprocess';</script>";
    unset($_SESSION["cart"]);
    unset($_SESSION["payment"]);
  }  
}
}
?>