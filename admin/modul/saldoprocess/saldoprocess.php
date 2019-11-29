<?php

    $action="modul/saldoprocess/action.php?module=".$_GET['module']."&act=".$_GET['act'];
    switch($_GET['act']) {
        default:
        ?>

    <div class="page-content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="panel">
                    <div class="panel-heading">
                        <h5 class="panel-title">Saldo - Proses</h5>
                    </div>
                    <div class="panel-body container-fluid table-detail">
                        <div class="table-full table-view">
                            <div class="navigation-btn">
                                <form method="get" action='<?php echo $_SERVER[' PHP_SELF '] ?>'>
                                    <div class='btn-navigation'>
                                        <a class="btn btn-primary" style="margin-right: 10px;" href="?module=saldoprocess&act=add">
                                            Tambah Saldo - Proses
                                        </a>
                                        <div class='pull-right'>
                                            <a class="btn btn-primary" href="?module=saldoprocess">
                                                <i class="fa fa-refresh"></i>
                                            </a>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <th>No</th>
                                        <th>Pelanggan</th>
                                        <th>Foto</th>
                                        <th>Dibuat</th>
                                        <th>Terakhir diubah</th>
                                        <th class="text-center">Aksi</th>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if (empty(isset($_GET['filter']))) {
                                            $p      = new Paging;
                                            $batas  = 10;
                                            $posisi = $p->cariPosisi($batas);

                                            $result=mysqli_query($connect,"SELECT * FROM saldo WHERE saldo_status='process' ORDER BY saldo_created DESC LIMIT $posisi,$batas");
                                            $jmldata = mysqli_num_rows(mysqli_query($connect, "SELECT * FROM saldo WHERE saldo_status='process'"));
                                            if(mysqli_num_rows($result) === 0) {
                                    ?>
                                            <tr>
                                                <td class="text-center" colspan="10">Data kosong...</td>
                                            </tr>
                                            <?php } else {
                                                $no = $posisi+1;
                                                while ($r=mysqli_fetch_array($result)) {
                                                $tanggal=tgl_indo($r['saldo_created']);
                                                $tanggal2=tgl_indo($r['saldo_updated']);
                                                $saldo_price=format_rupiah($r['saldo_price']);
                                                ?>
                                            <tr>
                                                <td>
                                                    <?php echo $no; ?>
                                                </td>
                                                <td>
                                                    <?php 
                                                    $result2 = mysqli_query($connect, "SELECT * FROM pelanggan WHERE pelanggan_username='$r[pelanggan_username]'");
                                                    $pelanggan      = mysqli_fetch_array($result2);
                                                    ?>
                                                    <a href="?module=pelanggan&act=detail&id=<?php echo $pelanggan['pelanggan_username']; ?>">
                                                        <?php echo $pelanggan['pelanggan_name']; ?>
                                                    </a>
                                                </td>
                                                <td>
                                                    <a href="assets/images/saldo/<?php echo $r['saldo_photo'] ?>" target="_blank">
                                                        <img style="width: 100px" src="assets/images/saldo/<?php echo $r['saldo_photo'] ?>">
                                                    </a>
                                                </td>
                                                <td>
                                                    <?php echo $tanggal?>
                                                </td>
                                                <td>
                                                    <?php echo $tanggal2?>
                                                </td>
                                                <td class="text-center action">
                                                    <a class="btn-update" href="?module=saldoprocess&act=accept&id=<?php echo $r['saldo_id'];?>">
                                                        <i class="icon wb-check"></i>
                                                    </a>
                                                    <a class="btn-detail" href="?module=saldoprocess&act=cancel&id=<?php echo $r['saldo_id'];?>">
                                                        <i class="icon wb-close"></i>
                                                    </a>
                                                </td>
                                                <?php $no++; } ?>
                                            </tr>
                                            <?php }
                                                $jmldata = mysqli_num_rows(mysqli_query($connect, "SELECT * FROM saldo WHERE saldo_status='process'"));
                                                $jmlhalaman  = $p->jumlahHalaman($jmldata, $batas);
                                                $linkHalaman = $p->navHalaman($_GET['halaman'], $jmlhalaman);
                                            } else {
                                            $p      = new Paging;
                                            $batas  = 10;
                                            $posisi = $p->cariPosisi($batas);
                                            $search = $_GET['filter'];

                                            $result=mysqli_query($connect,"SELECT * FROM saldo WHERE saldo_name LIKE '%$search%' AND saldo_status='process' LIMIT $posisi,$batas");
                                            $jmldata = mysqli_num_rows(mysqli_query($connect, "SELECT * FROM saldo WHERE saldo_name LIKE '%$search%' AND saldo_status='process'"));
                                            if(mysqli_num_rows($result) === 0) {
                                    ?>
                                            <tr>
                                                <td class="text-center" colspan="10">Pencarian tidak ditemukan...</td>
                                            </tr>
                                            <?php } else {
                                                $no = $posisi+1;
                                                while ($r=mysqli_fetch_array($result)) {
                                                $tanggal=tgl_indo($r['saldo_created']);
                                                $tanggal2=tgl_indo($r['saldo_updated']);
                                                $saldo_price=format_rupiah($r['saldo_price']);
                                                ?>
                                            <tr>
                                                                <td>
                                                    <?php echo $no; ?>
                                                </td>
                                                <td>
                                                    <?php 
                                                    $result2 = mysqli_query($connect, "SELECT * FROM pelanggan WHERE pelanggan_username='$r[pelanggan_username]'");
                                                    $pelanggan      = mysqli_fetch_array($result2);
                                                    ?>
                                                    <a href="?module=pelanggan&act=detail&id=<?php echo $pelanggan['pelanggan_username']; ?>">
                                                        <?php echo $pelanggan['pelanggan_name']; ?>
                                                    </a>
                                                </td>
                                                <td>
                                                    <a href="assets/images/saldo/<?php echo $r['saldo_photo'] ?>" target="_blank">
                                                        <img style="width: 100px" src="assets/images/saldo/<?php echo $r['saldo_photo'] ?>">
                                                    </a>
                                                </td>
                                                <td>
                                                    <?php echo $tanggal?>
                                                </td>
                                                <td>
                                                    <?php echo $tanggal2?>
                                                </td>
                                                <td class="text-center action">
                                                    <a class="btn-update" href="?module=saldoprocess&act=accept&id=<?php echo $r['saldo_id'];?>">
                                                        <i class="icon wb-check"></i>
                                                    </a>
                                                    <a class="btn-detail" href="?module=saldoprocess&act=cancel&id=<?php echo $r['saldo_id'];?>">
                                                        <i class="icon wb-close"></i>
                                                    </a>
                                                </td>
                                                <?php $no++; } ?>
                                            </tr>
                                            <?php }
                                                $jmldata = mysqli_num_rows(mysqli_query($connect, "SELECT * FROM saldo WHERE saldo_name LIKE '%$search%' AND saldo_status='process'"));
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
        case "cancel":
        $result = mysqli_query($connect, "SELECT * FROM saldo WHERE saldo_id='$_GET[id]'");
        $p      = mysqli_fetch_array($result);
        ?>
        <form action="<?php echo $action ?>" method="post" enctype="multipart/form-data" id="exampleStandardForm" autocomplete="off">
            <div class="page-content container-fluid">
                <div class="col-md-2"></div>
                <div class="col-md-8">
                    <div class="panel">
                        <div class="panel-heading">
                            <h5 class="panel-title">Cancel Isi Saldo #
                                <?php echo $p['saldo_id']?>
                            </h5>
                        </div>
                        <div class="panel-body container-fluid">
                            <div class="form-group form-material">
                                <label class="control-label" for="inputText">Order ID</label>
                                <input type="text" readonly class="form-control input-sm" id="saldo_id" name="saldo_id" placeholder="Masukan Order ID"
                                    value="<?php echo $p['saldo_id']?>" required/>
                            </div>
                            <div class="form-group form-material">
                                <label class="control-label" for="inputText">Alasan Cancel</label>
                                <input type="text" class="form-control input-sm" id="saldo_cancel" name="saldo_cancel" placeholder="Masukan Alasan Cancel"
                                    value="" required/>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-2"></div>
                <div class="col-md-12">
                    <div class='button text-center'>
                        <input class="btn btn-primary btn-sm" type="submit" name="simpan" value="Cancel Isi Saldo" id="validateButton2">
                        <a class="btn btn-default btn-sm" href="?module=saldoprocess">Kembali</a>
                    </div>
                </div>
            </div>
        </form>
        <?php
        break;
        case "accept":
        $result = mysqli_query($connect, "SELECT * FROM saldo WHERE saldo_id='$_GET[id]'");
        $p      = mysqli_fetch_array($result);
        ?>
        <form action="<?php echo $action ?>" method="post" enctype="multipart/form-data" id="exampleStandardForm" autocomplete="off">
            <div class="page-content container-fluid">
                <div class="col-md-2"></div>
                <div class="col-md-8">
                    <div class="panel">
                        <div class="panel-heading">
                            <h5 class="panel-title">Isi Saldo #
                                <?php echo $p['saldo_id']?>
                            </h5>
                        </div>
                        <div class="panel-body container-fluid">
                            <div class="form-group form-material">
                                <label class="control-label" for="inputText">Order ID</label>
                                <input type="text" readonly class="form-control input-sm" id="saldo_id" name="saldo_id" placeholder="Masukan Order ID"
                                    value="<?php echo $p['saldo_id']?>" required/>
                            </div>
                            <div class="form-group form-material">
                                <label class="control-label" for="inputText">Pelanggan Username</label>
                                <input type="text" readonly class="form-control input-sm" id="pelanggan_username" name="pelanggan_username" placeholder=""
                                    value="<?php echo $p['pelanggan_username']?>" required/>
                            </div>
                            <div class="form-group form-material">
                                <label class="control-label" for="inputText">Total Isi Saldo</label>
                                <input type="text" class="form-control input-sm" id="saldo_price" name="saldo_price" placeholder="Masukan Total isi Saldo"
                                    value="" required/>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-2"></div>
                <div class="col-md-12">
                    <div class='button text-center'>
                        <input class="btn btn-primary btn-sm" type="submit" name="simpan" value="Isi Saldo" id="validateButton2">
                        <a class="btn btn-default btn-sm" href="?module=saldoprocess">Kembali</a>
                    </div>
                </div>
            </div>
        </form>
    <?php
        break;
        case "add":
        ?>

        <form action="<?php echo $action ?>" method="post" enctype="multipart/form-data" id="exampleStandardForm" autocomplete="off">
            <div class="page-content container-fluid">
                <div class="col-md-6 col-md-offset-3">
                    <div class="panel">
                        <div class="panel-heading">
                            <h5 class="panel-title">Tambah Saldo - Proses</h5>
                        </div>
                        <div class="panel-body container-fluid">
                            <div class="form-group form-material">
                                <label class="control-label" for="inputText">Pelanggan</label>
                                <select type="text" class="form-control input-sm" id="pelanggan_username" name="pelanggan_username" placeholder="Masukan Kategori"
                                    value="" required/>
                                <?php 
                                             $result=mysqli_query($connect,"SELECT * FROM pelanggan");
                                             if(mysqli_num_rows($result) === 0) {
                                            ?>
                                <option value="">Data Kosong</option>
                                <?php } else {
                                                while ($r=mysqli_fetch_array($result)) {?>
                                <option value="<?php echo $r['pelanggan_username'] ?>">
                                    <?php echo $r['pelanggan_name'] ?>
                                </option>
                                <?php }
                                            } ?>
                                </select>
                            </div>
                            <div class="form-material">
                                <label class="control-label" for="inputText">Bukti Pembayaran</label>
                            </div>
                            <input name="fupload" type="file" class="form-control" id="fupload" required/>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class='button text-center'>
                        <input class="btn btn-primary btn-sm" type="submit" name="simpan" value="Tambah Data" id="validateButton2">
                        <a class="btn btn-default btn-sm" href="?module=saldoprocess">Kembali</a>
                    </div>
                </div>
            </div>
        </form>

        <?php
        break;
    }
?>