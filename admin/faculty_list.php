<?php include'db_connect.php' ?>
<?php include 'admin_history_logger.php' ?>
<?php
// Log faculty list access
$historyLogger->logDataAccess('faculty_list', null, 'Accessed Faculty List page');
?>
<div class="container-fluid">
	<div class="col-lg-12">
		<div class="row">
			<!-- FORM Panel -->

			<!-- Table Panel -->
			<div class="col-md-12">
				<div class="card">
					<div class="card-header">
						<b>Teacher List</b>
						<span class="float:right"><button class="btn btn-primary btn-block btn-sm col-sm-2 float-right" type="button" id="new_faculty">
					<i class="fa fa-plus"></i> Add New</button></span>
					</div>
					<div class="card-body">
						<div class="mb-3">
							<button class="btn btn-info btn-sm" id="filter-advisers">
								<i class="fa fa-users"></i> Show All Advisers
							</button>
							<button class="btn btn-secondary btn-sm" id="filter-subject-teachers">
								<i class="fa fa-chalkboard-teacher"></i> Show All Subject Teachers
							</button>
							<button class="btn btn-outline-dark btn-sm" id="filter-all">
								<i class="fa fa-list"></i> Show All
							</button>
						</div>
						<table class="table table-bordered table-hover" id="list">
							<thead>
								<tr>
									<th class="text-center">#</th>
									<th>Teacher ID</th>
									<th>Name</th>
									<th>Email</th>
									<th>Roles</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								<?php
								$i = 1;
								$qry = $conn->query("SELECT f.*, 
									CONCAT(f.firstname,' ',f.lastname) as name,
									CASE 
										WHEN f.gender = 'Male' THEN CONCAT('Mr. ', f.firstname, ' ', f.lastname)
										WHEN f.gender = 'Female' THEN CONCAT('Ms. ', f.firstname, ' ', f.lastname)
										ELSE CONCAT(f.firstname, ' ', f.lastname)
									END as display_name
								FROM faculty_list f
								ORDER BY CONCAT(f.firstname,' ',f.lastname) ASC");
								while($row= $qry->fetch_assoc()):
								?>
								<tr>
									<th class="text-center"><?php echo $i++ ?></th>
									<td><b><?php echo $row['school_id'] ?></b></td>
									<td><b><?php echo ucwords($row['display_name']) ?></b></td>
									<td><b><?php echo $row['email'] ?></b></td>
									<td>
										<?php if($row['role'] == 'Subject Teacher'): ?>
											<span class="badge badge-secondary">Subject Teacher</span>
										<?php elseif($row['role'] == 'Adviser'): ?>
											<span class="badge badge-info">Adviser</span>
										<?php elseif($row['role'] == 'Both'): ?>
											<span class="badge badge-info">Adviser</span>
											<span class="badge badge-secondary">Subject Teacher</span>
										<?php else: ?>
											<span class="text-muted">—</span>
										<?php endif; ?>
									</td>
									<td class="text-center">
										<button type="button" class="btn btn-default btn-sm dropdown-toggle dropdown-icon" data-toggle="dropdown">
					                      Action
					                    <span class="sr-only">Toggle Dropdown</span>
					                    </button>
					                    <div class="dropdown-menu" role="menu">
					                      <a class="dropdown-item view_faculty" href="javascript:void(0)" data-id="<?php echo $row['id'] ?>">View</a>
					                      <div class="dropdown-divider"></div>
					                      <a class="dropdown-item" href="./index.php?page=edit_faculty&id=<?php echo $row['id'] ?>">Edit</a>
					                      <div class="dropdown-divider"></div>
					                      <a class="dropdown-item delete_faculty" href="javascript:void(0)" data-id="<?php echo $row['id'] ?>">Delete</a>
					                    </div>
									</td>
								</tr>	
							<?php endwhile; ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script>
	$(document).ready(function(){
		var table = $('#list').DataTable({
			initComplete: function () {
				$('.dataTables_filter input[type="search"]').attr('style', 
					'border: 2px solid #007bff !important; border-radius: 4px; padding: 4px 8px; outline: none;');
			}
		});

		// Filter for Advisers only
		$('#filter-advisers').click(function(){
			table.column(4).search('Adviser').draw();
			$('.btn').removeClass('active');
			$(this).addClass('active');
		});

		// Filter for Subject Teachers only
		$('#filter-subject-teachers').click(function(){
			table.column(4).search('Subject Teacher').draw();
			$('.btn').removeClass('active');
			$(this).addClass('active');
		});

		// Show all teachers
		$('#filter-all').click(function(){
			table.column(4).search('').draw();
			$('.btn').removeClass('active');
			$(this).addClass('active');
		});

		// Set "Show All" as active by default
		$('#filter-all').addClass('active');
	})
	$('#new_faculty').click(function(){
		uni_modal('New Teacher','admin/new_faculty.php','mid-large')
		
		// Clear form after modal loads
		$('#uni_modal').on('shown.bs.modal', function () {
			setTimeout(function(){
				$('#manage_faculty')[0].reset();
				$('#manage_faculty input[type="text"]').val('');
				$('#manage_faculty input[type="email"]').val('');
				$('#manage_faculty input[type="password"]').val('');
				$('#manage_faculty select').val('');
				$('#cimg').attr('src', '');
				$('#pass_match').html('').attr('data-status', '');
			}, 200);
		});
	})
	$('.view_faculty').click(function(){
		uni_modal("<i class='fa fa-id-card'></i> Faculty Details","admin/view_faculty.php?id="+$(this).attr('data-id'))
	})
	$('.delete_faculty').click(function(){
		_conf("Are you sure to delete this faculty?","delete_faculty",[$(this).attr('data-id')])
	})
	function delete_faculty($id){
		start_load()
		$.ajax({
			url:'ajax.php?action=delete_faculty',
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
<?php include 'admin_footer.php'; ?>
<style>
	.col-lg-12 {
		padding-top: 30px !important;
		margin-top: 25px !important;
	}
	.card-header {
		margin-bottom: 40px !important;
		padding-bottom: 25px !important;
		border-bottom: 3px solid #007bff;
	}
</style>