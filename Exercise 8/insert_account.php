<?php
include 'db_connect.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $atype = $_POST['atype'];
    $balance = $_POST['balance'];
    $cid = $_POST['cid'];

    // Validate form inputs
    if (!in_array($atype, ['S', 'C'])) {
        echo "Account type must be 'S' for Savings or 'C' for Current.";
    } elseif ($balance < 0) {
        echo "Balance cannot be negative.";
    } else {
        $stmt = $conn->prepare("INSERT INTO ACCOUNT (ATYPE, BALANCE, CID) VALUES (?, ?, ?)");
        $stmt->bind_param("sdi", $atype, $balance, $cid);
        $stmt->execute();
        echo "New account inserted.";
    }
}
?>

<form method="post" action="">
    Account Type (S/C): <input type="text" name="atype">
    Initial Balance: <input type="number" name="balance" step="0.01">
    Customer ID: <input type="number" name="cid">
    <input type="submit" value="Insert Account">
</form>
