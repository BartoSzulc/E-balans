import Swiper from 'swiper';
import { Autoplay, EffectFade, Pagination, Navigation } from 'swiper/modules';

Swiper.use([Pagination, Autoplay, EffectFade, Navigation]);

export function initOpinieSlider() {
  const swiperInstances = [];

  const getScalingFactor = () => {
    const viewportWidth = document.documentElement.clientWidth;
    return viewportWidth >= 1024 ? (viewportWidth / 10) / 192 : 32 / 192;
  };

  const responsivePx = (px) => {
    return px * getScalingFactor();
  };

  document.querySelectorAll('.swiperOpinie').forEach(el => {
    let Opinieswiper = new Swiper(el, {
      slidesPerView: 1,
      spaceBetween: 15,
      slidesOffsetAfter: 0,
      slidesOffsetBefore: 0,
      watchSlidesProgress: true,
      loop: false,
      slideToClickedSlide: true,
      speed: 1000,
      effect: 'fade',
      fadeEffect: {
        crossFade: true,
      },
      breakpoints: {
        1024: {
          slidesPerView: 'auto',
          spaceBetween: responsivePx(20),
        }
      },
      on: {
        init: function() {
          const slideCount = this.slides.length;
          const navButtons = document.querySelectorAll('.swiperOpinie__nav');

          if (slideCount <= 1) {
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
    swiperInstances.push(Opinieswiper);
  });

  const nextButtons = document.querySelectorAll('.swiperOpinie__nav--next');
  const prevButtons = document.querySelectorAll('.swiperOpinie__nav--prev');

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
