document.addEventListener("DOMContentLoaded", () => {
    gsap.registerPlugin(ScrollTrigger);

    const scrollContainer = document.querySelector(".smooth-scroll");

    // 1. SETUP LOCOMOTIVE SCROLL
    const locoScroll = new LocomotiveScroll({
        el: scrollContainer,
        smooth: true,
        multiplier: 1,
        smartphone: { smooth: true },
        tablet: { smooth: true }
    });

    // 2. SETUP PROXY
    locoScroll.on("scroll", ScrollTrigger.update);

    ScrollTrigger.scrollerProxy(scrollContainer, {
        scrollTop(value) {
            return arguments.length
                ? locoScroll.scrollTo(value, { duration: 0, disableLerp: true })
                : locoScroll.scroll.instance.scroll.y;
        },
        getBoundingClientRect() {
            return {
                top: 0, left: 0, width: window.innerWidth, height: window.innerHeight
            };
        },
        pinType: scrollContainer.style.transform ? "transform" : "fixed"
    });

    ScrollTrigger.defaults({ scroller: ".smooth-scroll" });

    // 3. ANIMATION LOGIC
    let mainTimeline;

    function initAnimations() {
        if (mainTimeline) mainTimeline.kill();

        // Only run on desktop
        if (window.innerWidth < 1024) return;

        const startImg = document.querySelector("#moving-frappe");
        const targetImg = document.querySelector("#target-frappe");

        if (!startImg || !targetImg) return;

        // --- A. RESET STATE FOR MEASUREMENT ---
        // We must clear GSAP props to measure the natural CSS position first
        gsap.set(startImg, { clearProps: "all" });
        
        // Re-apply the initial CSS centering logic so measurement is accurate to what the user sees
        gsap.set(startImg, { 
            position: "absolute", 
            top: "50%", 
            left: "50%", 
            xPercent: -50, 
            yPercent: -50, 
            zIndex: 50,
            rotate: "-15deg",
            opacity: 1 
        });
        gsap.set(targetImg, { opacity: 0 });

        // --- B. GET GEOMETRIES ---
        const startRect = startImg.getBoundingClientRect();
        const targetRect = targetImg.getBoundingClientRect();

        // --- C. CALCULATE CENTER POINTS ---
        // We calculate the center of the start image
        const startCenterX = startRect.left + (startRect.width / 2);
        const startCenterY = startRect.top + (startRect.height / 2);

        // We calculate the center of the target image
        const targetCenterX = targetRect.left + (targetRect.width / 2);
        const targetCenterY = targetRect.top + (targetRect.height / 2);

        // --- D. CALCULATE DELTA (Distance to move) ---
        // Move from Center to Center
        const xMove = targetCenterX - startCenterX;
        const yMove = targetCenterY - startCenterY;

        // Calculate Scale
        const scaleFactor = targetRect.width / startRect.width;

        // --- E. CREATE TIMELINE ---
        mainTimeline = gsap.timeline({
            scrollTrigger: {
                trigger: ".second-section",
                start: "center center",
                endTrigger: ".third-section",
                end: "center center",
                scrub: 1.5, // slightly smoother
                pinSpacing: false
            }
        });

        mainTimeline.to(startImg, {
            x: `+=${xMove}`, // Move relative to current center
            y: `+=${yMove}`, // Move relative to current center
            scale: scaleFactor,
            rotation: 0,
            ease: "power1.inOut"
        })
        .to(startImg, { opacity: 0, duration: 0.1 })
        .to(targetImg, { opacity: 1, duration: 0.1 }, "<");
    }

    // 4. SCROLL & RESIZE OBSERVERS
    const resizeObserver = new ResizeObserver(() => {
        locoScroll.update();
        ScrollTrigger.refresh();
    });
    resizeObserver.observe(scrollContainer);

    // Refresh animation values on window resize
    ScrollTrigger.addEventListener("refreshInit", initAnimations);
    ScrollTrigger.addEventListener("refresh", () => locoScroll.update());

    // Initial Run
    initAnimations();
    ScrollTrigger.refresh();
});