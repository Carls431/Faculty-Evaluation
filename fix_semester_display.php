<?php
// Fix semester display issue
include 'db_connect.php';

echo "<h3>Current Academic Data:</h3>";
$result = $conn->query("SELECT * FROM academic_list WHERE is_default = 1");
if($result && $result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "ID: " . $row['id'] . "<br>";
        echo "Year: " . $row['year'] . "<br>";
        echo "Semester: " . $row['semester'] . "<br>";
        echo "Quarter: " . (isset($row['quarter']) ? $row['quarter'] : 'Not set') . "<br>";
        echo "Status: " . $row['status'] . "<br><br>";
    }
} else {
    echo "No default academic year found.<br>";
}

echo "<h3>All Academic Years:</h3>";
$all_result = $conn->query("SELECT * FROM academic_list ORDER BY id DESC LIMIT 5");
if($all_result && $all_result->num_rows > 0) {
    while($row = $all_result->fetch_assoc()) {
        echo "ID: " . $row['id'] . " | Year: " . $row['year'] . " | Semester: " . $row['semester'];
        if(isset($row['quarter'])) {
            echo " | Quarter: " . $row['quarter'];
        }
        echo " | Default: " . ($row['is_default'] ? 'Yes' : 'No') . "<br>";
    }
}

// Check if we need to fix the semester value
echo "<h3>Fix Options:</h3>";
echo "<p>If your current academic year should show '1st Quarter' instead of '0th', ";
echo "you need to update the semester field from 0 to 1.</p>";

echo '<form method="POST">';
echo '<button type="submit" name="fix_semester" style="background: #800000; color: white; padding: 10px 20px; border: none; border-radius: 5px;">Fix Semester Display (Change 0 to 1)</button>';
echo '</form>';

if(isset($_POST['fix_semester'])) {
    $update = $conn->query("UPDATE academic_list SET semester = 1 WHERE is_default = 1 AND semester = 0");
    if($update) {
        echo "<div style='background: #d4edda; color: #155724; padding: 10px; border-radius: 5px; margin: 10px 0;'>";
        echo "✅ Successfully updated semester field. Please refresh the evaluation page to see the change.";
        echo "</div>";
    } else {
        echo "<div style='background: #f8d7da; color: #721c24; padding: 10px; border-radius: 5px; margin: 10px 0;'>";
        echo "❌ Error updating semester field: " . $conn->error;
        echo "</div>";
    }
}
?>
