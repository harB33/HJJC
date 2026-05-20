<?php
require_once __DIR__ . '/../../config/config.php';

date_default_timezone_set('Asia/Manila');

$best_sellers = []; // We'll need a real query for this eventually
$coffee_items = [];
$milk_tea_items = [];
$frappe_items = [];
$shake_items = [];
$pastries_items = [];

// 2. Run ONE query to get ALL products
$sql = "SELECT p.*, c.category_name, c.category_id
        FROM products p
        JOIN category c ON p.category_id = c.category_id";
$result = mysqli_query($conn, $sql);

// 3. Check if the query worked and has rows
if ($result && mysqli_num_rows($result) > 0) {
    // Loop through the single result ONCE
    while ($row = mysqli_fetch_assoc($result)) {

        // 4. Sort each product into its correct array
        switch ($row['category_id']) {
            case '1':
                $coffee_items[] = $row;
                break;
            case '2':
                $milk_tea_items[] = $row;
                break;
            case '3':
                $frappe_items[] = $row;
                break;
            case '4':
                $shake_items[] = $row;
                break;
            case '5':
                $pastries_items[] = $row;
                break;
        }

        if ($row['category_id'] == '1') {
            $best_sellers[] = $row;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en" data-theme="light">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="<?php echo ASSET_URL; ?>/images/logo.ico" type="image/x-icon">
    <link
        href="https://cdn.jsdelivr.net/npm/daisyui@5"
        rel="stylesheet"
        type="text/css" />
    <title>HJJC. STORE|Menu</title>
    <link rel="stylesheet" href="<?php echo ASSET_URL; ?>/css/output.css" />
</head>

<body class="w-screen overflow-x-hidden scroll-smooth">
    <div class="sticky top-0 z-50 w-full ">
        <!-- Ewan ko kung tama-->
        <?php include VIEW_PATH . '/components/header.php';
        if ($result->num_rows > 0) {
            while ($product = $result->fetch_assoc()) {
            }
        } else {
            // echo "<p class='text-center text-lg'>No products found matching \"" . htmlspecialchars($search_query) . "\"</p>";
        }
        ?>
    </div>
    <section class="flex w-full h-full">
        <section class="flex items-center justify-center h-screen bg-custom-accent sticky top-0 flex-col max-lg:p-2.5 lg:p-4 ">
            <div class="grid grid-cols-1 place-items-center w-fit gap-16 content-center max-lg:5 lg:pt-8 text-center">
                <a href="#bestSeller" class="max-sm:size-12 sm:size-18 flex flex-col text-sm hover:scale-105 duration-300">
                    <div class=" leading-none ">
                        <img src="<?php echo ASSET_URL; ?>/images/best-seller.png" alt="" class="">
                        Best Seller
                    </div>
                </a>
                <a href="#coffee" class="max-sm:size-12 sm:size-18 flex flex-col  text-sm hover:scale-105 duration-300">
                    <div>
                        <img src="<?php echo ASSET_URL; ?>/images/coffee-cup.png" alt="">
                        Coffee
                    </div>
                </a>
                <a href="#milktea" class="max-sm:size-12 sm:size-18 flex flex-col  text-sm hover:scale-105 duration-300">
                    <div>
                        <img src="<?php echo ASSET_URL; ?>/images/bubble-tea.png" alt="">
                        Milk Tea
                    </div>
                </a>
                <a href="#frappe" class="max-sm:size-12 sm:size-18 flex flex-col  text-sm hover:scale-105 duration-300">
                    <div>
                        <img src="<?php echo ASSET_URL; ?>/images/frappe.png" alt="">
                        Frappe
                    </div>
                </a>
                <a href="#shake" class="max-sm:size-12 sm:size-18 flex flex-col  text-sm hover:scale-105 duration-300">
                    <div>
                        <img src="<?php echo ASSET_URL; ?>/images/smoothie.png" alt="">
                        Shake
                    </div>
                </a>
                <a href="#pastries" class="max-sm:size-12 sm:size-18 flex flex-col  text-sm hover:scale-105 duration-300">
                    <div>
                        <img src="<?php echo ASSET_URL; ?>/images/cookie.png" alt="">
                        Pastries
                    </div>
                </a>
            </div>
        </section>
        <section class=" w-full min-h-max flex flex-col  items-center bg-custom-background">
            <h1 id="bestSeller"></h1>
            <h1 class=" max-sm:text-3xl lg:text-5xl font-black  sticky top-0 w-full text-center max-sm:pt-14 pb-2 bg-custom-background shadow-md z-30 flex items-center justify-center lg:pt-24">Best Seller <svg xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-flame-icon lucide-flame fill-custom-accent h-[1em]">
                    <path d="M12 3q1 4 4 6.5t3 5.5a1 1 0 0 1-14 0 5 5 0 0 1 1-3 1 1 0 0 0 5 0c0-2-1.5-3-1.5-5q0-2 2.5-4" />
                </svg></h1>
            <section class="flex flex-col  items-center overflow-y-scroll h-screen w-full max-lg:p-4 lg:p-8 pb-14 bg-linear-to-t from-custom-background from-50% to-custom-background/10 to-100%">
                <section class="grid max-sm:grid-cols-2 max-lg:grid-cols-4 lg:grid-cols-5 max-lg:gap-2 lg:gap-4 place-contents-center w-fit  overflow-x-visible scroll-m-32">
                    <?php foreach ($best_sellers as $row): ?>
                        <div class=" group flex flex-col p-2 h-fit hover:bg-linear-to-br hover:bg-custom-accent/25 hover:outline hover:outline-custom-accent hover:shadow-lg rounded-2xl gap-2 hover:scale-105 transition-transform duration-300 ease-in-out">
                            <a href="<?php echo BASE_URL; ?>/product?id=<?= $row['product_id']; ?>" class=" max-w-[200px]">
                                <div class="overflow-hidden rounded-lg">
                                    <img src="<?php echo ASSET_URL; ?>/images/products/<?= htmlspecialchars($row['product_img']); ?>" alt="<?= htmlspecialchars($row['product_name']); ?>" class="w-full skeleton aspect-square object-cover rounded-lg shadow-lg scale-125 transition-transform duration-700 ease-in-out" />
                                </div>
                                <div class="min-h-max duration-300">
                                    <h3 class=" text-black/75 overflow-clip group-hover:text-custom-primary duration-300 leading-none p-1"><?= htmlspecialchars($row['product_name']); ?></h3>
                                    <p class="float-right group-hover:scale-110 font-bold text-black/85 duration-300 mt-">₱<?= number_format($row['price'], 2); ?></p>
                                </div>
                            </a>
                        </div>
                    <?php endforeach; ?>
                </section>
            </section>
            <h1 id="coffee"></h1>
            <h1 class=" max-sm:text-3xl lg:text-5xl font-black  sticky top-0 w-full text-center max-sm:pt-14 pb-2 bg-custom-background shadow-md z-30 flex items-center justify-center lg:pt-24">Coffee</h1>
            <section class="flex flex-col  items-center overflow-y-scroll h-screen w-full max-lg:p-4 lg:p-8 ">
                <section class="grid max-sm:grid-cols-2 max-lg:grid-cols-4 lg:grid-cols-5 max-lg:gap-2 lg:gap-4 place-contents-center w-fit  overflow-x-visible scroll-m-32">
                    <?php foreach ($coffee_items as $row): ?>
                        <div class="group flex flex-col p-2 h-fit hover:bg-linear-to-br hover:bg-custom-accent/25 hover:outline hover:outline-custom-accent hover:shadow-lg rounded-2xl gap-2 hover:scale-105 transition-transform duration-300 ease-in-out">
                            <a href="<?php echo BASE_URL; ?>/product?id=<?= $row['product_id']; ?>" class="max-w-[200px]">

                                <div class="overflow-hidden rounded-lg">
                                    <img src="<?php echo ASSET_URL; ?>/images/products/<?= htmlspecialchars($row['product_img']); ?>" alt="<?= htmlspecialchars($row['product_name']); ?>" class="w-full aspect-square object-cover rounded-lg shadow-lg scale-125 transition-transform duration-700 ease-in-out" />
                                </div>
                                <div class="min-h-max duration-300">
                                    <h3 class=" text-black/75 overflow-clip group-hover:text-custom-primary duration-300 leading-none p-1"><?= htmlspecialchars($row['product_name']); ?></h3>
                                    <p class="float-right group-hover:scale-110 font-bold text-black/85 duration-300 mt-">₱<?= number_format($row['price'], 2); ?></p>
                                </div>
                            </a>
                        </div>
                    <?php endforeach; ?>
                </section>
            </section>
            <h1 id="milktea"></h1>
            <h1 class=" max-sm:text-3xl lg:text-5xl font-black  sticky top-0 w-full text-center max-sm:pt-14 pb-2 bg-custom-background shadow-md z-30 flex items-center justify-center lg:pt-24">Milk Tea</h1>
            <section class="flex flex-col  items-center overflow-y-scroll h-screen w-full max-lg:p-4 lg:p-8 ">
                <section class="grid max-sm:grid-cols-2 max-lg:grid-cols-4 lg:grid-cols-5 max-lg:gap-2 lg:gap-4 place-contents-center w-fit  overflow-x-visible scroll-m-32">
                    <?php foreach ($milk_tea_items as $row): ?>
                        <div class="group flex flex-col p-2 h-fit hover:bg-linear-to-br hover:bg-custom-accent/25 hover:outline hover:outline-custom-accent hover:shadow-lg rounded-2xl gap-2 hover:scale-105 transition-transform duration-300 ease-in-out">
                            <a href="<?php echo BASE_URL; ?>/product?id=<?= $row['product_id']; ?>" class="max-w-[200px]">

                                <div class="overflow-hidden rounded-lg">
                                    <img src="<?php echo ASSET_URL; ?>/images/products/<?= htmlspecialchars($row['product_img']); ?>" alt="<?= htmlspecialchars($row['product_name']); ?>" class="w-full aspect-square object-cover rounded-lg shadow-lg scale-125 transition-transform duration-700 ease-in-out" />
                                </div>
                                <div class="min-h-max duration-300">
                                    <h3 class=" text-black/75 overflow-clip group-hover:text-custom-primary duration-300 leading-none p-1"><?= htmlspecialchars($row['product_name']); ?></h3>
                                    <p class="float-right group-hover:scale-110 font-bold text-black/85 duration-300 mt-">₱<?= number_format($row['price'], 2); ?></p>
                                </div>
                            </a>
                        </div>
                    <?php endforeach; ?>
                </section>
            </section>
            <h1 id="frappe"></h1>
            <h1 class=" max-sm:text-3xl lg:text-5xl font-black  sticky top-0 w-full text-center max-sm:pt-14 pb-2 bg-custom-background shadow-md z-30 flex items-center justify-center lg:pt-24">Frappe</h1>
            <section class="flex flex-col  items-center overflow-y-scroll h-screen w-full max-lg:p-4 lg:p-8 ">
                <section class="grid max-sm:grid-cols-2 max-lg:grid-cols-4 lg:grid-cols-5 max-lg:gap-2 lg:gap-4 place-contents-center w-fit  overflow-x-visible scroll-m-32">
                    <?php foreach ($frappe_items as $row): ?>
                        <div class="group flex flex-col p-2 h-fit hover:bg-linear-to-br hover:bg-custom-accent/25 hover:outline hover:outline-custom-accent hover:shadow-lg rounded-2xl gap-2 hover:scale-105 transition-transform duration-300 ease-in-out">
                            <a href="<?php echo BASE_URL; ?>/product?id=<?= $row['product_id']; ?>" class="max-w-[200px]">

                                <div class="overflow-hidden rounded-lg">
                                    <img src="<?php echo ASSET_URL; ?>/images/products/<?= htmlspecialchars($row['product_img']); ?>" alt="<?= htmlspecialchars($row['product_name']); ?>" class="w-full aspect-square object-cover rounded-lg shadow-lg scale-125 transition-transform duration-700 ease-in-out" />
                                </div>
                                <div class="min-h-max duration-300">
                                    <h3 class=" text-black/75 overflow-clip group-hover:text-custom-primary duration-300 leading-none p-1"><?= htmlspecialchars($row['product_name']); ?></h3>
                                    <p class="float-right group-hover:scale-110 font-bold text-black/85 duration-300 mt-">₱<?= number_format($row['price'], 2); ?></p>
                                </div>
                            </a>
                        </div>
                    <?php endforeach; ?>
                </section>
            </section>
            <h1 id="shake"></h1>
            <h1 class=" max-sm:text-3xl lg:text-5xl font-black  sticky top-0 w-full text-center max-sm:pt-14 pb-2 bg-custom-background shadow-md z-30 flex items-center justify-center lg:pt-24">Shake</h1>
            <section class="flex flex-col  items-center overflow-y-scroll h-screen w-full max-lg:p-4 lg:p-8 ">
                <section class="grid max-sm:grid-cols-2 max-lg:grid-cols-4 lg:grid-cols-5 max-lg:gap-2 lg:gap-4 place-contents-center w-fit  overflow-x-visible scroll-m-32">
                    <?php foreach ($shake_items as $row): ?>
                        <div class="group flex flex-col p-2 h-fit hover:bg-linear-to-br hover:bg-custom-accent/25 hover:outline hover:outline-custom-accent hover:shadow-lg rounded-2xl gap-2 hover:scale-105 transition-transform duration-300 ease-in-out">
                            <a href="<?php echo BASE_URL; ?>/product?id=<?= $row['product_id']; ?>" class="max-w-[200px]">

                                <div class="overflow-hidden rounded-lg">
                                    <img src="<?php echo ASSET_URL; ?>/images/products/<?= htmlspecialchars($row['product_img']); ?>" alt="<?= htmlspecialchars($row['product_name']); ?>" class="w-full aspect-square object-cover rounded-lg shadow-lg scale-125 transition-transform duration-700 ease-in-out" />
                                </div>
                                <div class="min-h-max duration-300">
                                    <h3 class=" text-black/75 overflow-clip group-hover:text-custom-primary duration-300 leading-none p-1"><?= htmlspecialchars($row['product_name']); ?></h3>
                                    <p class="float-right group-hover:scale-110 font-bold text-black/85 duration-300 mt-">₱<?= number_format($row['price'], 2); ?></p>
                                </div>
                            </a>
                        </div>
                    <?php endforeach; ?>
                </section>
            </section>
            <h1 id="pastries"></h1>
            <h1 class=" max-sm:text-3xl lg:text-5xl font-black  sticky top-0 w-full text-center max-sm:pt-14 pb-2 bg-custom-background shadow-md z-30 flex items-center justify-center lg:pt-24">Pastries</h1>
            <section class="flex flex-col pb-10  items-center overflow-y-scroll h-screen w-full max-lg:p-4 lg:p-8 ">
                <section class="grid max-sm:grid-cols-2 max-lg:grid-cols-4 lg:grid-cols-5 max-lg:gap-2 lg:gap-4 place-contents-center w-fit  overflow-x-visible scroll-m-32">
                    <?php foreach ($pastries_items as $row): ?>
                        <div class="group flex flex-col p-2 h-fit hover:bg-linear-to-br hover:bg-custom-accent/25 hover:outline hover:outline-custom-accent hover:shadow-lg rounded-2xl gap-2 hover:scale-105 transition-transform duration-300 ease-in-out">
                            <a href="<?php echo BASE_URL; ?>/product?id=<?= $row['product_id']; ?>" class="max-w-[200px]">

                                <div class="overflow-hidden rounded-lg">
                                    <img src="<?php echo ASSET_URL; ?>/images/products/<?= htmlspecialchars($row['product_img']); ?>" alt="<?= htmlspecialchars($row['product_name']); ?>" class="w-full aspect-square object-cover rounded-lg shadow-lg scale-125 transition-transform duration-700 ease-in-out" />
                                </div>
                                <div class="min-h-max duration-300">
                                    <h3 class=" text-black/75 overflow-clip group-hover:text-custom-primary duration-300 leading-none p-1"><?= htmlspecialchars($row['product_name']); ?></h3>
                                    <p class="float-right group-hover:scale-110 font-bold text-black/85 duration-300 mt-">₱<?= number_format($row['price'], 2); ?></p>
                                </div>
                            </a>
                        </div>
                    <?php endforeach; ?>
                </section>
            </section>
        </section>
    </section>
    <section class=" z-10">
        <?php include VIEW_PATH . '/components/footer.html'; ?>
    </section>
</body>

</html>