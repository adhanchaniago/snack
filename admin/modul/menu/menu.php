<?php

    $action="modul/menu/action.php?module=".$_GET['module']."&act=".$_GET['act'];
    switch($_GET['act']) {
        default:
        ?>

    <div class="page-content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="panel">
                    <div class="panel-heading">
                        <h5 class="panel-title">Menu Makanan</h5>
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
                                                <input type=hidden name=module value=menu>
                                                <span class="input-group-btn">
                                                    <button type="submit" class="btn btn-primary" type="button">
                                                        <i class="fa fa-search"></i>
                                                    </button>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class='btn-navigation'>
                                        <a class="btn btn-primary" style="margin-right: 10px;" href="?module=menu&act=add">
                                            Tambah Menu Makanan
                                        </a>
                                        <div class='pull-right'>
                                            <a class="btn btn-primary" href="?module=menu">
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
                                        <th>Toko</th>
                                        <th>Foto</th>
                                        <th>Nama</th>
                                        <th>Harga</th>
                                        <th>Berat</th>
                                        <th>Dibuat</th>
                                        <th class="text-center">Aksi</th>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if (empty(isset($_GET['filter']))) {
                                            $p      = new Paging;
                                            $batas  = 10;
                                            $posisi = $p->cariPosisi($batas);

                                            $result=mysqli_query($connect,"SELECT * FROM menu ORDER BY menu_created DESC LIMIT $posisi,$batas");
                                            $jmldata = mysqli_num_rows(mysqli_query($connect, "SELECT * FROM menu"));
                                            if(mysqli_num_rows($result) === 0) {
                                    ?>
                                            <tr>
                                                <td class="text-center" colspan="10">Data kosong...</td>
                                            </tr>
                                            <?php } else {
                                                $no = $posisi+1;
                                                while ($r=mysqli_fetch_array($result)) {
                                                $tanggal=tgl_indo($r['menu_created']);
                                                $menu_price=format_rupiah($r['menu_price']);
                                                ?>
                                            <tr>
                                                <td>
                                                    <?php echo $no; ?>
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
                                                    <a href="assets/images/menu/<?php echo $r['menu_photo'] ?>" target="_blank">
                                                        <img style="width: 100px" src="assets/images/menu/<?php echo $r['menu_photo'] ?>">
                                                    </a>
                                                </td>
                                                <td>
                                                    <?php echo $r['menu_name'];?><br>
                                                    Kategori: 
                                                    <?php 
                                                    $result3 = mysqli_query($connect, "SELECT * FROM category WHERE category_id='$r[category_id]'");
                                                    $category      = mysqli_fetch_array($result3);
                                                    ?>
                                                        <?php echo $category['category_name']; ?>
                                                </td>
                                                <td>
                                                    <?php echo $menu_price;?>
                                                </td>
                                                <td>
                                                    <?php echo $r['menu_weight'];?>
                                                </td>
                                                <td>
                                                    <?php echo $tanggal?>
                                                </td>
                                                <td class="text-center action">
                                                    <a class="btn-update" href="?module=menu&act=edit&id=<?php echo $r['menu_id'];?>">
                                                        <i class="icon wb-pencil"></i>
                                                    </a>
                                                    <a class="btn-detail" href="?module=menu&act=detail&id=<?php echo $r['menu_id'];?>">
                                                        <i class="icon wb-search"></i>
                                                    </a>
                                                    <a class="btn-delete" href="javascript:;" data-id="<?php echo $r['menu_id'];?>" data-toggle="modal" data-target="#modal-konfirmasi"
                                                        title="">
                                                        <i class="icon wb-trash"></i>
                                                    </a>
                                                </td>
                                                <?php $no++; } ?>
                                            </tr>
                                            <?php }
                                                $jmldata = mysqli_num_rows(mysqli_query($connect, "SELECT * FROM menu"));
                                                $jmlhalaman  = $p->jumlahHalaman($jmldata, $batas);
                                                $linkHalaman = $p->navHalaman($_GET['halaman'], $jmlhalaman);
                                            } else {
                                            $p      = new Paging;
                                            $batas  = 10;
                                            $posisi = $p->cariPosisi($batas);
                                            $search = $_GET['filter'];

                                            $result=mysqli_query($connect,"SELECT * FROM menu WHERE menu_name LIKE '%$search%' LIMIT $posisi,$batas");
                                            $jmldata = mysqli_num_rows(mysqli_query($connect, "SELECT * FROM menu WHERE menu_name LIKE '%$search%'"));
                                            if(mysqli_num_rows($result) === 0) {
                                    ?>
                                            <tr>
                                                <td class="text-center" colspan="10">Pencarian tidak ditemukan...</td>
                                            </tr>
                                            <?php } else {
                                                $no = $posisi+1;
                                                while ($r=mysqli_fetch_array($result)) {
                                                $tanggal=tgl_indo($r['menu_created']);
                                                $menu_price=format_rupiah($r['menu_price']);
                                                ?>
                                            <tr>
                                                <td>
                                                    <?php echo $no; ?>
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
                                                    <a href="assets/images/menu/<?php echo $r['menu_photo'] ?>" target="_blank">
                                                        <img style="width: 100px" src="assets/images/menu/<?php echo $r['menu_photo'] ?>">
                                                    </a>
                                                </td>
                                                <td>
                                                <?php echo $r['menu_name'];?><br>
                                                Kategori: 
                                                <?php 
                                                $result3 = mysqli_query($connect, "SELECT * FROM category WHERE category_id='$r[category_id]'");
                                                $category      = mysqli_fetch_array($result3);
                                                ?>
                                                    <?php echo $category['category_name']; ?>
                                                </td>
                                                <td>
                                                    <?php echo $menu_price;?>
                                                </td>
                                                <td>
                                                    <?php echo $r['menu_weight'];?>
                                                </td>
                                                <td>
                                                    <?php echo $tanggal?>
                                                </td>
                                                <td class="text-center action">
                                                    <a class="btn-update" href="?module=menu&act=edit&id=<?php echo $r['menu_id'];?>">
                                                        <i class="icon wb-pencil"></i>
                                                    </a>
                                                    <a class="btn-detail" href="?module=menu&act=detail&id=<?php echo $r['menu_id'];?>">
                                                        <i class="icon wb-search"></i>
                                                    </a>
                                                    <a class="btn-delete" href="javascript:;" data-id="<?php echo $r['menu_id'];?>" data-toggle="modal" data-target="#modal-konfirmasi"
                                                        title="">
                                                        <i class="icon wb-trash"></i>
                                                    </a>
                                                </td>
                                                <?php $no++; } ?>
                                            </tr>
                                            <?php }
                                                $jmldata = mysqli_num_rows(mysqli_query($connect, "SELECT * FROM menu WHERE menu_name LIKE '%$search%'"));
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
                    <a href="javascript:;" class="btn btn-danger" id="delete-menu">Ya</a>
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
                            <h5 class="panel-title">Tambah Menu Makanan</h5>
                        </div>
                        <div class="panel-body container-fluid">
                            <div class="form-group form-material">
                                <label class="control-label" for="inputText">Kategori</label>
                                <select type="text" class="form-control input-sm" id="category_id" name="category_id" placeholder="Masukan Kategori"
                                    value="" required/>
                                <?php 
                                             $result=mysqli_query($connect,"SELECT * FROM category");
                                             if(mysqli_num_rows($result) === 0) {
                                            ?>
                                <option value="">Data Kosong</option>
                                <?php } else {
                                                while ($r=mysqli_fetch_array($result)) {?>
                                <option value="<?php echo $r['category_id'] ?>">
                                    <?php echo $r['category_name'] ?>
                                </option>
                                <?php }
                                            } ?>
                                </select>
                            </div>
                            <div class="form-group form-material">
                                <label class="control-label" for="inputText">Toko</label>
                                <select type="text" class="form-control input-sm" id="toko_id" name="toko_id" placeholder="Masukan Toko"
                                    value="" required/>
                                <?php 
                                             $result=mysqli_query($connect,"SELECT * FROM toko");
                                             if(mysqli_num_rows($result) === 0) {
                                            ?>
                                <option value="">Data Kosong</option>
                                <?php } else {
                                                while ($r=mysqli_fetch_array($result)) {?>
                                <option value="<?php echo $r['toko_id'] ?>">
                                    <?php echo $r['toko_name'] ?>
                                </option>
                                <?php }
                                            } ?>
                                </select>
                            </div>
                            <div class="form-group form-material">
                                <label class="control-label" for="inputText">Nama</label>
                                <input type="text" class="form-control input-sm" id="menu_name" name="menu_name" placeholder="Masukan Nama" value="" required/>
                            </div>
                            <div class="form-group form-material">
                                <label class="control-label" for="inputText">Deskripsi</label>
                                <input type="text" class="form-control input-sm" id="menu_description" name="menu_description" placeholder="Masukan Deskripsi"
                                    value="" required/>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="panel">
                        <div class="panel-body container-fluid">
                            <div class="form-group form-material">
                                <label class="control-label" for="inputText">Harga</label>
                                <input type="number" class="form-control input-sm" id="menu_price" name="menu_price" placeholder="Masukan Harga" value=""
                                    required/>
                            </div>
                            <div class="form-group form-material">
                                <label class="control-label" for="inputText">Berat</label>
                                <input type="number" class="form-control input-sm" id="menu_weight" name="menu_weight" placeholder="Masukan Berat" value=""
                                    required/>
                            </div>
                            <div class="form-material">
                                <label class="control-label" for="inputText">Foto</label>
                            </div>
                            <input name="fupload" type="file" class="form-control" id="fupload" required/>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class='button text-center'>
                        <input class="btn btn-primary btn-sm" type="submit" name="simpan" value="Tambah Data" id="validateButton2">
                        <a class="btn btn-default btn-sm" href="?module=menu">Kembali</a>
                    </div>
                </div>
            </div>
        </form>

        <?php
        break;
        case "edit":
        $result = mysqli_query($connect, "SELECT * FROM menu WHERE menu_id='$_GET[id]'");
        $p      = mysqli_fetch_array($result);
        ?>
            <form action="<?php echo $action ?>" method="post" enctype="multipart/form-data" id="exampleStandardForm" autocomplete="off">
                <div class="page-content container-fluid">
                    <div class="col-md-6">
                        <div class="panel">
                            <div class="panel-heading">
                                <h5 class="panel-title">Ubah Menu Makanan</h5>
                            </div>
                            <div class="panel-body container-fluid">
                                <input type="hidden" name="menu_id" value="<?php echo $p['menu_id']?>" />
                            <div class="form-group form-material">
                                <label class="control-label" for="inputText">Kategori</label>
                                <select type="text" class="form-control input-sm" id="category_id" name="category_id" placeholder="Masukan Kategori"
                                    value="" required/>
                                    <?php 
                                             $result=mysqli_query($connect,"SELECT * FROM category WHERE category_id='$p[category_id]'");
                                             if(mysqli_num_rows($result) === 0) {
                                            ?>
                                <option value="">Data Kosong</option>
                                <?php } else {
                                                while ($r=mysqli_fetch_array($result)) {?>
                                <option value="<?php echo $r['category_id'] ?>">
                                    <?php echo $r['category_name'] ?>
                                </option>
                                <?php }
                                            } ?>

                                <?php 
                                             $result=mysqli_query($connect,"SELECT * FROM category");
                                             if(mysqli_num_rows($result) === 0) {
                                            ?>
                                <option value="">Data Kosong</option>
                                <?php } else {
                                                while ($r=mysqli_fetch_array($result)) {?>
                                <option value="<?php echo $r['category_id'] ?>">
                                    <?php echo $r['category_name'] ?>
                                </option>
                                <?php }
                                            } ?>
                                </select>
                            </div>

                                <div class="form-group form-material">
                                    <label class="control-label" for="inputText">Toko</label>
                                    <select type="text" class="form-control input-sm" id="toko_id" name="toko_id" placeholder="Masukan Toko"
                                        value="" required/>
                                        <?php 
                                         $result=mysqli_query($connect,"SELECT * FROM toko WHERE toko_id='$p[toko_id]'");
                                       
                                            while ($r=mysqli_fetch_array($result)) {?>
                                    <option value="<?php echo $r['toko_id'] ?>">
                                        <?php echo $r['toko_name'] ?>
                                    </option>
                                    <?php 
                                        } ?>
                                
                                    <?php 
                                                $result=mysqli_query($connect,"SELECT * FROM toko");
                                                if(mysqli_num_rows($result) === 0) {
                                                ?>
                                    <option value="">Data Kosong</option>
                                    <?php } else {
                                                    while ($r=mysqli_fetch_array($result)) {?>
                                    <option value="<?php echo $r['toko_id'] ?>">
                                        <?php echo $r['toko_name'] ?>
                                    </option>
                                    <?php }
                                                } ?>
                                    </select>
                                </div>
                                <div class="form-group form-material">
                                    <label class="control-label" for="inputText">Nama</label>
                                    <input type="text" class="form-control input-sm" id="menu_name" name="menu_name" placeholder="Masukan Nama" value="<?php echo $p['menu_name']?>"
                                        required/>
                                </div>
                                <div class="form-group form-material">
                                    <label class="control-label" for="inputText">Deskripsi</label>
                                    <input type="text" class="form-control input-sm" id="menu_description" name="menu_description" placeholder="Masukan Deskripsi"
                                        value="<?php echo $p['menu_description']?>" required/>
                                </div>
                                <div class="form-group form-material">
                                    <label class="control-label" for="inputText">Harga</label>
                                    <input type="number" class="form-control input-sm" id="menu_price" name="menu_price" placeholder="Masukan Harga" value="<?php echo $p['menu_price']?>"
                                        required/>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="panel">
                            <div class="panel-body container-fluid">
                                <div class="form-group form-material">
                                    <label class="control-label" for="inputText">Berat</label>
                                    <input type="number" class="form-control input-sm" id="menu_weight" name="menu_weight" placeholder="Masukan Berat" value="<?php echo $p['menu_weight']?>"
                                        required/>
                                </div>
                                <div class="form-group form-material">
                                    <label class="control-label" for="inputText">Foto</label>
                                    <input type="text" readonly class="form-control input-sm" id="menu_photo" name="menu_photo" placeholder="Foto" value="<?php echo $p['menu_photo']?>"
                                        required/>
                                </div>
                                <div class="form-material">
                                    <label class="control-label" for="inputText">Foto</label>
                                </div>
                                <input name="fupload" type="file" class="form-control" id="fupload" />
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class='button text-center'>
                            <input class="btn btn-primary btn-sm" type="submit" name="simpan" value="Ubah Data" id="validateButton2">
                            <a class="btn btn-default btn-sm" href="?module=menu">Kembali</a>
                        </div>
                    </div>
                </div>
            </form>

            <?php
        break;
        case "detail":
        $result = mysqli_query($connect, "SELECT * FROM menu WHERE menu_id='$_GET[id]'");
        $p      = mysqli_fetch_array($result);
        ?>
                <div class="page-content container-fluid">
                    <div class="col-md-12">
                        <div class="panel">
                            <div class="panel-heading">
                                <h5 class="panel-title">Detail Menu Makanan</h5>
                            </div>
                            <div class="panel-body container-fluid table-detail">
                                <div class="table-full table-detail">
                                    <div class="table-responsive">
                                        <table class="table table-hover">
                                            <tbody>
                                                <tr>
                                                    <td class="title" width=200>ID</td>
                                                    <td>
                                                        <?php echo $p['menu_id']?>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="title" width=200>Toko</td>
                                                    <td>
                                                    <?php 
                                                    $result2 = mysqli_query($connect, "SELECT * FROM toko WHERE toko_id='$p[toko_id]'");
                                                    $toko      = mysqli_fetch_array($result2);
                                                    ?>
                                                    <a href="?module=toko&act=detail&id=<?php echo $toko['toko_id']; ?>">
                                                        <?php echo $toko['toko_name']; ?>
                                                    </a>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="title">Foto</td>
                                                    <td>
                                                        <a href="assets/images/menu/<?php echo $p['menu_photo'] ?>" target="_blank">
                                                            <img style="width: 100px" src="assets/images/menu/<?php echo $p['menu_photo'] ?>">
                                                        </a>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="title" width=200>Kategori</td>
                                                    <td>
                                                   
                                                    <?php 
                                                    $result3 = mysqli_query($connect, "SELECT * FROM category WHERE category_id='$p[category_id]'");
                                                    $category      = mysqli_fetch_array($result3);
                                                    ?>
                                                        <?php echo $category['category_name']; ?>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="title">Nama</td>
                                                    <td>
                                                        <?php echo $p['menu_name']?>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="title">Deskripsi</td>
                                                    <td>
                                                        <?php echo $p['menu_description']?>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="title">Harga</td>
                                                    <td>
                                                        <?php echo format_rupiah($p['menu_price']);?>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="title">Berat</td>
                                                    <td>
                                                        <?php echo $p['menu_weight']?>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="title">Dibuat</td>
                                                    <td>
                                                        <?php echo tgl_indo($p['menu_created'])?>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="title">Terakhir diubah</td>
                                                    <td>
                                                        <?php echo tgl_indo($p['menu_updated'])?>
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
                            <a class="btn btn-default btn-sm" href="?module=menu">Kembali</a>
                        </div>
                    </div>
                </div>
                <?php
        break;
    }
?>