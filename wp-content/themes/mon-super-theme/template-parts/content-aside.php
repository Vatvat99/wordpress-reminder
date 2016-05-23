<?php
/**
 * Template appellé dans The Loop, utilisé les posts de type Aside
 *
 * @package MonSuperTheme
 * @since MonSuperTheme 1.0.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <header class="entry-header">
        <h1 class="entry-title">
            <a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'mon_super_theme' ), the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark">
                <?php the_title(); ?>
            </a>
        </h1>
    </header>

    <?php if ( is_search() ) { // Résultat de recherche : on affiche seulement un résumé ?>
        <div class="entry-summary">
            <?php the excerpt(); ?>
        </div>
    <?php } else { // Autres pages : on affiche le contenu de l'article ?>
        <div class="entry-content">
            <?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'mon_super_theme' ) ); ?>
            <?php wp_link_pages( array(
                'before' => '<div class="page-links">' . __( 'Pages:', 'mon_super_theme' ),
                'after' => '</div>'
            ) ); ?>
        </div>
    <?php } ?>

    <footer class="entry-meta">
        <a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'mon_super_theme' ), the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark">
            <?php echo get_the_date(); ?>
        </a>

        <?php // Affichage du lien vers les commentaires ?>
        <?php if ( ! post_password_required() && ( comments_open() || '0' != get_comments_number() ) ) { ?>
            <span class="sep"> | </span>
            <span class="comments-link"><?php comments_popup_link( __( 'Leave a comment', 'mon_super_theme' ), __('1 Comment', 'mon_super_theme'), __('% Comments', 'mon_super_theme') ); ?></span>
        <?php } ?>

        <?php // Affichage du lien d'édition de l'article ?>
        <?php edit_post_link( __( 'Edit', 'mon_super_theme' ), '<span class="sep"> | </span><span class="edit-link">', '</span>' ); ?>
    </footer>

</article>
