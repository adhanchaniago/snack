<?php
    include "../../config/include.php";

$module=$_GET['module'];
$act=$_GET['act'];

// Tambah
if ($module=='menu' AND $act=='add'){
  $lokasi_file = $_FILES['fupload']['tmp_name'];
  $nama_file   = $_FILES['fupload']['name'];
  $acak           = rand(000000,999999);
  $nama_file_unik = $acak.$nama_file;
  
  UploadImageMenuCustomer($nama_file_unik);

  $sql = "INSERT INTO menu (
            toko_id,
            category_id,
            menu_name,
            menu_description,
            menu_price,
            menu_weight,
            menu_photo)
          VALUES (
            '$_POST[toko_id]',
            '$_POST[category_id]',
            '$_POST[menu_name]',
            '$_POST[menu_description]',
            '$_POST[menu_price]',
            '$_POST[menu_weight]',
            '$nama_file_unik')";

  if (mysqli_query($connect, $sql)) {
    header('location:../../media.php?module='.$module);
  }
}

// Ubah
elseif ($module=='menu' AND $act=='edit'){
  $lokasi_file = $_FILES['fupload']['tmp_name'];
  $nama_file   = $_FILES['fupload']['name'];
  $acak           = rand(000000,999999);
  $nama_file_unik = $acak.$nama_file;

  // Apabila gambar tidak diganti
  if (empty($lokasi_file)){
    $sql = "UPDATE menu SET
              toko_id  = '$_POST[toko_id]',
              category_id  = '$_POST[category_id]',
              menu_name  = '$_POST[menu_name]',
              menu_description  = '$_POST[menu_description]',
              menu_price  = '$_POST[menu_price]',
              menu_weight  = '$_POST[menu_weight]'
            WHERE menu_id = '$_POST[menu_id]'";

    if (mysqli_query($connect, $sql)) {
      header('location:../../media.php?module='.$module);
    }
  } else {
    unlink('../../assets/images/menu/'.$_POST['menu_photo']);
    unlink('../../assets/images/menu/small_'.$_POST['menu_photo']);
    UploadImageMenuCustomer($nama_file_unik);
    $sql = "UPDATE menu SET
    toko_id  = '$_POST[toko_id]',
    category_id  = '$_POST[category_id]',
    menu_name  = '$_POST[menu_name]',
    menu_description  = '$_POST[menu_description]',
    menu_price  = '$_POST[menu_price]',
    menu_weight  = '$_POST[menu_weight]',
    menu_photo = '$nama_file_unik'
  WHERE menu_id = '$_POST[menu_id]'";

    if (mysqli_query($connect, $sql)) {
      header('location:../../media.php?module='.$module);
    }
  }
}

// Hapus
if ($module=='menu' AND $act=='delete'){
  $result = mysqli_query($connect, "SELECT * FROM menu WHERE menu_id='$_GET[id]'");
  $p      = mysqli_fetch_array($result);
  unlink('../../assets/images/menu/'.$p['menu_photo']);
  unlink('../../assets/images/menu/small_'.$p['menu_photo']);
  $sql = "DELETE FROM menu
          WHERE menu_id = '$_GET[id]'";

if (mysqli_query($connect, $sql)) {
    header('location:../../media.php?module='.$module);
  }
}

?>
