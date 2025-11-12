<?php
include '../db_connect.php';
if(isset($_GET['id'])){
	$qry = $conn->query("SELECT * FROM class_list where id={$_GET['id']}")->fetch_array();
	foreach($qry as $k => $v){
		$$k = $v;
	}
}
?>
<div class="container-fluid">
	<form action="" id="manage-shs-class">
		<input type="hidden" name="id" value="<?php echo isset($id) ? $id : '' ?>">
		<div id="msg" class="form-group"></div>
		
		<div class="row">
			<div class="col-md-6">
				<div class="form-group">
					<label for="grade_level" class="control-label">Grade Level</label>
					<select class="form-control form-control-sm" name="level" id="grade_level" required>
						<option value="">Select Grade Level</option>
						<option value="11" <?php echo (isset($level) && $level == '11') ? 'selected' : '' ?>>Grade 11</option>
						<option value="12" <?php echo (isset($level) && $level == '12') ? 'selected' : '' ?>>Grade 12</option>
					</select>
				</div>
			</div>
			<div class="col-md-6">
				<div class="form-group">
					<label for="strand" class="control-label">Strand/Track</label>
					<select class="form-control form-control-sm" id="strand" required>
						<option value="">Select Strand</option>
						<option value="STEM">STEM (Science, Technology, Engineering, Mathematics)</option>
						<option value="ABM">ABM (Accountancy, Business, Management)</option>
						<option value="HUMSS">HUMSS (Humanities and Social Sciences)</option>
						<option value="GAS">GAS (General Academic Strand)</option>
						<option value="TVL-COOKERY">TVL-Cookery (Culinary Arts)</option>
						<option value="TVL-SMAW">TVL-SMAW (Shielded Metal Arc Welding)</option>
						<option value="TVL-COMPROG">TVL-Computer Programming</option>
						<option value="TVL-AUTOMOTIVE">TVL-Automotive Technology</option>
						<option value="TVL-ELECTRONICS">TVL-Electronics Technology</option>
						<option value="TVL-CARPENTRY">TVL-Carpentry</option>
					</select>
				</div>
			</div>
		</div>
		
		<div class="form-group">
			<label for="section_name" class="control-label">Section Name</label>
			<input type="text" class="form-control form-control-sm" id="section_name" placeholder="e.g., Einstein, Darwin, Rizal, etc." required>
			<small class="form-text text-muted">Enter the section name (will be combined with strand)</small>
		</div>
		
		<div class="form-group">
			<label for="section" class="control-label">Generated Section Code</label>
			<input type="text" class="form-control form-control-sm" name="section" id="section" value="<?php echo isset($section) ? $section : '' ?>" readonly style="background-color: #e9ecef;">
			<small class="form-text text-muted">This will be auto-generated (e.g., STEM-Einstein, ABM-Rizal)</small>
		</div>
		
		<div class="form-group">
			<label for="curriculum" class="control-label">Curriculum</label>
			<select class="form-control form-control-sm" name="curriculum" id="curriculum" required>
				<option value="">Select Curriculum</option>
				<option value="SHS" <?php echo (isset($curriculum) && $curriculum == 'SHS') ? 'selected' : '' ?>>Senior High School (SHS)</option>
			</select>
		</div>
		
		<div class="form-group">
			<label for="adviser_faculty_id" class="control-label">Class Adviser (Optional)</label>
			<select class="form-control form-control-sm" name="adviser_faculty_id" id="adviser_faculty_id">
				<option value="">Select Faculty Adviser</option>
				<?php
				// Get faculty list from database
				$faculty_qry = $conn->query("SELECT * FROM faculty_list ORDER BY firstname ASC, lastname ASC");
				while($faculty_row = $faculty_qry->fetch_assoc()):
				?>
				<option value="<?php echo $faculty_row['id'] ?>" <?php echo (isset($adviser_faculty_id) && $adviser_faculty_id == $faculty_row['id']) ? 'selected' : '' ?>>
					<?php echo $faculty_row['firstname'] . ' ' . $faculty_row['lastname'] ?>
				</option>
				<?php endwhile; ?>
			</select>
			<small class="form-text text-muted">Select a faculty member as class adviser</small>
		</div>
	</form>
</div>

<script>
	$(document).ready(function(){
		// Set default curriculum to SHS
		$('#curriculum').val('SHS');
		
		// Auto-generate section code when selections change
		function generateSectionCode() {
			var strand = $('#strand').val();
			var sectionName = $('#section_name').val().trim();
			
			if (strand && sectionName) {
				var generatedCode = strand + '-' + sectionName;
				$('#section').val(generatedCode);
			} else {
				$('#section').val('');
			}
		}
		
		// Trigger code generation on change
		$('#strand, #section_name').on('change keyup', function() {
			generateSectionCode();
		});
		
		// If editing existing section, parse the section code
		<?php if(isset($section)): ?>
		var existingSection = '<?php echo $section ?>';
		if (existingSection && existingSection.includes('-')) {
			var parts = existingSection.split('-');
			if (parts.length >= 2) {
				$('#strand').val(parts[0]);
				$('#section_name').val(parts.slice(1).join('-'));
			}
		}
		<?php endif; ?>
		
		$('#manage-shs-class').submit(function(e){
			e.preventDefault();
			start_load()
			$('#msg').html('')
			
			// Validate that section code is generated
			if (!$('#section').val()) {
				$('#msg').html('<div class="alert alert-warning"><i class="fa fa-exclamation-triangle"></i> Please select Strand and enter Section Name to generate the section code.</div>')
				end_load()
				return;
			}
			
			// Debug: Log form data before sending
			var formData = $(this).serialize();
			console.log('SHS Section form data:', formData);
			
			$.ajax({
				url:'ajax.php?action=save_class',
				method:'POST',
				data: formData,
				success:function(resp){
					console.log('Response:', resp);
					if(resp == 1){
						alert_toast("SHS Section successfully saved.","success");
						setTimeout(function(){
							location.reload()	
						},1750)
					}else if(resp == 2){
						$('#msg').html('<div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> Section already exists.</div>')
						end_load()
					} else {
						$('#msg').html('<div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> Error saving section. Response: ' + resp + '</div>')
						end_load()
					}
				},
				error:function(xhr, status, error){
					console.log('AJAX Error:', error);
					console.log('Status:', status);
					console.log('Response:', xhr.responseText);
					$('#msg').html('<div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> Network error occurred. Please try again.</div>')
					end_load()
				}
			})
		})
	})
</script>
