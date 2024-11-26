<?php
include 'db_connect.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $cname = $_POST['cname'];

    // Validate customer name
    if (empty($cname)) {
        echo "Customer name is required.";
    } else {
        $stmt = $conn->prepare("INSERT INTO CUSTOMER (CNAME) VALUES (?)");
        $stmt->bind_param("s", $cname);
        $stmt->execute();
        echo "New customer inserted.";
    }
}
?>

<form method="post" action="">
    Customer Name: <input type="text" name="cname">
    <input type="submit" value="Insert Customer">
</form>
