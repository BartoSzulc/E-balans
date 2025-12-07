# Decoration Element Component

A reusable triangular decoration element created with CSS clip-path polygons. Perfect for adding visual accents to sections, cards, and containers.

## Location
`resources/views/partials/decoration-element.blade.php`

## Overview

The decoration element consists of two overlapping triangular shapes created using CSS clip-path. It creates a corner decoration with two colors.

## Basic Usage

### Default (Top Left Corner)
```blade
@include('partials.decoration-element')
```

This will render with default values:
- Size: `size-60`
- Color 1: `bg-color-5` (white)
- Color 2: `bg-color-1` (dark navy)
- Position: `top-0 left-0`

## Parameters

| Parameter | Type | Default | Description |
|-----------|------|---------|-------------|
| `size` | string | `'size-60'` | Tailwind size class (e.g., `size-40`, `size-60`, `size-80`) |
| `color1` | string | `'bg-color-5'` | Background color for first triangle |
| `color2` | string | `'bg-color-1'` | Background color for second triangle |
| `position` | string | `'top-0 left-0'` | Position classes (e.g., `top-0 right-0`, `bottom-0 left-0`) |

## Common Examples

### Different Sizes

#### Small (40px)
```blade
@include('partials.decoration-element', [
    'size' => 'size-40'
])
```

#### Medium (60px) - Default
```blade
@include('partials.decoration-element', [
    'size' => 'size-60'
])
```

#### Large (80px)
```blade
@include('partials.decoration-element', [
    'size' => 'size-80'
])
```

#### Extra Large (100px)
```blade
@include('partials.decoration-element', [
    'size' => 'size-100'
])
```

### Different Positions

#### Top Left (Default)
```blade
@include('partials.decoration-element', [
    'position' => 'top-0 left-0'
])
```

#### Top Right
```blade
@include('partials.decoration-element', [
    'position' => 'top-0 right-0'
])
```

#### Bottom Left
```blade
@include('partials.decoration-element', [
    'position' => 'bottom-0 left-0'
])
```

#### Bottom Right
```blade
@include('partials.decoration-element', [
    'position' => 'bottom-0 right-0'
])
```

### Different Color Combinations

#### White + Navy (Default)
```blade
@include('partials.decoration-element', [
    'color1' => 'bg-color-5',
    'color2' => 'bg-color-1'
])
```

#### Teal + Navy
```blade
@include('partials.decoration-element', [
    'color1' => 'bg-color-2',
    'color2' => 'bg-color-1'
])
```

#### Lime + Navy
```blade
@include('partials.decoration-element', [
    'color1' => 'bg-color-3',
    'color2' => 'bg-color-1'
])
```

#### White + Teal
```blade
@include('partials.decoration-element', [
    'color1' => 'bg-color-5',
    'color2' => 'bg-color-2'
])
```

#### Lime + Teal
```blade
@include('partials.decoration-element', [
    'color1' => 'bg-color-3',
    'color2' => 'bg-color-2'
])
```

## Complete Examples

### Section Header with Top Left Decoration
```blade
<section class="relative bg-color-5 py-80">
    @include('partials.decoration-element', [
        'size' => 'size-60',
        'color1' => 'bg-color-5',
        'color2' => 'bg-color-1',
        'position' => 'top-0 left-0'
    ])
    <div class="container">
        <h2>Section Title</h2>
        <p>Section content...</p>
    </div>
</section>
```

### Card with Bottom Right Decoration
```blade
<div class="relative p-40 bg-color-2">
    @include('partials.decoration-element', [
        'size' => 'size-40',
        'color1' => 'bg-color-3',
        'color2' => 'bg-color-1',
        'position' => 'bottom-0 right-0'
    ])
    <h3>Card Title</h3>
    <p>Card content...</p>
</div>
```

### Multiple Decorations (All Corners)
```blade
<section class="relative bg-color-5 py-80">
    {{-- Top Left --}}
    @include('partials.decoration-element', [
        'size' => 'size-60',
        'position' => 'top-0 left-0'
    ])

    {{-- Top Right --}}
    @include('partials.decoration-element', [
        'size' => 'size-60',
        'position' => 'top-0 right-0'
    ])

    {{-- Bottom Left --}}
    @include('partials.decoration-element', [
        'size' => 'size-60',
        'color1' => 'bg-color-3',
        'color2' => 'bg-color-2',
        'position' => 'bottom-0 left-0'
    ])

    {{-- Bottom Right --}}
    @include('partials.decoration-element', [
        'size' => 'size-60',
        'color1' => 'bg-color-3',
        'color2' => 'bg-color-2',
        'position' => 'bottom-0 right-0'
    ])

    <div class="container">
        <h2>Fully Decorated Section</h2>
    </div>
</section>
```

### Banner with Decoration (Belka)
```blade
<section class="relative text-center text-white bg-color-2 text-h4 px-100 lg:py-42">
    @include('partials.decoration-element', [
        'size' => 'size-60',
        'color1' => 'bg-color-5',
        'color2' => 'bg-color-1',
        'position' => 'top-0 left-0'
    ])
    <div class="container">
        <h2>Banner Content</h2>
    </div>
</section>
```

## Size Reference

| Size Class | Pixels | Usage |
|------------|--------|-------|
| `size-40` | 40px | Small cards, compact sections |
| `size-60` | 60px | Standard sections (default) |
| `size-80` | 80px | Large sections, hero areas |
| `size-100` | 100px | Extra large decorations |
| `size-120` | 120px | Massive hero sections |

## Color Palette Reference

| Color | Class | Hex | Description |
|-------|-------|-----|-------------|
| Color 1 | `bg-color-1` | #002234 | Dark Navy |
| Color 2 | `bg-color-2` | #66b0c0 | Teal |
| Color 3 | `bg-color-3` | #c2f970 | Lime Green |
| Color 4 | `bg-color-4` | #e5e9eb | Light Gray |
| Color 5 | `bg-color-5` | #ffffff | White |

## How It Works

The decoration element uses CSS clip-path to create two triangular shapes. The clip-path polygons **automatically adjust** based on the position parameter to ensure the decoration always points correctly toward the corner.

### SCSS Implementation

All clip-path styles are defined in `resources/css/components/_decoration.scss` using reusable CSS classes. This approach provides better performance, maintainability, and allows for easier customization.

**File location:** `resources/css/components/_decoration.scss`

The component uses clean class names like `clip-top-left-1`, `clip-top-right-2`, etc., instead of inline arbitrary Tailwind values.

### Position-Based Clip Paths

#### Top-Left Corner (`top-0 left-0`)
```css
/* First Triangle (Top-Left Half) */
clip-path: polygon(100% 0%, 0% 0%, 0% 100%)

/* Second Triangle (Bottom-Right Half) */
clip-path: polygon(100% 0%, 0% 100%, 100% 100%)
```

#### Top-Right Corner (`top-0 right-0`)
```css
/* First Triangle (Top-Right Half) */
clip-path: polygon(0% 0%, 100% 0%, 100% 100%)

/* Second Triangle (Bottom-Left Half) */
clip-path: polygon(0% 0%, 100% 100%, 0% 100%)
```

#### Bottom-Left Corner (`bottom-0 left-0`)
```css
/* First Triangle (Top-Left Half) */
clip-path: polygon(0% 0%, 0% 100%, 100% 100%)

/* Second Triangle (Top-Right Half) */
clip-path: polygon(0% 0%, 100% 0%, 100% 100%)
```

#### Bottom-Right Corner (`bottom-0 right-0`)
```css
/* First Triangle (Bottom-Right Half) */
clip-path: polygon(100% 0%, 100% 100%, 0% 100%)

/* Second Triangle (Top-Left Half) */
clip-path: polygon(100% 0%, 0% 0%, 0% 100%)
```

The component automatically selects the correct clip-path configuration based on your `position` parameter, so you don't need to worry about manually adjusting the triangles!

## Important Notes

1. **Parent Container Must Be Relative**
   ```blade
   <section class="relative">
       @include('partials.decoration-element')
   </section>
   ```

2. **Z-Index Considerations**
   The decoration element uses `absolute` positioning. If you need content to appear above it, add `relative z-10` to that content:
   ```blade
   <section class="relative">
       @include('partials.decoration-element')
       <div class="container relative z-10">
           Content appears above decoration
       </div>
   </section>
   ```

3. **Overflow Hidden**
   If the decoration appears outside the section boundaries, add `overflow-hidden`:
   ```blade
   <section class="relative overflow-hidden">
       @include('partials.decoration-element')
   </section>
   ```

## Real-World Usage

### Footer Belka (from footer.blade.php)
```blade
<section class="relative text-center text-white bg-color-2 text-h4 px-100 max-w-container lg:py-42">
    @include('partials.decoration-element', [
        'size' => 'size-60',
        'color1' => 'bg-color-5',
        'color2' => 'bg-color-1',
        'position' => 'top-0 left-0'
    ])
    <div class="container">
        {!! $footer_options['belka_text'] !!}
    </div>
</section>
```

## Customization Tips

### Add Custom Positions
To add new position variations:

1. **Add SCSS classes** in `resources/css/components/_decoration.scss`:
   ```scss
   // Custom center position
   .clip-center-1 {
     clip-path: polygon(0% 0%, 100% 50%, 0% 100%);
   }

   .clip-center-2 {
     clip-path: polygon(50% 0%, 0% 100%, 100% 100%);
   }
   ```

2. **Update the Blade component** in `decoration-element.blade.php`:
   ```php
   $clipPaths = [
       // ... existing positions ...
       'top-50 left-50' => [
           'clip1' => 'clip-center-1',
           'clip2' => 'clip-center-2',
       ],
   ];
   ```

### Create Different Shapes
Add new SCSS classes for completely different shapes in `_decoration.scss`:

```scss
// Right-pointing arrow
.clip-arrow-right {
  clip-path: polygon(0% 0%, 100% 50%, 0% 100%);
}

// Diamond shape
.clip-diamond {
  clip-path: polygon(50% 0%, 100% 50%, 50% 100%, 0% 50%);
}

// Pentagon
.clip-pentagon {
  clip-path: polygon(50% 0%, 100% 38%, 82% 100%, 18% 100%, 0% 38%);
}

// Circle (approximation)
.clip-circle {
  clip-path: circle(50% at 50% 50%);
}

// Star shape
.clip-star {
  clip-path: polygon(50% 0%, 61% 35%, 98% 35%, 68% 57%, 79% 91%, 50% 70%, 21% 91%, 32% 57%, 2% 35%, 39% 35%);
}
```

Then use them in your blade templates:
```blade
@include('partials.decoration-element', [
    'position' => 'custom-position',
    // Update $clipPaths in blade file to use 'clip-arrow-right'
])
```

### Opacity
Add opacity to the decoration:
```blade
@include('partials.decoration-element', [
    'color1' => 'bg-color-5/50',  {{-- 50% opacity --}}
    'color2' => 'bg-color-1/80'   {{-- 80% opacity --}}
])
```

### Rotate
Wrap in a transform container:
```blade
<div class="rotate-45">
    @include('partials.decoration-element')
</div>
```

## Browser Compatibility

The `clip-path` property is supported in all modern browsers:
- Chrome 55+
- Firefox 54+
- Safari 9.1+
- Edge 79+

For older browsers, consider adding a fallback or using progressive enhancement.
