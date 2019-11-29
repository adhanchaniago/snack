<?php
    include "../../../config/include.php";

$module=$_GET['module'];
$act=$_GET['act'];

// Tambah
if ($module=='driver' AND $act=='add'){
  $password = md5($_POST['driver_password']);
  $sql = "INSERT INTO driver (
            driver_username,
            driver_name,
            driver_password,
            driver_notelp,
            driver_latitude,
            driver_longitude,
            driver_alamat,
            driver_bank,
            driver_owner,
            driver_noaccount)
          VALUES (
            '$_POST[driver_username]',
            '$_POST[driver_name]',
            '$password',
            '$_POST[driver_notelp]',
            '$_POST[driver_latitude]',
            '$_POST[driver_longitude]',
            '$_POST[driver_alamat]',
            '$_POST[driver_bank]',
            '$_POST[driver_owner]',
            '$_POST[driver_noaccount]')";

  if (mysqli_query($connect, $sql)) {
    header('location:../../media.php?module='.$module);
  }
}

// Tambah
if ($module=='register' AND $act=='add'){
  $password = md5($_POST['driver_password']);
  $sql = "INSERT INTO driver (
            driver_username,
            driver_name,
            driver_password,
            driver_notelp,
            driver_latitude,
            driver_longitude,
            driver_alamat,
            driver_bank,
            driver_owner,
            driver_noaccount)
          VALUES (
            '$_POST[driver_username]',
            '$_POST[driver_name]',
            '$password',
            '$_POST[driver_notelp]',
            '$_POST[driver_latitude]',
            '$_POST[driver_longitude]',
            '$_POST[driver_alamat]',
            '$_POST[driver_bank]',
            '$_POST[driver_owner]',
            '$_POST[driver_noaccount]')";

  if (mysqli_query($connect, $sql)) {
    echo "<script>alert('Akun telah berhasil didaftarkan, silahkan masuk!');</script>";
    echo "<script>location='../../../media.php?module=login';</script>";
  }
}

// Active
elseif ($module=='driver' AND $act=='active'){
  $sql = "UPDATE driver SET
            driver_status  = 'done'
          WHERE driver_username = '$_GET[id]'";

  if (mysqli_query($connect, $sql)) {
    header('location:../../media.php?module='.$module);
  }
}

// NonActive
elseif ($module=='driver' AND $act=='nonactive'){
  $sql = "UPDATE driver SET
            driver_status  = 'process'
          WHERE driver_username = '$_GET[id]'";

  if (mysqli_query($connect, $sql)) {
    header('location:../../media.php?module='.$module);
  }
}

// Ubah
elseif ($module=='driver' AND $act=='edit'){
  $sql = "UPDATE driver SET
            driver_name  = '$_POST[driver_name]',
            driver_notelp  = '$_POST[driver_notelp]',
            driver_latitude  = '$_POST[driver_latitude]',
            driver_longitude  = '$_POST[driver_longitude]',
            driver_alamat  = '$_POST[driver_alamat]',
            driver_bank  = '$_POST[driver_bank]',
            driver_owner  = '$_POST[driver_owner]',
            driver_noaccount  = '$_POST[driver_noaccount]'
          WHERE driver_username = '$_POST[driver_username]'";

  if (mysqli_query($connect, $sql)) {
    header('location:../../media.php?module='.$module);
  }
}

// Ubah Password
elseif ($module=='driver' AND $act=='editpassword'){
    $password = md5($_POST['driver_password']);
    $sql = "UPDATE driver SET
            driver_password  = '$password'
            WHERE driver_username = '$_POST[driver_username]'";

    if (mysqli_query($connect, $sql)) {
    header('location:../../media.php?module='.$module);
    }
}

// Hapus
if ($module=='driver' AND $act=='delete'){
  $sql = "DELETE FROM driver
          WHERE driver_username = '$_GET[id]'";

if (mysqli_query($connect, $sql)) {
    header('location:../../media.php?module='.$module);
  }
}

?>
