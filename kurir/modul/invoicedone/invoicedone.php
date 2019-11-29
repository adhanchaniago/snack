<?php

    $action="modul/invoicedone/action.php?module=".$_GET['module']."&act=".$_GET['act'];
    switch($_GET['act']) {
        default:
        ?>

    <div class="page-content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="panel">
                    <div class="panel-heading">
                        <h5 class="panel-title">Pemesanan - Proses</h5>
                    </div>
                    <div class="panel-body container-fluid table-detail">
                        <div class="table-full table-view">
                            <div class="navigation-btn">
                                <form method="get" action='<?php echo $_SERVER[' PHP_SELF '] ?>'>
                                    <div class='row margin-bottom'>
                                        <div class='btn-search'>Cari Berdasarkan ID: &nbsp; &nbsp; &nbsp;</div>
                                        <div class='col-md-4 col-sm-12 select-search'>
                                            <div class="input-group">
                                                <input type="text" name="filter" class="form-control" value="" />
                                                <input type=hidden name=module value=invoicedone>
                                                <span class="input-group-btn">
                                                    <button type="submit" class="btn btn-primary" type="button">
                                                        <i class="fa fa-search"></i>
                                                    </button>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class='btn-navigation'>
                                        <div class='pull-right'>
                                            <a class="btn btn-primary" href="?module=invoicedone">
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
                                    <th>Nama</th>
                                    <th>QTY</th>
                                    <th>Harga</th>
                                    <th>Total Harga</th>
                                    <th>No Resi/Driver</th>
                                    <th>Dibuat</th>
                                </thead>
                                <tbody>
                                    <?php
                                    
                                    if (empty(isset($_GET['filter']))) {
                                        $p      = new Paging;
                                        $batas  = 10;
                                        $posisi = $p->cariPosisi($batas);

                                $result=mysqli_query($connect,"SELECT * FROM transaction WHERE transaction_status='done' AND driver_username='$_SESSION[driver_username]'");
                                $jmldata = mysqli_num_rows(mysqli_query($connect, "SELECT * FROM transaction WHERE transaction_status='done' AND driver_username='$_SESSION[driver_username]'"));
                                if(mysqli_num_rows($result) === 0) {
                        ?>
                                        <tr>
                                            <td class="text-center" colspan="15">Data kosong...</td>
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
                                            <?php if ($r['transaction_statustoko'] == 'processaccept') { ?>
                                                No Resi Belum Dikirim
                                             <?php } else if ($r['transaction_statustoko'] == 'selectdriveraccept') { ?>
                                                 Driver Belum Dipilih
                                                 <?php } else if ($r['transaction_statustoko'] == 'processacceptresi') { ?>
                                       No Resi:  <?php echo $r['transaction_noresi']  ;?>
                                     <?php } else if ($r['transaction_statustoko'] == 'selectdriveracceptdriver') {
                                        
                                          
$result2 = mysqli_query($connect, "SELECT * FROM driver WHERE driver_username='$r[driver_username]'");
$driver      = mysqli_fetch_array($result2);
?>
                                         Menunggu Konfirmasi Driver
                                         <?php } else if ($r['transaction_statustoko'] == 'doneresi') { ?>
                                       No Resi:  <?php echo $r['transaction_noresi']  ;?>
                                     <?php } else if ($r['transaction_statustoko'] == 'donedriver') {
                                        
                                          
$result2 = mysqli_query($connect, "SELECT * FROM driver WHERE driver_username='$r[driver_username]'");
$driver      = mysqli_fetch_array($result2);
?>
                                             Username :
                                        <?php echo $driver['driver_username']; ?>
                                        <br> Nama :
                                        <?php echo $driver['driver_name']; ?>
                                        <br> Alamat :
                                        <?php echo $driver['driver_alamat']; ?>
                                        <br> No Telp :
                                        <?php echo $driver['driver_notelp']; ?>
                                            <?php } else if ($r['transaction_statustoko'] == 'drivertotoko') { ?>
                                                Driver Pergi Ke Toko<br>
                                                Mengambil Pesanan
                                                <?php } else if ($r['transaction_statustoko'] == 'drivertopelanggan') { ?>
                                                    Driver Mengirim Barang ke Pelanggan 
                                                <?php } else if ($r['transaction_statustoko'] == 'done') { ?>
                                                    Selesai                                            
                                             <?php } else { ?>
                                                 Menunggu Konfirmasi
                                             <?php } ?>
                                            </td>
                                            <td>
                                                <?php echo $tanggal?>
                                            </td>
                                            <?php $no++; } ?>
                                        </tr>
                                            <?php }
                                                $jmldata = mysqli_num_rows(mysqli_query($connect, "SELECT * FROM invoice WHERE invoice_status='process'"));
                                                $jmlhalaman  = $p->jumlahHalaman($jmldata, $batas);
                                                $linkHalaman = $p->navHalaman($_GET['halaman'], $jmlhalaman);
                                            } else {
                                                $p      = new Paging;
                                                $batas  = 10;
                                                $posisi = $p->cariPosisi($batas);
    
                                        $result=mysqli_query($connect,"SELECT * FROM transaction WHERE invoice_id LIKE '%$search%' AND  transaction_status='done' AND driver_username='$_SESSION[driver_username]'");
                                        $jmldata = mysqli_num_rows(mysqli_query($connect, "SELECT * FROM transaction WHERE invoice_id LIKE '%$search%' AND  transaction_status='done' AND driver_username='$_SESSION[driver_username]'"));
                                        if(mysqli_num_rows($result) === 0) {
                                ?>
                                                <tr>
                                                    <td class="text-center" colspan="15">Data kosong...</td>
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
                                                    <?php if ($r['transaction_statustoko'] == 'processaccept') { ?>
                                                        No Resi Belum Dikirim
                                                     <?php } else if ($r['transaction_statustoko'] == 'selectdriveraccept') { ?>
                                                         Driver Belum Dipilih
                                                         <?php } else if ($r['transaction_statustoko'] == 'processacceptresi') { ?>
                                               No Resi:  <?php echo $r['transaction_noresi']  ;?>
                                             <?php } else if ($r['transaction_statustoko'] == 'selectdriveracceptdriver') {
                                                
                                                  
        $result2 = mysqli_query($connect, "SELECT * FROM driver WHERE driver_username='$r[driver_username]'");
        $driver      = mysqli_fetch_array($result2);
        ?>
                                                 Menunggu Konfirmasi Driver
                                                 <?php } else if ($r['transaction_statustoko'] == 'doneresi') { ?>
                                               No Resi:  <?php echo $r['transaction_noresi']  ;?>
                                             <?php } else if ($r['transaction_statustoko'] == 'donedriver') {
                                                
                                                  
        $result2 = mysqli_query($connect, "SELECT * FROM driver WHERE driver_username='$r[driver_username]'");
        $driver      = mysqli_fetch_array($result2);
        ?>
                                                     Username :
                                                <?php echo $driver['driver_username']; ?>
                                                <br> Nama :
                                                <?php echo $driver['driver_name']; ?>
                                                <br> Alamat :
                                                <?php echo $driver['driver_alamat']; ?>
                                                <br> No Telp :
                                                <?php echo $driver['driver_notelp']; ?>
                                                    <?php } else if ($r['transaction_statustoko'] == 'drivertotoko') { ?>
                                                        Driver Pergi Ke Toko<br>
                                                        Mengambil Pesanan
                                                        <?php } else if ($r['transaction_statustoko'] == 'drivertopelanggan') { ?>
                                                            Driver Mengirim Barang ke Pelanggan 
                                                        <?php } else if ($r['transaction_statustoko'] == 'done') { ?>
                                                            Selesai                                            
                                                     <?php } else { ?>
                                                         Menunggu Konfirmasi
                                                     <?php } ?>
                                                     </td>
                                                    <td>
                                                        <?php echo $tanggal?>
                                                    </td>
                                                    <?php $no++; } ?>
                                                </tr>
                                                    <?php }
                                                        $jmldata = mysqli_num_rows(mysqli_query($connect, "SELECT * FROM invoice WHERE invoice_id LIKE '%$search%' AND invoice_status='process'"));
                                                        $jmlhalaman  = $p->jumlahHalaman($jmldata, $batas);
                                                        $linkHalaman = $p->navHalaman($_GET['halaman'], $jmlhalaman);
                                            } ?>
                                    </tbody>
                                </table>
                            </div>
                            <div class="wrapper">
                                <div class="paging">
                                    <div id='pagination'>
                                        <div class='pagination-right'>
                                            <ul class="pagination">
                                                <?php echo $linkHalaman ?>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="total">Total :
                                    <?php echo $jmldata;?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ========== Modal Konfirmasi ========== -->
    <div id="modal-konfirmasi" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title">Konfirmasi</h4>
                </div>

                <div class="modal-body" style="background:green;color:#fff">
                    Apakah Anda yakin bukti pembayaran benar?
                </div>

                <div class="modal-footer">
                    <a href="javascript:;" class="btn btn-success" id="accept-invoice">Ya</a>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Tidak</button>
                </div>

            </div>
        </div>
    </div>
    <!-- ========== End Modal Konfirmasi ========== -->

            <?php
        break;
    }
?>