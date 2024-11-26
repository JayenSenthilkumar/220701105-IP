<?php
// Database connection credentials
$servername = "localhost";
$username = "root";
$password = "";  // Adjust password based on your MySQL setup
$dbname = "employee";

// Create a connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Collect form data
$name = $_POST['name'];
$designation = $_POST['des'];//name attribute of the input form
$dept=$_POST['dept'];
$doj = $_POST['doj'];
$salary = $_POST['sal'];


// SQL query to insert data into Employee table
$sql = "INSERT INTO emp_details (ename, Desig, Dept, Doj,Salary) 
        VALUES ('$name', '$designation','$dept', '$doj', '$salary')";

// Execute the query and check if successful
if ($conn->query($sql) === TRUE) {
    echo "New employee record created successfully";
    echo "<br>";
    echo "<br>";
    echo "<a href='form.php'>Go back to the form</a>";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Close the connection
$conn->close();
?>
