<?php

    $action="modul/website/action.php?module=".$_GET['module']."&act=".$_GET['act'];
    switch($_GET['act']) {
        case "edit":
        ?>

    <form action="<?php echo $action ?>" method="post" enctype="multipart/form-data" id="exampleStandardForm" autocomplete="off">
        <div class="page-content container-fluid">
            <div class="col-md-6">
                <div class="panel">
                    <div class="panel-heading">
                        <h5 class="panel-title">Edit Identitas Website</h5>
                    </div>
                    <div class="panel-body container-fluid">
                        <input type="hidden" name="identitas_id" value="<?php echo $w['identitas_id']?>" />
                        <div class="form-group form-material">
                            <label class="control-label" for="inputText">Nama</label>
                            <input type="text" class="form-control input-sm" id="identitas_website" name="identitas_website" placeholder="Masukan Nama"
                                value="<?php echo $w['identitas_website']?>" required/>
                        </div>
                        <div class="form-group form-material">
                            <label class="control-label" for="inputText">Deskripsi</label>
                            <input type="text" class="form-control input-sm" id="identitas_deskripsi" name="identitas_deskripsi" placeholder="Masukan Deskripsi"
                                value="<?php echo $w['identitas_deskripsi']?>" required/>
                        </div>
                        <div class="form-group form-material">
                            <label class="control-label" for="inputText">Keyword</label>
                            <input type="text" class="form-control input-sm" id="identitas_keyword" name="identitas_keyword" placeholder="Masukan Keyword"
                                value="<?php echo $w['identitas_keyword']?>" required/>
                        </div>
                        <div class="form-group form-material">
                            <label class="control-label" for="inputText">Alamat</label>
                            <input type="text" class="form-control input-sm" id="identitas_alamat" name="identitas_alamat" placeholder="Masukan Alamat"
                                value="<?php echo $w['identitas_alamat']?>" required/>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="panel">
                    <div class="panel-body container-fluid">
                        <input type="hidden" name="identitas_id" value="<?php echo $w['identitas_id']?>" />
                        <div class="form-group form-material">
                            <label class="control-label" for="inputText">No Telp</label>
                            <input type="text" class="form-control input-sm" id="identitas_notelp" name="identitas_notelp" placeholder="Masukan No Telp"
                                value="<?php echo $w['identitas_notelp']?>" required/>
                        </div>
                        <div class="form-group form-material">
                            <label class="control-label" for="inputText">Author</label>
                            <input type="text" class="form-control input-sm" id="identitas_author" name="identitas_author" placeholder="Masukan Author"
                                value="<?php echo $w['identitas_author']?>" required/>
                        </div>
                        <div class="form-group form-material">
                            <label class="control-label" for="inputText">Logo</label>
                            <input type="text" readonly class="form-control input-sm" id="identitas_favicon" name="identitas_favicon" placeholder="Logo"
                                value="<?php echo $w['identitas_favicon']?>" required/>
                        </div>
                        <div class="form-material">
                            <label class="control-label" for="inputText">Ganti Logo</label>
                        </div>
                        <input name="fupload" type="file" class="form-control" id="fupload" />
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class='button text-center'>
                    <input class="btn btn-primary btn-sm" type="submit" name="simpan" value="Ubah Data" id="validateButton2">
                </div>
            </div>
        </div>
    </form>

    <?php
        break;
    }
?>