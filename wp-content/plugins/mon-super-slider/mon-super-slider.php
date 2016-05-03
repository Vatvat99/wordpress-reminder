<?php
/*
Plugin Name: Mon super slider
Description: Un plugin de slider pour tester comment ça marche
Version:     0.1
Author:      Aurélien Vattant
*/

// On s'assure que le plugin ne fasse rien si on tente d'y accéder directement
if ( !function_exists( 'add_action' ) ) {
	echo 'Salut ! Je suis une simple extension, je ne peux pas faire grand-chose en l\'état';
	exit;
}

class Mon_Super_Slider
{

    public function __construct()
    {
        // Ajoute les js et css requis par le plugin
        add_action('wp_enqueue_scripts', array(&$this, 'enqueue_scripts'));

        // Inclus le "custom post type" dans le plugin
        require_once(sprintf('%s/post-types/slider-post-type.php', dirname(__FILE__)));
        $slider_post_type = new Slider_Post_Type();
    }

    /**
     * Ajoute les js et css requis par le plugin
     */
    public function enqueue_scripts()
    {
        // see https://developer.wordpress.org/reference/functions/wp_enqueue_script/
        wp_enqueue_style('slick-slider', plugins_url() . '/mon-super-slider/assets/vendor/slick-1.5.9/slick/slick.css');
        wp_enqueue_script('slick-slider', plugins_url() . '/mon-super-slider/assets/vendor/slick-1.5.9/slick/slick.min.js', array('jquery'));
        wp_enqueue_script('mon-super-slider', plugins_url() . '/mon-super-slider/assets/js/mon-super-slider.js', array('slick-slider'));
    }

}

/**
 * Permet d'afficher le slider dans le thème
 */
function mon_super_slider_show($limit = 10)
{
    $args = array(
        'post_type' => 'slider',
        'posts_per_page' => $limit
    );

    // see https://codex.wordpress.org/Class_Reference/WP_Query
    $slides = new WP_query($args);

    // Render the settings template
    include(sprintf('%S/views/slider.php', dirname(__FILE__)));
}

// Instancie le plugin
$mon_super_slider = new Mon_Super_Slider();
