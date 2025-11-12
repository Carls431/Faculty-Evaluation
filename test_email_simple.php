<?php
// Simple email test for forgot password debugging
require_once 'vendor/autoload.php';
require_once 'email_config_secure.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

echo "<h2>📧 Email Delivery Test</h2>";

// Test with a different email address
// Try with different email providers for testing
$test_emails = [
    "evalfaculty@gmail.com"
    // Uncomment and add your other emails:
    // "your_yahoo@yahoo.com",
    // "your_outlook@outlook.com"
];

echo "<h3>📧 Testing Multiple Email Addresses</h3>";
foreach($test_emails as $test_email) {

$mail = new PHPMailer(true);

try {
    // Enable verbose debug output
    $mail->SMTPDebug = SMTP::DEBUG_SERVER;
    $mail->Debugoutput = function($str, $level) {
        echo "Debug level $level; message: $str<br>";
    };

    // Server settings
    $mail->isSMTP();
    $mail->Host       = SMTP_HOST;
    $mail->SMTPAuth   = true;
    $mail->Username   = SMTP_USERNAME;
    $mail->Password   = SMTP_PASSWORD;
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port       = SMTP_PORT;
    $mail->Timeout    = 60;

    // Recipients
    $mail->setFrom(FROM_EMAIL, FROM_NAME);
    $mail->addAddress($test_email, 'Test User');

    // Content
    $mail->isHTML(true);
    $mail->Subject = 'Test Email - Faculty Evaluation System';
    $mail->Body    = '
    <div style="font-family: Arial, sans-serif; max-width: 600px; margin: 0 auto;">
        <h2 style="color: #800000;">Email Test Successful!</h2>
        <p>This is a test email to verify SMTP configuration.</p>
        <p><strong>Time sent:</strong> ' . date('Y-m-d H:i:s') . '</p>
        <p>If you receive this email, the SMTP configuration is working correctly.</p>
    </div>';

    $mail->send();
    echo '<div style="background: #d4edda; color: #155724; padding: 15px; border: 1px solid #c3e6cb; border-radius: 5px; margin: 20px 0;">';
    echo '<h3>✅ Email Sent Successfully!</h3>';
    echo '<p>Test email sent to: ' . $test_email . '</p>';
    echo '<p>Check your inbox (and spam folder) in 1-2 minutes.</p>';
    echo '</div>';
    
} catch (Exception $e) {
    echo '<div style="background: #f8d7da; color: #721c24; padding: 15px; border: 1px solid #f5c6cb; border-radius: 5px; margin: 20px 0;">';
    echo '<h3>❌ Email Failed to Send</h3>';
    echo '<p><strong>Error:</strong> ' . $mail->ErrorInfo . '</p>';
    echo '</div>';
}

echo "<h3>🔧 Troubleshooting Tips</h3>";
echo "<div style='background: #fff3cd; padding: 15px; border-left: 4px solid #ffc107;'>";
echo "<ul>";
echo "<li><strong>Gmail App Password:</strong> Make sure you're using an App Password, not your regular Gmail password</li>";
echo "<li><strong>2-Factor Authentication:</strong> Must be enabled on Gmail account to generate App Passwords</li>";
echo "<li><strong>Less Secure Apps:</strong> Should be disabled (use App Password instead)</li>";
echo "<li><strong>Spam Folder:</strong> Check spam/junk folder - Gmail may filter automated emails</li>";
echo "<li><strong>Alternative Email:</strong> Try testing with a different email provider (Yahoo, Outlook, etc.)</li>";
echo "</ul>";
echo "</div>";

echo "<h3>📋 Current SMTP Settings</h3>";
echo "<table border='1' style='border-collapse: collapse; margin: 10px 0;'>";
echo "<tr><th>Setting</th><th>Value</th></tr>";
echo "<tr><td>SMTP Host</td><td>" . SMTP_HOST . "</td></tr>";
echo "<tr><td>SMTP Port</td><td>" . SMTP_PORT . "</td></tr>";
echo "<tr><td>Username</td><td>" . SMTP_USERNAME . "</td></tr>";
echo "<tr><td>Encryption</td><td>" . SMTP_ENCRYPTION . "</td></tr>";
echo "<tr><td>From Email</td><td>" . FROM_EMAIL . "</td></tr>";
echo "</table>";
?>
