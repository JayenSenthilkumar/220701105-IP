<?php
$servername="localhost";
$username="root";
$password="";
$dbname="employee";

$conn=new mysqli($servername,$username,$password,$dbname);

if($conn->connect_error){
    die("Connection failed : ". $conn->connect_error);
}

if (isset($_GET['emp_id'])) {
    $empid = $_GET['emp_id'];
    $sql = "SELECT * FROM emp_details WHERE emp_id = '$empid'";
} else {
    $sql = "SELECT * FROM emp_details";
}
$result=$conn->query($sql);

if($result->num_rows>0){
    echo "<h2>Employee Details</h2>";
    echo "<br>";
    echo "<br>";
    echo "<table border='1'>
          <tr>
          <th>Employee ID </th>
          <th>Employee Name</th>
          <th>Designation</th>
          <th>Department</th>
          <th>Date of Joining</th>
          <th>Salary</th>
          </tr>";
    while($row=$result->fetch_assoc()){
        echo "<tr>
              <td>{$row['emp_id']}</td>
              <td>{$row['ename']}</td>
              <td>{$row['Desig']}</td>
              <td>{$row['Dept']}</td>
              <td>{$row['Doj']}</td>
              <td>{$row['Salary']}</td>
            </tr>";
    }
     echo "</table>";
     echo "<br>";
     echo "<br>";
     echo "<a href='form.php'>Go back to the form</a>";
}
else{
    echo "No records found.";
    echo "<br>";
    echo "<br>";
    echo "<a href='form.php'>Go back to the form</a>";
}
?>

