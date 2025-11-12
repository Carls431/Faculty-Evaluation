<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once 'vendor/autoload.php';
require_once 'email_config_forgot.php';
require_once 'db_connect.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Handle incoming requests
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';
    
    if ($action === 'send_otp') {
        echo send_otp();
        exit;
    } elseif ($action === 'verify_otp') {
        echo verify_otp();
        exit;
    } elseif ($action === 'reset_password') {
        echo reset_password();
        exit;
    }
}

function send_otp() {
    global $conn;
    
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    
    // Validate email format
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return 2; // Invalid email format
    }
    
    // Rate limiting - check attempts in last hour
    $ip_address = $_SERVER['REMOTE_ADDR'] ?? '127.0.0.1';
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
        
        // Generate 6-digit OTP
        $otp_code = sprintf('%06d', mt_rand(100000, 999999));
        $expires = date('Y-m-d H:i:s', strtotime('+15 minutes')); // OTP expires in 15 minutes
        
        // Store OTP in database
        $stmt = $conn->prepare("UPDATE users SET reset_token = ?, reset_expires = ? WHERE email = ?");
        $stmt->bind_param("sss", $otp_code, $expires, $email);
        $stmt->execute();
        
        // Send OTP email
        if(send_otp_email($email, $otp_code, $user['firstname'] . ' ' . $user['lastname'])) {
            return 1; // Success
        } else {
            return 3; // Email sending failed
        }
    } else {
        return 2; // Email not found
    }
}

function send_otp_email($email, $otp_code, $name) {
    $mail = new PHPMailer(true);
    
    try {
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
        
        // Content
        $mail->isHTML(true);
        $mail->Subject = 'Password Reset OTP - MOIST Faculty System';
        $mail->Priority = 1; // High priority for OTP
        
        $mail->Body = "
        <div style='font-family: Arial, sans-serif; max-width: 600px; margin: 0 auto;'>
            <div style='background: linear-gradient(135deg, #800000, #a00000); padding: 20px; text-align: center;'>
                <h1 style='color: white; margin: 0;'>Faculty Evaluation System</h1>
                <p style='color: rgba(255,255,255,0.9); margin: 5px 0 0 0;'>Password Reset OTP</p>
            </div>
            
            <div style='padding: 30px; background: #f9f9f9; text-align: center;'>
                <h2 style='color: #800000;'>Hello {$name},</h2>
                
                <p>Your password reset OTP code is:</p>
                
                <div style='background: #fff; border: 2px solid #800000; border-radius: 10px; padding: 20px; margin: 20px 0; display: inline-block;'>
                    <h1 style='color: #800000; font-size: 36px; margin: 0; letter-spacing: 8px; font-family: monospace;'>{$otp_code}</h1>
                </div>
                
                <p style='color: #666; font-size: 14px; margin-top: 20px;'>
                    <strong>Important:</strong> This OTP will expire in 15 minutes for security reasons.
                </p>
                
                <p style='color: #666; font-size: 14px;'>
                    If you didn't request this password reset, please ignore this email.
                </p>
            </div>
            
            <div style='background: #800000; padding: 15px; text-align: center;'>
                <p style='color: white; margin: 0; font-size: 12px;'>© " . date('Y') . " Faculty Evaluation System. All rights reserved.</p>
            </div>
        </div>";
        
        $mail->send();
        return true;
        
    } catch (Exception $e) {
        error_log("OTP Email sending failed: " . $mail->ErrorInfo);
        return false;
    }
}

function verify_otp() {
    global $conn;
    
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $otp_code = mysqli_real_escape_string($conn, $_POST['otp_code']);
    
    // Verify OTP
    $current_time = date('Y-m-d H:i:s');
    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ? AND reset_token = ? AND reset_expires > ?");
    $stmt->bind_param("sss", $email, $otp_code, $current_time);
    $stmt->execute();
    $query = $stmt->get_result();
    
    if($query->num_rows > 0) {
        // OTP is valid, mark as verified by setting a special token
        $verify_token = 'VERIFIED_' . bin2hex(random_bytes(16));
        $stmt = $conn->prepare("UPDATE users SET reset_token = ? WHERE email = ?");
        $stmt->bind_param("ss", $verify_token, $email);
        $stmt->execute();
        
        return 1; // Success
    } else {
        return 2; // Invalid or expired OTP
    }
}

function reset_password() {
    global $conn;
    
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $new_password = $_POST['new_password'];
    
    // Validate password strength
    if (strlen($new_password) < 8) {
        return 3; // Password too short
    }
    
    if (!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)/', $new_password)) {
        return 4; // Password doesn't meet complexity requirements
    }
    
    // Check if user has verified OTP (token starts with VERIFIED_)
    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ? AND reset_token LIKE 'VERIFIED_%'");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $query = $stmt->get_result();
    
    if($query->num_rows > 0) {
        $user = $query->fetch_assoc();
        $user_id = (int)$user['id'];
        $current_hash = $user['password'];

        // Ensure password_history table exists
        $conn->query("CREATE TABLE IF NOT EXISTS password_history (
            id INT AUTO_INCREMENT PRIMARY KEY,
            user_id INT NOT NULL,
            password_hash VARCHAR(255) NOT NULL,
            created_at DATETIME NOT NULL,
            INDEX(user_id),
            INDEX(created_at)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4");

        // Check if new password is same as current password
        if (!empty($current_hash) && password_verify($new_password, $current_hash)) {
            return 5; // New password is same as current password
        }

        // Check against last 5 previously used passwords
        $stmtHist = $conn->prepare("SELECT password_hash FROM password_history WHERE user_id = ? ORDER BY created_at DESC LIMIT 5");
        $stmtHist->bind_param("i", $user_id);
        $stmtHist->execute();
        $histResult = $stmtHist->get_result();
        while ($row = $histResult->fetch_assoc()) {
            if (password_verify($new_password, $row['password_hash'])) {
                return 6; // New password was used previously
            }
        }
        $stmtHist->close();

        // Hash the new password
        $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

        // Begin transaction to keep history and user update consistent
        $conn->begin_transaction();
        try {
            // Store old password hash in history if present
            if (!empty($current_hash)) {
                $now = date('Y-m-d H:i:s');
                $stmtIns = $conn->prepare("INSERT INTO password_history (user_id, password_hash, created_at) VALUES (?, ?, ?)");
                $stmtIns->bind_param("iss", $user_id, $current_hash, $now);
                $stmtIns->execute();
                $stmtIns->close();

                // Keep only last 5 history records
                $conn->query("DELETE ph FROM password_history ph
                              JOIN (
                                  SELECT id FROM password_history WHERE user_id = {$user_id} ORDER BY created_at DESC LIMIT 18446744073709551615 OFFSET 5
                              ) old_ph ON ph.id = old_ph.id");
            }

            // Update password and clear tokens
            $stmtUpd = $conn->prepare("UPDATE users SET password = ?, reset_token = NULL, reset_expires = NULL WHERE email = ?");
            $stmtUpd->bind_param("ss", $hashed_password, $email);
            $stmtUpd->execute();
            $stmtUpd->close();

            $conn->commit();
        } catch (Exception $e) {
            $conn->rollback();
            return 7; // Unknown error during update
        }

        return 1; // Success
    } else {
        return 2; // Invalid session or OTP not verified
    }
}
?>
