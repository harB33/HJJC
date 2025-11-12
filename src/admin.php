<?php 
include("./db/sessionStart.php");
include("./db/db.php");

if (!isset($_SESSION['customer_id'])) {
    die("Not logged in.");
}

$customer_id = $_SESSION['customer_id'];

$stmt = $conn->prepare("SELECT role FROM users WHERE customer_id = ?");
$stmt->bind_param("i", $customer_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

if ($user['role'] !== 'admin') {
    die("You do not have permission to access this page.");
}
?>