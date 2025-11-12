<?php
// Email Configuration for OTP - REPLACE WITH YOUR ACTUAL CREDENTIALS
define('SMTP_HOST', 'smtp.gmail.com');
define('SMTP_PORT', 587);
define('SMTP_USERNAME', 'your_email@gmail.com'); // Your Gmail
define('SMTP_PASSWORD', 'your_app_password_here');    // Gmail App Password
define('SMTP_FROM_EMAIL', 'your_email@gmail.com'); // Your Gmail
define('SMTP_FROM_NAME', 'Student Evaluation System');

// OTP Settings
define('OTP_EXPIRY_MINUTES', 5); // OTP expires in 5 minutes
define('OTP_LENGTH', 6); // 6-digit OTP
?>