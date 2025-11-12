<?php
include 'db_connect.php';

echo "<h2>Fix: ESP-10 Evaluation for Fernando</h2>";

// Fernando's info from debug results
$fernando_id = 10;
$fernando_class = 7;
$ryan_faculty_id = 10;
$current_academic_id = 4;

// The specific restriction ID for ESP-10 - G10- Values
$esp_restriction_id = 40;

echo "Student: Fernando (ID: $fernando_id)<br>";
echo "Faculty: Ryan Jim Bachinela (ID: $ryan_faculty_id)<br>";
echo "Subject: ESP-10 - G10- Values<br>";
echo "Restriction ID: $esp_restriction_id<br><br>";

// Check if ESP-10 evaluation already exists
$check_query = "SELECT * FROM evaluation_list 
                WHERE student_id = $fernando_id 
                AND faculty_id = $ryan_faculty_id 
                AND restriction_id = $esp_restriction_id
                AND academic_id = $current_academic_id";

$check_result = $conn->query($check_query);

if($check_result->num_rows > 0) {
    echo "<strong style='color: green;'>✓ ESP-10 evaluation already exists!</strong><br>";
    $evaluation = $check_result->fetch_assoc();
    echo "Evaluation ID: " . $evaluation['id'] . "<br>";
    echo "Date Taken: " . $evaluation['date_taken'] . "<br>";
    echo "The evaluation should show as COMPLETED now.<br>";
} else {
    echo "<strong style='color: red;'>✗ ESP-10 evaluation missing</strong><br>";
    echo "You need to complete the evaluation for ESP-10 - G10- Values<br>";
    echo "Go to the student evaluation page and evaluate Ryan Jim Bachinela for ESP-10<br>";
}

echo "<h3>Next Steps:</h3>";
echo "1. Go back to: <a href='student/evaluate.php'>Student Evaluation Page</a><br>";
echo "2. Look for Ryan Jim Bachinela - ESP-10 - G10- Values<br>";
echo "3. Click 'Start Evaluation' to complete the missing evaluation<br>";
echo "4. After completion, it should show as COMPLETED<br>";
?>
