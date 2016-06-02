<?php
/**
 * Template appellé dans The Loop, utilisé par défaut pour tous les posts types non surchargés
 *
 * @package MonSuperTheme
 * @since MonSuperTheme 1.0.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <header class="entry-header">
        <h1 class="entry-title">
            <a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'mon-super-theme' ), the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark">
                <?php the_title(); ?>
            </a>
        </h1>

        <?php if ( get_post_type() == 'post') { ?>
            <div class="entry-meta">
                <?php mon_super_theme_posted_on(); ?>
            </div>
        <?php } ?>
    </header>
    <?php if ( is_search() ) { // Résultat de recherche : on affiche seulement un résumé ?>
        <div class="entry-summary">
            <?php the_excerpt(); ?>
        </div>
    <?php } else { // Autres pages : on affiche le contenu de l'article ?>
        <div class="entry-content">
            <?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'mon-super-theme' ) ); ?>
            <?php wp_link_pages( array(
                'before' => '<div class="page-links">' . __( 'Pages:', 'mon-super-theme' ),
                'after' => '</div>'
            ) ); ?>
        </div>
    <?php } ?>

    <footer class="entry-meta">

        <?php if ( get_post_type() == 'post' ) { ?>

            <?php // Affichage des catégories ?>
            <?php $categories_list = get_the_category_list( __( ', ', 'mon-super-theme' ) ); ?>
            <?php if ( $categories_list && mon_super_theme_categorized_blog() ) { ?>
                <span class="cat-links">
                    <?php printf( __( 'Posted in %1s', 'mon-super-theme' ), $categories_list ); ?>
                </span>
            <?php } ?>

            <?php // Affichage des tags ?>
            <?php $tags_list = get_the_tag_list( '', __( ', ', 'mon-super-theme' ) ); ?>
            <?php if ($tags_list) { ?>
                <span class="sep"> | </span>
                <span class="tag-links">
                    <?php printf( __( 'Tagged %1$s', 'mon-super-theme' ), $tags_list ); ?>
                </span>
            <?php } ?>
        <?php } ?>

        <?php // Affichage du lien vers les commentaires ?>
        <?php if ( ! post_password_required() && ( comments_open() || '0' != get_comments_number() ) ) { ?>
            <span class="sep"> | </span>
            <span class="comments-link"><?php comments_popup_link( __( 'Leave a comment', 'mon-super-theme' ), __('1 Comment', 'mon-super-theme'), __('% Comments', 'mon-super-theme') ); ?></span>
        <?php } ?>

        <?php // Affichage du lien d'édition de l'article ?>
        <?php edit_post_link( __( 'Edit', 'mon-super-theme' ), '<span class="sep"> | </span><span class="edit-link">', '</span>' ); ?>
    </footer>

</article>
