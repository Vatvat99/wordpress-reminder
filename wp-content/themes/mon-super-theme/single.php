<?php
/**
 * Vue affichant le détail d'un post
 *
 * @package MonSuperTheme
 * @since MonSuperTheme 1.0.0
 */
get_header(); // Inclus header.php ?>
<div id="primary" class="content-area">
    <div id="content" class="site-content" role="main">
        <?php while ( have_posts() ) { ?>
            <?php the_post(); // récupère l'article courant ?>
            <?php mon_super_theme_content_nav( 'nav-above' ); ?>
            <?php
            // Affiche le contenu de l'article :
            // Check en premier lieu en fonction du type de post, si un template
            // comme template-parts/content-single.php est présent, sinon, utilise
            // template-parts/content.php
            get_template_part( 'template-parts/content', 'single' );
            ?>
            <?php mon_super_theme_content_nav( 'nav-below' ); ?>
            <?php
            // Si les commentaires sont autorisés, ou qu'on a au moins un commentaire,
            // on charge le template des commentaires
            if ( comments_open() || get_comments_number() != '0' )
                comments_template( '', true );
            ?>
        <?php } ?>
    </div><!-- #content .site-content -->
</div>
<?php get_sidebar(); // Inclus sidebar.php ?>
<?php get_footer(); // Inclus footer.php ?>
