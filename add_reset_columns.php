<?php
include 'db_connect.php';

echo "<h2>Adding Password Reset Columns</h2>";

// Add reset columns to users table
$add_columns = "ALTER TABLE users 
                ADD COLUMN reset_token VARCHAR(64) NULL,
                ADD COLUMN reset_expires DATETIME NULL";

if($conn->query($add_columns)) {
    echo "<p>✓ Password reset columns added successfully!</p>";
} else {
    echo "<p>❌ Error: " . $conn->error . "</p>";
}

echo "<p><a href='setup_phpmailer.php'>← Back to setup</a></p>";
?>