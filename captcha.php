<?php
session_start();

// Predefined CAPTCHA codes
$captcha_codes = array('T6yQ', 'h9P2', 'R3nX', 'Z8kL', 'b7D4', 'W2mQ', 'p6V9', 'C4zK','Dongai');

// Select a random code from the predefined list
$random_string = $captcha_codes[array_rand($captcha_codes)];

// Store the CAPTCHA code in the session
$_SESSION['captcha_code'] = $random_string;

// Check if GD extension is available
if (extension_loaded('gd')) {
    // Create an image using GD
    $image = imagecreatetruecolor(120, 40);
    
    // Define colors
    $bg_color = imagecolorallocate($image, 255, 255, 255); // White background
    $text_color = imagecolorallocate($image, 50, 50, 50);   // Dark grey text
    $noise_color = imagecolorallocate($image, 150, 150, 150); // Light grey noise
    
    // Fill the background
    imagefilledrectangle($image, 0, 0, 120, 40, $bg_color);
    
    // Add some noise (lines)
    for ($i = 0; $i < 5; $i++) {
        imageline($image, 0, rand() % 40, 120, rand() % 40, $noise_color);
    }
    
    // Add some noise (dots)
    for ($i = 0; $i < 500; $i++) {
        imagesetpixel($image, rand() % 120, rand() % 40, $noise_color);
    }
    
    // Use built-in font
    imagestring($image, 5, 20, 10, $random_string, $text_color);
    
    // Set the content type header and output the image
    header('Content-Type: image/png');
    imagepng($image);
    
    // Free up memory
    imagedestroy($image);
} else {
    // Fallback: Create a simple SVG image if GD is not available
    header('Content-Type: image/svg+xml');
    echo '<?xml version="1.0" encoding="UTF-8"?>
    <svg width="120" height="40" xmlns="http://www.w3.org/2000/svg">
        <rect width="120" height="40" fill="white" stroke="gray" stroke-width="1"/>
        <text x="10" y="25" font-family="Arial" font-size="16" fill="black">' . $random_string . '</text>
        <line x1="0" y1="10" x2="120" y2="30" stroke="lightgray" stroke-width="1"/>
        <line x1="0" y1="30" x2="120" y2="10" stroke="lightgray" stroke-width="1"/>
    </svg>';
}
?>
