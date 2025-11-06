<?php 
include("../db/sessionStart.php");
include("../db/db.php");

if (isset($_POST['remove']) && isset($_SESSION['customer_id'])) {

    $product_id = $_POST['remove'];
    $customer_id = $_SESSION['customer_id'];

    $sql = "DELETE FROM cart WHERE product_id = ? AND customer_id = ?";

    $stmt = $conn->prepare($sql);

    if ($stmt === false) {
        die("Prepare failed: " . $conn->error);
    }
    $stmt->bind_param("ii", $product_id, $customer_id);

    if ($stmt->execute()) {
        if ($stmt->affected_rows > 0) {
        header("Location: ../cart.php?status=removed");
        exit();
        } else {
            header("Location: ../cart.php?status=not_found");
            exit();
        }
    } else {
        echo "Error: Could not remove item." . $stmt->error;
    }

    $stmt->close();

} else {
    header("Location: ../cart.php?status=invalid_request");
    exit();
}

$conn->close();
?>