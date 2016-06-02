<?php
/**
 * Vue utilisée pour afficher les commentaires
 *
 * @package MonSuperTheme
 * @since MonSuperTheme 1.0.0
 */ ?>

<?php
    /* If the current post is protected by a password and
     * the visitor has not yet entered the password we will
     * return early without loading the comments.
     */
    if ( post_password_required() )
        return;
?>
<div id="comments" class="comments-area">
    <?php if ( have_comments() ) { ?>
        <h2 class="comments-title">
            <?php
                printf( _n( 'One thought on &ldquo;%2$s%rdquo;', '%1$s thoughts on &ldquo;%2$s&rdquo;', get_comments_number(), 'mon-super-theme' ), number_format_i18n( get_comments_number() ), '<span>' . get_the_title() . '</span>' );
            ?>
        </h2>

        <?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) { // are there comments to navigate through ? If so, show navigation ?>
            <nav role="navigation" id="comment-nav-above" class="site-navigation comment-navigation">
                <h1 class="assistive-text"><?php _e( 'Comment navigation', 'mon-super-theme' ); ?></h1>
                <div class="nav-previous"><?php previous_comments_link( __( '$larr; Older Comments', 'mon-super-theme' ) ); ?></div>
                <div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'mon-super-theme' ) ); ?></div>
            </nav>
        <?php } ?>

        <ol class="commentlist">
            <?php
                /* Loop through and list the comments. Tell wp_list_comments()
                 * to use mon_super_theme_comment() to format the comments.
                 * If you want to overload this in a child theme then you can
                 * define mon_super_theme_comment() and that will be used instead.
                 * See mon_super_theme_comment() in inc/template-tags.php for more.
                 */
                 wp_list_comments( array(
                     'callback' => 'mon_super_theme_comment'
                 ) );
             ?>
        </ol>

        <?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) { // are there comments to navigate through ? If so, show navigation  ?>
            <nav role="navigation" id="comment-nav-below" class="site-navigation comment-navigation">
                <h1 class="assistive-text"><?php _e( 'Comment navigation', 'mon-super-theme' ); ?></h1>
                <div class="nav-previous"><?php previous_comments_link( __( '$larr; Older Comments', 'mon-super-theme' ) ); ?></div>
                <div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'mon-super-theme' ) ); ?></div>
            </nav>
        <?php } ?>

    <?php } ?>

    <?php
    // If comments are closed and there are comments, let's leave a little note, shall we?
    if ( ! comments_open() && get_comments_number() != '0' && post_type_supports( get_post_type(), 'comments' ) ) { ?>
        <p class="nocomments"><?php _e( 'Comments are closed.', 'mon-super-theme' ); ?></p>
    <?php } ?>

    <?php comment_form(); ?>

</div>
