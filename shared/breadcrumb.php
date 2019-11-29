<?php
// Home
if ($_GET['module']=='home'){ ?>
    <div class="page-title blue">
        <h3><?php echo $w['identitas_website']?></h3>
        <p>Selamat Datang di <?php echo $w['identitas_website']?>, silahkan pilih menu makanan sesuai keinginan anda :)</p>
    </div>
<?php } ?>

<?php
// Cart
if ($_GET['module']=='cart'){ ?>
    <div class="page-title blue">
        <h3>Keranjang Belanja</h3>
        <p>Keranjang belanja anda...</p>
    </div>
<?php } ?>

<?php
// Pembayaran
if ($_GET['module']=='payment'){ ?>
    <div class="page-title blue">
        <h3>Pembayaran</h3>
        <p>Lakukan pembayaran pada daftar bank dibawah ini..</p>
    </div>
<?php } ?>


<?php
// Checkout
if ($_GET['module']=='checkout'){ ?>
    <div class="page-title blue">
        <h3>Checkout</h3>
        <p>Konfirmasi pemesanan menu anda...</p>
    </div>
<?php } ?>

<?php
// Masuk
if ($_GET['module']=='login'){ ?>
    <div class="page-title blue">
        <h3>Login</h3>
        <p>Masukan Username & Password anda...</p>
    </div>
<?php } ?>

<?php
// Driver
if ($_GET['module']=='driver'){ ?>
    <div class="page-title blue">
        <h3>Driver</h3>
        <p>Antar Kiriman Pesanan...</p>
    </div>
<?php } ?>

<?php
// Resi
if ($_GET['module']=='resi'){ ?>
    <div class="page-title blue">
        <h3>Lacak Pesanan</h3>
        <p>Lacak Lokasi Pesanan Anda...</p>
    </div>
<?php } ?>

<?php
// Register
if ($_GET['module']=='register'){ ?>
    <div class="page-title blue">
        <h3>Daftar</h3>
        <p>Silahkan isi biodata anda secara lengkap...</p>
    </div>
<?php } ?>

<?php
// Makanan
if ($_GET['module']=='menu'){ ?>
    <div class="page-title blue">
        <h3>Menu Makanan</h3>
        <p>Informasi mengenai menu makanan anda...</p>
    </div>
<?php } ?>

<?php
// Toko
if ($_GET['module']=='toko'){ ?>
    <div class="page-title blue">
        <h3>Toko</h3>
        <p>Informasi mengenai Toko...</p>
    </div>
<?php } ?>

<?php
// Saldo Toko
if ($_GET['module']=='saldotoko'){ ?>
    <div class="page-title blue">
        <h3>Saldo Toko</h3>
        <p>Informasi mengenai Saldo Toko...</p>
    </div>
<?php } ?>

<?php
// Register
if ($_GET['module']=='user'){ ?>
    <div class="page-title blue">
        <h3>Profile</h3>
        <p>Biodata Diri Anda...</p>
    </div>
<?php } ?>

<?php
// Pemesanan Proses
if ($_GET['module']=='invoiceprocess'){ ?>
    <div class="page-title blue">
        <h3>Histori Pemesanan - Proses</h3>
        <p>Informasi Mengenai Data Pemesanan - Proses</p>
    </div>
<?php } ?>

<?php
// Pemesanan Selesai
if ($_GET['module']=='invoicedone'){ ?>
    <div class="page-title blue">
        <h3>Histori Pemesanan - Selesai</h3>
        <p>Informasi Mengenai Data Pemesanan - Selesai</p>
    </div>
<?php } ?>

<?php
// Pemesanan Cancel
if ($_GET['module']=='invoicecancel'){ ?>
    <div class="page-title blue">
        <h3>Histori Pemesanan - Cancel</h3>
        <p>Informasi Mengenai Data Pemesanan - Cancel</p>
    </div>
<?php } ?>

<?php
// Pemesanan COD
if ($_GET['module']=='invoicecod'){ ?>
    <div class="page-title blue">
        <h3>Histori Pemesanan - COD</h3>
        <p>Informasi Mengenai Data Pemesanan - COD</p>
    </div>
<?php } ?>

<?php
// Pemesanan Proses
if ($_GET['module']=='transactionprocess'){ ?>
    <div class="page-title blue">
        <h3>Pemesanan Toko - Proses</h3>
        <p>Informasi Mengenai Data Pemesanan Toko - Proses</p>
    </div>
<?php } ?>

<?php
// Saldo Pelanggan - Proses
if ($_GET['module']=='saldoprocess'){ ?>
    <div class="page-title blue">
        <h3>Saldo - Proses</h3>
        <p>Informasi Mengenai Data Saldo - Proses</p>
    </div>
<?php } ?>

<?php
// Saldo Pelanggan - Selesai
if ($_GET['module']=='saldodone'){ ?>
    <div class="page-title blue">
        <h3>Saldo - Selesai</h3>
        <p>Informasi Mengenai Data Saldo - Selesai</p>
    </div>
<?php } ?>

<?php
// Saldo Pelanggan - Cancel
if ($_GET['module']=='saldocancel'){ ?>
    <div class="page-title blue">
        <h3>Saldo - Cancel</h3>
        <p>Informasi Mengenai Data Saldo - Cancel</p>
    </div>
<?php } ?>

<?php
// Pemesanan Selesai
if ($_GET['module']=='transactiondone'){ ?>
    <div class="page-title blue">
        <h3>Pemesanan Toko - Selesai</h3>
        <p>Informasi Mengenai Data Pemesanan Toko - Selesai</p>
    </div>
<?php } ?>

<?php
// Pemesanan Cancel
if ($_GET['module']=='transactioncancel'){ ?>
    <div class="page-title blue">
        <h3>Pemesanan Toko - Cancel</h3>
        <p>Informasi Mengenai Data Pemesanan Toko - Cancel</p>
    </div>
<?php }

// Pemesanan COD
if ($_GET['module']=='transactioncod'){ ?>
    <div class="page-title blue">
        <h3>Pemesanan Toko - COD</h3>
        <p>Informasi Mengenai Data Pemesanan Toko - COD</p>
    </div>
<?php }

?>