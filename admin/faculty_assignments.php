<?php include 'db_connect.php'; ?>
<div class="container-fluid">
    <div class="col-lg-12">
        <div class="row mb-4 mt-4">
            <div class="col-md-12">
                
            </div>
        </div>
        <div class="row">
            <!-- FORM Panel -->
            <div class="col-md-4">
                <form action="" id="manage-assignment">
                    <div class="card">
                        <div class="card-header">
                            Faculty Class Assignment Form
                        </div>
                        <div class="card-body">
                            <input type="hidden" name="id">
                            <div class="form-group">
                                <label class="control-label">Faculty</label>
                                <select name="faculty_id" id="faculty_id" class="form-control select2" required>
                                    <option value="">Select Faculty</option>
                                    <?php 
                                    $faculty = $conn->query("SELECT id, CONCAT(firstname,' ',lastname) as name FROM faculty_list ORDER BY firstname, lastname");
                                    while($row = $faculty->fetch_assoc()):
                                    ?>
                                    <option value="<?php echo $row['id'] ?>"><?php echo ucwords($row['name']) ?></option>
                                    <?php endwhile; ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Class/Section</label>
                                <select name="class_id" id="class_id" class="form-control select2" required>
                                    <option value="">Select Class</option>
                                    <?php 
                                    $classes = $conn->query("SELECT id, CONCAT(curriculum,' ',level,' - ',section) as class FROM class_list ORDER BY 
                                        CASE 
                                            WHEN level LIKE '%12%' THEN 1
                                            WHEN level LIKE '%11%' THEN 2  
                                            WHEN level LIKE '%10%' THEN 3
                                            WHEN level LIKE '%9%' THEN 4
                                            WHEN level LIKE '%8%' THEN 5
                                            WHEN level LIKE '%7%' THEN 6
                                            ELSE 7
                                        END,
                                        curriculum, section");
                                    while($row = $classes->fetch_assoc()):
                                    ?>
                                    <option value="<?php echo $row['id'] ?>"><?php echo $row['class'] ?></option>
                                    <?php endwhile; ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Subject</label>
                                <select name="subject_id" id="subject_id" class="form-control select2" required>
                                    <option value="">Select Subject</option>
                                    <?php 
                                    $subjects = $conn->query("SELECT id, CONCAT(code,' - ',subject) as subj FROM subject_list ORDER BY code");
                                    while($row = $subjects->fetch_assoc()):
                                    ?>
                                    <option value="<?php echo $row['id'] ?>"><?php echo $row['subj'] ?></option>
                                    <?php endwhile; ?>
                                </select>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="row">
                                <div class="col-md-12">
                                    <button class="btn btn-sm btn-primary col-sm-3 offset-md-3"> Save</button>
                                    <button class="btn btn-sm btn-default col-sm-3" type="button" onclick="_reset()"> Cancel</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <!-- FORM Panel -->

            <!-- Table Panel -->
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <b>Faculty Class Assignments List</b>
                    </div>
                    <div class="card-body">
                        <!-- Search Bar -->
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-search"></i></span>
                                    </div>
                                    <input type="text" class="form-control" id="faculty_search" placeholder="Search faculty name...">
                                </div>
                            </div>
                        </div>
                        
                        <table class="table table-condensed table-bordered table-hover" id="assignments_table">
                            <thead>
                                <tr>
                                    <th class="text-center">#</th>
                                    <th class="">Faculty</th>
                                    <th class="">Class</th>
                                    <th class="">Subject</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                $i = 1;
                                echo "<!-- Debug: Starting query -->";
                                $assignments = $conn->query("
                                    SELECT a.*, 
                                           CONCAT(f.firstname,' ',f.lastname) as faculty_name,
                                           CONCAT(c.curriculum,' ',c.level,' - ',c.section) as class_name,
                                           CONCAT(s.code,' - ',s.subject) as subject_name
                                    FROM faculty_class_assignments a 
                                    LEFT JOIN faculty_list f ON a.faculty_id = f.id 
                                    LEFT JOIN class_list c ON a.class_id = c.id 
                                    LEFT JOIN subject_list s ON a.subject_id = s.id 
                                    ORDER BY f.firstname, f.lastname, 
                                        CASE 
                                            WHEN c.level LIKE '%12%' THEN 1
                                            WHEN c.level LIKE '%11%' THEN 2  
                                            WHEN c.level LIKE '%10%' THEN 3
                                            WHEN c.level LIKE '%9%' THEN 4
                                            WHEN c.level LIKE '%8%' THEN 5
                                            WHEN c.level LIKE '%7%' THEN 6
                                            ELSE 7
                                        END,
                                        c.curriculum, c.section
                                ");
                                
                                echo "<!-- Debug: Query executed -->";
                                
                                if(!$assignments) {
                                    echo "<tr><td colspan='5' class='text-center text-danger'>Database Error: " . $conn->error . "</td></tr>";
                                } elseif($assignments->num_rows == 0) {
                                    echo "<tr><td colspan='5' class='text-center text-muted'>No assignments found. Add some faculty assignments to get started.</td></tr>";
                                } else {
                                    echo "<!-- Debug: Found " . $assignments->num_rows . " assignments -->";
                                    while($row=$assignments->fetch_assoc()):
                                ?>
                                <tr>
                                    <td class="text-center"><?php echo $i++ ?></td>
                                    <td><?php echo ucwords($row['faculty_name']) ?></td>
                                    <td><?php echo $row['class_name'] ?></td>
                                    <td><?php echo $row['subject_name'] ?></td>
                                    <td class="text-center">
                                        <button class="btn btn-sm btn-outline-primary edit_assignment" type="button" data-id="<?php echo $row['id'] ?>" data-faculty_id="<?php echo $row['faculty_id'] ?>" data-class_id="<?php echo $row['class_id'] ?>" data-subject_id="<?php echo $row['subject_id'] ?>">Edit</button>
                                        <button class="btn btn-sm btn-outline-danger delete_assignment" type="button" data-id="<?php echo $row['id'] ?>">Delete</button>
                                    </td>
                                </tr>
                                <?php 
                                    endwhile;
                                }
                                echo "<!-- Debug: Query processing complete -->";
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- Table Panel -->
        </div>
    </div>    
</div>
<style>
    td{
        vertical-align: middle !important;
    }
    td p{
        margin: unset
    }
    img{
        max-width:100px;
        max-height: 150px;
    }
</style>
<script>
    $(document).ready(function(){
        $('.select2').select2({
            placeholder:"Please select here",
            width: "100%"
        });
        
        // Search functionality
        $('#faculty_search').on('keyup', function() {
            var value = $(this).val().toLowerCase();
            $("#assignments_table tbody tr").filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });
    })
    $('#manage-assignment').on('reset',function(){
        $('#message').html('')
    })
    $('#new_assignment').click(function(){
        // Clear the form for new entry
        $('#manage-assignment')[0].reset();
        $('#manage-assignment input[name="id"]').val('');
        $('.select2').val('').trigger('change');
        
        // Show success message
        alert_toast("Form cleared for new assignment", 'info');
    })
    // Use event delegation for dynamically loaded content
    $(document).on('click', '.edit_assignment', function(){
        var id = $(this).attr('data-id');
        var faculty_id = $(this).attr('data-faculty_id');
        var class_id = $(this).attr('data-class_id');
        var subject_id = $(this).attr('data-subject_id');
        
        // Populate form with existing data
        $('#manage-assignment input[name="id"]').val(id);
        $('#faculty_id').val(faculty_id).trigger('change');
        $('#class_id').val(class_id).trigger('change');
        $('#subject_id').val(subject_id).trigger('change');
        
        // Scroll to form
        $('html, body').animate({
            scrollTop: $("#manage-assignment").offset().top - 100
        }, 500);
        
        alert_toast("Assignment loaded for editing", 'info');
    });
    
    $(document).on('click', '.delete_assignment', function(){
        _conf("Are you sure to delete this assignment?","delete_assignment",[$(this).attr('data-id')])
    });
    $('#manage-assignment').submit(function(e){
        e.preventDefault()
        start_load()
        $.ajax({
            url:'ajax.php?action=save_faculty_assignment',
            data: new FormData($(this)[0]),
            cache: false,
            contentType: false,
            processData: false,
            method: 'POST',
            type: 'POST',
            success:function(resp){
                if(resp==1){
                    alert_toast("Data successfully added",'success')
                    setTimeout(function(){
                        location.reload()
                    },1500)

                }
                else if(resp==2){
                    alert_toast("Data successfully updated",'success')
                    setTimeout(function(){
                        location.reload()
                    },1500)

                }else if(resp==3){
                    alert_toast("Assignment already exists",'error')
                    end_load()
                }
            }
        })
    })
    function delete_assignment($id){
        start_load()
        $.ajax({
            url:'ajax.php?action=delete_faculty_assignment',
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
    function _reset(){
        $('#manage-assignment').get(0).reset()
        $('#manage-assignment input,#manage-assignment textarea').val('')
    }
</script>
