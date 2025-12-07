import gsap from 'gsap';
import ScrollTrigger from 'gsap/ScrollTrigger';

export function initVideoToggle(options = {}) {

    const {
        videoSelector = '.animation-home',
        buttonSelector = '.play-button',
        playPathSelector = '.play-path',
        pausePathSelector = '.pause-path',
        enableKeyboard = true
    } = options;

    
    gsap.registerPlugin(ScrollTrigger);

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', () => setupVideoToggle());
    } else {
        setupVideoToggle();
    }

    function setupVideoToggle() {
        const playButton = document.querySelector(buttonSelector);
        const video = document.querySelector(videoSelector);
        const playPath = document.querySelector(playPathSelector);
        const pausePath = document.querySelectorAll(pausePathSelector);
        
        if (!playButton || !video || !playPath || !pausePath.length) {
            console.error('Video toggle: Required elements not found', {
                playButton: !!playButton,
                video: !!video,
                playPath: !!playPath,
                pausePath: pausePath.length > 0
            });
            return null;
        }

        // Ensure video is paused by default
        video.pause();
        
        let isManuallyPaused = false;
        
        function updateButtonState() {
            if (video.paused) {
                playPath.classList.remove('opacity-0');
                pausePath.forEach(element => element.classList.add('opacity-0'));
            } else {
                playPath.classList.add('opacity-0');
                pausePath.forEach(element => element.classList.remove('opacity-0'));
            }
        }
        
        updateButtonState();
        
        const handleClick = (e) => {
            e.preventDefault();
            
            if (video.paused) {
                video.play();
                isManuallyPaused = false;
            } else {
                video.pause();
                isManuallyPaused = true;
            }
            
            updateButtonState();
        };
        
        // GSAP ScrollTrigger - play when video reaches top of viewport
        const scrollTriggerInstance = ScrollTrigger.create({
            trigger: video,
            start: "top center",
            end: "bottom center",
            onEnter: () => {
                if (!isManuallyPaused) {
                    video.play().catch(e => {
                        console.warn('Autoplay prevented:', e.message);
                    });
                }
            },
            onLeave: () => {
                if (!isManuallyPaused) {
                    video.pause();
                }
            },
            onEnterBack: () => {
                if (!isManuallyPaused) {
                    video.play().catch(e => {
                        console.warn('Autoplay prevented:', e.message);
                    });
                }
            },
            onLeaveBack: () => {
                if (!isManuallyPaused) {
                    video.pause();
                }
            }
        });
        
        playButton.addEventListener('click', handleClick);
        video.addEventListener('play', updateButtonState);
        video.addEventListener('pause', updateButtonState);
        video.addEventListener('ended', updateButtonState);
        
        let keyboardHandler = null;
        if (enableKeyboard) {
            keyboardHandler = (e) => {
                if (e.code === 'Space' && e.target === document.body) {
                    e.preventDefault();
                    handleClick(e);
                }
            };
            document.addEventListener('keydown', keyboardHandler);
        }
    
        return function cleanup() {
            playButton.removeEventListener('click', handleClick);
            video.removeEventListener('play', updateButtonState);
            video.removeEventListener('pause', updateButtonState);
            video.removeEventListener('ended', updateButtonState);
            if (keyboardHandler) {
                document.removeEventListener('keydown', keyboardHandler);
            }
            if (scrollTriggerInstance) {
                scrollTriggerInstance.kill();
            }
        };
    }
}

export default initVideoToggle;