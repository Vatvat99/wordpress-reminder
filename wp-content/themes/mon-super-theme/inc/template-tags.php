<?php
/**
 * Tags personnalisés propres au thème
 *
 * Certaines des fonctions de ce fichier peuvent être remplacées par des
 * fonctionnalités du core
 *
 * @package MonSuperTheme
 * @since MonSuperTheme 1.0.0
 */

 if ( ! function_exists( 'mon_super_theme_posted_on' ) ) {

     /**
      * Affiche l'auteur et la date de publication d'un article
      */
     function mon_super_theme_posted_on() {
         printf( __( 'Posté le <a href="%1$s" title="%2$s" rel="bookmark"><time class="entry-date" datetime="%3$s" pubdate>%4s</time></a><span class="byline"> par <span class="author vcard"><a class="url fn n" href="%5$s" title="%6$s" rel="author">%7$s</a></span></span>', 'mon_super_theme' ),
             esc_url( get_permalink() ),
             esc_attr( get_the_time() ),
             esc_html( get_the_date( 'c' ) ),
             esc_html( get_the_date() ),
             esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
             esc_attr( sprintf( __( 'Voir tous les posts de %s', 'mon_super_theme' ), get_the_author() ) ),
             esc_html( get_the_author() )
         );
     }
 }

/**
 * Teste si un article appartient à une ou plusieus catégories
 */
function mon_super_theme_categorized_blog() {
    // Si le transient (donnée temporaire stockée en basse) "all_the_cool_cats" n'existe pas
    if ( ( $all_the_cool_cats = get_transient('all_the_cool_cats') ) === false ) {
        // On crée un array de toutes les catégories utilisées par au moins un article
        $all_the_cool_cats = get_categories( array(
            'hide_empty' => 1,
        ) );

        // On compte le nombre de catégories
        $all_the_cool_cats = count( $all_the_cool_cats );
        // Et on mémorise
        set_transient( 'all_the_cool_cats', $all_the_cool_cats );
    }

    if ( $all_the_cool_cats != '1' ) {
        // Cet article à plus d'une catégorie
        return true;
    } else {
        // Cet article a seulement une catégorie
        return false;
    }
}

/**
 * Supprime le transient créé dans la fonction mon_super_theme_categorized_blog()
 * quand on édite une catégorie ou qu'on sauvegarde un article, car c'est à ce moment
 * qu'on a la possibilité de créer de nouvelle catégories
 */
function mon_super_theme_transient_flusher() {
    delete_transient( 'all_the_cool_cats' );
}
add_action( 'edit_category', 'mon_super_theme_transient_flusher' );
add_action( 'save_post', 'mon_super_theme_transient_flusher' );

if ( ! function_exists( 'mon_super_theme_nav' ) ) {

    /**
     * Affiche la navigation entre les articles (liens précédent / suivant)
     */
    function mon_super_theme_nav( $nav_id ) {
        global $wp_query, $post;

        // Sur les pages article seul, on n'affiche les liens que si il y a un article avant et après
        if ( is_single() ) {
            $previous = ( is_attachment() ) ? get_post( $post->post_parent ) : get_adjacent_post( false, '', true );
            $next = get_adjacent_post( false, '', false );

            if ( ! $next && ! previous )
                return;
        }

        // On n'affiche pas de liens vide dans les archives si il n'y a qu'une page
        if ( $wp_query->max_num_pages < 2 && ( is_home() || is_archive() || is_search() ) )
            return;

        $nav_class = 'site-navigation paging-navigation';
        if ( is_single() )
            $nav_class = 'site-navigation post-navigation';
        ?>
        <nav role="navigation" id="<?php echo $nav_id; ?>" class="<?php echo $nav_class; ?>">
            <h1 class="assistive-text">
                <?php _e( 'Post navigation', 'mon_super_theme' ); ?>
            </h1>
            <?php if ( is_single() ) {
                // Navigation pour les pages articles seuls
            ?>
                <?php previous_post_link( '<div class="nav-previous">%link</div>', '<span class="meta-nav">' . _x( '&larr;', 'Previous post link', 'mon_super_theme' ) . '</span> %title' ); ?>
                <?php next_post_link( '<div class="nav-next">%link</div>', '%title <span class="meta-nav">' . _x( '&rarr;', 'Next post link', 'mon_super_theme' ) . '</span>' ); ?>
            <?php } elseif ( $wp_query->max_num_pages > 1 && ( is_home() || is_archive() || is_search() ) ) {
                // Navigation pour les pages accueil, archive, et résultats de recherche
            ?>
                <?php if ( get_next_posts_link() ) { ?>
                    <div class="nav-previous"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', 'mon_super_theme' ) ); ?></div>
                <?php } ?>
                <?php if ( get_previous_posts_link() ) { ?>
                    <div class="nav-next"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'mon_super_theme' ) ); ?></div>
                <?php } ?>
            <?php } ?>
        </nav>
        <?php
    }

}
