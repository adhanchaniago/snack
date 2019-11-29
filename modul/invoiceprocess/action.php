<?php
    include "../../config/include.php";

$module=$_GET['module'];
$act=$_GET['act'];

// Upload
if ($module=='invoiceprocess' AND $act=='upload'){
  $lokasi_file = $_FILES['fupload']['tmp_name'];
  $nama_file   = $_FILES['fupload']['name'];
  $acak           = rand(000000,999999);
  $nama_file_unik = $acak.$nama_file;

  UploadImageInvoice($nama_file_unik);
  $sql = "UPDATE invoice SET
                        invoice_photo = '$nama_file_unik'
            WHERE invoice_id = '$_POST[invoice_id]'";

if (mysqli_query($connect, $sql)) {
    echo "<script>alert('Upload Bukti Pembayaran Berhasil');</script>";
    echo "<script>location='../../media.php?module=invoiceprocess';</script>";
  }
}

?>