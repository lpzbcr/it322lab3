<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "payroll";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die(json_encode(["error" => "Database connection failed"]));
}

if (isset($_GET['emp_id'])) {
    $emp_id = intval($_GET['emp_id']);
    $sql = "SELECT * FROM attendance WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $emp_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        echo json_encode($result->fetch_assoc());
    } else {
        echo json_encode(["error" => "No record found"]);
    }

    $stmt->close();
} else {
    echo json_encode(["error" => "Invalid request"]);
}

$conn->close();
?>
