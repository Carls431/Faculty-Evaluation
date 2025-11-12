<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once 'vendor/autoload.php';
require_once 'email_config_forgot.php';
require_once 'db_connect.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Test email function
function testEmail($toEmail) {
    try {
        $mail = new PHPMailer(true);
        
        // Server settings
        $mail->SMTPDebug = SMTP::DEBUG_SERVER; // Enable verbose debug output
        $mail->isSMTP();
        $mail->Host = SMTP_HOST;
        $mail->SMTPAuth = true;
        $mail->Username = SMTP_USERNAME;
        $mail->Password = SMTP_PASSWORD;
        $mail->SMTPSecure = SMTP_ENCRYPTION;
        $mail->Port = SMTP_PORT;

        // Recipients
        $mail->setFrom(FROM_EMAIL, FROM_NAME);
        $mail->addAddress($toEmail);

        // Content
        $mail->isHTML(true);
        $mail->Subject = 'Test Email from Faculty Evaluation System';
        $mail->Body = 'This is a test email to verify the email functionality is working.';

        // Send email
        $mail->send();
        echo "Test email sent successfully to $toEmail<br>";
        echo "Check your inbox (and spam folder) for the test email.";
        
    } catch (Exception $e) {
        echo "Test email failed. Error: {$mail->ErrorInfo}<br>";
        echo "Debug information:<br>";
        echo "SMTP Host: " . SMTP_HOST . "<br>";
        echo "SMTP Port: " . SMTP_PORT . "<br>";
        echo "SMTP Username: " . SMTP_USERNAME . "<br>";
        echo "From Email: " . FROM_EMAIL . "<br>";
    }
}

// If form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['test_email'])) {
    $testEmail = $_POST['test_email'];
    testEmail($testEmail);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Email Test</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        .container { max-width: 600px; margin: 0 auto; }
        .form-group { margin-bottom: 15px; }
        input[type="email"] { width: 100%; padding: 8px; margin-bottom: 10px; }
        button { padding: 10px 15px; background: #007bff; color: white; border: none; cursor: pointer; }
        .instructions { background: #f8f9fa; padding: 15px; margin-bottom: 20px; }
    </style>
</head>
<body>
    <div class="container">
        <h2>Email Configuration Test</h2>
        
        <div class="instructions">
            <h3>Current Email Settings:</h3>
            <p>SMTP Host: <?php echo SMTP_HOST; ?></p>
            <p>SMTP Port: <?php echo SMTP_PORT; ?></p>
            <p>From Email: <?php echo FROM_EMAIL; ?></p>
        </div>

        <form method="POST">
            <div class="form-group">
                <label>Enter your email to test:</label>
                <input type="email" name="test_email" required placeholder="your@email.com">
            </div>
            <button type="submit">Send Test Email</button>
        </form>
    </div>
</body>
</html>
