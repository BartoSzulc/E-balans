<?php

namespace App\Fields;

use Log1x\AcfComposer\Builder;
use Log1x\AcfComposer\Field;

class Referencje extends Field
{
    /**
     * The field group.
     */
    public function fields(): array
    {
        $fields = Builder::make('referencje');

        $fields
            ->setLocation('post_type', '==', 'referencje');

        $fields
            ->addFile('pdf_file', [
                'label' => 'PDF File',
                'instructions' => 'Upload the reference PDF document',
                'return_format' => 'array',
                'library' => 'all',
                'mime_types' => 'pdf',
            ])
            ->addWysiwyg('excerpt', [
                'label' => 'Short Description',
                'instructions' => 'Brief description shown in the grid',
                'toolbar' => 'basic',
                'media_upload' => 0,
            ]);

        return $fields->build();
    }
}
