<?php
    include "../../config/include.php";

    $username = $_POST['username'];
    $password = md5($_POST['password']);

    $login=mysqli_query($connect, "SELECT * FROM driver WHERE driver_username='$username' AND driver_password='$password'");
    $find=mysqli_num_rows($login);
    $r=mysqli_fetch_array($login);

    if ($find > 0){
        if ($r['driver_status'] === 'done'){
            session_start();

            $_SESSION['driver_username']   = $r['driver_username'];
            $_SESSION['driver_name']       = $r['driver_name'];
            $_SESSION['driver_password']   = $r['driver_password'];
            $_SESSION['driver_saldo']   = $r['driver_saldo'];
            $_SESSION['driver_notelp']   = $r['driver_notelp'];
            $_SESSION['driver_address']   = $r['driver_address'];
            $_SESSION['driver_bank']   = $r['driver_bank'];
            $_SESSION['driver_owner']   = $r['driver_owner'];
            $_SESSION['driver_noaccount']   = $r['driver_noaccount'];

                $sid_lama = session_id();

                session_regenerate_id();

                $sid_baru = session_id();

            mysqli_query($connect, "UPDATE driver SET driver_session='$sid_baru' WHERE driver_username='$username'");
            header('location: ../media.php?module=invoiceprocess');
        } else {
            echo "<script>alert('Status Driver Menunggu Persetujuan Admin!');</script>";
            echo "<script>location='login.php';</script>";
        }
    } else {
        echo "<script>alert('Username atau Password salah!');</script>";
        echo "<script>location='login.php';</script>";
    }
?>
