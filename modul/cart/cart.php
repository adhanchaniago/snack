<div class="page-content container-fluid">
    <div class="col-md-12">
        <div class="panel">
            <div class="panel-body container-fluid table-detail">
                <div class="table-full table-view">
                                <?php 
                                    if(!empty($_SESSION["cart"]) OR isset($_SESSION["cart"])) {
                            ?>
                    <div class="navigation-btn">
                        <div class='text-right margin-bottom' style="padding-right: 20px;">
                            <a class="btn btn-danger" href="modul/cart/deleteall.php">
                                Hapus Semua
                            </a>
                        </div>
                    </div>
                                    <?php } ?>
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <th width=50>No</th>
                                <th width=400>Nama</th>
                                <th>Harga</th>
                                <th width=200>QTY</th>
                                <th>Total Harga</th>
                                <th class="text-center">Aksi</th>
                            </thead>
                            <tbody>
                                <?php 
                                    if(empty($_SESSION["cart"]) OR !isset($_SESSION["cart"])) {
                            ?>
                                <tr>
                                    <td class="text-center" colspan="10">Data kosong...</td>
                                </tr>
                                <?php } else {
                                        $no = 1;
                                        $total = 0;
                                        foreach ($_SESSION["cart"] as $menu_id => $qty): ?>

                                <?php
                                        $result = mysqli_query($connect, "SELECT * FROM menu WHERE menu_id='$menu_id'");
                                        $r      = mysqli_fetch_array($result);

                                        $tanggal=tgl_indo($r['menu_created']);
                                        $menu_price=format_rupiah($r['menu_price']);
                                        $menu_totalprice=$qty*$r['menu_price'];
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
                                            <form action="modul/cart/add.php" method="post" enctype="multipart/form-data" id="exampleStandardForm" autocomplete="off">
                                                <input type="hidden" class="form-control input-sm" id="menu_id" name="menu_id" value="<?php echo $r['menu_id'] ?>" />
                                                <div class="form-group form-material">
                                                    <input type="number" class="form-control input-sm" id="qty" name="qty" placeholder="Masukan Harga" value="<?php echo $qty ?>"
                                                        required/>
                                                </div>
                                                <input class="btn btn-primary" href="add.php" type="submit" name="simpan" value="Update">
                                            </form>
                                        </td>
                                        <td>
                                            Rp
                                            <?php echo format_rupiah($menu_totalprice);?>
                                        </td>
                                        <td class="text-center action">
                                            <a class="btn-detail" href="modul/cart/delete.php?id=<?php echo $r['menu_id'];?>">
                                                <i class="icon wb-trash"></i>
                                            </a>
                                        </td>
                                        <?php $no++;  ?>
                                        <?php $total += $menu_totalprice  ?>
                                        <?php endforeach ?>
                                    </tr>
                                    <?php } 
                                     
                                            ?>
                            </tbody>
                                <?php 
                                    if(!empty($_SESSION["cart"]) OR isset($_SESSION["cart"])) {
                            ?>
                            <tbody>
                                <tr>
                                    <td colspan="4">Total Belanja</td>
                                    <td colspan="2">Rp<?php echo format_rupiah($total) ?></td>
                                </tr>
                            </tbody>
                                    <?php  } ?>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>