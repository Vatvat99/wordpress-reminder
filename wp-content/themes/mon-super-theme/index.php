<?php
/**
 * Vue affichant tous les types de contenus WordPress
 * peut être surchargé suivant les types de contenus
 *
 * @package MonSuperTheme
 * @since MonSuperTheme 1.0.0
 */
get_header(); // Inclus header.php ?>
<div id="primary" class="content-area">
    <div id="content" class="site-content">
        <?php if ( have_posts() ) { ?>
            <?php
            // Affiche les liens de navigations
            mon_super_theme_nav( 'nav-above' );
            ?>
            <?php while ( have_posts() ) { ?>
                <?php the_post(); // récupère l'article courant ?>
                <?php
                // Affiche le contenu de l'article :
                // Check en premier lieu en fonction du type de post, si un template
                // comme template-parts/content-aside.php est présent, sinon, utilise
                // template-parts/content.php
                get_template_part('template-parts/content', get_post_format() );
                ?>
            <?php } ?>
            <?php
            // Affiche les liens de navigations
            mon_super_theme_nav( 'nav-below' );
            ?>
        <?php } ?>
    </div><!-- #content .site-content -->
</div>
<?php get_sidebar(); // Inclus sidebar.php ?>
<?php get_footer(); // Inclus footer.php ?>
