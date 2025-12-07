import Component from "./Component";
import gsap from "gsap";

export default class MarqueeImage extends Component {
    constructor() {
        super();
    }
    
    init() {
        // Find all .toleft and .toright containers
        const leftContainers = document.querySelectorAll(".toleft");
        const rightContainers = document.querySelectorAll(".toright");
        
        // Process each .toleft container separately
        leftContainers.forEach((container, index) => {
            const parts = container.querySelectorAll(".marquee-image__part");
            
            if (parts.length > 0) {
                const loopToLeft = horizontalLoop(parts, {
                    repeat: -1,
                    paused: false,
                    speed: 1
                });
                
                // Store the timeline reference on the container element
                container._timeline = loopToLeft;
            } else {
                console.warn(`No elements found for '.marquee-image__part' in .toleft container ${index}`);
            }
        });
        
        // Process each .toright container separately
        rightContainers.forEach((container, index) => {
            const parts = container.querySelectorAll(".marquee-image__part");
            
            if (parts.length > 0) {
                const loopToRight = horizontalLoop(parts, {
                    repeat: -1,
                    paused: false,
                    speed: 1,
                    reversed: true
                });
                
                // Store the timeline reference on the container element
                container._timeline = loopToRight;
            } else {
                console.warn(`No elements found for '.marquee-image__part' in .toright container ${index}`);
            }
        });
        
        // Uncomment to enable hover pause/resume functionality
        /*
        document.querySelectorAll(".toleft, .toright").forEach(element => {
            // Only add event listeners if the element has a timeline
            if (element._timeline) {
                element.addEventListener("mouseenter", function() {
                    // Pause the timeline associated with this specific container
                    this._timeline.pause();
                });
                
                element.addEventListener("mouseleave", function() {
                    // Resume the timeline associated with this specific container
                    this._timeline.resume();
                });
            }
        });
        */
        
        /*
        This helper function makes a group of elements animate along the x-axis in a seamless, responsive loop.

        Features:
        - Uses xPercent so that even if the widths change (like if the window gets resized), it should still work in most cases.
        - When each item animates to the left or right enough, it will loop back to the other side
        - Optionally pass in a config object with values like "speed" (default: 1, which travels at roughly 100 pixels per second), paused (boolean),  repeat, reversed, and paddingRight.
        - The returned timeline will have the following methods added to it:
        - next() - animates to the next element using a timeline.tweenTo() which it returns. You can pass in a vars object to control duration, easing, etc.
        - previous() - animates to the previous element using a timeline.tweenTo() which it returns. You can pass in a vars object to control duration, easing, etc.
        - toIndex() - pass in a zero-based index value of the element that it should animate to, and optionally pass in a vars object to control duration, easing, etc. Always goes in the shortest direction
        - current() - returns the current index (if an animation is in-progress, it reflects the final index)
        - times - an Array of the times on the timeline where each element hits the "starting" spot. There's also a label added accordingly, so "label1" is when the 2nd element reaches the start.
        */
        
        function horizontalLoop(items, config) {
            const media = window.innerWidth;
            let gapPX;
            if (media > 1024) {
                gapPX = -16;
            } else {
                gapPX = -10;
            }

            items = gsap.utils.toArray(items);
            config = config || {};
            let tl = gsap.timeline({
                repeat: config.repeat,
                paused: config.paused,
                defaults: { ease: "none" },
                onReverseComplete: () => tl.totalTime(tl.rawTime() + tl.duration() * 100),
            }),
                length = items.length,
                startX = items[0].offsetLeft,
                times = [],
                widths = [],
                xPercents = [],
                curIndex = 0,
                pixelsPerSecond = (config.speed || 1) * 100,
                snap = config.snap === false ? (v) => v : gsap.utils.snap(config.snap || 1),
                gap = gapPX, // Gap between elements
                totalWidth,
                curX,
                distanceToStart,
                distanceToLoop,
                item,
                i;
            
            gsap.set(items, {
                xPercent: (i, el) => {
                    let w = (widths[i] = parseFloat(gsap.getProperty(el, "width", "px")) + gap); // Include gap in the width calculation
                    xPercents[i] = snap(
                        (parseFloat(gsap.getProperty(el, "x", "px")) / w) * 100 +
                        gsap.getProperty(el, "xPercent")
                    );
                    return xPercents[i];
                },
            });
            
            gsap.set(items, { x: 0 });
            
            totalWidth =
                items[length - 1].offsetLeft +
                (xPercents[length - 1] / 100) * widths[length - 1] -
                startX +
                items[length - 1].offsetWidth *
                gsap.getProperty(items[length - 1], "scaleX") +
                (parseFloat(config.paddingRight) || 0) +
                gap * (length - 1); // Include total gaps in the totalWidth calculation
            
            for (i = 0; i < length; i++) {
                item = items[i];
                curX = (xPercents[i] / 100) * widths[i];
                distanceToStart = item.offsetLeft + curX - startX + gap * i; // Position each item with the gap included
                distanceToLoop =
                    distanceToStart + widths[i] * gsap.getProperty(item, "scaleX");
                tl.to(
                    item,
                    {
                        xPercent: snap(((curX - distanceToLoop) / widths[i]) * 100),
                        duration: distanceToLoop / pixelsPerSecond,
                    },
                    0
                )
                    .fromTo(
                        item,
                        {
                            xPercent: snap(
                                ((curX - distanceToLoop + totalWidth) / widths[i]) * 100
                            ),
                        },
                        {
                            xPercent: xPercents[i],
                            duration:
                                (curX - distanceToLoop + totalWidth - curX) / pixelsPerSecond,
                            immediateRender: false,
                        },
                        distanceToLoop / pixelsPerSecond
                    )
                    .add("label" + i, distanceToStart / pixelsPerSecond);
                times[i] = distanceToStart / pixelsPerSecond;
            }
            
            function toIndex(index, vars) {
                vars = vars || {};
                Math.abs(index - curIndex) > length / 2 &&
                    (index += index > curIndex ? -length : length); // always go in the shortest direction
                let newIndex = gsap.utils.wrap(0, length, index),
                    time = times[newIndex];
                if (time > tl.time() !== index > curIndex) {
                    // if we're wrapping the timeline's playhead, make the proper adjustments
                    vars.modifiers = { time: gsap.utils.wrap(0, tl.duration()) };
                    time += tl.duration() * (index > curIndex ? 1 : -1);
                }
                curIndex = newIndex;
                vars.overwrite = true;
                return tl.tweenTo(time, vars);
            }
            
            tl.next = (vars) => toIndex(curIndex + 1, vars);
            tl.previous = (vars) => toIndex(curIndex - 1, vars);
            tl.current = () => curIndex;
            tl.toIndex = (index, vars) => toIndex(index, vars);
            tl.times = times;
            tl.progress(1, true).progress(0, true); // pre-render for performance
            
            if (config.reversed) {
                tl.vars.onReverseComplete();
                tl.reverse();
            }
            
            return tl;
        }
    }
}