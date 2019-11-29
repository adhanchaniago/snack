<?php

    $action="modul/driver/action.php?module=".$_GET['module']."&act=".$_GET['act'];
    switch($_GET['act']) {
        default:
        ?>
<div class="page-content">
<div class="panel">
    <div class="panel-heading">
        <h3 class="panel-title">DRIVER</h3>
    </div>
    <div class="panel-body container-fluid">
        <div class="blockquote gray">
            <h3>Hallo</h3>
            <p>Silahkan Daftar menjadi Driver kami</p>
        </div>
        <div style="margin-top: 20px">

        <a class="btn btn-primary" href="?module=driver&act=add">Daftar</a>
        <a class="btn btn-primary" href="kurir">Sudah Punya Akun? Masuk</a>
    </div>
    </div>
</div>
    </div>
    <?php
        break;
        case "add":
        ?>

        <form action="<?php echo $action ?>" method="post" enctype="multipart/form-data" id="exampleStandardForm" autocomplete="off">
            <div class="page-content container-fluid">
                <div class="col-md-6">
                    <div class="panel">
                        <div class="panel-heading">
                            <h5 class="panel-title">Register Driver</h5>
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
                                <input type="text" class="form-control input-sm" id="driver_notelp" name="driver_notelp" placeholder="Masukan No Telp"
                                    value="" required/>
                            </div>
                            <div class="form-group form-material">
                                <label class="control-label" for="inputText">Alamat</label>
                                <input type="text" class="form-control input-sm" id="driver_alamat" name="driver_alamat" placeholder="Masukan Alamat"
                                    value="" required/>
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
                        <input class="btn btn-primary btn-sm" type="submit" name="simpan" value="Register Data" id="validateButton2">
                        <a class="btn btn-default btn-sm" href="?module=driver">Kembali</a>
                    </div>
                </div>
            </div>
        </form>

        <?php
        break;
    }
?>