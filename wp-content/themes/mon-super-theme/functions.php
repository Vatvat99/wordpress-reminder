<?php
/**
 * Fonctions et paramétrages de MonSuperTheme
 *
 * @package MonSuperTheme
 * @since MonSuperTheme 1.0.0
 */


/**
 * Définit une largeur maximum pour tous les contenus insérés dans une page (img, ...)
 * see https://codex.wordpress.org/Content_Width
 */
 if ( ! isset( $content_width ) ) {
    $content_width = 654;
}

if ( ! function_exists( 'mon_super_theme_setup' )) {

    /**
     * Initialisation du thème
     *
     * Cette fonction est appellée dans le hook after_setup_theme, qui séxécute
     * avant le hook init.
     */
    function mon_super_theme_setup() {
        /**
         * Tags personnalisés propres à ce thème
         */
        require( get_template_directory() . '/inc/template-tags.php');

        /**
         * Fonctions personnalisées indépendantes des templates du thème
         */
        require( get_template_directory() . '/inc/tweaks.php' );

        /**
         * Rend le thème disponibles pour les traductions
         * Les traductions peuvent être remplies dans le répertoire /languages
         */
        load_theme_textdomain( 'mon_super_theme', get_template_directory() . '/languages' );

        /**
         * Ajoute des liens par défauts vers les RSS d'articles et de commentaires dans le head
         */
        add_theme_support( 'automatic-feed-links' );

        /**
         * Active le support du format d'article Aside
         * See: https://codex.wordpress.org/Post_Formats
         */
        add_theme_support( 'posts-formats', array( 'aside' ) );

        /**
         * Déclaration des emplacements pour les menus de navigation
         * Le thème utilise wp_nav_menu() à un emplacement
         * See: http://codex.wordpress.org/Navigation_Menus
         */
        register_nav_menus( array(
            'primary' => __( 'Primary Menu', 'mon_super_theme' ),
        ) );

    }
    add_action( 'after_setup_theme', 'mon_super_theme_setup' );

}

/**
 * Ajoute des scripts et styles
 */
function mon_super_theme_scripts() {
    // Ajoute la feuille de style style.css
    wp_enqueue_style( 'style', get_stylesheet_uri() );

    // Ajoute le script nommé "comment-reply" (inclus avec Wordpress) sur sur les pages contenant des commentaires
    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) )
        wp_enqueue_script( 'comment-reply' );

    // Ajoute un script pour la navigation, et le nomme "navigation"
    wp_enqueue_script( 'navigation', get_template_directory_uri() . 'js/navigation.js', array(), '20160518', true );

    // Ajoute un script pour la navigation au clavier sur les pages de type images jointes
    if ( is_singular() && wp_attachment_is_image() )
        wp_enqueue_script( 'keyboard-image-navigation', get_template_directory_uri() . '/js/keyboard-image-navigation.js', array('jquery'), '20160518' );
}
add_action( 'wp_enqueue_scripts', 'mon_super_theme_scripts' );
