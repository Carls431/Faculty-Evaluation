<?php
// Clear all variables for new faculty (not edit)
if(!isset($_GET['id'])) {
    $school_id = '';
    $firstname = '';
    $lastname = '';
    $email = '';
    $gender = '';
    $role = '';
    $avatar = '';
    $password = '';
    $id = '';
}
?>
<div class="col-lg-12">
	<div class="card">
		<div class="card-body">
			<form action="" id="manage_faculty">
				<input type="hidden" name="id" value="<?php echo isset($id) ? $id : '' ?>">
				<div class="row">
					<div class="col-md-6 border-right">
						<div class="form-group">
							<label for="" class="control-label">Teacher ID</label>
							<input type="text" name="school_id" class="form-control form-control-sm" required value="<?php echo isset($school_id) && !empty($school_id) ? $school_id : '' ?>">
						</div>
						<div class="form-group">
							<label for="" class="control-label">First Name</label>
							<input type="text" name="firstname" class="form-control form-control-sm" required value="<?php echo isset($firstname) && !empty($firstname) ? $firstname : '' ?>">
						</div>
						<div class="form-group">
							<label for="" class="control-label">Last Name</label>
							<input type="text" name="lastname" class="form-control form-control-sm" required value="<?php echo isset($lastname) && !empty($lastname) ? $lastname : '' ?>">
						</div>
						<div class="form-group">
							<label for="" class="control-label">Gender</label>
							<select name="gender" class="form-control form-control-sm" required>
								<option value="">Select Gender</option>
								<option value="Male" <?php echo isset($gender) && $gender == 'Male' ? 'selected' : '' ?>>Male</option>
								<option value="Female" <?php echo isset($gender) && $gender == 'Female' ? 'selected' : '' ?>>Female</option>
							</select>
						</div>
						<div class="form-group">
							<label for="" class="control-label">Role</label>
							<select name="role" class="form-control form-control-sm" required>
								<option value="">Select Role</option>
								<option value="Subject Teacher" <?php echo isset($role) && $role == 'Subject Teacher' ? 'selected' : '' ?>>Subject Teacher</option>
								<option value="Adviser" <?php echo isset($role) && $role == 'Adviser' ? 'selected' : '' ?>>Adviser</option>
								<option value="Both" <?php echo isset($role) && $role == 'Both' ? 'selected' : '' ?>>Both (Subject Teacher & Adviser)</option>
							</select>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label for="" class="control-label">Avatar</label>
							<div class="custom-file">
		                      <input type="file" class="custom-file-input" id="customFile" name="img" onchange="displayImg(this,$(this))">
		                      <label class="custom-file-label" for="customFile">Choose file</label>
		                    </div>
						</div>
						<div class="form-group d-flex justify-content-center align-items-center">
							<img src="<?php echo isset($avatar) ? 'assets/uploads/'.$avatar :'' ?>" alt="Avatar" id="cimg" class="img-fluid img-thumbnail ">
						</div>
						<div class="form-group">
							<label class="control-label">Email</label>
							<input type="email" class="form-control form-control-sm" name="email" required value="<?php echo isset($email) && !empty($email) ? $email : '' ?>">
							<small id="#msg"></small>
						</div>
						<div class="form-group">
							<label class="control-label">Password</label>
							<input type="password" class="form-control form-control-sm" name="password" <?php echo !isset($id) ? "required":'' ?> value="">
							<small><i><?php echo isset($id) ? "Leave this blank if you dont want to change you password":'' ?></i></small>
						</div>
						<div class="form-group">
							<label class="label control-label">Confirm Password</label>
							<input type="password" class="form-control form-control-sm" name="cpass" <?php echo !isset($id) ? 'required' : '' ?>>
							<small id="pass_match" data-status=''></small>
						</div>
					</div>
				</div>
				<hr>
				<div class="row">
					<div class="col-md-12">
						<div id="msg"></div>
					</div>
				</div>
				<!-- Buttons - show when not in modal -->
				<div class="row" id="form-buttons">
					<div class="col-md-12 text-center">
						<button class="btn btn-primary btn-sm" type="submit" form="manage_faculty" id="save_faculty">Save</button>
						<button class="btn btn-secondary btn-sm" type="button" onclick="cancelEdit()">Cancel</button>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
<style>
	img#cimg{
		height: 15vh;
		width: 15vh;
		object-fit: cover;
		border-radius: 100% 100%;
	}
	
	#form-buttons {
		margin-top: 20px;
		padding: 15px 0;
		border-top: 1px solid #dee2e6;
	}
	
	#form-buttons .btn {
		margin: 0 5px;
		min-width: 100px;
		padding: 8px 16px;
	}
	
	#save_faculty {
		background-color: #007bff;
		border-color: #007bff;
		color: white;
	}
	
	#save_faculty:hover {
		background-color: #0056b3;
		border-color: #0056b3;
	}
</style>
<script>
	$('[name="password"],[name="cpass"]').keyup(function(){
		var pass = $('[name="password"]').val()
		var cpass = $('[name="cpass"]').val()
		if(cpass == '' ||pass == ''){
			$('#pass_match').attr('data-status','')
		}else{
			if(cpass == pass){
				$('#pass_match').attr('data-status','1').html('<i class="text-success">Password Matched.</i>')
			}else{
				$('#pass_match').attr('data-status','2').html('<i class="text-danger">Password does not match.</i>')
			}
		}
	})
	function displayImg(input,_this) {
	    if (input.files && input.files[0]) {
	        var reader = new FileReader();
	        reader.onload = function (e) {
	        	$('#cimg').attr('src', e.target.result);
	        }

	        reader.readAsDataURL(input.files[0]);
	    }
	}
	$(function(){
		// Check if we're in a modal context by checking URL parameters
		var urlParams = new URLSearchParams(window.location.search);
		var isDirectPage = urlParams.has('page') && urlParams.get('page').includes('faculty');
		
		if (isDirectPage) {
			// Direct page - show form buttons and add click handlers
			$('#form-buttons').show();
			
			// Add click handler for Save button
			$('#save_faculty').click(function(e){
				e.preventDefault();
				$('#manage_faculty').submit();
			});
		} else {
			// In modal - hide form buttons and use modal footer buttons
			$('#form-buttons').hide();
			// Handle modal footer buttons
			$(document).on('click', '.modal-footer .btn-primary', function(){
				$('#manage_faculty').submit();
			});
		}
		
		// Form submission handler
		$('#manage_faculty').submit(function(e){
			e.preventDefault();
			$('#msg').html('');
			
			// Basic form validation
			var school_id = $('[name="school_id"]').val().trim();
			var firstname = $('[name="firstname"]').val().trim();
			var lastname = $('[name="lastname"]').val().trim();
			var email = $('[name="email"]').val().trim();
			var gender = $('[name="gender"]').val();
			var role = $('[name="role"]').val();
			
			if(!school_id) {
				$('#msg').html("<div class='alert alert-danger'>Teacher ID is required.</div>");
				return false;
			}
			if(!firstname) {
				$('#msg').html("<div class='alert alert-danger'>First Name is required.</div>");
				return false;
			}
			if(!lastname) {
				$('#msg').html("<div class='alert alert-danger'>Last Name is required.</div>");
				return false;
			}
			if(!email) {
				$('#msg').html("<div class='alert alert-danger'>Email is required.</div>");
				return false;
			}
			if(!gender) {
				$('#msg').html("<div class='alert alert-danger'>Gender is required.</div>");
				return false;
			}
			if(!role) {
				$('#msg').html("<div class='alert alert-danger'>Role is required.</div>");
				return false;
			}
			
			// Check password validation
			if($('[name="password"]').val() != '' && $('[name="cpass"]').val() != ''){
				if($('#pass_match').attr('data-status') == '2'){
					$('#msg').html("<div class='alert alert-danger'>Password does not match.</div>");
					return false;
				}
			}
			
			console.log('Form validation passed, submitting...'); // Debug log
			start_load();
			
			$.ajax({
				url:'ajax.php?action=save_faculty',
				data: new FormData($(this)[0]),
			    cache: false,
			    contentType: false,
			    processData: false,
			    method: 'POST',
			    type: 'POST',
				success:function(resp){
					console.log('Save faculty response:', resp); // Debug log
					if(resp == 1){
						alert_toast('Data successfully saved.',"success");
						setTimeout(function(){
							if ($('#uni_modal').length && $('#uni_modal').hasClass('show')) {
								$('#uni_modal').modal('hide');
							}
							window.location.href = './index.php?page=faculty_list';
						},2000)
					}else if(resp == 2){
						$('#msg').html("<div class='alert alert-danger'>Teacher ID already exists.</div>");
						end_load()
					}else if(resp == 3){
						$('#msg').html("<div class='alert alert-danger'>Email already exists.</div>");
						end_load()
					}else if(resp == 0){
						$('#msg').html("<div class='alert alert-danger'>Database error occurred. Please check the form data and try again.</div>");
						end_load()
					}else{
						$('#msg').html("<div class='alert alert-danger'>An error occurred while saving. Please try again. (Code: " + resp + ")</div>");
						end_load()
					}
				}
			});
		});
	});
	
	// Clear form only for NEW faculty (not edit mode)
	$(document).ready(function(){
		// Stop any existing loading states
		end_load();
		
		<?php if(!isset($id) || empty($id)): ?>
		// Only clear form for new faculty, not edit mode
		setTimeout(function(){
			$('#manage_faculty')[0].reset();
			$('#manage_faculty input[type="text"]').val('');
			$('#manage_faculty input[type="email"]').val('');
			$('#manage_faculty input[type="password"]').val('');
			$('#manage_faculty select').val('');
			$('#cimg').attr('src', '');
			$('#pass_match').html('').attr('data-status', '');
			end_load();
		}, 100);
		<?php endif; ?>
	});
	
	// Cancel function that works for both modal and direct page
	function cancelEdit() {
		if ($('#uni_modal').length && $('#uni_modal').hasClass('show')) {
			// If in modal, close modal
			$('#uni_modal').modal('hide');
		} else {
			// If direct page, go back to faculty list
			window.location.href = './index.php?page=faculty_list';
		}
	}
</script>