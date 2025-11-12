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
    header("location:index.php?page=home");
    exit;
}
?>

<?php include 'header.php' ?>
<style>
    @import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700;900&display=swap');
    body.login-page {
        background: url(assets/img/background.png) no-repeat center center fixed;
        background-size: cover;
        display: flex;
        align-items: center;
        justify-content: center;
        height: 100vh;
        font-family: 'Montserrat', sans-serif;
    }
    .login-container {
        display: flex;
        width: 950px;
        max-width: 95%;
        height: 600px;
        background: #fff;
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0 15px 35px rgba(0,0,0,0.2);
        position: relative;
    }
    .info-panel {
        width: 60%;
        padding: 40px;
        display: flex;
        flex-direction: column;
        justify-content: flex-start;
        align-items: flex-start;
        background: #fff url('assets/img/loginwhitepage.png') no-repeat center bottom;
        background-size: cover;
        position: relative;
    }
    .info-panel::before {
        content: '';
        position: absolute;
        top: 0; right: 0; bottom: 0; left: 0;
        background: rgba(255, 255, 255, 0.4);
        z-index: 0;
    }
    .logo-container, .portal-title, .portal-subtitle {
        position: relative;
        z-index: 1;
    }
    .logo-container {
        display: flex;
        align-items: center;
        margin-bottom: 60px;
        width: 100%;
    }
    .info-logo {
        width: 80px;
        height: 80px;
        margin-right: 15px;
        flex-shrink: 0;
    }
    .institution-text {
        flex: 1;
        margin-left: -15px;
    }
    .institution-name {
        font-size: 1.3rem;
        font-weight: 600;
        color: #8B0000;
        line-height: 1.1;
        margin: 0;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    .institution-subtitle {
        font-size: 0.8rem;
        color: #666;
        margin: 2px 0 0 0;
        font-weight: 500;
        text-transform: uppercase;
        letter-spacing: 1px;
    }
    .portal-title {
    font-size: 3rem;
    font-weight: 700;
    color: #000;
    margin: 2px 0;
    line-height: 1.1;
    text-transform: uppercase;
    padding-top: 50px;
}

.portal-subtitle {
    font-size: 1.8rem;
    font-weight: 600;
    margin-top: 10px;

    /* Gradient maroon text */
    background: linear-gradient(to right, #800000, #b22222);  /* Maroon tones */
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    color: transparent;
}

    .form-panel {
        width: 58%;
        background: linear-gradient(to bottom right, #000428,rgb(5, 68, 122));
        position: absolute;
        top: 0;
        right: 0;
        height: 100%;
        color: #fff;
        clip-path: polygon(25% 0, 100% 0, 100% 100%, 0% 100%);
        padding: 50px 80px 50px 150px;
        display: flex;
        flex-direction: column;
        justify-content: center;
    }
    .form-panel h2 {
        font-weight: 700;
        font-size: 2rem;
        margin-bottom: 25px;
    }
    .form-control, .input-group-text {
        background: transparent;
        border: none;
        border-bottom: 2px solid rgba(255,255,255,0.5);
        border-radius: 0;
        color: #fff;
        padding-left: 0;
    }
    .input-group-text {
        border-bottom: 2px solid rgba(255,255,255,0.5) !important;
    }
    .form-control:focus {
        background: transparent;
        color: #fff;
        box-shadow: none;
        border-bottom-color: #ffc107;
    }
    .form-control::placeholder {
        color: rgba(255,255,255,0.7);
    }
    .btn-primary {
        background-color: #ffc107;
        border-color: #ffc107;
        color: #003366;
        font-weight: bold;
        padding: 12px;
        border-radius: 5px;
        transition: all 0.3s ease;
        margin-top: 20px;
    }
    .btn-primary:hover {
        background-color: #e0a800;
        border-color: #e0a800;
        color: #003366;
    }
    .alert {
        width: 100%;
        border-radius: 5px;
    }
    .text-light, .btn-link.text-light {
        color: #eee !important;
    }
    .btn-link.text-light:hover {
        color: #fff !important;
    }
    
    /* Logo rotation animation */
    @keyframes logoSpin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }
    
    .info-logo.loading {
        animation: logoSpin 1s linear infinite;
        transition: all 0.3s ease;
    }
    
    .info-logo {
        transition: all 0.3s ease;
    }
    
    /* 3D Loading Overlay */
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
        backdrop-filter: blur(5px);
    }
    
    .loading-3d-container {
        text-align: center;
        perspective: 1000px;
    }
    
    .loading-3d-logo {
        width: 120px;
        height: 120px;
        margin: 0 auto 20px;
        transform-style: preserve-3d;
        animation: rotate3D 2s linear infinite;
        filter: drop-shadow(0 10px 20px rgba(255, 193, 7, 0.3));
    }
    
    @keyframes rotate3D {
        0% { 
            transform: rotateY(0deg) rotateX(0deg);
        }
        25% { 
            transform: rotateY(90deg) rotateX(15deg);
        }
        50% { 
            transform: rotateY(180deg) rotateX(0deg);
        }
        75% { 
            transform: rotateY(270deg) rotateX(-15deg);
        }
        100% { 
            transform: rotateY(360deg) rotateX(0deg);
        }
    }
    
    .loading-text {
        color: #fff;
        font-size: 1.2rem;
        font-weight: 600;
        margin-top: 15px;
        text-shadow: 0 2px 4px rgba(0, 0, 0, 0.5);
    }
    
    .loading-dots {
        color: #ffc107;
        font-size: 1.5rem;
        animation: loadingDots 1.5s infinite;
    }
    
    @keyframes loadingDots {
        0%, 20% { opacity: 0; }
        50% { opacity: 1; }
        80%, 100% { opacity: 0; }
    }
    
    /* Mobile Responsive Design */
    @media screen and (max-width: 768px) {
        body.login-page {
            padding: 10px !important;
            height: auto !important;
            min-height: 100vh !important;
        }
        
        .login-container {
            flex-direction: column !important;
            width: 100% !important;
            max-width: 95% !important;
            height: auto !important;
            min-height: auto !important;
        }
        
        .info-panel {
            width: 100% !important;
            padding: 20px 15px !important;
            background: #fff !important;
            order: 1 !important;
            background-image: none !important;
        }
        
        .info-panel::before {
            display: none !important;
        }
        
        .logo-container {
            margin-bottom: 20px !important;
            justify-content: center !important;
            text-align: center !important;
        }
        
        .info-logo {
            width: 50px !important;
            height: 50px !important;
        }
        
        .institution-text {
            margin-left: 10px !important;
        }
        
        .institution-name {
            font-size: 0.9rem !important;
        }
        
        .portal-title {
            font-size: 1.8rem !important;
            text-align: center !important;
            padding-top: 10px !important;
        }
        
        .portal-subtitle {
            font-size: 1rem !important;
            text-align: center !important;
        }
        
        .form-panel {
            width: 100% !important;
            position: relative !important;
            clip-path: none !important;
            background: linear-gradient(to bottom, #000428, rgb(5, 68, 122)) !important;
            padding: 30px 20px !important;
            order: 2 !important;
            top: 0 !important;
            right: 0 !important;
            height: auto !important;
        }
        
        .form-panel h2 {
            font-size: 1.4rem !important;
            text-align: center !important;
            margin-bottom: 25px !important;
        }
        
        .btn-primary {
            padding: 12px !important;
            font-size: 1rem !important;
        }
        
        .loading-3d-logo {
            width: 80px !important;
            height: 80px !important;
        }
        
        .loading-text {
            font-size: 1rem !important;
        }
    }
    
    @media screen and (max-width: 480px) {
        .login-container {
            max-width: 98% !important;
        }
        
        .info-panel {
            padding: 15px 10px !important;
        }
        
        .form-panel {
            padding: 25px 15px !important;
        }
        
        .institution-name {
            font-size: 0.8rem !important;
        }
        
        .portal-title {
            font-size: 1.5rem !important;
        }
        
        .portal-subtitle {
            font-size: 0.9rem !important;
        }
        
        .form-control {
            font-size: 16px !important; /* Prevents zoom on iOS */
        }
    }
</style>

<body class="hold-transition login-page">
<div class="login-container">
    <div class="info-panel">
        <div class="logo-container">
            <img src="assets/img/logo.png" alt="MOIST Logo" class="info-logo">
            <div class="institution-text">
                <h1 class="institution-name">MISAMIS ORIENTAL<br>INSTITUTE OF SCIENCE<br>AND TECHNOLOGY</h1>
                
            </div>
        </div>
        <h2 class="portal-title"><B>Faculty</B><br>Evaluation</h2>
        <p class="portal-subtitle">Web Portal</p>
    </div>
    <div class="form-panel">
        <form action="" id="login-form">
            <h2>Sign In</h2>

            <!-- Step 1: Student ID and Email -->
            <div id="step1-fields">
                <div class="input-group mb-4">
                    <input type="text" class="form-control" name="student_id" required placeholder="Student ID">
                </div>
                <div class="input-group mb-4">
                    <input type="email" class="form-control" name="email" required placeholder="Email">
                </div>
            </div>

            <!-- Step 2: OTP Input (hidden initially) -->
            <div id="step2-fields" style="display: none;">
                <div class="input-group mb-4">
                    <input type="text" class="form-control" name="otp" maxlength="6" placeholder="Enter 6-digit OTP">
                </div>
                <div class="text-center mb-3">
                    <small class="text-light"><i class="fas fa-info-circle"></i> OTP sent to your email.</small>
                </div>
                <div class="text-center mb-3">
                    <button type="button" id="resend-otp" class="btn btn-link text-light" style="text-decoration: underline;">
                        <i class="fas fa-redo"></i> Resend OTP
                    </button>
                </div>
            </div>

            <input type="hidden" name="login" value="3">
            <input type="hidden" name="temp_student_id" id="temp_student_id" value="">

            <div class="row">
                <div class="col-12">
                    <button type="submit" class="btn btn-primary btn-block" id="submit-btn">
                        <span id="btn-text">Send OTP</span>
                        <span id="btn-spinner" style="display: none;">
                            <i class="fas fa-spinner fa-spin"></i> Sending...
                        </span>
                    </button>
                </div>
            </div>
        </form>

        <div class="text-center mt-3">
            <p class="text-light">Don't have an account? <a href="student_register.php" class="text-warning" style="text-decoration: none; font-weight: 500;">Register here</a></p>
        </div>
    </div>
</div>

<!-- 3D Loading Overlay -->
<div class="loading-overlay" id="loading-overlay">
    <div class="loading-3d-container">
        <img src="assets/img/logo.png" alt="MOIST Logo" class="loading-3d-logo">
        <div class="loading-text">
            Sending OTP<span class="loading-dots">...</span>
        </div>
    </div>
</div>

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script>
    let currentStep = 1;
    let tempStudentData = null;

    $(document).ready(function () {
      // Main form submission
      $('#login-form').submit(function (e) {
        e.preventDefault();
        
        // Remove any existing alerts
        $(this).find('.alert').remove();
        
        // Show loading state
        showLoading();
        
        $.ajax({
          url: 'ajax.php?action=student_login',
          method: 'POST',
          data: $(this).serialize(),
          error: function (err) {
            console.log(err);
            hideLoading();
            showError('Connection error. Please try again.');
          },
          success: function (resp) {
            hideLoading();
            console.log('Server response:', resp); // Debug line
            handleResponse(resp);
          }
        });
      });
      
      // Resend OTP button
      $('#resend-otp').click(function() {
        if (tempStudentData) {
          // Show loading
          $(this).html('<i class="fas fa-spinner fa-spin"></i> Sending...');
          $('#loading-overlay').css('display', 'flex').hide().fadeIn(300); // Show 3D overlay for resend
          
          $.ajax({
            url: 'ajax.php?action=student_login',
            method: 'POST',
            data: {
              student_id: tempStudentData.student_id,
              email: tempStudentData.email,
              login: 3
            },
            success: function(resp) {
              $('#resend-otp').html('<i class="fas fa-redo"></i> Resend OTP');
              $('#loading-overlay').fadeOut(300); // Hide 3D overlay
              if (resp == 4) {
                showSuccess('OTP resent successfully!');
              } else {
                showError('Failed to resend OTP. Please try again.');
              }
            },
            error: function() {
              $('#resend-otp').html('<i class="fas fa-redo"></i> Resend OTP');
              $('#loading-overlay').fadeOut(300); // Hide 3D overlay
              showError('Connection error. Please try again.');
            }
          });
        }
      });
      
      // Auto-format OTP input
      $('input[name="otp"]').on('input', function() {
        this.value = this.value.replace(/[^0-9]/g, '');
      });
    });
    
    function handleResponse(resp) {
      switch(parseInt(resp)) {
        case 1:
          // Login successful
          showSuccess('Login successful! Redirecting...');
          setTimeout(function() {
            window.location.href = 'index.php?page=evaluate';
          }, 1000);
          break;
          
        case 3:
          // Invalid credentials
          showError('Invalid Student ID or Email.');
          break;
          
        case 4:
          // OTP sent successfully
          showOTPStep();
          showSuccess('OTP sent to your email!');
          break;
          
        case 5:
          // Email sending failed
          showError('Failed to send OTP. Please check your email address.');
          break;
          
        case 6:
          // Database error
          showError('System error. Please try again later.');
          break;
          
        case 7:
          // OTP verification failed
          showError('Invalid or expired OTP. Please try again.');
          $('input[name="otp"]').val('').focus();
          break;
          
        case 8:
          // Invalid request
          showError('Invalid request. Please try again.');
          break;
          
        default:
          showError('Unexpected error. Please try again.');
      }
    }
    
    function showOTPStep() {
      // Store student data for resend functionality
      tempStudentData = {
        student_id: $('input[name="student_id"]').val(),
        email: $('input[name="email"]').val()
      };
      
      // Set temp student ID for OTP verification
      $('#temp_student_id').val(tempStudentData.student_id);
      
      // Hide step 1, show step 2
      $('#step1-fields').slideUp();
      $('#step2-fields').slideDown();
      
      // Update button text
      $('#btn-text').text('Verify OTP');
      
      // Focus on OTP input
      setTimeout(function() {
        $('input[name="otp"]').focus();
      }, 500);
      
      currentStep = 2;
    }
    
    function showLoading() {
      $('#btn-text').hide();
      $('#btn-spinner').show();
      $('#submit-btn').prop('disabled', true);
      
      // Show 3D loading overlay
      $('#loading-overlay').css('display', 'flex').hide().fadeIn(300);
    }
    
    function hideLoading() {
      $('#btn-spinner').hide();
      $('#btn-text').show();
      $('#submit-btn').prop('disabled', false);
      
      // Hide 3D loading overlay
      $('#loading-overlay').fadeOut(300);
    }
    
    function showError(message) {
      $('#login-form').prepend('<div class="alert alert-danger alert-dismissible fade show" role="alert">' + 
        '<i class="fas fa-exclamation-triangle"></i> ' + message + 
        '<button type="button" class="close" data-dismiss="alert">' +
        '<span>&times;</span></button></div>');
    }
    
    function showSuccess(message) {
      $('#login-form').prepend('<div class="alert alert-success alert-dismissible fade show" role="alert">' + 
        '<i class="fas fa-check-circle"></i> ' + message + 
        '<button type="button" class="close" data-dismiss="alert">' +
        '<span>&times;</span></button></div>');
    }
  </script>

  <?php include 'footer.php' ?>
</body>
</html>
