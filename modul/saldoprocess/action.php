<?php
    include "../../config/include.php";

$module=$_GET['module'];
$act=$_GET['act'];

session_start();
// Tambah
if ($module=='saldoprocess' AND $act=='add'){
  $lokasi_file = $_FILES['fupload']['tmp_name'];
  $nama_file   = $_FILES['fupload']['name'];
  $acak           = rand(000000,999999);
  $nama_file_unik = $acak.$nama_file;
  
  UploadImageSaldoCustomer($nama_file_unik);

  $sql = "INSERT INTO saldo (
            pelanggan_username,
            saldo_photo)
          VALUES (
            '$_SESSION[pelanggan_username]',
            '$nama_file_unik')";

  if (mysqli_query($connect, $sql)) {
    header('location:../../media.php?module='.$module);
  }
}

// Accept
if ($module=='saldoprocess' AND $act=='accept'){
  $sql = "UPDATE saldo SET
              saldo_price  = '$_POST[saldo_price]',
              saldo_cancel  = '',
              saldo_status  = 'done'
            WHERE saldo_id = '$_POST[saldo_id]'";

$result = mysqli_query($connect, "SELECT * FROM pelanggan WHERE pelanggan_username='$_POST[pelanggan_username]'");
$p      = mysqli_fetch_array($result);
$saldo = $p['pelanggan_saldo'] + $_POST['saldo_price'];

    $sql2 = "UPDATE pelanggan SET
                  pelanggan_saldo  = '$saldo'
    WHERE pelanggan_username = '$_POST[pelanggan_username]'";

if (mysqli_query($connect, $sql2) && mysqli_query($connect, $sql)) {
    header('location:../../media.php?module='.$module);
  }
}
// Cancel
elseif ($module=='saldoprocess' AND $act=='cancel'){
    $sql = "UPDATE saldo SET
              saldo_cancel  = '$_POST[saldo_cancel]',
              saldo_status  = 'cancel'
            WHERE saldo_id = '$_POST[saldo_id]'";

  if (mysqli_query($connect, $sql) ) {
    header('location:../../media.php?module='.$module);
  }
}

?>
