<?php
echo "<h2>Setting up PHPMailer for Forgot Password</h2>";

// Check if composer.json exists
if(file_exists('composer.json')) {
    echo "<p>✓ Composer.json found</p>";
} else {
    echo "<p>❌ Composer.json not found. Creating one...</p>";
    
    $composer_config = [
        "require" => [
            "phpmailer/phpmailer" => "^6.8"
        ]
    ];
    
    file_put_contents('composer.json', json_encode($composer_config, JSON_PRETTY_PRINT));
    echo "<p>✓ Composer.json created</p>";
}

echo "<h3>Next Steps:</h3>";
echo "<ol>";
echo "<li><strong>Install PHPMailer:</strong> Run <code>composer install</code> in your project directory</li>";
echo "<li><strong>Configure Email:</strong> I'll create the email configuration file</li>";
echo "<li><strong>Add Backend Handler:</strong> I'll add the forgot password functionality to ajax.php</li>";
echo "</ol>";

echo "<p><strong>After running 'composer install', click <a href='configure_email.php'>here to configure email settings</a></strong></p>";
?>