<?php
require_once __DIR__ . '/../../config/config.php';

$results = [];
$search_query = '';

if (isset($_GET['search']) && !empty(trim($_GET['search']))) {
    $search_query = trim($_GET['search']);
}

$sql = "SELECT * FROM products";
$params = [];
$types = '';

if ($search_query) {
    $sql .= " WHERE product_name LIKE ? OR product_desc LIKE ?";
    
    $param_value = '%' . $search_query . '%';

    $params[] = $param_value;
    $params[] = $param_value;
    $types = 'ss';
}

$sql .= " ORDER BY product_name ASC";

if ($stmt = $conn->prepare($sql)) { 
        
        if ($search_query) {
            $stmt->bind_param($types, ...$params); 
        }
        
        $stmt->execute();
        $result = $stmt->get_result();
        
        while ($row = $result->fetch_assoc()) {
            $results[] = $row;
        }

        $stmt->close();

} else {
        echo "Error preparing statement: " . $conn->error;
}
?>