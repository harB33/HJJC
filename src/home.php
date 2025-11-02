<?php 
include("./db/db.php");
date_default_timezone_set('Asia/Manila');

// if (isset($_POST["home"])) { // san ilalagay yung action/post ng home.php
//     $product_name = filter_input(INPUT_POST, "product_name", FILTER_SANITIZE_SPECIAL_CHARS);
//     $price = filter_input(INPUT_POST, "price", FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
//     $product_img = filter_input(INPUT_POST, "product_img", FILTER_SANITIZE_URL);
//     $product_desc = filter_input(INPUT_POST, "product_desc", FILTER_SANITIZE_SPECIAL_CHARS);
//     $category_id = filter_input(INPUT_POST, "category_id", FILTER_SANITIZE_NUMBER_INT);
//     $stock = filter_input(INPUT_POST, "stock", FILTER_SANITIZE_NUMBER_INT);

//     if (empty($product_name) || empty($price) || empty($product_img)|| empty($product_desc) || empty($category_id) || empty($stock)) {
//         die("Error: All fields are required.");
//     }

//     $date = date("Y-m-d H:i:s");

//     $sql = "INSERT INTO products (product_name, price, product_img, product_desc, category_id, stock, created_at, updated_at) 
//     VALUES ('$product_name', '$price', '$product_img', '$product_desc', '$category_id', '$stock', '$date', '$date')";
    

//     $conn->close();
// }

    $sql = "SELECT p.*, c.category_name 
        FROM products p
        JOIN category c ON p.category_id = c.category_id";

    // if (isset($_GET['sort']) && $_GET['sort'] == 'high') {
    //     $sql = "SELECT * FROM products ORDER BY price DESC";
    // } else {
    //     $sql = "SELECT * FROM products";
    // }

    $result = mysqli_query($conn, $sql);

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
</head>

<body class="w-screen overflow-x-hidden">
    <div class="sticky top-0 z-50 ">
        <?php include './components/header.php'; ?>
    </div>

    <section class="flex flex-col items-center w-full min-h-screen">
        <section class="mb-24">
            <div class="carousel w-full">
                <div id="slide1" class="carousel-item relative w-full">
                    <img
                        src="https://img.daisyui.com/images/stock/photo-1625726411847-8cbb60cc71e6.webp"
                        class="w-full" />
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
        </section>
        <section class="flex flex-col justify-center items-center w-3/4 mb-24">
            <h1 class=" text-3xl font-black m-4">CATEGORIES</h1>
            <div class="grid grid-cols-6 place-items-center w-fit gap-4">
                <a href="#" class="size-45 border">Electronics & Gadgets</a>
                <a href="#" class="size-45 border">Fashion & Apparel</a>
                <a href="#" class="size-45 border">Home & Living</a>
                <a href="#" class="size-45 border">Beauty & Personal Care</a>
                <a href="#" class="size-45 border">Health & Wellness</a>
                <a href="#" class="size-45 border">Baby & Kids</a>
                <a href="#" class="size-45 border">Pet Supplies</a>
                <a href="#" class="size-45 border">Sports & Outdoors</a>
                <a href="#" class="size-45 border">Automotive & Tools</a>
                <a href="#" class="size-45 border">Art & Stationery</a>
                <a href="#" class="size-45 border">Books & Education</a>
                <a href="#" class="size-45 border">Food & Beverages</a>
            </div>
        </section>
        <section class="flex flex-col justify-center items-center w-3/4 mb-24">
            <h1 class=" text-3xl font-black m-4 my-fadeInCard">Just For You</h1>
            <section class="grid grid-cols-5 h-full gap-4 place-contents-center content-center w-fit">
                <?php while ($row = mysqli_fetch_assoc($result)): ?>
                    <div class="group flex flex-col p-4 h-fit hover:bg-linear-to-br from-custom-primary/20 to-custom-secondary/40 hover:shadow-lg rounded-2xl gap-2 hover:scale-105 transition-transform duration-300 ease-in-out">
                        <a href="">
                            <img src="image/products/<?= $row['product_img'];?>" class="w-full object-cover rounded-lg shadow-lg "/>
                            <div class="">
                                <h3 class="max-h-[3lh] text-black/75 overflow-clip" ><?= htmlspecialchars($row['product_name']); ?></h3>
                                <p class=" float-right font-bold text-black/85">₱<?= $row['price']; ?></p>
                            </div>
                        </a>
                        <div class="flex w-full gap-2">
                            <button class="btn btn-md rounded-2xl w-3/4 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-shopping-bag-icon lucide-shopping-bag"><path d="M16 10a4 4 0 0 1-8 0"/><path d="M3.103 6.034h17.794"/><path d="M3.4 5.467a2 2 0 0 0-.4 1.2V20a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6.667a2 2 0 0 0-.4-1.2l-2-2.667A2 2 0 0 0 17 2H7a2 2 0 0 0-1.6.8z"/></svg>    
                                Add to Cart
                            </button>
                            <button class="btn btn-md rounded-2xl opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-heart-icon lucide-heart"><path d="M2 9.5a5.5 5.5 0 0 1 9.591-3.676.56.56 0 0 0 .818 0A5.49 5.49 0 0 1 22 9.5c0 2.29-1.5 4-3 5.5l-5.492 5.313a2 2 0 0 1-3 .019L5 15c-1.5-1.5-3-3.2-3-5.5"/></svg>
                            </button>
                        </div>
                    </div>
                <?php endwhile; ?>
        </section>
    </section>

    <section class="my-fadeInFooter z-10">
        <?php include './components/footer.html'; ?>
    </section>
</body>

</html>