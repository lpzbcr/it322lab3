<?php
$servername = "localhost"; // Change if needed
$username = "root"; // Change if needed
$password = ""; // Change if needed
$dbname = "payroll"; // Your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle request
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $action = $_POST['action'];

    if ($action === "add") {
        // Add deduction
        $description = $_POST['description'];
        $amount = $_POST['amount'];

        if (!empty($description) && is_numeric($amount) && $amount > 0) {
            $stmt = $conn->prepare("INSERT INTO deduction (description, amount) VALUES (?, ?)");
            $stmt->bind_param("sd", $description, $amount);
            if ($stmt->execute()) {
                echo "Deduction added successfully.";
            } else {
                echo "Error adding deduction.";
            }
            $stmt->close();
        } else {
            echo "Invalid input.";
        }
    } elseif ($action === "delete") {
        // Delete deduction
        $id = $_POST['id'];

        if (!empty($id) && is_numeric($id)) {
            $stmt = $conn->prepare("DELETE FROM deduction WHERE id = ?");
            $stmt->bind_param("i", $id);
            if ($stmt->execute()) {
                echo "Deduction deleted successfully.";
            } else {
                echo "Error deleting deduction.";
            }
            $stmt->close();
        } else {
            echo "Invalid ID.";
        }
    }
}

// Fetch all deductions (for display)
if ($_SERVER["REQUEST_METHOD"] === "GET") {
    $result = $conn->query("SELECT * FROM deduction ORDER BY id DESC");
    $deduction = [];

    while ($row = $result->fetch_assoc()) {
        $deduction[] = $row;
    }

    echo json_encode($deduction);
}

$conn->close();
?>
