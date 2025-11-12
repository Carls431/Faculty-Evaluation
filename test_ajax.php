<?php
session_start();
include 'db_connect.php';
include 'admin_class.php';

// Simulate the AJAX call
$_POST['fid'] = 2; // Try faculty ID 2 first
if (!isset($_SESSION['academic']['id'])) {
    $_SESSION['academic']['id'] = 3; // Set default academic ID
}

echo "Testing get_class function...\n";
echo "Faculty ID: " . $_POST['fid'] . "\n";
echo "Academic ID: " . $_SESSION['academic']['id'] . "\n\n";

$crud = new Action();
$result = $crud->get_class();

echo "Result: " . $result . "\n\n";

// Also test the direct query
$faculty_id = intval($_POST['fid']);
$academic_id = intval($_SESSION['academic']['id']);

$sql = "SELECT c.id, 
               CONCAT(c.curriculum,' ',c.level,' - ',c.section) as class,
               s.id as sid,
               CONCAT(s.code,' - ',s.subject) as subj 
        FROM restriction_list r 
        INNER JOIN class_list c ON c.id = r.class_id 
        INNER JOIN subject_list s ON s.id = r.subject_id 
        WHERE r.faculty_id = {$faculty_id} 
        AND r.academic_id = {$academic_id}
        ORDER BY c.curriculum, c.level, c.section, s.subject";

echo "SQL Query: " . $sql . "\n\n";

$get = $conn->query($sql);
if ($get) {
    echo "Query executed successfully. Rows found: " . $get->num_rows . "\n";
    if ($get->num_rows > 0) {
        while($row = $get->fetch_assoc()) {
            echo "Class: " . $row['class'] . " - Subject: " . $row['subj'] . "\n";
        }
    }
} else {
    echo "Query failed: " . $conn->error . "\n";
}

// Check if faculty exists in restriction_list at all
$check_sql = "SELECT COUNT(*) as count FROM restriction_list WHERE faculty_id = {$faculty_id}";
$check_result = $conn->query($check_sql);
if ($check_result) {
    $count = $check_result->fetch_assoc()['count'];
    echo "\nFaculty {$faculty_id} has {$count} total restrictions in any academic period\n";
}

// Check what academic periods exist for this faculty
$academic_sql = "SELECT DISTINCT academic_id FROM restriction_list WHERE faculty_id = {$faculty_id}";
$academic_result = $conn->query($academic_sql);
if ($academic_result && $academic_result->num_rows > 0) {
    echo "Academic periods for faculty {$faculty_id}: ";
    while($row = $academic_result->fetch_assoc()) {
        echo $row['academic_id'] . " ";
    }
    echo "\n";
}
?>
