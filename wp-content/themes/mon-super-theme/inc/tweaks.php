<?php
/**
 * Fonctions personnalisées indépendantes des templates du thème
 *
 * Certaines des fonctions de ce fichier peuvent être remplacées par des
 * fonctionnalités du core
 *
 * @package MonSuperTheme
 * @since MonSuperTheme 1.0.0
 */

/**
 * Affiche un lien vers la page d'accueil dans le menu wp_nav_menu()
 *
 * @since MonSuperTheme 1.0.0
 */
function mon_super_theme_page_menu_args( $args ) {
    $args['show_home'] = true;
    return $args;
}
add_filter( 'wp_page_menu_args', 'mon_super_theme_page_menu_args' );

/**
 * Ajoute des classes personnalisées aux classes du body
 *
 * @since MonSuperTheme 1.0.0
 */
function mon_super_theme_body_classes( $classes ) {
    // Ajoute une class "group-blog" aux articles ayant plus d'un auteur
    if ( is_multi_author() ) {
        $classes[] = 'group-blog';
    }

    return $classes;
}
add_filter( 'body_class', 'mon_super_theme_body_classes' );

/**
 * Ajoute une ancre sur les liens next/previous des pièces jointes de type image
 *
 * @since MonSuperTheme 1.0.0
 */
function mon_super_theme_enhanced_image_navigation( $url, $id ) {
    if ( ! is_attachment() && ! wp_attachment_is_image( $id ) )
        return $url;

    $image = get_post( $id );
    if ( ! empty( $image->post_parent ) && $image->post_parent != $id )
        $url .= '#main';

    return $url;
}
add_filter( 'attachment_link', 'mon_super_theme_enhanced_image_navigation', 10, 2 );
