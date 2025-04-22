<?php
// save_attendance.php

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
$id = isset($_POST['id']) ? $_POST['id'] : '';
$name = isset($_POST['name']) ? $_POST['name'] : '';
$date = isset($_POST['date']) ? $_POST['date'] : '';
$time_in = isset($_POST['time_in']) ? $_POST['time_in'] : '';
$time_out = isset($_POST['time_out']) ? $_POST['time_out'] : null; // Allow null for time_out

// Validate input data
if (empty($id) || empty($name) || empty($date) || empty($time_in)) {
    echo json_encode(["error" => "All fields except time out are required."]);
    exit;
}

// Prepare and bind
$stmt = $conn->prepare("INSERT INTO attendance (id, name, date, time_in, time_out) VALUES (?, ?, ?, ?, ?)");
$stmt->bind_param("sssss", $id, $name, $date, $time_in, $time_out);

// Execute the statement
if ($stmt->execute()) {
    echo json_encode(["success" => "Attendance saved successfully!"]);
} else {
    echo json_encode(["error" => "Error saving attendance: " . $stmt->error]);
}

// Close the statement and connection
$stmt->close();
$conn->close();
?>
