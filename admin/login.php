<?php

if (isset($_SESSION["adminid"])) {
  echo "<script>window.location.href ='index.php';</script>";
  exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Login</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <style>
    body {
      background: linear-gradient(to right, #2980b9, #6dd5fa); /* Gradient background */
      height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
    }
    .login-container {
      max-width: 600px;
      padding: 40px;
      border-radius: 10px;
      box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
      background-color: rgba(255, 255, 255, 0.9); /* Semi-transparent white background */
      background-image: url('https://www.transparenttextures.com/patterns/cubes.png'); /* Subtle pattern */
    }
    .login-container h2 {
      text-align: center;
      margin-bottom: 30px;
      color: #333;
    }
    .form-group {
      margin-bottom: 25px;
    }
    .form-control {
      border-radius: 6px;
      border: 1px solid #ced4da;
    }
    .form-control:focus {
      border-color: #007bff;
      box-shadow: none;
    }
    .btn-login {
      width: 100%;
      border-radius: 6px;
      background-color: #007bff;
      color: #fff;
      border: none;
      transition: background-color 0.3s ease;
    }
    .btn-login:hover {
      background-color: #0056b3;
    }
    .btn-login:focus {
      outline: none;
      box-shadow: none;
    }
    .login-footer {
      text-align: center;
      margin-top: 20px;
      color: #555;
    }
    .login-footer a {
      color: #007bff;
      text-decoration: none;
    }
    .login-footer a:hover {
      text-decoration: underline;
    }
  </style>
</head>
<body>
  <div class="login-container">
    <h2>Admin Login</h2>
    <form action="../admin-includes/login.adm.php" method="post">
      <div class="form-group">
        <input type="text" name="adminuid"  class="form-control" placeholder="Username" required>
      </div>
      <div class="form-group">
        <input type="password"  name="adminpwd"class="form-control" placeholder="Password" required>
      </div>
      <button type="submit" name="admin-btn-login"class="btn btn-login">Login</button>
    </form>
    
  </div>
</body>
</html>
