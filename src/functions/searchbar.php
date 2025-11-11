<?php 
include("../db/sessionStart.php");
include("../db/db.php");

$search_query = '';
if (isset($_GET['search']) && !empty(trim($_GET['search']))) {
    // Sanitize and store the query
    $search_query = trim($_GET['search']);
}

$sql = "SELECT product_name FROM products";
$params = [];
$types = '';

if ($search_query) {
    // Add WHERE clause to filter by product_name OR product_desc
    $sql .= " WHERE product_name LIKE ? OR product_desc LIKE ?";
    
    // The '%' signs are needed for LIKE operator, indicating partial matches
    $param_value = '%' . $search_query . '%';
    
    // Add the search term twice (for name and description)
    $params[] = $param_value;
    $params[] = $param_value;
    $types = 'ss'; // Two string parameters
}

$stmt = $conn->prepare($sql);

if ($search_query) {
    // Bind parameters if a search query exists
    $stmt->bind_param($types, ...$params);
}

$stmt->execute();
$result = $stmt->get_result();

?>