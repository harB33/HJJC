<!DOCTYPE html>
<html lang="en" data-theme="light">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="./image/logo.ico" type="image/x-icon">
    <link
        href="https://cdn.jsdelivr.net/npm/daisyui@5"
        rel="stylesheet"
        type="text/css" />
    <title>HJJC. STORE|Home</title>
</head>

<body class="w-screen overflow-x-hidden">
    <div class="sticky top-0 z-50 ">
        <?php include './components/header.php'; ?>
    </div>

    <section class="flex flex-col items-center w-full min-h-screen">
        <section class="mb-24">
            <div class="carousel w-full">
                <div id="slide1" class="carousel-item relative w-full">
                    <img
                        src="https://img.daisyui.com/images/stock/photo-1625726411847-8cbb60cc71e6.webp"
                        class="w-full" />
                    <div class="absolute left-5 right-5 top-1/2 flex -translate-y-1/2 transform justify-between">
                        <a href="#slide4" class="btn btn-circle">❮</a>
                        <a href="#slide2" class="btn btn-circle">❯</a>
                    </div>
                </div>
                <div id="slide2" class="carousel-item relative w-full">
                    <img
                        src="https://img.daisyui.com/images/stock/photo-1609621838510-5ad474b7d25d.webp"
                        class="w-full" />
                    <div class="absolute left-5 right-5 top-1/2 flex -translate-y-1/2 transform justify-between">
                        <a href="#slide1" class="btn btn-circle">❮</a>
                        <a href="#slide3" class="btn btn-circle">❯</a>
                    </div>
                </div>
                <div id="slide3" class="carousel-item relative w-full">
                    <img
                        src="https://img.daisyui.com/images/stock/photo-1414694762283-acccc27bca85.webp"
                        class="w-full" />
                    <div class="absolute left-5 right-5 top-1/2 flex -translate-y-1/2 transform justify-between">
                        <a href="#slide2" class="btn btn-circle">❮</a>
                        <a href="#slide4" class="btn btn-circle">❯</a>
                    </div>
                </div>
                <div id="slide4" class="carousel-item relative w-full">
                    <img
                        src="https://img.daisyui.com/images/stock/photo-1665553365602-b2fb8e5d1707.webp"
                        class="w-full" />
                    <div class="absolute left-5 right-5 top-1/2 flex -translate-y-1/2 transform justify-between">
                        <a href="#slide3" class="btn btn-circle">❮</a>
                        <a href="#slide1" class="btn btn-circle">❯</a>
                    </div>
                </div>
            </div>
        </section>
        <section class="flex flex-col justify-center items-center w-3/4 mb-24">
            <h1 class=" text-3xl font-black m-4">CATEGORIES</h1>
            <div class="grid grid-cols-6 place-items-center w-fit gap-4">
                <a href="#" class="size-45 border">Electronics & Gadgets</a>
                <a href="#" class="size-45 border">Fashion & Apparel</a>
                <a href="#" class="size-45 border">Home & Living</a>
                <a href="#" class="size-45 border">Beauty & Personal Care</a>
                <a href="#" class="size-45 border">Health & Wellness</a>
                <a href="#" class="size-45 border">Baby & Kids</a>
                <a href="#" class="size-45 border">Pet Supplies</a>
                <a href="#" class="size-45 border">Sports & Outdoors</a>
                <a href="#" class="size-45 border">Automotive & Tools</a>
                <a href="#" class="size-45 border">Art & Stationery</a>
                <a href="#" class="size-45 border">Books & Education</a>
                <a href="#" class="size-45 border">Food & Beverages</a>
            </div>
        </section>
        <section class="flex flex-col justify-center items-center w-3/4 mb-24">
            <h1 class=" text-3xl font-black m-4 my-fadeInCard">Just For You</h1>
            <div class="grid grid-cols-6 place-items-center w-fit gap-4">
                <a href="#" class="size-50 border my-fadeInCard">Electronics & Gadgets</a>
                <a href="#" class="size-50 border my-fadeInCard">Fashion & Apparel</a>
                <a href="#" class="size-50 border my-fadeInCard">Home & Living</a>
                <a href="#" class="size-50 border my-fadeInCard">Beauty & Personal Care</a>
                <a href="#" class="size-50 border my-fadeInCard">Health & Wellness</a>
                <a href="#" class="size-50 border my-fadeInCard">Baby & Kids</a>
                <a href="#" class="size-50 border my-fadeInCard">Pet Supplies</a>
                <a href="#" class="size-50 border my-fadeInCard">Sports & Outdoors</a>
                <a href="#" class="size-50 border my-fadeInCard">Automotive & Tools</a>
                <a href="#" class="size-50 border my-fadeInCard">Art & Stationery</a>
                <a href="#" class="size-50 border my-fadeInCard">Books & Education</a>
                <a href="#" class="size-50 border my-fadeInCard">Food & Beverages</a>
                <a href="#" class="size-50 border my-fadeInCard">Pet Supplies</a>
                <a href="#" class="size-50 border my-fadeInCard">Sports & Outdoors</a>
                <a href="#" class="size-50 border my-fadeInCard">Automotive & Tools</a>
                <a href="#" class="size-50 border my-fadeInCard">Art & Stationery</a>
                <a href="#" class="size-50 border my-fadeInCard">Books & Education</a>
                <a href="#" class="size-50 border my-fadeInCard">Food & Beverages</a>
            </div>
        </section>
    </section>

    <section class="my-fadeInFooter z-10">
        <?php include './components/footer.html'; ?>
    </section>
</body>

</html>