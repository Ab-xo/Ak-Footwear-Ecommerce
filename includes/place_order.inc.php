<?php
include 'dbh.inc.php';
include 'functions.inc.php';

session_start(); // Ensure the session is started

if (!isset($_SESSION["logged_in"]) || $_SESSION["logged_in"] !== true) {
    header("location: ../checkout.php?error=To place an order, you need to log in.");
    exit();
}

if (isset($_POST['place_order'])) {
    // Get user info and store it in database
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $country = $_POST['country'];
    $city = $_POST['city'];
    $order_cost = $_SESSION['total'];
    $order_status = "Not paid";
    $user_id = $_SESSION['userid'];
    $order_date = date('Y-m-d H:i:s');

    $stmt = $conn->prepare("INSERT INTO orders (order_cost, order_status, user_id, user_phone, user_country, user_city, user_address, order_date) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param('isiissss', $order_cost, $order_status, $user_id, $phone, $country, $city, $address, $order_date);

    $stmt_status = $stmt->execute();
    if (!$stmt_status) {
        header('location: ../index.php');
        exit();
    }

    // Get the new order ID
    $order_id = $stmt->insert_id;

    // Get products from cart (from session)
    foreach ($_SESSION['cart'] as $key => $value) {
        $product = $_SESSION['cart'][$key];
        $product_identity = $product['product_identity'];
        $product_single_image1 = $product['product_single_image1'];
        $product_description = $product['product_description'];
        $product_price = $product['product_price'];
        $product_quantity = $product['product_quantity'];

        // Store each item in order_items database
        $stmt1 = $conn->prepare("INSERT INTO orders_items (order_id, product_id, product_name, product_image, product_price, product_quantity, user_id, order_date) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt1->bind_param('iissiiis', $order_id, $product_identity, $product_description, $product_single_image1, $product_price, $product_quantity, $user_id, $order_date);
        $stmt1->execute();
    }
      $_SESSION['order_id'] = $order_id;
    // Redirect to payment page
    header('location: ../payment.php?order_status=Your Order Has Been Confirmed!');
    exit();
}

