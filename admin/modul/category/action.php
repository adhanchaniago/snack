<?php
    include "../../../config/include.php";

$module=$_GET['module'];
$act=$_GET['act'];

// Tambah
if ($module=='category' AND $act=='add'){

  $sql = "INSERT INTO category (
            category_id,
            category_name)
          VALUES (
            '$_POST[category_id]',
            '$_POST[category_name]')";

  if (mysqli_query($connect, $sql)) {
    header('location:../../media.php?module='.$module);
  }
}

// Ubah
elseif ($module=='category' AND $act=='edit'){
  $sql = "UPDATE category SET
            category_name  = '$_POST[category_name]'
          WHERE category_id = '$_POST[category_id]'";

  if (mysqli_query($connect, $sql)) {
    header('location:../../media.php?module='.$module);
  }
}

// Hapus
if ($module=='category' AND $act=='delete'){
  $sql = "DELETE FROM category
          WHERE category_id = '$_GET[id]'";

if (mysqli_query($connect, $sql)) {
    header('location:../../media.php?module='.$module);
  }
}

?>
