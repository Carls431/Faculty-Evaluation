<?php 
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$conn= new mysqli('localhost','root','','evaluation_db')or die("Could not connect to mysql".mysqli_error($con));

if(isset($_SESSION['login_id'])){
    $academic = $conn->query("SELECT * FROM academic_list where is_default = 1");
    if($academic->num_rows > 0){
        foreach($academic->fetch_array() as $k => $v){
            if(!is_numeric($k))
                $_SESSION['academic'][$k] = $v;
        }
    }
}
