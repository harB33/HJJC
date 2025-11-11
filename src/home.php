<?php
include("../db/sessionStart.php");
include("./db/db.php");
include("./functions/searchbar.php");

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

$milk_tea_sql = "SELECT p.*, c.category_name 
            FROM products p
            JOIN category c ON p.category_id = c.category_id
            WHERE c.category_id = '2'";
$milk_tea_result = mysqli_query($conn, $milk_tea_sql);

$frappe_sql = "SELECT p.*, c.category_name 
            FROM products p
            JOIN category c ON p.category_id = c.category_id
            WHERE c.category_id = '3'";
$frappe_result = mysqli_query($conn, $frappe_sql);

$shake_sql = "SELECT p.*, c.category_name 
            FROM products p
            JOIN category c ON p.category_id = c.category_id
            WHERE c.category_id = '4'";
$shake_result = mysqli_query($conn, $shake_sql);

$pastries_sql = "SELECT p.*, c.category_name 
            FROM products p
            JOIN category c ON p.category_id = c.category_id
            WHERE c.category_id = '5'";
$pastries_result = mysqli_query($conn, $pastries_sql);
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
        <!-- Ewan ko kung tama-->
        <?php include './components/header.php'; 
        if ($result->num_rows > 0) {
            while($product = $result->fetch_assoc()) {
                // Your existing code to display product cards/items using $product['...']
            }
        } else {
            // No results found message
            echo "<p class='text-center text-lg'>No products found matching \"". htmlspecialchars($search_query) . "\"</p>";
        }
        ?>
    </div>
    <section class="flex w-full h-full">
        <section class="flex items-center justify-center h-screen bg-custom-accent sticky top-0 flex-col p-2.5  ">
            <div class="grid grid-cols-1 place-items-center w-fit gap-16 content-center text-center">
                <a href="#bestSeller" class="size-12 sm:size-45 flex flex-col text-sm hover:scale-105 duration-300">
                    <div class=" leading-none">
                        <img src="./image/best-seller.png" alt="">
                        Best Seller
                    </div>
                </a>
                <a href="#coffee" class="size-12 sm:size-45 flex flex-col  text-sm hover:scale-105 duration-300">
                    <div>
                        <img src="./image/coffee-cup.png" alt="">
                        Coffee
                    </div>
                </a>
                <a href="#milktea" class="size-12 sm:size-45 flex flex-col  text-sm hover:scale-105 duration-300">
                    <div>
                        <img src="./image/bubble-tea.png" alt="">
                        Milk Tea
                    </div>
                </a>
                <a href="#frappe" class="size-12 sm:size-45 flex flex-col  text-sm hover:scale-105 duration-300">
                    <div>
                        <img src="./image/frappe.png" alt="">
                        Frappe
                    </div>
                </a>
                <a href="#shake" class="size-12 sm:size-45 flex flex-col  text-sm hover:scale-105 duration-300">
                    <div>
                        <img src="./image/smoothie.png" alt="">
                        Shake
                    </div>
                </a>
                <a href="#pastries" class="size-12 sm:size-45 flex flex-col  text-sm hover:scale-105 duration-300">
                    <div>
                        <img src="./image/cookie.png" alt="">
                        Pastries
                    </div>
                </a>
            </div>
        </section>
        <section class=" w-full min-h-max flex flex-col  items-center bg-custom-background">
            <h1 id="bestSeller"></h1>
            <h1 class=" text-3xl font-black  sticky top-0 w-full text-center pt-14 pb-2 bg-linear-to-t from-custom-background from-50% to-custom-background/10 to-100% shadow-md z-30 flex items-center justify-center">Best Seller <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-flame-icon lucide-flame fill-custom-accent">
                    <path d="M12 3q1 4 4 6.5t3 5.5a1 1 0 0 1-14 0 5 5 0 0 1 1-3 1 1 0 0 0 5 0c0-2-1.5-3-1.5-5q0-2 2.5-4" />
                </svg></h1>
            <section class="flex flex-col  items-center overflow-y-scroll h-fit w-full p-4 pb-14 bg-linear-to-t from-custom-background from-50% to-custom-background/10 to-100%">
                <section class="grid grid-cols-2  gap-2.5 place-contents-center  w-fit  overflow-x-visible scroll-m-32">
                </section>
            </section>
            <h1 id="coffee"></h1>
            <h1 class=" text-4xl font-black  sticky top-0 w-full text-center pt-14  pb-2 bg-linear-to-t from-custom-background from-50% to-custom-background/10 to-100% shadow-md z-30">Coffee</h1>
            <section class="flex flex-col  items-center overflow-y-scroll h-screen w-full p-4 ">
                <section class="grid grid-cols-2  gap-4 place-contents-center  w-fit  overflow-x-visible scroll-m-32">
                    <?php while ($row = mysqli_fetch_assoc($coffee_result)): ?>
                        <div class="group flex flex-col p-2 h-fit hover:bg-linear-to-br from-custom-primary/50 to-custom-accent/20 hover:shadow-lg rounded-2xl gap-2 hover:scale-105 transition-transform duration-300 ease-in-out">
                            <a href="./productPage.php?id=<?= $row['product_id']; ?>" class="">
                                <div class="overflow-hidden rounded-lg">
                                    <img src="image/products/<?= htmlspecialchars($row['product_img']); ?>" alt="<?= htmlspecialchars($row['product_name']); ?>" class="w-full aspect-square object-cover rounded-lg shadow-lg scale-125 transition-transform duration-700 ease-in-out" />
                                </div>
                                <div class="min-h-max duration-300">
                                    <h3 class=" text-black/75 overflow-clip group-hover:text-custom-primary duration-300 leading-none p-1"><?= htmlspecialchars($row['product_name']); ?></h3>
                                    <p class="float-right group-hover:scale-110 font-bold text-black/85 duration-300 mt-">₱<?= number_format($row['price'], 2); ?></p>
                                </div>
                            </a>
                        </div>
                    <?php endwhile; ?>
                </section>
            </section>
            <h1 id="milktea"></h1>
            <h1 class=" text-4xl font-black  sticky top-0 w-full text-center pt-14  pb-2 bg-linear-to-t from-custom-background from-50% to-custom-background/10 to-100% shadow-md z-30">Milk Tea</h1>
            <section class="flex flex-col  items-center overflow-y-scroll h-screen w-full p-4 ">
                <section class="grid grid-cols-2  gap-4 place-contents-center  w-fit  overflow-x-visible scroll-m-32">
                    <?php while ($row = mysqli_fetch_assoc($milk_tea_result)): ?>
                        <div class="group flex flex-col p-2 h-fit hover:bg-linear-to-br from-custom-primary/50 to-custom-accent/20 hover:shadow-lg rounded-2xl gap-2 hover:scale-105 transition-transform duration-300 ease-in-out">
                            <a href="./productPage.php?id=<?= $row['product_id']; ?>" class="">
                                <div class="overflow-hidden rounded-lg">
                                    <img src="image/products/<?= htmlspecialchars($row['product_img']); ?>" alt="<?= htmlspecialchars($row['product_name']); ?>" class="w-full aspect-square object-cover rounded-lg shadow-lg scale-125 transition-transform duration-700 ease-in-out" />
                                </div>
                                <div class="min-h-max duration-300">
                                    <h3 class=" text-black/75 overflow-clip group-hover:text-custom-primary duration-300 leading-none p-1"><?= htmlspecialchars($row['product_name']); ?></h3>
                                    <p class="float-right group-hover:scale-110 font-bold text-black/85 duration-300 mt-">₱<?= number_format($row['price'], 2); ?></p>
                                </div>
                            </a>
                        </div>
                    <?php endwhile; ?>
                </section>
            </section>
            <h1 id="frappe"></h1>
            <h1 class=" text-4xl font-black  sticky top-0 w-full text-center pt-14  pb-2 bg-linear-to-t from-custom-background from-50% to-custom-background/10 to-100% shadow-md z-30">Frappe</h1>
            <section class="flex flex-col  items-center overflow-y-scroll h-screen w-full p-4 ">
                <section class="grid grid-cols-2  gap-4 place-contents-center  w-fit  overflow-x-visible scroll-m-32">
                    <?php while ($row = mysqli_fetch_assoc($frappe_result)): ?>
                        <div class="group flex flex-col p-2 h-fit hover:bg-linear-to-br from-custom-primary/50 to-custom-accent/20 hover:shadow-lg rounded-2xl gap-2 hover:scale-105 transition-transform duration-300 ease-in-out">
                            <a href="./productPage.php?id=<?= $row['product_id']; ?>" class="">
                                <div class="overflow-hidden rounded-lg">
                                    <img src="image/products/<?= htmlspecialchars($row['product_img']); ?>" alt="<?= htmlspecialchars($row['product_name']); ?>" class="w-full aspect-square object-cover rounded-lg shadow-lg scale-125 transition-transform duration-700 ease-in-out" />
                                </div>
                                <div class="min-h-max duration-300">
                                    <h3 class=" text-black/75 overflow-clip group-hover:text-custom-primary duration-300 leading-none p-1"><?= htmlspecialchars($row['product_name']); ?></h3>
                                    <p class="float-right group-hover:scale-110 font-bold text-black/85 duration-300 mt-">₱<?= number_format($row['price'], 2); ?></p>
                                </div>
                            </a>
                        </div>
                    <?php endwhile; ?>
                </section>
            </section>
            <h1 id="shake"></h1>
            <h1 class=" text-4xl font-black  sticky top-0 w-full text-center pt-14  pb-2 bg-linear-to-t from-custom-background from-50% to-custom-background/10 to-100% shadow-md z-30">Shake</h1>
            <section class="flex flex-col  items-center overflow-y-scroll h-screen w-full p-4 ">
                <section class="grid grid-cols-2  gap-4 place-contents-center  w-fit  overflow-x-visible scroll-m-32">
                    <?php while ($row = mysqli_fetch_assoc($shake_result)): ?>
                        <div class="group flex flex-col p-2 h-fit hover:bg-linear-to-br from-custom-primary/50 to-custom-accent/20 hover:shadow-lg rounded-2xl gap-2 hover:scale-105 transition-transform duration-300 ease-in-out">
                            <a href="./productPage.php?id=<?= $row['product_id']; ?>" class="">
                                <div class="overflow-hidden rounded-lg">
                                    <img src="image/products/<?= htmlspecialchars($row['product_img']); ?>" alt="<?= htmlspecialchars($row['product_name']); ?>" class="w-full aspect-square object-cover rounded-lg shadow-lg scale-125 transition-transform duration-700 ease-in-out" />
                                </div>
                                <div class="min-h-max duration-300">
                                    <h3 class=" text-black/75 overflow-clip group-hover:text-custom-primary duration-300 leading-none p-1"><?= htmlspecialchars($row['product_name']); ?></h3>
                                    <p class="float-right group-hover:scale-110 font-bold text-black/85 duration-300 mt-">₱<?= number_format($row['price'], 2); ?></p>
                                </div>
                            </a>
                        </div>
                    <?php endwhile; ?>
                </section>
            </section>
            <h1 id="pastries"></h1>
            <h1 class=" text-4xl font-black  sticky top-0 w-full text-center pt-14  pb-2 bg-linear-to-t from-custom-background from-50% to-custom-background/10 to-100% shadow-md z-30">Pastries</h1>
            <section class="flex flex-col  items-center overflow-y-scroll h-screen w-full p-4 ">
                <section class="grid grid-cols-2  gap-4 place-contents-center  w-fit  overflow-x-visible scroll-m-32">
                    <?php while ($row = mysqli_fetch_assoc($pastries_result)): ?>
                        <div class="group flex flex-col p-2 h-fit hover:bg-linear-to-br from-custom-primary/50 to-custom-accent/20 hover:shadow-lg rounded-2xl gap-2 hover:scale-105 transition-transform duration-300 ease-in-out">
                            <a href="./productPage.php?id=<?= $row['product_id']; ?>" class="">
                                <div class="overflow-hidden rounded-lg">
                                    <img src="image/products/<?= htmlspecialchars($row['product_img']); ?>" alt="<?= htmlspecialchars($row['product_name']); ?>" class="w-full aspect-square object-cover rounded-lg shadow-lg scale-125 transition-transform duration-700 ease-in-out" />
                                </div>
                                <div class="min-h-max duration-300">
                                    <h3 class=" text-black/75 overflow-clip group-hover:text-custom-primary duration-300 leading-none p-1"><?= htmlspecialchars($row['product_name']); ?></h3>
                                    <p class="float-right group-hover:scale-110 font-bold text-black/85 duration-300 mt-">₱<?= number_format($row['price'], 2); ?></p>
                                </div>
                            </a>
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