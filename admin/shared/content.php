<?php

// Home
if ($_GET['module']=='home'){ ?>
  <?php include "modul/home/home.php"; ?>
<?php }

// Identitas Website
elseif ($_GET['module']=='website'){ ?>
  <?php include "modul/website/website.php"; ?>
<?php }

// User
elseif ($_GET['module']=='user'){ ?>
  <?php include "modul/user/user.php"; ?>
<?php } 

// Pelanggan
elseif ($_GET['module']=='pelanggan'){ ?>
  <?php include "modul/pelanggan/pelanggan.php"; ?>
<?php }

// Bank
elseif ($_GET['module']=='bank'){ ?>
  <?php include "modul/bank/bank.php"; ?>
<?php } 

// Driver
elseif ($_GET['module']=='driver'){ ?>
  <?php include "modul/driver/driver.php"; ?>
<?php } 

// Saldo Proses
elseif ($_GET['module']=='saldoprocess'){ ?>
  <?php include "modul/saldoprocess/saldoprocess.php"; ?>
<?php } 

// Saldo Selesai
elseif ($_GET['module']=='saldodone'){ ?>
  <?php include "modul/saldodone/saldodone.php"; ?>
<?php } 

// Saldo Cancel
elseif ($_GET['module']=='saldocancel'){ ?>
  <?php include "modul/saldocancel/saldocancel.php"; ?>
<?php } 

// Kategori
elseif ($_GET['module']=='category'){ ?>
  <?php include "modul/category/category.php"; ?>
<?php } 

// Ongkos Kirim
elseif ($_GET['module']=='ongkir'){ ?>
  <?php include "modul/ongkir/ongkir.php"; ?>
<?php } 

// Toko
elseif ($_GET['module']=='toko'){ ?>
  <?php include "modul/toko/toko.php"; ?>
<?php } 

// Ongkos Kirim Driver
elseif ($_GET['module']=='cod'){ ?>
  <?php include "modul/cod/cod.php"; ?>
<?php } 

// Saldo Toko
elseif ($_GET['module']=='saldotoko'){ ?>
  <?php include "modul/saldotoko/saldotoko.php"; ?>
<?php } 

// Saldo Driver
elseif ($_GET['module']=='saldodriver'){ ?>
  <?php include "modul/saldodriver/saldodriver.php"; ?>
<?php } 

// Toko
elseif ($_GET['module']=='toko'){ ?>
  <?php include "modul/toko/toko.php"; ?>
<?php } 

// Menu Makanan
elseif ($_GET['module']=='menu'){ ?>
  <?php include "modul/menu/menu.php"; ?>
<?php } 

// Pemesanan Proses
elseif ($_GET['module']=='invoiceprocess'){ ?>
  <?php include "modul/invoiceprocess/invoiceprocess.php"; ?>
<?php } 

// Pemesanan Selesai
elseif ($_GET['module']=='invoicedone'){ ?>
  <?php include "modul/invoicedone/invoicedone.php"; ?>
<?php } 

// Pemesanan Cancel
elseif ($_GET['module']=='invoicecancel'){ ?>
  <?php include "modul/invoicecancel/invoicecancel.php"; ?>
<?php } 

// Pemesanan COD
elseif ($_GET['module']=='invoicecod'){ ?>
  <?php include "modul/invoicecod/invoicecod.php"; ?>
<?php } 

// Laporan
elseif ($_GET['module']=='laporan'){ ?>
  <?php include "modul/laporan/laporan.php"; ?>
<?php } ?>
