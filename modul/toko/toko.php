<?php
 if (empty($_SESSION['pelanggan_username']) AND empty($_SESSION['pelanggan_password'])){
    echo "<script>location='media.php?module=home';</script>";
} else { 
    $action="modul/toko/action.php?module=".$_GET['module']."&act=".$_GET['act'];
    switch($_GET['act']) {
        default:
        
        ?>

    <div class="page-content container-fluid" style="min-height: 430px">
        <div class="row">
            <div class="col-md-12">
                <div class="panel">
                    <div class="panel-heading">
                        <h5 class="panel-title">Toko Anda</h5>
                    </div>
                    <div class="panel-body container-fluid table-detail">
                        <div class="table-full table-view">
                            <div class="navigation-btn">
                                    <div class='btn-navigation'>
                                        <a class="btn btn-primary" style="margin-right: 10px;" href="?module=saldotoko">
                                            Saldo - Toko
                                        </a>
                                        <a class="btn btn-primary" style="margin-right: 10px;" href="?module=transactionprocess">
                                            Kelola Transaksi
                                        </a>
                                        <a class="btn btn-primary" style="margin-right: 10px;" href="?module=menu">
                                            Kelola Menu
                                        </a>
                                    </div>
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <th>No</th>
                                        <th>Pelanggan</th>
                                        <th>Toko</th>
                                        <th>Bank</th>
                                        <th>Status</th>
                                        <th>Dibuat</th>
                                        <th class="text-center">Aksi</th>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if (empty(isset($_GET['filter']))) {
                                            $p      = new Paging;
                                            $batas  = 10;
                                            $posisi = $p->cariPosisi($batas);

                                            $result=mysqli_query($connect,"SELECT * FROM toko WHERE pelanggan_username='$_SESSION[pelanggan_username]'");
                                            $jmldata = mysqli_num_rows(mysqli_query($connect, "SELECT * FROM toko WHERE pelanggan_username='$_SESSION[pelanggan_username]'"));
                                            if(mysqli_num_rows($result) === 0) {
                                    ?>
                                            <tr>
                                                <td class="text-center" colspan="10">Data kosong...</td>
                                            </tr>
                                            <?php } else {
                                                $no = $posisi+1;
                                                while ($r=mysqli_fetch_array($result)) {
                                                ?>
                                            <tr>
                                                <td>
                                                    <?php echo $no; ?>
                                                </td>
                                                <td>
                                                    <?php 
                                                    $result2 = mysqli_query($connect, "SELECT * FROM pelanggan WHERE pelanggan_username='$r[pelanggan_username]'");
                                                    $pelanggan      = mysqli_fetch_array($result2);
                                                    ?> Username :
                                                    <a href="?module=pelanggan&act=detail&id=<?php echo $pelanggan['pelanggan_username']; ?>">
                                                        <?php echo $pelanggan['pelanggan_username']; ?>
                                                    </a>
                                                    <br> Nama :
                                                    <?php echo $pelanggan['pelanggan_name']; ?>
                                                    <br> Alamat :
                                                    <?php echo $pelanggan['pelanggan_alamat']; ?>
                                                    <br> No Telp :
                                                    <?php echo $pelanggan['pelanggan_notelp']; ?>
                                                </td>
                                                <td>
                                                    Toko:
                                                    <?php echo $r['toko_name'];?>
                                                    <br> Deskripsi:
                                                    <?php echo $r['toko_deskripsi'];?>
                                                </td>
                                                <td>
                                                    Bank:
                                                    <?php echo $r['toko_bank'];?>
                                                    <br> Atas Nama:
                                                    <?php echo $r['toko_owner'];?>
                                                    <br> No Rek:
                                                    <?php echo $r['toko_noaccount'];?>
                                                </td>
                                                <td>
                                                    <?php echo $r['toko_status'];?>
                                                </td>
                                                <td>
                                                    Dibuat:
                                                    <?php echo tgl_indo($r['toko_created']); ?>
                                                    <br> Terakhir diubah:
                                                    <?php echo tgl_indo($r['toko_updated']); ?>
                                                </td>
                                                <td class="text-center action">
                                                    <?php if ($r['toko_status'] == 'Close') { ?>
                                                    <a class="btn-update" href="modul/toko/action.php?module=toko&act=open&id=<?php echo $r['toko_id'];?>">
                                                        <i class="icon wb-check"></i>
                                                    </a>
                                                    <?php } else { ?>
                                                    <a class="btn-update" href="modul/toko/action.php?module=toko&act=close&id=<?php echo $r['toko_id'];?>">
                                                        <i class="icon wb-close"></i>
                                                    </a>
                                                    <?php } ?>
                                                    <a class="btn-update" href="?module=toko&act=edit&id=<?php echo $r['toko_id'];?>">
                                                        <i class="icon wb-pencil"></i>
                                                    </a>
                                                    <a class="btn-detail" href="?module=toko&act=detail&id=<?php echo $r['toko_id'];?>">
                                                        <i class="icon wb-search"></i>
                                                    </a>
                                                </td>
                                                <?php $no++; } ?>
                                            </tr>
                                            <?php }
                                                $jmldata = mysqli_num_rows(mysqli_query($connect, "SELECT * FROM toko WHERE pelanggan_username='$_SESSION[pelanggan_username]'"));
                                                $jmlhalaman  = $p->jumlahHalaman($jmldata, $batas);
                                                $linkHalaman = $p->navHalaman($_GET['halaman'], $jmlhalaman);
                                            } else {
                                            $p      = new Paging;
                                            $batas  = 10;
                                            $posisi = $p->cariPosisi($batas);
                                            $search = $_GET['filter'];

                                            $result=mysqli_query($connect,"SELECT * FROM toko WHERE pelanggan_username='$_SESSION[pelanggan_username]' WHERE toko_name LIKE '%$search%' LIMIT $posisi,$batas");
                                            $jmldata = mysqli_num_rows(mysqli_query($connect, "SELECT * FROM toko WHERE pelanggan_username='$_SESSION[pelanggan_username]' WHERE toko_name LIKE '%$search%'"));
                                            if(mysqli_num_rows($result) === 0) {
                                    ?>
                                            <tr>
                                                <td class="text-center" colspan="10">Pencarian tidak ditemukan...</td>
                                            </tr>
                                            <?php } else {
                                                $no = $posisi+1;
                                                while ($r=mysqli_fetch_array($result)) {
                                                $tanggal=tgl_indo($r['toko_created']);
                                                ?>
                                            <tr>
                                                <td>
                                                    <?php echo $no; ?>
                                                </td>
                                                <td>
                                                    <?php 
                                                    $result2 = mysqli_query($connect, "SELECT * FROM pelanggan WHERE pelanggan_username='$r[pelanggan_username]'");
                                                    $pelanggan      = mysqli_fetch_array($result2);
                                                    ?> Username :
                                                    <a href="?module=pelanggan&act=detail&id=<?php echo $pelanggan['pelanggan_username']; ?>">
                                                        <?php echo $pelanggan['pelanggan_username']; ?>
                                                    </a>
                                                    <br> Nama :
                                                    <?php echo $pelanggan['pelanggan_name']; ?>
                                                    <br> Alamat :
                                                    <?php echo $pelanggan['pelanggan_alamat']; ?>
                                                    <br> No Telp :
                                                    <?php echo $pelanggan['pelanggan_notelp']; ?>
                                                </td>
                                                <td>
                                                    Toko:
                                                    <?php echo $r['toko_name'];?>
                                                    <br> Deskripsi:
                                                    <?php echo $r['toko_deskripsi'];?>
                                                </td>
                                                <td>
                                                    Bank:
                                                    <?php echo $r['toko_bank'];?>
                                                    <br> Atas Nama:
                                                    <?php echo $r['toko_owner'];?>
                                                    <br> No Rek:
                                                    <?php echo $r['toko_noaccount'];?>
                                                </td>
                                                <td>
                                                    <?php echo $r['toko_status'];?>
                                                </td>
                                                <td>
                                                    Dibuat:
                                                    <?php echo tgl_indo($r['toko_created']); ?>
                                                    <br> Terakhir diubah:
                                                    <?php echo tgl_indo($r['toko_updated']); ?>
                                                </td>
                                                <td class="text-center action">
                                                <?php if ($r['toko_status'] == 'Close') { ?>
                                                    <a class="btn-update" href="modul/toko/action.php?module=toko&act=open&id=<?php echo $r['toko_id'];?>">
                                                        <i class="icon wb-check"></i>
                                                    </a>
                                                    <?php } else { ?>
                                                    <a class="btn-update" href="modul/toko/action.php?module=toko&act=close&id=<?php echo $r['toko_id'];?>">
                                                        <i class="icon wb-close"></i>
                                                    </a>
                                                    <?php } ?>
                                                    <a class="btn-update" href="?module=toko&act=edit&id=<?php echo $r['toko_id'];?>">
                                                        <i class="icon wb-pencil"></i>
                                                    </a>
                                                    <a class="btn-detail" href="?module=toko&act=detail&id=<?php echo $r['toko_id'];?>">
                                                        <i class="icon wb-search"></i>
                                                    </a>
                                                    <a class="btn-delete" href="javascript:;" data-id="<?php echo $r['toko_id'];?>" data-toggle="modal" data-target="#modal-konfirmasi"
                                                        title="">
                                                        <i class="icon wb-trash"></i>
                                                    </a>
                                                </td>
                                                <?php $no++; } ?>
                                            </tr>
                                            <?php }
                                                $jmldata = mysqli_num_rows(mysqli_query($connect, "SELECT * FROM toko WHERE pelanggan_username='$_SESSION[pelanggan_username]' WHERE toko_name LIKE '%$search%'"));
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

                <div class="modal-body" style="background:#d9534f;color:#fff">
                    Apakah Anda yakin ingin menghapus data ini?
                </div>

                <div class="modal-footer">
                    <a href="javascript:;" class="btn btn-danger" id="delete-toko">Ya</a>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Tidak</button>
                </div>

            </div>
        </div>
    </div>
    <!-- ========== End Modal Konfirmasi ========== -->
    <?php
        break;
        case "add":
        ?>

        <form action="<?php echo $action ?>" method="post" enctype="multipart/form-data" id="exampleStandardForm" autocomplete="off">
            <div class="page-content container-fluid">
                <div class="col-md-6">
                    <div class="panel">
                        <div class="panel-heading">
                            <h5 class="panel-title">Tambah Toko</h5>
                        </div>
                        <div class="panel-body container-fluid">
                        <div class="form-group form-material">
                                <label class="control-label" for="inputText">Username</label>
                                <input type="text" class="form-control input-sm" id="pelanggan_username" name="pelanggan_username" placeholder="Masukan Nama" readonly value="<?php echo $_SESSION['pelanggan_username'] ?>" required/>
                            </div>
                            <div class="form-group form-material">
                                <label class="control-label" for="inputText">Nama</label>
                                <input type="text" class="form-control input-sm" id="toko_name" name="toko_name" placeholder="Masukan Nama" value="" required/>
                            </div>
                            <div class="form-group form-material">
                                <label class="control-label" for="inputText">Deskripsi</label>
                                <input type="text" class="form-control input-sm" id="toko_deskripsi" name="toko_deskripsi" placeholder="Masukan Deskripsi"
                                    value="" required/>
                            </div>
                            <div class="form-group form-material">
                                <label class="control-label" for="inputText">Alamat Lengkap</label>
                                <input type="text" class="form-control input-sm" id="toko_alamat" name="toko_alamat" placeholder="Masukan Alamat Lengkap"
                                    value="" required/>
                            </div>
                            <div class="form-group form-material">
                                <label class="control-label" for="inputText">Longitude (https://www.google.com/maps)</label>
                                <input type="text" class="form-control input-sm" id="toko_longitude" name="toko_longitude" placeholder="Masukan Longitude"
                                    value="" required/>
                            </div>
                            <div class="form-group form-material">
                                <label class="control-label" for="inputText">Latitude (https://www.google.com/maps)</label>
                                <input type="text" class="form-control input-sm" id="toko_latitude" name="toko_latitude" placeholder="Masukan Latitude"
                                    value="" required/>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="panel">
                        <div class="panel-heading">
                            <h5 class="panel-title">Informasi Rekening</h5>
                        </div>
                        <div class="panel-body container-fluid">
                            <div class="form-group form-material">
                                <label class="control-label" for="inputText">Bank</label>
                                <input type="text" class="form-control input-sm" id="toko_bank" name="toko_bank" placeholder="Masukan Bank" value="" required/>
                            </div>
                            <div class="form-group form-material">
                                <label class="control-label" for="inputText">Atas Nama</label>
                                <input type="text" class="form-control input-sm" id="toko_owner" name="toko_owner" placeholder="Masukan Nama" value="" required/>
                            </div>
                            <div class="form-group form-material">
                                <label class="control-label" for="inputText">No Rek</label>
                                <input type="text" class="form-control input-sm" id="toko_noaccount" name="toko_noaccount" placeholder="Masukan No Rek" value=""
                                    required/>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-2"></div>
                <div class="col-md-12">
                    <div class='button text-center'>
                        <input class="btn btn-primary btn-sm" type="submit" name="simpan" value="Tambah Data" id="validateButton2">
                        <a class="btn btn-default btn-sm" href="?module=toko">Kembali</a>
                    </div>
                </div>
            </div>
        </form>

        <?php
        break;
        case "edit":
        $result = mysqli_query($connect, "SELECT * FROM toko WHERE toko_id='$_GET[id]'");
        $p      = mysqli_fetch_array($result);
        ?>
            <form action="<?php echo $action ?>" method="post" enctype="multipart/form-data" id="exampleStandardForm" autocomplete="off">
                <div class="page-content container-fluid">
                    <div class="col-md-6">
                        <div class="panel">
                            <div class="panel-heading">
                                <h5 class="panel-title">Ubah Toko</h5>
                            </div>
                            <div class="panel-body container-fluid">
                            <input type="hidden" class="form-control input-sm" id="toko_id" name="toko_id" placeholder="Masukan ID" value="<?php echo $p['toko_id'] ?>" required/>
                        <div class="form-group form-material">
                        <label class="control-label" for="inputText">Username</label>
                        <input type="text" class="form-control input-sm" id="pelanggan_username" name="pelanggan_username" placeholder="Masukan Nama" readonly value="<?php echo $_SESSION['pelanggan_username'] ?>" required/>
                    </div>
                                <div class="form-group form-material">
                                    <label class="control-label" for="inputText">Nama</label>
                                    <input type="text" class="form-control input-sm" id="toko_name" name="toko_name" placeholder="Masukan Nama" value="<?php echo $p['toko_name'] ?>" required/>
                                </div>
                                <div class="form-group form-material">
                                    <label class="control-label" for="inputText">Deskripsi</label>
                                    <input type="text" class="form-control input-sm" id="toko_deskripsi" name="toko_deskripsi" placeholder="Masukan Deskripsi"
                                        value="<?php echo $p['toko_deskripsi'] ?>" required/>
                                </div>
                                <div class="form-group form-material">
                                    <label class="control-label" for="inputText">Alamat Lengkap</label>
                                    <input type="text" class="form-control input-sm" id="toko_alamat" name="toko_alamat" placeholder="Masukan Alamat Lengkap"
                                        value="<?php echo $p['toko_alamat'] ?>" required/>
                                </div>
                                <div class="form-group form-material">
                                    <label class="control-label" for="inputText">Longitude (https://www.google.com/maps)</label>
                                    <input type="text" class="form-control input-sm" id="toko_longitude" name="toko_longitude" placeholder="Masukan Longitude"
                                        value="<?php echo $p['toko_longitude'] ?>" required/>
                                </div>
                                <div class="form-group form-material">
                                    <label class="control-label" for="inputText">Latitude (https://www.google.com/maps)</label>
                                    <input type="text" class="form-control input-sm" id="toko_latitude" name="toko_latitude" placeholder="Masukan Latitude"
                                        value="<?php echo $p['toko_latitude'] ?>" required/>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="panel">
                            <div class="panel-heading">
                                <h5 class="panel-title">Informasi Rekening</h5>
                            </div>
                            <div class="panel-body container-fluid">
                                <div class="form-group form-material">
                                    <label class="control-label" for="inputText">Bank</label>
                                    <input type="text" class="form-control input-sm" id="toko_bank" name="toko_bank" placeholder="Masukan Bank" value="<?php echo $p['toko_bank'] ?>" required/>
                                </div>
                                <div class="form-group form-material">
                                    <label class="control-label" for="inputText">Atas Nama</label>
                                    <input type="text" class="form-control input-sm" id="toko_owner" name="toko_owner" placeholder="Masukan Nama" value="<?php echo $p['toko_owner'] ?>" required/>
                                </div>
                                <div class="form-group form-material">
                                    <label class="control-label" for="inputText">No Rek</label>
                                    <input type="text" class="form-control input-sm" id="toko_noaccount" name="toko_noaccount" placeholder="Masukan No Rek" value="<?php echo $p['toko_noaccount'] ?>"
                                        required/>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class='button text-center'>
                            <input class="btn btn-primary btn-sm" type="submit" name="simpan" value="Ubah Data" id="validateButton2">
                            <a class="btn btn-default btn-sm" href="?module=toko">Kembali</a>
                        </div>
                    </div>
                </div>
            </form>
            <?php
        break;
        case "detail":
        $result = mysqli_query($connect, "SELECT * FROM toko WHERE toko_id='$_GET[id]'");
        $p      = mysqli_fetch_array($result);
        ?>
                <div class="page-content container-fluid">
                    <div class="col-md-12">
                        <div class="panel">
                            <div class="panel-heading">
                                <h5 class="panel-title">Detail Toko</h5>
                            </div>
                            <div class="panel-body container-fluid table-detail">
                                <div class="table-full table-detail">
                                    <div class="table-responsive">
                                        <table class="table table-hover">
                                            <tbody>
                                                <tr>
                                                    <td class="title" width=200>ID</td>
                                                    <td>
                                                        <?php echo $p['toko_id']?>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="title">Pelanggan</td>
                                                    <td>
                                                    <?php 
                                                    $pesult2 = mysqli_query($connect, "SELECT * FROM pelanggan WHERE pelanggan_username='$p[pelanggan_username]'");
                                                    $pelanggan      = mysqli_fetch_array($pesult2);
                                                    ?> Username :
                                                        <a href="?module=pelanggan&act=detail&id=<?php echo $pelanggan['pelanggan_username']; ?>">
                                                            <?php echo $pelanggan['pelanggan_username']; ?>
                                                        </a>
                                                        <br> Nama :
                                                        <?php echo $pelanggan['pelanggan_name']; ?>
                                                        <br> Alamat :
                                                        <?php echo $pelanggan['pelanggan_alamat']; ?>
                                                        <br> No Telp :
                                                        <?php echo $pelanggan['pelanggan_notelp']; ?>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="title">Toko</td>
                                                    <td>
                                                        Toko:
                                                        <?php echo $p['toko_name'];?>
                                                        <br> Deskripsi:
                                                        <?php echo $p['toko_deskripsi'];?>
                                                        <br> Status:
                                                        <?php echo $p['toko_status'];?>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="title">Bank</td>
                                                    <td>
                                                        Bank:
                                                        <?php echo $p['toko_bank'];?>
                                                        <br> Atas Nama:
                                                        <?php echo $p['toko_owner'];?>
                                                        <br> No Rek:
                                                        <?php echo $p['toko_noaccount'];?>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="title">Status</td>
                                                    <td>
                                                        <?php echo $p['toko_status']?>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="title">Dibuat</td>
                                                    <td>
                                                        <?php echo tgl_indo($p['toko_created'])?>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="title">Terakhir diubah</td>
                                                    <td>
                                                        <?php echo tgl_indo($p['toko_updated'])?>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class='button text-center'>
                            <a class="btn btn-default btn-sm" href="?module=toko">Kembali</a>
                        </div>
                    </div>
                </div>
                <?php
        break;
    }}
?>