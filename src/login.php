<?php
session_start();
include("./db/db.php");

$alert_html_output = userAndPassCorrect();

function userAndPassCorrect()
{
    include("./db/db.php");
    $alertMsg = '';

    if (isset($_POST["login"])) {
        $user = filter_input(INPUT_POST, "user", FILTER_SANITIZE_SPECIAL_CHARS);
        $pass = filter_input(INPUT_POST, "pass", FILTER_SANITIZE_SPECIAL_CHARS);

        $sql = "SELECT * FROM users WHERE customer_user='$user' LIMIT 1";
        $res = mysqli_query($conn, $sql);

        if ($res && $res->num_rows > 0) {
            $row = mysqli_fetch_assoc($res);

            if ($pass === $row['customer_pass']) {
                $_SESSION['customer_user'] = $user;
                $_SESSION['loggedIn'] = True;

                header("Location: ./index.php");
                exit;
            } else {
                $alertMsg .= '
                    <div role="alert" class="alert alert-warning">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 shrink-0 stroke-current" fill="none" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                        </svg>
                        <span>Warning: Invalid Password!</span>
                    </div>';
            }
        } else {
            $alertMsg .= '
                <div role="alert" class="alert alert-warning">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 shrink-0 stroke-current" fill="none" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                    </svg>
                    <span>Warning: Invalid Username!</span>
                </div>';
        }
    }
    return $alertMsg;
}


?>


<!DOCTYPE html>
<html lang="en" data-theme="light">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="./image/logo.ico" type="image/x-icon">
    <title>HJJC. STORE|Register</title>
    <link
        href="https://cdn.jsdelivr.net/npm/daisyui@5"
        rel="stylesheet"
        type="text/css" />
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link rel="stylesheet" href="./style/output.css" />
    <script src="./script/script.js" defer></script>
</head>

<body>
    <div class="grid grid-cols-[45%_55%] place-items-center ">
        <div class="flex flex-col gap-4 justify-center items-center h-screen w-full border-r-2 border-[#0A1829]">
            <div class="size-30 rounded-full shadow-[0px_0px_1px_2px] grid place-items-center p-2">
                <img src="./image/logo/logo-trans.png" alt="logo">
            </div>
            <div class="mb-8 text-center">
                <h1 class="font-black text-5xl ">Hello Shopper!</h1>
                <p class="text-2xl font-extralight">Let’s get you back to your cart.</p>
            </div>
            <form action="./login.php" method="post" class="flex flex-col gap-4 justify-center items-center w-3/4">
                <label class="input validator input-lg rounded-full w-3/4 floating-label">
                    <span class="text-xl left-8">Username</span>
                    <svg class="h-[1em] opacity-50" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                        <g stroke-linejoin="round" stroke-linecap="round" stroke-width="2.5" fill="none" stroke="currentColor">
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
                <label class="group input validator input-lg rounded-full w-3/4 floating-label">
                    <span class="text-xl left-8">Password</span>
                    <svg class="h-[1em] opacity-50" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                        <g stroke-linejoin="round" stroke-linecap="round" stroke-width="2.5" fill="none" stroke="currentColor">
                            <path d="M2.586 17.414A2 2 0 0 0 2 18.828V21a1 1 0 0 0 1 1h3a1 1 0 0 0 1-1v-1a1 1 0 0 1 1-1h1a1 1 0 0 0 1-1v-1a1 1 0 0 1 1-1h.172a2 2 0 0 0 1.414-.586l.814-.814a6.5 6.5 0 1 0-4-4z"></path>
                            <circle cx="16.5" cy="7.5" r=".5" fill="currentColor"></circle>
                        </g>
                    </svg>
                    <input
                        id="passwordInput"
                        type="password"
                        required
                        placeholder="Password"
                        minlength="8"
                        name="pass" />

                    <label class="swap opacity-0 pointer-events-none transition-opacity duration-300 group-focus-within:opacity-100 group-focus-within:pointer-events-auto" id="toggleLabel">
                        <input type="checkbox" id="toggleCheckbox" />
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-eye-off-icon lucide-eye-off swap-off">
                            <path d="M10.733 5.076a10.744 10.744 0 0 1 11.205 6.575 1 1 0 0 1 0 .696 10.747 10.747 0 0 1-1.444 2.49" />
                            <path d="M14.084 14.158a3 3 0 0 1-4.242-4.242" />
                            <path d="M17.479 17.499a10.75 10.75 0 0 1-15.417-5.151 1 1 0 0 1 0-.696 10.75 10.75 0 0 1 4.446-5.143" />
                            <path d="m2 2 20 20" />
                        </svg>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-eye-icon lucide-eye swap-on">
                            <path d="M2.062 12.348a1 1 0 0 1 0-.696 10.75 10.75 0 0 1 19.876 0 1 1 0 0 1 0 .696 10.75 10.75 0 0 1-19.876 0" />
                            <circle cx="12" cy="12" r="3" />
                        </svg>
                    </label>
                </label>
                <label class="flex items-center gap-2 w-3/4">
                    <input type="checkbox" checked="checked" class="checkbox" />
                    <h1 class="">Remember Me</h1>
                </label>
                <input type="submit" class="btn rounded-full w-3/4 btn-lg border text-[20px]" name="login" value="LOGIN">
            </form>
            <a href="./register.php" class="hover:underline">Don't Have an Account? Register</a>
            <div class=" w-fit gap-2 flex-col flex min-h-30">
                <?php
                echo $alert_html_output;
                ?>
            </div>
        </div>
        <?php include './components/loginAnimation.html' ?>
    </div>
    </div>
</body>

</html>