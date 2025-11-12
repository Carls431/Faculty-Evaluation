<?php 
include('./db_connect.php');
ob_start();
// Load system settings
if(!isset($_SESSION['system'])){
  $system = $conn->query("SELECT * FROM system_settings")->fetch_array();
  foreach($system as $k => $v){
    $_SESSION['system'][$k] = $v;
  }
}
ob_end_flush();

// Get email from URL parameter
$email = $_GET['email'] ?? '';
if (empty($email)) {
    header('Location: index.php?page=forgot_password');
    exit;
}
?>
<?php $page = 'new_password'; include 'header.php' ?>

<style>
body.login-page {
  background: url('assets/img/background.png') no-repeat center center fixed !important;
  background-size: cover !important;
}
.new-password-box {
  box-shadow: 0 8px 30px rgba(0,0,0,0.1);
  border-radius: 18px;
  background: rgba(255,255,255,0.98);
  width: 420px;
  max-width: 90vw;
  margin: 60px auto 0 auto;
  padding-bottom: 30px;
  position: relative;
  display: flex;
  flex-direction: column;
  align-items: center;
  overflow: hidden;
}
.new-password-box::before {
  content: '';
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 10px;
  background: linear-gradient(to right,rgb(197, 15, 15), #ff4500);
  border-top-left-radius: 18px;
  border-top-right-radius: 18px;
}
.new-password-header {
  color: #800000;
  text-shadow: 0 2px 8px rgba(0,0,0,0.08);
  background: none;
  padding: 20px 0 10px 0;
  border-radius: 0;
  font-size: 1.5rem;
  font-weight: bold;
  margin: 12px auto 10px auto;
  width: fit-content;
  box-shadow: none;
  letter-spacing: 1px;
  text-align: center;
}
.new-password-card-body {
  border-radius: 0 0 18px 18px;
  padding: 20px 30px;
  width: 100%;
}
.input-group-text {
  background-color: #f8f9fa;
  border-right: none;
  border-color: #ced4da;
}
.form-control {
  border-left: none;
  border-color: #ced4da;
  padding-left: 10px;
}
.form-control:focus {
  box-shadow: none;
  border-color: #800000;
}
.btn-primary {
  background-color: #800000;
  border-color: #800000;
  transition: all 0.3s ease;
  border-radius: 8px;
}
.btn-primary:hover {
  background-color: #ff4500;
  border-color: #ff4500;
}
.back-to-login {
  color: #800000;
  text-decoration: none;
  font-size: 0.9rem;
  transition: all 0.3s ease;
  display: inline-block;
  padding: 8px 15px;
  border-radius: 20px;
  background: rgba(128, 0, 0, 0.1);
}
.back-to-login:hover {
  color: #ff4500;
  text-decoration: none;
  background: rgba(255, 69, 0, 0.1);
  transform: translateY(-1px);
}
.password-requirements {
  font-size: 0.85rem;
  color: #666;
  background: #f8f9fa;
  padding: 10px;
  border-radius: 5px;
  margin-bottom: 15px;
}
.password-requirements ul {
  margin: 0;
  padding-left: 20px;
}
.password-strength {
  height: 5px;
  border-radius: 3px;
  margin-top: 5px;
  transition: all 0.3s ease;
}
.strength-weak { background: #dc3545; }
.strength-medium { background: #ffc107; }
.strength-strong { background: #28a745; }
</style>

<body class="hold-transition login-page bg-black">
<div class="new-password-box">
  <div class="login-logo-img">
    <img src="assets/img/logo.png" alt="Logo" style="width: 70px; height: 70px; margin-top: 20px;" />
  </div>
  <h2 class="new-password-header"><i class="fas fa-lock"></i> New Password</h2>
  
  <div class="new-password-card-body">
    <p class="text-center text-muted mb-4">Create a new password for your account:<br><strong><?php echo htmlspecialchars($email); ?></strong></p>
    
    <div class="password-requirements">
      <strong>Password Requirements:</strong>
      <ul>
        <li>At least 8 characters long</li>
        <li>Contains uppercase letter (A-Z)</li>
        <li>Contains lowercase letter (a-z)</li>
        <li>Contains at least one number (0-9)</li>
      </ul>
    </div>
    
    <form id="new-password-form" method="POST">
      <input type="hidden" name="email" value="<?php echo htmlspecialchars($email); ?>">
      <div id="msg"></div>
      
      <div class="input-group mb-3">
        <input type="password" class="form-control" name="new_password" id="new_password" placeholder="Enter new password" required>
        <div class="input-group-append">
          <div class="input-group-text">
            <span class="fas fa-lock"></span>
          </div>
        </div>
      </div>
      <div class="password-strength" id="password-strength"></div>
      
      <div class="input-group mb-3">
        <input type="password" class="form-control" name="confirm_password" id="confirm_password" placeholder="Confirm new password" required>
        <div class="input-group-append">
          <div class="input-group-text">
            <span class="fas fa-lock"></span>
          </div>
        </div>
      </div>
      
      <div class="row">
        <div class="col-12">
          <button type="submit" class="btn btn-primary btn-block btn-lg" id="submit-btn">
            <i class="fas fa-save"></i> Update Password
          </button>
        </div>
      </div>
    </form>
    
    <div class="text-center mt-4">
      <a href="index.php?page=login" class="back-to-login">
        <i class="fas fa-arrow-left"></i> Back to Login
      </a>
    </div>
  </div>
</div>

<!-- jQuery -->
<script src="assets/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap JS -->
<script src="assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- SweetAlert2 -->
<script src="assets/plugins/sweetalert2/sweetalert2.min.js"></script>

<script>
// Define required functions
window.start_load = function(){
    $('body').prepend('<div id="preloader2" style="position:fixed;top:0;left:0;width:100%;height:100%;background:rgba(0,0,0,0.3);z-index:9999;"><div style="position:absolute;top:50%;left:50%;transform:translate(-50%,-50%);color:white;">Loading...</div></div>')
}

window.end_load = function(){
    $('#preloader2').fadeOut('fast', function() {
        $(this).remove();
    })
}

window.alert_toast = function($msg = 'TEST', $bg = 'success', $pos = ''){
    var Toast = Swal.mixin({
        toast: true,
        position: $pos || 'top-end',
        showConfirmButton: false,
        timer: 5000
    });
    Toast.fire({
        icon: $bg,
        title: $msg
    })
}

$(document).ready(function() {
    // Password strength checker
    $('#new_password').on('input', function() {
        var password = $(this).val();
        var strength = checkPasswordStrength(password);
        var strengthBar = $('#password-strength');
        
        strengthBar.removeClass('strength-weak strength-medium strength-strong');
        
        if (password.length === 0) {
            strengthBar.hide();
        } else {
            strengthBar.show();
            if (strength < 3) {
                strengthBar.addClass('strength-weak');
            } else if (strength < 4) {
                strengthBar.addClass('strength-medium');
            } else {
                strengthBar.addClass('strength-strong');
            }
        }
    });
    
    // Real-time password confirmation check
    $('#confirm_password').on('input', function() {
        var password = $('#new_password').val();
        var confirm = $(this).val();
        
        if (confirm.length > 0) {
            if (password === confirm) {
                $(this).removeClass('is-invalid').addClass('is-valid');
            } else {
                $(this).removeClass('is-valid').addClass('is-invalid');
            }
        } else {
            $(this).removeClass('is-valid is-invalid');
        }
    });
    
    // Form submission
    $('#new-password-form').submit(function(e) {
        e.preventDefault();
        var email = $('input[name="email"]').val();
        var newPassword = $('#new_password').val();
        var confirmPassword = $('#confirm_password').val();
        
        // Clear previous messages
        $('#msg').html('');
        
        // Validate passwords match
        if (newPassword !== confirmPassword) {
            $('#msg').html('<div class="alert alert-danger">Passwords do not match.</div>');
            return;
        }
        
        // Validate password strength
        if (checkPasswordStrength(newPassword) < 3) {
            $('#msg').html('<div class="alert alert-danger">Password does not meet the minimum requirements.</div>');
            return;
        }
        
        // Show loading
        start_load();
        $('#submit-btn').prop('disabled', true);
        
        $.ajax({
            url: 'forgot_password_otp.php',
            type: 'POST',
            data: {
                email: email,
                new_password: newPassword,
                action: 'reset_password'
            },
            success: function(response) {
                console.log('Server Response:', response);
                
                if (response == 1) {
                    $('#msg').html('<div class="alert alert-success">Password updated successfully! Redirecting to login...</div>');
                    setTimeout(function() {
                        location.href = 'index.php?page=login';
                    }, 2000);
                } else if (response == 2) {
                    $('#msg').html('<div class="alert alert-danger">Invalid session. Please start the password reset process again.</div>');
                    setTimeout(function() {
                        location.href = 'index.php?page=forgot_password';
                    }, 3000);
                } else if (response == 3) {
                    $('#msg').html('<div class="alert alert-danger">Password must be at least 8 characters long.</div>');
                } else if (response == 4) {
                    $('#msg').html('<div class="alert alert-danger">Password must contain uppercase, lowercase, and numbers.</div>');
                } else if (response == 5) {
                    $('#msg').html('<div class="alert alert-warning">This password is already your current password. Please choose a different password.</div>');
                } else if (response == 6) {
                    $('#msg').html('<div class="alert alert-warning">You cannot reuse a previously used password. Please choose a new password that you have not used before.</div>');
                } else if (response == 7) {
                    $('#msg').html('<div class="alert alert-danger">An unexpected error occurred while updating your password. Please try again.</div>');
                } else {
                    $('#msg').html('<div class="alert alert-danger">An error occurred. Please try again.</div>');
                }
                end_load();
                $('#submit-btn').prop('disabled', false);
            },
            error: function(xhr, status, error) {
                console.error('AJAX Error:', error);
                $('#msg').html('<div class="alert alert-danger">Network error. Please try again.</div>');
                end_load();
                $('#submit-btn').prop('disabled', false);
            }
        });
    });
    
    function checkPasswordStrength(password) {
        var strength = 0;
        
        // Length check
        if (password.length >= 8) strength++;
        
        // Uppercase check
        if (/[A-Z]/.test(password)) strength++;
        
        // Lowercase check
        if (/[a-z]/.test(password)) strength++;
        
        // Number check
        if (/\d/.test(password)) strength++;
        
        // Special character check (bonus)
        if (/[!@#$%^&*(),.?":{}|<>]/.test(password)) strength++;
        
        return strength;
    }
});
</script>

<?php include 'footer.php' ?>
</body>
</html>
