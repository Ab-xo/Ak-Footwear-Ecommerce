<?php
if (isset($_POST["submit"])) {

  $username = $_POST["uid"];
  $pwd = $_POST["pwd"];

  // Check if the terms checkbox is checked
  if (!isset($_POST['terms'])) {
    header("location: ../login.php?error=Please ensure to check 'I accept all terms and conditions' before proceeding.");
    exit();
  }

  require_once 'dbh.inc.php';
  require_once 'functions.inc.php';

  if (emptyInputLogin($username, $pwd) !== false) {
    header("location: ../login.php?error=emptyinput");
    exit();
  }

  loginUser($conn, $username, $pwd);
} else {
  header("location: ../login.php");
  exit();
}
