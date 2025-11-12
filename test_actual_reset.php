<?php
// Quick test to verify the actual password reset process
require_once 'db_connect.php';

echo "<h2>Password Reset Database Test</h2>";

// Check if users table has reset columns
$result = $conn->query("DESCRIBE users");
echo "<h3>Users table structure:</h3>";
echo "<table border='1'>";
echo "<tr><th>Field</th><th>Type</th><th>Null</th><th>Key</th><th>Default</th></tr>";
while($row = $result->fetch_assoc()) {
    echo "<tr>";
    echo "<td>" . $row['Field'] . "</td>";
    echo "<td>" . $row['Type'] . "</td>";
    echo "<td>" . $row['Null'] . "</td>";
    echo "<td>" . $row['Key'] . "</td>";
    echo "<td>" . $row['Default'] . "</td>";
    echo "</tr>";
}
echo "</table>";

// Check if there are any admin users
$result = $conn->query("SELECT id, email, firstname, lastname FROM users LIMIT 5");
echo "<h3>Available admin users:</h3>";
echo "<table border='1'>";
echo "<tr><th>ID</th><th>Email</th><th>Name</th></tr>";
while($row = $result->fetch_assoc()) {
    echo "<tr>";
    echo "<td>" . $row['id'] . "</td>";
    echo "<td>" . $row['email'] . "</td>";
    echo "<td>" . $row['firstname'] . " " . $row['lastname'] . "</td>";
    echo "</tr>";
}
echo "</table>";

echo "<h3>Next Steps:</h3>";
echo "<ol>";
echo "<li>Go to: <a href='index.php?page=forgot_password' target='_blank'>Forgot Password Page</a></li>";
echo "<li>Enter one of the emails above</li>";
echo "<li>Check your Gmail for the reset link</li>";
echo "<li>Click the reset link and set new password</li>";
echo "</ol>";
?>
