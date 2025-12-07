import Lenis from 'lenis';

class CaseStudyFilter {
  constructor() {
    // DOM elements
    this.$tematykaButtons = document.querySelectorAll('.tematyka-filter-btn');
    this.$tematykaButtonsContainer = document.getElementById('tematyka-filter-container');
    this.$caseStudyGrid = document.getElementById('case-study-grid');
    this.$paginationContainer = document.getElementById('pagination-container');
    this.$loadingIndicator = document.getElementById('loading-indicator');
    this.$noResultsMessage = document.getElementById('no-results-message');
    this.$mainDiv = document.getElementById('main-div');
    this.$stickyHeader = document.querySelector('.main-header--sticky');
    
    // State
    this.currentPage = 1;
    this.currentTematyka = '';
    this.isLoading = false;
    this.initialLoadComplete = false;
    
    // Mobile detection
    this.isMobile = () => window.innerWidth < 1024;
    
    // AJAX data
    this.ajaxUrl = window.case_study_filter_ajax?.ajax_url || '';
    this.nonce = window.case_study_filter_ajax?.nonce || '';
    
    // Only initialize if elements exist and AJAX URL is available
    if (this.$tematykaButtonsContainer && this.$caseStudyGrid && this.ajaxUrl) {
      this.init();
    } else {
      //console.warn('Case study filter: Missing required elements or AJAX URL');
    }
  }
  
  init() {
    this.bindEvents();
    
    // Find active tematyka button and set initial state
    const activeButton = document.querySelector('.tematyka-filter-btn.active');
    if (activeButton) {
      this.currentTematyka = activeButton.dataset.tematyka;
    } else if (this.$tematykaButtons.length > 0) {
      // Set first tematyka as default if none is active
      const firstButton = this.$tematykaButtons[0];
      this.currentTematyka = firstButton.dataset.tematyka;
      // Add active class to first button
      this.setActiveButton(firstButton);
    }
    
    // Get page from URL if present
    const urlParams = new URLSearchParams(window.location.search);
    const pageParam = urlParams.get('strona');
    if (pageParam) {
      this.currentPage = parseInt(pageParam) || 1;
    }
    
    // Load case studies on page load
    this.loadCaseStudies();
  }
  
  setActiveButton(activeButton) {
    // Remove active class from all buttons
    this.$tematykaButtons.forEach(button => {
      button.classList.remove('active', 'text-color-2');
      button.classList.add('text-color-1');
    });
    
    // Add active class to the selected button
    activeButton.classList.add('active', 'text-color-2');
    activeButton.classList.remove('text-color-1');
  }
  
  bindEvents() {
    // Handle tematyka button clicks
    if (this.$tematykaButtons) {
      this.$tematykaButtons.forEach(button => {
        button.addEventListener('click', (e) => {
          e.preventDefault();
          
          // Skip if already selected
          if (this.currentTematyka === button.dataset.tematyka) return;

          // Update active button styling
          this.setActiveButton(button);

          // Update state
          this.currentTematyka = button.dataset.tematyka;
          this.currentPage = 1;
          
          // Show loading state but without the indicator after initial load
          this.showLoadingState(false);
          
          // Update URL without page parameter when changing tematyka
          this.updateUrlWithoutRefresh(this.currentTematyka, null);
          
          this.loadCaseStudies();
          
          // Hide sticky header before scrolling to top
          this.hideStickyHeader();
          this.scrollToTop();
        });
      });
    }
    
    // Custom pagination click handler
    document.addEventListener('click', (e) => {
      // Check if clicked element is a page link (using event delegation)
      const pageLink = e.target.closest('.page-link');
      if (pageLink && !pageLink.closest('.active')) {
        e.preventDefault();
        
        // Get the href attribute
        const href = pageLink.getAttribute('href');
        if (!href) return;
        
        // Try to extract the page number from the URL
        let page = 1;
        
        // Look for /strona/X/ or ?strona=X patterns
        const stranaMatch = href.match(/strona\/(\d+)/) || href.match(/strona=(\d+)/);
        if (stranaMatch && stranaMatch[1]) {
          page = parseInt(stranaMatch[1]);
        } else if (href.indexOf('page/') > -1) {
          // Handle /page/X/ pattern
          const pageMatch = href.match(/page\/(\d+)/);
          if (pageMatch && pageMatch[1]) {
            page = parseInt(pageMatch[1]);
          }
        } else if (pageLink.dataset.page) {
          // Try to get page from data attribute
          page = parseInt(pageLink.dataset.page) || 1;
        }
        
        if (page !== this.currentPage) {
          // Update current page
          this.currentPage = page;
          
          // Show loading state but without the indicator after initial load
          this.showLoadingState(false);
          
          // Update URL with the new page
          this.updateUrlWithoutRefresh(this.currentTematyka, page);
          
          // Hide sticky header before scrolling to top
          this.hideStickyHeader();
          
          // Scroll to top of case studies section
          this.scrollToTop();
          
          // Load case studies for the new page
          this.loadCaseStudies();
        }
      }
    });
    
    // Handle popstate for browser back/forward navigation
    window.addEventListener('popstate', (e) => {
      // Get state from URL parameters
      const urlParams = new URLSearchParams(window.location.search);
      const tematyka = urlParams.get('tematyka') || 'all';
      const page = parseInt(urlParams.get('strona')) || 1;
      
      // Only refresh if something changed
      if (tematyka !== this.currentTematyka || page !== this.currentPage) {
        // Update state variables
        this.currentTematyka = tematyka;
        this.currentPage = page;
        
        // Update tematyka buttons UI using the active button setter
        this.$tematykaButtons.forEach(btn => {
          if (btn.dataset.tematyka === tematyka) {
            this.setActiveButton(btn);
          }
        });
        
        // Show loading state but without the indicator after initial load
        this.showLoadingState(false);
        
        // Load case studies for the new state
        this.loadCaseStudies();
      }
    });
  }
  
  // Helper to update URL without page refresh
  updateUrlWithoutRefresh(tematyka, page) {
    const url = new URL(window.location);
    
    // Update tematyka in URL if it exists and isn't 'all'
    if (tematyka && tematyka !== 'all') {
      url.searchParams.set('tematyka', tematyka);
    } else {
      url.searchParams.delete('tematyka');
    }
    
    // Update page in URL if it exists and is greater than 1
    if (page && page > 1) {
      url.searchParams.set('strona', page);
    } else {
      url.searchParams.delete('strona');
    }
    
    // Replace current URL without reloading page
    window.history.pushState({}, '', url);
  }
  
  // Scroll to top with Lenis on desktop, native on mobile
  scrollToTop() {
    if (!this.isMobile()) {
      // Create a new Lenis instance
      const lenis = new Lenis({
        lerp: 0.1,
        wheelMultiplier: 1,
        smoothWheel: true,
        smoothTouch: false
      });
      
      // Start the Lenis animation loop
      function raf(time) {
        lenis.raf(time);
        requestAnimationFrame(raf);
      }
      requestAnimationFrame(raf);
      
      // Calculate the scroll position - use window.pageYOffset for better cross-browser support
      const offset = this.$mainDiv.getBoundingClientRect().top + window.pageYOffset;
      
      // Use scrollTo with a specific target position
      lenis.scrollTo(offset, {
        duration: 0.8,
        lock: true,
        immediate: false,
        easing: (t) => Math.min(1, 1.001 - Math.pow(2, -10 * t)) // Exponential ease-out
      });
      
      // Clean up after animation completes
      setTimeout(() => {
        lenis.destroy();
      }, 1000);
    } else {
      // Use native scrolling on mobile
      window.scrollTo({
        top: this.$mainDiv.offsetTop,
        behavior: 'smooth'
      });
    }
  }
  
  // Hide sticky header when navigating
  hideStickyHeader() {
    if (this.$stickyHeader) {
      // Force hide the sticky header
      this.$stickyHeader.classList.remove('translate-y-0', 'opacity-100', 'pointer-events-auto');
      this.$stickyHeader.classList.add('-translate-y-full', 'opacity-0', 'pointer-events-none');
      
      // Add a data attribute to prevent the header from appearing during scroll
      this.$stickyHeader.setAttribute('data-pagination-scrolling', 'true');
      
      // Remove the data attribute after scrolling is complete (roughly 500ms for smooth scrolling)
      setTimeout(() => {
        this.$stickyHeader.removeAttribute('data-pagination-scrolling');
      }, 800); // Slightly longer than typical smooth scroll duration
    }
  }
  
  // Show loading state - optionally show or hide the loading indicator
  showLoadingState(showIndicator = true) {
    // Only show the loading indicator on first load
    if (showIndicator && !this.initialLoadComplete) {
      if (this.$loadingIndicator) {
        this.$loadingIndicator.style.display = 'block';
      }
    } else {
      if (this.$loadingIndicator) {
        this.$loadingIndicator.style.display = 'none';
      }
    }
    
    // Hide case studies during loading
    if (this.$caseStudyGrid) {
      this.$caseStudyGrid.style.opacity = '0.5';
      this.$caseStudyGrid.style.pointerEvents = 'none';
    }
    
    // Hide pagination during loading
    if (this.$paginationContainer) {
      this.$paginationContainer.style.opacity = '0.5';
      this.$paginationContainer.style.pointerEvents = 'none';
    }
    
    // Hide no results message
    if (this.$noResultsMessage) {
      this.$noResultsMessage.classList.add('hidden');
    }
  }
  
  // Hide loading state
  hideLoadingState() {
    // Mark initial load as complete
    this.initialLoadComplete = true;
    
    // Hide loading indicator
    if (this.$loadingIndicator) {
      this.$loadingIndicator.style.display = 'none';
    }
    
    // Show case studies after loading
    if (this.$caseStudyGrid) {
      this.$caseStudyGrid.style.opacity = '1';
      this.$caseStudyGrid.style.pointerEvents = 'auto';
    }
    
    // Show pagination after loading
    if (this.$paginationContainer) {
      this.$paginationContainer.style.opacity = '1';
      this.$paginationContainer.style.pointerEvents = 'auto';
    }
  }
  
  loadCaseStudies() {
    if (this.isLoading || !this.ajaxUrl) return;
    
    this.isLoading = true;
    
    // Show loading state
    this.showLoadingState(!this.initialLoadComplete);
    
    // Build form data for the AJAX request
    const formData = new FormData();
    formData.append('action', 'load_case_studies');
    formData.append('nonce', this.nonce);
    formData.append('tematyka', this.currentTematyka);
    formData.append('paged', this.currentPage);
    formData.append('posts_per_page', 4)
    
    fetch(this.ajaxUrl, {
      method: 'POST',
      credentials: 'same-origin',
      body: formData,
    })
      .then(response => {
        // Check if the response is OK first
        if (!response.ok) {
          throw new Error(`HTTP error! Status: ${response.status}`);
        }
        
        // Check if the content type is json
        const contentType = response.headers.get('content-type');
        if (!contentType || !contentType.includes('application/json')) {
          throw new Error(`Expected JSON response but received ${contentType}`);
        }
        
        return response.json();
      })
      .then(response => {
        this.isLoading = false;
        
        // Check if response has success property
        if (!response.success) {
          this.handleError();
          return;
        }
        
        // Update case studies content
        if (this.$caseStudyGrid) {
          this.$caseStudyGrid.innerHTML = response.html;
        }
        
        // Update pagination
        if (this.$paginationContainer) {
          this.$paginationContainer.innerHTML = response.pagination;
        }
        
        // Show the content after loading
        this.hideLoadingState();
        
        // Handle empty results
        if (this.$noResultsMessage) {
          if (response.found_posts === 0) {
            this.$noResultsMessage.classList.remove('hidden');
          } else {
            this.$noResultsMessage.classList.add('hidden');
          }
        }
        
        // Reinitialize AOS for new elements
        if (typeof AOS !== 'undefined') {
          AOS.refresh();
        }
      })
      .catch(error => {
        console.error('Error loading case studies:', error);
        this.handleError();
      });
  }
  
  handleError() {
    this.isLoading = false;
    
    // Hide loading indicator
    if (this.$loadingIndicator) {
      this.$loadingIndicator.style.display = 'none';
    }
    
    // Restore case study grid visual state
    if (this.$caseStudyGrid) {
      this.$caseStudyGrid.style.opacity = '1';
      this.$caseStudyGrid.style.pointerEvents = 'auto';
      this.$caseStudyGrid.innerHTML = `
        <div class="col-span-full text-center text-color-1">
          <p>Wystąpił błąd podczas ładowania case studies. Spróbuj ponownie.</p>
        </div>
      `;
    }
    
    // Restore pagination visual state but clear content
    if (this.$paginationContainer) {
      this.$paginationContainer.style.opacity = '1';
      this.$paginationContainer.style.pointerEvents = 'auto';
      this.$paginationContainer.innerHTML = '';
    }
  }
}

export default CaseStudyFilter;