<?php
ob_start();
require_once '../../../config/include.php';
require_once '../../../config/dompdf/autoload.inc.php';
use Dompdf\Dompdf;
$dompdf = new Dompdf();

?>
<html xmlns="http://www.w3.org/1999/xhtml">

	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
		<title>Laporan Transaksi</title>
	</head>

	<body>
		<div class="title">Laporan Transaksi</div>
		<?php
           if (empty(isset($_GET['filter'])) AND empty(isset($_GET['filter2']))) {  ?>
			<div class="subtitle">Keseluruhan</div>
			<?php } else { ?>
				<div class="subtitle">
					Transaksi dari <?php echo tgl_indo($_GET[filter]." 00:00:00") ?> sampai	<?php echo tgl_indo($_GET[filter2]." 00:00:00") ?>
				</div>
			<?php } ?>
				<div class="center">
					<table class="border">
						<thead>
							<tr>
								<th>ID</th>
                                    <th>Order ID</th>
                                    <th>Toko</th>
                                    <th>Pelanggan</th>
								<th>Menu</th>
								<th>QTY</th>
								<th>Harga</th>
								<th>Total Harga</th>
								<th>Dibuat</th>
							</tr>
						</thead>
						<tbody>
							<?php
                                        if (empty(isset($_GET['filter'])) AND empty(isset($_GET['filter2']))) { 
						$result=mysqli_query($connect,"SELECT * FROM transaction WHERE transaction_status = 'done'");
						$jmldata = mysqli_num_rows(mysqli_query($connect,"SELECT * FROM transaction WHERE transaction_status = 'done'"));
										} else {
											$result=mysqli_query($connect,"SELECT * FROM transaction WHERE transaction_status='done' AND transaction_created
											BETWEEN '$_GET[filter] 00:00:00' AND '$_GET[filter2] 00:00:00'");
										$jmldata = mysqli_num_rows(mysqli_query($connect, "SELECT * FROM transaction WHERE transaction_status='done' AND transaction_created
										BETWEEN '$_GET[filter] 00:00:00' AND '$_GET[filter2] 00:00:00'"));
										}
						if(mysqli_num_rows($result) === 0) {
						?>
								<tr>
									<td style="text-align:center" colspan="6">Data kosong...</td>
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
                                                    <?php 
                                                    $result2 = mysqli_query($connect, "SELECT * FROM invoice WHERE invoice_id='$r[invoice_id]'");
                                                    $invoice      = mysqli_fetch_array($result2);
                                                    $result3 = mysqli_query($connect, "SELECT * FROM pelanggan WHERE pelanggan_username='$invoice[pelanggan_username]'");
                                                    $pelanggan      = mysqli_fetch_array($result3);
                                                    ?> Username :
                                                    <?php echo $pelanggan['pelanggan_username']; ?>
                                                    <br> Nama :
                                                    <?php echo $pelanggan['pelanggan_name']; ?>
                                                    <br> Alamat :
                                                    <?php echo $pelanggan['pelanggan_alamat']; ?>
                                                    <br> No Telp :
                                                    <?php echo $pelanggan['pelanggan_notelp']; ?>
                                                    <br>
                                                    <br> Alamat Pengiriman :
                                                    <?php echo $invoice['invoice_address']; ?>
                                                </td>
									<td>
										<?php echo $r['transaction_name'];?>
									</td>
									<td>
										<?php echo $r['transaction_qty'];?>
									</td>
									<td>
										<?php echo $transaction_price;?>
									</td>
									<td>
										<?php echo $transaction_totalprice;?>
									</td>
									<td>
										<?php echo $tanggal?>
									</td>
								</tr>
								<?php $no++; } ?>
								<?php } ?>
						</tbody>
						<tbody>
							<tr>
								<?php
                                        if (empty(isset($_GET['filter'])) AND empty(isset($_GET['filter2']))) { 
												$result = mysqli_query($connect, "SELECT SUM(transaction_totalprice) AS transaction_totalprice FROM transaction WHERE transaction_status = 'done'"); 
										} else {
											$result=mysqli_query($connect,"SELECT SUM(transaction_totalprice) AS transaction_totalprice FROM transaction WHERE transaction_status='done' AND transaction_created
                                            BETWEEN '$_GET[filter] 00:00:00' AND '$_GET[filter2] 00:00:00'");
										}
												$row = mysqli_fetch_assoc($result);  
												$sum = $row['transaction_totalprice'];
											?>
									<td colspan="8">Total Pendapatan</td>
									<td colspan="1">Rp
										<?php echo format_rupiah($sum); ?>,00</td>
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
html,body {text-align: center;}
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
$dompdf->stream("LAPORAN",array("Attachment"=>1));
?>