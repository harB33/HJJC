<?php
// Note: Config is assumed to be required in the including page
require_once __DIR__ . '/../../public/handlers/searchbar.php';
?>

<head>
    <link
        href="https://cdn.jsdelivr.net/npm/daisyui@5"
        rel="stylesheet"
        type="text/css" />
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link rel="stylesheet" href="<?php echo ASSET_URL; ?>/css/output.css" />
    <script src="<?php echo ASSET_URL; ?>/js/script.js" defer></script>
</head>

<body data-theme="light" class="backdrop-blur-lg ">
    <header class="shadow fixed top-0 w-screen flex justify-center z-50 items-center lg:px-5 lg:py-2 max-lg:px-2.5 max-lg:py-0.5  bg-custom-background backdrop-blur-sm">
        <div class="grid md:grid-cols-3 max-lg:grid-cols-2 items-center w-full max-sm:pr-6">
            <a href="<?php echo BASE_URL; ?>/" class="">
                <img src="<?php echo ASSET_URL; ?>/images/logo/Coffee_Logo.png" alt="logo" class="max-lg:h-12 lg:h-16 object-contain" />
            </a>
            <!-- <div class="flex items-center gap-2 w-full justify-end md:justify-center"> -->
            <div class="grow items-center flex justify-center md:gap-4 lg:gap-12 max-md:hidden text-nowrap">
                <a href="<?php echo BASE_URL; ?>/" class=" text-2xl font-urbanist italic font-medium hover:text-custom-accent active:text-custom-accent  duration-300">Home</a>
                <a href="<?php echo BASE_URL; ?>/home" class=" text-2xl font-urbanist italic font-medium hover:text-custom-accent active:text-custom-accent  duration-300">Place Order</a>
                <a href="<?php echo BASE_URL; ?>/cart" class=" text-2xl font-urbanist italic font-medium hover:text-custom-accent active:text-custom-accent  duration-300">Cart</a>
                <a href="<?php echo BASE_URL; ?>/orders" class=" text-2xl font-urbanist italic font-medium hover:text-custom-accent active:text-custom-accent  duration-300">Orders</a>
                <?php if(isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] === True): ?>
                    <a href="<?php echo BASE_URL; ?>/handlers/logout.php" class=" text-2xl font-urbanist italic font-medium hover:text-custom-accent active:text-custom-accent duration-300">Logout</a>
                <?php else: ?>
                    <a href="<?php echo BASE_URL; ?>/login" class=" text-2xl font-urbanist italic font-medium hover:text-custom-accent active:text-custom-accent duration-300">Login</a>
                <?php endif; ?>
            </div>
            <div class="h-full w-full flex items-center justify-end">
                <form action="/product" method="get" class="h-[75%] w-full">
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
                        <a href="/"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-x-icon lucide-x h-[1em]"><path d="M18 6 6 18"/><path d="m6 6 12 12"/></svg></a>
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
                                    // DB connection is already available via config.php required in main page
                                    if (isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] == True) {
                                        echo $_SESSION['customer_user'];
                                    } else {
                                        echo 'Guest';
                                    }
                                    ?>
                                </h2>
                                <ul>
                                    <li><a href="<?php echo BASE_URL; ?>/home"><svg ...>Place Order</a></li>
                                    <li><a href="<?php echo BASE_URL; ?>/cart"><svg ...>Cart</a></li>
                                    <li><a href="<?php echo BASE_URL; ?>/orders"><svg ...>Orders</a></li>
                                </ul>
                            </li>
                            <?php
                            if (isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] == True) {
                                echo '
                                    <li class="p-2">
                                        <a href="' . BASE_URL . '/handlers/logout.php" class=" shadow-custom-primary outline-none border-none flex items-center w-full p-2 m-2 bg-custom-accent">
                                            <div class="opacity-65"><svg ...></div>
                                            <div class="font-bold text-lg opacity-65">LOGOUT</div>
                                        </a>
                                    </li>
                                ';
                            } else {
                                echo '
                                    <li class="">
                                        <a href="' . BASE_URL . '/login" class=" shadow-custom-primary outline-none border-none flex items-center w-full p-2 m-2 bg-custom-accent">
                                            <div class="opacity-65"><svg ...></div>
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
                            ...
                                <li><a>Account</a></li>
                                <hr>
                                <li><a>Orders</a></li>
                                <hr>
                                <li>
                                    <a href="' . BASE_URL . '/handlers/logout.php" class="btn bg-red-400 flex justify-between w-full p-2">
                                        <div class="w-fit"><svg ...></div>
                                        <div class="grow">Log Out</div>
                                    </a>
                                </li>
                            </ul>
                        </div>
                        ';
                } else {
                    echo '
                    <div class="dropdown dropdown-center hidden">
                        ...
                        <ul tabindex="-1" class="dropdown-content menu bg-base-100 rounded-box z-1 w-52 p-2 shadow-sm">
                            <li>
                                <a href="' . BASE_URL . '/login" class="btn flex justify-between w-full p-2">
                                    <div class="shrink"><svg ...></div>
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