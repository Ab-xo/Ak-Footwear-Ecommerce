<?php
include ('Layouts/header.php');
if (!isset($_SESSION["userid"])) {
    echo "<script>window.location.href ='index.php';</script>";
    exit();
}else if(isset($_POST['order_details-btn']) && isset($_POST['order_id'])){
     include 'includes/dbh.inc.php';
     include 'includes/functions.inc.php';
    $order_id= $_POST['order_id'];
    $order_status = $_POST['order_status'];
    $stmt = $conn->prepare("SELECT * FROM orders_items WHERE order_id=?");
    $stmt->bind_param('i',$order_id);
    $stmt->execute();
    $order_details = $stmt->get_result();
    $order_total_price = calculateTotalOrderPrice($order_details);
 }
 function calculateTotalOrderPrice($order_details)
{
    $total = 0;
    foreach($order_details as $row) {
       $product_price= $row['product_price'];
       $product_quantity = $row['product_quantity'];

       $total = $total + ($product_price * $product_quantity);

    }
    return $total;
}

?>
  <title>Order Details</title>
    <style>
        .update-profile {
            max-width: 600px;
            margin: 50px auto;
            background-color: #fff;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }

        .update-profile img {
            display: block;
            margin: 0 auto 20px;
            width: 150px;
            height: 150px;
            border-radius: 50%;
            object-fit: cover;
        }

        .input-group {
            display: flex;
            justify-content: space-between;
        }

        .inputBox {
            flex: 1;
            margin-right: 20px;
        }

        .inputBox span {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        .box {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .box2 {
            width: 100%;
            padding: 10px;
            margin: 25px 100px auto 8px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .btn {
            display: block;
            width: 100%;
            padding: 10px;
            margin-top: 10px;
            text-align: center;
            text-decoration: none;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .delete-btn {
            display: block;
            width: 100%;
            padding: 10px;
            margin-top: 10px;
            text-align: center;
            text-decoration: none;
            color: #fff;
            background-color: #f44336;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .messages {
            margin-top: 10px;
            padding: 10px;
            background-color: #f8d7da;
            color: #721c24;
            border-radius: 5px;
        }

        .users-circle-sub {
            position: relative;
            width: 60px;
            height: 60px;
            border-radius: 50%;
            background-color: rgba(20, 167, 62, 1);
            /* You can customize the background color */
            color: #ffffff;
            font-size: 40px;
            text-align: center;
            margin: 0px 190px auto;
            line-height: 60px;
            font-weight: bold;
        }

        .icons {
            position: absolute;
            margin: 25px 2px auto 8px;
            min-width: 50px;
            left: 30px;
            transform: translateY(-50%);
            font-size: 18px;
            color: #8b8b8b;
            cursor: pointer;
            padding: 5px;
        }

        h2 {
            text-align: center;
            margin: 12px 650px auto;
            position: relative;
            display: inline-block;
        }

        h2::after {
            content: "";
            position: absolute;
            bottom: -10px;
            left: 50%;
            transform: translateX(-50%);
            width: 100px;
            /* Adjust the width of the underline as needed */
            height: 2px;
            background-color: #4CAF50;
            /* You can change the color as desired */
        }

        table {
            width: 80%;
            border-collapse: collapse;
            margin: 35px auto;
        }

        th,
        td {
            padding: 12px;
            text-align: left;

        }

        th:first-child,
        td:first-child {
            text-align: left;
        }

        th:last-child,
        td:last-child {
            text-align: right;
        }

        th {
            background-color: #4CAF50;
        }

        tr:hover {
            background-color: #f5f5f5;
        }

        .product-info {
            display: flex;
            align-items: center;
        }

        .product-info img {
            width: 50px;
            /* Adjust the width as needed */
            height: 50px;
            /* Adjust the height as needed */
            margin-right: 10px;
            /* Adjust the margin as needed */
        }

        .product-info span {
            font-weight: bold;
        }


        .details-btn {
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
            padding: 8px 16px;
            text-decoration: none;
            display: inline-block;
            border-radius: 4px;
            margin: 0px auto;
        }

        .details-btn:hover {
            background-color: #45a049;
        }

        .details-container {
            width: 90%;
            margin: 0px auto;
            display: none;
            padding: 10px;
            border: 1px solid #ccc;
            background-color: #f9f9f9;
            margin-top: 10px;
        }
        .pay-now-btn-container {
            text-align: right;
            margin-top: 20px;
            margin-right: 10%;
        }
        
        .pay-now-btn {
            display: inline-block;
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-align: center;
            text-decoration: none;
            margin-top: 10px;
        }
    </style>
</head>
    <h2>Order Details</h2>
    <table>
        <thead>
            <tr>
                <th>Product</th>
                <th>Price</th>
                <th>Quantity</th>
            </tr>
        </thead>
        <tbody>
        <?php  foreach($order_details as $row) { ?>
                <tr>
                    <td>
                        <div class="product-info">
                            <img src="S-produts/<?php echo $row['product_image'];?>" alt="">
                            <span><?php echo $row['product_name']; ?></span>
                        </div>
                    </td>
                    <td><strong>ETB: </strong><?php echo $row['product_price']; ?></td>
                    <td><?php echo $row['product_quantity']; ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
    <?php if($order_status == "Not paid"){?>
    <div class="pay-now-btn-container">
        <form method="POST" action="payment.php">
            <input type="hidden" name="order_id" value="<?php echo $order_id;?>">
            <input type="hidden" name="order_total_price" value="<?php echo $order_total_price;?>">
            <input type="hidden" name="order_status"  value="<?php echo  $order_status ;?>"   >
            <input type="submit" name="order_pay_btn"  type="submit" class="pay-now-btn" value="Pay Now" />
        </form>
    </div>
    <?php }?>
    <?php
    include ('Layouts/footer.php');
     ?>
