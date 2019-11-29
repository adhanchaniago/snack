<?php
    switch($_GET['act']) {
        default:
        ?>
    <div class="page-content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="panel">
                    <div class="panel-heading">
                        <h5 class="panel-title">Laporan Penjualan
                        </h5>
                    </div>
                    <div class="panel-body container-fluid table-detail">
                        <div class="table-full table-view">
                            <div class="navigation-btn">
                                <form method="get" action='<?php echo $_SERVER[' PHP_SELF '] ?>' id="exampleStandardForm" autocomplete="off">
                                    <div class='row margin-bottom'>
                                        <div class='btn-search'>Cari dari Tanggal: &nbsp; &nbsp; &nbsp;</div>
                                        <div class='col-md-3 col-sm-12 select-search'>
                                            <div class="input-group">
                                                <input type="date" name="filter" class="form-control" value="" required/>
                                                <input type=hidden name=module value=laporan>
                                            </div>
                                        </div>
                                        <div class='btn-search'>Sampai Tanggal: &nbsp; &nbsp; &nbsp;</div>
                                        <div class='col-md-3 col-sm-12 select-search'>
                                            <div class="input-group">
                                                <input type="date" name="filter2" class="form-control" value="" required/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class='btn-navigation'>
                                        <button class="btn btn-primary" type="submit" style="margin-right: 10px;" id="validateButton2">
                                            Cari
                                        </button>
                                        <?php
                                        if (empty(isset($_GET['filter'])) AND empty(isset($_GET['filter2']))) { 
                                            $result=mysqli_query($connect,"SELECT * FROM transaction WHERE transaction_status='done'");
                                            if(mysqli_num_rows($result) > 0) {?>
                                            <a class="btn btn-success" href="modul/laporan/laporan_pdf.php" style="margin-right: 10px;">
                                                <i class="fa fa-print"></i> Print PDF</a>
                                            <?php } ?>
                                            <?php } else { 
                                                $result=mysqli_query($connect,"SELECT * FROM transaction WHERE transaction_status='done' AND transaction_created
                                                BETWEEN '$_GET[filter] 00:00:00' AND '$_GET[filter2] 00:00:00'");
                                            if(mysqli_num_rows($result) > 0) {?>
                                            <a class="btn btn-success" href="modul/laporan/laporan_pdf.php?filter=<?php echo $_GET[filter]."&filter2=".$_GET[filter2] ?>" style="margin-right: 10px;">
                                                <i class="fa fa-print"></i> Print PDF</a>
                                            <?php }} ?>
                                            <div class='pull-right'>
                                                <a class="btn btn-primary" href="?module=laporan">
                                                    <i class="fa fa-refresh"></i>
                                                </a>
                                            </div>
                                    </div>
                                </form>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <th>ID</th>
                                    <th>Order ID</th>
                                    <th>Toko</th>
                                    <th>Pelanggan</th>
                                        <th>Menu</th>
                                        <th>QTY</th>
                                        <th>Harga</th>
                                        <th>Total Harga</th>
                                        <th>Dibuat</th>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if (empty(isset($_GET['filter'])) AND empty(isset($_GET['filter2']))) {
                                            $result=mysqli_query($connect,"SELECT * FROM transaction WHERE transaction_status='done'");
                                            $jmldata = mysqli_num_rows(mysqli_query($connect, "SELECT * FROM transaction WHERE transaction_status='done'"));
                                            if(mysqli_num_rows($result) === 0) {
                                    ?>
                                            <tr>
                                                <td class="text-center" colspan="10">Data kosong...</td>
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
                                                <?php $no++; } ?>
                                            </tr>
                                            <?php }} else {
                                                $result=mysqli_query($connect,"SELECT * FROM transaction WHERE transaction_status='done' AND transaction_created
                                                BETWEEN '$_GET[filter] 00:00:00' AND '$_GET[filter2] 00:00:00'");
                                            $jmldata = mysqli_num_rows(mysqli_query($connect, "SELECT * FROM transaction WHERE transaction_status='done' AND transaction_created
                                            BETWEEN '$_GET[filter] 00:00:00' AND '$_GET[filter2] 00:00:00'"));
                                            if(mysqli_num_rows($result) === 0) {
                                    ?>
                                            <tr>
                                                <td class="text-center" colspan="10">Data kosong...</td>
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
                                                <?php $no++; } ?>
                                            </tr>

                                            <?php } }?>
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
                                                <td colspan="7">Total Pendapatan</td>
                                                <td colspan="2" style="color:red">Rp
                                                    <?php echo format_rupiah($sum); ?>,00</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
        break;
    }
?>