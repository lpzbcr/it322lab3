<?php
// mark_as_deleted.php

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "payroll";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Collect data from POST request
$emp_id = isset($_POST['emp_id']) ? $_POST['emp_id'] : '';

// Validate input data
if (empty($emp_id)) {
    echo json_encode(["error" => "Employee ID is required."]);
    exit;
}

// Update the record as deleted
$stmt = $conn->prepare("UPDATE employees SET deleted_at = NOW() WHERE emp_id = ?");
$stmt->bind_param("s", $id);

// Execute the statement
if ($stmt->execute()) {
    echo json_encode(["success" => "Record marked as deleted."]);
} else {
    echo json_encode(["error" => "Error marking record as deleted: " . $stmt->error]);
}

$stmt->close();
$conn->close();
?>
