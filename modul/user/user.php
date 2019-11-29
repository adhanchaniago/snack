<?php
 if (empty($_SESSION['pelanggan_username']) AND empty($_SESSION['pelanggan_password'])){
    echo "<script>location='media.php?module=home';</script>";
} else { 
    $action="modul/user/action.php?module=".$_GET['module']."&act=".$_GET['act'];
    switch($_GET['act']) {
        default:
        ?>

    <div class="page-content container-fluid" style="min-height: 450px;">
        <div class="row">
            <div class="col-md-12">
                <div class="panel">
                    <div class="panel-heading">
                        <h5 class="panel-title">Profile</h5>
                    </div>
                    <div class="panel-body container-fluid table-detail">
                        <div class="table-full table-view">
                            <div class="navigation-btn">
                                <form method="get" action='<?php echo $_SERVER[' PHP_SELF '] ?>'>
                                    <div class='btn-navigation'>
                                        <a class="btn btn-primary" style="margin-right: 10px;" href="?module=saldoprocess&act=add">
                                            Tambah Saldo
                                        </a>
                                    </div>
                                </form>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <th>No</th>
                                        <th>Username</th>
                                        <th>Nama</th>
                                        <th>Password</th>
                                        <th>Alamat</th>
                                        <th>No Telp</th>
                                        <th>Saldo</th>
                                        <th>Dibuat</th>
                                        <th class="text-center">Aksi</th>
                                    </thead>
                                    <tbody>
                                    <?php
                                            $p      = new Paging;
                                            $batas  = 10;
                                            $posisi = $p->cariPosisi($batas);

                                            $result=mysqli_query($connect,"SELECT * FROM pelanggan WHERE pelanggan_username='$_SESSION[pelanggan_username]' LIMIT $posisi,$batas");
                                            $jmldata = mysqli_num_rows(mysqli_query($connect, "SELECT * FROM pelanggan WHERE pelanggan_username='$_SESSION[pelanggan_username]"));
                                            if(mysqli_num_rows($result) === 0) {
                                    ?>
                                            <tr>
                                                <td class="center" colspan="10">Data kosong...</td>
                                            </tr>
                                            <?php } else {
                                                $no = $posisi+1;
                                                while ($r=mysqli_fetch_array($result)) {
                                                $tanggal=tgl_indo($r['pelanggan_created']);
                                                ?>
                                        <tr>
                                            <td>
                                                <?php echo $no; ?>
                                            </td>
                                            <td>
                                                <?php echo $r['pelanggan_username'];?>
                                            </td>
                                            <td>
                                                <?php echo $r['pelanggan_name'];?>
                                            </td>
                                            <td>
                                                *****
                                            </td>
                                            <td>
                                                <?php echo $r['pelanggan_alamat'];?>
                                            </td>
                                            <td>
                                                <?php echo $r['pelanggan_notelp'];?>
                                            </td>
                                            <td>
                                                Rp<?php echo format_rupiah($r['pelanggan_saldo']) ;?>,00
                                            </td>
                                            <td>
                                                <?php echo $tanggal?>
                                            </td>
                                            <td class="text-center action">
                                                <a class="btn-update" href="?module=user&act=edit&id=<?php echo $r['pelanggan_username'];?>">
                                                    <i class="icon wb-pencil"></i>
                                                </a>
                                                <a class="btn-detail" href="?module=user&act=editpassword&id=<?php echo $r['pelanggan_username'];?>">
                                                    <i class="icon wb-lock"></i>
                                                </a>
                                            </td>
                                            <?php $no++; } ?>
                                        </tr>
                                            <?php }
                                                $jmldata = mysqli_num_rows(mysqli_query($connect, "SELECT * FROM pelanggan WHERE pelanggan_username='$_SESSION[pelanggan_username]"));
                                                $jmlhalaman  = $p->jumlahHalaman($jmldata, $batas);
                                                $linkHalaman = $p->navHalaman($_GET['halaman'], $jmlhalaman);
                                            ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
        break;
        case "edit":
        $result = mysqli_query($connect, "SELECT * FROM pelanggan WHERE pelanggan_username='$_GET[id]'");
        $a      = mysqli_fetch_array($result);
        ?>

        <form action="<?php echo $action ?>" method="post" enctype="multipart/form-data" id="exampleStandardForm" autocomplete="off">
            <div class="page-content container-fluid">
                <div class="col-md-2"></div>
                <div class="col-md-8">
                    <div class="panel">
                        <div class="panel-heading">
                            <h5 class="panel-title">Edit Profile</h5>
                        </div>
                        <div class="panel-body container-fluid">
                            <div class="form-group form-material">
                                <label class="control-label" for="inputText">Username</label>
                                <input type="text" class="form-control input-sm" id="pelanggan_username" name="pelanggan_username" placeholder="Masukan Username"
                                    value="<?php echo $a['pelanggan_username']?>" readonly required/>
                            </div>
                            <div class="form-group form-material">
                                <label class="control-label" for="inputText">Nama</label>
                                <input type="text" class="form-control input-sm" id="pelanggan_name" name="pelanggan_name" placeholder="Masukan Nama"
                                    value="<?php echo $a['pelanggan_name']?>" required/>
                            </div>
                            <div class="form-group form-material">
                                <label class="control-label" for="inputText">No Telp</label>
                                <input type="text" class="form-control input-sm" id="pelanggan_notelp" name="pelanggan_notelp" placeholder="Masukan No Telp"
                                    value="<?php echo $a['pelanggan_notelp']?>" required/>
                            </div>
                            <div class="form-group form-material">
                                <label class="control-label" for="inputText">Alamat</label>
                                <input type="text" class="form-control input-sm" id="pelanggan_alamat" name="pelanggan_alamat" placeholder="Masukan Alamat"
                                    value="<?php echo $a['pelanggan_alamat']?>" required/>
                            </div>
                            <div class='button center' style="margin-top: 20px;">
                                <input class="btn btn-primary btn-sm" type="submit" name="simpan" value="Ubah Data" id="validateButton2">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-2"></div>
            </div>
        </form>

        <?php
        break;

        case "editpassword":
        $result = mysqli_query($connect, "SELECT * FROM pelanggan WHERE pelanggan_username='$_GET[id]'");
        $a      = mysqli_fetch_array($result);
        ?>

        <form action="<?php echo $action ?>" method="post" enctype="multipart/form-data" id="exampleStandardForm" autocomplete="off">
            <div class="page-content container-fluid">
                <div class="col-md-2"></div>
                <div class="col-md-8">
                    <div class="panel">
                        <div class="panel-heading">
                            <h5 class="panel-title">Edit Password Profile</h5>
                        </div>
                        <div class="panel-body container-fluid">
                            <div class="form-group form-material">
                                <label class="control-label" for="inputText">Username</label>
                                <input type="text" class="form-control input-sm" id="pelanggan_username" name="pelanggan_username" placeholder="Masukan Username"
                                    value="<?php echo $a['pelanggan_username']?>" readonly required/>
                            </div>
                            <div class="form-group form-material">
                                <label class="control-label" for="inputText">New Password</label>
                                <input type="password" class="form-control input-sm" id="pelanggan_password" name="pelanggan_password" placeholder="Masukan Password"
                                    value="" required/>
                            </div>
                            <div class='button center' style="margin-top: 20px;">
                                <input class="btn btn-primary btn-sm" type="submit" name="simpan" value="Ubah Data" id="validateButton2">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-2"></div>
            </div>
        </form>

        <?php
        break;
    } }
?>