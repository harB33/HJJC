<!-- <?php
        include("../db/sessionStart.php");
        include("../db/db.php");

        if (!isset($_SESSION['customer_user'])) {
            die("Error: Not logged in.");
        }

        if (!isset($_POST['cart_id']) || !isset($_POST['quantity'])) {
            die("Error: Missing parameters.");
        }

        $cart_id = (int)$_POST['cart_id'];
        $quantity = (int)$_POST['quantity'];

        if ($quantity <= 0) {
            $quantity = 1;
        }

        $sql = "UPDATE cart SET quantity = ?, created_at = NOW() WHERE cart_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ii", $quantity, $cart_id);
        $stmt->execute();
        $stmt->close();

        header("Location: ../cart.php?updated=1");
        exit();
        ?>
        
        di nagamit
        -->

    