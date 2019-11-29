<?php
    include "../../../config/include.php";

$module=$_GET['module'];
$act=$_GET['act'];

// Tambah
if ($module=='saldotoko' AND $act=='add'){
  $lokasi_file = $_FILES['fupload']['tmp_name'];
  $nama_file   = $_FILES['fupload']['name'];
  $acak           = rand(000000,999999);
  $nama_file_unik = $acak.$nama_file;
  
  UploadImageSaldo($nama_file_unik);

  $sql = "INSERT INTO saldotoko (
            toko_id,
            invoice_id,
            saldotoko_price,
            saldotoko_photo)
          VALUES (
            '$_POST[toko_id]',
            '$_POST[invoice_id]',
            '$_POST[toko_id]',
            '$nama_file_unik')";
    
if (mysqli_query($connect, $sql)) {
    header('location:../../media.php?module='.$module);
  }
}
?>
