<?php
include 'db_connect.php';

echo "<h2>Database Records Test</h2>";

// Check if database connection works
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo "<p style='color: green;'>✓ Database connection successful</p>";

// Check students
$students = $conn->query("SELECT COUNT(*) as count FROM student_list");
$student_count = $students->fetch_assoc()['count'];
echo "<p><strong>Students:</strong> $student_count records</p>";

// Check classes
$classes = $conn->query("SELECT COUNT(*) as count FROM class_list");
$class_count = $classes->fetch_assoc()['count'];
echo "<p><strong>Classes:</strong> $class_count records</p>";

// Check faculty
$faculty = $conn->query("SELECT COUNT(*) as count FROM faculty_list");
$faculty_count = $faculty->fetch_assoc()['count'];
echo "<p><strong>Faculty:</strong> $faculty_count records</p>";

// Check evaluations
$evaluations = $conn->query("SELECT COUNT(*) as count FROM evaluation_list");
$eval_count = $evaluations->fetch_assoc()['count'];
echo "<p><strong>Evaluations:</strong> $eval_count records</p>";

// Check restrictions (evaluation assignments)
$restrictions = $conn->query("SELECT COUNT(*) as count FROM restriction_list");
$restriction_count = $restrictions->fetch_assoc()['count'];
echo "<p><strong>Evaluation Assignments:</strong> $restriction_count records</p>";

// Show sample data
echo "<h3>Sample Students:</h3>";
$sample_students = $conn->query("SELECT s.*, CONCAT(c.curriculum, ' ', c.level, ' - ', c.section) as class_name 
                                 FROM student_list s 
                                 LEFT JOIN class_list c ON c.id = s.class_id 
                                 LIMIT 5");
if ($sample_students->num_rows > 0) {
    echo "<table border='1' style='border-collapse: collapse; width: 100%;'>";
    echo "<tr><th>ID</th><th>Name</th><th>School ID</th><th>Class</th></tr>";
    while($row = $sample_students->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row['id'] . "</td>";
        echo "<td>" . $row['firstname'] . " " . $row['lastname'] . "</td>";
        echo "<td>" . ($row['school_id'] ?? 'N/A') . "</td>";
        echo "<td>" . ($row['class_name'] ?? 'No class assigned') . "</td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "<p style='color: red;'>No student records found</p>";
}

echo "<h3>Sample Faculty:</h3>";
$sample_faculty = $conn->query("SELECT * FROM faculty_list LIMIT 5");
if ($sample_faculty->num_rows > 0) {
    echo "<table border='1' style='border-collapse: collapse; width: 100%;'>";
    echo "<tr><th>ID</th><th>Name</th><th>Email</th></tr>";
    while($row = $sample_faculty->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row['id'] . "</td>";
        echo "<td>" . $row['firstname'] . " " . $row['lastname'] . "</td>";
        echo "<td>" . $row['email'] . "</td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "<p style='color: red;'>No faculty records found</p>";
}

$conn->close();
?>
