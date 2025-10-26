<!DOCTYPE html>
<html lang="en" data-theme="light">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="./image/logo.ico" type="image/x-icon">
    <title>Register</title>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@5" rel="stylesheet" type="text/css" />
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link rel="stylesheet" href="./style/output.css" />
</head>

<body>
    <div class="grid grid-cols-2 place-items-center">
        <div class="flex flex-col gap-4 justify-center items-center h-screen w-full">
            <div class="size-30 rounded-full shadow grid place-items-center">
                <img src="./image/logo.png" alt="logo">
            </div>
            <h1 class="font-black text-5xl mb-8">CREATE YOUR ACCOUNT</h1>
            <form action="./register.php" method="post" class="flex flex-col gap-4 w-3/4 justify-center items-center">
                <label class="input validator input-lg rounded-full w-3/4">
                    <svg class="h-[1em] opacity-50" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                        <g
                            stroke-linejoin="round"
                            stroke-linecap="round"
                            stroke-width="2.5"
                            fill="none"
                            stroke="currentColor">
                            <circle cx="12" cy="8" r="5" />
                            <path d="M20 21a8 8 0 0 0-16 0" />
                        </g>
                    </svg>
                    <input
                        type="text"
                        required
                        placeholder="Username"
                        pattern="[A-Za-z][A-Za-z0-9\-]*"
                        minlength="3"
                        maxlength="30"
                        title="Only letters, numbers or dash"
                        name="user" />
                </label>
                <label class="input validator input-lg rounded-full w-3/4">
                    <svg class="h-[1em] opacity-50" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                        <g
                            stroke-linejoin="round"
                            stroke-linecap="round"
                            stroke-width="2.5"
                            fill="none"
                            stroke="currentColor">
                            <path
                                d="M2.586 17.414A2 2 0 0 0 2 18.828V21a1 1 0 0 0 1 1h3a1 1 0 0 0 1-1v-1a1 1 0 0 1 1-1h1a1 1 0 0 0 1-1v-1a1 1 0 0 1 1-1h.172a2 2 0 0 0 1.414-.586l.814-.814a6.5 6.5 0 1 0-4-4z"></path>
                            <circle cx="16.5" cy="7.5" r=".5" fill="currentColor"></circle>
                        </g>
                    </svg>
                    <input
                        type="password"
                        required
                        placeholder="Password"
                        minlength="8"
                        pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"
                        title="Must be more than 8 characters, including number, lowercase letter, uppercase letter"
                        name="pass" />
                </label>

                <label class="input validator input-lg rounded-full w-3/4">
                    <svg class="h-[1em] opacity-50" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                        <g
                            stroke-linejoin="round"
                            stroke-linecap="round"
                            stroke-width="2.5"
                            fill="none"
                            stroke="currentColor">
                            <rect width="20" height="16" x="2" y="4" rx="2"></rect>
                            <path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"></path>
                        </g>
                    </svg>
                    <input type="email" name="email" placeholder="mail@site.com" required />
                    </label>
                <input type="submit" class="btn rounded-full w-3/4 btn-lg  border text-[20px]" name="register" value="REGISTER">
            </form>
            <a href="./login.php" class="hover:underline">Already Have an Account? Login</a>
        </div>
        <div></div>
    </div>
</body>

</html>


<?php

include("./db/db.php");

date_default_timezone_set('Asia/Manila');

if (isset($_POST["register"])) {
    $user = filter_input(INPUT_POST, "user", FILTER_SANITIZE_SPECIAL_CHARS);
    $pass = filter_input(INPUT_POST, "pass", FILTER_SANITIZE_SPECIAL_CHARS);
    $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_SPECIAL_CHARS);
    
    date_default_timezone_set('Asia/Manila');
    $date = date("Y-m-d H:i:s");

    $sql = "SELECT * FROM users WHERE username='$user' AND email='$email'";
    $res = $conn->query($sql);

    if ($res->num_rows > 0) {
        die("Username or Email already exists.");
    }else{
        $sql = "INSERT INTO users (username, password, email, created_at)
                VALUES ('$user', '$pass', '$email', '$date')";
    
        if($conn->query($sql)){
            die("Account created successfully.");
        }else {
            die("Error: " . $conn->error);
        }
    }
}

$conn->close();
?>