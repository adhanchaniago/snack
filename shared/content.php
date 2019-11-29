<?php

// Home
if ($_GET['module']=='home'){ ?>
  <?php include "modul/home/home.php"; ?>
<?php } ?>

<?php
// Menu
if ($_GET['module']=='menu'){ ?>
  <?php include "modul/menu/menu.php"; ?>
<?php } ?>

<?php
// Saldo Toko
if ($_GET['module']=='saldotoko'){ ?>
  <?php include "modul/saldotoko/saldotoko.php"; ?>
<?php } ?>

<?php
// Toko
if ($_GET['module']=='toko'){ ?>
  <?php include "modul/toko/toko.php"; ?>
<?php } ?>

<?php
// Driver
if ($_GET['module']=='driver'){ ?>
  <?php include "modul/driver/driver.php"; ?>
<?php } ?>

<?php
// Resi
if ($_GET['module']=='resi'){ ?>
  <?php include "modul/resi/resi.php"; ?>
<?php } ?>


<?php
// Pembayaran
if ($_GET['module']=='payment'){ ?>
  <?php include "modul/payment/payment.php"; ?>
<?php } ?>


<?php
// Cart
if ($_GET['module']=='cart'){ ?>
  <?php include "modul/cart/cart.php"; ?>
<?php } ?>

<?php
// Checkout
if ($_GET['module']=='checkout'){ ?>
  <?php include "modul/checkout/checkout.php"; ?>
<?php } ?>

<?php
// Masuk
if ($_GET['module']=='login'){ ?>
  <?php include "modul/login/login.php"; ?>
<?php } ?>

<?php
// Daftar
if ($_GET['module']=='register'){ ?>
  <?php include "modul/register/register.php"; ?>
<?php } ?>

<?php
// User
if ($_GET['module']=='user'){ ?>
  <?php include "modul/user/user.php"; ?>
<?php } ?>

<?php
// Saldo Proses
if ($_GET['module']=='saldoprocess'){ ?>
  <?php include "modul/saldoprocess/saldoprocess.php"; ?>
<?php } 

// Saldo Selesai
if ($_GET['module']=='saldodone'){ ?>
  <?php include "modul/saldodone/saldodone.php"; ?>
<?php } 

// Saldo Cancel
if ($_GET['module']=='saldocancel'){ ?>
  <?php include "modul/saldocancel/saldocancel.php"; ?>
<?php } 

// Pemesanan Proses
if ($_GET['module']=='invoiceprocess'){ ?>
  <?php include "modul/invoiceprocess/invoiceprocess.php"; ?>
<?php } 

// Pemesanan Selesai
if ($_GET['module']=='invoicedone'){ ?>
  <?php include "modul/invoicedone/invoicedone.php"; ?>
<?php } 

// Pemesanan Cancel
if ($_GET['module']=='invoicecancel'){ ?>
  <?php include "modul/invoicecancel/invoicecancel.php"; ?>
<?php } 

// Pemesanan COD
if ($_GET['module']=='invoicecod'){ ?>
  <?php include "modul/invoicecod/invoicecod.php"; ?>
<?php } 

// Pemesanan Proses
if ($_GET['module']=='transactionprocess'){ ?>
  <?php include "modul/transactionprocess/transactionprocess.php"; ?>
<?php } 

// Pemesanan Selesai
if ($_GET['module']=='transactiondone'){ ?>
  <?php include "modul/transactiondone/transactiondone.php"; ?>
<?php } 

// Pemesanan Cancel
if ($_GET['module']=='transactioncancel'){ ?>
  <?php include "modul/transactioncancel/transactioncancel.php"; ?>
<?php } 

// Pemesanan COD
if ($_GET['module']=='transactioncod'){ ?>
  <?php include "modul/transactioncod/transactioncod.php"; ?>
<?php } 

?>
