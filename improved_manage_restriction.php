<?php
include '../db_connect.php';

// Check if there are existing evaluations before allowing restriction changes
function checkExistingEvaluations($conn, $academic_id) {
    $check_query = "SELECT COUNT(*) as eval_count FROM evaluation_list WHERE academic_id = $academic_id";
    $result = $conn->query($check_query);
    $count = $result->fetch_assoc()['eval_count'];
    return $count > 0;
}

// Get affected students when changing restrictions
function getAffectedStudents($conn, $academic_id, $faculty_id, $class_id) {
    $query = "SELECT DISTINCT e.student_id, 
                     CONCAT(s.firstname, ' ', s.lastname) as student_name,
                     COUNT(*) as evaluation_count
              FROM evaluation_list e
              LEFT JOIN student_list s ON s.id = e.student_id
              WHERE e.academic_id = $academic_id 
              AND e.faculty_id = $faculty_id 
              AND e.class_id = $class_id
              GROUP BY e.student_id";
    
    return $conn->query($query);
}

$academic_id = isset($_GET['id']) ? $_GET['id'] : '';
$has_evaluations = checkExistingEvaluations($conn, $academic_id);
?>

<div class="container-fluid">
    <?php if($has_evaluations): ?>
    <div class="alert alert-warning">
        <h5><i class="fa fa-exclamation-triangle"></i> Warning: Existing Evaluations Detected</h5>
        <p>There are already completed evaluations in this academic year. Modifying restrictions may cause student evaluations to appear as "reset" or "pending" again.</p>
        <p><strong>Recommendation:</strong> Only add new restrictions. Avoid deleting or modifying existing ones.</p>
    </div>
    <?php endif; ?>

    <form action="" id="manage-restriction">
        <div class="row">
            <div class="col-md-4 border-right">
                <input type="hidden" name="academic_id" value="<?php echo $academic_id ?>">
                <div id="msg" class="form-group"></div>
                
                <div class="form-group">
                    <label for="" class="control-label">Faculty</label>
                    <select name="" id="faculty_id" class="form-control form-control-sm select2">
                        <option value="">Select Faculty to load assignments</option>
                        <?php 
                        $faculty = $conn->query("SELECT *,concat(firstname,' ',lastname) as name FROM faculty_list order by concat(firstname,' ',lastname) asc");
                        $f_arr = array();
                        while($row=$faculty->fetch_assoc()):
                            $f_arr[$row['id']]= $row;
                        ?>
                        <option value="<?php echo $row['id'] ?>"><?php echo ucwords($row['name']) ?></option>
                        <?php endwhile; ?>
                    </select>
                </div>
                
                <div class="form-group">
                    <label for="" class="control-label">Filter by Grade Level (Optional)</label>
                    <select name="" id="grade_filter" class="form-control form-control-sm select2">
                        <option value="">All Grade Levels</option>
                        <?php 
                        $grades = $conn->query("SELECT DISTINCT level FROM class_list ORDER BY level");
                        while($row = $grades->fetch_assoc()):
                        ?>
                        <option value="<?php echo $row['level'] ?>"><?php echo $row['level'] ?></option>
                        <?php endwhile; ?>
                    </select>
                </div>
                
                <div class="form-group">
                    <label for="" class="control-label">Filter by Subject (Optional)</label>
                    <select name="" id="subject_filter" class="form-control form-control-sm select2">
                        <option value="">All Subjects</option>
                        <?php 
                        $subjects = $conn->query("SELECT id, CONCAT(code,' - ',subject) as subj FROM subject_list ORDER BY code");
                        while($row = $subjects->fetch_assoc()):
                        ?>
                        <option value="<?php echo $row['id'] ?>"><?php echo $row['subj'] ?></option>
                        <?php endwhile; ?>
                    </select>
                </div>
                
                <div class="form-group">
                    <div class="d-flex w-100 justify-content-center">
                        <button class="btn btn-sm btn-flat btn-success bg-gradient-success" id="load_assignments" type="button">Load Faculty Assignments</button>
                    </div>
                    <small class="text-muted">Select faculty and optional filters above, then click to load assignments</small>
                </div>
            </div>
            
            <div class="col-md-8">
                <div id="evaluation_warning" style="display: none;" class="alert alert-danger">
                    <h6><i class="fa fa-exclamation-triangle"></i> Impact Warning</h6>
                    <p>Modifying this faculty's restrictions will affect the following students:</p>
                    <div id="affected_students"></div>
                    <p><strong>Their completed evaluations may appear as PENDING again!</strong></p>
                </div>
                
                <table class="table table-condensed" id="r-list">
                    <thead>
                        <tr>
                            <th>Faculty</th>
                            <th>Class</th>
                            <th>Subject</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $restriction = $conn->query("SELECT r.*, 
                                                            CONCAT(f.firstname, ' ', f.lastname) as faculty_name,
                                                            CONCAT(c.level, ' - ', c.section) as class_name,
                                                            CONCAT(s.code, ' - ', s.subject) as subject_name
                                                     FROM restriction_list r 
                                                     LEFT JOIN faculty_list f ON f.id = r.faculty_id
                                                     LEFT JOIN class_list c ON c.id = r.class_id
                                                     LEFT JOIN subject_list s ON s.id = r.subject_id
                                                     WHERE r.academic_id = {$academic_id} 
                                                     ORDER BY r.id ASC");
                        while($row=$restriction->fetch_assoc()):
                            // Check if this restriction has evaluations
                            $eval_check = $conn->query("SELECT COUNT(*) as count FROM evaluation_list WHERE restriction_id = {$row['id']}");
                            $has_evals = $eval_check->fetch_assoc()['count'] > 0;
                        ?>
                        <tr data-restriction-id="<?php echo $row['id'] ?>" data-faculty-id="<?php echo $row['faculty_id'] ?>" data-class-id="<?php echo $row['class_id'] ?>">
                            <td>
                                <b><?php echo $row['faculty_name'] ?></b>
                                <input type="hidden" name="rid[]" value="<?php echo $row['id'] ?>">
                                <input type="hidden" name="faculty_id[]" value="<?php echo $row['faculty_id'] ?>">
                            </td>
                            <td>
                                <b><?php echo $row['class_name'] ?></b>
                                <input type="hidden" name="class_id[]" value="<?php echo $row['class_id'] ?>">
                            </td>
                            <td>
                                <b><?php echo $row['subject_name'] ?></b>
                                <input type="hidden" name="subject_id[]" value="<?php echo $row['subject_id'] ?>">
                            </td>
                            <td>
                                <?php if($has_evals): ?>
                                    <span class="badge badge-warning">Has Evaluations</span>
                                <?php else: ?>
                                    <span class="badge badge-secondary">No Evaluations</span>
                                <?php endif; ?>
                            </td>
                            <td class="text-center">
                                <?php if($has_evals): ?>
                                    <button class="btn btn-sm btn-outline-danger" onclick="confirmDelete(this)" type="button" title="Warning: This will affect student evaluations">
                                        <i class="fa fa-exclamation-triangle"></i> <i class="fa fa-trash"></i>
                                    </button>
                                <?php else: ?>
                                    <button class="btn btn-sm btn-outline-danger" onclick="$(this).closest('tr').remove()" type="button">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </form>
</div>

<script>
$(document).ready(function(){
    $('.select2').select2({
        placeholder:"Please select here",
        width: "100%"
    });
    
    // Show warning when faculty is selected that has evaluations
    $('#faculty_id').change(function(){
        var faculty_id = $(this).val();
        if(faculty_id) {
            checkFacultyEvaluations(faculty_id);
        } else {
            $('#evaluation_warning').hide();
        }
    });
    
    function checkFacultyEvaluations(faculty_id) {
        $.ajax({
            url: 'ajax.php?action=check_faculty_evaluations',
            method: 'POST',
            data: {faculty_id: faculty_id, academic_id: <?php echo $academic_id ?>},
            dataType: 'json',
            success: function(response) {
                if(response.has_evaluations) {
                    $('#affected_students').html(response.students_html);
                    $('#evaluation_warning').show();
                } else {
                    $('#evaluation_warning').hide();
                }
            }
        });
    }
    
    function confirmDelete(button) {
        var row = $(button).closest('tr');
        var faculty_id = row.data('faculty-id');
        var class_id = row.data('class-id');
        
        if(confirm('WARNING: This restriction has existing evaluations. Deleting it will cause student evaluations to appear as PENDING again. Are you sure you want to continue?')) {
            row.remove();
        }
    }
    
    window.confirmDelete = confirmDelete;
    
    $('#manage-restriction').submit(function(e){
        e.preventDefault();
        
        // Check if we're modifying restrictions with evaluations
        var hasEvaluations = $('.badge-warning').length > 0;
        if(hasEvaluations) {
            if(!confirm('WARNING: You are modifying restrictions that have existing evaluations. This may cause student evaluations to appear as PENDING again. Continue?')) {
                return false;
            }
        }
        
        start_load()
        $('#msg').html('')
        $.ajax({
            url:'ajax.php?action=save_restriction',
            method:'POST',
            data:$(this).serialize(),
            success:function(resp){
                if(resp == 1){
                    alert_toast("Data successfully saved.","success");
                    setTimeout(function(){
                        location.reload()	
                    },1750)
                }else if(resp == 2){
                    $('#msg').html('<div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> Class already exist.</div>')
                    end_load()
                }
            }
        })
    })
    
    $('#load_assignments').click(function(){
        start_load()
        var faculty_id = $('#faculty_id').val();
        var grade_filter = $('#grade_filter').val();
        var subject_filter = $('#subject_filter').val();
        $.ajax({
            url: 'ajax.php?action=get_faculty_assignments',
            method: 'POST',
            data: {faculty_id: faculty_id, grade_filter: grade_filter, subject_filter: subject_filter},
            dataType: 'json',
            success: function(response) {
                // Don't clear existing restrictions, just add new ones
                if(response.length > 0) {
                    $.each(response, function(index, assignment) {
                        // Check if this assignment already exists
                        var exists = false;
                        $('#r-list tbody tr').each(function() {
                            var existing_faculty = $(this).find('input[name="faculty_id[]"]').val();
                            var existing_class = $(this).find('input[name="class_id[]"]').val();
                            var existing_subject = $(this).find('input[name="subject_id[]"]').val();
                            
                            if(existing_faculty == assignment.faculty_id && 
                               existing_class == assignment.class_id && 
                               existing_subject == assignment.subject_id) {
                                exists = true;
                                return false;
                            }
                        });
                        
                        if(!exists) {
                            var tr = $("<tr></tr>")
                            tr.append('<td><b>'+assignment.faculty_name+'</b><input type="hidden" name="rid[]" value=""><input type="hidden" name="faculty_id[]" value="'+assignment.faculty_id+'"></td>')
                            tr.append('<td><b>'+assignment.class+'</b><input type="hidden" name="class_id[]" value="'+assignment.class_id+'"></td>')
                            tr.append('<td><b>'+assignment.subject+'</b><input type="hidden" name="subject_id[]" value="'+assignment.subject_id+'"></td>')
                            tr.append('<td><span class="badge badge-secondary">New Assignment</span></td>')
                            tr.append('<td class="text-center"><button class="btn btn-sm btn-outline-danger" onclick="$(this).closest(\'tr\').remove()" type="button"><i class="fa fa-trash"></i></button></td>')
                            $('#r-list tbody').append(tr)
                        }
                    });
                }
                end_load()
            },
            error: function() {
                alert_toast("Error loading assignments.","error");
                end_load()
            }
        })
    })
})
</script>
