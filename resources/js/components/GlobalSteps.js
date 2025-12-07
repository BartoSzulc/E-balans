import { gsap } from 'gsap';
import { ScrollTrigger } from 'gsap/ScrollTrigger';

export function initializeOurHistoryAnimation() {
    gsap.registerPlugin(ScrollTrigger);
    
    // Get all global-steps sections
    const ourHistorySections = gsap.utils.toArray(".global-steps");

    if (ourHistorySections.length > 0) {
        const isMobile = window.innerWidth < 1024;
        let animationStart, animationEnd;

        if (isMobile) {
            animationStart = "top center";
            animationEnd = "bottom center";
        } else {
            animationStart = "top center"; 
            animationEnd = "bottom "; 
        }

        ourHistorySections.forEach((ourHistorySection, sectionIndex) => {
            const ourHistoryStepsWrapper = ourHistorySection.querySelector(".global-steps__wrapper");
            const steps = gsap.utils.toArray(".step", ourHistorySection); // Scope steps to current section

            if (ourHistoryStepsWrapper && steps.length > 0) {
                const tl = gsap.timeline({
                    scrollTrigger: {
                        trigger: ourHistorySection,
                        start: animationStart,
                        end: animationEnd,
                        //markers: true, // Keep markers for debugging
                        scrub: true,
                        id: `history-animation-${sectionIndex}`, // Unique ID for each section
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

                // Ensure the first step is active when the animation is at its very beginning
                const scrollTrigger = ScrollTrigger.getById(`history-animation-${sectionIndex}`);
                if (scrollTrigger && scrollTrigger.progress === 0) {
                    steps[0].classList.add("active");
                }
            }
        });
    }
}