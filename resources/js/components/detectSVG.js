export function detectSVGPathTypes() {
    const svgs = document.querySelectorAll('svg');

    svgs.forEach(svg => {
        const paths = svg.querySelectorAll('path');
        let hasStroke = false;
        let hasFill = false;

        paths.forEach(path => {
            const computedStyle = window.getComputedStyle(path);
            const stroke = computedStyle.stroke || path.getAttribute('stroke');
            const fill = computedStyle.fill || path.getAttribute('fill');

            if (stroke && stroke !== 'none' && stroke !== 'transparent') {
                hasStroke = true;
            }
            if (fill && fill !== 'none' && fill !== 'transparent') {
                hasFill = true;
            }
        });

        if (hasStroke && !hasFill) {
            svg.classList.add('svg-stroke');
        } else if (hasFill && !hasStroke) {
            svg.classList.add('svg-fill');
        } else if (hasStroke && hasFill) {
            svg.classList.add('svg-mixed');
        }
    });
}