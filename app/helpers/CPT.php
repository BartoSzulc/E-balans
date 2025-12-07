<?php

namespace App\Helpers;

/**
 * Register Custom Post Types
 */
class CPT
{
    public function __construct()
    {
        add_action('init', [$this, 'registerCaseStudies']);
    }

    /**
     * Register Case Studies Custom Post Type
     */
    public function registerCaseStudies()
    {
        $labels = [
            'name'                  => _x('Case Studies', 'Post Type General Name', 'sage'),
            'singular_name'         => _x('Case Study', 'Post Type Singular Name', 'sage'),
            'menu_name'             => __('Case Studies', 'sage'),
            'name_admin_bar'        => __('Case Study', 'sage'),
            'archives'              => __('Case Study Archives', 'sage'),
            'attributes'            => __('Case Study Attributes', 'sage'),
            'parent_item_colon'     => __('Parent Case Study:', 'sage'),
            'all_items'             => __('All Case Studies', 'sage'),
            'add_new_item'          => __('Add New Case Study', 'sage'),
            'add_new'               => __('Add New', 'sage'),
            'new_item'              => __('New Case Study', 'sage'),
            'edit_item'             => __('Edit Case Study', 'sage'),
            'update_item'           => __('Update Case Study', 'sage'),
            'view_item'             => __('View Case Study', 'sage'),
            'view_items'            => __('View Case Studies', 'sage'),
            'search_items'          => __('Search Case Study', 'sage'),
            'not_found'             => __('Not found', 'sage'),
            'not_found_in_trash'    => __('Not found in Trash', 'sage'),
            'featured_image'        => __('Featured Image', 'sage'),
            'set_featured_image'    => __('Set featured image', 'sage'),
            'remove_featured_image' => __('Remove featured image', 'sage'),
            'use_featured_image'    => __('Use as featured image', 'sage'),
            'insert_into_item'      => __('Insert into case study', 'sage'),
            'uploaded_to_this_item' => __('Uploaded to this case study', 'sage'),
            'items_list'            => __('Case Studies list', 'sage'),
            'items_list_navigation' => __('Case Studies list navigation', 'sage'),
            'filter_items_list'     => __('Filter case studies list', 'sage'),
        ];

        $args = [
            'label'                 => __('Case Study', 'sage'),
            'description'           => __('Case Studies', 'sage'),
            'labels'                => $labels,
            'supports'              => ['title', 'editor', 'thumbnail', 'excerpt'],
            'hierarchical'          => false,
            'public'                => true,
            'show_ui'               => true,
            'show_in_menu'          => true,
            'menu_position'         => 5,
            'menu_icon'             => 'dashicons-portfolio',
            'show_in_admin_bar'     => true,
            'show_in_nav_menus'     => true,
            'can_export'            => true,
            'has_archive'           => true,
            'exclude_from_search'   => false,
            'publicly_queryable'    => true,
            'capability_type'       => 'post',
            'show_in_rest'          => true,
        ];

        register_post_type('case_studies', $args);
    }
}

// Initialize CPT
new CPT();
