<?php include 'db_connect.php' ?>
<?php 
// Include the history logger and initialize it properly
include_once 'admin_history_logger.php';

// Initialize the logger after including the file
if (class_exists('AdminHistoryLogger')) {
    $historyLogger = new AdminHistoryLogger();
} else {
    echo "<div class='alert alert-danger'>AdminHistoryLogger class not found!</div>";
    exit;
}
?>
<div class="col-lg-12">
    <div class="card card-outline card-success">
        <div class="card-header">
            <h4 class="card-title"><B>Admin History Logs</B></h4>
        </div>
        <div class="card-body">
            <!-- Filter Section -->
            <div class="row mb-3">
                <div class="col-md-3">
                    <label>Filter by Admin:</label>
                    <select class="form-control" id="filter_admin">
                        <option value="">All Admins</option>
                        <?php
                        $admins = $conn->query("SELECT id, CONCAT(firstname, ' ', lastname) as name FROM users ORDER BY firstname");
                        while($admin = $admins->fetch_assoc()):
                        ?>
                        <option value="<?php echo $admin['id'] ?>"><?php echo $admin['name'] ?></option>
                        <?php endwhile; ?>
                    </select>
                </div>
                <div class="col-md-3">
                    <label>Filter by Action:</label>
                    <select class="form-control" id="filter_action">
                        <option value="">All Actions</option>
                        <option value="LOGIN_SUCCESS">Login Success</option>
                        <option value="LOGIN_FAILED">Login Failed</option>
                        <option value="LOGOUT">Logout</option>
                        <option value="DATA_ACCESS">Data Access</option>
                        <option value="DATA_MODIFY">Data Modify</option>
                        <option value="REPORT_ACCESS">Report Access</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <label>From Date:</label>
                    <input type="date" class="form-control" id="filter_date_from">
                </div>
                <div class="col-md-2">
                    <label>To Date:</label>
                    <input type="date" class="form-control" id="filter_date_to">
                </div>
                <div class="col-md-2">
                    <label>&nbsp;</label>
                    <button class="btn btn-primary btn-block" onclick="filterLogs()">Filter</button>
                </div>
            </div>

            <!-- History Logs Table -->
            <div class="table-responsive">
                <table class="table table-hover table-bordered" id="list">
                    <thead>
                        <tr>
                            <th class="text-center">#</th>
                            <th>Timestamp</th>
                            <th>Admin</th>
                            <th>Action Type</th>
                            <th>Description</th>
                            <th>IP Address</th>
                            <th>Details</th>
                        </tr>
                    </thead>
                    <tbody id="logs_tbody">
                        <?php 
                        // Get filter parameters
                        $admin_filter = isset($_GET['admin_id']) ? $_GET['admin_id'] : null;
                        $action_filter = isset($_GET['action_type']) ? $_GET['action_type'] : null;
                        $date_from = isset($_GET['date_from']) ? $_GET['date_from'] : null;
                        $date_to = isset($_GET['date_to']) ? $_GET['date_to'] : null;
                        $page = isset($_GET['log_page']) ? (int)$_GET['log_page'] : 1;
                        $limit = 20;
                        $offset = ($page - 1) * $limit;
                        
                        // Get logs using the properly initialized logger
                        try {
                            $logs = $historyLogger->getHistoryLogs($limit, $offset, $admin_filter, $action_filter, $date_from, $date_to);
                            $total_logs = $historyLogger->getLogsCount($admin_filter, $action_filter, $date_from, $date_to);
                        } catch (Exception $e) {
                            echo "<tr><td colspan='7' class='text-center text-danger'>Error loading logs: " . $e->getMessage() . "</td></tr>";
                            $logs = [];
                            $total_logs = 0;
                        }
                        
                        $i = $offset + 1;
                        foreach($logs as $row):
                        ?>
                        <tr>
                            <td class="text-center"><?php echo $i++ ?></td>
                            <td><?php echo date('M d, Y h:i A', strtotime($row['timestamp'])) ?></td>
                            <td><?php echo $row['admin_name'] ?></td>
                            <td>
                                <span class="badge badge-<?php 
                                    echo $row['action_type'] == 'LOGIN_SUCCESS' ? 'success' : 
                                        ($row['action_type'] == 'LOGIN_FAILED' ? 'danger' : 
                                        ($row['action_type'] == 'LOGOUT' ? 'warning' : 
                                        ($row['action_type'] == 'DATA_MODIFY' ? 'info' : 'secondary')));
                                ?>">
                                    <?php echo str_replace('_', ' ', $row['action_type']) ?>
                                </span>
                            </td>
                            <td><?php echo $row['action_description'] ?></td>
                            <td><?php echo $row['ip_address'] ?></td>
                            <td>
                                <button class="btn btn-sm btn-outline-info" onclick="viewDetails(<?php echo $row['id'] ?>)">
                                    <i class="fa fa-eye"></i> View
                                </button>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                        
                        <?php if(empty($logs)): ?>
                        <tr>
                            <td colspan="7" class="text-center text-muted">No history logs found. Start using the system to see logs appear here!</td>
                        </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <?php if($total_logs > $limit): ?>
            <div class="row">
                <div class="col-md-12">
                    <nav aria-label="History logs pagination">
                        <ul class="pagination justify-content-center">
                            <?php
                            $total_pages = ceil($total_logs / $limit);
                            $current_params = $_GET;
                            
                            // Previous button
                            if($page > 1):
                                $current_params['log_page'] = $page - 1;
                                $prev_url = '?' . http_build_query($current_params);
                            ?>
                            <li class="page-item">
                                <a class="page-link" href="<?php echo $prev_url ?>">Previous</a>
                            </li>
                            <?php endif; ?>
                            
                            <?php
                            // Page numbers
                            for($p = max(1, $page - 2); $p <= min($total_pages, $page + 2); $p++):
                                $current_params['log_page'] = $p;
                                $page_url = '?' . http_build_query($current_params);
                            ?>
                            <li class="page-item <?php echo $p == $page ? 'active' : '' ?>">
                                <a class="page-link" href="<?php echo $page_url ?>"><?php echo $p ?></a>
                            </li>
                            <?php endfor; ?>
                            
                            <?php
                            // Next button
                            if($page < $total_pages):
                                $current_params['log_page'] = $page + 1;
                                $next_url = '?' . http_build_query($current_params);
                            ?>
                            <li class="page-item">
                                <a class="page-link" href="<?php echo $next_url ?>">Next</a>
                            </li>
                            <?php endif; ?>
                        </ul>
                    </nav>
                </div>
            </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<!-- Details Modal -->
<div class="modal fade" id="detailsModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Log Details</h5>
                <button type="button" class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <div class="modal-body" id="modal_body">
                <!-- Details will be loaded here -->
            </div>
        </div>
    </div>
</div>

<style>
.table th {
    background-color: #f8f9fa;
    font-weight: 600;
}
.badge {
    font-size: 0.75em;
}
</style>

<script>
function filterLogs() {
    const admin_id = document.getElementById('filter_admin').value;
    const action_type = document.getElementById('filter_action').value;
    const date_from = document.getElementById('filter_date_from').value;
    const date_to = document.getElementById('filter_date_to').value;
    
    let url = '?page=history_logs';
    if(admin_id) url += '&admin_id=' + admin_id;
    if(action_type) url += '&action_type=' + action_type;
    if(date_from) url += '&date_from=' + date_from;
    if(date_to) url += '&date_to=' + date_to;
    
    window.location.href = url;
}

function viewDetails(log_id) {
    $.ajax({
        url: 'ajax.php?action=get_log_details',
        method: 'POST',
        data: {log_id: log_id},
        success: function(resp) {
            $('#modal_body').html(resp);
            $('#detailsModal').modal('show');
        }
    });
}
</script>
<?php include 'admin_footer.php'; ?>