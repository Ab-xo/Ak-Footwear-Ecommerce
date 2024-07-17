<?php
include("../includes/dbh.inc.php");
session_start();

if (!isset($_SESSION["adminid"])) {
    header('location: ../admin/login.php');
    exit();
}

// Function to handle file upload
function handleFileUpload($input_name, $existing_image) {
    if ($_FILES[$input_name]['error'] == UPLOAD_ERR_OK) {
        $target_dir = "../S-produts/";
        $target_file = $target_dir . basename($_FILES[$input_name]["name"]);
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Check if the file is an actual image
        $check = getimagesize($_FILES[$input_name]["tmp_name"]);
        if ($check !== false) {
            // Check file size
            if ($_FILES[$input_name]["size"] > 5000000) {
                echo "Sorry, your file is too large.";
                exit();
            }
            // Allow only certain file formats
            if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" && $imageFileType != "webp") {
                echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                exit();
            }
            // Move uploaded file to target directory
            if (move_uploaded_file($_FILES[$input_name]["tmp_name"], $target_file)) {
                // If a new file is uploaded, return the new filename
                return basename($_FILES[$input_name]["name"]);
            } else {
                echo "Sorry, there was an error uploading your file.";
                exit();
            }
        } else {
            echo "File is not an image.";
            exit();
        }
    } else {
        // If no new file is uploaded, return the existing filename
        return $existing_image;
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $product_id = $_POST['product_id'];

    // Retrieve existing product images
    $stmt = $conn->prepare("SELECT product_single_image1, product_single_image2, product_single_image3, product_single_image4 FROM products WHERE id = ?");
    $stmt->bind_param('i', $product_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $existing_images = $result->fetch_assoc();

    // Handle file uploads for each image
    $image1 = handleFileUpload('product_image1', $existing_images['product_single_image1']);
    $image2 = handleFileUpload('product_image2', $existing_images['product_single_image2']);
    $image3 = handleFileUpload('product_image3', $existing_images['product_single_image3']);
    $image4 = handleFileUpload('product_image4', $existing_images['product_single_image4']);

    // Prepare SQL statement to update product images
    $stmt = $conn->prepare("UPDATE products SET product_single_image1=?, product_single_image2=?, product_single_image3=?, product_single_image4=? WHERE id=?");
    $stmt->bind_param('ssssi', $image1, $image2, $image3, $image4, $product_id);

    // Execute the update query
    if ($stmt->execute()) {
        // Redirect after successful update
        header("Location:../admin/products.php?update=success&message=Product images updated successfully!");
    } else {
        // Error updating product images
        header("Location: ../admin/products.php?update=error&message=Error updating product images: " . htmlspecialchars($stmt->error));
    }

    $stmt->close();
    $conn->close();
}
