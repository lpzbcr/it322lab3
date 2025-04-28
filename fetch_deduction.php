<?php
// Database configuration
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

// Check if employee_id or payroll_id is passed
$employee_id = isset($_GET['employee_id']) ? intval($_GET['employee_id']) : 0;
$payroll_id = isset($_GET['payroll_id']) ? intval($_GET['payroll_id']) : 0;

// Initialize SQL
$sql = "SELECT * FROM deduction";
$conditions = [];

if ($employee_id > 0) {
    $conditions[] = "employee_id = $employee_id";
}
if ($payroll_id > 0) {
    $conditions[] = "payroll_id = $payroll_id";
}

// Add WHERE clause if needed
if (!empty($conditions)) {
    $sql .= " WHERE " . implode(" AND ", $conditions);
}

$result = $conn->query($sql);

$deductions = [];

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $deductions[] = $row;
    }
}

// Close the database connection
$conn->close();

// Set the content type to JSON
header('Content-Type: application/json');

// Return the deductions as JSON
echo json_encode($deductions);
?>

