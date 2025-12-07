# 🎨 Design Tokens Reference

> Complete design system exported from Figma and implemented in the boilerplate

This document provides a complete reference of design tokens exported from Figma. These tokens are implemented in `resources/css/abstracts/_variables.scss` and available throughout the project.

---

## Table of Contents

1. [Color Palette](#color-palette)
2. [Typography System](#typography-system)
3. [Font Families](#font-families)
4. [Shadows](#shadows)
5. [Usage Examples](#usage-examples)

---

## Color Palette

All colors exported from Figma design system:

| Token | Hex Value | Description | Usage |
|-------|-----------|-------------|-------|
| `color-1` | `#002234` | Dark Navy/Blue | Primary dark color, headers, text |
| `color-2` | `#66b0c0` | Teal/Cyan | Secondary color, accents, CTAs |
| `color-3` | `#c2f970` | Lime Green | Accent color, highlights |
| `color-4` | `#e5e9eb` | Light Gray | Backgrounds, borders |
| `color-5` | `#ffffff` | White | Backgrounds, text on dark |

### Usage in Code

```html
<!-- Backgrounds -->
<div class="bg-color-1">Dark navy background</div>
<div class="bg-color-2">Teal background</div>
<div class="bg-color-3">Lime green background</div>
<div class="bg-color-4">Light gray background</div>
<div class="bg-color-5">White background</div>

<!-- Text Colors -->
<h1 class="text-color-1">Dark navy text</h1>
<p class="text-color-2">Teal text</p>
<span class="text-color-3">Lime green text</span>

<!-- Borders -->
<div class="border border-color-4">Light gray border</div>

<!-- Opacity Variants -->
<div class="bg-color-1/10">10% opacity</div>
<div class="bg-color-2/20">20% opacity</div>
```

### CSS Variables

```css
/* In your custom CSS */
.custom-element {
  background-color: var(--color-color-1);
  color: var(--color-color-5);
  border-color: var(--color-color-4);
}
```

---

## Typography System

Complete typography scale from Figma with exact specifications.

### Headings

#### Heading 1 (H1)
- **Desktop:** 62px / 64px line-height / 600 weight
- **Mobile:** 48px / 52px line-height / 600 weight
- **Font:** Gantari Semi-Bold
- **Class:** `text-h1`

```html
<h1 class="text-h1">Main Page Heading</h1>
```

#### Heading 2 (H2)
- **Desktop:** 48px / 62px line-height / 600 weight
- **Mobile:** 38px / 44px line-height / 600 weight
- **Font:** Gantari Semi-Bold
- **Class:** `text-h2`

```html
<h2 class="text-h2">Section Heading</h2>
```

#### Heading 3 (H3)
- **Desktop:** 38px / 44px line-height / 600 weight
- **Mobile:** 28px / 34px line-height / 600 weight
- **Font:** Gantari Semi-Bold
- **Class:** `text-h3`

```html
<h3 class="text-h3">Subsection Heading</h3>
```

#### Heading 4 (H4)
- **Desktop:** 28px / 36px line-height / 600 weight
- **Mobile:** 24px / 30px line-height / 600 weight
- **Font:** Gantari Semi-Bold
- **Class:** `text-h4`

```html
<h4 class="text-h4">Card Title</h4>
```

#### Heading 5 (H5)
- **Desktop:** 22px / 30px line-height / 600 weight
- **Mobile:** 18px / 24px line-height / 600 weight
- **Font:** Gantari Semi-Bold
- **Class:** `text-h5`

```html
<h5 class="text-h5">Small Heading</h5>
```

### Body Text

#### Text 18
- **Desktop:** 18px / 26px line-height / 400 weight
- **Mobile:** 18px / 26px line-height / 400 weight
- **Font:** Gantari Regular
- **Class:** `text-18`

```html
<p class="text-18">Large body text for emphasis</p>
```

#### Text 16
- **Desktop:** 16px / 24px line-height / 400 weight
- **Mobile:** 16px / 24px line-height / 400 weight
- **Font:** Gantari Regular
- **Class:** `text-16`

```html
<p class="text-16">Standard body text</p>
```

### Component-Specific Typography

#### Menu/Navigation (menu)
- **Desktop:** 18px / 24px line-height / 700 weight
- **Mobile:** 18px / 24px line-height / 700 weight
- **Font:** Gantari Bold
- **Class:** `text-menu`

```html
<a href="#" class="text-menu">Menu Item</a>
```

#### Button (przycisk)
- **Desktop:** 16px / 18px line-height / 600 weight
- **Mobile:** 16px / 18px line-height / 600 weight
- **Font:** Gantari Semi-Bold
- **Class:** `text-button`

```html
<button class="text-button">Click Me</button>
```

#### Section Header (nagłówek)
- **Desktop:** 20px / 32px line-height / 600 weight / 2px letter-spacing / UPPERCASE
- **Mobile:** 18px / 28px line-height / 600 weight / 2px letter-spacing / UPPERCASE
- **Font:** Gantari Semi-Bold
- **Class:** `text-naglowek`

```html
<h6 class="text-naglowek">SECTION HEADER</h6>
```

#### Footer Menu (menu-stopka)
- **Desktop:** 18px / 30px line-height / 700 weight / 0.9px letter-spacing
- **Mobile:** 18px / 30px line-height / 700 weight / 0.9px letter-spacing
- **Font:** Gantari Bold
- **Class:** `text-menu-stopka`

```html
<a href="#" class="text-menu-stopka">Footer Link</a>
```

#### Legal/Consent Text (zgody_formularz)
- **Desktop:** 12px / 20px line-height / 400 weight
- **Mobile:** 12px / 20px line-height / 400 weight
- **Font:** Gantari Regular
- **Class:** `text-zgody`

```html
<p class="text-zgody">I agree to the terms and conditions</p>
```

#### Testimonial/Opinion (opinia)
- **Desktop:** 20px / 30px line-height / 400 weight / italic
- **Mobile:** 18px / 26px line-height / 400 weight / italic
- **Font:** Sansita Regular Italic
- **Class:** `text-opinia`

```html
<blockquote class="text-opinia">
  "This is an amazing testimonial from a satisfied customer."
</blockquote>
```

---

## Font Families

### Primary Font: Gantari

**Source:** Google Fonts
**Weights Required:** 400 (Regular), 600 (Semi-Bold), 700 (Bold)
**Usage:** All UI elements, headings, body text, buttons, menus

#### Download Instructions
1. Visit [Google Webfonts Helper - Gantari](https://gwfh.mranftl.com/fonts/gantari)
2. Select weights: 400, 600, 700
3. Select charsets: latin, latin-ext
4. Download .woff2 files
5. Place in `resources/fonts/` with filenames:
   - `gantari-v1-latin-400.woff2`
   - `gantari-v1-latin-600.woff2`
   - `gantari-v1-latin-700.woff2`

#### CSS Variable
```css
font-family: var(--font-primary);
/* or */
font-family: 'Gantari', sans-serif;
```

#### Tailwind Class
```html
<div class="font-primary">Text in Gantari</div>
```

### Secondary Font: Sansita

**Source:** Google Fonts
**Weights Required:** 400 italic
**Usage:** Testimonials, quotes, decorative text

#### Download Instructions
1. Visit [Google Webfonts Helper - Sansita](https://gwfh.mranftl.com/fonts/sansita)
2. Select weight: 400 italic
3. Select charsets: latin, latin-ext
4. Download .woff2 file
5. Place in `resources/fonts/` with filename:
   - `sansita-v11-latin-400italic.woff2`

#### CSS Variable
```css
font-family: var(--font-secondary);
/* or */
font-family: 'Sansita', sans-serif;
```

#### Tailwind Class
```html
<blockquote class="font-secondary italic text-opinia">
  Testimonial text
</blockquote>
```

---

## Shadows

Two shadow effects from Figma:

### Shadow 1 (cien-1)
- **Offset:** 30px, 30px
- **Blur:** 50px
- **Color:** rgba(7, 24, 44, 0.2)
- **Type:** Drop shadow

```html
<div class="shadow-cien-1-1">Card with shadow 1</div>
```

```css
/* CSS Variable */
.element {
  box-shadow: var(--shadow-cien-1-1);
}
```

### Shadow 2 (cien-2)
- **Offset:** 30px, 40px
- **Blur:** 40px
- **Color:** rgba(7, 24, 44, 0.15)
- **Type:** Drop shadow

```html
<div class="shadow-cien-1-2">Card with shadow 2</div>
```

```css
/* CSS Variable */
.element {
  box-shadow: var(--shadow-cien-1-2);
}
```

---

## Usage Examples

### Complete Component Example

```html
<!-- Hero Section with Figma Design Tokens -->
<section class="py-80 bg-color-5">
  <div class="container">
    <!-- Main Heading -->
    <h1 class="text-h1 text-color-1">
      Welcome to Our Platform
    </h1>

    <!-- Subheading -->
    <p class="mt-20 text-18 text-color-1">
      Discover amazing features designed for your success.
    </p>

    <!-- CTA Button -->
    <button class="mt-40 px-40 py-16 bg-color-2 text-color-5 rounded-8 text-button hover:bg-color-1 transition-colors">
      Get Started
    </button>

    <!-- Card with Shadow -->
    <div class="mt-60 p-40 bg-color-5 rounded-20 shadow-cien-1-1">
      <h3 class="text-h3 text-color-1">Feature Highlight</h3>
      <p class="mt-16 text-16 text-color-1">
        This is a description of an amazing feature.
      </p>

      <!-- Testimonial -->
      <blockquote class="mt-30 p-30 bg-color-4 rounded-12">
        <p class="text-opinia text-color-1">
          "This platform has transformed our business completely."
        </p>
      </blockquote>
    </div>
  </div>
</section>
```

### Navigation Menu Example

```html
<nav class="bg-color-1">
  <div class="container py-20">
    <ul class="flex gap-40">
      <li><a href="#" class="text-menu text-color-5 hover:text-color-2">Home</a></li>
      <li><a href="#" class="text-menu text-color-5 hover:text-color-2">About</a></li>
      <li><a href="#" class="text-menu text-color-5 hover:text-color-2">Services</a></li>
      <li><a href="#" class="text-menu text-color-5 hover:text-color-2">Contact</a></li>
    </ul>
  </div>
</nav>
```

### Form with Legal Text

```html
<form class="p-40 bg-color-5 rounded-20 shadow-cien-1-2">
  <h3 class="text-h3 text-color-1">Contact Us</h3>

  <input type="text"
         class="mt-20 w-full px-20 py-12 border border-color-4 rounded-8 text-16"
         placeholder="Your name">

  <input type="email"
         class="mt-16 w-full px-20 py-12 border border-color-4 rounded-8 text-16"
         placeholder="Your email">

  <textarea
    class="mt-16 w-full px-20 py-12 border border-color-4 rounded-8 text-16"
    rows="4"
    placeholder="Your message"></textarea>

  <label class="flex items-start gap-8 mt-20">
    <input type="checkbox" class="mt-4">
    <span class="text-zgody text-color-1">
      I agree to the processing of my personal data in accordance with the privacy policy.
    </span>
  </label>

  <button class="mt-30 px-40 py-16 bg-color-2 text-color-5 rounded-8 text-button hover:bg-color-1 transition-colors">
    Send Message
  </button>
</form>
```

---

## Responsive Behavior

All typography automatically adjusts for mobile devices (max-width: 1023px):

```html
<!-- This heading is 62px on desktop, 48px on mobile -->
<h1 class="text-h1">Responsive Heading</h1>

<!-- This text is 18px on both desktop and mobile -->
<p class="text-18">Body text</p>
```

The fluid responsive system ensures perfect scaling across all screen sizes using the dynamic root font-size calculation.

---

## Implementation Checklist

When starting a new project with these design tokens:

- [ ] Download Gantari font files (400, 600, 700)
- [ ] Download Sansita font file (400 italic)
- [ ] Place font files in `resources/fonts/`
- [ ] Verify `resources/css/abstracts/_variables.scss` has correct colors
- [ ] Verify `resources/css/components/_fonts.scss` has @font-face declarations
- [ ] Run `npm run build` to compile CSS
- [ ] Test typography on desktop and mobile
- [ ] Test color contrast for accessibility
- [ ] Test shadows on different backgrounds

---

## Design Token Sources

These design tokens were exported from Figma using the [Figma Design Tokens](https://www.figma.com/community/plugin/888356646278934516/Design-Tokens) plugin.

**Export Format:** JSON
**Export Date:** 2025
**Design System:** LogoTape Project

---

**For additional documentation, see:**
- [BOILERPLATE-README.md](./BOILERPLATE-README.md) - General boilerplate documentation
- [BOILERPLATE-GUIDE.md](./BOILERPLATE-GUIDE.md) - Complete development guide
- [QUICK-REFERENCE.md](./QUICK-REFERENCE.md) - Quick reference cheat sheet
