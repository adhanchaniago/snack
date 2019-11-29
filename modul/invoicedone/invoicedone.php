<?php
 if (empty($_SESSION['pelanggan_username']) AND empty($_SESSION['pelanggan_password'])){
    echo "<script>location='media.php?module=home';</script>";
} else { 
    $action="modul/invoicedone/action.php?module=".$_GET['module']."&act=".$_GET['act'];
    switch($_GET['act']) {
        default:
        ?>

    <div class="page-content container-fluid">
        <div class="row">
            <div class="col-md-3">
                <div class="panel">
                    <div class="panel-heading">
                        <h5 class="panel-title">Histori</h5>
                    </div>
                    <ul class="list">
                        <li class="list-item">
                            <a href="?module=invoiceprocess" class="animsition-link">
                               Pemesanan - Proses
                            </a>
                        </li>
                        <li class="list-item">
                            <a href="?module=invoicedone" class="animsition-link">
                                Pemesanan - Selesai
                            </a>
                        </li>
                        <li class="list-item">
                            <a href="?module=invoicecancel" class="animsition-link">
                                Pemesanan - Cancel
                            </a>
                        </li>
                        <li class="list-item">
                            <a href="?module=invoicecod" class="animsition-link">
                                Pemesanan - COD
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-md-9">
                <div class="panel">
                    <div class="panel-heading">
                        <h5 class="panel-title">Pemesanan - Selesai</h5>
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
                                        <th>Order ID</th>
                                        <th class="text-center">Bukti Pembayaran</th>
                                        <th>Pemesan</th>
                                        <th>Jenis Pembayaran</th>
                                        <th>Total</th>
                                        <th>Dipesan</th>
                                        <th class="text-center">Aksi</th>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if (empty(isset($_GET['filter']))) {
                                            $p      = new Paging;
                                            $batas  = 10;
                                            $posisi = $p->cariPosisi($batas);

                                            $result=mysqli_query($connect,"SELECT * FROM invoice WHERE invoice_status='done' AND pelanggan_username='$_SESSION[pelanggan_username]' LIMIT $posisi,$batas");
                                            $jmldata = mysqli_num_rows(mysqli_query($connect, "SELECT * FROM invoice WHERE invoice_status='done' AND pelanggan_username='$_SESSION[pelanggan_username]'"));
                                            if(mysqli_num_rows($result) === 0) {
                                    ?>
                                            <tr>
                                                <td class="text-center" colspan="10">Data kosong...</td>
                                            </tr>
                                            <?php } else {
                                                $no = $posisi+1;
                                                while ($r=mysqli_fetch_array($result)) {
                                                $tanggal=tgl_indo($r['invoice_created']);
                                                $invoice_price=format_rupiah($r['invoice_total']);
                                                ?>
                                            <tr>
                                                <td>
                                                    <?php echo $r['invoice_id'];?>
                                                </td>
                                                <?php if ($r['invoice_photo']) { ?>
                                                <td>
                                                    <a href="admin//assets/images/invoice/<?php echo $r['invoice_photo'] ?>" target="_blank">
                                                        <img style="width: 100px" src="admin//assets/images/invoice/<?php echo $r['invoice_photo'] ?>">
                                                    </a>
                                                </td>
                                                <?php } else { ?>
                                                <td class="text-center">
                                                    Belum Mengupload
                                                    <br>Bukti Pembayaran
                                                </td>
                                                <?php } ?>
                                                <td>
                                                    <?php 
                                                    $result2 = mysqli_query($connect, "SELECT * FROM pelanggan WHERE pelanggan_username='$r[pelanggan_username]'");
                                                    $pelanggan      = mysqli_fetch_array($result2);
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
                                                    <?php echo $r['invoice_address']; ?>
                                                </td>
                                                <td>
                                                Jenis : <?php echo $r['invoice_payment']; ?> <br>
                                               Ongkos Kirim : <?php echo format_rupiah($r['invoice_ongkir']); ?> <br>
                                              Per Toko : <?php echo format_rupiah($r['invoice_ongkir']/$r['invoice_totaltoko']); ?>
                                            </td>
                                                <td>
                                                    Total Item:
                                                    <?php echo $r['invoice_item'];?>
                                                    <br> Total Berat:
                                                    <?php echo $r['invoice_weight'];?>
                                                    <br> Total Harga:
                                                    <?php echo format_rupiah($r['invoice_total']); ?>
                                                </td>
                                                <td>
                                                    <?php echo $tanggal?>
                                                </td>
                                                <td class="text-center action">
                                                    <a style="margin-bottom: 10px" class="btn btn-primary" href="?module=invoicedone&act=detail&id=<?php echo $r['invoice_id'];?>">
                                                        Detail
                                                    </a>
                                                    <a class="btn btn-success" href="modul/invoicedone/invoicedone_pdf.php?id=<?php echo $r['invoice_id'];?>" style="margin-left: 0px;"><i class="fa fa-print"></i> Print PDF</a>
                                                </td>
                                                <?php $no++; } ?>
                                            </tr>
                                            <?php }
                                                $jmldata = mysqli_num_rows(mysqli_query($connect, "SELECT * FROM invoice WHERE invoice_status='done' AND pelanggan_username='$_SESSION[pelanggan_username]'"));
                                                $jmlhalaman  = $p->jumlahHalaman($jmldata, $batas);
                                                $linkHalaman = $p->navHalaman($_GET['halaman'], $jmlhalaman);
                                            } else {
                                            $p      = new Paging;
                                            $batas  = 10;
                                            $posisi = $p->cariPosisi($batas);
                                            $search = $_GET['filter'];

                                            $result=mysqli_query($connect,"SELECT * FROM invoice WHERE invoice_id LIKE '%$search%' AND invoice_status='done' LIMIT $posisi,$batas");
                                            $jmldata = mysqli_num_rows(mysqli_query($connect, "SELECT * FROM invoice WHERE invoice_id LIKE '%$search%' AND invoice_status='done'"));
                                            if(mysqli_num_rows($result) === 0) {
                                    ?>
                                            <tr>
                                                <td class="text-center" colspan="10">Pencarian tidak ditemukan...</td>
                                            </tr>
                                            <?php } else {
                                                $no = $posisi+1;
                                                while ($r=mysqli_fetch_array($result)) {
                                                $tanggal=tgl_indo($r['invoice_created']);
                                                $invoice_price=format_rupiah($r['invoice_price']);
                                                ?>
                                            <tr>
                                                <td>
                                                    <?php echo $r['invoice_id'];?>
                                                </td>
                                                <?php if ($r['invoice_photo']) { ?>
                                                <td>
                                                    <a href="admin//assets/images/invoice/<?php echo $r['invoice_photo'] ?>" target="_blank">
                                                        <img style="width: 100px" src="admin//assets/images/invoice/<?php echo $r['invoice_photo'] ?>">
                                                    </a>
                                                </td>
                                                <?php } else { ?>
                                                <td class="text-center">
                                                    Belum Mengupload
                                                    <br>Bukti Pembayaran
                                                </td>
                                                <?php } ?>
                                                <td>
                                                    <?php 
                                                $result2 = mysqli_query($connect, "SELECT * FROM pelanggan WHERE pelanggan_username='$r[pelanggan_username]'");
                                                $pelanggan      = mysqli_fetch_array($result2);
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
                                                    <?php echo $r['invoice_address']; ?>
                                                </td>
                                                <td>
                                                Jenis : <?php echo $r['invoice_payment']; ?> <br>
                                               Ongkos Kirim : <?php echo format_rupiah($r['invoice_ongkir']); ?> <br>
                                              Per Toko : <?php echo format_rupiah($r['invoice_ongkir']/$r['invoice_totaltoko']); ?>
                                            </td>
                                                <td>
                                                    Total Item:
                                                    <?php echo $r['invoice_item'];?>
                                                    <br> Total Berat:
                                                    <?php echo $r['invoice_weight'];?>
                                                    <br> Total Harga:
                                                    <?php echo format_rupiah($r['invoice_total']); ?>
                                                </td>
                                                <td>
                                                    <?php echo $tanggal?>
                                                </td>
                                                <td class="text-center action">
                                                    <a style="margin-bottom: 10px" class="btn btn-primary" href="?module=invoicedone&act=detail&id=<?php echo $r['invoice_id'];?>">
                                                        Detail
                                                    </a> <a class="btn btn-success" href="modul/invoicedone/invoicedone_pdf.php?id=<?php echo $r['invoice_id'];?>" style="margin-left: 0px;"><i class="fa fa-print"></i> Print PDF</a>
                                                </td>
                                                <?php $no++; } ?>
                                            </tr>
                                            <?php }
                                                $jmldata = mysqli_num_rows(mysqli_query($connect, "SELECT * FROM invoice WHERE invoice_id LIKE '%$search%' AND invoice_status='done'"));
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
    <?php
        break;
        case "upload":
        $result = mysqli_query($connect, "SELECT * FROM invoice WHERE invoice_id='$_GET[id]'");
        $p      = mysqli_fetch_array($result);
        ?>
        <form action="<?php echo $action ?>" method="post" enctype="multipart/form-data" id="exampleStandardForm" autocomplete="off">
            <div class="page-content container-fluid">
                <div class="col-md-2"></div>
                <div class="col-md-8">
                    <div class="panel">
                        <div class="panel-heading">
                            <h5 class="panel-title">Cancel Pemesanan #
                                <?php echo $p['invoice_id']?>
                            </h5>
                        </div>
                        <div class="panel-body container-fluid">
                            <div class="form-group form-material">
                                <label class="control-label" for="inputText">Order ID</label>
                                <input type="text" readonly class="form-control input-sm" id="invoice_id" name="invoice_id" placeholder="Masukan Order ID"
                                    value="<?php echo $p['invoice_id']?>" required/>
                            </div>
                            <div class="form-group form-material">
                                <label class="control-label" for="inputText">Alasan Pesanan di Cancel</label>
                                <input type="text" class="form-control input-sm" id="invoice_done" name="invoice_done" placeholder="Masukan Alasan Pesanan di Cancel"
                                    value="" required/>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-2"></div>
                <div class="col-md-12">
                    <div class='button text-center'>
                        <input class="btn btn-primary btn-sm" type="submit" name="simpan" value="Cancel Pesanan" id="validateButton2">
                        <a class="btn btn-default btn-sm" href="?module=invoicedone">Kembali</a>
                    </div>
                </div>
            </div>
        </form>

        <?php
        break;
        case "detail":   
        $results = mysqli_query($connect, "SELECT * FROM invoice WHERE invoice_id='$_GET[id]'");
        $invoice      = mysqli_fetch_array($results);
        $result2 = mysqli_query($connect, "SELECT * FROM pelanggan WHERE pelanggan_username='$invoice[pelanggan_username]'");
        $pelanggan      = mysqli_fetch_array($result2);
        ?>
            <div class="page-content container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="panel">
                            <div class="panel-heading">
                                <h5 class="panel-title">Detail Pemesanan #
                                    <?php echo $_GET['id'] ?>
                                    <br>
                                    <br>
                                    <small>
                                        Username :
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
                                        
                                    </small>
                                    <br>
                                               
                                    <small>   
                                    Jenis : <?php echo $invoice['invoice_payment']; ?> <br>
                                    Ongkos Kirim : <?php echo format_rupiah($invoice['invoice_ongkir']); ?> <br>
                                   Per Toko : <?php echo format_rupiah($invoice['invoice_ongkir']/$invoice['invoice_totaltoko']); ?> 
                                    </small>   
                                </h5>
                            </div>
                            <div class="panel-body container-fluid table-detail">
                                <div class="table-full table-view">
                                    <div class="navigation-btn">
                                        <div class='btn-navigation'>
                                            <a class="btn btn-primary" href="?module=invoicedone">
                                                Kembali
                                            </a>
                                        </div>
                                        </form>
                                    </div>
                                    <div class="table-responsive">
                                        <table class="table table-hover">
                                            <thead>
                                                <th>ID</th>
                                                <th>Nama</th>
                                                <th>QTY</th>
                                                <th>Harga</th>
                                                <th>Total Harga</th>
                                                <th>No Resi/Driver</th>
                                                <th>Dibuat</th>
                                            </thead>
                                            <tbody>
                                                <?php
                                            $result=mysqli_query($connect,"SELECT * FROM transaction WHERE invoice_id='$_GET[id]'");
                                            $jmldata = mysqli_num_rows(mysqli_query($connect, "SELECT * FROM transaction WHERE invoice_id='$_GET[id]'"));
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
                                                        </td> <td>
                                                            
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
                                                         Username :
                                                    <?php echo $driver['driver_username']; ?>
                                                    <br> Nama :
                                                    <?php echo $driver['driver_name']; ?>
                                                    <br> Alamat :
                                                    <?php echo $driver['driver_alamat']; ?>
                                                    <br> No Telp :
                                                    <?php echo $driver['driver_notelp']; ?>
                                                    <br>
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
                                                         <?php } else { ?>
                                                             Menunggu Konfirmasi
                                                         <?php } ?>
                                                      
                                                        </td>
                                                        <td>
                                                            <?php echo $tanggal?>
                                                        </td>
                                                        <?php $no++; } ?>
                                                    </tr>
                                                    <?php } ?>
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
    } }
?>