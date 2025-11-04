<?php
include './db/db.php';

$user = $_SESSION['customer_user'];
$id = "SELECT customer_id FROM users WHERE customer_user = '$user'";
$res = $conn->query($id);

$row = $res->fetch_assoc();
$customer_id = $row['customer_id'];
echo $customer_id;

$sql =" SELECT
    c.product_id,
    c.customer_id,
    p.*
FROM
    cart c
JOIN
    products p ON c.product_id = p.product_id
WHERE
    c.customer_id = '$customer_id'";

$result = mysqli_query($conn, $sql);

if ($result === false) {
    die("❌ **CART QUERY FAILED!** Check your SQL syntax or column names: " . mysqli_error($conn));
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php while ($row = mysqli_fetch_assoc($result)): ?>
    <div class="group flex flex-col p-4 h-fit hover:bg-linear-to-br from-custom-primary/15 to-color-custom-secondary/35 hover:shadow-lg rounded-2xl gap-2 hover:scale-105 transition-transform duration-300 ease-in-out">
        <a href="./productPage.php?id=<?= $row['product_id']; ?>">
            <div class="overflow-hidden rounded-lg">
                <img src="image/products/<?= htmlspecialchars($row['product_img']); ?>" alt="<?= htmlspecialchars($row['product_name']); ?>" class="w-full object-cover rounded-lg shadow-lg group-hover:scale-110 transition-transform duration-700 ease-in-out"/>
            </div>
            <div class="min-h-[4lh] mt-2 duration-300">
                <h3 class="max-h-[2lh] group-hover:max-h-[3lh] text-black/75 overflow-clip group-hover:text-custom-primary duration-300"><?= htmlspecialchars($row['product_name']); ?></h3>
                <p class="float-right font-bold text-black/85 duration-300">₱<?= number_format($row['price'], 2); ?></p>
            </div>
        </a>
        <div class="flex w-full gap-2 mt-2">
            <button class="btn btn-md rounded-2xl w-3/4 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center gap-2 bg-custom-primary text-white hover:bg-custom-secondary">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-shopping-bag">
                    <path d="M16 10a4 4 0 0 1-8 0"/><path d="M3.103 6.034h17.794"/><path d="M3.4 5.467a2 2 0 0 0-.4 1.2V20a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6.667a2 2 0 0 0-.4-1.2l-2-2.667A2 2 0 0 0 17 2H7a2 2 0 0 0-1.6.8z"/>
                </svg>
                Add to Cart
            </button>
            <button class="btn btn-md rounded-2xl opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center bg-white hover:bg-custom-secondary/40">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-heart text-color-custom-primary">
                    <path d="M2 9.5a5.5 5.5 0 0 1 9.591-3.676.56.56 0 0 0 .818 0A5.49 5.49 0 0 1 22 9.5c0 2.29-1.5 4-3 5.5l-5.492 5.313a2 2 0 0 1-3 .019L5 15c-1.5-1.5-3-3.2-3-5.5"/>
                </svg>
            </button>
        </div>
    </div>
<?php endwhile; ?>
</body>
</html>