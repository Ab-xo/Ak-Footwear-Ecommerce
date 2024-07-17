<?php
include("../includes/dbh.inc.php");
session_start();

if (!isset($_SESSION["adminid"])) {
    header('location: login.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $product_id = $_POST['product_id'];
    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];
    $product_category = $_POST['product_category'];
    $product_quantity = $_POST['product_quantity'];
    $product_arrival=$_POST['product_arrival'];
    $product_description = $_POST['product_description'];
    $product_details =$_POST['product_details'];

    // Handle file upload
    $product_image = $_FILES['product_image']['name'];
    $target_dir = "../products/";
    $target_file = $target_dir . basename($product_image);

    if (!empty($product_image)) {
        // Only update image if a new file is uploaded
        if (move_uploaded_file($_FILES['product_image']['tmp_name'], $target_file)) {
            $stmt = $conn->prepare("UPDATE products SET product_name=?, product_price=?, product_category=?, product_quantity=?, product_arrival=?, product_description=?, product_image=?, product_details=? WHERE id=?");
            $stmt->bind_param('ssssssssi', $product_name, $product_price, $product_category, $product_quantity, $product_arrival, $product_description, $product_image,$product_details, $product_id);
        } else {
            header("Location: products.php?update=error&message=Error uploading image.");
            exit();
        }
    } else {
        // Update without changing the image
        $stmt = $conn->prepare("UPDATE products SET product_name=?, product_price=?, product_category=?, product_quantity=?,product_arrival=?, product_description=?,product_details=? WHERE id=?");
        $stmt->bind_param('sssssssi', $product_name, $product_price, $product_category, $product_quantity,$product_arrival, $product_description,$product_details, $product_id);
    }

    if ($stmt->execute()) {
        header("Location:../admin/products.php?update=success&message=Product updated successfully!");
    } else {
        header("Location: ../admin/products.php?update=error&message=Error updating record: " . htmlspecialchars($stmt->error));
    }

    $stmt->close();
    $conn->close();
}

