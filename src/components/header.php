<head>
    <link
        href="https://cdn.jsdelivr.net/npm/daisyui@5"
        rel="stylesheet"
        type="text/css" />
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link rel="stylesheet" href="./style/output.css" />
</head>

<body data-theme="light">
    <header
        class="shadow sticky top-0 bg-white w-screen p-2 flex justify-center items-center">
        <div class="flex items-center justify-between w-[90%]">
            <a href="./index.php">
                <img src="./image/logo.png" alt="logo" class="h-14" />
            </a>
            <div class="flex items-center gap-4">
                <label class="input rounded-full">
                    <svg
                        class="h-[1em] opacity-50"
                        xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 24 24">
                        <g
                            stroke-linejoin="round"
                            stroke-linecap="round"
                            stroke-width="2.5"
                            fill="none"
                            stroke="currentColor">
                            <circle cx="11" cy="11" r="8"></circle>
                            <path d="m21 21-4.3-4.3"></path>
                        </g>
                    </svg>
                    <input type="search" required placeholder="Search" />
                </label>
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="2"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    class="lucide lucide-shopping-bag-icon lucide-shopping-bag h-10">
                    <path d="M16 10a4 4 0 0 1-8 0" />
                    <path d="M3.103 6.034h17.794" />
                    <path
                        d="M3.4 5.467a2 2 0 0 0-.4 1.2V20a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6.667a2 2 0 0 0-.4-1.2l-2-2.667A2 2 0 0 0 17 2H7a2 2 0 0 0-1.6.8z" />
                </svg>
                <?php
                session_start();
                if (isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] == True) {
                    echo '
                        
                        <div class="dropdown dropdown-center">
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
                                    <a href="logout.php" class="btn bg-red-400 flex justify-between w-full p-2">
                                        <div class="w-fit"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-log-out-icon lucide-log-out"><path d="m16 17 5-5-5-5"/><path d="M21 12H9"/><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/></svg></div>
                                        <div class="grow">Log Out</div>
                                    </a>
                                </li>
                            </ul>
                        </div>
                        ';
                } else {
                    echo '
                    <div class="dropdown dropdown-center">
                        <div tabindex="0" role="button" class=" m-1">
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
            </div>
        </div>
    </header>
</body>