    <?php
    include "../../config/include.php";

    $module=$_GET['module'];
    $act=$_GET['act'];
 
    // Ubah
    if ($module=='user' AND $act=='edit'){
        $sql = "UPDATE pelanggan SET
                pelanggan_name  = '$_POST[pelanggan_name]',
                pelanggan_notelp  = '$_POST[pelanggan_notelp]',
                pelanggan_alamat  = '$_POST[pelanggan_alamat]'
                WHERE pelanggan_username = '$_POST[pelanggan_username]'";
    
        if (mysqli_query($connect, $sql)) {
            echo "<script>alert('Data Biodata berhasil diubah!');</script>";
            echo "<script>location='../../media.php?module=user';</script>";
        }
    }

    // Ubah Password
    elseif ($module=='user' AND $act=='editpassword'){
        $password = md5($_POST['pelanggan_password']);
        $sql = "UPDATE pelanggan SET
                pelanggan_password  = '$password'
                WHERE pelanggan_username = '$_POST[pelanggan_username]'";
    
        if (mysqli_query($connect, $sql)) {
        header('location:../../media.php?module='.$module);
        echo "<script>alert('Password berhasil diubah!');</script>";
        echo "<script>location='../../media.php?module=user';</script>";
        }
    }
?>
