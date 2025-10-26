<!DOCTYPE html>
<html lang="en" data-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link
        href="https://cdn.jsdelivr.net/npm/daisyui@5"
        rel="stylesheet"
        type="text/css"
    />
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link rel="stylesheet" href="./style/output.css" />
</head>
<body class="w-screen overflow-x-hidden">
    <div class="sticky top-0 z-50 ">
        <?php include './components/header.html'; ?>
    </div>
    <section class="flex flex-col items-center text-center w-full overflow-clip">
        <section id="title" class="text-3xl font-light h-[80vh] w-full uppercase flex flex-col justify-center items-center my-fadeOutText">
            <h1 class="font-giaza font-black text-8xl mb-4">HJJC. Store</h1>
            <h1 class=" font-light text-4xl">Your one-stop shop for <span class="font-bold underline italic">everything</span> you need!</h1>
            <h1 class="font-extralight text-2xl">Scroll down to discover who we are and why customers love us.</h1>
        </section>
        <section class="flex flex-col h-screen w-screen justify-center items-center">
            <h1 class=" text-5xl font-bold my-fadeInText m-6 uppercase">Why Shop With Us?</h1>
            <div class="flex gap-8  justify-center items-center">
                <div class="card bg-base-100 w-96 shadow-sm my-fadeInCard">
                    <figure>
                        <img
                        src="https://img.daisyui.com/images/stock/photo-1606107557195-0e29a4b5b4aa.webp"
                        alt="Shoes" />
                    </figure>
                    <div class="card-body">
                        <h2 class="card-title">Shop Smart. Shop Authentic.</h2>
                    </div>
                </div>
                <div class="card bg-base-100 w-96 shadow-sm my-fadeInCard">
                    <figure>
                        <img
                        src="https://img.daisyui.com/images/stock/photo-1606107557195-0e29a4b5b4aa.webp"
                        alt="Shoes" />
                    </figure>
                    <div class="card-body">
                        <h2 class="card-title">Trusted by Thousands, Chosen by You.</h2>
                    </div>
                </div>
                <div class="card bg-base-100 w-96 shadow-sm my-fadeInCard">
                    <figure>
                        <img
                        src="https://img.daisyui.com/images/stock/photo-1606107557195-0e29a4b5b4aa.webp"
                        alt="Shoes" />
                    </figure>
                    <div class="card-body">
                        <h2 class="card-title">Real Products. Real Value. Real Trust.</h2>
                    </div>
                </div>
            </div>
        </section>
        <section class="relative w-full overflow-clip flex ">
            <img src="./image/shop-now.png" alt="circle" class="w-1/2 my-moveIn"/>
            <img src="./image/shop-now.png" alt="circle" class="w-1/2 my-moveIn"/>
            <img src="./image/shop-now.png" alt="circle" class="w-1/2 my-moveIn"/>
            <img src="./image/shop-now.png" alt="circle" class="w-1/2 my-moveIn"/>
            <img src="./image/shop-now.png" alt="circle" class="w-1/2 my-moveIn"/>
            <img src="./image/shop-now.png" alt="circle" class="w-1/2 my-moveIn"/>
            <img src="./image/shop-now.png" alt="circle" class="w-1/2 my-moveIn"/>
        </section>
        <section class="my-50 relative">
            <h1 class="text-4xl font-bold m-6 uppercase my-fadeInText my-popUp z-5">Find it all here. Explore our wide range of products built for you.</h1>
            <div class="grid grid-cols-[auto_auto] grid-rows-2 gap-4 place-content-center z-1">
                <a href="#" class="h-152 w-85 row-span-2 rounded-2xl hover:shadow-2xl transition-shadow duration-300">
                    <div class="border rounded-2xl h-152 w-85 bg-[url(../image/gpu.png)] bg-cover my-fadeInCard z-2"></div>
                </a>
                <a href="#" class=" h-73 w-150  rounded-2xl hover:shadow-2xl transition-shadow duration-300 z-2">
                    <div class="border rounded-2xl h-73 w-150 bg-[url(../image/shoes.png)] bg-contain my-fadeInCard "></div>
                </a>
                <a href="#" class=" h-73 w-150  rounded-2xl hover:shadow-2xl transition-shadow duration-300 z-2">
                    <div class="border rounded-2xl h-73 w-150 bg-[url(../image/laptop.png)] bg-contain my-fadeInCard "></div>
                </a>
                <a href="./home.php" class=" col-span-2"><button class="btn btn-xl rounded-full">Shop Now</button></a>
                <img src="./image/circle.png" alt="circle" class="size-300 absolute -bottom-170 -right-150 my-circleInfinite z-1 "/>
                <img src="./image/circle-shop.png" alt="circle" class="size-150 absolute -bottom-100 -right-80 my-circleInfinite z-1 "/>
            </div>
        </section>
        <section class="my-fadeInFooter z-10">
            <?php include './components/footer.html'; ?>
        </section>
        <img src="./image/circle.png" alt="circle" class="size-150 absolute -left-50 -bottom-40 z-0 my-circle"/>
        <img src="./image/circle.png" alt="circle" class="size-250 absolute -top-95 -right-95 my-circle z-0 "/>
    </section>
</body>
</html>