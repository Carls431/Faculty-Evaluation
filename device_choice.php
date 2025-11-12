<?php
session_start();
include('./db_connect.php');

$system = $conn->query("SELECT * FROM system_settings")->fetch_array();
foreach ($system as $k => $v) {
    $_SESSION['system'][$k] = $v;
}

// Get URLs
$protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http';
$host = $_SERVER['HTTP_HOST'];
$base_path = dirname($_SERVER['REQUEST_URI']);
$mobile_url = $protocol . '://' . $host . $base_path . '/mobile_login.php';
$desktop_url = $protocol . '://' . $host . $base_path . '/student_login.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Choose Your Device - Faculty Evaluation</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }
        
        .choice-container {
            width: 100%;
            max-width: 500px;
            background: rgba(255, 255, 255, 0.95);
            border-radius: 25px;
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.15);
            backdrop-filter: blur(10px);
            overflow: hidden;
            animation: slideUp 0.8s ease-out;
        }
        
        @keyframes slideUp {
            from {
                transform: translateY(50px);
                opacity: 0;
            }
            to {
                transform: translateY(0);
                opacity: 1;
            }
        }
        
        .header-section {
            background: linear-gradient(135deg, #800000, #a52a2a);
            color: white;
            padding: 30px 25px;
            text-align: center;
            position: relative;
        }
        
        .header-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('assets/img/pattern.png') repeat;
            opacity: 0.1;
        }
        
        .logo-choice {
            width: 70px;
            height: 70px;
            border-radius: 50%;
            border: 3px solid rgba(255, 255, 255, 0.3);
            margin-bottom: 15px;
            animation: pulse 2s infinite;
        }
        
        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.05); }
            100% { transform: scale(1); }
        }
        
        .school-name {
            font-size: 13px;
            font-weight: 600;
            margin-bottom: 8px;
            text-transform: uppercase;
            letter-spacing: 1px;
            opacity: 0.95;
        }
        
        .portal-title {
            font-size: 22px;
            font-weight: 700;
            margin-bottom: 5px;
        }
        
        .portal-subtitle {
            font-size: 12px;
            opacity: 0.9;
            font-weight: 300;
        }
        
        .content-section {
            padding: 35px 25px;
        }
        
        .welcome-text {
            text-align: center;
            margin-bottom: 30px;
        }
        
        .welcome-text h3 {
            font-size: 20px;
            font-weight: 600;
            color: #800000;
            margin-bottom: 8px;
        }
        
        .welcome-text p {
            font-size: 14px;
            color: #666;
            line-height: 1.5;
        }
        
        .device-options {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }
        
        .device-option {
            background: linear-gradient(135deg, #f8f9fa, #e9ecef);
            border: 2px solid #e0e0e0;
            border-radius: 20px;
            padding: 25px 20px;
            text-align: center;
            text-decoration: none;
            color: #333;
            transition: all 0.4s ease;
            position: relative;
            overflow: hidden;
        }
        
        .device-option::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.4), transparent);
            transition: left 0.6s;
        }
        
        .device-option:hover::before {
            left: 100%;
        }
        
        .device-option:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
            text-decoration: none;
            color: #333;
        }
        
        .mobile-option {
            border-color: #28a745;
            background: linear-gradient(135deg, #d4edda, #c3e6cb);
        }
        
        .mobile-option:hover {
            border-color: #20c997;
            background: linear-gradient(135deg, #28a745, #20c997);
            color: white;
        }
        
        .desktop-option {
            border-color: #007bff;
            background: linear-gradient(135deg, #d1ecf1, #bee5eb);
        }
        
        .desktop-option:hover {
            border-color: #0056b3;
            background: linear-gradient(135deg, #007bff, #0056b3);
            color: white;
        }
        
        .device-icon {
            font-size: 40px;
            margin-bottom: 15px;
            display: block;
        }
        
        .mobile-option .device-icon {
            color: #28a745;
        }
        
        .desktop-option .device-icon {
            color: #007bff;
        }
        
        .mobile-option:hover .device-icon,
        .desktop-option:hover .device-icon {
            color: white;
        }
        
        .device-title {
            font-size: 18px;
            font-weight: 600;
            margin-bottom: 8px;
        }
        
        .device-description {
            font-size: 13px;
            opacity: 0.8;
            line-height: 1.4;
        }
        
        .device-features {
            margin-top: 12px;
            font-size: 11px;
            opacity: 0.7;
        }
        
        .device-features i {
            margin-right: 5px;
        }
        
        .qr-info {
            background: linear-gradient(135deg, #fff3cd, #ffeaa7);
            border: 1px solid #ffc107;
            border-radius: 15px;
            padding: 15px;
            margin-bottom: 25px;
            text-align: center;
        }
        
        .qr-info i {
            color: #856404;
            font-size: 20px;
            margin-bottom: 8px;
        }
        
        .qr-info p {
            color: #856404;
            font-size: 12px;
            margin: 0;
            font-weight: 500;
        }
        
        .footer-note {
            text-align: center;
            margin-top: 25px;
            padding-top: 20px;
            border-top: 1px solid #e0e0e0;
            font-size: 11px;
            color: #666;
        }
        
        /* Responsive Design */
        @media (max-width: 480px) {
            .choice-container {
                max-width: 95%;
            }
            
            .content-section {
                padding: 25px 20px;
            }
            
            .device-option {
                padding: 20px 15px;
            }
            
            .device-icon {
                font-size: 35px;
            }
            
            .device-title {
                font-size: 16px;
            }
        }
        
        /* Animation for device detection */
        .auto-detect {
            position: fixed;
            top: 20px;
            right: 20px;
            background: rgba(0, 0, 0, 0.8);
            color: white;
            padding: 10px 15px;
            border-radius: 20px;
            font-size: 12px;
            display: none;
            animation: fadeIn 0.5s ease;
        }
        
        @keyframes fadeIn {
            from { opacity: 0; transform: translateX(100%); }
            to { opacity: 1; transform: translateX(0); }
        }
    </style>
</head>
<body>
    <div class="choice-container">
        <div class="header-section">
            <img src="assets/img/logo.png" alt="MOIST Logo" class="logo-choice">
            <div class="school-name">MISAMIS ORIENTAL INSTITUTE<br>OF SCIENCE AND TECHNOLOGY</div>
            <div class="portal-title">Faculty Evaluation</div>
            <div class="portal-subtitle">Student Portal</div>
        </div>
        
        <div class="content-section">
            <div class="qr-info">
                <i class="fas fa-qrcode"></i>
                <p><strong>QR Code Scanned Successfully!</strong><br>Choose your preferred device interface below</p>
            </div>
            
            <div class="welcome-text">
                <h3>Choose Your Device</h3>
                <p>Select the interface that best fits your device for the best evaluation experience</p>
            </div>
            
            <div class="device-options">
                <!-- Mobile Option -->
                <a href="<?php echo $mobile_url; ?>" class="device-option mobile-option" id="mobile-choice">
                    <i class="fas fa-mobile-alt device-icon"></i>
                    <div class="device-title">📱 Mobile Phone</div>
                    <div class="device-description">
                        Optimized for smartphones and tablets<br>
                        Touch-friendly interface with large buttons
                    </div>
                    <div class="device-features">
                        <i class="fas fa-check"></i> Easy touch navigation
                        <i class="fas fa-check"></i> Fast loading
                        <i class="fas fa-check"></i> Portrait mode friendly
                    </div>
                </a>
                
                <!-- Desktop Option -->
                <a href="<?php echo $desktop_url; ?>" class="device-option desktop-option" id="desktop-choice">
                    <i class="fas fa-desktop device-icon"></i>
                    <div class="device-title">💻 Desktop/Laptop</div>
                    <div class="device-description">
                        Full-featured interface for computers<br>
                        Complete functionality with keyboard support
                    </div>
                    <div class="device-features">
                        <i class="fas fa-check"></i> Full screen experience
                        <i class="fas fa-check"></i> Keyboard shortcuts
                        <i class="fas fa-check"></i> Advanced features
                    </div>
                </a>
            </div>
            
            <div class="footer-note">
                💡 <strong>Tip:</strong> You can always switch between interfaces later if needed
            </div>
        </div>
    </div>
    
    <!-- Auto-detect notification -->
    <div class="auto-detect" id="auto-detect">
        <i class="fas fa-magic"></i> Auto-detected: <span id="detected-device"></span>
    </div>
    
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    
    <script>
        $(document).ready(function() {
            // Auto-detect device type and highlight recommended option
            const isMobile = /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent);
            const isTablet = /iPad|Android(?=.*Mobile)/i.test(navigator.userAgent);
            
            if (isMobile || isTablet) {
                // Highlight mobile option
                $('#mobile-choice').css({
                    'border-color': '#28a745',
                    'box-shadow': '0 0 20px rgba(40, 167, 69, 0.3)',
                    'transform': 'scale(1.02)'
                });
                
                // Show auto-detect notification
                $('#detected-device').text('Mobile Device');
                $('#auto-detect').fadeIn().delay(3000).fadeOut();
                
                // Add recommended badge
                $('#mobile-choice').prepend('<div style="position: absolute; top: -10px; right: -10px; background: #28a745; color: white; border-radius: 50%; width: 30px; height: 30px; display: flex; align-items: center; justify-content: center; font-size: 12px; font-weight: bold;">✓</div>');
            } else {
                // Highlight desktop option
                $('#desktop-choice').css({
                    'border-color': '#007bff',
                    'box-shadow': '0 0 20px rgba(0, 123, 255, 0.3)',
                    'transform': 'scale(1.02)'
                });
                
                // Show auto-detect notification
                $('#detected-device').text('Desktop/Laptop');
                $('#auto-detect').fadeIn().delay(3000).fadeOut();
                
                // Add recommended badge
                $('#desktop-choice').prepend('<div style="position: absolute; top: -10px; right: -10px; background: #007bff; color: white; border-radius: 50%; width: 30px; height: 30px; display: flex; align-items: center; justify-content: center; font-size: 12px; font-weight: bold;">✓</div>');
            }
            
            // Add click tracking
            $('.device-option').click(function() {
                const deviceType = $(this).hasClass('mobile-option') ? 'Mobile' : 'Desktop';
                console.log('User selected:', deviceType);
                
                // Add loading effect
                $(this).html('<i class="fas fa-spinner fa-spin" style="font-size: 30px; color: #800000;"></i><br><br>Loading ' + deviceType + ' Interface...');
            });
            
            // Add hover sound effect (optional)
            $('.device-option').hover(function() {
                $(this).find('.device-icon').addClass('fa-bounce');
            }, function() {
                $(this).find('.device-icon').removeClass('fa-bounce');
            });
        });
    </script>
</body>
</html>
