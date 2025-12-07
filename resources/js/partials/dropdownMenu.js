export function initDropdownMenu() {
    const isMobile = () => window.innerWidth < 1024;

    if (!isMobile()) {
        const menuItems = document.querySelectorAll('.menu-item-has-children');

        menuItems.forEach(item => {
            const subMenu = item.querySelector('.sub-menu');
            if (!subMenu) return;

            let timeoutId;

            const showMenu = () => {
                clearTimeout(timeoutId);
                item.classList.add('active');
                subMenu.classList.add('active');
            };

            const hideMenu = () => {
                timeoutId = setTimeout(() => {
                    item.classList.remove('active');
                    subMenu.classList.remove('active');
                }, 200);
            };

            item.addEventListener('mouseenter', showMenu);
            item.addEventListener('mouseleave', hideMenu);

            item.addEventListener('focusin', showMenu);
            item.addEventListener('focusout', hideMenu);
        });
    }
}