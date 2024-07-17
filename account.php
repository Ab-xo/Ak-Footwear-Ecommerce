<?php
include ('Layouts/header.php');
include_once 'includes/dbh.inc.php';
$user_id = $_SESSION["userid"];
if (!isset($_SESSION["userid"])) {
   echo "<script>window.location.href ='index.php';</script>";
   exit();
}
 
if(isset($_SESSION['userid'])){
   $user_id = $_SESSION['userid'];
   $stmt = $conn->prepare("SELECT * FROM orders WHERE user_id=?");
   $stmt->bind_param('i',$user_id);
   $stmt->execute();
   $orders = $stmt->get_result();
   }
?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Update Profile</title>
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

      h3 {
         text-align: center;
         margin: 12px 650px auto;
         position: relative;
         display: inline-block;
      }

      h3::after {
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
         width: 70%;
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
         position: relative;
         /* Ensure relative positioning for button alignment */
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
         outline: none;
         position: absolute;
         /* Position button within th */
         top: 50%;
         /* Align button to center vertically */
         left: 50%;
         /* Align button to center horizontally */
         transform: translate(-50%, -50%);
         /* Center button */
      }

      .details-btn:hover {
         background-color: #45a049;
      }
   </style>
</head>

<body>
   <div class="update-profile">

      <?php include_once 'includes/dbh.inc.php'; ?>
      <?php
      $select = mysqli_query($conn, "SELECT * FROM `users` WHERE usersId = '$user_id'") or die('query failed');
      if (mysqli_num_rows($select) > 0) {
         $fetch = mysqli_fetch_assoc($select);
      }
      ?>
      <form action="includes/update_profile.inc.php" method="POST">
         <div class="user-info">
            <?php
            if (isset($_SESSION["userid"]) && isset($_SESSION["useruid"])) {
               // Extract the first letter of the username
               $first_letter = strtoupper(substr($_SESSION["useruid"], 0, 1));
            ?>
               <div class="users-circle-sub"><?php echo $first_letter; ?></div>
            <?php
            }
            ?>
         </div>
         
         <div class="input-group">
            <!-- Input Fields for Username, Email, and Profile Image -->
            <div class="inputBox">
               <span>Username:</span>
               <input type="text" name="uid" value="<?php echo $fetch['usersUid']; ?>" class="box">
               <span>Your Email:</span>
               <input type="email" name="email" value="<?php echo $fetch['usersEmail']; ?>" class="box">
            </div>

            <!-- Input Fields for Passwords -->
            <div class="inputBox">
               <span>New Password:</span>
               <input type="password" name="pwd" placeholder="Enter New Password" class="box">
               <span>Confirm Password:</span>
               <input type="password" name="pwdrepeat" placeholder="Confirm New Password" class="box">
            </div>
         </div>

         <!-- Submit Button and Go Back Link -->
         <input type="submit" value="Update Profile" name="update_profile" class="btn">
         <a href="index.php" class="delete-btn">Go Back</a>
      </form>
   </div>


   <h3>Your order</h3>
   <table>
      <thead>
         <tr>
            <th>Order ID</th>
            <th>Order Cost</th>
            <th>Order Status</th>
            <th>Order Date</th>
            <th>Order Details</th>
         </tr>
      </thead>
      <tbody>

         <?php while ($row = $orders->fetch_assoc()) { ?>
            <tr>
               <td><?php echo $row['order_id']; ?></td>
               <td><strong>ETB:</strong><?php echo $row['order_cost']; ?></td>
               <td><?php echo $row['order_status']; ?></td>
               <td><?php echo $row['order_date']; ?></td>
               <td>
                  <form action="orderdetail.php" method="POST">
                     <input type="hidden" value="<?php echo $row['order_status'];?>" name="order_status" />     >
                     <input type="hidden" name= "order_id" value="<?php echo $row['order_id']; ?>">
                     <input type="submit" class="details-btn" name="order_details-btn" value="Details" />
                  </form>
               </td>
            </tr>
         <?php } ?>
      </tbody>
   </table>

   <?php
  include ('Layouts/footer.php');
   ?>
</body>

</html>