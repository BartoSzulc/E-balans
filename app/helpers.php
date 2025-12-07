<?php

/**
 * Theme helpers.
 */

function removeSpaces($text) {
    return str_replace(' ', '', $text);
}
function acf_link($link, $class = '', $default = 'Learn More', $echo = true)
{
    if (empty($link) && !is_array($link)) {
        return false;
    }

    $link_title = !empty($link['title']) ? $link['title'] : $default;

    $output = "<a ";
    $output .= !empty($class) ? "class='{$class}'" : null;
    $output .= "href='{$link['url']}'";
    $output .= !empty($link['target']) ? "target='_blank'" : null;
    $output .= ">{$link_title}</a>";

    if ($echo) {
        echo $output; // Use: acf_link($link, $class, $default, $echo);
    } else {
        return $output; // Use: $output = acf_link($link, $class, $default, $echo);
    }
}

function admin_log($log, $name = '_')
{
    $date = new \DateTime();
    $date->setTimezone(new \DateTimeZone('Europe/Warsaw'));
    $log_date = $date->format('Y-m-d H:i:s');

    if (is_array($log)) {
        $log = http_build_query($log, '', ', ');
    }

    $log_msg =  $log_date . ' : ' . $log;
    $folder = dirname(__FILE__) . "/../../../logs/";

    if (!file_exists($folder)) {
        mkdir($folder, 0777, true);
    }

    $log_file_data = $folder . '/log' . $name . date('d-M-Y') . '_' . date('h') . '.log';
    file_put_contents($log_file_data, $log_msg . "\n", FILE_APPEND);
    // Use: admin_log($log, $name);
}

function placehold_img($size = '150x150', $format = 'png', $text_color = '#fff', $bg_color = '#6d6d6d', $text = false)
{
    $url = 'https://via.placeholder.com/' . $size . '.' . $format . '/' . $bg_color . '/' . $text_color ;
    if ($text) {
        $text = str_replace(' ', '+', $text);
        $url .= '?text=' . $text;
    }
    return $url; // Use: $url = placehold_img($size, $format, $text_color, $bg_color, $text);
}

function cc_mime_types($mimes) {
    $mimes['svg'] = 'image/svg+xml';
    return $mimes;
}   
add_filter('upload_mimes', 'cc_mime_types');

require('helpers-partials/navwalker.php');
require('helpers-partials/cpt.php');
require('helpers-partials/page_navi.php');
//require('helpers/CPT.php');

add_filter('wpcf7_autop_or_not', '__return_false');

add_filter('woocommerce_resize_images', static function() {
    return false;
});

require('helpers-partials/contact-form.php');

function add_editor_styles() {
    add_editor_style('editor-styles.css');
}
add_action('admin_init', __NAMESPACE__ . '\\add_editor_styles');


/**
 * Add custom color buttons to TinyMCE editor
 */


/**
 * Add custom color buttons to TinyMCE editor
 */
function custom_tinymce_color_buttons() {
    // Only run in admin area
    if (!is_admin()) {
        return;
    }

    // Add TinyMCE buttons
    add_filter('mce_buttons', 'register_custom_color_buttons');
    add_filter('mce_external_plugins', 'add_custom_color_buttons');
    
    // Add styles to admin
    add_action('admin_head', 'add_custom_color_styles');
    
    // Modify TinyMCE color palette
    add_filter('tiny_mce_before_init', 'customize_tinymce_colors');
}
add_action('init', 'custom_tinymce_color_buttons');

/**
 * Register new buttons
 */
function register_custom_color_buttons($buttons) {
    // Add the color selector if it doesn't exist
    if (!in_array('forecolor', $buttons)) {
        $buttons[] = 'forecolor';
    }
    
    // Add our custom buttons
    $buttons[] = 'color3_button';
    $buttons[] = 'color2_button';
    $buttons[] = 'texth5_button';
    
    return $buttons;
}

/**
 * Add new buttons
 */
function add_custom_color_buttons($plugin_array) {
    // Add the path to our TinyMCE plugin with version parameter to prevent caching
    $plugin_array['custom_color_buttons'] = get_template_directory_uri() . '/js/custom-buttons.js?ver=' . time();
    return $plugin_array;
}

/**
 * Add custom styles
 */
function add_custom_color_styles() {
    ?>
    <style type="text/css">
        /* Text color classes */
        .text-color-2 { color: #5CE6DE !important; }
        .text-color-3 { color: #0B284A !important; }

        
        .mce-i-color3-icon::before {
            content: "A";
            background: #0B284A;
            color: white;
            padding: 0 3px;
            border-radius: 3px;
        }
        .mce-i-color2-icon::before {
            content: "A";
            background: #5CE6DE;
            color: white;
            padding: 0 3px;
            border-radius: 3px;
        }
        .mce-i-texth5-icon::before {
            content: "H5";
            background: #333;
            color: white;
            padding: 0 3px;
            border-radius: 3px;
            font-size: 10px;
        }
    </style>
    <?php
}

/**
 * Add text color classes to frontend
 */
function add_frontend_custom_color_styles() {
    ?>
    <style type="text/css">
        .text-color-3 { color: #0B284A !important; }
        .text-color-2 { color: #5CE6DE !important; }
    </style>
    <?php
}
add_action('wp_head', 'add_frontend_custom_color_styles');

/**
 * Customize TinyMCE default colors
 */
function customize_tinymce_colors($init) {
    // Define custom colors
    $custom_colors = '
        "0B284A", "Text Color 3",
        "5CE6DE", "Text Color 2"
    ';
    
    // Add custom colors to existing colors
    if (isset($init['textcolor_map'])) {
        $init['textcolor_map'] = '['.$custom_colors.','.$init['textcolor_map'].']';
    } else {
        $init['textcolor_map'] = '['.$custom_colors.']';
    }
    
    // Show the color picker
    $init['textcolor_rows'] = 6;
    
    return $init;
}