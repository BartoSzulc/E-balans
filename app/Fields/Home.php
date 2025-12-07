<?php

namespace App\Fields;

use Log1x\AcfComposer\Builder;
use Log1x\AcfComposer\Field;

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
                'label' => 'Hero Section',
            ])
            ->addGroup('hero', [
                'label' => 'Hero Configuration',
            ])
                ->addWysiwyg('title', [
                    'label' => 'Tytuł',
                    'instructions' => 'Main heading for hero section',
                    'toolbar' => 'full',
                    'media_upload' => 0,
                ])
                ->addWysiwyg('description', [
                    'label' => 'Opis',
                    'instructions' => 'Hero description',
                    'toolbar' => 'full',
                    'media_upload' => 0,
                ])
                ->addRepeater('add_button', [
                    'label' => 'Przyciski',
                    'instructions' => 'Add call to action buttons',
                    'layout' => 'block',
                    'button_label' => 'Dodaj przycisk',
                ])
                    ->addLink('link', [
                        'label' => 'Link',
                        'return_format' => 'array',
                    ])
                ->endRepeater()
                ->addTrueFalse('animated', [
                    'label' => 'Animated?',
                    'instructions' => 'Enable animation for this section',
                    'default_value' => 0,
                    'ui' => 1,
                ])
                ->addGallery('animated_images', [
                    'label' => 'Obrazy do animacji',
                    'instructions' => 'Gallery images for animation',
                    'return_format' => 'id',
                    'preview_size' => 'medium',
                    'conditional_logic' => [
                        [
                            [
                                'field' => 'hero_animated',
                                'operator' => '==',
                                'value' => '1',
                            ],
                        ],
                    ],
                ])
            ->endGroup()

            // About Us Section
            ->addTab('about_us', [
                'label' => 'O nas',
            ])
            ->addGroup('about_us', [
                'label' => 'About Us Configuration',
            ])
                ->addText('section_id', [
                    'label' => 'Section ID',
                    'instructions' => 'HTML ID for this section',
                    'default_value' => 'about-us',
                ])
                ->addRepeater('add_column', [
                    'label' => 'Kolumny',
                    'instructions' => 'Add columns with content',
                    'layout' => 'block',
                    'button_label' => 'Dodaj kolumnę',
                ])
                    ->addImage('image', [
                        'label' => 'Obraz',
                        'return_format' => 'id',
                        'preview_size' => 'medium',
                    ])
                    ->addImage('logo', [
                        'label' => 'Logo',
                        'instructions' => 'Optional logo image',
                        'return_format' => 'id',
                        'preview_size' => 'thumbnail',
                        'required' => 0,
                    ])
                    ->addText('title', [
                        'label' => 'Tytuł',
                    ])
                    ->addWysiwyg('description', [
                        'label' => 'Opis',
                        'toolbar' => 'full',
                        'media_upload' => 0,
                    ])
                ->endRepeater()
            ->endGroup()

            // Rozwiązania Section
            ->addTab('rozwiazania', [
                'label' => 'Rozwiązania',
            ])
            ->addGroup('rozwiazania', [
                'label' => 'Rozwiązania Configuration',
            ])
                ->addText('section_id', [
                    'label' => 'Section ID',
                    'instructions' => 'HTML ID for this section',
                    'default_value' => 'rozwiazania',
                ])
                ->addWysiwyg('title', [
                    'label' => 'Tytuł',
                    'toolbar' => 'full',
                    'media_upload' => 0,
                ])
                ->addRepeater('add_tab', [
                    'label' => 'Zakładki',
                    'instructions' => 'Add tabs with content',
                    'layout' => 'block',
                    'button_label' => 'Dodaj zakładkę',
                ])
                    ->addText('tab_name', [
                        'label' => 'Nazwa zakładki',
                    ])
                    ->addWysiwyg('title', [
                        'label' => 'Tytuł',
                        'toolbar' => 'full',
                        'media_upload' => 0,
                    ])
                    ->addWysiwyg('description', [
                        'label' => 'Opis',
                        'toolbar' => 'full',
                        'media_upload' => 0,
                    ])
                    ->addLink('button', [
                        'label' => 'Przycisk',
                        'return_format' => 'array',
                    ])
                    ->addRepeater('accordion', [
                        'label' => 'Accordion',
                        'instructions' => 'Add accordion items',
                        'layout' => 'block',
                        'button_label' => 'Dodaj element',
                    ])
                        ->addWysiwyg('title', [
                            'label' => 'Tytuł',
                            'toolbar' => 'full',
                            'media_upload' => 0,
                        ])
                        ->addWysiwyg('description', [
                            'label' => 'Opis',
                            'toolbar' => 'full',
                            'media_upload' => 0,
                        ])
                        ->addImage('image', [
                            'label' => 'Obraz',
                            'return_format' => 'id',
                            'preview_size' => 'medium',
                        ])
                    ->endRepeater()
                ->endRepeater()
            ->endGroup()

            // Standardy Section
            ->addTab('standardy', [
                'label' => 'Standardy',
            ])
            ->addGroup('standardy', [
                'label' => 'Standardy Configuration',
            ])
                ->addWysiwyg('title', [
                    'label' => 'Tytuł',
                    'toolbar' => 'full',
                    'media_upload' => 0,
                ])
                ->addWysiwyg('wysiwyg', [
                    'label' => 'Opis',
                    'toolbar' => 'full',
                    'media_upload' => 0,
                ])
                ->addImage('background_image', [
                    'label' => 'Obraz tła',
                    'return_format' => 'id',
                    'preview_size' => 'medium',
                ])
                ->addRepeater('add_column', [
                    'label' => 'Kolumny',
                    'instructions' => 'Add columns with content',
                    'layout' => 'block',
                    'button_label' => 'Dodaj kolumnę',
                ])
                    ->addText('title', [
                        'label' => 'Tytuł',
                    ])
                    ->addWysiwyg('description', [
                        'label' => 'Opis',
                        'toolbar' => 'full',
                        'media_upload' => 0,
                    ])
                    ->addImage('image', [
                        'label' => 'Logo',
                        'return_format' => 'id',
                        'preview_size' => 'thumbnail',
                    ])
                ->endRepeater()
            ->endGroup()

            // Zobacz Jak Section
            ->addTab('zobacz_jak', [
                'label' => 'Zobacz Jak',
            ])
            ->addGroup('zobacz_jak', [
                'label' => 'Zobacz Jak Configuration',
            ])
                ->addWysiwyg('title', [
                    'label' => 'Tytuł',
                    'toolbar' => 'full',
                    'media_upload' => 0,
                ])
                ->addSelect('source_type', [
                    'label' => 'Źródło danych',
                    'instructions' => 'Wybierz czy chcesz wyświetlić case studies z CPT czy dodać manualnie',
                    'choices' => [
                        'cpt' => 'Case Studies (CPT)',
                        'manual' => 'Manualne wprowadzenie',
                    ],
                    'default_value' => 'cpt',
                    'ui' => 1,
                    'return_format' => 'value',
                ])
                ->addRelationship('case_studies', [
                    'label' => 'Wybierz Case Studies',
                    'instructions' => 'Wybierz case studies do wyświetlenia',
                    'post_type' => ['case_studies'],
                    'filters' => ['search'],
                    'return_format' => 'id',
                    'conditional_logic' => [
                        [
                            [
                                'field' => 'zobacz_jak_source_type',
                                'operator' => '==',
                                'value' => 'cpt',
                            ],
                        ],
                    ],
                ])
                ->addRepeater('manual_case_studies', [
                    'label' => 'Case Studies',
                    'instructions' => 'Dodaj case studies manualnie',
                    'layout' => 'block',
                    'button_label' => 'Dodaj Case Study',
                    'conditional_logic' => [
                        [
                            [
                                'field' => 'zobacz_jak_source_type',
                                'operator' => '==',
                                'value' => 'manual',
                            ],
                        ],
                    ],
                ])
                    ->addImage('image', [
                        'label' => 'Obraz',
                        'return_format' => 'id',
                        'preview_size' => 'medium',
                    ])
                    ->addText('title', [
                        'label' => 'Tytuł',
                    ])
                    ->addText('nazwa_firmy', [
                        'label' => 'Nazwa firmy',
                    ])
                    ->addImage('logo_firmy', [
                        'label' => 'Logo firmy',
                        'return_format' => 'url',
                        'preview_size' => 'thumbnail',
                    ])
                    ->addRepeater('dodaj_blok_tekstowy', [
                        'label' => 'Bloki tekstowe',
                        'instructions' => 'Dodaj bloki tekstowe',
                        'layout' => 'block',
                        'button_label' => 'Dodaj blok',
                    ])
                        ->addWysiwyg('title', [
                            'label' => 'Tytuł',
                            'toolbar' => 'full',
                            'media_upload' => 0,
                        ])
                        ->addWysiwyg('description', [
                            'label' => 'Opis',
                            'toolbar' => 'full',
                            'media_upload' => 0,
                        ])
                    ->endRepeater()
                ->endRepeater()
            ->endGroup()

            // Testimonials (Opinie) Section
            ->addTab('opinie', [
                'label' => 'Opinie',
            ])
            ->addGroup('opinie', [
                'label' => 'Opinie Configuration',
            ])
                ->addWysiwyg('title', [
                    'label' => 'Tytuł',
                    'toolbar' => 'full',
                    'media_upload' => 0,
                ])
                ->addFile('video', [
                    'label' => 'Video',
                    'instructions' => 'Upload video file',
                    'return_format' => 'array',
                    'library' => 'all',
                    'mime_types' => 'mp4,webm,ogg',
                ])
                ->addImage('poster', [
                    'label' => 'Poster video / Obraz',
                    'instructions' => 'Poster for video or image if no video',
                    'return_format' => 'id',
                    'preview_size' => 'medium',
                ])
                ->addRepeater('add_testimonial', [
                    'label' => 'Opinie',
                    'instructions' => 'Dodaj opinie',
                    'layout' => 'block',
                    'button_label' => 'Dodaj opinię',
                ])
                    ->addWysiwyg('description', [
                        'label' => 'Opinia (tekst)',
                        'toolbar' => 'full',
                        'media_upload' => 0,
                    ])
                    ->addText('author', [
                        'label' => 'Autor',
                    ])
                ->endRepeater()
            ->endGroup()

            // Contact Section
            ->addTab('contact', [
                'label' => 'Kontakt',
            ])
            ->addGroup('contact', [
                'label' => 'Contact Configuration',
            ])
                ->addWysiwyg('title', [
                    'label' => 'Tytuł',
                    'toolbar' => 'full',
                    'media_upload' => 0,
                ])
                ->addWysiwyg('description', [
                    'label' => 'Opis',
                    'toolbar' => 'full',
                    'media_upload' => 0,
                ])
                ->addImage('contact_person_image', [
                    'label' => 'Zdjęcie osoby kontaktowej',
                    'return_format' => 'id',
                    'preview_size' => 'medium',
                ])
                ->addText('text_before_phone', [
                    'label' => 'Tekst przed numerem telefonu',
                    'placeholder' => 'np. Zadzwoń do nas:',
                ])
                ->addText('phone_number', [
                    'label' => 'Numer telefonu',
                    'placeholder' => '+48 123 456 789',
                ])
                ->addText('cf7_shortcode', [
                    'label' => 'Contact Form 7 Shortcode',
                    'instructions' => 'Wklej shortcode formularza (np. [contact-form-7 id="123"])',
                    'placeholder' => '[contact-form-7 id="123"]',
                ])
            ->endGroup();

        return $builder->build();
    }
}
