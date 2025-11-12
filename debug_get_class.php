<?php
session_start();
include 'db_connect.php';
include 'admin_class.php';

// Set up test data
$_POST['fid'] = 1; // Test with faculty ID 1
$_SESSION['academic']['id'] = 3; // Current academic year from database

echo "<h2>Debug get_class() function</h2>";
echo "<p>Faculty ID: " . $_POST['fid'] . "</p>";
echo "<p>Academic ID: " . $_SESSION['academic']['id'] . "</p>";

$crud = new Action();
$result = $crud->get_class();

echo "<h3>Raw Result:</h3>";
echo "<pre>" . htmlspecialchars($result) . "</pre>";

echo "<h3>Parsed Result:</h3>";
$parsed = json_decode($result, true);
if ($parsed) {
    echo "<pre>" . print_r($parsed, true) . "</pre>";
} else {
    echo "<p>Failed to parse JSON</p>";
}

// Let's also check the restriction_list table directly
echo "<h3>Direct Database Query:</h3>";
$sql = "SELECT r.*, c.curriculum, c.level, c.section, s.code, s.subject 
        FROM restriction_list r 
        LEFT JOIN class_list c ON c.id = r.class_id 
        LEFT JOIN subject_list s ON s.id = r.subject_id 
        WHERE r.faculty_id = 1 AND r.academic_id = 3";
        
$result_direct = $conn->query($sql);
if ($result_direct && $result_direct->num_rows > 0) {
    echo "<table border='1'>";
    echo "<tr><th>ID</th><th>Faculty ID</th><th>Class ID</th><th>Subject ID</th><th>Class</th><th>Subject</th></tr>";
    while ($row = $result_direct->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row['id'] . "</td>";
        echo "<td>" . $row['faculty_id'] . "</td>";
        echo "<td>" . $row['class_id'] . "</td>";
        echo "<td>" . $row['subject_id'] . "</td>";
        echo "<td>" . $row['curriculum'] . " " . $row['level'] . " - " . $row['section'] . "</td>";
        echo "<td>" . $row['code'] . " - " . $row['subject'] . "</td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "<p>No records found in restriction_list for faculty_id=1, academic_id=3</p>";
}

// Check all faculty IDs in restriction_list
echo "<h3>All Faculty IDs in restriction_list:</h3>";
$faculty_sql = "SELECT DISTINCT faculty_id FROM restriction_list";
$faculty_result = $conn->query($faculty_sql);
if ($faculty_result) {
    while ($row = $faculty_result->fetch_assoc()) {
        echo "Faculty ID: " . $row['faculty_id'] . "<br>";
    }
}
?>
