<?php
include("header.php");
include("sidebar.php");

if (!isset($_SESSION["adminid"])) {
    header('Location: login.php');
    exit();
}

// Database connection (assuming $conn is your connection variable)
include("../includes/dbh.inc.php");

if (isset($_GET['order_id'])) {
    $order_id = $_GET['order_id'];
    
    // Prepare the SQL statement
    $stmt = $conn->prepare("SELECT * FROM orders WHERE order_id = ?");
    
    if ($stmt) {
        // Bind parameters and execute
        $stmt->bind_param('i', $order_id);
        $stmt->execute();
        
        // Get the result
        $orders = $stmt->get_result();
        
        if ($orders->num_rows > 0) {
            $order = $orders->fetch_assoc();
        } else {
            echo "Order not found.";
            exit();
        }
    } else {
        echo "Failed to prepare the SQL statement.";
        exit();
    }
} else {
    echo "Order ID not provided.";
    exit();
}
?>

<!-- Edit Page Content -->
<div class="page-content py-5">
  <div class="container">
    <div class="row">
      <div class="col-md-8 offset-md-2">
        <h3 class="mb-4 text-center">Edit Order</h3>
        <form action="../admin-includes/update_orders.adm.php" method="POST" class="form-modern">
          <input type="hidden" name="order_id" value="<?php echo htmlspecialchars($order['order_id']); ?>">

          <div class="form-group">
            <label for="order_status">Order Status</label>
            <select id="order_status" name="order_status" class="form-control">
              <option value="Pending" <?php echo ($order['order_status'] == 'Pending') ? 'selected' : ''; ?>>Pending</option>
              <option value="Processing" <?php echo ($order['order_status'] == 'Processing') ? 'selected' : ''; ?>>Processing</option>
              <option value="Completed" <?php echo ($order['order_status'] == 'Completed') ? 'selected' : ''; ?>>Completed</option>
              <option value="Paid" <?php echo ($order['order_status'] == 'Paid') ? 'selected' : ''; ?>>Paid</option>
              <option value="Shipped" <?php echo ($order['order_status'] == 'Shipped') ? 'selected' : ''; ?>>Shipped</option>
              <option value="Delivered" <?php echo ($order['order_status'] == 'Delivered') ? 'selected' : ''; ?>>Delivered</option>
            </select>
          </div>

          <div class="form-group">
            <label for="user_id">User ID</label>
            <p class="form-control-plaintext"><?php echo htmlspecialchars($order['user_id']); ?></p>
          </div>

          <div class="form-group">
            <label for="order_date">Order Date</label>
            <p class="form-control-plaintext"><?php echo htmlspecialchars($order['order_date']); ?></p>
          </div>

          <div class="form-group">
            <label for="user_phone">User Phone</label>
            <p class="form-control-plaintext"><?php echo htmlspecialchars($order['user_phone']); ?></p>
          </div>

          <div class="form-group">
            <label for="user_address">User Address</label>
            <p class="form-control-plaintext"><?php echo htmlspecialchars($order['user_address']); ?></p>
          </div>

          <button type="submit" class="btn btn-primary btn-block">Update Order</button>
          <a href="orders.php" class="btn btn-secondary btn-block">Cancel</a>
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

  .form-control-plaintext {
    display: block;
    width: 100%;
    padding: .375rem .75rem;
    margin-bottom: 1rem;
    line-height: 1.5;
    color: #495057;
    background-color: transparent;
    border: 1px solid #ced4da;
    border-radius: .25rem;
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
