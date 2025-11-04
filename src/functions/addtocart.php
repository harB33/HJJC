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

// --- THIS IS THE FIX ---
// Changed from $_GET to $_POST to match your form
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

// --- RETRIEVE CUSTOMER ID ---

$user_identifier = $_SESSION['customer_user'];

// Find the customer_id based on their session identifier (e.g., username or email)
$sql_get_id = "SELECT customer_id FROM users WHERE customer_user = ?"; // Replace 'customer_user' with your actual column name
$stmt_get_id = $conn->prepare($sql_get_id);
$stmt_get_id->bind_param("s", $user_identifier);
$stmt_get_id->execute();
$stmt_get_id->bind_result($customer_id);
$stmt_get_id->fetch();
$stmt_get_id->close();

// Check if a customer ID was found
if (empty($customer_id)) {
    die("Error: Customer ID could not be found for user: " . htmlspecialchars($user_identifier));
}

// --- ADD TO CART LOGIC ---

// REQUIREMENT: This requires a UNIQUE constraint on the (customer_id, product_id) columns.
// If you don't have one, run this in your database:
// ALTER TABLE cart ADD UNIQUE KEY `customer_product` (`customer_id`, `product_id`);

$quantity = 1; // Default quantity to add

$insert_sql = " INSERT INTO cart (customer_id, product_id) 
                VALUES (?, ?)";

$insert_stmt = $conn->prepare($insert_sql);
$insert_stmt->bind_param("ii", $customer_id, $product_id);

// Execute the query
if ($insert_stmt->execute()) {
    // Success! Redirect back to the cart page.
    header("Location: ../cart.php");
    exit();
} else {
    // This will catch the original foreign key error if $product_id doesn't exist in the 'products' table
    die("Error adding to cart: " . $insert_stmt->error);
}

$insert_stmt->close();
$conn->close();
