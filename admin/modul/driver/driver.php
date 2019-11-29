<?php

    $action="modul/driver/action.php?module=".$_GET['module']."&act=".$_GET['act'];
    switch($_GET['act']) {
        default:
        ?>

    <div class="page-content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="panel">
                    <div class="panel-heading">
                        <h5 class="panel-title">Driver</h5>
                    </div>
                    <div class="panel-body container-fluid table-detail">
                        <div class="table-full table-view">
                            <div class="navigation-btn">
                                <form method="get" action='<?php echo $_SERVER[' PHP_SELF '] ?>'>
                                    <div class='row margin-bottom'>
                                        <div class='btn-search'>Cari Berdasarkan Nama: &nbsp; &nbsp; &nbsp;</div>
                                        <div class='col-md-4 col-sm-12 select-search'>
                                            <div class="input-group">
                                                <input type="text" name="filter" class="form-control" value="" />
                                                <input type=hidden name=module value=driver>
                                                <span class="input-group-btn">
                                                    <button type="submit" class="btn btn-primary" type="button">
                                                        <i class="fa fa-search"></i>
                                                    </button>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class='btn-navigation'>
                                        <a class="btn btn-primary" style="margin-right: 10px;" href="?module=driver&act=add">
                                            Tambah Driver
                                        </a>
                                        <div class='pull-right'>
                                            <a class="btn btn-primary" href="?module=driver">
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
                                        <th>Username</th>
                                        <th>Nama</th>
                                        <th>Alamat</th>
                                        <th>Saldo</th>
                                        <th>Peta</th>
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

                                            $result=mysqli_query($connect,"SELECT * FROM driver LIMIT $posisi,$batas");
                                            $jmldata = mysqli_num_rows(mysqli_query($connect, "SELECT * FROM driver"));
                                            if(mysqli_num_rows($result) === 0) {
                                    ?>
                                            <tr>
                                                <td class="text-center" colspan="10">Data kosong...</td>
                                            </tr>
                                            <?php } else {
                                                $no = $posisi+1;
                                                while ($r=mysqli_fetch_array($result)) {
                                                $tanggal=tgl_indo($r['driver_created']);
                                                ?>
                                            <tr>
                                                <td>
                                                    <?php echo $no; ?>
                                                </td>
                                                <td>
                                                    <?php echo $r['driver_username'];?>
                                                </td>
                                                <td>
                                                    <?php echo $r['driver_name'];?>
                                                </td>
                                                <td>
                                                    <?php echo $r['driver_alamat'];?>
                                                </td>
                                                <td>
                                                    Rp
                                                    <?php echo format_rupiah($r['driver_saldo']);?>,00
                                                </td>
                                                <td>
                                                    <a target="_blank" href="https://www.google.com/maps/@<?php echo $r['driver_latitude'];?>,<?php echo $r['driver_longitude'];?>"
                                                        class="btn btn-primary">Buka</a>
                                                </td>
                                                <td>
                                                    <?php echo strtoupper($r['driver_status']);?>
                                                </td>
                                                <td>
                                                    <?php echo $tanggal?>
                                                </td>
                                                <td class="text-center action">
                                                    <a class="btn-update" href="?module=driver&act=edit&id=<?php echo $r['driver_username'];?>">
                                                        <i class="icon wb-pencil"></i>
                                                    </a>
                                                    <a class="btn-detail" href="?module=driver&act=detail&id=<?php echo $r['driver_username'];?>">
                                                        <i class="icon wb-search"></i>
                                                    </a>
                                                    <a class="btn-detail" href="?module=driver&act=editpassword&id=<?php echo $r['driver_username'];?>">
                                                        <i class="icon wb-lock"></i>
                                                    </a>
                                                    <a class="btn-delete" href="javascript:;" data-id="<?php echo $r['driver_username'];?>" data-toggle="modal" data-target="#modal-konfirmasi"
                                                        title="">
                                                        <i class="icon wb-trash"></i>
                                                    </a>
                                                    <?php if($r['driver_status'] === 'process') { ?>
                                                        <a class="btn-update" href="modul/driver/action.php?module=driver&act=active&id=<?php echo $r['driver_username'];?>">
                                                            <i class="icon wb-check"></i>
                                                        </a>
                                                    <?php } else { ?>
                                                        <a class="btn-update" href="modul/driver/action.php?module=driver&act=nonactive&id=<?php echo $r['driver_username'];?>">
                                                            <i class="icon wb-close"></i>
                                                        </a>
                                                    <?php } ?>
                                                </td>
                                                <?php $no++; } ?>
                                            </tr>
                                            <?php }
                                                $jmldata = mysqli_num_rows(mysqli_query($connect, "SELECT * FROM driver"));
                                                $jmlhalaman  = $p->jumlahHalaman($jmldata, $batas);
                                                $linkHalaman = $p->navHalaman($_GET['halaman'], $jmlhalaman);
                                            } else {
                                            $p      = new Paging;
                                            $batas  = 10;
                                            $posisi = $p->cariPosisi($batas);
                                            $search = $_GET['filter'];

                                            $result=mysqli_query($connect,"SELECT * FROM driver WHERE driver_name LIKE '%$search%' LIMIT $posisi,$batas");
                                            $jmldata = mysqli_num_rows(mysqli_query($connect, "SELECT * FROM driver WHERE driver_name LIKE '%$search%'"));
                                            if(mysqli_num_rows($result) === 0) {
                                    ?>
                                            <tr>
                                                <td class="text-center" colspan="10">Pencarian tidak ditemukan...</td>
                                            </tr>
                                            <?php } else {
                                                $no = $posisi+1;
                                                while ($r=mysqli_fetch_array($result)) {
                                                $tanggal=tgl_indo($r['driver_created']);
                                                ?>
                                            <tr>
                                                <td>
                                                    <?php echo $no; ?>
                                                </td>
                                                <td>
                                                    <?php echo $r['driver_username'];?>
                                                </td>
                                                <td>
                                                    <?php echo $r['driver_name'];?>
                                                </td>
                                                <td>
                                                    <?php echo $r['driver_alamat'];?>
                                                </td>
                                                <td>
                                                    Rp
                                                    <?php echo format_rupiah($r['driver_saldo']);?>,00
                                                </td>
                                                <td>
                                                    <a target="_blank" href="https://www.google.com/maps/@<?php echo $r['driver_latitude'];?>,<?php echo $r['driver_longitude'];?>"
                                                        class="btn btn-primary">Buka</a>
                                                </td>
                                                <td>
                                                    <?php echo $tanggal?>
                                                </td>
                                                <td class="text-center action">
                                                    <a class="btn-update" href="?module=driver&act=edit&id=<?php echo $r['driver_username'];?>">
                                                        <i class="icon wb-pencil"></i>
                                                    </a>
                                                    <a class="btn-detail" href="?module=driver&act=detail&id=<?php echo $r['driver_username'];?>">
                                                        <i class="icon wb-search"></i>
                                                    </a>
                                                    <a class="btn-detail" href="?module=driver&act=editpassword&id=<?php echo $r['driver_username'];?>">
                                                        <i class="icon wb-lock"></i>
                                                    </a>
                                                    <a class="btn-delete" href="javascript:;" data-id="<?php echo $r['driver_username'];?>" data-toggle="modal" data-target="#modal-konfirmasi"
                                                        title="">
                                                        <i class="icon wb-trash"></i>
                                                    </a>
                                                </td>
                                                <?php $no++; } ?>
                                            </tr>
                                            <?php }
                                                $jmldata = mysqli_num_rows(mysqli_query($connect, "SELECT * FROM driver WHERE driver_name LIKE '%$search%'"));
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

                <div class="modal-body" style="background:#d9534f;color:#fff">
                    Apakah Anda yakin ingin menghapus data ini?
                </div>

                <div class="modal-footer">
                    <a href="javascript:;" class="btn btn-danger" id="delete-driver">Ya</a>
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
                            <h5 class="panel-title">Tambah Driver</h5>
                        </div>
                        <div class="panel-body container-fluid">
                            <div class="form-group form-material">
                                <label class="control-label" for="inputText">Username</label>
                                <input type="text" class="form-control input-sm" id="driver_username" name="driver_username" placeholder="Masukan Username"
                                    value="" required/>
                            </div>
                            <div class="form-group form-material">
                                <label class="control-label" for="inputText">Nama</label>
                                <input type="text" class="form-control input-sm" id="driver_name" name="driver_name" placeholder="Masukan Nama" value=""
                                    required/>
                            </div>
                            <div class="form-group form-material">
                                <label class="control-label" for="inputText">Password</label>
                                <input type="password" class="form-control input-sm" id="driver_password" name="driver_password" placeholder="Masukan Password"
                                    value="" required/>
                            </div>
                            <div class="form-group form-material">
                                <label class="control-label" for="inputText">No Telp</label>
                                <input type="text" class="form-control input-sm" id="driver_notelp" name="driver_notelp" placeholder="Masukan No Telp" value=""
                                    required/>
                            </div>
                            <div class="form-group form-material">
                                <label class="control-label" for="inputText">Alamat</label>
                                <input type="text" class="form-control input-sm" id="driver_alamat" name="driver_alamat" placeholder="Masukan Alamat" value=""
                                    required/>
                            </div>
                            <div class="form-group form-material">
                                <label class="control-label" for="inputText">Longitude (https://www.google.com/maps)</label>
                                <input type="text" class="form-control input-sm" id="driver_longitude" name="driver_longitude" placeholder="Masukan Longitude"
                                    value="" required/>
                            </div>
                            <div class="form-group form-material">
                                <label class="control-label" for="inputText">Latitude (https://www.google.com/maps)</label>
                                <input type="text" class="form-control input-sm" id="driver_latitude" name="driver_latitude" placeholder="Masukan Latitude"
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
                                <input type="text" class="form-control input-sm" id="driver_bank" name="driver_bank" placeholder="Masukan Bank" value="<?php echo $p['driver_bank'] ?>"
                                    required/>
                            </div>
                            <div class="form-group form-material">
                                <label class="control-label" for="inputText">Atas Nama</label>
                                <input type="text" class="form-control input-sm" id="driver_owner" name="driver_owner" placeholder="Masukan Nama" value="<?php echo $p['driver_owner'] ?>"
                                    required/>
                            </div>
                            <div class="form-group form-material">
                                <label class="control-label" for="inputText">No Rek</label>
                                <input type="text" class="form-control input-sm" id="driver_noaccount" name="driver_noaccount" placeholder="Masukan No Rek" value="<?php echo $p['driver_noaccount'] ?>"
                                    required/>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class='button text-center'>
                        <input class="btn btn-primary btn-sm" type="submit" name="simpan" value="Tambah Data" id="validateButton2">
                        <a class="btn btn-default btn-sm" href="?module=driver">Kembali</a>
                    </div>
                </div>
            </div>
        </form>

        <?php
        break;
        case "edit":
        $result = mysqli_query($connect, "SELECT * FROM driver WHERE driver_username='$_GET[id]'");
        $p      = mysqli_fetch_array($result);
        ?>
            <form action="<?php echo $action ?>" method="post" enctype="multipart/form-data" id="exampleStandardForm" autocomplete="off">
                <div class="page-content container-fluid">
                    <div class="col-md-6">
                        <div class="panel">
                            <div class="panel-heading">
                                <h5 class="panel-title">Edit Driver</h5>
                            </div>
                            <div class="panel-body container-fluid">
                                <div class="form-group form-material">
                                    <label class="control-label" for="inputText">Username</label>
                                    <input type="text" class="form-control input-sm" id="driver_username" name="driver_username" placeholder="Masukan Username"
                                        value="<?php echo $p['driver_username']?>" readonly required/>
                                </div>
                                <div class="form-group form-material">
                                    <label class="control-label" for="inputText">Nama</label>
                                    <input type="text" class="form-control input-sm" id="driver_name" name="driver_name" placeholder="Masukan Nama" value="<?php echo $p['driver_name']?>"
                                        required/>
                                </div>
                                <div class="form-group form-material">
                                    <label class="control-label" for="inputText">No Telp</label>
                                    <input type="text" class="form-control input-sm" id="driver_notelp" name="driver_notelp" placeholder="Masukan No Telp" value="<?php echo $p['driver_notelp']?>"
                                        required/>
                                </div>
                                <div class="form-group form-material">
                                    <label class="control-label" for="inputText">Alamat</label>
                                    <input type="text" class="form-control input-sm" id="driver_alamat" name="driver_alamat" placeholder="Masukan Alamat" value="<?php echo $p['driver_alamat']?>"
                                        required/>
                                </div>
                                <div class="form-group form-material">
                                    <label class="control-label" for="inputText">Longitude (https://www.google.com/maps)</label>
                                    <input type="text" class="form-control input-sm" id="driver_longitude" name="driver_longitude" placeholder="Masukan Longitude"
                                        value="<?php echo $p['driver_longitude'] ?>" required/>
                                </div>
                                <div class="form-group form-material">
                                    <label class="control-label" for="inputText">Latitude (https://www.google.com/maps)</label>
                                    <input type="text" class="form-control input-sm" id="driver_latitude" name="driver_latitude" placeholder="Masukan Latitude"
                                        value="<?php echo $p['driver_latitude'] ?>" required/>
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
                                <input type="text" class="form-control input-sm" id="driver_bank" name="driver_bank" placeholder="Masukan Bank" value="<?php echo $p['driver_bank'] ?>"
                                    required/>
                            </div>
                            <div class="form-group form-material">
                                <label class="control-label" for="inputText">Atas Nama</label>
                                <input type="text" class="form-control input-sm" id="driver_owner" name="driver_owner" placeholder="Masukan Nama" value="<?php echo $p['driver_owner'] ?>"
                                    required/>
                            </div>
                            <div class="form-group form-material">
                                <label class="control-label" for="inputText">No Rek</label>
                                <input type="text" class="form-control input-sm" id="driver_noaccount" name="driver_noaccount" placeholder="Masukan No Rek" value="<?php echo $p['driver_noaccount'] ?>"
                                    required/>
                            </div>
                        </div>
                    </div>
                </div>
                    <div class="col-md-12">
                        <div class='button text-center'>
                            <input class="btn btn-primary btn-sm" type="submit" name="simpan" value="Ubah Data" id="validateButton2">
                            <a class="btn btn-default btn-sm" href="?module=driver">Kembali</a>
                        </div>
                    </div>
                </div>
            </form>

            <?php
        break;
        case "editpassword":
        $result = mysqli_query($connect, "SELECT * FROM driver WHERE driver_username='$_GET[id]'");
        $p      = mysqli_fetch_array($result);
        ?>
                ?>
                <form action="<?php echo $action ?>" method="post" enctype="multipart/form-data" id="exampleStandardForm" autocomplete="off">
                    <div class="page-content container-fluid">
                        <div class="col-md-2"></div>
                        <div class="col-md-8">
                            <div class="panel">
                                <div class="panel-heading">
                                    <h5 class="panel-title">Edit Driver</h5>
                                </div>
                                <div class="panel-body container-fluid">
                                    <div class="form-group form-material">
                                        <label class="control-label" for="inputText">Username</label>
                                        <input type="text" class="form-control input-sm" id="driver_username" name="driver_username" placeholder="Masukan Username"
                                            value="<?php echo $p['driver_username']?>" readonly required/>
                                    </div>
                                    <div class="form-group form-material">
                                        <label class="control-label" for="inputText">Password</label>
                                        <input type="password" class="form-control input-sm" id="driver_password" name="driver_password" placeholder="Masukan Password"
                                            value="" required/>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2"></div>
                        <div class="col-md-12">
                            <div class='button text-center'>
                                <input class="btn btn-primary btn-sm" type="submit" name="simpan" value="Ubah Password" id="validateButton2">
                                <a class="btn btn-default btn-sm" href="?module=driver">Kembali</a>
                            </div>
                        </div>
                    </div>
                </form>

                <?php
        break;
        case "detail":
        $result = mysqli_query($connect, "SELECT * FROM driver WHERE driver_username='$_GET[id]'");
        $p      = mysqli_fetch_array($result);
        ?>
                    <div class="page-content container-fluid">
                        <div class="col-md-12">
                            <div class="panel">
                                <div class="panel-heading">
                                    <h5 class="panel-title">Detail Driver</h5>
                                </div>
                                <div class="panel-body container-fluid table-detail">
                                    <div class="table-full table-detail">
                                        <div class="table-responsive">
                                            <table class="table table-hover">
                                                <tbody>
                                                    <tr>
                                                        <td class="title" width=200>Username</td>
                                                        <td>
                                                            <?php echo $p['driver_username']?>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="title">Nama</td>
                                                        <td>
                                                            <?php echo $p['driver_name']?>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="title">Password</td>
                                                        <td>
                                                            *****
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="title">Alamat</td>
                                                        <td>
                                                            <?php echo $p['driver_alamat']?>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="title">No Telp</td>
                                                        <td>
                                                            <?php echo $p['driver_notelp']?>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="title">Saldo</td>
                                                        <td>
                                                            Rp
                                                            <?php echo format_rupiah($p['driver_saldo']);?>,00
                                                        </td>
                                                    </tr>
                                                <tr>
                                                    <td class="title">Bank</td>
                                                    <td>
                                                        Bank:
                                                        <?php echo $p['driver_bank'];?>
                                                        <br> Atas Nama:
                                                        <?php echo $p['driver_owner'];?>
                                                        <br> No Rek:
                                                        <?php echo $p['driver_noaccount'];?>
                                                    </td>
                                                </tr>
                                                    <tr>
                                                        <td class="title">Peta</td>
                                                        <td>
                                                            <a target="_blank" href="https://www.google.com/maps/@<?php echo $r['driver_latitude'];?>,<?php echo $r['driver_longitude'];?>"
                                                                class="btn btn-primary">Buka</a>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="title">Dibuat</td>
                                                        <td>
                                                            <?php echo tgl_indo($p['driver_created'])?>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="title">Terakhir diubah</td>
                                                        <td>
                                                            <?php echo tgl_indo($p['driver_updated'])?>
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
                                <a class="btn btn-default btn-sm" href="?module=driver">Kembali</a>
                            </div>
                        </div>
                    </div>
                    <?php
        break;
    }
?>