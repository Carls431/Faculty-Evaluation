<?php
// Test script for forgot password functionality
include 'db_connect.php';

echo "<h2>🧪 Forgot Password Testing Guide</h2>";

// Check admin users
echo "<h3>📋 Step 1: Available Admin Accounts</h3>";
$result = $conn->query("SELECT email, firstname, lastname FROM users");
if ($result->num_rows > 0) {
    echo "<table border='1' style='border-collapse: collapse; margin: 10px 0;'>";
    echo "<tr><th>Email</th><th>Name</th><th>Status</th></tr>";
    while($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row['email'] . "</td>";
        echo "<td>" . $row['firstname'] . " " . $row['lastname'] . "</td>";
        echo "<td>✅ Ready for testing</td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "<p>❌ No admin users found!</p>";
}

// Check email configuration
echo "<h3>📧 Step 2: Email Configuration Status</h3>";
if (file_exists('email_config_secure.php')) {
    include 'email_config_secure.php';
    echo "<p>✅ Email config loaded</p>";
    echo "<ul>";
    echo "<li><strong>SMTP Host:</strong> " . SMTP_HOST . "</li>";
    echo "<li><strong>SMTP Port:</strong> " . SMTP_PORT . "</li>";
    echo "<li><strong>From Email:</strong> " . FROM_EMAIL . "</li>";
    echo "<li><strong>Rate Limit:</strong> " . MAX_RESET_ATTEMPTS_PER_HOUR . " attempts per hour</li>";
    echo "</ul>";
} else {
    echo "<p>❌ Email configuration missing!</p>";
}

// Check database structure
echo "<h3>🗄️ Step 3: Database Structure</h3>";
$tables_check = [
    'users' => "SELECT COUNT(*) as count FROM users",
    'password_reset_attempts' => "SELECT COUNT(*) as count FROM password_reset_attempts"
];

foreach ($tables_check as $table => $query) {
    $result = $conn->query($query);
    if ($result) {
        $count = $result->fetch_assoc()['count'];
        echo "<p>✅ Table '$table' exists ($count records)</p>";
    } else {
        if ($table == 'password_reset_attempts') {
            echo "<p>⚠️ Table '$table' will be created automatically on first use</p>";
        } else {
            echo "<p>❌ Table '$table' missing!</p>";
        }
    }
}

echo "<h3>🚀 Step 4: Testing Instructions</h3>";
echo "<div style='background: #f0f8ff; padding: 15px; border-left: 4px solid #007cba; margin: 10px 0;'>";
echo "<h4>Manual Testing Steps:</h4>";
echo "<ol>";
echo "<li><strong>Go to Admin Login:</strong> <a href='index.php?page=login' target='_blank'>index.php?page=login</a></li>";
echo "<li><strong>Click 'Forgot Password'</strong></li>";
echo "<li><strong>Enter admin email:</strong> Use one from the table above</li>";
echo "<li><strong>Click 'Send Reset Link'</strong></li>";
echo "<li><strong>Check your email</strong> (may take a few minutes)</li>";
echo "<li><strong>Click the reset link</strong> in the email</li>";
echo "<li><strong>Set new password</strong> (min 8 chars, uppercase, lowercase, number)</li>";
echo "<li><strong>Login with new password</strong></li>";
echo "</ol>";
echo "</div>";

echo "<h3>🔧 Step 5: Troubleshooting</h3>";
echo "<div style='background: #fff3cd; padding: 15px; border-left: 4px solid #ffc107; margin: 10px 0;'>";
echo "<h4>If email doesn't arrive:</h4>";
echo "<ul>";
echo "<li>Check spam/junk folder</li>";
echo "<li>Verify SMTP credentials in email_config_secure.php</li>";
echo "<li>Check server error logs</li>";
echo "<li>Try with a different email provider</li>";
echo "</ul>";
echo "</div>";

echo "<h3>🧪 Step 6: Quick Test Links</h3>";
echo "<p><a href='index.php?page=forgot_password' target='_blank' style='background: #007cba; color: white; padding: 10px 15px; text-decoration: none; border-radius: 5px;'>🔗 Test Forgot Password Page</a></p>";
echo "<p><a href='index.php?page=login' target='_blank' style='background: #28a745; color: white; padding: 10px 15px; text-decoration: none; border-radius: 5px;'>🔗 Go to Admin Login</a></p>";

?>
