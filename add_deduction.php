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

// Check if data is received
if (isset( $_POST['description'], $_POST['amount'])) {
    $description = $conn->real_escape_string($_POST['description']);
    $amount = $conn->real_escape_string($_POST['amount']);
    
    // INSERT into employees table
    $sql = "INSERT INTO deduction ( description, amount) VALUES ( '$description', '$amount')";
    
    if ($conn->query($sql) === TRUE) {
        echo "Deduction added successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
} else {
    echo "Invalid data received.";
}

$conn->close();
?>
