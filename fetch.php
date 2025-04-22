<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "payroll";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM `employees`";
$result = $conn->query($sql);

$employees = array();
while ($row = $result->fetch_assoc()) {
    $employees[] = $row;
}

echo json_encode($employees);

$conn->close();
?>

