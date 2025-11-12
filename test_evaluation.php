<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

echo "<h2>Evaluation Submission Diagnostic Test</h2>";

// Test 1: Check session
echo "<h3>1. Session Check:</h3>";
if(isset($_SESSION['login_id']) && isset($_SESSION['academic']['id'])) {
    echo "✅ Session OK - Student ID: " . $_SESSION['login_id'] . ", Academic ID: " . $_SESSION['academic']['id'] . "<br>";
} else {
    echo "❌ Session Missing - Please login first<br>";
    echo "Available session keys: " . implode(', ', array_keys($_SESSION)) . "<br>";
}

// Test 2: Check database connection
echo "<h3>2. Database Connection:</h3>";
include 'db_connect.php';
if($conn) {
    echo "✅ Database connected successfully<br>";
    
    // Test query
    $test = $conn->query("SELECT COUNT(*) as count FROM evaluation_list");
    if($test) {
        $row = $test->fetch_assoc();
        echo "✅ Database query works - Found " . $row['count'] . " evaluations<br>";
    } else {
        echo "❌ Database query failed: " . $conn->error . "<br>";
    }
} else {
    echo "❌ Database connection failed<br>";
}

// Test 3: Check if admin_class.php loads
echo "<h3>3. Admin Class Check:</h3>";
try {
    include 'admin_class.php';
    $crud = new Action();
    echo "✅ Admin class loaded successfully<br>";
} catch(Exception $e) {
    echo "❌ Admin class error: " . $e->getMessage() . "<br>";
}

// Test 4: Simulate AJAX request
echo "<h3>4. AJAX Simulation Test:</h3>";
if(isset($_SESSION['login_id'])) {
    $_POST = array(
        'academic_id' => $_SESSION['academic']['id'] ?? 1,
        'subject_id' => 1,
        'class_id' => $_SESSION['login_class_id'] ?? 1,
        'restriction_id' => 1,
        'faculty_id' => 1,
        'qid' => array(1, 2),
        'rate' => array(1 => 5, 2 => 4),
        'comment' => 'Test comment'
    );
    
    try {
        $result = $crud->save_evaluation();
        echo "✅ save_evaluation() returned: " . var_export($result, true) . "<br>";
    } catch(Exception $e) {
        echo "❌ save_evaluation() error: " . $e->getMessage() . "<br>";
    }
} else {
    echo "❌ Cannot test - no session<br>";
}

// Test 5: Check AJAX endpoint directly
echo "<h3>5. AJAX Endpoint Test:</h3>";
echo "<button onclick='testAjax()'>Test AJAX Call</button>";
echo "<div id='ajax-result'></div>";

?>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
function testAjax() {
    $('#ajax-result').html('Testing...');
    
    $.ajax({
        url: 'ajax.php?action=save_evaluation',
        method: 'POST',
        data: {
            academic_id: <?php echo $_SESSION['academic']['id'] ?? 1; ?>,
            subject_id: 1,
            class_id: <?php echo $_SESSION['login_class_id'] ?? 1; ?>,
            restriction_id: 1,
            faculty_id: 1,
            qid: [1, 2],
            rate: {1: 5, 2: 4},
            comment: 'Test comment'
        },
        success: function(resp) {
            $('#ajax-result').html('✅ AJAX Success: ' + resp);
        },
        error: function(xhr, status, error) {
            $('#ajax-result').html('❌ AJAX Error: ' + error + '<br>Status: ' + status + '<br>Response: ' + xhr.responseText);
        }
    });
}
</script>
