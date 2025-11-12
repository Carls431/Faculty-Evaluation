<?php
include 'db_connect.php';

echo "<h2>🧹 Clear Rate Limiting</h2>";

// Clear all rate limiting attempts
$result = $conn->query("DELETE FROM password_reset_attempts");
echo "<p>✅ All rate limiting cleared</p>";

// Check current attempts
$count = $conn->query("SELECT COUNT(*) as count FROM password_reset_attempts")->fetch_assoc()['count'];
echo "<p>Current attempts in database: $count</p>";

// Generate fresh token
$email = 'evalfaculty@gmail.com';
$token = bin2hex(random_bytes(32));
$expires = date('Y-m-d H:i:s', strtotime('+1 hour'));

$stmt = $conn->prepare("UPDATE users SET reset_token = ?, reset_expires = ? WHERE email = ?");
$stmt->bind_param("sss", $token, $expires, $email);
$stmt->execute();

echo "<p>✅ Fresh reset token generated</p>";
echo "<p><strong>Token expires:</strong> $expires</p>";

echo "<div style='background: #e7f3ff; padding: 15px; border-left: 4px solid #2196F3; margin: 20px 0;'>";
echo "<h3>🧪 Test Steps:</h3>";
echo "<ol>";
echo "<li><a href='index.php?page=forgot_password' target='_blank'>Go to Forgot Password</a></li>";
echo "<li>Enter: evalfaculty@gmail.com</li>";
echo "<li>Click Send Reset Link</li>";
echo "<li>Check Gmail inbox AND spam folder</li>";
echo "</ol>";
echo "</div>";

echo "<div style='background: #fff3cd; padding: 15px; border-left: 4px solid #ffc107; margin: 20px 0;'>";
echo "<h3>⚠️ Gmail Issues:</h3>";
echo "<ul>";
echo "<li>Gmail may take 1-2 minutes to deliver</li>";
echo "<li>Check spam/junk folder thoroughly</li>";
echo "<li>Check 'All Mail' folder</li>";
echo "<li>Check 'Promotions' tab</li>";
echo "<li>Try with different email provider if available</li>";
echo "</ul>";
echo "</div>";
?>
