<?php
include 'db_connect.php';

echo "<h3>Current Classes in Database:</h3>";
$classes = $conn->query("SELECT * FROM class_list ORDER BY curriculum, level, section");

if ($classes->num_rows > 0) {
    echo "<table border='1' style='border-collapse: collapse; width: 100%;'>";
    echo "<tr><th>ID</th><th>Curriculum</th><th>Level</th><th>Section</th><th>Display Format</th></tr>";
    
    while($row = $classes->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row['id'] . "</td>";
        echo "<td>" . $row['curriculum'] . "</td>";
        echo "<td>" . $row['level'] . "</td>";
        echo "<td>" . $row['section'] . "</td>";
        echo "<td>" . $row['curriculum'] . ' ' . $row['level'] . ' - ' . $row['section'] . "</td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "No classes found in database.";
}

$conn->close();
?>
