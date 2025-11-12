<?php
session_start();
include 'db_connect.php';
include 'admin_class.php';

// Set up test session (you'll need to adjust these values based on your actual data)
$_SESSION['academic']['id'] = 3; // Adjust this to match your current academic year

$crud = new Action();

// Test with a faculty ID (you'll need to check what faculty IDs exist in your database)
$_POST['fid'] = 1; // Change this to an actual faculty ID from your database

echo "<h2>Testing Faculty Stats Function</h2>";
echo "<h3>Faculty ID: " . $_POST['fid'] . "</h3>";
echo "<h3>Academic ID: " . $_SESSION['academic']['id'] . "</h3>";

// Test the function
$result = $crud->get_faculty_stats();
echo "<h3>JSON Result:</h3>";
echo "<pre>" . $result . "</pre>";

// Parse and display nicely
$data = json_decode($result, true);
echo "<h3>Parsed Data:</h3>";
echo "<ul>";
echo "<li>Total Students: " . $data['total_students'] . "</li>";
echo "<li>Evaluated Count: " . $data['evaluated_count'] . "</li>";
echo "<li>Pending Count: " . $data['pending_count'] . "</li>";
echo "<li>Completion Rate: " . $data['completion_rate'] . "%</li>";
echo "</ul>";

// Check if debug file was created
if(file_exists('debug_faculty_stats.txt')) {
    echo "<h3>Debug Information:</h3>";
    echo "<pre>" . file_get_contents('debug_faculty_stats.txt') . "</pre>";
}

// Let's also check what faculty members exist
echo "<h3>Available Faculty Members:</h3>";
$faculty_query = "SELECT id, firstname, lastname FROM faculty_list ORDER BY firstname";
$faculty_result = $conn->query($faculty_query);
if($faculty_result && $faculty_result->num_rows > 0) {
    echo "<ul>";
    while($row = $faculty_result->fetch_assoc()) {
        echo "<li>ID: " . $row['id'] . " - " . $row['firstname'] . " " . $row['lastname'] . "</li>";
    }
    echo "</ul>";
} else {
    echo "No faculty members found.";
}

// Check restriction list
echo "<h3>Restriction List (Faculty-Class assignments):</h3>";
$restriction_query = "SELECT r.faculty_id, r.class_id, r.academic_id, 
                      CONCAT(f.firstname, ' ', f.lastname) as faculty_name,
                      CONCAT(c.curriculum, ' ', c.level, ' - ', c.section) as class_name
                      FROM restriction_list r 
                      LEFT JOIN faculty_list f ON r.faculty_id = f.id
                      LEFT JOIN class_list c ON r.class_id = c.id
                      WHERE r.academic_id = " . $_SESSION['academic']['id'] . "
                      ORDER BY faculty_name";
$restriction_result = $conn->query($restriction_query);
if($restriction_result && $restriction_result->num_rows > 0) {
    echo "<ul>";
    while($row = $restriction_result->fetch_assoc()) {
        echo "<li>Faculty: " . $row['faculty_name'] . " (ID: " . $row['faculty_id'] . ") - Class: " . $row['class_name'] . " (ID: " . $row['class_id'] . ")</li>";
    }
    echo "</ul>";
} else {
    echo "No faculty-class assignments found for current academic year.";
}

// Check student list
echo "<h3>Students in Classes:</h3>";
$student_query = "SELECT c.id as class_id, 
                  CONCAT(c.curriculum, ' ', c.level, ' - ', c.section) as class_name,
                  COUNT(s.id) as student_count
                  FROM class_list c 
                  LEFT JOIN student_list s ON c.id = s.class_id
                  GROUP BY c.id
                  ORDER BY class_name";
$student_result = $conn->query($student_query);
if($student_result && $student_result->num_rows > 0) {
    echo "<ul>";
    while($row = $student_result->fetch_assoc()) {
        echo "<li>Class: " . $row['class_name'] . " (ID: " . $row['class_id'] . ") - Students: " . $row['student_count'] . "</li>";
    }
    echo "</ul>";
} else {
    echo "No students found.";
}
?>
