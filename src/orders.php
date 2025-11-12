<?php
include("./db/sessionStart.php");
include("./db/db.php");

$customer_id = (int)$_SESSION['customer_id'];
$address_id = (int)$_POST['selected_address_id'];
$total_amount = $_SESSION['total'];
$conn->begin_transaction();

try {
    $sql_order = "INSERT INTO orders (customer_id, total_amount, address_id, status) 
                  VALUES (?, ?, ?, 'Pending')";
    $stmt_order = $conn->prepare($sql_order);
    $stmt_order->bind_param("idi", $customer_id, $total_amount, $address_id);
    
    if (!$stmt_order->execute()) {
        throw new Exception("Order insertion failed: " . $stmt_order->error);
    }

    $order_id = $conn->insert_id;
    $stmt_order->close();

    $sql_cart_data = "SELECT product_id, temperature, milk_type, espresso_shots, sweetness, ice_level, quantity
                      FROM cart WHERE customer_id = ?";
    $stmt_cart_data = $conn->prepare($sql_cart_data);
    $stmt_cart_data->bind_param("i", $customer_id);
    $stmt_cart_data->execute();
    $cart_result = $stmt_cart_data->get_result();

    $sql_details = "INSERT INTO order_details (order_id, product_id, quantity, temperature, milk_type, espresso_shots, sweetness, ice_level, price) 
                    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt_details = $conn->prepare($sql_details);

    while ($item = $cart_result->fetch_assoc()) {
        $stmt_details->bind_param("iiisssssi", 
            $order_id, 
            $item['product_id'], 
            $item['quantity'], 
            $item['temperature'], 
            $item['milk_type'], 
            $item['espresso_shots'], 
            $item['sweetness'], 
            $item['ice_level'],
            $_SESSION['price']
        );
        if (!$stmt_details->execute()) {
            throw new Exception("Order detail insertion failed.");
        }
    }
    $stmt_cart_data->close();
    $stmt_details->close();

    $sql_clear = "DELETE FROM cart WHERE customer_id = ?";
    $stmt_clear = $conn->prepare($sql_clear);
    $stmt_clear->bind_param("i", $customer_id);

    if (!$stmt_clear->execute()) {
        throw new Exception("Cart clear failed.");
    }

    $stmt_clear->close();
    $conn->commit();
} catch (Exception $e) {
    $conn->rollback();
    $success = false;
    error_log("Checkout Error: " . $e->getMessage()); 
}
$conn->close();

if ($success) {
    header("Location: ./order_confirmation.php?order_id=" . $order_id);
} else {
    header("Location: ./orders.php?error=payment_failed");
}
exit();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HJJC Store|Orders</title>
</head>
<body>
    
</body>

</html>