<?php
session_start();
include('./db_connect.php');

// Check if student is logged in
if (!isset($_SESSION['login_id']) || $_SESSION['login_type'] != 3) {
    header("location:mobile_login.php");
    exit;
}

// Redirect to the existing evaluation system which is already responsive
header("location:index.php?page=evaluate");
exit;
?>
