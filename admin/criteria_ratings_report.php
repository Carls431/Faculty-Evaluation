<?php include 'db_connect.php' ?>
<?php include 'admin_history_logger.php' ?>
<?php
$faculty_id = isset($_GET['fid']) ? $_GET['fid'] : '';
$subject_id = isset($_GET['sid']) ? $_GET['sid'] : '';
$class_id = isset($_GET['cid']) ? $_GET['cid'] : '';

function ordinal_suffix($num){
    $num = $num % 100; // protect against large numbers
    if($num < 11 || $num > 13){
         switch($num % 10){
            case 1: return $num.'st';
            case 2: return $num.'nd';
            case 3: return $num.'rd';
        }
    }
    return $num.'th';
}

if(isset($_GET['fid'])){
    // Log report access
    $faculty_qry = $conn->query("SELECT CONCAT(firstname, ' ', lastname) as name FROM faculty_list WHERE id = $faculty_id");
    $faculty_name = $faculty_qry->num_rows > 0 ? $faculty_qry->fetch_assoc()['name'] : 'Unknown Faculty';
    
    if (isset($historyLogger)) {
        $historyLogger->logReportAccess('Criteria Ratings Report', $faculty_id, "Teacher: $faculty_name");
    }
}
?>
<div class="col-lg-12">
	<div class="callout callout-info">
		<div class="d-flex w-100 justify-content-center align-items-center">
			<label for="faculty">Select Faculty</label>
			<div class=" mx-2 col-md-4">
			<select name="" id="faculty_id" class="form-control form-control-sm select2">
				<option value=""></option>
				<?php 
				$faculty = $conn->query("SELECT *,concat(firstname,' ',lastname) as name FROM faculty_list order by concat(firstname,' ',lastname) asc");
				$f_arr = array();
				$fname = array();
				while($row=$faculty->fetch_assoc()):
					$f_arr[$row['id']]= $row;
					$fname[$row['id']]= ucwords($row['name']);
				?>
				<option value="<?php echo $row['id'] ?>" <?php echo isset($faculty_id) && $faculty_id == $row['id'] ? "selected" : "" ?>><?php echo ucwords($row['name']) ?></option>
				<?php endwhile; ?>
			</select>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12 mb-1">
			<div class="d-flex justify-content-end w-100">
				<button class="btn btn-sm btn-success bg-gradient-success" style="display:none" id="print-btn"><i class="fa fa-print"></i> Print</button>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-3">
			<div class="callout callout-info">
				<div class="list-group" id="class-list">
					
				</div>
			</div>
		</div>
		<div class="col-md-9">
			<div class="callout callout-info" id="printable">
			<div>
			<div class="text-center mb-4" style="border-bottom: 3px solid #000; padding-bottom: 15px;">
				<div style="display: flex; align-items: center; justify-content: center; margin-bottom: 10px;">
					<div style="width: 80px; height: 80px; margin-right: 20px;">
						<img src="../assets/img/logo.png" alt="School Logo" style="width: 80px; height: 80px; object-fit: contain;">
					</div>
					<div style="text-align: center;">
						<h4 style="margin: 0; font-weight: bold; font-size: 16px;">MISAMIS ORIENTAL INSTITUTE OF SCIENCE AND TECHNOLOGY</h4>
						<p style="margin: 5px 0; font-size: 12px; font-style: italic;">Sta. Cruz Cogon Balingasag Misamis Oriental</p>
						<p style="margin: 5px 0 0 0; font-size: 10px; line-height: 1.3;">
							Website: www.moist.ph | Email: reynaldo.valmores@gmail.com FB: www.facebook.com/moist.edu | Contact #: 09173172641
						</p>
					</div>
				</div>
			</div>
			<div class="text-center">
				<h3 style="margin: 5px 0; font-weight: bold; font-size: 18px;">CRITERIA RATINGS REPORT</h3>
				<p style="margin: 0; font-size: 14px;">S.Y. <?php echo $_SESSION['academic']['year'].'-'.(intval($_SESSION['academic']['year'])+1) ?></p>
			</div>
			<table width="100%">
					<tr>
						<td width="50%"><p><b>Teacher: <span id="fname"></span></b></p></td>
						<td width="50%"><p><b>Academic Year: <span id="ay"><?php echo $_SESSION['academic']['year'].' '.(ordinal_suffix($_SESSION['academic']['quarter'])) ?> Quarter</span></b></p></td>
					</tr>
					<tr>
						<td width="50%"><p><b>Class: <span id="classField"></span></b></p></td>
						<td width="50%"><p><b>Subject: <span id="subjectField"></span></b></p></td>
					</tr>
					<tr>
						<td width="50%"><p><b>Total Students Evaluated: <span id="tse"></span></b></p></td>
						<td width="50%"></td>
					</tr>
			</table>
			</div>
				<fieldset class="border border-info p-2 w-100">
				   <legend class="w-auto">Rating Legend</legend>
                   <p>5 = Strongly Agree, 4 = Agree, 3 = Uncertain, 2 = Disagree, 1 = Strongly Disagree</p>
                   <div class="rating-scale mt-2">
                       <p class="mb-1"><strong>Descriptive Rating Scale:</strong></p>
                       <ul class="list-unstyled small">
                           <li>4.50 – 5.00: Outstanding (O)</li>
                           <li>4.00 – 4.49: Very Satisfactory (VS)</li>
                           <li>3.50 – 3.99: Satisfactory (S)</li>
                           <li>3.00 – 3.49: Fair (F)</li>
                           <li>Below 3.00: Needs Improvement (NI)</li>
                       </ul>
                   </div>
                </fieldset>

				<!-- Criteria Ratings Table -->
				<table class="table table-bordered" id="criteria-ratings-table">
					<thead>
						<tr class="bg-gradient-secondary">
							<th width="10%" class="text-center">Student ID</th>
							<th width="20%" class="text-center">Student Name</th>
							<?php 
							$criteria = $conn->query("SELECT * FROM criteria_list where id in (SELECT criteria_id FROM question_list where academic_id = {$_SESSION['academic']['id']} ) order by abs(order_by) asc ");
							while($crow = $criteria->fetch_assoc()):
							?>
							<th width="15%" class="text-center"><?php echo $crow['criteria'] ?> (<?php 
								switch($crow['id']) {
									case 1: echo "50%"; break;
									case 2: echo "30%"; break;
									case 3: case 4: echo "20%"; break;
								}
								?>)</th>
							<?php endwhile; ?>
							<th width="10%" class="text-center">Overall</th>
						</tr>
					</thead>
					<tbody>
						<!-- Data will be loaded via AJAX -->
					</tbody>
				</table>

				<!-- Overall Class Rating Section -->
				<div id="overall-rating-section" class="mt-4">
					<div class="text-center mb-3">
						<p style="margin-bottom: 5px;"><b>Class Average Rating: <span id="class-average" class="font-weight-bold">-</span></b></p>
						<p><b>Descriptive Rating: <span id="descriptive-rating" class="font-weight-bold">-</span></b></p>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<script>
$(document).ready(function(){
	$('#faculty_id').change(function(){
		var faculty_id = $(this).val();
		if(faculty_id <= 0)
			return false;
		window.location.href = "./index.php?page=criteria_ratings_report&fid="+faculty_id;
	})
	
	if('<?php echo isset($_GET['fid']) ?>' == 1){
		load_class();
	}
})

function load_class(){
	start_load()
	$.ajax({
		url:"ajax.php?action=get_class",
		method:'POST',
		data:{fid:<?php echo $faculty_id ?>},
		success:function(resp){
			if(resp){
				resp = JSON.parse(resp)
				if(Object.keys(resp).length > 0){
					$('#class-list').html('')
					Object.keys(resp).map(k=>{
						var li = $('<a href="javascript:void(0)" class="list-group-item list-group-item-action">'+(resp[k].class)+'</a>')
						li.attr('data-json',JSON.stringify(resp[k]))
						$('#class-list').append(li)
					})
					$('#fname').text("<?php echo isset($faculty_id) ? $fname[$faculty_id] : '' ?>")
				}
			}
		},
		complete:function(){
			end_load();
			$('#class-list a').click(function(){
				var data = $(this).attr('data-json')
				data = JSON.parse(data)
				$('#class-list a.active').removeClass('active')
				$(this).addClass('active')
				$('#classField').text(data.class)
				$('#subjectField').text(data.subj)
				load_criteria_ratings(data.id,data.sid);
			})
		}
	})
}

function load_criteria_ratings(class_id, subject_id){
	start_load();
	$.ajax({
		url:"ajax.php?action=get_criteria_ratings",
		method:"POST",
		data:{faculty_id:<?php echo $faculty_id ?>, class_id: class_id, subject_id: subject_id},
		success:function(resp){
			if(resp){
				resp = JSON.parse(resp);
				if(Object.keys(resp).length > 0){
					$('#tse').text(resp.total_students);
					$('#criteria-ratings-table tbody').html('');
					
					// Add student rows
					if(resp.students.length > 0){
						resp.students.forEach(function(student){
							var row = $('<tr>');
							row.append('<td class="text-center">' + student.student_id + '</td>');
							row.append('<td>' + student.name + '</td>');
							
							// Add criteria ratings
							Object.keys(student.criteria_ratings).forEach(function(criteria_id){
								var rating = student.criteria_ratings[criteria_id];
								var cell = $('<td class="text-center">');
								cell.text(parseFloat(rating).toFixed(2));
								row.append(cell);
							});
							
							// Add overall rating
							row.append('<td class="text-center font-weight-bold">' + parseFloat(student.overall_rating).toFixed(2) + '</td>');
							
							$('#criteria-ratings-table tbody').append(row);
						});
						
						// Add class average row
						var avgRow = $('<tr class="bg-light">');
						avgRow.append('<td class="text-center font-weight-bold" colspan="2">Class Average</td>');
						
						// Add criteria averages
						Object.keys(resp.criteria_averages).forEach(function(criteria_id){
							var avg = resp.criteria_averages[criteria_id];
							var cell = $('<td class="text-center font-weight-bold">');
							cell.text(parseFloat(avg).toFixed(2));
							avgRow.append(cell);
						});
						
						// Add overall class average
						avgRow.append('<td class="text-center font-weight-bold">' + parseFloat(resp.class_average).toFixed(2) + '</td>');
						
						$('#criteria-ratings-table tbody').append(avgRow);
						
						// Update overall section
						$('#class-average').text(parseFloat(resp.class_average).toFixed(2));
						$('#descriptive-rating').text(getDescriptiveRating(resp.class_average));
						
						// Show print button
						$('#print-btn').show();
					} else {
						$('#criteria-ratings-table tbody').html('<tr><td colspan="' + (Object.keys(resp.criteria_averages).length + 3) + '" class="text-center">No evaluation data available</td></tr>');
						$('#print-btn').hide();
					}
				}
			}
		},
		complete:function(){
			end_load();
		}
	});
}

function getDescriptiveRating(rating) {
	rating = parseFloat(rating);
	if (rating >= 4.5) return "Outstanding (O)";
	if (rating >= 4.0) return "Very Satisfactory (VS)";
	if (rating >= 3.5) return "Satisfactory (S)";
	if (rating >= 3.0) return "Fair (F)";
	return "Needs Improvement (NI)";
}

$('#print-btn').click(function(){
	start_load()
	var ns = $('noscript').clone();
	var content = $('#printable').clone()
	ns.append(content)
	var nw = window.open('','','height=700,width=900')
	nw.document.write('<html><head><title>Criteria Ratings Report</title>')
	nw.document.write('<link rel="stylesheet" href="assets/vendor/bootstrap/css/bootstrap.min.css">')
	nw.document.write('<style>@media print { .btn-print { display: none } } #print-btn{ display:none;}</style>')
	nw.document.write('</head><body id="print">')
	nw.document.write(ns.html())
	nw.document.write('<br>')
	nw.document.write('<div class="text-center"><button class="btn btn-primary btn-print" onclick="window.print()"><i class="fa fa-print"></i> Print</button></div>')
	nw.document.write('</body></html>')
	nw.document.close()
	nw.focus()
	end_load()
	
	// Log print action
	$.ajax({
		url: "ajax.php?action=log_report_print",
		method: "POST",
		data: {
			report_type: "Criteria Ratings Report - Printed",
			faculty_id: <?php echo isset($faculty_id) ? $faculty_id : 0 ?>,
			details: "Printed report for Teacher: " + $("#fname").text() + " - ID: " + <?php echo isset($faculty_id) ? $faculty_id : 0 ?>
		}
	});
})
</script>