<?php
// Debug email sending issue after optimization
include 'db_connect.php';
include 'email_config_secure.php';

echo "<h2>🔍 Email Debug - After Optimization</h2>";

// Test the forgot password request
$test_email = 'evalfaculty@gmail.com';
$_POST['email'] = $test_email;

echo "<h3>Step 1: Testing request_password_reset()</h3>";

// Include handler and test
include 'forgot_password_handler.php';
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
        echo "<p>❌ Unknown error: $result</p>";
}

// Test direct email with optimizations
echo "<h3>Step 2: Testing Optimized Email Sending</h3>";

require_once 'vendor/autoload.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

$mail = new PHPMailer(true);

try {
    // Apply optimizations
    $mail->isSMTP();
    $mail->Host = SMTP_HOST;
    $mail->SMTPAuth = true;
    $mail->Username = SMTP_USERNAME;
    $mail->Password = SMTP_PASSWORD;
    $mail->SMTPSecure = SMTP_ENCRYPTION;
    $mail->Port = SMTP_PORT;
    
    // Optimizations that might be causing issues
    $mail->SMTPKeepAlive = true;
    $mail->Timeout = 10;
    $mail->SMTPOptions = array(
        'ssl' => array(
            'verify_peer' => false,
            'verify_peer_name' => false,
            'allow_self_signed' => true
        )
    );
    
    $mail->setFrom(FROM_EMAIL, FROM_NAME);
    $mail->addAddress($test_email, 'Test User');
    $mail->isHTML(true);
    $mail->Subject = 'Debug Test - Optimized Settings';
    $mail->Priority = 1;
    $mail->Body = '<h1>Debug Test</h1><p>Testing optimized email settings.</p>';
    
    echo "<p>Attempting to send with optimizations...</p>";
    $mail->send();
    echo "<p>✅ Optimized email sent successfully!</p>";
    
} catch (Exception $e) {
    echo "<p>❌ Optimized email failed: " . $e->getMessage() . "</p>";
    echo "<p><strong>Error Info:</strong> " . $mail->ErrorInfo . "</p>";
    
    // Try without optimizations
    echo "<h3>Step 3: Testing Without Optimizations</h3>";
    
    try {
        $mail2 = new PHPMailer(true);
        $mail2->isSMTP();
        $mail2->Host = SMTP_HOST;
        $mail2->SMTPAuth = true;
        $mail2->Username = SMTP_USERNAME;
        $mail2->Password = SMTP_PASSWORD;
        $mail2->SMTPSecure = SMTP_ENCRYPTION;
        $mail2->Port = SMTP_PORT;
        
        // NO optimizations - basic settings only
        
        $mail2->setFrom(FROM_EMAIL, FROM_NAME);
        $mail2->addAddress($test_email, 'Test User');
        $mail2->isHTML(true);
        $mail2->Subject = 'Debug Test - Basic Settings';
        $mail2->Body = '<h1>Debug Test</h1><p>Testing basic email settings.</p>';
        
        echo "<p>Attempting to send with basic settings...</p>";
        $mail2->send();
        echo "<p>✅ Basic email sent successfully!</p>";
        echo "<p><strong>Issue:</strong> Optimizations are causing the problem</p>";
        
    } catch (Exception $e2) {
        echo "<p>❌ Basic email also failed: " . $e2->getMessage() . "</p>";
        echo "<p><strong>Issue:</strong> Fundamental SMTP problem</p>";
    }
}

// Clear rate limiting
echo "<h3>Step 4: Clear Rate Limiting</h3>";
$ip_address = $_SERVER['REMOTE_ADDR'];
$conn->query("DELETE FROM password_reset_attempts WHERE ip_address = '$ip_address'");
echo "<p>✅ Rate limiting cleared</p>";

echo "<p><a href='index.php?page=forgot_password'>🔗 Test Forgot Password Again</a></p>";
?>
