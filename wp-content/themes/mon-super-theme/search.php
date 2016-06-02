<?php
/**
 * Vue utilisée pour afficher les résultats de recherche
 *
 * @package MonSuperTheme
 * @since MonSuperTheme 1.0.0
 */
get_header(); // Inclus header.php ?>

<section id="primary" class="content-area">
    <div id="content" class="site-content" role="main">
        <?php if ( have_posts() ) { ?>
            <header class="page-header">
                <h1 class="page-title"><?php printf( __( 'Search Results for: %s', 'mon-super-theme' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
            </header>

            <?php mon_super_theme_content_nav( 'nav-above' ); ?>

            <?php while ( have_posts() ) { ?>
                <?php the_post(); ?>
                <?php get_template_part( 'template-parts/content', 'search' ); ?>
            <?php } ?>

            <?php mon_super_theme_content_nav( 'nav-below' ); ?>

        <?php } else { ?>

            <?php get_template_part( 'template-parts/no-results', 'search' ); ?>

        <?php } ?>
    </div>
</section>

<?php get_sidebar(); ?>
<?php get_footer(); ?>
