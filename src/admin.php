<?php
include("./db/sessionStart.php");
include("./db/db.php");

// ----------------------------------------------------------------------
// --- CORRECTED Admin Page Logic ---------------------------------------
// ----------------------------------------------------------------------
if (!isset($_SESSION['customer_user']) || empty($_SESSION['customer_user'])) {
    header("Location: login.php");
    exit();
}

// 1. Get the username from the session
$username_from_session = $_SESSION['customer_user'];

// 2. Query the database using the USERNAME column
$sql_auth = "SELECT customer_id, role FROM users WHERE customer_user = ?";
$stmt = $conn->prepare($sql_auth);

if ($stmt === false) {
    die("SQL Error: Failed to prepare statement for role check. " . $conn->error);
}

$stmt->bind_param("s", $username_from_session);

if (!$stmt->execute()) {
    die("SQL Error: Failed to execute role check query. " . $stmt->error);
}

$result = $stmt->get_result();

// 3. Check if user exists
if ($result->num_rows === 0) {
    session_destroy();
    header("Location: login.php");
    exit();
}

$user = $result->fetch_assoc();
$stmt->close();

// 4. Check for admin role
if ($user['role'] !== 'admin') {
    header("Location: index.php");
    exit();
}

// 5. Store the actual numeric customer_id
$customer_id = (int)$user['customer_id'];

// ----------------------------------------------------------------------
// --- Data Fetching for Admin Orders (All Active) ----------------------
// ----------------------------------------------------------------------
$sql_orders = "SELECT o.*, u.customer_user 
               FROM orders o
               JOIN users u ON o.customer_id = u.customer_id 
               WHERE o.status IN ('Pending','Paid','Shipped','Completed','Cancelled')
               ORDER BY o.order_date DESC";


$orders_result = $conn->query($sql_orders);
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
    <title>HJJC Store | Admin Orders</title>
    <link rel="stylesheet" href="./style/output.css" />
</head>

<body class="w-screen overflow-x-hidden min-h-screen scroll-smooth bg-custom-background">
    <div class="sticky top-0 z-50 ">
        <?php include './components/header.php'; ?>
    </div>
    <section class="container mx-auto max-lg:py-10 lg:py-25">
        <?php
        // --- [REQUIRED] This block displays your success/error messages ---
        if (isset($_SESSION['status_message'])) {
            $msg = $_SESSION['status_message'];
            $color = ($msg['type'] === 'success')
                ? 'bg-green-100 border-green-400 text-green-700'
                : 'bg-red-100 border-red-400 text-red-700';

            echo '<div class="p-4 mb-4 border rounded-lg ' . $color . ' flex justify-between items-center" role="alert">';
            echo '<span>' . htmlspecialchars($msg['text']) . '</span>';
            echo '<button onclick="this.parentNode.remove()" class="text-xl font-bold ml-4 leading-none">&times;</button>';
            echo '</div>';

            unset($_SESSION['status_message']);
        }
        // --- End Flash Message ---
        ?>
        <h1 class="text-3xl font-bold mb-6 text-gray-800">Active Orders</h1>
        <hr>
        <div class="overflow-x-auto bg-white rounded-lg shadow-xl mt-4">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Order ID</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Customer</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date Placed</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total Amount</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    <?php
                    $available_statuses = ['Pending', 'Paid', 'Shipped', 'Completed', 'Cancelled'];
                    // Check if $orders_result is valid before fetching
                    if (isset($orders_result) && $orders_result->num_rows > 0) {
                        $row_index = 0;
                        while ($order = $orders_result->fetch_assoc()) {
                            $row_class = $row_index % 2 === 0 ? 'bg-white' : 'bg-gray-50';
                            $row_index++;
                    ?>
                            <tr class="<?= $row_class; ?>">
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900"><?php echo $order['order_id']; ?></td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><?php echo htmlspecialchars($order['customer_user']); ?></td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><?php echo date("Y-m-d H:i", strtotime($order['order_date'])); ?></td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-gray-900">₱<?php echo number_format($order['total_amount'], 2); ?></td>

                                <td class="px-6 py-4 whitespace-nowrap">
                                    <form method="POST" action="./functions/updatestatus.php" class="flex items-center space-x-2">
                                        <input type="hidden" name="order_id" value="<?php echo $order['order_id']; ?>">

                                        <select name="new_status" class="block w-full py-1.5 pl-2 pr-8 text-sm border border-gray-300 rounded-md focus:border-blue-500 focus:ring-blue-500">
                                            <?php foreach ($available_statuses as $status): ?>
                                                <option value="<?= htmlspecialchars($status); ?>"
                                                    <?= (strtolower($order['status']) == strtolower($status)) ? 'selected' : ''; ?>>
                                                    <?= htmlspecialchars($status); ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>

                                        <button type="submit" name="update_status"
                                            class="text-green-600 hover:text-green-900 border border-green-600 hover:border-green-900 px-3 py-1 text-xs rounded-md transition duration-150">
                                            Update
                                        </button>
                                    </form>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <a href="admin_order_details.php?order_id=<?php echo $order['order_id']; ?>"
                                        class="text-blue-600 hover:text-blue-900 border border-blue-600 hover:border-blue-900 px-3 py-1 text-xs rounded-md transition duration-150">
                                        View Details
                                    </a>
                                </td>
                            </tr>
                    <?php
                        }
                    } else {
                        echo '<tr><td colspan="6" class="px-6 py-4 text-center text-gray-500">No active orders found.</td></tr>';
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </section>
</body>

</html>

<?php
// Ensure resources are closed at the very end
if (isset($orders_result) && $orders_result instanceof mysqli_result) {
    $orders_result->close();
}
$conn->close();
?>