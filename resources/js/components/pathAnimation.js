import { gsap } from 'gsap';
import { ScrollTrigger } from 'gsap/ScrollTrigger';
import { DrawSVGPlugin } from 'gsap/DrawSVGPlugin';

export function initializePathAnimations() {
    gsap.registerPlugin(ScrollTrigger, DrawSVGPlugin);

    // SVG Path Animations (your existing code)
    const baseLines = document.querySelectorAll('.path-svg .base-line');
    const animatedLines = document.querySelectorAll('.path-svg .animated-line');
    const lastLines = document.querySelectorAll('.path-svg .last-line');
    const main  = document.querySelector('main');

    if (baseLines.length > 0 && animatedLines.length > 0) {
        if (baseLines.length !== animatedLines.length) {
            console.warn("Mismatch between base lines and animated lines. Animations might not work as expected.");
        }

        // Animate SVG lines
        animatedLines.forEach((animatedLine, index) => {
            const baseLine = baseLines[index];
            const isReversed = animatedLine.classList.contains('line-reversed');
            const isOddIndex = index % 2 === 1;

            gsap.set(animatedLine, {
                stroke: '#0B284A',
                strokeWidth: isOddIndex ? 1 : 1,
                opacity: 1,
                drawSVG: isReversed ? '100% 100%' : '0% 0%',
            });

            let tl = gsap.timeline({
                scrollTrigger: {
                    trigger: animatedLine,
                    start: "top center+=100",
                    end: "bottom center",
                    scrub: true,
                }
            });

            tl.to(animatedLine, {
                drawSVG: isReversed ? '0% 100%' : '100% 0%',
                opacity: 1,
                duration: 1,
                ease: "none",
            }, 0);

            tl.to(baseLine, {
                opacity: 0.5,
                duration: 1,
                ease: "none",
            }, 0);
        });
    }

    // DIV Path Animations (updated)
    const divAnimatedLines = document.querySelectorAll('.custom-container .animated-line');
    const divBaseLines = document.querySelectorAll('.custom-container > div:not(.animated-line)');

    if (divAnimatedLines.length > 0) {
        console.log('Found DIV animated lines:', divAnimatedLines.length);

        divAnimatedLines.forEach((animatedLine, index) => {
            const baseLine = divBaseLines[index];
            const lineNumber = parseInt(animatedLine.dataset.line) || (index + 1);

            // Set initial state - all lines start from 0
            gsap.set(animatedLine, {
                opacity: 1,
            });

            let tl = gsap.timeline({
                scrollTrigger: {
                    trigger: main, // Use body as trigger for full page scroll
                    start: "top center+=100",
                    end: "bottom center",
                    scrub: 1, // Smooth scrubbing
                }
            });

            // Different animation for each line based on scroll progress
            if (lineNumber === 1) {
                // First vertical line - grows down as you scroll
                gsap.set(animatedLine, {
                    height: 0,
                    transformOrigin: "top"
                });
                
                tl.to(animatedLine, {
                    height: "calc(100% - 0.520833rem)",
                    
                    ease: "none",
                }, 0);
                
            } else if (lineNumber === 2) {
                // Horizontal line - grows left after first line
                gsap.set(animatedLine, {
                    width: 0,
                    transformOrigin: "right"
                });
                
                tl.to(animatedLine, {
                    width: "4.7604166rem",
                    
                    ease: "none",
                }, 0.5); // Starts after first line (60%)
                
            } else if (lineNumber === 3) {
                // Final vertical line - grows up
                gsap.set(animatedLine, {
                    height: 0,
                    transformOrigin: "top"
                });
                
                tl.to(animatedLine, {
                    height: "0.520833rem", // 100px equivalent
                   
                    ease: "none",
                }, 0.7); // Starts after horizontal line (80%)
            }

            // Fade base line as animated line appears
            if (baseLine) {
                tl.to(baseLine, {
                    opacity: 0.2,
                    duration: 0.1,
                    ease: "none",
                }, lineNumber === 1 ? 0.5 : (lineNumber === 2 ? 0.8 : 0.8));
            }
        });
    }

    // // Animate last lines
    // if (lastLines.length > 0) {
    //     // Set initial state for all last lines
    //     lastLines.forEach((lastLine) => {
    //         const isReversed = lastLine.classList.contains('line-reversed');
    //         gsap.set(lastLine, {
    //             stroke: '#0B284A',
    //             strokeWidth: 1,
    //             opacity: 1,
    //             drawSVG: isReversed ? '100% 100%' : '0% 0%',
    //         });
    //     });

    //     // Trigger animation when second last line comes into view
    //     ScrollTrigger.create({
    //         trigger: lastLines[1],
    //         start: "top center",
    //         onEnter: () => {
    //             lastLines.forEach((lastLine) => {
    //                 const isReversed = lastLine.classList.contains('line-reversed');
    //                 gsap.to(lastLine, {
    //                     drawSVG: isReversed ? '0% 100%' : '100% 0%',
    //                     opacity: 1,
    //                     duration: 0.5,
    //                     ease: "power2.out",
    //                 });
    //             });
    //         },
    //         onLeave: () => {
    //             lastLines.forEach((lastLine) => {
                    
    //                 gsap.to(lastLine, {
                        
    //                     opacity: 0,
    //                     duration: 0.5,
    //                     ease: "power2.in",
    //                 });
    //             });
    //         }
    //     });
    // }
}

//* Animacja jedna po drugiej

//   gsap.registerPlugin(ScrollTrigger, DrawSVGPlugin);

//   const baseLines = document.querySelectorAll('.path-svg .base-line');
//   const animatedLines = document.querySelectorAll('.path-svg .animated-line');
  
//   if (baseLines.length !== animatedLines.length) {
//       console.warn("Mismatch between base lines and animated lines. Animations might not work as expected.");
//   }
  
//   // --- Determine Processing Order (Top-to-Bottom) ---
//   // Your HTML lists lines from bottom (highest Y) to top (lowest Y).
//   // To animate them visually from top-to-bottom, we need to reverse the order
//   // of the NodeLists before looping through them.
//   const orderedAnimatedLines = Array.from(animatedLines).reverse();
//   const orderedBaseLines = Array.from(baseLines).reverse();
  
//   // Create a single MASTER timeline. All individual line animations will be
//   // appended to this master timeline, ensuring they play in strict sequence.
//   const masterLineAnimationTL = gsap.timeline();
  
//   // --- Iterate through the lines (now ordered top-to-bottom) ---
//   orderedAnimatedLines.forEach((animatedLine, index) => {
//       const baseLine = orderedBaseLines[index];
  
//       // Determine drawing direction based on the 'line-reversed' class
//       const isReversed = animatedLine.classList.contains('line-reversed');
  
//       // Set initial state for the animated line.
//       // This is done immediately (not part of the timeline) so lines are ready.
//       gsap.set(animatedLine, {
//           stroke: '#0B284A',    // Final stroke color
//           strokeWidth: 1,       // Stroke width
//           opacity: 1,           // IMPORTANT: Line starts INVISIBLE so it appears as it draws
//           drawSVG: isReversed ? '100% 100%' : '0% 0%', // Initial state for drawing direction
//       });
  
//       // Add this specific line's animation to the master timeline.
//       // Each '.to()' call here adds a new step to the sequence.
//       masterLineAnimationTL.to(animatedLine, {
//           drawSVG: isReversed ? '0% 100%' : '100% 0%', // Final state for drawing
//           opacity: 1, // Make it fully visible as it draws
//           duration: 1, // Duration of THIS specific line's animation within the master timeline
//           ease: "none",
//       }, ">"); // The ">" position parameter ensures this animation starts *after* the previous one ends.
//                // For a very subtle overlap (to make transitions smoother), you could use ">-0.1" (starts 0.1s before previous ends).
  
//       // Add the fading animation for the base line to the master timeline.
//       masterLineAnimationTL.to(baseLine, {
//           opacity: 0.5, // Fade out the base line completely (from its initial 0.5 opacity in HTML)
//           duration: 1, // Duration of this tween, same as animatedLine for simultaneous fade/draw
//           ease: "none",
//       }, "<"); // The "<" position parameter ensures this animation starts *at the same time* as the previous tween (animatedLine drawing).
//   });
  
//   // --- Create a single ScrollTrigger to control the entire master timeline ---
//   // This ScrollTrigger will determine how much scroll is needed to play the
//   // entire sequence of line animations.
//   ScrollTrigger.create({
//       trigger: ".svg-container", // The main container acts as the overall trigger for the sequence
//       start: "top+=100 center",       // The entire sequence begins when the top of the SVG container hits the viewport's center.
//                                  // Adjust this for when you want the animation to start.
//       end: "bottom+=200 center",      // The entire sequence ends when the bottom of the SVG container hits the viewport's center.
//                                  // This defines the total scroll distance for the animations.
//                                  // If this is too short, the animation will be too fast.
//                                  // If it's too long, it will be very slow.
//       scrub: true, 
//       markers: true,             // Link the master timeline's progress directly to scroll.
//       animation: masterLineAnimationTL, // Attach the master timeline to this ScrollTrigger.
//       // markers: true,           // Uncomment this to see the ScrollTrigger start/end markers for the entire sequence.
//       // pin: true,               // Optional: Set to true if you want the SVG container to "pin" in place
//                                  // while the entire animation sequence plays out.
//   });