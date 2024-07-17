<?php
session_start();
include 'dbh.inc.php';
include 'functions.inc.php';
if (isset($_GET['transaction_id']) && isset($_GET['order_id'])) {

            $order_id = $_GET['order_id'];
            $order_status = "paid";
            $transaction_id = $_GET['transaction_id'];
            $user_id = $_SESSION['userid'];
            $payment_date = date('Y-m-d H:i:s');
            //change order_status  to paid
            $stmt = $conn->prepare("UPDATE orders SET order_status=? WHERE order_id=?");
            $stmt->bind_param('si', $order_status, $order_id);
            $stmt->execute();
            //to store payment info
            $stmt1 = $conn->prepare("INSERT INTO payments (order_id , user_id, transaction_id,payment_date) VALUES (?,?,?,?)");
            $stmt1->bind_param('iiss', $order_id,  $user_id, $transaction_id,$payment_date);
            $stmt1->execute();

            // go to user account 

            header('location: ../account.php?payment_message=paid successfully, thanks for your shopping with us');
}else {
    header('location: ../index.php');
    exit;
}
