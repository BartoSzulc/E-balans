<?php

/**
 * Add ACF fields to REST API for referencje post type
 */
add_action('rest_api_init', function () {
    // Register ACF fields
    register_rest_field('referencje', 'acf', [
        'get_callback' => function ($post) {
            return get_fields($post['id']);
        },
        'schema' => null,
    ]);

    // Register featured image URL
    register_rest_field('referencje', 'featured_media_url', [
        'get_callback' => function ($post) {
            if (!$post['featured_media']) {
                return null;
            }
            return wp_get_attachment_image_url($post['featured_media'], 'full');
        },
        'schema' => null,
    ]);
});
