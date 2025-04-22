<?php
// Database connection
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

// Collect data from POST request
$data = json_decode(file_get_contents("php://input"), true);
$id = isset($data['id']) ? $data['id'] : '';
$description = isset($data['description']) ? $data['description'] : '';
$amount = isset($data['amount']) ? $data['amount'] : '';

// Validate input data
if (empty($id) || empty($description) || !is_numeric($amount) || $amount <= 0) {
    echo json_encode(["error" => "Invalid input data."]);
    exit;
}

// Prepare and bind
$stmt = $conn->prepare("INSERT INTO deduction (id, description, amount) VALUES (?, ?, ?)");
$stmt->bind_param("ssd", $id, $description, $amount);

// Execute the statement
if ($stmt->execute()) {
    echo json_encode(["success" => "Deduction saved successfully!"]);
} else {
    error_log("Error saving deduction: " . $stmt->error);
    echo json_encode(["error" => "Error saving deduction: " . $stmt->error]);
}

// Close the statement and connection
$stmt->close();
$conn->close();
?>
