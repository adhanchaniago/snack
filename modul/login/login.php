<?php 
    if (!empty($_SESSION['pelanggan_username']) AND !empty($_SESSION['pelanggan_password'])){
        echo "<script>location='media.php?module=home';</script>";
    } else { 
        ?>
<form action="modul/login/check_login.php" method="post" enctype="multipart/form-data" id="exampleStandardForm" autocomplete="off">
    <div class="page-content container-fluid">
        <div class="col-md-3"></div>
        <div class="col-md-6">
            <div class="panel">
                <div class="panel-heading">
                    <h5 class="panel-title">Masuk</h5>
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
        <div class="col-md-3"></div>
        <div class="col-md-12">
            <div class='button text-center'>
                <input class="btn btn-primary btn-sm" type="submit" name="simpan" value="Masuk" id="validateButton2">
                <a class="btn btn-default btn-sm" href="?module=register&act=add">Daftar</a>
            </div>
        </div>
    </div>
</form>
    <?php } ?>