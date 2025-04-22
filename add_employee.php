<?php
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

// Check if data is received
if (isset($_POST['emp_id'], $_POST['name'], $_POST['department'], $_POST['position'])) {
    $emp_id = $conn->real_escape_string($_POST['emp_id']);
    $name = $conn->real_escape_string($_POST['name']);
    $department = $conn->real_escape_string($_POST['department']);
    $position = $conn->real_escape_string($_POST['position']);

    // INSERT into employees table
    $sql = "INSERT INTO employees (emp_id, name, department, position) VALUES ('$emp_id', '$name', '$department', '$position')";
    
    if ($conn->query($sql) === TRUE) {
        echo "Employee added successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
} else {
    echo "Invalid data received.";
}

$conn->close();
?>
