<?php
// DB and Session are handled by config.php via index.php


require_once BASE_PATH . '/vendor/autoload.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
use Mpdf\Mpdf;

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['place_order'])) {

    $success = true;
    $order_id = null; 

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

        $sql_price = "SELECT price FROM products WHERE product_id = ?";
        $stmt_price = $conn->prepare($sql_price);


        while ($item = $cart_result->fetch_assoc()) {
            $product_id = $item['product_id'];
            $stmt_price->bind_param("i", $product_id);
            $stmt_price->execute();
            $price_result = $stmt_price->get_result();
            $price_row = $price_result->fetch_assoc();
            
            if (!$price_row) {
                 throw new Exception("Product price not found for ID: " . $product_id);
            }
            $product_price = $price_row['price'];

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
                $product_price 
            );
            
            if (!$stmt_details->execute()) {
                throw new Exception("Order detail insertion failed.");
            }
        }
        
        $stmt_details->close();
        $stmt_cart_data->close();
        $stmt_price->close();

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
    
    if ($success && $order_id !== null) { 
        $user = $_SESSION['customer_user'];
        $sql_user = "SELECT customer_email, customer_firstname FROM users WHERE customer_user = ?"; 
        $stmt_user = $conn->prepare($sql_user);
        $stmt_user->bind_param("s", $user);
        $stmt_user->execute();
        $res = $stmt_user->get_result();

        if ($res->num_rows === 0) {
            error_log("Error: Could not find user for email.");
        } else {
            $row = $res->fetch_assoc();
            $customer_email = $row['customer_email'];
            $customer_name = $row['customer_firstname'];
            $stmt_user->close();
            
            $orderStatus = 'Pending';
            $orderConfirmationId = $order_id; 
            
            $mailResult = sendOrderConfirmation($customer_email, $customer_name, $orderConfirmationId, $orderStatus);
            if ($mailResult !== true) {
                error_log("Email sending failed for Order #$orderConfirmationId: " . $mailResult);
            }
        }
    }
    
    // $conn->close();
}

function sendOrderConfirmation($email, $firstName, $orderId, $orderStatus)
{
    $mail = new PHPMailer(true);

    try {
        $mail->SMTPDebug = SMTP::DEBUG_OFF;
        $mail->isSMTP();
        $mail->Host = "smtp.gmail.com";
        $mail->SMTPAuth = true;
        $mail->Username = "hjjc.store@gmail.com";
        $mail->Password = "xxhx nkiw bwsi erwb";
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->Port = 465;

        $mail->setFrom("hjjc.store@gmail.com", "HJJC STORE");
        $mail->addAddress($email);

        $mail->isHTML(true);
        $mail->Subject = "Your HJJC Store Order Confirmation #$orderId"; 

        $imagePath = BASE_PATH . '/public/assets/images/logo/Coffee_Logo.png'; 

        $mail->addEmbeddedImage(
            $imagePath,   
            'logo-hjjc',    
            'Coffee_Logo.png', 
            'base64',       
            'image/png'   
        );

        $mail->Body = '
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <style>
                body {
                    margin: 0;
                    padding: 0;
                    background-color: #f8f9fa; /* Light grey background */
                    font-family: Arial, sans-serif;
                }
                table {
                    border-collapse: collapse;
                }
                .wrapper {
                    width: 100%;
                    padding: 40px 0;
                }
                .container {
                    width: 90%;
                    max-width: 600px;
                    margin: 0 auto;
                    background-color: #ffffff;
                    border: 1px solid #e9ecef;
                    border-radius: 8px; /* Supported by many modern clients */
                    overflow: hidden;
                }
                .header {
                    text-align: center;
                    padding: 40px;
                    border-bottom: 1px solid #e9ecef;
                }
                .content {
                    padding: 40px;
                    font-size: 16px;
                    line-height: 1.6;
                    color: #333;
                }
                .content p {
                    margin: 0 0 20px 0;
                }
                .code {
                    font-size: 24px;
                    font-weight: bold;
                    color: #0d6efd; /* Blue */
                }
                .footer {
                    text-align: center;
                    padding: 30px 40px;
                    font-size: 14px;
                    color: #888;
                    background-color: #f8f9fa;
                }
            </style>
        </head>
        <body>
            <table class="wrapper" border="0" cellpadding="0" cellspacing="0" width="100%">
                <tr>
                    <td align="center">
                        <table class="container" border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;">
                            <tr>
                                <td class="header" align="center">
                                    <img src="cid:logo-hjjc" alt="HJJC Store Logo" style="width: 120px;">
                                </td>
                            </tr>
                            <tr>
                                <td class="content">
                                    <p>Hi<strong> ' . htmlspecialchars($firstName) . '</strong>,</p>
                                    <p>Your order has been successfully placed!</p>
                                    <p>Your Order #<strong>' . htmlspecialchars($orderId) . '</strong> is currently <strong> ' . htmlspecialchars($orderStatus) . ' </strong>.</p>
                                    <br>
                                </td>
                            </tr>
                            <tr>
                                <td class="footer" align="center">
                                    <p>&copy; ' . date("Y") . ' HJJC Store. All rights reserved.</p>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </body>
        </html>
        ';

        $mail->AltBody = "Hi $firstName, your order #$orderId has been successfully placed and is currently $orderStatus. You can track your order status on your orders page."; 

        $mail->send();
        return true;
    } catch (Exception $e) {
        return "Mailer Error: " . $mail->ErrorInfo;
    }
}
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
    <title>HJJC Store|Orders</title>
    <link rel="stylesheet" href="<?php echo ASSET_URL; ?>/css/output.css" />

</head>

<body class="w-screen overflow-x-hidden scroll-smooth bg-custom-background">
    <div class="sticky top-0 z-50 ">
        <?php include VIEW_PATH . '/components/header.php'; ?>

    </div>
    <section class="flex flex-col min-h-screen h-full w-full justify-start items-center lg:pt-20 max-lg:pt-10 bg-custom-background">
        <div class="fixed max-lg:top-[6%] max-lg:left-[4%] lg:top-[10%] lg:left-[8%] z-40">
            <a href="<?php echo BASE_URL; ?>/home" class="btn btn-circle shadow-none bg-custom-accent/20 border-custom-accent border hover:bg-custom-accent duration-300">

                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-arrow-left-icon lucide-arrow-left">
                    <path d="m12 19-7-7 7-7" />
                    <path d="M19 12H5" />
                </svg>
            </a>
        </div>
        <h1 class="max-lg:text-3xl lg:text-5xl font-extrabold text-custom-text/80 w-full text-center max-lg:py-10 lg:py-15">Orders</h1>
        <div class="orders-list-container w-full max-w-2xl px-4 md:px-0">
            <?php
            
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
                
                while ($order = $orders_result->fetch_assoc()) {
                    $order_id = $order['order_id'];
            ?>
                    <div class="order-card p-4 mb-5 rounded-lg border border-custom-accent bg-custom-background shadow-md">
                        <div class="order-header flex justify-between items-start pb-2 mb-3 border-b border-gray-200">
                            <div>
                                <h3 class="text-xl font-bold m-0 text-custom-text/80">Order #<?php echo $order['order_id']; ?></h3>
                                <p class="text-sm text-custom-text/50 m-0">Placed on: <?php echo date("F j, Y, g:i a", strtotime($order['order_date'])); ?></p>
                            </div>
                            <div class="flex items-center">
                                <span class="order-status font-semibold px-3 py-1 rounded-full text-sm bg-custom-accent/20 text-custom-accent">
                                    <?php echo htmlspecialchars($order['status']); ?>
                                </span>
                            </div>
                        </div>
                        <div class="order-body">
                            <p class="mb-3">
                                <strong class="text-lg text-custom-text/75">Total Amount: ₱<?php echo number_format($order['total_amount'], 2); ?></strong>
                            </p>
                            <h4 class="text-custom-text/50 font-semibold mb-2">Items in this order:</h4>
                            <ul class="list-none p-0">
                                <?php
                                
                                $sql_get_details = "SELECT od.*, p.product_name, p.product_img 
                                                    FROM order_details od
                                                    JOIN products p ON od.product_id = p.product_id 
                                                    WHERE od.order_id = ?";

                                $stmt_get_details = $conn->prepare($sql_get_details);
                                $stmt_get_details->bind_param("i", $order_id);
                                $stmt_get_details->execute();
                                $details_result = $stmt_get_details->get_result();

                                while ($item = $details_result->fetch_assoc()) {
                                ?>
                                    <li class="py-2 border-b border-dashed border-gray-200 flex items-center gap-3">
                                        <img src="<?php echo ASSET_URL; ?>/images/products/<?= htmlspecialchars($item['product_img']); ?>"

                                            alt="<?= htmlspecialchars($item['product_name']); ?>"
                                            class="size-24 object-cover rounded-md shrink-0">
                                        <div class="grow">
                                            <div class="flex justify-between items-start">
                                                <strong class="text-custom-text/75">
                                                    (<?php echo $item['quantity']; ?>x) <?php echo htmlspecialchars($item['product_name']); ?>
                                                </strong>
                                                <span class="text-base font-semibold text-custom-accent">
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
                                }
                                $stmt_get_details->close();
                                ?>
                            </ul>
                        </div>
                        
                    </div>
            <?php
                }
            }
            $stmt_get_orders->close();
            ?>
        </div>
    </section>
</body>

</html>