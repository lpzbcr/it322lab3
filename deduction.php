<?php
// Enable error reporting
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Database configuration
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "your_database_name";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die(json_encode(["error" => "Connection failed: " . $conn->connect_error]));
}

// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $emp_id = isset($_POST['emp_id']) ? $_POST['emp_id'] : null;
    $description = isset($_POST['description']) ? $_POST['description'] : null;
    $amount = isset($_POST['amount']) ? $_POST['amount'] : null;

    // Validate input
    if (!$emp_id || !$description || !$amount) {
        echo json_encode(["error" => "Missing required fields"]);
        exit;
    }

    // Sanitize input
    $emp_id = $conn->real_escape_string($emp_id);
    $description = $conn->real_escape_string($description);
    $amount = $conn->real_escape_string($amount);

    // Insert deduction into the database
    $sql = "INSERT INTO deductions (emp_id, description, amount) VALUES ('$emp_id', '$description', '$amount')";

    if ($conn->query($sql) === TRUE) {
        echo json_encode(["success" => "Deduction added successfully"]);
    } else {
        echo json_encode(["error" => "Error: " . $conn->error]);
    }

    // Close the database connection
    $conn->close();
} else {
    echo json_encode(["error" => "Invalid request method"]);
}
?>
