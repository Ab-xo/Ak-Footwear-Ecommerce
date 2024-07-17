<?php 
// Database connection
include("../includes/dbh.inc.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $product_name = $_POST['product_name'];
    $product_identity = $_POST['product_identity'];
    $product_price = $_POST['product_price'];
    $product_description = $_POST['product_description'];
    $product_image = handleFileUpload('product_image');
    $product_category =$_POST['product_category'];
    $product_quantity =$_POST['product_quantity'];
    $product_arrival=$_POST['product_arrival'];
    $product_details =$_POST['product_details'];


    // Prepare SQL statement to insert new product
    $stmt = $conn->prepare("INSERT INTO products (product_name, product_identity, product_price, product_description, product_image,product_category,product_quantity,product_arrival,product_details) VALUES (?, ?, ?, ?, ?,?,?,?,?)");
    $stmt->bind_param('ssdsssiss', $product_name, $product_identity, $product_price, $product_description, $product_image,$product_category,$product_quantity,$product_arrival,$product_details);

    if ($stmt->execute()) {
        // Redirect after successful creation
        header("Location: ../admin/products.php?create=success&message=Product created successfully!");
    } else {
        // Error creating product
        echo "Error creating product: " . htmlspecialchars($stmt->error);
    }

    $stmt->close();
    $conn->close();
}

// Function to handle file upload
function handleFileUpload($input_name) {
    if ($_FILES[$input_name]['error'] == UPLOAD_ERR_OK) {
        $target_dir = "../products/";
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
                // Return the image file name to be stored in the database
                return basename($_FILES[$input_name]["name"]);
            } else {
                echo "Sorry, there was an error uploading your file.";
                exit();
            }
        } else {
            echo "File is not an image.";
            exit();
        }
    }
    return "";
}