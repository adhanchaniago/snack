<?php

    $action="modul/saldodriver/action.php?module=".$_GET['module']."&act=".$_GET['act'];
    switch($_GET['act']) {
        default:
        ?>

    <div class="page-content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="panel">
                    <div class="panel-heading">
                        <h5 class="panel-title">Saldo - Driver</h5>
                    </div>
                    <div class="panel-body container-fluid table-detail">
                        <div class="table-full table-view">
                            <div class="navigation-btn">
                                <form method="get" action='<?php echo $_SERVER[' PHP_SELF '] ?>'>
                                    <div class='btn-navigation'>
                                        <div class='pull-right'>
                                            <a class="btn btn-primary" href="?module=saldodriver">
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
                                        <th>Foto</th>
                                        <th>Total Saldo</th>
                                        <th>Dibuat</th>
                                        <th>Terakhir diubah</th>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if (empty(isset($_GET['filter']))) {
                                            $p      = new Paging;
                                            $batas  = 10;
                                            $posisi = $p->cariPosisi($batas);

                                            $result=mysqli_query($connect,"SELECT * FROM saldodriver WHERE driver_username='$_SESSION[driver_username]' ORDER BY saldodriver_created DESC LIMIT $posisi,$batas");
                                            $jmldata = mysqli_num_rows(mysqli_query($connect, "SELECT * FROM saldodriver WHERE driver_username='$_SESSION[driver_username]'"));
                                            if(mysqli_num_rows($result) === 0) {
                                    ?>
                                            <tr>
                                                <td class="text-center" colspan="10">Data kosong...</td>
                                            </tr>
                                            <?php } else {
                                                $no = $posisi+1;
                                                while ($r=mysqli_fetch_array($result)) {
                                                $tanggal=tgl_indo($r['saldodriver_created']);
                                                $tanggal2=tgl_indo($r['saldodriver_updated']);
                                                $saldodriver_price=format_rupiah($r['saldodriver_price']);
                                                ?>
                                            <tr>
                                                <td>
                                                    <?php echo $no; ?>
                                                </td>
                                                <td>
                                                    <a href="../admin/assets/images/saldo/<?php echo $r['saldodriver_photo'] ?>" target="_blank">
                                                        <img style="width: 100px" src="../admin/assets/images/saldo/<?php echo $r['saldodriver_photo'] ?>">
                                                    </a>
                                                </td>
                                                <td>
                                                    Rp<?php echo format_rupiah($saldodriver_price);?>,00
                                                </td>
                                                <td>
                                                    <?php echo $tanggal?>
                                                </td>
                                                <td>
                                                    <?php echo $tanggal2?>
                                                </td>
                                                <?php $no++; } ?>
                                            </tr>
                                            <?php }
                                                $jmldata = mysqli_num_rows(mysqli_query($connect, "SELECT * FROM saldodriver WHERE driver_username='$_SESSION[driver_username]'"));
                                                $jmlhalaman  = $p->jumlahHalaman($jmldata, $batas);
                                                $linkHalaman = $p->navHalaman($_GET['halaman'], $jmlhalaman);
                                            } else {
                                            $p      = new Paging;
                                            $batas  = 10;
                                            $posisi = $p->cariPosisi($batas);
                                            $search = $_GET['filter'];

                                            $result=mysqli_query($connect,"SELECT * FROM saldodriver WHERE driver_username='$_SESSION[driver_username]' WHERE saldodriver_name LIKE '%$search%' AND saldodriver_status='process' LIMIT $posisi,$batas");
                                            $jmldata = mysqli_num_rows(mysqli_query($connect, "SELECT * FROM saldodriver WHERE driver_username='$_SESSION[driver_username]' WHERE saldodriver_name LIKE '%$search%' AND saldodriver_status='process'"));
                                            if(mysqli_num_rows($result) === 0) {
                                    ?>
                                            <tr>
                                                <td class="text-center" colspan="10">Pencarian tidak ditemukan...</td>
                                            </tr>
                                            <?php } else {
                                                $no = $posisi+1;
                                                while ($r=mysqli_fetch_array($result)) {
                                                $tanggal=tgl_indo($r['saldodriver_created']);
                                                $tanggal2=tgl_indo($r['saldodriver_updated']);
                                                $saldodriver_price=format_rupiah($r['saldodriver_price']);
                                                ?>
                                            <tr>
                                                                <td>
                                                    <?php echo $no; ?>
                                                </td>
                                                <td>
                                                    <?php 
                                                    $result2 = mysqli_query($connect, "SELECT * FROM driver WHERE driver_username='$r[driver_username]'");
                                                    $driver      = mysqli_fetch_array($result2);
                                                    ?>
                                                    <a href="?module=driver&act=detail&id=<?php echo $driver['driver_username']; ?>">
                                                        <?php echo $driver['driver_name']; ?>
                                                    </a>
                                                </td>
                                                <td>
                                                    <a href="../admin/assets/images/saldo/<?php echo $r['saldodriver_photo'] ?>" target="_blank">
                                                        <img style="width: 100px" src="../admin/assets/images/saldo/<?php echo $r['saldodriver_photo'] ?>">
                                                    </a>
                                                </td>
                                                <td>
                                                    Rp<?php echo format_rupiah($saldodriver_price);?>,00
                                                </td>
                                                <td>
                                                    <?php echo $tanggal?>
                                                </td>
                                                <td>
                                                    <?php echo $tanggal2?>
                                                </td>
                                                <?php $no++; } ?>
                                            </tr>
                                            <?php }
                                                $jmldata = mysqli_num_rows(mysqli_query($connect, "SELECT * FROM saldodriver WHERE driver_username='$_SESSION[driver_username]' WHERE saldodriver_name LIKE '%$search%' AND saldodriver_status='process'"));
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
        case "add":
        ?>
        <form action="<?php echo $action ?>" method="post" enctype="multipart/form-data" id="exampleStandardForm" autocomplete="off">
            <div class="page-content container-fluid">
                <div class="col-md-6 col-md-offset-3">
                    <div class="panel">
                        <div class="panel-heading">
                            <h5 class="panel-title">Tambah Saldo - Driver</h5>
                        </div>
                        <div class="panel-body container-fluid">
                            <div class="form-group form-material">
                                <label class="control-label" for="inputText">Driver</label>
                                <select type="text" class="form-control input-sm" id="driver_username" name="driver_username" placeholder="Masukan Kategori"
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
                            <div class="form-group form-material">
                                <label class="control-label" for="inputText">Jumlah Transfer</label>
                                <input type="text" class="form-control input-sm" id="saldodriver_price" name="saldodriver_price" placeholder="Masukan Jumlah Transfer"
                                    value="" required/>
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
                        <a class="btn btn-default btn-sm" href="?module=saldodriver">Kembali</a>
                    </div>
                </div>
            </div>
        </form>

        <?php
        break;
    }
?>