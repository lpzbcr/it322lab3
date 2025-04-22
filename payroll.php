<?php
header('Content-Type: application/json');

// Enable error reporting
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "payroll";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Include your database connection file
// Query to fetch payroll data
$sql = "SELECT id, name, daily_rate, hour_rate, deductions, gross_pay, net_pay FROM payroll";
$result = $conn->query($sql);

$data = [];
if ($result) {
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
} else {
    // Log the error for debugging
    error_log('Query failed: ' . $conn->error);
}

echo json_encode($data);
$conn->close();
?>