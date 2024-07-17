<?php

include("header.php");
include("sidebar.php");

if (!isset($_SESSION["adminid"])) {
    header("Location: login.php");
    exit();
}

include('../includes/dbh.inc.php');

$admin_id = $_SESSION["adminid"];

try {
    $sql = "SELECT admin_name, admin_username, admin_email FROM admins WHERE admin_id = ?";
    $stmt = $conn->prepare($sql);

    if ($stmt === false) {
        throw new Exception('Prepare failed: ' . $conn->error);
    }

    $stmt->bind_param("i", $admin_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $current_admin = $result->fetch_assoc();

    if ($current_admin === null) {
        throw new Exception('No admin details found');
    }

} catch (Exception $e) {
    echo "<script>alert('" . $e->getMessage() . "'); window.location.href='logout.php';</script>";
    exit();
} finally {
    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Account Page</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f2f5;
        }
        .container {
            max-width: 600px;
            margin: 120px auto;
        }
        .card {
            margin-bottom: 20px;
        }
        .card-header {
            background-color: #007bff;
            color: #fff;
        }
        .card-title {
            margin-bottom: 0;
        }
        .btn-custom {
            background-color: #28a745;
            color: #fff;
        }
        .btn-custom:hover {
            background-color: #218838;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h1 class="card-title">Admin Account Page</h1>
            </div>
            <div class="card-body">
                <h2>Current Admin Details</h2>
                <p>Name: <span id="current-name"><?php echo htmlspecialchars($current_admin['admin_name']); ?></span></p>
                <p>Username: <span id="current-username"><?php echo htmlspecialchars($current_admin['admin_username']); ?></span></p>
                <p>Email: <span id="current-email"><?php echo htmlspecialchars($current_admin['admin_email']); ?></span></p>
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                <h2 class="card-title">Update Admin Details</h2>
            </div>
            <div class="card-body">
                <form id="update-form" action="../admin-includes/update_admin.adm.php" method="POST">
                    <div class="form-group">
                        <label for="username">Username:</label>
                        <input type="text" id="username" name="username" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" id="email" name="email" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password:</label>
                        <input type="password" id="password" name="password" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-custom">Update</button>
                </form>
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                <h2 class="card-title">Add New Admin</h2>
            </div>
            <div class="card-body">
                <form id="add-admin-form" action="../admin-includes/add_admin.adm.php" method="POST">
                    <div class="form-group">
                        <label for="new_admin_name">Admin Name:</label>
                        <input type="text" id="new_admin_name" name="new_admin_name" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="new_username">Username:</label>
                        <input type="text" id="new_username" name="new_username" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="new_email">Email:</label>
                        <input type="email" id="new_email" name="new_email" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="new_password">Password:</label>
                        <input type="password" id="new_password" name="new_password" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-custom">Add Admin</button>
                </form>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
