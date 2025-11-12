<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once 'vendor/autoload.php';
require_once 'email_config_forgot.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Add missing constants
if (!defined('MAX_RESET_ATTEMPTS_PER_HOUR')) {
    define('MAX_RESET_ATTEMPTS_PER_HOUR', 5);
}
if (!defined('RESET_TOKEN_EXPIRY_HOURS')) {
    define('RESET_TOKEN_EXPIRY_HOURS', 1);
}

echo "<h2>Testing Email Configuration for Password Reset</h2>";

// Test 1: Check if PHPMailer is loaded
echo "<h3>1. PHPMailer Status</h3>";
if (class_exists('PHPMailer\PHPMailer\PHPMailer')) {
    echo "✅ PHPMailer is loaded successfully<br>";
} else {
    echo "❌ PHPMailer is not loaded<br>";
}

// Test 2: Check email configuration
echo "<h3>2. Email Configuration</h3>";
echo "SMTP Host: " . SMTP_HOST . "<br>";
echo "SMTP Port: " . SMTP_PORT . "<br>";
echo "SMTP Username: " . SMTP_USERNAME . "<br>";
echo "SMTP Password: " . (SMTP_PASSWORD ? "Set (hidden)" : "Not set") . "<br>";
echo "From Email: " . FROM_EMAIL . "<br>";

// Test 3: Test email sending
echo "<h3>3. Testing Email Send</h3>";

function test_send_email($test_email) {
    $mail = new PHPMailer(true);
    
    try {
        // Enable verbose debug output
        $mail->SMTPDebug = 2;
        $mail->Debugoutput = function($str, $level) {
            echo "Debug level $level; message: $str<br>";
        };
        
        // Server settings
        $mail->isSMTP();
        $mail->Host       = SMTP_HOST;
        $mail->SMTPAuth   = true;
        $mail->Username   = SMTP_USERNAME;
        $mail->Password   = SMTP_PASSWORD;
        $mail->SMTPSecure = SMTP_ENCRYPTION;
        $mail->Port       = SMTP_PORT;
        
        // Timeout settings
        $mail->Timeout = 30;
        
        // Recipients
        $mail->setFrom(FROM_EMAIL, FROM_NAME);
        $mail->addAddress($test_email, 'Test User');
        
        // Content
        $mail->isHTML(true);
        $mail->Subject = 'Test Email - Password Reset System';
        $mail->Body = '<h1>Test Email</h1><p>This is a test email to verify the password reset system is working.</p>';
        
        $mail->send();
        echo "✅ Test email sent successfully!<br>";
        return true;
        
    } catch (Exception $e) {
        echo "❌ Email sending failed: " . $mail->ErrorInfo . "<br>";
        echo "Exception: " . $e->getMessage() . "<br>";
        return false;
    }
}

// Test with a sample email (replace with your actual email)
$test_email = "evalfaculty@gmail.com"; // Change this to your email for testing
echo "Sending test email to: $test_email<br><br>";

if (test_send_email($test_email)) {
    echo "<br><strong>✅ Email system is working!</strong><br>";
} else {
    echo "<br><strong>❌ Email system has issues that need to be fixed.</strong><br>";
}

echo "<h3>4. Common Issues and Solutions</h3>";
echo "<ul>";
echo "<li><strong>Gmail App Password:</strong> Make sure you're using an App Password, not your regular Gmail password</li>";
echo "<li><strong>2-Factor Authentication:</strong> Gmail requires 2FA to be enabled for App Passwords</li>";
echo "<li><strong>Less Secure Apps:</strong> This setting is deprecated, use App Passwords instead</li>";
echo "<li><strong>Firewall/Antivirus:</strong> Check if your firewall is blocking SMTP connections</li>";
echo "<li><strong>XAMPP:</strong> Make sure Apache is running and PHP has the required extensions</li>";
echo "</ul>";

echo "<h3>5. Next Steps</h3>";
echo "<ol>";
echo "<li>If the test email works, check your spam/junk folder</li>";
echo "<li>If it doesn't work, check the debug output above for specific errors</li>";
echo "<li>Verify your Gmail App Password is correct</li>";
echo "<li>Try using a different email provider if Gmail continues to fail</li>";
echo "</ol>";
?>
