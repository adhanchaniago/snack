<?php
if (empty($_SESSION['pelanggan_username']) AND empty($_SESSION['pelanggan_password'])){ ?>
    <div class="page-content container-fluid">
        <div class="col-md-12">
            <div class="panel">
                <div class="panel-heading">
                    <h5 class="panel-title text-center">
                        Silahkan Masuk Terlebih dahulu
                        <div style="padding-top: 20px;">
                            <a class="btn btn-danger" href="?module=login">
                                Masuk
                            </a>
                        </div>
                    </h5>
                </div>
            </div>
        </div>
    </div>
    <?php } else { ?>
    <div class="page-content container-fluid" style="min-height: 430px">
        <div class="col-md-12">
                                    <?php 
                                    if(!empty($_SESSION["payment"])) {?>
                                      <form action="modul/cart/deletepayment.php" method="post" enctype="multipart/form-data" id="exampleStandardForm" autocomplete="off">
                <div class="panel">
                    <div class="panel-heading">
                        <h5 class="panel-title">Informasi Pembayaran</h5>
                    </div>  
                    <div class="panel-body container-fluid">
                        <input class="btn btn-primary" type="submit" name="simpan" value="Ubah Jenis Pembayaran">
                    </div>
            </div>    
                                </form>
            <div class="panel">
                <div class="panel-body container-fluid table-detail">
                    <div class="table-full table-view">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <th width=50>No</th>
                                    <th width=400>Nama</th>
                                    <th>Harga</th>
                                    <th width=200>QTY</th>
                                    <th>Total Harga</th>
                                </thead>
                                <tbody>
                                    <?php } ?>
                                    <?php 
                                    if(!empty($_SESSION["cart"])) {
                                        foreach ($_SESSION["cart"] as $menu_id => $qty): 
                                        $menu_totalprice=$qty*$r['menu_price'];
                                      $total += $menu_totalprice;
                                        endforeach;

                                    if(empty($_SESSION["payment"])) {?>
                                        <form action="modul/cart/addpayment.php" method="post" enctype="multipart/form-data" id="exampleStandardForm" autocomplete="off">
            <div class="col-md-6 col-md-offset-3">
                <div class="panel">
                    <div class="panel-heading">
                        <h5 class="panel-title">Informasi Pembayaran</h5>
                    </div>  
                    <div class="panel-body container-fluid">
                        <div class="form-group form-material">
                            <label class="control-label" for="inputText">Jenis Pembayaran</label>
                            <select type="text" class="form-control input-sm" id="invoice_payment" name="invoice_payment" required/>
                                <option value="Transfer Bank">Transfer Bank</option>
                                <?php 
                                
        $result = mysqli_query($connect, "SELECT * FROM pelanggan WHERE pelanggan_username='$_SESSION[pelanggan_username]'");
        $p      = mysqli_fetch_array($result);
        ?>
                                <?php if ($p['pelanggan_saldo'] > $total) { ?>
                                <option value="<?php echo $p['pelanggan_saldo']; ?>">Saldo (RP<?php echo format_rupiah($p['pelanggan_saldo']); ?>,00)</option>
                                <?php } else { ?>
                                    <option value="">Saldo Tidak Cukup - (RP<?php echo format_rupiah($p['pelanggan_saldo']) ?>,00)</option>
                                <?php } ?>
                                <option value="COD">COD</option>
                                </select>
                        </div>
                      
                        <input class="btn btn-primary" type="submit" name="simpan" value="Pilih">
                    </div>
            </div>    
                </div>
                                </form>
                                <?php } else { 
                            
                                        $no = 1;
                                        $total = 0;
                                        $totalItem = 0;
                                        $totalWeight = 0;
                                        $array = array();
                                        foreach ($_SESSION["cart"] as $menu_id => $qty): ?>

                                    <?php
                                        $result = mysqli_query($connect, "SELECT * FROM menu WHERE menu_id='$menu_id'");
                                        $r      = mysqli_fetch_array($result);
                                        if (count($array) > 0) {
                                        foreach ($array as $toko_id => $a): 
                                            if ($a != $r['toko_id']) {
                                                array_push($array, $r['toko_id']);
                                            }
                                        endforeach;
                                    } else {
                                        array_push($array, $r['toko_id']);
                                    }
                                        $tanggal=tgl_indo($r['menu_created']);
                                        $menu_price=format_rupiah($r['menu_price']);
                                        $menu_totalprice=$qty*$r['menu_price'];
                                        $menu_totalitem=$qty;
                                        $menu_totalweight=$qty*$r['menu_weight'];
                                        ?>

                                        <tr>
                                            <td>
                                                <?php echo $no;?>   
                                            </td>
                                            <td>
                                            <?php echo $r['menu_name'];?><br>
                                            <?php 
                                                    $result2 = mysqli_query($connect, "SELECT * FROM toko WHERE toko_id='$r[toko_id]'");
                                                    $toko      = mysqli_fetch_array($result2);
                                                    ?>
                                                    Toko: <a href="?module=toko&act=detail&id=<?php echo $toko['toko_id']; ?>">
                                                       <?php echo $toko['toko_name']; ?>
                                                    </a>
                                            </td>
                                            <td>
                                                Rp
                                                <?php echo $menu_price;?>
                                            </td>
                                            <td>
                                                <?php echo $qty;?>
                                            </td>
                                            <td>
                                                Rp
                                                <?php echo format_rupiah($menu_totalprice);?>
                                            </td>
                                            <?php $no++;  ?>
                                            <?php $total += $menu_totalprice  ?>
                                            <?php $totalItem += $menu_totalitem  ?>
                                            <?php $totalWeight += $menu_totalweight  ?>
                                            <?php endforeach ?>
                                        </tr>
                                        <?php
                                     
                                            ?>
                                </tbody>
                                <?php 
                                    if(!empty($_SESSION["cart"]) OR isset($_SESSION["cart"])) {
                                        if(!empty($_SESSION["payment"])) {
                            ?>
                                <tbody>
                                    <tr>
                                        <td colspan="4">Total Belanja</td>
                                        <td colspan="2">Rp
                                            <?php echo format_rupiah($total) ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="4">Total Item</td>
                                        <td colspan="2">
                                            <?php echo $totalItem ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="4">Total Berat</td>
                                        <td colspan="2">
                                            <?php echo $totalWeight ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="4">Jenis Pembayaran</td>
                                        <td colspan="2">
                                        <?php if ($_SESSION['payment'] == 'Transfer Bank') { ?>
                                            <?php echo $_SESSION['payment'] ?>
                                        <?php } else if ($_SESSION['payment'] == 'COD') { ?>
                                            <?php echo $_SESSION['payment'] ?>
                                        <?php } else { 
                       $result = mysqli_query($connect, "SELECT * FROM pelanggan WHERE pelanggan_username='$_SESSION[pelanggan_username]'");
                       $p      = mysqli_fetch_array($result);
                       ?>
                                            Saldo - Rp<?php echo format_rupiah($p['pelanggan_saldo']) ?>,00
                                        <?php } ?>
                                        </td>
                                    </tr>
                                </tbody>
                                <?php } }?>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php 
                                    if(!empty($_SESSION["cart"]) OR isset($_SESSION["cart"])) {
                                        if(!empty($_SESSION["payment"])) {
                            ?>
        <form action="modul/checkout/action.php?module=checkout" method="post" enctype="multipart/form-data" id="exampleStandardForm"
            autocomplete="off">
            <div class="col-md-6">
                <div class="panel">
                    <div class="panel-heading">
                        <h5 class="panel-title">Alamat Pengiriman</h5>
                    </div>
                    <div class="panel-body container-fluid">
                        <input type="hidden" name="pelanggan_username" value="<?php echo $_SESSION['pelanggan_username'] ?>" />
                        <input type="hidden" name="invoice_total" value="<?php echo $total ?>" />
                        <input type="hidden" name="invoice_weight" value="<?php echo $totalWeight ?>" />
                        <input type="hidden" name="invoice_totaltoko" value="<?php echo count($array) ?>" />
                        <input type="hidden" name="invoice_item" value="<?php echo $totalItem ?>" />
                        <div class="form-group form-material">
                            <label class="control-label" for="inputText">Nama</label>
                            <input type="text" class="form-control input-sm" id="pelanggan_name" name="pelanggan_name" placeholder="Masukan Nama" value="<?php echo $_SESSION['pelanggan_name'] ?>"
                                disabled required/>
                        </div>
                        <div class="form-group form-material">
                            <label class="control-label" for="inputText">No Telp</label>
                            <input type="text" class="form-control input-sm" id="pelanggan_notelp" name="pelanggan_notelp" placeholder="Masukan No Telp"
                                disabled value="<?php echo $_SESSION['pelanggan_notelp'] ?>" required/>
                        </div>
                        <div class="form-group form-material">
                            <label class="control-label" for="inputText">Alamat Lengkap</label>
                            <input type="text" class="form-control input-sm" id="invoice_address" name="invoice_address" placeholder="Masukan Alamat Lengkap dengan pengiriman (Termasuk Kode Pos)"
                                value="" required/>
                        </div>
                    </div>
                </div>
            </div>
            <?php if ($_SESSION['payment'] == 'Transfer Bank') { ?>
            <div class="col-md-6">
                <div class="panel">
                    <div class="panel-heading">
                        <h5 class="panel-title">Ongkos Kirim</h5>
                    </div>
                    <div class="panel-body container-fluid">
                        <div class="form-group form-material">
                            <label class="control-label" for="inputText">Pilih Kota Anda: Ongkos Kirim * (Total Toko) atau Pilih Menggunakan Driver<br>Total Toko: <?php echo count($array);?> </label>
                            <select type="text" class="form-control input-sm" id="invoice_ongkir" name="invoice_ongkir" required/>
                                <?php 
                                             $result=mysqli_query($connect,"SELECT * FROM ongkir");
                                             if(mysqli_num_rows($result) === 0) {
                                            ?>
                                <option value="">Data Kosong</option>
                                <?php } else {
                                                while ($r=mysqli_fetch_array($result)) {?>
                                <option value="<?php echo $r['ongkir_price'] ?>">
                                <?php echo $r['ongkir_city'] ?> - <?php echo $r['ongkir_price'] ?>
                                </option>
                                <?php }
                                            } ?> <option value="<?php echo $w['identitas_id'] ?>">
                                          Driver - <?php echo $w['identitas_cod'] ?>   </option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
                                        <?php } else if ($_SESSION['payment'] == 'COD') { ?>
           
                                            <div class="col-md-6">
                                            <div class="panel">
                                                <div class="panel-heading">
                                                    <h5 class="panel-title">Informasi Pemesanan</h5>
                                                </div>
                                                <div class="panel-body container-fluid">
                                                    <div class="form-group form-material">
                                                        <label class="control-label" for="inputText">Tanggal COD</label>
                                                        <input type="date" class="form-control input-sm" id="invoice_date" name="invoice_date" placeholder="Masukan Tanggal Pemesanan" value=""
                                                         required/>
                                                    </div>
                                                    <div class="form-group form-material">
                                                        <label class="control-label" for="inputText">Jam COD (Contoh: 13:00)</label>
                                                        <input type="text" class="form-control input-sm" id="invoice_clock" name="invoice_clock" placeholder="Masukan Jam Pemesanan (Contoh: 13:00)" value=""
                                                         required/>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
            <?php } else { ?>
                <div class="col-md-6">
                <div class="panel">
                    <div class="panel-heading">
                        <h5 class="panel-title">Ongkos Kirim</h5>
                    </div>
                    <div class="panel-body container-fluid">
                        <div class="form-group form-material">
                            <label class="control-label" for="inputText">Pilih Kota Anda: Ongkos Kirim * (Total Toko) atau Pilih Menggunakan Driver<br>Total Toko: <?php echo count($array);?> </label>
                            <select type="text" class="form-control input-sm" id="invoice_ongkir" name="invoice_ongkir" required/>
                                <?php 
                                             $result=mysqli_query($connect,"SELECT * FROM ongkir");
                                             if(mysqli_num_rows($result) === 0) {
                                            ?>
                                <option value="">Data Kosong</option>
                                <?php } else {
                                                while ($r=mysqli_fetch_array($result)) {?>
                                <option value="<?php echo $r['ongkir_price'] ?>">
                                <?php echo $r['ongkir_city'] ?> - <?php echo $r['ongkir_price'] ?>
                                </option>
                                <?php }
                                            } ?> <option value="<?php echo $w['identitas_id'] ?>">
                                          Driver - <?php echo $w['identitas_cod'] ?>   </option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <?php } ?>
            <div class="col-md-12">
                <div class='button text-center'>
                    <input class="btn btn-success btn-sm" type="submit" name="simpan" value="Konfirmasi" id="validateButton2">
                </div>
            </div>
        </form>
        <?php } }}?>
    </div>
    <?php }  else { ?>
        <div class="col-md-12">
            <div class="panel">
                <div class="panel-heading">
                    <h5 class="panel-title text-center">
                        Data Keranjang Kosong..
                    </h5>
                </div>
            </div>
        </div>
    </div>
     <?php } } ?>