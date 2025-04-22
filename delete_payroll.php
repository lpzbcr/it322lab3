<?php
$conn = new mysqli("localhost", "root", "", "payroll");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $sql = "DELETE FROM payroll WHERE id=$id";
    
    if ($conn->query($sql) === TRUE) {
        echo "Payroll deleted successfully!";
    } else {
        echo "Error: " . $conn->error;
    }
}
?>
