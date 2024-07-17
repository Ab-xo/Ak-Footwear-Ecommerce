<?php
include("header.php");
include("sidebar.php");

// Database connection
include("../includes/dbh.inc.php");

if (isset($_GET['order_id'])) {
    $order_id = $_GET['order_id'];
    
    // Prepare the SQL statement to delete the order
    $stmt = $conn->prepare("DELETE FROM orders WHERE order_id = ?");
    
    if ($stmt) {
        // Bind parameters and execute
        $stmt->bind_param('i', $order_id);
        if ($stmt->execute()) {
            // Redirect with success message
            header('Location:../admin/orders.php?delete=success');
        } else {
            // Redirect with error message
            header('Location: ../admin/orders.php?delete=error');
        }
        $stmt->close();
    } else {
        // Redirect with error message
        header('Location:../admin/orders.php?delete=error');
    }
} else {
    // Redirect with error message
    header('Location:../admin/orders.php?delete=error');
}

$conn->close();
exit();

