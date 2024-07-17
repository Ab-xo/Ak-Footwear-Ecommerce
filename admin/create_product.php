<?php
include("header.php");
include("sidebar.php");
if (!isset($_SESSION["adminid"])) {
    echo "<script>window.location.href ='login.php';</script>";
    exit();
}

?>

<!-- Create Product Page Content -->
<div class="page-content py-5">
    <div class="container">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <h3 class="mb-4 text-center">Create New Product</h3>
                <form action="../admin-includes/create_product.adm.php" method="POST" class="form-modern" enctype="multipart/form-data">

                   <div class="form-group">
                        <label for="product_image">Product Image</label>
                        <div class="image-upload-container d-flex align-items-center">
                            <input type="file" id="product_image" name="product_image" class="form-control-file" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="product_name">Product Name</label>
                        <input type="text" id="product_name" name="product_name" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="product_identity">Product Identity</label>
                        <input type="text" id="product_identity" name="product_identity" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="product_price">Product Price</label>
                        <input type="number" id="product_price" name="product_price" class="form-control" required step="0.01">
                    </div>
                    <div class="form-group">
                        <label for="product_name">Product Category</label>
                        <input type="text" id="product_category" name="product_category" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="product_name">Product Quantity</label>
                        <input type="text" id="product_quantity" name="product_quantity" class="form-control" required>
                    </div>
 <!-- #region -->    <div class="form-group">
                         <label for="product_name">Product Arrival</label>
                        <input type="text" id="product_arrival" name="product_arrival" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="product_description">Product Description</label>
                        <textarea id="product_description" name="product_description" class="form-control" rows="4" required></textarea>
                    </div>
                    
                    <div class="form-group">
                        <label for="product_description">Product Details</label>
                        <textarea id="product_details" name="product_details" class="form-control" rows="7" required></textarea>
                    </div>

                    

                    <button type="submit" class="btn btn-primary btn-block">Create Product</button>
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

    .image-upload-container {
        width: 100%;
    }
</style>