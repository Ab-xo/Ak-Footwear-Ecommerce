<?php 
require_once 'dbh.inc.php';
require_once 'functions.inc.php';
session_start();

 if(isset($_POST['update_profile'])) {
    $user_id = $_SESSION["userid"];

    // Check if individual fields are set and update them
    if(isset($_POST['email'])) {
        $email = $_POST['email'];
        if(InvalidEmail($email) !== false){
            header("location: ../account.php?error=Please choose Valid Email!");
            exit();
        }
        $stmt = $conn->prepare("UPDATE users SET usersEmail=? WHERE usersId=?");
        $stmt->bind_param('si', $email, $user_id);
        if(!$stmt->execute()){
            header('location: ../account.php?error=Could not update email');
            exit();
        }
        $_SESSION["useremail"] = $email;
    }

    if(isset($_POST['uid'])) {
        $username = $_POST['uid'];
        if(invalidUid($username) !== false){
            header("location: ../account.php?error=Please choose Valid Username!");
            exit();
        }
        $stmt = $conn->prepare("UPDATE users SET usersUid=? WHERE usersId=?");
        $stmt->bind_param('si', $username, $user_id);
        if(!$stmt->execute()){
            header('location: ../account.php?error=Could not update username');
            exit();
        }
        $_SESSION["useruid"] = $username;
    }

    if(isset($_POST['pwd']) && isset($_POST['pwdrepeat'])) {
        $pwd = mysqli_real_escape_string($conn, $_POST['pwd']);
        $pwdRepeat = mysqli_real_escape_string($conn, $_POST['pwdrepeat']);
        if(pwdStrong($pwd) !== false){
            header("location: ../account.php?error=Please choose a Strong Password and 6 length characters!");
            exit();
        }
        if(pwdMatch($pwd,$pwdRepeat) !== false){
            header("location: ../account.php?error=Password is not Match!");
            exit();
        }
        $hashed_pwd = password_hash($pwd, PASSWORD_DEFAULT);
        $stmt = $conn->prepare("UPDATE users SET usersPwd=? WHERE usersId=?");
        $stmt->bind_param('si', $hashed_pwd, $user_id);
        if(!$stmt->execute()){
            header('location: ../account.php?error=Could not update password');
            exit();
        }
    }

    header('location: ../account.php?message=Profile updated successfully');
}

