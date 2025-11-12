<?php include'db_connect.php' ?>
<style>
	.new_subject {
		border-color: #007bff !important;
	}
	.col-lg-12 {
		padding-top: 30px !important;
		margin-top: 25px !important;
	}
	.card-body {
		padding-top: 20px !important;
	}
	.card-header {
		margin-bottom: 40px !important;
		padding-bottom: 25px !important;
		border-bottom: 3px solid #007bff;
	}
	
	/* Better spacing between header and table */
	.table-section {
		margin-top: 10px !important;
		padding-top: 10px !important;
		background-color: #f8f9fa;
		border-radius: 8px;
		padding: 10px;
	}
	
	/* Add New button spacing */
	.add-new-section {
		margin-bottom: 30px !important;
		padding-bottom: 15px;
		border-bottom: 1px solid #dee2e6;
	}
	
	/* SHS Button Styling */
	#add_shs_subject {
		background: linear-gradient(135deg, #28a745, #20c997) !important;
		color: white !important;
		font-weight: 600;
		transition: all 0.3s ease;
	}
	
	#add_shs_subject:hover {
		background: linear-gradient(135deg, #1e7e34, #17a2b8) !important;
		transform: translateY(-1px);
		box-shadow: 0 4px 8px rgba(0,0,0,0.2);
	}
	
	/* Grade Filter Buttons */
	.grade-filter-section {
		margin-bottom: 20px !important;
		padding: 15px;
		background-color: #f8f9fa;
		border-radius: 8px;
		border: 1px solid #dee2e6;
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
	
	/* Responsive Table Enhancements */
	.table-responsive {
		border-radius: 8px;
		box-shadow: 0 2px 8px rgba(0,0,0,0.1);
	}
	
	#list {
		font-size: 0.9rem;
	}
	
	/* Mobile Responsive */
	@media (max-width: 768px) {
		.card-body {
			padding: 15px !important;
			margin-top: 10px !important;
		}
		
		#list {
			font-size: 0.8rem;
		}
		
		#list th, #list td {
			padding: 8px 4px !important;
			vertical-align: middle;
		}
		
		/* Hide less important columns on mobile */
		#list th:nth-child(1), 
		#list td:nth-child(1) {
			display: none;
		}
		
		/* Make action buttons smaller */
		.btn-group .btn {
			padding: 4px 8px;
			font-size: 0.75rem;
		}
		
		/* Wrap long text */
		#list td {
			word-wrap: break-word;
			max-width: 150px;
		}
	}
	
	@media (max-width: 576px) {
		/* Stack table content vertically on very small screens */
		.table-responsive {
			border: 0;
		}
		
		#list thead {
			display: none;
		}
		
		#list, #list tbody, #list tr, #list td {
			display: block;
			width: 100%;
		}
		
		#list tr {
			border: 1px solid #ccc;
			margin-bottom: 10px;
			padding: 10px;
			border-radius: 8px;
			background: #f8f9fa;
		}
		
		#list td {
			border: none;
			position: relative;
			padding-left: 50% !important;
			text-align: left !important;
		}
		
		#list td:before {
			content: attr(data-label) ": ";
			position: absolute;
			left: 6px;
			width: 45%;
			text-align: left;
			font-weight: bold;
			color: #495057;
		}
	}
</style>
<div class="col-lg-12">
	<div class="card card-outline card-success">
		<div class="card-header">
			<h4 class="card-title"><B>Subject List</B></h4>
		</div>
		<div class="card-body">
			<!-- Grade Filter Buttons -->
			<div class="grade-filter-section">
				<h6 class="mb-3"><i class="fas fa-filter"></i> Filter by Subject Level:</h6>
				<button class="btn btn-outline-primary btn-sm grade-filter-btn active" data-grade="all">
					<i class="fas fa-list"></i> All Subjects
				</button>
				<button class="btn btn-outline-primary btn-sm grade-filter-btn" data-grade="7">
					<i class="fas fa-graduation-cap"></i> Grade 7 subjects
				</button>
				<button class="btn btn-outline-primary btn-sm grade-filter-btn" data-grade="8">
					<i class="fas fa-graduation-cap"></i> Grade 8 subjects
				</button>
				<button class="btn btn-outline-primary btn-sm grade-filter-btn" data-grade="9">
					<i class="fas fa-graduation-cap"></i> Grade 9 subjects
				</button>
				<button class="btn btn-outline-primary btn-sm grade-filter-btn" data-grade="10">
					<i class="fas fa-graduation-cap"></i> Grade 10 subjects
				</button>
				<button class="btn btn-outline-success btn-sm grade-filter-btn" data-grade="11">
					<i class="fas fa-graduation-cap"></i> Grade 11 subjects (SHS)
				</button>
				<button class="btn btn-outline-success btn-sm grade-filter-btn" data-grade="12">
					<i class="fas fa-graduation-cap"></i> Grade 12 subjects (SHS)
				</button>
			</div>
			
			<!-- Add New buttons positioned above the table -->
			<div class="mb-3 d-flex justify-content-between add-new-section">
				<div>
					<a class="btn btn-primary btn-sm new_subject" href="javascript:void(0)" style="border:1.5px solid #007bff !important;">
						<i class="fa fa-plus"></i> Add JHS Subject (Grade 7-10)
					</a>
				</div>
				<div>
					<button class="btn btn-success btn-sm" id="add_shs_subject" style="border:1.5px solid #28a745 !important;">
						<i class="fas fa-graduation-cap"></i> Add SHS Subject (Grade 11/12)
					</button>
				</div>
			</div>
			
			<div class="table-responsive table-section">
				<table class="table table-hover table-bordered" id="list">
					<thead>
						<tr>
							<th class="text-center">#</th>
							<th>Code</th>
							<th>Subject</th>
							<th>Topics</th>
							<th class="text-center">Action</th>
						</tr>
					</thead>
					<tbody>
						<?php
						$i = 1;
						$qry = $conn->query("SELECT * FROM subject_list order by subject asc ");
						while($row= $qry->fetch_assoc()):
						?>
						<tr>
							<td class="text-center" data-label="#"><?php echo $i++ ?></td>
							<td data-label="Code"><b><?php echo $row['code'] ?></b></td>
							<td data-label="Subject"><b><?php echo $row['subject'] ?></b></td>
							<td data-label="Topics"><b><?php echo $row['description'] ?></b></td>
							<td class="text-center" data-label="Action">
			                    <div class="btn-group">
			                        <a href="javascript:void(0)" data-id='<?php echo $row['id'] ?>' class="btn btn-primary btn-flat manage_subject" title="Edit">
			                          <i class="fas fa-edit"></i>
			                        </a>
			                        <button type="button" class="btn btn-danger btn-flat delete_subject" data-id="<?php echo $row['id'] ?>" title="Delete">
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
  $(document).ready(function() {
    // Initialize DataTable
    var table = $('#list').DataTable({
      initComplete: function () {
        // Apply inline styles to the search input after table has fully loaded
        $('.dataTables_filter input[type="search"]').attr('style', 
          'border: 2px solid #007bff !important; border-radius: 4px; padding: 4px 8px; outline: none;');
      }
    });

    // Grade Filter Functionality
    $('.grade-filter-btn').click(function() {
      // Remove active class from all buttons
      $('.grade-filter-btn').removeClass('active');
      // Add active class to clicked button
      $(this).addClass('active');
      
      var selectedGrade = $(this).data('grade');
      
      if (selectedGrade === 'all') {
        // Show all rows
        table.column(1).search('').draw();
      } else {
        // Filter by grade - search for codes ending with the grade number
        // This will match patterns like "AP-7", "MATH-8", "ENG-9", "MATH-STEM-11", etc.
        if (selectedGrade == '11' || selectedGrade == '12') {
          // For SHS subjects, search for patterns like "MATH-STEM-11" or "ENG-CORE-12"
          table.column(1).search('-' + selectedGrade + '$', true, false).draw();
        } else {
          // For JHS subjects, search for patterns like "AP-7", "MATH-8", etc.
          table.column(1).search('-' + selectedGrade + '$', true, false).draw();
        }
      }
    });

    // Other existing code
    $('.new_subject').click(function(){
      uni_modal("New JHS Subject","<?php echo $_SESSION['login_view_folder'] ?>manage_subject.php")
    });

    // SHS Subject button
    $('#add_shs_subject').click(function(){
      uni_modal("New SHS Subject","<?php echo $_SESSION['login_view_folder'] ?>manage_shs_subject.php")
    });

    // Use event delegation for dynamically created elements
    $(document).on('click', '.manage_subject', function(){
      uni_modal("Manage subject","<?php echo $_SESSION['login_view_folder'] ?>manage_subject.php?id="+$(this).attr('data-id'))
    });

    $(document).on('click', '.delete_subject', function(){
      _conf("Are you sure to delete this subject?","delete_subject",[$(this).attr('data-id')])
    });
  });

  function delete_subject($id){
    start_load()
    $.ajax({
      url:'ajax.php?action=delete_subject',
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