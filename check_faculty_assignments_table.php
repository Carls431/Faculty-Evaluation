<?php
include 'db_connect.php';

echo "<h3>Checking faculty_class_assignments table...</h3>";

// Check if table exists
$check_table = $conn->query("SHOW TABLES LIKE 'faculty_class_assignments'");
if($check_table->num_rows == 0) {
    echo "<p>Table doesn't exist. Creating...</p>";
    
    // Create table
    $create_table = "
    CREATE TABLE `faculty_class_assignments` (
        `id` int(11) NOT NULL AUTO_INCREMENT,
        `faculty_id` int(11) NOT NULL,
        `class_id` int(11) NOT NULL,
        `subject_id` int(11) NOT NULL,
        PRIMARY KEY (`id`),
        UNIQUE KEY `unique_assignment` (`faculty_id`, `class_id`, `subject_id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
    ";
    
    if($conn->query($create_table)) {
        echo "<p style='color: green;'>✓ Table created successfully!</p>";
    } else {
        echo "<p style='color: red;'>✗ Error creating table: " . $conn->error . "</p>";
    }
} else {
    echo "<p style='color: green;'>✓ Table exists!</p>";
    
    // Check table structure
    echo "<h4>Table Structure:</h4>";
    $structure = $conn->query("DESCRIBE faculty_class_assignments");
    echo "<table border='1'><tr><th>Field</th><th>Type</th><th>Null</th><th>Key</th><th>Default</th><th>Extra</th></tr>";
    while($row = $structure->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row['Field'] . "</td>";
        echo "<td>" . $row['Type'] . "</td>";
        echo "<td>" . $row['Null'] . "</td>";
        echo "<td>" . $row['Key'] . "</td>";
        echo "<td>" . $row['Default'] . "</td>";
        echo "<td>" . $row['Extra'] . "</td>";
        echo "</tr>";
    }
    echo "</table>";
    
    // Check if academic_id column exists (should be removed)
    $check_academic = $conn->query("SHOW COLUMNS FROM faculty_class_assignments LIKE 'academic_id'");
    if($check_academic->num_rows > 0) {
        echo "<p style='color: orange;'>⚠ academic_id column still exists. Removing...</p>";
        
        // Drop the column
        if($conn->query("ALTER TABLE faculty_class_assignments DROP COLUMN academic_id")) {
            echo "<p style='color: green;'>✓ academic_id column removed!</p>";
        } else {
            echo "<p style='color: red;'>✗ Error removing academic_id: " . $conn->error . "</p>";
        }
        
        // Update unique constraint
        $conn->query("ALTER TABLE faculty_class_assignments DROP INDEX unique_assignment");
        if($conn->query("ALTER TABLE faculty_class_assignments ADD UNIQUE KEY unique_assignment (faculty_id, class_id, subject_id)")) {
            echo "<p style='color: green;'>✓ Unique constraint updated!</p>";
        } else {
            echo "<p style='color: red;'>✗ Error updating constraint: " . $conn->error . "</p>";
        }
    }
}

// Check sample data
echo "<h4>Sample Data:</h4>";
$sample = $conn->query("SELECT COUNT(*) as count FROM faculty_class_assignments");
$count = $sample->fetch_assoc()['count'];
echo "<p>Total assignments: " . $count . "</p>";

if($count > 0) {
    echo "<h5>First 5 records:</h5>";
    $data = $conn->query("SELECT * FROM faculty_class_assignments LIMIT 5");
    echo "<table border='1'><tr><th>ID</th><th>Faculty ID</th><th>Class ID</th><th>Subject ID</th></tr>";
    while($row = $data->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row['id'] . "</td>";
        echo "<td>" . $row['faculty_id'] . "</td>";
        echo "<td>" . $row['class_id'] . "</td>";
        echo "<td>" . $row['subject_id'] . "</td>";
        echo "</tr>";
    }
    echo "</table>";
}

echo "<p><a href='admin/faculty_assignments.php'>← Back to Faculty Assignments</a></p>";
?>
