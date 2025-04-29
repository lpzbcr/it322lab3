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

// Check if the deduction ID is received
if (isset($_POST['id'])) {
    $id = intval($_POST['id']); // Ensure the ID is an integer

    // Prepare and bind
    $stmt = $conn->prepare("DELETE FROM deductions WHERE id = ?");
    $stmt->bind_param("i", $id);

    // Execute the statement
    if ($stmt->execute()) {
        echo "Deduction deleted successfully.";
    } else {
        echo "Error deleting deduction: " . $stmt->error;
    }

    // Close the statement
    $stmt->close();
} else {
    echo "Invalid or missing deduction ID.";
}

// Close the connection
$conn->close();
?>
