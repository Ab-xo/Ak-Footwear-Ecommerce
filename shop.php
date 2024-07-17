<?php
include('Layouts/header.php');
include 'includes/dbh.inc.php';

// Initialize variables
$search_term = "";
$category = "";
$min_price = "";
$max_price = "";

// Check if search term is set
if (isset($_POST['search'])) {
    $search_term = $_POST['search'];
    $category = '%' . substr($search_term, 0, 3) . '%'; // Extract the first three letters of the search term and add % to match any category starting with those letters
    
    // Check if price range is set
    if (isset($_POST['min_price']) && isset($_POST['max_price'])) {
        $min_price = $_POST['min_price'];
        $max_price = $_POST['max_price'];

        // Prepare the SQL statement to search by product category and price range
        $stmt3 = $conn->prepare("SELECT COUNT(*) AS total_records FROM products WHERE LEFT(product_category, 3) LIKE ? AND product_price BETWEEN ? AND ?");
        if ($stmt3 === false) {
            die('Prepare failed: ' . htmlspecialchars($conn->error));
        }
        $stmt3->bind_param("sii", $category, $min_price, $max_price);
        $stmt3->execute();
        $stmt3->bind_result($total_records);
        $stmt3->store_result();
        $stmt3->fetch();
    } else {
        // Prepare the SQL statement to search by product category
        $stmt3 = $conn->prepare("SELECT COUNT(*) AS total_records FROM products WHERE LEFT(product_category, 3) LIKE ?");
        if ($stmt3 === false) {
            die('Prepare failed: ' . htmlspecialchars($conn->error));
        }
        $stmt3->bind_param("s", $category);
        $stmt3->execute();
        $stmt3->bind_result($total_records);
        $stmt3->store_result();
        $stmt3->fetch();
    }

    // Set pagination variables
    $page_no = isset($_GET['page_no']) ? $_GET['page_no'] : 1;
    $total_records_per_page = 8;
    $offset = ($page_no - 1) * $total_records_per_page;

    // Fetch searched products
    if (isset($_POST['min_price']) && isset($_POST['max_price'])) {
        $stmt4 = $conn->prepare("SELECT * FROM products WHERE LEFT(product_category, 3) LIKE ? AND product_price BETWEEN ? AND ? LIMIT ?, ?");
        if ($stmt4 === false) {
            die('Prepare failed: ' . htmlspecialchars($conn->error));
        }
        $stmt4->bind_param("siiii", $category, $min_price, $max_price, $offset, $total_records_per_page);
    } else {
        $stmt4 = $conn->prepare("SELECT * FROM products WHERE LEFT(product_category, 3) LIKE ? LIMIT ?, ?");
        if ($stmt4 === false) {
            die('Prepare failed: ' . htmlspecialchars($conn->error));
        }
        $stmt4->bind_param("sii", $category, $offset, $total_records_per_page);
    }
    $stmt4->execute();
    $all_products = $stmt4->get_result();
} else {
    // Fetch all products
    $stmt3 = $conn->prepare("SELECT COUNT(*) AS total_records FROM products");
    if ($stmt3 === false) {
        die('Prepare failed: ' . htmlspecialchars($conn->error));
    }
    $stmt3->execute();
    $stmt3->bind_result($total_records);
    $stmt3->store_result();
    $stmt3->fetch();

    // Set pagination variables
    $page_no = isset($_GET['page_no']) ? $_GET['page_no'] : 1;
    $total_records_per_page = 8;
    $offset = ($page_no - 1) * $total_records_per_page;

    // Fetch all products
    $stmt4 = $conn->prepare("SELECT * FROM products LIMIT ?, ?");
    if ($stmt4 === false) {
        die('Prepare failed: ' . htmlspecialchars($conn->error));
    }
    $stmt4->bind_param("ii", $offset, $total_records_per_page);
    $stmt4->execute();
    $all_products = $stmt4->get_result();
}
?>

<section id="page-header" class="shop-header">
    <h2>#Shop Now</h2> <br>
    <p>Explore our product case studies and shop now to experience excellence firsthand!</p>
</section>

<section id="product1" class="section-p1">
  <h2 data-translate="product-h2">All OUR  PRODUCTS</h2>
  <div class="pro-container">

    <?php include 'includes/get_product.inc.php'; ?>
    <?php while ($row = $all_products->fetch_assoc()) { ?>
      <div class="pro">
        <img src="products/<?php echo $row['product_image']; ?>" alt="">
        <div class="descri">
          <span data-translate="product-name1"><?php echo $row['product_name']; ?></span>
          <h5 data-translate="product-full-name1"><?php echo $row['product_description']; ?></h5>
          <div class="star">
            <i class="fa-solid fa-star"></i>
            <i class="fa-solid fa-star"></i>
            <i class="fa-solid fa-star"></i>
            <i class="fa-solid fa-star"></i>
            <i class="fa-solid fa-star"></i>
          </div>
          <h4 data-translate="product-price1">ETB <?php echo $row['product_price']; ?></h4>
        </div>
        <a href="<?php echo "Sproducts.php? product_identity=" . $row['product_identity']; ?>"></i><i class="_cart"><i class="fa fa-shopping-cart "></i></i></a>
      </div>

    <?php } ?>
  </div>
</section>

<?php if (!isset($_POST['search'])) { // Only display pagination if not searching ?>
    <section id="pagination" class="section-p1">
        <a href="<?php echo "?page_no=" . ($page_no - 1); ?>" <?php if ($page_no <= 1) echo 'style="pointer-events: none; opacity: 0.5;"'; ?>>Previous</a>
        <?php for ($i = 1; $i <= ceil($total_records / $total_records_per_page); $i++) { ?>
            <a href="?page_no=<?php echo $i; ?>" <?php if ($page_no == $i) echo 'class="active"'; ?>><?php echo $i; ?></a>
        <?php } ?>
        <a href="<?php echo "?page_no=" . ($page_no + 1); ?>" <?php if ($page_no >= ceil($total_records / $total_records_per_page)) echo 'style="pointer-events: none; opacity: 0.5;"'; ?>>Next</a>
    </section>
<?php } else { // Display search pagination ?>
    <section id="pagination" class="section-p1">
        <a href="<?php echo "?search=" . urlencode($search_term) . "&min_price=" . $min_price . "&max_price=" . $max_price . "&page_no=" . ($page_no - 1); ?>" <?php if ($page_no <= 1) echo 'style="pointer-events: none; opacity: 0.5;"'; ?>>Previous</a>
        <?php for ($i = 1; $i <= ceil($total_records / $total_records_per_page); $i++) { ?>
            <a href="?search=<?php echo urlencode($search_term); ?>&min_price=<?php echo $min_price; ?>&max_price=<?php echo $max_price; ?>&page_no=<?php echo $i; ?>" <?php if ($page_no == $i) echo 'class="active"'; ?>><?php echo $i; ?></a>
        <?php } ?>
        <a href="<?php echo "?search=" . urlencode($search_term) . "&min_price=" . $min_price . "&max_price=" . $max_price . "&page_no=" . ($page_no + 1); ?>" <?php if ($page_no >= ceil($total_records / $total_records_per_page)) echo 'style="pointer-events: none; opacity: 0.5;"'; ?>>Next</a>
    </section>
<?php } ?>

<?php
include('Layouts/footer.php');
?>

<script src="products.js"></script>
<script src="js/script.js"></script>
<script src="https://translate.google.com/translate_a/element.js?cb=loadGoogleTranslate"></script>
<script>
    function loadGoogleTranslate() {
        new google.translate.TranslateElement("google_element");
    }
</script>
<script>
    let submenu = document.getElementById("subMenu");

    function toggleMenu() {
        submenu.classList.toggle("open-menu");
    }
</script>
