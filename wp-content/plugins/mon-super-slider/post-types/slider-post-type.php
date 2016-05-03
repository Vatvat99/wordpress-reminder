<?php

if (!class_exists('Slider_Post_Type'))
{
    /**
     * "Custom post type" pour gérer les slides du slider
     */
    class Slider_Post_Type
    {
        const POST_TYPE = 'slider';

        public function __construct()
        {
            // register actions
            add_action('init', array(&$this, 'init'));
            // add_action('admin_init', array(&$this, 'admin_init'));

            // Ajoute un nouvel emplacement de champs metas
            add_action('add_meta_boxes_slider', array(&$this, 'meta_boxes'));

            // Gère l'enregistrement d'un slide
            add_action('save_post', array(&$this, 'save_post'), 10, 2);

            // Ajoute une colonne dans l'admin de ce post type
            // see https://codex.wordpress.org/Plugin_API/Filter_Reference/manage_edit-post_type_columns
            add_filter('manage_slider_posts_columns', array(&$this, 'slide_column_filter'));

            // Modifie le contenu de la nouvelle colonne "Image"
            // see https://codex.wordpress.org/Plugin_API/Action_Reference/manage_posts_custom_column
            add_action('manage_slider_posts_custom_column', array(&$this, 'slide_column'), 10, 2);
        }

        /**
         * hook into WP's init action hook
         */
        public function init()
        {
            // Initialize Post type
            $this->create_post_type();
            // add_action('save_post', array(&$this, 'save_post'));
        }

        /**
         * Crée le "custom post type"
         */
        public function create_post_type()
        {
            $labels = array(
                'name' => 'Slider',
                'singular_name' => 'Slider',
                'add_new' => 'Ajouter un slide',
                'add_new_item' => 'Ajouter un nouveau slide',
                'edit_item' => 'Editer un slide',
                'new_item' => 'Nouveau slide',
                'view_item' => 'Voir le slide',
                'search_items' => 'Rechercher un slide',
                'not_found' => 'Aucun slide',
                'not_found_in_trash' => 'Aucun slide dans la corbeille',
                'parent_item_colon' => '',
                'menu_name' => 'Slider',
            );

            // see https://codex.wordpress.org/Function_Reference/register_post_type
            // https://developer.wordpress.org/reference/functions/register_post_type/
            register_post_type(self::POST_TYPE, array(
                'labels' => $labels,
                'public' => true,
                'publicly_queryable' => false,
                'menu_position' => 9,
                'supports' => array('title', 'thumbnail'),
            ));

            // see https://developer.wordpress.org/reference/functions/add_image_size/
            add_image_size('slide', 1000, 300, true);
            add_image_size('tiny_square', 48, 48, true);
        }

        /**
         * Ajoute un nouvel emplacement de champs metas
         */
        public function meta_boxes()
        {
            add_meta_box('monSuperSliderLink', 'Lien', array(&$this, 'inner_meta_box'), self::POST_TYPE, 'normal', 'high');
        }

        /**
         * Ajoute le champ meta pour gérer le lien
         */
        public function inner_meta_box($post)
        {
            // Gènère un champ nonce pour s'assurer que le formulaire est bien posté depuis l'admin
            wp_nonce_field('monsuperslider', 'mon_super_slider_nonce');
            // Rendu du champ
            include(sprintf('%s/../views/slider-metabox.php', dirname(__FILE__)));
        }

        /**
         * Gère l'enregistrement d'un slide
         */
        public function save_post($post_id, $post)
        {
            // On enregistre le champ seulement si l'utilisateur a la permission
            $post_type = get_post_type_object($post->post_type);
            if (!current_user_can($post_type->cap->edit_post)) {
                return $post_id;
            }

            // et si le champ existe, et le nonce est valide
            if (!isset($_POST['mon_super_slider_link']) || !wp_verify_nonce($_POST['mon_super_slider_nonce'], 'monsuperslider')) {
                return $post_id;
            }

            update_post_meta($post_id, '_link', $_POST['mon_super_slider_link']);
        }

        /**
         * Ajoute une colonne dans l'admin de ce post type
         */
        public function slide_column_filter($columns)
        {
            $thumbnail_column = array('thumbnail' => 'Image');
            return array_slice($columns, 0, 1) + $thumbnail_column + array_slice($columns, 1, null);
        }

        /**
         * Modifie le contenu de la nouvelle colonne "Image"
         */
        public function slide_column($column_name, $post_id)
        {
            if ($column_name == 'thumbnail') {
                // see https://codex.wordpress.org/Function_Reference/edit_post_link
                // see https://developer.wordpress.org/reference/functions/get_the_post_thumbnail/
                echo edit_post_link(get_the_post_thumbnail($post_id, 'tiny_square'), null, null, $post_id);
            }

        }

    }
}
