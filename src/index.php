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
</head>

<body class="w-screen overflow-x-clip min-h-screen">
    <div class="sticky top-0 z-50 w-full">
        <?php include './components/header.php'; ?>
    </div>
    <section class="flex flex-col items-center text-center w-full overflow-clip ">
        <section id="title" class="text-3xl font-light h-[80vh] w-full uppercase flex flex-col justify-center items-center relative">
            <div class=" w-fit bg-white/90 z-10 ">
                <h1 class="font-giaza font-black text-6xl sm:text-8xl mb-4 z-1 my-fadeOutText">HJJC. Store</h1>
                <h1 class=" font-light text-3xl sm:text-4xl my-fadeOutText z-1">Your one-stop shop for <span class="font-bold underline italic">everything</span> you need!</h1>
                <h1 class="font-extralight text-xl sm:text-2xl my-fadeOutText z-1">Scroll down to discover who we are and why customers love us.</h1>
            </div>
            <img src="./image/circle.png" alt="circle" class="sm:size-150 absolute -left-50 -bottom-40 z-0 my-circle size-100" />
            <img src="./image/circle.png" alt="circle" class="sm:size-250 sm:-right-95 sm:-top-95 size-110 absolute -top-45 -right-50 my-circle z-0 " />
        </section>
        <section class="flex flex-col min-h-screen w-full justify-center items-center  z-10">
            <div class="bg-white/90">
                <h1 class="text-2xl sm:text-5xl font-bold my-fadeInText m-6 uppercase ">Why Shop With Us?</h1>
                <div class="flex gap-4 sm:gap-8  justify-center items-center max-sm:flex-col">
                    <div class="card bg-base-100 sm:w-96 w-75 shadow-sm my-fadeInMoveUpCard">
                        <figure>
                            <img
                                class="w-35 sm:w-50"
                                src="./image/delivery-truck.gif"
                                alt="Shoes" />
                        </figure>
                        <div class="card-body max-sm:p-2">
                            <h2 class="card-title ">Shop Smart. Shop Authentic.</h2>
                        </div>
                    </div>
                    <div class="card bg-base-100 sm:w-96 w-75 shadow-sm my-fadeInMoveUpCard">
                        <figure>
                            <img
                                class="w-35 sm:w-50"
                                src="./image/trust.gif"
                                alt="Shoes" />
                        </figure>
                        <div class="card-body max-sm:p-2">
                            <h2 class="card-title">Trusted by Thousands, Chosen by You.</h2>
                        </div>
                    </div>
                    <div class="card bg-base-100 sm:w-96 w-75 shadow-sm my-fadeInMoveUpCard">
                        <figure>
                            <img
                                class="w-35 sm:w-50"
                                src="./image/certificate.gif"
                                alt="Shoes" />
                        </figure>
                        <div class="card-body max-sm:p-2">
                            <h2 class="card-title">Real Products. Real Value. Real Trust.</h2>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="relative w-full overflow-clip flex ">
            <img src="./image/shop-now.png" alt="circle" class="w-1/2 max-sm:w-full my-moveIn" />
            <img src="./image/shop-now.png" alt="circle" class="w-1/2 max-sm:w-full my-moveIn" />
            <img src="./image/shop-now.png" alt="circle" class="w-1/2 max-sm:w-full my-moveIn" />
            <img src="./image/shop-now.png" alt="circle" class="w-1/2 max-sm:w-full my-moveIn" />
            <img src="./image/shop-now.png" alt="circle" class="w-1/2 max-sm:w-full my-moveIn" />
            <img src="./image/shop-now.png" alt="circle" class="w-1/2 max-sm:w-full my-moveIn" />
            <img src="./image/shop-now.png" alt="circle" class="w-1/2 max-sm:w-full my-moveIn" />
        </section>
        <section class="my-50 relative max-sm:hidden">
            <h1 class="text-2xl sm:text-4xl font-bold m-6 uppercase my-fadeInText my-popUp z-5">Find it all here.<br>Explore our wide range of products built for you.</h1>
            <div class="grid grid-cols-[auto_auto] grid-rows-2 gap-4 place-content-center z-1 max-sm:hidden max-sm:grid-cols-[auto] max-sm:grid-rows-auto">
                <a href="#" class="h-152 w-85 row-span-2 rounded-2xl hover:shadow-2xl transition-shadow duration-300">
                    <div class="border rounded-2xl h-152 w-85 bg-[url(../image/gpu.png)] bg-cover my-fadeInMoveUpCard z-2"></div>
                </a>
                <a href="#" class=" h-73 w-150 rounded-2xl hover:shadow-2xl transition-shadow duration-300 z-2">
                    <div class="border rounded-2xl h-73 w-150 bg-[url(../image/shoes.png)] bg-contain my-fadeInMoveUpCard "></div>
                </a>
                <a href="#" class=" h-73 w-150 rounded-2xl hover:shadow-2xl transition-shadow duration-300 z-2">
                    <div class="border rounded-2xl h-73 w-150 bg-[url(../image/laptop.png)] bg-contain my-fadeInMoveUpCard "></div>
                </a>
                <a href="./home.php" class=" col-span-2">
                    <button class="btn btn-xl rounded-full">Shop Now</button>
                </a>
                <img src="./image/circle.png" alt="circle" class="size-300 absolute -bottom-170 -right-200 my-circleInfinite z-1 object-cover" />
                <img src="./image/circle-shop.png" alt="circle" class="size-200 absolute -bottom-130 -right-180 my-circleInfinite z-1 object-cover" />
            </div>
        </section>
        <section class="my-50 relative sm:hidden">
            <h1 class="text-2xl sm:text-4xl font-bold m-6 uppercase my-fadeInText my-popUp z-5 max-sm:hidden">Find it all here. Explore our wide range of products built for you.</h1>
            <h1 class="text-2xl sm:text-4xl font-bold m-6 uppercase my-fadeInText my-popUp z-5 sm:hidden">Explore our wide range of products built for you.</h1>
            <div class=" grid grid-cols-1 gap-4 place-content-center z-0 overflow-clip">
                <!-- Product Cards -->
                <a href="#" class="size-auto rounded-2xl hover:shadow-2xl transition-shadow duration-300 z-10 flex items-center justify-center">
                    <div class="border rounded-2xl h-48 w-96 bg-[url(../image/gpu.png)] bg-contain my-fadeInMoveUpCard"></div>
                </a>
                <a href="#" class="size-auto rounded-2xl hover:shadow-2xl transition-shadow duration-300 z-10 flex items-center justify-center">
                    <div class="border rounded-2xl h-48 w-96 bg-[url(../image/shoes.png)] bg-contain my-fadeInMoveUpCard"></div>
                </a>
                <a href="#" class="size-auto rounded-2xl hover:shadow-2xl transition-shadow duration-300 z-10 flex items-center justify-center">
                    <div class="border rounded-2xl h-48 w-96 bg-[url(../image/laptop.png)] bg-contain my-fadeInMoveUpCard"></div>
                </a>
                <a href="./home.php" class=" z-10">
                    <button class="btn btn-xl rounded-full">Shop Now</button>
                </a>
                <img src="./image/circle.png" alt="circle" class="size-130 absolute -bottom-100 -right-30 my-circleInfinite z-1 object-cover" />
                <img src="./image/circle-shop.png" alt="circle" class="size-80 absolute -bottom-80 -right-20 my-circleInfinite z-1 object-cover" />
            </div>
        </section>
        <section class="my-fadeInFooter z-10">
            <?php include './components/footer.html'; ?>
        </section>
    </section>
</body>

</html>