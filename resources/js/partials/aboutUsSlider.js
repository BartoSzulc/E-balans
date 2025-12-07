import Swiper from 'swiper';
import { Autoplay, EffectFade, Pagination, Navigation } from 'swiper/modules';
import { gsap } from 'gsap';

Swiper.use([Pagination, Autoplay, EffectFade, Navigation]);

export function initAboutUsSlider() {
  const swiperInstances = new Map(); // Use Map to store instances by gallery ID

  // Updated getScalingFactor based on your desired responsive behavior
  const getScalingFactor = () => {
    const viewportWidth = document.documentElement.clientWidth;
    
    return viewportWidth >= 1024 ? (viewportWidth / 10) / 192 : 32 / 192;
  };

  const responsivePx = (px) => {
      // The 'px' value will be scaled by getScalingFactor().
      // For example, if getScalingFactor is 32/192, and px is 20,
      // the result will be 20 * (32/192)
      return px * getScalingFactor();
  };

  document.querySelectorAll('.swiperAbout').forEach((el) => {
    const galleryId = el.dataset.gallery;
    
    // Find navigation buttons for this specific gallery
    const nextButton = document.querySelector(`.swiperAbout__nav--next[data-gallery="${galleryId}"]`);
    const prevButton = document.querySelector(`.swiperAbout__nav--prev[data-gallery="${galleryId}"]`);

    let GallerySwiper = new Swiper(el, {
      slidesPerView: 1,
      spaceBetween: 15, // Default for mobile if not overridden by breakpoints
      slidesOffsetAfter: 0,
      slidesOffsetBefore: 0,
      watchSlidesProgress: true,
      loop: true,
      slideToClickedSlide: true,
      speed: 1000,
      // Use Swiper's built-in navigation if buttons are available
      navigation: {
        nextEl: nextButton,
        prevEl: prevButton,
      },
      breakpoints: {
        1024: {
          slidesPerView: 1,
          spaceBetween: responsivePx(15), // 20 here is your base value that will be scaled
        }
      },
      on: {
        init: function() {
          const slideCount = this.slides.length;
          
          // Hide navigation buttons for this specific slider if not enough slides
          if (slideCount <= 1) {
            if (nextButton) nextButton.style.display = 'none';
            if (prevButton) prevButton.style.display = 'none';
          } else {
            if (nextButton) nextButton.style.display = '';
            if (prevButton) prevButton.style.display = '';
          }
        }
      }
    });
    
    // Store the instance with its gallery ID
    if (galleryId) {
      swiperInstances.set(galleryId, GallerySwiper);
    }
  });

  return swiperInstances; // Return Map of instances by gallery ID
}