<?php

namespace App\Fields;

use Log1x\AcfComposer\Builder;
use Log1x\AcfComposer\Field;

class NasiPartnerzy extends Field
{
    /**
     * The field group.
     */
    public function fields(): array
    {
        $fields = Builder::make('nasi_partnerzy');

        $fields
            ->setLocation('page_template', '==', 'template-nasi-partnerzy.blade.php');

        $fields
            // Hero Section
            ->addGroup('hero', [
                'label' => 'Hero Section',
            ])
                ->addWysiwyg('title', [
                    'label' => 'Title (Optional)',
                    'instructions' => 'Leave empty to use page title',
                    'toolbar' => 'full',
                    'media_upload' => 0,
                    'required' => 0,
                ])
                ->addRepeater('partner_logos', [
                    'label' => 'Partner Logos',
                    'instructions' => 'Add partner logos for hero section (3 recommended)',
                    'layout' => 'table',
                    'button_label' => 'Add Logo',
                    'min' => 1,
                    'max' => 3,
                ])
                    ->addImage('image', [
                        'label' => 'Logo',
                        'return_format' => 'id',
                        'preview_size' => 'thumbnail',
                    ])
                ->endRepeater()
            ->endGroup()

            // Testimonials Section (Mowią o nas)
            ->addGroup('testimonials', [
                'label' => 'Testimonials Section (Mowią o nas)',
            ])
                ->addWysiwyg('title', [
                    'label' => 'Title',
                    'default_value' => 'Mówią o nas',
                    'toolbar' => 'full',
                    'media_upload' => 0,
                ])
                ->addRelationship('opinie', [
                    'label' => 'Opinie',
                    'instructions' => 'Select opinie to display. If none selected, 3 latest will be shown.',
                    'post_type' => ['opinie'],
                    'filters' => ['search'],
                    'return_format' => 'id',
                    'max' => 3,
                ])
                ->addLink('button', [
                    'label' => 'Button',
                    'instructions' => 'Optional button link',
                    'return_format' => 'array',
                ])
            ->endGroup()

            // Full Width Image Section
            ->addGroup('full_width_image', [
                'label' => 'Full Width Image Section',
            ])
                ->addImage('image', [
                    'label' => 'Image',
                    'instructions' => 'Full width image (height: 560px)',
                    'return_format' => 'id',
                    'preview_size' => 'large',
                ])
            ->endGroup()

            // Referencje Section
            ->addGroup('referencje', [
                'label' => 'Referencje Section',
            ])
                ->addWysiwyg('title', [
                    'label' => 'Title',
                    'default_value' => 'Referencje',
                    'toolbar' => 'full',
                    'media_upload' => 0,
                ])
                ->addText('button_text', [
                    'label' => 'Load More Button Text',
                    'default_value' => 'Załaduj więcej',
                    'instructions' => 'Text for the load more button',
                ])
            ->endGroup()

            // Form Section
            ->addGroup('form_section', [
                'label' => 'Form Section',
            ])
                ->addWysiwyg('title', [
                    'label' => 'Title',
                    'toolbar' => 'full',
                    'media_upload' => 0,
                ])
                ->addWysiwyg('description', [
                    'label' => 'Description',
                    'toolbar' => 'full',
                    'media_upload' => 0,
                ])
                ->addText('form_shortcode', [
                    'label' => 'Form Shortcode',
                    'instructions' => 'Enter Contact Form 7 shortcode (e.g., [contact-form-7 id="123"])',
                    'placeholder' => '[contact-form-7 id="123"]',
                ])
                ->addImage('image', [
                    'label' => 'Full Width Image',
                    'instructions' => 'Image displayed below the form',
                    'return_format' => 'id',
                    'preview_size' => 'large',
                ])
            ->endGroup();

        return $fields->build();
    }
}
