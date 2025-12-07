<?php

namespace App\Fields;

use Log1x\AcfComposer\Builder;
use Log1x\AcfComposer\Field;

/**
 * ═══════════════════════════════════════════════════════════════════════════
 * EXAMPLE ACF FIELD GROUP
 * ═══════════════════════════════════════════════════════════════════════════
 *
 * This is an example field group demonstrating common ACF Composer patterns
 * and best practices used in this boilerplate.
 *
 * DOCUMENTATION:
 * - ACF Composer: https://github.com/Log1x/acf-composer
 * - ACF Field Types: https://www.advancedcustomfields.com/resources/
 *
 * TO USE THIS EXAMPLE:
 * 1. Create a page template: resources/views/template-example.blade.php
 * 2. This field group will automatically appear when editing pages using that template
 * 3. Access fields in your template using get_field('field_name')
 *
 * ═══════════════════════════════════════════════════════════════════════════
 */
class ExamplePage extends Field
{
    /**
     * ─────────────────────────────────────────────────────────────────────
     * FIELD GROUP NAME
     * ─────────────────────────────────────────────────────────────────────
     * This appears in the WordPress admin as the field group title
     */
    public string $name = 'Example Page Fields';

    /**
     * ─────────────────────────────────────────────────────────────────────
     * BUILD THE FIELD GROUP
     * ─────────────────────────────────────────────────────────────────────
     * This method defines all fields and their configuration
     *
     * @return array The built field group configuration
     */
    public function fields(): array
    {
        // Initialize the builder with a unique key
        $builder = Builder::make('example_page');

        /**
         * ═════════════════════════════════════════════════════════════════
         * LOCATION RULES
         * ═════════════════════════════════════════════════════════════════
         * Define where this field group appears in WordPress admin
         *
         * Common location rules:
         * - Page template: 'page_template', '==', 'template-name.blade.php'
         * - Post type: 'post_type', '==', 'post'
         * - Specific page: 'page', '==', 123
         * - Page parent: 'page_parent', '==', 456
         */
        $builder->setLocation('page_template', '==', 'template-example.blade.php');

        /**
         * ═════════════════════════════════════════════════════════════════
         * FIELD DEFINITIONS
         * ═════════════════════════════════════════════════════════════════
         * All fields are added using a fluent, chainable API
         */

        /**
         * ─────────────────────────────────────────────────────────────────
         * TAB: HERO SECTION
         * ─────────────────────────────────────────────────────────────────
         * Tabs organize fields into logical groups in the admin interface
         */
        $builder->addTab('hero_section', [
            'label' => 'Hero Section',
            'placement' => 'left', // 'top' or 'left' (inherited from config/acf.php)
        ])

        /**
         * TEXT FIELD - Simple single-line text input
         */
        ->addText('hero_title', [
            'label' => 'Hero Title',
            'instructions' => 'Main headline displayed in the hero section',
            'default_value' => 'Welcome to Our Website',
            'placeholder' => 'Enter hero title...',
            'maxlength' => 100,
            'required' => 1,
        ])

        /**
         * WYSIWYG EDITOR - Rich text editor for formatted content
         */
        ->addWysiwyg('hero_content', [
            'label' => 'Hero Content',
            'instructions' => 'Description text for the hero section',
            'toolbar' => 'basic', // 'full', 'basic', or custom toolbar
            'media_upload' => 0, // Disable media upload button
            'delay' => 0,
        ])

        /**
         * IMAGE FIELD - Single image upload
         */
        ->addImage('hero_image', [
            'label' => 'Hero Background Image',
            'instructions' => 'Recommended size: 1920x1080px',
            'return_format' => 'array', // 'array', 'url', or 'id'
            'preview_size' => 'medium',
            'library' => 'all', // 'all' or 'uploadedTo'
        ])

        /**
         * TRUE/FALSE FIELD - Toggle switch (inherited UI from config/acf.php)
         */
        ->addTrueFalse('hero_enable_cta', [
            'label' => 'Enable Call-to-Action Button',
            'instructions' => 'Show a CTA button in the hero section',
            'default_value' => 1,
            'ui' => 1, // Shows as toggle switch (default from config)
        ])

        /**
         * CONDITIONAL FIELD - Only shows if hero_enable_cta is true
         */
        ->addText('hero_cta_text', [
            'label' => 'CTA Button Text',
            'default_value' => 'Get Started',
            'conditional_logic' => [
                [
                    [
                        'field' => 'hero_enable_cta',
                        'operator' => '==',
                        'value' => '1',
                    ],
                ],
            ],
        ])

        ->addUrl('hero_cta_url', [
            'label' => 'CTA Button URL',
            'placeholder' => 'https://example.com/contact',
            'conditional_logic' => [
                [
                    [
                        'field' => 'hero_enable_cta',
                        'operator' => '==',
                        'value' => '1',
                    ],
                ],
            ],
        ]);

        /**
         * ─────────────────────────────────────────────────────────────────
         * TAB: FEATURES SECTION
         * ─────────────────────────────────────────────────────────────────
         */
        $builder->addTab('features_section', [
            'label' => 'Features Section',
        ])

        /**
         * GROUP FIELD - Groups related fields together
         * Opens in a modal dialog (inherited from config/acf.php)
         */
        ->addGroup('features_settings', [
            'label' => 'Features Section Settings',
            'layout' => 'block', // 'block', 'table', or 'row'
        ])
            ->addText('section_title', [
                'label' => 'Section Title',
                'default_value' => 'Our Features',
            ])
            ->addTextarea('section_description', [
                'label' => 'Section Description',
                'rows' => 3,
            ])
        ->endGroup()

        /**
         * REPEATER FIELD - Repeatable set of fields
         * Ideal for lists of items (features, testimonials, team members, etc.)
         */
        ->addRepeater('features_list', [
            'label' => 'Features',
            'instructions' => 'Add features to display in this section',
            'button_label' => 'Add Feature',
            'layout' => 'block', // 'table', 'block', or 'row'
            'min' => 1,
            'max' => 6,
        ])
            /**
             * Sub-fields within the repeater
             * Each iteration will have these fields
             */
            ->addText('feature_title', [
                'label' => 'Feature Title',
                'required' => 1,
            ])

            ->addTextarea('feature_description', [
                'label' => 'Feature Description',
                'rows' => 2,
            ])

            ->addImage('feature_icon', [
                'label' => 'Feature Icon',
                'instructions' => 'Upload an icon (SVG recommended)',
                'return_format' => 'array',
                'preview_size' => 'thumbnail',
            ])

            ->addSelect('feature_color', [
                'label' => 'Feature Color',
                'instructions' => 'Choose a color theme for this feature',
                'choices' => [
                    'color-1' => 'Primary Blue',
                    'color-2' => 'Secondary Cyan',
                    'orange' => 'Orange',
                ],
                'default_value' => 'color-1',
                'ui' => 1, // Enhanced Select2 UI (default from config)
            ])

        ->endRepeater();

        /**
         * ─────────────────────────────────────────────────────────────────
         * TAB: TESTIMONIALS
         * ─────────────────────────────────────────────────────────────────
         */
        $builder->addTab('testimonials_section', [
            'label' => 'Testimonials',
        ])

        /**
         * FLEXIBLE CONTENT - Most powerful layout field
         * Allows mixing different content block types
         */
        ->addFlexibleContent('testimonials_layouts', [
            'label' => 'Testimonial Layouts',
            'button_label' => 'Add Testimonial Block',
        ])

            /**
             * LAYOUT 1: Text Testimonial
             */
            ->addLayout('text_testimonial', [
                'label' => 'Text Testimonial',
            ])
                ->addTextarea('testimonial_quote', [
                    'label' => 'Quote',
                    'required' => 1,
                ])
                ->addText('testimonial_author', [
                    'label' => 'Author Name',
                    'required' => 1,
                ])
                ->addText('testimonial_position', [
                    'label' => 'Author Position/Company',
                ])
            

            /**
             * LAYOUT 2: Video Testimonial
             */
            ->addLayout('video_testimonial', [
                'label' => 'Video Testimonial',
            ])
                ->addUrl('video_url', [
                    'label' => 'Video URL',
                    'instructions' => 'YouTube or Vimeo URL',
                    'required' => 1,
                ])
                ->addImage('video_thumbnail', [
                    'label' => 'Video Thumbnail',
                    'return_format' => 'array',
                ])
                ->addText('video_caption', [
                    'label' => 'Caption',
                ])
            

        ->endFlexibleContent();

        /**
         * ─────────────────────────────────────────────────────────────────
         * TAB: SEO & SETTINGS
         * ─────────────────────────────────────────────────────────────────
         */
        $builder->addTab('page_settings', [
            'label' => 'Page Settings',
        ])

        /**
         * SELECT FIELD - Dropdown menu
         */
        ->addSelect('page_layout', [
            'label' => 'Page Layout',
            'choices' => [
                'full-width' => 'Full Width',
                'boxed' => 'Boxed',
                'sidebar-left' => 'With Left Sidebar',
                'sidebar-right' => 'With Right Sidebar',
            ],
            'default_value' => 'full-width',
            'ui' => 1,
        ])

        /**
         * COLOR PICKER - HTML5 color picker
         */
        ->addColorPicker('page_background_color', [
            'label' => 'Page Background Color',
            'instructions' => 'Leave empty for default background',
            'default_value' => '',
        ])

        /**
         * ACCORDION - Collapsible section for organizing many fields
         */
        ->addAccordion('advanced_settings', [
            'label' => 'Advanced Settings',
            'open' => 0, // Closed by default
        ])

            ->addText('custom_css_class', [
                'label' => 'Custom CSS Class',
                'instructions' => 'Add custom CSS classes to the page wrapper',
            ])

            ->addTextarea('custom_scripts', [
                'label' => 'Custom JavaScript',
                'instructions' => 'Add custom JavaScript (without <script> tags)',
                'rows' => 5,
            ])

        ->addAccordion('accordion_end')
            ->endpoint();

        /**
         * ═════════════════════════════════════════════════════════════════
         * BUILD AND RETURN
         * ═════════════════════════════════════════════════════════════════
         * Convert the builder to an array that ACF can understand
         */
        return $builder->build();
    }
}

/**
 * ═══════════════════════════════════════════════════════════════════════════
 * USAGE IN BLADE TEMPLATES
 * ═══════════════════════════════════════════════════════════════════════════
 *
 * In template-example.blade.php:
 *
 * @php
 *   $hero_title = get_field('hero_title');
 *   $hero_content = get_field('hero_content');
 *   $hero_image = get_field('hero_image');
 *   $features = get_field('features_list');
 * @endphp
 *
 * {{-- Hero Section --}}
 * <section class="hero" style="background-image: url({{ $hero_image['url'] ?? '' }})">
 *   <h1>{{ $hero_title }}</h1>
 *   <div>{!! $hero_content !!}</div>
 *
 *   @if(get_field('hero_enable_cta'))
 *     <a href="{{ get_field('hero_cta_url') }}" class="btn">
 *       {{ get_field('hero_cta_text') }}
 *     </a>
 *   @endif
 * </section>
 *
 * {{-- Features Section --}}
 * @if($features)
 *   <section class="features">
 *     @php $settings = get_field('features_settings'); @endphp
 *     <h2>{{ $settings['section_title'] }}</h2>
 *     <p>{{ $settings['section_description'] }}</p>
 *
 *     <div class="features-grid">
 *       @foreach($features as $feature)
 *         <div class="feature bg-{{ $feature['feature_color'] }}">
 *           @if($feature['feature_icon'])
 *             <img src="{{ $feature['feature_icon']['url'] }}" alt="{{ $feature['feature_title'] }}">
 *           @endif
 *           <h3>{{ $feature['feature_title'] }}</h3>
 *           <p>{{ $feature['feature_description'] }}</p>
 *         </div>
 *       @endforeach
 *     </div>
 *   </section>
 * @endif
 *
 * {{-- Flexible Content (Testimonials) --}}
 * @if(have_rows('testimonials_layouts'))
 *   <section class="testimonials">
 *     @while(have_rows('testimonials_layouts'))
 *       @php the_row(); @endphp
 *
 *       @if(get_row_layout() == 'text_testimonial')
 *         <blockquote>
 *           <p>{{ get_sub_field('testimonial_quote') }}</p>
 *           <cite>
 *             {{ get_sub_field('testimonial_author') }}
 *             @if(get_sub_field('testimonial_position'))
 *               , {{ get_sub_field('testimonial_position') }}
 *             @endif
 *           </cite>
 *         </blockquote>
 *       @endif
 *
 *       @if(get_row_layout() == 'video_testimonial')
 *         <div class="video-testimonial">
 *           <iframe src="{{ get_sub_field('video_url') }}"></iframe>
 *           <p>{{ get_sub_field('video_caption') }}</p>
 *         </div>
 *       @endif
 *     @endwhile
 *   </section>
 * @endif
 *
 * ═══════════════════════════════════════════════════════════════════════════
 */
