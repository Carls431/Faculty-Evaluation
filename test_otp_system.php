<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once 'vendor/autoload.php';
require_once 'email_config_forgot.php';
require_once 'db_connect.php';

echo "<h2>🧪 Testing New OTP Password Reset System</h2>";

$test_email = "evalfaculty@gmail.com";

echo "<h3>Step 1: Testing OTP Generation and Email</h3>";

// Simulate sending OTP
$_POST['email'] = $test_email;
$_POST['action'] = 'send_otp';
$_SERVER['REQUEST_METHOD'] = 'POST';
$_SERVER['REMOTE_ADDR'] = '127.0.0.1';

// Clear rate limiting
$conn->query("DELETE FROM password_reset_attempts WHERE ip_address = '127.0.0.1'");

ob_start();
include 'forgot_password_otp.php';
$otp_result = ob_get_clean();

echo "<p><strong>Send OTP Result:</strong> $otp_result</p>";

if ($otp_result == '1') {
    echo "<p>✅ OTP sent successfully!</p>";
    
    // Get the OTP from database
    $stmt = $conn->prepare("SELECT reset_token, reset_expires FROM users WHERE email = ?");
    $stmt->bind_param("s", $test_email);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        $otp_code = $user['reset_token'];
        echo "<p><strong>Generated OTP:</strong> <span style='font-size: 24px; color: #800000; font-weight: bold;'>$otp_code</span></p>";
        echo "<p><strong>Expires:</strong> " . $user['reset_expires'] . "</p>";
        
        echo "<h3>Step 2: Testing OTP Verification</h3>";
        
        // Test OTP verification
        $_POST['email'] = $test_email;
        $_POST['otp_code'] = $otp_code;
        $_POST['action'] = 'verify_otp';
        
        ob_start();
        include 'forgot_password_otp.php';
        $verify_result = ob_get_clean();
        
        echo "<p><strong>Verify OTP Result:</strong> $verify_result</p>";
        
        if ($verify_result == '1') {
            echo "<p>✅ OTP verification successful!</p>";
            
            echo "<h3>Step 3: Testing Password Reset</h3>";
            
            // Test password reset
            $_POST['email'] = $test_email;
            $_POST['new_password'] = 'NewPassword123';
            $_POST['action'] = 'reset_password';
            
            ob_start();
            include 'forgot_password_otp.php';
            $reset_result = ob_get_clean();
            
            echo "<p><strong>Reset Password Result:</strong> $reset_result</p>";
            
            if ($reset_result == '1') {
                echo "<p>✅ Password reset successful!</p>";
                echo "<div style='background: #d4edda; padding: 15px; border: 1px solid #c3e6cb; border-radius: 5px; margin: 20px 0;'>";
                echo "<h4>🎉 Complete Success!</h4>";
                echo "<p>The new OTP-based password reset system is working perfectly!</p>";
                echo "<ul>";
                echo "<li>✅ OTP email sent successfully</li>";
                echo "<li>✅ OTP verification working</li>";
                echo "<li>✅ Password reset completed</li>";
                echo "</ul>";
                echo "</div>";
            } else {
                echo "<p>❌ Password reset failed</p>";
            }
        } else {
            echo "<p>❌ OTP verification failed</p>";
        }
    } else {
        echo "<p>❌ No OTP found in database</p>";
    }
} else {
    echo "<p>❌ Failed to send OTP</p>";
}

echo "<div style='background: #e7f3ff; padding: 15px; border-left: 4px solid #2196F3; margin: 20px 0;'>";
echo "<h4>🚀 Ready to Test!</h4>";
echo "<p>The new OTP system is ready. Here's how to use it:</p>";
echo "<ol>";
echo "<li><a href='index.php?page=forgot_password' target='_blank'>Go to Forgot Password Page</a></li>";
echo "<li>Enter email: <strong>evalfaculty@gmail.com</strong></li>";
echo "<li>Click 'Send OTP Code'</li>";
echo "<li>Check Gmail for 6-digit OTP</li>";
echo "<li>Enter OTP and verify</li>";
echo "<li>Set new password</li>";
echo "</ol>";
echo "</div>";
?>
