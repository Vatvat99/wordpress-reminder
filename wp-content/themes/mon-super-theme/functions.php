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
     * Cette fonction est appellée dans le hook after_setup_theme, qui s'exécute
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
        load_theme_textdomain( 'mon-super-theme', get_template_directory() . '/languages' );

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
            'primary' => __( 'Primary Menu', 'mon-super-theme' ),
        ) );

    }
    add_action( 'after_setup_theme', 'mon_super_theme_setup' );

}

/**
 * Active la fonctionnalité Wordpress "Custom Background"
 * see http://codex.wordpress.org/Custom_Backgrounds
 *
 * Utilise add_theme_support pour activer la fonctionnalité, fournit une
 * compatibilité avec les versions de wordpress antérieur à 3.4
 */
function mon_super_theme_custom_background() {
    $args = array(
        'default-color' => 'e9e0d1',
    );
    $args = apply_filters( 'mon_super_theme_background_args', $args );

    global $wp_version;
    // Si la version de Wordpress est supérieure à 3.4
    if ( version_compare( $wp_version, '3.4', '>=' ) ) {
        // on active les "custom background" en passant les paramètres par défaut
    	add_theme_support( 'custom-background', $args );
    }
    // La version de wordpress est inférieure à 3.4
    else {
        // on utilise l'ancienne méthode pour activer les "custom background"
        define( 'BACKGROUND_COLOR', $args['default-color'] );
        define( 'BACKGROUND_IMAGE', $args['default-image'] );
    	add_custom_background();
    }
}
add_action( 'after_setup_theme', 'mon_super_theme_custom_background' );

/**
 * Définit les zones pouvant accueillir des widgets et met à jour la sidebar
 * avec les widgets par défaut
 */
function mon_super_theme_widgets_init() {

    register_sidebar( array(
        'name' => __( 'Primary Widget Area', 'mon-super-theme' ),
        'id' => 'sidebar-1',
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h1 class="widget-title">',
        'after_title' => '</h1>',
    ) );

    register_sidebar( array(
        'name' => __( 'Secondary Widget Area', 'mon-super-theme' ),
        'id' => 'sidebar-2',
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h1 class="widget-title">',
        'after_title' => '</h1>',
    ) );

}
add_action( 'widgets_init', 'mon_super_theme_widgets_init' );

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

/**
 * Affiche les crédits du site
 */
function mon_super_theme_credits() {
    echo '<p>Tous droits réservés &copy; 2016</p>';
}
add_action( 'mon_super_theme_credits', 'mon_super_theme_credits' );

/**
 * Active la fonctionnalité Wordpress "Custom Header"
 * see https://codex.wordpress.org/Custom_Headers
 */
require( get_template_directory() . '/inc/custom-header.php' );
