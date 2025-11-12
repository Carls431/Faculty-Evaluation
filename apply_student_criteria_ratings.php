<?php
include 'db_connect.php';

// Display header
echo "<h2>Adding student_criteria_ratings table</h2>";

// Read the SQL file
$sql_file = file_get_contents('database/add_student_criteria_ratings.sql');

// Execute the SQL commands
if ($conn->multi_query($sql_file)) {
    do {
        // Store first result set
        if ($result = $conn->store_result()) {
            $result->free();
        }
        // Check for more results
    } while ($conn->more_results() && $conn->next_result());
    
    echo "<div style='color: green; margin: 20px 0;'>✓ student_criteria_ratings table created successfully!</div>";
    echo "<a href='index.php' style='display: inline-block; padding: 10px 15px; background-color: #4CAF50; color: white; text-decoration: none; border-radius: 4px;'>Return to Home</a>";
} else {
    echo "<div style='color: red; margin: 20px 0;'>✗ Error creating table: " . $conn->error . "</div>";
    echo "<a href='index.php' style='display: inline-block; padding: 10px 15px; background-color: #f44336; color: white; text-decoration: none; border-radius: 4px;'>Return to Home</a>";
}

$conn->close();
?>