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

$token = isset($_GET['token']) ? $_GET['token'] : '';
$valid_token = false;

if($token) {
    // Use PHP time instead of MySQL NOW() to avoid timezone issues
    $current_time = date('Y-m-d H:i:s');
    $stmt = $conn->prepare("SELECT * FROM users WHERE reset_token = ? AND reset_expires > ?");
    $stmt->bind_param("ss", $token, $current_time);
    $stmt->execute();
    $query = $stmt->get_result();
    $valid_token = $query->num_rows > 0;
}
?>
<?php $page = 'reset_password'; include 'header.php' ?>

<body class="hold-transition login-page bg-black">
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card card-outline card-primary mt-5">
                <div class="card-header">
                    <h3 class="card-title">Reset Password</h3>
                </div>
                <div class="card-body">
                    <?php if($valid_token): ?>
                        <p class="login-box-msg">Enter your new password below.</p>
                        <form id="reset-password-form">
                            <input type="hidden" name="token" value="<?php echo $token; ?>">
                            
                            <div class="input-group mb-3">
                                <input type="password" class="form-control" name="password" placeholder="New Password" required minlength="8">
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-lock"></span>
                                    </div>
                                </div>
                            </div>
                            <small class="text-muted mb-3 d-block">Password must be at least 8 characters with uppercase, lowercase, and number.</small>
                            
                            <div class="input-group mb-3">
                                <input type="password" class="form-control" name="confirm_password" placeholder="Confirm Password" required minlength="8">
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-lock"></span>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary btn-block">Reset Password</button>
                                </div>
                            </div>
                        </form>
                    <?php else: ?>
                        <div class="alert alert-danger">
                            <h5>Invalid or Expired Link</h5>
                            <p>This password reset link is either invalid or has expired. Please request a new password reset.</p>
                        </div>
                    <?php endif; ?>
                    
                    <p class="mt-3 mb-1">
                        <a href="index.php?page=login">Back to Login</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#reset-password-form').submit(function(e) {
            e.preventDefault();
            
            var password = $('input[name="password"]').val();
            var confirm_password = $('input[name="confirm_password"]').val();
            
            if(password !== confirm_password) {
                alert_toast("Passwords do not match!", 'error');
                return;
            }
            
            start_load();
            $('.err-msg').remove();
            
            $.ajax({
                url: 'ajax.php?action=reset_password',
                method: 'POST',
                data: $(this).serialize(),
                success: function(resp) {
                    if (resp == 1) {
                        alert_toast("Password reset successfully! You can now login with your new password.", 'success');
                        setTimeout(function(){
                            location.href = 'index.php?page=login';
                        }, 2000);
                    } else if (resp == 2) {
                        alert_toast("Invalid or expired reset link. Please request a new password reset.",'error');
                        end_load();
                    } else if (resp == 3) {
                        alert_toast("Password must be at least 8 characters long.",'error');
                        end_load();
                    } else if (resp == 4) {
                        alert_toast("Password must contain at least one uppercase letter, one lowercase letter, and one number.",'error');
                        end_load();
                    } else {
                        alert_toast("An error occurred. Please try again.",'error');
                        end_load();
                    }
                }
            });
        });
    });
</script>

<?php include 'footer.php' ?>
</body>
</html>