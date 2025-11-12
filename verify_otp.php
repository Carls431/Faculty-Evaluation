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
<?php $page = 'verify_otp'; include 'header.php' ?>

<style>
body.login-page {
  background: url('assets/img/background.png') no-repeat center center fixed !important;
  background-size: cover !important;
}
.otp-verification-box {
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
.otp-verification-box::before {
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
.otp-header {
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
.otp-card-body {
  border-radius: 0 0 18px 18px;
  padding: 20px 30px;
  width: 100%;
}
.otp-input {
  font-size: 24px;
  text-align: center;
  letter-spacing: 8px;
  font-family: monospace;
  font-weight: bold;
  border: 2px solid #ced4da;
  border-radius: 8px;
  padding: 15px;
}
.otp-input:focus {
  box-shadow: 0 0 0 0.2rem rgba(128, 0, 0, 0.25);
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
.resend-otp {
  color: #666;
  text-decoration: none;
  font-size: 0.9rem;
  transition: all 0.3s ease;
}
.resend-otp:hover {
  color: #800000;
  text-decoration: underline;
}
</style>

<body class="hold-transition login-page bg-black">
<div class="otp-verification-box">
  <div class="login-logo-img">
    <img src="assets/img/logo.png" alt="Logo" style="width: 70px; height: 70px; margin-top: 20px;" />
  </div>
  <h2 class="otp-header"><i class="fas fa-shield-alt"></i> Verify OTP</h2>
  
  <div class="otp-card-body">
    <p class="text-center text-muted mb-4">Enter the 6-digit OTP code sent to your email:<br><strong><?php echo htmlspecialchars($email); ?></strong></p>
    
    <form id="verify-otp-form" method="POST">
      <input type="hidden" name="email" value="<?php echo htmlspecialchars($email); ?>">
      <div id="msg"></div>
      
      <div class="form-group mb-3">
        <input type="text" class="form-control otp-input" name="otp_code" id="otp_code" placeholder="000000" maxlength="6" required>
      </div>
      
      <div class="row">
        <div class="col-12">
          <button type="submit" class="btn btn-primary btn-block btn-lg">
            <i class="fas fa-check"></i> Verify OTP
          </button>
        </div>
      </div>
    </form>
    
    <div class="text-center mt-3">
      <p class="text-muted mb-2">Didn't receive the code?</p>
      <a href="#" id="resend-otp" class="resend-otp">
        <i class="fas fa-redo"></i> Resend OTP
      </a>
    </div>
    
    <div class="text-center mt-4">
      <a href="index.php?page=forgot_password" class="back-to-login">
        <i class="fas fa-arrow-left"></i> Back to Email Entry
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
    // Auto-focus on OTP input
    $('#otp_code').focus();
    
    // Only allow numbers in OTP input
    $('#otp_code').on('input', function() {
        this.value = this.value.replace(/[^0-9]/g, '');
    });
    
    // Verify OTP form submission
    $('#verify-otp-form').submit(function(e) {
        e.preventDefault();
        var email = $('input[name="email"]').val();
        var otp_code = $('#otp_code').val();
        
        if (otp_code.length !== 6) {
            $('#msg').html('<div class="alert alert-danger">Please enter a 6-digit OTP code.</div>');
            return;
        }
        
        // Clear previous messages
        $('#msg').html('');
        
        // Show loading
        start_load();
        
        $.ajax({
            url: 'forgot_password_otp.php',
            type: 'POST',
            data: {
                email: email,
                otp_code: otp_code,
                action: 'verify_otp'
            },
            success: function(response) {
                console.log('Server Response:', response);
                
                if (response == 1) {
                    $('#msg').html('<div class="alert alert-success">OTP verified successfully! Redirecting...</div>');
                    setTimeout(function() {
                        location.href = 'index.php?page=new_password&email=' + encodeURIComponent(email);
                    }, 1500);
                } else if (response == 2) {
                    $('#msg').html('<div class="alert alert-danger">Invalid or expired OTP code. Please try again.</div>');
                } else {
                    $('#msg').html('<div class="alert alert-danger">An error occurred. Please try again.</div>');
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
    
    // Resend OTP functionality
    $('#resend-otp').click(function(e) {
        e.preventDefault();
        var email = $('input[name="email"]').val();
        
        start_load();
        
        $.ajax({
            url: 'forgot_password_otp.php',
            type: 'POST',
            data: {
                email: email,
                action: 'send_otp'
            },
            success: function(response) {
                if (response == 1) {
                    alert_toast('New OTP code sent to your email!', 'success');
                } else if (response == 2) {
                    alert_toast('Email not found in our records.', 'error');
                } else if (response == 4) {
                    alert_toast('Too many attempts. Please try again later.', 'error');
                } else {
                    alert_toast('Failed to send OTP. Please try again.', 'error');
                }
                end_load();
            },
            error: function(xhr, status, error) {
                alert_toast('Network error. Please try again.', 'error');
                end_load();
            }
        });
    });
});
</script>

<?php include 'footer.php' ?>
</body>
</html>
