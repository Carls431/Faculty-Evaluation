<?php
// Detailed debugging script for SMS functionality
require_once 'twilio_config.php';
require_once 'db_connect.php';

// Enable error reporting for debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

echo "<h1>Detailed SMS Debugging</h1>";

// Test sending SMS with error details
echo "<h2>Sending Test SMS with Debug Info</h2>";
$test_number = '+639123456789'; 
$test_message = 'This is a test message from the school system.';

echo "Attempting to send SMS to: $test_number<br>";
echo "Message: $test_message<br>";

// Check if phone number is properly formatted
if (strpos($test_number, '+') !== 0) {
    echo "<p style='color:red'>Error: Phone number must be in international format starting with +</p>";
} else {
    // Try to send the SMS with detailed error handling
    $url = "https://api.twilio.com/2010-04-01/Accounts/" . TWILIO_ACCOUNT_SID . "/Messages.json";

    $data = array(
        "To" => $test_number,
        "From" => TWILIO_PHONE_NUMBER,
        "Body" => $test_message
    );

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        "Authorization: Basic " . base64_encode(TWILIO_ACCOUNT_SID . ":" . TWILIO_AUTH_TOKEN)
    ));

    echo "<h3>cURL Request Details</h3>";
    echo "URL: $url<br>";
    echo "Data: " . print_r($data, true) . "<br>";

    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    $curlError = curl_error($ch);
    curl_close($ch);

    echo "<h3>cURL Response</h3>";
    echo "HTTP Status Code: $httpCode<br>";
    echo "cURL Error: $curlError<br>";
    echo "API Response: $response<br>";

    if($httpCode == 201){
        echo "<p style='color:green'>SMS sent successfully!</p>";
    } else {
        echo "<p style='color:red'>Failed to send SMS.</p>";

        // Try to decode the JSON response to get more details
        $responseData = json_decode($response, true);
        if (isset($responseData['message'])) {
            echo "<p>Error Message: " . htmlspecialchars($responseData['message']) . "</p>";
        }
        if (isset($responseData['code'])) {
            echo "<p>Error Code: " . htmlspecialchars($responseData['code']) . "</p>";
        }
    }
}
?>