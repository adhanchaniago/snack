<?php
    include "../../../config/include.php";

$module=$_GET['module'];
$act=$_GET['act'];

// Tambah
if ($module=='bank' AND $act=='add'){

  $sql = "INSERT INTO bank (
            bank_id,
            bank_type,
            bank_name,
            bank_noaccount)
          VALUES (
            '$_POST[bank_id]',
            '$_POST[bank_type]',
            '$_POST[bank_name]',
            '$_POST[bank_noaccount]')";

  if (mysqli_query($connect, $sql)) {
    header('location:../../media.php?module='.$module);
  }
}

// Ubah
elseif ($module=='bank' AND $act=='edit'){
  $sql = "UPDATE bank SET
            bank_type  = '$_POST[bank_type]',
            bank_name  = '$_POST[bank_name]',
            bank_noaccount  = '$_POST[bank_noaccount]'
          WHERE bank_id = '$_POST[bank_id]'";

  if (mysqli_query($connect, $sql)) {
    header('location:../../media.php?module='.$module);
  }
}

// Hapus
if ($module=='bank' AND $act=='delete'){
  $sql = "DELETE FROM bank
          WHERE bank_id = '$_GET[id]'";

if (mysqli_query($connect, $sql)) {
    header('location:../../media.php?module='.$module);
  }
}

?>
