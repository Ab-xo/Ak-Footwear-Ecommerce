<?php
include("header.php");
include("sidebar.php");
if (!isset($_SESSION["adminid"])) {
    header('location: login.php');
    exit();
}

// Database connection
include("../includes/dbh.inc.php");

// Pagination variables
$page_no = isset($_GET['page_no']) ? (int)$_GET['page_no'] : 1;
$total_records_per_page = 6;
$offset = ($page_no - 1) * $total_records_per_page;

// Fetch total records for pagination
$stmt3 = $conn->prepare("SELECT COUNT(*) AS total_records FROM products");
if ($stmt3 === false) {
    die('Prepare failed: ' . htmlspecialchars($conn->error));
}
$stmt3->execute();
$stmt3->bind_result($total_records);
$stmt3->store_result();
$stmt3->fetch();

// Calculate total pages
$total_no_of_pages = ceil($total_records / $total_records_per_page);

// Fetch products with pagination
$stmt4 = $conn->prepare("SELECT * FROM products LIMIT ?, ?");
if ($stmt4 === false) {
    die('Prepare failed: ' . htmlspecialchars($conn->error));
}
$stmt4->bind_param("ii", $offset, $total_records_per_page);
$stmt4->execute();
$products = $stmt4->get_result();
?>

<div class="page-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <h3 class="mb-3">Products</h3>
                <table class="table table-modern">
                    <thead>
                        <tr>
                            <th>Product ID</th>
                            <th>Product Image</th>
                            <th>Product Name</th>
                            <th>Product Price</th>
                            <th>Product Category</th>
                            <th>Product Quantity</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($product = $products->fetch_assoc()) { ?>
                            <tr>
                                <td style="display:none;"><?php echo htmlspecialchars($product['id']); ?></td>
                                <td><?php echo htmlspecialchars($product['product_identity']); ?></td>
                                <td>
                                    <div class="image-container">
                                        <img class="product-image" src="../products/<?php echo htmlspecialchars($product['product_image']); ?>" alt="Product Image">
                                        <a href="edit_images.php?product_id=<?php echo $product['id']; ?>" class="edit-images-button">Edit Images</a>
                                    </div>
                                </td>
                                <td><?php echo htmlspecialchars($product['product_name']); ?></td>
                                <td><?php echo htmlspecialchars($product['product_price']); ?></td>
                                <td><?php echo htmlspecialchars($product['product_category']); ?></td>
                                <td><?php echo htmlspecialchars($product['product_quantity']); ?></td>
                                <td><a class="btn btn-sm btn-primary" href="edit_products.php?product_id=<?php echo $product['id']; ?>">Edit</a></td>
                                <td><a class="btn btn-sm btn-danger" href="../admin-includes/delete_products.adm.php?product_id=<?php echo $product['id']; ?>" onclick="return confirm('Are you sure you want to delete this product?');">Delete</a></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
        <!-- Pagination -->
        <div class="row">
            <div class="col-md-12">
                <nav aria-label="Page navigation">
                    <ul class="pagination">
                        <?php if ($page_no > 1) { ?>
                            <li class="page-item"><a class="page-link" href="?page_no=1">First Page</a></li>
                        <?php } ?>
                        <li class="page-item <?php if ($page_no <= 1) { echo 'disabled'; } ?>">
                            <a class="page-link" <?php if ($page_no > 1) { echo "href='?page_no=" . ($page_no - 1) . "'"; } ?>>Previous</a>
                        </li>
                        <li class="page-item <?php if ($page_no >= $total_no_of_pages) { echo 'disabled'; } ?>">
                            <a class="page-link" <?php if ($page_no < $total_no_of_pages) { echo "href='?page_no=" . ($page_no + 1) . "'"; } ?>>Next</a>
                        </li>
                        <?php if ($page_no < $total_no_of_pages) { ?>
                            <li class="page-item"><a class="page-link" href="?page_no=<?php echo $total_no_of_pages; ?>">Last &rsaquo;&rsaquo;</a></li>
                        <?php } ?>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap Modal for Messages -->
<div class="modal fade" id="messageModal" tabindex="-1" role="dialog" aria-labelledby="messageModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="messageModalLabel">Message</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?php
                if (isset($_GET['update'])) {
                    if ($_GET['update'] == 'success') {
                        echo "Product updated successfully.";
                    } elseif ($_GET['update'] == 'error') {
                        echo "Failed to update the product.";
                    }
                }

                if (isset($_GET['delete'])) {
                    if ($_GET['delete'] == 'success') {
                        echo "Product deleted successfully.";
                    } elseif ($_GET['delete'] == 'error') {
                        echo "Failed to delete the product.";
                    }
                }
                ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- jQuery and Bootstrap scripts -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>

<?php if ((isset($_GET['update']) && ($_GET['update'] == 'success' || $_GET['update'] == 'error')) || 
          (isset($_GET['delete']) && ($_GET['delete'] == 'success' || $_GET['delete'] == 'error'))) { ?>
    <script>
        $(document).ready(function() {
            $('#messageModal').modal('show');
        });
    </script>
<?php } ?>
<style>
    .product-image {
        width: 100%;
        height: auto;
        display: block;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s ease;
    }

    .product-image:hover {
        transform: scale(1.05);
    }

    .image-container {
        position: relative;
        display: inline-block;
        overflow: hidden;
    }

    .edit-images-button {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%) scale(0);
        background-color: rgba(0, 0, 0, 0.6);
        color: white;
        padding: 10px 20px;
        border-radius: 5px;
        text-align: center;
        text-decoration: none;
        opacity: 0;
        transition: opacity 0.3s ease, transform 0.3s ease;
    }

    .image-container:hover .edit-images-button {
        transform: translate(-50%, -50%) scale(1);
        opacity: 1;
    }

    td {
        max-width: 150px;
    }
</style>
