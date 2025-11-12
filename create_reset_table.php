<?php
include 'db_connect.php';

echo "<h2>Creating Password Reset Table</h2>";

$sql = "CREATE TABLE IF NOT EXISTS password_reset_attempts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    ip_address VARCHAR(45) NOT NULL,
    email VARCHAR(255) NOT NULL,
    attempt_time DATETIME NOT NULL,
    INDEX(ip_address, attempt_time)
)";

if ($conn->query($sql) === TRUE) {
    echo "<p>✅ Table 'password_reset_attempts' created successfully!</p>";
} else {
    echo "<p>❌ Error creating table: " . $conn->error . "</p>";
}

echo "<p><a href='test_forgot_password.php'>← Back to Testing Guide</a></p>";
?>
