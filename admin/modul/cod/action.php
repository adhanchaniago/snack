    <?php
    include "../../../config/include.php";

    $module=$_GET['module'];
    $act=$_GET['act'];

    // Ubah
    if ($module=='cod' AND $act=='edit'){
            $sql = "UPDATE identitas SET
                        identitas_cod = '$_POST[identitas_cod]'
                    WHERE identitas_id = '$_POST[identitas_id]'";

            if (mysqli_query($connect, $sql)) {
                header('location:../../media.php?module='.$module.'&act=edit');
            }
        }
        
?>
