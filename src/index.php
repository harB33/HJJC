<!DOCTYPE html>
<html lang="en" data-theme="light" class=" overflow-x-clip">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="./image/logo.ico" type="image/x-icon">
    <title>HJJC. STORE|About Us</title>
    <link
        href="https://cdn.jsdelivr.net/npm/daisyui@5"
        rel="stylesheet"
        type="text/css" />
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link rel="stylesheet" href="./style/output.css" />
    <script src="./script/accountLogo.js" defer></script>
</head>
<body class="w-screen overflow-x-clip min-h-screen bg-custom-background">
    <div class="sticky top-0 z-50 w-full backdrop-blur-sm ">
        <?php include './components/header.php'; ?>
    </div>
    <section class="flex flex-col items-center text-center w-full overflow-clip ">
        <section id="title" class=" font-light h-[80vh] w-full uppercase flex flex-col p-8 overflow-clip justify-center items-center relative bg-linear-to-br from-custom-primary/40 to-custom-secondary/50 z-20">
            <div class=" w-full flex flex-col items-center justify-center max-sm:bg-custom-background/90 z-10 mb-8 grow">
                <h1 class="font-giaza font-black text-6xl sm:text-8xl  z-1 my-fadeOutText ">HJJC. Store</h1>
                <h1 class=" font-light text-3xl sm:text-4xl my-fadeOutText z-1 ">Your one-stop shop for <span class="font-bold underline italic opacity-85 text-shadow-xs text-5xl font-giaza text-custom-primary">everything</span> you need!</h1>
                <h1 class=" font-extralight text-xl sm:text-xl  z-1 my-fadeOutText w-[60%]">At HJJC Store, we make shopping easy and convenient. From gadgets to everyday essentials, find everything you need in one place — quality, value, and variety all under one roof.</h1>
                <div class=" translate-y-14">
                    <a href="./home.php" class="btn btn-primary btn-lg rounded-2xl bg-custom-primary/80 text-custom-background  my-fadeOutText">Shop Now!</a>
                    <a href="./home.php" class="btn btn-primary btn-lg rounded-2xl bg-custom-background text-custom-primary/85  my-fadeOutText">Know More</a>
                </div>
            </div>
            <div>
                <div class="flex justify-center flex-col items-center">
                    <h1 class="font-extralight text-xs sm:text-xl my-fadeOutText z-1">Scroll down to discover who we are and why customers love us.</h1>
                    <span class="arrow mt-">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-arrow-down-icon lucide-arrow-down"><path d="M12 5v14"/><path d="m19 12-7 7-7-7"/></svg>
                    </span>
                </div>
            </div>
            <img src="./image/circle.png" alt="circle" class="sm:size-150 absolute -left-50 sm:-left-65 -bottom-70 z-0 my-circle size-100" />
            <img src="./image/circle.png" alt="circle" class="sm:size-250 sm:-right-95 sm:-top-130 size-110 absolute -top-45 -right-50 my-circle z-0 " />
        </section>
        <section class="flex flex-col h-[80vh] w-full justify-center bg-custom-secondary/20 items-center  z-10">
            <div class="flex flex-col h-full items-center py-20">
                <h1 class="text-2xl sm:text-6xl font-bold my-fadeInText m-6 uppercase font-giaza">Why shop with Us?</h1>
                <div class="grid grid-cols-3 h-full gap-8 place-content-center w-[80%] max-sm:grid-cols-1 max-sm:gap-4 my-fadeInText">
                    <div class="flex flex-col items-center gap-4">
                        <svg xmlns="http://www.w3.org/2000/svg" width="100" height="100" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-truck-icon lucide-truck"><path d="M14 18V6a2 2 0 0 0-2-2H4a2 2 0 0 0-2 2v11a1 1 0 0 0 1 1h2"/><path d="M15 18H9"/><path d="M19 18h2a1 1 0 0 0 1-1v-3.65a1 1 0 0 0-.22-.624l-3.48-4.35A1 1 0 0 0 17.52 8H14"/><circle cx="17" cy="18" r="2"/><circle cx="7" cy="18" r="2"/></svg>
                        <div class="min-h-[100px]">
                            <h1 class="text-2xl font-bold">Fast Delivery</h1>
                            <p>Get your products delivered at your doorstep in record time.</p>
                        </div>
                    </div>
                    <div class="flex flex-col items-center gap-4">
                        <svg xmlns="http://www.w3.org/2000/svg"width="100" height="100" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-shield-check-icon lucide-shield-check"><path d="M20 13c0 5-3.5 7.5-7.66 8.95a1 1 0 0 1-.67-.01C7.5 20.5 4 18 4 13V6a1 1 0 0 1 1-1c2 0 4.5-1.2 6.24-2.72a1.17 1.17 0 0 1 1.52 0C14.51 3.81 17 5 19 5a1 1 0 0 1 1 1z"/><path d="m9 12 2 2 4-4"/></svg>
                        <div class="min-h-[100px]">
                            <h1 class="text-2xl font-bold">Trusted by Thousands</h1>
                            <p>We are proud to be trusted by a growing community of happy customers.</p>
                        </div>
                    </div>
                    <div class="flex flex-col items-center gap-4">
                        <svg xmlns="http://www.w3.org/2000/svg" width="100" height="10  0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-circle-check-big-icon lucide-circle-check-big"><path d="M21.801 10A10 10 0 1 1 17 3.335"/><path d="m9 11 3 3L22 4"/></svg>
                        <div class="min-h-[100px]">
                            <h1 class="text-2xl font-bold">Real Product Real Value</h1>
                            <p>100% authentic, high quality items, guaranteed.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- <section class=" w-full overflow-clip flex  bg-red-800 z-30">
            <div class="absolute flex top-[163%]">
                <img src="./image/shop-now.png" alt="circle" class="w-1/2 max-sm:w-full my-moveIn" />
                <img src="./image/shop-now.png" alt="circle" class="w-1/2 max-sm:w-full my-moveIn" />
                <img src="./image/shop-now.png" alt="circle" class="w-1/2 max-sm:w-full my-moveIn" />
                <img src="./image/shop-now.png" alt="circle" class="w-1/2 max-sm:w-full my-moveIn" />
                <img src="./image/shop-now.png" alt="circle" class="w-1/2 max-sm:w-full my-moveIn" />
                <img src="./image/shop-now.png" alt="circle" class="w-1/2 max-sm:w-full my-moveIn" />
                <img src="./image/shop-now.png" alt="circle" class="w-1/2 max-sm:w-full my-moveIn" />
            </div>
        </section> -->
        <section class=" relative max-sm:hidden flex flex-col h-[90vh] w-full justify-center">
            <div class="flex flex-col h-full  items-center py-20">
                <h1 class="text-2xl sm:text-5xl font-bold m-6 uppercase my-fadeInText my-popUp z-5 font-giaza">Explore our Featured Products</h1>
                <div class="grid grid-cols-3 h-full gap-8 place-contents-center content-center w-fit">
                    <div class="flex flex-col gap-6">
                        <img src="./image/gemini-gpu.png" alt="" class="size-80 rounded-2xl border hover:scale-105 transition-transform duration-300">
                        <div class="flex flex-col items-start">
                            <h1 class="text-2xl font-bold ">PC Components</h1>
                            <a href="" class="hover:underline opacity-70">Shop Now -></a>
                        </div>
                    </div>
                    <div class="flex flex-col gap-6">
                    <img src="./image/gemini-apparel.png" alt=""  class="size-80 rounded-2xl border hover:scale-105 transition-transform duration-300">
                        <div class="flex flex-col items-start">
                            <h1 class="text-2xl font-bold ">Apparel & Shoes</h1>
                            <a href="" class="hover:underline opacity-70">Shop Now -></a>
                        </div>
                    </div>
                    <div class="flex flex-col gap-6">
                    <img src="./image/gemini-tech.png" alt="" class="size-80 rounded-2xl border hover:scale-105 transition-transform duration-300">
                        <div class="flex flex-col items-start">
                            <h1 class="text-2xl font-bold ">Laptop & Tech</h1>
                            <a href="" class="hover:underline opacity-70">Shop Now -></a>
                        </div>
                    </div>
                </div>
                <a href="./home.php" class="hover:underline text-xl">Shop All Products</a>
            </div>
        </section>
        <section class="my-fadeInFooter z-10">
            <?php include './components/footer.html'; ?>
        </section>
    </section>
</body>

</html>