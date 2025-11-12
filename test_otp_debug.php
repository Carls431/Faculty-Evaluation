<?php
// Debug OTP System
session_start();
include('./db_connect.php');

echo "<h2>OTP System Debug</h2>";

// Test 1: Check if OTP columns exist
echo "<h3>1. Checking if OTP columns exist...</h3>";
$result = $conn->query("DESCRIBE student_list");
$columns = [];
while($row = $result->fetch_assoc()) {
    $columns[] = $row['Field'];
}

if(in_array('otp', $columns) && in_array('otp_expires', $columns)) {
    echo "✅ OTP columns exist in database<br>";
} else {
    echo "❌ OTP columns missing! Please run this SQL:<br>";
    echo "<code>ALTER TABLE `student_list` ADD COLUMN `otp` VARCHAR(6) NULL DEFAULT NULL AFTER `avatar`, ADD COLUMN `otp_expires` DATETIME NULL DEFAULT NULL AFTER `otp`;</code><br>";
}

// Test 2: Check if student exists
echo "<h3>2. Testing student credentials...</h3>";
$testStudentId = '6231415';
$testEmail = 'jsmith@sample.com';

$qry = $conn->query("SELECT id, student_id, firstname, lastname, email FROM student_list WHERE student_id = '$testStudentId' AND email = '$testEmail'");
if($qry->num_rows > 0) {
    $student = $qry->fetch_assoc();
    echo "✅ Test student found:<br>";
    echo "- ID: " . $student['id'] . "<br>";
    echo "- Student ID: " . $student['student_id'] . "<br>";
    echo "- Name: " . $student['firstname'] . " " . $student['lastname'] . "<br>";
    echo "- Email: " . $student['email'] . "<br>";
} else {
    echo "❌ Test student not found. Available students:<br>";
    $allStudents = $conn->query("SELECT student_id, email, firstname, lastname FROM student_list LIMIT 5");
    while($row = $allStudents->fetch_assoc()) {
        echo "- Student ID: " . $row['student_id'] . ", Email: " . $row['email'] . ", Name: " . $row['firstname'] . " " . $row['lastname'] . "<br>";
    }
}

// Test 3: Check email configuration
echo "<h3>3. Checking email configuration...</h3>";
if(file_exists('email_config.php')) {
    include 'email_config.php';
    echo "✅ Email config file exists<br>";
    echo "- SMTP Host: " . SMTP_HOST . "<br>";
    echo "- SMTP Username: " . SMTP_USERNAME . "<br>";
    echo "- From Name: " . SMTP_FROM_NAME . "<br>";
} else {
    echo "❌ Email config file missing<br>";
}

// Test 4: Check OTP functions
echo "<h3>4. Checking OTP functions...</h3>";
if(file_exists('otp_functions.php')) {
    echo "✅ OTP functions file exists<br>";
    try {
        include_once 'otp_functions.php';
        echo "✅ OTP functions loaded successfully<br>";
        
        // Test OTP generation
        $testOTP = generateOTP();
        echo "✅ OTP generation works: " . $testOTP . "<br>";
    } catch(Exception $e) {
        echo "❌ Error loading OTP functions: " . $e->getMessage() . "<br>";
    }
} else {
    echo "❌ OTP functions file missing<br>";
}

echo "<br><a href='student_login.php'>← Back to Student Login</a>";
?>