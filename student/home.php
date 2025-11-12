<?php 
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include('db_connect.php');

// Auto-redirect to teacher evaluation page
header('Location: index.php?page=evaluate');
exit();
?>
