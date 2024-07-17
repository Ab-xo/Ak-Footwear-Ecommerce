<?php
require_once 'dbh.inc.php';
require_once 'functions.inc.php';

if (isset($_SESSION['logged_in']) && isset($_SESSION['logged_in']) == true) {

    header("location:index.php"); // Redirect to index.php or any other page
    exit();
}
