<?php
/**
 * Vue utilisée pour afficher les pages
 *
 * @package MonSuperTheme
 * @since MonSuperTheme 1.0.0
 */
 get_header(); ?>

<div id="primary" class="content-area">
    <div id="content" class="site-content" role="main">
        <?php while ( have_posts() ) { ?>
            <?php the_post(); ?>
            <?php get_template_part( 'template-parts/content', 'page' ); ?>
            <?php comments_template( '', true ); ?>
        <?php } ?>
    </div>
</div>

 <?php get_sidebar(); ?>
 <?php get_footer(); ?>
