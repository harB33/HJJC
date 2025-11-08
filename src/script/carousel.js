document.addEventListener("DOMContentLoaded", () => {
    const slides = [...document.querySelectorAll(".carousel-content .mod")];
    const prevBtn = document.getElementById("prev");
    const nextBtn = document.getElementById("next");
    const container = document.querySelector(".carousel-content");
    if (!container || slides.length === 0 || !prevBtn || !nextBtn) {
        console.warn("Carousel: missing elements", { container: !!container, slides: slides.length, prev: !!prevBtn, next: !!nextBtn });
        return;
    }

    const order = ["bo","ba","bd","bc","bz","bn"];
    let offset = 0;
    const apply = () => slides.forEach((s,i) => s.className = "mod " + order[(i + offset) % slides.length]);

    const rotate = (dir) => { offset = (offset + dir + slides.length) % slides.length; apply(); };

    nextBtn.onclick = () => rotate(-1);
    prevBtn.onclick = () => rotate(1);

    //swipe
    let startX = 0, lastX = 0, isMoving = false;
    const threshold = 40;
    const maxTime = 800;
    let tStart = 0;

    container.addEventListener("touchstart", (e) => {
        if (!e.touches || !e.touches[0]) return;
        startX = e.touches[0].clientX;
        lastX = startX;
        isMoving = true;
        tStart = Date.now();
    }, {passive: true});

    container.addEventListener("touchmove", (e) => {
        if (!isMoving || !e.touches || !e.touches[0]) return;
        lastX = e.touches[0].clientX;
    }, {passive: true});

    container.addEventListener("touchend", (e) => {
        if (!isMoving) return;
        isMoving = false;
        const dist = lastX - startX;
        const dt = Date.now() - tStart;

        if (Math.abs(dist) > threshold && dt < 2000) {
        if (dist < 0) rotate(-1);
        else rotate(1);
        }
        startX = lastX = 0;
    }, {passive: true});
});