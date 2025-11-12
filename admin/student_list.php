<?php include'db_connect.php' ?>
<div class="col-lg-12">
	<div class="card card-outline card-success">
		<div class="card-header">
			<h4 class="card-title"><B>Student List</B></h4>
			<div class="card-tools">
				<button class="btn btn-block btn-sm btn-default btn-flat border-primary new_student" id="new_student_btn"><i class="fa fa-plus"></i> Add New Student</button>
			</div>
		</div>
		<div class="card-body">
			<table class="table tabe-hover table-bordered" id="list">
				<thead>
					<tr>
						<th class="text-center">#</th>
						<th>Student ID</th>
						<th>Name</th>
						<th>Email</th>
				<th>Phone</th>
				<th>SMS Notifications</th>
						<th>Current Class</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$i = 1;
					$class= array();
					$classes = $conn->query("SELECT id,concat(curriculum,' ',level,' - ',section) as `class` FROM class_list");
					while($row=$classes->fetch_assoc()){
						$class[$row['id']] = $row['class'];
					}
					$qry = $conn->query("SELECT *,concat(firstname,' ',lastname) as name FROM student_list order by concat(firstname,' ',lastname) asc");
					while($row= $qry->fetch_assoc()):
					?>
					<tr>
						<th class="text-center"><?php echo $i++ ?></th>
						<td><b><?php echo isset($row['student_id']) ? $row['student_id'] : 'N/A'; ?></b></td>
						<td><b><?php echo ucwords($row['name']) ?></b></td>
						<td><b><?php echo $row['email'] ?></b></td>
				<td>
					<input type="text" class="form-control form-control-sm" 
					       value="<?php echo isset($row['phone']) ? $row['phone'] : ''; ?>" 
					       data-student-id="<?php echo $row['id']; ?>"
					       data-field="phone">
				</td>
				<td>
					<div class="form-check form-check-inline">
						<input type="checkbox" class="form-check-input" 
						       id="sms_<?php echo $row['id']; ?>" 
						       data-student-id="<?php echo $row['id']; ?>"
						       data-field="sms_notifications"
						       <?php echo isset($row['sms_notifications']) && $row['sms_notifications'] ? 'checked' : ''; ?>>
						<label class="form-check-label" for="sms_<?php echo $row['id']; ?>">Enable</label>
					</div>
				</td>
						<td><b><?php echo isset($class[$row['class_id']]) ? $class[$row['class_id']] : "N/A" ?></b></td>
						<td class="text-center">
							<button type="button" class="btn btn-default btn-sm btn-flat border-info wave-effect text-info dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
		                      Action
		                    </button>
		                    <div class="dropdown-menu" style"">
		                      <a class="dropdown-item view_student" href="javascript:void(0)" data-id="<?php echo $row['id'] ?>">View</a>
		                      <div class="dropdown-divider"></div>
		                      <a class="dropdown-item" href="./index.php?page=edit_student&id=<?php echo $row['id'] ?>">Edit</a>
																<div class="dropdown-divider"></div>
																<a class="dropdown-item send_sms" href="javascript:void(0)" 
																   data-id="<?php echo $row['id']; ?>"
																   data-name="<?php echo ucwords($row['name']); ?>"
																   data-phone="<?php echo isset($row['phone']) ? $row['phone'] : ''; ?>">Send SMS</a>
		                      <div class="dropdown-divider"></div>
		                      <a class="dropdown-item delete_student" href="javascript:void(0)" data-id="<?php echo $row['id'] ?>">Delete</a>
		                    </div>
						</td>
					</tr>	
				<?php endwhile; ?>
				</tbody>
			</table>
		</div>
	</div>
</div>

<!-- SMS Modal -->
<div class="modal fade" id="smsModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Send SMS</h5>
                <button type="button" class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="smsForm">
                    <input type="hidden" id="selectedStudentId">
                    <div class="form-group">
                        <label>To: <span id="recipientName"></span></label>
                        <input type="text" class="form-control" id="recipientPhone" readonly>
                    </div>
                    <div class="form-group">
                        <label for="message">Message:</label>
                        <textarea class="form-control" id="message" 
                                  rows="3" maxlength="160"></textarea>
                        <small class="form-text text-muted">Max 160 characters</small>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" id="sendSmsBtn">Send SMS</button>
            </div>
        </div>
    </div>
</div>

<!-- Add New Student Modal -->
<div class="modal fade" id="newStudentModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add New Student</h5>
                <button type="button" class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
				<form action="" id="manage_student">
					<input type="hidden" name="id" value="">
					<div class="row">
						<div class="col-md-6 border-right">
							<div class="form-group">
								<label for="" class="control-label">Student ID</label>
								<input type="text" name="student_id" class="form-control form-control-sm" required value="">
							</div>
							<div class="form-group">
								<label for="" class="control-label">First Name</label>
								<input type="text" name="firstname" class="form-control form-control-sm" required value="">
							</div>
							<div class="form-group">
								<label for="" class="control-label">Last Name</label>
								<input type="text" name="lastname" class="form-control form-control-sm" required value="">
							</div>
							<div class="form-group">
								<label for="" class="control-label">Class</label>
								<select name="class_id" id="class_id" class="form-control form-control-sm select2">
									<option value=""></option>
									<?php 
									$classes = $conn->query("SELECT id,concat(curriculum,' ',level,' - ',section) as class FROM class_list");
									while($row=$classes->fetch_assoc()):
									?>
									<option value="<?php echo $row['id'] ?>"><?php echo $row['class'] ?></option>
									<?php endwhile; ?>
								</select>
							</div>
							<div class="form-group">
								<label for="" class="control-label">Avatar</label>
								<div class="custom-file">
			                      <input type="file" class="custom-file-input" id="customFile" name="img" onchange="displayImg(this,$(this))">
			                      <label class="custom-file-label" for="customFile">Choose file</label>
			                    </div>
							</div>
							<div class="form-group d-flex justify-content-center align-items-center">
								<img src="" alt="Avatar" id="cimg" class="img-fluid img-thumbnail ">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label">Email</label>
								<input type="email" class="form-control form-control-sm" name="email" required value="">
								<small id="#msg"></small>
							</div>
						</div>
					</div>
					<hr>
				</form>
			<div class="modal-footer">
				<button class="btn btn-primary mr-2" form="manage_student">Save</button>
				<button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
			</div>
        </div>
    </div>
</div>

<style>
	.new_student {
		border-color: #007bff !important;
	}
	.col-lg-12 {
		padding-top: 30px !important;
		margin-top: 25px !important;
	}
	.card-header {
		margin-bottom: 40px !important;
		padding-bottom: 25px !important;
		border-bottom: 3px solid #007bff;
	}
	img#cimg{
		height: 15vh;
		width: 15vh;
		object-fit: cover;
		border-radius: 100% 100%;
	}
</style>

<script>
	$(document).ready(function(){
		$('#new_student_btn').click(function(){
			$('#newStudentModal').modal('show');
		})

		$('.view_student').click(function(){
			uni_modal("<i class='fa fa-id-card'></i> student Details","<?php echo $_SESSION['login_view_folder'] ?>view_student.php?id="+$(this).attr('data-id'))
		})

		$('.delete_student').click(function(){
			_conf("Are you sure to delete this student?","delete_student",[$(this).attr('data-id')])
		})

		// Initialize DataTable
		$('#list').dataTable()

		// Style the search input field
		$('.dataTables_filter input').css({
			'border': '2px solid #007bff',
			'border-radius': '4px',
			'padding': '4px 8px',
			'outline': 'none'
		});

		// Handle phone number updates
		$(document).on('change', 'input[data-field="phone"]', function() {
			const studentId = $(this).data('student-id');
			const phone = $(this).val();

			$.ajax({
				url:'ajax.php?action=update_student_phone',
				method:'POST',
				data:{
					id: studentId,
					phone: phone
				},
				success:function(resp){
					if(resp == 1){
						alert_toast("Phone number updated successfully",'success');
					}
				}
			});
		});

		// Handle SMS notification toggle
		$(document).on('change', 'input[data-field="sms_notifications"]', function() {
			const studentId = $(this).data('student-id');
			const enabled = $(this).is(':checked');

			$.ajax({
				url:'ajax.php?action=toggle_sms_notifications',
				method:'POST',
				data:{
					id: studentId,
					sms_notifications: enabled
				},
				success:function(resp){
					if(resp == 1){
						alert_toast("SMS preference updated",'success');
					}
				}
			});
		});

		// Handle send SMS button click
		$(document).on('click', '.send_sms', function() {
			const studentId = $(this).data('id');
			const studentName = $(this).data('name');
			const studentPhone = $(this).data('phone');

			$('#selectedStudentId').val(studentId);
			$('#recipientName').text(studentName);
			$('#recipientPhone').val(studentPhone);
			$('#smsModal').modal('show');
		});

		// Handle send SMS form submission
		$('#sendSmsBtn').click(function() {
			const studentId = $('#selectedStudentId').val();
			const message = $('#message').val();

			if(!message){
				alert_toast("Please enter a message",'warning');
				return;
			}

			start_load();
			$.ajax({
				url:'ajax.php?action=send_sms',
				method:'POST',
				data:{
					id: studentId,
					message: message
				},
				success:function(resp){
					if(resp == 1){
						alert_toast("SMS sent successfully",'success');
						$('#smsModal').modal('hide');
					} else {
						alert_toast("Failed to send SMS",'danger');
					}
					end_load();
				}
			});
		});

		// Handle new student form submission
		$('#manage_student').submit(function(e){
			e.preventDefault();
			start_load();
			$.ajax({
				url:'ajax.php?action=save_student',
				data: new FormData($(this)[0]),
			    cache: false,
			    contentType: false,
			    processData: false,
			    method: 'POST',
			    type: 'POST',
				success:function(resp){
					if(resp == 1){
						alert_toast("Data successfully saved.",'success');
						setTimeout(function(){
							location.reload()
						},1500)
					}else if(resp == 2){
						$('#msg').html('<div class="alert alert-danger">Email already exist.</div>');
						$('[name="email"]').addClass("border-danger")
						end_load();
					}
				}
			})
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
	})

	function delete_student($id){
		start_load()
		$.ajax({
			url:'ajax.php?action=delete_student',
			method:'POST',
			data:{id:$id},
			success:function(resp){
				if(resp==1){
					alert_toast("Data successfully deleted",'success')
					setTimeout(function(){
						location.reload()
					},1500)

				}
			}
		})
	}
</script>
