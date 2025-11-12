<?php
include 'db_connect.php';

echo "<h2>Adding Sample SHS Subjects to Database</h2>";
echo "<div style='font-family: Arial, sans-serif; padding: 20px;'>";

// Read the SQL file
$sql_file = 'database/add_shs_subjects.sql';
if (file_exists($sql_file)) {
    $sql_content = file_get_contents($sql_file);
    
    // Split by semicolon to get individual queries
    $queries = explode(';', $sql_content);
    
    $success_count = 0;
    $error_count = 0;
    $skipped_count = 0;
    
    foreach ($queries as $query) {
        $query = trim($query);
        
        // Skip empty queries and comments
        if (empty($query) || strpos($query, '--') === 0) {
            continue;
        }
        
        // Extract subject code for duplicate checking
        if (preg_match("/INSERT INTO subject_list.*VALUES.*'([^']+)'/", $query, $matches)) {
            $subject_code = $matches[1];
            
            // Check if subject already exists
            $check = $conn->query("SELECT id FROM subject_list WHERE code = '$subject_code'");
            if ($check && $check->num_rows > 0) {
                echo "<p style='color: orange;'>⚠️ Skipped: $subject_code (already exists)</p>";
                $skipped_count++;
                continue;
            }
        }
        
        // Execute the query
        if ($conn->query($query)) {
            if (isset($subject_code)) {
                echo "<p style='color: green;'>✅ Added: $subject_code</p>";
                $success_count++;
            }
        } else {
            if (isset($subject_code)) {
                echo "<p style='color: red;'>❌ Error adding: $subject_code - " . $conn->error . "</p>";
                $error_count++;
            }
        }
        
        unset($subject_code);
    }
    
    echo "<hr>";
    echo "<h3>Summary:</h3>";
    echo "<p><strong>✅ Successfully added:</strong> $success_count subjects</p>";
    echo "<p><strong>⚠️ Skipped (already exist):</strong> $skipped_count subjects</p>";
    echo "<p><strong>❌ Errors:</strong> $error_count subjects</p>";
    
    if ($success_count > 0) {
        echo "<div style='background: #d4edda; border: 1px solid #c3e6cb; color: #155724; padding: 15px; border-radius: 5px; margin: 20px 0;'>";
        echo "<h4>🎉 SHS Subjects Successfully Added!</h4>";
        echo "<p>You can now:</p>";
        echo "<ul>";
        echo "<li>Go to Admin Panel → SHS Subjects to view and manage them</li>";
        echo "<li>Use the Grade 11/12 filters to see subjects by grade level</li>";
        echo "<li>Use the Strand filters (STEM, ABM, HUMSS, GAS, TVL, CORE) to filter by track</li>";
        echo "<li>Add more subjects using the 'Add New SHS Subject' button</li>";
        echo "<li>Use the 'Bulk Import' feature to add multiple subjects at once</li>";
        echo "</ul>";
        echo "</div>";
    }
    
} else {
    echo "<p style='color: red;'>❌ Error: SQL file not found at $sql_file</p>";
}

echo "<br><a href='admin/' style='background: #800000; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px;'>Go to Admin Panel</a>";
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

h3 {
    color: #333;
    margin-top: 20px;
}

p {
    margin: 5px 0;
    padding: 5px;
    border-radius: 3px;
}

hr {
    border: none;
    border-top: 2px solid #dee2e6;
    margin: 20px 0;
}
</style>
