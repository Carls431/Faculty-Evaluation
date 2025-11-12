<?php
if(isset($_POST['save_config'])) {
    $config = "<?php
// Email Configuration for Forgot Password
define('SMTP_HOST', '{$_POST['smtp_host']}');
define('SMTP_PORT', {$_POST['smtp_port']});
define('SMTP_USERNAME', '{$_POST['smtp_username']}');
define('SMTP_PASSWORD', '{$_POST['smtp_password']}');
define('SMTP_ENCRYPTION', '{$_POST['smtp_encryption']}');
define('FROM_EMAIL', '{$_POST['from_email']}');
define('FROM_NAME', '{$_POST['from_name']}');
?>";
    
    file_put_contents('email_config_forgot.php', $config);
    echo "<div class='alert alert-success'>✓ Email configuration saved! <a href='test_forgot_password.php'>Test it now</a></div>";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Configure Email for Forgot Password</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2>Configure Email Settings</h2>
    <form method="POST">
        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <label>SMTP Host</label>
                    <input type="text" name="smtp_host" class="form-control" placeholder="smtp.gmail.com" required>
                    <small class="text-muted">For Gmail: smtp.gmail.com</small>
                </div>
                
                <div class="mb-3">
                    <label>SMTP Port</label>
                    <input type="number" name="smtp_port" class="form-control" value="587" required>
                    <small class="text-muted">587 for TLS, 465 for SSL</small>
                </div>
                
                <div class="mb-3">
                    <label>SMTP Username (Email)</label>
                    <input type="email" name="smtp_username" class="form-control" placeholder="your-email@gmail.com" required>
                </div>
                
                <div class="mb-3">
                    <label>SMTP Password</label>
                    <input type="password" name="smtp_password" class="form-control" placeholder="Your app password" required>
                    <small class="text-muted">For Gmail, use App Password, not regular password</small>
                </div>
            </div>
            
            <div class="col-md-6">
                <div class="mb-3">
                    <label>Encryption</label>
                    <select name="smtp_encryption" class="form-control" required>
                        <option value="tls">TLS</option>
                        <option value="ssl">SSL</option>
                    </select>
                </div>
                
                <div class="mb-3">
                    <label>From Email</label>
                    <input type="email" name="from_email" class="form-control" placeholder="noreply@yourschool.com" required>
                </div>
                
                <div class="mb-3">
                    <label>From Name</label>
                    <input type="text" name="from_name" class="form-control" value="Faculty Evaluation System" required>
                </div>
                
                <button type="submit" name="save_config" class="btn btn-primary">Save Configuration</button>
            </div>
        </div>
    </form>
    
    <div class="mt-4">
        <h4>Gmail Setup Instructions:</h4>
        <ol>
            <li>Go to your Google Account settings</li>
            <li>Enable 2-Factor Authentication</li>
            <li>Generate an "App Password" for this application</li>
            <li>Use the App Password in the SMTP Password field above</li>
        </ol>
    </div>
</div>
</body>
</html>