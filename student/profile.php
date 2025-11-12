<?php
// Get current student data
$student_id = $_SESSION['login_id'];
$student = $conn->query("SELECT * FROM student_list WHERE id = {$student_id}")->fetch_assoc();
?>

<style>
    /* Ensure full width for student interface */
    .content-wrapper {
        margin-left: 0 !important;
    }
    
    .profile-container {
        max-width: 800px;
        margin: 20px auto;
    }
    
    .profile-header {
        background: linear-gradient(135deg, #800000, #a52a2a, #8b0000);
        color: white;
        padding: 30px;
        border-radius: 10px 10px 0 0;
        text-align: center;
    }
    
    .profile-avatar {
        width: 120px;
        height: 120px;
        border-radius: 50%;
        border: 4px solid white;
        object-fit: cover;
        margin-bottom: 15px;
    }
    
    .profile-body {
        background: white;
        padding: 30px;
        border-radius: 0 0 10px 10px;
        box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }
    
    .form-group label {
        font-weight: 600;
        color: #800000;
    }
    
    .btn-maroon {
        background: linear-gradient(135deg, #800000, #a52a2a);
        color: white;
        border: none;
        padding: 10px 30px;
        border-radius: 5px;
        font-weight: 600;
    }
    
    .btn-maroon:hover {
        background: linear-gradient(135deg, #a52a2a, #800000);
        color: white;
    }
    
    .avatar-upload {
        position: relative;
        display: inline-block;
    }
    
    .avatar-upload input[type="file"] {
        display: none;
    }
    
    .avatar-upload label {
        cursor: pointer;
        position: absolute;
        bottom: 0;
        right: 0;
        background: #800000;
        color: white;
        border-radius: 50%;
        width: 35px;
        height: 35px;
        display: flex;
        align-items: center;
        justify-content: center;
        border: 3px solid white;
    }
    
    .avatar-upload label:hover {
        background: #a52a2a;
    }
    
    .info-text {
        font-size: 0.9em;
        color: #666;
        margin-top: 5px;
    }
    
    .password-toggle {
        cursor: pointer;
        position: absolute;
        right: 10px;
        top: 38px;
        color: #800000;
    }
</style>

<div class="profile-container">
    <div class="profile-header">
        <div class="avatar-upload">
            <img src="../assets/uploads/<?php echo !empty($student['avatar']) ? $student['avatar'] : 'no-image-available.png' ?>" 
                 alt="Profile Picture" 
                 class="profile-avatar" 
                 id="profile-preview">
            <label for="avatar-input">
                <i class="fas fa-camera"></i>
            </label>
            <input type="file" id="avatar-input" accept="image/*">
        </div>
        <h3><?php echo ucwords($student['firstname'] . ' ' . $student['lastname']) ?></h3>
        <p class="mb-0"><i class="fas fa-id-card"></i> <?php echo $student['student_id'] ?></p>
    </div>
    
    <div class="profile-body">
        <form id="profile-form">
            <input type="hidden" name="id" value="<?php echo $student_id ?>">
            
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="firstname">First Name <span class="text-danger">*</span></label>
                        <input type="text" 
                               class="form-control" 
                               id="firstname" 
                               name="firstname" 
                               value="<?php echo $student['firstname'] ?>" 
                               required>
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="lastname">Last Name <span class="text-danger">*</span></label>
                        <input type="text" 
                               class="form-control" 
                               id="lastname" 
                               name="lastname" 
                               value="<?php echo $student['lastname'] ?>" 
                               required>
                    </div>
                </div>
            </div>
            
            <div class="form-group">
                <label for="email">Email Address <span class="text-danger">*</span></label>
                <input type="email" 
                       class="form-control" 
                       id="email" 
                       name="email" 
                       value="<?php echo $student['email'] ?>" 
                       required>
                <small class="info-text">Used for password recovery and notifications</small>
            </div>
            
            <div class="form-group">
                <label for="phone">Phone Number</label>
                <input type="text" 
                       class="form-control" 
                       id="phone" 
                       name="phone" 
                       value="<?php echo $student['phone'] ?>" 
                       placeholder="+63 XXX XXX XXXX">
                <small class="info-text">Optional: For SMS notifications</small>
            </div>
            
            <hr class="my-4">
            
            <h5 class="mb-3" style="color: #800000;"><i class="fas fa-lock"></i> Change Password</h5>
            <p class="info-text mb-3">Leave blank if you don't want to change your password</p>
            
            <div class="form-group position-relative">
                <label for="current_password">Current Password</label>
                <input type="password" 
                       class="form-control" 
                       id="current_password" 
                       name="current_password" 
                       placeholder="Enter current password to change">
                <i class="fas fa-eye password-toggle" onclick="togglePassword('current_password')"></i>
            </div>
            
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group position-relative">
                        <label for="new_password">New Password</label>
                        <input type="password" 
                               class="form-control" 
                               id="new_password" 
                               name="new_password" 
                               placeholder="Enter new password">
                        <i class="fas fa-eye password-toggle" onclick="togglePassword('new_password')"></i>
                        <small class="info-text">Minimum 6 characters</small>
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="form-group position-relative">
                        <label for="confirm_password">Confirm Password</label>
                        <input type="password" 
                               class="form-control" 
                               id="confirm_password" 
                               name="confirm_password" 
                               placeholder="Confirm new password">
                        <i class="fas fa-eye password-toggle" onclick="togglePassword('confirm_password')"></i>
                    </div>
                </div>
            </div>
            
            <div class="form-group mt-4">
                <button type="submit" class="btn btn-maroon btn-block">
                    <i class="fas fa-save"></i> Update Profile
                </button>
            </div>
        </form>
    </div>
</div>

<script>
// Toggle password visibility
function togglePassword(fieldId) {
    const field = document.getElementById(fieldId);
    const icon = field.nextElementSibling;
    
    if (field.type === 'password') {
        field.type = 'text';
        icon.classList.remove('fa-eye');
        icon.classList.add('fa-eye-slash');
    } else {
        field.type = 'password';
        icon.classList.remove('fa-eye-slash');
        icon.classList.add('fa-eye');
    }
}

// Avatar preview
document.getElementById('avatar-input').addEventListener('change', function(e) {
    const file = e.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('profile-preview').src = e.target.result;
        }
        reader.readAsDataURL(file);
    }
});

// Form submission
$('#profile-form').submit(function(e) {
    e.preventDefault();
    
    // Validate passwords if changing
    const currentPass = $('#current_password').val();
    const newPass = $('#new_password').val();
    const confirmPass = $('#confirm_password').val();
    
    if (newPass || confirmPass) {
        if (!currentPass) {
            alert_toast('Please enter your current password', 'warning');
            return false;
        }
        
        if (newPass !== confirmPass) {
            alert_toast('New passwords do not match', 'warning');
            return false;
        }
        
        if (newPass.length < 6) {
            alert_toast('Password must be at least 6 characters', 'warning');
            return false;
        }
    }
    
    // Create FormData for file upload
    const formData = new FormData(this);
    
    // Add avatar if selected
    const avatarFile = document.getElementById('avatar-input').files[0];
    if (avatarFile) {
        formData.append('avatar', avatarFile);
    }
    
    // Submit via AJAX
    $.ajax({
        url: '../ajax.php?action=update_student_profile',
        method: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success: function(resp) {
            if (resp == 1) {
                alert_toast('Profile updated successfully', 'success');
                setTimeout(function() {
                    location.reload();
                }, 1500);
            } else if (resp == 2) {
                alert_toast('Current password is incorrect', 'danger');
            } else if (resp == 3) {
                alert_toast('Email already exists', 'warning');
            } else {
                alert_toast('An error occurred', 'danger');
            }
        },
        error: function() {
            alert_toast('An error occurred', 'danger');
        }
    });
});
</script>
