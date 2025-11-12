<?php include 'db_connect.php' ?>
<?php include 'admin_history_logger.php' ?>
<div class="col-lg-12">
    <div class="card card-outline card-success">
        <div class="card-header">
            <div class="card-tools">
                <a class="btn btn-block btn-sm btn-default btn-flat border-primary" href="./index.php?page=new_evaluation"><i class="fa fa-plus"></i> Add New</a>
            </div>
        </div>
        <div class="card-body">        <!-- Filter Controls -->
            <div class="row mb-3">
                <div class="col-md-4">
                    <label for="class_filter">Filter by Class:</label>
                    <select id="class_filter" class="form-control form-control-sm">
                        <option value="">All Classes</option>
                        <?php 
                        $classes = $conn->query("SELECT * FROM class_list ORDER BY curriculum, level, section");
                        while($class = $classes->fetch_assoc()):
                        ?>
                        <option value="<?php echo $class['id'] ?>"><?php echo $class['curriculum'].' '.$class['level'].' - '.$class['section'] ?></option>
                        <?php endwhile; ?>
                    </select>
                </div>
                <div class="col-md-4">
                    <label for="faculty_filter">Filter by Faculty:</label>
                    <select id="faculty_filter" class="form-control form-control-sm">
                        <option value="">All Faculty</option>
                        <?php 
                        $faculty = $conn->query("SELECT * FROM faculty_list ORDER BY firstname, lastname");
                        while($fac = $faculty->fetch_assoc()):
                        ?>
                        <option value="<?php echo $fac['id'] ?>"><?php echo ucwords($fac['firstname'].' '.$fac['lastname']) ?></option>
                        <?php endwhile; ?>
                    </select>
                </div>
                <div class="col-md-4">
                    <label for="status_filter">Filter by Status:</label>
                    <select id="status_filter" class="form-control form-control-sm">
                        <option value="">All Status</option>
                        <option value="completed">Completed</option>
                        <option value="pending">Pending</option>
                    </select>
                </div>
            </div>

            <!-- Statistics Cards -->
            <div class="row mb-4">
                <div class="col-md-3">
                    <div class="stat-card card">
                        <div class="card-body bg-primary text-white">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <h3 id="total-students">-</h3>
                                    <p class="mb-0">Total Students</p>
                                </div>
                                <div class="align-self-center">
                                    <span><i class="fa fa-users fa-2x"></i></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stat-card card">
                        <div class="card-body bg-success text-white">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <h3 id="completed-evaluations">-</h3>
                                    <p class="mb-0">Completed</p>
                                </div>
                                <div class="align-self-center">
                                    <span><i class="fa fa-check-circle fa-2x"></i></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stat-card card">
                        <div class="card-body bg-warning text-white">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <h3 id="pending-evaluations">-</h3>
                                    <p class="mb-0">Pending</p>
                                </div>
                                <div class="align-self-center">
                                    <span><i class="fa fa-clock fa-2x"></i></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stat-card card">
                        <div class="card-body bg-info text-white">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <h3 id="completion-rate">-%</h3>
                                    <p class="mb-0">Completion Rate</p>
                                </div>
                                <div class="align-self-center">
                                    <span><i class="fa fa-chart-pie fa-2x"></i></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Progress Table -->
            <div class="table-responsive">
                <table class="table table-hover table-bordered" id="evaluation-progress-table">
                    <thead>
                        <tr>
                            <th>Student</th>
                            <th>Class</th>
                            <th>Assigned Teachers</th>
                            <th>Completed</th>
                            <th>Pending</th>
                            <th>Progress</th>
                            <th>Last Activity</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody id="progress-table-body">
                        <!-- Data will be loaded via AJAX -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<style>
.stat-card {
    position: relative;
    z-index: 1;
    overflow: hidden;
    margin-bottom: 1rem;
}

.stat-card .card-body {
    border-radius: 4px;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
}

.stat-card h3 {
    font-size: 2rem;
    font-weight: bold;
    margin-bottom: 0.5rem;
}

.stat-card p {
    font-size: 1rem;
    opacity: 0.9;
}

.stat-card i {
    opacity: 0.8;
}

.bg-primary, .bg-success, .bg-warning, .bg-info {
    position: relative;
    z-index: 1;
}

.progress-bar-custom {
    height: 20px;
    border-radius: 10px;
}
.status-badge {
    font-size: 0.75rem;
    padding: 0.25rem 0.5rem;
}
.student-name {
    font-weight: 600;
    color: #495057;
}
.class-info {
    font-size: 0.9rem;
    color: #6c757d;
}
.teacher-count {
    display: inline-block;
    min-width: 60px;
    text-align: center;
}
.action-buttons .btn {
    margin-right: 5px;
    padding: 0.25rem 0.5rem;
    font-size: 0.75rem;
}
</style>

<script>
$(document).ready(function(){
    loadEvaluationProgress();
    
    // Filter change handlers
    $('#class_filter, #faculty_filter, #status_filter').change(function(){
        loadEvaluationProgress();
    });
});

function loadEvaluationProgress() {
    start_load();
    
    $.ajax({
        url: 'ajax.php?action=get_evaluation_progress',
        method: 'POST',
        data: {
            class_id: $('#class_filter').val(),
            faculty_id: $('#faculty_filter').val(),
            status: $('#status_filter').val()
        },
        success: function(resp) {
            if(resp) {
                try {
                    var data = JSON.parse(resp);
                    updateStatistics(data.statistics);
                    updateProgressTable(data.students);
                } catch(e) {
                    console.error('Error parsing response:', e);
                }
            }
            end_load();
        },
        error: function(xhr, status, error) {
            console.error('AJAX Error:', error);
            end_load();
        }
    });
}

function updateStatistics(stats) {
    // Update the values without hiding cards
    $('#total-students').text(stats.total_students || 0);
    $('#completed-evaluations').text(stats.completed_evaluations || 0);
    $('#pending-evaluations').text(stats.pending_evaluations || 0);
    $('#completion-rate').text((stats.completion_rate || 0) + '%');
    
    // Add a subtle highlight animation instead
    $('.card.bg-primary, .card.bg-success, .card.bg-warning, .card.bg-info').addClass('highlight-update');
}

function updateProgressTable(students) {
    var tbody = $('#progress-table-body');
    tbody.empty();
    
    if(students.length === 0) {
        tbody.append('<tr><td colspan="8" class="text-center text-muted">No data available</td></tr>');
        return;
    }
    
    students.forEach(function(student) {
        var progressPercent = student.total_assigned > 0 ? 
            Math.round((student.completed_count / student.total_assigned) * 100) : 0;
        
        var progressBarClass = progressPercent >= 80 ? 'bg-success' : 
                              progressPercent >= 50 ? 'bg-warning' : 'bg-danger';
        
        var lastActivity = student.last_activity ? 
            new Date(student.last_activity).toLocaleDateString() : 'Never';
        
        var row = `
            <tr>
                <td>
                    <div class="student-name">${student.student_name}</div>
                    <small class="text-muted">${student.student_id}</small>
                </td>
                <td>
                    <div class="class-info">${student.class_name}</div>
                </td>
                <td class="text-center">
                    <span class="teacher-count badge badge-secondary">${student.total_assigned}</span>
                </td>
                <td class="text-center">
                    <span class="teacher-count badge badge-success">${student.completed_count}</span>
                </td>
                <td class="text-center">
                    <span class="teacher-count badge badge-warning">${student.pending_count}</span>
                </td>
                <td>
                    <div class="progress progress-bar-custom">
                        <div class="progress-bar ${progressBarClass}" role="progressbar" 
                             style="width: ${progressPercent}%" 
                             aria-valuenow="${progressPercent}" aria-valuemin="0" aria-valuemax="100">
                            ${progressPercent}%
                        </div>
                    </div>
                </td>
                <td class="text-center">
                    <small>${lastActivity}</small>
                </td>
                <td class="text-center">
                    <div class="action-buttons">
                        <button class="btn btn-sm btn-info" onclick="viewStudentDetail(${student.student_id})">
                            <i class="fa fa-eye"></i> View
                        </button>
                        <button class="btn btn-sm btn-primary" onclick="sendReminder(${student.student_id})">
                            <i class="fa fa-bell"></i> Remind
                        </button>
                    </div>
                </td>
            </tr>
        `;
        tbody.append(row);
    });
}

function viewStudentDetail(studentId) {
    uni_modal("Student Evaluation Details", "view_student_evaluations.php?id=" + studentId, 'large');
}

function sendReminder(studentId) {
    if(confirm('Send reminder to this student?')) {
        $.ajax({
            url: 'ajax.php?action=send_evaluation_reminder',
            method: 'POST',
            data: {student_id: studentId},
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
</script>
