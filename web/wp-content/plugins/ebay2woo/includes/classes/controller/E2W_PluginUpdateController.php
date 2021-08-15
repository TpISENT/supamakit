<?php

/**
 * Description of E2W_PluginUpdateController
 *
 * @author Andrey
 * 
 * @autoload: e2w_init
 */
if (!class_exists('E2W_PluginUpdateController')) {

    class E2W_PluginUpdateController extends E2W_AbstractController {

        private $update;

        public function __construct() {
            $this->update = new E2W_Update(E2W()->version, e2w_get_setting('api_endpoint').'update.php', E2W()->plugin_name, '19821022', e2w_get_setting('envato_personal_token'));

            //add_action('in_plugin_update_message-ebay2woo/ebay2woo.php', array($this, 'plugin_update_message'), 10, 3);
        }
        
        public function plugin_update_message($plugin_file, $plugin_data='', $status=''){
            echo ' <em><a href="'.admin_url( 'admin.php?page=e2w_setting').'">Register</a> your copy of plugin to receive access to automatic upgrades and support.</em>';
        }

    }

}