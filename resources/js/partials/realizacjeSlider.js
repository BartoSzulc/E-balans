import Swiper from 'swiper';
import { Autoplay, EffectFade, Pagination, Navigation } from 'swiper/modules';
import { gsap } from 'gsap';

Swiper.use([Pagination, Autoplay, EffectFade, Navigation]);

export function initRealizacjeSlider() {
  const swiperInstances = [];

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

  document.querySelectorAll('.swiperRealizacje').forEach(el => {
    let Realizacjeswiper = new Swiper(el, {
      slidesPerView: 1,
      spaceBetween: 15, // Default for mobile if not overridden by breakpoints
      slidesOffsetAfter: 0,
      slidesOffsetBefore: 0,
      watchSlidesProgress: true,
      loop: false,
      slideToClickedSlide: true,
      speed: 1000,
      breakpoints: {
        1024: {
          slidesPerView: 'auto',
          // Apply responsivePx to spaceBetween for desktop
          spaceBetween: responsivePx(20), // 20 here is your base value that will be scaled
        }
      },
      on: {
        init: function() {
          const slideCount = this.slides.length - this.loopedSlides * 2;
          const navButtons = document.querySelectorAll('.swiperRealizacje__nav');

          if (slideCount < 0) {
            navButtons.forEach(button => {
              button.style.display = 'none';
            });
          } else {
            navButtons.forEach(button => {
              button.style.display = '';
            });
          }
        }
      }
    });
    swiperInstances.push(Realizacjeswiper);
  });

  const nextButtons = document.querySelectorAll('.swiperRealizacje__nav--next');
  const prevButtons = document.querySelectorAll('.swiperRealizacje__nav--prev');

  if (nextButtons.length) {
    nextButtons.forEach(button => {
      button.addEventListener('click', () => {
        swiperInstances.forEach(swiper => {
          swiper.slideNext();
        });
      });
    });
  }
  if (prevButtons.length) {
    prevButtons.forEach(button => {
      button.addEventListener('click', () => {
        swiperInstances.forEach(swiper => {
          swiper.slidePrev();
        });
      });
    });
  }
}