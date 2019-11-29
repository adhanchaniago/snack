<div class="page-content container-fluid">
    <?php
        $p      = new Paging;
        $batas  = 10;
        $posisi = $p->cariPosisi($batas);

        $result=mysqli_query($connect,"SELECT * FROM bank LIMIT $posisi,$batas");
        $jmldata = mysqli_num_rows(mysqli_query($connect, "SELECT * FROM menu"));
        if(mysqli_num_rows($result) === 0) { ?>
        <div class="col-md-12">
            <div class="panel">
                <div class="panel-heading">
                    <h5 class="panel-title">Daftar Bank Kosong</h5>
                </div>
            </div>
        </div>
        <?php } else { 
            while ($r=mysqli_fetch_array($result)) {
                ?>
        <div class="col-md-3 col-xs-6">
            <div class="panel">
                <div class="panel-heading">
                    <h5 class="panel-title text-center">
                        <?php echo $r['bank_type'] ?>
                    </h5>
                    <div class="desc" style="padding: 0px 20px 5px 20px;">
                        Atas Nama : <?php echo $r['bank_name'] ?>
                    </div>
                    <div class="price" style="padding: 0px 20px 30px 20px;color: red">
                    No Rek : <?php echo $r['bank_noaccount'] ?>
                    </div>
                </div>
            </div>
        </div>
        <?php } 
     $jmldata = mysqli_num_rows(mysqli_query($connect, "SELECT * FROM bank"));
     $jmlhalaman  = $p->jumlahHalaman($jmldata, $batas);
     $linkHalaman = $p->navHalaman($_GET['halaman'], $jmlhalaman);
     }?>
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