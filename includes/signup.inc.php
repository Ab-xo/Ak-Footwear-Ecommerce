<?php
if (isset($_POST['submit'])) {
  $name = $_POST['name'];
  $email = $_POST['email'];
  $username = $_POST['uid'];
  $pwd = $_POST['pwd'];
  $pwdRepeat = $_POST['pwdrepeat'];

  require_once 'dbh.inc.php';
  require_once 'functions.inc.php';


  if (emptyInputSignup($name, $email, $username, $pwd, $pwdRepeat) !== false) {
    header("location: ../signup.php?error=Please fill out all fields. Some inputs are missing.");
    exit();
  }

  if (invalidUid($username) !== false) {
    header("location: ../signup.php?error=Please choose a valid username.");
    exit();
  }
  if (InvalidEmail($email) !== false) {
    header("location: ../signup.php?error=Please choose a valid Email.");
    exit();
  }

  if (pwdStrong($pwd) !== false) {
    header("location: ../signup.php?error=Please choose a strong password that is at least 6 characters long.");
    exit();
  }
  if (pwdMatch($pwd, $pwdRepeat) !== false) {
    header("location: ../signup.php?error=The passwords you entered do not match.");
    exit();
  }
  if (uidExists($conn, $username, $email) !== false) {
    header("location: ../signup.php?error=The username or email is already taken. Please choose another.");
    exit();
  }
  createUser($conn, $name, $email, $username, $pwd);
} else {
  header("location: ../signup.php");
  exit();
}
