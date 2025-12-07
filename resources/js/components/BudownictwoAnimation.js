import { gsap } from 'gsap';
import { ScrollTrigger } from 'gsap/ScrollTrigger';

export function initializeBudownictwoAnimation() {
    gsap.registerPlugin(ScrollTrigger);
    const budownictwoSection = document.querySelector(".budownictwo");
    const budownictwoStepsWrapper = document.querySelector(".budownictwo .grid.steps > div");
    const steps = gsap.utils.toArray(".budownictwo .step");
    const hoversGallery = document.querySelector(".hoversGalleryBudownictwo");

    const galleryItems = gsap.utils.toArray(".hoversGalleryBudownictwo .item"); 

    const scrollToTopButton = document.querySelector(".scroll-to-top");
    const firstSection = document.querySelector(".first-section"); // Assuming you have a class 'first-section' for your initial section

    if (budownictwoSection && budownictwoStepsWrapper && steps.length > 0 && hoversGallery && galleryItems.length > 0) {
        let animationStart;
        let animationEnd;

        const isMobile = window.innerWidth < 1024;

        if (isMobile) {
            animationStart = "top center";
            animationEnd = "top center";

            // --- Mobile Scroll Hover Effect (Single Active Item) ---
            ScrollTrigger.create({
                trigger: hoversGallery, // The parent container is the trigger
                start: "top center",   // When the top of the gallery hits the center of the viewport
                end: "bottom center",  // When the bottom of the gallery leaves the center of the viewport
                scrub: true,           // Smoothly track scroll
                // markers: true,      // Uncomment for debugging
                onUpdate: (self) => {
                    // Calculate which item is currently in the center of the viewport
                    let activeItemIndex = -1;
                    let closestDistance = Infinity;

                    galleryItems.forEach((item, index) => {
                        const rect = item.getBoundingClientRect();
                        const viewportCenter = window.innerHeight / 2;
                        const itemCenter = rect.top + rect.height / 2;
                        const distance = Math.abs(itemCenter - viewportCenter);

                        if (distance < closestDistance) {
                            closestDistance = distance;
                            activeItemIndex = index;
                        }
                    });

                    // Apply/remove the class based on the calculated active item
                    galleryItems.forEach((item, index) => {
                        if (index === activeItemIndex) {
                            item.classList.add("active-scroll-hover");
                        } else {
                            item.classList.remove("active-scroll-hover");
                        }
                    });
                    
                }
            });
            
            // --- End Mobile Scroll Hover Effect ---

            if (scrollToTopButton && firstSection) {
                gsap.set(scrollToTopButton, { autoAlpha: 0 }); // Initially hide the button

                ScrollTrigger.create({
                    trigger: firstSection,
                    start: "bottom top", // When the bottom of the first-section hits the top of the viewport
                    toggleActions: "play none none reverse", // Play on enter, reverse on leave back
                    // markers: true, // Uncomment for debugging
                    onEnter: () => gsap.to(scrollToTopButton, { autoAlpha: 1, duration: 0.3 }),
                    onLeaveBack: () => gsap.to(scrollToTopButton, { autoAlpha: 0, duration: 0.3 })
                });
            }

        } else {
            animationStart = "top-=280 center";
            animationEnd = "top+=100 center";
        }
        const tl = gsap.timeline({
            scrollTrigger: {
                trigger: budownictwoStepsWrapper,
                start: animationStart,
                endTrigger: hoversGallery,
                end: animationEnd,
                //markers: true,
                scrub: true,
                onUpdate: (self) => {
                    const progressPerStep = 1 / steps.length;
                    let activeStepIndex = -1;

                    if (self.progress > 0 && self.progress < 1) {
                        activeStepIndex = Math.floor(self.progress / progressPerStep);
                        if (activeStepIndex >= steps.length) {
                            activeStepIndex = steps.length - 1;
                        }
                    } else if (self.progress === 0) {
                        activeStepIndex = 0;
                    } else if (self.progress === 1) {
                        activeStepIndex = steps.length - 1;
                    }

                    steps.forEach((step, i) => {
                        if (i === activeStepIndex) {
                            step.classList.add("active");
                        } else {
                            step.classList.remove("active");
                        }
                    });
                }
            }
        });

        if (ScrollTrigger.getById(tl.scrollTrigger.id) && ScrollTrigger.getById(tl.scrollTrigger.id).progress === 0) {
            steps[0].classList.add("active");
        }
    }
}