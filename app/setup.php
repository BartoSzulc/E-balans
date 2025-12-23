<?php

/**
 * Theme setup.
 */

namespace App;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Vite;
//use App\Setup\PostFilterSetup;
//use App\Setup\CaseStudyFilterSetup;
//use App\Blocks;

/**

 * Inject styles into the block editor.
 *
 * @return array
 */
add_filter('block_editor_settings_all', function ($settings) {
    $style = Vite::asset('resources/css/editor.css');

    $settings['styles'][] = [
       'css' => "@import url('{$style}')",
    ];

    return $settings;
});
/**
 * Inject scripts into the block editor.
 *
 * @return void
 */
add_filter('admin_head', function () {
    if (! get_current_screen()?->is_block_editor()) {
        return;
    }

    //$dependencies = ['wp-blocks', 'wp-element', 'wp-block-editor', 'wp-components', 'wp-data', 'wp-i18n', 'wp-compose'];
    $dependencies = json_decode(Vite::content('editor.deps.json'));

    foreach ($dependencies as $dependency) {
        if (! wp_script_is($dependency)) {
            wp_enqueue_script($dependency);
        }
    }

    echo Vite::withEntryPoints([
        'resources/js/editor.js',
    ])->toHtml();
});

// /**
//  * Add Vite's HMR client to the block editor.
//  *
//  * @return void
//  */
// add_action('enqueue_block_assets', function () {
//     if (! is_admin() || ! get_current_screen()?->is_block_editor()) {
//         return;
//     }

//     if (! Vite::isRunningHot()) {
//         return;
//     }

//     $script = sprintf(
//         <<<'JS'
//         window.__vite_client_url = '%s';

//         window.self !== window.top && document.head.appendChild(
//             Object.assign(document.createElement('script'), { type: 'module', src: '%s' })
//         );
//         JS,
//         untrailingslashit(Vite::asset('')),
//         Vite::asset('@vite/client')
//     );

//     wp_add_inline_script('wp-blocks', $script);
// });

/**
 * Use the generated theme.json file.
 *
 * @return string
 */
add_filter('theme_file_path', function ($path, $file) {
    return $file === 'theme.json'
        ? public_path('build/assets/theme.json')
        : $path;
}, 10, 2);

/**
 * Register the initial theme setup.
 *
 * @return void
 */
add_action('after_setup_theme', function () {
    /**
     * Disable full-site editing support.
     *
     * @link https://wptavern.com/gutenberg-10-5-embeds-pdfs-adds-verse-block-color-options-and-introduces-new-patterns
     */
    remove_theme_support('block-templates');

    /**
     * Register the navigation menus.
     *
     * @link https://developer.wordpress.org/reference/functions/register_nav_menus/
     */
    register_nav_menus([
        'primary_navigation' => __('Primary Navigation', 'sage'),
        'footer_menu_1' => __('Footer - Materiały', 'sage'),
        'footer_menu_2' => __('Footer - O nas', 'sage'),
    ]);

    /**
     * Disable the default block patterns.
     *
     * @link https://developer.wordpress.org/block-editor/developers/themes/theme-support/#disabling-the-default-block-patterns
     */
    remove_theme_support('core-block-patterns');

    /**
     * Enable plugins to manage the document title.
     *
     * @link https://developer.wordpress.org/reference/functions/add_theme_support/#title-tag
     */
    add_theme_support('title-tag');

    /**
     * Enable post thumbnail support.
     *
     * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
     */
    add_theme_support('post-thumbnails');

    /**
     * Enable responsive embed support.
     *
     * @link https://developer.wordpress.org/block-editor/how-to-guides/themes/theme-support/#responsive-embedded-content
     */
    add_theme_support('responsive-embeds');

    /**
     * Enable HTML5 markup support.
     *
     * @link https://developer.wordpress.org/reference/functions/add_theme_support/#html5
     */
    add_theme_support('html5', [
        'caption',
        'comment-form',
        'comment-list',
        'gallery',
        'search-form',
        'script',
        'style',
    ]);

    /**
     * Enable selective refresh for widgets in customizer.
     *
     * @link https://developer.wordpress.org/reference/functions/add_theme_support/#customize-selective-refresh-widgets
     */
    add_theme_support('customize-selective-refresh-widgets');
}, 20);

/**
 * Register the theme sidebars.
 *
 * @return void
 */
add_action('widgets_init', function () {
    $config = [
        'before_widget' => '<section class="widget %1$s %2$s">',
        'after_widget' => '</section>',
        'before_title' => '<h3>',
        'after_title' => '</h3>',
    ];

    register_sidebar([
        'name' => __('Primary', 'sage'),
        'id' => 'sidebar-primary',
    ] + $config);

    register_sidebar([
        'name' => __('Footer', 'sage'),
        'id' => 'sidebar-footer',
    ] + $config);
});

// new PostFilterSetup();
// new CaseStudyFilterSetup();
// new Blocks();

/**
 * ═══════════════════════════════════════════════════════════════════════════
 * FLUID RESPONSIVE DESIGN SYSTEM - ROOT FONT SIZE
 * ═══════════════════════════════════════════════════════════════════════════
 *
 * This is the CORE of the fluid responsive design system used throughout
 * the theme. It dynamically sets the root font-size based on viewport width.
 *
 * HOW IT WORKS:
 *
 * 1. DESKTOP (≥1024px viewport):
 *    - Root font-size = viewport width / 10
 *    - Example at 1920px: 1920 / 10 = 192px = 1rem
 *    - Example at 1440px: 1440 / 10 = 144px = 1rem
 *    - Example at 1280px: 1280 / 10 = 128px = 1rem
 *
 * 2. MOBILE (<1024px viewport):
 *    - Root font-size = 32px (fixed)
 *    - Provides consistent sizing on smaller screens
 *
 * 3. ALL REM VALUES SCALE PROPORTIONALLY:
 *    - In _variables.scss: --text-h1: px-rem(72, 192)
 *    - This equals: 72 / 192 = 0.375rem
 *    - At 1920px: 0.375 × 192px = 72px ✓
 *    - At 1440px: 0.375 × 144px = 54px (scales down)
 *    - At 1280px: 0.375 × 128px = 48px (scales down)
 *
 * WHY THIS APPROACH?
 * ✓ True fluid scaling across all viewport sizes
 * ✓ Maintains design proportions at any screen width
 * ✓ Prevents Cumulative Layout Shift (CLS)
 * ✓ No need for multiple media query breakpoints
 * ✓ Works seamlessly with Tailwind's rem-based utilities
 *
 * WHY INLINE SCRIPT?
 * - Executes BEFORE CSS loads (priority 1, very first in <head>)
 * - Prevents flash of unstyled content (FOUC)
 * - Prevents Cumulative Layout Shift (CLS)
 * - Ensures correct initial render
 *
 * CUSTOMIZATION:
 * - Change breakpoint: Modify `vw >= 1024` to your preferred width
 * - Change desktop scaling: Modify `vw / 10` (try vw / 12 for smaller scaling)
 * - Change mobile base: Modify `32` to your preferred fixed size
 *
 * IMPORTANT:
 * If you change the desktop quotient (192) or mobile base (32), you MUST
 * also update the corresponding values in:
 * - resources/css/abstracts/_variables.scss (px-rem function quotients)
 * - All @media queries in _variables.scss
 *
 * ═══════════════════════════════════════════════════════════════════════════
 */
add_action('wp_head', function () {
    // Skip for specific templates if needed
    if (is_page_template('podzial')) {
        return;
    }
    ?>
    <script id="root-font-size-init">
        /**
         * Immediately Invoked Function Expression (IIFE)
         * Runs immediately when the script is parsed
         */
        (function() {
            const vw = window.innerWidth;  // Current viewport width in pixels

            /**
             * Calculate font size based on viewport
             * Desktop (≥1024px): viewport width / 10
             * Mobile (<1024px): Fixed 32px
             */
            const fs = vw >= 1024 ? (vw / 10) : 32;

            /**
             * Set the root font-size
             * This affects ALL rem-based values throughout the site
             */
            document.documentElement.style.fontSize = fs + 'px';
        })();
    </script>
    <?php
}, 1); // Priority 1 = Executes FIRST in wp_head (before CSS)
