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

<body class="w-screen overflow-x-hidden">
    <div class="sticky top-0 z-50 w-full backdrop-blur-sm ">
        <?php include './components/header.php'; ?>
    </div>
    <section class="flex flex-col items-center w-full">
        <section class="">
            <div class="carousel w-full">
                <div id="slide1" class="carousel-item relative w-full">
                    <img
                        src="./image/banner.png"
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
        <section class="flex flex-col justify-center items-center gap-12 w-3/4 m-24">
            <h1 class=" text-4xl font-black ">CATEGORIES</h1>
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
        <section class=" w-full min-h-screen flex flex-col  items-center bg-custom-secondary/20">
            <section class="flex flex-col justify-center items-center w-3/4 m-24">
                <h1 class=" text-4xl font-black m-4 my-fadeInCard">Just For You</h1>
                <form class="flex flex-wrap gap-2 p-4">
                    <input class="btn checked:bg-custom-primary/90 grow min-w-[15%] basis-[100px] " type="checkbox" name="frameworks" aria-label="Electronics & Gadgets" />
                    <input class="btn checked:bg-custom-primary/90 grow min-w-[15%] basis-[100px] " type="checkbox" name="frameworks" aria-label="Fashion & Apparel" />
                    <input class="btn checked:bg-custom-primary/90 grow min-w-[15%] basis-[100px] " type="checkbox" name="frameworks" aria-label="Home & Living" />
                    <input class="btn checked:bg-custom-primary/90 grow min-w-[15%] basis-[100px] " type="checkbox" name="frameworks" aria-label="Beauty & Personal Care" />
                    <input class="btn checked:bg-custom-primary/90 grow min-w-[15%] basis-[100px] " type="checkbox" name="frameworks" aria-label="Health & Wellness" />
                    <input class="btn checked:bg-custom-primary/90 grow min-w-[15%] basis-[100px] " type="checkbox" name="frameworks" aria-label="Baby & Kids" />
                    <input class="btn checked:bg-custom-primary/90 grow min-w-[15%] basis-[100px] " type="checkbox" name="frameworks" aria-label="Pet Supplies" />
                    <input class="btn checked:bg-custom-primary/90 grow min-w-[15%] basis-[100px] " type="checkbox" name="frameworks" aria-label="Sports & Outdoors" />
                    <input class="btn checked:bg-custom-primary/90 grow min-w-[15%] basis-[100px] " type="checkbox" name="frameworks" aria-label="Automotive & Tools" />
                    <input class="btn checked:bg-custom-primary/90 grow min-w-[15%] basis-[100px] " type="checkbox" name="frameworks" aria-label="Art & Stationery" />
                    <input class="btn checked:bg-custom-primary/90 grow min-w-[15%] basis-[100px] " type="checkbox" name="frameworks" aria-label="Books & Education" />
                    <input class="btn checked:bg-custom-primary/90 grow min-w-[15%] basis-[100px] " type="checkbox" name="frameworks" aria-label="Food & Beverages" />
                    <input class="btn checked:bg-custom-primary/90 btn-square" type="reset" value="×" />
                </form>
                <section class="grid grid-cols-5 h-full gap-4 place-contents-center content-center w-fit">
                    <?php while ($row = mysqli_fetch_assoc($result)): ?>
                        <div class="group flex flex-col p-4 h-fit hover:bg-linear-to-br from-custom-primary/15 to-color-custom-secondary/35 hover:shadow-lg rounded-2xl gap-2 hover:scale-105 transition-transform duration-300 ease-in-out">
                            <a href="./productPage.php?id=<?= $row['product_id']; ?>" class="">
                                <div class="overflow-hidden rounded-lg">
                                    <img src="image/products/<?= htmlspecialchars($row['product_img']); ?>" alt="<?= htmlspecialchars($row['product_name']); ?>" class="w-full aspect-square object-cover rounded-lg shadow-lg group-hover:scale-110 transition-transform duration-700 ease-in-out" />
                                </div>
                                <div class="min-h-[4lh] mt-2 duration-300 ">
                                    <h3 class="max-h-[2lh] group-hover:max-h-[3lh] text-black/75 overflow-clip group-hover:text-custom-primary duration-300"><?= htmlspecialchars($row['product_name']); ?></h3>
                                    <p class="float-right group-hover:scale-110 font-bold text-black/85 duration-300 mt-">₱<?= number_format($row['price'], 2); ?></p>
                                </div>
                            </a>
                            <div class="flex w-full gap-2">
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
                <div class="join mt-8">
                    <input
                        class="join-item btn btn-square checked:bg-custom-primary/90"
                        type="radio"
                        name="options"
                        aria-label="1"
                        checked="checked" />
                    <input class="join-item btn btn-square checked:bg-custom-primary/90" type="radio" name="options" aria-label="2" />
                    <input class="join-item btn btn-square checked:bg-custom-primary/90" type="radio" name="options" aria-label="3" />
                    <input class="join-item btn btn-square checked:bg-custom-primary/90" type="radio" name="options" aria-label="4" />
                </div>
            </section>
        </section>
        <section class="my-fadeInFooter z-10">
            <?php include './components/footer.html'; ?>
        </section>
</body>

</html>