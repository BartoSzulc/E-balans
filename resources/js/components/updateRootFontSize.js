import { gsap } from 'gsap';

function updateRootFontSize() {
    if (document.body && document.body.classList.contains('page-template-podzial')) {
        return;
    }

    const viewportWidth = document.documentElement.clientWidth;
    let fontSize;
    let layoutClass;

    if (viewportWidth >= 1024) {
        fontSize = viewportWidth / 10;
        layoutClass = 'desktop-layout';
    } else {
        fontSize = 32;
        layoutClass = 'mobile-layout';
    }
    document.documentElement.style.fontSize = `${fontSize}px`;

    document.body.classList.remove('desktop-layout', 'mobile-layout');
    document.body.classList.add(layoutClass);
}

function handlePageLoader() {
    const loader = document.getElementById('page-loader');
    if (loader) {
        loader.style.opacity = '0';
        setTimeout(() => {
            loader.remove();
        }, 600);
        const img = document.querySelector(".hero_background img");
        if (img) {
            gsap.fromTo(img, { y: 100 }, { y: 0, duration: 1 });
        }
    }
}

export function initializeFontSizeAndLoader() {
    // Initial font size setup
    (function() {
        if (document.body && document.body.classList.contains('page-template-podzial')) {
            return;
        }

        const initialWidth = document.documentElement.clientWidth;
        const initialFontSize = initialWidth >= 1024 ? (initialWidth / 10) : 32;

        const style = document.createElement('style');
        style.textContent = `html { font-size: ${initialFontSize}px; }`;
        document.head.appendChild(style);
    })();

    document.addEventListener('DOMContentLoaded', () => {
        if (document.body && document.body.classList.contains('page-template-podzial')) {
            setTimeout(handlePageLoader, 300);
            return;
        }

        updateRootFontSize();
        setTimeout(handlePageLoader, 300);
    });

    let resizeTimer;
    window.addEventListener('resize', () => {
        if (document.body && document.body.classList.contains('page-template-podzial')) {
            return;
        }

        clearTimeout(resizeTimer);
        resizeTimer = setTimeout(updateRootFontSize, 20);
    });

    window.addEventListener('DOMContentLoaded', updateRootFontSize);
}