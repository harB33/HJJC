<?php
// 1. Start the session to access customer data
// session_start();

// 2. Database Connection
include("../db/sessionStart.php");
include("../db/db.php"); // Ensure this path is correct

// 3. Check if the user is logged in
if (!isset($_SESSION['customer_user'])) {
    die("Error: You must be logged in to add items to your cart.");
}

// 4. VALIDATION AND VARIABLE RETRIEVAL
if (!isset($_POST['product_id']) || empty($_POST['product_id'])) {
    die("Error: Product ID is missing. Cannot add to cart.");
}

// We cast to (int) to sanitize it as a number
$product_id = (int)$_POST['product_id'];
// --- END OF FIX ---

// Check if product ID is a valid number
if ($product_id <= 0) {
    die("Error: Invalid Product ID.");
}

$sql_check_product = "SELECT product_id FROM products WHERE product_id = ?";
$stmt_check = $conn->prepare($sql_check_product);
$stmt_check->bind_param("i", $product_id);
$stmt_check->execute();
if ($stmt_check->get_result()->num_rows === 0) {
    die("Error: Product does not exist.");
}
$stmt_check->close();

$user_identifier = $_SESSION['customer_user'];

// Find the customer_id based on their session identifier (e.g., username or email)
$sql_get_id = "SELECT customer_id FROM users WHERE customer_user = ?"; // Replace 'customer_user' with your actual column name
$stmt_get_id = $conn->prepare($sql_get_id);
$stmt_get_id->bind_param("s", $user_identifier);
$stmt_get_id->execute();
$result_id = $stmt_get_id->get_result();
$row = $result_id->fetch_assoc();
$customer_id = $row['customer_id'];
$stmt_get_id->close();

// Check if a customer ID was found
if (empty($customer_id)) {
    die("Error: Customer ID could not be found for user: " . htmlspecialchars($user_identifier));
}

// --- ADD TO CART LOGIC ---

$quantity = isset($_POST['quantity']) && !empty($_POST['quantity']) ? (int)$_POST['quantity'] : 1;
if ($quantity <= 0) $quantity = 1;

$check_sql = "SELECT cart_id, quantity FROM cart WHERE customer_id = ? AND product_id = ?";
$check_stmt = $conn->prepare($check_sql);
$check_stmt->bind_param("ii", $customer_id, $product_id);
$check_stmt->execute();
$result = $check_stmt->get_result();

if ($result->num_rows > 0) {
    // Item exists: Update quantity
    $row = $result->fetch_assoc();
    $new_quantity = $row['quantity'] + $quantity;
    $update_sql = "UPDATE cart SET quantity = ? WHERE cart_id = ?";
    $update_stmt = $conn->prepare($update_sql);
    $update_stmt->bind_param("ii", $new_quantity, $row['cart_id']);
    $update_stmt->execute();
    $update_stmt->close();
} else {
    // Item doesn't exist: Insert new row
    $insert_sql = "INSERT INTO cart (customer_id, product_id, quantity) VALUES (?, ?, ?)";
    $insert_stmt = $conn->prepare($insert_sql);
    $insert_stmt->bind_param("iii", $customer_id, $product_id, $quantity);
    $insert_stmt->execute();
    $insert_stmt->close();
}

$check_stmt->close();

// Execute the query
header("Location: ../cart.php?status=added");
exit();

$conn->close();
