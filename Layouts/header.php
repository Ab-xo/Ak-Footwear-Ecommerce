 <?php
  session_start();
  // Initialize totalQuantity in session if not set
  if (!isset($_SESSION['totalQuantity'])) {
    $_SESSION['totalQuantity'] = 0;
  }

  ?>
 <!DOCTYPE html>
 <html lang="en">

 <head>
   <meta charset="utf-8">
   <meta http-equiv="x-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width,initial-scale=1.0">
   <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Cinzel|Fauna+One">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
   <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
   <link rel="icon" type="image/x-icon" href="img/Capture1-removebg-preview.png">
   <link rel="stylesheet" href="style.css">
   <link rel="stylesheet" href="css/login.css">
   <style>
     /* styling the user-icon after login which shows its username*/
     .user-circle {
       position: relative;
       right: -15px;
       width: 30px;
       height: 30px;
       border-radius: 50%;
       background-color: rgba(20, 167, 62, 1);
       /* You can customize the background color */
       color: #ffffff;
       font-size: 15px;
       text-align: center;
       line-height: 30px;
       font-weight: bold;

     }

     .user-circle-sub {
       position: relative;
       width: 50px;
       height: 50px;
       border-radius: 50%;
       background-color: rgba(20, 167, 62, 1);
       /* You can customize the background color */
       color: #ffffff;
       font-size: 15px;
       text-align: center;
       margin: 0px 100px auto;
       line-height: 50px;
       font-weight: bold;
     }

     .sub-menu-wrap {
       position: absolute;
       top: 100%;
       right: 10%;
       width: 320px;
       max-height: 0px;
       overflow: hidden;
       transition: max-height 0.7s;
     }

     .sub-menu-wrap.open-menu {
       max-height: 400px;


     }

     .sub-menu {
       background-color: #5358B3;
       padding: 20px;
       margin: 10px;
       border: 1px solid #333;
       /* Border with a dark color */
       border-radius: 10px;
       /* Rounded corners */
       box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
       /* Shadow for depth */
     }

     .user-info {
       display: inline-block;
       align-items: center;
     }

     .user-info h2 {
       font-weight: 500;
       margin: 0px 30px auto;
       color: #ffc107;
     }

     .user-info img {
       width: 60px;
       height: 60px;
       border-radius: 50%;
       margin-right: 15px;
     }

     .sub-menu hr {
       border: 0;
       height: 1px;
       width: 100%;
       background: #ccc;
       margin: 15px 0 10px;
     }

     .sub-menu-link {
       display: flex;
       align-items: center;
       text-decoration: none;
       color: #525252;
       margin: 12px 0;
     }

     .sub-menu-link p {
       width: 100%;
       color: #ffff;

     }

     .sub-menu-link i {
       width: 35px;
       background: #e5e5e5;
       border-radius: 50%;
       padding: 8px;
       margin-right: 15px;

     }

     .sub-menu-link span {
       font-size: 22px;
       transition: transform 0.5;
       color: #ffff;
     }

     .sub-menu-link:hover span {
       transform: translate(5px);
       color: #ffff;
     }

     .sub-menu-link:hover p {
       font-weight: 600;

     }

     /* styling of cart and quantity in header of website */
     #cart table tbody td.empty-cart {
       color: rgb(98, 236, 130);
       font-weight: bold;
       font-size: 300%;
     }

     #totalQuantity {
       position: absolute;
       top: -28px;
       right: 28px;
       font-size: x-large;
       background-color: #b31010;
       width: 29px;
       height: 29px;
       color: #fff;
       font-weight: bold;
       display: flex;
       justify-content: center;
       align-items: center;
       border-radius: 50%;
       transform: translateX(20px);
     }

     .fa-cart-shopping {
       font-size: 24px;
     }

     /* styling of the search box input*/
     .search-bar {
       position: relative;
       display: flex;
       justify-content: center;
       align-items: center;
     }

     .search-box {
       display: flex;
       border-radius: 25px;
       background: #ffffff;
       box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
       transition: all 0.3s ease-in-out;
       overflow: hidden;
     }

     .search-box input {
       border: none;
       outline: none;
       padding: 10px 20px;
       border-radius: 25px 0 0 25px;
       width: 250px;
       transition: all 0.3s ease-in-out;
     }

     .search-box button {
       background-color: #ff6600;
       border: none;
       padding: 10px 20px;
       border-radius: 0 25px 25px 0;
       cursor: pointer;
       transition: all 0.3s ease-in-out;
       color: white;
     }

     .search-box button i {
       font-size: 16px;
     }

     .search-box:hover {
       box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
     }

     .search-box input:focus {
       width: 150px;
     }

     .search-box button:hover {
       background-color: #ff4500;
     }

     @media screen and (max-width: 480px) {
       .search-box input {
         width: 150px;
       }

       .search-box input:focus {
         width: 150px;
       }
     }

     /* Pop-Up- eroor message show both in login and sign up form */
     .popup-message {
       display: block;
       position: fixed;
       left: 50%;
       top: 50%;
       transform: translate(-50%, -50%);
       padding: 20px;
       background-color: #f44336;
       color: white;
       border-radius: 8px;
       box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
       z-index: 1000;
       max-width: 300px;
       text-align: center;
       font-size: 16px;
     }

     .close-btn {
       position: absolute;
       top: 0px;
       right: 6px;
       color: white;
       font-size: 20px;
       font-weight: bold;
       cursor: pointer;
     }

     .close-btn:hover {
       color: #000;
     }
   </style>
 </head>

 <body>
   <section id="header">
     <a href="#"><img src="img/Capture1-removebg-preview.png" class="logo" alt=""></a>

     <form id="searchForm" action="shop.php" method="POST" class="search-bar">
       <div class="search-box">
         <input type="text" name="search" id="searchInput" placeholder="Search...">
         <button type="submit">
           <i class="fas fa-search"></i>
         </button>
       </div>
     </form>
     <ul id="nav-bar">
       <li><a href="index.php" data-translate="homepage">Home</a></li>
       <li><a href="shop.php" data-translate="shoppage">Shop</a></li>
       <li><a href="Blog.php" data-translate="blogpage">Blog</a></li>
       <li><a href="About.php" data-translate="aboutpage">About</a></li>
       <li><a href="contact.php" data-translate="contactpage">Contact</a></li>

       <?php
        if (isset($_SESSION["userid"]) && isset($_SESSION["useruid"])) {
          // Extract the first letter of the username
          $first_letter = strtoupper(substr($_SESSION["useruid"], 0, 1));
        ?>

         <li id="lg-bag">
           <a id="cart-icon" href="cart.php">
             <i class="fa-solid fa-cart-shopping"></i>
             <?php if(isset($_SESSION['totalQuantity']) && $_SESSION['totalQuantity'] !=0){ ?>
             <div id="totalQuantity"><?php echo $_SESSION['totalQuantity']; ?></div>
             <?php }?>
           </a>
         </li>

         <!-- Display the circular username -->
         <div class="user-circle" onclick="toggleMenu();"><?php echo $first_letter; ?></div>
         <div class="sub-menu-wrap" id="subMenu">
           <div class="sub-menu">
             <div class="user-info">
               <div class="user-circle-sub"><?php echo $first_letter; ?></div>
               <h2><?php echo $_SESSION["useruid"]; ?></h2>
             </div>
             <hr>
             <a href="account.php" class="sub-menu-link">
               <i class="fa-solid fa-user"></i>
               <p>Edit Profile</p>
               <span>></span>
             </a>
             <a href="#" class="sub-menu-link">
               <i class="fa-solid fa-wrench"></i>
               <p>Setting & Privacy</p>
               <span>></span>
             </a>
             <a href="#" class="sub-menu-link">
               <i class="fa-solid fa-handshake-angle"></i>
               <p>Help & Support</p>
               <span>></span>
             </a>
             <a href="#" class="sub-menu-link">
               <i class="fa-solid fa-right-from-bracket"></i>
               <p>Logout</p>
               <span>></span>
             </a>
           </div>
         </div>
         <li class="logout-btn"><a href="includes/logout.inc.php">LogOut</a></li>
         <a href="#" id="close"><i class="fa-solid fa-xmark"></i></a>
       <?php
        } else {
        ?>
         <li><a href="login.php"><i class="fa-solid fa-user"></i></a></li>
         <a href="#" id="close"><i class="fa-solid fa-xmark"></i></a></li>
         <li id="lg-bag">
           <a id="cart-icon" href="cart.php">
             <i class="fa-solid fa-cart-shopping"></i>
             <?php if(isset($_SESSION['totalQuantity']) && $_SESSION['totalQuantity'] !=0){ ?>
             <div id="totalQuantity"><?php echo $_SESSION['totalQuantity']; ?></div>
             <?php }?>
           </a>
         </li>
       <?php
        }
        ?>
     </ul>

     </div>
     <div id="mobile">
       <a href="cart.html"><i class="fa fa-shopping-cart" aria-hidden="true"></i></a>
       <i id="bar" class="fas fa-outdent"></i>
     </div>
   </section>
   <script>
         function closePopup() {
             document.getElementById('popupMessage').style.display = 'none';
         }

         window.onload = function() {
             var urlParams = new URLSearchParams(window.location.search);
             if (urlParams.has('error')) {
                 var errorMessage = urlParams.get('error');
                 document.getElementById('popupMessageContent').innerText = errorMessage;
                 document.getElementById('popupMessage').style.display = 'block';
             }
         }
     </script>
   <script src="js/script.js"></script>
 </body>
 </html>