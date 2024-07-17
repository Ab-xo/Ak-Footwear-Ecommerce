<?php
include ('Layouts/header.php');
if (!empty($_SESSION['cart'])) {
} else {
    echo "<script>window.location.href ='index.php?error=emptycart';</script>";
    exit();
}
?>
<head>
    <style>
        .container {
            width: 1200px;
            margin: 30px auto;
            max-width: 90%;
            transition: transform 1s;
            background-color: #ffff;
        }

        .container2 {
            width: 1200px;
            margin: 30px auto;
            max-width: 90%;
            transition: transform 1s;
        }

        .checkoutLayout {
            display: grid;
            grid-template-columns: repeat(auto, 1fr);
            gap: 50px;
            padding: 20px;
        }

        .right {
            background-color: #5358B3;
            border-radius: 20px;
            padding: 40px;
            margin-left: 40px;
            color: #fff;

        }

        .right .form {
            border-bottom: 1px solid #eee;
            padding-bottom: 20px;
            background-color: #5358B3;
            gap: 30px;
        }

        .right .form h1,
        .right .form .group:nth-child(-n+3) {
            grid-column-start: 1;
            grid-column-end: 3;
        }

        .right .form input,
        .right .form select {
            width: 100%;
            padding: 10px 20px;
            box-sizing: border-box;
            border-radius: 20px;
            margin-top: 10px;
            border: none;
            background-color: #6a6fc9;
            color: #ffff;

        }

        .right .return .row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 10px;
        }

        .right .return .row div:nth-child(2) {
            font-weight: bold;
            font-size: x-large;
        }

        .buttonCheckout {
            width: 100%;
            height: 40px;
            border: none;
            border-radius: 20px;
            background-color: #49D8B9;
            margin-top: 20px;
            font-weight: bold;
            color: #fff;


        }

        .returnCart h1 {
            border-top: 1px solid #eee;
            padding: 20px 0;
        }

        .returnCart .list .item img {
            height: 80px;
        }

        .returnCart .list .item {
            display: grid;
            grid-template-columns: 80px 1fr 50px 80px;
            align-items: center;
            gap: 20px;
            margin-bottom: 30px;
            padding: 0 10px;
            box-shadow: 0 10px 20px #5555;
            border-radius: 20px;
        }

        .returnCart .list .item .name,
        .returnCart .list .item .returnPrice {
            font-size: large;
            font-weight: bold;
        }
        /*log in link in error message */
        .button {
        display: inline-block;
        padding: 10px 20px;
        font-size: 16px;
        font-weight: bold;
        color: #fff;
        background-color: #007BFF;
        border: none;
        border-radius: 5px;
        text-decoration: none;
        transition: background-color 0.3s ease, box-shadow 0.3s ease;
    }

    .button:hover {
        background-color: #0056b3;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        color: black;
    }
    </style>
</head>
<?php if (isset($_GET['error'])): ?>
    <div class='popup-message' id='popupMessage'>
        <span class='close-btn' onclick='closePopup()'>&times;</span>
        <span id='popupMessageContent'><?php echo htmlspecialchars($_GET['error']); ?></span>
        <a href='login.php' id='loginLink' class='button'>Login</a>
    </div>
<?php endif; ?>

<div class="container">
    <div class="checkoutLayout">
        <div class="returnCart">
            <a href="/">keep shopping</a>
            <h1>List Product in Cart</h1>
            <div class="list">
                <?php foreach ($_SESSION['cart'] as $key => $value) { ?>
                    <div class="item">
                        <img src="S-produts/<?php echo $value['product_single_image1']; ?>" alt="">

                        <div class="info">
                            <div class="name"><?php echo $value['product_description']; ?></div>
                            <div class="price">ETB:<?php echo $value['product_price']; ?>/1 product</div>
                        </div>
                        <div class="quantity">QT:<?php echo $value['product_quantity']; ?></div>

                        <div class="returnPrice">Total:USD <?php echo $value['product_price'] * $value['product_quantity'] ?></div>
                        <div class="size">Size:<?php echo $value['product_size']; ?></div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
    <div class="container2">
        <div class="right">
            <h1>Checkout</h1>
            <form action="includes/place_order.inc.php" method="POST">
                <div class="form">

                    <div class="group">
                        <label for="name">Full Name</label>
                        <input type="text" name="name" id="name" required>
                    </div>
                    <div class="group">
                        <label for="email">Email</label>
                        <input type="text" name="email" id="email" required>
                    </div>
                    <div class="group">
                        <label for="phone">Phone Number</label>
                        <input type="text" name="phone" id="phone" required>
                    </div>

                    <div class="group">
                        <label for="address">Address</label>
                        <input type="text" name="address" id="address" required>
                    </div>

                    <div class="group">
                        <label for="country">Country</label>
                        <input type="text" name="country" id="country" required>
                    </div>

                    <div class="group">
                        <label for="city">City</label>
                        <input type="text" name="city" id="city" required>
                    </div>
                </div>
                <div class="return">
                    <div class="row">
                        <div>Total Price</div>
                        <div class="totalPrice">USD <?php echo $_SESSION['total']; ?></div>
                    </div>
                </div>
                <input type="submit" class="buttonCheckout" name="place_order" value="Place Order" />
            </form>
        </div>

    </div>
</div>

<script>
    function closePopup() {
        document.getElementById('popupMessage').style.display = 'none';
    }

    window.onload = function() {
        var popupMessage = document.getElementById('popupMessage');
        if (popupMessage) {
            popupMessage.style.display = 'block'; // Ensure the popup is visible if it exists
        }
    }
</script>
<?php
include ('Layouts/footer.php');
?>