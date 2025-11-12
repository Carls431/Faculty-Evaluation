<?php include'db_connect.php' ?>
<style>
	.new_subject {
		border-color: #800000 !important;
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
		border-bottom: 3px solid #800000;
		background: linear-gradient(135deg, #800000, #a52a2a, #8b0000);
		color: white;
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
		border: 1.5px solid #800000 !important;
		transition: all 0.3s ease;
		color: #800000;
	}
	
	.grade-filter-btn.active {
		background-color: #800000 !important;
		color: white !important;
		border-color: #600000 !important;
	}
	
	.grade-filter-btn:hover {
		background-color: #600000 !important;
		color: white !important;
		border-color: #400000 !important;
	}

	/* Strand Filter Buttons */
	.strand-filter-section {
		margin-bottom: 20px !important;
		padding: 15px;
		background: linear-gradient(135deg, #f8f9fa, #e9ecef);
		border-radius: 8px;
		border: 1px solid #dee2e6;
	}
	
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
	
	/* Responsive Table Enhancements */
	.table-responsive {
		border-radius: 8px;
		box-shadow: 0 2px 8px rgba(0,0,0,0.1);
	}
	
	#list {
		font-size: 0.9rem;
	}
	
	/* SHS Badge Styling */
	.shs-badge {
		background: linear-gradient(135deg, #800000, #a52a2a);
		color: white;
		padding: 2px 8px;
		border-radius: 12px;
		font-size: 0.75rem;
		font-weight: bold;
	}
	
	.strand-badge {
		background: linear-gradient(135deg, #28a745, #20c997);
		color: white;
		padding: 2px 6px;
		border-radius: 8px;
		font-size: 0.7rem;
		margin-left: 5px;
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
		
		.grade-filter-btn, .strand-filter-btn {
			font-size: 0.75rem;
			padding: 4px 8px;
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
			<h4 class="card-title"><i class="fas fa-graduation-cap"></i> <B>Senior High School (SHS) Subject List</B></h4>
		</div>
		<div class="card-body">
			<!-- Grade Filter Buttons -->
			<div class="grade-filter-section">
				<h6 class="mb-3"><i class="fas fa-filter"></i> Filter by Grade Level:</h6>
				<button class="btn btn-outline-primary btn-sm grade-filter-btn active" data-grade="all">
					<i class="fas fa-list"></i> All SHS Subjects
				</button>
				<button class="btn btn-outline-primary btn-sm grade-filter-btn" data-grade="11">
					<i class="fas fa-graduation-cap"></i> Grade 11 Subjects
				</button>
				<button class="btn btn-outline-primary btn-sm grade-filter-btn" data-grade="12">
					<i class="fas fa-graduation-cap"></i> Grade 12 Subjects
				</button>
			</div>

			<!-- Strand Filter Buttons -->
			<div class="strand-filter-section">
				<h6 class="mb-3"><i class="fas fa-tags"></i> Filter by Strand/Track:</h6>
				<button class="btn btn-outline-success btn-sm strand-filter-btn active" data-strand="all">
					<i class="fas fa-globe"></i> All Strands
				</button>
				<button class="btn btn-outline-success btn-sm strand-filter-btn" data-strand="STEM">
					<i class="fas fa-flask"></i> STEM
				</button>
				<button class="btn btn-outline-success btn-sm strand-filter-btn" data-strand="ABM">
					<i class="fas fa-chart-line"></i> ABM
				</button>
				<button class="btn btn-outline-success btn-sm strand-filter-btn" data-strand="HUMSS">
					<i class="fas fa-users"></i> HUMSS
				</button>
				<button class="btn btn-outline-success btn-sm strand-filter-btn" data-strand="GAS">
					<i class="fas fa-book"></i> GAS
				</button>
				<button class="btn btn-outline-success btn-sm strand-filter-btn" data-strand="TVL">
					<i class="fas fa-tools"></i> TVL
				</button>
				<button class="btn btn-outline-success btn-sm strand-filter-btn" data-strand="CORE">
					<i class="fas fa-star"></i> Core Subjects
				</button>
			</div>
			
			<!-- Add New button positioned above the table -->
			<div class="mb-3 d-flex justify-content-between add-new-section">
				<div>
					<a class="btn btn-success btn-sm" href="javascript:void(0)" id="bulk_import_shs">
						<i class="fa fa-upload"></i> Bulk Import SHS Subjects
					</a>
				</div>
				<div>
					<a class="btn btn-primary btn-sm new_subject" href="javascript:void(0)" style="border:1.5px solid #800000 !important; background-color: #800000;">
						<i class="fa fa-plus"></i> Add New SHS Subject
					</a>
				</div>
			</div>
			
			<div class="table-responsive table-section">
				<table class="table table-hover table-bordered" id="list">
					<thead>
						<tr>
							<th class="text-center">#</th>
							<th>Subject Code</th>
							<th>Subject Name</th>
							<th>Grade Level</th>
							<th>Strand</th>
							<th>Topics/Description</th>
							<th class="text-center">Action</th>
						</tr>
					</thead>
					<tbody>
						<?php
						$i = 1;
						// Query for SHS subjects (Grade 11 and 12)
						$qry = $conn->query("SELECT * FROM subject_list WHERE (code LIKE '%-11%' OR code LIKE '%-12%' OR code LIKE '%G11%' OR code LIKE '%G12%' OR code LIKE '%GRADE-11%' OR code LIKE '%GRADE-12%') ORDER BY subject ASC");
						while($row= $qry->fetch_assoc()):
							// Extract grade level from code
							$grade_level = '';
							$strand = '';
							if (preg_match('/-(11|12)/', $row['code'], $matches)) {
								$grade_level = $matches[1];
							} elseif (preg_match('/G(11|12)/', $row['code'], $matches)) {
								$grade_level = $matches[1];
							} elseif (preg_match('/GRADE-(11|12)/', $row['code'], $matches)) {
								$grade_level = $matches[1];
							}
							
							// Extract strand from code
							if (strpos($row['code'], 'STEM') !== false) $strand = 'STEM';
							elseif (strpos($row['code'], 'ABM') !== false) $strand = 'ABM';
							elseif (strpos($row['code'], 'HUMSS') !== false) $strand = 'HUMSS';
							elseif (strpos($row['code'], 'GAS') !== false) $strand = 'GAS';
							elseif (strpos($row['code'], 'TVL') !== false) $strand = 'TVL';
							elseif (strpos($row['code'], 'CORE') !== false) $strand = 'CORE';
							else $strand = 'CORE'; // Default to core if no strand specified
						?>
						<tr data-grade="<?php echo $grade_level ?>" data-strand="<?php echo $strand ?>">
							<td class="text-center" data-label="#"><?php echo $i++ ?></td>
							<td data-label="Subject Code"><b><?php echo $row['code'] ?></b></td>
							<td data-label="Subject Name">
								<b><?php echo $row['subject'] ?></b>
								<span class="shs-badge">SHS</span>
							</td>
							<td data-label="Grade Level">
								<span class="badge badge-primary">Grade <?php echo $grade_level ? $grade_level : 'N/A' ?></span>
							</td>
							<td data-label="Strand">
								<span class="strand-badge"><?php echo $strand ?></span>
							</td>
							<td data-label="Topics/Description"><?php echo $row['description'] ?></td>
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
          'border: 2px solid #800000 !important; border-radius: 4px; padding: 4px 8px; outline: none;');
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
        $('tr[data-grade]').show();
      } else {
        // Hide all rows first
        $('tr[data-grade]').hide();
        // Show only matching grade rows
        $('tr[data-grade="' + selectedGrade + '"]').show();
      }
      
      // Apply current strand filter as well
      var selectedStrand = $('.strand-filter-btn.active').data('strand');
      if (selectedStrand !== 'all') {
        applyStrandFilter(selectedStrand);
      }
    });

    // Strand Filter Functionality
    $('.strand-filter-btn').click(function() {
      // Remove active class from all buttons
      $('.strand-filter-btn').removeClass('active');
      // Add active class to clicked button
      $(this).addClass('active');
      
      var selectedStrand = $(this).data('strand');
      applyStrandFilter(selectedStrand);
    });

    function applyStrandFilter(selectedStrand) {
      if (selectedStrand === 'all') {
        // Show all visible rows (based on grade filter)
        var selectedGrade = $('.grade-filter-btn.active').data('grade');
        if (selectedGrade === 'all') {
          $('tr[data-strand]').show();
        } else {
          $('tr[data-grade="' + selectedGrade + '"]').show();
        }
      } else {
        // Hide all rows first
        $('tr[data-strand]').hide();
        // Show only matching strand rows
        $('tr[data-strand="' + selectedStrand + '"]').show();
        
        // Apply grade filter as well
        var selectedGrade = $('.grade-filter-btn.active').data('grade');
        if (selectedGrade !== 'all') {
          $('tr[data-strand="' + selectedStrand + '"]').each(function() {
            if ($(this).data('grade') != selectedGrade) {
              $(this).hide();
            }
          });
        }
      }
    }

    // Other existing code
    $('.new_subject').click(function(){
      uni_modal("New SHS Subject","<?php echo $_SESSION['login_view_folder'] ?>manage_shs_subject.php")
    });

    // Bulk Import functionality
    $('#bulk_import_shs').click(function(){
      uni_modal("Bulk Import SHS Subjects","<?php echo $_SESSION['login_view_folder'] ?>bulk_import_shs.php", "large")
    });

    // Use event delegation for dynamically created elements
    $(document).on('click', '.manage_subject', function(){
      uni_modal("Manage SHS Subject","<?php echo $_SESSION['login_view_folder'] ?>manage_shs_subject.php?id="+$(this).attr('data-id'))
    });

    $(document).on('click', '.delete_subject', function(){
      _conf("Are you sure to delete this SHS subject?","delete_subject",[$(this).attr('data-id')])
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
