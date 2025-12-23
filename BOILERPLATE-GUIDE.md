# 📘 Complete Boilerplate Guide

> A comprehensive guide for creating new projects based on the Quartz WordPress theme boilerplate.

This document provides detailed patterns, examples, and best practices for working with this boilerplate. It complements the main [BOILERPLATE-README.md](./BOILERPLATE-README.md) with practical implementation details.

---

## Table of Contents

1. [Design System Overview](#design-system-overview)
2. [Tailwind Configuration](#tailwind-configuration)
3. [ACF Patterns & Examples](#acf-patterns--examples)
4. [Blade Templates Structure](#blade-templates-structure)
5. [JavaScript Architecture](#javascript-architecture)
6. [Common Patterns](#common-patterns)
7. [Real Examples from Project](#real-examples-from-project)

---

## Design System Overview

### Color System

All colors are defined in `resources/css/abstracts/_variables.scss` using the `@theme` directive:

```scss
@theme {
  /* Primary Colors */
  --color-color-1: #0F529E;      /* Primary Blue */
  --color-color-2: #E52F3D;      /* Secondary Cyan */
  --color-color-3: #124797;      /* Dark Navy */
  --color-color-4: #CFDCEC;      /* Light Gray Blue */
  --color-color-5: #71849A;      /* Medium Gray */
  --color-orange: #FF8B00;       /* Accent Orange */
  --color-blue: #283250;         /* Dark Blue */

  /* Contrast Variants */
  --color-contrast-color-1: #124797;
  --color-contrast-color-2: #0F529E;
}
```

**Usage in HTML/Blade:**

```html
<!-- Background colors -->
<div class="bg-color-1">Primary blue background</div>
<div class="bg-color-2">Cyan background</div>
<div class="bg-color-2/10">Cyan with 10% opacity</div>

<!-- Text colors -->
<h1 class="text-color-1">Primary blue text</h1>
<p class="text-color-5">Medium gray text</p>

<!-- Border colors -->
<div class="border border-color-4">Light border</div>
```

**How to customize for a new project:**

1. Open `resources/css/abstracts/_variables.scss`
2. Change hex values in the `@theme` block
3. Keep the same variable names for consistency
4. Run `npm run build` to regenerate CSS

---

### Typography System

Complete typography scale with size, line-height, and weight:

```scss
@theme {
  /* Headings */
  --text-h1: #{px-rem(72, 192)};           /* 72px at 1920px viewport */
  --text-h1--line-height: #{px-rem(80, 192)};
  --text-h1--font-weight: 800;

  --text-h2: #{px-rem(54, 192)};           /* 54px at 1920px viewport */
  --text-h2--line-height: #{px-rem(62, 192)};
  --text-h2--font-weight: 800;

  --text-h3: #{px-rem(38, 192)};           /* 38px at 1920px viewport */
  --text-h3--line-height: #{px-rem(44, 192)};
  --text-h3--font-weight: 700;

  /* Body Text */
  --text-16: #{px-rem(16, 192)};
  --text-16--line-height: #{px-rem(30, 192)};

  --text-18: #{px-rem(18, 192)};
  --text-18--line-height: #{px-rem(30, 192)};

  /* Component Styles */
  --text-button: #{px-rem(13, 192)};
  --text-button--line-height: #{px-rem(24, 192)};
  --text-button--font-weight: 800;
  --text-button--letter-spacing: 0.1em;

  --text-menu: #{px-rem(16, 192)};
  --text-menu--line-height: #{px-rem(24, 192)};
  --text-menu--font-weight: 700;
}
```

**Usage:**

```html
<!-- Headings -->
<h1 class="text-h1">Main Heading</h1>
<h2 class="text-h2">Subheading</h2>
<h3 class="text-h3">Section Heading</h3>

<!-- Body text -->
<p class="text-16">Regular paragraph text</p>
<p class="text-18">Larger paragraph text</p>

<!-- Buttons -->
<button class="text-button">Button Text</button>

<!-- Menu items -->
<a class="text-menu">Menu Link</a>
```

**Mobile Responsive:**

All typography automatically recalculates for mobile (max-width: 1023px):

```scss
@media (max-width: 1023px) {
  :root {
    --text-h1: #{px-rem(56, 32)};        /* Smaller on mobile */
    --text-h1--line-height: #{px-rem(64, 32)};
    /* ... etc */
  }
}
```

---

### Border Radius Scale

```scss
@theme {
  --radius-80: #{px-rem(80, 192)};  /* Large radius */
  --radius-40: #{px-rem(40, 192)};  /* Medium radius */
  --radius-20: #{px-rem(20, 192)};  /* Small radius */
  --radius-16: #{px-rem(16, 192)};
  --radius-12: #{px-rem(12, 192)};
  --radius-10: #{px-rem(10, 192)};
  --radius-8: 0.04167rem;
  --radius-6: 0.03125rem;
  --radius-4: 0.02083rem;
}
```

**Usage:**

```html
<div class="rounded-40">Medium rounded corners</div>
<div class="rounded-t-80">Large top rounded corners</div>
<div class="rounded-bl-20">Small bottom-left rounded corner</div>

<!-- Individual corners -->
<div class="rounded-tl-20 lg:rounded-tl-80">Responsive corner radius</div>
```

---

### Font System

**Primary Font:** Plus Jakarta Sans (5 weights: 400, 500, 600, 700, 800)
**Secondary Font:** Poiret One (1 weight: 400)

Fonts are self-hosted in `resources/fonts/` for performance and GDPR compliance.

**Font face declarations** (`resources/css/components/_fonts.scss`):

```scss
@font-face {
  font-display: swap;
  font-family: 'Plus Jakarta Sans';
  font-style: normal;
  font-weight: 400;
  src: url('../fonts/plus-jakarta-sans-v12-latin_latin-ext-regular.woff2') format('woff2');
}
```

**Usage:**

```html
<div class="font-primary">Text in Plus Jakarta Sans</div>
<div class="font-secondary">Text in Poiret One</div>

<!-- With specific weights -->
<p class="font-bold font-primary">Bold text</p>
<h1 class="font-extrabold font-primary">Extra bold heading</h1>
```

**How to add new fonts:**

1. Download `.woff2` files from [google-webfonts-helper](https://gwfh.mranftl.com/fonts)
2. Place files in `resources/fonts/`
3. Add `@font-face` declarations in `resources/css/components/_fonts.scss`:

```scss
@font-face {
  font-display: swap;
  font-family: 'Your Font Name';
  font-style: normal;
  font-weight: 400;
  src: url('../fonts/your-font-file.woff2') format('woff2');
}
```

4. Update font variables in `resources/css/abstracts/_variables.scss`:

```scss
@theme {
  --font-primary: 'Your Font Name', sans-serif;
  --font-secondary: 'Another Font', serif;
}
```

5. Run `npm run build`

---

## Tailwind Configuration

### Content Paths

**File:** `tailwind.config.js`

```javascript
content: [
  './app/**/*.php',                // ACF fields, Blocks, PHP classes
  './resources/**/*.{php,vue,js}'  // Blade templates, Vue components, JS files
],
```

These paths tell Tailwind which files to scan for class names.

### Arbitrary Value Shortcuts

The config includes custom shortcuts for fluid pixel values:

```javascript
arbitrary: {
  width: {
    px: (value) => `calc(var(--pixel-to-rem) * ${value})`,
  },
  height: {
    px: (value) => `calc(var(--pixel-to-rem) * ${value})`,
  },
}
```

**Usage:**

```html
<div class="w-px-[100]">Width: 100px (fluid)</div>
<div class="h-px-[200]">Height: 200px (fluid)</div>
<div class="mt-px-[32]">Margin-top: 32px (fluid)</div>
```

---

## ACF Patterns & Examples

### Basic Field Group Structure

**Location:** `app/Fields/`

```php
<?php

namespace App\Fields;

use Log1x\AcfComposer\Builder;
use Log1x\AcfComposer\Field;

class YourPage extends Field
{
    /**
     * The field group name
     */
    public string $name = 'Your Page Fields';

    /**
     * Build the field group
     */
    public function fields(): array
    {
        $fields = Builder::make("your_page");

        // Set where this field group appears
        $fields->setLocation('page_template', '==', 'template-your-page.blade.php');

        // Build your fields here
        $fields
            ->addTab("section_name", [
                "label" => "Section Name",
            ])
            ->addGroup("section_name", [
                "label" => "Section Configuration",
            ])
                ->addText("section_id", [
                    "label" => "Section ID",
                    "instructions" => "HTML ID for this section (e.g., hero, about)",
                    "default_value" => "section-name",
                ])
                ->addWysiwyg("title", [
                    "label" => "Title",
                    "toolbar" => "full",
                    "media_upload" => 0,
                ])
                ->addTextarea("description", [
                    "label" => "Description",
                ])
            ->endGroup();

        return $fields->build();
    }
}
```

### Common Field Patterns

#### 1. Hero Section Pattern

```php
->addTab("hero", ["label" => "Hero"])
->addGroup("hero", ["label" => "Hero Section"])
    ->addText("section_id", [
        "label" => "Section ID",
        "default_value" => "hero",
    ])
    ->addWysiwyg("title", [
        "label" => "Main Title",
        "toolbar" => "full",
        "media_upload" => 0,
    ])
    ->addWysiwyg("subtitle", [
        "label" => "Subtitle",
        "toolbar" => "full",
        "media_upload" => 0,
    ])
    ->addTextarea("description", [
        "label" => "Description",
    ])
    ->addLink("cta_button", [
        "label" => "CTA Button",
        "return_format" => "array",
    ])
    ->addText("cta_button_text", [
        "label" => "Button Text",
        "default_value" => "Learn More",
    ])
    ->addImage("hero_image", [
        "label" => "Hero Image",
        "return_format" => "id",
        "preview_size" => "medium",
    ])
->endGroup()
```

#### 2. Repeater with Image Slider

```php
->addRepeater("slides", [
    "label" => "Slider Images",
    "layout" => "block",
    "button_label" => "Add Slide",
    "min" => 1,
])
    ->addImage("image", [
        "label" => "Image",
        "instructions" => "Recommended size: 1920x1080px",
        "return_format" => "id",
        "preview_size" => "medium",
    ])
    ->addText("image_alt", [
        "label" => "Alt Text",
        "instructions" => "For SEO and accessibility",
    ])
    ->addText("caption", [
        "label" => "Caption",
        "instructions" => "Optional",
    ])
->endRepeater()
```

#### 3. Info Cards/Boxes Repeater

```php
->addRepeater("boxes", [
    "label" => "Info Cards",
    "layout" => "block",
    "button_label" => "Add Card",
    "min" => 1,
    "max" => 3,
])
    ->addImage("icon", [
        "label" => "Icon",
        "instructions" => "SVG recommended (80x80px)",
        "return_format" => "id",
        "preview_size" => "thumbnail",
    ])
    ->addWysiwyg("box_title", [
        "label" => "Card Title",
        "toolbar" => "basic",
        "media_upload" => 0,
    ])
    ->addWysiwyg("box_description", [
        "label" => "Card Description",
        "toolbar" => "full",
        "media_upload" => 0,
    ])
    ->addRepeater("list_items", [
        "label" => "List Items",
        "layout" => "table",
        "button_label" => "Add Item",
    ])
        ->addWysiwyg("item_text", [
            "label" => "Item Text",
            "toolbar" => "basic",
            "media_upload" => 0,
        ])
    ->endRepeater()
->endRepeater()
```

#### 4. Post Selection (Manual/Auto)

```php
->addSelect("products_source", [
    "label" => "Products Source",
    "instructions" => "Choose how to display products",
    "choices" => [
        "auto" => "Automatic (latest posts)",
        "manual" => "Manually selected",
    ],
    "default_value" => "auto",
])
->addNumber("posts_per_page", [
    "label" => "Number of Products",
    "instructions" => "For automatic selection",
    "default_value" => 8,
    "min" => 1,
    "max" => 20,
    "conditional_logic" => [
        [
            [
                "field" => "products_source",
                "operator" => "==",
                "value" => "auto",
            ],
        ],
    ],
])
->addPostObject("selected_products", [
    "label" => "Selected Products",
    "instructions" => "Choose specific products",
    "post_type" => ["product"],
    "return_format" => "id",
    "multiple" => 1,
    "allow_null" => 1,
    "conditional_logic" => [
        [
            [
                "field" => "products_source",
                "operator" => "==",
                "value" => "manual",
            ],
        ],
    ],
])
```

#### 5. Video Section (Multiple Types)

```php
->addSelect("video_type", [
    "label" => "Video Type",
    "choices" => [
        "image_link" => "Image with Link (Lightbox)",
        "embed" => "Embed (YouTube/Vimeo)",
        "file" => "Video File",
    ],
    "default_value" => "image_link",
])
->addImage("video_thumbnail", [
    "label" => "Video Thumbnail",
    "instructions" => "Poster/preview image",
    "return_format" => "id",
    "preview_size" => "medium",
])
->addUrl("video_link", [
    "label" => "Video Link",
    "instructions" => "YouTube or Vimeo URL",
    "conditional_logic" => [
        [["field" => "video_type", "operator" => "==", "value" => "image_link"]],
        [["field" => "video_type", "operator" => "==", "value" => "embed"]],
    ],
])
->addFile("video_file", [
    "label" => "Video File",
    "instructions" => "MP4 recommended",
    "return_format" => "array",
    "mime_types" => "mp4,webm,ogg",
    "conditional_logic" => [
        [["field" => "video_type", "operator" => "==", "value" => "file"]],
    ],
])
```

### ACF Field Method Reference

```php
// Text inputs
->addText('field_name', [])
->addTextarea('field_name', [])
->addWysiwyg('field_name', ['toolbar' => 'basic|full'])
->addNumber('field_name', ['min' => 0, 'max' => 100])
->addUrl('field_name', [])
->addEmail('field_name', [])

// Media
->addImage('field_name', ['return_format' => 'id|array|url'])
->addGallery('field_name', ['return_format' => 'id|array'])
->addFile('field_name', ['mime_types' => 'pdf,doc,docx'])

// Choice fields
->addSelect('field_name', ['choices' => ['value' => 'Label']])
->addRadio('field_name', ['choices' => []])
->addCheckbox('field_name', ['choices' => []])
->addTrueFalse('field_name', ['ui' => 1])

// Relational
->addPostObject('field_name', ['post_type' => ['post'], 'multiple' => 1])
->addRelationship('field_name', ['post_type' => ['post']])
->addTaxonomy('field_name', ['taxonomy' => 'category'])
->addLink('field_name', ['return_format' => 'array'])

// Layout
->addGroup('group_name', [])
    // ... nested fields
->endGroup()

->addRepeater('repeater_name', ['layout' => 'block|table|row'])
    // ... nested fields
->endRepeater()

->addFlexibleContent('flex_name', [])
    ->addLayout('layout_name', ['label' => 'Layout Label'])
        // ... layout fields
->endFlexibleContent()

->addTab('tab_name', ['label' => 'Tab Label'])
->addAccordion('accordion_name', [])
```

---

## Blade Templates Structure

### Directory Organization

```
resources/views/
├── layouts/
│   └── app.blade.php          # Main layout wrapper
├── sections/
│   ├── header.blade.php       # Global header
│   ├── footer.blade.php       # Global footer
│   └── home/                  # Page-specific sections
│       ├── hero.blade.php
│       ├── intro.blade.php
│       ├── produkty.blade.php
│       └── cta.blade.php
├── partials/
│   ├── buttons.blade.php      # Reusable button components
│   ├── blur-elipse.blade.php  # Decorative elements
│   ├── header/
│   │   ├── menu.blade.php
│   │   └── menu-mobile.blade.php
│   └── post-card.blade.php    # Post/card components
├── template-*.blade.php       # Page templates
└── index.blade.php            # Blog index
```

### Main Layout Pattern

**File:** `resources/views/layouts/app.blade.php`

```blade
<!doctype html>
<html @php(language_attributes())>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @php(do_action('get_header'))
    @php(wp_head())
  </head>

  <body @php(body_class())>
    @php(wp_body_open())

    <div id="app">
      @include('sections.header')

      <main id="main" class="main">
        @yield('content')
      </main>

      @include('sections.footer')
    </div>

    @php(do_action('get_footer'))
    @php(wp_footer())
  </body>
</html>
```

### Page Template Pattern

**File:** `resources/views/template-home.blade.php`

```blade
{{--
  Template Name: Home Template
--}}

@extends('layouts.app')

@section('content')
  {{-- Include page-specific sections --}}
  @include('sections.home.hero')
  @include('sections.home.intro')
  @include('sections.home.produkty')
  @include('sections.home.video')
  @include('sections.home.rozwiazania')
  @include('sections.home.cta')
  @include('sections.home.zaufali_nam')
  @include('sections.home.case_study')
@endsection
```

### Section Component Pattern

**File:** `resources/views/sections/home/hero.blade.php`

```blade
@php
    $hero = get_field('hero');
@endphp

@if($hero)
<section class="relative py-40 lg:py-80 bg-color-4/20" id="{{ $hero['section_id'] ?? 'hero' }}">
    <div class="container">
        <div class="grid grid-cols-12 gap-20">
            <div class="col-span-full lg:col-span-5">
                {{-- Title --}}
                @if($hero['title'])
                <div class="text-h2 lg:text-h1 text-color-1" data-aos="fade-up">
                    <h1>{!! $hero['title'] !!}</h1>
                </div>
                @endif

                {{-- Subtitle --}}
                @if($hero['subtitle'])
                <div class="mt-20" data-aos="fade-up" data-aos-delay="100">
                    <div class="text-h4 text-color-1">
                        {!! $hero['subtitle'] !!}
                    </div>
                </div>
                @endif

                {{-- Description --}}
                @if($hero['description'])
                <div class="mt-20 text-16" data-aos="fade-up" data-aos-delay="200">
                    {!! $hero['description'] !!}
                </div>
                @endif

                {{-- CTA Button --}}
                @if($hero['cta_button'] || $hero['cta_button_text'])
                <div class="mt-30" data-aos="fade-up" data-aos-delay="300">
                    @php
                        $button_url = $hero['cta_button']['url'] ?? '#contact';
                        $button_text = $hero['cta_button_text'] ?? 'Learn More';
                        $button_target = $hero['cta_button']['target'] ?? '_self';
                    @endphp
                    <a href="{{ $button_url }}"
                       class="btn btn-primary"
                       target="{{ $button_target }}">
                        {{ $button_text }}
                    </a>
                </div>
                @endif
            </div>

            {{-- Hero Image --}}
            <div class="col-span-full lg:col-span-7">
                @if($hero['hero_image'])
                    {!! wp_get_attachment_image($hero['hero_image'], 'full', false, [
                        'class' => 'w-full h-auto rounded-20',
                        'alt' => get_post_meta($hero['hero_image'], '_wp_attachment_image_alt', true)
                    ]) !!}
                @endif
            </div>
        </div>
    </div>
</section>
@endif
```

### Partial/Component Pattern

**File:** `resources/views/partials/buttons.blade.php`

```blade
{{-- Primary Button --}}
<a href="{{ $url ?? '#' }}"
   class="flex items-center gap-20 py-4 pl-24 pr-4 transition-all duration-500 ease-in-out group button-wsk text-button bg-color-2 hover:bg-color-1 text-color-1 hover:text-white rounded-4">
    <span>{{ $text ?? 'Button Text' }}</span>
    <div class="flex items-center justify-center p-12 bg-white rounded-4">
        @svg('resources.images.chevron-right', 'w-24 h-24 group-hover:translate-x-4 transition-all duration-500 ease-in-out')
    </div>
</a>

{{-- Secondary Button --}}
<a href="{{ $url ?? '#' }}"
   class="flex items-center gap-20 py-4 pl-24 pr-4 text-white transition-all duration-500 ease-in-out button-wsk text-button bg-color-1 rounded-4 group hover:bg-color-2 hover:text-color-1">
    <span>{{ $text ?? 'Button Text' }}</span>
    <div class="flex items-center justify-center p-12 bg-color-2 rounded-4">
      @svg('resources.images.chevron-right', 'w-24 h-24 group-hover:translate-x-4 transition-all duration-500 ease-in-out')
    </div>
</a>
```

**Usage in templates:**

```blade
@include('partials.buttons', ['url' => '#contact', 'text' => 'Contact Us'])
```

### Repeater Loop Pattern

```blade
@if($hero['slides'])
    <div class="swiper swiperHero">
        <div class="swiper-wrapper">
            @foreach($hero['slides'] as $index => $slide)
                @php
                    $image = $slide['image'];
                    $image_alt = $slide['image_alt'] ?? '';
                @endphp
                <div class="swiper-slide">
                    @if($image)
                        {!! wp_get_attachment_image($image, 'full', false, [
                            'class' => 'object-contain object-center w-full h-auto',
                            'alt' => $image_alt
                        ]) !!}
                    @endif
                </div>
            @endforeach
        </div>
    </div>
@endif
```

---

## JavaScript Architecture

### Main Entry Point

**File:** `resources/js/app.js`

```javascript
import domReady from '@roots/sage/client/dom-ready';
import Alpine from 'alpinejs';
import { gsap } from 'gsap';
import { ScrollTrigger } from 'gsap/ScrollTrigger';
import AOS from 'aos';
import GLightbox from 'glightbox';

// Import components
import Carousels from './components/Carousels';
import { initMenu } from './partials/menu.js';
import { initHeaderVisibility } from './partials/stickyMenu.js';

// Initialize on DOM ready
domReady(async () => {
  // Alpine.js
  window.Alpine = Alpine;
  Alpine.start();

  // Initialize components
  initMenu();
  initHeaderVisibility();

  // Lightbox for videos/images
  const lightbox = GLightbox({
    touchNavigation: true,
    loop: true,
    autoplayVideos: true,
    selector: '.glightbox',
  });

  // Initialize carousels
  let carousels = new Carousels();
  carousels.init();

  // AOS (Animate on Scroll)
  AOS.init({
    duration: 800,
    easing: 'ease-in-out',
    once: true,
  });
});
```

### Component Structure

**File:** `resources/js/components/Carousels.js`

```javascript
import Swiper from 'swiper';
import { Navigation, Pagination, Autoplay } from 'swiper/modules';

export default class Carousels {
  constructor() {
    this.swipers = [];
  }

  init() {
    this.initHeroSwiper();
    this.initProductsSwiper();
  }

  initHeroSwiper() {
    const heroSwiper = new Swiper('.swiperHero', {
      modules: [Navigation, Autoplay],
      slidesPerView: 1,
      spaceBetween: 20,
      loop: true,
      autoplay: {
        delay: 5000,
        disableOnInteraction: false,
      },
      navigation: {
        nextEl: '.swiperHero__nav--next',
        prevEl: '.swiperHero__nav--prev',
      },
    });

    this.swipers.push(heroSwiper);
  }

  initProductsSwiper() {
    const productsSwiper = new Swiper('.swiperProducts', {
      modules: [Navigation, Pagination],
      slidesPerView: 1,
      spaceBetween: 20,
      breakpoints: {
        640: { slidesPerView: 2 },
        1024: { slidesPerView: 3 },
        1280: { slidesPerView: 4 },
      },
      navigation: {
        nextEl: '.swiperProducts__nav--next',
        prevEl: '.swiperProducts__nav--prev',
      },
      pagination: {
        el: '.swiper-pagination',
        clickable: true,
      },
    });

    this.swipers.push(productsSwiper);
  }
}
```

### Utility Function Pattern

**File:** `resources/js/utils/videoToggle.js`

```javascript
export function initVideoToggle() {
  const videoButtons = document.querySelectorAll('[data-video-toggle]');

  videoButtons.forEach(button => {
    button.addEventListener('click', (e) => {
      e.preventDefault();
      const videoUrl = button.dataset.videoUrl;

      // Lightbox integration or custom modal
      console.log('Open video:', videoUrl);
    });
  });
}
```

### Module Aliases

Defined in `vite.config.js`:

```javascript
resolve: {
  alias: {
    '@scripts': '/resources/js',
    '@styles': '/resources/css',
    '@fonts': '/resources/fonts',
    '@images': '/resources/images',
  },
},
```

**Usage:**

```javascript
// Instead of: import Component from '../../../resources/js/components/Component'
import Component from '@scripts/components/Component';

// Instead of: import '@css/components/buttons.scss'
import '@styles/components/buttons.scss';

// Images
import logo from '@images/logo.svg';
```

---

## Common Patterns

### 1. Conditional Section Rendering

```blade
@php
    $section = get_field('section_name');
@endphp

@if($section)
<section id="{{ $section['section_id'] ?? 'default-id' }}">
    {{-- Section content --}}
</section>
@endif
```

### 2. Image Output with WordPress

```blade
{{-- Using image ID --}}
{!! wp_get_attachment_image($image_id, 'full', false, [
    'class' => 'w-full h-auto rounded-20',
    'alt' => get_post_meta($image_id, '_wp_attachment_image_alt', true)
]) !!}

{{-- Using image array --}}
@if($image = get_field('image_field'))
<img src="{{ $image['url'] }}"
     alt="{{ $image['alt'] }}"
     width="{{ $image['width'] }}"
     height="{{ $image['height'] }}"
     class="w-full h-auto">
@endif
```

### 3. Link Field Output

```blade
@php
    $link = get_field('cta_button');
    $url = $link['url'] ?? '#';
    $title = $link['title'] ?? 'Click Here';
    $target = $link['target'] ?? '_self';
@endphp

<a href="{{ $url }}" target="{{ $target }}">{{ $title }}</a>
```

### 4. Responsive Grid Layout

```blade
<div class="grid grid-cols-1 gap-20 md:grid-cols-2 lg:grid-cols-3 lg:gap-40">
    @foreach($items as $item)
    <div class="col-span-1">
        {{-- Item content --}}
    </div>
    @endforeach
</div>
```

### 5. AOS (Animate on Scroll) Pattern

```blade
<div data-aos="fade-up" data-aos-delay="100">
    Content animates on scroll
</div>

<div data-aos="fade-left" data-aos-delay="200">
    Delayed animation
</div>

<div data-aos="zoom-in" data-aos-duration="1000">
    Custom duration
</div>
```

### 6. Dynamic Background Colors

```blade
<section class="py-80 bg-color-1">
    <div class="container">
        <h2 class="text-white text-h2">White text on color-1 background</h2>
    </div>
</section>

<section class="py-80 bg-color-4/20">
    <div class="container">
        <h2 class="text-h2 text-color-1">Semi-transparent background</h2>
    </div>
</section>
```

### 7. SVG Icon Integration

```blade
{{-- Using Blade Icons (@svg directive) --}}
@svg('resources.images.chevron-right', 'w-24 h-24 text-color-1')

{{-- Manual SVG --}}
<svg class="w-24 h-24" viewBox="0 0 24 24" fill="none">
    <path d="..." fill="currentColor"/>
</svg>
```

### 8. WordPress Loop Pattern

```php
@php
    $args = [
        'post_type' => 'post',
        'posts_per_page' => 6,
        'orderby' => 'date',
        'order' => 'DESC',
    ];
    $query = new WP_Query($args);
@endphp

@if($query->have_posts())
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-30">
        @while($query->have_posts())
            @php($query->the_post())

            <article class="post-card">
                <a href="{{ get_permalink() }}">
                    {{ the_post_thumbnail('medium', ['class' => 'w-full h-auto']) }}
                    <h3 class="mt-20 text-h4">{{ get_the_title() }}</h3>
                    <div class="mt-10 text-16">{{ get_the_excerpt() }}</div>
                </a>
            </article>
        @endwhile
    </div>
    @php(wp_reset_postdata())
@endif
```

---

## Real Examples from Project

### Example 1: Hero Section with Slider

**ACF Fields (app/Fields/Home.php):**

```php
->addGroup("hero", ["label" => "Hero Section"])
    ->addWysiwyg("title", ["label" => "Main Title"])
    ->addWysiwyg("subtitle", ["label" => "Subtitle"])
    ->addRepeater("slides", ["label" => "Slider Images"])
        ->addImage("image", ["return_format" => "id"])
        ->addText("image_alt", ["label" => "Alt Text"])
    ->endRepeater()
->endGroup()
```

**Template (resources/views/sections/home/hero.blade.php):**

```blade
@php $hero = get_field('hero'); @endphp

@if($hero)
<section id="{{ $hero['section_id'] ?? 'hero' }}">
    <div class="container">
        <h1 class="text-h1">{!! $hero['title'] !!}</h1>

        @if($hero['slides'])
        <div class="swiper swiperHero">
            <div class="swiper-wrapper">
                @foreach($hero['slides'] as $slide)
                <div class="swiper-slide">
                    {!! wp_get_attachment_image($slide['image'], 'full', false, [
                        'alt' => $slide['image_alt']
                    ]) !!}
                </div>
                @endforeach
            </div>
        </div>
        @endif
    </div>
</section>
@endif
```

**JavaScript (resources/js/components/Carousels.js):**

```javascript
initHeroSwiper() {
  new Swiper('.swiperHero', {
    slidesPerView: 1,
    loop: true,
    autoplay: { delay: 5000 },
  });
}
```

### Example 2: Products Grid (Manual/Auto)

**ACF Fields:**

```php
->addSelect("products_source", [
    "choices" => [
        "auto" => "Automatic",
        "manual" => "Manual",
    ],
])
->addNumber("posts_per_page", [
    "default_value" => 8,
    "conditional_logic" => [
        [["field" => "products_source", "operator" => "==", "value" => "auto"]],
    ],
])
->addPostObject("selected_products", [
    "post_type" => ["opakowania"],
    "multiple" => 1,
    "conditional_logic" => [
        [["field" => "products_source", "operator" => "==", "value" => "manual"]],
    ],
])
```

**Template:**

```blade
@php
    $produkty = get_field('produkty');
    $source = $produkty['products_source'] ?? 'auto';

    if ($source === 'auto') {
        $args = [
            'post_type' => 'opakowania',
            'posts_per_page' => $produkty['posts_per_page'] ?? 8,
        ];
    } else {
        $args = [
            'post_type' => 'opakowania',
            'post__in' => $produkty['selected_products'] ?? [],
            'orderby' => 'post__in',
        ];
    }

    $query = new WP_Query($args);
@endphp

@if($query->have_posts())
<section id="produkty" class="py-80">
    <div class="container">
        <h2 class="text-h2">{!! $produkty['title'] !!}</h2>

        <div class="grid grid-cols-1 mt-40 md:grid-cols-2 lg:grid-cols-4 gap-30">
            @while($query->have_posts())
                @php($query->the_post())

                <article class="product-card">
                    <a href="{{ get_permalink() }}">
                        {{ the_post_thumbnail('medium') }}
                        <h3 class="mt-20 text-h4">{{ get_the_title() }}</h3>
                    </a>
                </article>
            @endwhile
        </div>
    </div>
</section>
@php(wp_reset_postdata())
@endif
```

---

## Quick Start Checklist

When starting a new project with this boilerplate:

- [ ] Update `style.css` with theme information
- [ ] Update `vite.config.js` base path to match theme folder name
- [ ] Customize colors in `resources/css/abstracts/_variables.scss`
- [ ] Replace fonts in `resources/fonts/` and update `_fonts.scss`
- [ ] Update font family variables in `_variables.scss`
- [ ] Create page templates in `resources/views/`
- [ ] Create corresponding ACF field classes in `app/Fields/`
- [ ] Build page sections in `resources/views/sections/`
- [ ] Create reusable partials in `resources/views/partials/`
- [ ] Add custom JavaScript components in `resources/js/components/`
- [ ] Run `composer install` for PHP dependencies
- [ ] Run `npm install` for Node dependencies
- [ ] Run `npm run dev` during development
- [ ] Run `npm run build` for production

---

## Additional Resources

- [Main README](./BOILERPLATE-README.md) - Complete boilerplate documentation
- [Roots/Sage Docs](https://roots.io/sage/docs/) - Theme framework
- [ACF Composer](https://github.com/Log1x/acf-composer) - Field builder
- [Tailwind CSS 4.0](https://tailwindcss.com/docs/v4-beta) - CSS framework
- [Blade Templates](https://laravel.com/docs/blade) - Template engine

---

**Happy coding!** 🚀
