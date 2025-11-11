<?php
include("./db/sessionStart.php");
include './db/db.php';

if (!$conn || $conn->connect_error) {
    die("Database connection failed: " . ($conn ? $conn->connect_error : 'Unknown error'));
}

$id = (int)$_GET['id'];
if ($id <= 0) {
    die("Invalid Product ID.");
}

$result = $conn->query("SELECT * FROM products WHERE product_id=$id");
$product = $result->fetch_assoc();

$customer_id = 0; // Default for guests

if (isset($_SESSION['customer_user'])) {
    $user_identifier = $_SESSION['customer_user'];

    $stmt_get_id = $conn->prepare("SELECT customer_id FROM users WHERE customer_user = ?");
    $stmt_get_id->bind_param("s", $user_identifier);
    $stmt_get_id->execute();
    $result_id = $stmt_get_id->get_result();

    if ($row = $result_id->fetch_assoc()) {
        $customer_id = (int)$row['customer_id'];
    }
    $stmt_get_id->close();
}
if ($customer_id == 0) {
    $current_quantity = 1;
} else {
    $stmt_qty = $conn->prepare("SELECT quantity FROM cart WHERE customer_id = ? AND product_id = ?");
    $stmt_qty->bind_param("ii", $customer_id, $id);
    $stmt_qty->execute();
    $res_qty = $stmt_qty->get_result();

    if ($row_qty = $res_qty->fetch_assoc()) {
        $current_quantity = $row_qty['quantity'];
    } else {
        $current_quantity = 1;
    }
    $stmt_qty->close();
}
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
    <section class=" w-full min-h-screen justify-center items-center flex pt-20 pb-40 bg-custom-background relative">
        <div class="fixed top-[8%] left-[5%] z-40">
            <a href="./home.php" class="btn btn-circle bg-custom-accent border-none">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-chevron-left-icon lucide-chevron-left stroke-custom-background">
                    <path d="m15 18-6-6 6-6" />
                </svg>
            </a>
        </div>
        <div class="flex flex-col md:flex-row gap-10 w-[90%] justify-center items-center">
            <div class=" w-full justify-center flex gap-4">
                <img src="image/products/<?= $product['product_img']; ?>" class="w-[50%] object-contain h-fit rounded-2xl " alt="<?= htmlspecialchars($product['product_name']); ?>" />
            </div>
            <div class="w-[90%]">
                <div class=" w-full items-center h-full flex flex-col text-center">
                    <h1 class="text-2xl font-bold pb-3 text-custom-accent sticky top-15 bg-custom-background w-full "><?= htmlspecialchars($product['product_name']); ?></h1>
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
                            <input class="btn shadow-none checked:border-custom-accent  checked:bg-custom-accent/25 checked:text-black" type="radio" name="milk" value="Dairy Milk" required aria-label="Dairy Milk">
                            <input class="btn shadow-none checked:border-custom-accent  checked:bg-custom-accent/25 checked:text-black" type="radio" name="milk" value="Oat Milk" aria-label="Oat Milk">
                            <input class="btn shadow-none checked:border-custom-accent  checked:bg-custom-accent/25 checked:text-black" type="radio" name="milk" value="Coconut Milk" aria-label="Coconut Milk">
                        </div>
                    </div>
                    <div>
                        <h1 class=" font-bold mb-2">Espresso Shots</h1>
                        <div class="flex flex-wrap gap-2">
                            <input class="btn shadow-none checked:border-custom-accent  checked:bg-custom-accent/25 checked:text-black" type="radio" name="shots" value="No Shot" required aria-label="No Shot">
                            <input class="btn shadow-none checked:border-custom-accent  checked:bg-custom-accent/25 checked:text-black" type="radio" name="shots" value="LYDIA" aria-label="LYDIA">
                            <input class="btn shadow-none checked:border-custom-accent  checked:bg-custom-accent/25 checked:text-black" type="radio" name="shots" value="BOSS" aria-label="BOSS">
                        </div>
                    </div>
                    <div>
                        <h1 class=" font-bold mb-2">Sweetness</h1>
                        <div class="flex flex-wrap gap-2">
                            <input class="btn shadow-none checked:border-custom-accent  checked:bg-custom-accent/25 checked:text-black" type="radio" name="sweetness" value="Regular Sweet" required aria-label="Regular Sweet">
                            <input class="btn shadow-none checked:border-custom-accent  checked:bg-custom-accent/25 checked:text-black" type="radio" name="sweetness" value="Less Sweet" aria-label="Less Sweet">
                            <input class="btn shadow-none checked:border-custom-accent  checked:bg-custom-accent/25 checked:text-black" type="radio" name="sweetness" value="More Sweet" aria-label="More Sweet">
                        </div>
                    </div>
                    <div>
                        <h1 class=" font-bold mb-2">Ice Level</h1>
                        <div class="flex flex-wrap gap-2">
                            <input class="btn shadow-none checked:border-custom-accent  checked:bg-custom-accent/25 checked:text-black" type="radio" name="ice" value="Normal Ice" required aria-label="Normal Ice">
                            <input class="btn shadow-none checked:border-custom-accent  checked:bg-custom-accent/25 checked:text-black" type="radio" name="ice" value="Less Ice" aria-label="Less Ice">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>

    <section class=" w-full items-center justify-center flex flex-col fixed bottom-0 p-4 bg-custom-background shadow-2xl">
        <div class="flex gap-4 w-[90%] h-full items-center justify-center mb-4">
            <p class="text-2xl font-bold w-full ">₱<?= number_format($product['price'], 2); ?></p>
            <?php if (isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] == true): ?>
                <form method="POST" action="productPage.php?id=<?= $product['product_id']; ?>" class="quantity-form flex">
                    <input type="hidden" name="product_id" value="<?= $product['product_id']; ?>">
                    <input type="hidden" name="current_quantity" class="current-quantity-value" value="<?= $current_quantity; ?>">
                    <div class="quantity-selector flex">
                        <div class="quantity-selector flex">
                            <button type="button" class="minus-btn btn btn-circle size-10 disabled:bg-custom-background  border-custom-accent bg-custom-accent"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-minus-icon lucide-minus ">
                                    <path d="M5 12h14" />
                                </svg></button>
                            <input type="number" class="quantity-input input border-none bg-custom-background shadow-none text-center text-xl font-bold" min="1" max="<?= $product['stock'] ?>" value="<?= $current_quantity ?>">
                            <button type="button" class="plus-btn btn btn-circle size-10 bg-custom-accent border-custom-accent"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-plus-icon lucide-plus">
                                    <path d="M5 12h14" />
                                    <path d="M12 5v14" />
                                </svg></button>
                        </div>
                    </div>
                </form>
            <?php else: ?>
                <a href="./login.php" class="text-sm w-max underline">Click Here To Log In</a>
            <?php endif; ?>
        </div>
        <div class="flex gap-4 w-[90%] items-center justify-center">
            <?php if (isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] == true): ?>
                <form method="POST" action="./functions/buynow.php" class="grow w-1/2">
                    <input type="hidden" name="product_id" value="<?= $product['product_id']; ?>">
                    <button type="submit" class="btn btn-lg border-custom-accent bg-custom-background text-custom-accent w-full rounded-full  text-sm"">Buy Now</button>
                </form>
                <form id=" addToCartForm" method="POST" action="./functions/addtocart.php" class="grow w-1/2">
                        <input type="hidden" name="product_id" value="<?= $product['product_id'] ?>">
                        <input type="hidden" name="quantity" id="hiddenQuantityInput" value="<?= $current_quantity ?>">
                        <button type="submit" class="btn btn-lg bg-custom-accent border-custom-accent rounded-full w-full text-custom-background text-sm">Add To Cart</button>
                </form>
            <?php else: ?>
                <form method="POST" action="./functions/buynow.php" class="grow w-1/2">
                    <input type="hidden" name="product_id" value="<?= $product['product_id']; ?>">
                    <button type="submit" class="btn btn-lg btn-disabled w-full rounded-full">
                        <p class=" text-xs">Log In To Buy Now</p>
                    </button>
                </form>
                <form method="POST" action="./functions/addtocart.php" class="grow w-1/2">
                    <input type="hidden" name="product_id" value="<?= $product['product_id']; ?>">
                    <button type="submit" class="btn btn-lg btn-disabled w-full rounded-full">
                        <p class=" text-xs">Log In For Add To Cart</p>
                    </button>
                </form>
            <?php endif; ?>
        </div>
    </section>
</body>

</html>

<script src="./script/quantity.js"></script>