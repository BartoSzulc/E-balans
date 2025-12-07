<?php

namespace App;

/**
 * Custom Gutenberg Blocks Registration
 */
class Blocks
{
    /**
    * Constructor
    */
    public function __construct()
    {
        add_action('init', [$this, 'registerBlocks']);
        add_filter('block_categories_all', [$this, 'registerBlockCategory'], 10, 1);
    }

    /**
     * Register custom blocks
     */
    public function registerBlocks()
    {
        // Register the WYSIWYG editor block
        register_block_type('sage/wysiwyg', [
            'editor_script' => 'sage-blocks',
        ]);
        register_block_type('sage/text-group', [
            'editor_script' => 'sage-blocks',
        ]);

        register_block_type('sage/image', [
            'editor_script' => 'sage-blocks',
        ]);

        register_block_type('sage/testimonial', [
            'editor_script' => 'sage-blocks',
        ]);
        register_block_type('sage/share-buttons', [
            'editor_script' => 'sage-blocks',
        ]);
        
        // Register other blocks as needed
        // register_block_type('sage/checklist');
    }

    /**
     * Register custom block category
     */
    public function registerBlockCategory($categories)
    {
        return array_merge(
            $categories,
            [
                [
                    'slug' => 'sage-blocks',
                    'title' => __('Dodatkowe bloki', 'sage'),
                    'icon' => 'layout',
                ],
            ]
        );
    }
}