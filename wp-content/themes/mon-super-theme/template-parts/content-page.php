<?php
/**
 * Template appellé dans The Loop, utilisé pour les pages
 *
 * @package MonSuperTheme
 * @since MonSuperTheme 1.0.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <header class="entry-header">
        <h1 class="entry-title"><?php the_title(); ?></h1>
    </header>

    <div class="entry-content">
        <?php the_content(); ?>
        <?php wp_link_pages( array(
            'before' => '<div class="page-links">' . __( 'Pages:', 'mon_super_theme' ),
            'after' => '</div>',
        ) ); ?>
        <?php edit_post_link( __( 'Edit', 'mon_super_theme' ), '<span class="edit-link">', '</span>' ); ?>
    </div>
</article>
