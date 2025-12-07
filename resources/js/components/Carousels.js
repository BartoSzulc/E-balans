import Component from "./Component";


import { initTestimonialSliders } from '../partials/testimonialsSlider.js';
import { initRealizacjeSlider } from '../partials/realizacjeSlider.js';
import { initGallerySlider } from '../partials/galeriaSlider.js';
import { initAboutUsSlider } from '../partials/aboutUsSlider.js';
import { initPartnersSlider } from '../partials/partnersSlider.js';
import { initCertyfikatySlider } from '../partials/certyfikatySlider.js';
import { initHeroSlider } from '../partials/heroSlider.js';
import { initOpinieSlider } from '../partials/opinieSlider.js';
import { initZobaczJakSlider } from '../partials/zobaczJakSlider.js';

export default class Carousels extends Component {

    constructor() {
      super();
      this.TestimonialsSliders = document.querySelector('.testimonialsHome') !== null;
      this.RealizacjeSlider = document.querySelector('.realizacjeHome') !== null;
      this.GallerySlider = document.querySelector('.galleryOnas') !== null;
      this.AboutUsSlider = document.querySelector('.aboutUsSlider') !== null;
      this.PartnersSlider = document.querySelector('.swiperPartners') !== null;
      this.CertyfikatySlider = document.querySelector('.swiperCertyfikaty') !== null;
      this.HeroSlider = document.querySelector('.swiperHero') !== null;
      this.OpinieSlider = document.querySelector('.opinieHome') !== null;
      this.ZobaczJakSlider = document.querySelector('.zobaczJakHome') !== null;
    }
    init() {

        if (this.TestimonialsSliders) {
          initTestimonialSliders();
        }
        if (this.RealizacjeSlider) {
          initRealizacjeSlider();
        }
        if (this.GallerySlider) {
          initGallerySlider();
        }
        if (this.AboutUsSlider) {
          initAboutUsSlider();
        }
        if (this.PartnersSlider) {
          initPartnersSlider();
        }
        if (this.CertyfikatySlider) {
          initCertyfikatySlider();
        }
        if (this.HeroSlider) {
          initHeroSlider();
        }
        if (this.OpinieSlider) {
          initOpinieSlider();
        }
        if (this.ZobaczJakSlider) {
          initZobaczJakSlider();
        }

    }

}