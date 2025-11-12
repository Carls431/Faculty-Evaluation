<?php
include 'db_connect.php';

echo "<h2>🔍 Database Token Check</h2>";

// Check all users and their reset tokens
$result = $conn->query("SELECT id, email, firstname, lastname, reset_token, reset_expires FROM users");

echo "<h3>All Users in Database:</h3>";
echo "<table border='1' style='border-collapse: collapse;'>";
echo "<tr><th>ID</th><th>Email</th><th>Name</th><th>Reset Token</th><th>Expires</th><th>Status</th></tr>";

while($row = $result->fetch_assoc()) {
    echo "<tr>";
    echo "<td>" . $row['id'] . "</td>";
    echo "<td>" . $row['email'] . "</td>";
    echo "<td>" . $row['firstname'] . " " . $row['lastname'] . "</td>";
    
    if($row['reset_token']) {
        echo "<td>" . substr($row['reset_token'], 0, 20) . "...</td>";
        echo "<td>" . $row['reset_expires'] . "</td>";
        
        // Check if expired
        $now = date('Y-m-d H:i:s');
        if($row['reset_expires'] > $now) {
            echo "<td style='color: green;'>✅ Valid</td>";
        } else {
            echo "<td style='color: red;'>❌ Expired</td>";
        }
    } else {
        echo "<td>No token</td>";
        echo "<td>-</td>";
        echo "<td>-</td>";
    }
    echo "</tr>";
}
echo "</table>";

// Generate a fresh token for testing
echo "<h3>Generate Fresh Token for Testing:</h3>";
$email = 'evalfaculty@gmail.com';
$token = bin2hex(random_bytes(32));
$expires = date('Y-m-d H:i:s', strtotime('+1 hour'));

$stmt = $conn->prepare("UPDATE users SET reset_token = ?, reset_expires = ? WHERE email = ?");
$stmt->bind_param("sss", $token, $expires, $email);
$stmt->execute();

echo "<p>✅ Fresh token generated for $email</p>";
echo "<p><strong>Token:</strong> $token</p>";
echo "<p><strong>Expires:</strong> $expires</p>";

$test_link = "http://localhost/eval/index.php?page=reset_password&token=" . $token;
echo "<p><a href='$test_link' target='_blank' style='background: #007cba; color: white; padding: 10px 15px; text-decoration: none; border-radius: 5px;'>🔗 Test Reset Link</a></p>";

echo "<h3>Test Token Validation:</h3>";
// Test with PHP time instead of MySQL NOW()
$current_time = date('Y-m-d H:i:s');
$stmt2 = $conn->prepare("SELECT * FROM users WHERE reset_token = ? AND reset_expires > ?");
$stmt2->bind_param("ss", $token, $current_time);
$stmt2->execute();
$validation = $stmt2->get_result();

echo "<p>Current PHP time: $current_time</p>";
if($validation->num_rows > 0) {
    echo "<p>✅ Token validation successful</p>";
} else {
    echo "<p>❌ Token validation failed</p>";
}
?>
