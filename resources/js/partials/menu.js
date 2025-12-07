import Lenis from 'lenis';

export function initMenu() {
    const isMobile = () => window.innerWidth < 1024;
    let isOpen = false;
    
    // Destroy Lenis
    const destroyLenis = () => {
        if (window.lenis) {
            window.lenis.destroy();
            window.lenis = null;
        }
    };
    
    


    const toggleMenu = (shouldOpen) => {
        isOpen = shouldOpen !== undefined ? shouldOpen : !isOpen;

        const menus = document.querySelectorAll('.mobile-menu');
        menus.forEach(menu => {
            menu.classList.toggle('active', isOpen);
        });

        const mainHeader = document.querySelector('.main-header');
        if (mainHeader) {
            mainHeader.classList.toggle('active', isOpen);
        }

        const jsbuttons = document.querySelectorAll('.js-button');
        jsbuttons.forEach(button => {
            button.classList.toggle('active', isOpen);
        });

        const body = document.querySelector('body');
        if (body) {
            body.classList.toggle('overflow-hidden', isOpen);
        }

        // Handle Lenis scroll with destroy/initialize ONLY ON MOBILE
        if (isMobile()) {
            if (isOpen) {
                // Destroy Lenis when menu is open on mobile
                destroyLenis();
            } else {
                // Reinitialize Lenis when menu is closed on mobile
                
                resetAllSubmenus();
            }
        } else {
            // On desktop, just reset submenus when closing
            if (!isOpen) {
                resetAllSubmenus();
            }
        }
        

    };

    const closeMenu = () => {
        if (isOpen) toggleMenu(false);
    };

    // Slide animation functions
    const slideDown = (element, duration = 500) => {
        // Get the natural height of the element
        element.style.height = 'auto';
        const height = element.scrollHeight;
        
        // Set initial state
        element.style.height = '0px';
        element.style.opacity = '0';
        element.style.overflow = 'hidden';
        element.style.transition = `height ${duration}ms ease-in-out, opacity ${duration}ms ease-in-out`;
        
        // Force repaint
        element.offsetHeight;
        
        // Trigger the animation
        element.style.height = `${height}px`;
        element.style.opacity = '1';
        
        // Clean up after the animation
        setTimeout(() => {
            element.style.height = 'auto';
            element.style.overflow = '';
        }, duration);
    };

    const slideUp = (element, duration = 500) => {
        // Set initial state
        element.style.height = `${element.scrollHeight}px`;
        element.style.overflow = 'hidden';
        element.style.transition = `height ${duration}ms ease-in-out, opacity ${duration}ms ease-in-out`;
        
        // Force repaint
        element.offsetHeight;
        
        // Trigger the animation
        element.style.height = '0px';
        element.style.opacity = '0';
        
        // Clean up after the animation
        setTimeout(() => {
            element.style.display = 'none';
            element.style.height = '';
            element.style.opacity = '';
            element.style.overflow = '';
        }, duration);
    };

    const resetAllSubmenus = () => {
        document.querySelectorAll('.menu-item-has-children').forEach(item => {
            item.classList.remove('submenu-open');
            const submenu = item.querySelector('.sub-menu');
            if (submenu) {
                submenu.classList.remove('submenu-open');
                submenu.style.display = 'none';
                submenu.style.height = '';
                submenu.style.opacity = '';
            }
        });
    };

    // Open/Close main menu on .js-button click
    document.querySelectorAll('.js-button').forEach(button => {
        button.addEventListener('click', () => {
            toggleMenu();
        });
    });

    // Handle submenu toggling on menu-item-has-children clicks (whole item is clickable now)
    document.querySelectorAll('.menu-item-has-children').forEach(menuItem => {
        menuItem.addEventListener('click', function (event) {
            if (isMobile()) {
                // Prevent clicks on anchor elements from triggering submenu
                if (event.target.tagName.toLowerCase() === 'a' && !event.target.classList.contains('indicator')) {
                    return;
                }
                
                const submenu = this.querySelector('.sub-menu');
                if (!submenu) return;
                
                // Toggle submenu state
                const isSubmenuOpen = this.classList.contains('submenu-open');
                
                if (isSubmenuOpen) {
                    // Close the submenu with animation
                    this.classList.remove('submenu-open');
                    submenu.classList.remove('submenu-open');
                    slideUp(submenu);
                } else {
                    // Open the submenu with animation
                    this.classList.add('submenu-open');
                    submenu.classList.add('submenu-open');
                    submenu.style.display = 'block';
                    slideDown(submenu);
                }
                
                // Stop event propagation to prevent parent menu items from also toggling
                event.stopPropagation();
            }
        });
    });

    const backButtons = document.querySelectorAll('.menu-back-button');
    backButtons.forEach(button => {
        button.addEventListener('click', function (e) {
            e.preventDefault();
            const currentSubmenu = this.closest('.sub-menu');
            const parentMenuItem = currentSubmenu.closest('.menu-item-has-children');

            // Hide current submenu with animation
            parentMenuItem.classList.remove('submenu-open');
            currentSubmenu.classList.remove('submenu-open');
            slideUp(currentSubmenu);

            // Show parent menu items
            if (parentMenuItem) {
                const parentSubmenu = parentMenuItem.closest('.sub-menu');
                if (parentSubmenu) {
                    parentSubmenu.classList.add('submenu-open');
                    const parentMenuItemParent = parentSubmenu.closest('.menu-item-has-children');
                    if (parentMenuItemParent) {
                        parentMenuItemParent.classList.add('submenu-open');
                    }
                } else {
                    // We're at the top level, show all top-level items
                    resetAllSubmenus();
                }
            }
            
            // Stop event propagation
            e.stopPropagation();
        });
    });

    // Initialize submenu states and mobile menu
    document.querySelectorAll('.sub-menu').forEach(submenu => {
        if (isMobile()) {
            if (!submenu.classList.contains('submenu-open')) {
                submenu.style.display = 'none';
            }
        }
    });
    
    // Set up initial mobile menu state
    const mobileMenu = document.querySelector('.mobile-menu');
    if (mobileMenu) {
        // Add styles for touch scrolling
        mobileMenu.style.webkitOverflowScrolling = 'touch';
        mobileMenu.style.touchAction = 'pan-y';
        mobileMenu.classList.add('overflow-y-auto');
        
        // Fix for iOS touch scrolling
        Array.from(mobileMenu.children).forEach(child => {
            if (child.classList.contains('container') || child.classList.contains('nav-secondary')) {
                child.style.webkitOverflowScrolling = 'touch';
                child.style.touchAction = 'pan-y';
            }
        });
        
        // Special treatment for nav-secondary where most content is
        const navSecondary = mobileMenu.querySelector('.nav-secondary');
        if (navSecondary) {
            navSecondary.style.webkitOverflowScrolling = 'touch';
            navSecondary.style.touchAction = 'pan-y';
            navSecondary.style.overflowY = 'auto';
            navSecondary.style.height = '100%';
            navSecondary.style.flexGrow = '1';
        }
    }

    // Handle window resize
    window.addEventListener('resize', () => {
        if (!isMobile() && isOpen) {
            toggleMenu(false);
        }
    });
    

    
    // Return control methods for external use
    return {
        open: () => toggleMenu(true),
        close: closeMenu,
        toggle: toggleMenu
    };
}