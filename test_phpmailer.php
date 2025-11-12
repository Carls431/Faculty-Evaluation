<?php
// Test PHPMailer installation and configuration
echo "<h2>🔧 PHPMailer Diagnostic Test</h2>";

// Test 1: Check if vendor/autoload.php exists
echo "<h3>Step 1: Autoloader Check</h3>";
if (file_exists('vendor/autoload.php')) {
    require_once 'vendor/autoload.php';
    echo "<p>✅ Composer autoloader found</p>";
} else {
    echo "<p>❌ Composer autoloader missing</p>";
}

// Test 2: Check PHPMailer classes
echo "<h3>Step 2: PHPMailer Classes</h3>";
try {
    $classes = [
        'PHPMailer\PHPMailer\PHPMailer',
        'PHPMailer\PHPMailer\SMTP',
        'PHPMailer\PHPMailer\Exception'
    ];
    
    foreach ($classes as $class) {
        if (class_exists($class)) {
            echo "<p>✅ $class - Available</p>";
        } else {
            echo "<p>❌ $class - Missing</p>";
        }
    }
} catch (Exception $e) {
    echo "<p>❌ Error loading PHPMailer: " . $e->getMessage() . "</p>";
}

// Test 3: Check email configuration
echo "<h3>Step 3: Email Configuration</h3>";
if (file_exists('email_config_secure.php')) {
    include 'email_config_secure.php';
    echo "<p>✅ Email config loaded</p>";
    echo "<ul>";
    echo "<li>SMTP Host: " . (defined('SMTP_HOST') ? SMTP_HOST : 'NOT SET') . "</li>";
    echo "<li>SMTP Port: " . (defined('SMTP_PORT') ? SMTP_PORT : 'NOT SET') . "</li>";
    echo "<li>Username: " . (defined('SMTP_USERNAME') ? SMTP_USERNAME : 'NOT SET') . "</li>";
    echo "<li>Password: " . (defined('SMTP_PASSWORD') ? (strlen(SMTP_PASSWORD) > 0 ? 'SET (' . strlen(SMTP_PASSWORD) . ' chars)' : 'NOT SET') : 'NOT SET') . "</li>";
    echo "</ul>";
} else {
    echo "<p>❌ Email configuration file missing</p>";
}

// Test 4: Simple PHPMailer test
echo "<h3>Step 4: PHPMailer Initialization Test</h3>";
try {
    if (class_exists('PHPMailer\PHPMailer\PHPMailer')) {
        $mail = new PHPMailer\PHPMailer\PHPMailer(true);
        echo "<p>✅ PHPMailer object created successfully</p>";
        
        // Test SMTP configuration
        $mail->isSMTP();
        $mail->Host = defined('SMTP_HOST') ? SMTP_HOST : 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = defined('SMTP_USERNAME') ? SMTP_USERNAME : '';
        $mail->Password = defined('SMTP_PASSWORD') ? SMTP_PASSWORD : '';
        $mail->SMTPSecure = defined('SMTP_ENCRYPTION') ? SMTP_ENCRYPTION : 'tls';
        $mail->Port = defined('SMTP_PORT') ? SMTP_PORT : 587;
        
        echo "<p>✅ SMTP configuration applied</p>";
        
    } else {
        echo "<p>❌ PHPMailer class not available</p>";
    }
} catch (Exception $e) {
    echo "<p>❌ PHPMailer test failed: " . $e->getMessage() . "</p>";
}

// Test 5: Check if we can send a test email (dry run)
echo "<h3>Step 5: Email Send Test (Dry Run)</h3>";
if (defined('SMTP_USERNAME') && defined('SMTP_PASSWORD') && 
    strlen(SMTP_USERNAME) > 0 && strlen(SMTP_PASSWORD) > 0) {
    echo "<p>✅ SMTP credentials configured</p>";
    echo "<p>🔗 <a href='send_test_email.php' target='_blank'>Click here to send actual test email</a></p>";
} else {
    echo "<p>❌ SMTP credentials missing or incomplete</p>";
    echo "<div style='background: #fff3cd; padding: 15px; border-left: 4px solid #ffc107; margin: 10px 0;'>";
    echo "<h4>To fix email issues:</h4>";
    echo "<ol>";
    echo "<li>Make sure Gmail 2-factor authentication is enabled</li>";
    echo "<li>Generate an App Password in Gmail settings</li>";
    echo "<li>Update email_config_secure.php with correct credentials</li>";
    echo "<li>Or create a .env file with your settings</li>";
    echo "</ol>";
    echo "</div>";
}

echo "<p><a href='test_forgot_password.php'>← Back to Testing Guide</a></p>";
?>
