<?php

    $action="modul/transactionprocess/action.php?module=".$_GET['module']."&act=".$_GET['act'];
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
                        <a href="?module=transactionprocess" class="animsition-link">
                           Pemesanan Toko - Proses
                        </a>
                    </li>
                    <li class="list-item">
                        <a href="?module=transactiondone" class="animsition-link">
                            Pemesanan Toko - Selesai
                        </a>
                    </li>
                    <li class="list-item">
                        <a href="?module=transactioncancel" class="animsition-link">
                            Pemesanan Toko - Cancel
                        </a>
                    </li>
                    <li class="list-item">
                        <a href="?module=transactioncod" class="animsition-link">
                            Pemesanan Toko - COD
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="col-md-9">
                <div class="panel">
                    <div class="panel-heading">
                        <h5 class="panel-title">Pemesanan Toko - Selesai</h5>
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
                                                <input type=hidden name=module value=transactionprocess>
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
                                            <a class="btn btn-primary" href="?module=transactiondone">
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
                                        <th>Pemesan</th>
                                        <th>Jenis Pembayaran</th>
                                        <th>Dipesan</th>
                                        <th>Status Toko</th>
                                        <th class="text-center">Aksi</th>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if (empty(isset($_GET['filter']))) {
                                            $p      = new Paging;
                                            $batas  = 10;
                                            $posisi = $p->cariPosisi($batas);

                                            $result=mysqli_query($connect,"SELECT * FROM invoice WHERE invoice_status='done' LIMIT $posisi,$batas");
                                            $jmldata = mysqli_num_rows(mysqli_query($connect, "SELECT * FROM invoice WHERE invoice_status='done'"));
                                            if(mysqli_num_rows($result) === 0) {

                                               
                                    ?>
                                            <tr>
                                                <td class="text-center" colspan="10">Data kosong...</td>
                                            </tr>
                                            <?php } else {
                                                $no = $posisi+1;
                                                $no2 = 1;
                                                while ($r=mysqli_fetch_array($result)) {
                                                    $multiple_names = $r['toko_id'];  
                                                    $multiple_names_array = explode(',',$multiple_names);
                                                    
                                                    foreach($multiple_names_array as $resulttoko)
                                                    {
                                                      $tokos = mysqli_query($connect, "SELECT * FROM toko WHERE toko_id='$resulttoko'");
                                                      $toko      = mysqli_fetch_array($tokos);
                                                   if ($toko['toko_id'] == $_SESSION['toko_id']) {

                                                $tanggal=tgl_indo($r['invoice_created']);
                                                $invoice_price=format_rupiah($r['invoice_total']);
                                                ?>
                                            <tr>
                                                <td>
                                                    <?php echo $r['invoice_id'];?>
                                                </td>
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
                                               Ongkos Kirim : <?php echo format_rupiah($r['invoice_ongkir']/$r['invoice_totaltoko']); ?> 
                                            </td>
                                                <td>
                                                    <?php echo $tanggal?>
                                                </td>
                                                <td>
                                                <?php if ($r['invoice_statustoko'] == 'processaccept') { ?>
                                                    Menunggu Toko <br>Kirim No Resi
                                                 <?php } else if ($r['invoice_statustoko'] == 'selectdriveraccept') { ?>
                                                     Menunggu Toko <br>Pilih Driver
                                                 <?php } else if ($r['invoice_statustoko'] == 'processacceptresi') { ?>
                                                     Resi telah dikirim<br>
                                                     Menunggu Konfirmasi Admin
                                                 <?php } else if ($r['invoice_statustoko'] == 'selectdriveracceptdriver') { ?>
                                                    Driver telah dipilih<br>
                                                     Menunggu Konfirmasi Driver
                                                     <?php } else if ($r['invoice_statustoko'] == 'doneresi') { ?>
                                                   Selesai
                                                   <?php } else if ($r['invoice_statustoko'] == 'donedriver') { ?>
                                                   Selesai
                                                 <?php } else { ?>
                                                     Menunggu Konfirmasi
                                                 <?php } ?>
                                                </td>
                                                <td class="text-center action">
                                                <?php if ($r['invoice_statustoko'] == 'processaccept') { ?>
                                                    <a class="btn-update" href="?module=transactiondone&act=processaccept&id=<?php echo $r['invoice_id'];?>&toko=<?php echo $toko['toko_id'];?>" data-id="<?php echo $r['invoice_id'];?>" 
                                                        title="">
                                                        <i class="icon wb-check"></i>
                                                    </a>
                                                    <?php } else if ($r['invoice_statustoko'] == 'selectdriveraccept') { ?>
                                                        <a class="btn-update" href="?module=transactiondone&act=selectdriveraccept&id=<?php echo $r['invoice_id'];?>&toko=<?php echo $toko['toko_id'];?>" data-id="<?php echo $r['invoice_id'];?>" 
                                                        title="">
                                                        <i class="icon wb-users"></i>
                                                    </a>
                                                 <?php } ?>
                                                    <a class="btn-detail" href="?module=transactiondone&act=detail&id=<?php echo $r['invoice_id'];?>">
                                                        <i class="icon wb-search"></i>
                                                    </a>
                                                </td>
                                                <?php $no++; }} ?>
                                            <?php }?>
                                            </tr>
                                            <?php }
                                                $jmldata = mysqli_num_rows(mysqli_query($connect, "SELECT * FROM invoice WHERE invoice_status='done'"));
                                                $jmlhalaman  = $p->jumlahHalaman($jmldata, $batas);
                                                $linkHalaman = $p->navHalaman($_GET['halaman'], $jmlhalaman);
                                            } else {
                                                $p      = new Paging;
                                                $batas  = 10;
                                                $posisi = $p->cariPosisi($batas);
    
                                                $result=mysqli_query($connect,"SELECT * FROM invoice WHERE invoice_id LIKE '%$search%' AND invoice_status='done' LIMIT $posisi,$batas");
                                                $jmldata = mysqli_num_rows(mysqli_query($connect, "SELECT * FROM invoice WHERE invoice_id LIKE '%$search%' AND invoice_status='done'"));
                                                if(mysqli_num_rows($result) === 0) {
    
                                                   
                                        ?>
                                                <tr>
                                                    <td class="text-center" colspan="10">Data kosong...</td>
                                                </tr>
                                                <?php } else {
                                                    $no = $posisi+1;
                                                    $no2 = 1;
                                                    while ($r=mysqli_fetch_array($result)) {
                                                        $multiple_names = $r['toko_id'];  
                                                        $multiple_names_array = explode(',',$multiple_names);
                                                        
                                                        foreach($multiple_names_array as $resulttoko)
                                                        {
                                                          $tokos = mysqli_query($connect, "SELECT * FROM toko WHERE toko_id='$resulttoko'");
                                                          $toko      = mysqli_fetch_array($tokos);
                                                       if ($toko['toko_id'] == $_SESSION['toko_id']) {
    
                                                    $tanggal=tgl_indo($r['invoice_created']);
                                                    $invoice_price=format_rupiah($r['invoice_total']);
                                                    ?>
                                                <tr>
                                                    <td>
                                                        <?php echo $r['invoice_id'];?>
                                                    </td>
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
                                                   Ongkos Kirim : <?php echo format_rupiah($r['invoice_ongkir']/$r['invoice_totaltoko']); ?> 
                                                </td>
                                                    <td>
                                                        <?php echo $tanggal?>
                                                    </td>
                                                    <td>
                                                    <?php if ($r['invoice_statustoko'] == 'processaccept') { ?>
                                                        Menunggu Toko <br>Kirim No Resi
                                                     <?php } else if ($r['invoice_statustoko'] == 'selectdriveraccept') { ?>
                                                         Menunggu Toko <br>Pilih Driver
                                                     <?php } else if ($r['invoice_statustoko'] == 'processacceptresi') { ?>
                                                         Resi telah dikirim<br>
                                                         Menunggu Konfirmasi Admin
                                                     <?php } else if ($r['invoice_statustoko'] == 'selectdriveracceptdriver') { ?>
                                                        Driver telah dipilih<br>
                                                         Menunggu Konfirmasi Driver
                                                         <?php } else if ($r['invoice_statustoko'] == 'doneresi') { ?>
                                                   Selesai
                                                   <?php } else if ($r['invoice_statustoko'] == 'donedriver') { ?>
                                                   Selesai
                                                     <?php } else { ?>
                                                         Menunggu Konfirmasi
                                                     <?php } ?>
                                                    </td>
                                                    <td class="text-center action">
                                                    <?php if ($r['invoice_statustoko'] == 'processaccept') { ?>
                                                        <a class="btn-update" href="?module=transactiondone&act=processaccept&id=<?php echo $r['invoice_id'];?>&toko=<?php echo $toko['toko_id'];?>" data-id="<?php echo $r['invoice_id'];?>" 
                                                            title="">
                                                            <i class="icon wb-check"></i>
                                                        </a>
                                                        <?php } else if ($r['invoice_statustoko'] == 'selectdriveraccept') { ?>
                                                            <a class="btn-update" href="?module=transactiondone&act=selectdriveraccept&id=<?php echo $r['invoice_id'];?>&toko=<?php echo $toko['toko_id'];?>" data-id="<?php echo $r['invoice_id'];?>" 
                                                            title="">
                                                            <i class="icon wb-users"></i>
                                                        </a>
                                                     <?php } ?>
                                                        <a class="btn-detail" href="?module=transactiondone&act=detail&id=<?php echo $r['invoice_id'];?>">
                                                            <i class="icon wb-search"></i>
                                                        </a>
                                                    </td>
                                                    <?php $no++; }} ?>
                                                <?php }?>
                                                </tr>
                                                <?php }
                                                    $jmldata = mysqli_num_rows(mysqli_query($connect, "SELECT * FROM invoice WHERE invoice_id LIKE '%$search%' AND invoice_status='done'"));
                                                    $jmlhalaman  = $p->jumlahHalaman($jmldata, $batas);
                                                    $linkHalaman = $p->navHalaman($_GET['halaman'], $jmlhalaman);
                                            } ?>
                                    </tbody>
                                </table>
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
                    Apakah Anda yakin Pemesanan Toko ini telah selesai?
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
        case "processaccept":
        $result = mysqli_query($connect, "SELECT * FROM invoice WHERE invoice_id='$_GET[id]'");
        $p      = mysqli_fetch_array($result);
        ?>
        <form action="<?php echo $action ?>" method="post" enctype="multipart/form-data" id="exampleStandardForm" autocomplete="off">
            <div class="page-content container-fluid">
                <div class="col-md-2"></div>
                <div class="col-md-8">
                    <div class="panel">
                        <div class="panel-heading">
                            <h5 class="panel-title">Kirim No Resi #
                                <?php echo $p['invoice_id']?>
                            </h5>
                        </div>
                        <div class="panel-body container-fluid">
                            <div class="form-group form-material">
                                <label class="control-label" for="inputText">Order ID</label>
                                <input type="hidden" readonly class="form-control input-sm" id="toko_id" name="toko_id" placeholder="Masukan Order ID"
                                    value="<?php echo $_GET['toko'] ?>" required/>
                                <input type="text" readonly class="form-control input-sm" id="invoice_id" name="invoice_id" placeholder="Masukan Order ID"
                                    value="<?php echo $p['invoice_id']?>" required/>
                            </div>
                            <div class="form-group form-material">
                                <label class="control-label" for="inputText">No Resi</label>
                                <input type="text" class="form-control input-sm" id="invoice_noresi" name="invoice_noresi" placeholder="Masukan No Resi"
                                    value="" required/>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-2"></div>
                <div class="col-md-12">
                    <div class='button text-center'>
                        <input class="btn btn-primary btn-sm" type="submit" name="simpan" value="Kirim" id="validateButton2">
                        <a class="btn btn-default btn-sm" href="?module=transactiondone">Kembali</a>
                    </div>
                </div>
            </div>
        </form>
         <?php
        break;
        case "selectdriveraccept":
        $result = mysqli_query($connect, "SELECT * FROM invoice WHERE invoice_id='$_GET[id]'");
        $p      = mysqli_fetch_array($result);
        ?>
        <form action="<?php echo $action ?>" method="post" enctype="multipart/form-data" id="exampleStandardForm" autocomplete="off">
            <div class="page-content container-fluid">
                <div class="col-md-2"></div>
                <div class="col-md-8">
                    <div class="panel">
                        <div class="panel-heading">
                            <h5 class="panel-title">Pilih Driver #
                                <?php echo $p['invoice_id']?>
                            </h5>
                        </div>
                        <div class="panel-body container-fluid">
                            <div class="form-group form-material">
                                <label class="control-label" for="inputText">Order ID</label>
                                <input type="hidden" readonly class="form-control input-sm" id="toko_id" name="toko_id" placeholder="Masukan Order ID"
                                    value="<?php echo $_GET['toko'] ?>" required/>
                                <input type="text" readonly class="form-control input-sm" id="invoice_id" name="invoice_id" placeholder="Masukan Order ID"
                                    value="<?php echo $p['invoice_id']?>" required/>
                            </div>
                            <div class="form-group form-material">
                                <label class="control-label" for="inputText">Driver</label>
                                <select type="text" class="form-control input-sm" id="driver_username" name="driver_username" placeholder="Masukan Driver"
                                    value="" required/>
                                    <?php 
                                             $result=mysqli_query($connect,"SELECT * FROM driver");
                                             if(mysqli_num_rows($result) === 0) {
                                            ?>
                                <option value="">Data Kosong</option>
                                <?php } else {
                                                while ($r=mysqli_fetch_array($result)) {?>
                                <option value="<?php echo $r['driver_username'] ?>">
                                    <?php echo $r['driver_name'] ?>
                                </option>
                                <?php }
                                            } ?>
                                        </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-2"></div>
                <div class="col-md-12">
                    <div class='button text-center'>
                        <input class="btn btn-primary btn-sm" type="submit" name="simpan" value="Kirim" id="validateButton2">
                        <a class="btn btn-default btn-sm" href="?module=transactiondone">Kembali</a>
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
                                <h5 class="panel-title">Detail Pemesanan Toko #
                                    <?php echo $_GET['id'] ?>    <br>   <br><small>
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
                                                    <?php echo $invoice['invoice_address']; ?></small>
                                    <br>
                                               
                                    <small>   
                                    Jenis : <?php echo $invoice['invoice_payment']; ?> <br>
                                    Ongkos Kirim : <?php echo format_rupiah($invoice['invoice_ongkir']/$invoice['invoice_totaltoko']); ?>
                                    </small>   
                                </h5>
                            </div>
                            <div class="panel-body container-fluid table-detail">
                                <div class="table-full table-view">
                                    <div class="navigation-btn">
                                        <div class='btn-navigation'>
                                            <a class="btn btn-primary" href="?module=transactiondone">
                                                Kembali
                                            </a>
                                        </div>
                                        </form>
                                    </div>
                                    <div class="table-responsive">
                                        <table class="table table-hover">
                                            <thead>
                                                <th>ID</th>
                                                <th>Toko</th>
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
    }
?>