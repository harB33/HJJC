<!DOCTYPE html>
<html lang="en" data-theme="light">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="./image/logo.ico" type="image/x-icon">
    <title>HJJC. STORE | Map</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/locomotive-scroll@4.1.4/dist/locomotive-scroll.min.css">
    <link href="https://cdn.jsdelivr.net/npm/daisyui@5" rel="stylesheet" type="text/css" />
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link rel="stylesheet" href="./style/output.css" />
</head>
<body class=" min-h-screen overflow-x-clip">
    <div class="sticky top-0 z-50 ">
        <?php include './components/header.php'; ?>
    </div>
    <section class="w-screen flex justify-center items-center h-screen">
        <section class="w-fit flex flex-col p-8 ">
            <h1 class="w-full text-4xl font-black">Store Location</h1>
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3861.131778802718!2d120.98157049999999!3d14.5915659!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3397ca18d1ebbc55%3A0xd017325c95111277!2sUniversidad%20De%20Manila!5e0!3m2!1sen!2sph!4v1764123908380!5m2!1sen!2sph" class="max-w-2xl w-2xl max-h-[600px] h-[600px] rounded-2xl shadow-2xl" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </section>
        </section>
    <div class="w-full mt-auto z-10 block leading-none">
        <?php include './components/footer.html'; ?>
    </div>
</body>
</html>