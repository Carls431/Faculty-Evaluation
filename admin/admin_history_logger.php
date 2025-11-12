<?php
// Session is already started in other files, so don't start it again
include_once 'db_connect.php';

class AdminHistoryLogger {
    private $db;
    
    public function __construct() {
        global $conn;
        $this->db = $conn;
    }
    
    /**
     * Log admin action to history
     */
    public function logAction($action_type, $action_description, $target_table = null, $target_id = null, $old_values = null, $new_values = null) {
        // Get admin info from session
        $admin_id = isset($_SESSION['login_id']) ? $_SESSION['login_id'] : 0;
        $admin_name = isset($_SESSION['login_name']) ? $_SESSION['login_name'] : 'Unknown';
        
        // Get client info
        $ip_address = $this->getClientIP();
        $user_agent = isset($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] : '';
        $session_id = session_id();
        
        // Convert arrays to JSON for storage
        $old_values_json = $old_values ? json_encode($old_values) : null;
        $new_values_json = $new_values ? json_encode($new_values) : null;
        
        $stmt = $this->db->prepare("INSERT INTO admin_history_logs 
            (admin_id, admin_name, action_type, action_description, target_table, target_id, 
             old_values, new_values, ip_address, user_agent, session_id) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
            
        $stmt->bind_param("issssssssss", 
            $admin_id, $admin_name, $action_type, $action_description, 
            $target_table, $target_id, $old_values_json, $new_values_json, 
            $ip_address, $user_agent, $session_id);
            
        return $stmt->execute();
    }
    
    /**
     * Log login attempt
     */
    public function logLogin($email, $success = true, $error_message = '') {
        $action_type = $success ? 'LOGIN_SUCCESS' : 'LOGIN_FAILED';
        $description = $success ? 
            "Admin logged in successfully with email: {$email}" : 
            "Failed login attempt for email: {$email}. Error: {$error_message}";
            
        return $this->logAction($action_type, $description);
    }
    
    /**
     * Log logout
     */
    public function logLogout() {
        $admin_name = isset($_SESSION['login_name']) ? $_SESSION['login_name'] : 'Unknown';
        $description = "Admin {$admin_name} logged out";
        
        return $this->logAction('LOGOUT', $description);
    }
    
    /**
     * Log data view/access
     */
    public function logDataAccess($table, $record_id, $description) {
        return $this->logAction('DATA_ACCESS', $description, $table, $record_id);
    }
    
    /**
     * Log data modification
     */
    public function logDataModification($table, $record_id, $action, $old_data = null, $new_data = null) {
        $description = "Modified {$table} record (ID: {$record_id}) - {$action}";
        return $this->logAction('DATA_MODIFY', $description, $table, $record_id, $old_data, $new_data);
    }
    
    /**
     * Log report generation/viewing
     */
    public function logReportAccess($action_type, $faculty_id, $faculty_name) {
        // New, more readable format
        $description = "Printed report for {$faculty_name} - ID: {$faculty_id}";
        
        // Call the generic log function
        return $this->logAction($action_type, $description, 'faculty_list', $faculty_id);
    }
    
    /**
     * Get client IP address
     */
    private function getClientIP() {
        $ip = '';
        if (isset($_SERVER['HTTP_CLIENT_IP'])) {
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } elseif (isset($_SERVER['HTTP_X_FORWARDED'])) {
            $ip = $_SERVER['HTTP_X_FORWARDED'];
        } elseif (isset($_SERVER['HTTP_FORWARDED_FOR'])) {
            $ip = $_SERVER['HTTP_FORWARDED_FOR'];
        } elseif (isset($_SERVER['HTTP_FORWARDED'])) {
            $ip = $_SERVER['HTTP_FORWARDED'];
        } elseif (isset($_SERVER['REMOTE_ADDR'])) {
            $ip = $_SERVER['REMOTE_ADDR'];
        }
        return $ip;
    }
    
    /**
     * Get history logs with pagination and filtering
     */
    public function getHistoryLogs($limit = 50, $offset = 0, $admin_id = null, $action_type = null, $date_from = null, $date_to = null) {
        $where_conditions = [];
        $params = [];
        $param_types = '';
        
        if ($admin_id) {
            $where_conditions[] = "admin_id = ?";
            $params[] = $admin_id;
            $param_types .= 'i';
        }
        
        if ($action_type) {
            $where_conditions[] = "action_type = ?";
            $params[] = $action_type;
            $param_types .= 's';
        }
        
        if ($date_from) {
            $where_conditions[] = "timestamp >= ?";
            $params[] = $date_from;
            $param_types .= 's';
        }
        
        if ($date_to) {
            $where_conditions[] = "timestamp <= ?";
            $params[] = $date_to;
            $param_types .= 's';
        }
        
        $where_clause = !empty($where_conditions) ? "WHERE " . implode(" AND ", $where_conditions) : "";
        
        $sql = "SELECT * FROM admin_history_logs {$where_clause} ORDER BY timestamp DESC LIMIT ? OFFSET ?";
        $params[] = $limit;
        $params[] = $offset;
        $param_types .= 'ii';
        
        $stmt = $this->db->prepare($sql);
        if (!empty($params)) {
            $stmt->bind_param($param_types, ...$params);
        }
        
        $stmt->execute();
        $result = $stmt->get_result();
        
        return $result->fetch_all(MYSQLI_ASSOC);
    }
    
    /**
     * Get total count of logs for pagination
     */
    public function getLogsCount($admin_id = null, $action_type = null, $date_from = null, $date_to = null) {
        $where_conditions = [];
        $params = [];
        $param_types = '';
        
        if ($admin_id) {
            $where_conditions[] = "admin_id = ?";
            $params[] = $admin_id;
            $param_types .= 'i';
        }
        
        if ($action_type) {
            $where_conditions[] = "action_type = ?";
            $params[] = $action_type;
            $param_types .= 's';
        }
        
        if ($date_from) {
            $where_conditions[] = "timestamp >= ?";
            $params[] = $date_from;
            $param_types .= 's';
        }
        
        if ($date_to) {
            $where_conditions[] = "timestamp <= ?";
            $params[] = $date_to;
            $param_types .= 's';
        }
        
        $where_clause = !empty($where_conditions) ? "WHERE " . implode(" AND ", $where_conditions) : "";
        
        $sql = "SELECT COUNT(*) as total FROM admin_history_logs {$where_clause}";
        
        $stmt = $this->db->prepare($sql);
        if (!empty($params)) {
            $stmt->bind_param($param_types, ...$params);
        }
        
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        
        return $row['total'];
    }
    
    /**
     * Method to get paginated history logs
     */
    public function getPaginatedLogs($page = 1, $limit = 15, $filters = []) {
        $offset = ($page - 1) * $limit;
        $logs = $this->getHistoryLogs($limit, $offset, $filters['admin_id'] ?? null, $filters['action_type'] ?? null, $filters['date_from'] ?? null, $filters['date_to'] ?? null);
        $total_logs = $this->getLogsCount($filters['admin_id'] ?? null, $filters['action_type'] ?? null, $filters['date_from'] ?? null, $filters['date_to'] ?? null);
        $total_pages = ceil($total_logs / $limit);
        
        return [
            'logs' => $logs,
            'total_logs' => $total_logs,
            'total_pages' => $total_pages,
            'current_page' => $page,
        ];
    }
}

// Create global instance for easy access
$historyLogger = new AdminHistoryLogger();
?>
