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
    <header class="fixed top-0 left-0 w-full flex justify-center z-50 items-center lg:px-10 lg:py-4 px-6 py-3 backdrop-blur-md bg-black/10 border-b border-white/5 transition-all duration-300">
        <div class="flex justify-between items-center w-full max-w-7xl mx-auto">
            <!-- Logo Section -->
            <a href="<?php echo BASE_URL; ?>/" class="flex-shrink-0">
                <img src="<?php echo ASSET_URL; ?>/images/logo/Coffee_Logo.png" alt="logo" class="max-lg:h-12 lg:h-14 object-contain hover:scale-105 transition-transform duration-300" />
            </a>
            <!-- Navigation Links - Desktop -->
            <nav class="hidden md:flex items-center lg:gap-10 md:gap-6">
                <a href="<?php echo BASE_URL; ?>/" class="text-lg font-urbanist font-semibold text-zinc-100 hover:text-custom-accent transition-colors duration-300 relative group">
                    Home
                    <span class="absolute -bottom-1 left-0 w-0 h-0.5 bg-custom-accent transition-all duration-300 group-hover:w-full"></span>
                </a>
                <a href="<?php echo BASE_URL; ?>/home" class="text-lg font-urbanist font-semibold text-zinc-100 hover:text-custom-accent transition-colors duration-300 relative group">
                    Products
                    <span class="absolute -bottom-1 left-0 w-0 h-0.5 bg-custom-accent transition-all duration-300 group-hover:w-full"></span>
                </a>
                <a href="#" class="text-lg font-urbanist font-semibold text-zinc-100 hover:text-custom-accent transition-colors duration-300 relative group">
                    About Us
                    <span class="absolute -bottom-1 left-0 w-0 h-0.5 bg-custom-accent transition-all duration-300 group-hover:w-full"></span>
                </a>
                <a href="#" class="text-lg font-urbanist font-semibold text-zinc-100 hover:text-custom-accent transition-colors duration-300 relative group">
                    Contact
                    <span class="absolute -bottom-1 left-0 w-0 h-0.5 bg-custom-accent transition-all duration-300 group-hover:w-full"></span>
                </a>
            </nav>

            <!-- Actions Section (Cart, Profile, Mobile Menu) -->
            <div class="flex items-center lg:gap-6 gap-4">
                <!-- Cart Icon -->
                <a href="<?php echo BASE_URL; ?>/cart" class="text-zinc-100 hover:text-custom-accent transition-all duration-300 transform hover:scale-110">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5V6a3.75 3.75 0 1 0-7.5 0v4.5m11.356-1.993 1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 0 1-1.12-1.243l1.264-12A1.125 1.125 0 0 1 5.513 7.5h12.974c.576 0 1.059.435 1.119 1.007ZM8.625 10.5a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm7.5 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                    </svg>
                </a>

                <!-- Profile Dropdown -->
                <div class="dropdown dropdown-hover dropdown-end group">
                    <div tabindex="0" role="button" class="text-zinc-100 group-hover:text-custom-accent transition-all duration-300 transform hover:scale-110">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                        </svg>
                    </div>
                    <ul tabindex="-1" class="dropdown-content menu bg-zinc-900/90 backdrop-blur-xl border border-white/10 rounded-xl z-50 w-52 p-2 shadow-2xl mt-4">
                        <li><a href="<?php echo BASE_URL; ?>/orders" class="text-zinc-100 hover:bg-custom-accent hover:text-black font-urbanist transition-all duration-200">Orders</a></li>
                        <hr class="border-white/10 my-1">
                        <li>
                            <?php if(isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] === True): ?>
                                <a href="<?php echo BASE_URL; ?>/handlers/logout.php" class="text-zinc-100 hover:bg-red-500 hover:text-white font-urbanist transition-all duration-200">Logout</a>
                            <?php else: ?>
                                <a href="<?php echo BASE_URL; ?>/login" class="text-zinc-100 hover:bg-custom-accent hover:text-black font-urbanist transition-all duration-200">Login</a>
                            <?php endif; ?>
                        </li>
                    </ul>
                </div>

                <!-- Mobile Drawer Toggle -->
                <div class="drawer drawer-end w-fit md:hidden">
                    <input id="mobile-drawer" type="checkbox" class="drawer-toggle" />
                    <div class="drawer-content">
                        <label for="mobile-drawer" class="text-zinc-100 hover:text-custom-accent cursor-pointer">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="size-7">
                                <path d="M4 5h16" />
                                <path d="M4 12h16" />
                                <path d="M4 19h16" />
                            </svg>
                        </label>
                    </div>
                    <div class="drawer-side z-[60]">
                        <label for="mobile-drawer" aria-label="close sidebar" class="drawer-overlay"></label>
                        <ul class="menu p-6 w-80 min-h-full bg-zinc-900 text-zinc-100">
                            <li class="mb-8">
                                <h2 class="text-2xl font-giaza font-bold text-custom-accent">
                                    <?php
                                    if (isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] == True) {
                                        echo htmlspecialchars($_SESSION['customer_user']);
                                    } else {
                                        echo 'Welcome, Guest';
                                    }
                                    ?>
                                </h2>
                            </li>
                            <li><a href="<?php echo BASE_URL; ?>/" class="text-lg py-3 hover:text-custom-accent">Home</a></li>
                            <li><a href="<?php echo BASE_URL; ?>/home" class="text-lg py-3 hover:text-custom-accent">Products</a></li>
                            <li><a href="<?php echo BASE_URL; ?>/cart" class="text-lg py-3 hover:text-custom-accent">My Cart</a></li>
                            <li><a href="<?php echo BASE_URL; ?>/orders" class="text-lg py-3 hover:text-custom-accent">My Orders</a></li>
                            <div class="mt-auto pt-6">
                                <?php if (isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] == True): ?>
                                    <a href="<?php echo BASE_URL; ?>/handlers/logout.php" class="btn btn-outline border-red-500 text-red-500 hover:bg-red-500 hover:border-red-500 w-full">LOGOUT</a>
                                <?php else: ?>
                                    <a href="<?php echo BASE_URL; ?>/login" class="btn btn-outline border-custom-accent text-custom-accent hover:bg-custom-accent hover:text-black w-full">LOGIN</a>
                                <?php endif; ?>
                            </div>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </header>
</body>