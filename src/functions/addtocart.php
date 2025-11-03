<?php
    include '../db/db.php';

    $sql = "SELECT products.product_id , user.customer_id
        FROM products , user
        JOIN addtocart ON products.product_id = user.customer_id";

    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);

    echo $row;
?>

