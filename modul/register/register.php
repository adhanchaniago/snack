<?php 
    if (!empty($_SESSION['pelanggan_username']) AND !empty($_SESSION['pelanggan_password'])){
        echo "<script>location='media.php?module=home';</script>";
    } else {
    $action="admin/modul/pelanggan/action.php?module=".$_GET['module']."&act=".$_GET['act']; 
    switch($_GET['act']) {
        case "add":
        ?>
<form action="<?php echo $action ?>" method="post" enctype="multipart/form-data" id="exampleStandardForm" autocomplete="off">
    <div class="page-content container-fluid">
        <div class="col-md-6">
            <div class="panel">
                <div class="panel-heading">
                    <h5 class="panel-title">Daftar</h5>
                </div>
                <div class="panel-body container-fluid">
                    <div class="form-group form-material">
                        <label class="control-label" for="inputText">Username</label>
                        <input type="text" class="form-control input-sm" id="pelanggan_username" name="pelanggan_username" placeholder="Masukan Username"
                            value="" required/>
                    </div>
                    <div class="form-group form-material">
                        <label class="control-label" for="inputText">Password</label>
                        <input type="password" class="form-control input-sm" id="pelanggan_password" name="pelanggan_password" placeholder="Masukan Password"
                            value="" required/>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="panel">
                <div class="panel-body container-fluid">
                    <div class="form-group form-material">
                        <label class="control-label" for="inputText">Nama</label>
                        <input type="text" class="form-control input-sm" id="pelanggan_name" name="pelanggan_name" placeholder="Masukan Nama" value=""
                            required/>
                    </div>
                    <div class="form-group form-material">
                        <label class="control-label" for="inputText">No Telp</label>
                        <input type="text" class="form-control input-sm" id="pelanggan_notelp" name="pelanggan_notelp" placeholder="Masukan No Telp"
                            value="" required/>
                    </div>
                    <div class="form-group form-material">
                        <label class="control-label" for="inputText">Alamat</label>
                        <input type="text" class="form-control input-sm" id="pelanggan_alamat" name="pelanggan_alamat" placeholder="Masukan Alamat"
                            value="" required/>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class='button text-center'>
                <input class="btn btn-primary btn-sm" type="submit" name="simpan" value="Register" id="validateButton2">
                <a class="btn btn-default btn-sm" href="?module=login">Masuk</a>
            </div>
        </div>
    </div>
</form>
<?php 
break;
    }
}
    ?>