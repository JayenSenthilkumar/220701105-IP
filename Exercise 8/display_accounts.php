<?php
include 'db_connect.php';
// Fetch and display account information
$sql = "SELECT ANO, ATYPE, BALANCE, CNAME FROM ACCOUNT JOIN CUSTOMER ON ACCOUNT.CID = CUSTOMER.CID";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<table><tr><th>Account Number</th><th>Account Type</th><th>Balance</th><th>Customer Name</th></tr>";
    while($row = $result->fetch_assoc()) {
        echo "<tr><td>" . $row["ANO"]. "</td><td>" . $row["ATYPE"]. "</td><td>" . $row["BALANCE"]. "</td><td>" . $row["CNAME"]. "</td></tr>";
    }
    echo "</table>";
} else {
    echo "No accounts found.";
}
?>
