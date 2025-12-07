<?php

/**
 * Theme admin.
 */

namespace App;


function modify_admin_toolbar($admin_bar)
{
    $theme = wp_get_theme();


    $admin_bar->add_menu(array(
        'id' => 'settings-link',
        'title' => 'Zarządzanie motywem',
        'href' => admin_url('admin.php?page=options'),
        'meta' => array(
            'title' => __('Zarządzanie motywem'),
            'class' => 'settings-class',
        ),
    ));
}
add_action('admin_bar_menu', __NAMESPACE__ . '\\modify_admin_toolbar', 100);

function wpb_remove_version()
{
    return '';
}
add_filter('the_generator', __NAMESPACE__ . '\\wpb_remove_version');

function remove_from_admin_bar($wp_admin_bar)
{
    $wp_admin_bar->remove_node('comments');
}
add_action('admin_bar_menu', __NAMESPACE__ . '\\remove_from_admin_bar', 999);

function change_footer_version()
{
    $theme = wp_get_theme();
    echo $theme->name . ' ' . $theme->version;
}
add_filter('update_footer', __NAMESPACE__ . '\\change_footer_version', 9999);

function no_wordpress_errors()
{
    return 'Nieprawidłowe dane logowania!';
}
add_filter('login_errors', __NAMESPACE__ . '\\no_wordpress_errors');

function remove_admin_menu_items_prod()
{
    remove_menu_page('edit.php?post_type=acf-field-group');
}

