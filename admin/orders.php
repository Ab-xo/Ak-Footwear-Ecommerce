<?php
include("header.php");
include("sidebar.php");

if (!isset($_SESSION["adminid"])) {
  header('location: login.php');
  exit();
}

// Database connection (assuming $conn is your connection variable)
include("../includes/dbh.inc.php");

// Pagination variables
$page_no = isset($_GET['page_no']) ? (int)$_GET['page_no'] : 1;
$total_records_per_page = 8;
$offset = ($page_no - 1) * $total_records_per_page;

// Fetch total records for pagination
$stmt3 = $conn->prepare("SELECT COUNT(*) AS total_records FROM orders");
if ($stmt3 === false) {
  die('Prepare failed: ' . htmlspecialchars($conn->error));
}
$stmt3->execute();
$stmt3->bind_result($total_records);
$stmt3->store_result();
$stmt3->fetch();

// Calculate total pages
$total_no_of_pages = ceil($total_records / $total_records_per_page);

// Fetch orders with pagination
$stmt4 = $conn->prepare("SELECT * FROM orders LIMIT ?, ?");
if ($stmt4 === false) {
  die('Prepare failed: ' . htmlspecialchars($conn->error));
}
$stmt4->bind_param("ii", $offset, $total_records_per_page);
$stmt4->execute();
$all_orders = $stmt4->get_result();
?>

<!-- Page Content -->
<div class="page-content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <h3 class="mb-3">Orders</h3>
        <table class="table table-modern">
          <thead>
            <tr>
              <th>Order ID</th>
              <th>Order Status</th>
              <th>User ID</th>
              <th>Order Date</th>
              <th>User Phone</th>
              <th>User Address</th>
              <th>Edit</th>
              <th>Delete</th>
            </tr>
          </thead>
          <tbody>
            <?php while ($order = $all_orders->fetch_assoc()) { ?>
              <tr>
                <td><?php echo htmlspecialchars($order['order_id']); ?></td>
                <td><?php echo htmlspecialchars($order['order_status']); ?></td>
                <td><?php echo htmlspecialchars($order['user_id']); ?></td>
                <td><?php echo htmlspecialchars($order['order_date']); ?></td>
                <td><?php echo htmlspecialchars($order['user_phone']); ?></td>
                <td><?php echo htmlspecialchars($order['user_address']); ?></td>
                <td><a class="btn btn-sm btn-primary" href="edit_orders.php?order_id=<?php echo $order['order_id']; ?>">Edit</a></td>
                <td><a class="btn btn-sm btn-danger" href="../admin-includes/delete_orders.adm.php?order_id=<?php echo $order['order_id']; ?>" onclick="return confirm('Are you sure you want to delete this Order?');">Delete</a></td>
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
            <li class="page-item <?php if ($page_no <= 1) {
                                    echo 'disabled';
                                  } ?>">
              <a class="page-link" <?php if ($page_no > 1) {
                                      echo "href='?page_no=" . ($page_no - 1) . "'";
                                    } ?>>Previous</a>
            </li>
            <li class="page-item <?php if ($page_no >= $total_no_of_pages) {
                                    echo 'disabled';
                                  } ?>">
              <a class="page-link" <?php if ($page_no < $total_no_of_pages) {
                                      echo "href='?page_no=" . ($page_no + 1) . "'";
                                    } ?>>Next</a>
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
<div class="modal fade" id="orderMessageModal" tabindex="-1" role="dialog" aria-labelledby="orderMessageModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="orderMessageModalLabel">Order Update</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <?php
        if (isset($_GET['order_message'])) {
          echo htmlspecialchars($_GET['order_message']);
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

<?php if (isset($_GET['order_update']) && ($_GET['order_update'] == 'success' || $_GET['order_update'] == 'error')) { ?>
  <script>
    $(document).ready(function() {
      $('#orderMessageModal').modal('show');
    });
  </script>
<?php } ?>


<style>
  .product-image {
    width: 100%;
    height: auto;
    display: block;
  }

  td {
    max-width: 150px;
    /* or whatever width you prefer */
  }
</style>