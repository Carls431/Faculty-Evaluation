<?php
ini_set('display_errors', 0);
ini_set('display_startup_errors', 0);
error_reporting(0);
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include('db_connect.php');

// Force cache refresh
header("Cache-Control: no-cache, no-store, must-revalidate");
header("Pragma: no-cache");
header("Expires: 0");

if (
    !isset($_SESSION['academic']['id']) ||
    !isset($_SESSION['login_class_id']) ||
    !isset($_SESSION['login_id'])
) {
    die('Session expired or not set. Please log in again.');
}

function ordinal_suffix($num){
    $num = $num % 100; // protect against large numbers
    if($num < 11 || $num > 13){
         switch($num % 10){
            case 1: return $num.'st';
            case 2: return $num.'nd';
            case 3: return $num.'rd';
        }
    }
    return $num.'th';
}
$rid='';
$faculty_id='';
$subject_id='';
if(isset($_GET['rid']))
$rid = $_GET['rid'];
if(isset($_GET['fid']))
$faculty_id = $_GET['fid'];
if(isset($_GET['sid']))
$subject_id = $_GET['sid'];
$academic_id = (int)$_SESSION['academic']['id'];
$class_id = (int)$_SESSION['login_class_id'];
$student_id = (int)$_SESSION['login_id'];

$restriction = $conn->query("
    SELECT r.id, s.id as sid, f.id as fid,
           CONCAT(f.firstname, ' ', f.lastname) as faculty,
           s.code, s.subject 
    FROM restriction_list r 
    INNER JOIN faculty_list f ON f.id = r.faculty_id 
    INNER JOIN subject_list s ON s.id = r.subject_id 
    WHERE r.academic_id = $academic_id
    AND r.class_id = $class_id
    AND r.id NOT IN (
        SELECT restriction_id 
        FROM evaluation_list 
        WHERE academic_id = $academic_id
        AND student_id = $student_id
    )
");

$faculty_info = "No Teacher Selected";
$subject_info = "";
if(!empty($faculty_id)){
    $f_query = $conn->query("SELECT *, CONCAT(firstname, ' ', lastname) as faculty FROM faculty_list where id = $faculty_id");
    if($f_query->num_rows > 0){
        $f_row = $f_query->fetch_assoc();
        $faculty_info = $f_row['faculty'];
    }
    
    // Get subject info from restriction_list to ensure we get the correct subject for this faculty-student combination
    $restriction_query = $conn->query("
        SELECT s.code, s.subject, CONCAT(s.code, ' - ', s.subject) as subj 
        FROM restriction_list r 
        INNER JOIN subject_list s ON s.id = r.subject_id 
        WHERE r.faculty_id = $faculty_id 
        AND r.academic_id = $academic_id 
        AND r.class_id = $class_id
        LIMIT 1
    ");
    
    if($restriction_query->num_rows > 0){
        $restriction_row = $restriction_query->fetch_assoc();
        $subject_info = $restriction_row['subj'];
    } else {
        // Fallback to direct subject query if restriction not found
        $s_query = $conn->query("SELECT *, CONCAT(code, ' - ', subject) as subj FROM subject_list where id = $subject_id");
        if($s_query->num_rows > 0){
            $s_row = $s_query->fetch_assoc();
            $subject_info = $s_row['subj'];
        }
    }
}

?>
<style>
    .evaluation-page-container {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        padding: 20px 15px;
        background-color: #f4f6f9 !important;
    }
    
    /* Flash Banner Styles */
    .flash-banner-container {
        position: relative;
        width: 100%;
        height: 140px;
        margin-bottom: 25px;
        background: linear-gradient(135deg, #ffffff 0%, #f8f9fa 20%,rgb(220, 244, 10) 80%,rgb(230, 254, 10) 100%);
        border-radius: 15px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.15);
        border: 3px solid rgba(220, 38, 38, 0.3);
        overflow: hidden;
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 20px 30px;
        animation: flashPulse 4s ease-in-out infinite;
    }
    
    .flash-banner-container::before {
        content: '';
        position: absolute;
        top: -50%;
        left: -50%;
        width: 200%;
        height: 200%;
        background: linear-gradient(45deg, transparent 30%, rgba(255,255,255,0.3) 50%, transparent 70%);
        animation: flashSweep 3s ease-in-out infinite;
        pointer-events: none;
    }
    
    .banner-main-content {
        display: flex !important;
        flex-direction: column !important;
        align-items: center !important;
        flex: 1 !important;
        text-align: center !important;
        z-index: 2 !important;
        position: relative !important;
        margin-left: 280px !important;
    }
    
    .banner-logo-flash {
        width: 60px;
        height: 60px;
        margin-bottom: 10px;
        border-radius: 50%;
        box-shadow: 0 6px 20px rgba(0,0,0,0.2);
        animation: logoFloat 2s ease-in-out infinite alternate;
    }
    
    .banner-title-flash {
        font-size: 1.3rem;
        font-weight: 800;
        color: #1f2937;
        text-shadow: 2px 2px 4px rgba(255,255,255,0.8);
        margin: 0;
        letter-spacing: 0.8px;
        line-height: 1.3;
        animation: titleGlow 2s ease-in-out infinite alternate;
    }
    
    .banner-subtitle {
        font-size: 0.9rem;
        color: #4b5563;
        margin-left: 5px;
        font-weight: 500;
        text-shadow: 1px 1px 2px rgba(255,255,255,0.6);
    }
    
    .banner-decoration-left {
        position: absolute !important;
        left: 0px !important;
        top: 0px !important;
        width: 300px !important;
        height: 140px !important;
        z-index: 3 !important;
        filter: drop-shadow(0 8px 16px rgba(0,0,0,0.2)) !important;
    }
    
    .banner-decoration-left img {
        width: 100% !important;
        height: 100% !important;
        object-fit: contain !important;
        object-position: left center !important;
    }
    
    .banner-decoration-right {
        position: absolute;
        right: 20px;
        top: 50%;
        transform: translateY(-50%);
        width: 100px;
        height: 100px;
        animation: olapBounce 3s ease-in-out infinite;
        filter: drop-shadow(0 6px 12px rgba(252, 239, 239, 0.2));
        z-index: 3;
    }
    
    .banner-decoration-right img {
        width: 100%;
        height: 100%;
        object-fit: contain;
        animation: rainbowFilter 3s linear infinite;
    }
    
    .banner-decoration-right::before {
        content: '';
        position: absolute;
        top: -15px;
        left: -15px;
        right: -15px;
        bottom: -15px;
        background: radial-gradient(circle, rgba(255,182,193,0.4) 0%, rgba(251, 242, 243, 0.1) 50%, transparent 80%);
        border-radius: 50%;
        animation: olapGlow 2s ease-in-out infinite alternate;
    }
    
    .banner-decoration-right::after {
        content: '✨💫';
        position: absolute;
        top: -10px;
        right: -5px;
        font-size: 1.2rem;
        animation: sparkleRotate 4s linear infinite;
    }
    
    @keyframes flashPulse {
        0%, 100% {
            box-shadow: 0 10px 30px rgba(0,0,0,0.15);
            transform: scale(1);
        }
        50% {
            box-shadow: 0 15px 40px rgba(220, 38, 38, 0.3);
            transform: scale(1.02);
        }
    }
    
    @keyframes flashSweep {
        0% {
            transform: translateX(-100%) translateY(-100%) rotate(45deg);
        }
        50% {
            transform: translateX(0%) translateY(0%) rotate(45deg);
        }
        100% {
            transform: translateX(100%) translateY(100%) rotate(45deg);
        }
    }
    
    @keyframes logoFloat {
        0% {
            transform: translateY(0px);
        }
        100% {
            transform: translateY(-8px);
        }
    }
    
    @keyframes titleGlow {
        0% {
            text-shadow: 2px 2px 4px rgba(255,255,255,0.8);
        }
        100% {
            text-shadow: 2px 2px 4px rgba(255,255,255,0.8), 0 0 15px rgba(220, 38, 38, 0.4);
        }
    }
    
    @keyframes chopperFloat {
        0%, 100% {
            transform: translateY(0px) scale(1);
        }
        50% {
            transform: translateY(-8px) scale(1.02);
        }
    }
    
    @keyframes chopperGlow {
        0% {
            filter: brightness(1) saturate(1.2);
        }
        100% {
            filter: brightness(1.1) saturate(1.4) drop-shadow(0 0 15px rgba(255,182,193,0.6));
        }
    }
    
    @keyframes olapBounce {
        0%, 100% {
            transform: translateY(-50%) translateX(0px) rotate(0deg);
        }
        25% {
            transform: translateY(-60%) translateX(-5px) rotate(-3deg);
        }
        50% {
            transform: translateY(-40%) translateX(0px) rotate(0deg);
        }
        75% {
            transform: translateY(-55%) translateX(5px) rotate(3deg);
        }
    }
    
    @keyframes olapGlow {
        0% {
            opacity: 0.4;
            transform: scale(1);
        }
        100% {
            opacity: 0.8;
            transform: scale(1.15);
        }
    }
    
    @keyframes sparkleRotate {
        0% {
            transform: rotate(0deg) scale(1);
            opacity: 1;
        }
        25% {
            transform: rotate(90deg) scale(1.2);
            opacity: 0.8;
        }
        50% {
            transform: rotate(180deg) scale(1);
            opacity: 1;
        }
        75% {
            transform: rotate(270deg) scale(1.2);
            opacity: 0.8;
        }
        100% {
            transform: rotate(360deg) scale(1);
            opacity: 1;
        }
    }
    
    @keyframes rainbowFilter {
        0% {
            filter: hue-rotate(0deg) saturate(1.2) brightness(1.1);
        }
        16.66% {
            filter: hue-rotate(60deg) saturate(1.3) brightness(1.2);
        }
        33.33% {
            filter: hue-rotate(120deg) saturate(1.4) brightness(1.1);
        }
        50% {
            filter: hue-rotate(180deg) saturate(1.3) brightness(1.2);
        }
        66.66% {
            filter: hue-rotate(240deg) saturate(1.4) brightness(1.1);
        }
        83.33% {
            filter: hue-rotate(300deg) saturate(1.3) brightness(1.2);
        }
        100% {
            filter: hue-rotate(360deg) saturate(1.2) brightness(1.1);
        }
    }
    .card {
        border: none !important;
        border-radius: 12px !important;
        box-shadow: 0 4px 20px rgba(0,0,0,0.06) !important;
        margin-bottom: 20px !important;
    }
    /* Teachers Grid Container */
    .teachers-grid-container {
        background: #ffffff;
        border-radius: 12px;
        padding: 25px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.06);
        margin-bottom: 20px;
    }
    
    .teachers-grid-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 25px;
        padding-bottom: 15px;
        border-bottom: 2px solid #f1f1f1;
    }
    
    .search-filter-wrapper {
        flex: 0 0 300px;
    }
    
    .teacher-search-filter {
        width: 100%;
        padding: 10px 15px;
        border: 2px solid #e9ecef;
        border-radius: 25px;
        font-size: 0.95rem;
        transition: all 0.3s ease;
        background-color: #f8f9fa;
    }
    
    .teacher-search-filter:focus {
        outline: none;
        border-color: #800000;
        background-color: #fff;
        box-shadow: 0 0 0 3px rgba(128, 0, 0, 0.1);
    }
    
    /* Teachers Grid */
    .teachers-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
        gap: 20px;
        margin-top: 20px;
    }
    
    /* Teacher Card */
    .teacher-card {
        background: #fff;
        border: 2px solid #e9ecef;
        border-radius: 12px;
        padding: 20px;
        transition: all 0.3s ease;
        cursor: pointer;
        position: relative;
        overflow: hidden;
    }
    
    .teacher-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(0,0,0,0.1);
        border-color: #800000;
    }
    
    .teacher-card.completed {
        border-color: #28a745;
        background: linear-gradient(135deg, #fff 0%, #f8fff8 100%);
    }
    
    .teacher-card.pending {
        border-color: #ffc107;
        background: linear-gradient(135deg, #fff 0%, #fffdf5 100%);
    }
    
    /* Status Badge */
    .card-status-indicator {
        position: absolute;
        top: 15px;
        right: 15px;
    }
    
    .status-badge {
        display: flex;
        align-items: center;
        gap: 3px;
        padding: 2px 6px;
        border-radius: 8px;
        font-size: 0.65rem;
        font-weight: 500;
        text-transform: uppercase;
    }
    
    .status-badge.completed {
        background: #d4edda;
        color: #155724;
        border: 1px solid #c3e6cb;
    }
    
    .status-badge.pending {
        background: #fff3cd;
        color: #856404;
        border: 1px solid #ffeaa7;
    }
    
    /* Card Content */
    .card-content {
        display: flex;
        align-items: flex-start;
        gap: 15px;
        margin-bottom: 20px;
    }
    
    .teacher-avatar {
        flex: 0 0 50px;
        height: 50px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: linear-gradient(135deg, #800000, #a52a2a);
        border-radius: 50%;
        color: white;
        font-size: 1.5rem;
    }
    
    .teacher-details {
        flex: 1;
        min-width: 0;
    }
    
    .teacher-name {
        font-size: 1.1rem;
        font-weight: 600;
        color: #333;
        margin: 0 0 8px 0;
        line-height: 1.3;
    }
    
    .subject-info {
        display: flex;
        align-items: center;
        gap: 8px;
        color: #6c757d;
        font-size: 0.95rem;
        margin: 0 0 8px 0;
        line-height: 1.4;
    }
    
    .completion-date {
        display: flex;
        align-items: center;
        gap: 8px;
        color: #28a745;
        font-size: 0.85rem;
        margin: 0;
        font-weight: 500;
    }
    
    /* Card Actions */
    .card-actions {
        display: flex;
        justify-content: center;
    }
    
    .btn-action {
        display: flex;
        align-items: center;
        gap: 8px;
        padding: 10px 20px;
        border: none;
        border-radius: 8px;
        font-size: 0.95rem;
        font-weight: 500;
        cursor: pointer;
        transition: all 0.3s ease;
        text-decoration: none;
        min-width: 140px;
        justify-content: center;
    }
    
    .btn-evaluate {
        background: linear-gradient(135deg, #800000, #a52a2a);
        color: white;
    }
    
    .btn-evaluate:hover {
        background: linear-gradient(135deg, #a52a2a, #8b0000);
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(128, 0, 0, 0.3);
    }
    
    .btn-view {
        background: linear-gradient(135deg, #17a2b8, #138496);
        color: white;
    }
    
    .btn-view:hover {
        background: linear-gradient(135deg, #138496, #117a8b);
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(23, 162, 184, 0.3);
    }
    
    /* Empty State */
    .no-teachers-message {
        grid-column: 1 / -1;
        text-align: center;
        padding: 60px 20px;
    }
    
    .empty-state {
        color: #6c757d;
    }
    
    .empty-state i {
        color: #dee2e6;
        margin-bottom: 20px;
    }
    
    .empty-state h4 {
        color: #495057;
        margin-bottom: 10px;
    }
    
    .empty-state p {
        color: #6c757d;
        font-size: 1rem;
    }
    .evaluation-form-container {
        display: none;
        animation: fadeInUp 0.4s ease-out;
    }
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    .loading-spinner {
        text-align: center;
        padding: 40px;
        display: none;
    }
    .spinner {
        border: 3px solid #f3f3f3;
        border-top: 3px solid #007bff;
        border-radius: 50%;
        width: 30px;
        height: 30px;
        animation: spin 1s linear infinite;
        margin: 0 auto 15px;
    }
    @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }
    .evaluation-card {
        background: #ffffff !important;
        border-radius: 12px !important;
        padding: 30px !important;
        max-width: 800px; /* Reduced width for a more compact layout */
        margin: 0 auto 20px; /* Center the card and add bottom margin */
    }
    .teacher-info {
        border-bottom: 1px solid #e9ecef !important;
        padding-bottom: 20px;
        margin-bottom: 20px;
    }
    .teacher-info h2 {
        font-size: 1.8rem;
        font-weight: 600;
        color: #343a40 !important;
        margin-bottom: 10px;
    }
    .subject-text {
        font-size: 1.2rem;
        color: #6c757d !important;
        margin: 10px 0;
        font-weight: normal;
    }
    .text-muted {
        font-size: 1rem;
        color: #6c757d;
    }
    .d-flex {
        display: flex;
    }
    .flex-column {
        flex-direction: column;
    }
    .mb-2 {
        margin-bottom: 0.75rem;
    }
    .rating-legend {
        background-color: #f8f9fa !important;
        border: 1px solid #dee2e6 !important;
        border-radius: 8px !important;
        padding: 15px;
        font-size: 0.9rem;
        margin-bottom: 30px;
    }
    .criteria-header {
        background-color: #343a40 !important;
        color: #fff !important;
        padding: 12px 20px;
        border-radius: 8px !important;
        font-size: 1.2rem;
        font-weight: 500;
        margin-bottom: 1rem; /* Reverted */
    }
    .question-row {
        display: flex;
        align-items: center;
        justify-content: space-between; /* Align items to ends */
        padding: 12px 10px; 
        border-bottom: 1px solid #f1f1f1 !important;
    }
    .question-row:last-child {
        border-bottom: none !important;
    }
    .question-text {
        /* flex-grow: 1; REMOVED */
        font-size: 1rem;
        color: #333 !important;
        padding-right: 20px;
    }
    .rating-group {
        display: flex;
        gap: 8px; /* This brings the numbers closer */
        flex-shrink: 0;
    }
    .rating-group input[type="radio"] {
        display: none;
    }
    .rating-group label {
        display: flex;
        justify-content: center;
        align-items: center;
        width: 38px;
        height: 38px;
        border: 2px solid #ced4da !important;
        border-radius: 50%;
        cursor: pointer;
        font-weight: 600;
        color: #6c757d !important;
        transition: all 0.3s ease;
    }
    .rating-group input[type="radio"]:checked + label {
        background-color: #800000 !important;
        color: #fff !important;
        border-color: #800000 !important;
        transform: scale(1.1);
    }
    .rating-group label:hover {
        background-color: #a52a2a !important;
        color: #fff !important;
        border-color: #a52a2a !important;
    }
    .rating-controls {
        display: flex;
        align-items: center;
        justify-content: space-between;
    }
    .clear-rating-btn {
        background-color: #f8f9fa !important;
        border: 1px solid #dee2e6 !important;
        border-radius: 8px !important;
        padding: 8px 15px;
        font-size: 0.9rem;
        cursor: pointer;
    }
    .submit-btn-container {
        text-align: right;
        margin-top: 30px;
    }
    .submit-btn {
        background-color:rgb(187, 8, 8) !important;
        color: #fff !important;
        border: none !important;
        border-radius: 8px !important;
        padding: 12px 30px;
        font-size: 1.1rem;
        font-weight: 600;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }
    .submit-btn:hover {
        background-color: #a52a2a !important;
    }
    
    /* Multi-step evaluation styles */
    .step-progress {
        background: #f8f9fa;
        border-radius: 10px;
        padding: 20px;
        margin-bottom: 30px;
        border: 1px solid #dee2e6;
    }
    .progress-bar-container {
        background: #e9ecef;
        height: 8px;
        border-radius: 4px;
        overflow: hidden;
        margin-bottom: 15px;
    }
    .progress-bar {
        background: linear-gradient(90deg, #800000, #a52a2a);
        height: 100%;
        border-radius: 4px;
        transition: width 0.3s ease;
    }
    .step-info {
        display: flex;
        justify-content: space-between;
        align-items: center;
        font-size: 0.9rem;
        color: #6c757d;
        justify-content: space-between; /* Fix the typo here */
    }
    .step-counter {
        font-weight: 600;
        color: #800000;
    }
    .criteria-step {
        display: none;
        animation: fadeIn 0.3s ease-in-out;
    }
    .criteria-step.active {
        display: block;
    }
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }
    .step-navigation {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-top: 30px;
        padding-top: 20px;
        border-top: 1px solid #e9ecef;
    }
    .nav-btn {
        background-color: #6c757d;
        color: white;
        border: none;
        border-radius: 8px;
        padding: 10px 20px;
        font-size: 1rem;
        font-weight: 500;
        cursor: pointer;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        gap: 8px;
    }
    .nav-btn:hover {
        background-color: #5a6268;
        transform: translateY(-1px);
    }
    .nav-btn:disabled {
        background-color: #e9ecef;
        color: #6c757d;
        cursor: not-allowed;
        transform: none;
    }
    .nav-btn.next-btn {
        background-color: #800000;
    }
    .nav-btn.next-btn:hover {
        background-color: #a52a2a;
    }
    .step-validation-message {
        background-color: #fff3cd;
        border: 1px solid #ffeaa7;
        color: #856404;
        padding: 12px 15px;
        border-radius: 6px;
        margin-top: 15px;
        display: none;
    }
    .char-counter {
        text-align: right;
        font-size: 0.8rem;
        color: #6c757d;
        margin-top: 5px;
    }
    .content-wrapper, .main-header, .main-footer {
        margin-left: 0 !important;
    }

    /* Congratulations Banner Styles */
    .congratulations-banner {
        position: relative;
        width: 100%;
        height: 160px;
        margin-bottom: 25px;
        background: linear-gradient(135deg, #4CAF50 0%, #45a049 20%, #66BB6A 80%, #81C784 100%);
        border-radius: 15px;
        box-shadow: 0 10px 30px rgba(76, 175, 80, 0.3);
        border: 3px solid rgba(76, 175, 80, 0.5);
        overflow: hidden;
        display: flex;
        align-items: center;
        justify-content: center;
        animation: celebrationPulse 2s ease-in-out infinite;
    }
    
    .congratulations-banner::before {
        content: '';
        position: absolute;
        top: -50%;
        left: -50%;
        width: 200%;
        height: 200%;
        background: linear-gradient(45deg, transparent 30%, rgba(255,255,255,0.4) 50%, transparent 70%);
        animation: celebrationSweep 3s ease-in-out infinite;
        pointer-events: none;
    }
    
    .congrats-content {
        text-align: center;
        z-index: 2;
        position: relative;
    }
    
    .congrats-title {
        font-size: 2rem;
        font-weight: 900;
        color: #ffffff;
        text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
        margin: 0 0 10px 0;
        letter-spacing: 1px;
        animation: bounceIn 1s ease-out;
    }
    
    .congrats-subtitle {
        font-size: 1.1rem;
        color: #ffffff;
        font-weight: 600;
        text-shadow: 1px 1px 2px rgba(0,0,0,0.2);
        margin: 0;
        animation: fadeInUp 1.5s ease-out;
    }
    
    /* Fireworks Animation */
    .firework {
        position: absolute;
        width: 4px;
        height: 4px;
        border-radius: 50%;
        animation: fireworkExplode 2s ease-out infinite;
    }
    
    .firework:nth-child(1) {
        top: 20%;
        left: 20%;
        background: #FF6B6B;
        animation-delay: 0s;
    }
    
    .firework:nth-child(2) {
        top: 30%;
        right: 25%;
        background: #4ECDC4;
        animation-delay: 0.5s;
    }
    
    .firework:nth-child(3) {
        top: 15%;
        left: 70%;
        background: #45B7D1;
        animation-delay: 1s;
    }
    
    .firework:nth-child(4) {
        top: 40%;
        left: 15%;
        background: #FFA07A;
        animation-delay: 1.5s;
    }
    
    .firework:nth-child(5) {
        top: 25%;
        right: 15%;
        background: #98D8C8;
        animation-delay: 0.3s;
    }
    
    /* Floating Emojis */
    .floating-emoji {
        position: absolute;
        font-size: 2rem;
        animation: floatUp 3s ease-out infinite;
        pointer-events: none;
    }
    
    .floating-emoji:nth-child(6) {
        left: 10%;
        animation-delay: 0s;
    }
    
    .floating-emoji:nth-child(7) {
        left: 30%;
        animation-delay: 0.8s;
    }
    
    .floating-emoji:nth-child(8) {
        right: 30%;
        animation-delay: 1.2s;
    }
    
    .floating-emoji:nth-child(9) {
        right: 10%;
        animation-delay: 0.4s;
    }
    
    /* Animations */
    @keyframes celebrationPulse {
        0%, 100% {
            box-shadow: 0 10px 30px rgba(76, 175, 80, 0.3);
            transform: scale(1);
        }
        50% {
            box-shadow: 0 15px 40px rgba(76, 175, 80, 0.5);
            transform: scale(1.02);
        }
    }
    
    @keyframes celebrationSweep {
        0% {
            transform: translateX(-100%) translateY(-100%) rotate(45deg);
        }
        50% {
            transform: translateX(0%) translateY(0%) rotate(45deg);
        }
        100% {
            transform: translateX(100%) translateY(100%) rotate(45deg);
        }
    }
    
    @keyframes bounceIn {
        0% {
            opacity: 0;
            transform: scale(0.3) translateY(-50px);
        }
        50% {
            opacity: 1;
            transform: scale(1.05) translateY(0px);
        }
        70% {
            transform: scale(0.9);
        }
        100% {
            opacity: 1;
            transform: scale(1);
        }
    }
    
    @keyframes fadeInUp {
        0% {
            opacity: 0;
            transform: translateY(30px);
        }
        100% {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    @keyframes fireworkExplode {
        0% {
            opacity: 1;
            transform: scale(0);
            box-shadow: 0 0 0 0 currentColor;
        }
        50% {
            opacity: 1;
            transform: scale(1);
            box-shadow: 0 0 0 10px transparent,
                        0 0 0 20px currentColor,
                        0 0 0 30px transparent,
                        0 0 0 40px currentColor;
        }
        100% {
            opacity: 0;
            transform: scale(1);
            box-shadow: 0 0 0 50px transparent,
                        0 0 0 60px transparent,
                        0 0 0 70px transparent,
                        0 0 0 80px transparent;
        }
    }
    
    @keyframes floatUp {
        0% {
            opacity: 0;
            transform: translateY(100px) rotate(0deg);
        }
        10% {
            opacity: 1;
        }
        90% {
            opacity: 1;
        }
        100% {
            opacity: 0;
            transform: translateY(-100px) rotate(360deg);
        }
    }
    /* Mobile Responsive Styles */
    @media (max-width: 768px) {
        /* Banner Mobile Styles */
        .flash-banner-container {
            height: 100px;
            padding: 15px 20px;
            margin-bottom: 20px;
        }
        
        .banner-title-flash {
            font-size: 1.1rem;
            letter-spacing: 0.5px;
        }
        
        .banner-subtitle {
            font-size: 0.8rem;
        }
        
        .banner-decoration-left {
            width: 200px;
            height: 100px;
            left: 0px;
            top: 0px;
        }
        
        .banner-main-content {
            margin-left: 180px;
        }
        
        .banner-decoration-right {
            width: 70px;
            height: 70px;
            right: 15px;
        }
        
        .banner-decoration-right::after {
            font-size: 1rem;
            top: -8px;
            right: -3px;
        }
        
        .teachers-grid-header {
            flex-direction: column;
            gap: 15px;
            align-items: stretch;
        }
        
        .search-filter-wrapper {
            flex: 1;
        }
        
        .teachers-grid {
            grid-template-columns: 1fr;
            gap: 15px;
        }
        
        .teacher-card {
            padding: 15px;
        }
        
        .card-content {
            gap: 12px;
        }
        
        .teacher-avatar {
            flex: 0 0 40px;
            height: 40px;
            font-size: 1.2rem;
        }
        
        .teacher-name {
            font-size: 1rem;
        }
        
        .subject-info {
            font-size: 0.9rem;
        }
        
        .btn-action {
            padding: 8px 16px;
            font-size: 0.9rem;
            min-width: 120px;
        }
        
        .evaluation-card {
            padding: 15px !important;
        }
        
        .teacher-info h2 {
            font-size: 1.5rem;
        }
        
        .question-row {
            flex-direction: column;
            align-items: flex-start;
            padding: 5px 0;
        }
        
        .question-text {
            margin-bottom: 8px;
        }
        
        .rating-controls {
            flex-direction: column;
            align-items: flex-start;
        }
        
        .rating-group {
            width: 100%;
            justify-content: space-around;
            margin-bottom: 15px;
        }
        
        .evaluation-page-container {
            padding: 10px 5px;
        }
    }

    /* Additional Mobile Optimizations */
    @media (max-width: 480px) {
        .teachers-grid-container {
            padding: 15px;
        }
        
        .teachers-grid-header h3 {
            font-size: 1.2rem;
        }
        
        .teacher-card {
            padding: 12px;
        }
        
        .card-content {
            gap: 10px;
        }
        
        .teacher-avatar {
            flex: 0 0 35px;
            height: 35px;
            font-size: 1rem;
        }
        
        .status-badge {
            font-size: 0.6rem;
            padding: 2px 5px;
            gap: 2px;
        }
        
        .btn-action {
            padding: 6px 12px;
            font-size: 0.85rem;
            min-width: 100px;
        }
    }
</style>

<div class="evaluation-page-container">
    <div class="row justify-content-center">
        <div class="col-12">
            
            <!-- Teacher Cards Grid -->
            <div class="teachers-grid-container">
                <div class="teachers-grid-header">
                    <div>
                        <h3>👨‍🏫 Select Faculty to Evaluate</h3>
                        <p class="text-muted mb-0">Click on any teacher card to start or view their evaluation</p>
                    </div>
                    <div class="search-filter-wrapper">
                        <input type="text" 
                               class="teacher-search-filter" 
                               id="teacherSearchFilter" 
                               placeholder="🔍 Filter teachers..." 
                               autocomplete="off">
                    </div>
                </div>
                
                <div class="teachers-grid" id="teachersGrid">
                    <?php 
                    // Get completed evaluations for status display
                    $completed_evaluations = $conn->query("
                        SELECT restriction_id, date_taken 
                        FROM evaluation_list 
                        WHERE academic_id = $academic_id 
                        AND student_id = $student_id
                    ");
                    $completed_list = array();
                    while($comp = $completed_evaluations->fetch_assoc()) {
                        $completed_list[$comp['restriction_id']] = $comp['date_taken'];
                    }
                    
                    // Get all restrictions (both completed and pending)
                    $all_restrictions = $conn->query("
                        SELECT r.id, s.id as sid, f.id as fid,
                               CONCAT(f.firstname, ' ', f.lastname) as faculty,
                               s.code, s.subject 
                        FROM restriction_list r 
                        INNER JOIN faculty_list f ON f.id = r.faculty_id 
                        INNER JOIN subject_list s ON s.id = r.subject_id 
                        WHERE r.academic_id = $academic_id
                        AND r.class_id = $class_id
                        ORDER BY f.lastname, f.firstname, s.code
                    ");
                    
                    $has_any_teachers = $all_restrictions->num_rows > 0;
                    
                    if($has_any_teachers):
                        while($row=$all_restrictions->fetch_array()):
                            $is_completed = isset($completed_list[$row['id']]);
                            $completion_date = $is_completed ? $completed_list[$row['id']] : null;
                    ?>
                    <div class="teacher-card <?php echo $is_completed ? 'completed' : 'pending' ?>" 
                         data-rid="<?php echo $row['id'] ?>" 
                         data-sid="<?php echo $row['sid'] ?>" 
                         data-fid="<?php echo $row['fid'] ?>"
                         data-faculty="<?php echo htmlspecialchars($row['faculty']) ?>"
                         data-subject="<?php echo htmlspecialchars($row['subject']) ?>"
                         data-code="<?php echo htmlspecialchars($row['code']) ?>"
                         data-completed="<?php echo $is_completed ? '1' : '0' ?>"
                         data-search="<?php echo strtolower($row['faculty'] . ' ' . $row['subject'] . ' ' . $row['code']) ?>">
                        
                        <div class="card-status-indicator">
                            <?php if($is_completed): ?>
                                <div class="status-badge completed">
                                    <i class="fa fa-check-circle"></i>
                                    <span>Completed</span>
                                </div>
                            <?php else: ?>
                                <div class="status-badge pending">
                                    <i class="fa fa-clock-o"></i>
                                    <span>Pending</span>
                                </div>
                            <?php endif; ?>
                        </div>
                        
                        <div class="card-content">
                            <div class="teacher-avatar">
                                <i class="fa fa-user-circle"></i>
                            </div>
                            
                            <div class="teacher-details">
                                <h4 class="teacher-name"><?php echo ucwords($row['faculty'])?></h4>
                                <p class="subject-info">
                                    <i class="fa fa-book"></i>
                                    <?php echo $row["code"] . ' - ' . $row['subject']?>
                                </p>
                                
                                <?php if($is_completed && $completion_date): ?>
                                    <p class="completion-date">
                                        <i class="fa fa-calendar"></i>
                                        Completed: <?php echo date('M j, Y', strtotime($completion_date))?>
                                    </p>
                                <?php endif; ?>
                            </div>
                        </div>
                        
                        <div class="card-actions">
                            <?php if($is_completed): ?>
                                <button class="btn-action btn-view" type="button">
                                    <i class="fa fa-eye"></i>
                                    View Evaluation
                                </button>
                            <?php else: ?>
                                <button class="btn-action btn-evaluate" type="button">
                                    <i class="fa fa-pencil"></i>
                                    Start Evaluation
                                </button>
                            <?php endif; ?>
                        </div>
                    </div>
                    <?php endwhile; ?>
                    <?php else: ?>
                        <div class="no-teachers-message">
                            <div class="empty-state">
                                <i class="fa fa-users fa-3x"></i>
                                <h4>No Teachers Assigned</h4>
                                <p>No teachers have been assigned for evaluation in your class.</p>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
            
            <!-- Loading Spinner -->
            <div class="loading-spinner" id="loadingSpinner">
                <div class="spinner"></div>
                <p>Loading evaluation form...</p>
            </div>
            
            <!-- Evaluation Form Container -->
            <div class="evaluation-form-container" id="evaluationFormContainer">
            <div class="card evaluation-card">
                <div class="teacher-info">
                    <div class="d-flex flex-column">
                        <h2 class="mb-2"><?php echo ucwords($faculty_info) ?></h2>
                        <h4 class="subject-text mb-2"><?php echo $subject_info ?></h4>
                        <div class="text-muted">Academic Year: <?php echo $_SESSION['academic']['year'].' '.(ordinal_suffix($_SESSION['academic']['quarter'])) ?> Quarter</div>
                    </div>
                </div>

                <div class="rating-legend">
                    <p class="mb-0"><b>Rating Legend:</b> 5 = Excellent, 4 = very Good, 3 = Good, 2 = Fair, 1 = Poor</p>
                </div>

                <!-- Step Progress Indicator -->
                <div class="step-progress">
                    <div class="progress-bar-container">
                        <div class="progress-bar" id="progressBar" style="width: 0%"></div>
                    </div>
                    <div class="step-info">
                        <span class="step-counter" id="stepCounter">Step 1 of <span id="totalSteps"></span></span>
                        <span id="currentCriteriaName"></span>
                    </div>
                </div>

                <form id="manage-evaluation">
                    <input type="hidden" name="class_id" value="<?php echo $_SESSION['login_class_id'] ?>">
                    <input type="hidden" name="faculty_id" value="<?php echo $faculty_id?>">
                    <input type="hidden" name="restriction_id" value="<?php echo $rid ?>">
                    <input type="hidden" name="subject_id" value="<?php echo $subject_id ?>">
                    <input type="hidden" name="academic_id" value="<?php echo $_SESSION['academic']['id'] ?>">
                    
                    <?php 
                        $criteria = $conn->query("SELECT * FROM criteria_list where id in (SELECT criteria_id FROM question_list where academic_id = {$_SESSION['academic']['id']} ) order by abs(order_by) asc ");
                        $step_counter = 0;
                        while($crow = $criteria->fetch_assoc()):
                        $step_counter++;
                    ?>
                    <div class="criteria-step" data-step="<?php echo $step_counter ?>" data-criteria="<?php echo htmlspecialchars($crow['criteria']) ?>">
                        <div class="criteria-header d-flex justify-content-between">
                            <span><?php echo $crow['criteria'] ?></span>
                            <span class="font-weight-normal"><?php echo ($crow['weight'] * 100) . '%' ?></span>
                        </div>
                        <div class="questions-container">
                        <?php 
                        $questions = $conn->query("SELECT * FROM question_list where criteria_id = {$crow['id']} and academic_id = {$_SESSION['academic']['id']} order by abs(order_by) asc ");
                        while($row=$questions->fetch_assoc()):
                        ?>
                        <div class="question-row">
                            <div class="question-text">
                                <?php echo $row['question'] ?>
                                <input type="hidden" name="qid[]" value="<?php echo $row['id'] ?>">
                            </div>
                            <div class="rating-controls">
                                <div class="rating-group">
                                    <?php for($c=5;$c>=1;$c--): ?>
                                        <input type="radio" name="rate[<?php echo $row['id'] ?>]" id="qradio<?php echo $row['id'].'_'.$c ?>" value="<?php echo $c ?>">
                                        <label for="qradio<?php echo $row['id'].'_'.$c ?>"><?php echo $c ?></label>
                                    <?php endfor; ?>
                                </div>
                            </div>
                        </div>
                        <?php endwhile; ?>
                        </div>
                    </div>
                    <?php endwhile; ?>
                                        
                    <div class="criteria-step" data-step="<?php echo $step_counter + 1 ?>" data-criteria="Additional Comments">
                        <div class="criteria-header mb-3">
                            Additional Comments
                        </div>
                        
                        <!-- Strengths -->
                        <div class="form-group mt-3">
                            <label for="strengths_comment" class="font-weight-bold">1. What do you like most about your teacher?</label>
                            <textarea class="form-control" id="strengths_comment" name="strengths_comment" rows="3" placeholder="Your answer here..." maxlength="500"></textarea>
                            <div id="strengths_char_count" class="char-counter">0/500</div>
                        </div>
                        
                        <!-- Areas for Improvement -->
                        <div class="form-group mt-4">
                            <label for="improvement_comment" class="font-weight-bold">2. What areas could the teacher improve on? Please provide constructive suggestions.</label>
                            <textarea class="form-control" id="improvement_comment" name="improvement_comment" rows="3" placeholder="Your answer here..." maxlength="500"></textarea>
                            <div id="improvement_char_count" class="char-counter">0/500</div>
                        </div>
                    </div>

                    <!-- Step Navigation -->
                    <div class="step-navigation">
                        <button type="button" class="nav-btn prev-btn" id="prevBtn" disabled>
                            <i class="fa fa-chevron-left"></i> Previous
                        </button>
                        <div class="step-validation-message" id="stepValidationMessage">
                            Please answer all questions in this section before proceeding.
                        </div>
                        <button type="button" class="nav-btn next-btn" id="nextBtn">
                            Next <i class="fa fa-chevron-right"></i>
                        </button>
                        <button class="submit-btn" type="submit" id="submitBtn" style="display: none;">
                            Submit Evaluation
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Completion Success Modal -->
<div class="modal fade" id="completionModal" tabindex="-1" role="dialog" aria-labelledby="completionModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-success text-white">
                <h5 class="modal-title" id="completionModalLabel">
                    <i class="fa fa-check-circle"></i> Evaluation Completed!
                </h5>
            </div>
            <div class="modal-body text-center">
                <div class="mb-3">
                    <i class="fa fa-check-circle text-success" style="font-size: 4rem;"></i>
                </div>
                <h4 class="text-success">Thank You!</h4>
                <p class="mb-2">Your evaluation for <strong id="completed-teacher"></strong> has been successfully submitted.</p>
                <p class="text-muted">Subject: <span id="completed-subject"></span></p>
                <p class="text-muted">Completed on: <span id="completion-time"></span></p>
                
                <div class="mt-4">
                    <p class="small text-info">
                        <i class="fa fa-info-circle"></i> 
                        Your feedback helps improve the quality of education.
                    </p>
                </div>
            </div>
            <div class="modal-footer justify-content-center">
                <button type="button" class="btn btn-success" onclick="location.reload()">
                    <i class="fa fa-list"></i> Continue to Next Evaluation
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Preview Submitted Evaluation Modal -->
<div class="modal fade" id="previewModal" tabindex="-1" role="dialog" aria-labelledby="previewModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-dark text-white">
                <h5 class="modal-title" id="previewModalLabel"><i class="fa fa-eye"></i> Your Submitted Answers</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="previewBody">
                <div class="text-center text-muted">Loading...</div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
    </div>

<script>
    $(document).ready(function(){
        // Teacher cards variables
        let selectedTeacher = null;
        let allTeacherCards = [];
        
        // Multi-step evaluation variables
        let currentStep = 1;
        let totalSteps = $('.criteria-step').length;
        
        // Initialize teacher cards
        function initializeTeacherCards() {
            // Collect all teacher card data
            $('.teacher-card').each(function() {
                allTeacherCards.push({
                    element: $(this),
                    rid: $(this).data('rid'),
                    sid: $(this).data('sid'),
                    fid: $(this).data('fid'),
                    faculty: $(this).data('faculty'),
                    subject: $(this).data('subject'),
                    code: $(this).data('code'),
                    completed: $(this).data('completed') === 1,
                    searchText: $(this).data('search')
                });
            });
        }
        
        // Filter teacher cards based on search
        function filterTeacherCards(searchTerm) {
            const term = searchTerm.toLowerCase();
            let visibleCount = 0;
            
            allTeacherCards.forEach(teacher => {
                if (term === '' || teacher.searchText.includes(term)) {
                    teacher.element.show();
                    visibleCount++;
                } else {
                    teacher.element.hide();
                }
            });
            
            return visibleCount;
        }
        
        // Select a teacher from card
        function selectTeacherFromCard(teacherData) {
            selectedTeacher = teacherData;
            
            // Hide teacher grid and show loading
            $('.teachers-grid-container').slideUp();
            $('#loadingSpinner').show();
            
            // Load evaluation form or preview
            loadEvaluationForm(teacherData);
        }
        
        // Load evaluation form dynamically
        function loadEvaluationForm(teacherData) {
            if (teacherData.completed) {
                // Show preview for completed evaluation
                showCompletedEvaluation(teacherData);
                return;
            }
            
            // Show loading spinner
            $('#loadingSpinner').show();
            $('#evaluationFormContainer').hide();
            
            // Simulate loading (in real implementation, you'd make an AJAX call)
            setTimeout(() => {
                // Update form data
                $('input[name="faculty_id"]').val(teacherData.fid);
                $('input[name="restriction_id"]').val(teacherData.rid);
                $('input[name="subject_id"]').val(teacherData.sid);
                
                // Update teacher info in form
                $('.teacher-info h2').text(teacherData.faculty);
                $('.subject-text').text(`${teacherData.code} - ${teacherData.subject}`);
                
                // Add back button
                addBackButton();
                
                // Hide loading and show form
                $('#loadingSpinner').hide();
                $('#evaluationFormContainer').slideDown();
                
                // Initialize multi-step form
                initializeSteps();
                
                // Scroll to form
                $('html, body').animate({
                    scrollTop: $('#evaluationFormContainer').offset().top - 20
                }, 500);
            }, 800);
        }
        
        // Show completed evaluation preview
        function showCompletedEvaluation(teacherData) {
            // Load preview via AJAX
            $.ajax({
                url: 'ajax.php?action=get_student_evaluation',
                method: 'POST',
                data: { 
                    restriction_id: teacherData.rid, 
                    subject_id: teacherData.sid, 
                    faculty_id: teacherData.fid 
                },
                success: function(html) {
                    $('#loadingSpinner').hide();
                    // Add back button to the preview
                    const previewWithBack = `
                        <div class="back-to-teachers" style="margin-bottom: 20px;">
                            <button type="button" class="btn btn-outline-secondary" id="backToTeachers">
                                <i class="fa fa-arrow-left"></i> Back to Teacher List
                            </button>
                        </div>
                        ${html}
                    `;
                    $('#evaluationFormContainer').html(previewWithBack).slideDown();
                },
                error: function() {
                    $('#loadingSpinner').hide();
                    $('#evaluationFormContainer').html(`
                        <div class="back-to-teachers" style="margin-bottom: 20px;">
                            <button type="button" class="btn btn-outline-secondary" id="backToTeachers">
                                <i class="fa fa-arrow-left"></i> Back to Teacher List
                            </button>
                        </div>
                        <div class="alert alert-danger">Failed to load evaluation preview.</div>
                    `).slideDown();
                }
            });
        }
        
        // Event handlers for new card interface
        $('#teacherSearchFilter').on('input', function() {
            const searchTerm = $(this).val();
            filterTeacherCards(searchTerm);
        });
        
        // Teacher card click handlers
        $(document).on('click', '.teacher-card', function(e) {
            // Don't trigger if clicking on action button
            if ($(e.target).closest('.btn-action').length) {
                return;
            }
            
            const teacherData = {
                rid: $(this).data('rid'),
                sid: $(this).data('sid'),
                fid: $(this).data('fid'),
                faculty: $(this).data('faculty'),
                subject: $(this).data('subject'),
                code: $(this).data('code'),
                completed: $(this).data('completed') === 1
            };
            
            selectTeacherFromCard(teacherData);
        });
        
        // Action button handlers - direct to evaluation/view
        $(document).on('click', '.btn-evaluate', function(e) {
            e.stopPropagation();
            const card = $(this).closest('.teacher-card');
            const teacherData = {
                rid: card.data('rid'),
                sid: card.data('sid'),
                fid: card.data('fid'),
                faculty: card.data('faculty'),
                subject: card.data('subject'),
                code: card.data('code'),
                completed: false
            };
            
            // Go directly to evaluation form
            selectTeacherFromCard(teacherData);
        });
        
        $(document).on('click', '.btn-view', function(e) {
            e.stopPropagation();
            const card = $(this).closest('.teacher-card');
            const teacherData = {
                rid: card.data('rid'),
                sid: card.data('sid'),
                fid: card.data('fid'),
                faculty: card.data('faculty'),
                subject: card.data('subject'),
                code: card.data('code'),
                completed: true
            };
            
            // Go directly to view completed evaluation
            selectTeacherFromCard(teacherData);
        });
        
        // Initialize the multi-step form
        function initializeSteps() {
            totalSteps = $('.criteria-step').length;
            if (totalSteps > 0) {
                $('#totalSteps').text(totalSteps);
                showStep(1);
                updateProgress();
                updateStepInfo();
            }
        }
        
        // Show specific step
        function showStep(step) {
            $('.criteria-step').removeClass('active');
            $('[data-step="' + step + '"]').addClass('active');
            currentStep = step;
            
            // Update navigation buttons
            $('#prevBtn').prop('disabled', step === 1);
            
            if (step === totalSteps) {
                $('#nextBtn').hide();
                $('#submitBtn').show();
            } else {
                $('#nextBtn').show();
                $('#submitBtn').hide();
            }
            
            updateProgress();
            updateStepInfo();
            hideValidationMessage();
        }
        
        // Update progress bar
        function updateProgress() {
            const progress = ((currentStep - 1) / (totalSteps - 1)) * 100;
            $('#progressBar').css('width', progress + '%');
        }
        
        // Update step information
        function updateStepInfo() {
            $('#stepCounter').html('Step ' + currentStep + ' of <span id="totalSteps">' + totalSteps + '</span>');
            const criteriaName = $('[data-step="' + currentStep + '"]').data('criteria');
            $('#currentCriteriaName').text(criteriaName);
        }
        
        // Validate current step
        function validateCurrentStep() {
            const currentStepElement = $('[data-step="' + currentStep + '"]');
            const radioGroups = currentStepElement.find('input[type="radio"]');
            
            if (radioGroups.length === 0) {
                // No radio buttons (comment section), always valid
                return true;
            }
            
            // Get unique question IDs in current step
            const questionIds = [];
            radioGroups.each(function() {
                const name = $(this).attr('name');
                if (name && name.startsWith('rate[') && questionIds.indexOf(name) === -1) {
                    questionIds.push(name);
                }
            });
            
            // Check if all questions are answered
            for (let i = 0; i < questionIds.length; i++) {
                const questionName = questionIds[i];
                if (!$('input[name="' + questionName + '"]:checked').length) {
                    return false;
                }
            }
            
            return true;
        }
        
        // Show validation message
        function showValidationMessage() {
            $('#stepValidationMessage').slideDown();
        }
        
        // Hide validation message
        function hideValidationMessage() {
            $('#stepValidationMessage').slideUp();
        }
        
        // Next button click
        $('#nextBtn').click(function() {
            if (validateCurrentStep()) {
                if (currentStep < totalSteps) {
                    showStep(currentStep + 1);
                }
            } else {
                showValidationMessage();
            }
        });
        
        // Previous button click
        $('#prevBtn').click(function() {
            if (currentStep > 1) {
                showStep(currentStep - 1);
            }
        });
        
        // Clear rating button functionality
        $(document).on('click', '.clear-rating-btn', function() {
            const questionRow = $(this).closest('.question-row');
            questionRow.find('input[type="radio"]').prop('checked', false);
        });
        
        // Character counter for comment fields
        function initCharCounter(textareaId, counterId, maxLength) {
            const textarea = $('#' + textareaId);
            const counter = $('#' + counterId);
            
            textarea.on('input', function() {
                const currentLength = $(this).val().length;
                counter.text(currentLength + '/' + maxLength);
            });
            // Initial count
            counter.text(textarea.val().length + '/' + maxLength);
        }

        initCharCounter('strengths_comment', 'strengths_char_count', 500);
        initCharCounter('improvement_comment', 'improvement_char_count', 500);
        
        // Initialize teacher cards
        initializeTeacherCards();
        
        // Add back button to evaluation form
        function addBackButton() {
            if ($('.back-to-teachers').length === 0) {
                const backButton = $(`
                    <div class="back-to-teachers" style="margin-bottom: 20px;">
                        <button type="button" class="btn btn-outline-secondary" id="backToTeachers">
                            <i class="fa fa-arrow-left"></i> Back to Teacher List
                        </button>
                    </div>
                `);
                $('#evaluationFormContainer').prepend(backButton);
            }
        }
        
        // Back to teachers handler
        $(document).on('click', '#backToTeachers', function() {
            $('#evaluationFormContainer').slideUp();
            $('#loadingSpinner').hide();
            $('.teachers-grid-container').slideDown();
            selectedTeacher = null;
        });
g
        // Force the sidebar to be closed and remove the margin
		if('<?php echo $_SESSION['academic']['status'] ?>' == 0){
			uni_modal("Information","<?php echo $_SESSION['login_view_folder'] ?>not_started.php")
		}else if('<?php echo $_SESSION['academic']['status'] ?>' == 2){
			uni_modal("Information","<?php echo $_SESSION['login_view_folder'] ?>closed.php")
		}
	})
	$('#manage-evaluation').submit(function(e){
		e.preventDefault();
		start_load()
		$.ajax({
			url:'ajax.php?action=save_evaluation',
			method:'POST',
			data:$(this).serialize(),
			success:function(resp){
				end_load();
				if(resp == 1){
					// Show completion modal instead of simple toast
					showCompletionModal();
				} else {
					alert_toast("Error saving evaluation. Please try again.","error");
				}
			},
			error:function(xhr, status, error){
				end_load();
				console.log('AJAX Error:', error);
				console.log('Status:', status);
				console.log('Response:', xhr.responseText);
				alert_toast("Connection error. Please check your internet connection and try again.","error");
			}
		})
	})
	
	// Function to show completion modal
	function showCompletionModal() {
		// Get current teacher and subject info
		var teacherName = '<?php echo ucwords($faculty_info) ?>';
		var subjectInfo = '<?php echo $subject_info ?>';
		var currentTime = new Date().toLocaleString();
		
		// Update modal content
		$('#completed-teacher').text(teacherName);
		$('#completed-subject').text(subjectInfo);
		$('#completion-time').text(currentTime);
		
		// Show the modal
		$('#completionModal').modal('show');
	}

    // Reusable function to open preview modal
    function openEvaluationPreview(rid, sid, fid){
        if(!rid) return;
        $('#previewBody').html('<div class="text-center text-muted">Loading...</div>');
        $('#previewModal').modal('show');
        $.ajax({
            url: 'ajax.php?action=get_student_evaluation',
            method: 'POST',
            data: { restriction_id: rid, subject_id: sid, faculty_id: fid },
            success: function(html){
                $('#previewBody').html(html);
            },
            error: function(){
                $('#previewBody').html('<p class="text-danger">Failed to load preview.</p>');
            }
        });
    }

    // Click-to-preview for completed evaluations (entire list item)
    $(document).on('click', '.preview-eval', function(){
        openEvaluationPreview($(this).data('rid'), $(this).data('sid'), $(this).data('fid'));
    });

    // Click-to-preview for the explicit button
    $(document).on('click', '.preview-eval-btn', function(e){
        e.stopPropagation(); // avoid triggering parent anchor click
        openEvaluationPreview($(this).data('rid'), $(this).data('sid'), $(this).data('fid'));
    });
</script>