<?php
include 'db_connect.php';

echo "<h3>Current Subjects in Database:</h3>";
echo "<table border='1' style='border-collapse: collapse; width: 100%;'>";
echo "<tr><th>ID</th><th>Code</th><th>Subject</th><th>Description</th></tr>";

$qry = $conn->query("SELECT * FROM subject_list ORDER BY code ASC");
while($row = $qry->fetch_assoc()) {
    echo "<tr>";
    echo "<td>" . $row['id'] . "</td>";
    echo "<td><strong>" . $row['code'] . "</strong></td>";
    echo "<td>" . $row['subject'] . "</td>";
    echo "<td>" . $row['description'] . "</td>";
    echo "</tr>";
}

echo "</table>";
echo "<br><p><strong>Total subjects: " . $qry->num_rows . "</strong></p>";
?>
