<?php
    include "../../config/include.php";

$module=$_GET['module'];
$act=$_GET['act'];

session_start();
// Accept
if ($module=='transactionprocess' AND $act=='accept2'){
  $sql = "UPDATE invoice SET
              invoice_cancel  = '',
              invoice_statustoko  = 'done',
              invoice_status  = 'done'
            WHERE invoice_id = '$_GET[id]'";

    $sql2 = "UPDATE transaction SET
   transaction_statustoko  = 'process',
                  transaction_status  = 'done'
    WHERE invoice_id = '$_GET[id]'";

if (mysqli_query($connect, $sql2) && mysqli_query($connect, $sql)) {
    header('location:../../media.php?module='.$module);
  }
}

// Accept
if ($module=='transactionprocess' AND $act=='accept'){
  $sql = "UPDATE invoice SET
              invoice_cancel  = '',
              invoice_statustoko  = 'process',
              invoice_status  = 'process'
            WHERE invoice_id = '$_GET[id]'";

    $sql2 = "UPDATE transaction SET
   transaction_statustoko  = 'process',
                  transaction_status  = 'process'
    WHERE invoice_id = '$_GET[id]'";

if (mysqli_query($connect, $sql2) && mysqli_query($connect, $sql)) {
    header('location:../../media.php?module='.$module);
  }
}
// No Resi
elseif ($module=='transactionprocess' AND $act=='processaccept'){
  $sql = "UPDATE invoice SET
  invoice_statustoko  = 'processacceptresi'
WHERE invoice_id = '$_POST[invoice_id]'";

    $sql2 = "UPDATE transaction SET
    transaction_statustoko  = 'processacceptresi',
    transaction_noresi  = '$_POST[invoice_noresi]'
    WHERE invoice_id = '$_POST[invoice_id]' AND toko_id = '$_POST[toko_id]'";

if (mysqli_query($connect, $sql2) && mysqli_query($connect, $sql)) {
    header('location:../../media.php?module='.$module);
  }
}

// Select Driver
elseif ($module=='transactionprocess' AND $act=='selectdriveraccept'){
  
  $website = mysqli_query($connect, "SELECT * FROM identitas WHERE identitas_id=1");
  while ($w = mysqli_fetch_array($website)) { 
    $driver = mysqli_query($connect, "SELECT * FROM driver WHERE driver_username='$_POST[driver_username]'");
    while ($d = mysqli_fetch_array($driver)) { 
  $sql = "UPDATE invoice SET
  invoice_statustoko  = 'selectdriveracceptdriver'
WHERE invoice_id = '$_POST[invoice_id]'";

    $sql2 = "UPDATE transaction SET
    transaction_statustoko  = 'selectdriveracceptdriver',
    driver_username  = '$_POST[driver_username]'
    WHERE invoice_id = '$_POST[invoice_id]' AND toko_id = '$_POST[toko_id]'";

$saldo = $d['driver_saldo'] + $w['identitas_cod'];
$sql3 = "UPDATE driver SET
driver_saldo  = '$saldo'
WHERE driver_username = '$_POST[driver_username]'";

if (mysqli_query($connect, $sql2) && mysqli_query($connect, $sql) && mysqli_query($connect, $sql3)) {
    header('location:../../media.php?module='.$module);
  }
}
}

// Select Driver
} elseif ($module=='transactionprocess' AND $act=='driver'){
  
    $sql2 = "UPDATE transaction SET
    transaction_statustoko  = 'drivertopelanggan'
    WHERE invoice_id = '$_GET[id]' AND toko_id = '$_SESSION[toko_id]'";

if (mysqli_query($connect, $sql2)) {
  header('location:../../media.php?module='.$module);
  }
}

?>