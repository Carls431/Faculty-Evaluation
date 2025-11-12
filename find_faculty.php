<?php
include 'db_connect.php';

// Get all faculty members to find John Mike Garindo
$result = $conn->query("SELECT id, firstname, lastname, CONCAT(firstname, ' ', lastname) as name FROM faculty_list ORDER BY firstname, lastname");

echo "All Faculty Members:\n";
while($row = $result->fetch_assoc()) {
    echo "ID: " . $row['id'] . " - Name: " . $row['name'] . "\n";
}
?>
