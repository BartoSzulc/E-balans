<?php

/**
 * ═══════════════════════════════════════════════════════════════════════════
 * ACF COMPOSER CONFIGURATION
 * ═══════════════════════════════════════════════════════════════════════════
 *
 * ACF Composer is a Laravel-style field builder for Advanced Custom Fields (ACF)
 * that provides a clean, fluent API for defining custom fields programmatically.
 *
 * BENEFITS:
 * ✓ Version control your field definitions (instead of database-stored fields)
 * ✓ Fluent, chainable API similar to Laravel's Eloquent
 * ✓ DRY - set default configuration once, apply to all fields
 * ✓ Type safety and IDE autocomplete
 * ✓ Easy to reuse and share field groups
 *
 * FIELD DEFINITIONS:
 * Field classes are stored in /app/Fields/ directory
 * Each class extends Log1x\AcfComposer\Field
 *
 * EXAMPLE:
 *   class HomePage extends Field {
 *       public function fields() {
 *           $builder = Builder::make('home_page');
 *           $builder->addText('title', ['label' => 'Title']);
 *           return $builder->build();
 *       }
 *   }
 *
 * DOCUMENTATION:
 * https://github.com/Log1x/acf-composer
 *
 * ═══════════════════════════════════════════════════════════════════════════
 */

return [

    /*
    |--------------------------------------------------------------------------
    | Default Field Type Settings
    |--------------------------------------------------------------------------
    |
    | Here you can set default field group and field type configuration that
    | is then merged with your field groups when they are composed.
    |
    | This allows you to avoid the repetitive process of setting common field
    | configuration such as `ui` on every `trueFalse` field or your
    | preferred `instruction_placement` on every `fieldGroup`.
    |
    | ACFE (ACF Extended) FEATURES:
    | - instruction_placement: 'acfe_instructions_tooltip' → Shows help text as tooltip
    | - acfe_repeater_stylised_button: 1 → Stylized "Add Row" button
    | - acfe_group_modal: 1 → Opens groups in a modal dialog
    |
    */

    'defaults' => [
        // Field Group Settings
        'fieldGroup' => [
            'instruction_placement' => 'acfe_instructions_tooltip', // Show instructions as tooltips (ACFE)
        ],

        // Repeater Fields (repeatable groups of fields)
        'repeater' => [
            'layout' => 'block',                      // Display as blocks (vs table/row)
            'acfe_repeater_stylised_button' => 1,    // Stylized add button (ACFE)
        ],

        // True/False Fields (toggle switches)
        'trueFalse' => [
            'ui' => 1, // Show as toggle switch instead of checkbox
        ],

        // Select Fields (dropdown menus)
        'select' => [
            'ui' => 1, // Enhanced Select2 UI
        ],

        // Post Object Fields (select posts/pages)
        'postObject' => [
            'ui' => 1,                  // Enhanced Select2 UI
            'return_format' => 'object', // Return WP_Post object (vs ID)
        ],

        // Accordion Fields (collapsible sections)
        'accordion' => [
            'multi_expand' => 1, // Allow multiple accordions to be open at once
        ],

        // Group Fields (group related fields together)
        'group' => [
            'layout' => 'block',          // Display as block (vs table)
            'acfe_group_modal' => 1,      // Open in modal dialog (ACFE)
        ],

        // Tab Fields (organize fields into tabs)
        'tab' => [
            'placement' => 'left', // Show tabs on the left side
        ],

        // Sidebar Selector (custom field type)
        'sidebar_selector' => [
            'default_value' => 'sidebar-primary', // Default sidebar
            'allow_null' => 1,                    // Allow no selection
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Field Types
    |--------------------------------------------------------------------------
    |
    | Here you can define custom field types that are not included with ACF
    | out of the box. This allows you to use the fluent builder pattern with
    | custom field types such as `addEditorPalette()`.
    |
    | USAGE:
    | Map the fluent method name (camelCase) to the ACF field type (snake_case)
    |
    | EXAMPLE:
    |   'types' => [
    |       'editorPalette' => 'editor_palette',  // Use: ->addEditorPalette()
    |       'phoneNumber' => 'phone_number',       // Use: ->addPhoneNumber()
    |   ],
    |
    */

    'types' => [
        // Add custom field type mappings here
        // 'editorPalette' => 'editor_palette',
        // 'phoneNumber' => 'phone_number',
    ],

    /*
    |--------------------------------------------------------------------------
    | Cache Manifest Path
    |--------------------------------------------------------------------------
    |
    | Here you can define the cache manifest path. Fields are typically cached
    | when running the `acf:cache` command. This will cache the built field
    | groups and potentially improve performance in complex applications.
    |
    | PERFORMANCE TIP:
    | Run `wp acorn acf:cache` after modifying field definitions to improve
    | performance by caching compiled field groups.
    |
    | CLEAR CACHE:
    | Run `wp acorn acf:clear` to clear the cached field groups after making
    | changes during development.
    |
    */

    'manifest' => storage_path('framework/cache'),

];
