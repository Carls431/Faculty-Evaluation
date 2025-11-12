<?php
echo "<h2>Detailed Email Test</h2>";

require_once 'vendor/autoload.php';
require_once 'email_config_forgot.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

if(isset($_POST['test_email'])) {
    $mail = new PHPMailer(true);
    
    try {
        // Enable verbose debug output
        $mail->SMTPDebug = SMTP::DEBUG_SERVER;
        $mail->Debugoutput = 'html';
        
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
        $mail->Body    = '<h1>Test Email</h1><p>If you receive this, your email configuration is working!</p>';
        
        $mail->send();
        echo '<div style="background: green; color: white; padding: 10px; margin: 10px 0;">✅ Email sent successfully!</div>';
        
    } catch (Exception $e) {
        echo '<div style="background: red; color: white; padding: 10px; margin: 10px 0;">❌ Email failed: ' . $mail->ErrorInfo . '</div>';
    }
}
?>

<form method="POST">
    <h3>Test Email Configuration</h3>
    <p><strong>SMTP Host:</strong> <?php echo SMTP_HOST; ?></p>
    <p><strong>SMTP Port:</strong> <?php echo SMTP_PORT; ?></p>
    <p><strong>SMTP Username:</strong> <?php echo SMTP_USERNAME; ?></p>
    <p><strong>SMTP Password:</strong> <?php echo substr(SMTP_PASSWORD, 0, 4) . '****'; ?></p>
    <p><strong>Encryption:</strong> <?php echo SMTP_ENCRYPTION; ?></p>
    
    <button type="submit" name="test_email" style="background: #800000; color: white; padding: 10px 20px; border: none; border-radius: 5px;">
        Test Email Sending
    </button>
</form>

<h3>Gmail App Password Setup Check:</h3>
<ol>
    <li>Go to <a href="https://myaccount.google.com/security" target="_blank">Google Account Security</a></li>
    <li>Make sure 2-Step Verification is ON</li>
    <li>Go to App Passwords</li>
    <li>Generate a new password for "Faculty Evaluation System"</li>
    <li>Use that 16-character password (not your regular Gmail password)</li>
</ol>