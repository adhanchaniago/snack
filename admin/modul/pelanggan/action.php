<?php
    include "../../../config/include.php";

$module=$_GET['module'];
$act=$_GET['act'];

// Tambah
if ($module=='pelanggan' AND $act=='add'){
  $password = md5($_POST['pelanggan_password']);
  $sql = "INSERT INTO pelanggan (
            pelanggan_username,
            pelanggan_name,
            pelanggan_password,
            pelanggan_notelp,
            pelanggan_alamat)
          VALUES (
            '$_POST[pelanggan_username]',
            '$_POST[pelanggan_name]',
            '$password',
            '$_POST[pelanggan_notelp]',
            '$_POST[pelanggan_alamat]')";

  if (mysqli_query($connect, $sql)) {
    header('location:../../media.php?module='.$module);
  }
}

// Tambah
if ($module=='register' AND $act=='add'){
  $password = md5($_POST['pelanggan_password']);
  $sql = "INSERT INTO pelanggan (
            pelanggan_username,
            pelanggan_name,
            pelanggan_password,
            pelanggan_notelp,
            pelanggan_alamat)
          VALUES (
            '$_POST[pelanggan_username]',
            '$_POST[pelanggan_name]',
            '$password',
            '$_POST[pelanggan_notelp]',
            '$_POST[pelanggan_alamat]')";

  if (mysqli_query($connect, $sql)) {
    echo "<script>alert('Akun telah berhasil didaftarkan, silahkan masuk!');</script>";
    echo "<script>location='../../../media.php?module=login';</script>";
  }
}

// Ubah
elseif ($module=='pelanggan' AND $act=='edit'){
  $sql = "UPDATE pelanggan SET
            pelanggan_name  = '$_POST[pelanggan_name]',
            pelanggan_notelp  = '$_POST[pelanggan_notelp]',
            pelanggan_alamat  = '$_POST[pelanggan_alamat]'
          WHERE pelanggan_username = '$_POST[pelanggan_username]'";

  if (mysqli_query($connect, $sql)) {
    header('location:../../media.php?module='.$module);
  }
}

// Ubah Password
elseif ($module=='pelanggan' AND $act=='editpassword'){
    $password = md5($_POST['pelanggan_password']);
    $sql = "UPDATE pelanggan SET
            pelanggan_password  = '$password'
            WHERE pelanggan_username = '$_POST[pelanggan_username]'";

    if (mysqli_query($connect, $sql)) {
    header('location:../../media.php?module='.$module);
    }
}

// Hapus
if ($module=='pelanggan' AND $act=='delete'){
  $sql = "DELETE FROM pelanggan
          WHERE pelanggan_username = '$_GET[id]'";

if (mysqli_query($connect, $sql)) {
    header('location:../../media.php?module='.$module);
  }
}

?>
