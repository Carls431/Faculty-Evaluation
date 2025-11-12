<?php
ob_start();
date_default_timezone_set("Asia/Manila");

$action = $_GET['action'];
include 'admin_class.php';
$crud = new Action();
if($action == "login"){
    $login = $crud->login();
    if($login)
        echo $login;
}
elseif($action == "logout"){
    $logout = $crud->logout();
    if($logout)
        echo $logout;
}
elseif($action == "student_login"){
    $login = $crud->login2();
    if($login)
        echo $login;
}
if($action == 'login2'){
	$login = $crud->login2();
	if($login)
		echo $login;
}

if($action == 'logout2'){
	$logout = $crud->logout2();
	if($logout)
		echo $logout;
}

if($action == 'signup'){
	$save = $crud->signup();
	if($save)
		echo $save;
}
if($action == 'save_user'){
	$save = $crud->save_user();
	if($save)
		echo $save;
}
if($action == 'update_user'){
	$save = $crud->update_user();
	if($save)
		echo $save;
}
if($action == 'delete_user'){
	$save = $crud->delete_user();
	if($save)
		echo $save;
}
if($action == 'save_subject'){
	$save = $crud->save_subject();
	if($save)
		echo $save;
}
if($action == 'delete_subject'){
	$save = $crud->delete_subject();
	if($save)
		echo $save;
}
if($action == 'bulk_import_shs_subjects'){
	$subjects = json_decode($_POST['subjects'], true);
	$success_count = 0;
	$error_count = 0;
	
	foreach($subjects as $subject) {
		// Check if subject code already exists
		$check = $conn->query("SELECT id FROM subject_list WHERE code = '".$subject['code']."'");
		if($check->num_rows == 0) {
			// Insert new subject
			$insert = $conn->query("INSERT INTO subject_list (code, subject, description) VALUES ('".$subject['code']."', '".$subject['subject']."', '".$subject['description']."')");
			if($insert) {
				$success_count++;
			} else {
				$error_count++;
			}
		} else {
			$error_count++;
		}
	}
	
	if($success_count > 0) {
		echo 1; // Success
	} else {
		echo 0; // All failed
	}
}
if($action == 'save_class'){
	$save = $crud->save_class();
	if($save)
		echo $save;
}
if($action == 'delete_class'){
	$save = $crud->delete_class();
	if($save)
		echo $save;
}
if($action == 'save_academic'){
	$save = $crud->save_academic();
	if($save)
		echo $save;
}
if($action == 'delete_academic'){
	$save = $crud->delete_academic();
	if($save)
		echo $save;
}
if($action == 'make_default'){
	$save = $crud->make_default();
	if($save)
		echo $save;
}
if($action == 'save_criteria'){
	$save = $crud->save_criteria();
	if($save)
		echo $save;
}
if($action == 'delete_criteria'){
	$save = $crud->delete_criteria();
	if($save)
		echo $save;
}
if($action == 'save_question'){
	$save = $crud->save_question();
	if($save)
		echo $save;
}
if($action == 'delete_question'){
	$save = $crud->delete_question();
	if($save)
		echo $save;
}

if($action == 'save_criteria_question'){
	$save = $crud->save_criteria_question();
	if($save)
		echo $save;
}
if($action == 'save_criteria_order'){
	$save = $crud->save_criteria_order();
	if($save)
		echo $save;
}

if($action == 'save_question_order'){
	$save = $crud->save_question_order();
	if($save)
		echo $save;
}
if($action == 'save_faculty'){
	$save = $crud->save_faculty();
	if($save)
		echo $save;
}
if($action == 'delete_faculty'){
	$save = $crud->delete_faculty();
	if($save)
		echo $save;
}
if($action == 'save_student'){
	$save = $crud->save_student();
	if($save)
		echo $save;
}
if($action == 'delete_student'){
	$save = $crud->delete_student();
	if($save)
		echo $save;
}

// Update student phone number
if($action == 'update_student_phone'){
	include 'db_connect.php';
	$id = $_POST['id'];
	$phone = $_POST['phone'];

	$conn->query("UPDATE student_list SET phone = '{$phone}' WHERE id = {$id}");
	echo 1;
}

// Toggle SMS notifications
if($action == 'toggle_sms_notifications'){
	include 'db_connect.php';
	$id = $_POST['id'];
	$sms_notifications = $_POST['sms_notifications'] ? 1 : 0;

	$conn->query("UPDATE student_list SET sms_notifications = {$sms_notifications} WHERE id = {$id}");
	echo 1;
}

// Send SMS
if($action == 'send_sms'){
	include 'db_connect.php';
	include 'twilio_config.php';
	
	$student_id = $_POST['student_id'];
	$message = $_POST['message'];

	// Get student phone number from database
	$student = $conn->query("SELECT * FROM student_list WHERE id = {$student_id}")->fetch_assoc();

	if($student && !empty($student['phone'])){
		// Check if Twilio setup is correct
		if(defined('TWILIO_ACCOUNT_SID') && defined('TWILIO_AUTH_TOKEN') && defined('TWILIO_PHONE_NUMBER')){
			$response = send_sms($student['phone'], $message);
			if($response){
				echo 1;
			}else{
				echo 0;
			}
		}else{
			error_log('Twilio credentials are not set');
			echo 0;
		}
	}else{
		error_log('Student phone number is not set');
		echo 0;
	}
}
if($action == 'save_restriction'){
    $save = $crud->save_restriction();
    if($save)
        echo $save;
}
if($action == 'get_faculty_classes'){
    $faculty_id = $_POST['faculty_id'];
    include 'db_connect.php';
    
    // Get classes assigned to this faculty from restriction_list or a faculty_class assignment table
    // For now, we'll return all classes but you can modify this query based on your database structure
    $classes = $conn->query("
        SELECT DISTINCT c.id, CONCAT(c.curriculum,' ',c.level,' - ',c.section) as class 
        FROM class_list c 
        LEFT JOIN restriction_list r ON c.id = r.class_id 
        WHERE r.faculty_id = '$faculty_id' OR r.faculty_id IS NULL
        ORDER BY c.curriculum, c.level, c.section
    ");
    
    $result = array();
    while($row = $classes->fetch_assoc()){
        $result[] = $row;
    }
    
    echo json_encode($result);
}
if($action == 'save_evaluation'){
    $save = $crud->save_evaluation();
    if($save)
        echo $save;
}

// Fetch the logged-in student's submitted evaluation (ratings + comments) for a given restriction
if($action == 'get_student_evaluation'){
    include 'db_connect.php';
    if (session_status() === PHP_SESSION_NONE) { session_start(); }

    $student_id = isset($_SESSION['login_id']) ? intval($_SESSION['login_id']) : 0;
    $restriction_id = isset($_POST['restriction_id']) ? intval($_POST['restriction_id']) : 0;
    $subject_id = isset($_POST['subject_id']) ? intval($_POST['subject_id']) : 0;
    $faculty_id = isset($_POST['faculty_id']) ? intval($_POST['faculty_id']) : 0;
    $academic_id = isset($_SESSION['academic']['id']) ? intval($_SESSION['academic']['id']) : 0;

    if($student_id == 0 || $restriction_id == 0 || $academic_id == 0){
        echo '<p class="text-danger">Invalid request.</p>';
        exit;
    }

    // Get evaluation header (filter by subject and faculty when provided)
    $extra = '';
    if($subject_id > 0) { $extra .= " AND el.subject_id = {$subject_id}"; }
    if($faculty_id > 0) { $extra .= " AND el.faculty_id = {$faculty_id}"; }
    $eval_sql = "SELECT el.*, 
                        el.evaluation_id AS evaluation_id,
                        CONCAT(f.firstname,' ',f.lastname) AS faculty_name,
                        CONCAT(s.code,' - ',s.subject) AS subject_name
                 FROM evaluation_list el
                 INNER JOIN restriction_list r ON r.id = el.restriction_id
                 INNER JOIN faculty_list f ON f.id = el.faculty_id
                 INNER JOIN subject_list s ON s.id = el.subject_id
                 WHERE el.student_id = {$student_id}
                   AND el.restriction_id = {$restriction_id}
                   AND el.academic_id = {$academic_id}
                   {$extra}
                 ORDER BY el.date_taken DESC
                 LIMIT 1";

    $eval = $conn->query($eval_sql);
    if(!$eval || $eval->num_rows == 0){
        echo '<p class="text-muted">No submitted answers found for this item.</p>';
        exit;
    }

    $eval_row = $eval->fetch_assoc();
    $evaluation_id = intval($eval_row['evaluation_id']);

    // Get answers with question text and criteria (use LEFT JOIN to tolerate missing questions/criteria)
    $ans_sql = "SELECT ea.question_id as qid, q.question, cl.criteria, ea.rate,
                       COALESCE(ABS(cl.order_by), 9999) AS c_ord,
                       COALESCE(ABS(q.order_by), 9999) AS q_ord
                FROM evaluation_answers ea
                LEFT JOIN question_list q ON q.id = ea.question_id
                LEFT JOIN criteria_list cl ON cl.id = q.criteria_id
                WHERE ea.evaluation_id = {$evaluation_id}
                ORDER BY c_ord ASC, q_ord ASC, q.id ASC";
    $answers = $conn->query($ans_sql);

    // Render a compact HTML preview
    echo '<div class="text-left">';
    echo '<h5 class="mb-1">'.htmlentities($eval_row['faculty_name']).'</h5>';
    echo '<div class="text-muted mb-2">'.htmlentities($eval_row['subject_name']).' · '.date('M j, Y h:i A', strtotime($eval_row['date_taken'])).'</div>';

    if(!$answers || $answers->num_rows === 0){
        echo '<div class="alert alert-warning">No answers were found for this evaluation.</div>';
    } else {
        $current_criteria = null;
        while($row = $answers->fetch_assoc()){
            $crit_label = $row['criteria'] ? $row['criteria'] : 'Ungrouped';
            if($crit_label !== $current_criteria){
                if($current_criteria !== null) echo '</div>';
                $current_criteria = $crit_label;
                echo '<div class="mt-3">';
                echo '<div class="badge badge-dark mb-2" style="font-size:0.95rem">'.htmlentities($current_criteria).'</div>';
            }
            $qtext = $row['question'] ? $row['question'] : ('Question #'.$row['qid']);
            echo '<div class="d-flex justify-content-between align-items-start py-1 border-bottom">';
            echo '<div class="pr-3" style="max-width: 75%">'.htmlentities($qtext).'</div>';
            echo '<div><span class="badge badge-primary" style="font-size:0.9rem">'.$row['rate'].'</span></div>';
            echo '</div>';
        }
        if($current_criteria !== null) echo '</div>';
    }

    // Comments
    if(!empty($eval_row['strengths_comment']) || !empty($eval_row['improvement_comment'])){
        echo '<div class="mt-4">';
        echo '<div class="font-weight-bold mb-2">Other Comments</div>';
        if(!empty($eval_row['strengths_comment'])){
            echo '<div class="mb-2"><div class="text-muted small mb-1">1. What do you like most about your teacher?</div>';
            echo '<div class="p-2 bg-light rounded">'.nl2br(htmlentities($eval_row['strengths_comment'])).'</div></div>';
        }
        if(!empty($eval_row['improvement_comment'])){
            echo '<div class="mb-2"><div class="text-muted small mb-1">2. What areas could the teacher improve on?</div>';
            echo '<div class="p-2 bg-light rounded">'.nl2br(htmlentities($eval_row['improvement_comment'])).'</div></div>';
        }
        echo '</div>';
    }

    echo '</div>';
    exit;
}

if($action == 'get_class'){
	$get = $crud->get_class();
	if($get)
		echo $get;
}
if($action == 'get_faculty_stats'){
	$get = $crud->get_faculty_stats();
	if($get)
		echo $get;
}
if($action == 'get_report'){
	// Add logging for report access via AJAX
	include_once 'admin/admin_history_logger.php';
	
	// Get faculty info for logging
	$faculty_id = isset($_POST['fid']) ? $_POST['fid'] : 'Unknown';
	if($faculty_id != 'Unknown') {
		$faculty_qry = $conn->query("SELECT CONCAT(firstname, ' ', lastname) as name FROM faculty_list WHERE id = $faculty_id");
		$faculty_name = $faculty_qry->num_rows > 0 ? $faculty_qry->fetch_assoc()['name'] : 'Unknown Faculty';
		$historyLogger->logReportAccess('Teacher Evaluation Report - Viewed', $faculty_id, "Teacher: $faculty_name");
	}
	
	$get = $crud->get_report();
	if($get)
		echo $get;
}
if($action == 'get_comments'){
	$get = $crud->get_comments();
	if($get)
		echo $get;
}

if($action == 'get_evaluation_progress'){
	$get = $crud->get_evaluation_progress();
	if($get)
		echo $get;
}

if($action == 'get_evaluation_form'){
    include 'student/get_evaluation_form.php';
}

// Add this new handler for history logs
if($action == 'get_log_details'){
	include_once 'admin/admin_history_logger.php';
	$log_id = $_POST['log_id'];
	
	$stmt = $conn->prepare("SELECT * FROM admin_history_logs WHERE id = ?");
	$stmt->bind_param("i", $log_id);
	$stmt->execute();
	$result = $stmt->get_result();
	$log = $result->fetch_assoc();
	
	if($log):
?>
<div class="row">
	<div class="col-md-6">
		<strong>Admin:</strong> <?php echo $log['admin_name'] ?><br>
		<strong>Action:</strong> <?php echo str_replace('_', ' ', $log['action_type']) ?><br>
		<strong>Timestamp:</strong> <?php echo date('M d, Y h:i:s A', strtotime($log['timestamp'])) ?><br>
		<strong>IP Address:</strong> <?php echo $log['ip_address'] ?><br>
		<strong>Session ID:</strong> <?php echo substr($log['session_id'], 0, 20) ?>...
	</div>
	<div class="col-md-6">
		<?php if($log['target_table']): ?>
		<strong>Target Table:</strong> <?php echo $log['target_table'] ?><br>
		<?php endif; ?>
		<?php if($log['target_id']): ?>
		<strong>Target ID:</strong> <?php echo $log['target_id'] ?><br>
		<?php endif; ?>
		<strong>User Agent:</strong> <?php echo substr($log['user_agent'], 0, 50) ?>...
	</div>
</div>
<hr>
<div class="row">
	<div class="col-md-12">
		<strong>Description:</strong><br>
		<p class="text-muted"><?php echo $log['action_description'] ?></p>
	</div>
</div>

<?php if($log['old_values'] || $log['new_values']): ?>
<div class="row">
	<?php if($log['old_values']): ?>
	<div class="col-md-6">
		<strong>Old Values:</strong>
		<pre class="bg-light p-2"><?php echo json_encode(json_decode($log['old_values']), JSON_PRETTY_PRINT) ?></pre>
	</div>
	<?php endif; ?>
	<?php if($log['new_values']): ?>
	<div class="col-md-6">
		<strong>New Values:</strong>
		<pre class="bg-light p-2"><?php echo json_encode(json_decode($log['new_values']), JSON_PRETTY_PRINT) ?></pre>
	</div>
	<?php endif; ?>
</div>
<?php endif; ?>

<?php
	else:
		echo "<p class='text-danger'>Log not found.</p>";
	endif;
}

// Add handler for print report logging
if($action == 'log_print_report'){
	include_once 'admin/admin_history_logger.php';
	$faculty_id = $_POST['faculty_id'];
	$faculty_name = $_POST['faculty_name'];
	
	if($faculty_id && $faculty_name) {
		$historyLogger->logReportAccess('Teacher Evaluation Report - Printed', $faculty_id, "Teacher: $faculty_name");
	}
	echo "success";
}

// Forgot Password functionality
if($action == 'request_password_reset'){
    include 'forgot_password_handler.php';
    $result = request_password_reset();
    echo $result;
}

if($action == 'reset_password'){
    include 'forgot_password_handler.php';
    $result = reset_password();
    echo $result;
}

// Student Registration handlers
if($action == 'send_registration_otp'){
    $result = $crud->send_registration_otp();
    if($result)
        echo $result;
}

if($action == 'complete_student_registration'){
    $result = $crud->complete_student_registration();
    if($result)
        echo $result;
}

if($action == 'enable_2fa'){
    $result = $crud->enable_2fa();
    if($result)
        echo $result;
}

if($action == 'disable_2fa'){
    $result = $crud->disable_2fa();
    if($result)
        echo $result;
}

if($action == 'verify_2fa'){
    $result = $crud->verify_2fa();
    if($result)
        echo $result;
}

if($action == 'save_faculty_assignment'){
    $save = $crud->save_faculty_assignment();
    if($save)
        echo $save;
}

if($action == 'delete_faculty_assignment'){
    $delete = $crud->delete_faculty_assignment();
    if($delete)
        echo $delete;
}

if($action == 'get_faculty_assignments'){
    $faculty_id = $_POST['faculty_id'];
    $grade_filter = isset($_POST['grade_filter']) ? $_POST['grade_filter'] : '';
    $subject_filter = isset($_POST['subject_filter']) ? $_POST['subject_filter'] : '';
    include 'db_connect.php';
    
    $where_conditions = array();
    $where_conditions[] = "a.faculty_id = '$faculty_id'";
    
    if(!empty($grade_filter)) {
        $where_conditions[] = "c.level = '$grade_filter'";
    }
    
    if(!empty($subject_filter)) {
        $where_conditions[] = "a.subject_id = '$subject_filter'";
    }
    
    $where_clause = implode(' AND ', $where_conditions);
    
    $assignments = $conn->query("
        SELECT a.*, 
               CONCAT(f.firstname,' ',f.lastname) as faculty_name,
               CONCAT(c.curriculum,' ',c.level,' - ',c.section) as class,
               CONCAT(s.code,' - ',s.subject) as subject
        FROM faculty_class_assignments a 
        LEFT JOIN faculty_list f ON a.faculty_id = f.id 
        LEFT JOIN class_list c ON a.class_id = c.id 
        LEFT JOIN subject_list s ON a.subject_id = s.id 
        WHERE $where_clause
        ORDER BY c.curriculum, c.level, c.section
    ");
    
    $result = array();
    while($row = $assignments->fetch_assoc()){
        $result[] = $row;
    }
    
    echo json_encode($result);
}

// Dynamic Calendar: fetch events for a given month/year
// Update student profile
if($action == 'update_student_profile'){
    include 'db_connect.php';
    if (session_status() === PHP_SESSION_NONE) { session_start(); }
    
    $id = $_POST['id'];
    $firstname = $conn->real_escape_string($_POST['firstname']);
    $lastname = $conn->real_escape_string($_POST['lastname']);
    $email = $conn->real_escape_string($_POST['email']);
    $phone = isset($_POST['phone']) ? $conn->real_escape_string($_POST['phone']) : '';
    
    // Check if email already exists for another student
    $check = $conn->query("SELECT id FROM student_list WHERE email = '{$email}' AND id != {$id}");
    if($check->num_rows > 0){
        echo 3; // Email already exists
        exit;
    }
    
    // Build update query
    $update_fields = array();
    $update_fields[] = "firstname = '{$firstname}'";
    $update_fields[] = "lastname = '{$lastname}'";
    $update_fields[] = "email = '{$email}'";
    $update_fields[] = "phone = '{$phone}'";
    
    // Handle password change
    if(!empty($_POST['current_password']) && !empty($_POST['new_password'])){
        $current_password = md5($_POST['current_password']);
        $new_password = md5($_POST['new_password']);
        
        // Verify current password
        $verify = $conn->query("SELECT id FROM student_list WHERE id = {$id} AND password = '{$current_password}'");
        if($verify->num_rows == 0){
            echo 2; // Current password is incorrect
            exit;
        }
        
        $update_fields[] = "password = '{$new_password}'";
    }
    
    // Handle avatar upload
    if(isset($_FILES['avatar']) && $_FILES['avatar']['error'] == 0){
        $allowed = array('jpg', 'jpeg', 'png', 'gif');
        $filename = $_FILES['avatar']['name'];
        $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
        
        if(in_array($ext, $allowed)){
            $new_filename = time() . '_' . $filename;
            $upload_path = '../assets/uploads/' . $new_filename;
            
            if(move_uploaded_file($_FILES['avatar']['tmp_name'], $upload_path)){
                // Delete old avatar if not default
                $old_avatar = $conn->query("SELECT avatar FROM student_list WHERE id = {$id}")->fetch_assoc()['avatar'];
                if($old_avatar != 'no-image-available.png' && file_exists('../assets/uploads/' . $old_avatar)){
                    unlink('../assets/uploads/' . $old_avatar);
                }
                
                $update_fields[] = "avatar = '{$new_filename}'";
                $_SESSION['login_avatar'] = $new_filename;
            }
        }
    }
    
    // Execute update
    $update_query = "UPDATE student_list SET " . implode(', ', $update_fields) . " WHERE id = {$id}";
    if($conn->query($update_query)){
        // Update session variables
        $_SESSION['login_firstname'] = $firstname;
        $_SESSION['login_lastname'] = $lastname;
        echo 1; // Success
    } else {
        echo 0; // Error
    }
}

if($action == 'get_calendar_events'){
    include 'db_connect.php';
    if (session_status() === PHP_SESSION_NONE) { session_start(); }

    $month = isset($_POST['month']) ? intval($_POST['month']) : intval(date('n'));
    $year  = isset($_POST['year'])  ? intval($_POST['year'])  : intval(date('Y'));

    // Determine current academic_id
    $academic_id = isset($_SESSION['academic']['id']) ? intval($_SESSION['academic']['id']) : 0;
    if ($academic_id === 0) {
        $row = $conn->query("SELECT id FROM academic_list WHERE is_default = 1 LIMIT 1");
        if ($row && $row->num_rows > 0) {
            $academic_id = intval($row->fetch_assoc()['id']);
        }
    }

    // Ensure table exists (safe-guard, non-destructive)
    $conn->query("CREATE TABLE IF NOT EXISTS calendar_events (
        id INT AUTO_INCREMENT PRIMARY KEY,
        academic_id INT NULL,
        title VARCHAR(255) NOT NULL,
        event_date DATE NOT NULL,
        type ENUM('deadline','holiday','event') DEFAULT 'event',
        color VARCHAR(20) NULL,
        created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
        INDEX idx_acad_date (academic_id, event_date)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4");

    $first_day = sprintf('%04d-%02d-01', $year, $month);
    $last_day  = date('Y-m-t', strtotime($first_day));

    // Check if there are academic-specific events for this month; if none, auto-seed defaults
    $check_sql = "SELECT COUNT(*) AS cnt
                  FROM calendar_events
                  WHERE event_date BETWEEN '{$first_day}' AND '{$last_day}'
                    AND academic_id = {$academic_id}";
    $check_res = $conn->query($check_sql);
    $need_seed = false;
    if ($check_res) {
        $need_seed = ((int)$check_res->fetch_assoc()['cnt']) === 0;
    }

    if ($need_seed && $academic_id > 0) {
        $start_date = $first_day; // 1st day of month
        $title = 'Evaluation Starts';
        $type  = 'event';
        $stmt = $conn->prepare("INSERT INTO calendar_events (academic_id, title, event_date, type, color) VALUES (?,?,?,?,NULL)");
        if ($stmt) {
            $stmt->bind_param('isss', $academic_id, $title, $start_date, $type);
            $stmt->execute();
            $stmt->close();
        }
    }

    // Fetch academic-specific and global (academic_id IS NULL or 0) events
    $sql = "SELECT id, academic_id, title, event_date, type, color
            FROM calendar_events
            WHERE event_date BETWEEN '{$first_day}' AND '{$last_day}'
              AND (academic_id = {$academic_id} OR academic_id IS NULL OR academic_id = 0)
            ORDER BY event_date ASC";
    $res = $conn->query($sql);

    $events = array();
    if ($res) {
        while($row = $res->fetch_assoc()){
            $events[] = $row;
        }
    }

    header('Content-Type: application/json');
    echo json_encode(array(
        'month' => $month,
        'year' => $year,
        'academic_id' => $academic_id,
        'events' => $events
    ));
}

ob_end_flush();
?>
