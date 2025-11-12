<?php
// Secure Email Configuration for Forgot Password
// Load from environment variables or use defaults

function loadEmailConfig() {
    // Try to load from .env file if it exists
    $envFile = __DIR__ . '/.env';
    if (file_exists($envFile)) {
        $lines = file($envFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        foreach ($lines as $line) {
            if (strpos($line, '=') !== false && strpos($line, '#') !== 0) {
                list($key, $value) = explode('=', $line, 2);
                $_ENV[trim($key)] = trim($value);
            }
        }
    }
    
    // Define constants with fallbacks
    define('SMTP_HOST', $_ENV['SMTP_HOST'] ?? 'smtp.gmail.com');
    define('SMTP_PORT', $_ENV['SMTP_PORT'] ?? 587);
    define('SMTP_USERNAME', $_ENV['SMTP_USERNAME'] ?? 'evalfaculty@gmail.com');
    define('SMTP_PASSWORD', $_ENV['SMTP_PASSWORD'] ?? 'gzdz czcv zknu alim');
    define('SMTP_ENCRYPTION', $_ENV['SMTP_ENCRYPTION'] ?? 'tls');
    define('FROM_EMAIL', $_ENV['FROM_EMAIL'] ?? 'evalfaculty@gmail.com');
    define('FROM_NAME', $_ENV['FROM_NAME'] ?? 'Faculty Evaluation System');
    define('RESET_TOKEN_EXPIRY_HOURS', $_ENV['RESET_TOKEN_EXPIRY_HOURS'] ?? 1);
    define('MAX_RESET_ATTEMPTS_PER_HOUR', $_ENV['MAX_RESET_ATTEMPTS_PER_HOUR'] ?? 3);
}

// Load configuration
loadEmailConfig();
?>
