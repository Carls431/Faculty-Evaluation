<?php
require_once 'vendor/autoload.php';
require_once 'email_config.php';
require_once 'db_connect.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

/**
 * Generate a random OTP
 */
function generateOTP($length = OTP_LENGTH) {
    return sprintf("%0{$length}d", mt_rand(1, pow(10, $length) - 1));
}

/**
 * Send OTP via email
 */
function sendOTPEmail($email, $otp, $studentName = '', $context = 'login') {
    $mail = new PHPMailer(true);
    
    try {
        // Server settings
        $mail->isSMTP();
        $mail->Host       = SMTP_HOST;
        $mail->SMTPAuth   = true;
        $mail->Username   = SMTP_USERNAME;
        $mail->Password   = SMTP_PASSWORD;
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = SMTP_PORT;

        // Recipients
        $mail->setFrom(SMTP_FROM_EMAIL, SMTP_FROM_NAME);
        $mail->addAddress($email);

        // Content
        $mail->isHTML(true);
        
        $greeting = !empty($studentName) ? "Dear {$studentName}," : "Dear Student,";
        
        if ($context === 'registration') {
            $mail->Subject = 'Student Registration OTP - ' . $_SESSION['system']['name'];
            $title = 'Student Registration Verification';
            $purpose = 'complete your student registration';
            $altText = "Your OTP for student registration is: {$otp}. Valid for " . OTP_EXPIRY_MINUTES . " minutes.";
        } else {
            $mail->Subject = 'Student Login OTP - ' . $_SESSION['system']['name'];
            $title = 'Student Login Verification';
            $purpose = 'student login';
            $altText = "Your OTP for student login is: {$otp}. Valid for " . OTP_EXPIRY_MINUTES . " minutes.";
        }
        
        $mail->Body = "
        <div style='font-family: Arial, sans-serif; max-width: 600px; margin: 0 auto;'>
            <h2 style='color: #800000;'>{$title}</h2>
            <p>{$greeting}</p>
            <p>Your One-Time Password (OTP) to {$purpose} is:</p>
            <div style='background-color: #f8f9fa; padding: 20px; text-align: center; margin: 20px 0; border-radius: 8px;'>
                <h1 style='color: #800000; font-size: 32px; margin: 0; letter-spacing: 5px;'>{$otp}</h1>
            </div>
            <p><strong>Important:</strong></p>
            <ul>
                <li>This OTP is valid for " . OTP_EXPIRY_MINUTES . " minutes only</li>
                <li>Do not share this OTP with anyone</li>
                <li>If you didn't request this, please ignore this email</li>
            </ul>
            <p>Best regards,<br>" . $_SESSION['system']['name'] . "</p>
        </div>";

        $mail->AltBody = $altText;

        $mail->send();
        return true;
    } catch (Exception $e) {
        error_log("OTP Email Error: " . $mail->ErrorInfo);
        return false;
    }
}

/**
 * Store OTP in database
 */
function storeOTP($studentId, $otp) {
    include 'db_connect.php';
    
    $expiryTime = date('Y-m-d H:i:s', strtotime('+' . OTP_EXPIRY_MINUTES . ' minutes'));
    
    $stmt = $conn->prepare("UPDATE student_list SET otp = ?, otp_expires = ? WHERE id = ?");
    $stmt->bind_param("ssi", $otp, $expiryTime, $studentId);
    
    return $stmt->execute();
}

/**
 * Verify OTP
 */
function verifyOTP($studentId, $inputOTP) {
    include 'db_connect.php';
    
    $stmt = $conn->prepare("SELECT otp, otp_expires FROM student_list WHERE id = ?");
    $stmt->bind_param("i", $studentId);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows === 0) {
        return ['success' => false, 'message' => 'Student not found'];
    }
    
    $row = $result->fetch_assoc();
    
    // Check if OTP exists
    if (empty($row['otp'])) {
        return ['success' => false, 'message' => 'No OTP found. Please request a new one.'];
    }
    
    // Check if OTP has expired
    if (strtotime($row['otp_expires']) < time()) {
        // Clear expired OTP
        clearOTP($studentId);
        return ['success' => false, 'message' => 'OTP has expired. Please request a new one.'];
    }
    
    // Check if OTP matches
    if ($row['otp'] !== $inputOTP) {
        return ['success' => false, 'message' => 'Invalid OTP. Please try again.'];
    }
    
    // OTP is valid, clear it from database
    clearOTP($studentId);
    return ['success' => true, 'message' => 'OTP verified successfully'];
}

/**
 * Clear OTP from database
 */
function clearOTP($studentId) {
    include 'db_connect.php';
    
    $stmt = $conn->prepare("UPDATE student_list SET otp = NULL, otp_expires = NULL WHERE id = ?");
    $stmt->bind_param("i", $studentId);
    
    return $stmt->execute();
}

/**
 * Check if student exists and get details
 */
function getStudentByCredentials($studentId, $email) {
    include 'db_connect.php';
    
    $stmt = $conn->prepare("SELECT id, student_id, firstname, lastname, email, class_id FROM student_list WHERE student_id = ? AND email = ?");
    $stmt->bind_param("ss", $studentId, $email);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        return $result->fetch_assoc();
    }
    
    return false;
}
?>