<?php
include('db_connect.php');

echo "<h3>Current Grade Levels in Database:</h3>";
$grade_qry = $conn->query("SELECT DISTINCT level FROM class_list ORDER BY CAST(level AS UNSIGNED) ASC");
while($grade_row = $grade_qry->fetch_assoc()) {
    echo "Grade " . $grade_row['level'] . "<br>";
}

echo "<hr><h3>All Sections:</h3>";
$all_qry = $conn->query("SELECT *,concat(curriculum,' ',level,'-',section) as `class` FROM class_list order by level asc, section asc");
while($row = $all_qry->fetch_assoc()) {
    echo "Level: " . $row['level'] . " - " . $row['class'] . "<br>";
}
?>
