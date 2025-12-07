# Button Styles Guide

This document provides reusable button patterns and styling guidelines for the project.

## Base Button Classes

### Standard Button
```html
<button class="btn">
    Button Text
</button>
```

### Button with Icon
```html
<button class="btn flex items-center gap-16">
    <span>Button Text</span>
    <svg><!-- icon --></svg>
</button>
```

## Border Styles

### Border Solid (Default)
```html
<button class="btn border-1 border-color-1">
    Solid Border
</button>
```

### Border Dashed
```html
<button class="btn border-1 border-dashed border-color-1">
    Dashed Border
</button>
```

### Border Variations
```html
<!-- Dashed with color-2 -->
<button class="btn border-1 border-dashed border-color-2">
    Dashed Color 2
</button>

<!-- Dashed with color-3 -->
<button class="btn border-1 border-dashed border-color-3">
    Dashed Color 3
</button>

<!-- Thicker border -->
<button class="btn border-2 border-dashed border-color-1">
    Thick Dashed
</button>
```

## Layout Patterns

### Flex Container with Gap
```html
<div class="flex gap-16">
    <button class="btn border-1 border-dashed border-color-1">Button 1</button>
    <button class="btn border-1 border-dashed border-color-2">Button 2</button>
</div>
```

### Flex Column
```html
<div class="flex flex-col gap-16">
    <button class="btn border-1 border-dashed">Button 1</button>
    <button class="btn border-1 border-dashed">Button 2</button>
</div>
```

### Responsive Flex Direction
```html
<div class="flex flex-col lg:flex-row gap-16">
    <button class="btn border-1 border-dashed">Button 1</button>
    <button class="btn border-1 border-dashed">Button 2</button>
</div>
```

## Transitions

### Hover Transitions
```html
<!-- Color transition -->
<button class="btn border-1 border-dashed border-color-1 transition-colors duration-300 hover:border-color-2">
    Hover Color Change
</button>

<!-- Background transition -->
<button class="btn border-1 border-dashed border-color-1 transition-all duration-300 hover:bg-color-1 hover:text-white">
    Hover Background
</button>

<!-- Transform transition -->
<button class="btn border-1 border-dashed transition-transform duration-300 hover:scale-105">
    Hover Scale
</button>

<!-- Multiple transitions -->
<button class="btn border-1 border-dashed transition-all duration-300 hover:border-color-2 hover:bg-color-2 hover:text-white">
    Multiple Transitions
</button>
```

### Active States
```html
<button class="btn border-1 border-dashed transition-all duration-300 active:scale-95 active:opacity-80">
    Active State
</button>
```

### Focus States
```html
<button class="btn border-1 border-dashed transition-all duration-300 focus:outline-none focus:ring-2 focus:ring-color-2">
    Focus Ring
</button>
```

## Complete Button Examples

### Primary Dashed Button
```html
<button class="
    flex items-center gap-16
    border-1 border-dashed border-color-1
    px-40 py-20
    text-color-1 font-semibold
    transition-all duration-300
    hover:bg-color-1 hover:text-white hover:border-solid
    active:scale-95
">
    <span>Primary Action</span>
    <svg width="20" height="20"><!-- icon --></svg>
</button>
```

### Secondary Dashed Button
```html
<button class="
    flex items-center gap-16
    border-1 border-dashed border-color-2
    px-40 py-20
    text-color-2 font-semibold
    transition-all duration-300
    hover:bg-color-2 hover:text-white hover:border-solid
    active:scale-95
">
    <span>Secondary Action</span>
</button>
```

### Outline Dashed Button
```html
<button class="
    flex items-center justify-center gap-16
    border-2 border-dashed border-color-1
    bg-transparent
    px-40 py-20
    text-color-1 font-semibold
    transition-all duration-300
    hover:bg-color-1 hover:text-white
    focus:outline-none focus:ring-2 focus:ring-color-1 focus:ring-offset-2
">
    <span>Outline Button</span>
</button>
```

### Icon Only Button
```html
<button class="
    flex items-center justify-center
    border-1 border-dashed border-color-1
    w-48 h-48 rounded-full
    transition-all duration-300
    hover:bg-color-1 hover:text-white hover:border-solid
">
    <svg width="24" height="24"><!-- icon --></svg>
</button>
```

## Button Groups

### Horizontal Button Group
```html
<div class="flex gap-16">
    <button class="btn border-1 border-dashed border-color-1 transition-all duration-300 hover:bg-color-1 hover:text-white">
        Button 1
    </button>
    <button class="btn border-1 border-dashed border-color-1 transition-all duration-300 hover:bg-color-1 hover:text-white">
        Button 2
    </button>
    <button class="btn border-1 border-dashed border-color-1 transition-all duration-300 hover:bg-color-1 hover:text-white">
        Button 3
    </button>
</div>
```

### Responsive Button Group
```html
<div class="flex flex-col lg:flex-row gap-16">
    <button class="btn border-1 border-dashed border-color-1 transition-all duration-300">
        Mobile Stack
    </button>
    <button class="btn border-1 border-dashed border-color-1 transition-all duration-300">
        Desktop Row
    </button>
</div>
```

### Justified Button Group
```html
<div class="flex gap-16 w-full">
    <button class="btn flex-1 border-1 border-dashed border-color-1 transition-all duration-300">
        Equal Width 1
    </button>
    <button class="btn flex-1 border-1 border-dashed border-color-1 transition-all duration-300">
        Equal Width 2
    </button>
</div>
```

## Blade Component Examples

### ACF Button Repeater
```blade
@if(isset($buttons) && is_array($buttons))
    <div class="flex gap-16">
        @foreach($buttons as $button)
            @if($button['link'])
                <a href="{{ $button['link']['url'] }}"
                   target="{{ $button['link']['target'] ?? '_self' }}"
                   class="
                       flex items-center gap-16
                       border-1 border-dashed border-color-1
                       px-40 py-20
                       text-color-1 font-semibold
                       transition-all duration-300
                       hover:bg-color-1 hover:text-white hover:border-solid
                   ">
                    {{ $button['link']['title'] }}
                </a>
            @endif
        @endforeach
    </div>
@endif
```

### Dynamic Button Style
```blade
@php
    $button_classes = [
        'primary' => 'border-color-1 text-color-1 hover:bg-color-1 hover:text-white',
        'secondary' => 'border-color-2 text-color-2 hover:bg-color-2 hover:text-white',
        'accent' => 'border-color-3 text-color-3 hover:bg-color-3 hover:text-color-1',
    ];
    $style = $button['style'] ?? 'primary';
@endphp

<button class="flex items-center gap-16 border-1 border-dashed px-40 py-20 transition-all duration-300 {{ $button_classes[$style] }}">
    {{ $button['text'] }}
</button>
```

## Utility Classes Reference

### Flex & Gap
- `flex` - Display flex
- `flex-col` - Flex direction column
- `flex-row` - Flex direction row
- `items-center` - Align items center
- `justify-center` - Justify content center
- `gap-16` - Gap 16px
- `gap-20` - Gap 20px
- `gap-24` - Gap 24px

### Borders
- `border-1` - Border width 1px
- `border-2` - Border width 2px
- `border-dashed` - Dashed border style
- `border-solid` - Solid border style
- `border-color-1` - Border color 1 (#002234)
- `border-color-2` - Border color 2 (#66b0c0)
- `border-color-3` - Border color 3 (#c2f970)

### Transitions
- `transition-all` - Transition all properties
- `transition-colors` - Transition colors only
- `transition-transform` - Transition transforms only
- `duration-300` - 300ms duration
- `duration-500` - 500ms duration

### Hover States
- `hover:bg-color-1` - Hover background color 1
- `hover:text-white` - Hover text white
- `hover:border-color-2` - Hover border color 2
- `hover:border-solid` - Hover border solid
- `hover:scale-105` - Hover scale up 5%

### Active States
- `active:scale-95` - Active scale down 5%
- `active:opacity-80` - Active opacity 80%

## Common Patterns

### Call-to-Action Section
```blade
<section class="py-80 text-center">
    <h2 class="text-h2 mb-40">Ready to get started?</h2>
    <div class="flex flex-col lg:flex-row gap-16 justify-center">
        <a href="/contact" class="
            flex items-center justify-center gap-16
            border-2 border-dashed border-color-1
            bg-color-1 text-white
            px-60 py-24
            font-bold text-button
            transition-all duration-300
            hover:bg-transparent hover:text-color-1 hover:border-solid
        ">
            Get Started
        </a>
        <a href="/about" class="
            flex items-center justify-center gap-16
            border-2 border-dashed border-color-1
            bg-transparent text-color-1
            px-60 py-24
            font-bold text-button
            transition-all duration-300
            hover:bg-color-1 hover:text-white hover:border-solid
        ">
            Learn More
        </a>
    </div>
</section>
```

### Navigation Buttons
```blade
<nav class="flex gap-16">
    <button class="
        flex items-center gap-16
        border-1 border-dashed border-color-1
        px-30 py-15
        transition-all duration-300
        hover:border-solid hover:bg-color-1 hover:text-white
        disabled:opacity-50 disabled:cursor-not-allowed
    " disabled>
        <svg><!-- prev icon --></svg>
        Previous
    </button>
    <button class="
        flex items-center gap-16
        border-1 border-dashed border-color-1
        px-30 py-15
        transition-all duration-300
        hover:border-solid hover:bg-color-1 hover:text-white
    ">
        Next
        <svg><!-- next icon --></svg>
    </button>
</nav>
```

### Filter Buttons
```blade
<div class="flex flex-wrap gap-16">
    <button class="
        border-1 border-dashed border-color-1
        px-24 py-12
        text-color-1
        transition-all duration-300
        hover:bg-color-1 hover:text-white hover:border-solid
        [&.active]:bg-color-1 [&.active]:text-white [&.active]:border-solid
    " data-filter="all">
        All
    </button>
    <button class="
        border-1 border-dashed border-color-1
        px-24 py-12
        text-color-1
        transition-all duration-300
        hover:bg-color-1 hover:text-white hover:border-solid
    " data-filter="category-1">
        Category 1
    </button>
    <button class="
        border-1 border-dashed border-color-1
        px-24 py-12
        text-color-1
        transition-all duration-300
        hover:bg-color-1 hover:text-white hover:border-solid
    " data-filter="category-2">
        Category 2
    </button>
</div>
```

## Accessibility

### Keyboard Focus
Always include focus states for accessibility:
```html
<button class="
    btn border-1 border-dashed
    transition-all duration-300
    focus:outline-none focus:ring-2 focus:ring-color-1 focus:ring-offset-2
">
    Accessible Button
</button>
```

### ARIA Labels
For icon-only buttons:
```html
<button aria-label="Close menu" class="btn border-1 border-dashed">
    <svg><!-- close icon --></svg>
</button>
```

### Disabled States
```html
<button disabled class="
    btn border-1 border-dashed
    disabled:opacity-50 disabled:cursor-not-allowed
">
    Disabled Button
</button>
```

## Animation Examples

### Pulse Effect
```html
<button class="
    btn border-1 border-dashed
    animate-pulse
">
    Loading...
</button>
```

### Bounce on Hover
```html
<button class="
    btn border-1 border-dashed
    transition-transform duration-300
    hover:animate-bounce
">
    Bounce
</button>
```

### Slide In Icon
```html
<button class="
    flex items-center gap-16
    border-1 border-dashed
    overflow-hidden
    transition-all duration-300
    group
">
    <span>Hover Me</span>
    <svg class="transform translate-x-[-10px] opacity-0 group-hover:translate-x-0 group-hover:opacity-100 transition-all duration-300">
        <!-- arrow icon -->
    </svg>
</button>
```
