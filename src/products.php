<?php 
include("./db/db.php");
date_default_timezone_set("Asia/Manila");

$alertMsg = '';

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
            $alertMsg = '
            <div role="alert" class="alert alert-success">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 shrink-0 stroke-current" fill="none" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span>Your Input is Successful!</span>
            </div>
            ';
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
<html lang="en" data-theme="light" class=" overflow-x-clip" >
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="./image/logo.ico" type="image/x-icon">
    <title>HJJC. STORE|Product Input</title>
    <link
        href="https://cdn.jsdelivr.net/npm/daisyui@5"
        rel="stylesheet"
        type="text/css" />
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link rel="stylesheet" href="./style/output.css" />
    <script src="./script/accountLogo.js" defer></script>
</head>
<body class="overflow-clip h-screen">
    <div class="sticky top-0 z-50 w-full backdrop-blur-sm ">
        <?php include './components/header.php'; ?>
    </div>
    <section class="flex flex-col items-center gap-8 w-screen h-screen" >
        <div class="flex flex-col items-center gap-4 h-">
            <h1 class="font-giaza font-black text-5xl">PRODUCT INPUT</h1>
        </div>
        <div class="flex items-center flex-col gap-8 justify-center h-fit w-full">
            <?php echo $alertMsg; ?>
            <form action="./products.php" method="post" enctype="multipart/form-data" class="flex flex-col gap-4 w-[30%]">
                <label class="floating-label">
                    <span class="text-2xl" >Product Name</span>
                    <input type="text"
                        required
                        placeholder="Product Name"
                        maxlength="100"
                        title="Only Letters, Numbers or Dash"
                        name="product_name" 
                        class="input input-lg rounded w-full"
                        />
                </label>
                <label class="floating-label">
                    <span class="text-2xl">Price</span>
                    <input type="number"
                        required
                        placeholder="Price"
                        step="0.01"
                        min="0"
                        name="price" 
                        class="input input-lg rounded w-full"
                        />
                </label>
                <label class="floating-label">
                    <span class="text-2xl">Product Image</span>
                    <input type="text" 
                        required
                        placeholder="Image URL or Path"
                        name="product_img" 
                        class="input input-lg rounded w-full"
                        />
                </label>
                <label class="floating-label">
                    <span class="text-2xl">Product Description</span>
                    <textarea
                        required
                        placeholder="Product Description"
                        class="input input-lg rounded min-h-[5lh] text-wrap min-w-full"
                        name="product_desc"></textarea>
                </label>
                <!-- <label class="floating-label">
                    <span>Product Category ID</span>
                    <input type="number"
                        min="1"
                        required
                        placeholder="Category ID"
                        title="Only Numbers (Foreign Key)"
                        name="category" />
                </label> -->
                <fieldset class="fieldset w-full">
                    <select class="select w-full" name="category_id" required>
                        <option disabled selected value="">Category ID</option>
                        <option value="1">1 Electronics & Gadgets</option>
                        <option value="2">2 Fashion & Apparel</option>
                        <option value="3">3 Home & Living</option>
                        <option value="4">4 Beauty & Personal</option>
                        <option value="5">5 Health & Wellness</option>
                        <option value="6">6 Baby & Kids</option>
                        <option value="7">7 Pets Supplies</option>
                        <option value="8">8 Sports & Outdoors</option>
                        <option value="9">9 Automotive & Tools</option>
                        <option value="10">10 Arts & Stationery</option>
                        <option value="11">11 Books & Education</option>
                        <option value="12">12 Food & Beverages</option>
                    </select>
                </fieldset>
                <label class="floating-label ">
                    <span class="text-2xl">Stock</span>
                    <input type="number"
                        required
                        placeholder="Stock"
                        title="Only Numbers"
                        name="stock" 
                        class="input input-lg rounded w-full"
                        />
                </label>
                <input type="submit" value="Publish" name="finish" class="btn bg-custom-primary/75 btn-lg rounded-full text-white mt-4"/>
            </form>
        </div>  
    </section>
</body>
</html>