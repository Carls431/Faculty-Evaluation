<?php
session_start();
// Destroy session
session_destroy();
foreach ($_SESSION as $key => $value) {
    unset($_SESSION[$key]);
}
// Redirect to student login page
header("location:student_login.php");
?>