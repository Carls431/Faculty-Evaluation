<?php include '../db_connect.php'; ?>
<div class="container-fluid">
	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header" style="background: linear-gradient(135deg, #800000, #a52a2a); color: white;">
					<h5><i class="fas fa-upload"></i> Bulk Import SHS Subjects</h5>
				</div>
				<div class="card-body">
					<form action="" id="bulk-import-form" enctype="multipart/form-data">
						<div id="msg" class="form-group"></div>
						
						<div class="alert alert-info">
							<h6><i class="fas fa-info-circle"></i> Instructions:</h6>
							<ul class="mb-0">
								<li>You can either upload a CSV file or manually enter subjects below</li>
								<li>CSV Format: Subject Code, Subject Name, Grade Level (11/12), Strand, Description</li>
								<li>Example: MATH-STEM-11, General Mathematics, 11, STEM, Basic mathematics concepts</li>
							</ul>
						</div>
						
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label for="csv_file">Upload CSV File (Optional)</label>
									<input type="file" class="form-control-file" name="csv_file" id="csv_file" accept=".csv">
									<small class="form-text text-muted">Upload a CSV file with SHS subjects data</small>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label for="default_grade">Default Grade Level</label>
									<select class="form-control" name="default_grade" id="default_grade">
										<option value="11">Grade 11</option>
										<option value="12">Grade 12</option>
									</select>
								</div>
							</div>
						</div>
						
						<hr>
						<h6><i class="fas fa-keyboard"></i> Or Add Subjects Manually:</h6>
						
						<div id="manual-subjects">
							<div class="subject-row border p-3 mb-3" style="border-radius: 8px; background-color: #f8f9fa;">
								<div class="row">
									<div class="col-md-2">
										<div class="form-group">
											<label>Subject Code Base</label>
											<input type="text" class="form-control form-control-sm subject-code-base" placeholder="e.g., MATH">
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<label>Subject Name</label>
											<input type="text" class="form-control form-control-sm subject-name" placeholder="e.g., General Mathematics">
										</div>
									</div>
									<div class="col-md-2">
										<div class="form-group">
											<label>Grade</label>
											<select class="form-control form-control-sm grade-level">
												<option value="11">Grade 11</option>
												<option value="12">Grade 12</option>
											</select>
										</div>
									</div>
									<div class="col-md-2">
										<div class="form-group">
											<label>Strand</label>
											<select class="form-control form-control-sm strand">
												<option value="CORE">Core</option>
												<option value="STEM">STEM</option>
												<option value="ABM">ABM</option>
												<option value="HUMSS">HUMSS</option>
												<option value="GAS">GAS</option>
												<option value="TVL">TVL</option>
											</select>
										</div>
									</div>
									<div class="col-md-2">
										<div class="form-group">
											<label>Description</label>
											<input type="text" class="form-control form-control-sm description" placeholder="Topics/Description">
										</div>
									</div>
									<div class="col-md-1">
										<div class="form-group">
											<label>&nbsp;</label>
											<button type="button" class="btn btn-danger btn-sm remove-subject d-block">
												<i class="fas fa-trash"></i>
											</button>
										</div>
									</div>
								</div>
							</div>
						</div>
						
						<div class="text-center mb-3">
							<button type="button" class="btn btn-success btn-sm" id="add-subject-row">
								<i class="fas fa-plus"></i> Add Another Subject
							</button>
						</div>
						
						<hr>
						<h6><i class="fas fa-magic"></i> Quick Add Common SHS Subjects:</h6>
						<div class="row">
							<div class="col-md-3">
								<button type="button" class="btn btn-outline-primary btn-sm btn-block quick-add" data-subjects='[
									{"code":"FIL","name":"Komunikasyon at Pananaliksik","strand":"CORE"},
									{"code":"ENG","name":"Oral Communication","strand":"CORE"},
									{"code":"MATH","name":"General Mathematics","strand":"CORE"},
									{"code":"SCI","name":"Earth and Life Science","strand":"CORE"}
								]'>Core Subjects</button>
							</div>
							<div class="col-md-3">
								<button type="button" class="btn btn-outline-success btn-sm btn-block quick-add" data-subjects='[
									{"code":"MATH","name":"Pre-Calculus","strand":"STEM"},
									{"code":"CHEM","name":"General Chemistry","strand":"STEM"},
									{"code":"PHYS","name":"General Physics","strand":"STEM"},
									{"code":"BIO","name":"General Biology","strand":"STEM"}
								]'>STEM Subjects</button>
							</div>
							<div class="col-md-3">
								<button type="button" class="btn btn-outline-warning btn-sm btn-block quick-add" data-subjects='[
									{"code":"ACC","name":"Fundamentals of Accountancy","strand":"ABM"},
									{"code":"BUS","name":"Business Mathematics","strand":"ABM"},
									{"code":"ECON","name":"Applied Economics","strand":"ABM"},
									{"code":"ENT","name":"Entrepreneurship","strand":"ABM"}
								]'>ABM Subjects</button>
							</div>
							<div class="col-md-3">
								<button type="button" class="btn btn-outline-info btn-sm btn-block quick-add" data-subjects='[
									{"code":"PHIL","name":"Introduction to Philosophy","strand":"HUMSS"},
									{"code":"SOC","name":"Disciplines and Ideas in Social Sciences","strand":"HUMSS"},
									{"code":"HIST","name":"Philippine Politics and Governance","strand":"HUMSS"},
									{"code":"PSY","name":"Understanding Culture and Society","strand":"HUMSS"}
								]'>HUMSS Subjects</button>
							</div>
						</div>
					</form>
				</div>
				<div class="card-footer">
					<div class="d-flex justify-content-between">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">
							<i class="fas fa-times"></i> Cancel
						</button>
						<button type="button" class="btn btn-primary" id="import-subjects">
							<i class="fas fa-save"></i> Import All Subjects
						</button>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<script>
$(document).ready(function(){
	// Add new subject row
	$('#add-subject-row').click(function(){
		var newRow = $('.subject-row:first').clone();
		newRow.find('input, select').val('');
		newRow.find('.subject-code-base').val('');
		$('#manual-subjects').append(newRow);
	});
	
	// Remove subject row
	$(document).on('click', '.remove-subject', function(){
		if ($('.subject-row').length > 1) {
			$(this).closest('.subject-row').remove();
		} else {
			alert('At least one subject row is required');
		}
	});
	
	// Quick add subjects
	$('.quick-add').click(function(){
		var subjects = JSON.parse($(this).attr('data-subjects'));
		var defaultGrade = $('#default_grade').val();
		
		// Clear existing rows
		$('#manual-subjects').empty();
		
		subjects.forEach(function(subject, index){
			var newRow = $(`
				<div class="subject-row border p-3 mb-3" style="border-radius: 8px; background-color: #f8f9fa;">
					<div class="row">
						<div class="col-md-2">
							<div class="form-group">
								<label>Subject Code Base</label>
								<input type="text" class="form-control form-control-sm subject-code-base" value="${subject.code}">
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-group">
								<label>Subject Name</label>
								<input type="text" class="form-control form-control-sm subject-name" value="${subject.name}">
							</div>
						</div>
						<div class="col-md-2">
							<div class="form-group">
								<label>Grade</label>
								<select class="form-control form-control-sm grade-level">
									<option value="11" ${defaultGrade == '11' ? 'selected' : ''}>Grade 11</option>
									<option value="12" ${defaultGrade == '12' ? 'selected' : ''}>Grade 12</option>
								</select>
							</div>
						</div>
						<div class="col-md-2">
							<div class="form-group">
								<label>Strand</label>
								<select class="form-control form-control-sm strand">
									<option value="CORE" ${subject.strand == 'CORE' ? 'selected' : ''}>Core</option>
									<option value="STEM" ${subject.strand == 'STEM' ? 'selected' : ''}>STEM</option>
									<option value="ABM" ${subject.strand == 'ABM' ? 'selected' : ''}>ABM</option>
									<option value="HUMSS" ${subject.strand == 'HUMSS' ? 'selected' : ''}>HUMSS</option>
									<option value="GAS" ${subject.strand == 'GAS' ? 'selected' : ''}>GAS</option>
									<option value="TVL" ${subject.strand == 'TVL' ? 'selected' : ''}>TVL</option>
								</select>
							</div>
						</div>
						<div class="col-md-2">
							<div class="form-group">
								<label>Description</label>
								<input type="text" class="form-control form-control-sm description" placeholder="Topics/Description">
							</div>
						</div>
						<div class="col-md-1">
							<div class="form-group">
								<label>&nbsp;</label>
								<button type="button" class="btn btn-danger btn-sm remove-subject d-block">
									<i class="fas fa-trash"></i>
								</button>
							</div>
						</div>
					</div>
				</div>
			`);
			$('#manual-subjects').append(newRow);
		});
	});
	
	// Import subjects
	$('#import-subjects').click(function(){
		start_load();
		$('#msg').html('');
		
		var subjects = [];
		var hasError = false;
		
		// Collect all subjects from manual input
		$('.subject-row').each(function(){
			var codeBase = $(this).find('.subject-code-base').val().trim().toUpperCase();
			var name = $(this).find('.subject-name').val().trim();
			var grade = $(this).find('.grade-level').val();
			var strand = $(this).find('.strand').val();
			var description = $(this).find('.description').val().trim();
			
			if (codeBase && name) {
				var fullCode = codeBase + '-' + strand + '-' + grade;
				subjects.push({
					code: fullCode,
					subject: name,
					description: description || 'SHS Subject'
				});
			}
		});
		
		if (subjects.length === 0) {
			$('#msg').html('<div class="alert alert-warning"><i class="fa fa-exclamation-triangle"></i> Please add at least one subject to import.</div>');
			end_load();
			return;
		}
		
		// Send AJAX request to import subjects
		$.ajax({
			url: 'ajax.php?action=bulk_import_shs_subjects',
			method: 'POST',
			data: {subjects: JSON.stringify(subjects)},
			success: function(resp){
				if(resp == 1){
					alert_toast("SHS Subjects successfully imported!", "success");
					setTimeout(function(){
						location.reload();
					}, 1750);
				} else {
					$('#msg').html('<div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> Error importing subjects. Some subjects may already exist.</div>');
					end_load();
				}
			},
			error: function(){
				$('#msg').html('<div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> Error occurred during import.</div>');
				end_load();
			}
		});
	});
});
</script>
