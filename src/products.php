<?php 
include("./db/db.php");
date_default_timezone_set("Asia/Manila");

if (isset($_POST["finish"])) {
    $product_name = $_POST['product_name'] ?? null;
    $price = $_POST['price'] ?? null;
    $product_img = $_POST['product_img'] ?? null; 
    $product_desc = $_POST['product_desc'] ?? null;
    $category_id = $_POST['category'] ?? null; 
    $stock = $_POST['stock'] ?? null;
    $date = date("Y-m-d H:i:s");

    $sql = "INSERT INTO products 
            (product_name, price, product_img, product_desc, category_id, stock, created_at, updated_at) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);

    if ($stmt) {

        $stmt->bind_param(
            "sdssiiss", 
            $product_name,
            $price,
            $product_img,
            $product_desc,
            $category_id,
            $stock,
            $date,
            $date
        );

        if ($stmt->execute()) {
            echo "New product added successfully!";
        } else {
            echo "Error executing statement: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "Error preparing statement: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<body>
    <form action="./products.php" method="post" enctype="multipart/form-data">
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
            <input type="text" 
                required
                placeholder="Image URL or Path"
                name="product_img" />
        </label>
        <label>
            <span>Product Description</span>
            <textarea
                required
                placeholder="Product Description"
                name="product_desc"></textarea>
        </label>
        <label>
            <span>Product Category ID</span>
            <input type="number"
                min="1"
                required
                placeholder="Category ID"
                title="Only Numbers (Foreign Key)"
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