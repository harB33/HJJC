<?php
include("../db/sessionStart.php");
include("../db/db.php");

if (!isset($_SESSION['customer_user'])) {
    header("Location: ../components/mustBeLoggedIn.php");
    die;
}

if (!isset($_POST['product_id']) || empty($_POST['product_id'])) {
    die("Error: Product ID is missing.");
}

$product_id = (int)$_POST['product_id'];
if ($product_id <= 0) die("Error: Invalid Product ID.");

$quantity_to_add = isset($_POST['quantity']) ? (int)$_POST['quantity'] : 1;
if ($quantity_to_add <= 0) $quantity_to_add = 1;

// Get product stock
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

// Get customer ID
$user_identifier = $_SESSION['customer_user'];
$stmt_get_id = $conn->prepare("SELECT customer_id FROM users WHERE customer_user = ?");
$stmt_get_id->bind_param("s", $user_identifier);
$stmt_get_id->execute();
$result_id = $stmt_get_id->get_result();
$row = $result_id->fetch_assoc();
$customer_id = (int)$row['customer_id'];
$stmt_get_id->close();

// Check if product is already in cart
$stmt_cart = $conn->prepare("SELECT cart_id, quantity FROM cart WHERE customer_id = ? AND product_id = ?");
$stmt_cart->bind_param("ii", $customer_id, $product_id);
$stmt_cart->execute();
$result_cart = $stmt_cart->get_result();

if ($result_cart->num_rows > 0) {
    // Product exists in cart → add to existing quantity
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
    // Product not in cart → insert new row
    if ($quantity_to_add > $stock) die("Error: Quantity exceeds stock.");

    $stmt_insert = $conn->prepare("INSERT INTO cart (customer_id, product_id, quantity, created_at) VALUES (?, ?, ?, NOW())");
    $stmt_insert->bind_param("iii", $customer_id, $product_id, $quantity_to_add);
    $stmt_insert->execute();
    $stmt_insert->close();
}

$stmt_cart->close();
$conn->close();

// Redirect
header("Location: ../cart.php?status=added&cache_bust=" . time());
exit();
