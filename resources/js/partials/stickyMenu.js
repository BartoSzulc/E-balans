export function initHeaderVisibility() {
  const mainHeader = document.querySelector('.main-header');
  const stickyHeader = document.querySelector('.main-header--sticky');
  
  if (!mainHeader || !stickyHeader) return;

  const mainHeaderHeight = mainHeader.offsetHeight;
  let lastScrollY = window.scrollY;

  function handleStickyHeaderVisibility() {
    const currentScrollY = window.scrollY;
    
    // Check if pagination scrolling is in progress
    const isPaginationScrolling = stickyHeader.hasAttribute('data-pagination-scrolling');
    
    // If pagination scrolling is happening, keep the header hidden and exit
    if (isPaginationScrolling) {
      stickyHeader.classList.remove('translate-y-0', 'opacity-100', 'pointer-events-auto');
      stickyHeader.classList.add('-translate-y-full', 'opacity-0', 'pointer-events-none');
      return;
    }

    // Only apply header visibility logic when scrolled past the main header height
    if (currentScrollY <= mainHeaderHeight) {
      // At the top of the page, ensure sticky header is hidden
      stickyHeader.classList.remove('translate-y-0', 'opacity-100', 'pointer-events-auto');
      stickyHeader.classList.add('-translate-y-full', 'opacity-0', 'pointer-events-none');
      return;
    }

    // Determine scroll direction
    const isScrollingDown = currentScrollY > lastScrollY;

    if (isScrollingDown) {
      // When scrolling down, hide the header
      stickyHeader.classList.remove('translate-y-0', 'opacity-100', 'pointer-events-auto');
      stickyHeader.classList.add('-translate-y-full', 'opacity-0', 'pointer-events-none');
    } else {
      // When scrolling up, show the header
      stickyHeader.classList.remove('-translate-y-full', 'opacity-0', 'pointer-events-none');
      stickyHeader.classList.add('translate-y-0', 'opacity-100', 'pointer-events-auto');
    }

    lastScrollY = currentScrollY;
  }

  window.addEventListener('scroll', handleStickyHeaderVisibility);
  
  // Initial call to set correct state
  handleStickyHeaderVisibility();
}