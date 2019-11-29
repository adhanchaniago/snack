<?php
    include "../../../config/include.php";

$module=$_GET['module'];
$act=$_GET['act'];

// Tambah
if ($module=='ongkir' AND $act=='add'){

  $sql = "INSERT INTO ongkir (
            ongkir_id,
            ongkir_city,
            ongkir_price)
          VALUES (
            '$_POST[ongkir_id]',
            '$_POST[ongkir_city]',
            '$_POST[ongkir_price]')";

  if (mysqli_query($connect, $sql)) {
    header('location:../../media.php?module='.$module);
  }
}

// Ubah
elseif ($module=='ongkir' AND $act=='edit'){
  $sql = "UPDATE ongkir SET
            ongkir_city  = '$_POST[ongkir_city]',
            ongkir_price  = '$_POST[ongkir_price]'
          WHERE ongkir_id = '$_POST[ongkir_id]'";

  if (mysqli_query($connect, $sql)) {
    header('location:../../media.php?module='.$module);
  }
}

// Hapus
if ($module=='ongkir' AND $act=='delete'){
  $sql = "DELETE FROM ongkir
          WHERE ongkir_id = '$_GET[id]'";

if (mysqli_query($connect, $sql)) {
    header('location:../../media.php?module='.$module);
  }
}

?>
