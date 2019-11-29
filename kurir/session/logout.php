  <?php
    session_start();
    unset($_SESSION["driver_username"]);
    unset($_SESSION["driver_name"]);
    unset($_SESSION["driver_password"]);
    unset($_SESSION["driver_notelp"]);
    unset($_SESSION["driver_address"]);
    unset($_SESSION["driver_saldo"]);
    unset($_SESSION["driver_bank"]);
    unset($_SESSION["driver_owner"]);
    unset($_SESSION["driver_noaccount"]);

    header('location: ../index.php');
  ?>