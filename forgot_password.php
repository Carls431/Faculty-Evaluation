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
?>
<?php $page = 'forgot_password'; include 'header.php' ?>

<style>
body.login-page {
  background: url('assets/img/background.png') no-repeat center center fixed !important;
  background-size: cover !important;
}
.forgot-password-box {
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
.forgot-password-box::before {
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
.forgot-password-header {
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
.forgot-card-body {
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
.alert-danger {
  background-color: #f8d7da;
  color: #721c24;
  border-color: #f5c6cb;
  padding: 10px;
  border-radius: 8px;
  margin-bottom: 15px;
  font-size: 0.9em;
}
</style>

<body class="hold-transition login-page bg-black">
<div class="forgot-password-box">
  <div class="login-logo-img">
    <img src="assets/img/logo.png" alt="Logo" style="width: 70px; height: 70px; margin-top: 20px;" />
  </div>
  <h2 class="forgot-password-header"><i class="fas fa-key"></i> Forgot Password</h2>
  
  <div class="forgot-card-body">
    <p class="text-center text-muted mb-4">Enter your email address and we will send you a 6-digit OTP code to reset your password.</p>
    
    <form id="forgot-password-form" method="POST">
      <div id="msg"></div>
      <div class="input-group mb-3">
        <input type="email" class="form-control" name="email" id="email" placeholder="Enter your email address" required>
        <div class="input-group-append">
          <div class="input-group-text">
            <span class="fas fa-envelope"></span>
          </div>
        </div>
      </div>
      
      <div class="row">
        <div class="col-12">
          <button type="submit" class="btn btn-primary btn-block btn-lg">
            <i class="fas fa-paper-plane"></i> Send OTP Code
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
    $('#forgot-password-form').submit(function(e) {
        e.preventDefault();
        var email = $('#email').val();
        
        // Clear previous messages
        $('#msg').html('');
        
        // Show loading
        start_load();
        
        $.ajax({
            url: 'forgot_password_otp.php',
            type: 'POST',
            data: {
                email: email,
                action: 'send_otp'
            },
            success: function(response) {
                console.log('Server Response:', response);
                
                try {
                    if (response == 1) {
                        $('#msg').html('<div class="alert alert-success">OTP code has been sent to your email. Redirecting...</div>');
                        setTimeout(function() {
                            location.href = 'index.php?page=verify_otp&email=' + encodeURIComponent(email);
                        }, 2000);
                    } else if (response == 2) {
                        $('#msg').html('<div class="alert alert-danger">Email not found in our records.</div>');
                    } else if (response == 4) {
                        $('#msg').html('<div class="alert alert-danger">Too many reset attempts. Please try again in an hour.</div>');
                    } else {
                        $('#msg').html('<div class="alert alert-danger">An error occurred. Please try again.</div>');
                    }
                } catch (e) {
                    console.error('Error parsing response:', e);
                    $('#msg').html('<div class="alert alert-danger">An unexpected error occurred.</div>');
                }
                end_load();
            },
            error: function(xhr, status, error) {
                console.error('AJAX Error:', error);
                $('#msg').html('<div class="alert alert-danger">Network error. Please try again.</div>');
                end_load();
            }
        });
    });
});
</script>

<?php include 'footer.php' ?>
</body>
</html>