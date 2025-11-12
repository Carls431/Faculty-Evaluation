<?php
include 'db_connect.php';

echo "<h3>Database Structure Check</h3>";

// Check class_list table structure
echo "<h4>class_list table structure:</h4>";
$result = $conn->query("DESCRIBE class_list");
if ($result) {
    echo "<table border='1'>";
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

// Check if adviser_faculty_id column exists
echo "<h4>Checking for adviser_faculty_id column:</h4>";
$check_column = $conn->query("SHOW COLUMNS FROM class_list LIKE 'adviser_faculty_id'");
if ($check_column && $check_column->num_rows > 0) {
    echo "<p style='color: green;'>✓ adviser_faculty_id column EXISTS</p>";
} else {
    echo "<p style='color: red;'>✗ adviser_faculty_id column DOES NOT EXIST</p>";
}

// Check faculty_list table structure
echo "<h4>faculty_list table structure:</h4>";
$result2 = $conn->query("DESCRIBE faculty_list");
if ($result2) {
    echo "<table border='1'>";
    echo "<tr><th>Field</th><th>Type</th><th>Null</th><th>Key</th><th>Default</th><th>Extra</th></tr>";
    while ($row = $result2->fetch_assoc()) {
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

// Check restriction_list table structure
echo "<h4>restriction_list table structure:</h4>";
$result3 = $conn->query("DESCRIBE restriction_list");
if ($result3) {
    echo "<table border='1'>";
    echo "<tr><th>Field</th><th>Type</th><th>Null</th><th>Key</th><th>Default</th><th>Extra</th></tr>";
    while ($row = $result3->fetch_assoc()) {
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

$conn->close();
?>
