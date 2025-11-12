<?php
include 'db_connect.php';

// Update the weight of School and Community Service criteria
$update = $conn->query("UPDATE criteria_list SET weight = 0.20 WHERE id = 4 AND criteria = 'School and community Service'");

if($update) {
    echo "<h3>Update Successful!</h3>";
    echo "<p>The weight for 'School and Community Service' criteria has been updated to 20%.</p>";
} else {
    echo "<h3>Update Failed!</h3>";
    echo "<p>Error: " . $conn->error . "</p>";
}

echo "<p><a href='admin/index.php?page=report'>Go to Report Page</a></p>";
?>