<?php
include 'db_connect.php';

echo "<h2>Faculty List Debug</h2>";

// Get all faculty members
$faculty_sql = "SELECT id, firstname, lastname, CONCAT(firstname, ' ', lastname) as full_name FROM faculty_list ORDER BY firstname, lastname";
$faculty_result = $conn->query($faculty_sql);

if ($faculty_result && $faculty_result->num_rows > 0) {
    echo "<h3>All Faculty Members:</h3>";
    echo "<table border='1'>";
    echo "<tr><th>ID</th><th>First Name</th><th>Last Name</th><th>Full Name</th></tr>";
    while ($row = $faculty_result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row['id'] . "</td>";
        echo "<td>" . $row['firstname'] . "</td>";
        echo "<td>" . $row['lastname'] . "</td>";
        echo "<td>" . $row['full_name'] . "</td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "<p>No faculty members found</p>";
}

// Find John Mike Garindo specifically
$john_sql = "SELECT id FROM faculty_list WHERE CONCAT(firstname, ' ', lastname) LIKE '%John Mike Garindo%' OR firstname LIKE '%John%' AND lastname LIKE '%Garindo%'";
$john_result = $conn->query($john_sql);

if ($john_result && $john_result->num_rows > 0) {
    echo "<h3>John Mike Garindo Details:</h3>";
    $john_row = $john_result->fetch_assoc();
    $john_id = $john_row['id'];
    echo "<p>Faculty ID: " . $john_id . "</p>";
    
    // Check restriction_list for this faculty
    echo "<h3>Restrictions for John Mike Garindo (ID: $john_id):</h3>";
    $restriction_sql = "SELECT r.*, c.curriculum, c.level, c.section, s.code, s.subject 
                       FROM restriction_list r 
                       LEFT JOIN class_list c ON c.id = r.class_id 
                       LEFT JOIN subject_list s ON s.id = r.subject_id 
                       WHERE r.faculty_id = $john_id";
    
    $restriction_result = $conn->query($restriction_sql);
    if ($restriction_result && $restriction_result->num_rows > 0) {
        echo "<table border='1'>";
        echo "<tr><th>ID</th><th>Academic ID</th><th>Class ID</th><th>Subject ID</th><th>Class</th><th>Subject</th></tr>";
        while ($row = $restriction_result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row['id'] . "</td>";
            echo "<td>" . $row['academic_id'] . "</td>";
            echo "<td>" . $row['class_id'] . "</td>";
            echo "<td>" . $row['subject_id'] . "</td>";
            echo "<td>" . ($row['curriculum'] ? $row['curriculum'] . " " . $row['level'] . " - " . $row['section'] : 'N/A') . "</td>";
            echo "<td>" . ($row['code'] ? $row['code'] . " - " . $row['subject'] : 'N/A') . "</td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "<p>No restrictions found for this faculty member</p>";
    }
} else {
    echo "<p>John Mike Garindo not found in faculty_list</p>";
}

// Check current academic session
session_start();
echo "<h3>Current Academic Session:</h3>";
if (isset($_SESSION['academic']['id'])) {
    echo "<p>Academic ID: " . $_SESSION['academic']['id'] . "</p>";
    
    $academic_sql = "SELECT * FROM academic_list WHERE id = " . $_SESSION['academic']['id'];
    $academic_result = $conn->query($academic_sql);
    if ($academic_result && $academic_result->num_rows > 0) {
        $academic_row = $academic_result->fetch_assoc();
        echo "<p>Year: " . $academic_row['year'] . "</p>";
        echo "<p>Semester: " . $academic_row['semester'] . "</p>";
        echo "<p>Status: " . $academic_row['status'] . "</p>";
    }
} else {
    echo "<p>No academic session set</p>";
}
?>
