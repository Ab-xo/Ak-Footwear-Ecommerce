<?php
if (isset($_POST["admin-btn-login"])) {

  $username = $_POST["adminuid"];
  $pwd = $_POST["adminpwd"];

  require_once '../includes/dbh.inc.php';
  require_once 'function.adm.php';

  if (emptyInputadminLogin($username, $pwd) !== false) {
    header("location: ../admin/login.php?error=emptyinput");
    exit();
  }
  adminloginUser($conn, $username, $pwd);
} else {
  header("location: ../admin/login.php");
  exit();
}
