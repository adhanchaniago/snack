    <?php
    include "../../../config/include.php";

    $module=$_GET['module'];
    $act=$_GET['act'];

    // Ubah
    if ($module=='website' AND $act=='edit'){
        $lokasi_file = $_FILES['fupload']['tmp_name'];
        $nama_file   = $_FILES['fupload']['name'];
        $acak           = rand(000000,999999);
        $nama_file_unik = $acak.$nama_file;

        // Apabila gambar tidak diganti
        if (empty($lokasi_file)){
            $sql = "UPDATE identitas SET
                        identitas_website  = '$_POST[identitas_website]',
                        identitas_deskripsi = '$_POST[identitas_deskripsi]',
                        identitas_keyword = '$_POST[identitas_keyword]',
                        identitas_alamat = '$_POST[identitas_alamat]',
                        identitas_notelp = '$_POST[identitas_notelp]',
                        identitas_author = '$_POST[identitas_author]'
                    WHERE identitas_id = '$_POST[identitas_id]'";

            if (mysqli_query($connect, $sql)) {
                header('location:../../media.php?module='.$module.'&act=edit');
            }
        } else {
            unlink('../../assets/images/identitas/'.$_POST['identitas_favicon']);
            unlink('../../assets/images/identitas/small_'.$_POST['identitas_favicon']);
            UploadImage($nama_file_unik);
            $sql = "UPDATE identitas SET
                        identitas_website  = '$_POST[identitas_website]',
                        identitas_deskripsi = '$_POST[identitas_deskripsi]',
                        identitas_keyword = '$_POST[identitas_keyword]',
                        identitas_alamat = '$_POST[identitas_alamat]',
                        identitas_notelp = '$_POST[identitas_notelp]',
                        identitas_favicon = '$nama_file_unik',
                        identitas_author = '$_POST[identitas_author]'
                    WHERE identitas_id = '$_POST[identitas_id]'";

            if (mysqli_query($connect, $sql)) {
                header('location:../../media.php?module='.$module.'&act=edit');
            }
        }
    }
?>
