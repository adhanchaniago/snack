<div class="page-content container-fluid">
    
<form method="get" action='<?php echo $_SERVER[' PHP_SELF '] ?>'>
                                    <div class='row margin-bottom' style="margin-bottom: 45px !important;">
                                        <div class='btn-search'  style="color: white !Important; font-size: 14px;">Cari Berdasarkan kategori: &nbsp; &nbsp; &nbsp;</div>
                                        <div class='col-md-6 col-sm-12 select-search'>
                                            <div class="input-group">
                                <select type="text" class="form-control" id="filter" name="filter" placeholder="Masukan Kategori"
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
                                                <input type=hidden name=module value=home>
                                                <span class="input-group-btn">
                                                    <button type="submit" class="btn btn-primary" type="button">
                                                        <i class="fa fa-search"></i>
                                                    </button>
                                                </span>
                                        <div class='pull-right'>
                                            <a class="btn btn-primary" href="?module=home">
                                              Hapus Pencarian
                                            </a>
                                        </div>
                                            </div>
                                        </div>
                                    </div>
                                        </form>

                                    <?php
                                    
                                    if (empty(isset($_GET['filter']))) {
        $p      = new Paging;
        $batas  = 10;
        $posisi = $p->cariPosisi($batas);

        $result=mysqli_query($connect,"SELECT * FROM menu ORDER BY menu_created DESC LIMIT $posisi,$batas");
        $jmldata = mysqli_num_rows(mysqli_query($connect, "SELECT * FROM menu"));
        if(mysqli_num_rows($result) === 0) { ?>
        <div class="col-md-12">
            <div class="panel">
                <div class="panel-heading">
                    <h5 class="panel-title">Menu Makanan Kosong</h5>
                </div>
            </div>
        </div>
        <?php } else { 
            while ($r=mysqli_fetch_array($result)) {
                $menu_price=format_rupiah($r['menu_price']);
                ?>
        <div class="col-md-3 col-xs-6">
            <div class="panel">
                <div class="panel-heading">
                    <h5 class="panel-title text-center">
                        <?php echo $r['menu_name'] ?>
                    </h5>
                    <div class="desc" style="padding: 00px 20px 0px 20px;">
                    <?php 
                                                    $result2 = mysqli_query($connect, "SELECT * FROM toko WHERE toko_id='$r[toko_id]'");
                                                    $toko      = mysqli_fetch_array($result2);
                                                    ?>
                                                    <a href="?module=toko&act=detail&id=<?php echo $toko['toko_id']; ?>">
                                                        Toko: <?php echo $toko['toko_name']; ?>
                                                    </a>
            </div>
                    <div class="desc" style="padding: 00px 20px 5px 20px;">                     
                                                    Kategori: 
                                                    <?php 
                                                    $result3 = mysqli_query($connect, "SELECT * FROM category WHERE category_id='$r[category_id]'");
                                                    $category      = mysqli_fetch_array($result3);
                                                    ?>
                                                        <?php echo $category['category_name']; ?>             
            </div>
                    <div class="img">
                        <a href="admin/assets/images/menu/<?php echo $r['menu_photo'] ?>" target="_blank">
                            <img style="width: 100%;height:200px" src="admin/assets/images/menu/<?php echo $r['menu_photo'] ?>">
                        </a>
                    </div>
                    <div class="desc" style="padding: 20px 20px 5px 20px;">
                        <?php echo $r['menu_description'] ?>
                    </div>
                    <div class="price" style="padding: 0px 20px 5px 20px;color: red">Rp
                        <?php echo $menu_price ?>
                    </div>
                    <form action="modul/cart/add.php" method="post" enctype="multipart/form-data" id="exampleStandardForm" autocomplete="off">
                        <div class="text-center" style="padding: 5px 20px 20px 20px;">
                                <input type="hidden" class="form-control input-sm" id="menu_id" name="menu_id" value="<?php echo $r['menu_id'] ?>" />
                            <div class="form-group form-material">
                                <label class="control-label" for="inputText">QTY</label>
                                <input type="number" class="form-control input-sm" id="qty" name="qty" placeholder="Masukan Harga" value="1"
                                    required/>
                            </div>
                            <?php if ($toko['toko_status'] === 'Open') { ?>
                            <input class="btn btn-primary" type="submit" name="simpan2" value="Add to Cart">
                            <?php } else { ?>
                                <input class="btn btn-danger" value="Toko Tutup">
                            <?php } ?>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <?php } 
     $jmldata = mysqli_num_rows(mysqli_query($connect, "SELECT * FROM menu"));
     $jmlhalaman  = $p->jumlahHalaman($jmldata, $batas);
     $linkHalaman = $p->navHalaman($_GET['halaman'], $jmlhalaman);
     }?>

    <?php
                                    } else {
        $p      = new Paging;
        $batas  = 10;
        $posisi = $p->cariPosisi($batas);

        $result=mysqli_query($connect,"SELECT * FROM menu WHERE category_id='$_GET[filter]' ORDER BY menu_created DESC LIMIT $posisi,$batas");
        $jmldata = mysqli_num_rows(mysqli_query($connect, "SELECT * FROM menu WHERE category_id='$_GET[filter]'"));
        if(mysqli_num_rows($result) === 0) { ?>
        <div class="col-md-12">
            <div class="panel">
                <div class="panel-heading">
                    <h5 class="panel-title">Menu Makanan Kosong</h5>
                </div>
            </div>
        </div>
        <?php } else { 
            while ($r=mysqli_fetch_array($result)) {
                $menu_price=format_rupiah($r['menu_price']);
                ?>
        <div class="col-md-3 col-xs-6">
            <div class="panel">
                <div class="panel-heading">
                    <h5 class="panel-title text-center">
                        <?php echo $r['menu_name'] ?>
                    </h5>
                    <div class="desc" style="padding: 00px 20px 0px 20px;">
                    <?php 
                                                    $result2 = mysqli_query($connect, "SELECT * FROM toko WHERE toko_id='$r[toko_id]'");
                                                    $toko      = mysqli_fetch_array($result2);
                                                    ?>
                                                    <a href="?module=toko&act=detail&id=<?php echo $toko['toko_id']; ?>">
                                                        Toko: <?php echo $toko['toko_name']; ?>
                                                    </a>
            </div>
                    <div class="desc" style="padding: 00px 20px 5px 20px;">                     
                                                    Kategori: 
                                                    <?php 
                                                    $result3 = mysqli_query($connect, "SELECT * FROM category WHERE category_id='$r[category_id]'");
                                                    $category      = mysqli_fetch_array($result3);
                                                    ?>
                                                        <?php echo $category['category_name']; ?>             
            </div>
                    <div class="img">
                        <a href="admin/assets/images/menu/<?php echo $r['menu_photo'] ?>" target="_blank">
                            <img style="width: 100%;height:200px" src="admin/assets/images/menu/<?php echo $r['menu_photo'] ?>">
                        </a>
                    </div>
                    <div class="desc" style="padding: 20px 20px 5px 20px;">
                        <?php echo $r['menu_description'] ?>
                    </div>
                    <div class="price" style="padding: 0px 20px 5px 20px;color: red">Rp
                        <?php echo $menu_price ?>
                    </div>
                    <form action="modul/cart/add.php" method="post" enctype="multipart/form-data" id="exampleStandardForm" autocomplete="off">
                        <div class="text-center" style="padding: 5px 20px 20px 20px;">
                                <input type="hidden" class="form-control input-sm" id="menu_id" name="menu_id" value="<?php echo $r['menu_id'] ?>" />
                            <div class="form-group form-material">
                                <label class="control-label" for="inputText">QTY</label>
                                <input type="number" class="form-control input-sm" id="qty" name="qty" placeholder="Masukan Harga" value="1"
                                    required/>
                            </div>   <?php if ($toko['toko_status'] === 'Open') { ?>
                                <input class="btn btn-primary" type="submit" name="simpan2" value="Add to Cart">
                                <?php } else { ?>
                                    <input class="btn btn-danger" value="Toko Tutup">
                                <?php } ?>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <?php } 
     $jmldata = mysqli_num_rows(mysqli_query($connect, "SELECT * FROM menu WHERE category_id='$_GET[filter]'"));
     $jmlhalaman  = $p->jumlahHalaman($jmldata, $batas);
     $linkHalaman = $p->navHalaman($_GET['halaman'], $jmlhalaman);
     }}?>
     <div class="col-md-12">
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