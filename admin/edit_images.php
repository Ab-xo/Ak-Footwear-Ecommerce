<?php
include("header.php");
include("sidebar.php");

if (!isset($_SESSION["adminid"])) {
    header('location: login.php');
    exit();
}

// Database connection (assuming $conn is your connection variable)
include("../includes/dbh.inc.php");

if (isset($_GET['product_id'])) {
    $product_id = $_GET['product_id'];
    
    // Prepare the SQL statement
    $stmt = $conn->prepare("SELECT * FROM products WHERE id = ?");
    
    if ($stmt) {
        // Bind parameters and execute
        $stmt->bind_param('i', $product_id);
        $stmt->execute();
        
        // Get the result
        $product_result = $stmt->get_result();
        
        if ($product_result->num_rows > 0) {
            $product = $product_result->fetch_assoc();
        } else {
            echo "Product not found.";
            exit();
        }
    } else {
        echo "Failed to prepare the SQL statement.";
        exit();
    }
} else {
    echo "Product ID not provided.";
    exit();
}
?>
<!-- Edit Page Content -->
<div class="page-content py-5">
  <div class="container">
    <div class="row">
      <div class="col-md-8 offset-md-2">
        <h3 class="mb-4 text-center">Edit Single Product Images</h3>
        <form action="../admin-includes/update_S-products_image.adm.php" method="POST" class="form-modern" enctype="multipart/form-data">
          <input type="hidden" name="product_id" value="<?php echo htmlspecialchars($product['id']); ?>">

          <div class="form-group">
            <label for="product_image">Product Image 1</label>
            <div class="image-upload-container d-flex align-items-center">
              <img src="../S-produts/<?php echo htmlspecialchars($product['product_single_image1']); ?>" alt="Product Image" class="img-thumbnail mr-3">
              <input type="file" id="product_image" name="product_image1" class="form-control-file">
            </div>
          </div>

          <div class="form-group">
            <label for="product_image">Product Image 2</label>
            <div class="image-upload-container d-flex align-items-center">
              <img src="../S-produts/<?php echo htmlspecialchars($product['product_single_image2']); ?>" alt="Product Image" class="img-thumbnail mr-3">
              <input type="file" id="product_image" name="product_image2" class="form-control-file">
            </div>
          </div>

          <div class="form-group">
            <label for="product_image">Product Image 3</label>
            <div class="image-upload-container d-flex align-items-center">
              <img src="../S-produts/<?php echo htmlspecialchars($product['product_single_image3']); ?>" alt="Product Image" class="img-thumbnail mr-3">
              <input type="file" id="product_image" name="product_image3" class="form-control-file">
            </div>
          </div>

          <div class="form-group">
            <label for="product_image">Product Image 4</label>
            <div class="image-upload-container d-flex align-items-center">
              <img src="../S-produts/<?php echo htmlspecialchars($product['product_single_image4']); ?>" alt="Product Image" class="img-thumbnail mr-3">
              <input type="file" id="product_image" name="product_image4" class="form-control-file">
            </div>
          </div>
          <!-- Repeat the above structure for other images -->

          <button type="submit" class="btn btn-primary btn-block">Update Images</button>
          <a href="products.php" class="btn btn-secondary btn-block">Cancel</a>
        </form>
      </div>
    </div>
  </div>
</div>

<style>
  .page-content {
    background-color: #f8f9fa;
  }

  .form-modern {
    background: #fff;
    padding: 30px;
    border-radius: 10px;
    box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
  }

  .form-group label {
    font-weight: bold;
  }

  .form-control-file {
    font-size: 16px;
  }

  .btn-primary {
    background-color: #007bff;
    border: none;
    transition: background-color 0.3s ease;
  }

  .btn-primary:hover {
    background-color: #0056b3;
  }

  .btn-secondary {
    background-color: #6c757d;
    border: none;
    transition: background-color 0.3s ease;
  }

  .btn-secondary:hover {
    background-color: #5a6268;
  }

  .btn-block {
    display: block;
    width: 100%;
  }

  .image-upload-container img {
    width: 150px;
    height: 150px;
    object-fit: cover;
    border: 2px solid #007bff; /* Lovely border */
    border-radius: 10px; /* Rounded border */
    transition: transform 0.3s ease; /* Animation */
  }

  .image-upload-container img:hover {
    transform: scale(1.05); /* Zoom in effect on hover */
  }
</style>