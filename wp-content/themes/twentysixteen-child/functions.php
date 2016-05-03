<?php

add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );

/**
 * Charge les styles du thème parent
 */
function theme_enqueue_styles() {

    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );

}

/**
 * Affiche un favicon
 * see http://codex.wordpress.org/Child_Themes
 */
function favicon_link() {
    // see https://codex.wordpress.org/Function_Reference/get_stylesheet_directory_uri
    echo '<link rel="shortcut icon" type="image/x-icon" href="' . get_stylesheet_directory_uri() . '/favicon.ico" />' . "\n";
}
add_action( 'wp_head', 'favicon_link' );


/* ------------------------------------------------------------------- */
/* Pages d'inscription / connexion personnalisées -------------------- */
/* ------------------------------------------------------------------- */

/**
 * Routing des url d'inscriptions / connexion / profil / déconnexion
 */
function site_router() {

    $root = str_replace('index.php', '', $_SERVER['SCRIPT_NAME']);
    $url = str_replace($root, '', $_SERVER['REQUEST_URI']);
    $url_parts = explode('/', $url);

    if (count($url_parts) == 1 && $url_parts[0] == 'login') {
        require 'page-login.php'; die();
    }
    elseif (count($url_parts) == 1 && $url_parts[0] == 'profil') {
        require 'page-profil.php'; die();
    }
    elseif (count($url_parts) == 1 && $url_parts[0] == 'register') {
        require 'page-register.php'; die();
    }
    elseif (count($url_parts) == 1 && $url_parts[0] == 'logout') {
        //die($root);
        wp_logout();
        header('location:' . $root); die();
    }

}
// see https://codex.wordpress.org/Plugin_API/Action_Reference/send_headers
add_action('send_headers', 'site_router');

// Cache la toolbar wordpress pour tous les utilisateurs
add_filter('show_admin_bar', '__return_false');

// Cache la toolbar wordpress pour tous les utilisateurs, sauf les administrateurs
function remove_admin_bar() {
    if (!current_user_can('administrator') && !is_admin()) {
        add_filter('show_admin_bar', '__return_false');
    }
}
add_action('after_setup_theme', 'remove_admin_bar');
