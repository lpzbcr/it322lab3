<?php
header('Content-Type: application/json');
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "payroll";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die(json_encode(["error" => "Database connection failed: " . $conn->connect_error]));
}

if (isset($_GET['emp_id']) && !empty($_GET['emp_id'])) {
    $emp_id = $conn->real_escape_string($_GET['emp_id']);

    $sql = "SELECT * FROM attendance WHERE id = '$emp_id'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo json_encode($result->fetch_assoc());
    } else {
        echo json_encode(["error" => "No record found for ID $emp_id"]);
    }
} else {
    echo json_encode(["error" => "Invalid request: Employee ID missing"]);
}

$conn->close();
?>
