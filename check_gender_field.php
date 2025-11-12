<?php
include 'db_connect.php';

echo "<h3>Checking faculty_list table structure:</h3>";

// Check if gender field exists
$result = $conn->query("DESCRIBE faculty_list");
if ($result) {
    echo "<table border='1' style='border-collapse: collapse; margin: 10px 0;'>";
    echo "<tr><th>Field</th><th>Type</th><th>Null</th><th>Key</th><th>Default</th><th>Extra</th></tr>";
    while ($row = $result->fetch_assoc()) {
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
} else {
    echo "Error: " . $conn->error;
}

echo "<h3>Current faculty data with gender:</h3>";

// Check current faculty data
$faculty_result = $conn->query("SELECT id, school_id, firstname, lastname, 
    CASE 
        WHEN gender = 'Male' THEN CONCAT('Mr. ', firstname, ' ', lastname)
        WHEN gender = 'Female' THEN CONCAT('Ms. ', firstname, ' ', lastname)
        ELSE CONCAT(firstname, ' ', lastname)
    END as display_name,
    gender 
FROM faculty_list ORDER BY firstname");

if ($faculty_result) {
    echo "<table border='1' style='border-collapse: collapse; margin: 10px 0;'>";
    echo "<tr><th>ID</th><th>Teacher ID</th><th>Display Name</th><th>Gender</th></tr>";
    while ($row = $faculty_result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row['id'] . "</td>";
        echo "<td>" . $row['school_id'] . "</td>";
        echo "<td><strong>" . $row['display_name'] . "</strong></td>";
        echo "<td>" . $row['gender'] . "</td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "Error checking faculty data: " . $conn->error;
}

$conn->close();
?>
