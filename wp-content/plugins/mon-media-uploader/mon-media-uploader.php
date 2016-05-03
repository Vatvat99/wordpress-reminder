<?php
/*
Plugin Name: Mon media uploader
Description: Un plugin pour tester l'upload d'image depuis un panneau dédié dans l'admin
Version:     0.1
Author:      Aurélien Vattant
*/

// On s'assure que le plugin ne fasse rien si on tente d'y accéder directement
if ( !function_exists( 'add_action' ) ) {
	echo 'Salut ! Je suis une simple extension, je ne peux pas faire grand-chose en l\'état';
	exit;
}

class Mon_Media_Uploader
{

    public function __construct()
    {
        // Ajoute un panneau dans l'administration
        add_action('admin_menu', array(&$this, 'add_menu_items'));

        // Ajoute les js et css requis par le plugin
        add_action('admin_enqueue_scripts', array(&$this, 'enqueue_admin_scripts'));
    }

    /**
     * Ajoute un lien dans le menu de l'admin
     */
    public function add_menu_items()
    {
        add_menu_page('Mon media uploader', 'Mon media uploader', 'activate_plugins', 'mon-media-uploader-page', array(&$this, 'render_panel'), 'dashicons-format-gallery', 110);
        // Ajout de sous-rubriques juste pour tester
        add_submenu_page('mon-media-uploader-page', 'Sous-rubrique test', 'Sous-rubrique test', 'activate_plugins', 'my-subpanel-test', array(&$this, 'render_panel'));
    }

    /**
     * Affiche la page quand on clique sur le lien dans le menu de l'admin
     */
     public function render_panel()
     {
         // Si le formulaire a été posté
         if (isset($_POST['panel_update'])) {

             // On vérifie que le token est valide
             if (!wp_verify_nonce($_POST['panel_noncename'], 'my-panel')) {
                 die('Token non-valide');
             }

             // Si c'est tout bon on sauvegarde les modifications
             foreach ($_POST['options'] as $name => $value) {
                 if (empty($value)) {
                     delete_option($name);
                 } else {
                     update_option($name, $value);
                 }

             }
             $success = 'Options sauvegardées avec succès';
         }

         // Render the panel template
         include(sprintf('%S/views/media-uploader.php', dirname(__FILE__)));
     }

     /**
      * Ajoute les js et css requis par le plugin
      */
     public function enqueue_admin_scripts($hook)
     {
         // see https://developer.wordpress.org/reference/functions/wp_enqueue_script/
         wp_enqueue_script('mon-media-uploader', plugins_url() . '/mon-media-uploader/assets/js/mon-media-uploader.js', array('jquery'));

         // charge les fichiers nécessaires à l'utilisatio de l'API media Javascript, seulement sur la page du plugin
         // see https://codex.wordpress.org/Function_Reference/wp_enqueue_media
        if ($hook == 'toplevel_page_mon-media-uploader-page')
            wp_enqueue_media();
     }

}

// Instancie le plugin
$mon_media_uploader = new Mon_Media_Uploader();
