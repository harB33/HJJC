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
            <span>Product Description</span>
            <input type="text"
            required
            placeholder="Product Description"
            name="product_desc" />
        </label>
        <label>
            <span>Product Category (1,2,3,4,5)</span>
            <input type="number"
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