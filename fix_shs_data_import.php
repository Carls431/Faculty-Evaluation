<?php
include('db_connect.php');

echo "<h2>🔧 Fixed SHS Data Import</h2>";
echo "<hr>";

// First, let's check the table structures
echo "<h3>📋 Checking Table Structures:</h3>";

// Check faculty_list table structure
$faculty_columns = $conn->query("DESCRIBE faculty_list");
echo "<strong>Faculty Table Columns:</strong><br>";
while($col = $faculty_columns->fetch_assoc()) {
    echo "- " . $col['Field'] . " (" . $col['Type'] . ")<br>";
}

echo "<br><strong>Class List Table Columns:</strong><br>";
$class_columns = $conn->query("DESCRIBE class_list");
while($col = $class_columns->fetch_assoc()) {
    echo "- " . $col['Field'] . " (" . $col['Type'] . ")<br>";
}

echo "<br><strong>Subject List Table Columns:</strong><br>";
$subject_columns = $conn->query("DESCRIBE subject_list");
while($col = $subject_columns->fetch_assoc()) {
    echo "- " . $col['Field'] . " (" . $col['Type'] . ")<br>";
}

echo "<hr>";

// 1. ADD ALL TEACHERS/FACULTY (Fixed version)
echo "<h3>👨‍🏫 Adding Faculty Members:</h3>";

$faculty_data = [
    // TVL-Maritime Teachers
    ['firstname' => 'Jerick Jonh', 'lastname' => 'Sanchez'],
    ['firstname' => 'Ryan Jim', 'lastname' => 'Bachinela'],
    ['firstname' => 'Johnson L.', 'lastname' => 'Ramoso'],
    ['firstname' => 'Helbert', 'lastname' => 'Oclida'],
    ['firstname' => 'Herbert', 'lastname' => 'Oclida'],
    ['firstname' => 'Glysdi Mae', 'lastname' => 'Lomosbog'],
    ['firstname' => 'France Antoinette', 'lastname' => 'Valmores'],
    ['firstname' => 'Micheal', 'lastname' => 'Luna'],
    ['firstname' => 'Rocky', 'lastname' => 'Valmores'],
    ['firstname' => 'Jan Fred', 'lastname' => 'Solver'],
    
    // TVL-Cookery Teachers
    ['firstname' => 'Mary Con', 'lastname' => 'Cuyugon'],
    ['firstname' => 'Charlie Mae', 'lastname' => 'Real'],
    ['firstname' => 'Ms.', 'lastname' => 'Buenaflor'],
    ['firstname' => 'Carmi Jane S.', 'lastname' => 'Donque'],
    ['firstname' => 'Helen', 'lastname' => 'Galdo'],
    ['firstname' => 'Sanivilla', 'lastname' => 'Rebato'],
    
    // TVL-CompProg/EIM Teachers
    ['firstname' => 'Wenefredo', 'lastname' => 'Caparida'],
    ['firstname' => 'Carmen Jane', 'lastname' => 'Tongue'],
    ['firstname' => 'Ms.', 'lastname' => 'Ometer'],
    ['firstname' => 'Jasper Kate', 'lastname' => 'Tagarda'],
    ['firstname' => 'Geraldo', 'lastname' => 'Laña'],
    
    // HUMSS Teachers
    ['firstname' => 'Gregorio', 'lastname' => 'Valmores'],
    ['firstname' => 'Jenefer G.', 'lastname' => 'Perez'],
    ['firstname' => 'Yu', 'lastname' => 'Catherine'],
    ['firstname' => 'Catherine', 'lastname' => 'Yu'],
    ['firstname' => 'Patrick Jones', 'lastname' => 'Fabela'],
    ['firstname' => 'Cheryl Mae', 'lastname' => 'Balili'],
    ['firstname' => 'Ms.', 'lastname' => 'Orcales']
];

foreach($faculty_data as $faculty) {
    // Check if faculty already exists
    $firstname = mysqli_real_escape_string($conn, $faculty['firstname']);
    $lastname = mysqli_real_escape_string($conn, $faculty['lastname']);
    
    $check = $conn->query("SELECT * FROM faculty_list WHERE firstname = '$firstname' AND lastname = '$lastname'");
    
    if($check->num_rows == 0) {
        $insert = $conn->query("INSERT INTO faculty_list (firstname, lastname) VALUES ('$firstname', '$lastname')");
        if($insert) {
            echo "✅ Added Faculty: {$faculty['firstname']} {$faculty['lastname']}<br>";
        } else {
            echo "❌ Failed to add: {$faculty['firstname']} {$faculty['lastname']} - " . $conn->error . "<br>";
        }
    } else {
        echo "⚠️ Already exists: {$faculty['firstname']} {$faculty['lastname']}<br>";
    }
}

echo "<hr>";

// 2. ADD ALL SECTIONS
echo "<h3>🏫 Adding Sections:</h3>";

$sections_data = [
    ['curriculum' => 'TVL-MARITIME', 'level' => '11', 'section' => 'DISCIPLINE'],
    ['curriculum' => 'TVL-COOKERY', 'level' => '11', 'section' => 'SIMPLICITY'],
    ['curriculum' => 'TVL-COMPROG', 'level' => '11', 'section' => 'PERSEVERANCE'],
    ['curriculum' => 'TVL-EIM', 'level' => '11', 'section' => 'HONESTY'],
    ['curriculum' => 'HUMSS', 'level' => '12', 'section' => 'GENTLENESS'],
    ['curriculum' => 'HUMSS', 'level' => '12', 'section' => 'DIGNITY']
];

foreach($sections_data as $section) {
    $curriculum = mysqli_real_escape_string($conn, $section['curriculum']);
    $level = mysqli_real_escape_string($conn, $section['level']);
    $section_name = mysqli_real_escape_string($conn, $section['section']);
    
    $check = $conn->query("SELECT * FROM class_list WHERE curriculum = '$curriculum' AND level = '$level' AND section = '$section_name'");
    
    if($check->num_rows == 0) {
        $insert = $conn->query("INSERT INTO class_list (curriculum, level, section) VALUES ('$curriculum', '$level', '$section_name')");
        if($insert) {
            echo "✅ Added Section: {$section['curriculum']} {$section['level']}-{$section['section']}<br>";
        } else {
            echo "❌ Failed to add: {$section['curriculum']} {$section['level']}-{$section['section']} - " . $conn->error . "<br>";
        }
    } else {
        echo "⚠️ Already exists: {$section['curriculum']} {$section['level']}-{$section['section']}<br>";
    }
}

echo "<hr>";

// 3. ADD ALL SUBJECTS
echo "<h3>📚 Adding Subjects:</h3>";

$subjects_data = [
    // Core Subjects
    ['code' => 'HRGP-CORE-11', 'subject' => 'Homeroom Guidance Program'],
    ['code' => 'GENMATH-CORE-11', 'subject' => 'General Mathematics'],
    ['code' => 'ORALCOM-CORE-11', 'subject' => 'Oral Communication'],
    ['code' => 'SAFETY-TVL-11', 'subject' => 'Safety'],
    ['code' => 'EAP-CORE-11', 'subject' => 'English for Academic Purposes'],
    ['code' => 'READWRIT-CORE-11', 'subject' => 'Reading and Writing'],
    ['code' => 'PERSDEV-CORE-11', 'subject' => 'Personality Development'],
    ['code' => 'EARTHSCI-CORE-11', 'subject' => 'Earth and Life Sciences'],
    ['code' => 'NAVWATCH-TVL-11', 'subject' => 'Navigation Watch 1'],
    ['code' => 'PE-CORE-11', 'subject' => 'Physical Education and Health'],
    ['code' => 'APTSERV-TVL-11', 'subject' => 'Aptitude for Service'],
    
    // TVL Specialization Subjects
    ['code' => 'SPEC1-TVL-11', 'subject' => 'Specialization 1'],
    ['code' => 'KOMPAN-CORE-11', 'subject' => 'Komunikasyon at Pananaliksik sa Wika at Kulturang Pilipino'],
    ['code' => 'EMPTECH-CORE-11', 'subject' => 'Empowerment Technology'],
    ['code' => '21STLIT-CORE-11', 'subject' => '21st Century Literature from the Philippines and the World'],
    
    // HUMSS Grade 12 Subjects
    ['code' => 'EAP-CORE-12', 'subject' => 'English for Academic Purposes'],
    ['code' => 'UCSP-HUMSS-12', 'subject' => 'Understanding Culture, Society and Politics'],
    ['code' => 'PHILPOL-HUMSS-12', 'subject' => 'Philippine Politics and Governance'],
    ['code' => 'TRENDS-HUMSS-12', 'subject' => 'Trends, Networks, and Critical Thinking Skills in the 21st Century'],
    ['code' => 'PE-CORE-12', 'subject' => 'Physical Education and Health'],
    ['code' => 'CREATNONF-HUMSS-12', 'subject' => 'Creative Non-Fiction'],
    ['code' => 'PERSDEV-CORE-12', 'subject' => 'Personality Development'],
    ['code' => 'PRACRES2-HUMSS-12', 'subject' => 'Practical Research 2']
];

foreach($subjects_data as $subject) {
    $code = mysqli_real_escape_string($conn, $subject['code']);
    $subject_name = mysqli_real_escape_string($conn, $subject['subject']);
    
    $check = $conn->query("SELECT * FROM subject_list WHERE code = '$code'");
    
    if($check->num_rows == 0) {
        $insert = $conn->query("INSERT INTO subject_list (code, subject) VALUES ('$code', '$subject_name')");
        if($insert) {
            echo "✅ Added Subject: {$subject['code']} - {$subject['subject']}<br>";
        } else {
            echo "❌ Failed to add: {$subject['code']} - {$subject['subject']} - " . $conn->error . "<br>";
        }
    } else {
        echo "⚠️ Already exists: {$subject['code']} - {$subject['subject']}<br>";
    }
}

echo "<hr>";
echo "<h3>📊 Summary:</h3>";
echo "✅ Faculty Members: " . count($faculty_data) . " processed<br>";
echo "✅ Sections: " . count($sections_data) . " processed<br>";
echo "✅ Subjects: " . count($subjects_data) . " processed<br>";
echo "<br><strong>🎉 SHS Data Import Complete!</strong><br>";
echo "<a href='admin/index.php' class='btn btn-primary' style='background: #800000; border: none; padding: 10px 20px; color: white; text-decoration: none; border-radius: 5px; display: inline-block; margin-top: 10px;'>Go to Admin Panel</a>";
?>
