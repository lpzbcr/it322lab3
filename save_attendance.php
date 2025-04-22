<?php
// save_attendance.php

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "payroll";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Collect data from POST request
$id = isset($_POST['id']) ? $_POST['id'] : '';
$time_out = isset($_POST['time_out']) ? $_POST['time_out'] : null; // Allow null for time_out

// Validate input data
if (empty($id)) {
    echo json_encode(["error" => "Employee ID is required."]);
    exit;
}

// Prepare and bind
$stmt = $conn->prepare("UPDATE attendance SET time_out = ? WHERE id = ?");
$stmt->bind_param("ss", $time_out, $id);

// Execute the statement
if ($stmt->execute()) {
    echo json_encode(["success" => "Time out saved successfully!"]);
} else {
    error_log("Error updating time out: " . $stmt->error);
    echo json_encode(["error" => "Error updating time out: " . $stmt->error]);
}

// Close the statement and connection
$stmt->close();
$conn->close();
?>
