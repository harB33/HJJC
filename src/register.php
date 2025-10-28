<?php
include("./db/db.php");
date_default_timezone_set('Asia/Manila');

$alert_html_output = userAndEmailAlert();

function userAndEmailAlert(){
    include("./db/db.php");
    $alertMsg = '';

    if (isset($_POST["register"])) {
        $user = filter_input(INPUT_POST, "user", FILTER_SANITIZE_SPECIAL_CHARS);
        $pass = filter_input(INPUT_POST, "pass", FILTER_SANITIZE_SPECIAL_CHARS);
        $confirmPass = filter_input(INPUT_POST, "confirmPass", FILTER_SANITIZE_SPECIAL_CHARS);
        $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_SPECIAL_CHARS);
    
        $hashed_pass = password_hash($pass, PASSWORD_DEFAULT);
    
        date_default_timezone_set('Asia/Manila');
        $date = date("Y-m-d H:i:s");
    
        $sql = "SELECT * FROM users WHERE username='$user' OR email='$email'";
        $res = $conn->query($sql);
    
        if ($res->num_rows > 0) {
            $row = $res->fetch_assoc();
    
            if ($row['username'] === $user) {
                $alertMsg .= '
                    <div role="alert" class="alert alert-warning">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 shrink-0 stroke-current" fill="none" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                        </svg>
                        <span>Warning: User Already Exists!</span>
                    </div>';
            }
            if ($row['email'] === $email) {
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
            $sql = "INSERT INTO users (username, password, email, created_at)
                    VALUES ('$user', '$pass', '$email', '$date')";
    
            if ($conn->query($sql)) {
                $alertMsg .= '
                    <div role="alert" class="alert alert-success">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 shrink-0 stroke-current" fill="none" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <span>Your Account has been Created!</span>
                    </div>';
            } else {
                die("Error: " . $conn->error);
            }
        }
        $conn->close();
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
        type="text/css"
    />
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link rel="stylesheet" href="./style/output.css" />
</head>

<body>
    <div class="grid grid-cols-[45%_55%] place-items-center">
        <div class="flex flex-col gap-4 justify-center items-center h-screen w-full">
            <div class="size-30 rounded-full p-2 shadow-[0px_0px_1px_2px] grid place-items-center">
                <img src="./image/logo/logo-trans.png" alt="logo">
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
                <div class=" w-fit gap-2 flex-col flex min-h-30">
                    <?php
                        echo $alert_html_output;
                    ?>
                </div>
            </div>
            <div class=" bg-base-300 overflow-clip relative w-full h-full">
            <div class=" bg-base-300 overflow-clip relative w-full h-full ">
            <div class="flex absolute w-full h-full justify-center items-center gap-4 p-4 rotate-25">
                <div class="flex flex-col my-loginImgAnimation">
                    <div class="mockup-phone w-50 h-85 ">
                        <div class="mockup-phone-camera"></div>
                        <div class="mockup-phone-display text-white grid place-content-center bg-neutral-900">
                            <img src="./image/image-login/PUMA SHIRT.png" alt="" class=" h-full">
                        </div>
                    </div>
                    <div class="mockup-phone w-50 h-85 ">
                        <div class="mockup-phone-camera"></div>
                        <div class="mockup-phone-display text-white grid place-content-center bg-neutral-900">
                            <img src="./image/image-login/Adida_Trefoil.png" alt="" class=" h-full">
                        </div>
                    </div>
                    <div class="mockup-phone w-50 h-85 ">
                        <div class="mockup-phone-camera"></div>
                        <div class="mockup-phone-display text-white grid place-content-center bg-neutral-900">
                            <img src="./image/image-login/Asus laptop14.png" alt="" class=" h-full">
                        </div>
                    </div>
                    <div class="mockup-phone w-50 h-85 ">
                        <div class="mockup-phone-camera"></div>
                        <div class="mockup-phone-display text-white grid place-content-center bg-neutral-900">
                            <img src="./image/image-login/asus marshmallow.png" alt="" class=" h-full">
                        </div>
                    </div>
                    <div class="mockup-phone w-50 h-85 ">
                        <div class="mockup-phone-camera"></div>
                        <div class="mockup-phone-display text-white grid place-content-center bg-neutral-900">
                            <img src="./image/image-login/atk v100 semi-alum.png" alt="" class=" h-full">
                        </div>
                    </div>
                </div>
                <div class="flex flex-col my-loginImgAnimation">
                    <div class="mockup-phone w-50 h-85 ">
                        <div class="mockup-phone-camera"></div>
                        <div class="mockup-phone-display text-white grid place-content-center bg-neutral-900">
                            <img src="./image/image-login/dell optiplex.png" alt="" class=" h-full">
                        </div>
                    </div>
                    <div class="mockup-phone w-50 h-85 ">
                        <div class="mockup-phone-camera"></div>
                        <div class="mockup-phone-display text-white grid place-content-center bg-neutral-900">
                            <img src="./image/image-login/geforce rtx5070 prime.png" alt="" class=" h-full">
                        </div>
                    </div>
                    <div class="mockup-phone w-50 h-85 ">
                        <div class="mockup-phone-camera"></div>
                        <div class="mockup-phone-display text-white grid place-content-center bg-neutral-900">
                            <img src="./image/image-login/hawaiian short.png" alt="" class=" h-full">
                        </div>
                    </div>
                    <div class="mockup-phone w-50 h-85 ">
                        <div class="mockup-phone-camera"></div>
                        <div class="mockup-phone-display text-white grid place-content-center bg-neutral-900">
                            <img src="./image/image-login/hp pavilion.png" alt="" class=" h-full">
                        </div>
                    </div>
                    <div class="mockup-phone w-50 h-85 ">
                        <div class="mockup-phone-camera"></div>
                        <div class="mockup-phone-display text-white grid place-content-center bg-neutral-900">
                            <img src="./image/image-login/hp14.png" alt="" class=" h-full">
                        </div>
                    </div>
                </div>
                <div class="flex flex-col my-loginImgAnimation">
                    <div class="mockup-phone w-50 h-85 ">
                        <div class="mockup-phone-camera"></div>
                        <div class="mockup-phone-display text-white grid place-content-center bg-neutral-900">
                            <img src="./image/image-login/iphone 17 promax.png" alt="" class=" h-full">
                        </div>
                    </div>
                    <div class="mockup-phone w-50 h-85 ">
                        <div class="mockup-phone-camera"></div>
                        <div class="mockup-phone-display text-white grid place-content-center bg-neutral-900">
                            <img src="./image/image-login/irving 4.png" alt="" class=" h-full">
                        </div>
                    </div>
                    <div class="mockup-phone w-50 h-85 ">
                        <div class="mockup-phone-camera"></div>
                        <div class="mockup-phone-display text-white grid place-content-center bg-neutral-900">
                            <img src="./image/image-login/jordan 11 high.png" alt="" class=" h-full">
                        </div>
                    </div>
                    <div class="mockup-phone w-50 h-85 ">
                        <div class="mockup-phone-camera"></div>
                        <div class="mockup-phone-display text-white grid place-content-center bg-neutral-900">
                            <img src="./image/image-login/lenovo legion 7.png" alt="" class=" h-full">
                        </div>
                    </div>
                    <div class="mockup-phone w-50 h-85 ">
                        <div class="mockup-phone-camera"></div>
                        <div class="mockup-phone-display text-white grid place-content-center bg-neutral-900">
                            <img src="./image/image-login/M75.png" alt="" class=" h-full">
                        </div>
                    </div>
                </div>
                <div class="flex flex-col my-loginImgAnimation">
                    <div class="mockup-phone w-50 h-85 ">
                        <div class="mockup-phone-camera"></div>
                        <div class="mockup-phone-display text-white grid place-content-center bg-neutral-900">
                            <img src="./image/image-login/nike air 1 low.png" alt="" class=" h-full">
                        </div>
                    </div>
                    <div class="mockup-phone w-50 h-85 ">
                        <div class="mockup-phone-camera"></div>
                        <div class="mockup-phone-display text-white grid place-content-center bg-neutral-900">
                            <img src="./image/image-login/PUMA SHIRT_Cat Graph.png" alt="" class=" h-full">
                        </div>
                    </div>
                    <div class="mockup-phone w-50 h-85 ">
                        <div class="mockup-phone-camera"></div>
                        <div class="mockup-phone-display text-white grid place-content-center bg-neutral-900">
                            <img src="./image/image-login/PUMA SHIRT.png" alt="" class=" h-full">
                        </div>
                    </div>
                    <div class="mockup-phone w-50 h-85 ">
                        <div class="mockup-phone-camera"></div>
                        <div class="mockup-phone-display text-white grid place-content-center bg-neutral-900">
                            <img src="./image/image-login/rrj shorts.png" alt="" class=" h-full">
                        </div>
                    </div>
                    <div class="mockup-phone w-50 h-85 ">
                        <div class="mockup-phone-camera"></div>
                        <div class="mockup-phone-display text-white grid place-content-center bg-neutral-900">
                            <img src="./image/image-login/samsung s26 ultra.png" alt="" class=" h-full">
                        </div>
                    </div>
                </div>
                <div class="flex flex-col my-loginImgAnimation">
                    <div class="mockup-phone w-50 h-85 ">
                        <div class="mockup-phone-camera"></div>
                        <div class="mockup-phone-display text-white grid place-content-center bg-neutral-900">
                            <img src="./image/image-login/sandugo short.png" alt="" class=" h-full">
                        </div>
                    </div>
                    <div class="mockup-phone w-50 h-85 ">
                        <div class="mockup-phone-camera"></div>
                        <div class="mockup-phone-display text-white grid place-content-center bg-neutral-900">
                            <img src="./image/image-login/vivo v50.png" alt="" class=" h-full">
                        </div>
                    </div>
                    <div class="mockup-phone w-50 h-85 ">
                        <div class="mockup-phone-camera"></div>
                        <div class="mockup-phone-display text-white grid place-content-center bg-neutral-900">
                            <img src="./image/image-login/iphone 17 promax.png" alt="" class=" h-full">
                        </div>
                    </div>
                    <div class="mockup-phone w-50 h-85 ">
                        <div class="mockup-phone-camera"></div>
                        <div class="mockup-phone-display text-white grid place-content-center bg-neutral-900">
                            <img src="./image/image-login/hp14.png" alt="" class=" h-full">
                        </div>
                    </div>
                    <div class="mockup-phone w-50 h-85 ">
                        <div class="mockup-phone-camera"></div>
                        <div class="mockup-phone-display text-white grid place-content-center bg-neutral-900">
                            <img src="./image/image-login/dell optiplex.png" alt="" class=" h-full">
                        </div>
                    </div>
                </div>
                <div class="flex flex-col my-loginImgAnimation">
                    <div class="mockup-phone w-50 h-85 ">
                        <div class="mockup-phone-camera"></div>
                        <div class="mockup-phone-display text-white grid place-content-center bg-neutral-900">
                            <img src="./image/image-login/lenovo legion 7.png" alt="" class=" h-full">
                        </div>
                    </div>
                    <div class="mockup-phone w-50 h-85 ">
                        <div class="mockup-phone-camera"></div>
                        <div class="mockup-phone-display text-white grid place-content-center bg-neutral-900">
                            <img src="./image/image-login/asus marshmallow.png" alt="" class=" h-full">
                        </div>
                    </div>
                    <div class="mockup-phone w-50 h-85 ">
                        <div class="mockup-phone-camera"></div>
                        <div class="mockup-phone-display text-white grid place-content-center bg-neutral-900">
                            <img src="./image/image-login/Adida_Trefoil.png" alt="" class=" h-full">
                        </div>
                    </div>
                    <div class="mockup-phone w-50 h-85 ">
                        <div class="mockup-phone-camera"></div>
                        <div class="mockup-phone-display text-white grid place-content-center bg-neutral-900">
                            <img src="./image/image-login/irving 4.png" alt="" class=" h-full">
                        </div>
                    </div>
                    <div class="mockup-phone w-50 h-85 ">
                        <div class="mockup-phone-camera"></div>
                        <div class="mockup-phone-display text-white grid place-content-center bg-neutral-900">
                            <img src="./image/image-login/geforce rtx5070 prime.png" alt="" class=" h-full">
                        </div>
                    </div>
                </div>
                <div class="flex flex-col my-loginImgAnimation">
                    <div class="mockup-phone w-50 h-85 ">
                        <div class="mockup-phone-camera"></div>
                        <div class="mockup-phone-display text-white grid place-content-center bg-neutral-900">
                            <img src="./image/image-login/PUMA SHIRT.png" alt="" class=" h-full">
                        </div>
                    </div>
                    <div class="mockup-phone w-50 h-85 ">
                        <div class="mockup-phone-camera"></div>
                        <div class="mockup-phone-display text-white grid place-content-center bg-neutral-900">
                            <img src="./image/image-login/samsung s26 ultra.png" alt="" class=" h-full">
                        </div>
                    </div>
                    <div class="mockup-phone w-50 h-85 ">
                        <div class="mockup-phone-camera"></div>
                        <div class="mockup-phone-display text-white grid place-content-center bg-neutral-900">
                            <img src="./image/image-login/Asus laptop14.png" alt="" class=" h-full">
                        </div>
                    </div>
                    <div class="mockup-phone w-50 h-85 ">
                        <div class="mockup-phone-camera"></div>
                        <div class="mockup-phone-display text-white grid place-content-center bg-neutral-900">
                            <img src="./image/image-login/asus marshmallow.png" alt="" class=" h-full">
                        </div>
                    </div>
                    <div class="mockup-phone w-50 h-85 ">
                        <div class="mockup-phone-camera"></div>
                        <div class="mockup-phone-display text-white grid place-content-center bg-neutral-900">
                            <img src="./image/image-login/atk v100 semi-alum.png" alt="" class=" h-full">
                        </div>
                    </div>
                </div>
                <div class="flex flex-col my-loginImgAnimation">
                    <div class="mockup-phone w-50 h-85 ">
                        <div class="mockup-phone-camera"></div>
                        <div class="mockup-phone-display text-white grid place-content-center bg-neutral-900">
                            <img src="./image/image-login/dell optiplex.png" alt="" class=" h-full">
                        </div>
                    </div>
                    <div class="mockup-phone w-50 h-85 ">
                        <div class="mockup-phone-camera"></div>
                        <div class="mockup-phone-display text-white grid place-content-center bg-neutral-900">
                            <img src="./image/image-login/geforce rtx5070 prime.png" alt="" class=" h-full">
                        </div>
                    </div>
                    <div class="mockup-phone w-50 h-85 ">
                        <div class="mockup-phone-camera"></div>
                        <div class="mockup-phone-display text-white grid place-content-center bg-neutral-900">
                            <img src="./image/image-login/hawaiian short.png" alt="" class=" h-full">
                        </div>
                    </div>
                    <div class="mockup-phone w-50 h-85 ">
                        <div class="mockup-phone-camera"></div>
                        <div class="mockup-phone-display text-white grid place-content-center bg-neutral-900">
                            <img src="./image/image-login/hp pavilion.png" alt="" class=" h-full">
                        </div>
                    </div>
                    <div class="mockup-phone w-50 h-85 ">
                        <div class="mockup-phone-camera"></div>
                        <div class="mockup-phone-display text-white grid place-content-center bg-neutral-900">
                            <img src="./image/image-login/hp14.png" alt="" class=" h-full">
                        </div>
                    </div>
                </div>
                <div class="flex flex-col my-loginImgAnimation">
                    <div class="mockup-phone w-50 h-85 ">
                        <div class="mockup-phone-camera"></div>
                        <div class="mockup-phone-display text-white grid place-content-center bg-neutral-900">
                            <img src="./image/image-login/iphone 17 promax.png" alt="" class=" h-full">
                        </div>
                    </div>
                    <div class="mockup-phone w-50 h-85 ">
                        <div class="mockup-phone-camera"></div>
                        <div class="mockup-phone-display text-white grid place-content-center bg-neutral-900">
                            <img src="./image/image-login/irving 4.png" alt="" class=" h-full">
                        </div>
                    </div>
                    <div class="mockup-phone w-50 h-85 ">
                        <div class="mockup-phone-camera"></div>
                        <div class="mockup-phone-display text-white grid place-content-center bg-neutral-900">
                            <img src="./image/image-login/jordan 11 high.png" alt="" class=" h-full">
                        </div>
                    </div>
                    <div class="mockup-phone w-50 h-85 ">
                        <div class="mockup-phone-camera"></div>
                        <div class="mockup-phone-display text-white grid place-content-center bg-neutral-900">
                            <img src="./image/image-login/lenovo legion 7.png" alt="" class=" h-full">
                        </div>
                    </div>
                    <div class="mockup-phone w-50 h-85 ">
                        <div class="mockup-phone-camera"></div>
                        <div class="mockup-phone-display text-white grid place-content-center bg-neutral-900">
                            <img src="./image/image-login/M75.png" alt="" class=" h-full">
                        </div>
                    </div>
                </div>
                <div class="flex flex-col my-loginImgAnimation">
                    <div class="mockup-phone w-50 h-85 ">
                        <div class="mockup-phone-camera"></div>
                        <div class="mockup-phone-display text-white grid place-content-center bg-neutral-900">
                            <img src="./image/image-login/nike air 1 low.png" alt="" class=" h-full">
                        </div>
                    </div>
                    <div class="mockup-phone w-50 h-85 ">
                        <div class="mockup-phone-camera"></div>
                        <div class="mockup-phone-display text-white grid place-content-center bg-neutral-900">
                            <img src="./image/image-login/PUMA SHIRT_Cat Graph.png" alt="" class=" h-full">
                        </div>
                    </div>
                    <div class="mockup-phone w-50 h-85 ">
                        <div class="mockup-phone-camera"></div>
                        <div class="mockup-phone-display text-white grid place-content-center bg-neutral-900">
                            <img src="./image/image-login/PUMA SHIRT.png" alt="" class=" h-full">
                        </div>
                    </div>
                    <div class="mockup-phone w-50 h-85 ">
                        <div class="mockup-phone-camera"></div>
                        <div class="mockup-phone-display text-white grid place-content-center bg-neutral-900">
                            <img src="./image/image-login/rrj shorts.png" alt="" class=" h-full">
                        </div>
                    </div>
                    <div class="mockup-phone w-50 h-85 ">
                        <div class="mockup-phone-camera"></div>
                        <div class="mockup-phone-display text-white grid place-content-center bg-neutral-900">
                            <img src="./image/image-login/samsung s26 ultra.png" alt="" class=" h-full">
                        </div>
                    </div>
                </div>
                <div class="flex flex-col my-loginImgAnimation">
                    <div class="mockup-phone w-50 h-85 ">
                        <div class="mockup-phone-camera"></div>
                        <div class="mockup-phone-display text-white grid place-content-center bg-neutral-900">
                            <img src="./image/image-login/sandugo short.png" alt="" class=" h-full">
                        </div>
                    </div>
                    <div class="mockup-phone w-50 h-85 ">
                        <div class="mockup-phone-camera"></div>
                        <div class="mockup-phone-display text-white grid place-content-center bg-neutral-900">
                            <img src="./image/image-login/vivo v50.png" alt="" class=" h-full">
                        </div>
                    </div>
                    <div class="mockup-phone w-50 h-85 ">
                        <div class="mockup-phone-camera"></div>
                        <div class="mockup-phone-display text-white grid place-content-center bg-neutral-900">
                            <img src="./image/image-login/iphone 17 promax.png" alt="" class=" h-full">
                        </div>
                    </div>
                    <div class="mockup-phone w-50 h-85 ">
                        <div class="mockup-phone-camera"></div>
                        <div class="mockup-phone-display text-white grid place-content-center bg-neutral-900">
                            <img src="./image/image-login/hp14.png" alt="" class=" h-full">
                        </div>
                    </div>
                    <div class="mockup-phone w-50 h-85 ">
                        <div class="mockup-phone-camera"></div>
                        <div class="mockup-phone-display text-white grid place-content-center bg-neutral-900">
                            <img src="./image/image-login/dell optiplex.png" alt="" class=" h-full">
                        </div>
                    </div>
                </div>
                <div class="flex flex-col my-loginImgAnimation">
                    <div class="mockup-phone w-50 h-85 ">
                        <div class="mockup-phone-camera"></div>
                        <div class="mockup-phone-display text-white grid place-content-center bg-neutral-900">
                            <img src="./image/image-login/lenovo legion 7.png" alt="" class=" h-full">
                        </div>
                    </div>
                    <div class="mockup-phone w-50 h-85 ">
                        <div class="mockup-phone-camera"></div>
                        <div class="mockup-phone-display text-white grid place-content-center bg-neutral-900">
                            <img src="./image/image-login/asus marshmallow.png" alt="" class=" h-full">
                        </div>
                    </div>
                    <div class="mockup-phone w-50 h-85 ">
                        <div class="mockup-phone-camera"></div>
                        <div class="mockup-phone-display text-white grid place-content-center bg-neutral-900">
                            <img src="./image/image-login/Adida_Trefoil.png" alt="" class=" h-full">
                        </div>
                    </div>
                    <div class="mockup-phone w-50 h-85 ">
                        <div class="mockup-phone-camera"></div>
                        <div class="mockup-phone-display text-white grid place-content-center bg-neutral-900">
                            <img src="./image/image-login/irving 4.png" alt="" class=" h-full">
                        </div>
                    </div>
                    <div class="mockup-phone w-50 h-85 ">
                        <div class="mockup-phone-camera"></div>
                        <div class="mockup-phone-display text-white grid place-content-center bg-neutral-900">
                            <img src="./image/image-login/geforce rtx5070 prime.png" alt="" class=" h-full">
                        </div>
                    </div>
                </div>
                </div>
            </div>
        </div>
        </div>
    </div>
</body>

</html>