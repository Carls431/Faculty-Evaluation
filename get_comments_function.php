	function get_comments(){
		extract($_POST);
		$data = array();

		// Get comments with student names and evaluation dates
		$get = $this->db->query("
			SELECT el.comment, el.date_taken, CONCAT(s.firstname, ' ', s.lastname) as student_name
			FROM evaluation_list el
			INNER JOIN student_list s ON s.id = el.student_id
			WHERE el.academic_id = {$_SESSION['academic']['id']}
			AND el.faculty_id = $faculty_id
			AND el.subject_id = $subject_id
			AND el.class_id = $class_id
			AND el.comment IS NOT NULL
			AND el.comment != ''
			ORDER BY el.date_taken DESC
		");

		while($row = $get->fetch_assoc()){
			$data[] = $row;
		}

		return json_encode($data);
	}