<?php
// Email Configuration for Forgot Password
define('SMTP_HOST', 'smtp.gmail.com');
define('SMTP_PORT', 587);
define('SMTP_USERNAME', 'evalfaculty@gmail.com');
define('SMTP_PASSWORD', 'gzdz czcv zknu alim');
define('SMTP_ENCRYPTION', 'tls');
define('FROM_EMAIL', 'evalfaculty@gmail.com');
define('FROM_NAME', 'Faculty Evaluation System');

// Password reset settings
define('MAX_RESET_ATTEMPTS_PER_HOUR', 5);
define('RESET_TOKEN_EXPIRY_HOURS', 1);
?>