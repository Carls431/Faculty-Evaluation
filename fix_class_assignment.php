<?php
include 'db_connect.php';

echo "<h2>Fix: Class Assignment for ESP-10</h2>";

// The problematic restriction ID for ESP-10 in wrong class
$wrong_restriction_id = 40; // ESP-10 in Class ID: 9 (10 - GOLD)
$correct_class_id = 7; // Fernando's class (10 - CARNELIAN)

echo "<h3>Current Problem:</h3>";
echo "ESP-10 - G10- Values is assigned to Class 10 - GOLD (ID: 9)<br>";
echo "But Fernando is in Class 10 - CARNELIAN (ID: 7)<br><br>";

echo "<h3>Solution Options:</h3>";

echo "<h4>Option 1: Update the restriction to correct class</h4>";
$update_query = "UPDATE restriction_list 
                 SET class_id = $correct_class_id 
                 WHERE id = $wrong_restriction_id";

echo "SQL: <code>$update_query</code><br>";
echo "<button onclick=\"executeUpdate()\">Execute Update</button><br><br>";

echo "<h4>Option 2: Delete the wrong restriction</h4>";
$delete_query = "DELETE FROM restriction_list WHERE id = $wrong_restriction_id";
echo "SQL: <code>$delete_query</code><br>";
echo "<button onclick=\"executeDelete()\">Execute Delete</button><br><br>";

echo "<h3>Manual Fix:</h3>";
echo "Go to Admin → Evaluation Restrictions and:<br>";
echo "1. Remove Ryan Jim Bachinela from Class 10 - GOLD for ESP-10<br>";
echo "2. Add Ryan Jim Bachinela to Class 10 - CARNELIAN for ESP-10<br>";
echo "3. This will ensure Fernando only sees teachers assigned to his class<br>";

?>

<script>
function executeUpdate() {
    if(confirm('Update ESP-10 restriction to Fernando\'s class?')) {
        fetch('', {
            method: 'POST',
            headers: {'Content-Type': 'application/x-www-form-urlencoded'},
            body: 'action=update'
        }).then(response => response.text())
          .then(data => {
              alert('Update completed');
              location.reload();
          });
    }
}

function executeDelete() {
    if(confirm('Delete the wrong ESP-10 restriction?')) {
        fetch('', {
            method: 'POST',
            headers: {'Content-Type': 'application/x-www-form-urlencoded'},
            body: 'action=delete'
        }).then(response => response.text())
          .then(data => {
              alert('Delete completed');
              location.reload();
          });
    }
}
</script>

<?php
if(isset($_POST['action'])) {
    if($_POST['action'] == 'update') {
        if($conn->query($update_query)) {
            echo "<div style='color: green;'>✓ Updated restriction to correct class</div>";
        } else {
            echo "<div style='color: red;'>✗ Error: " . $conn->error . "</div>";
        }
    } elseif($_POST['action'] == 'delete') {
        if($conn->query($delete_query)) {
            echo "<div style='color: green;'>✓ Deleted wrong restriction</div>";
        } else {
            echo "<div style='color: red;'>✗ Error: " . $conn->error . "</div>";
        }
    }
}
?>
