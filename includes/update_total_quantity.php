<?php
// Calculate total quantity
calculateTotalQuantity();

// Output total quantity
echo $_SESSION['totalQuantity'];

function calculateTotalQuantity()
{
    $totalQuantity = 0;
    if (!empty($_SESSION['cart'])) {
        foreach ($_SESSION['cart'] as $product) {
            $totalQuantity += $product['product_quantity'];
        }
    }
    $_SESSION['totalQuantity'] = $totalQuantity;
}

