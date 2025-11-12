<?php
// Direct email sending test
require_once 'vendor/autoload.php';
require_once 'email_config_secure.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

echo "<h2>📧 Direct Email Sending Test</h2>";

$mail = new PHPMailer(true);

try {
    // Enable verbose debug output
    $mail->SMTPDebug = SMTP::DEBUG_SERVER;
    $mail->Debugoutput = function($str, $level) {
        echo "<p style='margin: 2px 0; font-family: monospace; font-size: 12px;'>$str</p>";
    };
    
    // Server settings
    $mail->isSMTP();
    $mail->Host       = SMTP_HOST;
    $mail->SMTPAuth   = true;
    $mail->Username   = SMTP_USERNAME;
    $mail->Password   = SMTP_PASSWORD;
    $mail->SMTPSecure = SMTP_ENCRYPTION;
    $mail->Port       = SMTP_PORT;
    
    // Recipients
    $mail->setFrom(FROM_EMAIL, FROM_NAME);
    $mail->addAddress('evalfaculty@gmail.com', 'Test User');
    
    // Content
    $mail->isHTML(true);
    $mail->Subject = 'Test Email - Faculty Evaluation System';
    $mail->Body    = '<h1>Test Email</h1><p>This is a test email to verify SMTP configuration.</p>';
    
    echo "<h3>Attempting to send email...</h3>";
    $mail->send();
    echo "<h3 style='color: green;'>✅ Email sent successfully!</h3>";
    
} catch (Exception $e) {
    echo "<h3 style='color: red;'>❌ Email sending failed</h3>";
    echo "<p><strong>Error:</strong> {$mail->ErrorInfo}</p>";
    echo "<p><strong>Exception:</strong> " . $e->getMessage() . "</p>";
}

echo "<p><a href='debug_forgot_password.php'>← Back to Debug</a></p>";
?>
