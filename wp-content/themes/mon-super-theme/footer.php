<?php
/**
 * Vue affichant le pied de page du site
 *
 * @package MonSuperTheme
 * @since MonSuperTheme 1.0.0
 */
?>

    </div><!-- #main .site-main -->
    <footer id="colophon" class="site-footer" role="contentinfo">
        <div class="site-info">
            <?php do_action( 'mon_super_theme_credits' ); ?>
            <a href="http://www.wordpress.org" title="<?php esc_attr_e( 'A Semantic Personal Publishing Platform', 'mon-super-theme' ); ?>" rel="generator">
                <?php printf( __( 'Proudly powered by %s', 'mon-super-theme' ), 'Wordpress' ); ?>
            </a>
            <span class="sep"> | </span>
            <?php printf( __( 'Theme: %1$s by %2$s.', 'mon-super-theme' ), 'Mon Super Theme', '<a href="https://themeshaper.com/" rel="designer">ThemeShaper</a>' ); ?>
        </div>
    </footer>
</div> <!-- #page .hfeed .site -->
<?php wp_footer(); ?>
</body>
</html>
