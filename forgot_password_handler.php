<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once 'vendor/autoload.php';
require_once 'email_config_forgot.php';
require_once 'db_connect.php';

// Handle incoming requests
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';
    
    if ($action === 'request_reset') {
        $result = request_password_reset();
        echo $result;
        exit;
    }
}

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

function request_password_reset() {
    global $conn;
    
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    
    // Validate email format
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return 2; // Invalid email format
    }
    
    // Rate limiting - check attempts in last hour
    $ip_address = $_SERVER['REMOTE_ADDR'] ?? '127.0.0.1'; // Default to localhost if not set
    $one_hour_ago = date('Y-m-d H:i:s', strtotime('-1 hour'));
    
    // Create rate limiting table if not exists
    $conn->query("CREATE TABLE IF NOT EXISTS password_reset_attempts (
        id INT AUTO_INCREMENT PRIMARY KEY,
        ip_address VARCHAR(45) NOT NULL,
        email VARCHAR(255) NOT NULL,
        attempt_time DATETIME NOT NULL,
        INDEX(ip_address, attempt_time)
    )");
    
    // Check attempts for this IP in last hour
    $stmt = $conn->prepare("SELECT COUNT(*) as attempts FROM password_reset_attempts WHERE ip_address = ? AND attempt_time > ?");
    $stmt->bind_param("ss", $ip_address, $one_hour_ago);
    $stmt->execute();
    $result = $stmt->get_result()->fetch_assoc();
    
    if ($result['attempts'] >= MAX_RESET_ATTEMPTS_PER_HOUR) {
        return 4; // Too many attempts
    }
    
    // Log this attempt
    $current_time = date('Y-m-d H:i:s');
    $stmt = $conn->prepare("INSERT INTO password_reset_attempts (ip_address, email, attempt_time) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $ip_address, $email, $current_time);
    $stmt->execute();
    
    // Check if email exists in users table (admin)
    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $user_query = $stmt->get_result();
    
    if($user_query->num_rows > 0) {
        $user = $user_query->fetch_assoc();
        
        // Generate reset token
        $token = bin2hex(random_bytes(32));
        $expires = date('Y-m-d H:i:s', strtotime('+' . RESET_TOKEN_EXPIRY_HOURS . ' hour'));
        
        // Store token in database
        $stmt = $conn->prepare("UPDATE users SET reset_token = ?, reset_expires = ? WHERE email = ?");
        $stmt->bind_param("sss", $token, $expires, $email);
        $stmt->execute();
        
        // Send email
        if(send_reset_email($email, $token, $user['firstname'] . ' ' . $user['lastname'])) {
            return 1; // Success
        } else {
            return 3; // Email sending failed
        }
    } else {
        return 2; // Email not found
    }
}

function send_reset_email($email, $token, $name) {
    $mail = new PHPMailer(true);
    
    try {
        // Server settings - optimized for speed
        $mail->isSMTP();
        $mail->Host       = SMTP_HOST;
        $mail->SMTPAuth   = true;
        $mail->Username   = SMTP_USERNAME;
        $mail->Password   = SMTP_PASSWORD;
        $mail->SMTPSecure = SMTP_ENCRYPTION;
        $mail->Port       = SMTP_PORT;
        
        // Basic reliable settings
        $mail->Timeout = 30;          // Reasonable timeout
        
        // Recipients
        $mail->setFrom(FROM_EMAIL, FROM_NAME);
        $mail->addAddress($email, $name);
        
        // Content - optimized
        $mail->isHTML(true);
        $mail->Subject = 'Password Reset - MOIST Faculty System';
        $mail->Priority = 3; // Normal priority to avoid spam filters
        
        $reset_link = "http://localhost/eval/index.php?page=reset_password&token=" . $token;
        
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
        return true;
        
    } catch (Exception $e) {
        error_log("Email sending failed: " . $mail->ErrorInfo);
        return false;
    }
}

function reset_password() {
    global $conn;
    
    $token = mysqli_real_escape_string($conn, $_POST['token']);
    $new_password = $_POST['password'];
    
    // Validate password strength
    if (strlen($new_password) < 8) {
        return 3; // Password too short
    }
    
    if (!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)/', $new_password)) {
        return 4; // Password doesn't meet complexity requirements
    }
    
    // Verify token - use PHP time instead of MySQL NOW() to avoid timezone issues
    $current_time = date('Y-m-d H:i:s');
    $stmt = $conn->prepare("SELECT * FROM users WHERE reset_token = ? AND reset_expires > ?");
    $stmt->bind_param("ss", $token, $current_time);
    $stmt->execute();
    $query = $stmt->get_result();
    
    if($query->num_rows > 0) {
        // Use secure password hashing
        $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
        
        // Update password and clear token
        $stmt = $conn->prepare("UPDATE users SET password = ?, reset_token = NULL, reset_expires = NULL WHERE reset_token = ?");
        $stmt->bind_param("ss", $hashed_password, $token);
        $stmt->execute();
        
        return 1; // Success
    } else {
        return 2; // Invalid or expired token
    }
}
?>