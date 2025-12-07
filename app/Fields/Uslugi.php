<?php

namespace App\Fields;

use Log1x\AcfComposer\Builder;
use Log1x\AcfComposer\Field;

class Uslugi extends Field
{
    /**
     * The field group.
     */
    public function fields(): array
    {
        $fields = Builder::make('uslugi');

        $fields
            ->setLocation('page_template', '==', 'template-uslugi.blade.php');

        $fields
        ->addTab("page_hero", [
            "label" => "Page Hero",
        ])
        ->addGroup("page_hero", [
            "label" => "Sekcja Page Hero",
        ])
        ->addText("section_id", [
            "label" => "ID sekcji",
            "instructions" => "Używane jako HTML id dla kotwy (np. page-hero)",
            "default_value" => "page-hero",
        ])
        ->addText("badge_text", [
            "label" => "Tekst badge",
            "default_value" => "Nasze usługi",
        ])
        ->addWysiwyg("main_title", [
            "label" => "Główny tytuł",
            "default_value" => 'Pro Modular oferuje <span class="text-color-2">kompleksowe usługi</span> w zakresie <span class="text-color-3">budownictwa modułowego,</span>',
            "toolbar" => "full",
            "media_upload" => 0,
        ])
        ->addWysiwyg("subtitle", [
            "label" => "Podtytuł",
            "default_value" => "od koncepcji i projektowania, przez produkcję, transport i montaż, <br>po wykończenie i oddanie obiektu do użytku.",
            "toolbar" => "full",
            "media_upload" => 0,
        ])
        ->addWysiwyg("gray_panel_text", [
            "label" => "Tekst w szarym panelu",
            "default_value" => 'Nasze podejście opiera się na ścisłej <span class="text-color-3">współpracy z klientem na każdym etapie realizacji projektu,</span> <br>aby zapewnić optymalne rozwiązania dostosowane do jego potrzeb.',
            "toolbar" => "full",
            "media_upload" => 0,
        ])
        ->addImage("hero_image", [
            "label" => "Zdjęcie hero",
            "return_format" => "id",
            "preview_size" => "medium",
            "library" => "all",
        ])
        ->endGroup()
        ->addTab("about_us_sections", [
            "label" => "Sekcje O Nas",
        ])
        ->addGroup("about_us_sections", [
            "label" => "Sekcje O Nas",
        ])
        ->addRepeater("sections", [
            "label" => "Sekcje",
            "layout" => "block",
            "button_label" => "Dodaj sekcję",
            "min" => 1,
        ])
        ->addWysiwyg("title", [
            "label" => "Tytuł sekcji",
            "default_value" => "Zarządzanie <br>i koordynacja inwestycji",
            "toolbar" => "full",
            "media_upload" => 0,
        ])
        ->addWysiwyg("main_description", [
            "label" => "Główny opis",
            "default_value" => 'Pro Modular zapewnia <span class="text-color-2">kompleksowe wsparcie inwestycyjne</span> - od koncepcji, przez projektowanie, po realizację i odbiory.',
            "toolbar" => "full",
            "media_upload" => 0,
        ])
        ->addWysiwyg("secondary_description", [
            "label" => "Opis dodatkowy",
            "default_value" => "Gwarantujemy płynność i efektywność na każdym etapie projektu, dzięki profesjonalnemu zarządzaniu i koordynacji prac.",
            "toolbar" => "full",
            "media_upload" => 0,
        ])
        ->addText("approach_title", [
            "label" => "Tytuł podejścia",
            "default_value" => "Nasze podejście:",
        ])
        ->addRepeater("approach_list", [
            "label" => "Lista podejścia",
            "layout" => "table",
            "button_label" => "Dodaj element",
            "min" => 1,
        ])
        ->addWysiwyg("list_item", [
            "label" => "Element listy",
            "default_value" => "Szczegółowe planowanie i harmonogramowanie",
        ])
        ->endRepeater()
        ->addTrueFalse("has_swiper", [
            "label" => "Slider zdjęć?",
            "default_value" => 0,
            "ui" => 1,
        ])
        ->addImage("image_single", [
            "label" => "Zdjęcie",
            "return_format" => "id",
            "preview_size" => "medium",
            "library" => "all",
            "conditional_logic" => [
                [
                    [
                        "field" => "has_swiper",
                        "operator" => "==",
                        "value" => "0",
                    ],
                ],
            ],
        ])
        ->addRepeater("swiper_images", [
            "label" => "Zdjęcie slidera",
            "layout" => "block",
            "button_label" => "Dodaj zdjęcie do slidera",
            "min" => 1,
            "conditional_logic" => [
                [
                    [
                        "field" => "has_swiper",
                        "operator" => "==",
                        "value" => "1",
                    ],
                ],
            ],
        ])
        ->addImage("image", [
            "label" => "Zdjęcie",
            "return_format" => "id",
            "preview_size" => "medium",
            "library" => "all",
        ])
        ->endRepeater()
        ->addSelect("image_height", [
            "label" => "Wysokość zdjęcia",
            "choices" => [
                "660" => "660",
                "620" => "620",
                "580" => "580",
            ],
            "default_value" => "660",
            "allow_null" => 0,
        ])
        ->endRepeater()
        ->endGroup()
        ;

        return $fields->build();
    }
}
