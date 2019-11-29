<div class="page-content">
    <div class="panel">
        <div class="panel-heading">
            <h3 class="panel-title">Selamat datang di Halaman Administrator</h3>
        </div>
        <div class="panel-body container-fluid">
            <div class="blockquote gray">
                <h3>Hallo,
                    <?php echo $_SESSION['name'] ?>
                </h3>
                <p>Sistem informasi ini untuk administrator atau operator menjalankan data yang akan dibuat</p>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-3 col-xs-6">
            <div class="small-box bg-aqua">
                <div class="inner">
                    <h3>
                       <?php 
                        $jmldata = mysqli_num_rows(mysqli_query($connect, "SELECT * FROM pelanggan"));
                        echo $jmldata;
                       ?>
                    </h3>
                    <p>Pelanggan</p>
                </div>
                <div class="icon">
                    <i class="fa fa-users"></i>
                </div>
                <a href="?module=pelanggan" class="small-box-footer">
                    Lihat Pelanggan
                    <i class="fa fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
        <div class="col-lg-3 col-xs-6">
            <div class="small-box bg-yellow">
                <div class="inner">
                    <h3>
                    <?php 
                     $jmldata = mysqli_num_rows(mysqli_query($connect, "SELECT * FROM invoice WHERE invoice_status='process'"));
                     echo $jmldata;
                    ?>
                    </h3>
                    <p> Pemesanan - Proses</p>
                </div>
                <div class="icon">
                    <i class="fa fa-file"></i>
                </div>
                <a href="?module=invoiceprocess" class="small-box-footer">
                    Lihat Pemesanan - Proses
                    <i class="fa fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
        <div class="col-lg-3 col-xs-6">
            <div class="small-box bg-green">
                <div class="inner">
                    <h3>
                    <?php 
                     $jmldata = mysqli_num_rows(mysqli_query($connect, "SELECT * FROM invoice WHERE invoice_status='done'"));
                     echo $jmldata;
                    ?>
                    </h3>
                    <p>Pemesanan - Selesai </p>
                </div>
                <div class="icon">
                    <i class="fa fa-file"></i>
                </div>
                <a href="?module=invoicedone" class="small-box-footer">
                    Lihat Pemesanan - Selesai
                    <i class="fa fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
        <div class="col-lg-3 col-xs-6">
            <div class="small-box bg-red">
                <div class="inner">
                    <h3>
                    <?php 
                     $jmldata = mysqli_num_rows(mysqli_query($connect, "SELECT * FROM invoice WHERE invoice_status='cancel'"));
                     echo $jmldata;
                    ?>
                    </h3>
                    <p>Pemesanan - Cancel</p>
                </div>
                <div class="icon">
                    <i class="fa fa-file"></i>
                </div>
                <a href="?module=invoicecancel" class="small-box-footer">
                    Lihat Pemesanan - Cancel
                    <i class="fa fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
    </div>
</div>