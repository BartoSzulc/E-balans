/**
 * ═══════════════════════════════════════════════════════════════════════════
 * VITE CONFIGURATION
 * ═══════════════════════════════════════════════════════════════════════════
 *
 * Vite is a modern build tool that provides:
 * ✓ Lightning-fast Hot Module Replacement (HMR) during development
 * ✓ Optimized production builds with code splitting
 * ✓ Native ES modules support
 * ✓ Tailwind CSS 4.0 integration
 * ✓ WordPress theme.json generation
 *
 * COMMANDS:
 * - npm run dev   → Start development server with HMR
 * - npm run build → Build optimized assets for production
 *
 * DOCUMENTATION:
 * - Vite: https://vitejs.dev
 * - Laravel Vite Plugin: https://laravel.com/docs/vite
 * - Roots Vite Plugin: https://github.com/roots/vite-plugin
 *
 * ═══════════════════════════════════════════════════════════════════════════
 */

import { defineConfig } from 'vite'
import tailwindcss from '@tailwindcss/vite';
import laravel from 'laravel-vite-plugin'
import { wordpressPlugin, wordpressThemeJson } from '@roots/vite-plugin';

export default defineConfig({
  /**
   * ─────────────────────────────────────────────────────────────────────────
   * BASE PATH
   * ─────────────────────────────────────────────────────────────────────────
   * Public base path when served in production
   * IMPORTANT: Update 'Quartz' to match your theme folder name
   */
  base: '/wp-content/themes/LogoTape/public/build/',

  /**
   * ─────────────────────────────────────────────────────────────────────────
   * DEVELOPMENT SERVER (OPTIONAL)
   * ─────────────────────────────────────────────────────────────────────────
   * Uncomment and configure for network access during development
   * Useful for testing on mobile devices or virtual machines
   */
  // server: {
  //   host: '0.0.0.0',              // Allow access from network
  //   port: 5173,                   // Development server port
  //   cors: true,                   // Enable CORS
  //   origin: 'http://YOUR_IP:5173', // Replace with your IP address
  //   hmr: {
  //     protocol: 'ws',             // WebSocket protocol for HMR
  //     host: 'YOUR_IP',            // Replace with your IP address
  //     port: 5173,
  //   },
  // },

  /**
   * ─────────────────────────────────────────────────────────────────────────
   * PLUGINS
   * ─────────────────────────────────────────────────────────────────────────
   */
  plugins: [
    /**
     * TAILWIND CSS 4.0 PLUGIN
     * Enables Tailwind CSS 4.0 with @theme directive support
     * Configuration in resources/css/abstracts/_variables.scss
     */
    tailwindcss(),

    /**
     * LARAVEL VITE PLUGIN
     * Provides seamless integration with Laravel/Sage themes
     *
     * Features:
     * - Hot Module Replacement (HMR) during development
     * - Automatic asset refresh on file changes
     * - Asset manifest generation
     * - Proper URL generation for production builds
     */
    laravel({
      input: [
        'resources/css/app.css',      // Main stylesheet
        'resources/js/app.js',        // Main JavaScript
        'resources/css/editor.css',   // WordPress block editor styles
        'resources/js/editor.js',     // Block editor JavaScript
      ],
      refresh: true, // Enable full page refresh on blade template changes
    }),

    /**
     * WORDPRESS PLUGIN
     * Provides WordPress-specific functionality and helpers
     */
    wordpressPlugin(),

    /**
     * THEME.JSON GENERATOR
     * Automatically generates WordPress theme.json from Tailwind config
     *
     * This enables:
     * - Block editor color palettes from Tailwind colors
     * - Typography presets from Tailwind font configuration
     * - Font size options in the block editor
     *
     * Generated file: public/build/assets/theme.json
     */
    wordpressThemeJson({
      disableTailwindColors: false,    // Include Tailwind colors in theme.json
      disableTailwindFonts: false,     // Include Tailwind fonts in theme.json
      disableTailwindFontSizes: false, // Include Tailwind font sizes in theme.json
    }),
  ],

  /**
   * ─────────────────────────────────────────────────────────────────────────
   * MODULE ALIASES
   * ─────────────────────────────────────────────────────────────────────────
   * Shorthand paths for cleaner imports
   *
   * USAGE:
   *   import Component from '@scripts/components/Component'
   *   import '@styles/components/buttons.scss'
   *   import logo from '@images/logo.svg'
   *
   * Instead of:
   *   import Component from '../../../resources/js/components/Component'
   */
  resolve: {
    alias: {
      '@scripts': '/resources/js',
      '@styles': '/resources/css',
      '@fonts': '/resources/fonts',
      '@images': '/resources/images',
    },
  },
})
