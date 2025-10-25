<!DOCTYPE html>
<html lang="en" data-theme="light">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@5" rel="stylesheet" type="text/css" />
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link rel="stylesheet" href="./style/output.css" />
</head>

<body>
    <div class="grid grid-cols-2 place-items-center">
        <div class="flex flex-col gap-4 justify-center items-center h-screen">
            <div class="size-30 rounded-full shadow grid place-items-center">
                <img src="./image/logo.png" alt="logo">
            </div>
            <h1 class="font-black text-5xl">CREATE YOUR ACCOUNT</h1>
            <form action="./register.php" method="post" class="flex flex-col gap-4 w-full justify-center items-center">
                <input type="text" class="input rounded-full w-3/4 p-6 text-[20px]" name="user" placeholder="USERNAME" required>
                <input type="password" class="input rounded-full w-3/4 p-6 text-[20px]" name="pass" placeholder="PASSWORD" required>
                <input type="submit" class="rounded-full w-3/4 p-4 border text-[20px]" name="register" value="REGISTER">
            </form>
        </div>
        <div></div>
    </div>
</body>

</html>


<?php
include("./db/db.php");

if (isset($_POST["register"])) {
    // Sanitize input
    $user = filter_input(INPUT_POST, "user", FILTER_SANITIZE_SPECIAL_CHARS);
    $pass = filter_input(INPUT_POST, "pass", FILTER_SANITIZE_SPECIAL_CHARS);

    // Example INSERT query (if this is registration — not login)
    $date = date("Y-m-d H:m:s");
    $email = "example@email.com"; // replace with actual user input
    date_default_timezone_set('Asia/Manila');
    $sql = "INSERT INTO users (username, password, email, created_at)
            VALUES ('$user', '$pass', '$email', '$date')";

    // if (mysqli_query($conn, $sql)) {
    //     echo "User added successfully!";
    // } else {
    //     echo "Error: " . mysqli_error($conn);
    // }

    // echo "USER: {$user} <br>";
    // echo "PASS: {$pass}";
}
?>