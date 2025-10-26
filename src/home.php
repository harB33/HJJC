<!DOCTYPE html>
<html lang="en" data-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body class="w-screen overflow-x-hidden">
    <div class="sticky top-0 z-50 ">
        <?php include './components/header.html'; ?>
    </div>

    <section class="flex flex-col items-center w-full min-h-screen">
        <section class="flex flex-col justify-center items-center w-3/4">
            <h1 class=" text-3xl font-black">CATEGORIES</h1>
            <div class="grid grid-cols-6 place-items-center w-fit gap-4">
                <a href="#" class="size-50 border">Electronics & Gadgets</a>
                <a href="#" class="size-50 border">Fashion & Apparel</a>
                <a href="#" class="size-50 border">Home & Living</a>
                <a href="#" class="size-50 border">Beauty & Personal Care</a>
                <a href="#" class="size-50 border">Health & Wellness</a>
                <a href="#" class="size-50 border">Baby & Kids</a>
                <a href="#" class="size-50 border">Pet Supplies</a>
                <a href="#" class="size-50 border">Sports & Outdoors</a>
                <a href="#" class="size-50 border">Automotive & Tools</a>
                <a href="#" class="size-50 border">Art & Stationery</a>
                <a href="#" class="size-50 border">Books & Education</a>
                <a href="#" class="size-50 border">Food & Beverages</a>
            </div>
        </section>
    </section>

    <section class="my-fadeInFooter z-10">
            <?php include './components/footer.html'; ?>
    </section>
</body>
</html>