<?php
include("./db/sessionStart.php");
include("./db/db.php");

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['place_order'])) {

    $success = true;

    $customer_id = (int)$_SESSION['customer_id'];
    $address_id = (int)$_POST['selected_address_id'];
    $total_amount = $_SESSION['total'];
    $conn->begin_transaction();

    try {
        $sql_order = "INSERT INTO orders (customer_id, total_amount, address_id, status) 
                  VALUES (?, ?, ?, 'Pending')";
        $stmt_order = $conn->prepare($sql_order);
        $stmt_order->bind_param("idi", $customer_id, $total_amount, $address_id);

        if (!$stmt_order->execute()) {
            throw new Exception("Order insertion failed: " . $stmt_order->error);
        }

        $order_id = $conn->insert_id;
        $stmt_order->close();

        $sql_cart_data = "SELECT product_id, temperature, milk_type, espresso_shots, sweetness, ice_level, quantity
                      FROM cart WHERE customer_id = ?";
        $stmt_cart_data = $conn->prepare($sql_cart_data);
        $stmt_cart_data->bind_param("i", $customer_id);
        $stmt_cart_data->execute();
        $cart_result = $stmt_cart_data->get_result();

        $sql_details = "INSERT INTO order_details (order_id, product_id, quantity, temperature, milk_type, espresso_shots, sweetness, ice_level, price) 
                    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt_details = $conn->prepare($sql_details);

        while ($item = $cart_result->fetch_assoc()) {
            $stmt_details->bind_param(
                "iiisssssd",
                $order_id,
                $item['product_id'],
                $item['quantity'],
                $item['temperature'],
                $item['milk_type'],
                $item['espresso_shots'],
                $item['sweetness'],
                $item['ice_level'],
                $_SESSION['price']
            );
            if (!$stmt_details->execute()) {
                throw new Exception("Order detail insertion failed.");
            }
        }
        $stmt_details->close();
        $stmt_cart_data->close();

        $sql_clear = "DELETE FROM cart WHERE customer_id = ?";
        $stmt_clear = $conn->prepare($sql_clear);
        $stmt_clear->bind_param("i", $customer_id);

        if (!$stmt_clear->execute()) {
            throw new Exception("Cart clear failed.");
        }

        $stmt_clear->close();
        $conn->commit();
    } catch (Exception $e) {
        $conn->rollback();
        $success = false;
        error_log("Checkout Error: " . $e->getMessage());
    }
    $conn->close();

    if ($success) {
        header("Location: ./orders.php");
    } else {
        header("Location: ./orders.php?error=payment_failed");
    }
    exit();
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
    <title>HJJC Store|Orders</title>
    <link rel="stylesheet" href="./style/output.css" />
</head>

<body class="w-screen overflow-x-hidden scroll-smooth bg-custom-background">
    <div class="sticky top-0 z-50 ">
        <?php include './components/header.php'; ?>
    </div>
    <section class="flex flex-col min-h-screen h-full w-full justify-start items-center pt-20 bg-custom-background">
        <h1 class="text-3xl font-bold mb-8 text-gray-800">Orders</h1>
        <div class="orders-list-container w-full max-w-2xl px-4 md:px-0">
            <?php
            // 1. Fetch Orders for the current customer
            $customer_id = (int)$_SESSION['customer_id'];
            $sql_get_orders = "SELECT order_id, total_amount, status, order_date 
                                FROM orders 
                                WHERE customer_id = ? 
                                ORDER BY order_date DESC";

            $stmt_get_orders = $conn->prepare($sql_get_orders);
            $stmt_get_orders->bind_param("i", $customer_id);
            $stmt_get_orders->execute();
            $orders_result = $stmt_get_orders->get_result();

            if ($orders_result->num_rows == 0) {
                echo "<p class='text-center text-gray-500'>You have not placed any orders yet.</p>";
            } else {
                // 2. Loop through each ORDER
                while ($order = $orders_result->fetch_assoc()) {
                    $order_id = $order['order_id'];
            ?>
                    <div class="order-card p-4 mb-5 rounded-lg border border-gray-200 bg-custom-background shadow-md">
                        <div class="order-header flex justify-between items-start pb-2 mb-3 border-b border-gray-200">
                            <div>
                                <h3 class="text-xl font-bold m-0">Order #<?php echo $order['order_id']; ?></h3>
                                <p class="text-sm text-gray-500 m-0">Placed on: <?php echo date("F j, Y, g:i a", strtotime($order['order_date'])); ?></p>
                            </div>
                            <div class="flex items-center">
                                <span class="order-status font-semibold px-3 py-1 rounded-full text-sm bg-gray-100 text-gray-700">
                                    <?php echo htmlspecialchars($order['status']); ?>
                                </span>
                            </div>
                        </div>
                        <div class="order-body">
                            <p class="mb-3">
                                <strong class="text-lg text-gray-900">Total Amount: ₱<?php echo number_format($order['total_amount'], 2); ?></strong>
                            </p>
                            <h4 class="text-base font-semibold mb-2">Items in this order:</h4>
                            <ul class="list-none p-0">
                                <?php
                                // 3. Inner query to fetch DETAILS (items) for this specific order
                                $sql_get_details = "SELECT od.*, p.product_name, p.product_img 
                                                    FROM order_details od
                                                    JOIN products p ON od.product_id = p.product_id 
                                                    WHERE od.order_id = ?";

                                $stmt_get_details = $conn->prepare($sql_get_details);
                                $stmt_get_details->bind_param("i", $order_id);
                                $stmt_get_details->execute();
                                $details_result = $stmt_get_details->get_result();

                                // 4. Loop through each ITEM in the order
                                while ($item = $details_result->fetch_assoc()) {
                                ?>
                                    <li class="py-2 border-b border-dashed border-gray-200 flex items-center gap-3">
                                        <img src="image/products/<?= htmlspecialchars($item['product_img']); ?>"
                                            alt="<?= htmlspecialchars($item['product_name']); ?>"
                                            class="size-24 object-cover rounded-md shrink-0">
                                        <div class="grow">
                                            <div class="flex justify-between items-start">
                                                <strong class="text-gray-900">
                                                    (<?php echo $item['quantity']; ?>x) <?php echo htmlspecialchars($item['product_name']); ?>
                                                </strong>
                                                <span class="text-base font-semibold text-[--color-custom-accent]">
                                                    ₱<?php echo number_format($item['price'] * $item['quantity'], 2); ?>
                                                </span>
                                            </div>
                                            <div class="pl-0 text-sm text-gray-600">
                                                <?php
                                                $customizations = [];
                                                if (!empty($item['temperature'])) {
                                                    $customizations[] = htmlspecialchars($item['temperature']);
                                                }
                                                if (!empty($item['milk_type'])) {
                                                    $customizations[] = htmlspecialchars($item['milk_type']);
                                                }
                                                if (!empty($item['sweetness'])) {
                                                    $customizations[] = htmlspecialchars($item['sweetness']);
                                                }
                                                if (!empty($item['ice_level'])) {
                                                    $customizations[] = htmlspecialchars($item['ice_level']);
                                                }
                                                if (!empty($customizations)) {
                                                    echo implode(' | ', $customizations);
                                                }
                                                ?>
                                            </div>
                                        </div>
                                    </li>
                                <?php
                                } // End of item loop
                                $stmt_get_details->close();
                                ?>
                            </ul>
                        </div>
                    </div>
            <?php
                } // End of order loop
            }
            $stmt_get_orders->close();
            ?>
        </div>
    </section>
</body>

</html>