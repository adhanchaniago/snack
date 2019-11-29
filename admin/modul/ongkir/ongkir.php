<?php

    $action="modul/ongkir/action.php?module=".$_GET['module']."&act=".$_GET['act'];
    switch($_GET['act']) {
        default:
        ?>

    <div class="page-content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="panel">
                    <div class="panel-heading">
                        <h5 class="panel-title">Ongkos Kirim</h5>
                    </div>
                    <div class="panel-body container-fluid table-detail">
                        <div class="table-full table-view">
                            <div class="navigation-btn">
                                <form method="get" action='<?php echo $_SERVER[' PHP_SELF '] ?>'>
                                    <div class='row margin-bottom'>
                                        <div class='btn-search'>Cari Berdasarkan Kota: &nbsp; &nbsp; &nbsp;</div>
                                        <div class='col-md-4 col-sm-12 select-search'>
                                            <div class="input-group">
                                                <input type="text" name="filter" class="form-control" value="" />
                                                <input type=hidden name=module value=ongkir>
                                                <span class="input-group-btn">
                                                    <button type="submit" class="btn btn-primary" type="button">
                                                        <i class="fa fa-search"></i>
                                                    </button>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class='btn-navigation'>
                                        <a class="btn btn-primary" style="margin-right: 10px;" href="?module=ongkir&act=add">
                                            Tambah Ongkos Kirim
                                        </a>
                                        <div class='pull-right'>
                                            <a class="btn btn-primary" href="?module=ongkir">
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
                                        <th>Kota</th>
                                        <th>Harga</th>
                                        <th>Dibuat</th>
                                        <th class="text-center">Aksi</th>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if (empty(isset($_GET['filter']))) {
                                            $p      = new Paging;
                                            $batas  = 10;
                                            $posisi = $p->cariPosisi($batas);

                                            $result=mysqli_query($connect,"SELECT * FROM ongkir LIMIT $posisi,$batas");
                                            $jmldata = mysqli_num_rows(mysqli_query($connect, "SELECT * FROM ongkir"));
                                            if(mysqli_num_rows($result) === 0) {
                                    ?>
                                            <tr>
                                                <td class="text-center" colspan="10">Data kosong...</td>
                                            </tr>
                                            <?php } else {
                                                $no = $posisi+1;
                                                while ($r=mysqli_fetch_array($result)) {
                                                $tanggal=tgl_indo($r['ongkir_created']);
                                                ?>
                                            <tr>
                                                <td>
                                                    <?php echo $no; ?>
                                                </td>
                                                <td>
                                                    <?php echo $r['ongkir_city'];?>
                                                </td>
                                                <td>
                                                    Rp<?php echo format_rupiah($r['ongkir_price']) ;?>,00
                                                </td>
                                                <td>
                                                    <?php echo $tanggal?>
                                                </td>
                                                <td class="text-center action">
                                                    <a class="btn-update" href="?module=ongkir&act=edit&id=<?php echo $r['ongkir_id'];?>">
                                                        <i class="icon wb-pencil"></i>
                                                    </a>
                                                    <a class="btn-detail" href="?module=ongkir&act=detail&id=<?php echo $r['ongkir_id'];?>">
                                                        <i class="icon wb-search"></i>
                                                    </a>
                                                    <a class="btn-delete" href="javascript:;" data-id="<?php echo $r['ongkir_id'];?>" data-toggle="modal" data-target="#modal-konfirmasi"
                                                        title="">
                                                        <i class="icon wb-trash"></i>
                                                    </a>
                                                </td>
                                                <?php $no++; } ?>
                                            </tr>
                                            <?php }
                                                $jmldata = mysqli_num_rows(mysqli_query($connect, "SELECT * FROM ongkir"));
                                                $jmlhalaman  = $p->jumlahHalaman($jmldata, $batas);
                                                $linkHalaman = $p->navHalaman($_GET['halaman'], $jmlhalaman);
                                            } else {
                                            $p      = new Paging;
                                            $batas  = 10;
                                            $posisi = $p->cariPosisi($batas);
                                            $search = $_GET['filter'];

                                            $result=mysqli_query($connect,"SELECT * FROM ongkir WHERE ongkir_city LIKE '%$search%' LIMIT $posisi,$batas");
                                            $jmldata = mysqli_num_rows(mysqli_query($connect, "SELECT * FROM ongkir WHERE ongkir_city LIKE '%$search%'"));
                                            if(mysqli_num_rows($result) === 0) {
                                    ?>
                                            <tr>
                                                <td class="text-center" colspan="10">Pencarian tidak ditemukan...</td>
                                            </tr>
                                            <?php } else {
                                                $no = $posisi+1;
                                                while ($r=mysqli_fetch_array($result)) {
                                                $tanggal=tgl_indo($r['ongkir_created']);
                                                ?>
                                            <tr>
                                                <td>
                                                    <?php echo $no; ?>
                                                </td>
                                                <td>
                                                    <?php echo $r['ongkir_city'];?>
                                                </td>
                                                <td>
                                                    Rp<?php echo format_rupiah($r['ongkir_price']) ;?>,00
                                                </td>
                                                <td>
                                                    <?php echo $tanggal?>
                                                </td>
                                                <td class="text-center action">
                                                    <a class="btn-update" href="?module=ongkir&act=edit&id=<?php echo $r['ongkir_id'];?>">
                                                        <i class="icon wb-pencil"></i>
                                                    </a>
                                                    <a class="btn-detail" href="?module=ongkir&act=detail&id=<?php echo $r['ongkir_id'];?>">
                                                        <i class="icon wb-search"></i>
                                                    </a>
                                                    <a class="btn-delete" href="javascript:;" data-id="<?php echo $r['ongkir_id'];?>" data-toggle="modal" data-target="#modal-konfirmasi"
                                                        title="">
                                                        <i class="icon wb-trash"></i>
                                                    </a>
                                                </td>
                                                <?php $no++; } ?>
                                            </tr>
                                            <?php }
                                                $jmldata = mysqli_num_rows(mysqli_query($connect, "SELECT * FROM ongkir WHERE ongkir_city LIKE '%$search%'"));
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
                    <a href="javascript:;" class="btn btn-danger" id="delete-ongkir">Ya</a>
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
                <div class="col-md-2"></div>
                <div class="col-md-8">
                    <div class="panel">
                        <div class="panel-heading">
                            <h5 class="panel-title">Tambah Ongkos Kirim</h5>
                        </div>
                        <div class="panel-body container-fluid">
                            <div class="form-group form-material">
                                <label class="control-label" for="inputText">Kota</label>
                                <input type="text" class="form-control input-sm" id="ongkir_city" name="ongkir_city" placeholder="Masukan Kota"
                                    value="" required/>
                            </div>
                            <div class="form-group form-material">
                                <label class="control-label" for="inputText">Harga</label>
                                <input type="text" class="form-control input-sm" id="ongkir_price" name="ongkir_price" placeholder="Masukan Harga"
                                    value="" required/>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-2"></div>
                <div class="col-md-12">
                    <div class='button text-center'>
                        <input class="btn btn-primary btn-sm" type="submit" name="simpan" value="Tambah Data" id="validateButton2">
                        <a class="btn btn-default btn-sm" href="?module=ongkir">Kembali</a>
                    </div>
                </div>
            </div>
        </form>

        <?php
        break;
        case "edit":
        $result = mysqli_query($connect, "SELECT * FROM ongkir WHERE ongkir_id='$_GET[id]'");
        $p      = mysqli_fetch_array($result);
        ?>
            ?>
            <form action="<?php echo $action ?>" method="post" enctype="multipart/form-data" id="exampleStandardForm" autocomplete="off">
                <div class="page-content container-fluid">
                    <div class="col-md-2"></div>
                    <div class="col-md-8">
                        <div class="panel">
                            <div class="panel-heading">
                                <h5 class="panel-title">Edit Ongkos Kirim</h5>
                            </div>
                            <div class="panel-body container-fluid">
                                <input type="hidden" class="form-control input-sm" id="ongkir_id" name="ongkir_id" placeholder="Masukan Username"
                                    value="<?php echo $p['ongkir_id']?>" readonly required/>
                                <div class="form-group form-material">
                                    <label class="control-label" for="inputText">Kota</label>
                                    <input type="text" class="form-control input-sm" id="ongkir_city" name="ongkir_city" placeholder="Masukan Kota"
                                        value="<?php echo $p['ongkir_city']?>" required/>
                                </div>
                                <div class="form-group form-material">
                                    <label class="control-label" for="inputText">Harga</label>
                                    <input type="text" class="form-control input-sm" id="ongkir_price" name="ongkir_price" placeholder="Masukan Harga"
                                        value="<?php echo $p['ongkir_price']?>" required/>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2"></div>
                    <div class="col-md-12">
                        <div class='button text-center'>
                            <input class="btn btn-primary btn-sm" type="submit" name="simpan" value="Ubah Data" id="validateButton2">
                            <a class="btn btn-default btn-sm" href="?module=ongkir">Kembali</a>
                        </div>
                    </div>
                </div>
            </form>
            <?php
        break;
        case "detail":
        $result = mysqli_query($connect, "SELECT * FROM ongkir WHERE ongkir_id='$_GET[id]'");
        $p      = mysqli_fetch_array($result);
        ?>
                    <div class="page-content container-fluid">
                        <div class="col-md-12">
                            <div class="panel">
                                <div class="panel-heading">
                                    <h5 class="panel-title">Detail Ongkos Kirim</h5>
                                </div>
                                <div class="panel-body container-fluid table-detail">
                                    <div class="table-full table-detail">
                                        <div class="table-responsive">
                                            <table class="table table-hover">
                                                <tbody>
                                                    <tr>
                                                        <td class="title" width=200>ID</td>
                                                        <td>
                                                            <?php echo $p['ongkir_id']?>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="title">Kota</td>
                                                        <td>
                                                            <?php echo $p['ongkir_city']?>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="title">Harga</td>
                                                        <td>
                                                            Rp<?php echo format_rupiah($p['ongkir_price']) ?>,00
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="title">Dibuat</td>
                                                        <td>
                                                            <?php echo tgl_indo($p['ongkir_created'])?>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="title">Terakhir diubah</td>
                                                        <td>
                                                            <?php echo tgl_indo($p['ongkir_updated'])?>
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
                                <a class="btn btn-default btn-sm" href="?module=ongkir">Kembali</a>
                            </div>
                        </div>
                    </div>
                    <?php
        break;
    }
?>