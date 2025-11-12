<?php
require_once('db_connect.php');
require_once('twilio_config.php');

// Existing AJAX handlers...

// Update student phone number
if(isset($_POST['action']) && $_POST['action'] == 'update_student_phone'){
    $id = $_POST['id'];
    $phone = $_POST['phone'];

    $conn->query("UPDATE student_list SET phone = '{$phone}' WHERE id = {$id}");
    echo 1;
    exit;
}

// Toggle SMS notifications
if(isset($_POST['action']) && $_POST['action'] == 'toggle_sms_notifications'){
    $id = $_POST['id'];
    $sms_notifications = $_POST['sms_notifications'] ? 1 : 0;

    $conn->query("UPDATE student_list SET sms_notifications = {$sms_notifications} WHERE id = {$id}");
    echo 1;
    exit;
}

// Send SMS
if(isset($_POST['action']) && $_POST['action'] == 'send_sms'){
    $student_id = $_POST['student_id'];
    $message = $_POST['message'];

    // Get student phone number from database
    $student = $conn->query("SELECT * FROM student_list WHERE id = {$student_id}")->fetch_assoc();

    if($student && !empty($student['phone'])){
        // Check if Twilio setup is correct
        if(defined('TWILIO_ACCOUNT_SID') && defined('TWILIO_AUTH_TOKEN') && defined('TWILIO_PHONE_NUMBER')){
            $response = send_sms($student['phone'], $message);
            if($response){
                echo 1;
            }else{
                echo 0;
            }
        }else{
            error_log('Twilio credentials are not set');
            echo 0;
        }
    }else{
        error_log('Student phone number is not set');
        echo 0;
    }
    exit;
}
