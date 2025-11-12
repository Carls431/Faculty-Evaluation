<?php
include 'db_connect.php';

echo "<h2>Fix: Evaluation Issue for Fernando & Ryan Jim Bachinela</h2>";

// Get current academic year
$academic_query = "SELECT * FROM academic_list WHERE is_default = 1";
$academic_result = $conn->query($academic_query);
$current_academic_id = $academic_result->fetch_assoc()['id'];

// Find Fernando's student ID
$student_query = "SELECT * FROM student_list WHERE firstname LIKE '%Fernando%' OR lastname LIKE '%Fernando%'";
$student_result = $conn->query($student_query);
if($student_result->num_rows > 0) {
    $student = $student_result->fetch_assoc();
    $fernando_id = $student['id'];
    $fernando_class = $student['class_id'];
    echo "Found Fernando - Student ID: $fernando_id, Class ID: $fernando_class<br><br>";
} else {
    die("Fernando not found in database.");
}

// Find Ryan Jim Bachinela's faculty ID
$faculty_query = "SELECT * FROM faculty_list WHERE firstname LIKE '%Ryan%' AND lastname LIKE '%Bachinela%'";
$faculty_result = $conn->query($faculty_query);
if($faculty_result->num_rows > 0) {
    $faculty = $faculty_result->fetch_assoc();
    $ryan_faculty_id = $faculty['id'];
    echo "Found Ryan Jim Bachinela - Faculty ID: $ryan_faculty_id<br><br>";
} else {
    die("Ryan Jim Bachinela not found in database.");
}

// Check for existing evaluation
echo "<h3>Step 1: Checking existing evaluation records</h3>";
$existing_eval_query = "SELECT * FROM evaluation_list 
                        WHERE student_id = $fernando_id 
                        AND faculty_id = $ryan_faculty_id 
                        AND academic_id = $current_academic_id";
$existing_eval_result = $conn->query($existing_eval_query);

if($existing_eval_result->num_rows > 0) {
    $evaluation = $existing_eval_result->fetch_assoc();
    echo "Found existing evaluation - ID: " . $evaluation['id'] . "<br>";
    echo "Current restriction_id in evaluation: " . $evaluation['restriction_id'] . "<br>";
    
    // Find the current/correct restriction ID
    echo "<h3>Step 2: Finding current restriction ID</h3>";
    $current_restriction_query = "SELECT r.id FROM restriction_list r
                                  WHERE r.faculty_id = $ryan_faculty_id
                                  AND r.academic_id = $current_academic_id
                                  AND r.class_id = $fernando_class
                                  ORDER BY r.id DESC LIMIT 1";
    $current_restriction_result = $conn->query($current_restriction_query);
    
    if($current_restriction_result->num_rows > 0) {
        $current_restriction = $current_restriction_result->fetch_assoc();
        $correct_restriction_id = $current_restriction['id'];
        echo "Current restriction ID: $correct_restriction_id<br>";
        
        if($evaluation['restriction_id'] != $correct_restriction_id) {
            echo "<h3>Step 3: Fixing the mismatch</h3>";
            echo "<strong style='color: red;'>MISMATCH DETECTED!</strong><br>";
            echo "Evaluation restriction_id: " . $evaluation['restriction_id'] . "<br>";
            echo "Current restriction_id: $correct_restriction_id<br><br>";
            
            // Update the evaluation record
            $update_query = "UPDATE evaluation_list 
                            SET restriction_id = $correct_restriction_id 
                            WHERE id = " . $evaluation['id'];
            
            if($conn->query($update_query)) {
                echo "<strong style='color: green;'>✓ FIXED!</strong><br>";
                echo "Updated evaluation record with correct restriction_id<br>";
                echo "Ryan Jim Bachinela should now show as COMPLETED<br>";
            } else {
                echo "<strong style='color: red;'>✗ ERROR:</strong> " . $conn->error . "<br>";
            }
        } else {
            echo "<strong style='color: green;'>No mismatch found - restriction IDs match</strong><br>";
        }
    } else {
        echo "<strong style='color: red;'>ERROR: No current restriction found for Ryan Jim Bachinela</strong><br>";
    }
} else {
    echo "No existing evaluation found for Fernando + Ryan Jim Bachinela<br>";
    echo "This means the evaluation was never completed or was deleted<br>";
}

// Clean up duplicate restrictions (optional)
echo "<h3>Step 4: Checking for duplicate restrictions</h3>";
$duplicate_query = "SELECT COUNT(*) as count FROM restriction_list 
                     WHERE faculty_id = $ryan_faculty_id 
                     AND academic_id = $current_academic_id 
                     AND class_id = $fernando_class";
$duplicate_result = $conn->query($duplicate_query);
$duplicate_count = $duplicate_result->fetch_assoc()['count'];

if($duplicate_count > 1) {
    echo "<strong style='color: orange;'>WARNING:</strong> Found $duplicate_count duplicate restrictions<br>";
    echo "Consider cleaning up duplicates to prevent future issues<br>";
    
    // Show all duplicates
    $all_restrictions_query = "SELECT r.*, CONCAT(s.code, ' - ', s.subject) as subject_info
                               FROM restriction_list r
                               LEFT JOIN subject_list s ON s.id = r.subject_id
                               WHERE r.faculty_id = $ryan_faculty_id 
                               AND r.academic_id = $current_academic_id 
                               AND r.class_id = $fernando_class
                               ORDER BY r.id";
    $all_restrictions_result = $conn->query($all_restrictions_query);
    
    echo "<br>All restrictions for Ryan Jim Bachinela:<br>";
    while($row = $all_restrictions_result->fetch_assoc()) {
        echo "ID: " . $row['id'] . " - Subject: " . $row['subject_info'] . "<br>";
    }
} else {
    echo "No duplicate restrictions found<br>";
}

echo "<h3>Step 5: Verification</h3>";
echo "Go back to the student evaluation page and check if Ryan Jim Bachinela now shows as COMPLETED<br>";
echo "If the issue persists, there might be other factors involved<br>";
?>
