<?php
include 'db_connect.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $ano = $_POST['ano'];
    $ttype = $_POST['ttype'];
    $tamount = $_POST['tamount'];

    // Fetch current balance
    $sql = "SELECT BALANCE FROM ACCOUNT WHERE ANO = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $ano);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $balance = $row['BALANCE'];

    if ($ttype == 'D') {
        $balance += $tamount;
    } elseif ($ttype == 'W') {
        if ($balance >= $tamount) {
            $balance -= $tamount;
        } else {
            echo "Insufficient balance.";
            exit;
        }
    } else {
        echo "Invalid transaction type.";
        exit;
    }

    // Update balance
    $stmt = $conn->prepare("UPDATE ACCOUNT SET BALANCE = ? WHERE ANO = ?");
    $stmt->bind_param("di", $balance, $ano);
    $stmt->execute();

    // Insert transaction record
    $stmt = $conn->prepare("INSERT INTO TRANSACTION (ANO, TTYPE, TDATE, TAMOUNT) VALUES (?, ?, NOW(), ?)");
    $stmt->bind_param("isd", $ano, $ttype, $tamount);
    $stmt->execute();

    echo "Transaction successful.";
}
?>

<form method="post" action="">
    Account Number: <input type="number" name="ano">
    Transaction Type (D/W): <input type="text" name="ttype">
    Transaction Amount: <input type="number" name="tamount" step="0.01">
    <input type="submit" value="Process Transaction">
</form>
