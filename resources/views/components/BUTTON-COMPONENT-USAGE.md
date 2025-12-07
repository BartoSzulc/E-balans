# Button Component Usage

This file demonstrates how to use the reusable button component.

## Location
`resources/views/components/button.blade.php`

## Basic Usage

### Simple Button
```blade
<x-button>
    Click Me
</x-button>
```

### Button with Link
```blade
<x-button href="/contact">
    Contact Us
</x-button>
```

## Variants

### Primary (Default)
```blade
<x-button variant="primary">
    Primary Button
</x-button>
```

### Secondary
```blade
<x-button variant="secondary">
    Secondary Button
</x-button>
```

### Accent
```blade
<x-button variant="accent">
    Accent Button
</x-button>
```

### Outline
```blade
<x-button variant="outline">
    Outline Button
</x-button>
```

## Sizes

### Small
```blade
<x-button size="small">
    Small Button
</x-button>
```

### Medium (Default)
```blade
<x-button size="medium">
    Medium Button
</x-button>
```

### Large
```blade
<x-button size="large">
    Large Button
</x-button>
```

## Border Styles

### Dashed (Default)
```blade
<x-button border="dashed">
    Dashed Border
</x-button>
```

### Solid
```blade
<x-button border="solid">
    Solid Border
</x-button>
```

## With Icons

### Icon on Right (Default)
```blade
<x-button icon="<svg>...</svg>">
    Next
</x-button>
```

### Icon on Left
```blade
<x-button icon="<svg>...</svg>" iconPosition="left">
    Previous
</x-button>
```

### Icon Only
```blade
<x-button icon="<svg>...</svg>">
</x-button>
```

## Button Groups

### Horizontal Group
```blade
<div class="flex gap-16">
    <x-button variant="primary">Button 1</x-button>
    <x-button variant="secondary">Button 2</x-button>
    <x-button variant="accent">Button 3</x-button>
</div>
```

### Responsive Group
```blade
<div class="flex flex-col lg:flex-row gap-16">
    <x-button>Mobile Stack</x-button>
    <x-button>Desktop Row</x-button>
</div>
```

## Advanced Examples

### CTA Section with Multiple Buttons
```blade
<section class="py-80 text-center">
    <h2 class="text-h2 mb-40">Ready to get started?</h2>
    <div class="flex flex-col lg:flex-row gap-16 justify-center">
        <x-button href="/contact" variant="primary" size="large">
            Get Started
        </x-button>
        <x-button href="/about" variant="outline" size="large">
            Learn More
        </x-button>
    </div>
</section>
```

### Form Submit Buttons
```blade
<div class="flex gap-16 justify-end">
    <x-button type="button" variant="outline">
        Cancel
    </x-button>
    <x-button type="submit" variant="primary">
        Submit
    </x-button>
</div>
```

### ACF Button Repeater Integration
```blade
@if(isset($section['buttons']) && is_array($section['buttons']))
    <div class="flex gap-16">
        @foreach($section['buttons'] as $button)
            <x-button
                href="{{ $button['link']['url'] ?? '#' }}"
                variant="{{ $button['variant'] ?? 'primary' }}"
                size="{{ $button['size'] ?? 'medium' }}">
                {{ $button['link']['title'] ?? 'Click Here' }}
            </x-button>
        @endforeach
    </div>
@endif
```

### Navigation Buttons
```blade
<nav class="flex gap-16">
    <x-button
        variant="outline"
        size="small"
        icon="<svg><!-- prev icon --></svg>"
        iconPosition="left"
        disabled>
        Previous
    </x-button>
    <x-button
        variant="outline"
        size="small"
        icon="<svg><!-- next icon --></svg>"
        iconPosition="right">
        Next
    </x-button>
</nav>
```

## Custom Classes

You can add custom classes using standard attributes:

```blade
<x-button class="custom-class another-class">
    Custom Button
</x-button>
```

## All Props

| Prop | Type | Default | Options |
|------|------|---------|---------|
| `variant` | string | `'primary'` | `'primary'`, `'secondary'`, `'accent'`, `'outline'` |
| `border` | string | `'dashed'` | `'dashed'`, `'solid'` |
| `size` | string | `'medium'` | `'small'`, `'medium'`, `'large'` |
| `icon` | string | `null` | Any HTML/SVG string |
| `iconPosition` | string | `'right'` | `'left'`, `'right'` |
| `href` | string | `null` | Any URL (renders as `<a>` tag) |
| `type` | string | `'button'` | `'button'`, `'submit'`, `'reset'` |

## Included Styles

All buttons include:
- ✅ `flex items-center gap-16` - Flexbox layout with gap
- ✅ `border-1` - 1px border width
- ✅ `border-dashed` or `border-solid` - Border style
- ✅ `transition-all duration-300` - Smooth transitions
- ✅ `hover:border-solid` - Solid border on hover
- ✅ `active:scale-95` - Scale down on click
- ✅ `focus:outline-none focus:ring-2 focus:ring-offset-2` - Keyboard focus ring

## Examples in Context

### Hero Section CTA
```blade
<section class="hero">
    <h1>Welcome to Our Site</h1>
    <p>Discover amazing features</p>
    <div class="flex gap-16 justify-center mt-40">
        <x-button href="/signup" variant="primary" size="large">
            Sign Up Now
        </x-button>
        <x-button href="/demo" variant="outline" size="large">
            Watch Demo
        </x-button>
    </div>
</section>
```

### Product Card
```blade
<div class="product-card">
    <img src="product.jpg" alt="Product">
    <h3>Product Name</h3>
    <p class="price">$99.99</p>
    <div class="flex flex-col gap-16">
        <x-button variant="primary" size="medium">
            Add to Cart
        </x-button>
        <x-button variant="outline" size="small">
            View Details
        </x-button>
    </div>
</div>
```

### Filter Bar
```blade
<div class="filter-bar flex flex-wrap gap-16">
    <x-button variant="primary" size="small" class="active">
        All
    </x-button>
    <x-button variant="outline" size="small">
        Category 1
    </x-button>
    <x-button variant="outline" size="small">
        Category 2
    </x-button>
    <x-button variant="outline" size="small">
        Category 3
    </x-button>
</div>
```
