<?php

namespace App\Fields;

use Log1x\AcfComposer\Builder;
use Log1x\AcfComposer\Field;

class Kontakt extends Field
{
    /**
     * The field group.
     */
    public function fields(): array
    {
        $fields = Builder::make('kontakt');

        $fields
        ->setLocation('page_template', '==', 'template-kontakt.blade.php');

        $fields
        ->addTab("kontakt_hero", [
            "label" => "Kontakt Hero",
        ])
        ->addGroup("kontakt_hero", [
            "label" => "Sekcja Kontakt Hero",
        ])
        ->addText("section_id", [
            "label" => "ID sekcji",
            "instructions" => "Używane jako HTML id dla kotwy (np. kontakt-hero)",
            "default_value" => "kontakt-hero",
        ])
        ->addText("badge_text", [
            "label" => "Tekst badge",
            "default_value" => "Kontakt",
        ])
        ->addWysiwyg("main_title", [
            "label" => "Główny tytuł",
            "default_value" => "Skontaktuj się z nami",
            "toolbar" => "full",
            "media_upload" => 0,
        ])
        ->addWysiwyg("description", [
            "label" => "Opis",
            "default_value" => "Zacznijmy współpracę nad Twoim projektem budowlanym.",
            "toolbar" => "full",
            "media_upload" => 0,
        ])
        ->addRepeater("contact_items", [
            "label" => "Elementy kontaktowe",
            "layout" => "block",
            "button_label" => "Dodaj element kontaktowy",
            "min" => 1,
        ])
        ->addImage("icon", [
            "label" => "Ikona",
            "instructions" => "Preferowane formaty: SVG, PNG, JPG",
            "return_format" => "id",
            "preview_size" => "thumbnail",
            "library" => "all",
        ])
        ->addText("label", [
            "label" => "Etykieta",
            "default_value" => "E-mail",
        ])
        ->addText("contact_value", [
            "label" => "Wartość kontaktu",
            "default_value" => "office@promodular.com.pl",
        ])
        ->addText("contact_link", [
            "label" => "Link kontaktu",
            "instructions" => "np. mailto:email@domain.com lub tel:+48123456789",
            "default_value" => "mailto:office@promodular.com.pl",
        ])
        ->endRepeater()
        ->addTextarea("map_embed", [
            "label" => "Kod embed mapy",
            "instructions" => "Kod HTML do osadzenia mapy (Google Maps, OpenStreetMap itp.)",
            "default_value" => "",
            "rows" => 3,
        ])
        ->endGroup()
        ->addTab("kontakt_formularz", [
            "label" => "Kontakt Formularz",
        ])
        ->addGroup("kontakt_formularz", [
            "label" => "Sekcja Kontakt Formularz",
        ])
        ->addText("section_id", [
            "label" => "ID sekcji",
            "instructions" => "Używane jako HTML id dla kotwy (np. kontakt-formularz)",
            "default_value" => "kontakt-formularz",
        ])
        ->addWysiwyg("form_title", [
            "label" => "Tytuł formularza",
            "default_value" => "Wypełnij formularz",
            "toolbar" => "full",
            "media_upload" => 0,
        ])
        ->addWysiwyg("form_description", [
            "label" => "Opis formularza",
            "default_value" => "Masz pytanie lub potrzebujesz wyceny? <br>Skontaktuj się z nami jeszcze dziś.",
            "toolbar" => "full",
            "media_upload" => 0,
        ])
        ->addText("form_shortcode", [
            "label" => "Shortcode formularza",
            "instructions" => "Shortcode Contact Form 7",
            "default_value" => '[contact-form-7 id="75c58be" title="Contact form 1"]',
        ])
        ->endGroup()
        ;
        return $fields->build();
    }
}
