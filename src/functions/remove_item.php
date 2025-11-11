<?php 
include("../db/sessionStart.php");
include("../db/db.php");

if (isset($_POST['remove']) && isset($_SESSION['customer_id'])) {

    $cart_id = (int)$_POST['remove'];
    $customer_id = (int)$_SESSION['customer_id'];
    
    $del_sql = "DELETE FROM cart WHERE cart_id = ? AND customer_id = ?";

    $del_stmt = $conn->prepare($del_sql);
     if ($del_stmt === false) {
        die("Prepare failed: " . $conn->error);
    }
    $del_stmt->bind_param("ii", $cart_id, $customer_id);
    $del_stmt->execute();

    if ($del_stmt->affected_rows > 0) {
        header("Location: ../cart.php?status=removed");
    } else {
        header("Location: ../cart.php?status=not_found");
    }

    $del_stmt->close();
    $conn->close();
    exit();
} else {
    header("Location: ../cart.php?status=invalid_request");
    exit();
}
?>