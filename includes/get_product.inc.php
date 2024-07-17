<?php
include('dbh.inc.php');

// Fetch 8 random products for the "All Release Products" section
$stmt_all_release = $conn->prepare("SELECT * FROM products WHERE product_arrival = 'release' ORDER BY RAND() LIMIT 8");
if (!$stmt_all_release) {
    die("Error preparing statement for all release products: " . $conn->error);
}
$stmt_all_release->execute();
$all_release_products = $stmt_all_release->get_result();

// Fetch 8 random "new arrival" products for the "New Arrival" section
$stmt_new_arrival = $conn->prepare("SELECT * FROM products WHERE product_arrival = 'new' ORDER BY RAND() LIMIT 8");
if (!$stmt_new_arrival) {
    die("Error preparing statement for new arrival products: " . $conn->error);
}
$stmt_new_arrival->execute();
$new_arrival_products = $stmt_new_arrival->get_result();

