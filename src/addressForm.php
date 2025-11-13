<?php
include("./db/sessionStart.php");
include("./db/db.php");

if (isset($_POST['address']) && isset($_SESSION['customer_id'])) {
    $customer_id = (int)$_SESSION['customer_id'];
    $address_name = $_POST['address_name'];
    $address_city = $_POST['address_city'];
    $address_region = $_POST['address_region'];
    $address_brgy = $_POST['address_brgy'];
    $address_postal = (int)$_POST['address_postal'];

    $sql_address = "INSERT INTO address (customer_id, address_name, address_city, address_region, address_brgy, address_postal, created_at) 
        VALUES (?, ?, ?, ?, ?, ?, NOW())";
    $stmt_address = $conn->prepare($sql_address);

    if ($stmt_address === false) {
        die("SQL Prepare Failed: " . $conn->error);
    }

    $stmt_address->bind_param(
        "issssi",
        $customer_id,
        $address_name,
        $address_city,
        $address_region,
        $address_brgy,
        $address_postal
    );

    $stmt_address->execute();
    $res = $stmt_address->get_result();

    if ($stmt_address->execute()) {
        header("Location: ./cart.php?status=address_added");
        exit();
    } else {
        die("Execute Failed: " . $stmt_address->error);
    }

    $stmt_address->close();
    $conn->close();
} else if (!isset($_SESSION['customer_id'])) {
    header("Location: ./login.php?redirect=addressForm.php");
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
    <title>HJJC Store|Cart</title>
    <link rel="stylesheet" href="./style/output.css" />
</head>

<body class="w-screen min-h-screen overflow-hidden scroll-smooth">
    <div class="sticky top-0 z-50 ">
        <?php include './components/header.php'; ?>
    </div>
    <section class="w-[90] h-full flex flex-col item-center mt-5 bg-custom-background">
        <h1 class="text-3xl font-extrabold text-custom-text/80 w-full text-center py-10">Address</h1>
        <div class="fixed max-lg:top-[6%] max-lg:left-[4%] lg:top-[10%] lg:left-[8%] z-40">
            <a href="./cart.php" class="btn btn-circle shadow-none bg-custom-accent border-none">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-arrow-left-icon lucide-arrow-left">
                    <path d="m12 19-7-7 7-7" />
                    <path d="M19 12H5" />
                </svg>
            </a>
        </div>
        <div class="w-full h-full flex justify-center items-start pt-10 px-4">
            <form action="./addressForm.php" method="post" class="flex flex-col w-full max-w-md space-y-4 bg-white p-6 rounded-xl shadow-lg border border-gray-100">
                <div class="flex flex-col space-y-2">
                    <label for="address_name" class="text-sm font-medium text-gray-700">Address Name</label>
                    <input
                        type="text"
                        name="address_name"
                        id="address_name"
                        required
                        placeholder="e.g., Home, Office"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg text-base transition duration-200 
                       focus:border-custom-accent focus:ring-2 focus:ring-custom-accent/50 outline-none">
                </div>
                <div class="flex flex-col space-y-2">
                    <label for="address_city" class="text-sm font-medium text-gray-700">Address City</label>
                    <input
                        type="text"
                        name="address_city"
                        id="address_city"
                        required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg text-base transition duration-200 
                       focus:border-custom-accent focus:ring-2 focus:ring-custom-accent/50 outline-none">
                </div>
                <div class="flex flex-col space-y-2">
                    <label for="address_region" class="text-sm font-medium text-gray-700">Address Region</label>
                    <input
                        type="text"
                        name="address_region"
                        id="address_region"
                        required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg text-base transition duration-200 
                       focus:border-custom-accent focus:ring-2 focus:ring-custom-accent/50 outline-none">
                </div>
                <div class="flex flex-col space-y-2">
                    <label for="address_brgy" class="text-sm font-medium text-gray-700">Address Barangay</label>
                    <input
                        type="text"
                        name="address_brgy"
                        id="address_brgy"
                        required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg text-base transition duration-200 
                       focus:border-custom-accent focus:ring-2 focus:ring-custom-accent/50 outline-none">
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div class="flex flex-col space-y-2">
                        <label for="address_postal" class="text-sm font-medium text-gray-700">Postal Code</label>
                        <input
                            type="text"
                            name="address_postal"
                            id="address_postal"
                            required
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg text-base transition duration-200 
                           focus:border-custom-accent focus:ring-2 focus:ring-custom-accent/50 outline-none">
                    </div>
                </div>
                <input
                    type="submit"
                    name="address"
                    value="Save Address"
                    class="mt-6 w-full py-3 bg-custom-accent text-custom-background font-bold text-lg rounded-lg shadow-md 
                   hover:bg-custom-accent/80 transition duration-300 cursor-pointer">
            </form>
        </div>
    </section>
</body>

</html>