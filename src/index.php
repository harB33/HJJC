<!DOCTYPE html>
<html lang="en" data-theme="light" class="overflow-x-clip">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="./image/logo.ico" type="image/x-icon">
    <title>HJJC. STORE | About Us</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/locomotive-scroll@4.1.4/dist/locomotive-scroll.min.css">

    <link href="https://cdn.jsdelivr.net/npm/daisyui@5" rel="stylesheet" type="text/css" />
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link rel="stylesheet" href="./style/output.css" />
    <script src="./script/accountLogo.js" defer></script>
</head>

<body class="w-screen overflow-x-hidden min-h-screen bg-white m-0 p-0 max-md:h-max">
    <?php include './components/header.php'; ?>

    <main class="smooth-scroll w-full min-h-screen relative" data-scroll-container>

        <section class="flex flex-col items-center text-center w-full relative">
            <div class="relative h-screen w-full overflow-hidden">
                <video class="w-full h-full object-cover brightness-50 block" autoplay loop muted playsinline data-scroll data-scroll-speed="-2">
                    <source src="./image/1107.mp4">
                </video>
            </div>
            <div id="title" class="font-light h-screen w-full flex flex-col p-8 justify-center items-center absolute z-20 top-0">
                <div class="w-full flex flex-col items-center justify-center max-w-5xl z-10 mb-8 grow">
                    <h1 class="font-giaza font-black max-lg:text-2xl z-1 text-custom-accent lg:text-5xl text-shadow-lg mb-6">Define Your Standard.</h1>
                    <h1 class="font-light max-lg:text-md text-custom-background/90 lg:text-2xl text-shadow-lg">Relentless perfection. We transform the world's finest ingredients into exquisite beverages that redefine your standard.</h1>
                </div>
            </div>
        </section>
        <section class="h-screen w-full grid grid-cols-[40%_60%] max-md:grid-cols-1 max-md:place-items-center second-section relative z-10 bg-white">
            <div class="grid place-items-center relative max-md:hidden">
                <img src="./image/design.png" alt=""
                    class="rounded-2xl w-lg absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 block max-md:hidden"
                    id="moving-frappe">
            </div>
            <div class="flex flex-col justify-center items-start w-2/3 max-md:text-center">
                <h1 class="font-giaza font-black max-lg:text-3xl lg:text-5xl mb-6">The <span class="">Standard</span> Has Arrived.</h1>
                <p class=" font-light text-md mb-2 lg:text-2xl">HJJC is proud to introduce an unparalleled coffee experience to the Philippines. We are defined by a relentless pursuit of perfection. Our baristas transform the world's finest ingredients into exquisite beverages that stimulate the senses and redefine your expectations.</p>
                <p class=" font-light text-md lg:text-2xl ">Explore the new <span class=" text-black/80 font-giaza capitalize font-black border-b border-gray-400 pb-1 lg:text-3xl">pinnacle of taste.</span></p>
            </div>
        </section>
        <section class="flex flex-col min-h-screen w-full items-center z-10 pt-20 third-section bg-custom-secondary/20">
            <div class="grow flex flex-col justify-center w-full items-center">
                <div class="flex flex-col w-full justify-evenly h-fit items-center max-w-5xl mb-10">
                    <h1 class="font-giaza font-black max-lg:text-2xl mb-6 lg:text-5xl">A Brew to Define Your Day.</h1>
                </div>
                <div class="grid grid-cols-5 max-md:grid-cols-2 gap-4 w-4/5 justify-center mb-20 ">
                    <div class="md:p-4 max-md:p-2 bg-linear-to-br from-custom-primary/50 to-custom-accent/20 rounded-2xl w-full h-max max-md:hidden">
                        <img src="./image/products/product_691187dfa0ee02.31544433.png" alt="" class="rounded-2xl block w-full">
                        <div class="flex w-full justify-between mt-4">
                            <p class="font-bold">Affogato</p>
                            <p class="font-black">₱150</p>
                        </div>
                    </div>
                    <div class="md:p-4 max-md:p-2 bg-linear-to-br from-custom-primary/50 to-custom-accent/20 rounded-2xl w-full h-max">
                        <img src="./image/products/product_691187dfa0ee02.31544433.png" alt="" class="rounded-2xl block w-full">
                        <div class="flex w-full justify-between mt-4">
                            <p class="font-bold">Affogato</p>
                            <p class="font-black">₱150</p>
                        </div>
                    </div>
                    <div class="md:p-4 max-md:p-2 bg-linear-to-br from-custom-primary/50 to-custom-accent/20 rounded-2xl w-full h-max md:hidden">
                        <img src="./image/products/product_691187dfa0ee02.31544433.png" alt="" class="rounded-2xl block w-full">
                        <div class="flex w-full justify-between mt-4">
                            <p class="font-bold">Affogato</p>
                            <p class="font-black">₱150</p>
                        </div>
                    </div>
                    <div class="md:p-4 max-md:p-2 bg-linear-to-br from-custom-primary/50 to-custom-accent/20 rounded-2xl relative w-full h-max max-md:hidden">
                        <img src="./image/products/product_6912e8c629d923.48374687.png" alt="" class="rounded-2xl opacity-0 block w-full" id="target-frappe">
                        <div class="flex w-full items-center justify-between mt-4">
                            <p class=" font-bold text-custom-text leading-none">Caramel Machiato</p>
                            <p class="text-black/80 font-black float-right">₱150</p>
                        </div>
                    </div>
                    <div class="md:p-4 max-md:p-2 bg-linear-to-br from-custom-primary/50 to-custom-accent/20 rounded-2xl w-full h-max">
                        <img src="./image/products/product_691187dfa0ee02.31544433.png" alt="" class="rounded-2xl block w-full">
                        <div class="flex w-full justify-between mt-4">
                            <p class="font-bold">Affogato</p>
                            <p class="font-black">₱150</p>
                        </div>
                    </div>
                    <div class="md:p-4 max-md:p-2 bg-linear-to-br from-custom-primary/50 to-custom-accent/20 rounded-2xl w-full h-max max-md:hidden">
                        <img src="./image/products/product_691187dfa0ee02.31544433.png" alt="" class="rounded-2xl block w-full">
                        <div class="flex w-full justify-between mt-4">
                            <p class="font-bold">Affogato</p>
                            <p class="font-black">₱150</p>
                        </div>
                    </div>
                    <div class="md:p-4 max-md:p-2 border border-custom-accent rounded-2xl w-full group md:hidden">
                        <div class="mb-10 flex justify-center items-center h-full group-hover:scale-105 duration-300">
                            <a href="./home.php" class=" font-black group-hover:text-custom-accent">EXPLORE</a>
                        </div>
                    </div>
                </div>
                <div class="mb-10 max-md:hidden flex justify-center items-center w-full group">
                    <div class="flex items-center justify-center gap-2 hover:text-custom-accent active:text-custom-accent hover:border-dashed hover:border-b not-hover:border-gray-300 hover:border-custom-accent border-b">
                        <a href="./home.php" class=" duration-300 transition-colors flex items-center justify-center group hover:text-custom-accent">Explore</a>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-coffee-icon lucide-coffee group-hover:stroke-[#e69c4d] duration-300 transition-colors"><path d="M10 2v2"/><path d="M14 2v2"/><path d="M16 8a1 1 0 0 1 1 1v8a4 4 0 0 1-4 4H7a4 4 0 0 1-4-4V9a1 1 0 0 1 1-1h14a4 4 0 1 1 0 8h-1"/><path d="M6 2v2"/></svg>
                    </div>
                </div>
            </div>
            <div class="w-full mt-auto z-10 block leading-none">
                <?php include './components/footer.html'; ?>
            </div>
        </section>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/gsap@3.13.0/dist/gsap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/gsap@3.13.0/dist/ScrollTrigger.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/locomotive-scroll@4.1.4/dist/locomotive-scroll.min.js"></script>
    <script src="./script/scrollAnimation.js"></script>
</body>

</html>