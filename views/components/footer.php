<head>
    <link
        href="https://cdn.jsdelivr.net/npm/daisyui@5"
        rel="stylesheet"
        type="text/css"
    />
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link rel="stylesheet" href="<?php echo ASSET_URL; ?>/css/output.css" />
</head>
<body data-theme="light">
    <section class="col-span-full w-screen grid grid-cols-12 bg-custom-primary pt-32">
        <h1 class="w-full grid-span-full text-[8.7cqi] -ml-1 font-giaza font-black text-nowrap uppercase tracking-tight text-white leading-none">Define Your Standard.</h1>
    </section>
    <section class=" col-start-1 col-end-13 p-16 min-h-[50vh] flex">
        <div class="w-1/2 h-full flex flex-col justify-between">
            <div>
                <h1 class="max-w-xs">Our subscription service will keep you up to date on new roast, special offers, and brewing tips that have to offer.</h1>
                <div class="border-b max-w-sm p-2 pt-8 flex justify-between">
                    <input type="text" placeholder="your email" class=" border-none outline-none">
                    <button type="submit" class="flex items-center gap-2">Submit <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-arrow-right-icon lucide-arrow-right"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg></button>
                </div>
            </div>
            <div class="flex items-center gap-4">
                <img src="<?php echo ASSET_URL; ?>/images/logo/Coffee_Logo.png" alt="" class="aspect-square w-32 h-auto rounded-full border" >
                <p class="font-giaza text-9xl leading-none text-custom-accent font-black -mt-10">HJJC.</p>
            </div>
        </div>
        <div class="w-1/2 h-full flex gap-16 justify-end">
            <div class="flex flex-col gap-4" >
                <div class="flex flex-col items-end" >
                    <a href="mailto:hjjc.store@gmail.com">hjjc.store@gmail.com</a>
                    <a href="">location:</a>
                </div>
            </div>
            <div class="flex flex-col gap-4">
                <div class="flex flex-col items-end" >
                    <a href="">Home</a>
                    <a href="">Menu</a>
                    <a href="">Contact</a>
                    <a href="">About Us</a>
                </div>
                <div class="flex flex-col items-end" >
                    <a href="">FaceBook</a>
                    <a href="">YouTube</a>
                    <a href="">X (Twitter)</a>
                    <a href="">Instagram</a>
                    <a href="">LinkedIn</a>
                </div>
            </div>
        </div>
    </section>
    <!-- <footer
        class="grid grid-cols-[auto_auto] bg-custom-primary text-center p-2 w-screen"
    >
        <div class="flex items-center gap-2">
            <img
                src="./image/logo/Coffee_Logo.png"
                alt="logo"
                class="size-12"
            />
            <h1 class="text-black font-giaza text-2xl">HJJC Store</h1>
        </div>
        <div class="flex items-center gap-8 flex-wrap">
            <a
                href="#"
                target="_blank"
                class="flex text-black gap-2 hover:text-custom-secondary active:text-custom-secondary hover:scale-105 duration-300"
            >
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    width="24"
                    height="24"
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="2"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    class="lucide hover:stroke-custom-secondary lucide-facebook-icon lucide-facebook"
                >
                    <path
                        d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"
                    />
                </svg>
                HJJC Facebook Page</a
            >
            <a
                href="mailto:hjjc.store@gmail.com?subject=Inquiry%20About%20My%20Order&body=Please%20provide%20an%20update%20on%20order%20%231234."
                target="_blank"
                class="flex text-black gap-2 hover:text-custom-secondary active:text-custom-secondary hover:scale-105 duration-300"
                ><svg
                    xmlns="http://www.w3.org/2000/svg"
                    width="24"
                    height="24"
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="2"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    class="lucide lucide-mail-icon lucide-mail hover:stroke-custom-secondary"
                >
                    <path d="m22 7-8.991 5.727a2 2 0 0 1-2.009 0L2 7" />
                    <rect x="2" y="4" width="20" height="16" rx="2" />
                </svg>
                hjjc.store@gmail.com</a
            >
            <a
                href="https://www.google.com/maps/place/Universidad+De+Manila/@14.5915711,120.9789956,17z/data=!3m1!4b1!4m6!3m5!1s0x3397ca18d1ebbc55:0xd017325c95111277!8m2!3d14.5915659!4d120.9815705!16zL20vMGR6bGI2?entry=ttu&g_ep=EgoyMDI1MTExMS4wIKXMDSoASAFQAw%3D%3D"
                target="_blank"
                class="flex text-black gap-2 hover:text-custom-secondary active:text-custom-secondary hover:scale-105 duration-300"
                ><svg
                    xmlns="http://www.w3.org/2000/svg"
                    width="24"
                    height="24"
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="2"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    class="lucide hover:stroke-custom-secondary lucide-map-pin-house-icon lucide-map-pin-house"
                >
                    <path
                        d="M15 22a1 1 0 0 1-1-1v-4a1 1 0 0 1 .445-.832l3-2a1 1 0 0 1 1.11 0l3 2A1 1 0 0 1 22 17v4a1 1 0 0 1-1 1z"
                    />
                    <path
                        d="M18 10a8 8 0 0 0-16 0c0 4.993 5.539 10.193 7.399 11.799a1 1 0 0 0 .601.2"
                    />
                    <path d="M18 22v-3" />
                    <circle cx="10" cy="10" r="3" />
                </svg>
                659-A Cecilia Muñoz St, Ermita, Manila, 1000 Metro Manila</a
            >
        </div>
    </footer> -->
</body>
