<?php
$result;
function emptyInputSignup($name, $email, $username, $pwd, $pwdRepeat)
{
  if (empty($name) || empty($email) || empty($username) || empty($pwd) || empty($pwdRepeat)) {
    $result = true;
  } else {
    $result = false;
  }
  return $result;
}
function invalidUid($username)
{
  if (!preg_match("/^[a-zA-Z0-9_.-]{3,16}$/",  $username)) {
    $result = true;
  } else {
    $result = false;
  }
  return $result;
}

function InvalidEmail($email)
{
  if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $result = true;
  } else {
    $result = false;
  }
  return $result;
}

function pwdMatch($pwd, $pwdRepeat)
{
  if ($pwd !== $pwdRepeat) {
    $result = true;
  } else {
    $result = false;
  }
  return $result;
}
function pwdStrong($pwd)
{
  if (strlen($pwd) >= 6 && preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{6,}$/', $pwd)) {
    $result = false;
  } else {
    $result = true;
  }
  return $result;
}

function uidExists($conn, $username, $email)
{

  $sql = "SELECT * FROM users WHERE usersUid = ? OR usersEmail = ?;";
  $stmt = mysqli_stmt_init($conn);

  if (!mysqli_stmt_prepare($stmt, $sql)) {
    header("location: ../signup.php?error=StatmentField");
    exit();
  }
  mysqli_stmt_bind_param($stmt, "ss", $username, $email);
  mysqli_stmt_execute($stmt);

  $resultData = mysqli_stmt_get_result($stmt);

  if ($row = mysqli_fetch_assoc($resultData)) {
    return $row;
  } else {

    $result = false;
    return $result;
  }

}
function createUser($conn, $name, $email, $username, $pwd)
{

  $sql = "INSERT INTO users (usersName,usersEmail,usersUid,usersPwd) VALUES (?, ?, ?, ?)";
  $stmt = mysqli_stmt_init($conn);

  if (!mysqli_stmt_prepare($stmt, $sql)) {
    header("location: ../signup.php?error=StatmentFailed");
    exit();
  }
  $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);

  mysqli_stmt_bind_param($stmt, "ssss", $name, $email, $username, $hashedPwd);
  mysqli_stmt_execute($stmt);
  mysqli_stmt_close($stmt);
  session_start();
  $_SESSION['registration_success'] = true;

  // Redirect to login page with success message 
  header("location: ../login.php?error=RegisterSuccessfully");
  exit();
}

function emptyInputLogin($username, $pwd)
{
  if (empty($username) || empty($pwd)) {
    $result = true;
  } else {
    $result = false;
  }
  return $result;
}

function loginUser($conn, $username, $pwd)
{

  $uidExists = uidExists($conn, $username, $username);

  if ($uidExists === false) {
    header("location: ../login.php?error=The username you entered is not found. Please try again.");
    exit();
  }
  $pwdHashed =   $uidExists["usersPwd"];
  $checkPwd = password_verify($pwd, $pwdHashed);

  if ($checkPwd === false) {
    header("location: ../login.php?error=The password you entered is incorrect. Please try again.");
    exit();
  } else if ($checkPwd === true) {
    session_start();
    $_SESSION["userid"] = $uidExists["usersId"];
    $_SESSION["useruid"] = $uidExists["usersUid"];
    $_SESSION["logged_in"] = true;
    header("location: ../index.php");
    exit();
  }
}
