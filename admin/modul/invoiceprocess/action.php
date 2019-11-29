<?php
    include "../../../config/include.php";

$module=$_GET['module'];
$act=$_GET['act'];

// Accept2
if ($module=='invoiceprocess' AND $act=='accept2'){

  $invoice = mysqli_query($connect, "SELECT * FROM invoice WHERE invoice_id='$_GET[id]'");
  while ($i = mysqli_fetch_array($invoice)) {
            if($i['invoice_statustoko'] == 'processacceptresi') {
            $status= 'done';
            $statustoko= 'doneresi';
        } else {
            $status= 'done';
            $statustoko= 'donedriver';
            }
          }

  $sql = "UPDATE invoice SET
              invoice_cancel  = '',
              invoice_statustoko  = '$statustoko',
              invoice_status  = '$status'
            WHERE invoice_id = '$_GET[id]'";

    $sql2 = "UPDATE transaction SET
   transaction_statustoko  = '$statustoko',
                  transaction_status  = '$status'
    WHERE invoice_id = '$_GET[id]'";

if (mysqli_query($connect, $sql2) && mysqli_query($connect, $sql)) {
    header('location:../../media.php?module='.$module);
  }
}

// Accept
if ($module=='invoiceprocess' AND $act=='accept'){

  $invoice = mysqli_query($connect, "SELECT * FROM invoice WHERE invoice_id='$_GET[id]'");
  while ($i = mysqli_fetch_array($invoice)) {
            if($i['invoice_statustoko'] == 'process') {
            $status= 'process';
            $statustoko= 'processaccept';
        } else {
            $status= 'process';
            $statustoko= 'selectdriveraccept';
            }
          }

  $sql = "UPDATE invoice SET
              invoice_cancel  = '',
              invoice_statustoko  = '$statustoko',
              invoice_status  = '$status'
            WHERE invoice_id = '$_GET[id]'";

    $sql2 = "UPDATE transaction SET
   transaction_statustoko  = '$statustoko',
                  transaction_status  = '$status'
    WHERE invoice_id = '$_GET[id]'";

if (mysqli_query($connect, $sql2) && mysqli_query($connect, $sql)) {
    header('location:../../media.php?module='.$module);
  }
}
// Cancel
elseif ($module=='invoiceprocess' AND $act=='cancel'){
    $sql = "UPDATE invoice SET
              invoice_cancel  = '$_POST[invoice_cancel]',
    invoice_statustoko  = 'cancel',
              invoice_status  = 'cancel'
            WHERE invoice_id = '$_POST[invoice_id]'";

    $sql2 = "UPDATE transaction SET
    transaction_statustoko  = 'cancel',
    transaction_status  = 'cancel'
    WHERE invoice_id = '$_POST[invoice_id]'";

  if (mysqli_query($connect, $sql) && mysqli_query($connect, $sql2)) {
    header('location:../../media.php?module='.$module);
  }
}
?>