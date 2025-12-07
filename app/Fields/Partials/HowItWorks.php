<?php

namespace App\Fields\Partials;

use Log1x\AcfComposer\Builder;
use Log1x\AcfComposer\Partial;

class HowItWorks extends Partial
{
    /**
     * The partial field group.
     */
    public function fields(): Builder
    {
        $fields = Builder::make('how_it_works');

        $fields
            ->addWysiwyg('title', [
                'label' => 'Title',
                'toolbar' => 'full',
                'media_upload' => 0,
            ])
            ->addRepeater('add_how_it_works', [
                'label' => 'Steps',
                'instructions' => 'Add steps',
                'layout' => 'block',
                'button_label' => 'Add Step',
            ])
                ->addImage('image', [
                    'label' => 'Image',
                    'return_format' => 'id',
                    'preview_size' => 'medium',
                ])
                ->addText('title', [
                    'label' => 'Title',
                ])
                ->addWysiwyg('description', [
                    'label' => 'Description',
                    'toolbar' => 'full',
                    'media_upload' => 0,
                ])
            ->endRepeater();

        return $fields;
    }
}
