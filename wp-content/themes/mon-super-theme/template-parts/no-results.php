<?php
/**
 * Template appellé dans The Loop, utilisé pour afficher un message quand aucun poste n'est trouvé
 *
 * @package MonSuperTheme
 * @since MonSuperTheme 1.0.0
 */
?>

<article id="post-0" class="post no-results not-found">
    <header class="entry-header">
        <h1 class="entry-title"><?php _e( 'Nothing Found', 'mon_super_theme' ); ?></h1>
    </header>
    <div class="entry-content">
        <?php if ( is_home() && current_user_can( 'publish_posts' ) ) { ?>
            <p><?php printf( __( 'Ready to publish your first post? <a href="%1$s">Get started here</a>', 'mon_super_theme' ), admin_url( 'post-new.php' ) ); ?></p>
        <?php } else ( is_search() ) { ?>
            <p><?php _e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'mon_super_theme' ); ?></p>
            <?php get_search_form(); ?>
        <?php } else { ?>
            <p><?php _e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'mon_super_theme' ); ?></p>
            <?php get_search_form(); ?>
        <?php } ?>
    </div>
</article>
