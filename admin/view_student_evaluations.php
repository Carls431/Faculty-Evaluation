<?php
include 'db_connect.php';
$student_id = $_GET['id'];
$academic_id = $_SESSION['academic']['id'];

// Get student info
$student_query = $conn->query("SELECT CONCAT(firstname, ' ', lastname) as name, school_id, class_id FROM student_list WHERE id = $student_id");
$student = $student_query->fetch_assoc();

// Get class info
$class_query = $conn->query("SELECT CONCAT(curriculum, ' ', level, ' - ', section) as class_name FROM class_list WHERE id = {$student['class_id']}");
$class_info = $class_query->fetch_assoc();
?>

<div class="container-fluid">
    <div class="row mb-3">
        <div class="col-12">
            <h5><i class="fa fa-user"></i> <?php echo $student['name'] ?></h5>
            <p class="text-muted mb-0">Student ID: <?php echo $student['school_id'] ?></p>
            <p class="text-muted">Class: <?php echo $class_info['class_name'] ?></p>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead class="thead-dark">
                <tr>
                    <th>Teacher</th>
                    <th>Subject</th>
                    <th>Status</th>
                    <th>Completion Date</th>
                    <th>Comment</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Get all assigned evaluations for this student
                $evaluations_query = "
                    SELECT 
                        r.id as restriction_id,
                        CONCAT(f.firstname, ' ', f.lastname) as teacher_name,
                        CONCAT(s.code, ' - ', s.subject) as subject_name,
                        el.date_taken,
                        el.comment,
                        el.evaluation_id,
                        f.id as faculty_id,
                        s.id as subject_id
                    FROM restriction_list r
                    INNER JOIN faculty_list f ON f.id = r.faculty_id
                    INNER JOIN subject_list s ON s.id = r.subject_id
                    LEFT JOIN evaluation_list el ON el.restriction_id = r.id AND el.student_id = $student_id
                    WHERE r.class_id = {$student['class_id']} AND r.academic_id = $academic_id
                    ORDER BY f.lastname, f.firstname, s.subject
                ";
                
                $evaluations = $conn->query($evaluations_query);
                $total_assigned = $evaluations->num_rows;
                $completed_count = 0;
                
                while($eval = $evaluations->fetch_assoc()):
                    $is_completed = !empty($eval['evaluation_id']);
                    if($is_completed) $completed_count++;
                    
                    $status_badge = $is_completed ? 
                        '<span class="badge badge-success"><i class="fa fa-check"></i> Completed</span>' : 
                        '<span class="badge badge-warning"><i class="fa fa-clock"></i> Pending</span>';
                    
                    $completion_date = $is_completed ? 
                        date('M d, Y g:i A', strtotime($eval['date_taken'])) : 
                        '-';
                    
                    $comment_display = $is_completed && !empty($eval['comment']) ? 
                        '<button class="btn btn-sm btn-info" onclick="showComment(\'' . htmlspecialchars($eval['comment'], ENT_QUOTES) . '\')">
                            <i class="fa fa-comment"></i> View
                        </button>' : 
                        '<span class="text-muted">No comment</span>';
                    
                    $action_button = $is_completed ? 
                        '<button class="btn btn-sm btn-secondary" onclick="viewEvaluation(' . $eval['evaluation_id'] . ')">
                            <i class="fa fa-eye"></i> View
                        </button>' : 
                        '<button class="btn btn-sm btn-primary" onclick="sendIndividualReminder(' . $student_id . ', ' . $eval['restriction_id'] . ')">
                            <i class="fa fa-bell"></i> Remind
                        </button>';
                ?>
                <tr class="<?php echo $is_completed ? 'table-success' : 'table-warning' ?>">
                    <td><?php echo $eval['teacher_name'] ?></td>
                    <td><?php echo $eval['subject_name'] ?></td>
                    <td><?php echo $status_badge ?></td>
                    <td><?php echo $completion_date ?></td>
                    <td><?php echo $comment_display ?></td>
                    <td><?php echo $action_button ?></td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>

    <!-- Progress Summary -->
    <div class="row mt-3">
        <div class="col-md-6">
            <div class="card bg-light">
                <div class="card-body">
                    <h6><i class="fa fa-chart-pie"></i> Progress Summary</h6>
                    <div class="progress mb-2" style="height: 25px;">
                        <?php 
                        $progress_percent = $total_assigned > 0 ? round(($completed_count / $total_assigned) * 100) : 0;
                        $progress_class = $progress_percent >= 80 ? 'bg-success' : ($progress_percent >= 50 ? 'bg-warning' : 'bg-danger');
                        ?>
                        <div class="progress-bar <?php echo $progress_class ?>" style="width: <?php echo $progress_percent ?>%">
                            <?php echo $progress_percent ?>% Complete
                        </div>
                    </div>
                    <small class="text-muted">
                        <?php echo $completed_count ?> of <?php echo $total_assigned ?> evaluations completed
                    </small>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card bg-light">
                <div class="card-body">
                    <h6><i class="fa fa-info-circle"></i> Quick Stats</h6>
                    <p class="mb-1"><strong>Completed:</strong> <?php echo $completed_count ?></p>
                    <p class="mb-1"><strong>Pending:</strong> <?php echo ($total_assigned - $completed_count) ?></p>
                    <p class="mb-0"><strong>Total Assigned:</strong> <?php echo $total_assigned ?></p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Comment Modal -->
<div class="modal fade" id="commentModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Student Comment</h5>
                <button type="button" class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p id="comment-text"></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
    <button type="button" class="btn btn-primary" onclick="sendBulkReminder(<?php echo $student_id ?>)">
        <i class="fa fa-bell"></i> Send Reminder for All Pending
    </button>
</div>

<script>
function showComment(comment) {
    $('#comment-text').text(comment);
    $('#commentModal').modal('show');
}

function viewEvaluation(evaluationId) {
    uni_modal("Evaluation Details", "view_evaluation.php?id=" + evaluationId, 'large');
}

function sendIndividualReminder(studentId, restrictionId) {
    if(confirm('Send reminder for this specific evaluation?')) {
        $.ajax({
            url: 'ajax.php?action=send_individual_reminder',
            method: 'POST',
            data: {
                student_id: studentId,
                restriction_id: restrictionId
            },
            success: function(resp) {
                if(resp == 1) {
                    alert_toast("Reminder sent successfully", "success");
                } else {
                    alert_toast("Failed to send reminder", "error");
                }
            }
        });
    }
}

function sendBulkReminder(studentId) {
    if(confirm('Send reminder for all pending evaluations for this student?')) {
        $.ajax({
            url: 'ajax.php?action=send_bulk_reminder',
            method: 'POST',
            data: {student_id: studentId},
            success: function(resp) {
                if(resp == 1) {
                    alert_toast("Reminders sent successfully", "success");
                } else {
                    alert_toast("Failed to send reminders", "error");
                }
            }
        });
    }
}
</script>

<style>
.table-success {
    background-color: rgba(40, 167, 69, 0.1) !important;
}
.table-warning {
    background-color: rgba(255, 193, 7, 0.1) !important;
}
</style>
