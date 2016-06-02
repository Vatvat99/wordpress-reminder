<?php
/**
 * Vue affichant la barre latérale du site
 *
 * @package MonSuperTheme
 * @since MonSuperTheme 1.0.0
 */
?>

<div id="secondary" class="widget-area" role="complementary">
    <?php do_action( 'before_sidebar' ); ?>
    <?php
    /* Les 3 widgets dans ce if sont affichés seulement si l'utilisateur n'a
     * rien glissé dans cette zone depuis l'admin
     */
    if ( ! dynamic_sidebar( 'sidebar-1' ) ) { ?>
        <aside id="search" class="widget widget_search">
            <?php get_search_form(); ?>
        </aside>
        <aside id="archives" class="widget">
            <h1 class="widget-title">
                <?php _e( 'Archives', 'mon-super-theme' ); ?>
            </h1>
            <ul>
                <?php wp_get_archives( array( 'type' => 'monthly' ) ); ?>
            </ul>
        </aside>
        <aside id="meta" class="widget">
            <h1 class="widget-title">
                <?php _e( 'Meta', 'mon-super-theme' ); ?>
            </h1>
            <ul>
                <?php wp_register(); ?>
                <li><?php wp_loginout(); ?></li>
                <?php wp_meta(); ?>
            </ul>
        </aside>
    <?php } ?>
</div>

<?php
/* On affiche la deuxième zone seulement si l'utilisateur a glissé des widgets
 *depuis l'admin
 */
if ( is_active_sidebar( 'sidebar-2' ) ) { ?>
    <div id="tertiary" class="widget-area" role="supplementary">
        <?php dynamic_sidebar( 'sidebar-2' ); ?>
    </div>
<?php } ?>
