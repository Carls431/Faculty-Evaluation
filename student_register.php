<?php
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
    body.register-page {
        background: url(assets/img/background.png) no-repeat center center fixed;
        background-size: cover;
        display: flex;
        align-items: center;
        justify-content: center;
        min-height: 100vh;
        font-family: 'Montserrat', sans-serif;
        padding: 20px 0;
    }
    .register-container {
        display: flex;
        width: 1100px;
        min-height: 700px;
        background: #fff;
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0 15px 35px rgba(0,0,0,0.2);
        position: relative;
        z-index: 1;
    }
    .info-panel {
        width: 45%;
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
        margin-bottom: 40px;
        width: 100%;
    }
    .info-logo {
        width: 70px;
        height: 70px;
        margin-right: 15px;
        flex-shrink: 0;
    }
    .institution-text {
        flex: 1;
        margin-left: -15px;
    }
    .institution-name {
        font-size: 1.1rem;
        font-weight: 600;
        color: #8B0000;
        line-height: 1.1;
        margin: 0;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    .institution-subtitle {
        font-size: 0.7rem;
        color: #666;
        margin: 2px 0 0 0;
        font-weight: 500;
        text-transform: uppercase;
        letter-spacing: 1px;
    }
    .portal-title {
        font-size: 2.5rem;
        font-weight: 700;
        color: #000;
        margin: 2px 0;
        line-height: 1.1;
        text-transform: uppercase;
        padding-top: 30px;
    }
    .portal-subtitle {
        font-size: 1.5rem;
        font-weight: 600;
        margin-top: 10px;
        background: linear-gradient(to right, #800000, #b22222);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        color: transparent;
    }
    .form-panel {
        width: 55%;
        background: linear-gradient(to bottom right, #000428, rgb(5, 68, 122));
        position: absolute;
        top: 0;
        right: 0;
        height: 100%;
        color: #fff;
        clip-path: polygon(15% 0, 100% 0, 100% 100%, 0% 100%);
        padding: 30px 60px 30px 120px;
        display: flex;
        flex-direction: column;
        justify-content: center;
        overflow-y: auto;
    }
    
    .form-panel::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-image: 
            linear-gradient(30deg, transparent 40%, rgba(255,255,255,0.03) 40.5%, rgba(255,255,255,0.03) 41%, transparent 41.5%),
            linear-gradient(60deg, transparent 60%, rgba(255,255,255,0.04) 60.5%, rgba(255,255,255,0.04) 61%, transparent 61.5%),
            linear-gradient(120deg, transparent 20%, rgba(255,255,255,0.02) 20.5%, rgba(255,255,255,0.02) 21%, transparent 21.5%),
            linear-gradient(150deg, transparent 70%, rgba(255,255,255,0.03) 70.5%, rgba(255,255,255,0.03) 71%, transparent 71.5%);
        background-size: 80px 80px, 120px 120px, 100px 100px, 90px 90px;
        background-position: 0 0, 40px 40px, 20px 20px, 60px 60px;
        pointer-events: none;
        z-index: 0;
    }
    
    .form-panel::after {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-image: 
            radial-gradient(circle at 20% 30%, rgba(255,255,255,0.02) 1px, transparent 1px),
            radial-gradient(circle at 80% 70%, rgba(255,255,255,0.02) 1px, transparent 1px),
            radial-gradient(circle at 40% 80%, rgba(255,255,255,0.01) 1px, transparent 1px),
            radial-gradient(circle at 90% 20%, rgba(255,255,255,0.02) 1px, transparent 1px);
        background-size: 150px 150px, 200px 200px, 180px 180px, 160px 160px;
        background-position: 0 0, 75px 75px, 40px 40px, 120px 120px;
        pointer-events: none;
        z-index: 0;
    }
    .form-panel h2 {
        font-weight: 700;
        font-size: 1.8rem;
        margin-bottom: 20px;
        text-align: center;
        position: relative;
        z-index: 1;
    }
    .form-control, .input-group-text {
        background: transparent;
        border: none;
        border-bottom: 2px solid rgba(255,255,255,0.5);
        border-radius: 0;
        color: #fff;
        padding-left: 0;
        font-size: 0.9rem;
        padding: 8px 0;
        position: relative;
        z-index: 1;
    }
    
    /* Specific styling for select dropdown */
    select.form-control {
        background: rgba(255,255,255,0.1);
        border: 1px solid rgba(255,255,255,0.3);
        border-radius: 5px;
        padding: 10px 12px;
        cursor: pointer;
        appearance: auto;
        -webkit-appearance: auto;
        -moz-appearance: auto;
    }
    
    select.form-control:focus {
        background: rgba(255,255,255,0.15);
        border-color: #ffc107;
        outline: none;
    }
    
    select.form-control option {
        background: #001b3a;
        color: #fff;
        padding: 8px 12px;
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
        font-size: 0.9rem;
    }
    .form-group {
        margin-bottom: 15px;
    }
    .btn-primary {
        background-color: #ffc107;
        border-color: #ffc107;
        color: #003366;
        font-weight: bold;
        padding: 12px;
        border-radius: 5px;
        transition: all 0.3s ease;
        margin-top: 15px;
        position: relative;
        z-index: 1;
    }
    .btn-primary:hover {
        background-color: #e0a800;
        border-color: #e0a800;
        color: #003366;
    }
    .alert {
        width: 100%;
        border-radius: 5px;
        margin-bottom: 15px;
    }
    .text-light, .btn-link.text-light {
        color: #eee !important;
    }
    .btn-link.text-light:hover {
        color: #fff !important;
    }
    .login-link {
        text-align: center;
        margin-top: 15px;
    }
    .login-link a {
        color: #ffc107;
        text-decoration: none;
        font-weight: 500;
    }
    .login-link a:hover {
        color: #fff;
        text-decoration: underline;
    }
    
    /* Loading Animation */
    @keyframes logoSpin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }
    
    .info-logo.loading {
        animation: logoSpin 1s linear infinite;
        transition: all 0.3s ease;
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
        0% { transform: rotateY(0deg) rotateX(0deg); }
        25% { transform: rotateY(90deg) rotateX(15deg); }
        50% { transform: rotateY(180deg) rotateX(0deg); }
        75% { transform: rotateY(270deg) rotateX(-15deg); }
        100% { transform: rotateY(360deg) rotateX(0deg); }
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

    /* Step indicator */
    .step-indicator {
        display: flex;
        justify-content: center;
        margin-bottom: 20px;
        position: relative;
        z-index: 1;
    }
    .step {
        width: 30px;
        height: 30px;
        border-radius: 50%;
        background: rgba(255,255,255,0.3);
        color: #fff;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 5px;
        font-size: 0.8rem;
        font-weight: bold;
    }
    .step.active {
        background: #ffc107;
        color: #003366;
    }
    .step.completed {
        background: #28a745;
        color: #fff;
    }
</style>

<body class="register-page">
<div class="register-container">
    <div class="info-panel">
        <div class="logo-container">
            <img src="assets/img/logo.png" alt="MOIST Logo" class="info-logo">
            <div class="institution-text">
                <h1 class="institution-name">MISAMIS ORIENTAL<br>INSTITUTE OF SCIENCE<br>AND TECHNOLOGY</h1>
            </div>
        </div>
        <h2 class="portal-title"><B>Student</B><br>Registration</h2>
        <p class="portal-subtitle">Join Our Portal</p>
    </div>
    <div class="form-panel">
        <!-- Step Indicator -->
        <div class="step-indicator">
            <div class="step active" id="step-1">1</div>
            <div class="step" id="step-2">2</div>
        </div>

        <form action="" id="register-form">
            <h2 id="form-title">Personal Information</h2>

            <!-- Step 1: Personal Information -->
            <div id="step1-fields">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <input type="text" class="form-control" name="student_id" required placeholder="Student ID">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <input type="email" class="form-control" name="email" required placeholder="Email Address">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <input type="text" class="form-control" name="firstname" required placeholder="First Name">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <input type="text" class="form-control" name="lastname" required placeholder="Last Name">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <input type="tel" class="form-control" name="phone" placeholder="Phone Number (Optional)">
                </div>
                <div class="form-group">
                    <select class="form-control" name="class_id" required>
                        <option value="">Select Your Class/Section</option>
                        <?php
                        $classes = $conn->query("SELECT * FROM class_list ORDER BY curriculum, level, section");
                        while($row = $classes->fetch_assoc()):
                        ?>
                        <option value="<?php echo $row['id'] ?>"><?php echo $row['curriculum'] . ' ' . $row['level'] . ' - ' . $row['section'] ?></option>
                        <?php endwhile; ?>
                    </select>
                </div>
            </div>

            <!-- Step 2: OTP Verification -->
            <div id="step2-fields" style="display: none;">
                <div class="form-group">
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

            <input type="hidden" name="register" value="1">
            <input type="hidden" name="current_step" id="current_step" value="1">

            <div class="row">
                <div class="col-12">
                    <button type="button" class="btn btn-secondary btn-block" id="prev-btn" style="display: none;">
                        <i class="fas fa-arrow-left"></i> Previous
                    </button>
                    <button type="submit" class="btn btn-primary btn-block" id="submit-btn">
                        <span id="btn-text">Next</span>
                        <span id="btn-spinner" style="display: none;">
                            <i class="fas fa-spinner fa-spin"></i> Processing...
                        </span>
                    </button>
                </div>
            </div>
        </form>

        <div class="login-link">
            <p class="text-light">Already have an account? <a href="student_login.php">Sign In</a></p>
        </div>
    </div>
</div>

<!-- 3D Loading Overlay -->
<div class="loading-overlay" id="loading-overlay">
    <div class="loading-3d-container">
        <img src="assets/img/logo.png" alt="MOIST Logo" class="loading-3d-logo">
        <div class="loading-text">
            Processing Registration<span class="loading-dots">...</span>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    let currentStep = 1;
    let registrationData = {};

    // Debug function to check if everything is working
    function debugForm() {
        console.log('Current Step:', currentStep);
        console.log('Form data:', {
            student_id: $('input[name="student_id"]').val(),
            email: $('input[name="email"]').val(),
            firstname: $('input[name="firstname"]').val(),
            lastname: $('input[name="lastname"]').val()
        });
    }

    $(document).ready(function () {
        console.log('Registration form loaded successfully');
        
        // Add click handler for debugging
        $('#submit-btn').click(function(e) {
            console.log('Submit button clicked');
            debugForm();
        });
        // Form submission handler
        $('#register-form').submit(function (e) {
            e.preventDefault();
            console.log('Form submitted, current step:', currentStep);
            
            // Remove any existing alerts
            $(this).find('.alert').remove();
            
            // Disable HTML5 validation for hidden fields
            $('#step2-fields input, #step2-fields select').prop('required', false);
            $('#step3-fields input').prop('required', false);
            
            if (currentStep === 1) {
                console.log('Processing step 1');
                // Enable validation only for step 1 fields
                $('#step1-fields input[required]').prop('required', true);
                
                // Step 1: Validate personal information and send OTP
                if (validateStep1()) {
                    console.log('Step 1 validation passed');
                    storeStepData(1);
                    sendRegistrationOTP();
                } else {
                    console.log('Step 1 validation failed');
                }
            } else if (currentStep === 2) {
                console.log('Processing step 2 - OTP verification');
                // Enable validation only for step 2 fields
                $('#step2-fields input').prop('required', true);
                
                // Step 2: Verify OTP and complete registration
                completeRegistration();
            }
        });

        // Previous button handler
        $('#prev-btn').click(function() {
            if (currentStep > 1) {
                showStep(currentStep - 1);
            }
        });

        // Resend OTP handler
        $('#resend-otp').click(function() {
            sendRegistrationOTP(true);
        });

        // Password confirmation validation
        $('input[name="confirm_password"]').on('input', function() {
            const password = $('input[name="password"]').val();
            const confirmPassword = $(this).val();
            
            if (confirmPassword && password !== confirmPassword) {
                $(this).addClass('border-danger');
                showError('Passwords do not match');
            } else {
                $(this).removeClass('border-danger');
                $('.alert-danger').remove();
            }
        });

        // Auto-format phone number
        $('input[name="phone"]').on('input', function() {
            let value = this.value.replace(/\D/g, '');
            if (value.length > 0) {
                if (value.startsWith('63')) {
                    value = '+' + value;
                } else if (value.startsWith('9')) {
                    value = '+63 ' + value;
                } else if (!value.startsWith('+63')) {
                    value = '+63 ' + value;
                }
            }
            this.value = value;
        });

        // Auto-format OTP input
        $('input[name="otp"]').on('input', function() {
            this.value = this.value.replace(/[^0-9]/g, '');
        });
    });

    function validateStep1() {
        const studentId = $('input[name="student_id"]').val().trim();
        const email = $('input[name="email"]').val().trim();
        const firstname = $('input[name="firstname"]').val().trim();
        const lastname = $('input[name="lastname"]').val().trim();
        const classId = $('select[name="class_id"]').val();

        console.log('Validating:', {studentId, email, firstname, lastname, classId});

        if (!studentId || !email || !firstname || !lastname || !classId) {
            showError('Please fill in all required fields');
            return false;
        }

        if (!isValidEmail(email)) {
            showError('Please enter a valid email address');
            return false;
        }

        console.log('Step 1 validation passed');
        return true;
    }

    // Remove validateStep2 since we only have 2 steps now

    function storeStepData(step) {
        console.log('Storing step data for step:', step);
        
        if (step === 1) {
            registrationData.student_id = $('input[name="student_id"]').val().trim();
            registrationData.email = $('input[name="email"]').val().trim();
            registrationData.firstname = $('input[name="firstname"]').val().trim();
            registrationData.lastname = $('input[name="lastname"]').val().trim();
            registrationData.phone = $('input[name="phone"]').val().trim();
            registrationData.class_id = $('select[name="class_id"]').val();
            
            console.log('Step 1 data stored:', {
                student_id: registrationData.student_id,
                email: registrationData.email,
                firstname: registrationData.firstname,
                lastname: registrationData.lastname,
                phone: registrationData.phone,
                class_id: registrationData.class_id
            });
        }
        // Remove step 2 data storage since we don't need class/password anymore
        
        console.log('Complete registration data:', registrationData);
    }

    function showStep(step) {
        // Hide all steps
        $('#step1-fields, #step2-fields, #step3-fields').hide();
        
        // Update step indicators
        $('.step').removeClass('active completed');
        for (let i = 1; i < step; i++) {
            $('#step-' + i).addClass('completed');
        }
        $('#step-' + step).addClass('active');
        
        // Show current step
        $('#step' + step + '-fields').show();
        currentStep = step;
        $('#current_step').val(step);
        
        // Update form title and button text
        if (step === 1) {
            $('#form-title').text('Personal Information');
            $('#btn-text').text('Send OTP');
            $('#prev-btn').hide();
        } else if (step === 2) {
            $('#form-title').text('Verify Email');
            $('#btn-text').text('Complete Registration');
            $('#prev-btn').show();
        }
    }

    function sendRegistrationOTP(isResend = false) {
        const buttonText = isResend ? 'Resending...' : 'Sending OTP...';
        
        if (isResend) {
            $('#resend-otp').html('<i class="fas fa-spinner fa-spin"></i> ' + buttonText);
        } else {
            showLoading();
        }

        $.ajax({
            url: 'ajax.php?action=send_registration_otp',
            method: 'POST',
            data: {
                student_id: registrationData.student_id,
                email: registrationData.email,
                firstname: registrationData.firstname,
                lastname: registrationData.lastname,
                class_id: registrationData.class_id
            },
            success: function(resp) {
                if (isResend) {
                    $('#resend-otp').html('<i class="fas fa-redo"></i> Resend OTP');
                } else {
                    hideLoading();
                }
                
                if (resp == 1) {
                    if (!isResend) {
                        showStep(2);
                    }
                    showSuccess('OTP sent to your email!');
                } else if (resp == 2) {
                    showError('Student ID already exists');
                } else if (resp == 3) {
                    showError('Email already exists');
                } else if (resp == 4) {
                    showError('Failed to send OTP. Please try again.');
                } else {
                    showError('Registration failed. Please try again.');
                }
            },
            error: function() {
                if (isResend) {
                    $('#resend-otp').html('<i class="fas fa-redo"></i> Resend OTP');
                } else {
                    hideLoading();
                }
                showError('Connection error. Please try again.');
            }
        });
    }

    function completeRegistration() {
        const otp = $('input[name="otp"]').val().trim();
        
        console.log('Complete registration called');
        console.log('OTP entered:', otp);
        console.log('Registration data:', registrationData);
        
        if (!otp || otp.length !== 6) {
            showError('Please enter the 6-digit OTP');
            return;
        }

        showLoading();

        const formData = {
            ...registrationData,
            otp: otp,
            action: 'complete_student_registration'
        };

        console.log('Sending data to server:', formData);

        $.ajax({
            url: 'ajax.php?action=complete_student_registration',
            method: 'POST',
            data: formData,
            success: function(resp) {
                console.log('Server response:', resp);
                hideLoading();
                
                if (resp == 1) {
                    showSuccess('Registration successful! Redirecting to login...');
                    setTimeout(function() {
                        window.location.href = 'student_login.php?registered=1';
                    }, 2000);
                } else if (resp == 2) {
                    showError('Invalid or expired OTP');
                    $('input[name="otp"]').val('').focus();
                } else if (resp == 3) {
                    showError('Student ID already exists');
                } else if (resp == 4) {
                    showError('Email already exists');
                } else {
                    showError('Registration failed. Please try again. Response: ' + resp);
                }
            },
            error: function(xhr, status, error) {
                console.log('AJAX error:', error);
                console.log('Status:', status);
                console.log('Response:', xhr.responseText);
                hideLoading();
                showError('Connection error. Please try again.');
            }
        });
    }

    function isValidEmail(email) {
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return emailRegex.test(email);
    }

    function showLoading() {
        $('#btn-text').hide();
        $('#btn-spinner').show();
        $('#submit-btn').prop('disabled', true);
        $('#loading-overlay').css('display', 'flex').hide().fadeIn(300);
    }

    function hideLoading() {
        $('#btn-spinner').hide();
        $('#btn-text').show();
        $('#submit-btn').prop('disabled', false);
        $('#loading-overlay').fadeOut(300);
    }

    function showError(message) {
        $('#register-form').prepend('<div class="alert alert-danger alert-dismissible fade show" role="alert">' + 
            '<i class="fas fa-exclamation-triangle"></i> ' + message + 
            '<button type="button" class="close" data-dismiss="alert">' +
            '<span>&times;</span></button></div>');
    }

    function showSuccess(message) {
        $('#register-form').prepend('<div class="alert alert-success alert-dismissible fade show" role="alert">' + 
            '<i class="fas fa-check-circle"></i> ' + message + 
            '<button type="button" class="close" data-dismiss="alert">' +
            '<span>&times;</span></button></div>');
    }
</script>

<?php include 'footer.php' ?>
</body>
</html>