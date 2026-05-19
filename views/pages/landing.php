<?php require_once __DIR__ . '/../../config/config.php'; ?>
<!DOCTYPE html>
<html lang="en" data-theme="light" class=" overflow-x-clip">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="<?php echo ASSET_URL; ?>/images/logo.ico" type="image/x-icon">
    <title>HJJC. STORE|About Us</title>
    <link
        href="https://cdn.jsdelivr.net/npm/daisyui@5"
        rel="stylesheet"
        type="text/css" />
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link rel="stylesheet" href="<?php echo ASSET_URL; ?>/css/output.css" />
    <script src="<?php echo ASSET_URL; ?>/js/accountLogo.js" defer></script>
</head>

<body class="w-screen overflow-x-clip min-h-screen">
    <?php include VIEW_PATH . '/components/header.php'; ?>
    <section class="grid grid-cols-12 size-screen relative overflow-hidden">
        <section class="absolute inset-0 w-screen h-screen z-0 ">
            <video class="w-full h-full object-cover brightness-40" autoplay loop muted>
                <source src="<?php echo ASSET_URL; ?>/images/1107.mp4">
            </video>
        </section>
        <section id="title" class="col-start-1 col-end-13 px-16 h-screen w-1/2 flex flex-col justify-center gap-8 z-20 select-none">
            <h1 class="text-custom-accent font-giaza font-black text-9xl leading-[100%]">Define<br>Your<br>Standard.</h1>
            <h1 class="text-zinc-300 font-bold font-urbanist text-4xl">Relentless perfection. We transform the world's finest ingredients into exquisite beverages that redefine your standard.</h1>
            <button class="btn bg-custom-accent border-custom-accent hover:border-white/50 hover:duration-700 duration-700 shadow-custom-accent shadow-none hover:shadow-md  rounded-full text-2xl h-16 px-10 font-giaza inline-flex items-center justify-center leading-none w-max italic"><span class="-mt-2">Order Now</span><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-coffee-icon lucide-coffee translate-x-4">
                    <path d="M10 2v2" />
                    <path d="M14 2v2" />
                    <path d="M16 8a1 1 0 0 1 1 1v8a4 4 0 0 1-4 4H7a4 4 0 0 1-4-4V9a1 1 0 0 1 1-1h14a4 4 0 1 1 0 8h-1" />
                    <path d="M6 2v2" />
                </svg></button>
        </section>
        <section class="col-start-1 col-end-13 px-16 h-auto py-32 w-full flex flex-col justify-center gap-16 z-20 select-none">
            <div class="flex flex-col gap-8">
                <div class="flex flex-col gap-8">
                    <h1 class="font-giaza font-black max-lg:text-2xl lg:text-5xl ">The <span class="">Standard</span> Has Arrived.</h1>
                    <p class=" font-light text-md lg:text-2xl">HJJC is proud to introduce an unparalleled coffee experience to the Philippines. We are defined by a relentless pursuit of perfection.<br>Our baristas transform the world's finest ingredients into exquisite beverages that stimulate the senses and redefine your expectations.</p>
                    <p class=" font-light text-md lg:text-2xl -mt-10">Explore the new <span class="font-giaza  font-black italic text-3xl text-custom-accent">Pinnacle of Taste.</span></p>
                </div>
                <h1 class="font-giaza font-black max-lg:text-2xl lg:text-5xl flex justify-between items-center mt-8"><span>Our Menu</span><a href="/" class="flex items-center font-poppins font-light text-2xl gap-2 translate-y-2">See More<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-arrow-right-icon lucide-arrow-right">
                            <path d="M5 12h14" />
                            <path d="m12 5 7 7-7 7" />
                        </svg></a></h1>
                <div class="w-full grid grid-cols-5 gap-8">
                    <div class=" w-full flex flex-col items-center gap-2"><img src="" alt="" class="w-full h-auto aspect-square border rounded-2xl">
                        <p class="text-2xl italic">Coffee</p>
                    </div>
                    <div class=" w-full flex flex-col items-center gap-2"><img src="" alt="" class="w-full h-auto aspect-square border rounded-2xl">
                        <p class="text-2xl italic">Milk Tea</p>
                    </div>
                    <div class=" w-full flex flex-col items-center gap-2"><img src="" alt="" class="w-full h-auto aspect-square border rounded-2xl">
                        <p class="text-2xl italic">Frappe</p>
                    </div>
                    <div class=" w-full flex flex-col items-center gap-2"><img src="" alt="" class="w-full h-auto aspect-square border rounded-2xl">
                        <p class="text-2xl italic">Shake</p>
                    </div>
                    <div class=" w-full flex flex-col items-center gap-2"><img src="" alt="" class="w-full h-auto aspect-square border rounded-2xl">
                        <p class="text-2xl italic">Pastries</p>
                    </div>
                </div>
            </div>
            <div class="flex flex-col gap-8">
                <h1 class="font-giaza font-black max-lg:text-2xl lg:text-5xl flex justify-between items-center"><span>Everyone's Favorite</span><a href="/" class="flex items-center font-poppins font-light text-2xl gap-2 translate-y-2">See More<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-arrow-right-icon lucide-arrow-right">
                            <path d="M5 12h14" />
                            <path d="m12 5 7 7-7 7" />
                        </svg></a></h1>
                <div class="w-full grid grid-cols-3 gap-8">
                    <div class=" w-full flex flex-col items-center gap-2"><img src="" alt="" class="w-full h-auto aspect-square border rounded-2xl">
                        <p class="text-2xl italic">Caramel Machiato</p>
                    </div>
                    <div class=" w-full flex flex-col items-center gap-2"><img src="" alt="" class="w-full h-auto aspect-square border rounded-2xl">
                        <p class="text-2xl italic">Matcha</p>
                    </div>
                    <div class=" w-full flex flex-col items-center gap-2"><img src="" alt="" class="w-full h-auto aspect-square border rounded-2xl">
                        <p class="text-2xl italic">Random</p>
                    </div>
                </div>
            </div>
            <!-- <div class="my-popUp z-20 lg:hidden">
                <div class="animate-bounce text-custom-accent -rotate-10 translate-y-40 -translate-x-20 text-xl font-black  bg-black/80 p-1.5 rounded-2xl">Caramel Machiato!</div>
            </div>
            <img src="<?php echo ASSET_URL; ?>/images/design.png" alt="" class=" my-moveTop lg:hidden"> -->
        </section>
        <section class=" col-span-full grid grid-cols-12 w-screen py-32 bg-custom-primary">
            <div class=" col-start-1 col-end-13 px-16 flex flex-col gap-32">
                <h1 class="divider text-white font-giaza font-black text-5xl leading-[100%]"><span class="-mt-4">People's Comments</span></h1>
                <div class="w-full grid grid-cols-3 gap-8">
                    <div class="w-full h-auto aspect-video border rounded-2xl relative">
                        <div class="w-full p-4 flex items-center gap-4">
                            <img src="" alt="" class=" aspect-square size-16 rounded-full border">
                            <h1 class="text-2xl italic font-giaza font-black">harbe</h1>
                        </div>
                        <div class="divider -my-2 px-8"></div>
                        <div class="p-4 text-center">
                            <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Accusantium quae minus veniam incidunt, voluptatibus eveniet doloribus minima, repellendus voluptates commodi quibusdam aliquam nisi deserunt illo nulla at id. Velit, omnis.</p>
                        </div>
                        <div class="absolute right-[calc(0%+16px)] top-[calc(0%-34px)] flex">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-star-icon lucide-star size-16 fill-yellow-300">
                                <path d="M11.525 2.295a.53.53 0 0 1 .95 0l2.31 4.679a2.123 2.123 0 0 0 1.595 1.16l5.166.756a.53.53 0 0 1 .294.904l-3.736 3.638a2.123 2.123 0 0 0-.611 1.878l.882 5.14a.53.53 0 0 1-.771.56l-4.618-2.428a2.122 2.122 0 0 0-1.973 0L6.396 21.01a.53.53 0 0 1-.77-.56l.881-5.139a2.122 2.122 0 0 0-.611-1.879L2.16 9.795a.53.53 0 0 1 .294-.906l5.165-.755a2.122 2.122 0 0 0 1.597-1.16z" />
                            </svg>
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-star-icon lucide-star size-16 fill-yellow-300">
                                <path d="M11.525 2.295a.53.53 0 0 1 .95 0l2.31 4.679a2.123 2.123 0 0 0 1.595 1.16l5.166.756a.53.53 0 0 1 .294.904l-3.736 3.638a2.123 2.123 0 0 0-.611 1.878l.882 5.14a.53.53 0 0 1-.771.56l-4.618-2.428a2.122 2.122 0 0 0-1.973 0L6.396 21.01a.53.53 0 0 1-.77-.56l.881-5.139a2.122 2.122 0 0 0-.611-1.879L2.16 9.795a.53.53 0 0 1 .294-.906l5.165-.755a2.122 2.122 0 0 0 1.597-1.16z" />
                            </svg>
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-star-icon lucide-star size-16 fill-yellow-300">
                                <path d="M11.525 2.295a.53.53 0 0 1 .95 0l2.31 4.679a2.123 2.123 0 0 0 1.595 1.16l5.166.756a.53.53 0 0 1 .294.904l-3.736 3.638a2.123 2.123 0 0 0-.611 1.878l.882 5.14a.53.53 0 0 1-.771.56l-4.618-2.428a2.122 2.122 0 0 0-1.973 0L6.396 21.01a.53.53 0 0 1-.77-.56l.881-5.139a2.122 2.122 0 0 0-.611-1.879L2.16 9.795a.53.53 0 0 1 .294-.906l5.165-.755a2.122 2.122 0 0 0 1.597-1.16z" />
                            </svg>
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-star-icon lucide-star size-16 fill-yellow-300">
                                <path d="M11.525 2.295a.53.53 0 0 1 .95 0l2.31 4.679a2.123 2.123 0 0 0 1.595 1.16l5.166.756a.53.53 0 0 1 .294.904l-3.736 3.638a2.123 2.123 0 0 0-.611 1.878l.882 5.14a.53.53 0 0 1-.771.56l-4.618-2.428a2.122 2.122 0 0 0-1.973 0L6.396 21.01a.53.53 0 0 1-.77-.56l.881-5.139a2.122 2.122 0 0 0-.611-1.879L2.16 9.795a.53.53 0 0 1 .294-.906l5.165-.755a2.122 2.122 0 0 0 1.597-1.16z" />
                            </svg>
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-star-icon lucide-star size-16 fill-yellow-300">
                                <path d="M11.525 2.295a.53.53 0 0 1 .95 0l2.31 4.679a2.123 2.123 0 0 0 1.595 1.16l5.166.756a.53.53 0 0 1 .294.904l-3.736 3.638a2.123 2.123 0 0 0-.611 1.878l.882 5.14a.53.53 0 0 1-.771.56l-4.618-2.428a2.122 2.122 0 0 0-1.973 0L6.396 21.01a.53.53 0 0 1-.77-.56l.881-5.139a2.122 2.122 0 0 0-.611-1.879L2.16 9.795a.53.53 0 0 1 .294-.906l5.165-.755a2.122 2.122 0 0 0 1.597-1.16z" />
                            </svg>
                        </div>
                    </div>
                    <div class="w-full h-auto aspect-video border rounded-2xl relative">
                        <div class="w-full p-4 flex items-center gap-4">
                            <img src="" alt="" class=" aspect-square size-16 rounded-full border">
                            <h1 class="text-2xl italic font-giaza font-black">harbe</h1>
                        </div>
                        <div class="divider -my-2 px-8"></div>
                        <div class="p-4 text-center">
                            <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Accusantium quae minus veniam incidunt, voluptatibus eveniet doloribus minima, repellendus voluptates commodi quibusdam aliquam nisi deserunt illo nulla at id. Velit, omnis.</p>
                        </div>
                        <div class="absolute right-[calc(0%+16px)] top-[calc(0%-34px)] flex">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-star-icon lucide-star size-16 fill-yellow-300">
                                <path d="M11.525 2.295a.53.53 0 0 1 .95 0l2.31 4.679a2.123 2.123 0 0 0 1.595 1.16l5.166.756a.53.53 0 0 1 .294.904l-3.736 3.638a2.123 2.123 0 0 0-.611 1.878l.882 5.14a.53.53 0 0 1-.771.56l-4.618-2.428a2.122 2.122 0 0 0-1.973 0L6.396 21.01a.53.53 0 0 1-.77-.56l.881-5.139a2.122 2.122 0 0 0-.611-1.879L2.16 9.795a.53.53 0 0 1 .294-.906l5.165-.755a2.122 2.122 0 0 0 1.597-1.16z" />
                            </svg>
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-star-icon lucide-star size-16 fill-yellow-300">
                                <path d="M11.525 2.295a.53.53 0 0 1 .95 0l2.31 4.679a2.123 2.123 0 0 0 1.595 1.16l5.166.756a.53.53 0 0 1 .294.904l-3.736 3.638a2.123 2.123 0 0 0-.611 1.878l.882 5.14a.53.53 0 0 1-.771.56l-4.618-2.428a2.122 2.122 0 0 0-1.973 0L6.396 21.01a.53.53 0 0 1-.77-.56l.881-5.139a2.122 2.122 0 0 0-.611-1.879L2.16 9.795a.53.53 0 0 1 .294-.906l5.165-.755a2.122 2.122 0 0 0 1.597-1.16z" />
                            </svg>
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-star-icon lucide-star size-16 fill-yellow-300">
                                <path d="M11.525 2.295a.53.53 0 0 1 .95 0l2.31 4.679a2.123 2.123 0 0 0 1.595 1.16l5.166.756a.53.53 0 0 1 .294.904l-3.736 3.638a2.123 2.123 0 0 0-.611 1.878l.882 5.14a.53.53 0 0 1-.771.56l-4.618-2.428a2.122 2.122 0 0 0-1.973 0L6.396 21.01a.53.53 0 0 1-.77-.56l.881-5.139a2.122 2.122 0 0 0-.611-1.879L2.16 9.795a.53.53 0 0 1 .294-.906l5.165-.755a2.122 2.122 0 0 0 1.597-1.16z" />
                            </svg>
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-star-icon lucide-star size-16 fill-yellow-300">
                                <path d="M11.525 2.295a.53.53 0 0 1 .95 0l2.31 4.679a2.123 2.123 0 0 0 1.595 1.16l5.166.756a.53.53 0 0 1 .294.904l-3.736 3.638a2.123 2.123 0 0 0-.611 1.878l.882 5.14a.53.53 0 0 1-.771.56l-4.618-2.428a2.122 2.122 0 0 0-1.973 0L6.396 21.01a.53.53 0 0 1-.77-.56l.881-5.139a2.122 2.122 0 0 0-.611-1.879L2.16 9.795a.53.53 0 0 1 .294-.906l5.165-.755a2.122 2.122 0 0 0 1.597-1.16z" />
                            </svg>
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-star-icon lucide-star size-16 fill-yellow-300">
                                <path d="M11.525 2.295a.53.53 0 0 1 .95 0l2.31 4.679a2.123 2.123 0 0 0 1.595 1.16l5.166.756a.53.53 0 0 1 .294.904l-3.736 3.638a2.123 2.123 0 0 0-.611 1.878l.882 5.14a.53.53 0 0 1-.771.56l-4.618-2.428a2.122 2.122 0 0 0-1.973 0L6.396 21.01a.53.53 0 0 1-.77-.56l.881-5.139a2.122 2.122 0 0 0-.611-1.879L2.16 9.795a.53.53 0 0 1 .294-.906l5.165-.755a2.122 2.122 0 0 0 1.597-1.16z" />
                            </svg>
                        </div>
                    </div>
                    <div class="w-full h-auto aspect-video border rounded-2xl relative">
                        <div class="w-full p-4 flex items-center gap-4">
                            <img src="" alt="" class=" aspect-square size-16 rounded-full border">
                            <h1 class="text-2xl italic font-giaza font-black">harbe</h1>
                        </div>
                        <div class="divider -my-2 px-8"></div>
                        <div class="p-4 text-center">
                            <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Accusantium quae minus veniam incidunt, voluptatibus eveniet doloribus minima, repellendus voluptates commodi quibusdam aliquam nisi deserunt illo nulla at id. Velit, omnis.</p>
                        </div>
                        <div class="absolute right-[calc(0%+16px)] top-[calc(0%-34px)] flex">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-star-icon lucide-star size-16 fill-yellow-300">
                                <path d="M11.525 2.295a.53.53 0 0 1 .95 0l2.31 4.679a2.123 2.123 0 0 0 1.595 1.16l5.166.756a.53.53 0 0 1 .294.904l-3.736 3.638a2.123 2.123 0 0 0-.611 1.878l.882 5.14a.53.53 0 0 1-.771.56l-4.618-2.428a2.122 2.122 0 0 0-1.973 0L6.396 21.01a.53.53 0 0 1-.77-.56l.881-5.139a2.122 2.122 0 0 0-.611-1.879L2.16 9.795a.53.53 0 0 1 .294-.906l5.165-.755a2.122 2.122 0 0 0 1.597-1.16z" />
                            </svg>
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-star-icon lucide-star size-16 fill-yellow-300">
                                <path d="M11.525 2.295a.53.53 0 0 1 .95 0l2.31 4.679a2.123 2.123 0 0 0 1.595 1.16l5.166.756a.53.53 0 0 1 .294.904l-3.736 3.638a2.123 2.123 0 0 0-.611 1.878l.882 5.14a.53.53 0 0 1-.771.56l-4.618-2.428a2.122 2.122 0 0 0-1.973 0L6.396 21.01a.53.53 0 0 1-.77-.56l.881-5.139a2.122 2.122 0 0 0-.611-1.879L2.16 9.795a.53.53 0 0 1 .294-.906l5.165-.755a2.122 2.122 0 0 0 1.597-1.16z" />
                            </svg>
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-star-icon lucide-star size-16 fill-yellow-300">
                                <path d="M11.525 2.295a.53.53 0 0 1 .95 0l2.31 4.679a2.123 2.123 0 0 0 1.595 1.16l5.166.756a.53.53 0 0 1 .294.904l-3.736 3.638a2.123 2.123 0 0 0-.611 1.878l.882 5.14a.53.53 0 0 1-.771.56l-4.618-2.428a2.122 2.122 0 0 0-1.973 0L6.396 21.01a.53.53 0 0 1-.77-.56l.881-5.139a2.122 2.122 0 0 0-.611-1.879L2.16 9.795a.53.53 0 0 1 .294-.906l5.165-.755a2.122 2.122 0 0 0 1.597-1.16z" />
                            </svg>
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-star-icon lucide-star size-16 fill-yellow-300">
                                <path d="M11.525 2.295a.53.53 0 0 1 .95 0l2.31 4.679a2.123 2.123 0 0 0 1.595 1.16l5.166.756a.53.53 0 0 1 .294.904l-3.736 3.638a2.123 2.123 0 0 0-.611 1.878l.882 5.14a.53.53 0 0 1-.771.56l-4.618-2.428a2.122 2.122 0 0 0-1.973 0L6.396 21.01a.53.53 0 0 1-.77-.56l.881-5.139a2.122 2.122 0 0 0-.611-1.879L2.16 9.795a.53.53 0 0 1 .294-.906l5.165-.755a2.122 2.122 0 0 0 1.597-1.16z" />
                            </svg>
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-star-icon lucide-star size-16 fill-yellow-300">
                                <path d="M11.525 2.295a.53.53 0 0 1 .95 0l2.31 4.679a2.123 2.123 0 0 0 1.595 1.16l5.166.756a.53.53 0 0 1 .294.904l-3.736 3.638a2.123 2.123 0 0 0-.611 1.878l.882 5.14a.53.53 0 0 1-.771.56l-4.618-2.428a2.122 2.122 0 0 0-1.973 0L6.396 21.01a.53.53 0 0 1-.77-.56l.881-5.139a2.122 2.122 0 0 0-.611-1.879L2.16 9.795a.53.53 0 0 1 .294-.906l5.165-.755a2.122 2.122 0 0 0 1.597-1.16z" />
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <?php include VIEW_PATH . '/components/footer.php'; ?>
    </section>
    <!-- <section class="flex flex-col items-center text-center w-full overflow-clip ">
        <section class="flex flex-col h-lvh px-6 w-full max-lg:pt-20 bg-custom-secondary items-center lg:justify-center lg:pt-0 z-10">
            <div class="flex flex-col items-center max-w-7xl my-moveDown">
                <h1 class="font-giaza font-black max-lg:text-2xl lg:text-5xl mb-6">The <span class="">Standard</span> Has Arrived.</h1>
                <p class=" font-light text-md mb-2 lg:text-2xl">HJJC is proud to introduce an unparalleled coffee experience to the Philippines. We are defined by a relentless pursuit of perfection. Our baristas transform the world's finest ingredients into exquisite beverages that stimulate the senses and redefine your expectations.</p>
                <p class=" font-noarmal text-md lg:text-2xl ">Explore the new <span class="font-giaza capitalize font-black">pinnacle of taste.</span></p>
            </div>
            <div class="my-popUp z-20 lg:hidden">
                <div class="animate-bounce text-custom-accent -rotate-10 translate-y-40 -translate-x-20 text-xl font-black  bg-black/80 p-1.5 rounded-2xl">Caramel Machiato!</div>
            </div>
            <img src="<?php echo ASSET_URL; ?>/images/design.png" alt="" class=" my-moveTop lg:hidden">
        </section>
        <section class="flex flex-col h-lvh px-6 w-full justify-evenly bg-custom-secondary/20 items-center  z-10">
            <div class="flex flex-col w-full justify-evenly h-fit items-center max-w-7xl">
                <div>
                    <h1 class="font-giaza font-black max-lg:text-2xl mb-6 lg:text-5xl">A Brew to Define Your Day.</h1>
                    <p class=" font-light text-md lg:text-2xl">Fuel your pursuit of perfection. From robust classics to nuanced single-origins, our menu offers an exquisite beverage to satisfy your distinct taste.</p>
                </div>
            </div>
            <div class="slider" style="--width: 225px;--height:300px;--quantity:10;">
                <div class="slider_list">
                    <div class="list_item h-max p-4 bg-linear-to-br from-custom-primary/50 to-custom-accent/20 rounded-2xl" style="--position:1"><img src="<?php echo ASSET_URL; ?>/images/products/product_691187dfa0ee02.31544433.png" alt="" class="rounded-2xl">
                        <div class="flex w-full justify-between  ">
                            <p class="text-xl font-bold pb-3 text-custom-accent leading-none">Affogato</p>
                            <p class="text-black/80 text-2xl font-black float-right">₱150</p>
                        </div>
                    </div>
                    <div class="list_item p-4 bg-linear-to-br from-custom-primary/50 to-custom-accent/20 rounded-2xl" style="--position:2"><img src="<?php echo ASSET_URL; ?>/images/products/product_691187f16780b4.98755633.png" alt="" class="rounded-2xl">
                        <div class="flex w-full justify-between">
                            <p class="text-xl font-bold pb-3 text-custom-accent leading-none">Americano</p>
                            <p class="text-black/80 text-2xl font-black float-right">₱150</p>
                        </div>
                    </div>
                    <div class="list_item p-4 bg-linear-to-br from-custom-primary/50 to-custom-accent/20 rounded-2xl" style="--position:4"><img src="<?php echo ASSET_URL; ?>/images/products/product_69118851ee63a8.69493917.png" alt="" class="rounded-2xl">
                        <div class="flex w-full justify-between">
                            <p class="text-xl font-bold pb-3 text-custom-accent leading-none">Coffee Frappé</p>
                            <p class="text-black/80 text-2xl font-black float-right">₱150</p>
                        </div>
                    </div>
                    <div class="list_item p-4 bg-linear-to-br from-custom-primary/50 to-custom-accent/20 rounded-2xl" style="--position:5"><img src="<?php echo ASSET_URL; ?>/images/products/product_691188318450d4.46308589.png" alt="" class="rounded-2xl">
                        <div class="flex w-full justify-between">
                            <p class="text-xl font-bold pb-3 text-custom-accent leading-none">Chocolate Frappé</p>
                            <p class="text-black/80 text-2xl font-black float-right">₱150</p>
                        </div>
                    </div>
                    <div class="list_item p-4 bg-linear-to-br from-custom-primary/50 to-custom-accent/20 rounded-2xl" style="--position:3"><img src="<?php echo ASSET_URL; ?>/images/products/product_69118842ed1234.57943100.png" alt="" class="rounded-2xl">
                        <div class="flex w-full justify-between">
                            <p class="text-xl font-bold pb-3 text-custom-accent leading-none">Caramel Frappé</p>
                            <p class="text-black/80 text-2xl font-black float-right">₱150</p>
                        </div>
                    </div>
                    <div class="list_item p-4 bg-linear-to-br from-custom-primary/50 to-custom-accent/20 rounded-2xl" style="--position:6"><img src="<?php echo ASSET_URL; ?>/images/products/product_691187dfa0ee02.31544433.png" alt="" class="rounded-2xl">
                        <div class="flex w-full justify-between">
                            <p class="text-xl font-bold pb-3 text-custom-accent">Affogato</p>
                            <p class="text-black/80 text-2xl font-black float-right">₱150</p>
                        </div>
                    </div>
                    <div class="list_item p-4 bg-linear-to-br from-custom-primary/50 to-custom-accent/20 rounded-2xl" style="--position:7"><img src="<?php echo ASSET_URL; ?>/images/products/product_691187f16780b4.98755633.png" alt="" class="rounded-2xl">
                        <div class="flex w-full justify-between">
                            <p class="text-xl font-bold pb-3 text-custom-accent">Americano</p>
                            <p class="text-black/80 text-2xl font-black float-right">₱150</p>
                        </div>
                    </div>
                    <div class="list_item p-4 bg-linear-to-br from-custom-primary/50 to-custom-accent/20 rounded-2xl" style="--position:8"><img src="<?php echo ASSET_URL; ?>/images/products/product_69118842ed1234.57943100.png" alt="" class="rounded-2xl">
                        <div class="flex w-full justify-between">
                            <p class="text-xl font-bold pb-3 text-custom-accent leading-none">Coffee Frappé</p>
                            <p class="text-black/80 text-2xl font-black float-right">₱150</p>
                        </div>
                    </div>
                    <div class="list_item p-4 bg-linear-to-br from-custom-primary/50 to-custom-accent/20 rounded-2xl" style="--position:9"><img src="<?php echo ASSET_URL; ?>/images/products/product_69118851ee63a8.69493917.png" alt="" class="rounded-2xl">
                        <div class="flex w-full justify-between">
                            <p class="text-xl font-bold pb-3 text-custom-accent leading-none">Chocolate Frappé</p>
                            <p class="text-black/80 text-2xl font-black float-right">₱150</p>
                        </div>
                    </div>
                    <div class="list_item p-4 bg-linear-to-br from-custom-primary/50 to-custom-accent/20 rounded-2xl" style="--position:10"><img src="<?php echo ASSET_URL; ?>/images/products/product_691188318450d4.46308589.png" alt="" class="rounded-2xl">
                        <div class="flex w-full justify-between">
                            <p class="text-xl font-bold pb-3 text-custom-accent leading-none">Caramel Frappé</p>
                            <p class="text-2xl font-black float-right text-black/80">₱150</p>
                        </div>
                    </div>
                </div>
            </div>
            <div>
                <a href="<?php echo BASE_URL; ?>/home" class="underline flex gap-0.5 max-lg:text-xl">
                    <svg ...>
                    Explore</a>
            </div>
        </section>
        <section class=" z-10">
            <?php include VIEW_PATH . '/components/footer.html'; ?>
        </section>
    </section> -->
</body>

</html>