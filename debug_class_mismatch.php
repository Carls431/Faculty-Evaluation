<?php
include 'db_connect.php';

echo "<h2>Debug: Class Mismatch Issue</h2>";

// Fernando's info
$fernando_id = 10;
$fernando_class = 7;
$ryan_faculty_id = 10;
$current_academic_id = 4;

echo "<h3>1. Fernando's Class Information</h3>";
$fernando_class_query = "SELECT * FROM class_list WHERE id = $fernando_class";
$fernando_class_result = $conn->query($fernando_class_query);
if($fernando_class_result->num_rows > 0) {
    $class_info = $fernando_class_result->fetch_assoc();
    echo "Fernando's Class ID: $fernando_class<br>";
    echo "Class Name: " . $class_info['level'] . " - " . $class_info['section'] . "<br>";
    echo "Curriculum: " . $class_info['curriculum'] . "<br>";
} else {
    echo "Class ID $fernando_class not found!<br>";
}

echo "<h3>2. Ryan Jim Bachinela's Current Restrictions</h3>";
$ryan_restrictions_query = "SELECT r.*, 
                                   CONCAT(c.level, ' - ', c.section) as class_name,
                                   CONCAT(s.code, ' - ', s.subject) as subject_info
                            FROM restriction_list r
                            LEFT JOIN class_list c ON c.id = r.class_id
                            LEFT JOIN subject_list s ON s.id = r.subject_id
                            WHERE r.faculty_id = $ryan_faculty_id 
                            AND r.academic_id = $current_academic_id
                            ORDER BY r.class_id";

$ryan_restrictions_result = $conn->query($ryan_restrictions_query);
echo "Ryan Jim Bachinela is assigned to these classes:<br>";
while($row = $ryan_restrictions_result->fetch_assoc()) {
    echo "- Class ID: " . $row['class_id'] . " (" . $row['class_name'] . ") - " . $row['subject_info'] . "<br>";
    if($row['class_id'] == $fernando_class) {
        echo "  <strong style='color: green;'>✓ MATCHES Fernando's class</strong><br>";
    }
}

echo "<h3>3. Problem Analysis</h3>";
$correct_restrictions_query = "SELECT r.*, 
                                      CONCAT(c.level, ' - ', c.section) as class_name,
                                      CONCAT(s.code, ' - ', s.subject) as subject_info
                               FROM restriction_list r
                               LEFT JOIN class_list c ON c.id = r.class_id
                               LEFT JOIN subject_list s ON s.id = r.subject_id
                               WHERE r.faculty_id = $ryan_faculty_id 
                               AND r.class_id = $fernando_class
                               AND r.academic_id = $current_academic_id";

$correct_restrictions_result = $conn->query($correct_restrictions_query);

if($correct_restrictions_result->num_rows > 0) {
    echo "<strong style='color: green;'>✓ Ryan Jim Bachinela IS assigned to Fernando's class</strong><br>";
    while($row = $correct_restrictions_result->fetch_assoc()) {
        echo "- Restriction ID: " . $row['id'] . " - " . $row['subject_info'] . "<br>";
    }
} else {
    echo "<strong style='color: red;'>✗ Ryan Jim Bachinela is NOT assigned to Fernando's class</strong><br>";
    echo "This is why Fernando shouldn't see Ryan Jim Bachinela in his evaluation list<br>";
}

echo "<h3>4. What Fernando Should See</h3>";
$fernando_should_see_query = "SELECT r.id, 
                                     CONCAT(f.firstname, ' ', f.lastname) as faculty_name,
                                     CONCAT(c.level, ' - ', c.section) as class_name,
                                     CONCAT(s.code, ' - ', s.subject) as subject_info
                              FROM restriction_list r
                              LEFT JOIN faculty_list f ON f.id = r.faculty_id
                              LEFT JOIN class_list c ON c.id = r.class_id
                              LEFT JOIN subject_list s ON s.id = r.subject_id
                              WHERE r.class_id = $fernando_class
                              AND r.academic_id = $current_academic_id
                              AND r.id NOT IN (
                                  SELECT restriction_id 
                                  FROM evaluation_list 
                                  WHERE academic_id = $current_academic_id
                                  AND student_id = $fernando_id
                              )";

$fernando_should_see_result = $conn->query($fernando_should_see_query);

if($fernando_should_see_result->num_rows > 0) {
    echo "Fernando should only see these teachers for evaluation:<br>";
    while($row = $fernando_should_see_result->fetch_assoc()) {
        echo "- " . $row['faculty_name'] . " (" . $row['subject_info'] . ")<br>";
    }
} else {
    echo "Fernando has completed all evaluations for his class<br>";
}

echo "<h3>5. Solution</h3>";
echo "If Ryan Jim Bachinela should NOT appear in Fernando's evaluation list:<br>";
echo "1. Remove the incorrect restriction assignments<br>";
echo "2. Only assign Ryan Jim Bachinela to his correct classes<br>";
echo "3. Fernando should only see teachers assigned to his class (Class ID: $fernando_class)<br>";
?>
