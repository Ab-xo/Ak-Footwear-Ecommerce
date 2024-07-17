<?php
include("header.php");
include("sidebar.php");

if (!isset($_SESSION["adminid"])) {
    header('location: login.php');
    exit();
}

// Database connection
include("../includes/dbh.inc.php");

if (isset($_GET['product_id'])) {
    $product_id = $_GET['product_id'];
    
    // Prepare the SQL statement to delete the product
    $stmt = $conn->prepare("DELETE FROM products WHERE id = ?");
    
    if ($stmt) {
        // Bind parameters and execute
        $stmt->bind_param('i', $product_id);
        if ($stmt->execute()) {
            // Redirect with success message
            header('Location: products.php?delete=success');
        } else {
            // Redirect with error message
            header('Location: products.php?delete=error');
        }
        $stmt->close();
    } else {
        // Redirect with error message
        header('Location: products.php?delete=error');
    }
} else {
    // Redirect with error message
    header('Location: products.php?delete=error');
}

$conn->close();
exit();
