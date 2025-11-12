<?php
include '../db_connect.php';
?>
<div class="container-fluid">
	<form action="" id="manage-restriction">
		<div class="row">
			<div class="col-md-4 border-right">
				<input type="hidden" name="academic_id" value="<?php echo isset($_GET['id']) ? $_GET['id'] : '' ?>">
				<div id="msg" class="form-group"></div>
				<div class="form-group">
					<label for="" class="control-label">Faculty</label>
					<select name="" id="faculty_id" class="form-control form-control-sm select2">
						<option value="">Select Faculty to load assignments</option>
						<?php 
						$faculty = $conn->query("SELECT *,concat(firstname,' ',lastname) as name FROM faculty_list order by concat(firstname,' ',lastname) asc");
						$f_arr = array();
						while($row=$faculty->fetch_assoc()):
							$f_arr[$row['id']]= $row;
						?>
						<option value="<?php echo $row['id'] ?>" <?php echo isset($faculty_id) && $faculty_id == $row['id'] ? "selected" : "" ?>><?php echo ucwords($row['name']) ?></option>
						<?php endwhile; ?>
					</select>
				</div>
				<div class="form-group">
					<label for="" class="control-label">Filter by Grade Level (Optional)</label>
					<select name="" id="grade_filter" class="form-control form-control-sm select2">
						<option value="">All Grade Levels</option>
						<?php 
						$grades = $conn->query("SELECT DISTINCT level FROM class_list ORDER BY level");
						while($row = $grades->fetch_assoc()):
						?>
						<option value="<?php echo $row['level'] ?>"><?php echo $row['level'] ?></option>
						<?php endwhile; ?>
					</select>
				</div>
				<div class="form-group">
					<label for="" class="control-label">Filter by Subject (Optional)</label>
					<select name="" id="subject_filter" class="form-control form-control-sm select2">
						<option value="">All Subjects</option>
						<?php 
						$subjects = $conn->query("SELECT id, CONCAT(code,' - ',subject) as subj FROM subject_list ORDER BY code");
						while($row = $subjects->fetch_assoc()):
						?>
						<option value="<?php echo $row['id'] ?>"><?php echo $row['subj'] ?></option>
						<?php endwhile; ?>
					</select>
				</div>
				<div class="form-group">
					<div class="d-flex w-100 justify-content-center">
						<button class="btn btn-sm btn-flat btn-success bg-gradient-success" id="load_assignments" type="button">Load Faculty Assignments</button>
					</div>
					<small class="text-muted">Select faculty and optional filters above, then click to load assignments</small>
				</div>
				<div class="form-group">
					<div class="d-flex w-100 justify-content-center">
						<button class="btn btn-sm btn-flat btn-warning bg-gradient-warning" id="clear_all" type="button"><i class="fa fa-eraser"></i> Clear All Loaded Assignments</button>
					</div>
					<small class="text-muted">Remove all loaded assignments from the table (not saved yet)</small>
				</div>
				
			</div>
			<div class="col-md-8">
				<table class="table table-condensed" id="r-list">
					<thead>
						<tr>
							<th>Faculty</th>
							<th>Class</th>
							<th>Subject</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						<?php 
						$restriction = $conn->query("SELECT * FROM restriction_list where academic_id = {$_GET['id']} order by id asc");
						while($row=$restriction->fetch_assoc()):
						?>
						<tr>
							<td>
								<b><?php echo isset($f_arr[$row['faculty_id']]) ? $f_arr[$row['faculty_id']]['name'] : '' ?></b>
								<input type="hidden" name="rid[]" value="<?php echo $row['id'] ?>">
								<input type="hidden" name="faculty_id[]" value="<?php echo $row['faculty_id'] ?>">
							</td>
							<td>
								<b><?php echo isset($c_arr[$row['class_id']]) ? $c_arr[$row['class_id']]['class'] : '' ?></b>
								<input type="hidden" name="class_id[]" value="<?php echo $row['class_id'] ?>">
							</td>
							<td>
								<b><?php echo isset($s_arr[$row['subject_id']]) ? $s_arr[$row['subject_id']]['subj'] : '' ?></b>
								<input type="hidden" name="subject_id[]" value="<?php echo $row['class_id'] ?>">
							</td>
							<td class="text-center">
								<button class="btn btn-sm btn-outline-danger" onclick="$(this).closest('tr').remove()" type="button"><i class="fa fa-trash"></i></button>
							</td>
						</tr>
					<?php endwhile; ?>
					</tbody>
				</table>
			</div>
		</div>
	</form>
</div>
<script>
	$(document).ready(function(){
		$('.select2').select2({
		    placeholder:"Please select here",
		    width: "100%"
		  });
		
		// Dynamic class filtering based on faculty selection
		$('#faculty_id').change(function(){
			// Faculty selection changed - no additional action needed
			// Load assignments button will handle the rest
		});
		
		$('#manage-restriction').submit(function(e){
			e.preventDefault();
			start_load()
			$('#msg').html('')
			$.ajax({
				url:'ajax.php?action=save_restriction',
				method:'POST',
				data:$(this).serialize(),
				success:function(resp){
					if(resp == 1){
						alert_toast("Data successfully saved.","success");
						setTimeout(function(){
							location.reload()	
						},1750)
					}else if(resp == 2){
						$('#msg').html('<div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> Class already exist.</div>')
						end_load()
					}
				}
			})
		})
		$('#clear_all').click(function(){
			if(confirm('Are you sure you want to clear all loaded assignments? This will not affect saved data until you click Save.')){
				// Only remove newly loaded items (those without rid value)
				$('#r-list tbody tr').each(function(){
					var rid = $(this).find('input[name="rid[]"]').val();
					if(!rid || rid == ''){
						$(this).remove();
					}
				});
				alert_toast("Loaded assignments cleared. Already saved assignments remain.","success");
			}
		})
		
		$('#load_assignments').click(function(){
			start_load()
			var faculty_id = $('#faculty_id').val();
			var grade_filter = $('#grade_filter').val();
			var subject_filter = $('#subject_filter').val();
			$.ajax({
				url: 'ajax.php?action=get_faculty_assignments',
				method: 'POST',
				data: {faculty_id: faculty_id, grade_filter: grade_filter, subject_filter: subject_filter},
				dataType: 'json',
				success: function(response) {
					// DON'T CLEAR - just append new assignments to existing ones
					// $('#r-list tbody').empty(); // REMOVED THIS LINE
					if(response.length > 0) {
						$.each(response, function(index, assignment) {
							// Check if this assignment already exists to avoid duplicates
							var exists = false;
							$('#r-list tbody tr').each(function() {
								var existingFaculty = $(this).find('input[name="faculty_id[]"]').val();
								var existingClass = $(this).find('input[name="class_id[]"]').val();
								var existingSubject = $(this).find('input[name="subject_id[]"]').val();
								
								if(existingFaculty == assignment.faculty_id && 
								   existingClass == assignment.class_id && 
								   existingSubject == assignment.subject_id) {
									exists = true;
									return false; // break the loop
								}
							});
							
							// Only add if it doesn't exist yet
							if(!exists) {
								var tr = $("<tr></tr>")
								tr.append('<td><b>'+assignment.faculty_name+'</b><input type="hidden" name="rid[]" value=""><input type="hidden" name="faculty_id[]" value="'+assignment.faculty_id+'"></td>')
								tr.append('<td><b>'+assignment.class+'</b><input type="hidden" name="class_id[]" value="'+assignment.class_id+'"></td>')
								tr.append('<td><b>'+assignment.subject+'</b><input type="hidden" name="subject_id[]" value="'+assignment.subject_id+'"></td>')
								tr.append('<td class="text-center"><span class="btn btn-sm btn-outline-danger" onclick="$(this).closest(\'tr\').remove()" type="button"><i class="fa fa-trash"></i></span></td>')
								$('#r-list tbody').append(tr)
							}
						});
					}
					end_load()
				},
				error: function() {
					alert_toast("Error loading assignments.","error");
					end_load()
				}
			})
		})
	})

</script>