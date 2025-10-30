<!DOCTYPE html>
<html lang="en" data-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="./image/logo.ico" type="image/x-icon">
    <title>HJJC. STORE|Developer</title>
    <link
        href="https://cdn.jsdelivr.net/npm/daisyui@5"
        rel="stylesheet"
        type="text/css" />
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link rel="stylesheet" href="./style/output.css" />
</head>
<body class="w-screen overflow-x-hidden">
    <div class="sticky top-0 z-50 ">
        <?php include './components/header.php'; ?>
    </div>
    <section class="flex flex-col items-center text-center w-full overflow-clip min-h-screen bg-[#B6CCD7]">
        <h1 class=" font-black text-4xl mb-4">OUR DEVELOPERS</h1>
        <section class="flex flex-col" >
            <div>
                <h1 class=" font-bold text-2xl mb-4">CTO: <span class="font-black text-3xl">BAUTISTA, HARVY S.</span></h1>
            </div>
            <div>
                <h1 class=" font-bold text-2xl mb-4">SYSTEM ADMIN: <span class="font-black text-3xl">WAMIL, JOMARI L.</span></h1>
            </div>
            <div>
                <h1 class=" font-bold text-2xl mb-4">CMO: <span class="font-black text-3xl">PATRIARCA, JOHN ROMMEL T.</span></h1>
            </div>
            <div>
                <h1 class=" font-bold text-2xl mb-4">JOURNALIST: <span class="font-black text-3xl">MALIGAYA, CYRIL NERO .</span></h1>
            </div>
        </section>
    </section>

    <section class="my-fadeInFooter z-10">
        <?php include './components/footer.html'; ?>
    </section>
</body>
</html>