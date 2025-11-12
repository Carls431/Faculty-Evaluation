<?php
// Test script for SMS functionality
require_once 'twilio_config.php';
require_once 'db_connect.php';

// Enable error reporting for debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

echo "<h1>Testing SMS Functionality</h1>";

// Check if Twilio credentials are defined
echo "<h2>Twilio Configuration Check</h2>";
echo "Account SID: " . (defined('TWILIO_ACCOUNT_SID') ? TWILIO_ACCOUNT_SID : 'NOT DEFINED') . "<br>";
echo "Auth Token: " . (defined('TWILIO_AUTH_TOKEN') ? 'SET' : 'NOT DEFINED') . "<br>";
echo "Phone Number: " . (defined('TWILIO_PHONE_NUMBER') ? TWILIO_PHONE_NUMBER : 'NOT DEFINED') . "<br>";

// Test sending SMS to a dummy number
echo "<h2>Sending Test SMS</h2>";
$test_number = '+639123456789'; // Replace with a real test number if you have one
$test_message = 'This is a test message from the school system.';

echo "Attempting to send SMS to: $test_number<br>";
echo "Message: $test_message<br>";

// Check if phone number is properly formatted
if (strpos($test_number, '+') !== 0) {
    echo "<p style='color:red'>Error: Phone number must be in international format starting with +</p>";
} else {
    // Try to send the SMS
    $result = send_sms($test_number, $test_message);

    if ($result) {
        echo "<p style='color:green'>SMS sent successfully!</p>";
    } else {
        echo "<p style='color:red'>Failed to send SMS. Check error logs for details.</p>";
    }
}

// Check cURL extension
echo "<h2>cURL Extension Check</h2>";
if (extension_loaded('curl')) {
    echo "<p style='color:green'>cURL extension is loaded.</p>";
} else {
    echo "<p style='color:red'>cURL extension is not loaded. This is required for Twilio API.</p>";
}

// Check PHP version
echo "<h2>PHP Version</h2>";
echo "PHP Version: " . phpversion() . "<br>";
if (version_compare(PHP_VERSION, '5.6.0') >= 0) {
    echo "<p style='color:green'>PHP version is compatible.</p>";
} else {
    echo "<p style='color:red'>PHP version may not be compatible with Twilio API.</p>";
}
?>