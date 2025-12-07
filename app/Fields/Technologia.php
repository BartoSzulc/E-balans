<?php

namespace App\Fields;

use Log1x\AcfComposer\Builder;
use Log1x\AcfComposer\Field;

class Technologia extends Field
{
    /**
     * The field group.
     */
    public function fields(): array
    {
        $fields = Builder::make('technologia');

        $fields
            ->setLocation('page_template', '==', 'template-technologia.blade.php');

        $fields


        ->addTab("page_hero", [
            "label" => "Hero",
        ])
        ->addGroup("page_hero", [
            "label" => "Sekcja Hero",
        ])
        ->addText("section_id", [
            "label" => "ID sekcji",
            "instructions" => "Używane jako HTML id (np. page-hero)",
            "default_value" => "page-hero",
        ])
        ->addWysiwyg("subtitle", [
            "label" => "Podtytuł",
            "default_value" => "TECHNOLOGIA MODUŁOWA",
            "toolbar" => "full",
            "media_upload" => 0,
        ])
        ->addWysiwyg("main_title", [
            "label" => "Główny tytuł",
            "default_value" => 'Budownictwo modułowe to <span class="text-color-3">innowacyjna metoda</span> <span class="text-color-2">wznoszenia obiektów</span>, w której budynki powstają',
            "toolbar" => "full",
            "media_upload" => 0,
        ])
        ->addWysiwyg("description", [
            "label" => "Opis pod tytułem",
            "default_value" => "z prefabrykowanych modułów – te natomiast wytwarzane są z najwyższą starannością <br>w kontrolowanych warunkach fabrycznych. Następnie przewożone są na miejsce przeznaczenia, gdzie montowane są w jedną całość.",
            "toolbar" => "full",
            "media_upload" => 0,
        ])
        ->addWysiwyg("grey_panel_text", [
            "label" => "Tekst w szarym panelu",
            "default_value" => 'Ta zaawansowana technologia pozwala na <span class="text-color-3">znaczące skrócenie czasu realizacji</span> inwestycji, <br>przy jednoczesnym zachowaniu najwyższej jakości i precyzji wykonania.',
            "toolbar" => "full",
            "media_upload" => 0,
        ])
        ->addImage("hero_image", [
            "label" => "Zdjęcie tła",
            "instructions" => "Główne zdjęcie tła sekcji hero",
            "return_format" => "id",
            "preview_size" => "medium",
            "library" => "all",
        ])
        
        ->endGroup()
        ->addTab("global_steps", [
            "label" => "Proces Budowy",
        ])
        ->addGroup("global_steps", [
            "label" => "Sekcja Proces Budowy",
        ])
        ->addText("section_id", [
            "label" => "ID sekcji",
            "instructions" => "Używane jako HTML id dla kotwy (np. proces-budowy)",
            "default_value" => "proces-budowy",
        ])
        ->addWysiwyg("title", [
            "label" => "Tytuł sekcji",
            "default_value" => "Proces budowy modułowej",
            "toolbar" => "full",
            "media_upload" => 0,
        ])
        ->addRepeater("steps", [
            "label" => "Kroki procesu",
            "layout" => "block",
            "button_label" => "Dodaj krok",
            "min" => 1,
        ])
        ->addImage("icon", [
            "label" => "Ikona kroku",
            "instructions" => "Ikona w formacie SVG lub PNG",
            "return_format" => "id",
            "preview_size" => "thumbnail",
            "library" => "all",
        ])
        ->addText("step_title", [
            "label" => "Tytuł kroku",
            "default_value" => "Etap projektowy",
        ])
        ->addWysiwyg("step_description", [
            "label" => "Opis kroku",
            "default_value" => "Kompleksowe projektowanie uwzględniające specyfikę technologii modułowej.",
            "toolbar" => "full",
            "media_upload" => 0,
        ])
        ->endRepeater()
        ->endGroup()
        ->addTab("zalety_technologii", [
            "label" => "Zalety Technologii",
        ])
        ->addGroup("zalety_technologii", [
            "label" => "Sekcja Zalety Technologii",
        ])
        ->addText("section_id", [
            "label" => "ID sekcji",
            "instructions" => "Używane jako HTML id dla kotwy (np. zalety-technologii)",
            "default_value" => "zalety-technologii",
        ])
        ->addWysiwyg("title", [
            "label" => "Tytuł sekcji",
            "default_value" => "Zalety technologii modułowej",
            "toolbar" => "full",
            "media_upload" => 0,
        ])
        ->addRepeater("advantages", [
            "label" => "Zalety",
            "layout" => "block",
            "button_label" => "Dodaj zaletę",
            "min" => 1,
        ])
        ->addText("advantage_title", [
            "label" => "Tytuł zalety",
            "default_value" => "Szybkość Realizacji",
        ])
        ->addWysiwyg("advantage_description", [
            "label" => "Opis zalety",
            "default_value" => "Projekty mogą być ukończone nawet o 50% szybciej niż w przypadku tradycyjnego budownictwa.",
            "toolbar" => "full",
            "media_upload" => 0,
        ])
        ->endRepeater()
        ->endGroup()
        ->addTab("porownanie_technologii", [
            "label" => "Porównanie Technologii",
        ])
        ->addGroup("porownanie_technologii", [
            "label" => "Sekcja Porównanie Technologii",
        ])
        ->addText("section_id", [
            "label" => "ID sekcji",
            "instructions" => "Używane jako HTML id dla kotwy (np. porownanie-technologii)",
            "default_value" => "porownanie-technologii",
        ])
        ->addWysiwyg("title", [
            "label" => "Tytuł sekcji",
            "default_value" => "ZASTOSOWANIA TECHNOLOGII MODUŁOWEJ",
            "toolbar" => "full",
            "media_upload" => 0,
        ])
        ->addText("column_criterion", [
            "label" => "Nagłówek kolumny kryterium",
            "default_value" => "KRYTERIUM",
        ])
        ->addText("column_traditional", [
            "label" => "Nagłówek kolumny tradycyjnej",
            "default_value" => "TRADYCYJNE BUDOWNICTWO",
        ])
        ->addText("column_modular", [
            "label" => "Nagłówek kolumny modułowej",
            "default_value" => "BUDOWNICTWO MODUŁOWE",
        ])
        ->addRepeater("comparison_rows", [
            "label" => "Wiersze porównania",
            "layout" => "block",
            "button_label" => "Dodaj wiersz",
            "min" => 1,
        ])
        ->addText("criterion", [
            "label" => "Kryterium",
            "default_value" => "Czas budowy",
        ])
        ->addText("traditional_value", [
            "label" => "Wartość tradycyjna",
            "default_value" => "24+ miesięcy",
        ])
        ->addWysiwyg("modular_value", [
            "label" => "Wartość modułowa",
            "default_value" => "13–17 miesięcy (50% szybciej)",
            "toolbar" => "full",
            "media_upload" => 0,
        ])
        ->endRepeater()
        ->endGroup()
        ->addTab("technologia_modulowa", [
            "label" => "Technologia Modułowa",
        ])
        ->addGroup("technologia_modulowa", [
            "label" => "Sekcja Technologia Modułowa",
        ])
        ->addText("section_id", [
            "label" => "ID sekcji",
            "instructions" => "Używane jako HTML id dla kotwy (np. technologia-modulowa)",
            "default_value" => "technologia-modulowa",
        ])
        ->addWysiwyg("title", [
            "label" => "Tytuł sekcji",
            "default_value" => "Technologia modułowa znajduje <br>zastosowanie w różnorodnych projektach",
            "toolbar" => "full",
            "media_upload" => 0,
        ])
        ->addRepeater("applications", [
            "label" => "Zastosowania technologii",
            "layout" => "block",
            "button_label" => "Dodaj zastosowanie",
            "min" => 1,
        ])
        ->addText("app_id", [
            "label" => "ID zastosowania",
            "instructions" => "Używane jako identyfikator dla hover (np. hotele-i-obiekty-turystyczne)",
            "default_value" => "hotele-i-obiekty-turystyczne",
        ])
        ->addText("app_title", [
            "label" => "Tytuł zastosowania",
            "default_value" => "HOTELE I OBIEKTY TURYSTYCZNE",
        ])
        ->addWysiwyg("app_description", [
            "label" => "Opis zastosowania",
            "default_value" => "Szybka realizacja obiektów hotelowych pozwala <br>na wcześniejsze generowanie przychodów.",
            "toolbar" => "full",
            "media_upload" => 0,
        ])
        ->addImage("app_image", [
            "label" => "Zdjęcie zastosowania",
            "return_format" => "id",
            "preview_size" => "medium",
            "library" => "all",
        ])
        ->endRepeater()
        ->endGroup()

        ;

        return $fields->build();
    }
}
