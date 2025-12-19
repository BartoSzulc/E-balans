<?php

namespace App\Fields;

use Log1x\AcfComposer\Builder;
use Log1x\AcfComposer\Field;
use App\Fields\Partials\HowItWorks;


class Home extends Field
{
    /**
     * The field group name
     */
    public string $name = 'Home Page';

    /**
     * Build the field group
     */
    public function fields(): array
    {
        $builder = Builder::make('home_page');

        // Set location to front page
        $builder->setLocation('page_type', '==', 'front_page');

        $builder
            // Hero Section
            ->addTab('hero', [
                'label' => 'Hero',
            ])
            ->addGroup('hero', [
                'label' => 'Hero Section',
            ])
                ->addWysiwyg('title', [
                    'label' => 'Title',
                    'instructions' => 'Main heading for hero section',
                    'toolbar' => 'full',
                    'media_upload' => 0,
                ])
                ->addWysiwyg('description', [
                    'label' => 'Description',
                    'instructions' => 'Hero description',
                    'toolbar' => 'full',
                    'media_upload' => 0,
                ])
                ->addRepeater('add_buttons', [
                    'label' => 'Buttons',
                    'instructions' => 'Add call to action buttons',
                    'layout' => 'block',
                    'button_label' => 'Add Button',
                ])
                    ->addLink('button', [
                        'label' => 'Button',
                        'return_format' => 'array',
                    ])
                ->endRepeater()
                ->addImage('hero_image', [
                    'label' => 'Hero Image',
                    'return_format' => 'id',
                    'preview_size' => 'medium',
                ])
            ->endGroup()

            // Aktualności Section
            ->addTab('aktualnosci', [
                'label' => 'Aktualności',
            ])
            ->addGroup('aktualnosci', [
                'label' => 'Aktualności Section',
            ])
                ->addWysiwyg('title', [
                    'label' => 'Title',
                    'toolbar' => 'full',
                    'media_upload' => 0,
                ])
                ->addRelationship('posts', [
                    'label' => 'Posts',
                    'instructions' => 'Select posts to display',
                    'post_type' => ['post'],
                    'filters' => ['search', 'taxonomy'],
                    'return_format' => 'id',
                ])
                ->addLink('button', [
                    'label' => 'Button',
                    'return_format' => 'array',
                ])
            ->endGroup()

            // O nas Section
            ->addTab('o_nas', [
                'label' => 'O nas',
            ])
            ->addGroup('o_nas', [
                'label' => 'O nas Section',
            ])
                ->addRepeater('images', [
                    'label' => 'Images',
                    'instructions' => 'Add images',
                    'layout' => 'block',
                    'button_label' => 'Add Image',
                ])
                    ->addImage('image', [
                        'label' => 'Image',
                        'return_format' => 'id',
                        'preview_size' => 'medium',
                    ])
                ->endRepeater()
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
                ->addLink('button', [
                    'label' => 'Button',
                    'return_format' => 'array',
                ])
                ->addRepeater('add_services', [
                    'label' => 'Services',
                    'instructions' => 'Add services',
                    'layout' => 'block',
                    'button_label' => 'Add Service',
                ])
                    ->addImage('image', [
                        'label' => 'Icon',
                        'instructions' => 'Service icon',
                        'return_format' => 'id',
                        'preview_size' => 'thumbnail',
                    ])
                    ->addWysiwyg('text', [
                        'label' => 'Text',
                        'toolbar' => 'full',
                        'media_upload' => 0,
                    ])
                ->endRepeater()
            ->endGroup()

            // Mówią o nas (Testimonials) Section
            ->addTab('testimonials', [
                'label' => 'Mówią o nas',
            ])
            ->addGroup('testimonials', [
                'label' => 'Testimonials Section',
            ])
            ->addWysiwyg('title', [
                    'label' => 'Title',
                    'toolbar' => 'full',
                    'media_upload' => 0,
                ])
                ->addRelationship('referencje', [
                    'label' => 'Referencje',
                    'instructions' => 'Select referencje to display. If none selected, 3 latest will be shown.',
                    'post_type' => ['referencje'],
                    'filters' => ['search'],
                    'return_format' => 'id',
                    'max' => 3,
                ])
                ->addLink('button', [
                    'label' => 'Button',
                    'return_format' => 'array',
                ])
            ->endGroup()

            // MSIT Section
            ->addTab('msit', [
                'label' => 'MSIT',
            ])
            ->addGroup('msit', [
                'label' => 'MSIT Section',
            ])
                ->addText('badge', [
                    'label' => 'Badge',
                ])
                ->addWysiwyg('title', [
                    'label' => 'Title',
                    'toolbar' => 'full',
                    'media_upload' => 0,
                ])
                ->addImage('image', [
                    'label' => 'Image',
                    'return_format' => 'id',
                    'preview_size' => 'medium',
                ])
            ->endGroup()

            // Our Materiały Section
            ->addTab('our_materialy', [
                'label' => 'Our Materiały',
            ])
            ->addGroup('our_materialy', [
                'label' => 'Our Materiały Section',
            ])
            ->addWysiwyg('title', [
                    'label' => 'Title',
                    'toolbar' => 'full',
                    'media_upload' => 0,
                ])
                ->addRepeater('add_material', [
                    'label' => 'Materials',
                    'instructions' => 'Add materials',
                    'layout' => 'block',
                    'button_label' => 'Add Material',
                ])
                    ->addText('title', [
                        'label' => 'Title',
                    ])
                    ->addWysiwyg('description', [
                        'label' => 'Description',
                        'toolbar' => 'full',
                        'media_upload' => 0,
                    ])
                    ->addLink('button', [
                        'label' => 'Button',
                        'return_format' => 'array',
                    ])
                    ->addImage('image', [
                        'label' => 'Image',
                        'return_format' => 'id',
                        'preview_size' => 'medium',
                    ])
                ->endRepeater()
            ->endGroup()

            // How It Works Section
            ->addTab('how_it_works', [
                'label' => 'How It Works',
            ])
            ->addGroup('how_it_works', [
                'label' => 'How It Works Section',
            ])
                    ->addPartial(HowItWorks::class)
            ->endGroup()

            // Partnerzy Section
            ->addTab('partnerzy', [
                'label' => 'Partnerzy',
            ])
            ->addGroup('partnerzy', [
                'label' => 'Partnerzy Section',
            ])
            ->addWysiwyg('title', [
                    'label' => 'Title',
                    'toolbar' => 'full',
                    'media_upload' => 0,
                ])
                ->addRepeater('add_image', [
                    'label' => 'Partners',
                    'instructions' => 'Add partner logos',
                    'layout' => 'block',
                    'button_label' => 'Add Partner',
                ])
                    ->addImage('image', [
                        'label' => 'Image',
                        'return_format' => 'id',
                        'preview_size' => 'medium',
                    ])
                ->endRepeater()
            ->endGroup();

        return $builder->build();
    }
}
