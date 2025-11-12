<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once 'vendor/autoload.php';
require_once 'email_config_forgot.php';
require_once 'db_connect.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

echo "<h2>🔧 Actual Password Reset Process Test</h2>";

// Simulate the actual forgot password request
$test_email = "evalfaculty@gmail.com";

echo "<h3>Step 1: Simulating forgot password form submission</h3>";
echo "<p>Testing with email: <strong>$test_email</strong></p>";

// Set up POST data like the form would
$_POST['email'] = $test_email;
$_POST['action'] = 'request_reset';
$_SERVER['REQUEST_METHOD'] = 'POST';
$_SERVER['REMOTE_ADDR'] = '127.0.0.1';

// Clear any previous rate limiting
$conn->query("DELETE FROM password_reset_attempts WHERE ip_address = '127.0.0.1'");

echo "<h3>Step 2: Calling forgot_password_handler.php</h3>";

// Capture output from the handler
ob_start();
include 'forgot_password_handler.php';
$handler_output = ob_get_clean();

echo "<p><strong>Handler Response:</strong> $handler_output</p>";

switch($handler_output) {
    case '1':
        echo "<p>✅ Success - Password reset email should be sent</p>";
        break;
    case '2':
        echo "<p>❌ Email not found in database</p>";
        break;
    case '3':
        echo "<p>❌ Email sending failed</p>";
        break;
    case '4':
        echo "<p>❌ Too many attempts (rate limited)</p>";
        break;
    default:
        echo "<p>❌ Unexpected response: '$handler_output'</p>";
}

// Check if token was created in database
echo "<h3>Step 3: Checking database for reset token</h3>";
$stmt = $conn->prepare("SELECT reset_token, reset_expires FROM users WHERE email = ?");
$stmt->bind_param("s", $test_email);
$stmt->execute();
$result = $stmt->get_result();

if($result->num_rows > 0) {
    $user = $result->fetch_assoc();
    if($user['reset_token']) {
        echo "<p>✅ Reset token created: " . substr($user['reset_token'], 0, 16) . "...</p>";
        echo "<p>✅ Token expires: " . $user['reset_expires'] . "</p>";
        
        // Test the reset link
        $reset_link = "http://localhost/eval/index.php?page=reset_password&token=" . $user['reset_token'];
        echo "<p><strong>Reset Link:</strong> <a href='$reset_link' target='_blank'>Test Reset Link</a></p>";
    } else {
        echo "<p>❌ No reset token found in database</p>";
    }
} else {
    echo "<p>❌ User not found</p>";
}

echo "<h3>Step 4: Manual Email Test</h3>";
echo "<p>Let's try sending an email manually to verify SMTP works:</p>";

function manual_email_test($email) {
    $mail = new PHPMailer(true);
    
    try {
        $mail->isSMTP();
        $mail->Host = SMTP_HOST;
        $mail->SMTPAuth = true;
        $mail->Username = SMTP_USERNAME;
        $mail->Password = SMTP_PASSWORD;
        $mail->SMTPSecure = SMTP_ENCRYPTION;
        $mail->Port = SMTP_PORT;
        $mail->Timeout = 30;
        
        $mail->setFrom(FROM_EMAIL, FROM_NAME);
        $mail->addAddress($email);
        
        $mail->isHTML(true);
        $mail->Subject = 'Manual Test - Password Reset Debug';
        $mail->Body = '<h1>Manual Test</h1><p>This is a manual test to verify email sending works.</p>';
        
        $mail->send();
        return true;
    } catch (Exception $e) {
        echo "<p>❌ Manual email failed: " . $e->getMessage() . "</p>";
        return false;
    }
}

if(manual_email_test($test_email)) {
    echo "<p>✅ Manual email test successful</p>";
} else {
    echo "<p>❌ Manual email test failed</p>";
}

echo "<div style='background: #fff3cd; padding: 15px; border: 1px solid #ffeaa7; border-radius: 5px; margin: 20px 0;'>";
echo "<h4>🔍 Troubleshooting</h4>";
echo "<p>If emails are not arriving:</p>";
echo "<ul>";
echo "<li>Check Gmail spam/junk folder</li>";
echo "<li>Wait 1-2 minutes for delivery</li>";
echo "<li>Try refreshing Gmail</li>";
echo "<li>Check if Gmail is blocking the emails</li>";
echo "</ul>";
echo "</div>";
?>