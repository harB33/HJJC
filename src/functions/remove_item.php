<?php 
include("../db/sessionStart.php");
include("../db/db.php");

if (isset($_POST['remove']) && isset($_SESSION['customer_id'])) {

    $cart_id = (int)$_POST['remove'];
    $customer_id = $_SESSION['customer_id'];

    $check_sql = "SELECT 1 FROM cart WHERE product_id = ? AND customer_id = ?";
    $check_stmt = $conn->prepare($check_sql);
    $check_stmt->bind_param("ii", $product_id, $customer_id);
    $check_stmt->execute();
    $exists = $check_stmt->get_result()->num_rows > 0;
    $check_stmt->close();

    if (!$exists) {
        header("Location: ../cart.php?status=not_found");
        exit();
    }
    
    $del_sql = "DELETE FROM cart WHERE cart_id = ? AND customer_id = ?";
    $del_stmt = $conn->prepare($del_sql);
    $del_stmt->bind_param("ii", $cart_id, $customer_id);
    $del_stmt->execute();

//     if ($stmt === false) {
//         die("Prepare failed: " . $conn->error);
//     }
//     $stmt->bind_param("ii", $product_id, $customer_id);

//     if ($stmt->execute()) {
//         if ($stmt->affected_rows > 0) {
//         header("Location: ../cart.php?status=removed");
//         exit();
//         } else {
//             header("Location: ../cart.php?status=not_found");
//             exit();
//         }
//     } else {
//         echo "Error: Could not remove item." . $stmt->error;
//     }

//     $stmt->close();

// } else {
//     header("Location: ../cart.php?status=invalid_request");
//     exit();
// }

// $conn->close();
    if ($del_stmt->affected_rows > 0) {
            header("Location: ../cart.php?status=removed");
        } else {
            header("Location: ../cart.php?status=not_found");
        }
        $del_stmt->close();
        $conn->close();
        exit();
    } else {
        header("Location: ../cart.php?status=invalid_request");
        exit();
    }
?>