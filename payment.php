<?php
include('Layouts/header.php');
if (!isset($_SESSION["userid"])) {
  echo "<script>window.location.href ='index.php';</script>";
  exit();
} else if (isset($_POST['order_pay_btn'])) {
  $order_id = $_POST['order_id'];
  $order_status =  $_POST['order_status'];
  $order_total_price = $_POST['order_total_price'];
  // Store order details in session for further use
  $_SESSION['order_id'] = $order_id;
  $_SESSION['order_status'] = $order_status;
  $_SESSION['order_total_price'] = $order_total_price;
}
?>

<title>Order Confirmation</title>
<style>
  .container {
    margin-top: 50px;
    background-color: #5358B3;
    width: 600px;
    height: 300px;
  }
  .confirmation {
    background-color: #f8f9fa;
    padding: 20px;
    margin-top: 1px;
    margin-right: 420px;
    border-radius: 10px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    min-width: 400px;
    height: 400px;
  }

  .confirmation h2 {
    color: #007bff;
    margin-top: 20px;
  }
  .confirmation h3 {
    color: #007bff;
    margin-top: 20px;
    font-size: 80px;
    margin-top: 30px;
  }
   #no-order {
     font-size: 50px;
    margin-top: 30px;
  }
  .total {
    font-size: 24px;
    font-weight: bold;
    margin-top: 100px;
  }

  .pay-now-btn {
    margin-top: 10px;
  }

  .pay-now-btn button {
    width: 150px;

  }

  @keyframes fadeIn {
    from {
      opacity: 0;
    }

    to {
      opacity: 1;
      color: black;
    }
  }

  .confirmation {
    animation: fadeIn 0.5s ease-in-out;
  }
</style>

</head>

<body>
  
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <div class="confirmation text-center">

        <?php if (isset($_POST['order_status']) && $_POST['order_status'] == "Not paid") { ?>
            <p>We've received your order and it's being processed.</p>
            <?php $amount = strval($_POST['order_total_price']); ?>
            <?php $order_id = $_POST['order_id'];?>
            <div class="total">Total Payment: ETB <?php echo $_POST['order_total_price']; ?></div>
            <!--<div class="pay-now-btn">
              <button type="button" class="btn btn-primary">Pay Now</button>
            </div>-->
              <!-- Add a container for the PayPal button -->
          <div id="paypal-button-container"></div>
        

          <?php } else if (isset($_SESSION['total']) && $_SESSION['total'] != 0) { ?>
            <p>The product is coming from your cart and is ready for purchase.</p>
            <?php $amount = strval($_SESSION['total']); ?>
            <?php $order_id = $_SESSION['order_id'];?>
            <div class="total">Total Payment: ETB <?php echo $_SESSION['total']; ?></div>
            <!--<div class="pay-now-btn">
              <button type="button" class="btn btn-primary">Pay Now</button>
            </div>-->
              <!-- Add a container for the PayPal button -->
          <div id="paypal-button-container"></div>
          
          <?php } else { ?>
            <h3>No Order</h2>
            <p id="no-order">You don't have an order.</p>
          <?php } ?>
        </div>
      </div>
    </div>
  </div>

  <!-- Include the PayPal JS SDK -->
  <script src="https://www.paypal.com/sdk/js?client-id=AaZWu3Udowi0P_0gLHB57GCydoKcYAdD4TNICp-2wB6VvnG9nFU9E4eQV30GZW8-Lq9MeVtZmQoIWvcU&currency=USD"></script>
  
   <script>
        // Render the PayPal button into #paypal-button-container
        paypal.Buttons({
            // Set up the transaction
            createOrder: function(data, actions) {
                return actions.order.create({
                    purchase_units: [{
                        amount: {
                          value: '<?php echo $amount; ?>',
                        }
                    }]
                });
            },
            // Finalize the transaction
            onApprove: function(data, actions) {
                return actions.order.capture().then(function(orderData) {
                    // Show a success message to the buyer
                    console.log('Capture result', orderData, JSON.stringify(orderData, null, 2));
                    var transaction = orderData.purchase_units[0].payments.captures[0];
                    alert('Transaction completed by ' + transaction.status + ': ' + transaction.id + '\n\nSee console for all available details');

                    // Redirect to server-side script to complete the payment
                  window.location.href = "includes/complete_payment.inc.php?transaction_id=" + transaction.id + "&order_id=" + <?php echo $order_id; ?>;
                });
            },
        }).render('#paypal-button-container'); // Display payment options on your web page
    </script>

  <?php
  include('Layouts/footer.php');
  ?>