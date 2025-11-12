<?php
include '../db_connect.php';
if(isset($_GET['id'])){
	$qry = $conn->query("SELECT * FROM subject_list where id={$_GET['id']}")->fetch_array();
	foreach($qry as $k => $v){
		$$k = $v;
	}
}
?>
<div class="container-fluid">
	<form action="" id="manage-shs-subject">
		<input type="hidden" name="id" value="<?php echo isset($id) ? $id : '' ?>">
		<div id="msg" class="form-group"></div>
		
		<div class="row">
			<div class="col-md-6">
				<div class="form-group">
					<label for="grade_level" class="control-label">Grade Level</label>
					<select class="form-control form-control-sm" id="grade_level" required>
						<option value="">Select Grade Level</option>
						<option value="11" <?php echo (isset($code) && strpos($code, '11') !== false) ? 'selected' : '' ?>>Grade 11</option>
						<option value="12" <?php echo (isset($code) && strpos($code, '12') !== false) ? 'selected' : '' ?>>Grade 12</option>
					</select>
				</div>
			</div>
			<div class="col-md-6">
				<div class="form-group">
					<label for="strand" class="control-label">Strand/Track</label>
					<select class="form-control form-control-sm" id="strand" required>
						<option value="">Select Strand</option>
						<option value="CORE" <?php echo (isset($code) && strpos($code, 'CORE') !== false) ? 'selected' : '' ?>>Core Subjects</option>
						<option value="STEM" <?php echo (isset($code) && strpos($code, 'STEM') !== false) ? 'selected' : '' ?>>STEM (Science, Technology, Engineering, Mathematics)</option>
						<option value="ABM" <?php echo (isset($code) && strpos($code, 'ABM') !== false) ? 'selected' : '' ?>>ABM (Accountancy, Business, Management)</option>
						<option value="HUMSS" <?php echo (isset($code) && strpos($code, 'HUMSS') !== false) ? 'selected' : '' ?>>HUMSS (Humanities and Social Sciences)</option>
						<option value="GAS" <?php echo (isset($code) && strpos($code, 'GAS') !== false) ? 'selected' : '' ?>>GAS (General Academic Strand)</option>
						<option value="TVL" <?php echo (isset($code) && strpos($code, 'TVL') !== false) ? 'selected' : '' ?>>TVL (Technical-Vocational-Livelihood)</option>
					</select>
				</div>
			</div>
		</div>
		
		<div class="form-group">
			<label for="subject_code_base" class="control-label">Subject Code Base</label>
			<input type="text" class="form-control form-control-sm" id="subject_code_base" placeholder="e.g., MATH, ENG, FIL, etc." required>
			<small class="form-text text-muted">The system will automatically generate the full code (e.g., MATH-STEM-11)</small>
		</div>
		
		<div class="form-group">
			<label for="code" class="control-label">Generated Subject Code</label>
			<input type="text" class="form-control form-control-sm" name="code" id="code" value="<?php echo isset($code) ? $code : '' ?>" readonly style="background-color: #e9ecef;">
			<small class="form-text text-muted">This will be auto-generated based on your selections above</small>
		</div>
		
		<div class="form-group">
			<label for="subject" class="control-label">Subject Name</label>
			<input type="text" class="form-control form-control-sm" name="subject" id="subject" value="<?php echo isset($subject) ? $subject : '' ?>" placeholder="e.g., General Mathematics, Oral Communication, etc." required>
		</div>
		
		<div class="form-group">
			<label for="description" class="control-label">Topics/Description</label>
			<textarea name="description" id="description" cols="30" rows="4" class="form-control" placeholder="Enter the topics or description for this subject..." required><?php echo isset($description) ? $description : '' ?></textarea>
		</div>
		
		<!-- These fields are for UI only, not sent to database -->
		
		<div class="form-group">
			<label for="teacher_assigned" class="control-label">Teacher Assigned (Optional)</label>
			<input type="text" class="form-control form-control-sm" id="teacher_assigned" placeholder="Teacher's name (if known)">
			<small class="form-text text-muted">This is for display only and won't be saved to database</small>
		</div>
	</form>
</div>

<script>
	$(document).ready(function(){
		// Auto-generate subject code when selections change
		function generateSubjectCode() {
			var gradeLevel = $('#grade_level').val();
			var strand = $('#strand').val();
			var codeBase = $('#subject_code_base').val().toUpperCase();
			
			if (gradeLevel && strand && codeBase) {
				var generatedCode = codeBase + '-' + strand + '-' + gradeLevel;
				$('#code').val(generatedCode);
			} else {
				$('#code').val('');
			}
		}
		
		// Trigger code generation on change
		$('#grade_level, #strand, #subject_code_base').on('change keyup', function() {
			generateSubjectCode();
		});
		
		// If editing existing subject, parse the code
		<?php if(isset($code)): ?>
		var existingCode = '<?php echo $code ?>';
		if (existingCode) {
			// Try to parse existing code format
			var parts = existingCode.split('-');
			if (parts.length >= 3) {
				$('#subject_code_base').val(parts[0]);
				$('#strand').val(parts[1]);
				$('#grade_level').val(parts[2]);
			} else if (parts.length == 2) {
				// Handle simpler formats
				$('#subject_code_base').val(parts[0]);
				if (parts[1].includes('11')) $('#grade_level').val('11');
				else if (parts[1].includes('12')) $('#grade_level').val('12');
			}
		}
		<?php endif; ?>
		
		$('#manage-shs-subject').submit(function(e){
			e.preventDefault();
			start_load()
			$('#msg').html('')
			
			// Validate that code is generated
			if (!$('#code').val()) {
				$('#msg').html('<div class="alert alert-warning"><i class="fa fa-exclamation-triangle"></i> Please select Grade Level, Strand, and enter Subject Code Base to generate the subject code.</div>')
				end_load()
				return;
			}
			
			// Debug: Log form data before sending
			var formData = $(this).serialize();
			console.log('Form data being sent:', formData);
			
			$.ajax({
				url:'ajax.php?action=save_subject',
				method:'POST',
				data: formData,
				success:function(resp){
					console.log('Response:', resp); // Debug log
					if(resp == 1){
						alert_toast("SHS Subject successfully saved.","success");
						setTimeout(function(){
							location.reload()	
						},1750)
					}else if(resp == 2){
						$('#msg').html('<div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> Subject Code already exists.</div>')
						end_load()
					} else {
						$('#msg').html('<div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> Error saving subject. Response: ' + resp + '</div>')
						end_load()
					}
				},
				error:function(xhr, status, error){
					console.log('AJAX Error:', error); // Debug log
					console.log('Status:', status); // Debug log
					console.log('Response:', xhr.responseText); // Debug log
					$('#msg').html('<div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> Network error occurred. Please try again.</div>')
					end_load()
				}
			})
		})
	})
</script>
