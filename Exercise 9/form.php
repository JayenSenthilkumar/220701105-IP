<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
    div{
        border: 2px solid black;
        text-align:center;
        margin:50px 50px;
        padding:30px;
    }
    </style>
</head>
<body>
    <div>
    <h2>Employee Details</h2>
    <form action="emp.php" method="POST">
        <label for="name">Name :</label>
        <input type="text" id="name" name="name" required><br><br>

        <label for="des">Designation :</label>
        <input type="text" id="des" name="des" required><br><br>

        <label for="dept">Department :</label>
        <input type="text" id="dept" name="dept" required><br><br>

        <label for="doj">Date of Joining</label>
        <input type="date" id="doj" name="doj" required><br><br>

        <label for="sal">Salary</label>
        <input type="text" id="sal" name="sal" required><br><br>

        <input type="submit" value="submit">
    </form>
    <br>
    <br>
    <h2>View Detail of particular ID</h2>
    <form action="view.php" method="GET">
    <label for="emp_id">Employee ID</label>
    <input type="text" id="emp_id"name="emp_id"><br><br>
    <input type="submit" value="submit">
    </form>

    <br>
    <h2>View Employee Details</h2>
    <a href="view.php">View Details</a>
</div>
</body>
</html>