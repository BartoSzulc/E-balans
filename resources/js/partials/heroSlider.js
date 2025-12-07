import Swiper from 'swiper';
import { Autoplay, EffectFade, Pagination, Navigation, } from 'swiper/modules';
import { gsap } from 'gsap';


Swiper.use([Pagination, Autoplay, EffectFade, Navigation ]);

export function initHeroSlider() {
  const swiperInstances = [];

    const getScalingFactor = () => {
        const viewportWidth = document.documentElement.clientWidth;
        return viewportWidth >= 1024 ? (viewportWidth / 1920) : (32 / 192);
    };

    // Function to create a responsive pixel value that scales with the viewport
    const responsivePx = (px) => {
        return px * getScalingFactor();
    };
    document.querySelectorAll('.swiperHero').forEach(el => {

        let heroSwiper = new Swiper(el, {

            slidesPerView: 1,
            spaceBetween: 20,
            slidesOffsetAfter: 0,
            slidesOffsetBefore: 0,
            watchSlidesProgress: true,
            loop: true,
            slideToClickedSlide: true,
            speed: 800,
            autoplay: {
                delay: 4000,
                disableOnInteraction: false,
            },
            breakpoints: {
                1024: {
                    slidesPerView: 1,
                    spaceBetween: responsivePx(20),
                },
            },
            on: {
                init: function() {
                    const slideCount = this.slides.length - this.loopedSlides * 2;
                    const navButtons = document.querySelectorAll('.swiperHero__nav');

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
        swiperInstances.push(heroSwiper);

    });

    const nextButtons = document.querySelectorAll('.swiperHero__nav--next');
    const prevButtons = document.querySelectorAll('.swiperHero__nav--prev');

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
