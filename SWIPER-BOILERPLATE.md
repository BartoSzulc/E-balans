# Swiper Boilerplate

This document provides a reusable boilerplate for creating new Swiper carousels in the project.

## Quick Setup Guide

### 1. Blade Template Structure

```blade
@php
    $section_data = get_field('section_name');
@endphp

{{-- Section Name --}}
<section class="sectionNameHome">
    {{-- Your content and fields here --}}

    <div class="swiper swiperSectionName">
        <div class="swiper-wrapper">
            @if(isset($section_data['repeater_field']) && is_array($section_data['repeater_field']))
                @foreach($section_data['repeater_field'] as $index => $item)
                    <div class="swiper-slide">
                        {{-- Slide content here --}}
                    </div>
                @endforeach
            @endif
        </div>
    </div>

    {{-- Navigation Buttons (in comments - uncomment when styling) --}}
    {{-- <button class="swiperSectionName__nav swiperSectionName__nav--prev">Prev</button> --}}
    {{-- <button class="swiperSectionName__nav swiperSectionName__nav--next">Next</button> --}}
</section>
```

### 2. JavaScript Slider File

Create `resources/js/partials/sectionNameSlider.js`:

```javascript
import Swiper from 'swiper';
import { Autoplay, EffectFade, Pagination, Navigation } from 'swiper/modules';

Swiper.use([Pagination, Autoplay, EffectFade, Navigation]);

export function initSectionNameSlider() {
  const swiperInstances = [];

  // Responsive scaling function
  const getScalingFactor = () => {
    const viewportWidth = document.documentElement.clientWidth;
    return viewportWidth >= 1024 ? (viewportWidth / 10) / 192 : 32 / 192;
  };

  const responsivePx = (px) => {
    return px * getScalingFactor();
  };

  // Initialize all sliders with this class
  document.querySelectorAll('.swiperSectionName').forEach(el => {
    let SectionNameswiper = new Swiper(el, {
      slidesPerView: 1,
      spaceBetween: 15,
      slidesOffsetAfter: 0,
      slidesOffsetBefore: 0,
      watchSlidesProgress: true,
      loop: false,
      slideToClickedSlide: true,
      speed: 1000,

      // Optional: Add fade effect
      // effect: 'fade',
      // fadeEffect: {
      //   crossFade: true,
      // },

      breakpoints: {
        1024: {
          slidesPerView: 'auto',
          spaceBetween: responsivePx(20),
        }
      },
      on: {
        init: function() {
          const slideCount = this.slides.length;
          const navButtons = document.querySelectorAll('.swiperSectionName__nav');

          // Hide navigation if only 1 slide
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
    swiperInstances.push(SectionNameswiper);
  });

  // Navigation button event listeners
  const nextButtons = document.querySelectorAll('.swiperSectionName__nav--next');
  const prevButtons = document.querySelectorAll('.swiperSectionName__nav--prev');

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
```

### 3. Register in Carousels.js

Edit `resources/js/components/Carousels.js`:

```javascript
// 1. Import the slider
import { initSectionNameSlider } from '../partials/sectionNameSlider.js';

export default class Carousels extends Component {
    constructor() {
      super();
      // 2. Add check for section existence
      this.SectionNameSlider = document.querySelector('.sectionNameHome') !== null;
    }

    init() {
        // 3. Initialize if section exists
        if (this.SectionNameSlider) {
          initSectionNameSlider();
        }
    }
}
```

## Naming Convention

Follow this pattern for consistency:

| Component | Pattern | Example |
|-----------|---------|---------|
| Section class | `sectionNameHome` | `opinieHome`, `zobaczJakHome` |
| Swiper class | `swiperSectionName` | `swiperOpinie`, `swiperZobaczJak` |
| Nav class | `swiperSectionName__nav` | `swiperOpinie__nav` |
| Prev button | `swiperSectionName__nav--prev` | `swiperOpinie__nav--prev` |
| Next button | `swiperSectionName__nav--next` | `swiperOpinie__nav--next` |
| JS file | `sectionNameSlider.js` | `opinieSlider.js` |
| Function | `initSectionNameSlider()` | `initOpinieSlider()` |

## Common Configuration Options

### Basic Slider
```javascript
{
  slidesPerView: 1,
  spaceBetween: 15,
  loop: false,
  speed: 1000,
}
```

### Fade Effect
```javascript
{
  effect: 'fade',
  fadeEffect: {
    crossFade: true,
  },
}
```

### Auto Height
```javascript
{
  autoHeight: true,
}
```

### Autoplay
```javascript
{
  autoplay: {
    delay: 3000,
    disableOnInteraction: false,
  },
}
```

### Responsive Breakpoints
```javascript
breakpoints: {
  1024: {
    slidesPerView: 'auto',
    spaceBetween: responsivePx(20),
  }
}
```

## Examples

### Simple Slider (Opinie)
- Effect: fade
- 1 slide per view
- No loop
- Responsive spacing

### Gallery Slider (Zobacz Jak)
- No fade effect
- Auto slides per view
- Responsive spacing
- Multiple instances support

## Notes

- Always use `responsivePx()` for desktop spacing to maintain fluid design
- Hide navigation buttons when only 1 slide exists
- Support multiple instances on the same page with `querySelectorAll`
- Keep navigation buttons in comments until styling is complete
