<?php
// Debug token validation issue
include 'db_connect.php';

echo "<h2>🔍 Token Validation Debug</h2>";

// Get the token from URL (simulate clicking email link)
$token = isset($_GET['token']) ? $_GET['token'] : '';

if (!$token) {
    echo "<p>❌ No token provided in URL</p>";
    echo "<p>Add ?token=your_token_here to test</p>";
    exit;
}

echo "<p><strong>Token:</strong> $token</p>";

// Check if token exists in database
echo "<h3>Step 1: Check Token in Database</h3>";
$stmt = $conn->prepare("SELECT id, email, firstname, lastname, reset_token, reset_expires FROM users WHERE reset_token = ?");
$stmt->bind_param("s", $token);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
    echo "<p>✅ Token found in database</p>";
    echo "<ul>";
    echo "<li>User: " . $user['firstname'] . " " . $user['lastname'] . "</li>";
    echo "<li>Email: " . $user['email'] . "</li>";
    echo "<li>Token: " . substr($user['reset_token'], 0, 20) . "...</li>";
    echo "<li>Expires: " . $user['reset_expires'] . "</li>";
    echo "</ul>";
    
    // Check if token is expired
    echo "<h3>Step 2: Check Token Expiry</h3>";
    $now = date('Y-m-d H:i:s');
    echo "<p>Current time: $now</p>";
    echo "<p>Token expires: " . $user['reset_expires'] . "</p>";
    
    if ($user['reset_expires'] > $now) {
        echo "<p>✅ Token is still valid</p>";
    } else {
        echo "<p>❌ Token has expired</p>";
        $time_diff = strtotime($now) - strtotime($user['reset_expires']);
        echo "<p>Expired " . round($time_diff/60) . " minutes ago</p>";
    }
    
} else {
    echo "<p>❌ Token not found in database</p>";
    
    // Check if there are any tokens at all
    $all_tokens = $conn->query("SELECT COUNT(*) as count FROM users WHERE reset_token IS NOT NULL");
    $count = $all_tokens->fetch_assoc()['count'];
    echo "<p>Total tokens in database: $count</p>";
    
    if ($count > 0) {
        echo "<p>Recent tokens:</p>";
        $recent = $conn->query("SELECT email, reset_expires, SUBSTRING(reset_token, 1, 20) as token_start FROM users WHERE reset_token IS NOT NULL ORDER BY reset_expires DESC LIMIT 3");
        while ($row = $recent->fetch_assoc()) {
            echo "<p>- " . $row['email'] . ": " . $row['token_start'] . "... (expires: " . $row['reset_expires'] . ")</p>";
        }
    }
}

// Test the exact validation logic from reset_password.php
echo "<h3>Step 3: Test Validation Logic</h3>";
$stmt2 = $conn->prepare("SELECT * FROM users WHERE reset_token = ? AND reset_expires > NOW()");
$stmt2->bind_param("s", $token);
$stmt2->execute();
$validation_result = $stmt2->get_result();

if ($validation_result->num_rows > 0) {
    echo "<p>✅ Token passes validation (valid and not expired)</p>";
} else {
    echo "<p>❌ Token fails validation</p>";
}

echo "<p><a href='index.php?page=reset_password&token=$token'>🔗 Test Reset Password Page</a></p>";
?>
