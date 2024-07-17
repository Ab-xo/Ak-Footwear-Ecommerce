<?php
include("header.php");
include("sidebar.php");
include("../includes/dbh.inc.php");

if (isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];
    
    // Prepare the SQL statement to delete the customer
    $stmt = $conn->prepare("DELETE FROM customers WHERE customer_id = ?");
    
    if ($stmt) {
        // Bind parameters and execute
        $stmt->bind_param('i', $delete_id);
        if ($stmt->execute()) {
            // Redirect with success message
            header('Location: customers.php?delete=success');
        } else {
            // Redirect with error message
            header('Location: customers.php?delete=error');
        }
        $stmt->close();
    } else {
        // Redirect with error message
        header('Location: customers.php?delete=error');
    }
}

// Fetch customers data
$result = $conn->query("SELECT * FROM customers");

?>

<!DOCTYPE html>
<html>
<head>
    <title>Manage Customers</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
    <div class="content">
        <h1>Customers</h1>
        <?php
        if (isset($_GET['delete']) && $_GET['delete'] == 'success') {
            echo "<p class='success'>Customer deleted successfully!</p>";
        } elseif (isset($_GET['delete']) && $_GET['delete'] == 'error') {
            echo "<p class='error'>Error deleting customer.</p>";
        }
        ?>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Address</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                        <td>{$row['customer_id']}</td>
                        <td>{$row['name']}</td>
                        <td>{$row['email']}</td>
                        <td>{$row['phone']}</td>
                        <td>{$row['address']}</td>
                        <td>
                            <a href='edit_customer.php?customer_id={$row['customer_id']}'>Edit</a> |
                            <a href='customers.php?delete_id={$row['customer_id']}' onclick=\"return confirm('Are you sure you want to delete this customer?');\">Delete</a>
                        </td>
                    </tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>

<?php
$conn->close();
?>
