<?php
/**
 * Template appellé dans The Loop, utilisé pour les post-types single
 *
 * @package MonSuperTheme
 * @since MonSuperTheme 1.0.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <header class="entry-header">
        <h1 class="entry-title"><?php the_title(); ?></h1>
        <div class="entry-meta">
            <?php mon_super_theme_posted_on(); ?>
        </div>
    </header>
    <div class="entry-content">
        <?php the_content(); ?>
        <?php wp_link_pages( array(
            'before' => '<div class="page-links">' . __( 'Pages:', 'mon_super_theme' ),
            'after' => '</div>',
        ) ); ?>
    </div>
    <footer class="entry-meta">
        <?php
        /* translators: used between list items, there is a space after the comma */
        $category_list = get_the_category_list( __( ', ', 'mon_super_theme' ) );
        /* translators: used between list items, there is a space after the comma */
        $tag_list = get_the_tag_list( '', __( ', ', 'mon_super_theme' ) );

        if ( ! mon_super_theme_categorized_blog() ) {
            // This blog only has 1 category so we just need to worry about tags in the meta text
            if ( $tag_list != '' ) {
                $meta_text = __( 'This entry was tagged %2s. Bookmark the <a href="%3s" title="Permalink to %4s" rel="bookmark">permalink</a>.', 'mon_super_theme' );
            } else {
                $meta_text = __( 'Bookmark the <a href="%3$s" title="Permalink to %4s" rel="bookmark">permalink</a>.', 'mon_super_theme' );
            }
        } else {
            // But this blog has loads of categories so we should probably display them here
            if ( $tag_list != '' ) {
                $meta_text = __( 'This entry was posted in %1$s and tagged %2s. Bookmark the <a href="%3s" title="Permalink to %4s" rel="bookmark">permalink</a>.', 'mon_super_theme' );
            } else {
                $meta_text = __( 'This entry was posted in %1$s. Bookmark the <a href="%3s" title="Permalink to %4s" rel="bookmark">permalink</a>.', 'mon_super_theme' );
            }
        }

        printf(
            $meta_text,
            $category_list,
            $tag_list,
            get_permalink(),
            the_title_attribute( 'echo=0' )
        );
        ?>

        <?php edit_post_link( __( 'Edit', 'mon_super_theme' ), '<span class="edit-link">', '</span>' ); ?>
    </footer>
</article>
