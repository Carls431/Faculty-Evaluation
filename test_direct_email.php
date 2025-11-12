<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once 'vendor/autoload.php';
require_once 'email_config_forgot.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

echo "<h2>Direct Password Reset Email Test</h2>";

function send_password_reset_email($email, $name) {
    $mail = new PHPMailer(true);
    
    try {
        // Enable debug output
        $mail->SMTPDebug = 1;
        $mail->Debugoutput = function($str, $level) {
            echo "SMTP Debug: $str<br>";
        };
        
        // Server settings
        $mail->isSMTP();
        $mail->Host = SMTP_HOST;
        $mail->SMTPAuth = true;
        $mail->Username = SMTP_USERNAME;
        $mail->Password = SMTP_PASSWORD;
        $mail->SMTPSecure = SMTP_ENCRYPTION;
        $mail->Port = SMTP_PORT;
        $mail->Timeout = 30;
        
        // Recipients
        $mail->setFrom(FROM_EMAIL, FROM_NAME);
        $mail->addAddress($email, $name);
        
        // Generate test token
        $token = bin2hex(random_bytes(32));
        $reset_link = "http://localhost/eval/index.php?page=reset_password&token=" . $token;
        
        // Content
        $mail->isHTML(true);
        $mail->Subject = 'Password Reset - MOIST Faculty System';
        $mail->Body = "
        <div style='font-family: Arial, sans-serif; max-width: 600px; margin: 0 auto;'>
            <div style='background: linear-gradient(135deg, #800000, #a00000); padding: 20px; text-align: center;'>
                <h1 style='color: white; margin: 0;'>Faculty Evaluation System</h1>
                <p style='color: rgba(255,255,255,0.9); margin: 5px 0 0 0;'>Password Reset Request</p>
            </div>
            
            <div style='padding: 30px; background: #f9f9f9;'>
                <h2 style='color: #800000;'>Hello {$name},</h2>
                
                <p>We received a request to reset your password for your Faculty Evaluation System account.</p>
                
                <p>Click the button below to reset your password:</p>
                
                <div style='text-align: center; margin: 30px 0;'>
                    <a href='{$reset_link}' style='background: linear-gradient(135deg, #800000, #a00000); color: white; padding: 15px 30px; text-decoration: none; border-radius: 5px; display: inline-block; font-weight: bold;'>Reset Password</a>
                </div>
                
                <p style='color: #666; font-size: 14px;'>If the button doesn't work, copy and paste this link into your browser:</p>
                <p style='color: #666; font-size: 12px; word-break: break-all;'>{$reset_link}</p>
                
                <p style='color: #666; font-size: 14px; margin-top: 30px;'>
                    <strong>Important:</strong> This link will expire in 1 hour for security reasons.
                </p>
                
                <p style='color: #666; font-size: 14px;'>
                    If you didn't request this password reset, please ignore this email. Your password will remain unchanged.
                </p>
            </div>
            
            <div style='background: #800000; padding: 15px; text-align: center;'>
                <p style='color: white; margin: 0; font-size: 12px;'>© " . date('Y') . " Faculty Evaluation System. All rights reserved.</p>
            </div>
        </div>";
        
        $mail->send();
        echo "<div style='background: #d4edda; padding: 15px; border: 1px solid #c3e6cb; border-radius: 5px; margin: 20px 0;'>";
        echo "<h3>✅ Email Sent Successfully!</h3>";
        echo "<p>Password reset email has been sent to: <strong>$email</strong></p>";
        echo "<p>Check your Gmail inbox and spam folder.</p>";
        echo "<p><strong>Test Reset Link:</strong> <a href='$reset_link' target='_blank'>$reset_link</a></p>";
        echo "</div>";
        return true;
        
    } catch (Exception $e) {
        echo "<div style='background: #f8d7da; padding: 15px; border: 1px solid #f5c6cb; border-radius: 5px; margin: 20px 0;'>";
        echo "<h3>❌ Email Failed!</h3>";
        echo "<p><strong>Error:</strong> " . $mail->ErrorInfo . "</p>";
        echo "<p><strong>Exception:</strong> " . $e->getMessage() . "</p>";
        echo "</div>";
        return false;
    }
}

// Test with your email
$test_email = "evalfaculty@gmail.com";
$test_name = "Carls Pamorel";

echo "<h3>Sending password reset email to: $test_email</h3>";
send_password_reset_email($test_email, $test_name);

echo "<div style='background: #fff3cd; padding: 15px; border: 1px solid #ffeaa7; border-radius: 5px; margin: 20px 0;'>";
echo "<h4>📧 Check Your Email</h4>";
echo "<p>If the email was sent successfully, check these locations in Gmail:</p>";
echo "<ul>";
echo "<li><strong>Primary Inbox</strong></li>";
echo "<li><strong>Spam/Junk folder</strong></li>";
echo "<li><strong>Promotions tab</strong></li>";
echo "<li><strong>All Mail</strong></li>";
echo "</ul>";
echo "<p>Gmail may take 1-2 minutes to deliver the email.</p>";
echo "</div>";
?>
