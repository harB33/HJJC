<?php 
include("./db/db.php");
date_default_timezone_set("Asia/Manila");

if (isset($_POST["finish"])){
    $product_name = $_POST['product_name'] ?? null;
    $price = $_POST['price'] ?? null;
    $product_img = $_POST['product_img'] ?? null;
    $product_desc = $_POST['product_desc'] ?? null;
    $category_id = $_POST['category_id'] ?? null;
    $stock = $_POST['stock'] ?? null;
    $date = date("Y-m-d H:i:s");

    $sql = "INSERT INTO products (product_name, price, product_img, product_desc, category_id, stock, created_at, updated_at) values
    ('$product_name', '$price', '$product_img', '$product_desc', '$category', '$stock', '$date', '$date',)";

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="./products.php" method="post">
        <label>
            <span>Product Name</span>
            <input type="text" 
            required 
            placeholder="Product Name" 
            maxlength="100" 
            title="Only Letters, Numbers or Dash" 
            name="product_name" />
        </label>
        <label>
            <span>Price</span>
            <input type="number" 
            required 
            placeholder="Price" 
            step="0.01"
            min="0"
            name="price" />
        </label>
        <label>
            <span>Product Image</span>
            <input type="image" 
            required 
            placeholder="Product Image" 
            name="product_img" />
        </label>
        <label>
            <span>Product Description</span>
            <input type="text"
            required
            placeholder="Product Description"
            name="product_desc" />
        </label>
        <label>
            <span>Product Category</span>
            <input type="text"
            min="1"
            required
            placeholder="Category"
            title="Only Numbers"
            name="category" />
        </label>
        <label>
            <span>Stock</span>
            <input type="number" 
            required
            placeholder="Stock"
            title="Only Numbers"
            name="stock" />
        </label>
        <input type="submit" value="Publish" name="finish">
    </form>
</body>
</html>