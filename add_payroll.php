<?php
$conn = new mysqli("localhost", "root", "", "payroll");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $employee_id = $_POST['employee_id'];
    $date_from = $_POST['date_from'];
    $date_to = $_POST['date_to'];
    $total_hours = $_POST['total_hours'];
    
    // Fetch rates
    $res = $conn->query("SELECT daily_rate, hourly_rate FROM employees WHERE id=$employee_id");
    $emp = $res->fetch_assoc();
    
    $gross_pay = $total_hours * $emp['hourly_rate'];
    $deductions = $gross_pay * 0.10; // Example: 10% deductions
    $net_pay = $gross_pay - $deductions;
    
    $sql = "INSERT INTO payroll (employee_id, date_from, date_to, total_hours, gross_pay, deductions, net_pay, status) 
            VALUES ($employee_id, '$date_from', '$date_to', $total_hours, $gross_pay, $deductions, $net_pay, 'Calculated')";
    
    if ($conn->query($sql) === TRUE) {
        echo "Payroll added successfully!";
    } else {
        echo "Error: " . $conn->error;
    }
}
?>

<form method="post">
    Employee: 
    <select name="emp_id">
        <?php
        $res = $conn->query("SELECT * FROM employees");
        while ($emp = $res->fetch_assoc()) {
            echo "<option value='{$emp['id']}'>{$emp['name']}</option>";
        }
        ?>
    </select><br>
    Date From: <input type="date" name="date_from" required><br>
    Date To: <input type="date" name="date_to" required><br>
    Total Hours: <input type="number" name="total_hours" required><br>
    <button type="submit">Add Payroll</button>
</form>
