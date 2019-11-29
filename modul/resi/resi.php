<form action="modul/resi/check_resi.php" method="post" enctype="multipart/form-data" id="exampleStandardForm" autocomplete="off">
    <div class="page-content container-fluid">
        <div class="col-md-3"></div>
        <div class="col-md-6">
            <div class="panel">
                <div class="panel-heading">
                    <h5 class="panel-title">Cek Resi</h5>
                </div>
                <div class="panel-body container-fluid">
                    <div class="form-group form-material">
                        <label class="control-label" for="inputText">No Resi</label>
                        <input type="text" class="form-control input-sm" id="no_resi" name="no_resi" placeholder="Masukan No Resi"
                            value="" required/>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3"></div>
        <div class="col-md-12">
            <div class='button text-center'>
                <input class="btn btn-primary btn-sm" type="submit" name="simpan" value="Cek Resi" id="validateButton2">
            </div>
        </div>
    </div>
</form>