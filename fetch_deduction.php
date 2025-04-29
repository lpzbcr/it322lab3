<?php
// Enable error reporting
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Database configuration
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "payroll";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die(json_encode(["error" => "Connection failed: " . $conn->connect_error]));
}

// Fetch deductions from the database
$sql = "SELECT id, emp_id, description, amount FROM deductions";
$result = $conn->query($sql);

$deductions = [];

if ($result->num_rows > 0) {
    // Output data of each row
    while($row = $result->fetch_assoc()) {
        $deductions[] = $row;
    }
} else {
    echo json_encode(["error" => "No deductions found"]);
    exit;
}

// Close the database connection
$conn->close();

// Return the deductions as JSON
header('Content-Type: application/json');
echo json_encode($deductions);
?>
