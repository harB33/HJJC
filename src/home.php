<?php
include("./db/db.php");
date_default_timezone_set('Asia/Manila');

$sql = "SELECT p.*, c.category_name 
        FROM products p
        JOIN category c ON p.category_id = c.category_id";

// if (isset($_GET['sort']) && $_GET['sort'] == 'high') {
//     $sql = "SELECT * FROM products ORDER BY price DESC";
// } else {
//     $sql = "SELECT * FROM products";
// }
$result = mysqli_query($conn, $sql);

$coffee_sql = "SELECT p.*, c.category_name 
                FROM products p
                JOIN category c ON p.category_id = c.category_id
                WHERE c.category_id = '1'";
$coffee_result = mysqli_query($conn, $coffee_sql);

$frappe_sql = "SELECT p.*, c.category_name 
            FROM products p
            JOIN category c ON p.category_id = c.category_id
            WHERE c.category_id = '3'";
$frappe_result = mysqli_query($conn, $frappe_sql);

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
    <title>HJJC. STORE|Home</title>
    <link rel="stylesheet" href="./style/output.css" />
</head>

<body class="w-screen overflow-x-hidden scroll-smooth">
    <div class="sticky top-0 z-50 w-full backdrop-blur-sm ">
        <?php include './components/header.php'; ?>
    </div>
    <section class="flex w-full h-full">
        <!-- <section class="">
            <div class="carousel w-full hidden">
                <div id="slide1" class="carousel-item relative w-full">
                    <img
                        src="./image/banner.png"
                        class="w-full " />
                    <div class="absolute left-5 right-5 top-1/2 flex -translate-y-1/2 transform justify-between">
                        <a href="#slide4" class="btn btn-circle">❮</a>
                        <a href="#slide2" class="btn btn-circle">❯</a>
                    </div>
                </div>
                <div id="slide2" class="carousel-item relative w-full">
                    <img
                        src="https://img.daisyui.com/images/stock/photo-1609621838510-5ad474b7d25d.webp"
                        class="w-full" />
                    <div class="absolute left-5 right-5 top-1/2 flex -translate-y-1/2 transform justify-between">
                        <a href="#slide1" class="btn btn-circle">❮</a>
                        <a href="#slide3" class="btn btn-circle">❯</a>
                    </div>
                </div>
                <div id="slide3" class="carousel-item relative w-full">
                    <img
                        src="https://img.daisyui.com/images/stock/photo-1414694762283-acccc27bca85.webp"
                        class="w-full" />
                    <div class="absolute left-5 right-5 top-1/2 flex -translate-y-1/2 transform justify-between">
                        <a href="#slide2" class="btn btn-circle">❮</a>
                        <a href="#slide4" class="btn btn-circle">❯</a>
                    </div>
                </div>
                <div id="slide4" class="carousel-item relative w-full">
                    <img
                        src="https://img.daisyui.com/images/stock/photo-1665553365602-b2fb8e5d1707.webp"
                        class="w-full" />
                    <div class="absolute left-5 right-5 top-1/2 flex -translate-y-1/2 transform justify-between">
                        <a href="#slide3" class="btn btn-circle">❮</a>
                        <a href="#slide1" class="btn btn-circle">❯</a>
                    </div>
                </div>
            </div>
        </section> -->
        <section class="flex items-center justify-center h-screen bg-custom-accent sticky top-0 flex-col p-2.5  ">
            <div class="grid grid-cols-1 place-items-center w-fit gap-2">
                <a href="#bestSeller" class="size-12 sm:size-45 border">Best Seller</a>
                <a href="#coffee" class="size-12 sm:size-45 border">Coffee</a>
                <a href="#frappe" class="size-12 sm:size-45 border">Frappe</a>
                <a href="#tea" class="size-12 sm:size-45 border">Tea</a>
            </div>
        </section>
        <section class=" w-full min-h-max flex flex-col  items-center bg-custom-background">
            <h1 id="bestSeller"></h1>
            <h1 class=" text-4xl font-black my-fadeInCard  sticky top-0 w-full text-center pt-14 pb-2 bg-custom-background shadow-md z-30">Best Seller</h1>
            <section class="flex flex-col  items-center overflow-y-scroll h-fit w-full p-4 ">
                <section class="grid grid-cols-2  gap-4 place-contents-center  w-fit  overflow-x-clip scroll-m-32">
                    <?php while ($row = mysqli_fetch_assoc($coffee_result)): ?>
                        <div class="group flex flex-col p-2 h-fit hover:bg-linear-to-br from-custom-primary/15 to-color-custom-secondary/35 hover:shadow-lg rounded-2xl gap-2 hover:scale-105 transition-transform duration-300 ease-in-out">
                            <a href="./productPage.php?id=<?= $row['product_id']; ?>" class="">
                                <div class="overflow-hidden rounded-lg">
                                    <img src="image/products/<?= htmlspecialchars($row['product_img']); ?>" alt="<?= htmlspecialchars($row['product_name']); ?>" class="w-full aspect-square object-cover rounded-lg shadow-lg scale-125 transition-transform duration-700 ease-in-out" />
                                </div>
                                <div class="min-h-max mt-2 duration-300">
                                    <h3 class=" text-black/75 overflow-clip group-hover:text-custom-primary duration-300"><?= htmlspecialchars($row['product_name']); ?></h3>
                                    <p class="float-right group-hover:scale-110 font-bold text-black/85 duration-300 mt-">₱<?= number_format($row['price'], 2); ?></p>
                                </div>
                            </a>
                            <div class="flex w-full gap-2 hidden">
                                <form method="POST" action="./functions/addtocart.php" class=" flex w-full">
                                    <input type="hidden" name="product_id" value="<?= $row['product_id']; ?>">
                                    <button type="submit" class="btn btn-md rounded-2xl w-full opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center gap-2 bg-custom-primary/90 btn-primary text-white hover:bg-custom-secondary">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-shopping-bag">
                                            <path d="M16 10a4 4 0 0 1-8 0" />
                                            <path d="M3.103 6.034h17.794" />
                                            <path d="M3.4 5.467a2 2 0 0 0-.4 1.2V20a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6.667a2 2 0 0 0-.4-1.2l-2-2.667A2 2 0 0 0 17 2H7a2 2 0 0 0-1.6.8z" />
                                        </svg>
                                        Add to Cart</button>
                                </form>
                                <button class="btn btn-md rounded-2xl opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center bg-white hover:bg-custom-secondary/40">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-heart text-color-custom-primary">
                                        <path d="M2 9.5a5.5 5.5 0 0 1 9.591-3.676.56.56 0 0 0 .818 0A5.49 5.49 0 0 1 22 9.5c0 2.29-1.5 4-3 5.5l-5.492 5.313a2 2 0 0 1-3 .019L5 15c-1.5-1.5-3-3.2-3-5.5" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                    <?php endwhile; ?>
                </section>
            </section>
            <h1 id="frappe"></h1>
            <h1 class=" text-4xl font-black my-fadeInCard  sticky top-0 w-full text-center pt-14 pb-2 bg-custom-background shadow-md z-30">Frappe</h1>
            <section class="flex flex-col  items-center overflow-y-scroll h-screen w-full p-4 ">
                <section class="grid grid-cols-2  gap-4 place-contents-center  w-fit  overflow-x-clip scroll-m-32">
                    <?php while ($row = mysqli_fetch_assoc($frappe_result)): ?>
                        <div class="group flex flex-col p-2 h-fit hover:bg-linear-to-br from-custom-primary/15 to-color-custom-secondary/35 hover:shadow-lg rounded-2xl gap-2 hover:scale-105 transition-transform duration-300 ease-in-out">
                            <a href="./productPage.php?id=<?= $row['product_id']; ?>" class="">
                                <div class="overflow-hidden rounded-lg">
                                    <img src="image/products/<?= htmlspecialchars($row['product_img']); ?>" alt="<?= htmlspecialchars($row['product_name']); ?>" class="w-full aspect-square object-cover rounded-lg shadow-lg scale-125 transition-transform duration-700 ease-in-out" />
                                </div>
                                <div class="min-h-max mt-2 duration-300">
                                    <h3 class=" text-black/75 overflow-clip group-hover:text-custom-primary duration-300"><?= htmlspecialchars($row['product_name']); ?></h3>
                                    <p class="float-right group-hover:scale-110 font-bold text-black/85 duration-300 mt-">₱<?= number_format($row['price'], 2); ?></p>
                                </div>
                            </a>
                            <div class="flex w-full gap-2 hidden">
                                <form method="POST" action="./functions/addtocart.php" class=" flex w-full">
                                    <input type="hidden" name="product_id" value="<?= $row['product_id']; ?>">
                                    <button type="submit" class="btn btn-md rounded-2xl w-full opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center gap-2 bg-custom-primary/90 btn-primary text-white hover:bg-custom-secondary">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-shopping-bag">
                                            <path d="M16 10a4 4 0 0 1-8 0" />
                                            <path d="M3.103 6.034h17.794" />
                                            <path d="M3.4 5.467a2 2 0 0 0-.4 1.2V20a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6.667a2 2 0 0 0-.4-1.2l-2-2.667A2 2 0 0 0 17 2H7a2 2 0 0 0-1.6.8z" />
                                        </svg>
                                        Add to Cart</button>
                                </form>
                                <button class="btn btn-md rounded-2xl opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center bg-white hover:bg-custom-secondary/40">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-heart text-color-custom-primary">
                                        <path d="M2 9.5a5.5 5.5 0 0 1 9.591-3.676.56.56 0 0 0 .818 0A5.49 5.49 0 0 1 22 9.5c0 2.29-1.5 4-3 5.5l-5.492 5.313a2 2 0 0 1-3 .019L5 15c-1.5-1.5-3-3.2-3-5.5" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                    <?php endwhile; ?>
                </section>
            </section>
        </section>
    </section>
    <section class="my-fadeInFooter z-10">
        <?php include './components/footer.html'; ?>
    </section>
</body>

</html>