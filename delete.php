<?php
// delete.php
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


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $emp_id = $_POST['emp_id'];

    $sql = "UPDATE employees SET deleted_at = NOW() WHERE emp_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $emp_id);

    if ($stmt->execute()) {
        echo "Employee marked as deleted.";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
