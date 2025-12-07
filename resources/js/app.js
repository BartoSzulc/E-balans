import domReady from '@roots/sage/client/dom-ready';
import Alpine from 'alpinejs';
import { gsap } from 'gsap';
import { ScrollTrigger } from 'gsap/ScrollTrigger';
import { DrawSVGPlugin } from 'gsap/DrawSVGPlugin';
import AOS from 'aos';
import Carousels from './components/Carousels';
import '../../node_modules/preline/preline.js';
// import CustomSelect from './components/CustomSelect.js';
import { initDropdownMenu } from './partials/dropdownMenu.js';
// import PostFilter from './components/PostFilter.js';
// import CaseStudyFilter from './components/CaseStudyFilter.js';
import { initHeaderVisibility } from './partials/stickyMenu.js';
import { initMenu } from './partials/menu.js';
import GLightbox from 'glightbox';
import $ from 'jquery';

import { initializeBudownictwoAnimation } from './components/BudownictwoAnimation.js';
import { initializePathAnimations } from './components/pathAnimation.js';
import { detectSVGPathTypes } from './components/detectSVG.js';
import { initializeScrollAndAOS } from './components/ScrollAndAos.js';
import { initializeFontSizeAndLoader } from './components/updateRootFontSize.js';
import { initVideoToggle } from './utils/videoToggle';
import { initializeOurHistoryAnimation } from './components/GlobalSteps.js';
import {
  createGoogleMap,
  initGoogleMap,
  loadGoogleMapsAPI,
} from './components/googleMap.js';

const images = import.meta.glob(['../images/**', '../fonts/**']);
async function setupMap() {
  try {
    await loadGoogleMapsAPI('AIzaSyD1xapQrIT1MyrUurS1NZ8FuBkWbZA25cs');
    const mapInstance = initGoogleMap({
      containerId: 'map',
      lat: 53.709064,
      lng: 17.573389,
    });
    console.log('Map ready:', mapInstance);
  } catch (error) {
    console.error('Map setup failed:', error);
  }
}
domReady(async () => {
  window.Alpine = Alpine;
  Alpine.start();

  const isMobile = () => window.innerWidth < 1024;
  const isHome = () =>
    document.body.classList.contains('page-template-template-home');
  const isConsulting = () =>
    document.body.classList.contains('page-template-template-consulting');
  const isContact = () =>
    document.body.classList.contains('page-template-template-kontakt');

  // Initialize other components
  // new CustomSelect();
  initDropdownMenu();
  //new PostFilter();
  //new CaseStudyFilter();
  //const numberCounter = new NumberCounter();
  //numberCounter.init();
  //let marqueeImage = new MarqueeImage();
  //marqueeImage.init();
  initHeaderVisibility();

  const lightbox = GLightbox({
    touchNavigation: true,
    loop: true,
    autoplayVideos: true,
    selector: '.glightbox',
  });
  initMenu();
  detectSVGPathTypes();
  initializeScrollAndAOS();
  initializePathAnimations();

  if (isHome()) {
    initVideoToggle();
    initializeBudownictwoAnimation();
  }
  if (isConsulting()) {
    initVideoToggle();
  }

  initializeOurHistoryAnimation();

  const mainElement = document.getElementById('main');
  const customContainer = document.querySelector('.custom-container');

  if (mainElement && customContainer) {
    const setCustomContainerHeight = () => {
      customContainer.style.height = `${mainElement.clientHeight}px`;
    };

    setCustomContainerHeight();
    window.addEventListener('resize', setCustomContainerHeight);
  }

  if (isContact()) {
    setupMap();
  }
});

initializeFontSizeAndLoader();
let carousels = new Carousels();
carousels.init();

const scrollToTopBtn = document.getElementById('scrollToTop');

// function toggleScrollButton() {
//   const isVisible = window.scrollY > 100;

//   if (isVisible) {
//     scrollToTopBtn.classList.add('visible');
//   } else {
//     scrollToTopBtn.classList.remove('visible');
//   }
// }
// function scrollToTop() {
//   window.scrollTo({
//     top: 0,
//     behavior: 'smooth',
//   });
// }

// window.addEventListener('scroll', toggleScrollButton);
// scrollToTopBtn.addEventListener('click', scrollToTop);

// toggleScrollButton();


// $('a[href*="#"]')
// .not('[href="#"]')
// .not('[href="#0"]')
// .click(function (event) {
//   if (
//     location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '')
//     &&
//     location.hostname == this.hostname
//   ) {
//     var target = $(this.hash);
//     target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
//     if (target.length) {pen
//       event.preventDefault();
//       $('html, body').animate({
//         scrollTop: target.offset().top
//       }, 500, function () {
//         var $target = $(target);
//         $target.focus();
//         if ($target.is(":focus")) {
//           return false;
//         } else {
//           $target.attr('tabindex', '-1');
//           $target.focus();
//         };
//       });
//     }
//   }
// });
