<?php

namespace App\Fields;

use Log1x\AcfComposer\Builder;
use Log1x\AcfComposer\Field;

class Onas extends Field
{
    /**
     * The field group.
     */
    public function fields(): array
    {
        $fields = Builder::make('onas');

        $fields
            ->setLocation('page_template', '==', 'template-onas.blade.php');

        $fields
            ->addFlexibleContent('flexible_content', [
                'label' => 'Content Sections',
                'instructions' => 'Add content sections',
                'button_label' => 'Add Section',
            ])
                // Info Layout
                ->addLayout('info', [
                    'label' => 'Info Section',
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
                    ->addRepeater('add_columns', [
                        'label' => 'Columns',
                        'instructions' => 'Add columns with icon, title, and description',
                        'layout' => 'block',
                        'button_label' => 'Add Column',
                    ])
                        ->addImage('icon', [
                            'label' => 'Icon',
                            'return_format' => 'id',
                            'preview_size' => 'thumbnail',
                        ])
                        ->addText('title', [
                            'label' => 'Title',
                        ])
                        ->addWysiwyg('description', [
                            'label' => 'Description',
                            'toolbar' => 'full',
                            'media_upload' => 0,
                        ])
                    ->endRepeater()

                // TextImage Layout
                ->addLayout('text_image', [
                    'label' => 'Text & Image Section',
                ])
                    ->addTrueFalse('image_left', [
                        'label' => 'Zdjęcie po lewej?',
                        'instructions' => 'Enable to place image on the left side',
                        'default_value' => 0,
                        'ui' => 1,
                    ])
                    ->addImage('image', [
                        'label' => 'Image',
                        'return_format' => 'id',
                        'preview_size' => 'medium',
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

                // Video Layout
                ->addLayout('video', [
                    'label' => 'Video Section',
                ])
                    ->addWysiwyg('title', [
                        'label' => 'Title',
                        'toolbar' => 'full',
                        'media_upload' => 0,
                    ])
                    ->addUrl('video_url', [
                        'label' => 'Video URL',
                        'instructions' => 'YouTube or Vimeo video URL (e.g., https://www.youtube.com/watch?v=...)',
                    ])
                    ->addImage('poster', [
                        'label' => 'Poster Image (Optional)',
                        'instructions' => 'Thumbnail/poster image for the video',
                        'return_format' => 'id',
                        'preview_size' => 'medium',
                        'required' => 0,
                    ])

                // HowItWorks Layout
                ->addLayout('how_it_works', [
                    'label' => 'How It Works Section',
                ])
                    ->addPartial(new \App\Fields\Partials\HowItWorks())

                // CTA Layout
                ->addLayout('cta', [
                    'label' => 'Call to Action',
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
                    ->addLink('link', [
                        'label' => 'Link',
                        'return_format' => 'array',
                    ])
                    ->addImage('image', [
                        'label' => 'Image',
                        'return_format' => 'id',
                        'preview_size' => 'medium',
                    ])
            ->endFlexibleContent();

        return $fields->build();
    }
}
