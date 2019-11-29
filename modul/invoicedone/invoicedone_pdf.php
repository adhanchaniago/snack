<?php
ob_start();
require_once '../../config/include.php';
require_once '../../config/dompdf/autoload.inc.php';
use Dompdf\Dompdf;
$dompdf = new Dompdf();

?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Laporan Transaksi</title>
</head>
<body>
<?php 
       $results = mysqli_query($connect, "SELECT * FROM invoice WHERE invoice_id='$_GET[id]'");
       $invoice      = mysqli_fetch_array($results);
       $result2 = mysqli_query($connect, "SELECT * FROM pelanggan WHERE pelanggan_username='$invoice[pelanggan_username]'");
       $pelanggan      = mysqli_fetch_array($result2);
       ?>

			<div class="title">Detail Pemesanan # <?php echo $_GET['id'] ?></div>
                                    <small>
                                        Username : <?php echo $pelanggan['pelanggan_username']; ?>
                                        <br> Nama : <?php echo $pelanggan['pelanggan_name']; ?>
                                        <br> Alamat : <?php echo $pelanggan['pelanggan_alamat']; ?>
                                        <br> No Telp : <?php echo $pelanggan['pelanggan_notelp']; ?>
                                    </small>
                                               
                                    <small>   
									Jenis : <?php echo $invoice['invoice_payment']; ?> 
									<br> Ongkos Kirim : <?php echo format_rupiah($invoice['invoice_ongkir']); ?> 
									<br> Per Toko : <?php echo format_rupiah($invoice['invoice_ongkir']/$invoice['invoice_totaltoko']); ?> 
                                    </small>   
				<div class="center">
								<table class="border">
									<thead>
										<tr>
											<th>ID</th>
										<th>Order ID</th>
										<th>Toko</th>
                                        <th>Menu</th>
                                        <th>QTY</th>
                                        <th>Harga</th>
                                        <th>Total Harga</th>
                                        <th>Dibuat</th>
										</tr>
									</thead>
									<tbody>
									<?php
                                            $result=mysqli_query($connect,"SELECT * FROM transaction WHERE invoice_id='$_GET[id]'");
                                            $jmldata = mysqli_num_rows(mysqli_query($connect, "SELECT * FROM transaction WHERE invoice_id='$_GET[id]'"));
										if(mysqli_num_rows($result) === 0) {
										?>
										<tr>
											<td  style="text-align:center" colspan="6">Data kosong...</td>
										</tr>
										<?php } else {
										 $no = 1;
										 while ($r=mysqli_fetch_array($result)) {
										 $tanggal=tgl_indo($r['transaction_created']);
										 $transaction_price=format_rupiah($r['transaction_price']);
										 $transaction_totalprice=format_rupiah($r['transaction_totalprice']);
										 ?>
									 <tr>
										 <td>
											 <?php echo $r['transaction_id'];?>
										 </td>
										<td>
											#<?php echo $r['invoice_id'];?>
										</td>
										<td>
											<?php 
											$result2 = mysqli_query($connect, "SELECT * FROM toko WHERE toko_id='$r[toko_id]'");
											$toko      = mysqli_fetch_array($result2);
											?>
											<a href="?module=toko&act=detail&id=<?php echo $toko['toko_id']; ?>">
												<?php echo $toko['toko_name']; ?>
											</a>
										</td>
										 <td>
											 <?php echo $r['transaction_name'];?>
										 </td>
										 <td>
											 <?php echo $r['transaction_qty'];?>
										 </td>
										 <td>
											 Rp<?php echo $transaction_price;?>,00
										 </td>
										 <td>
											 Rp<?php echo $transaction_totalprice;?>,00
										 </td>
										 <td>
											 <?php echo $tanggal?>
										 </td>
										 <?php $no++; } ?>
										</tr>
										<?php } ?>
									</tbody>
									<tbody>
										<tr>
											<?php
												$result = mysqli_query($connect, "SELECT SUM(transaction_totalprice) AS transaction_totalprice FROM transaction  WHERE invoice_id='$_GET[id]'");
												$row = mysqli_fetch_assoc($result);  
												$sum = $row['transaction_totalprice'];
											?>
											<td colspan="7">Total Harga</td>
											<td colspan="1">Rp<?php echo format_rupiah($sum); ?>,00</td>
										</tr>
									</tbody>
								</table>


								</div>
    <style>
.title {font-size: 30px;text-align: center; border-bottom: 3px solid black;padding-bottom: 20px;}
table.border{width:100%; border-collapse:collapse; table-layout:auto; vertical-align:top; border:1px solid #CCCCCC;}
table.border thead th{font-size: 12px; color:#FFFFFF; background-color:#666666; border:1px solid #CCCCCC; border-collapse:collapse; text-align:center; table-layout:auto; vertical-align:middle;}
table.border tbody td{vertical-align:top; border-collapse:collapse; border-left:1px solid #CCCCCC; border-right:1px solid #CCCCCC; border-bottom:1px solid #CCCCCC; font-size: 12px;}
table.border thead th, table tbody td{padding:5px; border-collapse:collapse;}
table.border tbody tr.light{color:#979797; background-color:#F7F7F7;}
table.border tbody tr.dark{color:#979797; background-color:#E8E8E8;}
</style>
                
	</body>

	</html>

<?php
$html = ob_get_contents(); //Proses untuk mengambil hasil dari OB..
ob_end_clean();
//Here convert the encode for UTF-8, if you prefer the ISO-8859-1 just change for $mpdf->WriteHTML($html);
$dompdf->loadHTML(utf8_encode($html));

// (Opsional) Mengatur ukuran kertas dan orientasi kertas
$dompdf->setPaper('A4', 'landscape');
// Menjadikan HTML sebagai PDF
$dompdf->render();
// Output akan menghasilkan PDF (1 = download dan 0 = preview)
$dompdf->stream("TRANSAKSI-".$_GET['id'],array("Attachment"=>1));
?>
