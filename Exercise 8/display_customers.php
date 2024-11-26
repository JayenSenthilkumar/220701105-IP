<?php
include 'db_connect.php';

// Fetch and display customer information
$sql = "SELECT * FROM CUSTOMER";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<table><tr><th>CID</th><th>Customer Name</th></tr>";
    while($row = $result->fetch_assoc()) {
        echo "<tr><td>" . $row["CID"]. "</td><td>" . $row["CNAME"]. "</td></tr>";
    }
    echo "</table>";
} else {
    echo "No customers found.";
}
?>
