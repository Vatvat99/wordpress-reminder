<?php
/**
 * Vue utilisée pour afficher le formulaire de recherche
 *
 * @package MonSuperTheme
 * @since MonSuperTheme 1.0.0
 */
 ?>

 <form method="get" id="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>" role="search">
     <label for="s" class="assistive-text">
         <?php _e( 'Search', 'mon-super-theme' ); ?>
     </label>
     <input type="text" class="field" name="s" value="<?php echo esc_attr( get_search_query() ); ?>" id="s" placeholder="<?php esc_attr_e( 'Search &hellip;', 'mon-super-theme' ); ?>" />
     <input type="submit" class="submit" name="submit" id="searchsubmit" value="<?php esc_attr_e( 'Search', 'mon-super-theme' ); ?>" />
 </form>
