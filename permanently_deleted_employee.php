<?php
// permanently_delete_employee.php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "payroll";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $emp_id = $_POST['emp_id'];

    $sql = "DELETE FROM employees WHERE emp_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $emp_id);

    if ($stmt->execute()) {
        echo "Employee permanently deleted.";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
