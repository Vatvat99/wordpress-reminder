<?php
/**
 * Vue affichant l'entête du site
 *
 * @package MonSuperTheme
 * @since MonSuperTheme 1.0.0
 */
?><!DOCTYPE html>
<!-- [if IE 8]>
<html id="ie8" <?php language_attributes(); ?>>
<![endif]-->
<!-- [if !(IE 8)]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
    <head>
        <meta charset="<?php bloginfo( 'charset' ); ?>" />
        <meta name="viewport" content="width=device-width" />
        <title>
            <?php
            global $page, $paged;

            // Affiche le titre de la page suivi d'un | sur la droite
            wp_title( '|', true, 'right' );

            // Affiche le nom du site
            bloginfo( 'name' );

            // Ajoute la description du site pour la page d'accueil et les pages du front
            $site_description = get_bloginfo( 'description', 'display' );
            if ( $site_description && ( is_home() || is_front_page() ) )
                echo ' | ' . $site_description;

            // Ajoute le numéro de la page si nécessaire
            if ( $paged >= 2 || $page >= 2 )
                echo ' | ' . sprintf( __( 'Page %s', 'mon-super-theme' ), max( $paged, $page ) );
            ?>
        </title>
        <link rel="profile" href="http://gmpg.org/xfn/11" />
        <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
        <!--[if lt IE 9]>
        <script src="<?php echo get_template_directory_uri(); ?>/js/html5.js" type="text/javascript"></script>
        <![endif]-->
        <?php wp_head(); ?>
    </head>
    <body <?php body_class(); ?>>
        <div id="page" class="hfeed site">
             <header id="masthead" class="site-header" role="banner">
                  <hgroup>
                      <h1 class="site-title">
                          <a href="<?php echo home_url( '/' ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
                      </h1>
                      <h2 class="site-description">
                          <?php bloginfo( 'description' ); ?>
                      </h2>
                  </hgroup>

                  <?php
                  $header_image = get_header_image();
                  if ( ! empty( $header_image ) ) { ?>
                      <a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
                        <img src="<?php header_image(); ?>" width="<?php echo get_custom_header()->width; ?>" height="<?php echo get_custom_header()->height; ?>" alt="" />
                    </a>
                  <?php } ?>

                  <nav role="navigation" class="site-navigation main-navigation">
                      <h1 class="assistive-text"><?php _e( 'Menu', 'mon-super-theme' ); ?></h1>
                      <div class="assistive-text skip-link">
                          <a href="#content" title="<?php esc_attr_e( 'Skip to content', '_s' ); ?>">
                              <?php _e( 'Skip to content', 'mon-super-theme' ); ?>
                          </a>
                      </div>
                      <?php wp_nav_menu( array( 'theme_location' => 'primary' ) ); ?>
                  </nav><!-- .site-navigation .main-navigation -->
             </header><!-- #masthead .site-header -->
             <div id="main" class="site-main">
