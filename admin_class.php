<?php
session_start();
ini_set('display_errors', 1);
include_once 'admin/admin_history_logger.php'; // Use admin directory version

Class Action {
	private $db;

	public function __construct() {
		ob_start();
   	include 'db_connect.php';
    
    $this->db = $conn;
	}
	function __destruct() {
	    $this->db->close();
	    ob_end_flush();
	}

	function login(){
		global $historyLogger; 
		extract($_POST);
		$type = array("","users","faculty_list","student_list");
		$type2 = array("","admin","faculty","student");
		
		// Use prepared statement for security
		$stmt = $this->db->prepare("SELECT *,concat(firstname,' ',lastname) as name FROM {$type[$login]} where email = ?");
		$stmt->bind_param("s", $email);
		$stmt->execute();
		$qry = $stmt->get_result();
		
		// Check if user exists
		if($qry->num_rows > 0) {
			$user = $qry->fetch_assoc();

			// Account Lockout Check
			if ($login == 1 && isset($user['lockout_until']) && strtotime($user['lockout_until']) > time()) {
				return 3; // Account is locked
			}

			$stored_password = $user['password'];
			
			// Check password - support both old MD5 and new bcrypt
			$password_valid = false;
			if (password_verify($password, $stored_password)) {
				// New bcrypt password
				$password_valid = true;
			} elseif (md5($password) === $stored_password) {
				// Old MD5 password - upgrade to bcrypt
				$new_hash = password_hash($password, PASSWORD_DEFAULT);
				$update_stmt = $this->db->prepare("UPDATE {$type[$login]} SET password = ? WHERE email = ?");
				$update_stmt->bind_param("ss", $new_hash, $email);
				$update_stmt->execute();
				$password_valid = true;
			}
			
			if($password_valid) {
				// Reset lockout on successful login
				if ($login == 1) {
					$this->db->query("UPDATE users SET failed_login_attempts = 0, lockout_until = NULL WHERE id = {$user['id']}");
				}

				// Check if 2FA is enabled for admin users
				if($login == 1 && $user['is_2fa_enabled'] == 1) {
					// Store user data in session temporarily for 2FA verification
					$_SESSION['temp_login_data'] = $user;
					$_SESSION['temp_login_type'] = $login;
					return 5; // Requires 2FA verification
				}

				foreach ($user as $key => $value) {
					if($key != 'password' && !is_numeric($key))
						$_SESSION['login_'.$key] = $value;
				}
				$_SESSION['login_type'] = $login;
				$_SESSION['login_view_folder'] = $type2[$login].'/';
				
				$academic = $this->db->query("SELECT * FROM academic_list where is_default = 1 ");
				if($academic->num_rows > 0){
					foreach($academic->fetch_array() as $k => $v){
						if(!is_numeric($k))
							$_SESSION['academic'][$k] = $v;
					}
				}
				
				// Log successful login
				if($login == 1) { 
					$historyLogger->logLogin($email, true);
				}
				
				return 1;
			} else {
				// Handle failed login attempt for admin
				if ($login == 1) {
					$attempts = $user['failed_login_attempts'] + 1;
					if ($attempts >= 5) {
						$lockout_time = date('Y-m-d H:i:s', strtotime('+15 minutes'));
						$this->db->query("UPDATE users SET failed_login_attempts = $attempts, lockout_until = '$lockout_time' WHERE id = {$user['id']}");
					} else {
						$this->db->query("UPDATE users SET failed_login_attempts = $attempts WHERE id = {$user['id']}");
					}
				}
			}
		} 
		// Log failed login attempt (user not found or wrong password)
		if($login == 1) { 
			$historyLogger->logLogin($email, false, 'Invalid credentials');
		}
		return 2;
	}
	function logout(){
		global $historyLogger; 
		
		// Log logout before destroying session
		if(isset($_SESSION['login_type']) && $_SESSION['login_type'] == 1) { 
			$historyLogger->logLogout();
		}
		
		session_destroy();
		foreach ($_SESSION as $key => $value) {
			unset($_SESSION[$key]);
		}
		header("location:login.php");
	}
	function login2(){
		extract($_POST);
		
		// Check if this is OTP verification step (OTP field has value and temp_student_id is not empty)
		if(isset($otp) && !empty($otp) && isset($temp_student_id) && !empty($temp_student_id)) {
			// Get student ID from session data
			if(isset($_SESSION['temp_student_data'])) {
				return $this->verifyOTPLogin($_SESSION['temp_student_data']['id'], $otp);
			} else {
				return 7; // Session expired
			}
		}
		
		// Step 1: Verify student credentials and send OTP
		if(isset($student_id) && isset($email)) {
			$qry = $this->db->query("SELECT *,concat(firstname,' ',lastname) as name FROM student_list where student_id = '{$student_id}' AND email = '{$email}' ");
			if($qry->num_rows > 0){
				$row = $qry->fetch_assoc();
				
				// Generate and send OTP
				require_once 'otp_functions.php';
				$otp = generateOTP();
				
				if(storeOTP($row['id'], $otp)) {
					$studentName = $row['firstname'] . ' ' . $row['lastname'];
					if(sendOTPEmail($email, $otp, $studentName)) {
						// Store student ID temporarily for OTP verification
						$_SESSION['temp_student_data'] = [
							'id' => $row['id'],
							'student_id' => $row['student_id'],
							'email' => $row['email']
						];
						return 4; // OTP sent successfully
					} else {
						return 5; // Email sending failed
					}
				} else {
					return 6; // Database error
				}
			}else{
				return 3; // Invalid credentials
			}
		}
		
		return 8; // Invalid request
	}
	
	function verifyOTPLogin($tempStudentId, $inputOTP) {
		require_once 'otp_functions.php';
		
		// Verify OTP
		$otpResult = verifyOTP($tempStudentId, $inputOTP);
		
		if($otpResult['success']) {
			// OTP is valid, complete login
			$qry = $this->db->query("SELECT *,concat(firstname,' ',lastname) as name FROM student_list where id = '{$tempStudentId}' ");
			if($qry->num_rows > 0){
				$row = $qry->fetch_assoc();
				foreach ($row as $key => $value) {
					if($key != 'password' && !is_numeric($key))
						$_SESSION['login_'.$key] = $value;
				}
				// Set session variables that index.php expects
				$_SESSION['login_type'] = 3; // Student login type
				$_SESSION['login_view_folder'] = 'student/';
				
				// Set academic session variables
				$academic = $this->db->query("SELECT * FROM academic_list where is_default = 1 ");
				if($academic->num_rows > 0){
					foreach($academic->fetch_array() as $k => $v){
						if(!is_numeric($k))
							$_SESSION['academic'][$k] = $v;
					}
				}
				
				// Clear temporary session data
				unset($_SESSION['temp_student_data']);
				
				return 1; // Login successful
			}
		}
		
		return 7; // OTP verification failed
	}
	function save_user(){
		extract($_POST);
		$data = "";
		foreach($_POST as $k => $v){
			if(!in_array($k, array('id','cpass','password')) && !is_numeric($k)){
				if(empty($data)){
					$data .= " $k='$v' ";
				}else{
					$data .= ", $k='$v' ";
				}
			}
		}
		if(!empty($password)){
					$data .= ", password=md5('$password') ";

		}
		$check = $this->db->query("SELECT * FROM users where email ='$email' ".(!empty($id) ? " and id != {$id} " : ''))->num_rows;
		if($check > 0){
			return 2;
			exit;
		}
		if(isset($_FILES['img']) && $_FILES['img']['tmp_name'] != ''){
			$fname = strtotime(date('y-m-d H:i')).'_'.$_FILES['img']['name'];
			$move = move_uploaded_file($_FILES['img']['tmp_name'],'assets/uploads/'. $fname);
			$data .= ", avatar = '$fname' ";

		}
		if(empty($id)){
			$save = $this->db->query("INSERT INTO users set $data");
		}else{
			$save = $this->db->query("UPDATE users set $data where id = $id");
		}

		if($save){
			return 1;
		}
	}
	function signup(){
		extract($_POST);
		$data = "";
		foreach($_POST as $k => $v){
			if(!in_array($k, array('id','cpass')) && !is_numeric($k)){
				if($k =='password'){
					if(empty($v))
						continue;
					$v = md5($v);

				}
				if(empty($data)){
					$data .= " $k='$v' ";
				}else{
					$data .= ", $k='$v' ";
				}
			}
		}

		$check = $this->db->query("SELECT * FROM users where email ='$email' ".(!empty($id) ? " and id != {$id} " : ''))->num_rows;
		if($check > 0){
			return 2;
			exit;
		}
		if(isset($_FILES['img']) && $_FILES['img']['tmp_name'] != ''){
			$fname = strtotime(date('y-m-d H:i')).'_'.$_FILES['img']['name'];
			$move = move_uploaded_file($_FILES['img']['tmp_name'],'assets/uploads/'. $fname);
			$data .= ", avatar = '$fname' ";

		}
		if(empty($id)){
			$save = $this->db->query("INSERT INTO users set $data");

		}else{
			$save = $this->db->query("UPDATE users set $data where id = $id");
		}

		if($save){
			if(empty($id))
				$id = $this->db->insert_id;
			foreach ($_POST as $key => $value) {
				if(!in_array($key, array('id','cpass','password')) && !is_numeric($key))
					$_SESSION['login_'.$key] = $value;
			}
					$_SESSION['login_id'] = $id;
				if(isset($_FILES['img']) && !empty($_FILES['img']['tmp_name']))
					$_SESSION['login_avatar'] = $fname;
			return 1;
		}
	}

	function update_user(){
		extract($_POST);
		$data = "";
		$type = array("","users","faculty_list","student_list");
	foreach($_POST as $k => $v){
			if(!in_array($k, array('id','cpass','table','password')) && !is_numeric($k)){
				
				if(empty($data)){
					$data .= " $k='$v' ";
				}else{
					$data .= ", $k='$v' ";
				}
			}
		}
		$check = $this->db->query("SELECT * FROM {$type[$_SESSION['login_type']]} where email ='$email' ".(!empty($id) ? " and id != {$id} " : ''))->num_rows;
		if($check > 0){
			return 2;
			exit;
		}
		if(isset($_FILES['img']) && $_FILES['img']['tmp_name'] != ''){
			$fname = strtotime(date('y-m-d H:i')).'_'.$_FILES['img']['name'];
			$move = move_uploaded_file($_FILES['img']['tmp_name'],'assets/uploads/'. $fname);
			$data .= ", avatar = '$fname' ";

		}
		if(!empty($password))
			$data .= " ,password=md5('$password') ";
		if(empty($id)){
			$save = $this->db->query("INSERT INTO {$type[$_SESSION['login_type']]} set $data");
		}else{
			echo "UPDATE {$type[$_SESSION['login_type']]} set $data where id = $id";
			$save = $this->db->query("UPDATE {$type[$_SESSION['login_type']]} set $data where id = $id");
		}

		if($save){
			foreach ($_POST as $key => $value) {
				if($key != 'password' && !is_numeric($key))
					$_SESSION['login_'.$key] = $value;
			}
			if(isset($_FILES['img']) && !empty($_FILES['img']['tmp_name']))
					$_SESSION['login_avatar'] = $fname;
			return 1;
		}
	}
	function delete_user(){
		extract($_POST);
		$delete = $this->db->query("DELETE FROM users where id = ".$id);
		if($delete)
			return 1;
	}
	function save_system_settings(){
		extract($_POST);
		$data = '';
		foreach($_POST as $k => $v){
			if(!is_numeric($k)){
				if(empty($data)){
					$data .= " $k='$v' ";
				}else{
					$data .= ", $k='$v' ";
				}
			}
		}
		if($_FILES['cover']['tmp_name'] != ''){
			$fname = strtotime(date('y-m-d H:i')).'_'.$_FILES['cover']['name'];
			$move = move_uploaded_file($_FILES['cover']['tmp_name'],'../assets/uploads/'. $fname);
			$data .= ", cover_img = '$fname' ";

		}
		$chk = $this->db->query("SELECT * FROM system_settings");
		if($chk->num_rows > 0){
			$save = $this->db->query("UPDATE system_settings set $data where id =".$chk->fetch_array()['id']);
		}else{
			$save = $this->db->query("INSERT INTO system_settings set $data");
		}
		if($save){
			foreach($_POST as $k => $v){
				if(!is_numeric($k)){
					$_SESSION['system'][$k] = $v;
				}
			}
			if($_FILES['cover']['tmp_name'] != ''){
				$_SESSION['system']['cover_img'] = $fname;
			}
			return 1;
		}
	}
	function save_image(){
		extract($_FILES['file']);
		if(!empty($tmp_name)){
			$fname = strtotime(date("Y-m-d H:i"))."_".(str_replace(" ","-",$name));
			$move = move_uploaded_file($tmp_name,'assets/uploads/'. $fname);
			$protocol = strtolower(substr($_SERVER["SERVER_PROTOCOL"],0,5))=='https'?'https':'http';
			$hostName = $_SERVER['HTTP_HOST'];
			$path =explode('/',$_SERVER['PHP_SELF']);
			$currentPath = '/'.$path[1]; 
			if($move){
				return $protocol.'://'.$hostName.$currentPath.'/assets/uploads/'.$fname;
			}
		}
	}
	function save_subject(){
		extract($_POST);
		$data = "";
		foreach($_POST as $k => $v){
			if(!in_array($k, array('id','user_ids')) && !is_numeric($k)){
				if(empty($data)){
					$data .= " $k='$v' ";
				}else{
					$data .= ", $k='$v' ";
				}
			}
		}
		$chk = $this->db->query("SELECT * FROM subject_list where code = '$code' and id != '{$id}' ")->num_rows;
		if($chk > 0){
			return 2;
		}
		if(empty($id)){
			$save = $this->db->query("INSERT INTO subject_list set $data");
		}else{
			$save = $this->db->query("UPDATE subject_list set $data where id = $id");
		}
		if($save){
			return 1;
		}
	}
	function delete_subject(){
		extract($_POST);
		$delete = $this->db->query("DELETE FROM subject_list where id = $id");
		if($delete){
			return 1;
		}
	}
	function save_class(){
		extract($_POST);
		$data = "";
		foreach($_POST as $k => $v){
			if(!in_array($k, array('id','user_ids')) && !is_numeric($k)){
				if(empty($data)){
					$data .= " $k='$v' ";
				}else{
					$data .= ", $k='$v' ";
				}
			}
		}
		$chk = $this->db->query("SELECT * FROM class_list where (".str_replace(",",'and',$data).") and id != '{$id}' ")->num_rows;
		if($chk > 0){
			return 2;
		}
		if(isset($user_ids)){
			$data .= ", user_ids='".implode(',',$user_ids)."' ";
		}
		if(empty($id)){
			$save = $this->db->query("INSERT INTO class_list set $data");
		}else{
			$save = $this->db->query("UPDATE class_list set $data where id = $id");
		}
		if($save){
			return 1;
		}
	}
	function delete_class(){
		extract($_POST);
		$delete = $this->db->query("DELETE FROM class_list where id = $id");
		if($delete){
			return 1;
		}
	}
	function save_academic(){
		extract($_POST);
		$data = "";
		foreach($_POST as $k => $v){
			if(!in_array($k, array('id','user_ids')) && !is_numeric($k)){
				if(empty($data)){
					$data .= " $k='$v' ";
				}else{
					$data .= ", $k='$v' ";
				}
			}
		}
		$chk = $this->db->query("SELECT * FROM academic_list where (".str_replace(",",'and',$data).") and id != '{$id}' ")->num_rows;
		if($chk > 0){
			return 2;
		}
		$hasDefault = $this->db->query("SELECT * FROM academic_list where is_default = 1")->num_rows;
		if($hasDefault == 0){
			$data .= " , is_default = 1 ";
		}
		if(empty($id)){
			$save = $this->db->query("INSERT INTO academic_list set $data");
		}else{
			$save = $this->db->query("UPDATE academic_list set $data where id = $id");
		}
		if($save){
			return 1;
		}
	}
	function delete_academic(){
		extract($_POST);
		$delete = $this->db->query("DELETE FROM academic_list where id = $id");
		if($delete){
			return 1;
		}
	}
	function make_default(){
		extract($_POST);
		$update= $this->db->query("UPDATE academic_list set is_default = 0");
		$update1= $this->db->query("UPDATE academic_list set is_default = 1 where id = $id");
		$qry = $this->db->query("SELECT * FROM academic_list where id = $id")->fetch_array();
		if($update && $update1){
			foreach($qry as $k =>$v){
				if(!is_numeric($k))
					$_SESSION['academic'][$k] = $v;
			}

			return 1;
		}
	}
	function save_criteria(){
		extract($_POST);
		$data = "";
		foreach($_POST as $k => $v){
			if(!in_array($k, array('id','user_ids')) && !is_numeric($k)){
				if(empty($data)){
					$data .= " $k='$v' ";
				}else{
					$data .= ", $k='$v' ";
				}
			}
		}
		$chk = $this->db->query("SELECT * FROM criteria_list where (".str_replace(",",'and',$data).") and id != '{$id}' ")->num_rows;
		if($chk > 0){
			return 2;
		}
		
		if(empty($id)){
			$lastOrder= $this->db->query("SELECT * FROM criteria_list order by abs(order_by) desc limit 1");
		$lastOrder = $lastOrder->num_rows > 0 ? $lastOrder->fetch_array()['order_by'] + 1 : 0;
		$data .= ", order_by='$lastOrder' ";
			$save = $this->db->query("INSERT INTO criteria_list set $data");
		}else{
			$save = $this->db->query("UPDATE criteria_list set $data where id = $id");
		}
		if($save){
			return 1;
		}
	}
	function delete_criteria(){
		extract($_POST);
		$delete = $this->db->query("DELETE FROM criteria_list where id = $id");
		if($delete){
			return 1;
		}
	}
	function save_criteria_order(){
		extract($_POST);
		$data = "";
		foreach($criteria_id as $k => $v){
			$update[] = $this->db->query("UPDATE criteria_list set order_by = $k where id = $v");
		}
		if(isset($update) && count($update)){
			return 1;
		}
	}

	function save_question(){
		extract($_POST);
		$data = "";
		foreach($_POST as $k => $v){
			if(!in_array($k, array('id','user_ids')) && !is_numeric($k)){
				if(empty($data)){
					$data .= " $k='$v' ";
				}else{
					$data .= ", $k='$v' ";
				}
			}
		}
		
		if(empty($id)){
			$lastOrder= $this->db->query("SELECT * FROM question_list where academic_id = $academic_id order by abs(order_by) desc limit 1");
			$lastOrder = $lastOrder->num_rows > 0 ? $lastOrder->fetch_array()['order_by'] + 1 : 0;
			$data .= ", order_by='$lastOrder' ";
			$save = $this->db->query("INSERT INTO question_list set $data");
		}else{
			$save = $this->db->query("UPDATE question_list set $data where id = $id");
		}
		if($save){
			return 1;
		}
	}
	function delete_question(){
		extract($_POST);
		$delete = $this->db->query("DELETE FROM question_list where id = $id");
		if($delete){
			return 1;
		}
	}
	function save_question_order(){
		extract($_POST);
		$data = "";
		foreach($qid as $k => $v){
			$update[] = $this->db->query("UPDATE question_list set order_by = $k where id = $v");
		}
		if(isset($update) && count($update)){
			return 1;
		}
	}
	function save_faculty(){
		extract($_POST);
		$data = "";
		// Define allowed fields based on actual database structure
		$allowed_fields = array('school_id', 'firstname', 'lastname', 'gender', 'role', 'email', 'avatar');
		
		// Debug: Log all POST data
		error_log("Faculty save attempt - POST data: " . print_r($_POST, true));
		
		foreach($_POST as $k => $v){
			if(!in_array($k, array('id','cpass','password')) && !is_numeric($k) && in_array($k, $allowed_fields)){
				$v = $this->db->real_escape_string($v); // Escape for security
				if(empty($data)){
					$data .= " $k='$v' ";
				}else{
					$data .= ", $k='$v' ";
				}
			}
		}
		
		// Debug: Log the data string being built
		error_log("Faculty save - Data string: " . $data);
		
		if(!empty($password)){
			$password = $this->db->real_escape_string($password);
			$data .= ", password=md5('$password') ";
		}
		
		// Check for duplicate email
		$email = $this->db->real_escape_string($email);
		$check = $this->db->query("SELECT * FROM faculty_list where email ='$email' ".(!empty($id) ? " and id != {$id} " : ''))->num_rows;
		if($check > 0){
			error_log("Faculty save failed: Duplicate email");
			return 3;
		}
		
		// Check for duplicate school_id
		$school_id = $this->db->real_escape_string($school_id);
		$check = $this->db->query("SELECT * FROM faculty_list where school_id ='$school_id' ".(!empty($id) ? " and id != {$id} " : ''))->num_rows;
		if($check > 0){
			error_log("Faculty save failed: Duplicate school_id");
			return 2;
		}
		
		// Handle file upload
		if(isset($_FILES['img']) && $_FILES['img']['tmp_name'] != ''){
			$fname = strtotime(date('y-m-d H:i')).'_'.$_FILES['img']['name'];
			$move = move_uploaded_file($_FILES['img']['tmp_name'],'assets/uploads/'. $fname);
			if($move) {
				$data .= ", avatar = '$fname' ";
			}
		}
		
		// Execute query
		if(empty($id)){
			$sql = "INSERT INTO faculty_list set $data";
			error_log("Faculty save - INSERT SQL: " . $sql);
			$save = $this->db->query($sql);
		}else{
			$sql = "UPDATE faculty_list set $data where id = $id";
			error_log("Faculty save - UPDATE SQL: " . $sql);
			$save = $this->db->query($sql);
		}

		if($save){
			error_log("Faculty save successful");
			return 1;
		}else{
			// Log the error for debugging
			error_log("Faculty save failed. SQL Error: " . $this->db->error);
			error_log("SQL Query: " . $sql);
			error_log("Data: " . $data);
			return 0; // Return 0 for database error
		}
	}
	function delete_faculty(){
		extract($_POST);
		$delete = $this->db->query("DELETE FROM faculty_list where id = ".$id);
		if($delete)
			return 1;
	}
	function save_student(){
		extract($_POST);
		$data = "";
		foreach($_POST as $k => $v){
			if(!in_array($k, array('id','cpass','password')) && !is_numeric($k)){
				if(empty($data)){
					$data .= " $k='$v' ";
				}else{
					$data .= ", $k='$v' ";
				}
			}
		}
		if(!empty($password)){
					$data .= ", password=md5('$password') ";

		}
		$check = $this->db->query("SELECT * FROM student_list where email ='$email' ".(!empty($id) ? " and id != {$id} " : ''))->num_rows;
		if($check > 0){
			return 2;
			exit;
		}
		if(isset($_FILES['img']) && $_FILES['img']['tmp_name'] != ''){
			$fname = strtotime(date('y-m-d H:i')).'_'.$_FILES['img']['name'];
			$move = move_uploaded_file($_FILES['img']['tmp_name'],'assets/uploads/'. $fname);
			$data .= ", avatar = '$fname' ";

		}
		if(empty($id)){
			$save = $this->db->query("INSERT INTO student_list set $data");
		}else{
			$save = $this->db->query("UPDATE student_list set $data where id = $id");
		}

		if($save){
			return 1;
		}
	}
	function delete_student(){
		extract($_POST);
		$delete = $this->db->query("DELETE FROM student_list where id = ".$id);
		if($delete)
			return 1;
	}
	function save_task(){
		extract($_POST);
		$data = "";
		foreach($_POST as $k => $v){
			if(!in_array($k, array('id')) && !is_numeric($k)){
				if($k == 'description')
					$v = htmlentities(str_replace("'","&#x2019;",$v));
				if(empty($data)){
					$data .= " $k='$v' ";
				}else{
					$data .= ", $k='$v' ";
				}
			}
		}
		if(empty($id)){
			$save = $this->db->query("INSERT INTO task_list set $data");
		}else{
			$save = $this->db->query("UPDATE task_list set $data where id = $id");
		}
		if($save){
			return 1;
		}
	}
	function delete_task(){
		extract($_POST);
		$delete = $this->db->query("DELETE FROM task_list where id = $id");
		if($delete){
			return 1;
		}
	}
	function save_progress(){
		extract($_POST);
		$data = "";
		foreach($_POST as $k => $v){
			if(!in_array($k, array('id')) && !is_numeric($k)){
				if($k == 'progress')
					$v = htmlentities(str_replace("'","&#x2019;",$v));
				if(empty($data)){
					$data .= " $k='$v' ";
				}else{
					$data .= ", $k='$v' ";
				}
			}
		}
		if(!isset($is_complete))
			$data .= ", is_complete=0 ";
		if(empty($id)){
			$save = $this->db->query("INSERT INTO task_progress set $data");
		}else{
			$save = $this->db->query("UPDATE task_progress set $data where id = $id");
		}
		if($save){
		if(!isset($is_complete))
			$this->db->query("UPDATE task_list set status = 1 where id = $task_id ");
		else
			$this->db->query("UPDATE task_list set status = 2 where id = $task_id ");
			return 1;
		}
	}
	function delete_progress(){
		extract($_POST);
		$delete = $this->db->query("DELETE FROM task_progress where id = $id");
		if($delete){
			return 1;
		}
	}
	function save_restriction(){
		extract($_POST);
		$filtered = implode(",",array_filter($rid));
		if(!empty($filtered))
			$this->db->query("DELETE FROM restriction_list where id not in ($filtered) and academic_id = $academic_id");
		else
			$this->db->query("DELETE FROM restriction_list where  academic_id = $academic_id");
		foreach($rid as $k => $v){
			$data = " academic_id = $academic_id ";
			$data .= ", faculty_id = {$faculty_id[$k]} ";
			$data .= ", class_id = {$class_id[$k]} ";
			$data .= ", subject_id = {$subject_id[$k]} ";
			if(empty($v)){
				$save[] = $this->db->query("INSERT INTO restriction_list set $data ");
			}else{
				$save[] = $this->db->query("UPDATE restriction_list set $data where id = $v ");
			}
		}
		return 1;
	}
	function save_evaluation(){
		extract($_POST);
		// Build fixed columns
		$base = " student_id = {$_SESSION['login_id']} ";
		$base .= ", academic_id = $academic_id ";
		$base .= ", subject_id = $subject_id ";
		$base .= ", class_id = $class_id ";
		$base .= ", restriction_id = $restriction_id ";
		$base .= ", faculty_id = $faculty_id ";
		
		$updates = " date_taken = NOW()";
		if(isset($strengths_comment) && !empty($strengths_comment)) {
			$updates .= ", strengths_comment = '".addslashes($strengths_comment)."' ";
		}
		if(isset($improvement_comment) && !empty($improvement_comment)) {
			$updates .= ", improvement_comment = '".addslashes($improvement_comment)."' ";
		}

		// Transaction start
		$this->db->begin_transaction();

		// Does evaluation already exist?
		$check_sql = "SELECT evaluation_id FROM evaluation_list WHERE student_id = {$_SESSION['login_id']} AND academic_id = $academic_id AND subject_id = $subject_id AND class_id = $class_id AND restriction_id = $restriction_id AND faculty_id = $faculty_id LIMIT 1";
		$check = $this->db->query($check_sql);
		if(!$check){ $this->db->rollback(); return 0; }

		if($check->num_rows > 0){
			$eid = (int)$check->fetch_assoc()['evaluation_id'];
			$save = $this->db->query("UPDATE evaluation_list SET $updates WHERE evaluation_id = $eid");
			if(!$save){ $this->db->rollback(); return 0; }
		}else{
			$ins = $this->db->query("INSERT INTO evaluation_list SET $base, $updates");
			if(!$ins){ $this->db->rollback(); return 0; }
			$eid = (int)$this->db->insert_id;
		}

		// Replace answers
		$del = $this->db->query("DELETE FROM evaluation_answers WHERE evaluation_id = $eid");
		if(!$del){ $this->db->rollback(); return 0; }

		$success = 0;
		foreach($qid as $k => $v){
			$data = " evaluation_id = $eid ";
			$data .= ", question_id = $v ";
			$data .= ", rate = {$rate[$v]} ";
			if($this->db->query("INSERT INTO evaluation_answers SET $data ")){
				$success++;
			}
		}

		if($success == count($qid)){
			$this->db->commit();
			return 1;
		}else{
			$this->db->rollback();
			return 0;
		}
	}
	function get_class(){
		extract($_POST);
		$data = array();
		
		// Validate required parameters
		if(!isset($fid) || empty($fid)) {
			error_log("get_class: Missing faculty ID");
			return json_encode([]);
		}
		
		if(!isset($_SESSION['academic']['id'])) {
			error_log("get_class: Missing academic session ID");
			return json_encode([]);
		}
		
		// Sanitize input
		$faculty_id = intval($fid);
		$academic_id = intval($_SESSION['academic']['id']);
		
		// Build and execute query with proper error handling
		$sql = "SELECT c.id, 
				       CONCAT(c.curriculum,' ',c.level,' - ',c.section) as class,
				       s.id as sid,
				       CONCAT(s.code,' - ',s.subject) as subj 
				FROM restriction_list r 
				INNER JOIN class_list c ON c.id = r.class_id 
				INNER JOIN subject_list s ON s.id = r.subject_id 
				WHERE r.faculty_id = {$faculty_id} 
				AND r.academic_id = {$academic_id}
				ORDER BY c.curriculum, c.level, c.section, s.subject";
		
		error_log("get_class SQL: " . $sql);
		
		$get = $this->db->query($sql);
		
		if(!$get) {
			error_log("get_class query failed: " . $this->db->error);
			return json_encode([]);
		}
		
		if($get->num_rows == 0) {
			error_log("get_class: No classes found for faculty_id={$faculty_id}, academic_id={$academic_id}");
			// Let's also check if the faculty exists in restriction_list at all
			$check_sql = "SELECT COUNT(*) as count FROM restriction_list WHERE faculty_id = {$faculty_id}";
			$check_result = $this->db->query($check_sql);
			if($check_result) {
				$count = $check_result->fetch_assoc()['count'];
				error_log("get_class: Faculty {$faculty_id} has {$count} total restrictions");
			}
		}
		
		while($row = $get->fetch_assoc()){
			$data[] = $row;
		}
		
		error_log("get_class: Returning " . count($data) . " classes");
		return json_encode($data);
	}

	function get_faculty_stats(){
		// Safely get faculty_id from POST
		$faculty_id = isset($_POST['fid']) ? intval($_POST['fid']) : 0;
		$academic_id = isset($_SESSION['academic']['id']) ? intval($_SESSION['academic']['id']) : 0;
		$data = array();
		
		if($faculty_id <= 0 || $academic_id <= 0) {
			return json_encode([
				'total_students' => 0,
				'evaluated_count' => 0,
				'pending_count' => 0,
				'response_count' => 0,
				'completion_rate' => 0
			]);
		}
		
		// Get total possible evaluation cards for this faculty (students × subjects they teach)
		$total_cards_query = "SELECT COUNT(*) as total_cards
						FROM student_list sl 
						INNER JOIN class_list cl ON sl.class_id = cl.id
						INNER JOIN restriction_list rl ON cl.id = rl.class_id 
						WHERE rl.faculty_id = ? AND rl.academic_id = ?";
		
		$stmt = $this->db->prepare($total_cards_query);
		$stmt->bind_param('ii', $faculty_id, $academic_id);
		$stmt->execute();
		$total_possible_cards = $stmt->get_result()->fetch_assoc()['total_cards'] ?? 0;
		$stmt->close();
		
		// Get actual evaluation cards completed for this faculty across ALL subjects
		$completed_cards_query = "SELECT COUNT(*) as completed_cards 
						FROM evaluation_list el 
						WHERE el.faculty_id = ? 
						AND el.academic_id = ?";
		
		$stmt = $this->db->prepare($completed_cards_query);
		$stmt->bind_param('ii', $faculty_id, $academic_id);
		$stmt->execute();
		$completed_cards = $stmt->get_result()->fetch_assoc()['completed_cards'] ?? 0;
		$stmt->close();
		
		// Get unique students who have evaluated this faculty (for display purposes)
		$unique_students_query = "SELECT COUNT(DISTINCT el.student_id) as unique_students 
						FROM evaluation_list el 
						WHERE el.faculty_id = ? 
						AND el.academic_id = ?";
		
		$stmt = $this->db->prepare($unique_students_query);
		$stmt->bind_param('ii', $faculty_id, $academic_id);
		$stmt->execute();
		$unique_students_evaluated = $stmt->get_result()->fetch_assoc()['unique_students'] ?? 0;
		$stmt->close();
		
		// Calculate pending cards and completion rate based on total evaluation cards
		$pending_count = $total_possible_cards - $completed_cards;
		$completion_rate = $total_possible_cards > 0 ? round(($completed_cards / $total_possible_cards) * 100, 1) : 0;
		
		$data['total_students'] = (int)$total_possible_cards;
		$data['evaluated_count'] = (int)$completed_cards;
		$data['pending_count'] = (int)$pending_count;
		$data['completion_rate'] = (float)$completion_rate;
		$data['response_count'] = (int)$completed_cards;
		
		return json_encode($data);
	}
	function get_report(){
		extract($_POST);
		$data = array();
		$get = $this->db->query("SELECT * FROM evaluation_answers where evaluation_id in (SELECT evaluation_id FROM evaluation_list where academic_id = {$_SESSION['academic']['id']} and faculty_id = $faculty_id and subject_id = $subject_id and class_id = $class_id ) ");
		$answered = $this->db->query("SELECT * FROM evaluation_list where academic_id = {$_SESSION['academic']['id']} and faculty_id = $faculty_id and subject_id = $subject_id and class_id = $class_id");
		
		// Get total students in the class
		$total_students = $this->db->query("SELECT COUNT(*) as total FROM student_list WHERE class_id = $class_id");
		$total_count = $total_students->fetch_assoc()['total'];
		
		$rate = array();
		while($row = $get->fetch_assoc()){
			if(!isset($rate[$row['question_id']][$row['rate']]))
			$rate[$row['question_id']][$row['rate']] = 0;
			$rate[$row['question_id']][$row['rate']] += 1;

		}
		// $data[]= $row;
		$ta = $answered->num_rows;
		$r = array();
		foreach($rate as $qk => $qv){
			foreach($qv as $rk => $rv){
			$r[$qk][$rk] = $ta > 0 ? ($rate[$qk][$rk] / $ta) * 100 : 0;
		}
	}
	
	// Calculate weighted ratings for this specific subject/class
	$total_weighted_average = 0;
	if($ta > 0) {
		$criteria = $this->db->query("SELECT * FROM criteria_list where id in (SELECT criteria_id FROM question_list where academic_id = {$_SESSION['academic']['id']} ) order by abs(order_by) asc ");
		while($crow = $criteria->fetch_assoc()){
			// Calculate per-criterion average for this specific subject/class
			$critSql = "SELECT AVG(ea.rate) as avg_rate
						FROM evaluation_answers ea
						INNER JOIN evaluation_list el ON el.evaluation_id = ea.evaluation_id
						INNER JOIN question_list q ON q.id = ea.question_id
						WHERE q.criteria_id = {$crow['id']}
						  AND q.academic_id = {$_SESSION['academic']['id']}
						  AND el.faculty_id = $faculty_id
						  AND el.subject_id = $subject_id
						  AND el.class_id = $class_id";
			$critRes = $this->db->query($critSql);
			$critRow = $critRes ? $critRes->fetch_assoc() : null;
			$avg_rate = $critRow && $critRow['avg_rate'] !== null ? (float)$critRow['avg_rate'] : 0;

			// Use DB-configured weight
			$weight = isset($crow['weight']) ? (float)$crow['weight'] : 0;
			$weighted_avg = $avg_rate * $weight;
			$total_weighted_average += $weighted_avg;
		}
	}
	
	// Get descriptive rating
	$descriptive_rating = "N/A";
	if ($total_weighted_average >= 4.23 && $total_weighted_average <= 5.00) {
		$descriptive_rating = "Outstanding";
	} else if ($total_weighted_average >= 3.43 && $total_weighted_average <= 4.22) {
		$descriptive_rating = "Very Good";
	} else if ($total_weighted_average >= 2.62 && $total_weighted_average <= 3.42) {
		$descriptive_rating = "Good";
	} else if ($total_weighted_average >= 1.81 && $total_weighted_average <= 2.61) {
		$descriptive_rating = "Fair";
	} else if ($total_weighted_average >= 1.00 && $total_weighted_average <= 1.80) {
		$descriptive_rating = "Poor";
	}
	
	$data['tse'] = $ta;
	$data['data'] = $r;
	$data['total_students'] = $total_count;
	$data['pending_count'] = $total_count - $ta;
	$data['completion_rate'] = $total_count > 0 ? round(($ta / $total_count) * 100, 1) : 0;
	// Only return ratings if there are actual evaluations
	if($ta > 0) {
		$data['weighted_rating'] = round($total_weighted_average, 2);
		$data['descriptive_rating'] = $descriptive_rating;
	} else {
		// No evaluations, don't send rating data
		$data['weighted_rating'] = null;
		$data['descriptive_rating'] = null;
	}
		
		return json_encode($data);

	}

	function get_comments(){
		extract($_POST);
		$data = array();
		
		// Get comments without student personal information for privacy
		$get = $this->db->query("
			SELECT 
				el.strengths_comment,
				el.improvement_comment
			FROM evaluation_list el
			INNER JOIN student_list s ON s.id = el.student_id
			WHERE el.academic_id = {$_SESSION['academic']['id']}
			AND el.faculty_id = $faculty_id
			AND el.subject_id = $subject_id
			AND el.class_id = $class_id
			AND ((el.strengths_comment IS NOT NULL AND el.strengths_comment != '') 
				OR (el.improvement_comment IS NOT NULL AND el.improvement_comment != ''))
			GROUP BY el.strengths_comment, el.improvement_comment, s.firstname, s.lastname
			ORDER BY date_taken DESC
		");
		
		while($row = $get->fetch_assoc()){
			$data[] = $row;
		}
		
		return json_encode($data);
	}

	function get_evaluation_progress(){
		extract($_POST);
		$academic_id = $_SESSION['academic']['id'];
		
		// Build WHERE clause for filters
		$where_conditions = ["s.id IS NOT NULL"];
		
		if(!empty($class_id)) {
			$where_conditions[] = "s.class_id = $class_id";
		}
		
		// Get all students with their evaluation progress
		$students_query = "
			SELECT 
				s.id as student_id,
				CONCAT(s.firstname, ' ', s.lastname) as student_name,
				CONCAT(c.curriculum, ' ', c.level, ' - ', c.section) as class_name,
				c.id as class_id,
				COUNT(DISTINCT r.id) as total_assigned,
				COUNT(DISTINCT el.evaluation_id) as completed_count,
				MAX(el.date_taken) as last_activity
			FROM student_list s
			INNER JOIN class_list c ON c.id = s.class_id
			LEFT JOIN restriction_list r ON r.class_id = s.class_id AND r.academic_id = $academic_id
			LEFT JOIN evaluation_list el ON el.student_id = s.id AND el.restriction_id = r.id AND el.academic_id = $academic_id
			WHERE " . implode(' AND ', $where_conditions) . "
			GROUP BY s.id, s.firstname, s.lastname, c.curriculum, c.level, c.section, c.id
			ORDER BY s.lastname, s.firstname
		";
		
		if(!empty($faculty_id)) {
			$students_query = "
				SELECT 
					s.id as student_id,
					CONCAT(s.firstname, ' ', s.lastname) as student_name,
					CONCAT(c.curriculum, ' ', c.level, ' - ', c.section) as class_name,
					c.id as class_id,
					COUNT(DISTINCT r.id) as total_assigned,
					COUNT(DISTINCT el.evaluation_id) as completed_count,
					MAX(el.date_taken) as last_activity
				FROM student_list s
				INNER JOIN class_list c ON c.id = s.class_id
				LEFT JOIN restriction_list r ON r.class_id = s.class_id AND r.academic_id = $academic_id AND r.faculty_id = $faculty_id
				LEFT JOIN evaluation_list el ON el.student_id = s.id AND el.restriction_id = r.id AND el.academic_id = $academic_id
				WHERE " . implode(' AND ', $where_conditions) . "
				GROUP BY s.id, s.firstname, s.lastname, c.curriculum, c.level, c.section, c.id
				ORDER BY s.lastname, s.firstname
			";
		}
		
		$students_result = $this->db->query($students_query);
		$students_data = array();
		$total_students = 0;
		$total_completed = 0;
		$total_pending = 0;
		
		while($row = $students_result->fetch_assoc()) {
			$pending_count = $row['total_assigned'] - $row['completed_count'];
			
			// Apply status filter
			if(!empty($status)) {
				if($status == 'completed' && $pending_count > 0) continue;
				if($status == 'pending' && $pending_count == 0) continue;
			}
			
			$row['pending_count'] = $pending_count;
			$students_data[] = $row;
			
			$total_students++;
			$total_completed += $row['completed_count'];
			$total_pending += $pending_count;
		}
		
		// Calculate completion rate
		$total_evaluations = $total_completed + $total_pending;
		$completion_rate = $total_evaluations > 0 ? round(($total_completed / $total_evaluations) * 100, 1) : 0;
		
		$response = array(
			'statistics' => array(
				'total_students' => $total_students,
				'completed_evaluations' => $total_completed,
				'pending_evaluations' => $total_pending,
				'completion_rate' => $completion_rate
			),
			'students' => $students_data
		);
		
		return json_encode($response);
	}

	function send_registration_otp(){
		extract($_POST);
		
		// Check if student ID already exists
		$check_student_id = $this->db->query("SELECT * FROM student_list WHERE student_id = '$student_id'")->num_rows;
		if($check_student_id > 0){
			return 2; // Student ID already exists
		}
		
		// Check if email already exists
		$check_email = $this->db->query("SELECT * FROM student_list WHERE email = '$email'")->num_rows;
		if($check_email > 0){
			return 3; // Email already exists
		}
		
		// Generate and send OTP
		require_once 'otp_functions.php';
		$otp = generateOTP();
		
		// Store OTP temporarily in session for registration
		$_SESSION['registration_otp'] = [
			'otp' => $otp,
			'expires' => date('Y-m-d H:i:s', strtotime('+10 minutes')),
			'student_data' => [
				'student_id' => $student_id,
				'email' => $email,
				'firstname' => $firstname,
				'lastname' => $lastname,
				'phone' => isset($phone) ? $phone : ''
			]
		];
		
		// Send OTP email
		$studentName = $firstname . ' ' . $lastname;
		if(sendOTPEmail($email, $otp, $studentName, 'registration')) {
			return 1; // OTP sent successfully
		} else {
			return 4; // Email sending failed
		}
	}

	function complete_student_registration(){
		extract($_POST);
		
		// Verify OTP from session
		if(!isset($_SESSION['registration_otp'])) {
			return 2; // Invalid or expired OTP
		}
		
		$registration_data = $_SESSION['registration_otp'];
		
		// Check if OTP has expired
		if(strtotime($registration_data['expires']) < time()) {
			unset($_SESSION['registration_otp']);
			return 2; // OTP expired
		}
		
		// Verify OTP
		if($registration_data['otp'] !== $otp) {
			return 2; // Invalid OTP
		}
		
		// Double-check that student ID and email don't exist (race condition protection)
		$check_student_id = $this->db->query("SELECT * FROM student_list WHERE student_id = '$student_id'")->num_rows;
		if($check_student_id > 0){
			unset($_SESSION['registration_otp']);
			return 3; // Student ID already exists
		}
		
		$check_email = $this->db->query("SELECT * FROM student_list WHERE email = '$email'")->num_rows;
		if($check_email > 0){
			unset($_SESSION['registration_otp']);
			return 4; // Email already exists
		}
		
		// Get data from session (no password needed for OTP-only login)
		$student_data = $registration_data['student_data'];
		$student_id = $student_data['student_id'];
		$email = $student_data['email'];
		$firstname = $student_data['firstname'];
		$lastname = $student_data['lastname'];
		$phone = !empty($student_data['phone']) ? $student_data['phone'] : NULL;
		
		// Insert new student (assign to default class_id = 1)
		$insert_query = "INSERT INTO student_list (
			student_id, 
			firstname, 
			lastname, 
			email, 
			phone, 
			password,
			class_id,
			avatar,
			date_created
		) VALUES (
			'$student_id',
			'$firstname',
			'$lastname',
			'$email',
			" . ($phone ? "'$phone'" : "NULL") . ",
			'',
			1,
			'no-image-available.png',
			NOW()
		)";
		
		$save = $this->db->query($insert_query);
		
		if($save) {
			// Clear registration OTP from session
			unset($_SESSION['registration_otp']);
			return 1; // Registration successful
		} else {
			return 5; // Database error
		}
	}

	function enable_2fa(){
		include 'twofa_helper.php';
		
		if(!isset($_SESSION['login_id'])){
			return 0;
		}
		
		$user_id = $_SESSION['login_id'];
		$verification_code = $_POST['verification_code'];
		
		// Get user's secret key
		$stmt = $this->db->prepare("SELECT secret_key FROM users WHERE id = ?");
		$stmt->bind_param("i", $user_id);
		$stmt->execute();
		$result = $stmt->get_result();
		$user_data = $result->fetch_assoc();
		
		if(!$user_data){
			return 0;
		}
		
		$secret_key = $user_data['secret_key'];
		
		// Verify the code
		if(TwoFactorAuth::verifyCode($secret_key, $verification_code)){
			// Enable 2FA
			$update_stmt = $this->db->prepare("UPDATE users SET is_2fa_enabled = 1 WHERE id = ?");
			$update_stmt->bind_param("i", $user_id);
			$update_stmt->execute();
			return 1;
		} else {
			return 0;
		}
	}
	
	function disable_2fa(){
		if(!isset($_SESSION['login_id'])){
			return 0;
		}
		
		$user_id = $_SESSION['login_id'];
		
		// Disable 2FA
		$stmt = $this->db->prepare("UPDATE users SET is_2fa_enabled = 0 WHERE id = ?");
		$stmt->bind_param("i", $user_id);
		$stmt->execute();
		return 1;
	}
	
	function verify_2fa(){
		include 'twofa_helper.php';
		global $historyLogger;
		
		if(!isset($_SESSION['temp_login_data'])){
			return 0;
		}
		
		$user = $_SESSION['temp_login_data'];
		$login = $_SESSION['temp_login_type'];
		$verification_code = $_POST['verification_code'];
		
		// Verify the 2FA code
		if(TwoFactorAuth::verifyCode($user['secret_key'], $verification_code)){
			// Complete the login process
			foreach ($user as $key => $value) {
				if($key != 'password' && !is_numeric($key))
					$_SESSION['login_'.$key] = $value;
			}
			$_SESSION['login_type'] = $login;
			$_SESSION['login_view_folder'] = 'admin/';
			
			$academic = $this->db->query("SELECT * FROM academic_list where is_default = 1 ");
			if($academic->num_rows > 0){
				foreach($academic->fetch_array() as $k => $v){
					if(!is_numeric($k))
						$_SESSION['academic'][$k] = $v;
				}
			}
			
			// Clear temporary session data
			unset($_SESSION['temp_login_data']);
			unset($_SESSION['temp_login_type']);
			
			// Log successful login
			$historyLogger->logLogin($user['email'], true);
			
			return 1;
		} else {
			return 0;
		}
	}
	
	function save_faculty_assignment(){
		extract($_POST);
		$data = " faculty_id = '$faculty_id' ";
		$data .= ", class_id = '$class_id' ";
		$data .= ", subject_id = '$subject_id' ";
		
		if(empty($id)){
			// Check if assignment already exists
			$check = $this->db->query("SELECT id FROM faculty_class_assignments WHERE faculty_id = '$faculty_id' AND class_id = '$class_id' AND subject_id = '$subject_id'")->num_rows;
			if($check > 0){
				return 3; // Assignment already exists
			}
			$save = $this->db->query("INSERT INTO faculty_class_assignments set ".$data);
		}else{
			// Check if assignment already exists (excluding current record)
			$check = $this->db->query("SELECT id FROM faculty_class_assignments WHERE faculty_id = '$faculty_id' AND class_id = '$class_id' AND subject_id = '$subject_id' AND id != '$id'")->num_rows;
			if($check > 0){
				return 3; // Assignment already exists
			}
			$save = $this->db->query("UPDATE faculty_class_assignments set ".$data." where id = ".$id);
		}
		if($save){
			return 1;
		}
	}
	
	function delete_faculty_assignment(){
		extract($_POST);
		$delete = $this->db->query("DELETE FROM faculty_class_assignments where id = ".$id);
		if($delete){
			return 1;
		}
	}
}