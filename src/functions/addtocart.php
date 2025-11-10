<?php
include("../db/sessionStart.php");
include("../db/db.php"); 

if (!isset($_SESSION['customer_user'])) {
    die("Error: You must be logged in to add items to your cart.");
}

if (!isset($_POST['product_id']) || empty($_POST['product_id'])) {
    die("Error: Product ID is missing. Cannot add to cart.");
}

$product_id = (int)$_POST['product_id'];

if ($product_id <= 0) {
    die("Error: Invalid Product ID.");
}

$sql_check_product = "SELECT product_id, stock FROM products WHERE product_id = ?";
$stmt_check = $conn->prepare($sql_check_product);
$stmt_check->bind_param("i", $product_id);
$stmt_check->execute();
$result_check = $stmt_check->get_result();

if ($result_check === false || $result_check->num_rows === 0) {
    die("Error: Product stock info not found.");
}

$product_data = $result_check->fetch_assoc();
$stock = (int)$product_data['stock'];
$stmt_check->close();

$user_identifier = $_SESSION['customer_user'];

$sql_get_id = "SELECT customer_id FROM users WHERE customer_user = ?"; 
$stmt_get_id = $conn->prepare($sql_get_id);
$stmt_get_id->bind_param("s", $user_identifier);
$stmt_get_id->execute();
$result_id = $stmt_get_id->get_result();
$row = $result_id->fetch_assoc();
$customer_id = $row['customer_id'];
$stmt_get_id->close();

if (empty($customer_id)) {
    die("Error: Customer ID could not be found for user: " . htmlspecialchars($user_identifier));
}

$quantity = isset($_POST['quantity']) && !empty($_POST['quantity']) ? (int)$_POST['quantity'] : 1;
if ($quantity <= 0) {
    $quantity = 1;
}

$check_sql = "SELECT cart_id, quantity FROM cart WHERE customer_id = ? AND product_id = ?";
$check_stmt = $conn->prepare($check_sql);
$check_stmt->bind_param("ii", $customer_id, $product_id);
$check_stmt->execute();
$result_check = $check_stmt->get_result();

if ($result_check->num_rows > 0) {
    $row = $result_check->fetch_assoc();
    $new_quantity = $row['quantity'] + $quantity;

    if ($new_quantity > $stock) {
        die("Error: Requested quantity exceeds available stock.");
    }

    $update_sql = "UPDATE cart SET quantity = ?, created_at = NOW() WHERE cart_id = ?";
    $update_stmt = $conn->prepare($update_sql);
    $update_stmt->bind_param("ii", $new_quantity, $row['cart_id']);
    $update_stmt->execute();
    $update_stmt->close();
} else {
    if ($quantity > $stock) {
        die("Error: Requested quantity exceeds available stock.");
    }
    $insert_sql = "INSERT INTO cart (customer_id, product_id, quantity, created_at) VALUES (?, ?, ?, NOW())";
    $insert_stmt = $conn->prepare($insert_sql);
    $insert_stmt->bind_param("iii", $customer_id, $product_id, $quantity);
    $insert_stmt->execute();
    $insert_stmt->close();
}

$check_stmt->close();
$conn->close();

header("Location: ../cart.php?status=added");
exit();
?>