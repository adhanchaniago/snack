<?php
    include "../../../config/include.php";

$module=$_GET['module'];
$act=$_GET['act'];

// Accept
if ($module=='invoiceprocess' AND $act=='accept'){
  $sql = "UPDATE invoice SET
              invoice_cancel  = '',
              invoice_status  = 'done'
            WHERE invoice_id = '$_GET[id]'";

    $sql2 = "UPDATE transaction SET
                  transaction_status  = 'done'
    WHERE invoice_id = '$_GET[id]'";

if (mysqli_query($connect, $sql2) && mysqli_query($connect, $sql)) {
    header('location:../../media.php?module='.$module);
  }
}
// Cancel
elseif ($module=='invoiceprocess' AND $act=='cancel'){
    $sql = "UPDATE invoice SET
              invoice_cancel  = '$_POST[invoice_cancel]',
              invoice_status  = 'cancel'
            WHERE invoice_id = '$_POST[invoice_id]'";

    $sql2 = "UPDATE transaction SET
    transaction_status  = 'cancel'
    WHERE invoice_id = '$_POST[invoice_id]'";

  if (mysqli_query($connect, $sql) && mysqli_query($connect, $sql2)) {
    header('location:../../media.php?module='.$module);
  }
}
?>