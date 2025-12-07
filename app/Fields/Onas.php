<?php

namespace App\Fields;

use Log1x\AcfComposer\Builder;
use Log1x\AcfComposer\Field;

class Onas extends Field
{
    /**
     * The field group.
     */
    public function fields(): array
    {
        $fields = Builder::make('onas');

        $fields
            ->setLocation('page_template', '==', 'template-onas.blade.php');


        $fields
            ->addTab("about_us", [
                "label" => "Hero",
            ])
            ->addGroup("about_us", [
                "label" => "Sekcja Hero",
            ])
            ->addText("section_id", [
                "label" => "ID sekcji",
                "instructions" => "Używane jako HTML id (np. about-us)",
                "default_value" => "about-us",
            ])
            ->addWysiwyg("subtitle", [
                "label" => "Podtytuł",
                "default_value" => "O PRO MODULAR",
                "toolbar" => "full",
                "media_upload" => 0,
            ])
            ->addWysiwyg("main_title", [
                "label" => "Główny tytuł",
                "default_value" => 'Pro Modular to firma specjalizująca się <br>w <span class="text-color-3">innowacyjnym</span> <span class="text-color-2">budownictwie modułowym</span>, założona przez <br>Marcina Serkiewicza -',
                "toolbar" => "full",
                "media_upload" => 0,
            ])
            ->addWysiwyg("description", [
                "label" => "Opis pod tytułem",
                "default_value" => "eksperta z wieloletnim doświadczeniem w zarządzaniu projektami modułowymi na rynkach globalnych.",
                "toolbar" => "full",
                "media_upload" => 0,
            ])
            ->addWysiwyg("mission_text", [
                "label" => "Tekst misji (w ramce)",
                "default_value" => 'Nasza misja to transformacja branży budowlanej poprzez dostarczanie <span class="text-color-5">zaawansowanych rozwiązań modułowych</span>, które znacząco skracają czas realizacji inwestycji przy jednoczesnym zachowaniu najwyższej jakości.',
                "toolbar" => "full",
                "media_upload" => 0,
            ])
            ->addImage("hero_image", [
                "label" => "Zdjęcie tła",
                "instructions" => "Główne zdjęcie tła sekcji",
                "return_format" => "id",
                "preview_size" => "medium",
                "library" => "all",
            ])
            ->endGroup()


            ->addTab("our_history", [
                "label" => "Nasza Historia",
            ])
            ->addGroup("our_history", [
                "label" => "Sekcja Nasza Historia",
            ])
            ->addText("section_id", [
                "label" => "ID sekcji",
                "instructions" => "Używane jako HTML id (np. our-history)",
                "default_value" => "our-history",
            ])
            ->addWysiwyg("title", [
                "label" => "Tytuł sekcji",
                "default_value" => "NASZA HISTORIA",
                "toolbar" => "full",
                "media_upload" => 0,
            ])
            ->addRepeater("history_steps", [
                "label" => "Kroki historii",
                "layout" => "block",
                "button_label" => "Dodaj krok",
                "min" => 1,
                "max" => 5,
            ])
            ->addText("year", [
                "label" => "Rok",
                "default_value" => "2023",
                "instructions" => "Rok dla tego kroku historii",
            ])
            ->addWysiwyg("description", [
                "label" => "Opis kroku",
                "default_value" => 'Od 2025 roku, Pro Modular rozszerzyło swoją działalność <br><span class="text-color-3">o produkcję w pełni wyposażonych modułowych systemów budowlanych</span> <br>w oparciu o konstrukcje stalowe, uruchamiając własne zakłady produkcyjne.',
                "toolbar" => "full",
                "media_upload" => 0,
            ])
            ->endRepeater()
            ->endGroup()
            // Add this after the About Us tab in your fields() method:

            ->addTab("about_founder", [
                "label" => "O Założycielu",
            ])
            ->addGroup("about_founder", [
                "label" => "Sekcja O Założycielu",
            ])
            ->addText("section_id", [
                "label" => "ID sekcji",
                "instructions" => "Używane jako HTML id (np. about-founder)",
                "default_value" => "about-founder",
            ])
            ->addWysiwyg("subtitle", [
                "label" => "Podtytuł",
                "default_value" => "O założycielu",
                "toolbar" => "full",
                "media_upload" => 0,
            ])
            ->addWysiwyg("founder_name", [
                "label" => "Imię i nazwisko założyciela",
                "default_value" => "Marcin Serkiewicz",
                "toolbar" => "full",
                "media_upload" => 0,
            ])
            ->addWysiwyg("founder_title", [
                "label" => "Tytuł założyciela",
                "default_value" => "Marcin Serkiewicz",
                "toolbar" => "full",
                "media_upload" => 0,
            ])
            ->addWysiwyg("intro_text", [
                "label" => "Tekst wprowadzający",
                "default_value" => "Marcin Serkiewicz to magister prawa z Europejskiej Szkoły Prawa i Administracji w Warszawie oraz absolwent Inżynierii Lądowej na Stratford Newham University w Londynie.",
                "toolbar" => "full",
                "media_upload" => 0,
            ])
            ->addWysiwyg("description", [
                "label" => "Główny opis",
                "default_value" => '<p><strong>Posiada wieloletnie doświadczenie</strong> jako Project Manager w nadzorowaniu zróżnicowanych inwestycji budownictwa modułowego na rynkach globalnych - USA, Kanada, Europa i Azja. Jest certyfikowanym specjalistą w zarządzaniu projektami (PMP) i metodologii Agile.</p><br><p><strong>Jego umiejętności obejmują</strong> strategiczne planowanie, zarządzanie relacjami, negocjacje umów oraz zarządzanie procesami zakupowymi. Marcin wyróżnia się biegłością w językach angielskim, niemieckimi hiszpańskim, co pozwala na skuteczną komunikacjęw międzynarodowym środowisku biznesowym.</p>',
                "toolbar" => "full",
                "media_upload" => 0,
            ])
            ->addRepeater("founder_slides", [
                "label" => "Slajdy założyciela",
                "layout" => "block",
                "button_label" => "Dodaj slajd",
                "min" => 1,
            ])
            ->addImage("slide_image", [
                "label" => "Zdjęcie slajdu",
                "instructions" => "Główne zdjęcie slajdu",
                "return_format" => "id",
                "preview_size" => "medium",
                "library" => "all",
            ])
            ->addWysiwyg("quote_text", [
                "label" => "Tekst cytatu",
                "default_value" => "Budownictwo modułowe to nie tylko technologia - to nowe podejście do realizacji inwestycji, które jest szybsze, bardziej efektywne i zrównoważone.",
                "toolbar" => "full",
                "media_upload" => 0,
            ])
            ->addText("quote_author", [
                "label" => "Autor cytatu",
                "default_value" => "Marcin Serkiewicz",
            ])
            ->endRepeater()
            ->endGroup()

            // Add this after the About Founder tab in your fields() method:

            ->addTab("our_values", [
                "label" => "Nasze Wartości",
            ])
            ->addGroup("our_values", [
                "label" => "Sekcja Nasze Wartości",
            ])
            ->addText("section_id", [
                "label" => "ID sekcji",
                "instructions" => "Używane jako HTML id (np. our-values)",
                "default_value" => "our-values",
            ])
            ->addWysiwyg("title", [
                "label" => "Tytuł sekcji",
                "default_value" => "NASZE WARTOŚCI",
                "toolbar" => "full",
                "media_upload" => 0,
            ])
            ->addRepeater("values", [
                "label" => "Wartości",
                "layout" => "block",
                "button_label" => "Dodaj wartość",
                "min" => 1,
                "max" => 5,
            ])
            ->addImage("icon", [
                "label" => "Ikona wartości",
                "instructions" => "Ikona w formacie SVG lub PNG",
                "return_format" => "id",
                "preview_size" => "thumbnail",
                "library" => "all",
            ])
            ->addWysiwyg("description", [
                "label" => "Opis wartości",
                "default_value" => "Nieustannie poszukujemy nowych rozwiązań i technologii, które pozwalają nam dostarczać coraz lepsze produkty i usługi.",
                "toolbar" => "full",
                "media_upload" => 0,
            ])
            ->endRepeater()
            ->endGroup()


            // Add this after the Our Values tab in your fields() method:

            ->addTab("partners", [
                "label" => "Wspieramy/Partnerzy",
            ])
            ->addGroup("partners", [
                "label" => "Sekcja Wspieramy/Partnerzy",
            ])
            ->addText("section_id", [
                "label" => "ID sekcji",
                "instructions" => "Używane jako HTML id (np. partners)",
                "default_value" => "partners",
            ])
            ->addWysiwyg("title", [
                "label" => "Tytuł sekcji",
                "default_value" => "Wspieramy/ Pomagamy",
                "toolbar" => "full",
                "media_upload" => 0,
            ])
            ->addRepeater("partner_logos", [
                "label" => "Loga partnerów",
                "layout" => "block",
                "button_label" => "Dodaj logo partnera",
                "min" => 1,
            ])
            ->addImage("logo", [
                "label" => "Logo partnera",
                "instructions" => "Logo w formacie PNG, JPG lub SVG",
                "return_format" => "id",
                "preview_size" => "medium",
                "library" => "all",
            ])
            ->addText('partner_class', [
                "label" => "Klasa CSS logo",
                "instructions" => "Opcjonalna klasa CSS do stylizacji logo (np. 'h-120')",
                "default_value" => "",
            ])
            ->addText("partner_name", [
                "label" => "Nazwa partnera",
                "instructions" => "Używane jako tekst alternatywny",
                "default_value" => "Partner",
            ])
            ->addLink("partner_link", [
                "label" => "Link do partnera (opcjonalny)",
                "instructions" => "Jeśli podasz link, logo będzie klikalny",
                "return_format" => "array",
            ])
            ->endRepeater()
            ->endGroup()





            ->addTab("gallery", [
                "label" => "Galeria",
            ])
            ->addGroup("gallery", [
                "label" => "Sekcja Galeria",
            ])
            ->addText("section_id", [
                "label" => "ID sekcji",
                "instructions" => "Używane jako HTML id (np. gallery)",
                "default_value" => "gallery",
            ])
            ->addWysiwyg("title", [
                "label" => "Tytuł sekcji",
                "default_value" => "Galeria",
                "toolbar" => "full",
                "media_upload" => 0,
            ])
            ->addText("gallery_id", [
                "label" => "ID galerii",
                "instructions" => "Unikalny identyfikator dla lightbox (np. galleryOnas)",
                "default_value" => "galleryOnas",
            ])
            ->addRepeater("gallery_images", [
                "label" => "Zdjęcia galerii",
                "layout" => "block",
                "button_label" => "Dodaj zdjęcie",
                "min" => 1,
            ])
            ->addImage("image", [
                "label" => "Zdjęcie",
                "instructions" => "Zdjęcie do galerii",
                "return_format" => "id",
                "preview_size" => "medium",
                "library" => "all",
            ])
            ->addText("alt_text", [
                "label" => "Tekst alternatywny",
                "instructions" => "Opis zdjęcia dla dostępności",
                "default_value" => "Zdjęcie z galerii",
            ])
            ->addImage("thumbnail", [
                "label" => "Miniatura (opcjonalna)",
                "instructions" => "Jeśli nie podasz, użyje głównego zdjęcia",
                "return_format" => "id",
                "preview_size" => "thumbnail",
                "library" => "all",
            ])
            ->endRepeater()
            ->endGroup()
        ;

        return $fields->build();
    }
}
