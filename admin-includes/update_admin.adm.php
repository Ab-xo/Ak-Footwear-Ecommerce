<?php
session_start(); // Ensure session is started
include('../includes/dbh.inc.php'); // Assuming this file contains your database connection details

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = md5($_POST['password']); // Hash the password for security
    $admin_id = $_SESSION["adminid"];

    $sql = "UPDATE admins SET admin_username = ?, admin_email = ?, admin_password = ? WHERE admin_id = ?";
    $stmt = $conn->prepare($sql);

    if ($stmt === false) {
        die('Prepare failed: ' . htmlspecialchars($conn->error));
    }

    $stmt->bind_param("sssi", $username, $email, $password, $admin_id);

    if ($stmt->execute()) {
        echo "<script>alert('Admin details updated successfully'); window.location.href='../admin/account.php';</script>";
    } else {
        echo "<script>alert('Error updating admin details'); window.location.href='../admin/account.php';</script>";
    }
    
    $stmt->close();
}

$conn->close();

