<?php
// functions/updatestatus.php
include("../db/sessionStart.php");
include("../db/db.php");

// Redirect URL
$redirect_url = "../admin.php";

// Default feedback
$message_type = 'error';
$message_text = 'An unknown error occurred.';

/**
 * Robust trim function — removes spaces, tabs, newlines, NBSPs, zero-width spaces
 */
function robust_trim($string)
{
    if (!isset($string)) return '';
    // Remove invisible Unicode characters
    $string = preg_replace('/\x{00A0}|\x{200B}|\x{200C}|\x{200D}/u', '', $string);
    // Remove control/separator spaces at start/end
    $string = preg_replace('/^[\pZ\pC]+|[\pZ\pC]+$/u', '', $string);
    return trim($string);
}

// ----------------------------------------------------------------------
// --- SECURITY CHECK ---------------------------------------------------
// ----------------------------------------------------------------------
if (!isset($_SESSION['customer_user']) || empty($_SESSION['customer_user'])) {
    header("Location: ../login.php");
    exit();
}

// Confirm user is admin
$username_from_session = $_SESSION['customer_user'];
$sql_auth = "SELECT role FROM users WHERE customer_user = ?";
$stmt_auth = $conn->prepare($sql_auth);
$stmt_auth->bind_param("s", $username_from_session);
$stmt_auth->execute();
$result = $stmt_auth->get_result();
$user = $result->fetch_assoc();
$stmt_auth->close();

if (!$user || $user['role'] !== 'admin') {
    $_SESSION['status_message'] = ['type' => 'error', 'text' => 'Access denied: Admin only.'];
    header("Location: ../index.php");
    exit();
}

// ----------------------------------------------------------------------
// --- MAIN UPDATE LOGIC ------------------------------------------------
// ----------------------------------------------------------------------
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_status'])) {

    $order_id = filter_input(INPUT_POST, 'order_id', FILTER_VALIDATE_INT);
    $new_status = isset($_POST['new_status']) ? robust_trim($_POST['new_status']) : '';

    // Must match MySQL ENUM exactly
    $valid_statuses = ['Pending', 'Paid', 'Shipped', 'Completed', 'Cancelled'];

    if (!$order_id) {
        $message_text = "Missing or invalid Order ID.";
    } elseif (!in_array($new_status, $valid_statuses, true)) {
        $message_text = "Invalid status value selected.";
    } else {
        try {
            $stmt = $conn->prepare("UPDATE orders SET status = ? WHERE order_id = ?");
            if (!$stmt) throw new Exception("SQL prepare error: " . $conn->error);

            $stmt->bind_param("si", $new_status, $order_id);
            $stmt->execute();

            if ($stmt->affected_rows > 0) {
                $message_type = 'success';
                $message_text = "Order #$order_id status updated to '$new_status'.";
            } else {
                $message_type = 'info';
                $message_text = "Order #$order_id already has status '$new_status'.";
            }

            $stmt->close();
        } catch (Exception $e) {
            error_log("Order update failed (ID: $order_id): " . $e->getMessage());
            $message_text = "A database error occurred while updating the order.";
        }
    }
} else {
    $message_text = "Invalid request method or missing form data.";
}

// ----------------------------------------------------------------------
// --- FINALIZE ---------------------------------------------------------
// ----------------------------------------------------------------------
$conn->close();
$_SESSION['status_message'] = ['type' => $message_type, 'text' => $message_text];
header("Location: $redirect_url");
exit();
