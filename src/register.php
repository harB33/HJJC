<!DOCTYPE html>
<html lang="en" data-theme="light">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
                <!-- <p class="validator-hint">
                    Must be 3 to 30 characters
                    <br />containing only letters, numbers or dash
                    </p> -->

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
                    <input type="email" placeholder="mail@site.com" name="email" required />
                </label>
                <!-- <div class="validator-hint hidden">Enter valid email address</div> -->
                <!-- <p class="validator-hint hidden">
                    Must be more than 8 characters, including
                    <br />At least one number <br />At least one lowercase letter <br />At least one uppercase letter
                    </p> -->
                <!-- <input type="text" class="input rounded-full w-3/4  input-lg text-[20px]" name="user" placeholder="USERNAME" required> -->
                <!-- <input type="password" class="input rounded-full w-3/4  input-lg text-[20px]" name="pass" placeholder="PASSWORD" required> -->
                <input type="submit" class="btn rounded-full w-3/4 btn-lg  border text-[20px]" name="register" value="REGISTER">
            </form>
            <a href="./login.php" class="hover:underline">Already Have an Account? Login</a>
        </div>
        <div></div>
    </div>
</body>

</html>


<?php

// Always include the connection file at the top
include("./db/db.php");

// Explicitly set the timezone before any date functions
date_default_timezone_set('Asia/Manila');

// Check if the form was submitted
if (isset($_POST["register"])) {

    // Sanitize and validate user input
    // The previous code was using FILTER_SANITIZE_SPECIAL_CHARS,
    // but prepared statements make this unnecessary for SQL injection.
    // However, basic validation and trimming is still a good practice.
    $user = trim($_POST["user"]);
    $email = trim($_POST["email"]);
    $pass = $_POST["pass"]; // Keep original password for hashing

    // Perform server-side validation
    if (empty($user) || empty($email) || empty($pass)) {
        die("Please fill in all the fields.");
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("Invalid email format.");
    }

    // Hash the password for secure storage
    $hashed_pass = password_hash($pass, PASSWORD_DEFAULT);

    // Get the current date and time
    $date = date("Y-m-d H:i:s");

    // Use prepared statements to prevent SQL injection
    $sql = "INSERT INTO users (username, password, email, created_at) VALUES (?, ?, ?, ?)";

    // Initialize a prepared statement
    $stmt = $conn->prepare($sql);

    // Check if the statement was prepared successfully
    if ($stmt === false) {
        die("Prepare failed: " . $conn->error);
    }

    // Bind parameters to the query
    // "ssss" indicates all four parameters are strings
    $stmt->bind_param("ssss", $user, $hashed_pass, $email, $date);

    // Execute the prepared statement
    if ($stmt->execute()) {
        echo "User added successfully!";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close the statement
    $stmt->close();
}

// Close the database connection at the end of the script
$conn->close();


// include("./db/db.php");

// if (isset($_POST["register"])) {

//     $user = filter_input(INPUT_POST, "user", FILTER_SANITIZE_SPECIAL_CHARS);
//     $pass = filter_input(INPUT_POST, "pass", FILTER_SANITIZE_SPECIAL_CHARS);
//     $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_SPECIAL_CHARS);;
//     $date = date("Y-m-d H:i:s");
//     date_default_timezone_set('Asia/Manila');

//     $sql = "INSERT INTO users (username, password, email, created_at)
//             VALUES ('$user', '$pass', '$email', '$date')";

//     if (mysqli_query($conn, $sql)) {
//         echo "User added successfully!";
//     } else {
//         echo "Error: " . mysqli_error($conn);
//     }
// }
?>