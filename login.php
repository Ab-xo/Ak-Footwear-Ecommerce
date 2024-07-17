<?php
include ('Layouts/header.php');
if (isset($_SESSION["userid"])) {
  echo "<script>window.location.href ='index.php';</script>";
  exit();
}
?>
<title>Login</title>
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

  .log-eye-icons {
    top: 33%;
    position: absolute;
    min-width: 50px;
    right: 40px;
    transform: translateY(-50%);
    font-size: 18px;
    color: #8b8b8b;
    cursor: pointer;
    padding: 5px;
  }


  /* show all styling of login wrapper */
  .wrappers {
    max-width: 530px;
    width: 100%;
    background: #2e38f1;
    padding: 30px;
    margin: 100px auto 30px;
    width: 60%;
    border-radius: 9px;
    box-shadow: 0 5px 10px rgba(3, 3, 3, 0.2);
  }

  .wrappers h2 {
    position: relative;
    font-size: 22px;
    font-weight: 600;
    color: #fff;
  }

  .wrappers .message {
    margin: 10px 0;
    width: 100%;
    border-radius: 5px;
    padding: 10px;
    text-align: center;
    font-size: 20px;
    color: #eb0909;
    background-color: #ffff;
  }

  .wrappers h2::before {
    content: "";
    position: absolute;
    left: 0;
    bottom: 0;
    height: 3px;
    width: 50px;
    border-radius: 12px;
    background: #4070f4;
  }

  .wrappers form {
    margin-top: 30px;
    height: 80%;
  }

  .wrappers form .input-box {
    height: 52px;
    margin: 12px 0;
  }

  form .input-box input {
    height: 100%;
    width: 100%;
    outline: none;
    padding: 0 30px;
    font-size: 17px;
    font-weight: 400;
    color: #333;
    border: 1.5px solid #c7bebe;
    border-bottom-width: 2.5px;
    border-radius: 6px;
    transition: all 0.3s ease;
  }

  .input-box input:focus,
  .input-box input:valid {
    border-color: #4070f4;
  }

  form .policy {
    display: flex;
    align-items: center;
  }

  form h3 {
    color: #eee7e7;
    font-size: 14px;
    font-weight: 500;
    margin-left: 10px;
  }

  .input-box.button input {
    color: #fff;
    letter-spacing: 1px;
    border: none;
    background: #05e043fb;
    cursor: pointer;
  }

  .input-box.button input:hover {
    background: #101111;
  }

  form .text h3 {
    color: #faf9f9;
    width: 100%;
    text-align: center;
  }

  form .text h3 a {
    color: #3ae008;
    text-decoration: none;
  }

  form .text h3 a:hover {
    text-decoration: underline;
  }

  /* the image section above header in login pge*/

  #page-header.login-header {
    background-image: url("banner-box/146122694-user-login-form-on-mobile-phone-screen-isometric-smartphone-with-blue-screen-and-authentication-or.jpg");
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
<section id="page-header" class="login-header">
  <h2>#Login Now</h2>
  <p>Sign in to access your account and explore exclusive benefits!</p>
</section>

<div class="wrapper">
  <h2> Log in</h2>

  <div class='popup-message' id='popupMessage' style='display: none;'>
    <span class='close-btn' onclick='closePopup()'>&times;</span>
    <span id='popupMessageContent'></span>
  </div>

  <form action="includes/login.inc.php" method="post">
    <div class="input-box">
      <i class="fa-solid fa-circle-user icons"></i>
      <input type="text" name="uid" placeholder="Enter Your Username Or Email" required>
    </div>
    <div class="input-box">
      <i class="fa-solid fa-lock icons"></i>
      <input type="password" name="pwd" id="password" placeholder="Enter Your Password" required>
      <i id="togglePassword" class="fa fa-eye-slash log-eye-icons" aria-hidden="true"></i>
    </div>
    <div class="policy">
      <input type="checkbox" name="terms">
      <h3>I accept all terms & condition</h3>
    </div>
    <div class="input-box button">
      <input type="Submit" name="submit" value="LogIn Now">
    </div>
    <div class="text">
      <h3>Don't have an account? <a href="signup.php">Sign up now</a></h3>
    </div>
  </form>
</div>

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
  togglePassword.addEventListener('click', function() {
    const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
    password.setAttribute('type', type);
    this.classList.toggle('fa-eye');
    this.classList.toggle('fa-eye-slash');
    // Synchronize confirm password with password
  });
</script>
<script src="script.js"></script>