<?php
    include "../../config/include.php";

    $resi = $_POST['no_resi'];

    header('location:https://cekresi.com/?noresi='.$resi);
?>
