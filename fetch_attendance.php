<?php
// Fetch attendance data from the database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "payroll";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT id, name, time_in, time_out FROM attendance";
$result = $conn->query($sql);

$attendanceData = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $attendanceData[] = $row;
    }
}

echo json_encode($attendanceData);
$conn->close();
?>
