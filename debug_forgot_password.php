<?php
// Debug script for forgot password functionality
include 'db_connect.php';
include 'email_config_secure.php';

echo "<h2>🔍 Forgot Password Debug Test</h2>";

// Test with the actual email from database
$test_email = 'evalfaculty@gmail.com';

echo "<h3>Testing with email: $test_email</h3>";

// Simulate the forgot password request
$_POST['email'] = $test_email;

// Include the handler and test
include 'forgot_password_handler.php';

echo "<h4>Step 1: Calling request_password_reset()</h4>";
$result = request_password_reset();

echo "<p><strong>Result Code:</strong> $result</p>";

switch($result) {
    case 1:
        echo "<p>✅ Success - Email should be sent</p>";
        break;
    case 2:
        echo "<p>❌ Email not found in database</p>";
        break;
    case 3:
        echo "<p>❌ Email sending failed</p>";
        break;
    case 4:
        echo "<p>❌ Too many attempts (rate limited)</p>";
        break;
    default:
        echo "<p>❌ Unknown error code: $result</p>";
}

// Check if user exists
echo "<h4>Step 2: Database Check</h4>";
$stmt = $conn->prepare("SELECT email, firstname, lastname FROM users WHERE email = ?");
$stmt->bind_param("s", $test_email);
$stmt->execute();
$user_result = $stmt->get_result();

if($user_result->num_rows > 0) {
    $user = $user_result->fetch_assoc();
    echo "<p>✅ User found: " . $user['firstname'] . " " . $user['lastname'] . "</p>";
} else {
    echo "<p>❌ User not found in database</p>";
}

// Check rate limiting table
echo "<h4>Step 3: Rate Limiting Check</h4>";
$ip_address = $_SERVER['REMOTE_ADDR'];
$one_hour_ago = date('Y-m-d H:i:s', strtotime('-1 hour'));

$stmt = $conn->prepare("SELECT COUNT(*) as attempts FROM password_reset_attempts WHERE ip_address = ? AND attempt_time > ?");
$stmt->bind_param("ss", $ip_address, $one_hour_ago);
$stmt->execute();
$rate_result = $stmt->get_result()->fetch_assoc();

echo "<p>Attempts from your IP in last hour: " . $rate_result['attempts'] . "</p>";
echo "<p>Rate limit: " . MAX_RESET_ATTEMPTS_PER_HOUR . " attempts per hour</p>";

if($rate_result['attempts'] >= MAX_RESET_ATTEMPTS_PER_HOUR) {
    echo "<p>❌ Rate limit exceeded</p>";
} else {
    echo "<p>✅ Rate limit OK</p>";
}

// Test email sending directly
echo "<h4>Step 4: Direct Email Test</h4>";
echo "<p><strong>SMTP Settings:</strong></p>";
echo "<ul>";
echo "<li>Host: " . SMTP_HOST . "</li>";
echo "<li>Port: " . SMTP_PORT . "</li>";
echo "<li>Username: " . SMTP_USERNAME . "</li>";
echo "<li>Password: " . (strlen(SMTP_PASSWORD) > 0 ? 'SET (' . strlen(SMTP_PASSWORD) . ' chars)' : 'NOT SET') . "</li>";
echo "</ul>";

// Clear rate limiting for testing
echo "<h4>Step 5: Clear Rate Limiting (for testing)</h4>";
$conn->query("DELETE FROM password_reset_attempts WHERE ip_address = '$ip_address'");
echo "<p>✅ Rate limiting cleared for your IP</p>";

echo "<div style='background: #e7f3ff; padding: 15px; border-left: 4px solid #2196F3; margin: 20px 0;'>";
echo "<h4>🧪 Test Again</h4>";
echo "<p>Rate limiting has been cleared. Try the forgot password form again:</p>";
echo "<p><a href='index.php?page=forgot_password' target='_blank' style='background: #2196F3; color: white; padding: 10px 15px; text-decoration: none; border-radius: 5px;'>Test Forgot Password</a></p>";
echo "</div>";

?>
