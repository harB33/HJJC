<?php
include("./db/sessionStart.php");
include("./db/db.php");

if (isset($_GET['update_cart_id']) && isset($_GET['new_qty'])) {
    $update_cart_id = filter_var($_GET['update_cart_id'], FILTER_VALIDATE_INT);
    $new_qty = filter_var($_GET['new_qty'], FILTER_VALIDATE_INT);

    // Ensure quantity is not less than 1
    if ($new_qty < 1) {
        $new_qty = 1;
    }

    if ($update_cart_id !== false) {
        $sql_update = "UPDATE cart SET quantity = ? WHERE cart_id = ?";
        $stmt_update = $conn->prepare($sql_update);
        $stmt_update->bind_param("ii", $new_qty, $update_cart_id);
        $stmt_update->execute();
        $stmt_update->close();
    }

    // Redirect to the same page without the GET parameters to prevent re-submission
    header('Location: ' . basename($_SERVER['PHP_SELF']));
    exit;
}

$user = $_SESSION['customer_user'];
$sql_user = "SELECT customer_id FROM users WHERE customer_user = ?";
$stmt_user = $conn->prepare($sql_user);
$stmt_user->bind_param("s", $user);
$stmt_user->execute();
$res = $stmt_user->get_result();

if ($res->num_rows === 0) {
    die("Error: Could not find user.");
}
$row = $res->fetch_assoc();
$customer_id = $row['customer_id'];
$_SESSION['customer_id'] = $customer_id;

$sql_cart = "SELECT c.cart_id, c.product_id, c.customer_id, c.quantity, 
                    c.temperature, c.milk_type, c.espresso_shots, c.sweetness, c.ice_level,
                    p.*
FROM cart c
JOIN products p ON c.product_id = p.product_id
WHERE c.customer_id = ?";

$stmt_cart = $conn->prepare($sql_cart);
$stmt_cart->bind_param("i", $customer_id);
$stmt_cart->execute();
$result = $stmt_cart->get_result();

if ($result === false) {
    die("❌ **CART QUERY FAILED!** Check your SQL syntax or column names: " . mysqli_error($conn));
}

$cart_id_query = "SELECT c.*
                    FROM cart c
                    WHERE c.customer_id = ?";

$stmt_cart_id = $conn->prepare($cart_id_query);
$stmt_cart_id->bind_param("i", $customer_id);
$stmt_cart_id->execute();
$result_cart_id = $stmt_cart_id->get_result();

$cart_row = $result_cart_id->fetch_assoc();

if ($cart_row) {
    $cart_temp = $cart_row['temperature'];
} else {
    $cart_temp = "N/A";
}

$stmt_cart_id->close();

$total = 0;
$cart_items = [];
while ($row = $result->fetch_assoc()) {
    $cart_items[] = $row;
    $total += $row['price'] * $row['quantity'];
}
?>
<!DOCTYPE html>
<html lang="en" data-theme="light">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="./image/logo.ico" type="image/x-icon">
    <link
        href="https://cdn.jsdelivr.net/npm/daisyui@5"
        rel="stylesheet"
        type="text/css" />
    <title>HJJC Store|Cart</title>
    <link rel="stylesheet" href="./style/output.css" />
</head>

<body class="w-screen overflow-x-hidden scroll-smooth">
    <div class="sticky top-0 z-50 ">
        <?php include './components/header.php'; ?>
    </div>
    <section class="flex min-h-screen h-full w-full justify-center items-start pt-20 bg-custom-background">
        <div class="fixed top-[6%] left-[4%] z-40">
            <a href="./home.php" class="btn btn-circle bg-custom-accent border-none">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-arrow-left-icon lucide-arrow-left">
                    <path d="m12 19-7-7 7-7" />
                    <path d="M19 12H5" />
                </svg>
            </a>
        </div>
        <?php
        if (empty($cart_items)) {
            echo '
                <div class="flex w-full fixed top-1/2 left-1/2 -translate-1/2 items-center justify-center gap-4">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-shopping-bag-icon lucide-shopping-bag"><path d="M16 10a4 4 0 0 1-8 0"/><path d="M3.103 6.034h17.794"/><path d="M3.4 5.467a2 2 0 0 0-.4 1.2V20a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6.667a2 2 0 0 0-.4-1.2l-2-2.667A2 2 0 0 0 17 2H7a2 2 0 0 0-1.6.8z"/></svg>
                    Your Bag is Empty
                </div>
                ';
        }
        ?>
        <div class="flex flex-col gap-4 w-[90%] justify-center items-start">
            <?php foreach ($cart_items as $row): ?>
                <div class="w-full rounded-2xl border-custom-accent border-2">
                    <div class="flex p-2.5  size-full justify-between flex-1 rounded-2xl gap-4">
                        <div class="gap-2 flex ">
                            <div class="h-full max-w-[120px]">
                                <a href="./productPage.php?id=<?= $row['product_id']; ?>" class="h-full">
                                    <img src="image/products/<?= htmlspecialchars($row['product_img']); ?>" alt="<?= htmlspecialchars($row['product_name']); ?>" class=" w-full object-cover rounded-lg shadow-lg group-hover:scale-110 transition-transform duration-700 ease-in-out">
                                </a>
                            </div>
                            <div>
                                <h1 class="font-bold text-black/75"><?= htmlspecialchars($row['product_name']); ?></h1>
                                <p class=" w-full overflow-hidden font-medium text-xs leading-tight">
                                    <span class="font-light">Temp: </span><?= htmlspecialchars($row['temperature']); ?><br>
                                    <span class="font-light">Milk: </span><?= htmlspecialchars($row['milk_type']); ?><br>
                                    <span class="font-light">Shots: </span><?= htmlspecialchars($row['espresso_shots']); ?><br>
                                    <span class="font-light">Sweetness: </span><?= htmlspecialchars($row['sweetness']); ?><br>
                                    <span class="font-light">Ice: </span><?= htmlspecialchars($row['ice_level']); ?>
                                </p>
                                <p>
                                    <?php
                                    if (empty($cart_items)) {
                                        echo '
                                    <div class="flex w-full fixed top-1/2 left-1/2 -translate-1/2 items-center justify-center gap-4">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-shopping-bag-icon lucide-shopping-bag"><path d="M16 10a4 4 0 0 1-8 0"/><path d="M3.103 6.034h17.794"/><path d="M3.4 5.467a2 2 0 0 0-.4 1.2V20a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6.667a2 2 0 0 0-.4-1.2l-2-2.667A2 2 0 0 0 17 2H7a2 2 0 0 0-1.6.8z"/></svg>
                                    Your Bag is Empty
                                    </div>
                                    ';
                                    }
                                    ?>
                                </p>
                            </div>
                        </div>
                        <div class="flex gap-4 w-fit">
                            <div class="flex w-fit h-full">
                                <div class="w-fit flex flex-col justify-between h-full">
                                    <div>
                                        <p class="font-extrabold text-xl float-right">₱<?= number_format($row['price'], 2); ?></p>
                                    </div>
                                    <div class="quantity-selector flex items-center">
                                        <a href="?update_cart_id=<?= $row['cart_id']; ?>&new_qty=<?= $row['quantity'] - 1; ?>"
                                            class="btn btn-circle size-6 border-custom-accent bg-custom-accent minus-btn <?= ($row['quantity'] <= 1) ? 'disabled' : ''; ?>"
                                            role="button">
                                            -
                                        </a>
                                        <input type="number"
                                            class="input quantity-input border-none font-bold bg-custom-background text-center w-10 text-xl shadow-none"
                                            value="<?= $row['quantity']; ?>"
                                            min="1" max="100" readonly>
                                        <a href="?update_cart_id=<?= $row['cart_id']; ?>&new_qty=<?= $row['quantity'] + 1; ?>"
                                            class="btn btn-circle size-6 border-custom-accent bg-custom-accent plus-btn"
                                            role="button">
                                            +
                                        </a>
                                    </div>
                                    <div class="">
                                        <form action="./functions/remove_item.php" method="post">
                                            <input type="hidden" name="remove" value="<?= $row['cart_id']; ?>">
                                            <button type="submit" class=" btn-error text-custom-background float-right flex">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-trash2-icon lucide-trash-2 stroke-red-400">
                                                    <path d="M10 11v6" />
                                                    <path d="M14 11v6" />
                                                    <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6" />
                                                    <path d="M3 6h18" />
                                                    <path d="M8 6V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2" />
                                                </svg>
                                                <p class="text-red-400">
                                                </p>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </section>
    <section class=" w-full items-center justify-center flex  fixed bottom-0 p-4 bg-custom-background shadow-2xl">
        <?php if (!empty($cart_items)): ?>
            <div class="flex gap-4 grow w-1/2 items-center justify-center">
                <form method="POST" action="./functions/buynow.php" class="grow w-full">
                    <input type="hidden" name="product_id" value="<?= $product['product_id']; ?>">
                    <button type="submit" class="btn btn-lg border-custom-accent bg-custom-background text-custom-accent w-full rounded-full  text-sm">Buy Now</button>
                </form>
            </div>
            <div class=" w-1/2 grow items-end justify-center flex flex-col">
                <div>
                    <h1 class="text-md font-medium w-full float-right ">Total</h1>
                    <p class="text-2xl font-bold w-full text-custom-accent">₱<?= number_format($total, 2); ?></p>
                </div>
            </div>
        <?php endif; ?>
    </section>
</body>

</html>

<script src="./script/quantity.js"></script>