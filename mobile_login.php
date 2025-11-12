<?php
// Check system access first (CLI authentication required)
require_once 'check_access.php';

session_start();
include('./db_connect.php');
ob_start();
$system = $conn->query("SELECT * FROM system_settings")->fetch_array();
foreach ($system as $k => $v) {
    $_SESSION['system'][$k] = $v;
}
ob_end_flush();

if (isset($_SESSION['login_id'])) {
    header("location:mobile_interface.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <title>Mobile Student Login - <?php echo $_SESSION['system']['name'] ?></title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 10px;
            overflow-x: hidden;
        }
        
        .mobile-container {
            width: 100%;
            max-width: 400px;
            background: rgba(255, 255, 255, 0.95);
            border-radius: 20px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            backdrop-filter: blur(10px);
            overflow: hidden;
            animation: slideUp 0.6s ease-out;
        }
        
        @keyframes slideUp {
            from {
                transform: translateY(50px);
                opacity: 0;
            }
            to {
                transform: translateY(0);
                opacity: 1;
            }
        }
        
        .header-section {
            background: linear-gradient(135deg, #800000, #a52a2a);
            color: white;
            padding: 30px 20px;
            text-align: center;
            position: relative;
        }
        
        .header-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('assets/img/pattern.png') repeat;
            opacity: 0.1;
        }
        
        .logo-mobile {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            border: 3px solid rgba(255, 255, 255, 0.3);
            margin-bottom: 15px;
            animation: pulse 2s infinite;
        }
        
        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.05); }
            100% { transform: scale(1); }
        }
        
        .school-name {
            font-size: 14px;
            font-weight: 600;
            margin-bottom: 5px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        
        .portal-title {
            font-size: 24px;
            font-weight: 700;
            margin-bottom: 5px;
        }
        
        .portal-subtitle {
            font-size: 12px;
            opacity: 0.9;
            font-weight: 300;
        }
        
        .form-section {
            padding: 30px 25px;
        }
        
        .welcome-text {
            text-align: center;
            margin-bottom: 25px;
            color: #333;
        }
        
        .welcome-text h3 {
            font-size: 20px;
            font-weight: 600;
            margin-bottom: 5px;
            color: #800000;
        }
        
        .welcome-text p {
            font-size: 14px;
            color: #666;
        }
        
        .form-group {
            margin-bottom: 20px;
            position: relative;
        }
        
        .form-control {
            border: none;
            border-bottom: 2px solid #e0e0e0;
            border-radius: 0;
            padding: 15px 45px 15px 15px;
            font-size: 16px;
            background: rgba(248, 249, 250, 0.8);
            transition: all 0.3s ease;
        }
        
        .form-control:focus {
            border-bottom-color: #800000;
            box-shadow: none;
            background: #fff;
            transform: translateY(-2px);
        }
        
        .input-icon {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #800000;
            font-size: 18px;
        }
        
        .btn-mobile-login {
            width: 100%;
            padding: 15px;
            background: linear-gradient(135deg, #800000, #a52a2a);
            border: none;
            border-radius: 50px;
            color: white;
            font-size: 16px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }
        
        .btn-mobile-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(128, 0, 0, 0.3);
        }
        
        .btn-mobile-login:active {
            transform: translateY(0);
        }
        
        .btn-mobile-login::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.5s;
        }
        
        .btn-mobile-login:hover::before {
            left: 100%;
        }
        
        .otp-section {
            display: none;
            text-align: center;
        }
        
        .otp-input {
            width: 50px;
            height: 50px;
            text-align: center;
            font-size: 18px;
            font-weight: bold;
            border: 2px solid #e0e0e0;
            border-radius: 10px;
            margin: 0 5px;
            transition: all 0.3s ease;
        }
        
        .otp-input:focus {
            border-color: #800000;
            transform: scale(1.1);
        }
        
        .otp-container {
            display: flex;
            justify-content: center;
            margin: 20px 0;
        }
        
        .resend-link {
            color: #800000;
            text-decoration: none;
            font-weight: 500;
            font-size: 14px;
        }
        
        .resend-link:hover {
            text-decoration: underline;
            color: #a52a2a;
        }
        
        .register-link {
            text-align: center;
            margin-top: 20px;
            padding-top: 20px;
            border-top: 1px solid #e0e0e0;
        }
        
        .register-link a {
            color: #800000;
            text-decoration: none;
            font-weight: 500;
        }
        
        .register-link a:hover {
            text-decoration: underline;
        }
        
        .loading-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.8);
            display: none;
            justify-content: center;
            align-items: center;
            z-index: 9999;
        }
        
        .loading-spinner {
            width: 60px;
            height: 60px;
            border: 4px solid rgba(255, 255, 255, 0.3);
            border-top: 4px solid #800000;
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }
        
        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
        
        .loading-text {
            color: white;
            margin-top: 15px;
            font-weight: 500;
        }
        
        .alert {
            border-radius: 10px;
            border: none;
            font-size: 14px;
            margin-bottom: 20px;
        }
        
        .alert-success {
            background: linear-gradient(135deg, #28a745, #20c997);
            color: white;
        }
        
        .alert-danger {
            background: linear-gradient(135deg, #dc3545, #e74c3c);
            color: white;
        }
        
        /* QR Code Info */
        .qr-info {
            background: linear-gradient(135deg, #f8f9fa, #e9ecef);
            padding: 15px;
            border-radius: 15px;
            margin-bottom: 20px;
            text-align: center;
        }
        
        .qr-info i {
            font-size: 24px;
            color: #800000;
            margin-bottom: 10px;
        }
        
        .qr-info p {
            font-size: 12px;
            color: #666;
            margin: 0;
        }
        
        /* Responsive adjustments */
        @media (max-width: 375px) {
            .mobile-container {
                max-width: 350px;
            }
            
            .form-section {
                padding: 25px 20px;
            }
            
            .otp-input {
                width: 45px;
                height: 45px;
                margin: 0 3px;
            }
        }
    </style>
</head>
<body>
    <div class="mobile-container">
        <div class="header-section">
            <img src="assets/img/logo.png" alt="MOIST Logo" class="logo-mobile">
            <div class="school-name">MISAMIS ORIENTAL INSTITUTE<br>OF SCIENCE AND TECHNOLOGY</div>
            <div class="portal-title">Faculty Evaluation</div>
            <div class="portal-subtitle">Mobile Portal</div>
        </div>
        
        <div class="form-section">
            <div class="qr-info">
                <i class="fas fa-qrcode"></i>
                <p>Scanned from QR Code? You're all set!</p>
            </div>
            
            <div class="welcome-text">
                <h3>Student Login</h3>
                <p>Enter your credentials to access evaluations</p>
            </div>
            
            <form id="mobile-login-form">
                <!-- Step 1: Credentials -->
                <div id="credentials-section">
                    <div class="form-group">
                        <input type="text" class="form-control" name="student_id" placeholder="Student ID" required>
                        <i class="fas fa-user input-icon"></i>
                    </div>
                    
                    <div class="form-group">
                        <input type="email" class="form-control" name="email" placeholder="Email Address" required>
                        <i class="fas fa-envelope input-icon"></i>
                    </div>
                </div>
                
                <!-- Step 2: OTP -->
                <div id="otp-section" class="otp-section">
                    <p style="color: #666; margin-bottom: 15px;">
                        <i class="fas fa-shield-alt" style="color: #800000;"></i>
                        Enter the 6-digit code sent to your email
                    </p>
                    
                    <div class="otp-container">
                        <input type="text" class="otp-input" maxlength="1" data-index="0">
                        <input type="text" class="otp-input" maxlength="1" data-index="1">
                        <input type="text" class="otp-input" maxlength="1" data-index="2">
                        <input type="text" class="otp-input" maxlength="1" data-index="3">
                        <input type="text" class="otp-input" maxlength="1" data-index="4">
                        <input type="text" class="otp-input" maxlength="1" data-index="5">
                    </div>
                    
                    <input type="hidden" name="otp" id="otp-hidden">
                    
                    <p style="font-size: 12px; color: #666; margin-bottom: 15px;">
                        Didn't receive the code? 
                        <a href="#" id="resend-otp" class="resend-link">Resend OTP</a>
                    </p>
                </div>
                
                <input type="hidden" name="login" value="3">
                <input type="hidden" name="temp_student_id" id="temp_student_id">
                
                <button type="submit" class="btn-mobile-login" id="submit-btn">
                    <span id="btn-text">Send OTP</span>
                    <span id="btn-spinner" style="display: none;">
                        <i class="fas fa-spinner fa-spin"></i> Processing...
                    </span>
                </button>
            </form>
            
            <div class="register-link">
                <p style="color: #666; font-size: 14px;">
                    Don't have an account? 
                    <a href="student_register.php">Register here</a>
                </p>
            </div>
        </div>
    </div>
    
    <!-- Loading Overlay -->
    <div class="loading-overlay" id="loading-overlay">
        <div style="text-align: center;">
            <div class="loading-spinner"></div>
            <div class="loading-text">Processing...</div>
        </div>
    </div>
    
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    
    <script>
        let currentStep = 1;
        let tempStudentData = null;
        
        $(document).ready(function() {
            // OTP input handling
            $('.otp-input').on('input', function() {
                const value = $(this).val();
                const index = parseInt($(this).data('index'));
                
                // Only allow numbers
                if (!/^\d$/.test(value)) {
                    $(this).val('');
                    return;
                }
                
                // Move to next input
                if (value && index < 5) {
                    $('.otp-input[data-index="' + (index + 1) + '"]').focus();
                }
                
                // Update hidden OTP field
                updateOTPValue();
            });
            
            // OTP backspace handling
            $('.otp-input').on('keydown', function(e) {
                const index = parseInt($(this).data('index'));
                
                if (e.key === 'Backspace' && !$(this).val() && index > 0) {
                    $('.otp-input[data-index="' + (index - 1) + '"]').focus();
                }
            });
            
            // Form submission
            $('#mobile-login-form').submit(function(e) {
                e.preventDefault();
                
                // Remove existing alerts
                $('.alert').remove();
                
                // Show loading
                showLoading();
                
                $.ajax({
                    url: 'ajax.php?action=student_login',
                    method: 'POST',
                    data: $(this).serialize(),
                    success: function(resp) {
                        hideLoading();
                        handleResponse(resp);
                    },
                    error: function() {
                        hideLoading();
                        showAlert('Connection error. Please try again.', 'danger');
                    }
                });
            });
            
            // Resend OTP
            $('#resend-otp').click(function(e) {
                e.preventDefault();
                
                if (tempStudentData) {
                    $(this).text('Sending...');
                    showLoading();
                    
                    $.ajax({
                        url: 'ajax.php?action=student_login',
                        method: 'POST',
                        data: {
                            student_id: tempStudentData.student_id,
                            email: tempStudentData.email,
                            login: 3
                        },
                        success: function(resp) {
                            hideLoading();
                            $('#resend-otp').text('Resend OTP');
                            
                            if (resp == 4) {
                                showAlert('OTP resent successfully!', 'success');
                            } else {
                                showAlert('Failed to resend OTP.', 'danger');
                            }
                        },
                        error: function() {
                            hideLoading();
                            $('#resend-otp').text('Resend OTP');
                            showAlert('Connection error.', 'danger');
                        }
                    });
                }
            });
        });
        
        function updateOTPValue() {
            let otp = '';
            $('.otp-input').each(function() {
                otp += $(this).val();
            });
            $('#otp-hidden').val(otp);
        }
        
        function handleResponse(resp) {
            switch(parseInt(resp)) {
                case 1:
                    showAlert('Login successful! Redirecting...', 'success');
                    setTimeout(function() {
                        window.location.href = 'mobile_interface.php';
                    }, 1000);
                    break;
                    
                case 3:
                    showAlert('Invalid Student ID or Email.', 'danger');
                    break;
                    
                case 4:
                    showOTPStep();
                    showAlert('OTP sent to your email!', 'success');
                    break;
                    
                case 5:
                    showAlert('Failed to send OTP. Please check your email.', 'danger');
                    break;
                    
                case 6:
                    showAlert('System error. Please try again later.', 'danger');
                    break;
                    
                case 7:
                    showAlert('Invalid or expired OTP.', 'danger');
                    $('.otp-input').val('');
                    $('.otp-input[data-index="0"]').focus();
                    break;
                    
                default:
                    showAlert('Unexpected error. Please try again.', 'danger');
            }
        }
        
        function showOTPStep() {
            tempStudentData = {
                student_id: $('input[name="student_id"]').val(),
                email: $('input[name="email"]').val()
            };
            
            $('#temp_student_id').val(tempStudentData.student_id);
            
            $('#credentials-section').slideUp(300);
            $('#otp-section').slideDown(300);
            $('#btn-text').text('Verify & Login');
            
            setTimeout(function() {
                $('.otp-input[data-index="0"]').focus();
            }, 400);
            
            currentStep = 2;
        }
        
        function showLoading() {
            $('#btn-text').hide();
            $('#btn-spinner').show();
            $('#submit-btn').prop('disabled', true);
            $('#loading-overlay').fadeIn(300);
        }
        
        function hideLoading() {
            $('#btn-spinner').hide();
            $('#btn-text').show();
            $('#submit-btn').prop('disabled', false);
            $('#loading-overlay').fadeOut(300);
        }
        
        function showAlert(message, type) {
            const alertClass = type === 'success' ? 'alert-success' : 'alert-danger';
            const icon = type === 'success' ? 'fa-check-circle' : 'fa-exclamation-triangle';
            
            const alert = `
                <div class="alert ${alertClass} alert-dismissible fade show" role="alert">
                    <i class="fas ${icon}"></i> ${message}
                    <button type="button" class="close" data-dismiss="alert">
                        <span>&times;</span>
                    </button>
                </div>
            `;
            
            $('.form-section').prepend(alert);
            
            // Auto dismiss after 5 seconds
            setTimeout(function() {
                $('.alert').fadeOut();
            }, 5000);
        }
    </script>
</body>
</html>
