export function initializeReferencjeLoader() {
  const container = document.querySelector('[data-referencje-container]');

  // Only run if we're on a page with referencje container
  if (!container) return;

  const restUrl = '/wp-json/wp/v2/referencje';
  const loadingState = document.querySelector('[data-loading-state]');
  const loadMoreWrapper = document.querySelector('[data-load-more-wrapper]');
  const loadMoreBtn = document.querySelector('.load-more-referencje');

  let allPosts = [];
  let displayedCount = 0;
  const postsPerLoad = 3;

  // Fetch all referencje posts on page load
  console.log('Fetching from:', restUrl);
  fetch(restUrl + '?per_page=100&orderby=date&order=desc')
    .then(response => {
      console.log('Response status:', response.status);
      if (!response.ok) {
        throw new Error('Network response was not ok: ' + response.status);
      }
      return response.json();
    })
    .then(posts => {
      console.log('Posts received:', posts);
      allPosts = posts;
      loadingState.style.display = 'none';

      if (allPosts.length === 0) {
        container.innerHTML = '<p class="text-center">Brak referencji do wyświetlenia.</p>';
        container.style.display = 'block';
        return;
      }

      // Display initial 3 posts
      displayPosts(postsPerLoad);
      container.style.display = 'grid';

      // Show load more button if there are more posts
      if (allPosts.length > postsPerLoad) {
        loadMoreWrapper.style.display = 'block';
      }
    })
    .catch(error => {
      console.error('Error loading referencje:', error);
      loadingState.innerHTML = '<p class="text-red-500">Błąd podczas ładowania referencji: ' + error.message + '</p>';
    });

  // Load more button click handler
  if (loadMoreBtn) {
    loadMoreBtn.addEventListener('click', function() {
      displayPosts(postsPerLoad);

      // Hide button if all posts are displayed
      if (displayedCount >= allPosts.length) {
        loadMoreWrapper.style.display = 'none';
      }
    });
  }

  function displayPosts(count) {
    const postsToShow = allPosts.slice(displayedCount, displayedCount + count);

    postsToShow.forEach((post, index) => {
      const card = createReferencjeCard(post, displayedCount + index);
      container.insertAdjacentHTML('beforeend', card);
    });

    displayedCount += postsToShow.length;

    // Refresh AOS for new elements
    if (typeof AOS !== 'undefined') {
      AOS.refresh();
    }
  }

  function createReferencjeCard(post, index) {
    const pdfUrl = post.acf?.pdf_file?.url || '#';
    const excerpt = post.acf?.excerpt || '';
    const delay = 200 + ((index % 3) * 100);

    return `
      <article data-aos="fade-up" data-aos-delay="${delay}" class="relative z-10 flex flex-col bg-white shadow-special rounded-32 lg:pt-60 lg:pb-32 lg:px-32 p-20 pt-38">
        <div class="absolute top-0 -translate-y-1/2 left-20 lg:left-32 size-36 lg:size-72">
          <svg class="size-full" viewBox="0 0 72 72" fill="none" xmlns="http://www.w3.org/2000/svg">
            <circle cx="36" cy="36" r="36" fill="#E52F3D"/>
            <path d="M47.1124 26.6417L41.0859 20.9404C40.4449 20.3339 39.6059 20 38.7236 20H27.25C25.3546 20 23.8125 21.5421 23.8125 23.4375V48.5625C23.8125 50.4579 25.3546 52 27.25 52H44.75C46.6454 52 48.1875 50.4579 48.1875 48.5625V29.1389C48.1875 28.1983 47.7956 27.2881 47.1124 26.6417ZM45.2913 27.5H40.625C40.4527 27.5 40.3125 27.3598 40.3125 27.1875V22.7898L45.2913 27.5ZM44.75 50.125H27.25C26.3884 50.125 25.6875 49.4241 25.6875 48.5625V23.4375C25.6875 22.5759 26.3884 21.875 27.25 21.875H38.4375V27.1875C38.4375 28.3937 39.4188 29.375 40.625 29.375H46.3125V48.5625C46.3125 49.4241 45.6116 50.125 44.75 50.125Z" fill="white"/>
            <path d="M42.6875 32.5H28.9375C28.4197 32.5 28 32.9197 28 33.4375C28 33.9553 28.4197 34.375 28.9375 34.375H42.6875C43.2052 34.375 43.625 33.9553 43.625 33.4375C43.625 32.9197 43.2052 32.5 42.6875 32.5Z" fill="white"/>
            <path d="M42.6875 37.5H28.9375C28.4197 37.5 28 37.9197 28 38.4375C28 38.9553 28.4197 39.375 28.9375 39.375H42.6875C43.2052 39.375 43.625 38.9553 43.625 38.4375C43.625 37.9197 43.2052 37.5 42.6875 37.5Z" fill="white"/>
            <path d="M33.4825 42.5H28.9375C28.4197 42.5 28 42.9197 28 43.4375C28 43.9553 28.4197 44.375 28.9375 44.375H33.4825C34.0002 44.375 34.42 43.9553 34.42 43.4375C34.42 42.9197 34.0002 42.5 33.4825 42.5Z" fill="white"/>
          </svg>
        </div>
        <div class="flex flex-col gap-16 grow">
          <h3 class="text-h3 text-color-3">${post.title.rendered}</h3>
          ${excerpt ? `<div class="entry-summary">${excerpt}</div>` : ''}
          <a href="${pdfUrl}" target="_blank" rel="noopener noreferrer" class="flex items-center space-x-8 transition-all duration-300 ease-in-out group hover:text-color-2 lg:mt-16">
            <span>Sprawdź</span>
            <svg class="duration-300 size-24 translate-all ease-power1-in group-hover:translate-x-2" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
              <circle cx="12" cy="12" r="12" fill="#E52F3D"/>
              <path d="M16.5 11.134C17.1667 11.5189 17.1667 12.4811 16.5 12.866L10.5 16.3301C9.83333 16.715 9 16.2339 9 15.4641L9 8.5359C9 7.7661 9.83333 7.28497 10.5 7.66987L16.5 11.134Z" fill="white"/>
            </svg>
          </a>
        </div>
      </article>
    `;
  }
}
