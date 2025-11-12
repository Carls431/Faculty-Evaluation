<?php
include 'db_connect.php';

echo "<h2>Debug: Evaluation Issue for Fernando & Ryan Jim Bachinela</h2>";

// Get Fernando's student info
echo "<h3>1. Student Information (Fernando)</h3>";
$student_query = "SELECT * FROM student_list WHERE firstname LIKE '%Fernando%' OR lastname LIKE '%Fernando%'";
$student_result = $conn->query($student_query);
if($student_result->num_rows > 0) {
    while($row = $student_result->fetch_assoc()) {
        echo "Student ID: " . $row['id'] . "<br>";
        echo "Name: " . $row['firstname'] . " " . $row['lastname'] . "<br>";
        echo "Email: " . $row['email'] . "<br>";
        echo "Class ID: " . $row['class_id'] . "<br>";
        $fernando_id = $row['id'];
        $fernando_class = $row['class_id'];
    }
} else {
    echo "No student named Fernando found.<br>";
}

// Get Ryan Jim Bachinela's faculty info
echo "<h3>2. Faculty Information (Ryan Jim Bachinela)</h3>";
$faculty_query = "SELECT * FROM faculty_list WHERE firstname LIKE '%Ryan%' AND lastname LIKE '%Bachinela%'";
$faculty_result = $conn->query($faculty_query);
if($faculty_result->num_rows > 0) {
    while($row = $faculty_result->fetch_assoc()) {
        echo "Faculty ID: " . $row['id'] . "<br>";
        echo "Name: " . $row['firstname'] . " " . $row['lastname'] . "<br>";
        echo "Email: " . $row['email'] . "<br>";
        $ryan_faculty_id = $row['id'];
    }
} else {
    echo "No faculty named Ryan Jim Bachinela found.<br>";
}

// Check current academic year
echo "<h3>3. Current Academic Year</h3>";
$academic_query = "SELECT * FROM academic_list WHERE is_default = 1";
$academic_result = $conn->query($academic_query);
if($academic_result->num_rows > 0) {
    $academic = $academic_result->fetch_assoc();
    echo "Academic ID: " . $academic['id'] . "<br>";
    echo "Year: " . $academic['year'] . "<br>";
    echo "Semester: " . $academic['semester'] . "<br>";
    $current_academic_id = $academic['id'];
}

// Check restriction records for Ryan Jim Bachinela
echo "<h3>4. Restriction Records for Ryan Jim Bachinela</h3>";
if(isset($ryan_faculty_id) && isset($current_academic_id)) {
    $restriction_query = "SELECT r.*, 
                                 CONCAT(f.firstname, ' ', f.lastname) as faculty_name,
                                 c.level, c.section,
                                 CONCAT(s.code, ' - ', s.subject) as subject_info
                          FROM restriction_list r
                          LEFT JOIN faculty_list f ON f.id = r.faculty_id
                          LEFT JOIN class_list c ON c.id = r.class_id  
                          LEFT JOIN subject_list s ON s.id = r.subject_id
                          WHERE r.faculty_id = $ryan_faculty_id 
                          AND r.academic_id = $current_academic_id";
    
    $restriction_result = $conn->query($restriction_query);
    if($restriction_result->num_rows > 0) {
        while($row = $restriction_result->fetch_assoc()) {
            echo "Restriction ID: " . $row['id'] . "<br>";
            echo "Faculty: " . $row['faculty_name'] . "<br>";
            echo "Class: " . $row['level'] . " - " . $row['section'] . "<br>";
            echo "Subject: " . $row['subject_info'] . "<br>";
            echo "Academic ID: " . $row['academic_id'] . "<br>";
            echo "---<br>";
        }
    } else {
        echo "No restriction records found for Ryan Jim Bachinela.<br>";
    }
}

// Check evaluation records for Fernando
echo "<h3>5. Evaluation Records for Fernando</h3>";
if(isset($fernando_id) && isset($current_academic_id)) {
    $evaluation_query = "SELECT e.*, 
                                CONCAT(f.firstname, ' ', f.lastname) as faculty_name,
                                CONCAT(s.code, ' - ', s.subject) as subject_info,
                                c.level, c.section
                         FROM evaluation_list e
                         LEFT JOIN faculty_list f ON f.id = e.faculty_id
                         LEFT JOIN subject_list s ON s.id = e.subject_id
                         LEFT JOIN class_list c ON c.id = e.class_id
                         WHERE e.student_id = $fernando_id 
                         AND e.academic_id = $current_academic_id";
    
    $evaluation_result = $conn->query($evaluation_query);
    if($evaluation_result->num_rows > 0) {
        while($row = $evaluation_result->fetch_assoc()) {
            echo "Evaluation ID: " . $row['id'] . "<br>";
            echo "Faculty: " . $row['faculty_name'] . "<br>";
            echo "Subject: " . $row['subject_info'] . "<br>";
            echo "Class: " . $row['level'] . " - " . $row['section'] . "<br>";
            echo "Restriction ID: " . $row['restriction_id'] . "<br>";
            echo "Date Taken: " . $row['date_taken'] . "<br>";
            echo "---<br>";
        }
    } else {
        echo "No evaluation records found for Fernando.<br>";
    }
}

// Check if there's a conflict
echo "<h3>6. Conflict Analysis</h3>";
if(isset($fernando_id) && isset($ryan_faculty_id) && isset($current_academic_id)) {
    $conflict_query = "SELECT e.*, r.id as restriction_id
                       FROM evaluation_list e
                       LEFT JOIN restriction_list r ON r.faculty_id = e.faculty_id 
                                                   AND r.academic_id = e.academic_id
                                                   AND r.class_id = e.class_id
                       WHERE e.student_id = $fernando_id 
                       AND e.faculty_id = $ryan_faculty_id
                       AND e.academic_id = $current_academic_id";
    
    $conflict_result = $conn->query($conflict_query);
    if($conflict_result->num_rows > 0) {
        echo "<strong style='color: red;'>CONFLICT FOUND!</strong><br>";
        while($row = $conflict_result->fetch_assoc()) {
            echo "Evaluation exists for Fernando + Ryan Jim Bachinela<br>";
            echo "Evaluation ID: " . $row['id'] . "<br>";
            echo "Restriction ID in evaluation: " . $row['restriction_id'] . "<br>";
            echo "Current restriction ID: " . $row['restriction_id'] . "<br>";
        }
    } else {
        echo "No direct conflict found.<br>";
    }
}

// Show available teachers for Fernando (what the system sees)
echo "<h3>7. Available Teachers for Fernando (System View)</h3>";
if(isset($fernando_id) && isset($fernando_class) && isset($current_academic_id)) {
    $available_query = "SELECT r.id, s.id as sid, f.id as fid,
                               CONCAT(f.firstname, ' ', f.lastname) as faculty,
                               s.code, s.subject 
                        FROM restriction_list r 
                        INNER JOIN faculty_list f ON f.id = r.faculty_id 
                        INNER JOIN subject_list s ON s.id = r.subject_id 
                        WHERE r.academic_id = $current_academic_id
                        AND r.class_id = $fernando_class
                        AND r.id NOT IN (
                            SELECT restriction_id 
                            FROM evaluation_list 
                            WHERE academic_id = $current_academic_id
                            AND student_id = $fernando_id
                        )";
    
    $available_result = $conn->query($available_query);
    if($available_result->num_rows > 0) {
        while($row = $available_result->fetch_assoc()) {
            echo "Faculty: " . $row['faculty'] . "<br>";
            echo "Subject: " . $row['code'] . " - " . $row['subject'] . "<br>";
            echo "Restriction ID: " . $row['id'] . "<br>";
            if($row['fid'] == $ryan_faculty_id) {
                echo "<strong style='color: green;'>This is Ryan Jim Bachinela - AVAILABLE</strong><br>";
            }
            echo "---<br>";
        }
    } else {
        echo "No available teachers found for Fernando.<br>";
    }
}

echo "<h3>8. Solution</h3>";
echo "If Ryan Jim Bachinela should show as COMPLETED but shows as PENDING:<br>";
echo "1. Check if there's an old evaluation record with different restriction_id<br>";
echo "2. Update the restriction_id in existing evaluation_list record<br>";
echo "3. Or delete conflicting records and re-evaluate<br>";
?>
