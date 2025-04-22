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

// Fetch employees where position = 'ccis'
$sql = "SELECT * FROM employees WHERE department = 'ctas'";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CCIS Employees</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            text-align: center;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 80%;
            margin: 30px auto;
            background: #fff;
            padding: 20px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }
        h2 {
            color: #333;
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        th, td {
            padding: 12px;
            border: 1px solid #ddd;
            text-align: left;
        }
        th {
            background-color:rgb(107, 68, 107);
            color: white;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        tr:hover {
            background-color: #f1f1f1;
        }
        .back-btn {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 20px;
            background-color:rgb(107, 68, 107);
            color: white;
            text-decoration: none;
            border-radius: 5px;
            transition: background 0.3s;
        }
        .back-btn:hover {
            background-color:rgb(107, 68, 107);
        }
    </style>
</head>
<body>

    <div class="container">
        <h2>College of Technology and Allied Sciences Employees List</h2>
        <table>
            <tr>
                <th>Employee ID</th>
                <th>Name</th>
            </tr>
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["emp_id"] . "</td>";
                    echo "<td>" . $row["name"] . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='2'>No employees found</td></tr>";
            }
            ?>
        </table>
        <a href="/payroll/login/dashboard.html" class="back-btn">Back to Dashboard</a>
    </div>

</body>
</html>

<?php
$conn->close();
?>
