<?php
include('db_connect.php');

// Add Grade 12 HUMSS sections based on your data
$grade12_sections = [
    ['curriculum' => 'HUMSS', 'level' => '12', 'section' => 'GENTLENESS'],
    ['curriculum' => 'HUMSS', 'level' => '12', 'section' => 'DIGNITY']
];

echo "<h3>Adding Grade 12 Sections:</h3>";

foreach($grade12_sections as $section) {
    // Check if section already exists
    $check = $conn->query("SELECT * FROM class_list WHERE curriculum = '{$section['curriculum']}' AND level = '{$section['level']}' AND section = '{$section['section']}'");
    
    if($check->num_rows == 0) {
        $insert = $conn->query("INSERT INTO class_list (curriculum, level, section) VALUES ('{$section['curriculum']}', '{$section['level']}', '{$section['section']}')");
        if($insert) {
            echo "✅ Added: {$section['curriculum']} {$section['level']}-{$section['section']}<br>";
        } else {
            echo "❌ Failed to add: {$section['curriculum']} {$section['level']}-{$section['section']}<br>";
        }
    } else {
        echo "⚠️ Already exists: {$section['curriculum']} {$section['level']}-{$section['section']}<br>";
    }
}

echo "<hr><h3>Updated Grade Levels:</h3>";
$grade_qry = $conn->query("SELECT DISTINCT level FROM class_list ORDER BY CAST(level AS UNSIGNED) ASC");
while($grade_row = $grade_qry->fetch_assoc()) {
    echo "Grade " . $grade_row['level'] . "<br>";
}
?>
