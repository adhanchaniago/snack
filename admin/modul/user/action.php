    <?php
    include "../../../config/include.php";

    $module=$_GET['module'];
    $act=$_GET['act'];
 
    // Ubah
    if ($module=='user' AND $act=='edit'){
        $sql = "UPDATE admin SET
                admin_name  = '$_POST[admin_name]'
                WHERE admin_username = '$_POST[admin_username]'";
    
        if (mysqli_query($connect, $sql)) {
        header('location:../../media.php?module='.$module);
        }
    }

    // Ubah Password
    elseif ($module=='user' AND $act=='editpassword'){
        $password = md5($_POST['admin_password']);
        $sql = "UPDATE admin SET
                admin_password  = '$password'
                WHERE admin_username = '$_POST[admin_username]'";
    
        if (mysqli_query($connect, $sql)) {
        header('location:../../media.php?module='.$module);
        }
    }
?>
