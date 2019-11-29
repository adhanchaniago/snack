<?php

    $action="modul/cod/action.php?module=".$_GET['module']."&act=".$_GET['act'];
    switch($_GET['act']) {
        case "edit":
        ?>

    <form action="<?php echo $action ?>" method="post" enctype="multipart/form-data" id="exampleStandardForm" autocomplete="off">
        <div class="page-content container-fluid">
            <div class="col-md-6 col-md-offset-3">
                <div class="panel">
                    <div class="panel-heading">
                        <h5 class="panel-title">Ongkos Kirim COD</h5>
                    </div>
                    <div class="panel-body container-fluid">
                        <input type="hidden" name="identitas_id" value="<?php echo $w['identitas_id']?>" />
                        <div class="form-group form-material">
                            <label class="control-label" for="inputText">Ongkos Kirim Jauh Dekat</label>
                            <input type="text" class="form-control input-sm" id="identitas_cod" name="identitas_cod" placeholder="Masukan Ongkos Kirim Jauh Dekat"
                                value="<?php echo $w['identitas_cod']?>" required/>
                        </div>
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