<?php
require_once __DIR__ . '/../../config/config.php';

if (!isset($_SESSION['customer_user'])) {
    header("Location: /login.php");
    die;
}

if (!isset($_POST['product_id']) || empty($_POST['product_id'])) {
    die("Error: Product ID is missing.");
} 

$product_id = (int)$_POST['product_id'];
if ($product_id <= 0) die("Error: Invalid Product ID.");

$quantity_to_add = isset($_POST['quantity']) ? (int)$_POST['quantity'] : 1;
if ($quantity_to_add <= 0) $quantity_to_add = 1;

$temperature = $_POST['temperature'] ?? '';
$milk_type = $_POST['milk_type'] ?? '';
$espresso_shots = $_POST['espresso_shots'] ?? '';
$sweetness = $_POST['sweetness'] ?? '';
$ice_level = $_POST['ice_level'] ?? '';

$stmt_check = $conn->prepare("SELECT stock FROM products WHERE product_id = ?");
$stmt_check->bind_param("i", $product_id);
$stmt_check->execute();
$result_check = $stmt_check->get_result();
if (!$result_check || $result_check->num_rows === 0) {
    die("Error: Product not found.");
}
$product = $result_check->fetch_assoc();
$stock = (int)$product['stock'];
$stmt_check->close();

$user_identifier = $_SESSION['customer_user'];
$stmt_get_id = $conn->prepare("SELECT customer_id FROM users WHERE customer_user = ?");
$stmt_get_id->bind_param("s", $user_identifier);
$stmt_get_id->execute();
$result_id = $stmt_get_id->get_result();
$row = $result_id->fetch_assoc();
$customer_id = (int)$row['customer_id'];
$stmt_get_id->close();

$stmt_cart = $conn->prepare("SELECT cart_id, quantity FROM cart WHERE customer_id = ? 
    AND product_id = ? 
    AND temperature = ?
    AND milk_type = ?
    AND espresso_shots = ?
    AND sweetness = ?
    AND ice_level = ?"
);

$stmt_cart->bind_param("iisssss", 
    $customer_id, 
    $product_id,
    $temperature,
    $milk_type,
    $espresso_shots,
    $sweetness,
    $ice_level
);
$stmt_cart->execute();
$result_cart = $stmt_cart->get_result();

if ($result_cart->num_rows > 0) {
    $row_cart = $result_cart->fetch_assoc();
    $cart_id = $row_cart['cart_id'];
    $existing_quantity = (int)$row_cart['quantity'];

    $new_quantity = $existing_quantity + $quantity_to_add;
    if ($new_quantity > $stock) die("Error: Quantity exceeds stock.");

    $stmt_update = $conn->prepare("UPDATE cart SET quantity = ? WHERE cart_id = ?");
    $stmt_update->bind_param("ii", $new_quantity, $cart_id);
    $stmt_update->execute();
    $stmt_update->close();
} else {
    if ($quantity_to_add > $stock) die("Error: Quantity exceeds stock.");

    $stmt_insert = $conn->prepare("INSERT INTO cart (customer_id, product_id, temperature, milk_type, espresso_shots, sweetness, ice_level, quantity, created_at) 
    VALUES (?, ?, ?, ?, ?, ?, ?, ?, NOW())");
        $stmt_insert->bind_param("iisssssi", 
        $customer_id, 
        $product_id,
        $temperature,
        $milk_type,
        $espresso_shots,
        $sweetness,
        $ice_level,
        $quantity_to_add
    );
    $stmt_insert->execute();
    $cart_id = $conn->insert_id;
    $stmt_insert->close();

    if ($cart_id === 0) {
        die("Error: Failed to retrieve cart ID for new item.");
    }
}

$stmt_cart->close();
$conn->close();

header("Location: /cart.php?status=added&cache_bust=" . time());
exit();
