<?php
include 'db_connect.php';

echo "<h2>🔍 Database Table Structure Check</h2>";
echo "<div style='font-family: Arial, sans-serif; padding: 20px;'>";

// Check subject_list table structure
$result = $conn->query("DESCRIBE subject_list");

if ($result) {
    echo "<h3>📊 subject_list Table Structure:</h3>";
    echo "<table border='1' style='border-collapse: collapse; width: 100%;'>";
    echo "<tr style='background: #f8f9fa;'>";
    echo "<th style='padding: 10px;'>Field</th>";
    echo "<th style='padding: 10px;'>Type</th>";
    echo "<th style='padding: 10px;'>Null</th>";
    echo "<th style='padding: 10px;'>Key</th>";
    echo "<th style='padding: 10px;'>Default</th>";
    echo "<th style='padding: 10px;'>Extra</th>";
    echo "</tr>";
    
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td style='padding: 8px; font-weight: bold; color: #800000;'>" . $row['Field'] . "</td>";
        echo "<td style='padding: 8px;'>" . $row['Type'] . "</td>";
        echo "<td style='padding: 8px;'>" . $row['Null'] . "</td>";
        echo "<td style='padding: 8px;'>" . $row['Key'] . "</td>";
        echo "<td style='padding: 8px;'>" . ($row['Default'] ?? 'NULL') . "</td>";
        echo "<td style='padding: 8px;'>" . $row['Extra'] . "</td>";
        echo "</tr>";
    }
    echo "</table>";
    
    echo "<hr>";
    echo "<h3>💡 Analysis:</h3>";
    echo "<p>✅ <strong>Available columns for SHS subjects:</strong></p>";
    echo "<ul>";
    echo "<li><strong>id</strong> - Primary key (auto increment)</li>";
    echo "<li><strong>code</strong> - Subject code (e.g., MATH-STEM-11)</li>";
    echo "<li><strong>subject</strong> - Subject name</li>";
    echo "<li><strong>description</strong> - Topics/description</li>";
    echo "</ul>";
    
    echo "<p>❌ <strong>NOT available (causing errors):</strong></p>";
    echo "<ul>";
    echo "<li>grade_level, grade_level_temp</li>";
    echo "<li>strand, strand_temp</li>";
    echo "<li>subject_code_base, subject_code_base_temp</li>";
    echo "<li>teacher_assigned</li>";
    echo "</ul>";
    
} else {
    echo "<p style='color: red;'>❌ Error: " . $conn->error . "</p>";
}

// Check sample data
echo "<hr>";
echo "<h3>📋 Sample Data (First 5 records):</h3>";
$sample = $conn->query("SELECT * FROM subject_list LIMIT 50");
if ($sample && $sample->num_rows > 0) {
    echo "<table border='1' style='border-collapse: collapse; width: 100%;'>";
    echo "<tr style='background: #f8f9fa;'>";
    echo "<th style='padding: 8px;'>ID</th>";
    echo "<th style='padding: 8px;'>Code</th>";
    echo "<th style='padding: 8px;'>Subject</th>";
    echo "<th style='padding: 8px;'>Description</th>";
    echo "</tr>";
    
    while ($row = $sample->fetch_assoc()) {
        echo "<tr>";
        echo "<td style='padding: 6px;'>" . $row['id'] . "</td>";
        echo "<td style='padding: 6px; font-weight: bold;'>" . $row['code'] . "</td>";
        echo "<td style='padding: 6px;'>" . $row['subject'] . "</td>";
        echo "<td style='padding: 6px;'>" . substr($row['description'], 0, 50) . "...</td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "<p>No data found or error: " . $conn->error . "</p>";
}

echo "<br><a href='admin/index.php?page=subject_list' style='background: #800000; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px;'>Go to Subjects</a>";
echo "</div>";
?>

<style>
body {
    font-family: Arial, sans-serif;
    background-color: #f8f9fa;
    margin: 0;
    padding: 20px;
}

h2 {
    color: #800000;
    border-bottom: 3px solid #800000;
    padding-bottom: 10px;
}

table {
    margin: 10px 0;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
}

th {
    background: #800000 !important;
    color: white !important;
}

tr:nth-child(even) {
    background: #f8f9fa;
}
</style>
