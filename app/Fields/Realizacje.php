<?php

namespace App\Fields;

use Log1x\AcfComposer\Builder;
use Log1x\AcfComposer\Field;

class Realizacje extends Field
{
    /**
     * The field group.
     */
    public function fields(): array
    {
        $fields = Builder::make('realizacje');

        $fields
            ->setLocation('page_template', '==', 'template-realizacje.blade.php');

        $fields
        ->addTab("realizacje_hero", [
            "label" => "Realizacje Hero",
        ])
        ->addGroup("realizacje_hero", [
            "label" => "Sekcja Realizacje Hero",
        ])
        ->addText("section_id", [
            "label" => "ID sekcji",
            "instructions" => "Używane jako HTML id dla kotwy (np. realizacje-hero)",
            "default_value" => "realizacje-hero",
        ])
        ->addText("badge_text", [
            "label" => "Tekst badge",
            "default_value" => "Nasze realizacje",
        ])
        ->addWysiwyg("main_title", [
            "label" => "Główny tytuł",
            "default_value" => 'W Pro Modular <span class="text-color-2">z dumą prezentujemy</span> <span class="text-color-3">nasze dotychczasowe projekty</span>, które są dowodem naszego',
            "toolbar" => "full",
            "media_upload" => 0,
        ])
        ->addWysiwyg("subtitle", [
            "label" => "Podtytuł",
            "default_value" => "profesjonalizmu, doświadczenia i zaangażowania <br>w dostarczanie najwyższej jakości rozwiązań modułowych.",
            "toolbar" => "full",
            "media_upload" => 0,
        ])
        ->addWysiwyg("gray_panel_text", [
            "label" => "Tekst w szarym panelu",
            "default_value" => 'Każda realizacja to <span class="text-color-3"> unikalne wyzwanie, któremu sprostaliśmy <br>dzięki naszemu doświadczeniu</span> i innowacyjnemu podejściu.',
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
        ->addTab("realizacje_sections", [
            "label" => "Sekcje Realizacji",
        ])
        ->addGroup("realizacje_sections", [
            "label" => "Sekcje Realizacji",
        ])
        ->addRepeater("projects", [
            "label" => "Projekty",
            "layout" => "block",
            "button_label" => "Dodaj projekt",
            "min" => 1,
        ])
        ->addText("project_id", [
            "label" => "ID projektu",
            "instructions" => "Używane jako HTML id dla kotwy (np. projekt-salzburg)",
            "default_value" => "projekt-salzburg",
        ])
        ->addImage("project_logo", [
            "label" => "Logo/zdjęcie projektu",
            "return_format" => "id",
            "preview_size" => "medium",
            "library" => "all",
        ])
        ->addText("project_title", [
            "label" => "Tytuł projektu",
            "default_value" => "Hotel w Salzburg",
        ])
        ->addText("project_location", [
            "label" => "Lokalizacja",
            "default_value" => "Austria",
        ])
        ->addWysiwyg("project_description", [
            "label" => "Opis projektu",
            "default_value" => "Kompleksowa renowacja i modernizacja 150 pokoi hotelowych, obejmująca całkowitą wymianę łazienek i instalację nowego wyposażenia.",
            "toolbar" => "full",
            "media_upload" => 0,
        ])
        ->addText("scope_title", [
            "label" => "Tytuł zakresu prac",
            "default_value" => "Zakres prac",
        ])
        ->addRepeater("scope_list", [
            "label" => "Lista zakresu prac",
            "layout" => "table",
            "button_label" => "Dodaj element",
            "min" => 1,
        ])
        ->addText("scope_item", [
            "label" => "Element zakresu",
            "default_value" => "Demontaż istniejącego wyposażenia",
        ])
        ->endRepeater()
        ->addText("results_title", [
            "label" => "Tytuł rezultatów",
            "default_value" => "Rezultat",
        ])
        ->addWysiwyg("results_description", [
            "label" => "Opis rezultatów",
            "default_value" => "Nowoczesny hotel spełniający najwyższe standardy komfortu i estetyki, oddany do użytku zgodnie z harmonogramem i budżetem.",
            "toolbar" => "full",
            "media_upload" => 0,
        ])
        ->addLink("contact_button", [
            "label" => "Przycisk kontaktu",
            "return_format" => "array",
        ])
        ->addText("contact_button_text", [
            "label" => "Tekst przycisku",
            "default_value" => "Skontaktuj się z nami",
        ])
        ->addText("gallery_title", [
            "label" => "Tytuł galerii",
            "default_value" => "Galeria",
        ])
        ->addRepeater("gallery_images", [
            "label" => "Zdjęcia galerii",
            "layout" => "block",
            "button_label" => "Dodaj zdjęcie",
            "min" => 1,
        ])
        ->addImage("image", [
            "label" => "Zdjęcie",
            "return_format" => "id",
            "preview_size" => "medium",
            "library" => "all",
        ])
        ->addImage("lightbox_image", [
            "label" => "Zdjęcie lightbox (większe)",
            "instructions" => "Opcjonalne - jeśli puste, użyje głównego zdjęcia",
            "return_format" => "id",
            "preview_size" => "medium",
            "library" => "all",
        ])
        ->endRepeater()
        ->endRepeater()
        ->endGroup()
        ;

        return $fields->build();
    }
}
