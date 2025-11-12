<?php include'db_connect.php' ?>
<div class="col-lg-12">
	<div class="card card-outline card-success">
		<div class="card-header">
			<h4 class="card-title"><B>Section List</B></h4>
		</div>
		<div class="card-body">
			<!-- Grade Filter Buttons -->
			<div class="grade-filter-section">
				<h6 class="mb-3"><i class="fas fa-filter"></i> Filter by Grade Level:</h6>
				<button class="btn btn-outline-primary btn-sm grade-filter-btn active" data-grade="all">
					<i class="fas fa-list"></i> All Sections
				</button>
				<?php
				// Get unique grade levels from database
				$grade_qry = $conn->query("SELECT DISTINCT level FROM class_list ORDER BY CAST(level AS UNSIGNED) ASC");
				while($grade_row = $grade_qry->fetch_assoc()):
				?>
				<button class="btn btn-outline-primary btn-sm grade-filter-btn" data-grade="<?php echo $grade_row['level'] ?>">
					<i class="fas fa-graduation-cap"></i> Grade <?php echo $grade_row['level'] ?> sections
				</button>
				<?php endwhile; ?>
			</div>
			
			<!-- SHS Strand Filter Buttons -->
			<div class="strand-filter-section mb-3" style="padding: 15px; background: linear-gradient(135deg, #f8f9fa, #e9ecef); border-radius: 8px; border: 1px solid #dee2e6;">
				<h6 class="mb-3"><i class="fas fa-tags"></i> Filter by SHS Strand/Track:</h6>
				<button class="btn btn-outline-success btn-sm strand-filter-btn active" data-strand="all" style="margin-right: 8px; margin-bottom: 5px;">
					<i class="fas fa-globe"></i> All Strands
				</button>
				<button class="btn btn-outline-success btn-sm strand-filter-btn" data-strand="STEM" style="margin-right: 8px; margin-bottom: 5px;">
					<i class="fas fa-flask"></i> STEM
				</button>
				<button class="btn btn-outline-success btn-sm strand-filter-btn" data-strand="ABM" style="margin-right: 8px; margin-bottom: 5px;">
					<i class="fas fa-chart-line"></i> ABM
				</button>
				<button class="btn btn-outline-success btn-sm strand-filter-btn" data-strand="HUMSS" style="margin-right: 8px; margin-bottom: 5px;">
					<i class="fas fa-users"></i> HUMSS
				</button>
				<button class="btn btn-outline-success btn-sm strand-filter-btn" data-strand="GAS" style="margin-right: 8px; margin-bottom: 5px;">
					<i class="fas fa-book"></i> GAS
				</button>
				<button class="btn btn-outline-success btn-sm strand-filter-btn" data-strand="TVL-COOKERY" style="margin-right: 8px; margin-bottom: 5px;">
					<i class="fas fa-utensils"></i> TVL-Cookery
				</button>
				<button class="btn btn-outline-success btn-sm strand-filter-btn" data-strand="TVL-SMAW" style="margin-right: 8px; margin-bottom: 5px;">
					<i class="fas fa-fire"></i> TVL-SMAW
				</button>
				<button class="btn btn-outline-success btn-sm strand-filter-btn" data-strand="TVL-COMPROG" style="margin-right: 8px; margin-bottom: 5px;">
					<i class="fas fa-code"></i> TVL-CompProg
				</button>
				<button class="btn btn-outline-success btn-sm strand-filter-btn" data-strand="TVL" style="margin-right: 8px; margin-bottom: 5px;">
					<i class="fas fa-tools"></i> All TVL
				</button>
			</div>

			<!-- Add New buttons positioned above the table -->
			<div class="mb-3 d-flex justify-content-between add-new-section">
				<div>
					<a class="btn btn-primary btn-sm" href="javascript:void(0)" id="new_class" style="border:1.5px solid #007bff !important;">
						<i class="fa fa-plus"></i> Add JHS Section (Grade 7-10)
					</a>
				</div>
				<div>
					<button class="btn btn-success btn-sm" id="add_shs_section" style="border:1.5px solid #28a745 !important; background: linear-gradient(135deg, #28a745, #20c997) !important; color: white !important; font-weight: 600;">
						<i class="fas fa-graduation-cap"></i> Add SHS Section (Grade 11/12)
					</button>
				</div>
			</div>
			
			<div class="table-responsive">
				<table class="table table-hover table-bordered" id="list">
				<colgroup>
					<col width="5%">
					<col width="60%">
				</colgroup>
				<thead>
					<tr>
						<th class="text-center">#</th>
						<th>Section</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$i = 1;
					$qry = $conn->query("SELECT *,concat(curriculum,' ',level,'-',section) as `class` FROM class_list order by class asc ");
					while($row= $qry->fetch_assoc()):
					?>
					<tr data-grade="<?php echo $row['level'] ?>">
						<th class="text-center"><?php echo $i++ ?></th>
						<td><b><?php echo $row['class'] ?></b></td>
						<td class="text-center">
		                    <div class="btn-group">
		                        <a href="javascript:void(0)" data-id='<?php echo $row['id'] ?>' class="btn btn-primary btn-flat manage_class">
		                          <i class="fas fa-edit"></i>
		                        </a>
		                        <button type="button" class="btn btn-danger btn-flat delete_class" data-id="<?php echo $row['id'] ?>">
		                          <i class="fas fa-trash"></i>
		                        </button>
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
<script>
	$(document).ready(function(){
		var table = $('#list').DataTable();
		$('.dataTables_filter input').attr('style', 'border: 2px solid #007bff !important; border-radius: 4px; padding: 4px 8px; outline: none;')
		
		$('#new_class').click(function(){
			uni_modal("New JHS Section","<?php echo $_SESSION['login_view_folder'] ?>manage_class.php")
		})

		// SHS Section button
		$('#add_shs_section').click(function(){
			uni_modal("New SHS Section","<?php echo $_SESSION['login_view_folder'] ?>manage_shs_class.php")
		})
		$(document).on('click', '.manage_class', function(){
			uni_modal("Manage Class","<?php echo $_SESSION['login_view_folder'] ?>manage_class.php?id="+$(this).data('id'))
		})
		$(document).on('click', '.delete_class', function(){
			_conf("Are you sure to delete this class?","delete_class",[$(this).data('id')])
		})

		// Grade filter functionality
		$('.grade-filter-btn').click(function(){
			var selectedGrade = $(this).data('grade');
			
			// Update active button
			$('.grade-filter-btn').removeClass('active');
			$(this).addClass('active');
			
			// Clear any existing search
			$.fn.dataTable.ext.search = [];
			
			// Filter using DataTable API
			if(selectedGrade === 'all') {
				table.search('').draw();
			} else {
				// Add custom search function for grade filtering
				$.fn.dataTable.ext.search.push(
					function(settings, data, dataIndex) {
						var row = table.row(dataIndex).node();
						var rowGrade = $(row).data('grade');
						return rowGrade == selectedGrade;
					}
				);
				table.draw();
			}
		});

		// Strand filter functionality
		$('.strand-filter-btn').click(function(){
			var selectedStrand = $(this).data('strand');
			
			// Update active button
			$('.strand-filter-btn').removeClass('active');
			$(this).addClass('active');
			
			// Clear any existing search
			$.fn.dataTable.ext.search = [];
			
			// Filter using DataTable API
			if(selectedStrand === 'all') {
				table.search('').draw();
			} else {
				// Add custom search function for strand filtering
				$.fn.dataTable.ext.search.push(
					function(settings, data, dataIndex) {
						var sectionName = data[1]; // Section column
						// Check if section name contains the strand
						return sectionName.toUpperCase().includes(selectedStrand.toUpperCase());
					}
				);
				table.draw();
			}
		});
	})
	function delete_class($id){
		start_load()
		$.ajax({
			url:'ajax.php?action=delete_class',
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
	
	/* Grade Filter Buttons */
	.grade-filter-section {
		margin-bottom: 20px !important;
		padding: 15px;
		background-color: #f8f9fa;
		border-radius: 8px;
		border: 1px solid #dee2e6;
	}
	
	/* Strand Filter Buttons */
	.strand-filter-btn {
		margin-right: 8px;
		margin-bottom: 5px;
		border: 1.5px solid #28a745 !important;
		transition: all 0.3s ease;
		color: #28a745;
		font-size: 0.85rem;
	}
	
	.strand-filter-btn.active {
		background-color: #28a745 !important;
		color: white !important;
		border-color: #1e7e34 !important;
	}
	
	.strand-filter-btn:hover {
		background-color: #1e7e34 !important;
		color: white !important;
		border-color: #155724 !important;
	}
	
	/* SHS Section Button Styling */
	#add_shs_section:hover {
		background: linear-gradient(135deg, #1e7e34, #17a2b8) !important;
		transform: translateY(-1px);
		box-shadow: 0 4px 8px rgba(0,0,0,0.2);
	}

	.grade-filter-btn {
		margin-right: 10px;
		margin-bottom: 5px;
		border: 1.5px solid #007bff !important;
		transition: all 0.3s ease;
	}
	
	.grade-filter-btn.active {
		background-color: #007bff !important;
		color: white !important;
		border-color: #0056b3 !important;
	}
	
	.grade-filter-btn:hover {
		background-color: #0056b3 !important;
		color: white !important;
		border-color: #004085 !important;
	}
	
	/* Add New button spacing */
	.add-new-section {
		margin-bottom: 30px !important;
		padding-bottom: 15px;
		border-bottom: 1px solid #dee2e6;
	}
</style>