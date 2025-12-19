<?php 

function register_custom_post_type_case_study() {  
    $labels = array(
        'name' => 'Case Study',
        'singular_name' => 'Case Study',
        'add_new' => 'Dodaj nowe case study',
        'add_new_item' => 'Dodaj nowe case study',
        'edit_item' => 'Edytuj case study',
        'new_item' => 'Nowe Case Study',
        'view_item' => 'Zobacz case study',
        'search_items' => 'Szukaj case study',
        'not_found' => 'Nie znaleziono case study',
        'not_found_in_trash' => 'Nie znaleziono case study w koszu',
    );

    $args = array(
        'labels' => $labels,
        'has_archive' => false,
        'public' => true,
        'supports' => array('title', 'thumbnail', 'editor', 'custom-fields', 'excerpt'),
        'menu_icon' => 'dashicons-analytics', // Changed icon to be more appropriate for case studies
        'show_ui' => true, 
        'show_in_rest' => true, // Enable Gutenberg editor
        'rewrite' => array('slug' => 'case-study'), // Changed slug to "case-study"
    );

    register_post_type('case-study', $args);
}
add_action('init', 'register_custom_post_type_case_study');

// Register custom taxonomy "Tematyka" for case studies
function register_case_study_taxonomy() {
    $labels = array(
        'name' => 'Tematyka',
        'singular_name' => 'Tematyka',
        'search_items' => 'Szukaj tematyki',
        'all_items' => 'Wszystkie tematyki',
        'parent_item' => 'Tematyka nadrzędna',
        'parent_item_colon' => 'Tematyka nadrzędna:',
        'edit_item' => 'Edytuj tematykę',
        'update_item' => 'Aktualizuj tematykę',
        'add_new_item' => 'Dodaj nową tematykę',
        'new_item_name' => 'Nowa nazwa tematyki',
        'menu_name' => 'Tematyka',
    );
    
    register_taxonomy('tematyka', 'case-study', array(
        'hierarchical' => true,
        'labels' => $labels,
        'show_ui' => true,
        'show_in_rest' => true,
        'show_admin_column' => true,
        'query_var' => true,
        'rewrite' => array('slug' => 'tematyka'),
    ));
}
add_action('init', 'register_case_study_taxonomy');

// Register custom post type "Produkty"
function register_custom_post_type_produkty() {  
    $labels = array(
        'name' => 'Produkty',
        'singular_name' => 'Produkt',
        'add_new' => 'Dodaj nowy produkt',
        'add_new_item' => 'Dodaj nowy produkt',
        'edit_item' => 'Edytuj produkt',
        'new_item' => 'Nowy produkt',
        'view_item' => 'Zobacz produkt',
        'search_items' => 'Szukaj produktów',
        'not_found' => 'Nie znaleziono produktów',
        'not_found_in_trash' => 'Nie znaleziono produktów w koszu',
    );

    $args = array(
        'labels' => $labels,
        'has_archive' => false,
        'public' => true,
        'supports' => array('title', 'thumbnail', 'editor', 'custom-fields', 'excerpt'),
        'menu_icon' => 'dashicons-products',
        'show_ui' => true, 
        'show_in_rest' => true,
        'rewrite' => array('slug' => 'produkty'),
    );

    register_post_type('produkty', $args);
}
add_action('init', 'register_custom_post_type_produkty');

// Register custom taxonomy "Kategoria" for produkty
function register_produkty_taxonomy() {
    $labels = array(
        'name' => 'Kategoria',
        'singular_name' => 'Kategoria',
        'search_items' => 'Szukaj kategorii',
        'all_items' => 'Wszystkie kategorie',
        'parent_item' => 'Kategoria nadrzędna',
        'parent_item_colon' => 'Kategoria nadrzędna:',
        'edit_item' => 'Edytuj kategorię',
        'update_item' => 'Aktualizuj kategorię',
        'add_new_item' => 'Dodaj nową kategorię',
        'new_item_name' => 'Nowa nazwa kategorii',
        'menu_name' => 'Kategoria',
    );
    
    register_taxonomy('kategoria', 'produkty', array(
        'hierarchical' => true,
        'labels' => $labels,
        'show_ui' => true,
        'show_in_rest' => true,
        'show_admin_column' => true,
        'query_var' => true,
        'rewrite' => array('slug' => 'kategoria'),
    ));
}
add_action('init', 'register_produkty_taxonomy');

// Register custom post type "Referencje"
function register_custom_post_type_referencje() {
    $labels = array(
        'name' => 'Referencje',
        'singular_name' => 'Referencja',
        'add_new' => 'Dodaj nową referencję',
        'add_new_item' => 'Dodaj nową referencję',
        'edit_item' => 'Edytuj referencję',
        'new_item' => 'Nowa referencja',
        'view_item' => 'Zobacz referencję',
        'search_items' => 'Szukaj referencji',
        'not_found' => 'Nie znaleziono referencji',
        'not_found_in_trash' => 'Nie znaleziono referencji w koszu',
    );

    $args = array(
        'labels' => $labels,
        'has_archive' => false,
        'public' => true,
        'supports' => array('title', 'editor', 'excerpt'),
        'menu_icon' => 'dashicons-star-filled',
        'show_ui' => true,
        'show_in_rest' => true,
        'rewrite' => array('slug' => 'referencje'),
    );

    register_post_type('referencje', $args);
}
add_action('init', 'register_custom_post_type_referencje');

