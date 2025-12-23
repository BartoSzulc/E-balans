<?php

namespace App\Fields\Partials;

use Log1x\AcfComposer\Builder;
use Log1x\AcfComposer\Partial;

class Hero extends Partial
{
    /**
     * The partial field group.
     */
    public function fields(): Builder
    {
        $fields = Builder::make('hero');

        $fields
            ->addGroup('hero', [
                'label' => 'Hero Section',
            ])
                ->addWysiwyg('title', [
                    'label' => 'Title',
                    'instructions' => 'Main heading for hero section',
                    'toolbar' => 'full',
                    'media_upload' => 0,
                ])
                ->addImage('hero_image', [
                    'label' => 'Hero Image',
                    'return_format' => 'id',
                ])
            ->endGroup();
               

        return $fields;
    }
}
