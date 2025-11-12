<?php include '../db_connect.php' ?>
<?php include '../twofa_helper.php' ?>
<?php
if(!isset($_SESSION['login_id'])){
    header("location:../login.php");
    exit;
}

$user_id = $_SESSION['login_id'];
$user_email = $_SESSION['login_email'];

// Get current 2FA status
$stmt = $conn->prepare("SELECT is_2fa_enabled, secret_key FROM users WHERE id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user_data = $result->fetch_assoc();

$is_2fa_enabled = $user_data['is_2fa_enabled'];
$secret_key = $user_data['secret_key'];

// Generate new secret if not exists
if (empty($secret_key)) {
    $secret_key = TwoFactorAuth::generateSecret();
    $update_stmt = $conn->prepare("UPDATE users SET secret_key = ? WHERE id = ?");
    $update_stmt->bind_param("si", $secret_key, $user_id);
    $update_stmt->execute();
}

$qr_code_url = TwoFactorAuth::getQRCodeUrl($user_email, $secret_key);
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>2FA Setup | MOIST Faculty Evaluation</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../assets/dist/css/adminlte.min.css">
    <link rel="stylesheet" href="../assets/plugins/fontawesome-free/css/all.min.css">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
    <?php include 'topbar.php' ?>
    <?php include 'sidebar.php' ?>
    
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Two-Factor Authentication Setup</h1>
                    </div>
                </div>
            </div>
        </section>

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">
                                    <i class="fas fa-shield-alt"></i>
                                    2FA Status: 
                                    <?php if($is_2fa_enabled): ?>
                                        <span class="badge badge-success">Enabled</span>
                                    <?php else: ?>
                                        <span class="badge badge-danger">Disabled</span>
                                    <?php endif; ?>
                                </h3>
                            </div>
                            <div class="card-body">
                                <?php if(!$is_2fa_enabled): ?>
                                    <div class="alert alert-info">
                                        <h5><i class="icon fas fa-info"></i> Setup Instructions:</h5>
                                        <ol>
                                            <li>Download <strong>Google Authenticator</strong> app on your phone</li>
                                            <li>Scan the QR code below with the app</li>
                                            <li>Enter the 6-digit code from the app to verify</li>
                                            <li>Click "Enable 2FA" to activate</li>
                                        </ol>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col-md-6">
                                            <h5>QR Code:</h5>
                                            <img src="<?php echo $qr_code_url ?>" alt="QR Code" class="img-fluid">
                                        </div>
                                        <div class="col-md-6">
                                            <h5>Manual Entry:</h5>
                                            <p><strong>Secret Key:</strong></p>
                                            <code><?php echo $secret_key ?></code>
                                            
                                            <form id="verify-2fa-form" class="mt-3">
                                                <div class="form-group">
                                                    <label>Enter 6-digit code from your app:</label>
                                                    <input type="text" class="form-control" name="verification_code" maxlength="6" required>
                                                </div>
                                                <button type="submit" class="btn btn-success">
                                                    <i class="fas fa-check"></i> Enable 2FA
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                <?php else: ?>
                                    <div class="alert alert-success">
                                        <h5><i class="icon fas fa-check"></i> 2FA is Active!</h5>
                                        Your account is protected with Two-Factor Authentication.
                                    </div>
                                    
                                    <button class="btn btn-danger" id="disable-2fa">
                                        <i class="fas fa-times"></i> Disable 2FA
                                    </button>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    
    <?php include 'footer.php' ?>
</div>

<script src="../assets/plugins/jquery/jquery.min.js"></script>
<script src="../assets/dist/js/adminlte.min.js"></script>

<script>
$(document).ready(function(){
    $('#verify-2fa-form').submit(function(e){
        e.preventDefault();
        $.ajax({
            url: '../ajax.php?action=enable_2fa',
            method: 'POST',
            data: $(this).serialize(),
            success: function(resp){
                if(resp == 1){
                    alert('2FA enabled successfully!');
                    location.reload();
                } else {
                    alert('Invalid verification code. Please try again.');
                }
            }
        });
    });
    
    $('#disable-2fa').click(function(){
        if(confirm('Are you sure you want to disable 2FA? This will make your account less secure.')){
            $.ajax({
                url: '../ajax.php?action=disable_2fa',
                method: 'POST',
                success: function(resp){
                    if(resp == 1){
                        alert('2FA disabled successfully.');
                        location.reload();
                    }
                }
            });
        }
    });
});
</script>

</body>
</html>
