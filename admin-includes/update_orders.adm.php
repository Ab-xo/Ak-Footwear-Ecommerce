<?php
session_start();

if (!isset($_SESSION["adminid"])) {
    header('Location: ../admin/login.php');
    exit();
}

// Database connection
include("../includes/dbh.inc.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['order_id']) && isset($_POST['order_status'])) {
        $order_id = $_POST['order_id'];
        $order_status = $_POST['order_status'];

        // Update order status
        $stmt = $conn->prepare("UPDATE orders SET order_status = ? WHERE order_id = ?");
        if ($stmt) {
            $stmt->bind_param('si', $order_status, $order_id);
            if ($stmt->execute()) {
                header('Location: ../admin/orders.php?update=success');
            } else {
                header('Location: ../admin/orders.php?update=error');
            }
            $stmt->close();
        } else {
            header('Location: ../admin/orders.php?update=error');
        }
    } else {
        header('Location: ../admin/orders.php?update=error');
    }
} else {
    header('Location: ../admin/orders.php');
}

