# ⚡ Quick Reference Guide

> Fast lookup for common tasks and patterns used in daily development

---

## Table of Contents

1. [Tailwind Classes Quick Reference](#tailwind-classes-quick-reference)
2. [ACF Field Types Cheat Sheet](#acf-field-types-cheat-sheet)
3. [Common Blade Patterns](#common-blade-patterns)
4. [Color & Typography Classes](#color--typography-classes)
5. [Spacing & Layout](#spacing--layout)
6. [Component Snippets](#component-snippets)

---

## Tailwind Classes Quick Reference

### Colors (From Figma)

```html
<!-- Backgrounds -->
<div class="bg-color-1">      <!-- Dark Navy (#002234) -->
<div class="bg-color-2">      <!-- Teal (#66b0c0) -->
<div class="bg-color-3">      <!-- Lime Green (#c2f970) -->
<div class="bg-color-4">      <!-- Light Gray (#e5e9eb) -->
<div class="bg-color-5">      <!-- White (#ffffff) -->
<div class="bg-color-2/10">   <!-- 10% opacity -->
<div class="bg-color-2/20">   <!-- 20% opacity -->

<!-- Text -->
<div class="text-color-1">    <!-- Dark navy text -->
<div class="text-color-2">    <!-- Teal text -->
<div class="text-color-3">    <!-- Lime green text -->
<div class="text-color-5">    <!-- White text -->

<!-- Border -->
<div class="border-color-4">  <!-- Light gray border -->

📚 **See [DESIGN-TOKENS.md](./DESIGN-TOKENS.md) for complete color specifications.**
```

### Typography (From Figma)

```html
<!-- Headings -->
<h1 class="text-h1">          <!-- 62px desktop, 48px mobile, Gantari 600 -->
<h2 class="text-h2">          <!-- 48px desktop, 38px mobile, Gantari 600 -->
<h3 class="text-h3">          <!-- 38px desktop, 28px mobile, Gantari 600 -->
<h4 class="text-h4">          <!-- 28px desktop, 24px mobile, Gantari 600 -->
<h5 class="text-h5">          <!-- 22px desktop, 18px mobile, Gantari 600 -->

<!-- Body text -->
<p class="text-16">           <!-- 16px body text, Gantari 400 -->
<p class="text-18">           <!-- 18px body text, Gantari 400 -->

<!-- Component text -->
<button class="text-button">  <!-- 16px, Gantari 600 -->
<a class="text-menu">         <!-- 18px, Gantari 700 -->
<h6 class="text-naglowek">    <!-- 20px, Gantari 600, UPPERCASE, 2px spacing -->
<blockquote class="text-opinia"> <!-- 20px, Sansita 400 italic -->

<!-- Font families -->
<div class="font-primary">    <!-- Gantari -->
<div class="font-secondary">  <!-- Sansita -->

<!-- Font weights (Gantari) -->
<div class="font-normal">     <!-- 400 -->
<div class="font-semibold">   <!-- 600 -->
<div class="font-bold">       <!-- 700 -->

📚 **See [DESIGN-TOKENS.md](./DESIGN-TOKENS.md) for complete typography specifications.**
```

### Border Radius

```html
<div class="rounded-80">      <!-- Large -->
<div class="rounded-40">      <!-- Medium -->
<div class="rounded-20">      <!-- Small -->
<div class="rounded-8">       <!-- Extra small -->

<!-- Individual corners -->
<div class="rounded-t-80">    <!-- Top corners -->
<div class="rounded-b-80">    <!-- Bottom corners -->
<div class="rounded-l-80">    <!-- Left corners -->
<div class="rounded-r-80">    <!-- Right corners -->
<div class="rounded-tl-80">   <!-- Top-left -->
<div class="rounded-tr-80">   <!-- Top-right -->
<div class="rounded-bl-80">   <!-- Bottom-left -->
<div class="rounded-br-80">   <!-- Bottom-right -->

<!-- Responsive -->
<div class="rounded-20 lg:rounded-80">  <!-- Small mobile, large desktop -->
```

### Spacing

```html
<!-- Padding -->
<div class="p-20">            <!-- All sides -->
<div class="px-20">           <!-- Horizontal (left + right) -->
<div class="py-20">           <!-- Vertical (top + bottom) -->
<div class="pt-20">           <!-- Top -->
<div class="pb-20">           <!-- Bottom -->
<div class="pl-20">           <!-- Left -->
<div class="pr-20">           <!-- Right -->

<!-- Margin -->
<div class="m-20">            <!-- All sides -->
<div class="mx-20">           <!-- Horizontal -->
<div class="my-20">           <!-- Vertical -->
<div class="mt-20">           <!-- Top -->
<div class="mb-20">           <!-- Bottom -->

<!-- Gap (for flex/grid) -->
<div class="gap-20">          <!-- All -->
<div class="gap-x-20">        <!-- Horizontal -->
<div class="gap-y-20">        <!-- Vertical -->

<!-- Common spacing values -->
p-10, p-20, p-30, p-40, p-60, p-80, p-100
```

### Responsive Breakpoints

```html
<!-- Mobile first approach -->
<div class="text-16 md:text-18 lg:text-h4">
<!-- 16px mobile, 18px tablet, h4 desktop -->

<div class="grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
<!-- 1 col mobile, 2 tablet, 3 laptop, 4 desktop -->

<!-- Breakpoints -->
sm:   640px
md:   768px
lg:   1024px
xl:   1280px
2xl:  1536px
```

### Layout

```html
<!-- Container -->
<div class="container">       <!-- Centered max-width container -->

<!-- Grid -->
<div class="grid grid-cols-12 gap-20">
  <div class="col-span-6">   <!-- Half width -->
  <div class="col-span-4">   <!-- Third width -->
  <div class="col-span-3">   <!-- Quarter width -->
</div>

<!-- Flex -->
<div class="flex items-center justify-between">
<div class="flex flex-col gap-20">
<div class="flex flex-wrap">

<!-- Common flex utilities -->
items-start       <!-- Align items to start -->
items-center      <!-- Center items vertically -->
items-end         <!-- Align items to end -->
justify-start     <!-- Justify content to start -->
justify-center    <!-- Center content -->
justify-between   <!-- Space between items -->
justify-end       <!-- Justify to end -->
```

---

## ACF Field Types Cheat Sheet

### Text Fields

```php
// Simple text
->addText('field_name', [
    'label' => 'Field Label',
    'default_value' => 'Default text',
    'placeholder' => 'Placeholder text',
])

// Textarea
->addTextarea('field_name', [
    'label' => 'Description',
    'rows' => 4,
])

// WYSIWYG editor
->addWysiwyg('field_name', [
    'label' => 'Content',
    'toolbar' => 'full',  // or 'basic'
    'media_upload' => 0,  // Disable media upload
])

// Number
->addNumber('field_name', [
    'label' => 'Count',
    'default_value' => 0,
    'min' => 0,
    'max' => 100,
])

// URL
->addUrl('field_name', [
    'label' => 'Website URL',
])

// Email
->addEmail('field_name', [
    'label' => 'Email Address',
])
```

### Media Fields

```php
// Image (return ID)
->addImage('image_field', [
    'label' => 'Image',
    'return_format' => 'id',
    'preview_size' => 'medium',
])

// Image (return array)
->addImage('image_field', [
    'label' => 'Image',
    'return_format' => 'array',
])

// Gallery
->addGallery('gallery_field', [
    'label' => 'Photo Gallery',
    'return_format' => 'id',
    'min' => 1,
    'max' => 10,
])

// File
->addFile('file_field', [
    'label' => 'PDF Document',
    'return_format' => 'array',
    'mime_types' => 'pdf,doc,docx',
])
```

### Choice Fields

```php
// Select dropdown
->addSelect('select_field', [
    'label' => 'Choose Option',
    'choices' => [
        'option1' => 'Option 1',
        'option2' => 'Option 2',
        'option3' => 'Option 3',
    ],
    'default_value' => 'option1',
    'allow_null' => 0,
    'multiple' => 0,
])

// Radio buttons
->addRadio('radio_field', [
    'label' => 'Choose One',
    'choices' => [
        'yes' => 'Yes',
        'no' => 'No',
    ],
])

// Checkbox
->addCheckbox('checkbox_field', [
    'label' => 'Select Multiple',
    'choices' => [
        'choice1' => 'Choice 1',
        'choice2' => 'Choice 2',
    ],
])

// True/False (toggle)
->addTrueFalse('toggle_field', [
    'label' => 'Enable Feature',
    'default_value' => 1,
    'ui' => 1,  // Shows as toggle switch
])
```

### Relational Fields

```php
// Link (ACF Link field)
->addLink('link_field', [
    'label' => 'CTA Button',
    'return_format' => 'array',
])

// Post Object
->addPostObject('post_field', [
    'label' => 'Select Post',
    'post_type' => ['post', 'page'],
    'return_format' => 'id',  // or 'object'
    'multiple' => 0,
])

// Relationship (multiple posts)
->addRelationship('posts_field', [
    'label' => 'Related Posts',
    'post_type' => ['post'],
    'max' => 5,
])

// Taxonomy
->addTaxonomy('category_field', [
    'label' => 'Categories',
    'taxonomy' => 'category',
    'field_type' => 'select',
    'return_format' => 'id',
])
```

### Layout Fields

```php
// Group
->addGroup('group_name', [
    'label' => 'Group Label',
])
    ->addText('nested_field', [])
    // ... more nested fields
->endGroup()

// Repeater
->addRepeater('repeater_name', [
    'label' => 'Items',
    'layout' => 'block',  // or 'table', 'row'
    'button_label' => 'Add Item',
    'min' => 0,
    'max' => 10,
])
    ->addText('item_title', [])
    ->addTextarea('item_description', [])
->endRepeater()

// Flexible Content
->addFlexibleContent('flex_name', [
    'label' => 'Content Blocks',
])
    ->addLayout('text_block', [
        'label' => 'Text Block',
    ])
        ->addWysiwyg('content', [])
    ->endLayout()

    ->addLayout('image_block', [
        'label' => 'Image Block',
    ])
        ->addImage('image', [])
    ->endLayout()
->endFlexibleContent()

// Tab
->addTab('tab_name', [
    'label' => 'Tab Label',
])
// Fields after this will be in the tab

// Accordion
->addAccordion('accordion_name', [
    'label' => 'Advanced Settings',
    'open' => 0,  // 0 = closed by default
])
```

### Conditional Logic

```php
->addSelect('show_content', [
    'choices' => ['yes' => 'Yes', 'no' => 'No'],
])
->addWysiwyg('content', [
    'label' => 'Content',
    'conditional_logic' => [
        [
            [
                'field' => 'show_content',
                'operator' => '==',
                'value' => 'yes',
            ],
        ],
    ],
])
```

---

## Common Blade Patterns

### Get ACF Field

```blade
{{-- Simple field --}}
{{ get_field('field_name') }}

{{-- With fallback --}}
{{ get_field('field_name') ?? 'Default value' }}

{{-- Field from specific post --}}
{{ get_field('field_name', $post_id) }}

{{-- Group field --}}
@php $hero = get_field('hero'); @endphp
{{ $hero['title'] }}
{{ $hero['description'] }}
```

### Output HTML (unescaped)

```blade
{{-- WYSIWYG content (allows HTML) --}}
{!! get_field('wysiwyg_content') !!}

{{-- Escaped (safe) --}}
{{ get_field('text_field') }}
```

### Images

```blade
{{-- WordPress function (with ID) --}}
{!! wp_get_attachment_image($image_id, 'full', false, [
    'class' => 'w-full h-auto',
    'alt' => 'Alt text'
]) !!}

{{-- Image array --}}
@php $image = get_field('image'); @endphp
@if($image)
<img src="{{ $image['url'] }}"
     alt="{{ $image['alt'] }}"
     width="{{ $image['width'] }}"
     height="{{ $image['height'] }}">
@endif

{{-- Featured image --}}
{{ the_post_thumbnail('medium', ['class' => 'w-full']) }}
```

### Links

```blade
{{-- ACF Link field --}}
@php $link = get_field('link_field'); @endphp
<a href="{{ $link['url'] }}"
   target="{{ $link['target'] ?? '_self' }}">
   {{ $link['title'] }}
</a>

{{-- Permalink --}}
<a href="{{ get_permalink() }}">{{ get_the_title() }}</a>

{{-- Custom URL --}}
<a href="{{ home_url('/page-slug') }}">Link</a>
```

### Loops

```blade
{{-- Repeater --}}
@if(get_field('repeater_name'))
    @foreach(get_field('repeater_name') as $item)
        <div>{{ $item['field_name'] }}</div>
    @endforeach
@endif

{{-- WP Query --}}
@php
    $query = new WP_Query([
        'post_type' => 'post',
        'posts_per_page' => 6,
    ]);
@endphp

@if($query->have_posts())
    @while($query->have_posts())
        @php($query->the_post())

        <article>
            <h2>{{ get_the_title() }}</h2>
            <div>{{ get_the_excerpt() }}</div>
        </article>
    @endwhile
    @php(wp_reset_postdata())
@endif
```

### Conditionals

```blade
@if(get_field('show_section'))
    <div>Section content</div>
@endif

@if($hero['slides'])
    {{-- Has slides --}}
@else
    {{-- No slides --}}
@endif

@isset($variable)
    {{-- Variable is set --}}
@endisset

@empty($array)
    {{-- Array is empty --}}
@endempty
```

### Including Partials

```blade
{{-- Simple include --}}
@include('partials.header')

{{-- Include with data --}}
@include('partials.button', [
    'url' => '#contact',
    'text' => 'Contact Us',
    'class' => 'btn-primary'
])

{{-- Include section --}}
@include('sections.home.hero')
```

---

## Component Snippets

### Button Component

```blade
{{-- Primary Button --}}
<a href="{{ $url ?? '#' }}"
   class="flex items-center gap-20 py-4 pl-24 pr-4 transition-all duration-500 ease-in-out group text-button bg-color-2 hover:bg-color-1 text-color-1 hover:text-white rounded-4">
    <span>{{ $text ?? 'Button' }}</span>
    <div class="flex items-center justify-center p-12 bg-white rounded-4">
        @svg('resources.images.chevron-right', 'w-24 h-24 group-hover:translate-x-4 transition-all')
    </div>
</a>
```

### Card Component

```blade
<div class="p-30 bg-white rounded-20 shadow-cien-1">
    @if($icon)
        <div class="mb-20">
            {!! wp_get_attachment_image($icon, 'thumbnail') !!}
        </div>
    @endif

    <h3 class="text-h4 text-color-1">{{ $title }}</h3>
    <p class="mt-10 text-16">{{ $description }}</p>

    @if($link)
        <a href="{{ $link['url'] }}" class="inline-block mt-20 text-button text-color-2">
            {{ $link['title'] }}
        </a>
    @endif
</div>
```

### Section Wrapper

```blade
<section class="py-40 lg:py-80 {{ $bg_class ?? 'bg-white' }}"
         id="{{ $section_id ?? 'section' }}">
    <div class="container">
        {{-- Title --}}
        @if($title)
        <h2 class="text-h2 text-color-1 text-center" data-aos="fade-up">
            {!! $title !!}
        </h2>
        @endif

        {{-- Subtitle --}}
        @if($subtitle)
        <div class="mt-20 text-18 text-center" data-aos="fade-up" data-aos-delay="100">
            {!! $subtitle !!}
        </div>
        @endif

        {{-- Content --}}
        <div class="mt-40">
            {{ $slot }}
        </div>
    </div>
</section>
```

### Grid of Posts

```blade
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-20 lg:gap-40">
    @foreach($posts as $post)
    <article class="group">
        <a href="{{ get_permalink($post->ID) }}">
            {{-- Image --}}
            <div class="overflow-hidden rounded-20">
                {{ get_the_post_thumbnail($post->ID, 'medium', [
                    'class' => 'w-full h-auto transition-transform duration-500 group-hover:scale-110'
                ]) }}
            </div>

            {{-- Title --}}
            <h3 class="mt-20 text-h4 text-color-1 group-hover:text-color-2 transition-colors">
                {{ get_the_title($post->ID) }}
            </h3>

            {{-- Excerpt --}}
            <p class="mt-10 text-16 text-color-5">
                {{ wp_trim_words(get_the_excerpt($post->ID), 20) }}
            </p>
        </a>
    </article>
    @endforeach
</div>
```

---

## Animation Patterns

### AOS (Animate on Scroll)

```html
<!-- Fade in from bottom -->
<div data-aos="fade-up">Content</div>

<!-- Fade in from left -->
<div data-aos="fade-left">Content</div>

<!-- Fade in from right -->
<div data-aos="fade-right">Content</div>

<!-- Zoom in -->
<div data-aos="zoom-in">Content</div>

<!-- With delay -->
<div data-aos="fade-up" data-aos-delay="100">Content</div>
<div data-aos="fade-up" data-aos-delay="200">Content</div>

<!-- Custom duration -->
<div data-aos="fade-up" data-aos-duration="1000">Content</div>

<!-- Only animate once -->
<div data-aos="fade-up" data-aos-once="true">Content</div>
```

### Tailwind Transitions

```html
<!-- Transition all properties -->
<div class="transition-all duration-300 hover:scale-105">Hover me</div>

<!-- Transition specific properties -->
<div class="transition-colors duration-500 hover:text-color-2">Text</div>
<div class="transition-transform duration-300 hover:translate-x-4">Move</div>

<!-- Common transitions -->
transition-opacity
transition-transform
transition-colors
transition-all

<!-- Durations -->
duration-150   <!-- 150ms -->
duration-300   <!-- 300ms -->
duration-500   <!-- 500ms -->
duration-700   <!-- 700ms -->
duration-1000  <!-- 1000ms -->

<!-- Easing -->
ease-linear
ease-in
ease-out
ease-in-out
```

---

## WordPress Functions Quick Reference

```php
// Get current post
get_the_ID()
get_the_title()
get_the_content()
get_the_excerpt()
get_permalink()
get_the_post_thumbnail()

// ACF
get_field('field_name')
get_field('field_name', $post_id)
the_field('field_name')
have_rows('repeater_name')

// URLs
home_url()
home_url('/path')
get_template_directory_uri()
wp_get_attachment_url($attachment_id)

// Posts
wp_get_recent_posts()
get_posts()
new WP_Query($args)

// Categories/Terms
get_categories()
get_terms()
get_the_category()
get_the_tags()

// Meta
get_post_meta($post_id, 'meta_key', true)
update_post_meta($post_id, 'meta_key', $value)

// User
get_current_user_id()
is_user_logged_in()
wp_get_current_user()

// Conditionals
is_front_page()
is_home()
is_single()
is_page()
is_page_template('template-name.blade.php')
```

---

## File Paths Reference

```
Theme Root:             /wp-content/themes/Quartz/
Views:                  resources/views/
Sections:               resources/views/sections/
Partials:               resources/views/partials/
CSS:                    resources/css/
JavaScript:             resources/js/
Images:                 resources/images/
Fonts:                  resources/fonts/
ACF Fields:             app/Fields/
Public (compiled):      public/build/
```

---

## Command Reference

```bash
# Development
npm run dev              # Start dev server with HMR
npm run build            # Build for production

# PHP/Composer
composer install         # Install PHP dependencies
composer update          # Update dependencies

# WordPress CLI (if available)
wp acorn acf:clear      # Clear ACF cache
wp acorn acf:cache      # Build ACF cache

# Translations
npm run translate        # Generate translations
npm run translate:pot    # Generate .pot file
npm run translate:compile # Compile .mo files
```

---

## Common Issues & Solutions

### Assets not loading
```bash
# 1. Check vite.config.js base path
# 2. Run build
npm run build
# 3. Clear WordPress cache
# 4. Hard refresh browser (Cmd+Shift+R)
```

### ACF fields not showing
```bash
# Clear ACF cache
wp acorn acf:clear
wp acorn acf:cache
# Or check field location rules in Field class
```

### HMR not working
```bash
# 1. Ensure npm run dev is running
# 2. Check browser console for WebSocket errors
# 3. Verify you're on correct URL
```

### Fonts not loading
```bash
# 1. Check files exist in resources/fonts/
# 2. Verify paths in _fonts.scss
# 3. Run npm run build
# 4. Clear browser cache
```

---

**Keep this guide handy for quick reference during development!** 🚀
