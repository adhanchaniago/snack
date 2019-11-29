<?php

    $action="modul/saldocancel/action.php?module=".$_GET['module']."&act=".$_GET['act'];
    switch($_GET['act']) {
        default:
        ?>

    <div class="page-content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="panel">
                    <div class="panel-heading">
                        <h5 class="panel-title">Saldo - Cancel</h5>
                    </div>
                    <div class="panel-body container-fluid table-detail">
                        <div class="table-full table-view">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <th>No</th>
                                        <th>Pelanggan</th>
                                        <th>Foto</th>
                                        <th>Alasan Cancel</th>
                                        <th>Dibuat</th>
                                        <th>Terakhir diubah</th>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if (empty(isset($_GET['filter']))) {
                                            $p      = new Paging;
                                            $batas  = 10;
                                            $posisi = $p->cariPosisi($batas);

                                            $result=mysqli_query($connect,"SELECT * FROM saldo WHERE saldo_status='cancel' ORDER BY saldo_created DESC LIMIT $posisi,$batas");
                                            $jmldata = mysqli_num_rows(mysqli_query($connect, "SELECT * FROM saldo WHERE saldo_status='cancel'"));
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
                                                    <?php echo $r['saldo_cancel']; ?>
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
                                                $jmldata = mysqli_num_rows(mysqli_query($connect, "SELECT * FROM saldo WHERE saldo_status='cancel'"));
                                                $jmlhalaman  = $p->jumlahHalaman($jmldata, $batas);
                                                $linkHalaman = $p->navHalaman($_GET['halaman'], $jmlhalaman);
                                            } else {
                                            $p      = new Paging;
                                            $batas  = 10;
                                            $posisi = $p->cariPosisi($batas);
                                            $search = $_GET['filter'];

                                            $result=mysqli_query($connect,"SELECT * FROM saldo WHERE saldo_name LIKE '%$search%' AND saldo_status='cancel' LIMIT $posisi,$batas");
                                            $jmldata = mysqli_num_rows(mysqli_query($connect, "SELECT * FROM saldo WHERE saldo_name LIKE '%$search%' AND saldo_status='cancel'"));
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
                                                    <?php echo $r['saldo_cancel']; ?>
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
                                                $jmldata = mysqli_num_rows(mysqli_query($connect, "SELECT * FROM saldo WHERE saldo_name LIKE '%$search%' AND saldo_status='cancel'"));
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
    }
?>