<?php

include('../includes/dbh.inc.php'); // Assuming this file contains your database connection details

$sql = "SELECT admin_name, admin_username, admin_email FROM admins WHERE id = 1"; // Assuming the current admin has ID 1
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    echo json_encode($row);
} else {
    echo json_encode(['admin_name' => 'Admin', 'admin_username' => 'admin', 'admin_email' => 'admin@example.com']);
}

$conn->close();

