<?php
include 'db_connect.php';

// Add role column to faculty_list table
$sql = "ALTER TABLE faculty_list ADD COLUMN role ENUM('Subject Teacher', 'Adviser', 'Both') DEFAULT 'Subject Teacher' AFTER gender";

if ($conn->query($sql) === TRUE) {
    echo "Role column added successfully to faculty_list table!";
} else {
    echo "Error adding role column: " . $conn->error;
}

$conn->close();
?>
