<?php 
include("./db/sessionStart.php");
include("./db/db.php");

if (isset($_POST['address']) && isset($_SESSION['customer_id'])) {
    $customer_id = (int)$_SESSION['customer_id'];
    $address_name = $_POST['address_name'];
    $address_city = $_POST['address_city'];
    $address_region = $_POST['address_region'];
    $address_brgy = $_POST['address_brgy'];
    $address_postal = (int)$_POST['address_postal'];

    $sql_address = "INSERT INTO address (customer_id, address_name, address_city, address_region, address_brgy, address_postal, created_at) 
        VALUES (?, ?, ?, ?, ?, ?, NOW())";
    $stmt_address = $conn->prepare($sql_address);

    if ($stmt_address === false) {
        die("SQL Prepare Failed: " . $conn->error);
    }

    $stmt_address->bind_param("issssi", 
        $customer_id,
        $address_name,
        $address_city,
        $address_region,
        $address_brgy,
        $address_postal
        );

    $stmt_address->execute();
    $res = $stmt_address->get_result();

    if ($stmt_address->execute()) {
        header("Location: ./cart.php?status=address_added");
        exit();
    } else {
        die("Execute Failed: " . $stmt_address->error);
    }

    $stmt_address->close();
    $conn->close();

} else if (!isset($_SESSION['customer_id'])) {
    header("Location: ./login.php?redirect=addressForm.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>>HJJC Store|Address</title>
</head>
<body>
    <form action="./addressForm.php" method="post">
        <label>Address Name</label>
        <input type="text" name="address_name" required>

        <label>Address City</label>
        <input type="text" name="address_city" required>

        <label>Address Region</label>
        <input type="text" name="address_region" required>

        <label>Address Barangay</label>
        <input type="text" name="address_brgy" required>

        <label>Address Postal</label>
        <input type="text" name="address_postal" required>

        <input type="submit" name="address" value="Submit">
    </form>
</body>
</html>