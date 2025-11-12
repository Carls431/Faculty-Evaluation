<?php
include 'db_connect.php';

echo "Academic Periods:\n";
$result = $conn->query("SELECT * FROM academic_list ORDER BY id DESC");
while($row = $result->fetch_assoc()) {
    echo "ID: " . $row['id'] . 
         " - Year: " . $row['year'] . 
         " - Semester: " . $row['semester'] . 
         " - Status: " . $row['status'] . 
         " - Default: " . $row['is_default'] . "\n";
}
?>
