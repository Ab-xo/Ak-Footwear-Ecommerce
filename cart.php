<?php

include ('Layouts/header.php');
if (isset($_POST['add_to_cart'])) {
    $product_identity = $_POST['product_identity'];
    $product_single_image1 = $_POST['product_single_image1'];
    $product_description = $_POST['product_description'];
    $product_price = $_POST['product_price'];
    $product_quantity = $_POST['product_quantity'];
    $product_size = $_POST['product_size']; // New: Receive selected size
    
    // Initialize cart session if not set
    if (!isset($_SESSION['cart']) || !is_array($_SESSION['cart'])) {
        $_SESSION['cart'] = array();
    }
    // If cart exists
    if (isset($_SESSION['cart'])) {
        $products_array_ids = array_column($_SESSION['cart'], 'product_identity');
        $product_identity = $_POST['product_identity'];
        // If product not already in cart
        if (!in_array($product_identity, $products_array_ids)) {
            $product_array = array(
                'product_identity' => $product_identity,
                'product_single_image1' => $product_single_image1,
                'product_description' => $product_description,
                'product_price' => $product_price,
                'product_quantity' => $product_quantity,
                'product_size' => $product_size // New: Add size to cart
            );
            $_SESSION['cart'][$product_identity] = $product_array;
        } else {
            echo '<script>alert("Product was already added to the cart ")</script>';
        }
    } else {
        // If cart doesn't exist, create a new one
        $product_array = array(
            'product_identity' => $product_identity,
            'product_single_image1' => $product_single_image1,
            'product_description' => $product_description,
            'product_price' => $product_price,
            'product_quantity' => $product_quantity,
            'product_size' => $product_size // New: Add size to cart
        );
        $_SESSION['cart'][$product_identity] = $product_array;
    }

    //calcuate total price
    calculateTotalCart();
    calculateTotalQuantity();

  // Redirect using JavaScript
  echo '<script>window.location.href = window.location.href;</script>';
  exit;
    //romove product from the cart
} else if (isset($_POST['remove_product'])) {

    $product_identity = $_POST['product_identity'];
    unset($_SESSION['cart'][$product_identity]);
    calculateTotalCart();
    calculateTotalQuantity();
      // Redirect using JavaScript
    echo '<script>window.location.href = window.location.href;</script>';
    exit;
    
} else if (isset($_POST['edit_quantity'])) {
    //we get id and quantity from the form
    $product_identity = $_POST['product_identity'];
    $product_quantity = $_POST['product_quantity'];
    // get the product array from the session
    $product_array = $_SESSION['cart'][$product_identity];
    //updtate product quantity

    $product_array['product_quantity'] = $product_quantity;
    //return arrray back t its place
    $_SESSION['cart'][$product_identity] = $product_array;
    calculateTotalCart();
    calculateTotalQuantity();

      // Redirect using JavaScript
    echo '<script>window.location.href = window.location.href;</script>';
    exit;
}
 
function calculateTotalCart()
{
    $total = 0;
    foreach ($_SESSION['cart'] as $key => $value) {
        $product = $_SESSION['cart'][$key];

        $price = $product['product_price'];
        $quantity = $product['product_quantity'];
        $total += $price * $quantity;
    }
    $_SESSION['total'] = $total;
}
// Calculate total quantity of items in the cart

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
?>
<style>
 #cart table tbody tr td form  .remove-btn{
 background-color: blue;
 color: white;
 border: none;
 border-radius: 50%; /* to create a round shape */
 width: 22px; /* adjust as needed */
 height: 22px; /* adjust as needed */
 font-size: 13px; /* adjust as needed */
 cursor: pointer;
 transition: background-color 0.3s ease;
}
#cart table tbody tr td form  .remove-btn:hover{
 background-color: black; /* adjust as needed */
 color: white;
 animation: bounce 0.5s infinite alternate; /* animation when hovered */

}
#cart table tbody tr td form  .edit-btn{
 background-color: black;
 color: white;
 border: none;
 cursor: pointer;
 transition: background-color 0.3s ease;
}
#cart table tbody tr td form  .edit-btn:hover{
 background-color: blueblack; /* adjust as needed */
 color: white;
 animation: bounce 0.5s infinite alternate; /* animation when hovered */

}

@keyframes bounce {
 0% {
     transform: translateY(0);
 }
 100% {
     transform: translateY(-5px);
 }
}
</style>
<section id="page-header" class="Cart-headers">
 <h2>#Your Cart</h2> <br>
</section>
<section id="cart" class="section-p1">
 <table width="100%">
     <thead>
         <tr>
             <td>Remove</td>
             <td>Image</td>
             <td>Product</td>
             <td>Price</td>
             <td>Quantity</td>
             <td>Size</td>
             <td>Subtotal</td>
         </tr>
     </thead>
     <tbody>
     <?php if (!empty($_SESSION['cart'])) {
          foreach ($_SESSION['cart'] as $key => $value) {?>
             <tr>
                 <td>
                 <form action="cart.php" method="POST">
                      
                    <input type="hidden" name="product_identity" value="<?php echo $value['product_identity']; ?>"> 
                    <input type="submit" name="remove_product" class="remove-btn" value="X" /> 

                 </form>
                 </td>
                 <td> <img src="S-produts/<?php echo $value['product_single_image1'];?>" alt=""></td>
                 <td><?php echo $value['product_description']; ?></td>
                 <td>ETB <?php echo $value['product_price']; ?></td>
                 <td>
                  <form action="cart.php" method="POST">
                 <input type="hidden" name="product_identity" value="<?php echo $value['product_identity']; ?>"> 
                 <input type="number"  name="product_quantity" min="1" value="<?php echo $value['product_quantity']; ?>"/>
                 <input type="submit" name="edit_quantity" class="edit-btn" value="EDIT"/>
                 </form>
                 <td><?php echo $value['product_size']; ?></td>
                 </td>
                 <td>ETB <?php echo $value['product_price'] * $value['product_quantity'] ?></td>
             </tr>
             <?php }
     } else { ?>
         <tr>
             <td colspan="6" class="empty-cart">Your cart is empty</td>
         </tr>
     <?php } ?>
     </tbody>
 </table>
</section>
<section id="cart-add" class="section-p1">
 <div id="coupon">
     <h3>Apply Coupon</h3>
     <div>
         <input type="text" placeholder="Enter Your Coupon">
         <button >Apply</button>
     </div>
 </div>
 <div id="Subtotal">
     <h3>Cart Totals</h3>
     <table>
         <tr>
             <td>Shipping</td>
             <td>Free</td>
         </tr>
         <tr>
 <td><strong>Total</strong></td>
 <?php if (!empty($_SESSION['cart'])): ?>
     <td><strong>ETB <?php echo $_SESSION['total']; ?></strong></td>
 <?php else: ?>
     <td><strong>ETB 0</strong></td>
 <?php endif; ?>
</tr>
     </table>
     <form action="checkout.php" method="POST">
     <input type="hidden" name="product_identity" value="<?php echo $value['product_identity']; ?>"/>
     <input type="hidden" name="product_single_image1" value="<?php echo $value['product_single_image1'];?>"/>
     <input type="hidden" name="product_description" value="<?php echo $value['product_description'];?>"/>
     <input type="hidden" name="product_quantity" value="<?php echo $value['product_quantity'] ;?>"/>
     <input class="normal" type="submit"  name="checkout"  value="Proceed to checkout" />
     </form>
 </div>
</section>
<?php
include ('Layouts/footer.php');
?>
<script src="js/script.js"></script>
<script src="https://translate.google.com/translate_a/element.js?cb=loadGoogleTranslate"></script>
<script>
 function loadGoogleTranslate() {
     new google.translate.TranslateElement("google_element");
 }
</script>
</body>
</html>
