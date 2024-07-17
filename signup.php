 <?php
   include ('Layouts/header.php');
    if (isset($_SESSION["userid"])) {
        echo "<script>window.location.href ='index.php';</script>";
        exit();
    } else if (isset($_SESSION['registration_success']) && $_SESSION['registration_success'] === true) {
        echo "<script>window.location.href ='login.php';</script>";
        exit();
    }
    ?>
     <title>Register </title>
     <style>
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

         .eye-icons {
             position: absolute;
             top: 50%;
             min-width: 50px;
             right: 40px;
             transform: translateY(-50%);
             font-size: 18px;
             color: #8b8b8b;
             cursor: pointer;
             padding: 5px;
         }

         #page-header.signup-header {
             background-image: url("https://t3.ftcdn.net/jpg/04/74/64/76/360_F_474647635_hi7VkJUCtIHRb5fBIsSLiPjywtXtUs3s.jpghttps://img.freepik.com/premium-vector/vector-illustration-register-now-speech-bubble-label_180786-180.jpghttps://t4.ftcdn.net/jpg/03/88/30/03/360_F_388300372_4EjWUJxQ8lHzsPP7wIb9X3IXIh3Fxzns.jpg");
             width: 100%;
             height: 40vh;
             background-size: cover;
             display: flex;
             justify-content: center;
             text-align: center;
             padding: 14px;
             flex-direction: column;
             background-repeat: no-repeat;
             background-position: center;
         }

         #page-header h2,
         #page-header p {
             color: #fff;
         }
     </style>

     <section id="page-header" class="signup-header">

     </section>

     <section>
         <div class="wrapper">
             <h2> Sign Up</h2>
             <div class='popup-message' id='popupMessage' style='display: none;'>
                 <span class='close-btn' onclick='closePopup()'>&times;</span>
                 <span id='popupMessageContent'></span>
             </div>
             <form action="includes/signup.inc.php" method="POST" enctype="multipart/form-data">

                 <div class="input-box">
                     <input type="text" name="name" placeholder="Enter your Full name" required>
                     <i class="fa-solid fa-circle-user icons"></i>
                 </div>
                 <div class="input-box">
                     <i class="fa fa-envelope icons" aria-hidden="true"></i>
                     <input type="text" name="email" placeholder="Enter your email" required>
                 </div>
                 <div class="input-box">
                     <i class="fa fa-user icons" aria-hidden="true"></i>
                     <input type="text" name="uid" placeholder="Enter your user name" required>
                 </div>
                 <div class="input-box">
                     <i class="fa-solid fa-lock icons"></i>
                     <input type="password" name="pwd" placeholder="Create password" id="password" required>
                     <i id="togglePassword" aria-hidden="true"></i>
                 </div>
                 <div class="input-box">
                     <i class="fa-solid fa-lock icons"></i>
                     <input type="password" name="pwdrepeat" placeholder="Confirm password" id="confirmPassword" required>
                 </div>
                 <div class="input-box button">
                     <input type="Submit" name="submit" value="Sign Up Now">
                 </div>
                 <div class="text">
                     <h3>Already have an account? <a href="login.php">Login now</a></h3>
                 </div>
             </form>
         </div>
     </section>

    <?php include ('Layouts/footer.php'); ?>

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

     <script>
         const togglePassword = document.getElementById('togglePassword');
         const password = document.getElementById('password');
         const confirmPassword = document.getElementById('confirmPassword');

         togglePassword.addEventListener('click', function() {
             const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
             password.setAttribute('type', type);
             confirmPassword.setAttribute('type', type);
             this.classList.toggle('fa-eye');
             this.classList.toggle('fa-eye-slash');
             confirmPassword.value = text.value; // Synchronize confirm password with password
         });
     </script>

 