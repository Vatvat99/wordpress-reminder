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
 * Routing des url d'inscription / connexion
 */
function site_router() {
    // print_r($_SERVER); die();
}
add_action('send_headers', 'site_router');
