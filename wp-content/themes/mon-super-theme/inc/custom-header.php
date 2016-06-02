<?php
/**
 * Implémentation de la fonctionnalité Wordpress "Custom Header"
 * see https://codex.wordpress.org/Custom_Headers
 *
 * Ajouter le code suivant à header.php pour afficher l'entête personnalisée
 *
 * <?php $header_image = get_header_image();
 * if ( ! empty( $header_image ) ) { ?>
 * <a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
 * <img src="<?php header_image(); ?>" width="<?php echo get_custom_header()->width; ?>" height="<?php echo get_custom_header()->height; ?>" alt="" />
 * </a>
 * <?php } ?>
 *
 * @package MonSuperTheme
 * @since MonSuperTheme 1.0.0
 */

/**
 * Active la fonctionnalité Wordpress "Custom Header"
 */
function mon_super_theme_custom_header_setup() {

    $args = array(
        'default-image' => '',
        'default-text-color' => 'e9e0e1',
        'width' => 1050,
        'height' => 250,
        'flex-height' => true,
        'wp-head-callback' => 'mon_super_theme_header_style',
        'admin-head-callback' => 'mon_super_theme_admin_header_style',
        'admin-preview-callback' => 'mon_super_theme_admin_header_image',
    );

    $args = apply_filters( 'mon_super_theme_header_args', $args );

    // Si la version de Wordpress est supérieure à 3.4
    global $wp_version;
    if ( version_compare( $wp_version, '3.4', '>=' ) ) {
        // on active les "Custom Header" en passant les paramètres par défaut
    	add_theme_support( 'custom-header', $args );
    }
    // La version de wordpress est inférieure à 3.4
    else {
        // on utilise l'ancienne méthode pour activer les "custom background"
        define( 'HEADER_TEXTCOLOR', $args['default-text-color'] );
        define( 'HEADER_IMAGE', $args['default-image'] );
        define( 'HEADER_IMAGE_WIDTH', $args['width'] );
        define( 'HEADER_IMAGE_HEIGHT', $args['height'] );
    	add_custom_image_header( $args['wp-head-callback'], $args['admin-head-callback'], $args['admin-preview-callback'] );
    }

}
add_action( 'after_setup_theme', 'mon_super_theme_custom_header_setup' );

/**
* Définit get_custom_header() pour des raisons e compatibilité.
* Cette fonction a été introduite avec Wordpress 3.4. Si elle n'existe pas on
* définit la nôtre.
*/
if ( ! function_exists( 'get_custom_header' ) ) {
    function get_custom_header() {
        return (object) array(
            'url' => get_header_image(),
            'thumbnail_url' => get_header_image(),
            'width' => HEADER_IMAGE_WIDTH,
            'height' => HEADER_IMAGE_HEIGHT,
        );
    }
}

if ( ! function_exists( 'mon_super_theme_header_style' ) ) {

    /**
     * Ajoute les styles pour le "Custom Header" sur le front
     */
    function mon_super_theme_header_style() {

        // If no custom options for text are set, let's bail
        // get_header_textcolor() options: HEADER_TEXTCOLOR is default, hide text (returns 'blank') or any hex value
        if ( get_header_textcolor() == HEADER_TEXTCOLOR && get_header_image() == '' )
            return;
        // If we get this far, we have custom styles. Let's do this.
        ?>
        <style type="text/css">
            <?php
            // Do we have a custom header image ?
            if ( get_header_image() != '' ) { ?>
                .site-header img {
                    display: block;
                    margin: 1.5em auto 0;
                }
            <?php }
            // Has the text been hidden ?
            if ( get_header_textcolor() == 'blank' ) { ?>
                .site-title,
                .site-description {
                    position: absolute !important;
                    clip: rect(1px 1px 1px 1px); /* IE6, IE7 */
                    clip: rect(1px, 1px, 1px, 1px);
                }

                .site-header hgroup {
                    background: none;
                    padding: 0;
                }
            <?php }
            // If the user has set a custom color for the text use that
            else { ?>
                .site-title a,
                .site-description {
                    color: #<?php echo get_header_textcolor(); ?> !important;
                }
            <?php } ?>
        </style>
        <?php
    }

}

if ( ! function_exists( 'mon_super_theme_admin_header_style' ) ) {

    /**
     * Ajoute les styles pour le "Custom Header" dans l'admin (Apparence > En-tête)
     */
    function mon_super_theme_admin_header_style() {
    ?>
        <style type="text/css">
            .appearance_page_custom-header #headimg { /* This is the container for the Custom Header preview. */
                background: #33605a;
                border: none;
                min-height: 0 !important
            }
            #headimg h1 { /* This is the site title displayed in the preview */
                font-size: 45px;
                font-family: Georgia, 'Times New Roman', serif;
                font-style: italic;
                font-weight: normal;
                padding: 0.8em 0.5em 0;
            }
            #desc { /* This is the site description (tagline) displayed in the preview */
                padding: 0 2em 2em;
            }
            #headimg h1 a,
            #desc {
                color: #e9e0d1;
                text-decoration: none;
            }
        </style>
    <?php
    }

}

if ( ! function_exists( 'mon_super_theme_admin_header_image' ) ) {

    /**
     * Affichage de l'image sélectionnée pour le "Custom Header" dans l'admin (Apparence > En-tête)
     */
    function mon_super_theme_admin_header_image() {
    ?>
        <div id="heading">
            <?php
            if ( get_header_textcolor() == 'blank' || get_header_textcolor == '' )
                $style = ' style="display: none;"';
            else
                $style = ' style="color: #' . get_header_textcolor() . '"';
            ?>
            <h1>
                <a id="name"<?php echo $style; ?> onclick="return false;" href="<?php echo esc_url( home_url( '/' ) ); ?>">
                    <?php bloginfo( 'name' ); ?>
                </a>
            </h1>
            <div id="desc"<?php echo $style; ?>>
                <?php bloginfo( 'description' ); ?>
            </div>
            <?php $header_image = get_header_image();
            if ( ! empty( $header_image ) ) { ?>
                <img src="<?php echo esc_url( $header_image ); ?>" alt="" />
            <?php } ?>
        </div>
    <?php
    }

}
