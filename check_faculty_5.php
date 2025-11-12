<?php
include 'db_connect.php';

echo "Checking Faculty ID 5 (John Mike Garrido):\n\n";

// Check restrictions for faculty ID 5
$result = $conn->query("SELECT COUNT(*) as count FROM restriction_list WHERE faculty_id = 5");
$row = $result->fetch_assoc();
echo "Total restrictions for faculty ID 5: " . $row['count'] . "\n\n";

// Get detailed restrictions
$result2 = $conn->query("SELECT r.*, c.curriculum, c.level, c.section, s.code, s.subject 
                        FROM restriction_list r 
                        LEFT JOIN class_list c ON c.id = r.class_id 
                        LEFT JOIN subject_list s ON s.id = r.subject_id 
                        WHERE r.faculty_id = 5");

if($result2->num_rows > 0) {
    echo "Detailed restrictions:\n";
    while($row = $result2->fetch_assoc()) {
        echo "Academic: " . $row['academic_id'] . 
             ", Class: " . $row['curriculum'] . " " . $row['level'] . " - " . $row['section'] . 
             ", Subject: " . $row['code'] . " - " . $row['subject'] . "\n";
    }
} else {
    echo "No restrictions found for faculty ID 5\n";
}

// Check current academic session
session_start();
echo "\nCurrent academic session: " . (isset($_SESSION['academic']['id']) ? $_SESSION['academic']['id'] : 'Not set') . "\n";
?>
