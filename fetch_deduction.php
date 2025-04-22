<?php
// Database configuration
$servername = "localhost"; // Replace with your database server name
$username = "root";        // Replace with your database username
$password = "";            // Replace with your database password
$dbname = "payroll";    // Replace with your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// SQL query to fetch deductions
$sql = "SELECT * FROM deduction";
$result = $conn->query($sql);

$deductions = [];

if ($result->num_rows > 0) {
    // Output data of each row
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
