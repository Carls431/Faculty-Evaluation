<?php
?>
<div class="col-lg-12">
	<div class="card">
		<div class="card-body">
			<form action="" id="manage_user">
				<input type="hidden" name="id" value="<?php echo isset($id) ? $id : '' ?>">
				<div class="row">
					<div class="col-md-6 border-right">
						<div class="form-group">
							<label for="" class="control-label">First Name</label>
							<input type="text" name="firstname" class="form-control form-control-sm" required value="<?php echo isset($firstname) ? $firstname : '' ?>">
						</div>
						<div class="form-group">
							<label for="" class="control-label">Last Name</label>
							<input type="text" name="lastname" class="form-control form-control-sm" required value="<?php echo isset($lastname) ? $lastname : '' ?>">
						</div>
						<div class="form-group">
							<label for="" class="control-label">Avatar</label>
							<div class="custom-file">
		                      <input type="file" class="custom-file-input" id="customFile" name="img" onchange="displayImg(this,$(this))">
		                      <label class="custom-file-label" for="customFile">Choose file</label>
		                    </div>
						</div>
						<div class="form-group d-flex justify-content-center align-items-center">
							<?php 
							$avatar_src = '';
							$show_placeholder = true;
							
							if(isset($avatar) && !empty($avatar)) {
								// Check if we're accessing through index.php routing or directly
								$avatar_path_direct = '../assets/uploads/' . $avatar;  // Direct admin folder access
								$avatar_path_routed = 'assets/uploads/' . $avatar;     // Through index.php routing
								
								if(file_exists($avatar_path_direct)) {
									$avatar_src = '../assets/uploads/' . $avatar;
									$show_placeholder = false;
								} elseif(file_exists($avatar_path_routed)) {
									$avatar_src = 'assets/uploads/' . $avatar;
									$show_placeholder = false;
								}
							}
							?>
							<?php if($show_placeholder): ?>
								<div id="cimg" class="img-fluid img-thumbnail d-flex justify-content-center align-items-center bg-secondary text-white" style="height: 15vh; width: 15vh; border-radius: 50%; font-size: 2rem;">
									<?php 
									if(isset($firstname) && isset($lastname)) {
										echo strtoupper(substr($firstname, 0, 1) . substr($lastname, 0, 1));
									} else {
										echo '<i class="fas fa-user"></i>';
									}
									?>
								</div>
							<?php else: ?>
								<img src="<?php echo $avatar_src ?>" alt="Avatar" id="cimg" class="img-fluid img-thumbnail">
							<?php endif; ?>
						</div>
					</div>
					<div class="col-md-6">
						
						<div class="form-group">
							<label class="control-label">Email</label>
							<input type="email" class="form-control form-control-sm" name="email" required value="<?php echo isset($email) ? $email : '' ?>">
							<small id="#msg"></small>
						</div>
						<div class="form-group">
							<label class="control-label">Password</label>
							<input type="password" class="form-control form-control-sm" name="password" <?php echo !isset($id) ? "required":'' ?>>
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
				<div class="col-lg-12 text-right justify-content-center d-flex">
					<button class="btn btn-primary mr-2">Save</button>
					<button class="btn btn-secondary" type="button" onclick="location.href = 'index.php?page=user_list'">Cancel</button>
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
#password_strength {
    margin-left: 10px;
    font-weight: bold;
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
	        	// Replace placeholder div with actual image
	        	var imgContainer = $('#cimg').parent();
	        	$('#cimg').remove();
	        	imgContainer.append('<img src="' + e.target.result + '" alt="Avatar" id="cimg" class="img-fluid img-thumbnail">');
	        }

	        reader.readAsDataURL(input.files[0]);
	    }
	}
	$('#manage_user').submit(function(e){
		e.preventDefault()
		$('input').removeClass("border-danger")
		start_load()
		$('#msg').html('')
		if($('[name="password"]').val() != '' && $('[name="cpass"]').val() != ''){
			if($('#pass_match').attr('data-status') != 1){
				if($("[name='password']").val() !=''){
					$('[name="password"],[name="cpass"]').addClass("border-danger")
					end_load()
					return false;
				}
			}
		}
		$.ajax({
			url:'ajax.php?action=save_user',
			data: new FormData($(this)[0]),
		    cache: false,
		    contentType: false,
		    processData: false,
		    method: 'POST',
		    type: 'POST',
			success:function(resp){
				if(resp == 1){
					alert_toast('Data successfully saved.',"success");
					setTimeout(function(){
						location.replace('index.php?page=user_list')
					},750)
				}else if(resp == 2){
					$('#msg').html("<div class='alert alert-danger'>Email already exist.</div>");
					$('[name="email"]').addClass("border-danger")
					end_load()
				}
			}
		})
	})
	$('[name="password"]').keyup(function(){
    var password = $(this).val();
    var strength = checkPasswordStrength(password);
    var strengthText = '';
    var textColor = '';
    
    if(password.length === 0) {
        strengthText = '';
    } else if(password.length < 4) {
        strengthText = 'Weak password';
        textColor = 'text-danger';
    } else if(password.length < 8) {
        strengthText = 'Moderate';
        textColor = 'text-warning';
    } else {
        strengthText = 'Strong password';
        textColor = 'text-success';
    }

    // Update or create strength indicator
    if($('#password_strength').length === 0) {
        $('[name="password"]').after('<small id="password_strength"></small>');
    }
    $('#password_strength').html(`<i class="${textColor}">${strengthText}</i>`);
});

function checkPasswordStrength(password) {
    // Initialize score
    let score = 0;
    
    // Check length
    if(password.length >= 8) score += 2;
    else if(password.length >= 4) score += 1;
    
    // Check for mixed case
    if(password.match(/[a-z]/) && password.match(/[A-Z]/)) score += 2;
    
    // Check for numbers
    if(password.match(/\d/)) score += 2;
    
    // Check for special characters
    if(password.match(/[^a-zA-Z\d]/)) score += 2;
    
    return score;
}
</script>