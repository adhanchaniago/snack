<?php
    include "../../../config/include.php";

$module=$_GET['module'];
$act=$_GET['act'];

// Tambah
if ($module=='toko' AND $act=='add'){

  $sql = "INSERT INTO toko (
            pelanggan_username,
            toko_name,
            toko_deskripsi,
            toko_alamat,
            toko_latitude,
            toko_longitude,
            toko_status,
            toko_bank,
            toko_owner,
            toko_noaccount)
          VALUES (
            '$_POST[pelanggan_username]',
            '$_POST[toko_name]',
            '$_POST[toko_deskripsi]',
            '$_POST[toko_alamat]',
            '$_POST[toko_latitude]',
            '$_POST[toko_longitude]',
            'Open',
            '$_POST[toko_bank]',
            '$_POST[toko_owner]',
            '$_POST[toko_noaccount]')";

  if (mysqli_query($connect, $sql)) {
    header('location:../../media.php?module='.$module);
  }
}

// Open
elseif ($module=='toko' AND $act=='open'){
  $sql = "UPDATE toko SET
            toko_status  = 'Open'
          WHERE toko_id = '$_GET[id]'";

  if (mysqli_query($connect, $sql)) {
    header('location:../../media.php?module='.$module);
  }
}

// Close
elseif ($module=='toko' AND $act=='close'){
  $sql = "UPDATE toko SET
            toko_status  = 'Close'
          WHERE toko_id = '$_GET[id]'";

  if (mysqli_query($connect, $sql)) {
    header('location:../../media.php?module='.$module);
  }
}

// Ubah
elseif ($module=='toko' AND $act=='edit'){
  $sql = "UPDATE toko SET
            pelanggan_username= '$_POST[pelanggan_username]',
            toko_name= '$_POST[toko_name]',
            toko_deskripsi= '$_POST[toko_deskripsi]',
            toko_alamat= '$_POST[toko_alamat]',
            toko_latitude= '$_POST[toko_latitude]',
            toko_longitude= '$_POST[toko_longitude]',
            toko_bank  = '$_POST[toko_bank]',
            toko_owner  = '$_POST[toko_owner]',
            toko_noaccount  = '$_POST[toko_noaccount]'
          WHERE toko_id = '$_POST[toko_id]'";

  if (mysqli_query($connect, $sql)) {
    header('location:../../media.php?module='.$module);
  }
}

// Hapus
if ($module=='toko' AND $act=='delete'){
  $sql = "DELETE FROM toko
          WHERE toko_id = '$_GET[id]'";

if (mysqli_query($connect, $sql)) {
    header('location:../../media.php?module='.$module);
  }
}

?>
