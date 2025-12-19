<?php

namespace App\Options;

use Log1x\AcfComposer\Builder;
use Log1x\AcfComposer\Options as Field;
use App\Fields\Partials\Buttons;


class Options extends Field
{
    /**
     * The option page menu name.
     *
     * @var string
     */
    public $name = 'Zarządzanie motywem';

    /**
     * The option page menu slug.
     *
     * @var string
     */
    public $slug = 'options';

    /**
     * The option page document title.
     *
     * @var string
     */
    public $title = 'Zarządzanie motywem';

    /**
     * The option page permission capability.
     *
     * @var string
     */
    public $capability = 'edit_theme_options';

    /**
     * The option page menu position.
     *
     * @var int
     */
    public $position = PHP_INT_MAX;

    /**
     * The option page visibility in the admin menu.
     *
     * @var boolean
     */
    public $menu = true;

    /**
     * The slug of another admin page to be used as a parent.
     *
     * @var string
     */
    public $parent = null;

    /**
     * The option page menu icon.
     *
     * @var string
     */
    public $icon = null;

    /**
     * Redirect to the first child page if one exists.
     *
     * @var boolean
     */
    public $redirect = true;

    /**
     * The post ID to save and load values from.
     *
     * @var string|int
     */
    public $post = 'options';

    /**
     * The option page autoload setting.
     *
     * @var bool
     */
    public $autoload = true;

    /**
     * The additional option page settings.
     *
     * @var array
     */
    public $settings = [];

    /**
     * Localized text displayed on the submit button.
     */
    public function updateButton(): string
    {
        return __('Update', 'acf');
    }

    /**
     * Localized text displayed after form submission.
     */
    public function updatedMessage(): string
    {
        return __('Options Updated', 'acf');
    }

    /**
     * The option page field group.
     */
    public function fields(): array
    {
        $fields = Builder::make('options', ['title' => 'Ogólne']);

        $fields
        
        ->addTab('header', ['label' => 'Nagłówek'])

                ->addGroup('header', [
                    'label' => 'Nagłówek',
                ])
                ->addLink('button', [
                    'label' => 'Przycisk w nagłówku',
                    'instructions' => 'Wproadz link do konsultacji',
                ])
                
                
            ->endGroup()
        ->addTab('footer', ['label' => 'Stopka'])
            ->addGroup('footer', [
                'label' => 'Stopka',
            ])
                ->addTrueFalse('wyswietl_belke', [
                    'label' => 'Wyświetl belkę',
                    'instructions' => 'Zaznacz, aby wyświetlić belkę nad stopką',
                    'default_value' => 0,
                    'ui' => 1,
                ])
                ->addWysiwyg('belka_text', [
                    'label' => 'Tekst belki',
                    'instructions' => 'Wprowadź tekst wyświetlany w belce',
                    'toolbar' => 'full',
                    'media_upload' => 0,
                    'conditional_logic' => [
                        [
                            [
                                'field' => 'footer_wyswietl_belke',
                                'operator' => '==',
                                'value' => '1',
                            ],
                        ],
                    ],
                ])
                ->addWysiwyg('footer_text', [
                    'label' => 'Tekst w stopce',
                    'instructions' => 'Wprowadź tekst wyświetlany w kolumnie "Znajdź nas"',
                ])

                ->addRepeater('contact_info', ['label' => 'Informacje kontaktowe', 'placement' => 'left', 'button_label' => 'Dodaj informację'])
                    ->addSelect('icon', [
                        'label' => 'Ikona',
                        'choices' => [
                            'envelope' => 'Email (Envelope)',
                            'mobile-screen-button' => 'Telefon (Mobile)',
                            'location-dot' => 'Lokalizacja (Pin)',
                        ],
                        'default_value' => 'envelope',
                    ])
                    ->addText('text', ['label' => 'Tekst', 'placeholder' => 'np. email@example.com'])
                    ->addText('link', ['label' => 'Link (opcjonalnie)', 'placeholder' => 'mailto:email@example.com lub tel:+48123456789'])
                ->endRepeater()
            ->endGroup()
            ->addRepeater('socials', ['label' => 'Social Media', 'placement' => 'left', 'button_label' => 'Dodaj social media'])
                ->addSelect('icon', [
                    'label' => 'Ikona',
                    'choices' => [
                        'facebook-f' => 'Facebook',
                        'instagram' => 'Instagram',
                        'youtube' => 'YouTube',
                    ],
                    'default_value' => 'facebook-f',
                ])
                ->addText('link', ['label' => 'Link', 'placeholder' => 'https://facebook.com/...'])
            ->endRepeater()
        ->addTab('privacy', ['label' => 'Polityka prywatności'])
            ->addWysiwyg('privacy_policy_text', [
                'label' => 'Tekst polityki prywatności',
                'instructions' => 'Wprowadź tekst polityki prywatności',
                'default_value' => 'Polityka prywatności',
            ])
        ->addTab('scripts', ['label' => 'Dodatkowe skrypty'])
            ->addTextarea('head', [
                'label' => 'Skrypty w sekcji <head>',
                'instructions' => 'Dodaj skrypty do sekcji <head>',
                'rows' => 5,
            ])
            ->addTextarea('body', [
                'label' => 'Skrypty przed zamknięciem znacznika <body>',
                'instructions' => 'Dodaj skrypty przed zamknięciem znacznika <body>',
                'rows' => 5,
            ])
            ;

        return $fields->build();
    }
}