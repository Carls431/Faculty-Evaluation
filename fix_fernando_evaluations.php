<?php
include 'db_connect.php';

echo "<h2>Fix: Fernando's Reset Evaluations</h2>";

// Fernando's info
$fernando_id = 10;
$ryan_faculty_id = 10;
$current_academic_id = 4;

echo "<h3>Problem:</h3>";
echo "Fernando completed evaluations but they show as PENDING because restriction IDs changed<br><br>";

echo "<h3>Current Situation:</h3>";
echo "Fernando's completed evaluations use OLD restriction IDs:<br>";
echo "- AP-10: restriction_id 36 (OLD)<br>";
echo "- ENG-10: restriction_id 37 (OLD)<br><br>";

echo "Current system uses NEW restriction IDs:<br>";
echo "- AP-10: restriction_id 38 (NEW)<br>";
echo "- ENG-10: restriction_id 39 (NEW)<br><br>";

echo "<h3>Fix: Update restriction IDs</h3>";

// Update AP-10 evaluation
$update_ap_query = "UPDATE evaluation_list 
                    SET restriction_id = 38 
                    WHERE student_id = $fernando_id 
                    AND faculty_id = $ryan_faculty_id 
                    AND restriction_id = 36";

echo "Updating AP-10 evaluation...<br>";
if($conn->query($update_ap_query)) {
    echo "✓ AP-10 evaluation updated (restriction_id: 36 → 38)<br>";
} else {
    echo "✗ Error updating AP-10: " . $conn->error . "<br>";
}

// Update ENG-10 evaluation  
$update_eng_query = "UPDATE evaluation_list 
                     SET restriction_id = 39 
                     WHERE student_id = $fernando_id 
                     AND faculty_id = $ryan_faculty_id 
                     AND restriction_id = 37";

echo "Updating ENG-10 evaluation...<br>";
if($conn->query($update_eng_query)) {
    echo "✓ ENG-10 evaluation updated (restriction_id: 37 → 39)<br>";
} else {
    echo "✗ Error updating ENG-10: " . $conn->error . "<br>";
}

echo "<br><h3>Verification:</h3>";
$verify_query = "SELECT e.*, 
                        CONCAT(s.code, ' - ', s.subject) as subject_info
                 FROM evaluation_list e
                 LEFT JOIN restriction_list r ON r.id = e.restriction_id
                 LEFT JOIN subject_list s ON s.id = r.subject_id
                 WHERE e.student_id = $fernando_id 
                 AND e.faculty_id = $ryan_faculty_id
                 AND e.academic_id = $current_academic_id";

$verify_result = $conn->query($verify_query);
if($verify_result->num_rows > 0) {
    echo "Fernando's current evaluations:<br>";
    while($row = $verify_result->fetch_assoc()) {
        echo "- " . $row['subject_info'] . " (restriction_id: " . $row['restriction_id'] . ") - " . $row['date_taken'] . "<br>";
    }
} else {
    echo "No evaluations found<br>";
}

echo "<br><h3>Result:</h3>";
echo "✓ Fernando's evaluations should now show as COMPLETED<br>";
echo "✓ Go back to student evaluation page to verify<br>";
echo "✓ AP-10 and ENG-10 should have green COMPLETED status<br>";
?>
