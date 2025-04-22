<?php
// fetch_deleted.php

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "payroll";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    // Return a JSON error response if the connection fails
    header('Content-Type: application/json');
    echo json_encode(["error" => "Connection failed: " . $conn->connect_error]);
    exit;
}

// Fetch deleted records
$sql = "SELECT emp_id, name, date, department, position, deleted_at FROM employees WHERE deleted_at IS NOT NULL";
$result = $conn->query($sql);

if (!$result) {
    // Return a JSON error response if the query fails
    header('Content-Type: application/json');
    echo json_encode(["error" => "Error executing query: " . $conn->error]);
    $conn->close();
    exit;
}

$deletedData = [];
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $deletedData[] = $row;
    }
}

// Return data as JSON
header('Content-Type: application/json');
echo json_encode($deletedData);

$conn->close();
?>
