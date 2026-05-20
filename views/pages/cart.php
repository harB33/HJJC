<?php
require_once __DIR__ . '/../../config/config.php';

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
    header('Location: ' . BASE_URL . '/cart');
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

$sql_address = "SELECT * FROM address WHERE customer_id = ?";
$stmt_address = $conn->prepare($sql_address);
$stmt_address->bind_param("i", $customer_id);
$stmt_address->execute();
$result_address = $stmt_address->get_result();

$customer_address = null;
$selected_address_id = null;
if ($result_address->num_rows > 0) {
    $customer_address = $result_address->fetch_assoc();
    $selected_address_id = $customer_address['address_id'];
}

$stmt_address->close();

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
$total_quantity = 0;
$cart_items = [];

while ($row = $result->fetch_assoc()) {
    $cart_items[] = $row;
    $total += $row['price'] * $row['quantity'];
    $total_quantity += $row['quantity'];
    $price = $row['price'];
    $_SESSION['price'] = $price;
}
$_SESSION['total'] = $total;


?>
<!DOCTYPE html>
<html lang="en" data-theme="light">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="<?php echo ASSET_URL; ?>/images/logo.ico" type="image/x-icon">
    <link
        href="https://cdn.jsdelivr.net/npm/daisyui@5"
        rel="stylesheet"
        type="text/css" />
    <title>HJJC Store|Cart</title>
    <link rel="stylesheet" href="<?php echo ASSET_URL; ?>/css/output.css" />
</head>

<body class="w-screen overflow-x-hidden scroll-smooth">
    <div class="sticky top-0 z-50 ">
        <?php include VIEW_PATH . '/components/header.php'; ?>
    </div>
    <section class="flex flex-col min-h-screen h-full w-full justify-start items-center lg:pt-20 max-lg:pt-10 bg-custom-background">
        <h1 class=" max-lg:text-3xl lg:text-5xl font-extrabold text-custom-text/80 w-full text-center max-lg:py-10 lg:py-15">CHECK OUT</h1>
        <div class="fixed max-lg:top-[6%] max-lg:left-[4%] lg:top-[10%] lg:left-[8%] z-40">
            <a href="<?php echo BASE_URL; ?>/menu" class="btn btn-circle shadow-none bg-custom-accent/20 border-custom-accent border hover:bg-custom-accent duration-300">

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
        <div class="flex flex-col gap-4 w-[90%] max-w-2xl justify-center items-start">
            <div class="w-full rounded-2xl border-custom-accent border shadow-md">
                <div class="flex p-2.5 gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-map-pin-icon lucide-map-pin stroke-custom-text/75">
                        <path d="M20 10c0 4.993-5.539 10.193-7.399 11.799a1 1 0 0 1-1.202 0C9.539 20.193 4 14.993 4 10a8 8 0 0 1 16 0" />
                        <circle cx="12" cy="10" r="3" />
                    </svg>
                    <?php if ($customer_address): ?>
                        <div class="flex flex-col font-extralight w-full">
                            <p class="text-custom-text"><?= htmlspecialchars($user); ?></p>
                            <hr class="dashed border-t border-dotted border-gray-300">
                            <p class=" text-custom-text/55"><?= htmlspecialchars($customer_address['address_name']); ?>, <?= htmlspecialchars($customer_address['address_city']); ?>, <?= htmlspecialchars($customer_address['address_region']); ?>, <?= htmlspecialchars($customer_address['address_brgy']); ?>, <?= htmlspecialchars($customer_address['address_postal']); ?></p>
                        </div>
                    <?php else: ?>
                        <div>
                            <a href="/address-form" class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-circle-plus-icon lucide-circle-plus stroke-custom-text/75">
                                    <circle cx="12" cy="12" r="10" />
                                    <path d="M8 12h8" />
                                    <path d="M12 8v8" />
                                </svg>
                                <span>Add Address</span>
                            </a>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
            <?php foreach ($cart_items as $row): ?>
                <div class="w-full rounded-2xl border-custom-accent border shadow-md">
                    <div class="flex p-2.5  size-full justify-between flex-1 rounded-2xl gap-4 ">
                        <div class="gap-2 flex ">
                            <div class="h-full max-w-[120px]">
                                <a href="/product?id=<?= $row['product_id']; ?>" class="h-full">
                                    <img src="<?php echo ASSET_URL; ?>/images/products/<?= htmlspecialchars($row['product_img']); ?>" alt="<?= htmlspecialchars($row['product_name']); ?>" class=" w-full object-cover rounded-lg shadow group-hover:scale-110 transition-transform duration-700 ease-in-out">

                                </a>
                            </div>
                            <div class="flex flex-col justify-between">
                                <div>
                                    <h1 class="font-bold text-lg text-black/75"><?= htmlspecialchars($row['product_name']); ?></h1>
                                    <?php if ($row['category_id'] < 5): ?>
                                        <p class="text-gray-600 text-md">
                                            <?php
                                            $customizations = [];
                                            if (!empty($row['temperature'])) {
                                                $customizations[] = htmlspecialchars($row['temperature']);
                                            }
                                            if (!empty($row['milk_type'])) {
                                                $customizations[] = htmlspecialchars($row['milk_type']);
                                            }
                                            if (!empty($row['sweetness'])) {
                                                $customizations[] = htmlspecialchars($row['sweetness']);
                                            }
                                            if (!empty($row['ice_level'])) {
                                                $customizations[] = htmlspecialchars($row['ice_level']);
                                            }
                                            if (!empty($customizations)) {
                                                echo implode(' | ', $customizations);
                                            }
                                            ?>
                                        </p>
                                    <?php endif; ?>
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
                                <div class="quantity-selector flex items-center">
                                    <a href="?update_cart_id=<?= $row['cart_id']; ?>&new_qty=<?= $row['quantity'] - 1; ?>"
                                        class="btn btn-circle size-6 border-custom-accent bg-custom-accent minus-btn <?= ($row['quantity'] <= 1) ? 'disabled' : ''; ?>"
                                        role="button">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-minus-icon lucide-minus stroke-custom-background">
                                            <path d="M5 12h14" />
                                        </svg>
                                    </a>
                                    <input type="number"
                                        class="input quantity-input border-none font-medium bg-custom-background text-center w-15 text-sm shadow-none"
                                        value="<?= $row['quantity']; ?>"
                                        min="1" max="100" readonly>
                                    <a href="?update_cart_id=<?= $row['cart_id']; ?>&new_qty=<?= $row['quantity'] + 1; ?>"
                                        class="btn btn-circle size-6 border-custom-accent bg-custom-accent plus-btn"
                                        role="button">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-plus-icon lucide-plus stroke-custom-background">
                                            <path d="M5 12h14" />
                                            <path d="M12 5v14" />
                                        </svg>
                                    </a>
                                </div>
                            </div>

                        </div>
                        <div class="flex gap-4 w-fit">
                            <div class="flex w-fit h-full">
                                <div class="w-fit flex flex-col justify-between h-full">
                                    <div>
                                        <p class="font-bold text-lg text-black/80 float-right">₱<?= number_format($row['price'], 2); ?></p>
                                    </div>

                                    <div class="">
                                        <form action="<?php echo BASE_URL; ?>/public/handlers/remove_item.php" method="post">

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
            <?php if (!empty($cart_items)): ?>
                <div class="w-full rounded-2xl border-custom-accent border p-2.5 mb-40 shadow-md ">
                    <h1 class="pb-2.5">Paymenth Method</h1>
                    <form action="/cart" class="grid grid-cols-2 place-items-center gap-2.5 h-[15vh]">
                        <div class="relative flex flex-col w-full h-full max-w-sm">
                            <input type="radio" name="paymentMethod" id="cod-radio" class="hidden peer" value="cod">
                            <label
                                for="cod-radio" class="w-full h-full cursor-pointer border border-transparent rounded-2xl duration-300 peer-checked:bg-custom-accent">
                                <div class="w-full h-full bg-custom-background rounded-2xl peer-checked:bg-custom-accent">
                                    <div
                                        class="w-full text-center text-black/75 h-full bg-custom-accent/15  text-xl font-black border-custom-accent/0 border-2 rounded-2xl duration-300   flex items-end justify-center pb-2.5  peer-checked:ring-2 peer-checked:ring-custom-accent peer-checked:border-2   peer-checked:text-custom-background peer-checked:bg-transparent">
                                        CASH ON DELIVERY
                                    </div>
                                </div>
                                <span class="absolute inset-y-0 top-[30%] -translate-y-[50%] left-[50%] -translate-x-[50%] flex h-full items-center text-gray-400 pointer-events-none peer-checked:text-white">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-wallet size-[90%] stroke-custom-accent peer-checked:stroke-custom-background">
                                        <path d="M19 7V4a1 1 0 0 0-1-1H5a2 2 0 0 0 0 4h15a1 1 0 0 1 1 1v4h-3a2 2 0 0 0 0 4h3a1 1 0 0 0 1-1v-2a1 1 0 0 0-1-1" />
                                        <path d="M3 5v14a2 2 0 0 0 2 2h15a1 1 0 0 0 1-1v-4" />
                                    </svg>
                                </span>
                            </label>
                        </div>
                        <div class="relative flex flex-col w-full h-full max-w-sm">
                            <input
                                type="radio"
                                name="paymentMethod"
                                id="cc-radio"
                                class="hidden peer"
                                value="cc">
                            <label
                                for="cc-radio"
                                class="w-full h-full cursor-pointer border border-transparent rounded-2xl duration-300 peer-checked:bg-custom-accent">
                                <div class="w-full h-full bg-custom-background rounded-2xl peer-checked:bg-custom-accent">
                                    <div
                                        class="w-full text-center text-black/75 h-full text-xl bg-custom-accent/15 font-black border-none rounded-2xl duration-300   flex items-end justify-center pb-2.5  peer-checked:ring-2 peer-checked:ring-custom-accent    peer-checked:text-custom-background peer-checked:bg-transparent">
                                        CREDIT CARD
                                    </div>
                                </div>
                                <span class="absolute inset-y-0 top-[30%] -translate-y-[50%] left-[50%] -translate-x-[50%] flex h-full items-center text-gray-400 pointer-events-none peer-checked:text-white">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-credit-card size-[90%] stroke-custom-accent peer-checked:stroke-custom-background">
                                        <rect width="20" height="14" x="2" y="5" rx="2" />
                                        <line x1="2" x2="22" y1="10" y2="10" />
                                    </svg>
                                </span>
                            </label>
                        </div>
                    </form>
                </div>
            <?php else: ?>
            <?php endif; ?>
        </div>
    </section>
    <section class="w-full  items-center justify-center flex fixed bottom-0 p-4 bg-custom-background shadow-2xl">
        <?php if (!empty($cart_items)): ?>
            <form method="POST" action="/orders" class="flex gap-4 max-w-2xl grow w-full items-center justify-center">
                <input type="hidden" name="total_amount" value="<?= $total; ?>">
                <input type="hidden" name="selected_address_id" value="<?= htmlspecialchars($selected_address_id ?? ''); ?>">
                <input type="hidden" name="payment_method" id="hiddenPaymentMethod" value="">
                <div class="flex gap-4 grow w-1/2 items-center justify-center">
                    <button
                        type="submit"
                        name="place_order"
                        class="btn btn-lg border-custom-accent bg-custom-accent btn-ghost  w-full rounded-full text-sm"
                        <?php if (!$selected_address_id): ?>disabled<?php endif; ?>>
                        <?= (!$selected_address_id) ? 'Add Address to Buy' : 'Buy Now'; ?>
                    </button>
                </div>
                <div class=" w-1/2 grow items-end justify-center flex flex-col">
                    <div>
                        <h1 class="text-sm font-medium w-full float-right flex justify-between">Quantity: <span><?php echo $total_quantity ?></span> </h1>
                        <h1 class="text-sm font-medium w-full float-right ">Total:</h1>
                        <p class="text-2xl font-bold w-full text-custom-accent">₱<?= number_format($total, 2); ?></p>
                    </div>
                </div>
            </form>
        <?php endif; ?>
    </section>
</body>

</html>

<script src="<?php echo ASSET_URL; ?>/js/quantity.js"></script>
