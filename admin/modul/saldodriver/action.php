<?php
    include "../../../config/include.php";

$module=$_GET['module'];
$act=$_GET['act'];

// Tambah
if ($module=='saldodriver' AND $act=='add'){
  $lokasi_file = $_FILES['fupload']['tmp_name'];
  $nama_file   = $_FILES['fupload']['name'];
  $acak           = rand(000000,999999);
  $nama_file_unik = $acak.$nama_file;
  
  UploadImageSaldo($nama_file_unik);

  $sql = "INSERT INTO saldodriver (
            driver_username,
            saldodriver_price,
            saldodriver_photo)
          VALUES (
            '$_POST[driver_username]',
            '$_POST[saldodriver_price]',
            '$nama_file_unik')";

$result = mysqli_query($connect, "SELECT * FROM driver WHERE driver_username='$_POST[driver_username]'");
$p      = mysqli_fetch_array($result);
$saldo = $p['driver_saldo'] - $_POST['saldodriver_price'];

    $sql2 = "UPDATE driver SET
                  driver_saldo  = '$saldo'
    WHERE driver_username = '$_POST[driver_username]'";
    
if (mysqli_query($connect, $sql2) && mysqli_query($connect, $sql)) {
    header('location:../../media.php?module='.$module);
  }
}
?>
