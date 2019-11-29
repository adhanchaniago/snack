<?php
  session_start();
  unset($_SESSION["pelanggan_username"]);
  unset($_SESSION["pelanggan_name"]);
  unset($_SESSION["pelanggan_password"]);
  unset($_SESSION["pelanggan_notelp"]);
  unset($_SESSION["pelanggan_address"]);
  unset($_SESSION["pelanggan_saldo"]);
  unset($_SESSION["toko_id"]);

  header('location: ../../index.php');
?>
