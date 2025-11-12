<?php $faculty_id = isset($_GET['fid']) ? $_GET['fid'] : '' ; ?>
<?php 
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
?>
<?php include 'db_connect.php' ?>
<?php include 'admin_history_logger.php' ?>
<?php
if(isset($_GET['fid'])):
    // Log report access
    $faculty_id = $_GET['fid'];
    $faculty_qry = $conn->query("SELECT CONCAT(firstname, ' ', lastname) as name FROM faculty_list WHERE id = $faculty_id");
    $faculty_name = $faculty_qry->num_rows > 0 ? $faculty_qry->fetch_assoc()['name'] : 'Unknown Faculty';
    
    // Debug: Check if logger exists
    if (isset($historyLogger)) {
        $log_result = $historyLogger->logReportAccess('Teacher Evaluation Report', $faculty_id, "Teacher: $faculty_name");
        echo "<script>console.log('Report log result: " . ($log_result ? 'SUCCESS' : 'FAILED') . "');</script>";
    } else {
        echo "<script>console.log('ERROR: historyLogger not found!');</script>";
    }
endif;
?>
<h1>Teacher Evaluation Report</h1>
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
				<button class="btn btn-sm btn-success bg-gradient-success" style="display:none" id="print-options-btn" data-toggle="modal" data-target="#printModal"><i class="fa fa-print"></i> Print Report</button>
			</div>
		</div>
	</div>
	<!-- Enhanced Statistics Cards Row -->
	<div class="row mb-4 justify-content-center" id="stats-cards" style="<?php echo (isset($_GET['fid']) && !empty($_GET['fid'])) ? 'display: flex;' : 'display: none;'; ?>">
		<!-- Total Students Card -->
		<div class="col-xxl-2 col-xl-2 col-lg-3 col-md-4 col-sm-6 mb-3">
			<div class="modern-stat-card total-card">
				<div class="stat-card-header">
					<div class="stat-card-info">
						<div class="stat-card-title">TOTAL Studend CARDS</div>
						<div class="stat-card-number" id="total-students-card">-</div>
					</div>
					<div class="stat-card-icon">
						<div class="icon-circle" style="background: linear-gradient(145deg, #8B0000, #800000);">
							<i class="fas fa-users"></i>
						</div>
					</div>
				</div>
				<div class="stat-card-progress">
					<div class="progress" style="height: 4px;">
						<div class="progress-bar" style="background: linear-gradient(145deg, #8B0000, #800000); width: 100%"></div>
					</div>
				</div>
			</div>
		</div>
		<!-- Evaluated Card -->
		<div class="col-xxl-2 col-xl-2 col-lg-3 col-md-4 col-sm-6 mb-3">
			<div class="modern-stat-card evaluated-card">
				<div class="stat-card-header">
					<div class="stat-card-info">
						<div class="stat-card-title">Student Evaluated COMPLETED</div>
						<div class="stat-card-number" id="evaluated-count-card">-</div>
					</div>
					<div class="stat-card-icon">
						<div class="icon-circle" style="background: linear-gradient(145deg, #8B0000, #800000);">
							<i class="fas fa-check-circle"></i>
						</div>
					</div>
				</div>
				<div class="stat-card-progress">
					<div class="progress" style="height: 4px;">
						<div class="progress-bar" style="background: linear-gradient(145deg, #8B0000, #800000); width: 100%"></div>
					</div>
				</div>
			</div>
		</div>

		<!-- Pending Card -->
		<div class="col-xxl-2 col-xl-2 col-lg-3 col-md-4 col-sm-6 mb-3">
			<div class="modern-stat-card pending-card">
				<div class="stat-card-header">
					<div class="stat-card-info">
						<div class="stat-card-title">PENDING CARDS</div>
						<div class="stat-card-number" id="pending-count-card">-</div>
						<div class="stat-card-desc">Remaining</div>
					</div>
					<div class="stat-card-icon">
						<div class="icon-circle" style="background: linear-gradient(145deg, #8B0000, #800000);">
							<i class="fas fa-clock"></i>
						</div>
					</div>
				</div>
				<div class="stat-card-progress">
					<div class="progress" style="height: 4px;">
						<div class="progress-bar" style="background: linear-gradient(145deg, #8B0000, #800000); width: 100%"></div>
					</div>
				</div>
			</div>
		</div>

		<!-- Responses Card -->
		<div class="col-xxl-2 col-xl-2 col-lg-3 col-md-4 col-sm-6 mb-3">
			<div class="modern-stat-card responses-card">
				<div class="stat-card-header">
					<div class="stat-card-info">
						<div class="stat-card-title">RESPONSES</div>
						<div class="stat-card-number" id="studentCount">-</div>
						<div class="stat-card-desc">Total</div>
					</div>
					<div class="stat-card-icon">
						<div class="icon-circle" style="background: linear-gradient(145deg, #8B0000, #800000);">
							<i class="fas fa-user-check"></i>
						</div>
					</div>
				</div>
				<div class="stat-card-progress">
					<div class="progress" style="height: 4px;">
						<div class="progress-bar" style="background: linear-gradient(145deg, #8B0000, #800000); width: 100%"></div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Selected Faculty Subject Header - Outside the table -->
	<div class="row mb-4" id="faculty-header" style="<?php echo (isset($_GET['fid']) && !empty($_GET['fid'])) ? 'display: block;' : 'display: none;'; ?>">
		<div class="col-md-12">
			<div class="text-center" style="background: #f8f9fa; padding: 20px; border-radius: 8px; border-left: 4px solid #007bff; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
				<h4 style="margin: 0; font-weight: bold; color: #495057; font-size: 16px;">Selected Faculty Subject</h4>
				<p style="margin: 8px 0 0 0; font-size: 30px; color: #007bff; font-weight: 600;" id="faculty_name_display">
					<?php 
					if(isset($_GET['fid']) && !empty($_GET['fid'])) {
						$faculty_id = (int)$_GET['fid'];
						$faculty_qry = $conn->query("SELECT CONCAT(firstname, ' ', lastname) as name FROM faculty_list WHERE id = $faculty_id");
						echo $faculty_qry->num_rows > 0 ? $faculty_qry->fetch_assoc()['name'] : '-';
					} else {
						echo '-';
					}
					?>
				</p>
				<div class="mt-3" style="display: flex; justify-content: center; gap: 60px; flex-wrap: wrap;">
					<div style="text-align: center;">
						<strong style="color: #6c757d; font-size: 14px;">Weighted Rating:</strong>
						<div style="font-size: 24px; font-weight: bold; color: #007bff;" id="weighted_rating_display">
							<?php 
							if(isset($_GET['fid']) && !empty($_GET['fid'])) {
								if(isset($has_evaluations) && !$has_evaluations) {
									echo 'Not yet evaluated';
								} elseif(isset($has_evaluations) && $has_evaluations && isset($total_weighted_average)) {
									echo number_format($total_weighted_average, 2);
								} else {
									echo '-';
								}
							} else {
								echo '-';
							}
							?>
						</div>
					</div>
					<div style="text-align: center;">
						<strong style="color: #6c757d; font-size: 14px;">Descriptive Rating:</strong>
						<div style="font-size: 24px; font-weight: bold; color:rgb(23, 219, 69);" id="descriptive_rating_display">
							<?php 
							if(isset($_GET['fid']) && !empty($_GET['fid'])) {
								if(isset($has_evaluations) && !$has_evaluations) {
									echo '-';
								} elseif(isset($has_evaluations) && $has_evaluations && isset($total_weighted_average)) {
									// Calculate descriptive rating
									if ($total_weighted_average >= 4.23 && $total_weighted_average <= 5.00) {
										echo "Outstanding";
									} elseif ($total_weighted_average >= 3.43 && $total_weighted_average <= 4.22) {
										echo "Very Good";
									} elseif ($total_weighted_average >= 2.62 && $total_weighted_average <= 3.42) {
										echo "Good";
									} elseif ($total_weighted_average >= 1.81 && $total_weighted_average <= 2.61) {
										echo "Fair";
									} elseif ($total_weighted_average >= 1.00 && $total_weighted_average <= 1.80) {
										echo "Poor";
									} else {
										echo "N/A";
									}
								} else {
									echo '-';
								}
							} else {
								echo '-';
							}
							?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="row" id="report-content">
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
						<img src="./assets/img/logo.png" alt="School Logo" style="width: 80px; height: 80px; object-fit: contain;">
					</div>
					<div style="text-align: center;">
						<p style="margin: 5px 0; font-size: 14px;">MISAMIS ORIENTAL INSTITUTE OF SCIENCE AND TECHNOLOGY, INC.</p>
						<p style="margin: 0; font-size: 12px; font-style: italic;">Sta. Cruz Cogon Balingasag Misamis Oriental</p>
						<p style="margin: 5px 0 0 0; font-size: 10px; line-height: 1.3;">
							Website: www.moist.ph | Email: reynaldo.valmores@gmail.com FB: www.facebook.com/moist.edu | Contact #: 09173172641
						</p>
					</div>
				</div>
				<!-- Simple line above text -->
			</div>
			<div class="text-center">
				<h3 style="margin: 5px 0; font-weight: bold; font-size: 18px; text-align: center !important; width: 100%;">Faculty Evaluation by Students</h3>
				<p style="margin: 0; font-size: 14px; text-align: center !important; width: 100%;">S.Y. <?php echo $_SESSION['academic']['year'].' '.(ordinal_suffix($_SESSION['academic']['quarter'])) ?> Quarter</p>
			</div>
			<table width="100%">
					<tr>
						<td width="50%"><p><b>Teacher: <span id="fname">Please select a faculty member</span></b></p></td>
						<td width="50%">
							<p><b>Date Observed: <span id="evaluation-period">
							<?php 
							// Get the latest evaluation date from evaluation_list for this academic year
							$date_range_query = $conn->query("
								SELECT 
									MAX(DATE(date_taken)) as last_eval
								FROM evaluation_list 
								WHERE academic_id = {$_SESSION['academic']['id']}
							");
							
							if($date_range_query && $date_range_query->num_rows > 0) {
								$date_range = $date_range_query->fetch_assoc();
								if(!empty($date_range['last_eval'])) {
									// Show latest evaluation date only
									echo date('F j, Y', strtotime($date_range['last_eval']));
								} else {
									// No evaluations yet, show academic year
									echo $_SESSION['academic']['year'].' '.(ordinal_suffix($_SESSION['academic']['quarter'])) . ' Quarter';
								}
							} else {
								// Fallback to academic year and quarter
								echo $_SESSION['academic']['year'].' '.(ordinal_suffix($_SESSION['academic']['quarter'])) . ' Quarter';
							}
							?>
							</span></b></p>
						</td>
					</tr>
					<tr>
						<td width="50%"><p><b>Subject: <span id="subjectField">-</span></b></p></td>
					</tr>
			</table>
			</div>
				                <?php 
                            $q_arr = array();
                            $criteria_counter = 1;
                            // Use restriction id from URL if present to scope calculations
                            $restriction_id = isset($_GET['rid']) ? (int)$_GET['rid'] : 0;
                            // Determine if there is data for the selected restriction in the current academic year
                            $scopeAcademic = " AND el.academic_id = {$_SESSION['academic']['id']} ";
                            if($restriction_id){
                                $chkSql = "SELECT 1
                                           FROM evaluation_answers ea
                                           INNER JOIN evaluation_list el ON el.evaluation_id = ea.evaluation_id
                                           WHERE el.academic_id = {$_SESSION['academic']['id']} 
                                             AND el.restriction_id = {$restriction_id}
                                           LIMIT 1";
                                $chkRes = $conn->query($chkSql);
                                if(!$chkRes || $chkRes->num_rows === 0){
                                    // No data for this academic year + restriction; relax to any academic year but keep restriction
                                    $scopeAcademic = "";
                                    // Check again across all academic years; if still none, drop restriction filter
                                    $chkSqlAny = "SELECT 1
                                                  FROM evaluation_answers ea
                                                  INNER JOIN evaluation_list el ON el.evaluation_id = ea.evaluation_id
                                                  WHERE el.restriction_id = {$restriction_id}
                                                  LIMIT 1";
                                    $chkAnyRes = $conn->query($chkSqlAny);
                                    if(!$chkAnyRes || $chkAnyRes->num_rows === 0){
                                        $restriction_id = 0; // no data at all for this restriction, fallback to unscoped
                                    }
                                }
                            } else {
                                // No specific restriction; check if any answers exist for the current academic year at all
                                $chkSql2 = "SELECT 1
                                            FROM evaluation_answers ea
                                            INNER JOIN evaluation_list el ON el.evaluation_id = ea.evaluation_id
                                            WHERE el.academic_id = {$_SESSION['academic']['id']}
                                            LIMIT 1";
                                $chkRes2 = $conn->query($chkSql2);
                                if(!$chkRes2 || $chkRes2->num_rows === 0){
                                    $scopeAcademic = ""; // relax academic filter if no data this year
                                }
                            }
                            // Check if there are any evaluations for the selected faculty
                            $has_evaluations = false;
                            if(isset($_GET['fid']) && !empty($_GET['fid'])) {
                                $faculty_id = (int)$_GET['fid'];
                                // Check for evaluations in current academic year first
                                $eval_check = $conn->query("SELECT COUNT(*) as count FROM evaluation_list WHERE faculty_id = $faculty_id AND academic_id = {$_SESSION['academic']['id']}");
                                $has_evaluations = $eval_check && $eval_check->fetch_assoc()['count'] > 0;
                                
                                // Debug: Log the evaluation check
                                error_log("Faculty ID: $faculty_id, Academic ID: {$_SESSION['academic']['id']}, Has Evaluations: " . ($has_evaluations ? 'YES' : 'NO'));
                            }
                            
                            $criteria = $conn->query("SELECT * FROM criteria_list where id in (SELECT criteria_id FROM question_list where academic_id = {$_SESSION['academic']['id']} ) order by abs(order_by) asc ");
                            ?>
                            <div class="evaluation-tables <?php echo $has_evaluations ? 'show-data' : ''; ?>">
                            <?php if(!$has_evaluations && isset($_GET['fid']) && !empty($_GET['fid'])): ?>
                                <div id="no-evaluation-message" class="alert alert-info text-center">
                                    <h5>No Evaluations Available</h5>
                                    <p>This teacher has not been evaluated yet for any class and subject.</p>
                                </div>
                            <?php endif; ?>
                            <?php
                            while($crow = $criteria->fetch_assoc()):
                        ?>
					<table class="table table-bordered">
    <thead>
        <tr class="bg-gradient-secondary">
            <th width="60%"><?php echo $crow['criteria'] ?></th>
            <th width="15%" class="text-center">Scores</th>
            <th width="10%" class="text-center">Average</th>
            <th width="15%" class="text-center">Weighted</th>
        </tr>
    </thead>
    <tbody>
        <?php 
        // Build the questions array first so we know which is last
        $question_counter = 1;
        $questions_q = $conn->query("SELECT q.*, 
            (SELECT COUNT(DISTINCT ea.evaluation_id) 
               FROM evaluation_answers ea 
               INNER JOIN evaluation_list el ON el.evaluation_id = ea.evaluation_id 
              WHERE ea.question_id = q.id 
                ".($restriction_id?" AND el.restriction_id = {$restriction_id}":"").$scopeAcademic.") as response_count,
            (SELECT AVG(ea.rate) 
               FROM evaluation_answers ea 
               INNER JOIN evaluation_list el ON el.evaluation_id = ea.evaluation_id 
              WHERE ea.question_id = q.id 
                ".($restriction_id?" AND el.restriction_id = {$restriction_id}":"").$scopeAcademic.") as avg_rate,
            (SELECT SUM(ea.rate) 
               FROM evaluation_answers ea 
               INNER JOIN evaluation_list el ON el.evaluation_id = ea.evaluation_id 
              WHERE ea.question_id = q.id 
                ".($restriction_id?" AND el.restriction_id = {$restriction_id}":"").$scopeAcademic.") as total_score
            FROM question_list q 
            WHERE q.criteria_id = {$crow['id']} 
            AND q.academic_id = {$_SESSION['academic']['id']} 
            ORDER BY abs(q.order_by) ASC");
        $qrows = array();
        while($r = $questions_q->fetch_assoc()){
            $qrows[] = $r;
        }
        // Compute criterion average using a single AVG over all answers scoped by restriction_id for consistency
        $critAvgSql = "SELECT AVG(ea.rate) as avg_rate
                        FROM evaluation_answers ea
                        INNER JOIN evaluation_list el ON el.evaluation_id = ea.evaluation_id
                        INNER JOIN question_list q2 ON q2.id = ea.question_id
                        WHERE q2.criteria_id = {$crow['id']}
                          AND q2.academic_id = {$_SESSION['academic']['id']}".
                        ($restriction_id ? " AND el.restriction_id = {$restriction_id}" : "").
                        $scopeAcademic;
        $critAvgRes = $conn->query($critAvgSql);
        $critAvgRow = $critAvgRes ? $critAvgRes->fetch_assoc() : null;
        $criteria_avg = $critAvgRow && $critAvgRow['avg_rate'] !== null ? (float)$critAvgRow['avg_rate'] : 0;
        $total_questions = count($qrows);
        foreach($qrows as $idx => $row):
        $is_last = ($idx === $total_questions - 1);
        ?>
        <tr>
            <td><?php echo $criteria_counter . '.' . $question_counter++ . '. ' . $row['question'] ?></td>
            <td class="text-center">
                <?php echo isset($row['avg_rate']) && $row['avg_rate'] !== null ? number_format((float)$row['avg_rate'], 2) : '0.00'; ?>
            </td>
            <td class="text-center">
                <?php echo $is_last ? number_format($criteria_avg,2) : '' ?>
            </td>
            <td class="text-center">
                <?php 
                if($is_last){
                    // Map criterion to numeric weight
                    $weight_val = 0;
                    switch($crow['id']) {
                        case 1: $weight_val = 0.50; break;
                        case 2: $weight_val = 0.30; break;
                        case 3: $weight_val = 0.20; break;
                        case 4: $weight_val = 0.20; break;
                        default: $weight_val = 0; break;
                    }
                    echo number_format($criteria_avg * $weight_val, 2);
                } else {
                    echo '';
                }
                ?>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?php $criteria_counter++; endwhile; ?>

<!-- Overall Rating Section -->
<?php
$total_weighted_average = 0;
$criteria_data = [];

// Only calculate ratings if there are evaluations
if($has_evaluations) {
    // Reuse same criteria list
    $criteria = $conn->query("SELECT * FROM criteria_list where id in (SELECT criteria_id FROM question_list where academic_id = {$_SESSION['academic']['id']} ) order by abs(order_by) asc ");
    while($crow = $criteria->fetch_assoc()){
        // Compute per-criterion average using the same scope rules as the table above
        $critOverallSql = "SELECT AVG(ea.rate) as avg_rate
                            FROM evaluation_answers ea
                            INNER JOIN evaluation_list el ON el.evaluation_id = ea.evaluation_id
                            INNER JOIN question_list q ON q.id = ea.question_id
                            WHERE q.criteria_id = {$crow['id']}
                              AND q.academic_id = {$_SESSION['academic']['id']}".
                            ($restriction_id ? " AND el.restriction_id = {$restriction_id}" : "").
                            $scopeAcademic;
        $critOverallRes = $conn->query($critOverallSql);
        $critOverallRow = $critOverallRes ? $critOverallRes->fetch_assoc() : null;
        $avg_rate = $critOverallRow && $critOverallRow['avg_rate'] !== null ? (float)$critOverallRow['avg_rate'] : 0;

        // Use DB-configured weight directly
        $weight = isset($crow['weight']) ? (float)$crow['weight'] : 0;

        $weighted_avg = $avg_rate * $weight;
        $total_weighted_average += $weighted_avg;
        $criteria_data[] = ['name' => $crow['criteria'], 'avg' => $avg_rate, 'weight' => $weight, 'weighted_avg' => $weighted_avg];
    }
}
?>
<div style="width: 100%; overflow: hidden;">
    <div class="mt-4" style="float: right; margin-left: 20px;">
        <div class="rating-item">
            <strong>Weighted Rating:</strong>
            <span id="bottom_weighted_rating"><?php echo (isset($_GET['fid']) && !empty($_GET['fid']) && !$has_evaluations) ? 'Not yet evaluated' : '-'; ?></span>
        </div>
        <div class="rating-item">
            <strong>Descriptive Rating:</strong>
            <span id="bottom_descriptive_rating"><?php echo (isset($_GET['fid']) && !empty($_GET['fid']) && !$has_evaluations) ? '-' : '-'; ?></span>
        </div>
    </div>
</div>
</div> <!-- End evaluation-tables -->

					
					<div class="mt-4" id="comments-section" style="<?php echo !$has_evaluations ? 'display: none;' : ''; ?>">
						<div class="card card-outline card-info">
							<div class="card-header">
								<b>Student Comments</b>
							</div>
							<div class="card-body" id="comments-container">
								<p class="text-muted text-center">No comments available.</p>
							</div>
						</div>
					</div>
			</div>
		</div>
	</div>
</div>

<!-- Print Options Modal -->
<div class="modal fade" id="printModal" tabindex="-1" role="dialog" aria-labelledby="printModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="printModalLabel"><i class="fa fa-print"></i> Print Options</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<p class="mb-3">Choose what you would like to print:</p>
				<div class="d-grid gap-2">
					<button class="btn btn-primary btn-block mb-2" id="print-form-only">
						<i class="fa fa-file-text"></i> Print Evaluation Form Only
					</button>
					<button class="btn btn-info btn-block mb-2" id="print-comments-only">
						<i class="fa fa-comments"></i> Print Student Comments Only
					</button>
					<button class="btn btn-success btn-block" id="print-both">
						<i class="fa fa-print"></i> Print Complete Report (Both)
					</button>
				</div>
			</div>
		</div>
	</div>
</div>

<style>
	.list-group-item:hover{
		color: black !important;
		font-weight: 700 !important;
	}
	.evaluation-results table {
    margin-bottom: 2rem;
}

.evaluation-results th {
    background-color: #f4f6f9;
}

.evaluation-results td {
    vertical-align: middle;
}

.text-center {
    text-align: center;
}

/* Enhanced table styles */
.table-bordered {
    border: 1px solid #dee2e6;
    margin-bottom: 1rem;
}

.bg-gradient-secondary {
    background: #6c757d linear-gradient(180deg,#828a91,#6c757d) repeat-x!important;
    color: #fff;
}

#weighted-average, #descriptive-rating {
    font-size: 1.1em;
    font-weight: bold;
    color: #28a745;
}

.criteria-avg {
    color: #007bff;
    font-weight: bold;
}

/* Enhanced Statistics Cards Styling */
.modern-stat-card {
    background: #ffffff;
    border-radius: 12px;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    padding: 25px 20px;
    transition: all 0.3s ease;
    height: 100%;
    position: relative;
    overflow: hidden;
    margin-bottom: 15px;
    border: 1px solid rgba(0,0,0,0.05);
}

.modern-stat-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
}

.stat-card-info {
    flex: 1;
    min-width: 0; /* Prevents flex item from overflowing */
}

.stat-card-title {
    color: #5a6268;
    font-size: 0.9rem;
    font-weight: 500;
    line-height: 1.4;
    margin-top: 5px;
}

.stat-card-icon {
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
    margin-top: 5px;
}

.icon-circle {
    width: 50px;
    height: 50px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #ffffff;
    box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    transition: all 0.3s ease;
    font-size: 1.2rem;
}

.icon-circle i {
    font-size: 1.2rem;
}

.stat-card-number {
    font-size: 1.9rem;
}

@media (max-width: 1200px) {
    .stat-card-number {
        font-size: 1.7rem;
    }
    .icon-circle {
        width: 45px;
        height: 45px;
        font-size: 1.1rem;
    }
}

@media (max-width: 992px) {
    .stat-card-number {
        font-size: 1.6rem;
    }
    .stat-card-desc {
        font-size: 0.75rem;
    }
}

@media (max-width: 576px) {
    .stat-card-number {
        font-size: 1.6rem;
    }
    .icon-circle {
        width: 40px;
        height: 40px;
        font-size: 1rem;
    }
    .stat-card-header {
        gap: 10px;
    }
}

#stats-cards .card:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
}

#stats-cards .card-body {
    padding: 1rem;
}

#stats-cards .stats-title {
    font-size: 0.75rem;
    font-weight: 600;
    text-transform: uppercase;
    margin-bottom: 0.5rem;
    color: #ffffff !important;
}

#stats-cards .stats-value {
    font-size: 1.8rem;
    font-weight: bold;
    margin: 0;
    line-height: 1.2;
    color: #ffffff !important;
    text-shadow: 1px 1px 2px rgba(0,0,0,0.1);
}

#stats-cards .stats-subtitle {
    font-size: 0.7rem;
    color: rgba(255,255,255,0.85) !important;
}

#stats-cards .card-icon {
    margin-left: 10px;
    color: #ffffff !important;
    opacity: 0.8;
}

.opacity-75 {
    opacity: 0.75;
}

/* Fix card text colors */
.card.bg-primary, .card.bg-success, .card.bg-warning, .card.bg-info, .card.bg-secondary {
    color: #ffffff !important;
}

.card.bg-primary *, .card.bg-success *, .card.bg-warning *, .card.bg-info *, .card.bg-secondary * {
    color: #ffffff !important;
}

.card-body > div {
    display: flex;
    flex-direction: column;
    justify-content: center;
}

/* Force text color for specific elements */
.card h2.mb-0.font-weight-bold,
.card h6.card-title.mb-1.text-uppercase,
.card small.opacity-75 {
    color: #ffffff !important;
    text-shadow: 0 1px 2px rgba(0,0,0,0.1);
}

/* Responsive adjustments for cards */
@media (max-width: 768px) {
    .card h3 {
        font-size: 2rem;
    }
    
    .card-body {
        padding: 1rem;
    }
    
    .card-icon i {
        font-size: 1.5rem !important;
    }
}

.stat-card-header {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    margin-bottom: 10px;
    gap: 15px;
}

/* No evaluation message styling */
#no-evaluation-message {
    margin: 20px 0;
    padding: 30px;
    background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
    border: 2px solid #dee2e6;
    border-radius: 10px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

#no-evaluation-message h5 {
    color: #495057;
    margin-bottom: 15px;
    font-weight: 600;
}

#no-evaluation-message p {
    color: #6c757d;
    margin-bottom: 0;
    font-size: 16px;
}

/* Hide evaluation tables by default until data is loaded */
.evaluation-tables {
    display: none;
}

.evaluation-tables.show-data {
    display: block;
}
</style>
<style>
    @media print {
        @page {
            size: 8.5in 11in; /* Short bond paper */
            margin: 0.3in; /* Smaller margins for more space */
        }
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            font-size: 8px; /* Smaller base font */
        }
        /* Ensure elements marked as text-center and their children stay centered on print */
        .text-center, .text-center * {
            text-align: center !important;
        }
        .no-print, .card-header .btn, .card-tools {
            display: none !important;
        }
        
        /* Compact header */
        .text-center.mb-4 {
            margin-bottom: 5px !important;
            padding-bottom: 5px !important;
        }
        .text-center img {
            width: 50px !important;
            height: 50px !important;
        }
        .text-center h3 {
            font-size: 12px !important;
            margin: 2px 0 !important;
        }
        .text-center p {
            font-size: 8px !important;
            margin: 1px 0 !important;
            line-height: 1.1 !important;
        }
        
        /* Compact tables */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 5px !important;
            font-size: 7px !important;
        }
        table, table tr, table td, table th {
            border: 1px solid #000;
            padding: 2px 3px !important;
            line-height: 1.1 !important;
        }
        table thead tr, table thead th {
            background-color: #f0f0f0 !important;
            font-weight: bold;
            text-align: center;
            font-size: 7px !important;
        }
        
        /* Info table at top */
        table:first-of-type {
            margin-bottom: 3px !important;
        }
        table:first-of-type td {
            font-size: 8px !important;
        }
        table:first-of-type p {
            margin: 1px 0 !important;
        }
        
        /* Overall rating section */
        .overall-rating-section {
            margin-top: 3px !important;
            margin-bottom: 3px !important;
        }
        .overall-rating-section h4 {
            font-size: 10px !important;
            margin: 2px 0 !important;
        }
        .overall-rating-section p {
            font-size: 8px !important;
            margin: 1px 0 !important;
        }
        
        /* Rating legend */
        fieldset {
            margin: 3px 0 !important;
            padding: 3px !important;
        }
        fieldset legend {
            font-size: 8px !important;
            padding: 0 3px !important;
        }
        fieldset p {
            font-size: 7px !important;
            margin: 1px 0 !important;
        }
        
        /* Hide comments section for form-only print */
        #comments-section {
            display: none !important;
        }
        
        /* Compact spacing */
        hr {
            margin: 3px 0 !important;
        }
        
        h3, h4, h5 {
            margin: 2px 0 !important;
        }
    }
</style>
<noscript>
	<style>
		/* Print-specific styles */
		@media print {
			body { margin: 0; padding: 20px; font-family: Arial, sans-serif; }
			.no-print { display: none !important; }
		}
		
		/* General table styling for print */
		table {
			width: 100%;
			border-collapse: collapse;
			margin-bottom: 15px;
			font-size: 12px;
		}
		
		/* Style all tables with borders */
		table, table tr, table td, table th {
			border: 1px solid #000;
			padding: 8px;
		}
		
		/* Header styling */
		table thead tr, table thead th {
			background-color: #f0f0f0 !important;
			font-weight: bold;
			text-align: center;
		}
		
		/* Text alignment classes */
		.text-center { text-align: center; }
		.text-right { text-align: right; }
		.text-left { text-align: left; }
		
		/* Header section styling */
		.print-header {
			text-align: center;
			margin-bottom: 20px;
			border-bottom: 2px solid #000;
			padding-bottom: 15px;
		}
		
		/* Logo and title styling */
		.header-content {
			display: flex;
			align-items: center;
			justify-content: center;
			margin-bottom: 10px;
		}
		
		.logo-section {
			width: 80px;
			height: 80px;
			margin-right: 20px;
		}
		
		.logo-section img {
			width: 80px;
			height: 80px;
			object-fit: contain;
		}
		
		/* Title styling */
		h4, h3 { margin: 5px 0; font-weight: bold; }
		h4 { font-size: 16px; }
		h3 { font-size: 18px; }
		
		/* Info table styling */
		.info-table {
			width: 100%;
			margin-bottom: 15px;
		}
		
		.info-table td {
			padding: 5px;
			border: none;
		}
		
		/* Rating legend styling */
		.rating-legend {
			border: 1px solid #000;
			padding: 10px;
			margin-bottom: 15px;
		}
		
		.rating-legend legend {
			font-weight: bold;
			padding: 0 10px;
		}
		
		/* Comments section */
		.comments-section {
			margin-top: 20px;
			border: 1px solid #000;
			padding: 10px;
		}
		
		.comments-header {
			font-weight: bold;
			margin-bottom: 10px;
			background-color: #f0f0f0;
			padding: 5px;
		}
		
		/* Page break handling */
		.page-break-before { page-break-before: always; }
		.page-break-after { page-break-after: always; }
		.no-page-break { page-break-inside: avoid; }

		.rating-item {
			font-size: 14px;
			margin-bottom: 10px;
		}

		.rating-item strong {
			width: 180px; /* Adjust as needed */
			display: inline-block;
		}

		.rating-item span {
			border-bottom: 1px solid #000;
			display: inline-block;
			width: 150px; /* Adjust as needed */
			text-align: center;
		}
		
		/* Font sizes */
		p { font-size: 12px; margin: 3px 0; }
		li { font-size: 11px; }
		
		/* Bold text */
		b, strong { font-weight: bold; }
	</style>
</noscript>
<script>
	$(document).ready(function(){
		// Show empty state initially but keep form visible
		showEmptyState();
		
		// Check if faculty dropdown exists before binding event
		if($('#faculty_id').length > 0) {
			$('#faculty_id').change(function(){
				if($(this).val() > 0) {
					// Show loading indicator
					start_load();
					
					// Get selected faculty name for better UX
					var selectedText = $(this).find('option:selected').text();
					if($('#faculty_name_display').length) {
						$('#faculty_name_display').text(selectedText);
					}
					
					// Immediately refresh the page with the new faculty selection
					window.location.href = './index.php?page=report&fid=' + $(this).val();
				} else {
					showEmptyState();
				}
			});
		}
		
		// Only load class if faculty is already selected (from URL)
		if($('#faculty_id').val() > 0) {
			showReportContent();
			load_class();
		} else {
			// Show the form template with empty scores
			showEmptyState();
		}

        // Calculate and set descriptive rating on document ready
        <?php if(isset($has_evaluations) && $has_evaluations): ?>
        var total_avg = <?php echo isset($total_weighted_average) ? $total_weighted_average : 0; ?>;
        var descriptive_rating = getDescriptiveRating(total_avg);
        $('#descriptive_rating_val').text(descriptive_rating);
        
        // Update the new prominent rating display
        $('#weighted_rating_display').text(total_avg.toFixed(2));
        $('#descriptive_rating_display').text(descriptive_rating);
        console.log('Evaluations found, displaying ratings:', total_avg);
        <?php else: ?>
        // No evaluations, keep default "Not yet evaluated" text
        console.log('No evaluations found, keeping default display');
        console.log('Has evaluations: <?php echo isset($has_evaluations) ? ($has_evaluations ? "true" : "false") : "undefined"; ?>');
        console.log('Faculty ID from URL: <?php echo isset($_GET["fid"]) ? $_GET["fid"] : "none"; ?>');
        <?php endif; ?>
	})
	
	// Function to show empty state
	function showEmptyState() {
		// Use safe jQuery operations with existence checks
		if($('#stats-cards').length) $('#stats-cards').hide();
		if($('#faculty-header').length) $('#faculty-header').hide();
		if($('#print-options-btn').length) $('#print-options-btn').hide();
		if($('#class-list').length) $('#class-list').html('<div class="text-center text-muted p-3">Select faculty to view classes</div>');
		if($('#fname').length) $('#fname').text('Please select a faculty member');
		if($('#subjectField').length) $('#subjectField').text('-');
		if($('#faculty_name_display').length) $('#faculty_name_display').text('-');
		if($('#weighted_rating_display').length) $('#weighted_rating_display').text('-');
		if($('#descriptive_rating_display').length) $('#descriptive_rating_display').text('-');
		if($('#bottom_weighted_rating').length) $('#bottom_weighted_rating').text('-');
		if($('#bottom_descriptive_rating').length) $('#bottom_descriptive_rating').text('-');
		
		// Hide evaluation tables and comments when no faculty selected
		if($('.evaluation-tables').length) $('.evaluation-tables').removeClass('show-data');
		if($('#comments-section').length) $('#comments-section').hide();
		if($('#no-evaluation-message').length) $('#no-evaluation-message').remove();
		
		// Only clear scores if no faculty is selected
		if($('#faculty_id').length && ($('#faculty_id').val() == '' || $('#faculty_id').val() == '0')) {
			$('.table-bordered tbody tr td:nth-child(2)').text('-');
			$('.table-bordered tbody tr td:nth-child(3)').text('');
			$('.table-bordered tbody tr td:nth-child(4)').text('');
		}
	}
	
	// Function to show report content
	function showReportContent() {
		$('#faculty-header').show();
	}
 	
	// Function to get descriptive rating
	function getDescriptiveRating(score) {
		if (score >= 4.23 && score <= 5.00) {
			return "Outstanding";
		} else if (score >= 3.43 && score <= 4.22) {
			return "Very Good";
		} else if (score >= 2.62 && score <= 3.42) {
			return "Good";
		} else if (score >= 1.81 && score <= 2.61) {
			return "Fair";
		} else if (score >= 1.00 && score <= 1.80) {
			return "Poor";
		} else {
			return "N/A";
		}
	}
	
	// Clean weighted formula calculation: Final Rating = Σ (Averageᵢ × Weightᵢ)
function calculateOverallRating() {
    // Step 4: Define weights for 3 criteria (must sum to 1.00)
    var criteriaWeights = {
        1: 0.50,  // Teaching Performance: 50%
        2: 0.30,  // Personal and Related Teaching Qualities: 30%
        3: 0.20,  // School and Community Service: 20%
        4: 0.20   // School and Community Service: 20% (alternative ID)
    };
    
    var finalRating = 0;
    var totalWeight = 0;
    
    console.log('=== WEIGHTED FORMULA CALCULATION ===');
    
    // Process each criteria table
    $('.table-bordered').each(function() {
        var criteriaHeader = $(this).find('thead tr th:first').text().trim();
        var criteriaId = 0;
        
        // Match criteria based on exact header text (order matters!)
        if (criteriaHeader.includes('Personal and Related Teaching')) criteriaId = 2;
        else if (criteriaHeader.includes('Teaching Performance')) criteriaId = 1;
        else if (criteriaHeader.includes('School and community Service')) criteriaId = 4;
        
        if (criteriaId > 0 && criteriaWeights[criteriaId]) {
            // Step 1: Calculate Average per item for this criteria
            var totalRating = 0;
            var questionCount = 0;
            
            $(this).find('tbody tr').each(function() {
                // Get the average from the 3rd column (Average column)
                var rating = parseFloat($(this).find('td:nth-child(3)').text());
                if (!isNaN(rating)) {
                    totalRating += rating;
                    questionCount++;
                }
            });
            
            if (questionCount > 0) {
                // Step 1: Average for this criteria
                var criteriaAverage = totalRating / questionCount;
                
                // Step 2: Weighted Score = Average × Weight
                var weightedScore = criteriaAverage * criteriaWeights[criteriaId];
                
                // Step 3: Add to final rating
                finalRating += weightedScore;
                totalWeight += criteriaWeights[criteriaId];
                
                console.log('Criteria ' + criteriaId + ': Average = ' + criteriaAverage.toFixed(2) + 
                           ', Weight = ' + (criteriaWeights[criteriaId] * 100) + '%, Weighted Score = ' + weightedScore.toFixed(2));
            }
        }
    });
    
    // Step 4: Verify total weight = 1.00
    console.log('Total Weight Check: ' + totalWeight.toFixed(2) + ' (should be 1.00)');
    
    if (totalWeight > 0) {
        // Step 5: Apply descriptive interpretation
        var descriptive_rating = getDescriptiveRating(finalRating);
        
        console.log('=== FINAL RESULTS ===');
        console.log('Final Rating = Σ (Averageᵢ × Weightᵢ) = ' + finalRating.toFixed(2));
        console.log('Descriptive Rating: ' + descriptive_rating);
        
        // Update the display
        $('#weighted-average').text(finalRating.toFixed(2));
        $('#descriptive-rating').text(descriptive_rating);
        
        // Update the new prominent rating display
        $('#weighted_rating_display').text(finalRating.toFixed(2));
        $('#descriptive_rating_display').text(descriptive_rating);
        
        // Update the bottom rating display
        $('#bottom_weighted_rating').text(finalRating.toFixed(2));
        $('#bottom_descriptive_rating').text(descriptive_rating);
        
    } else {
        console.log('No valid criteria data found');
        $('#weighted-average').text('-');
        $('#descriptive-rating').text('-');
        
        // Update the new prominent rating display for no data case
        $('#weighted_rating_display').text('-');
        $('#descriptive_rating_display').text('-');
        
        // Update the bottom rating display for no data case
        $('#bottom_weighted_rating').text('-');
        $('#bottom_descriptive_rating').text('-');
    }
}
	
	// Function to calculate criteria breakdown (simplified - no longer displayed)
	function calculateCriteriaBreakdown() {
		// This function is kept for potential future use but no longer displays criteria breakdown
		// since we're using the simplified format
	}
	
	function load_class(){
		start_load()
		var fname = <?php echo json_encode($fname) ?>;
		var faculty_id = $('#faculty_id').val();
		
		console.log('Loading classes for faculty ID:', faculty_id);
		$('#fname').text(fname[faculty_id])
		$('#faculty_name_display').text(fname[faculty_id])
		
		// Load faculty-wide statistics first
		load_faculty_stats(faculty_id)
		
		$.ajax({
			url:"ajax.php?action=get_class",
			method:'POST',
			data:{fid: faculty_id},
			error:function(err){
				console.error("AJAX Error loading classes:", err);
				console.log("Error details:", err.responseText);
				alert_toast("An error occurred while loading classes. Check console for details.",'error')
				$('#class-list').html('<a href="javascript:void(0)" class="list-group-item list-group-item-action disabled text-danger">Error loading classes. Please try again.</a>')
				end_load()
			},
			success:function(resp){
				console.log('Raw response from get_class:', resp);
				
				if(!resp || resp.trim() === '') {
					console.warn('Empty response from get_class');
					$('#class-list').html('<a href="javascript:void(0)" class="list-group-item list-group-item-action disabled">No classes assigned to this faculty.</a>')
					return;
				}
				
				try {
					resp = JSON.parse(resp);
					console.log('Parsed response:', resp);
					
					if(!Array.isArray(resp) || resp.length === 0) {
						console.warn('No classes found for faculty ID:', faculty_id);
						$('#class-list').html('<a href="javascript:void(0)" class="list-group-item list-group-item-action disabled">No classes assigned to this faculty for the current academic period.</a>')
					} else {
						console.log('Found', resp.length, 'classes');
						$('#class-list').html('')
						resp.forEach(function(item, index) {
							console.log('Adding class item:', item);
							$('#class-list').append('<a href="javascript:void(0)" data-json=\''+JSON.stringify(item)+'\' data-id="'+item.id+'" class="list-group-item list-group-item-action show-result">'+item.class+' - '+item.subj+'</a>')
						});
					}
				} catch(e) {
					console.error('JSON parse error:', e);
					console.log('Response that failed to parse:', resp);
					alert_toast("Error parsing server response. Check console for details.",'error')
					$('#class-list').html('<a href="javascript:void(0)" class="list-group-item list-group-item-action disabled text-danger">Error parsing server response.</a>')
				}
			},
			complete:function(){
				end_load()
				anchor_func()
				if('<?php echo isset($_GET['rid']) ?>' == 1){
					$('.show-result[data-id="<?php echo isset($_GET['rid']) ? $_GET['rid'] : '' ?>"]').trigger('click')
				}else{
					$('.show-result').first().trigger('click')
				}
			}
		})
	}
	
	function load_faculty_stats(faculty_id){
		$.ajax({
			url:"ajax.php?action=get_faculty_stats",
			method:'POST',
			data:{fid:faculty_id},
			success:function(resp){
				console.log('Raw response:', resp)
				if(resp){
					try {
						resp = JSON.parse(resp)
						console.log('Faculty stats loaded:', resp)
						$('#stats-cards').show()
						
						// Update all statistics cards with the data
						// Update the total students and evaluated count
						var totalStudents = parseInt(resp.total_students) || 0;
						var evaluatedCount = parseInt(resp.evaluated_count) || 0;
						
						// Calculate the percentage based on total evaluation cards for this teacher
						var actualPercentage = totalStudents > 0 ? Math.round((evaluatedCount / totalStudents) * 100) : 0;
						
						// Update the cards
						$('#total-students-card').html(totalStudents);
						$('#evaluated-count-card').html(evaluatedCount);
						$('#pending-count-card').html(resp.pending_count || '0');
						$('#completion-rate-card').html(actualPercentage + '%');
						$('#studentCount').html(resp.response_count || '0');
						
						// Update the percentage display - always show just the percentage number
						console.log('Updating percentage element with:', actualPercentage + '%');
						console.log('Element found:', $('#evaluated-percentage').length);
						$('#evaluated-percentage').html(actualPercentage + '%');
						console.log('Element content after update:', $('#evaluated-percentage').html());
						
						// Color coding based on progress (green for good progress, orange for moderate, red for low)
						if (actualPercentage >= 60) {
							$('#evaluated-percentage').css('color', '#28a745'); // Green for good progress
							console.log('Setting percentage color to green');
						} else if (actualPercentage >= 30) {
							$('#evaluated-percentage').css('color', '#ffc107'); // Orange for moderate progress
							console.log('Setting percentage color to orange');
						} else {
							$('#evaluated-percentage').css('color', '#dc3545'); // Red for low progress
							console.log('Setting percentage color to red');
						}
						
						console.log('Cards updated with values:', {
							total: resp.total_students,
							evaluated: resp.evaluated_count,
							pending: resp.pending_count,
							rate: resp.completion_rate
						})
					} catch(e) {
						console.error('JSON parse error:', e)
						console.log('Response that failed to parse:', resp)
					}
				} else {
					console.log('Empty response received')
				}
			},
			error:function(err){
				console.log('Error loading faculty stats:', err)
			}
		})
	}
	function anchor_func(){
		$('.show-result').off('click').on('click', function(){
			var vars = [], hash;
			var data = $(this).attr('data-json')
				data = JSON.parse(data)
			var _href = location.href.slice(window.location.href.indexOf('?') + 1).split('&');
			for(var i = 0; i < _href.length; i++)
				{
					hash = _href[i].split('=');
					vars[hash[0]] = hash[1];
				}
			window.history.pushState({}, null, './index.php?page=report&fid='+vars.fid+'&rid='+data.id);
			$('#comments-container').html(''); // Clear comments on new report load
			load_report(vars.fid,data.sid,data.id);
			load_comments(vars.fid,data.sid,data.id);
			$('#subjectField').text(data.subj)
			$('#classField').text(data.class)
			$('.show-result.active').removeClass('active')
			$(this).addClass('active')
		})
	}
	function load_comments($faculty_id, $subject_id, $class_id){
		console.log('load_comments called with:', $faculty_id, $subject_id, $class_id);
		$('#comments-container').html('<p class="text-muted text-center">Loading comments...</p>');
		$.ajax({
			url:'ajax.php?action=get_comments',
			method:"POST",
			data:{faculty_id: $faculty_id,subject_id:$subject_id,class_id:$class_id},
			error:function(err){
				console.log(err)
				alert_toast("An Error Occured while loading comments.","error");
			},
			success:function(resp){
				if(resp && resp.trim() !== ''){
					try {
						resp = JSON.parse(resp);
						if(resp.length <= 0){
							$('#comments-container').html('<p class="text-muted text-center">No comments available.</p>');
						} else {
						$('#comments-container').html(''); // Clear loading message
						
						// Group comments by question
						var strengthsAnswers = [];
						var improvementAnswers = [];
						
						resp.forEach(function(comment) {
							if (comment.strengths_comment && comment.strengths_comment.trim() !== '') {
								strengthsAnswers.push(escapeHTML(comment.strengths_comment));
							}
							if (comment.improvement_comment && comment.improvement_comment.trim() !== '') {
								improvementAnswers.push(escapeHTML(comment.improvement_comment));
							}
						});
						
						var groupedHtml = '';
						
						// Display strengths question with all answers
						if (strengthsAnswers.length > 0) {
							groupedHtml += '<div class="question-group" style="margin-bottom: 30px;">';
							groupedHtml += '<div><strong>1. What do you like most about your teacher?</strong></div>';
							strengthsAnswers.forEach(function(answer) {
								groupedHtml += '<p style="margin-left: 15px; margin-bottom: 8px;">' + answer + '</p>';
							});
							groupedHtml += '</div>';
						}
						
						// Display improvement question with all answers
						if (improvementAnswers.length > 0) {
							groupedHtml += '<div class="question-group" style="margin-bottom: 30px;">';
							groupedHtml += '<div><strong>2. What areas could the teacher improve on?</strong></div>';
							improvementAnswers.forEach(function(answer) {
								groupedHtml += '<p style="margin-left: 15px; margin-bottom: 8px;">' + answer + '</p>';
							});
							groupedHtml += '</div>';
						}
						
						if (groupedHtml === '') {
							$('#comments-container').html('<p class="text-muted text-center">No comments available.</p>');
						} else {
							$('#comments-container').html(groupedHtml);
						}
					}
					} catch(e) {
						console.error('JSON parse error:', e);
						$('#comments-container').html('<p class="text-muted text-center">Error loading comments.</p>');
					}
				} else {
					$('#comments-container').html('<p class="text-muted text-center">No comments available.</p>');
				}
			},
			complete:function(){
				// No action needed here
			}
		})
	}
	function escapeHTML(str) {
		return str.replace(/[&<>"']/g, function(tag) {
			var chars_to_replace = {
				'&': '&amp;',
				'<': '&lt;',
				'>': '&gt;',
				'"': '&quot;',
				"'": '&#39;'
			};
			return chars_to_replace[tag] || tag;
		});
	}
	function load_report($faculty_id, $subject_id, $class_id) {
		$('#comments-container').html(''); // Clear comments on new report load
		if($('#preloader2').length <= 0)
		start_load()
		$.ajax({
			url:'ajax.php?action=get_report',
			method:"POST",
			data:{faculty_id: $faculty_id,subject_id:$subject_id,class_id:$class_id},
			error:function(err){
				console.log(err)
				alert_toast("An Error Occured.","error");
				end_load()
			},
			success:function(resp){
				if(resp){
					resp = JSON.parse(resp)
					console.log('Report response:', resp); // Debug log
					if(Object.keys(resp).length <= 0 || resp.tse == 0){
						console.log('No evaluations found, hiding tables'); // Debug log
						$('.rates').text('0.00%')
						$('#tse').text('0')
						$('#studentCount').text('0')
						$('#stats-cards').show()
						$('#total-students-card').text(resp.total_students || 0)
						$('#evaluated-count-card').text('0')
						$('#pending-count-card').text(resp.total_students || 0)
						$('#completion-rate-card').text('0%')
						$('#evaluated-percentage').html('0%')
						$('#print-options-btn').hide()
						$('#overall-rating-section').hide()
						
						// Hide the evaluation tables when no data
						$('.evaluation-tables').removeClass('show-data')
						$('#comments-section').hide()
						
						// Show "No evaluations available" message
						if($('#no-evaluation-message').length == 0) {
							$('.evaluation-tables').prepend('<div id="no-evaluation-message" class="alert alert-info text-center"><h5>No Evaluations Available</h5><p>This teacher has not been evaluated yet for the selected class and subject.</p></div>');
						}
						
						// Show "Evaluation results will appear here once available" for ratings
						$('#weighted_rating_display').text('Not yet evaluated')
						$('#descriptive_rating_display').text('-')
						$('#bottom_weighted_rating').text('Not yet evaluated')
						$('#bottom_descriptive_rating').text('-')
					}else{
						// Show evaluation tables and hide no-data message
						$('.evaluation-tables').addClass('show-data')
						$('#comments-section').show()
						$('#no-evaluation-message').remove()
						
						$('#print-options-btn').show()
						$('#tse').text(resp.tse)
						$('#studentCount').text(resp.tse)
						
						// Update statistics cards
						$('#stats-cards').show()
						$('#total-students-card').text(resp.total_students || 0)
						$('#evaluated-count-card').text(resp.tse || 0)
						$('#pending-count-card').text(resp.pending_count || 0)
						$('#completion-rate-card').text((resp.completion_rate || 0) + '%')
						
						$('.rates').text('-')
						var data = resp.data
						Object.keys(data).map(q=>{
							Object.keys(data[q]).map(r=>{
								console.log($('.rate_'+r+'_'+q),data[q][r])
								$('.rate_'+r+'_'+q).text(data[q][r]+'%')
							})
						})
						
						// Update weighted and descriptive ratings based on evaluation status
						var totalStudents = resp.total_students || 0;
						var evaluatedStudents = resp.tse || 0;
						
						if(evaluatedStudents === 0) {
							// No evaluations yet
							$('#weighted_rating_display').text('Results pending');
							$('#descriptive_rating_display').text('-');
							$('#descriptive_rating_val').text('-');
							$('#bottom_weighted_rating').text('Results pending');
							$('#bottom_descriptive_rating').text('-');
						} else if(resp.weighted_rating !== undefined && resp.descriptive_rating !== undefined) {
							// Show ratings without partial/final status
							$('#weighted_rating_display').text(resp.weighted_rating);
							$('#descriptive_rating_display').text(resp.descriptive_rating);
							$('#descriptive_rating_val').text(resp.descriptive_rating);
							$('#bottom_weighted_rating').text(resp.weighted_rating);
							$('#bottom_descriptive_rating').text(resp.descriptive_rating);
						} else {
							// Fallback to calculation if server doesn't provide ratings
							setTimeout(function() {
								calculateOverallRating();
							}, 100);
						}
						console.log('Evaluation status:', evaluatedStudents + '/' + totalStudents + ' students evaluated');
					}
					
				}
			},
			complete:function(){
				// Load comments after the report is loaded
				load_comments($faculty_id, $subject_id, $class_id);
				end_load()
			}
		})
	}
	
	// Print Form Only
	$('#print-form-only').click(function(){
		$('#printModal').modal('hide');
		start_load()
		
		// Get the printable content without comments
		var content = $('#printable').clone()
		content.find('#comments-section').remove() // Remove comments section
		var formContent = content.html()
		
		openPrintPreview(formContent, 'Faculty Evaluation Form', 'form');
		end_load();
	})
	
	// Print Comments Only
	$('#print-comments-only').click(function(){
		$('#printModal').modal('hide');
		start_load()
		
		// Get only what we need for the comments report
		var headerDiv = $('#printable > div:first').clone() // Get the first div which contains the header
		var commentsContent = $('#printable').find('#comments-section').clone()
		
		// Create comments-only content
		var content = '<div>' + headerDiv.html() + '</div>'
		content += '<div>' + commentsContent[0].outerHTML + '</div>'
		
		openPrintPreview(content, 'Student Comments Report', 'comments');
		end_load();
	})
	
	// Print Both (Complete Report)
	$('#print-both').click(function(){
		$('#printModal').modal('hide');
		start_load()
		
		// Get the complete printable content
		var content = $('#printable').html()
		
		openPrintPreview(content, 'Complete Faculty Evaluation Report', 'complete');
		end_load();
	})
	
	// Helper function to open print preview
	function openPrintPreview(content, title, type) {
		// Fix logo path for print window
		content = content.replace('./assets/img/logo.png', window.location.origin + window.location.pathname.replace('index.php', '') + 'assets/img/logo.png');
		
		// Get print styles from noscript
		var printStyles = $('noscript style').html()
		
		// Create complete HTML document for printing
		var printHTML = createPrintHTML(content, printStyles, title)
		
		// Open preview window
		var nw = window.open("", title.replace(/\s+/g, ''), "width=900,height=700,scrollbars=yes");
		nw.document.write(printHTML);
		nw.document.close();
		
		// Add print button to preview window
		addPrintButtonToWindow(nw, type);
	}
	
	// Helper function to create print HTML
	function createPrintHTML(content, printStyles, title) {
		return `
		<!DOCTYPE html>
		<html>
		<head>
			<meta charset="utf-8">
			<title>${title}</title>
			<style>
				${printStyles}
				
				/* Ensure short bond paper sizing and margins - COMPACT FOR 1 PAGE */
				@page {
					size: 8.5in 11in; /* Short bond paper */
					margin: 0.3in; /* Smaller margins */
				}
				
				/* Additional print optimizations - COMPACT */
				body {
					margin: 0;
					padding: 10px;
					font-family: Arial, sans-serif;
					font-size: 8px; /* Smaller font */
					line-height: 1.1; /* Tighter line height */
				}

				/* Keep images within printable width */
				img { max-width: 100%; height: auto; }

				/* Comment pagination and spacing for print */
				.comments-section { width: 100%; }
				.comment-item {
					break-inside: avoid;
					page-break-inside: avoid;
					margin-bottom: 12pt;
					padding-bottom: 8pt;
					border-bottom: 1px solid #000;
				}
				.page-break { page-break-after: always; break-after: page; }
				
				/* Preview-specific styles */
				.preview-controls {
					position: fixed;
					top: 10px;
					right: 10px;
					z-index: 1000;
					background: white;
					padding: 10px;
					border: 2px solid #007bff;
					border-radius: 5px;
					box-shadow: 0 2px 10px rgba(0,0,0,0.1);
				}
				
				.preview-controls button {
					background: #007bff;
					color: white;
					border: none;
					padding: 8px 16px;
					border-radius: 4px;
					cursor: pointer;
					margin-right: 5px;
				}
				
				.preview-controls button:hover {
					background: #0056b3;
				}
				
				/* Ensure proper table formatting */
				.table-bordered {
					border-collapse: collapse;
					width: 100%;
					margin-bottom: 15px;
				}
				
				.table-bordered th,
				.table-bordered td {
					border: 1px solid #000;
					padding: 8px;
					text-align: left;
				}
				
				.table-bordered th {
					background-color: #f0f0f0;
					font-weight: bold;
					text-align: center;
				}
				
				/* Print-specific adjustments */
				@media print {
					.preview-controls { display: none !important; }
					body { margin: 0; font-size: 12pt; }
					.no-print { display: none !important; }
					
					/* Enhanced comment section styling for print */
					.question-group {
						margin-bottom: 25px !important;
						page-break-inside: avoid;
					}
					
					.question-group strong {
						font-size: 14pt !important;
						font-weight: bold !important;
						margin-bottom: 10px !important;
						display: block !important;
					}
					
					.question-group p {
						font-size: 12pt !important;
						line-height: 1.2 !important;
						margin-left: 20px !important;
						margin-bottom: 3px !important;
						margin-top: 2px !important;
					}
					
					/* Student Comments section header */
					#comments-container {
						font-size: 12pt !important;
					}
					
					/* Reduce spacing in header table */
					table tr td p {
						margin-bottom: 2px !important;
						margin-top: 2px !important;
					}
				}
			</style>
		</head>
		<body>
			<div class="preview-controls no-print">
				<button onclick="window.print()">🖨️ Print</button>
				<button onclick="window.close()">❌ Close</button>
			</div>
			${content}
		</body>
		</html>
		`;
	}
	
	// Helper function to add print functionality to preview window
	function addPrintButtonToWindow(windowObj, type) {
		// Log print action via AJAX
		var faculty_id = $('#faculty_id').val();
		var faculty_name = $('#faculty_id option:selected').text();
		
		// Add event listener for when print is triggered
		windowObj.addEventListener('beforeprint', function() {
			$.ajax({
				url: 'ajax.php?action=log_print_report',
				method: 'POST',
				data: {
					faculty_id: faculty_id,
					faculty_name: faculty_name,
					print_type: type
				}
			});
		});
	}

	// Simplified rating update function
	function updateOverallRating() {
		<?php if(isset($has_evaluations) && $has_evaluations): ?>
		var total_avg = <?php echo isset($total_weighted_average) ? $total_weighted_average : 0; ?>;
		var descriptive_rating = getDescriptiveRating(total_avg);
		$('#descriptive_rating_val').text(descriptive_rating);
		<?php else: ?>
		$('#descriptive_rating_val').text('-');
		<?php endif; ?>
	}

</script>
<?php include 'admin_footer.php'; ?>