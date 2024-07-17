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
        <h3 class="mb-4 text-center">Edit Product</h3>
        <form action="../admin-includes/update_product.adm.php" method="POST" class="form-modern" enctype="multipart/form-data">
          <input type="hidden" name="product_id" value="<?php echo htmlspecialchars($product['id']); ?>">

          <div class="form-group">
            <label for="product_image">Product Image</label>
            <div class="d-flex align-items-center">
              <img src="../products/<?php echo htmlspecialchars($product['product_image']); ?>" alt="Product Image" class="img-thumbnail mr-3" style="width: 150px; height: 150px; object-fit: cover;">
              <input type="file" id="product_image" name="product_image" class="form-control-file">
            </div>
          </div>

          <div class="form-group">
            <label for="product_name">Product Name</label>
            <input type="text" id="product_name" name="product_name" class="form-control" value="<?php echo htmlspecialchars($product['product_name']); ?>">
          </div>

          <div class="form-group">
            <label for="product_price">Product Price</label>
            <input type="text" id="product_price" name="product_price" class="form-control" value="<?php echo htmlspecialchars($product['product_price']); ?>">
          </div>

          <div class="form-group">
            <label for="product_category">Product Category</label>
            <input type="text" id="product_category" name="product_category" class="form-control" value="<?php echo htmlspecialchars($product['product_category']); ?>">
          </div>

          <div class="form-group">
            <label for="product_quantity">Product Quantity</label>
            <input type="number" id="product_quantity" name="product_quantity" class="form-control" value="<?php echo htmlspecialchars($product['product_quantity']); ?>">
          </div>
          <div class="form-group">
            <label for="product_quantity">Product Arrival</label>
            <input type="text" id="product_arrival" name="product_arrival" class="form-control" value="<?php echo htmlspecialchars($product['product_arrival']); ?>">
          </div>

          <div class="form-group">
            <label for="product_description">Product Description</label>
            <textarea id="product_description" name="product_description" class="form-control" rows="3"><?php echo htmlspecialchars($product['product_description']); ?></textarea>
          </div>
          <div class="form-group">
            <label for="product_details">Product Details</label>
            <textarea id="product_details" name="product_details" class="form-control" rows="7"><?php echo htmlspecialchars($product['product_details']); ?></textarea>
          </div>

          <button type="submit" class="btn btn-primary btn-block">Update Product</button>
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

  .form-control {
    border-radius: 5px;
    border: 1px solid #ced4da;
    padding: 10px;
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
</style>
