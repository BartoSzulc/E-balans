import Lenis from 'lenis';
import { gsap } from 'gsap';
import { ScrollTrigger } from 'gsap/ScrollTrigger';
import AOS from 'aos';

// Assuming isMobile function is defined elsewhere or imported
// For example:
export function initializeScrollAndAOS() {
    gsap.registerPlugin(ScrollTrigger);
    const isMobile = () => window.innerWidth < 1024;

    // if (!isMobile()) {
    //     const lenis = new Lenis({
    //         lerp: 0.1,
    //         wheelMultiplier: 0.5,
    //         smoothWheel: true,
    //         smoothTouch: false
    //     });

    //     ScrollTrigger.normalizeScroll(true);

    //     const updateAOS = () => {
    //         AOS.refresh();
    //     };

    //     lenis.on('scroll', ScrollTrigger.update);
    //     lenis.on('scroll', updateAOS);

    //     gsap.ticker.add((time) => {
    //         lenis.raf(time * 1000);
    //     });

    //     gsap.ticker.lagSmoothing(0);

    //     AOS.init({
    //         offset: 100,
    //         duration: 500,
    //         easing: 'ease-in-out',
    //         once: true,
    //         disable: false,
    //         startEvent: 'DOMContentLoaded',
    //         mirror: false,
    //         anchorPlacement: 'top-bottom',
    //         delay: 400
    //     });
    // } else {
        AOS.init({
            offset: 50,
            duration: 350,
            easing: 'ease-in-out',
            once: true
        });
    // }
}