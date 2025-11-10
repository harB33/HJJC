<?php
// include("./db/sessionStart.php");
include './db/db.php';
$id = $_GET['id'];
$result = $conn->query("SELECT * FROM products WHERE product_id='$id'");
$product = $result->fetch_assoc();

?>

<!DOCTYPE html>
<html lang="en" data-theme="light">

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
    <section class=" w-full min-h-screen justify-center items-center flex pt-20 pb-40 bg-custom-background">
        <div class="flex flex-col md:flex-row gap-10 w-[90%] justify-center items-center">
            <div class=" w-full justify-center flex gap-4">
                <img src="image/products/<?= $product['product_img']; ?>" class="w-[50%] object-contain h-fit rounded-2xl " alt="<?= htmlspecialchars($product['product_name']); ?>" />
            </div>
            <div class="w-[90%]">
                <div class=" w-full items-center h-full flex flex-col">
                    <h1 class="text-2xl font-bold mb-3 text-custom-accent"><?= htmlspecialchars($product['product_name']); ?></h1>
                    <p class="text-black/80 mb-6"><?= nl2br(htmlspecialchars($product['product_desc'])); ?></p>
                </div>
            </div>
            <div class="w-[90%]">
                <form class=" gap-12 flex flex-col">
                    <div>
                        <h1 class=" font-bold mb-2">Temperature</h1>
                        <div class="flex flex-wrap gap-2">
                            <input class="btn shadow-none checked:border-custom-accent  checked:bg-custom-accent/25 checked:text-black" type="radio" name="temperature" value="Hot" required aria-label="Hot">
                            <input class="btn shadow-none checked:border-custom-accent  checked:bg-custom-accent/25 checked:text-black" type="radio" name="temperature" value="Iced" aria-label="Iced">
                        </div>
                    </div>
                    <div>
                        <h1 class=" font-bold mb-2">Milk</h1>
                        <div class="flex flex-wrap gap-2">
                            <input class="btn shadow-none checked:border-custom-accent  checked:bg-custom-accent/25 checked:text-black" type="radio" name="milk" value="Hot" required aria-label="Dairy Milk">
                            <input class="btn shadow-none checked:border-custom-accent  checked:bg-custom-accent/25 checked:text-black" type="radio" name="milk" value="Cold" aria-label="Oat Milk">
                            <input class="btn shadow-none checked:border-custom-accent  checked:bg-custom-accent/25 checked:text-black" type="radio" name="milk" value="Cold" aria-label="Coconut Milk">
                        </div>
                    </div>
                    <div>
                        <h1 class=" font-bold mb-2">Espresso Shots</h1>
                        <div class="flex flex-wrap gap-2">
                            <input class="btn shadow-none checked:border-custom-accent  checked:bg-custom-accent/25 checked:text-black" type="radio" name="shots" value="Hot" required aria-label="No Shot">
                            <input class="btn shadow-none checked:border-custom-accent  checked:bg-custom-accent/25 checked:text-black" type="radio" name="shots" value="Cold" aria-label="LYDIA">
                            <input class="btn shadow-none checked:border-custom-accent  checked:bg-custom-accent/25 checked:text-black" type="radio" name="shots" value="Cold" aria-label="BOSS">
                        </div>
                    </div>
                    <div>
                        <h1 class=" font-bold mb-2">Sweetness</h1>
                        <div class="flex flex-wrap gap-2">
                            <input class="btn shadow-none checked:border-custom-accent  checked:bg-custom-accent/25 checked:text-black" type="radio" name="sweetness" value="Hot" required aria-label="Regular Sweet">
                            <input class="btn shadow-none checked:border-custom-accent  checked:bg-custom-accent/25 checked:text-black" type="radio" name="sweetness" value="Cold" aria-label="Less Sweet">
                            <input class="btn shadow-none checked:border-custom-accent  checked:bg-custom-accent/25 checked:text-black" type="radio" name="sweetness" value="Cold" aria-label="More Sweet">
                        </div>
                    </div>
                    <div>
                        <h1 class=" font-bold mb-2">Ice Level</h1>
                        <div class="flex flex-wrap gap-2">
                            <input class="btn shadow-none checked:border-custom-accent  checked:bg-custom-accent/25 checked:text-black" type="radio" name="ice" value="Hot" required aria-label="Normal Ice">
                            <input class="btn shadow-none checked:border-custom-accent  checked:bg-custom-accent/25 checked:text-black" type="radio" name="ice" value="Cold" aria-label="Less Ice">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <section class=" w-full items-center justify-center flex flex-col fixed bottom-0 p-4 bg-custom-background shadow-2xl">
        <div class="flex gap-4 w-[90%] h-full items-center justify-center mb-4">
            <p class="text-2xl font-bold w-full ">₱<?= number_format($product['price'], 2); ?></p>
            <div class="quantity-selector flex">
                <button type="button" class="btn btn-circle border-custom-accent disabled:bg-custom-background disabled:border-custom-accent bg-custom-accent minus-btn" disabled>-</button>
                <input type="number" class="input quantity-input border-none font-bold bg-custom-background text-center w-20 text-xl" value="1" min="1" max="100" readonly>
                <button type="button" class="btn btn-circle border-custom-accent bg-custom-accent plus-btn">+</button>
            </div>
        </div>
        <div class="flex gap-4 w-[90%] items-center justify-center">
            <form method="POST" action="./functions/addtocart.php" class="grow w-1/2">
                <input type="hidden" name="product_id" value="<?= $product['product_id']; ?>">
                <button type="submit" class="btn btn-lg border-custom-accent bg-custom-background text-custom-accent w-full rounded-full">Buy Now</button>
            </form>
            <form method="POST" action="./functions/buynow.php" class="grow w-1/2">
                <input type="hidden" name="product_id" value="<?= $product['product_id']; ?>">
                <button type="submit" class="btn btn-lg border-custom-accent bg-custom-accent  text-custom-background  w-full rounded-full">Add To Cart</button>
            </form>
        </div>
    </section>
</body>

</html>

<script src="./script/quantity.js"></script>