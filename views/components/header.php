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

<body data-theme="light" class="">
    <header class="fixed top-0 w-screen flex justify-center z-50 items-center lg:px-5 lg:py-2 max-lg:px-2.5 max-lg:py-0.5  backdrop-blur-2xl">
        <div class="flex max-w-7xl w-full items-center justify-between">
            <a href="<?php echo BASE_URL; ?>/" class="grow"><img src="<?php echo ASSET_URL; ?>/images/logo/Coffee_Logo.png" alt="logo" class="size-12" /></a>
            <!-- <div class="flex items-center gap-2 w-full justify-end md:justify-center"> -->
            <div class="flex items-center justify-between grow-2">
                <a href="<?php echo BASE_URL; ?>/" class="text-2xl font-urbanist italic font-light text-zinc-100 border-b-2 border-transparent hover:border-custom-accent transition-all duration-300">Home</a>
                <a href="<?php echo BASE_URL; ?>/home" class="text-2xl font-urbanist italic font-light text-zinc-100 border-b-2 border-transparent hover:border-custom-accent transition-all duration-300">Menu</a>
                <a href="#" class="text-2xl font-urbanist italic font-light text-zinc-100 border-b-2 border-transparent hover:border-custom-accent transition-all duration-300">Contact</a>
                <a href="#" class="text-2xl font-urbanist italic font-light text-zinc-100 border-b-2 border-transparent hover:border-custom-accent transition-all duration-300">About Us</a>
            </div>
            <div class="flex items-center justify-end grow gap-2">
                <!-- <form action="/product" method="get" class="h-[65%] w-full">
                    <label class="input rounded-full float-right h-full w-[50%] max-md:min-w-[200px] max-w-[250px] outline-0 border-2 border-custom-accent bg-zinc-100/10">
                        <svg
                        class="size-4  stroke-custom-accent"
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
                <input type="text" name="search" class="text-zinc-100 placeholder-zinc-100" required placeholder="Explore..." 
                    value="<?php echo htmlspecialchars($search_query ?? ''); ?>" />
                    <?php if (!empty($search_query)): ?>
                        <a href="/"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" class="size-6" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-x-icon lucide-x h-[1em]"><path d="M18 6 6 18"/><path d="m6 6 12 12"/></svg></a>
                    <?php endif; ?>
                    </label>
                </form> -->
                <a href="<?php echo BASE_URL; ?>/cart" class=" text-2xl font-urbanist italic font-medium hover:text-custom-accent active:text-custom-accent  duration-300"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1" stroke="currentColor" class="size-8.5 stroke-zinc-100 hover:stroke-custom-accent"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5V6a3.75 3.75 0 1 0-7.5 0v4.5m11.356-1.993 1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 0 1-1.12-1.243l1.264-12A1.125 1.125 0 0 1 5.513 7.5h12.974c.576 0 1.059.435 1.119 1.007ZM8.625 10.5a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm7.5 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" /></svg></a>
                <div class="dropdown dropdown-hover dropdown-end group">
                    <div tabindex="0" role="button" class="group-hover:text-custom-accent hover:text-custom-accent active:text-custom-accent duration-300">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1" stroke="currentColor" class="size-8.5 stroke-zinc-100 group-hover:stroke-custom-accent hover:stroke-custom-accent"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" /></svg></div>
                    <ul tabindex="-1" class="dropdown-content menu bg-base-100 rounded-box z-1 w-52 p-2 shadow-sm">
                        <li><a href="<?php echo BASE_URL; ?>/orders" class="text-lg font-urbanist border-l-2 border-transparent hover:border-custom-accent transition-all duration-300">Orders</a></li>
                        <li>
                            <?php if(isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] === True): ?>
                                <a href="<?php echo BASE_URL; ?>/handlers/logout.php" class="text-lg font-urbanist border-l-2 border-transparent hover:border-custom-accent transition-all duration-300">Logout</a>
                            <?php else: ?>
                                <a href="<?php echo BASE_URL; ?>/login" class="text-lg font-urbanist border-l-2 border-transparent hover:border-custom-accent transition-all duration-300">Login</a>
                            <?php endif; ?>
                        </li>
                    </ul>
                </div>

                <!-- mobile navbar -->
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