<?php
// Debug script para sa SHS subject saving issue
ob_start();
date_default_timezone_set("Asia/Manila");

echo "<h2>🔍 Debug SHS Subject Save</h2>";
echo "<div style='font-family: Arial, sans-serif; padding: 20px;'>";

// Test database connection
include 'db_connect.php';
if ($conn) {
    echo "<p style='color: green;'>✅ Database connection: OK</p>";
} else {
    echo "<p style='color: red;'>❌ Database connection: FAILED</p>";
    die();
}

// Test admin_class inclusion
include 'admin_class.php';
if (class_exists('Action')) {
    echo "<p style='color: green;'>✅ Action class: OK</p>";
    $crud = new Action();
} else {
    echo "<p style='color: red;'>❌ Action class: NOT FOUND</p>";
    die();
}

// Test save_subject method
if (method_exists($crud, 'save_subject')) {
    echo "<p style='color: green;'>✅ save_subject method: EXISTS</p>";
} else {
    echo "<p style='color: red;'>❌ save_subject method: NOT FOUND</p>";
}

// Test sample data
echo "<hr><h3>🧪 Test Sample Save</h3>";

// Simulate POST data
$_POST = array(
    'grade_level' => '11',
    'strand' => 'CORE',
    'subject_code_base' => 'TEST',
    'code' => 'TEST-CORE-11',
    'subject' => 'Test Subject',
    'description' => 'This is a test subject for debugging',
    'teacher_assigned' => 'Test Teacher'
);

echo "<p><strong>Test Data:</strong></p>";
echo "<pre>" . print_r($_POST, true) . "</pre>";

// Try to save
try {
    $result = $crud->save_subject();
    echo "<p><strong>Save Result:</strong> $result</p>";
    
    if ($result == 1) {
        echo "<p style='color: green;'>✅ Save successful!</p>";
        
        // Check if it was actually saved
        $check = $conn->query("SELECT * FROM subject_list WHERE code = 'TEST-CORE-11'");
        if ($check && $check->num_rows > 0) {
            echo "<p style='color: green;'>✅ Data found in database!</p>";
            $row = $check->fetch_assoc();
            echo "<pre>" . print_r($row, true) . "</pre>";
            
            // Clean up test data
            $conn->query("DELETE FROM subject_list WHERE code = 'TEST-CORE-11'");
            echo "<p style='color: orange;'>🧹 Test data cleaned up</p>";
        } else {
            echo "<p style='color: red;'>❌ Data NOT found in database!</p>";
        }
    } elseif ($result == 2) {
        echo "<p style='color: orange;'>⚠️ Subject code already exists</p>";
    } else {
        echo "<p style='color: red;'>❌ Unknown result: $result</p>";
    }
    
} catch (Exception $e) {
    echo "<p style='color: red;'>❌ Exception: " . $e->getMessage() . "</p>";
}

// Test database error
if ($conn->error) {
    echo "<p style='color: red;'>❌ Database Error: " . $conn->error . "</p>";
}

echo "<hr>";
echo "<h3>💡 Recommendations:</h3>";
echo "<ol>";
echo "<li>Check browser console for JavaScript errors</li>";
echo "<li>Check network tab for AJAX request details</li>";
echo "<li>Verify all form fields are filled properly</li>";
echo "<li>Make sure XAMPP/Apache is running properly</li>";
echo "</ol>";

echo "<br><a href='admin/index.php?page=shs_subject_list' style='background: #800000; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px;'>Go to SHS Subjects</a>";
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

pre {
    background: #f8f9fa;
    border: 1px solid #dee2e6;
    padding: 10px;
    border-radius: 5px;
    overflow-x: auto;
}

hr {
    border: none;
    border-top: 2px solid #dee2e6;
    margin: 20px 0;
}
</style>
