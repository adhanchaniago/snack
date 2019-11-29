<?php
    include "../../config/include.php";

    $username = $_POST['pelanggan_username'];
    $password = md5($_POST['pelanggan_password']);

    $login=mysqli_query($connect, "SELECT * FROM pelanggan WHERE pelanggan_username='$username' AND pelanggan_password='$password'");
    $find=mysqli_num_rows($login);
    $r=mysqli_fetch_array($login);

    if ($find > 0){
        session_start();

        $result2 = mysqli_query($connect, "SELECT * FROM toko WHERE pelanggan_username='$username'");
        $toko      = mysqli_fetch_array($result2);

        $_SESSION['pelanggan_username']   = $r['pelanggan_username'];
        $_SESSION['pelanggan_name']       = $r['pelanggan_name'];
        $_SESSION['pelanggan_password']   = $r['pelanggan_password'];
        $_SESSION['pelanggan_saldo']   = $r['pelanggan_saldo'];
        $_SESSION['pelanggan_notelp']   = $r['pelanggan_notelp'];
        $_SESSION['pelanggan_address']   = $r['pelanggan_address'];
        $_SESSION['toko_id']   = $toko['toko_id'];

            $sid_lama = session_id();

            session_regenerate_id();

            $sid_baru = session_id();

        mysqli_query($connect, "UPDATE pelanggan SET pelanggan_session='$sid_baru' WHERE pelanggan_username='$username'");
        echo "<script>alert('Anda berhasil masuk!');</script>";
        echo "<script>location='../../media.php?module=home';</script>";
    } else {
        echo "<script>alert('Username atau Password salah');</script>";
        echo "<script>location='../../media.php?module=login';</script>";
    }
?>
