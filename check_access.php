<?php
/**
 * System Access Control
 * Checks if the system has been unlocked via CLI script
 */

function checkSystemAccess() {
    $access_file = __DIR__ . '/.system_access';
    
    // Check if access token file exists
    if (!file_exists($access_file)) {
        // System is locked
        showAccessDenied();
        exit();
    }
    
    // Optional: Check if file is recent (within last 24 hours)
    $file_time = filemtime($access_file);
    $current_time = time();
    $time_diff = $current_time - $file_time;
    
    // If file is older than 24 hours, require re-authentication
    if ($time_diff > 86400) { // 86400 seconds = 24 hours
        unlink($access_file); // Delete old token
        showAccessDenied();
        exit();
    }
    
    // Access granted - system is unlocked
    return true;
}

function showAccessDenied() {
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>System Locked - Faculty Evaluation System</title>
        <style>
            * {
                margin: 0;
                padding: 0;
                box-sizing: border-box;
            }
            
            body {
                font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
                background: linear-gradient(135deg, #800000 0%, #a52a2a 50%, #8b0000 100%);
                min-height: 100vh;
                display: flex;
                justify-content: center;
                align-items: center;
                color: white;
            }
            
            .lock-container {
                text-align: center;
                background: rgba(255, 255, 255, 0.1);
                backdrop-filter: blur(10px);
                padding: 60px 80px;
                border-radius: 20px;
                box-shadow: 0 8px 32px rgba(0, 0, 0, 0.3);
                border: 1px solid rgba(255, 255, 255, 0.2);
                max-width: 600px;
            }
            
            .lock-icon {
                font-size: 100px;
                margin-bottom: 30px;
                animation: pulse 2s infinite;
            }
            
            @keyframes pulse {
                0%, 100% { transform: scale(1); }
                50% { transform: scale(1.1); }
            }
            
            h1 {
                font-size: 36px;
                margin-bottom: 20px;
                font-weight: 600;
            }
            
            .message {
                font-size: 18px;
                line-height: 1.6;
                margin-bottom: 30px;
                opacity: 0.9;
            }
            
            .instructions {
                background: rgba(255, 255, 255, 0.15);
                padding: 25px;
                border-radius: 10px;
                margin-top: 30px;
                text-align: left;
            }
            
            .instructions h3 {
                margin-bottom: 15px;
                font-size: 20px;
            }
            
            .instructions ol {
                margin-left: 20px;
                line-height: 2;
            }
            
            .instructions li {
                margin-bottom: 10px;
            }
            
            .code {
                background: rgba(0, 0, 0, 0.3);
                padding: 8px 15px;
                border-radius: 5px;
                font-family: 'Courier New', monospace;
                display: inline-block;
                margin-top: 5px;
                font-size: 16px;
                color: #ffd700;
            }
            
            .warning {
                margin-top: 20px;
                padding: 15px;
                background: rgba(255, 0, 0, 0.2);
                border-left: 4px solid #ff0000;
                border-radius: 5px;
                font-size: 14px;
            }
        </style>
    </head>
    <body>
        <div class="lock-container">
            <div class="lock-icon">🔒</div>
            <h1>System Locked</h1>
            <p class="message">
                The Faculty Evaluation System is currently locked.<br>
                Access is restricted to authorized personnel only.
            </p>
            
            <div class="warning">
                📞 <strong>Contact the Developer to Unlock the System</strong><br>09169035405<br>carlcabrera@gmail.com<br>
                This system can only be unlocked by the authorized developer.<br>
                Please contact the system administrator for access.
            </div>
        </div>
    </body>
    </html>
    <?php
}

// Run the access check
checkSystemAccess();
?>
