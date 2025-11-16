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

<body class="w-screen overflow-x-clip min-h-screen">
    <?php include './components/header.php'; ?>
    <section class="flex flex-col items-center text-center w-full overflow-clip ">
        <div class="h-screen w-screen ">
            <video class="w-full h-full object-cover brightness-50" autoplay loop muted>
                <source src="./image/1107.mp4">
            </video>
        </div>
        <section id="title" class=" font-light h-screen w-full flex flex-col p-8 overflow-clip justify-center items-center absolute z-20">
            <div class=" w-full flex flex-col items-center justify-center max-w-5xl z-10 mb-8 grow">
                <h1 class="font-giaza font-black max-lg:text-2xl z-1 text-custom-accent lg:text-5xl text-shadow-lg mb-6">Define Your Standard.</h1>
                <h1 class=" font-light max-lg:text-md text-custom-background/90 lg:text-2xl text-shadow-lg">Relentless perfection. We transform the world's finest ingredients into exquisite beverages that redefine your standard.</h1>
            </div>
            <div>
                <div class="flex justify-center flex-col items-center">
                    <h1 class="font-extralight text-xs sm:text-xl my-fadeOutText z-1"></h1>
                    <span class="arrow mt-">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-arrow-down-icon lucide-arrow-down stroke-white">
                            <path d="M12 5v14" />
                            <path d="m19 12-7 7-7-7" />
                        </svg>
                    </span>
                </div>
            </div>
        </section>
        <section class="flex flex-col h-lvh px-6 w-full max-lg:pt-20 bg-custom-secondary items-center lg:justify-center lg:pt-0 z-10">
            <div class="flex flex-col items-center max-w-5xl my-moveDown">
                <h1 class="font-giaza font-black max-lg:text-2xl lg:text-5xl mb-6">The <span class="">Standard</span> Has Arrived.</h1>
                <p class=" font-light text-md mb-2 lg:text-2xl">HJJC is proud to introduce an unparalleled coffee experience to the Philippines. We are defined by a relentless pursuit of perfection. Our baristas transform the world's finest ingredients into exquisite beverages that stimulate the senses and redefine your expectations.</p>
                <p class=" font-noarmal text-md lg:text-2xl ">Explore the new <span class="font-giaza capitalize font-black">pinnacle of taste.</span></p>
            </div>
            <div class="my-popUp z-20 lg:hidden">
                <div class="animate-bounce text-custom-accent -rotate-10 translate-y-40 -translate-x-20 text-xl font-black  bg-black/80 p-1.5 rounded-2xl">Caramel Machiato!</div>
            </div>
            <img src="./image/design.png" alt="" class=" my-moveTop lg:hidden">
        </section>
        <section class="flex flex-col h-lvh px-6 w-full justify-evenly bg-custom-secondary/20 items-center  z-10">
            <div class="flex flex-col w-full justify-evenly h-fit items-center max-w-5xl">
                <div>
                    <h1 class="font-giaza font-black max-lg:text-2xl mb-6 lg:text-5xl">A Brew to Define Your Day.</h1>
                    <p class=" font-light text-md lg:text-2xl">Fuel your pursuit of perfection. From robust classics to nuanced single-origins, our menu offers an exquisite beverage to satisfy your distinct taste.</p>
                </div>
            </div>
            <div class="slider" style="--width: 225px;--height:300px;--quantity:10;">
                <div class="slider_list">
                    <div class="list_item h-max p-4 bg-linear-to-br from-custom-primary/50 to-custom-accent/20 rounded-2xl" style="--position:1"><img src="./image/products/product_691187dfa0ee02.31544433.png" alt="" class="rounded-2xl">
                        <div class="flex w-full justify-between  ">
                            <p class="text-xl font-bold pb-3 text-custom-accent leading-none">Affogato</p>
                            <p class="text-black/80 text-2xl font-black float-right">₱150</p>
                        </div>
                    </div>
                    <div class="list_item p-4 bg-linear-to-br from-custom-primary/50 to-custom-accent/20 rounded-2xl" style="--position:2"><img src="./image/products/product_691187f16780b4.98755633.png" alt="" class="rounded-2xl">
                        <div class="flex w-full justify-between">
                            <p class="text-xl font-bold pb-3 text-custom-accent leading-none">Americano</p>
                            <p class="text-black/80 text-2xl font-black float-right">₱150</p>
                        </div>
                    </div>
                    <div class="list_item p-4 bg-linear-to-br from-custom-primary/50 to-custom-accent/20 rounded-2xl" style="--position:4"><img src="./image/products/product_69118851ee63a8.69493917.png" alt="" class="rounded-2xl">
                        <div class="flex w-full justify-between">
                            <p class="text-xl font-bold pb-3 text-custom-accent leading-none">Coffee Frappé</p>
                            <p class="text-black/80 text-2xl font-black float-right">₱150</p>
                        </div>
                    </div>
                    <div class="list_item p-4 bg-linear-to-br from-custom-primary/50 to-custom-accent/20 rounded-2xl" style="--position:5"><img src="./image/products/product_691188318450d4.46308589.png" alt="" class="rounded-2xl">
                        <div class="flex w-full justify-between">
                            <p class="text-xl font-bold pb-3 text-custom-accent leading-none">Chocolate Frappé</p>
                            <p class="text-black/80 text-2xl font-black float-right">₱150</p>
                        </div>
                    </div>
                    <div class="list_item p-4 bg-linear-to-br from-custom-primary/50 to-custom-accent/20 rounded-2xl" style="--position:3"><img src="./image/products/product_69118842ed1234.57943100.png" alt="" class="rounded-2xl">
                        <div class="flex w-full justify-between">
                            <p class="text-xl font-bold pb-3 text-custom-accent leading-none">Caramel Frappé</p>
                            <p class="text-black/80 text-2xl font-black float-right">₱150</p>
                        </div>
                    </div>
                    <div class="list_item p-4 bg-linear-to-br from-custom-primary/50 to-custom-accent/20 rounded-2xl" style="--position:6"><img src="./image/products/product_691187dfa0ee02.31544433.png" alt="" class="rounded-2xl">
                        <div class="flex w-full justify-between">
                            <p class="text-xl font-bold pb-3 text-custom-accent">Affogato</p>
                            <p class="text-black/80 text-2xl font-black float-right">₱150</p>
                        </div>
                    </div>
                    <div class="list_item p-4 bg-linear-to-br from-custom-primary/50 to-custom-accent/20 rounded-2xl" style="--position:7"><img src="./image/products/product_691187f16780b4.98755633.png" alt="" class="rounded-2xl">
                        <div class="flex w-full justify-between">
                            <p class="text-xl font-bold pb-3 text-custom-accent">Americano</p>
                            <p class="text-black/80 text-2xl font-black float-right">₱150</p>
                        </div>
                    </div>
                    <div class="list_item p-4 bg-linear-to-br from-custom-primary/50 to-custom-accent/20 rounded-2xl" style="--position:8"><img src="./image/products/product_69118842ed1234.57943100.png" alt="" class="rounded-2xl">
                        <div class="flex w-full justify-between">
                            <p class="text-xl font-bold pb-3 text-custom-accent leading-none">Coffee Frappé</p>
                            <p class="text-black/80 text-2xl font-black float-right">₱150</p>
                        </div>
                    </div>
                    <div class="list_item p-4 bg-linear-to-br from-custom-primary/50 to-custom-accent/20 rounded-2xl" style="--position:9"><img src="./image/products/product_69118851ee63a8.69493917.png" alt="" class="rounded-2xl">
                        <div class="flex w-full justify-between">
                            <p class="text-xl font-bold pb-3 text-custom-accent leading-none">Chocolate Frappé</p>
                            <p class="text-black/80 text-2xl font-black float-right">₱150</p>
                        </div>
                    </div>
                    <div class="list_item p-4 bg-linear-to-br from-custom-primary/50 to-custom-accent/20 rounded-2xl" style="--position:10"><img src="./image/products/product_691188318450d4.46308589.png" alt="" class="rounded-2xl">
                        <div class="flex w-full justify-between">
                            <p class="text-xl font-bold pb-3 text-custom-accent leading-none">Caramel Frappé</p>
                            <p class="text-2xl font-black float-right text-black/80">₱150</p>
                        </div>
                    </div>
                </div>
            </div>
            <div>
                <a href="./home.php" class="underline flex gap-0.5 max-lg:text-xl">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-coffee-bean-icon lucide-coffee-bean">
                        <path d="M4.05 19.95a11.24 8.585 135 0 0 15.9-15.9 11.24 8.585 135 0 0-15.9 15.9" />
                        <path d="M19.8 4.2C20 14 4 10 4.2 19.8" />
                    </svg>
                    Explore</a>
            </div>
        </section>
        <section class=" z-10">
            <?php include './components/footer.html'; ?>
        </section>
    </section>
</body>

</html>