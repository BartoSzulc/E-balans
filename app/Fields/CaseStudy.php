<?php

namespace App\Fields;

use Log1x\AcfComposer\Builder;
use Log1x\AcfComposer\Field;

class CaseStudy extends Field
{
    /**
     * The field group.
     */
    public function fields(): array
    {
        $fields = Builder::make('case_study');

        $fields
            ->setLocation('post_type', '==', 'case-study');

        $fields
            ->addImage('logo_klienta', [
                'label' => 'Logo klienta',
                'return_format' => 'id',
                'preview_size' => 'medium',
            ]);
            

        return $fields->build();
    }
}
