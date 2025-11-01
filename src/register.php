<?php
session_start();
include("./db/db.php");
include("./functions/email-verification.php");

date_default_timezone_set('Asia/Manila');

if (!isset($_SESSION['registration'])) {
    $_SESSION['registration'] = true;
}
if (!isset($_SESSION['verificationCode'])) {
    $_SESSION['verificationCode'] = null;
}

$alert_html_output = userAndEmailAlert();

function userAndEmailAlert()
{
    include("./db/db.php");
    global $conn;
    $alertMsg = '';

    if (isset($_POST["register"])) {
        $user = filter_input(INPUT_POST, "user", FILTER_SANITIZE_SPECIAL_CHARS);
        $pass = filter_input(INPUT_POST, "pass", FILTER_SANITIZE_SPECIAL_CHARS);
        $confirmPass = filter_input(INPUT_POST, "confirmPass", FILTER_SANITIZE_SPECIAL_CHARS);
        $first_name = filter_input(INPUT_POST, "first_name", FILTER_SANITIZE_SPECIAL_CHARS);
        $last_name = filter_input(INPUT_POST, "last_name", FILTER_SANITIZE_SPECIAL_CHARS);
        $email = filter_input(INPUT_POST, "email", FILTER_VALIDATE_EMAIL);
        $phone = filter_input(INPUT_POST, "phone", FILTER_SANITIZE_SPECIAL_CHARS);
        // $hashed_pass = password_hash($pass, PASSWORD_DEFAULT);

        if ($email !== false && $email !== null) {
            list($userEmail, $domain) = explode("@", $email);
            if (!getmxrr($domain, $mxhosts)) {
                $alertMsg .= '
                    <div role="alert" class="alert alert-warning">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 shrink-0 stroke-current" fill="none" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                        </svg>
                        <span>Warning: Invalid Email Address!</span>
                    </div>';
                return $alertMsg;
            }
        } else {
            $alertMsg .= '
                <div role="alert" class="alert alert-warning">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 shrink-0 stroke-current" fill="none" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                    </svg>
                    <span>Warning: Invalid Email Format!</span>
                </div>';
            return $alertMsg;
        }

        date_default_timezone_set('Asia/Manila');
        $date = date("Y-m-d H:i:s");

        $sql = "SELECT * FROM users WHERE customer_user='$user' OR customer_email='$email'";
        $res = $conn->query($sql);

        if ($res->num_rows > 0) {
            $row = $res->fetch_assoc();

            if ($row['customer_user'] === $user) {
                $alertMsg .= '
                    <div role="alert" class="alert alert-warning">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 shrink-0 stroke-current" fill="none" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                        </svg>
                        <span>Warning: User Already Exists!</span>
                    </div>';
            }
            if ($row['customer_email'] === $email) {
                $alertMsg .= '
                    <div role="alert" class="alert alert-warning">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 shrink-0 stroke-current" fill="none" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                        </svg>
                        <span>Warning: Email Already Exists!</span>
                    </div>';
            }
            if ($pass !== $confirmPass) {
                $alertMsg .= '
                    <div role="alert" class="alert alert-warning">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 shrink-0 stroke-current" fill="none" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                        </svg>
                        <span>Warning: Passwords Do Not Match!</span>
                    </div>';
            }
        } else {
            if ($pass !== $confirmPass) {
                $alertMsg .= '
                    <div role="alert" class="alert alert-warning">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 shrink-0 stroke-current" fill="none" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                        </svg>
                        <span>Warning: Passwords Do Not Match!</span>
                    </div>';
            } else {
                // $sql = "INSERT INTO users (customer_user, customer_pass, customer_firstname, customer_lastname, customer_email, customer_phone, created_at)
                //         VALUES ('$user', '$pass', '$first_name', '$last_name', '$email', '$phone', '$date')";
                // if ($conn->query($sql)) {
                $_SESSION['user'] = $user;
                $_SESSION['pass'] = $pass;
                $_SESSION['first_name'] = $first_name;
                $_SESSION['last_name'] = $last_name;
                $_SESSION['email'] = $email;
                $_SESSION['phone'] = $phone;
                $_SESSION['date'] = $date;


                $verificationCode = generateCode();
                $sendResult = sendVerification($email, $verificationCode, $first_name);
                $_SESSION['verificationCode'] = $verificationCode;

                if ($sendResult === true) {
                    $_SESSION['registration'] = false;
                    $_SESSION['verification'] = true;

                    $alertMsg .= '
                            <div role="alert" class="alert alert-success">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 shrink-0 stroke-current" fill="none" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <span>Verification has been Sent to your Email!</span>
                            </div>';
                } else {
                    $alertMsg .= '
                            <div role="alert" class="alert alert-warning">
                                <span>Account created, but failed to send verification email.</span>
                                <br>
                                <strong>Debug Info: ' . htmlspecialchars($sendResult) . '</strong>
                            </div>';
                }
                // } else {
                //     die("Error: " . $conn->error);
                // }
            }
        }
    } elseif (isset($_POST["verify"])) {

        $code = filter_input(INPUT_POST, "code", FILTER_SANITIZE_SPECIAL_CHARS);


        if ($_SESSION['verificationCode'] == $code) {
            $user = $_SESSION['user'];
            $pass = $_SESSION['pass'];
            $first_name = $_SESSION['first_name'];
            $last_name = $_SESSION['last_name'];
            $email = $_SESSION['email'];
            $phone = $_SESSION['phone'];
            $date = $_SESSION['date'];

            $sql = "INSERT INTO users (customer_user, customer_pass, customer_firstname, customer_lastname, customer_email, customer_phone, created_at)
            VALUES ('$user', '$pass', '$first_name', '$last_name', '$email', '$phone', '$date')";

            if (!$conn->query($sql)) {
                die("Insert error: " . $conn->error);
            }

            $alertMsg .= '
                    <div role="alert" class="alert alert-success">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 shrink-0 stroke-current" fill="none" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <span>Successfullly Created an Account</span>
                    </div>';
            session_destroy();
        } else {
            $alertMsg .= '
                            <div role="alert" class="alert alert-success">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 shrink-0 stroke-current" fill="none" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <span>Invalid Verification Code</span>
                            </div>';
        }
        return $alertMsg;
    }
    return $alertMsg;
}
$conn->close();
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
    <div class="grid grid-cols-[45%_55%] place-items-center">
        <div class="flex flex-col gap-4 justify-center items-center h-screen w-full border-r-2 border-[#0A1829]">
            <div class="size-30 rounded-full p-2 shadow-[0px_0px_1px_2px] grid place-items-center">
                <img src="./image/logo/logo-trans.png" alt="logo">
            </div>
            <h1 class="font-black text-5xl mb-8">CREATE YOUR ACCOUNT</h1>
            <form action="./register.php" method="post" class="flex flex-col gap-4 w-3/4 justify-center items-center">
                <?php
                if ($_SESSION['registration'] == true) {
                    echo '
                <label class="input validator input-lg rounded-full w-3/4 floating-label">
                    <span class="left-8 text-xl">Username</span>
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
                <div class="flex gap-2 w-3/4">
                    <label class="group input validator input-lg rounded-full w-full floating-label">
                        <span class="left-8 text-xl">Password</span>
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
                            id="passwordInput"
                            type="password"
                            required
                            placeholder="Password"
                            minlength="8"
                            pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"
                            title="Must be more than 8 characters, including number, lowercase letter, uppercase letter"
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
                    <label class="input validator input-lg rounded-full w-full floating-label">
                        <span class="left-8 text-xl">Confirm Password</span>
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
                            placeholder="Confirm Password"
                            minlength="8"
                            pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"
                            title="Must be more than 8 characters, including number, lowercase letter, uppercase letter"
                            name="confirmPass" />
                    </label>
                </div>
                <!-- start here -->
                <div class="flex gap-2 w-3/4">
                    <label class="input validator input-lg rounded-full w-full floating-label">
                        <span class="left-8 text-xl">First Name</span>
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
                            placeholder="First Name"
                            pattern="[A-Za-z]+( [A-Za-z]+)*"
                            minlength="3"
                            maxlength="30"
                            title="Only letters and single spaces between words"
                            name="first_name" />
                    </label>
                    <label class="input validator input-lg rounded-full w-full floating-label">
                        <span class="left-8 text-xl">Last Name</span>
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
                            placeholder="Last Name"
                            pattern="[A-Za-z]*"
                            minlength="3"
                            maxlength="30"
                            title="Only letters"
                            name="last_name" />
                    </label>
                </div>
                <label class="input validator input-lg rounded-full w-3/4 floating-label">
                    <span class="left-8 text-xl">Email</span>
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
                <label class="input validator input-lg rounded-full w-3/4 floating-label">
                    <span class="left-8 text-xl">Phone Number</span>
                    <svg class="h-[1em] opacity-50" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16">
                        <g fill="none">
                            <path
                                d="M7.25 11.5C6.83579 11.5 6.5 11.8358 6.5 12.25C6.5 12.6642 6.83579 13 7.25 13H8.75C9.16421 13 9.5 12.6642 9.5 12.25C9.5 11.8358 9.16421 11.5 8.75 11.5H7.25Z"
                                fill="currentColor"></path>
                            <path
                                fill-rule="evenodd"
                                clip-rule="evenodd"
                                d="M6 1C4.61929 1 3.5 2.11929 3.5 3.5V12.5C3.5 13.8807 4.61929 15 6 15H10C11.3807 15 12.5 13.8807 12.5 12.5V3.5C12.5 2.11929 11.3807 1 10 1H6ZM10 2.5H9.5V3C9.5 3.27614 9.27614 3.5 9 3.5H7C6.72386 3.5 6.5 3.27614 6.5 3V2.5H6C5.44771 2.5 5 2.94772 5 3.5V12.5C5 13.0523 5.44772 13.5 6 13.5H10C10.5523 13.5 11 13.0523 11 12.5V3.5C11 2.94772 10.5523 2.5 10 2.5Z"
                                fill="currentColor"></path>
                        </g>
                    </svg>
                    <input type="tel" name="phone" placeholder="0900-000-0000" required />
                </label>
                <input type="submit" class="btn rounded-full w-3/4 btn-lg  border text-[20px]" name="register" value="REGISTER">
                ';
                } else {
                    echo '
                    <label class="input validator input-lg rounded-full w-3/4 floating-label">
                    <span class="left-8 text-xl">Verification Code</span>
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
                        placeholder="Verification Code"
                        pattern="[0-9]*"
                        minlength="3"
                        maxlength="30"
                        title="Only letters, numbers or dash"
                        name="code" />
                </label>
                <input type="submit" class="btn rounded-full w-3/4 btn-lg  border text-[20px]" name="verify" value="VERIFY">
                    ';
                }
                ?>
            </form>
            <a href="./login.php" class="hover:underline">Already Have an Account? Login</a>
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