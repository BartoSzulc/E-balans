<?php

/**
 * Theme filters.
 */

namespace App;

/**
 * Add "… Continued" to the excerpt.
 *
 * @return string
 */
// Modify the excerpt word count limit
add_filter('excerpt_length', function() {
    return 25; // Set excerpt length to 25 words
});

// Customize the excerpt "more" text
add_filter('excerpt_more', function() {
    return '&hellip;'; // Adds ellipsis at the end of excerpts
});

function add_additional_class_on_li($classes, $item, $args)
{
    if (isset($args->add_li_class)) {
        $classes[] = $args->add_li_class;
    }
    return $classes;
}
add_filter('nav_menu_css_class', __NAMESPACE__ . '\\add_additional_class_on_li', 1, 3);
