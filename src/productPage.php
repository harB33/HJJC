<?php
// include("./db/sessionStart.php");
include './db/db.php';
$id = $_GET['id'];
$result = $conn->query("SELECT * FROM products WHERE product_id='$id'");
$product = $result->fetch_assoc();

?>

<!DOCTYPE html>
<html lang="en"  data-theme="light">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="./image/logo.ico" type="image/x-icon">
    <link
        href="https://cdn.jsdelivr.net/npm/daisyui@5"
        rel="stylesheet"
        type="text/css" />
    <title><?= htmlspecialchars($product['product_name']); ?> - HJJC Store</title>
    <link rel="stylesheet" href="./style/output.css" /> 
</head>
<body class="font-poppins">
    <div class="sticky top-0 z-50 ">
        <?php include './components/header.php'; ?>
    </div>
    <section class=" w-full h-full justify-center items-center flex">
        <div class="flex flex-col md:flex-row gap-10 p-10 w-[80%] justify-center items-center">
            <div class=" w-[90%] flex gap-4">
                <img src="image/products/<?= $product['product_img']; ?>" class="w-[70%] object-contain h-fit rounded-2xl shadow-lg" alt="<?= htmlspecialchars($product['product_name']); ?>" />
                <div class="flex flex-col w-[15%] items-start h-full gap-4">
                    <img src="image/products/<?= $product['product_img']; ?>" alt="" class="w-full object-cover border">
                    <img src="image/products/<?= $product['product_img']; ?>" alt="" class="w-full object-cover border">
                    <img src="image/products/<?= $product['product_img']; ?>" alt="" class="w-full object-cover border">
                    <img src="image/products/<?= $product['product_img']; ?>" alt="" class="w-full object-cover border">
                </div>
            </div>
            <div class="w-[90%]">
                <div class="max-w-lg items-start h-full">
                    <h1 class="text-4xl font-bold mb-3 text-black/80"><?= htmlspecialchars($product['product_name']); ?></h1>
                    <p class="text-lg mb-6 font-bold">₱<?= number_format($product['price'], 2); ?></p>
                    <p class="text-black/80 mb-6"><?= nl2br(htmlspecialchars($product['product_desc'])); ?></p>
                        <form method="POST" action="./functions/addtocart.php" class="float-right">
                            <input type="hidden" name="product_id" value="<?= $product['product_id']; ?>">
                            <button type="submit" class="btn btn-lg rounded-2xl bg-custom-primary/80 text-custom-background btn-primary">Add to Cart</button>
                        </form>
                </div>
            </div>
        </div>
    </section>
</body>
</html>
