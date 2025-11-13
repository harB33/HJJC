<?php 
include("../db/sessionStart.php");
include("../db/db.php");

$search_query = '';
if (isset($_GET['search']) && !empty(trim($_GET['search']))) {
    $search_query = trim($_GET['search']);
}

$sql = "SELECT * FROM products";
$params = [];
$types = '';

if ($search_query) {
    $sql .= " WHERE LOWER(product_name) LIKE ? OR LOWER(product_desc) LIKE ?";
    
    $param_value = '%' . strtolower($search_query) . '%';

    $params[] = $param_value;
    $params[] = $param_value;
    $types = 'ss';
}

$sql .= " ORDER BY product_name ASC";

$stmt = $conn->prepare($sql);

if ($search_query) {
    $stmt->bind_param($types, ...$params);
}

$stmt->execute();
$result = $stmt->get_result();

?>