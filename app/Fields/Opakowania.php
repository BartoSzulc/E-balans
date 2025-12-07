<?php

namespace App\Fields;

use Log1x\AcfComposer\Builder;
use Log1x\AcfComposer\Field;

class Opakowania extends Field
{
    /**
     * The field group.
     */
    public function fields(): array
    {
        $fields = Builder::make('opakowania');

        $fields
            ->setLocation('post_type', '==', 'opakowania');

        $fields
            ->addImage('second_image', [
                'label' => 'Drugie zdjęcie',
                'return_format' => 'id',
                'preview_size' => 'medium',
            ]);
            

        return $fields->build();
    }
}
