<?php
/**
 * Vue utilisée pour les erreurs 404
 *
 * @package MonSuperTheme
 * @since MonSuperTheme 1.0.0
 */
get_header(); // Inclus header.php ?>
<div id="primary" class="contetn-area">
    <div id="content" class="site-content" role="main">
        <article id="post-0" class="post error404 not-found">
            <header class="entry-header">
                <h1 class="entry-title">
                    <?php _e( 'Oops ! That page can\'t be found.', 'mon-super-theme' ); ?>
                </h1>
            </header>
            <div class="entry-content">
                <p><?php _e( 'It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'mon-super-theme' ); ?></p>
                <?php get_search_form(); ?>
                <?php the_widget( 'WP_Widget_Recent_Posts' ); ?>
                <div class="widget">
                    <h2 class="widgettitle">
                        <?php _e( 'Most Used Categories', 'mon-super-theme' ); ?>
                    </h2>
                    <ul>
                        <?php wp_list_categories( array(
                            'orderby' => 'count',
                            'order' => 'DESC',
                            'show_count' => 1,
                            'title_li' => '',
                            'number' => 10,
                        ) ); ?>
                    </ul>
                </div>

                <?php
                /* translators: %1s: smilie */
                $archive_content = '<p>' . sprintf( __( 'Try looking in the monthly archives. %1s', 'mon-super-theme' ), convert_smilies( ':)' ) ) . '</p>';
                the_widget( 'WP_Widget_Archives', 'dropdown=1', 'after_title=</h2>' . $archive_content );
                ?>
                <?php the_widget( 'WP_Widget_Tag_Cloud' ); ?>
            </div>
        </article>
    </div>
</div>
<?php get_footer(); ?>
