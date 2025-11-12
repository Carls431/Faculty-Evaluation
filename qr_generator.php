<?php
session_start();
include('./db_connect.php');

$system = $conn->query("SELECT * FROM system_settings")->fetch_array();
foreach ($system as $k => $v) {
    $_SESSION['system'][$k] = $v;
}

// Get server URL - now points to device choice page
$protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http';
$host = $_SERVER['HTTP_HOST'];
$choice_url = $protocol . '://' . $host . dirname($_SERVER['REQUEST_URI']) . '/device_choice.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Evaluation QR Code Generator</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            padding: 20px;
        }
        
        .qr-container {
            max-width: 800px;
            margin: 0 auto;
            background: white;
            border-radius: 20px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }
        
        .header-section {
            background: linear-gradient(135deg, #800000, #a52a2a);
            color: white;
            padding: 30px;
            text-align: center;
        }
        
        .header-section h1 {
            font-size: 28px;
            font-weight: 700;
            margin-bottom: 10px;
        }
        
        .header-section p {
            font-size: 16px;
            opacity: 0.9;
            margin: 0;
        }
        
        .content-section {
            padding: 40px;
        }
        
        .qr-display {
            text-align: center;
            margin-bottom: 30px;
        }
        
        .qr-code-container {
            display: inline-block;
            padding: 20px;
            background: #f8f9fa;
            border-radius: 15px;
            border: 3px dashed #800000;
            margin-bottom: 20px;
        }
        
        .qr-code {
            width: 250px;
            height: 250px;
            border: none;
        }
        
        .url-display {
            background: #f8f9fa;
            padding: 15px;
            border-radius: 10px;
            border-left: 4px solid #800000;
            margin-bottom: 20px;
        }
        
        .url-display strong {
            color: #800000;
        }
        
        .url-text {
            font-family: 'Courier New', monospace;
            font-size: 14px;
            color: #333;
            word-break: break-all;
        }
        
        .btn-custom {
            background: linear-gradient(135deg, #800000, #a52a2a);
            border: none;
            color: white;
            padding: 12px 25px;
            border-radius: 25px;
            font-weight: 600;
            transition: all 0.3s ease;
            margin: 5px;
        }
        
        .btn-custom:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(128, 0, 0, 0.3);
            color: white;
        }
        
        .instructions {
            background: linear-gradient(135deg, #e3f2fd, #bbdefb);
            padding: 25px;
            border-radius: 15px;
            margin-bottom: 30px;
        }
        
        .instructions h4 {
            color: #1565c0;
            font-weight: 600;
            margin-bottom: 15px;
        }
        
        .instructions ol {
            color: #333;
            line-height: 1.8;
        }
        
        .instructions li {
            margin-bottom: 8px;
        }
        
        .features {
            background: linear-gradient(135deg, #f3e5f5, #e1bee7);
            padding: 25px;
            border-radius: 15px;
            margin-bottom: 30px;
        }
        
        .features h4 {
            color: #7b1fa2;
            font-weight: 600;
            margin-bottom: 15px;
        }
        
        .feature-item {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
            color: #333;
        }
        
        .feature-item i {
            color: #7b1fa2;
            margin-right: 10px;
            width: 20px;
        }
        
        .back-btn {
            position: absolute;
            top: 20px;
            left: 20px;
            background: rgba(255, 255, 255, 0.2);
            border: 1px solid rgba(255, 255, 255, 0.3);
            color: white;
            padding: 10px 15px;
            border-radius: 25px;
            text-decoration: none;
            transition: all 0.3s ease;
        }
        
        .back-btn:hover {
            background: rgba(255, 255, 255, 0.3);
            color: white;
            text-decoration: none;
        }
        
        .copy-notification {
            position: fixed;
            top: 20px;
            right: 20px;
            background: #28a745;
            color: white;
            padding: 15px 20px;
            border-radius: 10px;
            display: none;
            z-index: 1000;
            animation: slideIn 0.3s ease;
        }
        
        @keyframes slideIn {
            from {
                transform: translateX(100%);
                opacity: 0;
            }
            to {
                transform: translateX(0);
                opacity: 1;
            }
        }
        
        @media (max-width: 768px) {
            .content-section {
                padding: 20px;
            }
            
            .qr-code {
                width: 200px;
                height: 200px;
            }
            
            .header-section {
                padding: 20px;
            }
            
            .header-section h1 {
                font-size: 24px;
            }
        }
    </style>
</head>
<body>
    <div class="qr-container">
        <div class="header-section">
            <h1><i class="fas fa-qrcode"></i> Student Evaluation QR Code</h1>
            <p>QR code for students to choose their device and access evaluations</p>
        </div>
        
        <div class="content-section">
            <div class="qr-display">
                <div class="qr-code-container">
                    <img src="https://api.qrserver.com/v1/create-qr-code/?size=250x250&data=<?php echo urlencode($choice_url); ?>&bgcolor=ffffff&color=800000" 
                         alt="Student Evaluation QR Code" class="qr-code">
                </div>
                
                <div class="url-display">
                    <strong>Student Access URL:</strong><br>
                    <span class="url-text" id="choice-url"><?php echo $choice_url; ?></span>
                </div>
                
                <button class="btn btn-custom" onclick="copyURL()">
                    <i class="fas fa-copy"></i> Copy URL
                </button>
                
                <button class="btn btn-custom" onclick="downloadQR()">
                    <i class="fas fa-download"></i> Download QR Code
                </button>
                
                <button class="btn btn-custom" onclick="printQR()">
                    <i class="fas fa-print"></i> Print QR Code
                </button>
            </div>
            
            <div class="instructions">
                <h4><i class="fas fa-info-circle"></i> How to Use</h4>
                <ol>
                    <li><strong>Display the QR Code:</strong> Show this QR code on a screen, poster, or printed material</li>
                    <li><strong>Students Scan:</strong> Students use their phone camera or QR scanner app to scan the code</li>
                    <li><strong>Choose Device:</strong> Students will see a choice page to select Mobile or Desktop interface</li>
                    <li><strong>Login Process:</strong> Students enter their credentials and receive OTP via email</li>
                    <li><strong>Access Evaluations:</strong> After verification, students can access and complete evaluations</li>
                </ol>
            </div>
            
            <div class="features">
                <h4><i class="fas fa-star"></i> Student Benefits</h4>
                <div class="feature-item">
                    <i class="fas fa-mobile-alt"></i>
                    <span>Choose between Mobile or Desktop interface</span>
                </div>
                <div class="feature-item">
                    <i class="fas fa-shield-alt"></i>
                    <span>Secure OTP-based authentication system</span>
                </div>
                <div class="feature-item">
                    <i class="fas fa-eye"></i>
                    <span>Auto-detects device and recommends best interface</span>
                </div>
                <div class="feature-item">
                    <i class="fas fa-bolt"></i>
                    <span>Fast access without typing long URLs</span>
                </div>
                <div class="feature-item">
                    <i class="fas fa-check-circle"></i>
                    <span>Easy evaluation process on any device</span>
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-6">
                    <div class="card border-0" style="background: linear-gradient(135deg, #fff3e0, #ffe0b2);">
                        <div class="card-body text-center">
                            <i class="fas fa-users fa-2x" style="color: #f57c00; margin-bottom: 15px;"></i>
                            <h5 style="color: #e65100;">For Classrooms</h5>
                            <p style="color: #333; font-size: 14px;">Display QR code on classroom screens or whiteboards for easy student access</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card border-0" style="background: linear-gradient(135deg, #e8f5e8, #c8e6c9);">
                        <div class="card-body text-center">
                            <i class="fas fa-print fa-2x" style="color: #388e3c; margin-bottom: 15px;"></i>
                            <h5 style="color: #2e7d32;">For Posters</h5>
                            <p style="color: #333; font-size: 14px;">Print QR codes on posters and place them around campus for student convenience</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="copy-notification" id="copyNotification">
        <i class="fas fa-check"></i> URL copied to clipboard!
    </div>
    
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    
    <script>
        function copyURL() {
            const urlText = document.getElementById('choice-url').textContent;
            
            // Create temporary textarea
            const textarea = document.createElement('textarea');
            textarea.value = urlText;
            document.body.appendChild(textarea);
            textarea.select();
            document.execCommand('copy');
            document.body.removeChild(textarea);
            
            // Show notification
            const notification = document.getElementById('copyNotification');
            notification.style.display = 'block';
            
            setTimeout(() => {
                notification.style.display = 'none';
            }, 3000);
        }
        
        function downloadQR() {
            const qrUrl = 'https://api.qrserver.com/v1/create-qr-code/?size=500x500&data=<?php echo urlencode($choice_url); ?>&bgcolor=ffffff&color=800000';
            
            // Create download link
            const link = document.createElement('a');
            link.href = qrUrl;
            link.download = 'mobile_evaluation_qr_code.png';
            document.body.appendChild(link);
            link.click();
            document.body.removeChild(link);
        }
        
        function printQR() {
            const printWindow = window.open('', '_blank');
            const qrUrl = 'https://api.qrserver.com/v1/create-qr-code/?size=400x400&data=<?php echo urlencode($choice_url); ?>&bgcolor=ffffff&color=800000';
            
            printWindow.document.write(`
                <!DOCTYPE html>
                <html>
                <head>
                    <title>Mobile Evaluation QR Code</title>
                    <style>
                        body {
                            font-family: Arial, sans-serif;
                            text-align: center;
                            padding: 20px;
                        }
                        .header {
                            color: #800000;
                            margin-bottom: 20px;
                        }
                        .qr-container {
                            border: 2px dashed #800000;
                            padding: 20px;
                            display: inline-block;
                            margin: 20px 0;
                        }
                        .instructions {
                            margin-top: 20px;
                            font-size: 14px;
                            color: #333;
                        }
                        .url {
                            font-family: monospace;
                            background: #f5f5f5;
                            padding: 10px;
                            margin: 10px 0;
                            border-radius: 5px;
                            word-break: break-all;
                        }
                    </style>
                </head>
                <body>
                    <div class="header">
                        <h1>MISAMIS ORIENTAL INSTITUTE OF SCIENCE AND TECHNOLOGY</h1>
                        <h2>Faculty Evaluation - Mobile Access</h2>
                    </div>
                    
                    <div class="qr-container">
                        <img src="${qrUrl}" alt="Mobile Login QR Code">
                    </div>
                    
                    <div class="instructions">
                        <h3>How Students Access:</h3>
                        <p>1. Open phone camera or QR scanner app</p>
                        <p>2. Point camera at the QR code above</p>
                        <p>3. Choose Mobile or Desktop interface</p>
                        <p>4. Enter Student ID and Email</p>
                        <p>5. Complete the evaluation process</p>
                        
                        <div class="url">
                            <strong>Direct URL:</strong><br>
                            <?php echo $choice_url; ?>
                        </div>
                    </div>
                </body>
                </html>
            `);
            
            printWindow.document.close();
            printWindow.print();
        }
    </script>
</body>
</html>
