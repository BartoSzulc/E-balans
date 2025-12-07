<?php

namespace App\Fields;

use Log1x\AcfComposer\Builder;
use Log1x\AcfComposer\Field;

class Aktualnosci extends Field
{
    /**
     * The field group.
     */
    public function fields(): array
    {
        $fields = Builder::make('aktualnosci');

        $fields
        ->setLocation('page_template', '==', 'template-aktualnosci.blade.php');

        $fields
            ->addRepeater('items')
                ->addText('item')
            ->endRepeater();

        return $fields->build();
    }
}
