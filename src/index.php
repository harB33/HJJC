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
            <div class=" w-full flex flex-col items-center justify-center z-10 mb-8 grow">
                <h1 class="font-giaza font-black text-2xl z-1 text-custom-accent  text-shadow-lg">Define Your Standard.</h1>
                <h1 class=" font-light text-md text-custom-background/90  text-shadow-lg">Relentless perfection. We transform the world's finest ingredients into exquisite beverages that redefine your standard.</h1>
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
        <section class="flex flex-col h-[90dvh] px-6 w-full pt-20 bg-custom-secondary items-center  z-10">
            <div class="flex flex-col items-center my-moveDown">
                <h1 class="font-giaza font-black text-2xl mb-6">The <span class="">Standard</span> Has Arrived.</h1>
                <p class=" font-light text-md mb-2">HJJC is proud to introduce an unparalleled coffee experience to the Philippines. We are defined by a relentless pursuit of perfection. Our baristas transform the world's finest ingredients into exquisite beverages that stimulate the senses and redefine your expectations.</p>
                <p class=" font-light text-md">Discover the new pinnacle of taste.</p>
            </div>
            <div class="my-popUp z-20">
                <div class="animate-bounce text-custom-accent -rotate-10 translate-y-40 -translate-x-20 text-xl font-black  bg-black/80 p-1.5 rounded-2xl">Caramel Machiato!</div>
            </div>
            <img src="./image/design.png" alt="" class=" my-moveTop">
        </section>
        <section class="flex flex-col h-[80vh] px-6 w-full justify-center bg-custom-secondary/20 items-center  z-10">
            <div class="flex flex-col w-full justify-evenly h-full items-center ">
                <div>
                    <h1 class="font-giaza font-black text-2xl mb-6">A Brew to Define Your Day.</h1>
                    <p class=" font-light text-md">Fuel your pursuit of perfection. From robust classics to nuanced single-origins, our menu offers an exquisite beverage to satisfy your distinct taste.</p>
                </div>

        </section>
        <section class="my-fadeInFooter z-10">
            <?php include './components/footer.html'; ?>
        </section>
    </section>
</body>

</html>