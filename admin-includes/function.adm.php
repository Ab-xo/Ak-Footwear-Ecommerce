<?php
$result;
function uidExists($conn, $username, $email)
{

  $sql = "SELECT * FROM admins WHERE admin_username = ? OR admin_email  = ? LIMIT 1;";
  $stmt = mysqli_stmt_init($conn);

  if (!mysqli_stmt_prepare($stmt, $sql)) {
    header("location: ../admin/login.php?error=StatmentField");
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
function emptyInputadminLogin($username, $pwd)
{
  if (empty($username) || empty($pwd)) {
    $result = true;
  } else {
    $result = false;
  }
  return $result;
}

function adminloginUser($conn, $username, $pwd)
{
    $uidExists = uidExists($conn, $username, $username);

    if ($uidExists === false) {
        header("location: ../admin/login.php?error=The username you entered is not found. Please try again.");
        exit();
    }

    // Extract the stored hashed password from the database
    $pwdHashed = $uidExists["admin_password"];

    // Hash the password entered by the user using MD5
    $pwdEnteredHashed = md5($pwd);

    // Compare the hashed passwords
    if ($pwdEnteredHashed !== $pwdHashed) {
        header("location: ../admin/login.php?error=The password you entered is incorrect. Please try again.");
        exit();
    } else {
        session_start();
        $_SESSION["adminid"] = $uidExists["admin_id"];
        $_SESSION["adminuid"] = $uidExists["admin_username"];
        $_SESSION["admin_logged_in"] = true;
        header("location: ../admin/index.php?message=logged in successfully");
        exit();
    }
}

