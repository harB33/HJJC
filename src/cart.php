<?php
include("./db/sessionStart.php");
include("./db/db.php");

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

$sql_cart =" SELECT c.cart_id, c.product_id, c.customer_id, c.quantity, p.*
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
<body>
    <div class="sticky top-0 z-50 ">
        <?php include './components/header.php'; ?>
    </div>
    <section class="grid grid-cols-[70%_30%] justify-items-center">
        <div class="flex flex-col gap-4 w-full justify-center items-center">
            <?php while ($row = mysqli_fetch_assoc($result)): ?>
                <div class=" w-[60%]">
                    <div class="flex p-4 bg-red-400 w-fit rounded-2xl gap-4">
                        <div class="size-[35%]">
                            <a href="./productPage.php?id=<?= $row['product_id']; ?>" class="w-full" >
                                <img src="image/products/<?= htmlspecialchars($row['product_img']); ?>" alt="<?= htmlspecialchars($row['product_name']); ?>" class=" w-full object-cover rounded-lg shadow-lg group-hover:scale-110 transition-transform duration-700 ease-in-out">
                            </a>
                        </div>
                        <div class="flex gap-4 w-fit">
                            <div class="max-h-[5lh] overflow-hidden">
                                <h1 class="font-bold text-black/75"><?= htmlspecialchars($row['product_name']); ?></h1>
                                <p class=" w-full overflow-hidden"><?= nl2br(htmlspecialchars($row['product_desc'])); ?></p>
                            </div>
                            <div class="flex flex-col justify-evenly">
                                <p class="font-extrabold text-xl" >₱<?= number_format($row['price'], 2); ?></p>
                                <form action="./functions/remove_item.php" method="post">
                                    <input type="hidden" name="remove" value="<?= $row['cart_id']; ?>">
                                    <button type="submit" class="btn btn-sm btn-error">Remove</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- <div class="group flex w-[60%] p-4  hover:bg-linear-to-br from-custom-primary/15 to-color-custom-secondary/35 hover:shadow-lg rounded-2xl gap-2 hover:scale-105 transition-transform duration-300 ease-in-out">
                    <a href="./productPage.php?id=<?= $row['product_id']; ?>" class=" flex items-center justify-center w-full">
                        <div class="overflow-hidden rounded-lg w-[15%]">
                            <img src="image/products/<?= htmlspecialchars($row['product_img']); ?>" alt="<?= htmlspecialchars($row['product_name']); ?>" class=" w-full object-cover rounded-lg shadow-lg group-hover:scale-110 transition-transform duration-700 ease-in-out"/>
                        </div>
                        <div>
                            <h3 class=" text-black/75 overflow-clip group-hover:text-custom-primary duration-300"><?= htmlspecialchars($row['product_name']); ?></h3>
                            <p class="float-right font-bold text-black/85 duration-300">₱<?= number_format($row['price'], 2); ?></p>
                        </div>
                    </a>
                </div> -->
            <?php endwhile; ?>
        </div>
        <div class="bg-red-400 h-3/5">
                asd
        </div>
    </section>
</body>
</html>