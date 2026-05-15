<?php
require_once './db/sessionStart.php';
require_once './functions/searchbar.php'
?>

<head>
    <link
        href="https://cdn.jsdelivr.net/npm/daisyui@5"
        rel="stylesheet"
        type="text/css" />
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link rel="stylesheet" href="./style/output.css" />
    <script src="./script/script.js" defer></script>
</head>

<body data-theme="light" class="backdrop-blur-lg ">
    <header class="shadow fixed top-0 w-screen flex justify-center z-50 items-center lg:px-5 lg:py-2 max-lg:px-2.5 max-lg:py-0.5  bg-custom-background backdrop-blur-sm">
        <div class="grid md:grid-cols-3 max-lg:grid-cols-2 items-center w-full max-sm:pr-6">
            <a href="./index.php" class="">
                <img src="./image/logo/Coffee_Logo.png" alt="logo" class="max-lg:h-12 lg:h-16 object-contain" />
            </a>
            <!-- <div class="flex items-center gap-2 w-full justify-end md:justify-center"> -->
                <div class="grow items-center flex justify-center md:gap-4 lg:gap-12 max-md:hidden text-nowrap">
                    <a href="./index.php" class=" text-2xl font-urbanist italic font-medium hover:text-custom-accent active:text-custom-accent  duration-300">Home</a>
                    <a href="./home.php" class=" text-2xl font-urbanist italic font-medium hover:text-custom-accent active:text-custom-accent  duration-300">Place Order</a>
                    <a href="./cart.php" class=" text-2xl font-urbanist italic font-medium hover:text-custom-accent active:text-custom-accent  duration-300">Cart</a>
                    <a href="./orders.php" class=" text-2xl font-urbanist italic font-medium hover:text-custom-accent active:text-custom-accent  duration-300">Orders</a>
                    <?php if(isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] === True): ?>
                        <a href="./functions/logout.php" class=" text-2xl font-urbanist italic font-medium hover:text-custom-accent active:text-custom-accent duration-300">Logout</a>
                    <?php else: ?>
                        <a href="./login.php" class=" text-2xl font-urbanist italic font-medium hover:text-custom-accent active:text-custom-accent duration-300">Login</a>
                    <?php endif; ?>
                </div>
                <div class="h-full w-full flex items-center justify-end">
                    <form action="./productPage.php" method="get" class="h-[75%] w-full">
                        <label class="input rounded-full float-right h-full w-[50%] max-md:min-w-[200px] max-w-[250px] outline-0 border-custom-accent bg-custom-background">
                            <svg
                            class="h-[1em]  stroke-custom-accent"
                            xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 24 24">
                            <g
                            stroke-linejoin="round"
                            stroke-linecap="round"
                            stroke-width="2.5"
                            fill="none"
                            stroke="">
                            <circle cx="11" cy="11" r="8"></circle>
                            <path d="m21 21-4.3-4.3"></path>
                        </g>
                    </svg>
                    <input type="text" name="search" required placeholder="Explore..." 
                    value="<?php echo htmlspecialchars($search_query ?? ''); ?>" />
                    <?php if (!empty($search_query)): ?>
                        <a href="index.php"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-x-icon lucide-x h-[1em]"><path d="M18 6 6 18"/><path d="m6 6 12 12"/></svg></a>
                        <?php endif; ?>
                    </label>
                </form>
                <div class="drawer drawer-end w-fit md:hidden">
                    <input id="my-drawer-5" type="checkbox" class="drawer-toggle" />
                    <div class="drawer-content">
                        <label for="my-drawer-5" class="drawer-button "><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-menu-icon lucide-menu size-7">
                                <path d="M4 5h16" />
                                <path d="M4 12h16" />
                                <path d="M4 19h16" />
                            </svg></label>
                    </div>
                    <div class="drawer-side backdrop-blur-2xl">
                        <label for="my-drawer-5" aria-label="close sidebar" class="drawer-overlay backdrop-blur-2xl"></label>
                        <ul class="menu bg-custom-background rounded-box w-56 sm:w-100  min-h-screen backdrop-">
                            <li>
                                <h2 class="menu-title">
                                    <?php
                                    include './db/db.php';
                                    if (isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] == True) {
                                        echo $_SESSION['customer_user'];
                                    } else {
                                        echo 'Guest';
                                    }
                                    ?>
                                </h2>
                                <ul>
                                    <li><a href="./home.php"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-map-pin-house-icon lucide-map-pin-house"><path d="M15 22a1 1 0 0 1-1-1v-4a1 1 0 0 1 .445-.832l3-2a1 1 0 0 1 1.11 0l3 2A1 1 0 0 1 22 17v4a1 1 0 0 1-1 1z"/><path d="M18 10a8 8 0 0 0-16 0c0 4.993 5.539 10.193 7.399 11.799a1 1 0 0 0 .601.2"/><path d="M18 22v-3"/><circle cx="10" cy="10" r="3"/></svg>Place Order</a></li>
                                    <li><a href="./cart.php"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-shopping-bag-icon lucide-shopping-bag"><path d="M16 10a4 4 0 0 1-8 0"/><path d="M3.103 6.034h17.794"/><path d="M3.4 5.467a2 2 0 0 0-.4 1.2V20a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6.667a2 2 0 0 0-.4-1.2l-2-2.667A2 2 0 0 0 17 2H7a2 2 0 0 0-1.6.8z"/></svg>Cart</a></li>
                                    <li><a href="./orders.php"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-truck-icon lucide-truck"><path d="M14 18V6a2 2 0 0 0-2-2H4a2 2 0 0 0-2 2v11a1 1 0 0 0 1 1h2"/><path d="M15 18H9"/><path d="M19 18h2a1 1 0 0 0 1-1v-3.65a1 1 0 0 0-.22-.624l-3.48-4.35A1 1 0 0 0 17.52 8H14"/><circle cx="17" cy="18" r="2"/><circle cx="7" cy="18" r="2"/></svg>Orders</a></li>
                                </ul>
                            </li>
                            <?php
                            if (isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] == True) {
                                echo '
                                    <li class="p-2">
                                        <a href="./functions/logout.php" class=" shadow-custom-primary outline-none border-none flex items-center w-full p-2 m-2 bg-custom-accent">
                                            <div class="opacity-65"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-log-in-icon lucide-log-in"><path d="m10 17 5-5-5-5"/><path d="M15 12H3"/><path d="M15 3h4a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-4"/></svg></div>
                                            <div class="font-bold text-lg opacity-65">LOGOUT</div>
                                        </a>
                                    </li>
                                ';
                            } else {
                                echo '
                                    <li class="">
                                        <a href="./login.php" class=" shadow-custom-primary outline-none border-none flex items-center w-full p-2 m-2 bg-custom-accent">
                                            <div class="opacity-65"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-log-in-icon lucide-log-in"><path d="m10 17 5-5-5-5"/><path d="M15 12H3"/><path d="M15 3h4a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-4"/></svg></div>
                                            <div class="font-bold text-lg opacity-65">LOGIN</div>
                                        </a>
                                    </li>
                                ';
                            }
                            ?>
                        </ul>
                    </div>
                </div>
                </div>
                <?php
                if (isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] == True) {
                    echo '
                        <div class="dropdown dropdown-center hidden" >
                            <div tabindex="0" role="button" class="m-1 cursor-pointer">
                            <svg   
                                xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="2"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                class="lucide lucide-user-round-icon lucide-user-round h-8"
                            >
                                <circle cx="12" cy="8" r="5" />
                                <path d="M20 21a8 8 0 0 0-16 0" />
                            </svg>
                            </div>
                            <ul tabindex="-1" class="dropdown-content menu bg-base-100 rounded-box z-1 w-52 p-2 shadow-sm flex gap-1.5 flex-col">
                        ';
                    echo $_SESSION['customer_user'];
                    echo '
                                <li><a>Account</a></li>
                                <hr>
                                <li><a>Orders</a></li>
                                <hr>
                                <li>
                                    <a href="./functions/logout.php" class="btn bg-red-400 flex justify-between w-full p-2">
                                        <div class="w-fit"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-log-out-icon lucide-log-out"><path d="m16 17 5-5-5-5"/><path d="M21 12H9"/><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/></svg></div>
                                        <div class="grow">Log Out</div>
                                    </a>
                                </li>
                            </ul>
                        </div>
                        ';
                } else {
                    echo '
                    <div class="dropdown dropdown-center hidden">
                        <div tabindex="0" role="button" class=" m-1" id="accountIcon">
                            <svg    
                                xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 24 24"
                                // fill="none"
                                stroke="currentColor"
                                stroke-width="2"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                class="lucide lucide-user-round-icon lucide-user-round h-8"
                                id="accountSvg"
                            >
                                <circle cx="12" cy="8" r="5" />
                                <path d="M20 21a8 8 0 0 0-16 0" />
                            </svg>
                        </div>
                        <ul tabindex="-1" class="dropdown-content menu bg-base-100 rounded-box z-1 w-52 p-2 shadow-sm">
                            <li>
                                <a href="./login.php" class="btn flex justify-between w-full p-2">
                                    <div class="shrink"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-log-in-icon lucide-log-in"><path d="m10 17 5-5-5-5"/><path d="M15 12H3"/><path d="M15 3h4a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-4"/></svg></div>
                                    <div class="grow">Log In</div>
                                </a>
                            </li>
                        </ul>
                    </div>
                    ';
                }
                ?>
            <!-- </div> -->
        </div>
    </header>
</body>