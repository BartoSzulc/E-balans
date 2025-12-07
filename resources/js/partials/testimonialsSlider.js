import Swiper from 'swiper';
import { Autoplay, EffectFade, Pagination, Navigation } from 'swiper/modules';
import { gsap } from 'gsap';

Swiper.use([Pagination, Autoplay, EffectFade, Navigation]);

export function initTestimonialSliders() {
    const getScalingFactor = () => {
        const viewportWidth = document.documentElement.clientWidth;
        return viewportWidth >= 1024 ? (viewportWidth / 10) / 192 : 32 / 192;
    };

    const responsivePx = (px) => {
        return px * getScalingFactor();
    };

    // --- Swiper Testimonial 1 (Desktop Left) ---
    const swiperTestimonial1El = document.querySelector('.swiperTestimonial1');
    let swiperTestimonial1;
    if (swiperTestimonial1El) {
        swiperTestimonial1 = new Swiper(swiperTestimonial1El, {
            slidesPerView: 1,
            spaceBetween: 20,
            slidesOffsetAfter: 0,
            slidesOffsetBefore: 0,
            watchSlidesProgress: true,
            loop: true,
            slideToClickedSlide: true,
            speed: 1000,
            effect: 'fade',
            autoHeight: true,
            fadeEffect: {
                crossFade: true,
            },
            breakpoints: {
                1024: {
                    autoHeight: false,
                    slidesPerView: 'auto',
                    spaceBetween: responsivePx(20),
                }
            },
            on: {
                init: function() {
                    const slideCount = this.slides.length;
                    const navButton = document.querySelector('.swiperTestimonial__nav--prev1');

                    if (navButton) {
                        if (slideCount <= 1) {
                            navButton.style.display = 'none';
                        } else {
                            navButton.style.display = '';
                        }
                    }
                }
            }
        });
    }

    // --- Swiper Testimonial Mobile ---
    const swiperTestimonialMobileEl = document.querySelector('.swiperTestimonialMobile');
    let swiperTestimonialMobile;
    if (swiperTestimonialMobileEl) {
        swiperTestimonialMobile = new Swiper(swiperTestimonialMobileEl, {
            slidesPerView: 1,
            spaceBetween: 20,
            slidesOffsetAfter: 0,
            slidesOffsetBefore: 0,
            watchSlidesProgress: true,
            loop: true,
            slideToClickedSlide: true,
            speed: 1000,
            effect: 'fade',
            autoHeight: true,
            fadeEffect: {
                crossFade: true,
            },
            on: {
                init: function() {
                    const slideCount = this.slides.length;
                    const prevButton = document.querySelector('.swiperTestimonial__nav--prev1');
                    const nextButton = document.querySelector('.swiperTestimonial__nav--next1');

                    if (prevButton && nextButton) {
                        if (slideCount <= 1) {
                            prevButton.style.display = 'none';
                            nextButton.style.display = 'none';
                        } else {
                            prevButton.style.display = '';
                            nextButton.style.display = '';
                        }
                    }
                }
            }
        });
    }

    // --- Swiper Testimonial 2 (Desktop Right) ---
    const swiperTestimonial2El = document.querySelector('.swiperTestimonial2');
    let swiperTestimonial2;
    if (swiperTestimonial2El) {
        swiperTestimonial2 = new Swiper(swiperTestimonial2El, {
            slidesPerView: 1,
            spaceBetween: 20,
            slidesOffsetAfter: 0,
            slidesOffsetBefore: 0,
            watchSlidesProgress: true,
            loop: true,
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
                    const navButton = document.querySelector('.swiperTestimonial__nav--next2');

                    if (navButton) {
                        if (slideCount <= 1) {
                            navButton.style.display = 'none';
                        } else {
                            navButton.style.display = '';
                        }
                    }
                }
            }
        });
    }

    // --- Navigation Event Listeners ---
    const prevButton1 = document.querySelector('.swiperTestimonial__nav--prev1');
    if (prevButton1) {
        prevButton1.addEventListener('click', () => {
            // Check screen size and target appropriate slider
            if (window.innerWidth >= 1024) {
                // Desktop - use left slider
                if (swiperTestimonial1) swiperTestimonial1.slidePrev();
            } else {
                // Mobile - use mobile slider
                if (swiperTestimonialMobile) swiperTestimonialMobile.slidePrev();
            }
        });
    }

    const nextButton1 = document.querySelector('.swiperTestimonial__nav--next1');
    if (nextButton1) {
        nextButton1.addEventListener('click', () => {
            // Mobile only button - always use mobile slider
            if (swiperTestimonialMobile) swiperTestimonialMobile.slideNext();
        });
    }

    const nextButton2 = document.querySelector('.swiperTestimonial__nav--next2');
    if (nextButton2) {
        nextButton2.addEventListener('click', () => {
            // Desktop only - use right slider
            if (swiperTestimonial2) swiperTestimonial2.slideNext();
        });
    }
}