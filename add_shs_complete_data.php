<?php
include('db_connect.php');

echo "<h2>🎓 Adding Complete SHS Data to System</h2>";
echo "<hr>";

// 1. ADD ALL TEACHERS/FACULTY
echo "<h3>👨‍🏫 Adding Faculty Members:</h3>";

$faculty_data = [
    // TVL-Maritime Teachers
    ['firstname' => 'Jerick Jonh', 'lastname' => 'Sanchez', 'email' => 'jerick.sanchez@moist.edu.ph', 'contact' => '09123456789', 'gender' => 'Male'],
    ['firstname' => 'Ryan Jim', 'lastname' => 'Bachinela', 'email' => 'ryan.bachinela@moist.edu.ph', 'contact' => '09123456790', 'gender' => 'Male'],
    ['firstname' => 'Johnson L.', 'lastname' => 'Ramoso', 'email' => 'johnson.ramoso@moist.edu.ph', 'contact' => '09123456791', 'gender' => 'Male'],
    ['firstname' => 'Helbert', 'lastname' => 'Oclida', 'email' => 'helbert.oclida@moist.edu.ph', 'contact' => '09123456792', 'gender' => 'Male'],
    ['firstname' => 'Herbert', 'lastname' => 'Oclida', 'email' => 'herbert.oclida@moist.edu.ph', 'contact' => '09123456793', 'gender' => 'Male'],
    ['firstname' => 'Glysdi Mae', 'lastname' => 'Lomosbog', 'email' => 'glysdi.lomosbog@moist.edu.ph', 'contact' => '09123456794', 'gender' => 'Female'],
    ['firstname' => 'France Antoinette', 'lastname' => 'Valmores', 'email' => 'france.valmores@moist.edu.ph', 'contact' => '09123456795', 'gender' => 'Female'],
    ['firstname' => 'Micheal', 'lastname' => 'Luna', 'email' => 'micheal.luna@moist.edu.ph', 'contact' => '09123456796', 'gender' => 'Male'],
    ['firstname' => 'Rocky', 'lastname' => 'Valmores', 'email' => 'rocky.valmores@moist.edu.ph', 'contact' => '09123456797', 'gender' => 'Male'],
    ['firstname' => 'Jan Fred', 'lastname' => 'Solver', 'email' => 'janfred.solver@moist.edu.ph', 'contact' => '09123456798', 'gender' => 'Male'],
    
    // TVL-Cookery Teachers
    ['firstname' => 'Mary Con', 'lastname' => 'Cuyugon', 'email' => 'marycon.cuyugon@moist.edu.ph', 'contact' => '09123456799', 'gender' => 'Female'],
    ['firstname' => 'Charlie Mae', 'lastname' => 'Real', 'email' => 'charliemae.real@moist.edu.ph', 'contact' => '09123456800', 'gender' => 'Female'],
    ['firstname' => 'Ms.', 'lastname' => 'Buenaflor', 'email' => 'buenaflor@moist.edu.ph', 'contact' => '09123456801', 'gender' => 'Female'],
    ['firstname' => 'Carmi Jane S.', 'lastname' => 'Donque', 'email' => 'carmijane.donque@moist.edu.ph', 'contact' => '09123456802', 'gender' => 'Female'],
    ['firstname' => 'Helen', 'lastname' => 'Galdo', 'email' => 'helen.galdo@moist.edu.ph', 'contact' => '09123456803', 'gender' => 'Female'],
    ['firstname' => 'Sanivilla', 'lastname' => 'Rebato', 'email' => 'sanivilla.rebato@moist.edu.ph', 'contact' => '09123456804', 'gender' => 'Female'],
    
    // TVL-CompProg/EIM Teachers
    ['firstname' => 'Wenefredo', 'lastname' => 'Caparida', 'email' => 'wenefredo.caparida@moist.edu.ph', 'contact' => '09123456805', 'gender' => 'Male'],
    ['firstname' => 'Carmen Jane', 'lastname' => 'Tongue', 'email' => 'carmenjane.tongue@moist.edu.ph', 'contact' => '09123456806', 'gender' => 'Female'],
    ['firstname' => 'Ms.', 'lastname' => 'Ometer', 'email' => 'ometer@moist.edu.ph', 'contact' => '09123456807', 'gender' => 'Female'],
    ['firstname' => 'Jasper Kate', 'lastname' => 'Tagarda', 'email' => 'jasperkate.tagarda@moist.edu.ph', 'contact' => '09123456808', 'gender' => 'Female'],
    ['firstname' => 'Geraldo', 'lastname' => 'Laña', 'email' => 'geraldo.lana@moist.edu.ph', 'contact' => '09123456809', 'gender' => 'Male'],
    
    // HUMSS Teachers
    ['firstname' => 'Gregorio', 'lastname' => 'Valmores', 'email' => 'gregorio.valmores@moist.edu.ph', 'contact' => '09123456810', 'gender' => 'Male'],
    ['firstname' => 'Jenefer G.', 'lastname' => 'Perez', 'email' => 'jenefer.perez@moist.edu.ph', 'contact' => '09123456811', 'gender' => 'Female'],
    ['firstname' => 'Yu', 'lastname' => 'Catherine', 'email' => 'yu.catherine@moist.edu.ph', 'contact' => '09123456812', 'gender' => 'Female'],
    ['firstname' => 'Catherine', 'lastname' => 'Yu', 'email' => 'catherine.yu@moist.edu.ph', 'contact' => '09123456813', 'gender' => 'Female'],
    ['firstname' => 'Patrick Jones', 'lastname' => 'Fabela', 'email' => 'patrickjones.fabela@moist.edu.ph', 'contact' => '09123456814', 'gender' => 'Male'],
    ['firstname' => 'Cheryl Mae', 'lastname' => 'Balili', 'email' => 'cherylmae.balili@moist.edu.ph', 'contact' => '09123456815', 'gender' => 'Female'],
    ['firstname' => 'Ms.', 'lastname' => 'Orcales', 'email' => 'orcales@moist.edu.ph', 'contact' => '09123456816', 'gender' => 'Female']
];

foreach($faculty_data as $faculty) {
    // Check if faculty already exists
    $check = $conn->query("SELECT * FROM faculty_list WHERE firstname = '{$faculty['firstname']}' AND lastname = '{$faculty['lastname']}'");
    
    if($check->num_rows == 0) {
        $insert = $conn->query("INSERT INTO faculty_list (firstname, lastname, email, contact, gender) VALUES ('{$faculty['firstname']}', '{$faculty['lastname']}', '{$faculty['email']}', '{$faculty['contact']}', '{$faculty['gender']}')");
        if($insert) {
            echo "✅ Added Faculty: {$faculty['firstname']} {$faculty['lastname']}<br>";
        } else {
            echo "❌ Failed to add: {$faculty['firstname']} {$faculty['lastname']}<br>";
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
    $check = $conn->query("SELECT * FROM class_list WHERE curriculum = '{$section['curriculum']}' AND level = '{$section['level']}' AND section = '{$section['section']}'");
    
    if($check->num_rows == 0) {
        $insert = $conn->query("INSERT INTO class_list (curriculum, level, section) VALUES ('{$section['curriculum']}', '{$section['level']}', '{$section['section']}')");
        if($insert) {
            echo "✅ Added Section: {$section['curriculum']} {$section['level']}-{$section['section']}<br>";
        } else {
            echo "❌ Failed to add: {$section['curriculum']} {$section['level']}-{$section['section']}<br>";
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
    ['code' => 'HRGP-CORE-11', 'subject' => 'Homeroom Guidance Program', 'description' => 'Monday only guidance program'],
    ['code' => 'GENMATH-CORE-11', 'subject' => 'General Mathematics', 'description' => 'Core mathematics subject'],
    ['code' => 'ORALCOM-CORE-11', 'subject' => 'Oral Communication', 'description' => 'Communication skills development'],
    ['code' => 'SAFETY-TVL-11', 'subject' => 'Safety', 'description' => 'Workplace safety protocols'],
    ['code' => 'EAP-CORE-11', 'subject' => 'English for Academic Purposes', 'description' => 'Academic English writing'],
    ['code' => 'READWRIT-CORE-11', 'subject' => 'Reading and Writing', 'description' => 'Literacy development'],
    ['code' => 'PERSDEV-CORE-11', 'subject' => 'Personality Development', 'description' => 'Personal growth and development'],
    ['code' => 'EARTHSCI-CORE-11', 'subject' => 'Earth and Life Sciences', 'description' => 'Natural sciences'],
    ['code' => 'NAVWATCH-TVL-11', 'subject' => 'Navigation Watch 1', 'description' => 'Maritime navigation basics'],
    ['code' => 'PE-CORE-11', 'subject' => 'Physical Education and Health', 'description' => 'Physical fitness and health'],
    ['code' => 'APTSERV-TVL-11', 'subject' => 'Aptitude for Service', 'description' => 'Service orientation skills'],
    
    // TVL Specialization Subjects
    ['code' => 'SPEC1-TVL-11', 'subject' => 'Specialization 1', 'description' => 'TVL specialization course'],
    ['code' => 'KOMPAN-CORE-11', 'subject' => 'Komunikasyon at Pananaliksik sa Wika at Kulturang Pilipino', 'description' => 'Filipino communication and research'],
    ['code' => 'EMPTECH-CORE-11', 'subject' => 'Empowerment Technology', 'description' => 'ICT skills development'],
    ['code' => '21STLIT-CORE-11', 'subject' => '21st Century Literature from the Philippines and the World', 'description' => 'Contemporary literature'],
    
    // HUMSS Grade 12 Subjects
    ['code' => 'EAP-CORE-12', 'subject' => 'English for Academic Purposes', 'description' => 'Advanced academic English'],
    ['code' => 'UCSP-HUMSS-12', 'subject' => 'Understanding Culture, Society and Politics', 'description' => 'Social studies'],
    ['code' => 'PHILPOL-HUMSS-12', 'subject' => 'Philippine Politics and Governance', 'description' => 'Philippine government studies'],
    ['code' => 'TRENDS-HUMSS-12', 'subject' => 'Trends, Networks, and Critical Thinking Skills in the 21st Century', 'description' => 'Critical thinking development'],
    ['code' => 'PE-CORE-12', 'subject' => 'Physical Education and Health', 'description' => 'Advanced PE and health'],
    ['code' => 'CREATNONF-HUMSS-12', 'subject' => 'Creative Non-Fiction', 'description' => 'Creative writing skills'],
    ['code' => 'PERSDEV-CORE-12', 'subject' => 'Personality Development', 'description' => 'Advanced personal development'],
    ['code' => 'PRACRES2-HUMSS-12', 'subject' => 'Practical Research 2', 'description' => 'Advanced research methods']
];

foreach($subjects_data as $subject) {
    $check = $conn->query("SELECT * FROM subject_list WHERE code = '{$subject['code']}'");
    
    if($check->num_rows == 0) {
        $insert = $conn->query("INSERT INTO subject_list (code, subject, description) VALUES ('{$subject['code']}', '{$subject['subject']}', '{$subject['description']}')");
        if($insert) {
            echo "✅ Added Subject: {$subject['code']} - {$subject['subject']}<br>";
        } else {
            echo "❌ Failed to add: {$subject['code']} - {$subject['subject']}<br>";
        }
    } else {
        echo "⚠️ Already exists: {$subject['code']} - {$subject['subject']}<br>";
    }
}

echo "<hr>";

// 4. CREATE FACULTY ASSIGNMENTS
echo "<h3>👥 Creating Faculty Assignments:</h3>";

// Get faculty and class IDs for assignments
$faculty_assignments = [
    // TVL-Maritime Grade 11 Discipline
    ['teacher' => 'Jerick Jonh Sanchez', 'section' => 'TVL-MARITIME 11-DISCIPLINE', 'subject' => 'HRGP-CORE-11'],
    ['teacher' => 'Ryan Jim Bachinela', 'section' => 'TVL-MARITIME 11-DISCIPLINE', 'subject' => 'GENMATH-CORE-11'],
    ['teacher' => 'Johnson L. Ramoso', 'section' => 'TVL-MARITIME 11-DISCIPLINE', 'subject' => 'ORALCOM-CORE-11'],
    ['teacher' => 'Helbert Oclida', 'section' => 'TVL-MARITIME 11-DISCIPLINE', 'subject' => 'SAFETY-TVL-11'],
    ['teacher' => 'Glysdi Mae Lomosbog', 'section' => 'TVL-MARITIME 11-DISCIPLINE', 'subject' => 'EAP-CORE-11'],
    ['teacher' => 'France Antoinette Valmores', 'section' => 'TVL-MARITIME 11-DISCIPLINE', 'subject' => 'READWRIT-CORE-11'],
    ['teacher' => 'Micheal Luna', 'section' => 'TVL-MARITIME 11-DISCIPLINE', 'subject' => 'PERSDEV-CORE-11'],
    ['teacher' => 'Rocky Valmores', 'section' => 'TVL-MARITIME 11-DISCIPLINE', 'subject' => 'EARTHSCI-CORE-11'],
    ['teacher' => 'Jan Fred Solver', 'section' => 'TVL-MARITIME 11-DISCIPLINE', 'subject' => 'PE-CORE-11'],
    
    // TVL-Cookery Grade 11 Simplicity
    ['teacher' => 'Mary Con Cuyugon', 'section' => 'TVL-COOKERY 11-SIMPLICITY', 'subject' => 'SPEC1-TVL-11'],
    ['teacher' => 'Charlie Mae Real', 'section' => 'TVL-COOKERY 11-SIMPLICITY', 'subject' => 'KOMPAN-CORE-11'],
    ['teacher' => 'Ms. Buenaflor', 'section' => 'TVL-COOKERY 11-SIMPLICITY', 'subject' => 'EMPTECH-CORE-11'],
    ['teacher' => 'France Antoinette Valmores', 'section' => 'TVL-COOKERY 11-SIMPLICITY', 'subject' => 'ORALCOM-CORE-11'],
    ['teacher' => 'Carmi Jane S. Donque', 'section' => 'TVL-COOKERY 11-SIMPLICITY', 'subject' => 'EARTHSCI-CORE-11'],
    ['teacher' => 'Helen Galdo', 'section' => 'TVL-COOKERY 11-SIMPLICITY', 'subject' => 'GENMATH-CORE-11'],
    ['teacher' => 'Sanivilla Rebato', 'section' => 'TVL-COOKERY 11-SIMPLICITY', 'subject' => '21STLIT-CORE-11'],
    
    // HUMSS Grade 12 Gentleness
    ['teacher' => 'Glysdi Mae Lomosbog', 'section' => 'HUMSS 12-GENTLENESS', 'subject' => 'EAP-CORE-12'],
    ['teacher' => 'Gregorio Valmores', 'section' => 'HUMSS 12-GENTLENESS', 'subject' => 'UCSP-HUMSS-12'],
    ['teacher' => 'Jenefer G. Perez', 'section' => 'HUMSS 12-GENTLENESS', 'subject' => 'PHILPOL-HUMSS-12'],
    ['teacher' => 'Yu Catherine', 'section' => 'HUMSS 12-GENTLENESS', 'subject' => 'TRENDS-HUMSS-12'],
    ['teacher' => 'Patrick Jones Fabela', 'section' => 'HUMSS 12-GENTLENESS', 'subject' => 'PE-CORE-12'],
    ['teacher' => 'Cheryl Mae Balili', 'section' => 'HUMSS 12-GENTLENESS', 'subject' => 'CREATNONF-HUMSS-12'],
    ['teacher' => 'Ms. Orcales', 'section' => 'HUMSS 12-GENTLENESS', 'subject' => 'PERSDEV-CORE-12'],
    
    // HUMSS Grade 12 Dignity
    ['teacher' => 'Cheryl Mae Balili', 'section' => 'HUMSS 12-DIGNITY', 'subject' => 'CREATNONF-HUMSS-12'],
    ['teacher' => 'Geraldo Laña', 'section' => 'HUMSS 12-DIGNITY', 'subject' => 'PERSDEV-CORE-12'],
    ['teacher' => 'Patrick Jones Fabela', 'section' => 'HUMSS 12-DIGNITY', 'subject' => 'PE-CORE-12'],
    ['teacher' => 'Catherine Yu', 'section' => 'HUMSS 12-DIGNITY', 'subject' => 'TRENDS-HUMSS-12'],
    ['teacher' => 'Gregorio Valmores', 'section' => 'HUMSS 12-DIGNITY', 'subject' => 'UCSP-HUMSS-12'],
    ['teacher' => 'Catherine Yu', 'section' => 'HUMSS 12-DIGNITY', 'subject' => 'EAP-CORE-12']
];

$assignment_count = 0;
foreach($faculty_assignments as $assignment) {
    // Get faculty ID
    $names = explode(' ', $assignment['teacher']);
    $firstname = $names[0];
    if(isset($names[1])) {
        $lastname = implode(' ', array_slice($names, 1));
    } else {
        $lastname = '';
    }
    
    $faculty_query = $conn->query("SELECT id FROM faculty_list WHERE firstname LIKE '%$firstname%' AND lastname LIKE '%$lastname%' LIMIT 1");
    
    if($faculty_query->num_rows > 0) {
        $faculty_row = $faculty_query->fetch_assoc();
        $faculty_id = $faculty_row['id'];
        
        // Get class ID
        $class_parts = explode(' ', $assignment['section']);
        $curriculum = $class_parts[0];
        $level_section = explode('-', $class_parts[1]);
        $level = $level_section[0];
        $section = $level_section[1];
        
        $class_query = $conn->query("SELECT id FROM class_list WHERE curriculum = '$curriculum' AND level = '$level' AND section = '$section' LIMIT 1");
        
        if($class_query->num_rows > 0) {
            $class_row = $class_query->fetch_assoc();
            $class_id = $class_row['id'];
            
            // Get subject ID
            $subject_query = $conn->query("SELECT id FROM subject_list WHERE code = '{$assignment['subject']}' LIMIT 1");
            
            if($subject_query->num_rows > 0) {
                $subject_row = $subject_query->fetch_assoc();
                $subject_id = $subject_row['id'];
                
                // Check if assignment already exists
                $check_assignment = $conn->query("SELECT * FROM faculty_assignments WHERE faculty_id = $faculty_id AND class_id = $class_id AND subject_id = $subject_id");
                
                if($check_assignment->num_rows == 0) {
                    $insert_assignment = $conn->query("INSERT INTO faculty_assignments (faculty_id, class_id, subject_id) VALUES ($faculty_id, $class_id, $subject_id)");
                    if($insert_assignment) {
                        echo "✅ Assigned: {$assignment['teacher']} → {$assignment['section']} → {$assignment['subject']}<br>";
                        $assignment_count++;
                    } else {
                        echo "❌ Failed assignment: {$assignment['teacher']} → {$assignment['section']}<br>";
                    }
                } else {
                    echo "⚠️ Assignment exists: {$assignment['teacher']} → {$assignment['section']}<br>";
                }
            } else {
                echo "❌ Subject not found: {$assignment['subject']}<br>";
            }
        } else {
            echo "❌ Class not found: {$assignment['section']}<br>";
        }
    } else {
        echo "❌ Faculty not found: {$assignment['teacher']}<br>";
    }
}

echo "<hr>";
echo "<h3>📊 Summary:</h3>";
echo "✅ Faculty Members: " . count($faculty_data) . " processed<br>";
echo "✅ Sections: " . count($sections_data) . " processed<br>";
echo "✅ Subjects: " . count($subjects_data) . " processed<br>";
echo "✅ Faculty Assignments: $assignment_count created<br>";
echo "<br><strong>🎉 SHS Data Import Complete!</strong><br>";
echo "<a href='admin/index.php' class='btn btn-primary'>Go to Admin Panel</a>";
?>
