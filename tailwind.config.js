/**
 * ═══════════════════════════════════════════════════════════════════════════
 * TAILWIND CSS CONFIGURATION
 * ═══════════════════════════════════════════════════════════════════════════
 *
 * TAILWIND CSS 4.0 WITH @THEME DIRECTIVE
 *
 * This boilerplate uses Tailwind CSS 4.0 which introduces a new @theme
 * directive that allows you to define your design system using CSS variables
 * directly in your stylesheets.
 *
 * CONFIGURATION LOCATIONS:
 * - Main theme variables → resources/css/abstracts/_variables.scss
 * - This file (tailwind.config.js) is minimal by design
 *
 * WHY THIS APPROACH?
 * ✓ CSS variables are more flexible and can be changed at runtime
 * ✓ Better for responsive design (different values at different breakpoints)
 * ✓ Easier to maintain in one location
 * ✓ Supports the fluid responsive design pattern used in this boilerplate
 *
 * DOCUMENTATION:
 * - Tailwind CSS 4.0: https://tailwindcss.com/docs/v4-beta
 * - @theme directive: https://tailwindcss.com/docs/v4-beta#theme-configuration
 *
 * ═══════════════════════════════════════════════════════════════════════════
 */

module.exports = {
  /**
   * ─────────────────────────────────────────────────────────────────────────
   * CONTENT PATHS
   * ─────────────────────────────────────────────────────────────────────────
   * Files to scan for Tailwind class usage (for JIT compilation)
   * Tailwind will only include classes that are actually used
   */
  content: [
    './app/**/*.php',              // PHP files (Blade templates, field definitions)
    './resources/**/*.{php,vue,js}' // Resources (views, components, JavaScript)
  ],

  /**
   * ─────────────────────────────────────────────────────────────────────────
   * THEME CONFIGURATION
   * ─────────────────────────────────────────────────────────────────────────
   * Most theme configuration is in resources/css/abstracts/_variables.scss
   * using the @theme directive (Tailwind CSS 4.0 feature)
   */
  theme: {
    extend: {
      /**
       * ───────────────────────────────────────────────────────────────────
       * ARBITRARY VALUE SHORTCUTS
       * ───────────────────────────────────────────────────────────────────
       * Allows using pixel values that automatically convert to rem units
       * using the fluid responsive design system
       *
       * USAGE:
       *   <div class="w-px-[100]">   → width: calc(var(--pixel-to-rem) * 100)
       *   <div class="h-px-[200]">   → height: calc(var(--pixel-to-rem) * 200)
       *   <div class="mt-px-[32]">   → margin-top: calc(var(--pixel-to-rem) * 32)
       *   <div class="p-px-[16]">    → padding: calc(var(--pixel-to-rem) * 16)
       *
       * HOW IT WORKS:
       * - The --pixel-to-rem variable is set in setup.php
       * - Desktop: viewport width / 10 / 192 (e.g., 1920px / 10 / 192 = 1rem)
       * - Mobile: Fixed 32px base
       * - All values scale proportionally with viewport size
       *
       * NOTE: This is optional. You can also use the standard Tailwind
       * spacing scale (w-4, h-8, etc.) or CSS variables (w-[var(--spacing)])
       */
      arbitrary: {
        width: {
          px: (value) => `calc(var(--pixel-to-rem) * ${value})`,
        },
        height: {
          px: (value) => `calc(var(--pixel-to-rem) * ${value})`,
        },
        margin: {
          px: (value) => `calc(var(--pixel-to-rem) * ${value})`,
        },
        padding: {
          px: (value) => `calc(var(--pixel-to-rem) * ${value})`,
        },
      },
    },
  },
};
