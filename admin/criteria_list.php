<?php include'db_connect.php' ?>
<div class="col-lg-12">
	<div class="card card-outline card-primary">
		<div class="card-header">
			<h4 class="card-title"><B>Criteria List</B></h4>
		</div>
		<div class="card-body">
			<div class="container-fluid">
				<div class="row">
					<div class="col-md-4">
						<div class="card card-outline card-info">
							<div class="card-header">
								<div class="d-flex justify-content-between align-items-center">
									<b>Criteria Form</b>
									<button class="btn btn-sm btn-success btn-flat bg-gradient-success" id="add-new-criteria">
										<i class="fa fa-plus"></i> Add New Criteria
									</button>
								</div>
							</div>
							<div class="card-body">
								<form action="" id="manage-criteria">
									<input type="hidden" name="id">
									<div class="form-group">
										<label for="">Criteria</label>
										<input type="text" name="criteria" class="form-control form-control-sm" required>
									</div>
									<div class="form-group">
										<label for="">Weight (%)</label>
										<input type="number" step="0.01" min="0" max="100" name="weight" class="form-control form-control-sm" required>
										<small class="text-muted">Enter weight as percentage (e.g., 50 for 50%)</small>
									</div>
								</form>
							</div>
							<div class="card-footer">
								<div class="d-flex justify-content-end w-100">
									<button class="btn btn-sm btn-primary btn-flat bg-gradient-primary mx-1" form="manage-criteria">Save</button>
									<button class="btn btn-sm btn-flat btn-secondary bg-gradient-secondary mx-1" form="manage-criteria" type="reset">Cancel</button>
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-8">
						<div class="callout callout-info">
							<?php 
								$qry = $conn->query("SELECT id, criteria, COALESCE(weight, 0) as weight, order_by FROM criteria_list order by abs(order_by) asc ");
								if($qry->num_rows > 0):
							?>
							<div class="d-flex justify-content-between w-100">
								<label for=""><b>Criteria List</b></label>
									<button class="btn btn-sm btn-primary btn-flat bg-gradient-primary mx-1" form="order-criteria">Save Creteria</button>
							</div>
							<hr>
							<form action="" id="order-criteria">
							<ul class="list-group btn col-md-8" id="ui-sortable-list">
								<?php
								$criteria = array();
								while($row= $qry->fetch_assoc()):
									$criteria[$row['id']] = $row; 
								?>
								<li class="list-group-item text-left">
									<span class="btn-group dropright float-right">
									  <span type="button" class="btn" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
									   <i class="fa fa-ellipsis-v"></i>
									  </span>
									  <div class="dropdown-menu">
									     <a class="dropdown-item edit_criteria" href="javascript:void(0)" data-id="<?php echo $row['id'] ?>">Edit</a>
					                      <div class="dropdown-divider"></div>
					                     <a class="dropdown-item delete_criteria" href="javascript:void(0)" data-id="<?php echo $row['id'] ?>">Delete  </a>
									  </div>
									</span>
									<i class="fa fa-bars"></i> <?php echo ucwords($row['criteria']) ?> 
									<span class="badge badge-info"><?php echo $row['weight'] ?>%</span>
									<input type="hidden" name="criteria_id[]" value="<?php echo $row['id'] ?>">
								</li>
								<?php endwhile; ?>
							</form>
							</ul>
							</form>
							<?php else: ?>
								<center>There's no criteria in the database yet</center>
							<?php endif; ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<style>
	.dropright a:hover{
		color:black !important;
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
</style>
<script>
	$(document).ready(function(){
		$('#ui-sortable-list').sortable()
		
		// Add New Criteria button functionality
		$('#add-new-criteria').click(function(){
			$('#manage-criteria')[0].reset(); // Clear the form
			$('#manage-criteria').find("[name='id']").val(''); // Clear hidden ID field
			$('#manage-criteria').find("[name='criteria']").focus(); // Focus on criteria input
		})
		
		$('.edit_criteria').click(function(){
				var id = $(this).attr('data-id')
				var criteria = <?php echo json_encode($criteria) ?>;
				$('#manage-criteria').find("[name='id']").val(criteria[id].id)
				$('#manage-criteria').find("[name='criteria']").val(criteria[id].criteria)
				$('#manage-criteria').find("[name='weight']").val(criteria[id].weight || '')

		})
		$('#manage-criteria').on('reset',function(){
			$(this).find('input:hidden').val('')
		})
		$('.delete_criteria').click(function(){
		_conf("Are you sure to delete this criteria?","delete_criteria",[$(this).attr('data-id')])
		})
		$('.make_default').click(function(){
		_conf("Are you sure to make this criteria year as the system default?","make_default",[$(this).attr('data-id')])
		})

		$('#manage-criteria').submit(function(e){
			e.preventDefault();
			start_load()
			$('#msg').html('')
			$.ajax({
				url:'ajax.php?action=save_criteria',
				method:'POST',
				data:$(this).serialize(),
				success:function(resp){
					if(resp == 1){
						alert_toast("Data successfully saved.","success");
						setTimeout(function(){
							location.reload()	
						},1750)
					}else if(resp == 2){
						$('#msg').html('<div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> Criteria already exist.</div>')
						end_load()
					}
				}
			})
		})
		$('#order-criteria').submit(function(e){
			e.preventDefault();
			start_load()
			$.ajax({
				url:'ajax.php?action=save_criteria_order',
				method:'POST',
				data:$(this).serialize(),
				success:function(resp){
					if(resp == 1){
						alert_toast("Data successfully saved.","success");
						setTimeout(function(){
							location.reload()	
						},1750)
				}
				}
			})
		})

	})
	function delete_criteria($id){
		start_load()
		$.ajax({
			url:'ajax.php?action=delete_criteria',
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
	function make_default($id){
		start_load()
		$.ajax({
			url:'ajax.php?action=make_default',
			method:'POST',
			data:{id:$id},
			success:function(resp){
				if(resp==1){
					alert_toast("Dafaut criteria Year Updated",'success')
					setTimeout(function(){
						location.reload()
					},1500)
				}
			}
		})
	}
</script>
<?php include 'admin_footer.php'; ?>