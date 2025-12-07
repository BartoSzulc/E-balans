<?php

// Add a custom tag for the privacy policy text in Contact Form 7
function simple_privacy_text_handler($tag) {

    // Get the ACF field value
    $privacy_text = get_field('privacy_policy_text', 'option'); // If using an options page

    return '<div class="text-zgody privacy-policy-text wysiwyg">' . $privacy_text . '</div>';
}

add_action('wpcf7_init', 'register_simple_privacy_tag');

function register_simple_privacy_tag() {
    wpcf7_add_form_tag('privacy_policy_text', 'simple_privacy_text_handler');
}

// Register the custom submit button tag
function custom_cf7_submit_button($tag) {
    // Extract the tag attributes
    $tag = new WPCF7_FormTag($tag);
    
    // Get button text
    $buttonText = !empty($tag->values) ? esc_attr($tag->values[0]) : 'Umów się na konsultację';
    
    // Get custom button class if provided
    $buttonClass = '';
    if ($tag->has_option('btn-class')) {
        $buttonClass = $tag->get_option('btn-class', '', true);
        $buttonClass = ' ' . $buttonClass; // Add space before for proper concatenation
    }
    
    // Get custom wrapper class if provided
    $wrapperClass = '';
    if ($tag->has_option('wrapper-class')) {
        $wrapperClass = $tag->get_option('wrapper-class', '', true);
        $wrapperClass = ' ' . $wrapperClass; // Add space before for proper concatenation
    }
    
    // Default classes + custom classes
    $buttonClasses = 'cursor-pointer wpcf7-form-control wpcf7-submit flex items-center gap-20 py-4 pl-24 pr-4 button-wsk rounded-4 text-button transition-all duration-500 ease-in-out group' . $buttonClass;
    $wrapperClasses = 'inline-flex' . $wrapperClass;
    
    return view('components.submit-contactform7', [
        'buttonText' => $buttonText,
        'buttonClasses' => $buttonClasses,
        'wrapperClasses' => $wrapperClasses
    ])->render();
}

add_action('wpcf7_init', 'register_blade_submit_tag');

function register_blade_submit_tag() {
    wpcf7_add_form_tag('blade_submit', 'custom_cf7_submit_button');
}

// Register the custom submit button tag
function custom_cf7_heading($tag) {
    // Extract the tag attributes
    $tag = new WPCF7_FormTag($tag);
    
    // Get heading text
    $headingText = !empty($tag->values) ? wp_kses_post($tag->values[0]) : 'Bezpłatna konsultacja';
    
    // Get custom class if provided
    $class = '';
    if ($tag->has_option('class')) {
        $class = $tag->get_option('class', '', true);
        $class = '' . $class; // Add space before for proper concatenation
    }
    
    // Default classes + custom class
    $classes = 'text-color-1 ' . $class;
    
    return view('components.heading-contactform7', [
        'headingText' => $headingText,
        'classes' => $classes
    ])->render();
}

add_action('wpcf7_init', 'register_heading_tag');

function register_heading_tag() {
    wpcf7_add_form_tag('heading', 'custom_cf7_heading');
}

// Register the custom subtitle tag
function custom_cf7_subtitle($tag) {
    // Extract the tag attributes
    $tag = new WPCF7_FormTag($tag);
    
    // Get subtitle text
    $subtitleText = !empty($tag->values) ? wp_kses_post($tag->values[0]) : '';
    
    // Get custom class if provided
    $class = '';
    if ($tag->has_option('class')) {
        $class = $tag->get_option('class', '', true);
        $class = '' . $class; // Add space before for proper concatenation
    }
    
    // Default classes + custom class
    $classes = 'text-color-1' . $class;
    
    return view('components.subtitle-contactform7', [
        'subtitleText' => $subtitleText,
        'classes' => $classes
    ])->render();
}

add_action('wpcf7_init', 'register_subtitle_tag');

function register_subtitle_tag() {
    wpcf7_add_form_tag('subtitle', 'custom_cf7_subtitle');
}