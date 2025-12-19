# Quartz WordPress Theme Boilerplate

A modern, production-ready WordPress theme boilerplate built with **Roots/Sage**, **Tailwind CSS 4.0**, **ACF Composer**, and **Vite**.

## 🎯 Key Features

### 🎨 Fluid Responsive Design System
- **Viewport-based scaling** using calculated rem units
- Desktop: 192px base (viewport / 10)
- Mobile: 32px fixed base
- All measurements scale proportionally with viewport size
- Prevents layout shift and ensures consistent proportions

### 🎨 Tailwind CSS 4.0 with @theme Directive
- CSS variables-based design system
- Runtime-changeable theme values
- Responsive variables (different values at different breakpoints)
- All configuration in `resources/css/abstracts/_variables.scss`

### 🔧 ACF Composer Integration
- Laravel-style fluent API for Advanced Custom Fields
- Version-controlled field definitions
- DRY configuration with default field settings
- Type safety and IDE autocomplete

### ⚡ Vite Build System
- Lightning-fast Hot Module Replacement (HMR)
- Optimized production builds
- Automatic WordPress theme.json generation
- Module aliases for cleaner imports

### 🎯 Self-Hosted Fonts (From Figma Design Tokens)
- No external dependencies (GDPR compliant)
- Optimized loading with font-display: swap
- Gantari (Primary: 400, 600, 700) + Sansita (Secondary: 400 italic)

---

## 📁 Project Structure

```
Quartz/
├── app/                          # PHP Application Layer
│   ├── Fields/                   # ACF Composer field definitions
│   ├── Blocks/                   # Custom Gutenberg blocks
│   ├── Options/                  # ACF option pages
│   ├── View/Components/          # Blade components
│   ├── setup.php                 # Theme setup & root font-size script
│   ├── filters.php               # WordPress filters
│   └── assets.php                # Asset enqueuing
│
├── resources/
│   ├── css/
│   │   ├── abstracts/
│   │   │   └── _variables.scss   # ⭐ Main design system (@theme)
│   │   ├── components/
│   │   │   ├── _fonts.scss       # ⭐ Font-face declarations
│   │   │   ├── _buttons.scss
│   │   │   └── _form.scss
│   │   ├── app.scss              # Main stylesheet entry
│   │   └── editor.scss           # Block editor styles
│   │
│   ├── js/
│   │   ├── app.js                # Main JavaScript entry
│   │   ├── components/           # Reusable JS components
│   │   └── partials/             # Page-specific scripts
│   │
│   ├── fonts/                    # Self-hosted font files (.woff2)
│   ├── images/
│   └── views/                    # Blade templates
│
├── config/
│   └── acf.php                   # ⭐ ACF Composer configuration
│
├── vite.config.js                # ⭐ Vite build configuration
├── tailwind.config.js            # ⭐ Tailwind CSS configuration
├── composer.json                 # PHP dependencies
└── package.json                  # Node dependencies
```

---

## 🚀 Getting Started

### Prerequisites

- PHP 8.0+
- Composer
- Node.js 18+
- WordPress 6.0+

### Installation

1. **Clone this boilerplate** to your WordPress themes directory:
   ```bash
   cd wp-content/themes/
   git clone <your-repo-url> your-theme-name
   cd your-theme-name
   ```

2. **Install PHP dependencies**:
   ```bash
   composer install
   ```

3. **Install Node dependencies**:
   ```bash
   npm install
   ```

4. **Update configuration**:
   - In `vite.config.js`, update `base` path to match your theme folder name
   - In `style.css`, update theme information (name, description, etc.)

5. **Build assets**:
   ```bash
   # Development (with HMR)
   npm run dev

   # Production
   npm run build
   ```

6. **Activate the theme** in WordPress admin

---

## 🎨 Design System Guide

### CSS Variables & @theme Directive

All design tokens are defined in `resources/css/abstracts/_variables.scss` using Tailwind CSS 4.0's `@theme` directive.

#### Color System
```scss
// Define in _variables.scss
--color-color-1: #0F529E;  /* Primary Blue */
--color-color-2: #E52F3D;  /* Secondary Cyan */
```

```html
<!-- Use in HTML -->
<div class="bg-color-1 text-color-2">...</div>
```

#### Typography Scale
```scss
// Heading styles with size, line-height, and weight
--text-h1: 0.375rem;              /* 72px at 1920px viewport */
--text-h1--line-height: 0.417rem; /* 80px */
--text-h1--font-weight: 800;
```

```html
<!-- Use in HTML -->
<h1 class="text-h1">Main Heading</h1>
```

#### Border Radius
```scss
--radius-40: 0.208rem;  /* 40px at desktop, scales on mobile */
```

```html
<div class="rounded-40">...</div>
```

### Responsive Design

Variables automatically recalculate at mobile breakpoint (max-width: 1023px):

```scss
// Desktop (quotient: 192)
--text-h1: #{px-rem(72, 192)};

// Mobile (quotient: 32)
@media (max-width: 1023px) {
  --text-h1: #{px-rem(56, 32)};
}
```

### Root Font Size System

The theme dynamically sets root font-size via JavaScript (see `app/setup.php:112`):

```javascript
// Desktop: viewport width / 10 = base font size
// At 1920px: 1920 / 10 = 192px = 1rem
// At 1440px: 1440 / 10 = 144px = 1rem

// Mobile: Fixed 32px
const vw = window.innerWidth;
const fs = vw >= 1024 ? (vw / 10) : 32;
document.documentElement.style.fontSize = fs + 'px';
```

This creates a **truly fluid** responsive system where all rem-based values scale with viewport.

---

## 🔧 ACF Composer Guide

### Creating Field Groups

1. **Create a new field class** in `app/Fields/`:

```php
<?php

namespace App\Fields;

use Log1x\AcfComposer\Builder;
use Log1x\AcfComposer\Field;

class HomePage extends Field
{
    /**
     * The field group name
     */
    public string $name = 'Home Page';

    /**
     * Build the field group
     */
    public function fields(): array
    {
        $builder = Builder::make('home_page');

        // Set location (where this field group appears)
        $builder->setLocation('page_template', '==', 'template-home.blade.php');

        // Add fields using fluent API
        $builder
            ->addTab('hero_section', ['label' => 'Hero Section'])
            ->addText('hero_title', [
                'label' => 'Hero Title',
                'instructions' => 'Main headline for hero section',
                'default_value' => 'Welcome to our site',
            ])
            ->addWysiwyg('hero_content', [
                'label' => 'Hero Content',
                'toolbar' => 'basic',
            ])
            ->addImage('hero_image', [
                'label' => 'Hero Background Image',
                'return_format' => 'array',
            ])

            // Repeater field example
            ->addRepeater('features', [
                'label' => 'Features',
                'button_label' => 'Add Feature',
            ])
                ->addText('feature_title', ['label' => 'Title'])
                ->addTextarea('feature_description', ['label' => 'Description'])
                ->addImage('feature_icon', ['label' => 'Icon'])
            ->endRepeater();

        return $builder->build();
    }
}
```

2. **Default field settings** are configured in `config/acf.php`:
   - All `trueFalse` fields show as toggles
   - All `select` fields use enhanced UI
   - All `repeater` fields use block layout with stylized buttons
   - Instructions display as tooltips (ACF Extended)

3. **Access field values** in Blade templates:

```php
{{-- In template-home.blade.php --}}
<h1>{{ get_field('hero_title') }}</h1>

@if(get_field('features'))
  @foreach(get_field('features') as $feature)
    <div class="feature">
      <h3>{{ $feature['feature_title'] }}</h3>
      <p>{{ $feature['feature_description'] }}</p>
    </div>
  @endforeach
@endif
```

### Useful Field Methods

```php
// Text inputs
->addText('field_name', [])
->addTextarea('field_name', [])
->addWysiwyg('field_name', [])

// Media
->addImage('field_name', [])
->addGallery('field_name', [])
->addFile('field_name', [])

// Choice fields
->addSelect('field_name', ['choices' => ['value' => 'Label']])
->addCheckbox('field_name', ['choices' => []])
->addRadio('field_name', ['choices' => []])
->addTrueFalse('field_name', [])

// Relational
->addPostObject('field_name', [])
->addRelationship('field_name', [])
->addTaxonomy('field_name', [])

// Layout
->addGroup('field_name', [])
->addRepeater('field_name', [])
->addFlexibleContent('field_name', [])
->addTab('tab_name', [])
->addAccordion('accordion_name', [])
```

---

## ⚡ Vite Development

### Commands

```bash
# Start development server with HMR
npm run dev

# Build for production
npm run build

# Translation workflow
npm run translate        # Generate .pot and update .po files
npm run translate:pot    # Generate .pot file
npm run translate:compile # Compile translations
```

### Module Aliases

Use clean import paths:

```javascript
// Instead of: import '../../../resources/js/components/Slider'
import Slider from '@scripts/components/Slider'

// Instead of: import '../../../resources/css/components/buttons.scss'
import '@styles/components/buttons.scss'

// Images
import logo from '@images/logo.svg'
```

### Hot Module Replacement (HMR)

When running `npm run dev`:
- CSS changes apply instantly without page reload
- JavaScript changes reload the page automatically
- Blade template changes trigger page refresh

---

## 🎯 Customization Guide

### Change Colors

Edit `resources/css/abstracts/_variables.scss`:

```scss
@theme {
  // Update these colors
  --color-color-1: #YOUR_PRIMARY_COLOR;
  --color-color-2: #YOUR_SECONDARY_COLOR;
  --color-color-3: #YOUR_DARK_COLOR;
}
```

### Change Fonts

**Current Fonts (From Figma):**
- Primary: Gantari (400, 600, 700)
- Secondary: Sansita (400 italic)

**To change fonts:**

1. Download `.woff2` files from [google-webfonts-helper](https://gwfh.mranftl.com/fonts)
   - [Gantari](https://gwfh.mranftl.com/fonts/gantari)
   - [Sansita](https://gwfh.mranftl.com/fonts/sansita)
2. Place files in `resources/fonts/`
3. Add `@font-face` declarations in `resources/css/components/_fonts.scss`
4. Update font variables in `resources/css/abstracts/_variables.scss`:

```scss
--font-primary: 'Gantari', sans-serif;
--font-secondary: 'Sansita', sans-serif;
```

5. Run `npm run build`

📚 **See [DESIGN-TOKENS.md](./DESIGN-TOKENS.md) for complete font specifications.**

### Add New Typography Styles

In `resources/css/abstracts/_variables.scss`:

```scss
@theme {
  // Desktop
  --text-custom: #{px-rem(24, 192)};
  --text-custom--line-height: #{px-rem(32, 192)};
  --text-custom--font-weight: 600;
}

@media (max-width: 1023px) {
  :root {
    // Mobile
    --text-custom: #{px-rem(20, 32)};
    --text-custom--line-height: #{px-rem(28, 32)};
  }
}
```

Usage:
```html
<p class="text-custom">Custom styled text</p>
```

### Modify Responsive Breakpoint

Change the mobile breakpoint in `resources/css/abstracts/_variables.scss`:

```scss
// Change from 1023px to your preferred breakpoint
@media (max-width: 768px) {
  // Mobile variables...
}
```

Also update in `app/setup.php`:

```javascript
const fs = vw >= 769 ? (vw / 10) : 32; // Match your breakpoint
```

---

## 📚 Key Files Reference

| File | Purpose |
|------|---------|
| `resources/css/abstracts/_variables.scss` | Main design system (colors, typography, spacing) |
| `resources/css/components/_fonts.scss` | Font-face declarations |
| `config/acf.php` | ACF Composer configuration |
| `vite.config.js` | Vite build configuration |
| `tailwind.config.js` | Tailwind CSS configuration |
| `app/setup.php` | Theme setup & root font-size script (line 112) |
| `app/Fields/` | ACF field group definitions |

---

## 🔍 Common Tasks

### Create a New Page Template

1. Create Blade template in `resources/views/`:
   ```php
   {{-- template-custom.blade.php --}}
   {{--
     Template Name: Custom Template
   --}}

   @extends('layouts.app')

   @section('content')
     <h1>{{ get_field('page_title') }}</h1>
   @endsection
   ```

2. Create ACF fields in `app/Fields/CustomPage.php`
3. Build and test

### Add Custom JavaScript Component

1. Create file in `resources/js/components/`:
   ```javascript
   // MyComponent.js
   export default function initMyComponent() {
     // Your code
   }
   ```

2. Import and initialize in `resources/js/app.js`:
   ```javascript
   import initMyComponent from '@scripts/components/MyComponent';

   domReady(async () => {
     initMyComponent();
   });
   ```

### Add Custom SCSS Component

1. Create file in `resources/css/components/_mycomponent.scss`
2. Import in `resources/css/app.scss`:
   ```scss
   @import 'components/mycomponent';
   ```

---

## 🛠️ Troubleshooting

### Assets not loading after build

1. Verify `base` path in `vite.config.js` matches your theme folder name
2. Clear WordPress cache
3. Hard refresh browser (Cmd+Shift+R / Ctrl+Shift+F5)

### ACF fields not showing

1. Clear ACF cache: `wp acorn acf:clear`
2. Rebuild cache: `wp acorn acf:cache`
3. Verify field location rules in your Field class

### HMR not working

1. Check that `npm run dev` is running
2. Verify you're accessing the site via the correct URL
3. Check browser console for WebSocket errors

### Fonts not loading

1. Verify font files exist in `resources/fonts/`
2. Check paths in `_fonts.scss` are correct (relative to CSS file)
3. Clear browser cache and rebuild: `npm run build`

---

## 📖 Documentation Links

### Internal Documentation
- [DESIGN-TOKENS.md](./DESIGN-TOKENS.md) - Complete design tokens from Figma
- [BOILERPLATE-GUIDE.md](./BOILERPLATE-GUIDE.md) - Detailed development guide
- [QUICK-REFERENCE.md](./QUICK-REFERENCE.md) - Quick reference cheat sheet

### External Resources
- [Roots/Sage Documentation](https://roots.io/sage/docs/)
- [ACF Composer Documentation](https://github.com/Log1x/acf-composer)
- [Tailwind CSS 4.0 Beta](https://tailwindcss.com/docs/v4-beta)
- [Vite Documentation](https://vitejs.dev)
- [Blade Templates](https://laravel.com/docs/blade)

---

## 📝 License

This boilerplate is based on the Quartz project patterns and best practices.

---

## 🤝 Contributing

Feel free to customize this boilerplate for your projects. Key patterns to maintain:

1. **Fluid responsive design system** (root font-size scaling)
2. **CSS variables via @theme directive** (Tailwind 4.0)
3. **ACF Composer** for version-controlled fields
4. **Self-hosted fonts** for performance and GDPR
5. **Vite** for modern build tooling

---

Happy coding! 🚀
