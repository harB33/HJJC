<?php
include("./db/sessionStart.php");
include './db/db.php';

$id = $_GET['id'];
$result = $conn->query("SELECT * FROM products WHERE product_id='$id'");
$product = $result->fetch_assoc();

if (!isset($_SESSION['customer_id']) || $_SESSION['customer_id'] == 0) {
    $current_quantity = 0; // guest, cannot persist
} else {
    $customer_id = $_SESSION['customer_id'];

    // fetch current quantity from DB
    $stmt_qty = $conn->prepare("SELECT quantity FROM cart WHERE customer_id = ? AND product_id = ?");
    $stmt_qty->bind_param("ii", $customer_id, $id);
    $stmt_qty->execute();
    $res_qty = $stmt_qty->get_result();

    if ($row_qty = $res_qty->fetch_assoc()) {
        $current_quantity = $row_qty['quantity'];
    } else {
        // FIX APPLIED: If not in the cart, default to 1 for display only.
        // DO NOT automatically insert the item into the DB here.
        $current_quantity = 1;
    }

    $stmt_qty->close();
}

// --- HANDLE POST SUBMISSION (UPDATE/INSERT for +/- buttons) ---
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['product_id'], $_POST['action'])) {
    $product_id = (int)$_POST['product_id'];
    $action = $_POST['action'];

    // Fetch current quantity from DB
    $stmt = $conn->prepare("SELECT cart_id, quantity FROM cart WHERE customer_id = ? AND product_id = ?");
    $stmt->bind_param("ii", $customer_id, $product_id);
    $stmt->execute();
    $res = $stmt->get_result();
    $item = $res->fetch_assoc();
    $stmt->close();

    $current_qty = $item ? (int)$item['quantity'] : 1;
    $cart_id = $item ? $item['cart_id'] : null;

    // Update quantity
    if ($action === 'increase') $current_qty++;
    if ($action === 'decrease') $current_qty = max(1, $current_qty - 1);

    // Insert or update DB
    if ($cart_id) {
        $stmt = $conn->prepare("UPDATE cart SET quantity = ? WHERE cart_id = ?");
        $stmt->bind_param("ii", $current_qty, $cart_id);
        $stmt->execute();
        $stmt->close();
    } else {
        // Correctly inserts the new quantity when using the +/- buttons
        $stmt = $conn->prepare("INSERT INTO cart (customer_id, product_id, quantity) VALUES (?, ?, ?)");
        $stmt->bind_param("iii", $customer_id, $product_id, $current_qty);
        $stmt->execute();
        $stmt->close();
    }

    // Use a cache-buster for reliable redirection
    header("Location: productPage.php?id=$product_id&cache_bust=" . time());
    exit;
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
                        <button type="submit"
                            name="action"
                            value="decrease"
                            class="btn btn-circle border-custom-accent disabled:bg-custom-background disabled:border-custom-accent bg-custom-accent minus-btn"
                            <?= ($current_quantity <= 1) ? 'disabled' : ''; ?>> -
                        </button>
                        <input type="number"
                            class="input quantity-input border-none font-bold bg-custom-background text-center w-20 text-xl"
                            value="<?= $current_quantity; ?>" min="1" max="100" readonly>
                        <button type="submit"
                            name="action"
                            value="increase"
                            class="btn btn-circle border-custom-accent bg-custom-accent plus-btn">
                            +
                        </button>
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
                    <button type="submit" class="btn btn-lg border-custom-accent bg-custom-background text-custom-accent w-full rounded-full">Buy Now</button>
                </form>
                <form id="addToCartForm" method="POST" action="./functions/addtocart.php" class="grow w-1/2">
                    <input type="hidden" name="product_id" value="<?= $product['product_id']; ?>">
                    <input type="hidden" name="quantity" id="hiddenQuantityInput" value="<?= $current_quantity; ?>">
                    <button type="submit" class="btn btn-lg border-custom-accent bg-custom-accent  text-custom-background  w-full rounded-full">Add To Cart</button>
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