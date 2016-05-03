<?php

/*
Plugin Name: Mon petit plugin
Plugin URI: -
Description: Un petit plugin wordpress qui ajoute une page de configuration dans l'admin
Version: 1.0
Author: Aurélien Vattant
Author URI: -
License: GPL2
*/
/*

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License, version 2, as
published by the Free Software Foundation.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

// Make sure we don't expose any info if called directly
if ( !function_exists( 'add_action' ) ) {
	echo 'Hi there!  I\'m just a plugin, not much I can do when called directly.';
	exit;
}

if (!class_exists('Mon_Petit_Plugin'))
{
    class Mon_Petit_Plugin
    {
        /**
         * Construct the plugin object
         */
        public function __construct()
        {
            // register actions
            add_action('admin_init', array(&$this, 'admin_init'));
            add_action('admin_menu', array(&$this, 'add_menu'));
            // Incorpore the custom post type into the plugin
            require_once(sprintf('%s/post-types/post_type_template.php', dirname(__FILE__)));
            $post_type_template = new Post_Type_Template();
        }

        /**
         * hook into WP's admin_init action hook
         */
        public function admin_init()
        {
            // Set up the settings for this plugin
            $this->init_settings();
            // Possibly do additional admin_init tasks
            // ...
        }

        /**
         * Initialize some custom settings
         */
        public function init_settings()
        {
            // register the settings for this plugin
            // see http://codex.wordpress.org/Function_Reference/register_setting
            register_setting('mon_petit_plugin_settings_group', 'setting_a');
            register_setting('mon_petit_plugin_settings_group', 'setting_b');
        }

        /**
         * Add a menu
         */
        public function add_menu()
        {
            // see http://codex.wordpress.org/Function_Reference/add_options_page
            add_options_page('réglages Mon petit plugin', 'Mon petit plugin', 'manage_options', 'mon_petit_plugin', array(&$this, 'plugin_settings_page'));
        }

        /**
         * Menu Callback
         */
        public function plugin_settings_page()
        {
            if (!current_user_can('manage_options')) {
                wp_die(__('Vous n\'avez pas la permission pour accéder à cette page'));
            }

            // Render the settings template
            include(sprintf('%S/templates/settings.php', dirname(__FILE__)));
        }

        /**
         * Activate the plugin
         */
        public static function activate()
        {
            // Do nothing
        }

        /**
         * Deactivate the plugin
         */
        public static function deactivate()
        {
            // Do nothing
        }

    }
}

if (class_exists('Mon_Petit_Plugin'))
{
    // Activation and deactivation hooks
    register_activation_hook(__FILE__, array('Mon_Petit_Plugin', 'activate'));
    register_deactivation_hook(__FILE__, array('Mon_Petit_Plugin', 'deactivate'));

    // Instantiate the plugin class
    $mon_petit_plugin = new Mon_Petit_Plugin();

    // Add a link to the settings page onto the plugin page
    if (isset($mon_petit_plugin))
    {
        // Add the settings link to the plugins page
        function add_action_links($links) {
            $links[] = '<a href="' . admin_url('options-general.php?page=mon_petit_plugin') . '">Réglages</a>';
            return $links;
        }
        // see https://codex.wordpress.org/Plugin_API/Filter_Reference/plugin_action_links_(plugin_file_name)
        add_filter('plugin_action_links_' . plugin_basename(__FILE__), 'add_action_links');
    }
}
