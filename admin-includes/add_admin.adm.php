<?php
session_start(); // Ensure session is started
include('../includes/dbh.inc.php'); // Assuming this file contains your database connection details

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $new_admin_name = $_POST['new_admin_name'];
    $new_username = $_POST['new_username'];
    $new_email = $_POST['new_email'];
    $new_password = md5($_POST['new_password']); // Hash the password for security

    $sql = "INSERT INTO admins (admin_name, admin_username, admin_email, admin_password) VALUES (?,?, ?, ?)";
    $stmt = $conn->prepare($sql);

    if ($stmt === false) {
        die('Prepare failed: ' . htmlspecialchars($conn->error));
    }

    $stmt->bind_param("ssss",$new_admin_name, $new_username, $new_email, $new_password);

    if ($stmt->execute()) {
        echo "<script>alert('New admin added successfully'); window.location.href='../admin/account.php';</script>";
    } else {
        echo "<script>alert('Error adding new admin'); window.location.href='../admin/account.php';</script>";
    }
    
    $stmt->close();
}

$conn->close();

