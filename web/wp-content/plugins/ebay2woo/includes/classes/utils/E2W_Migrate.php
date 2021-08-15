<?php

/**
 * Description of E2W_Migrate
 *
 * @author Andrey
 * 
 * @autoload: e2w_init
 */

if (!class_exists('E2W_Migrate')) {

    class E2W_Migrate {
        public function __construct() {
            $this->migrate();
        }
        
        public function migrate(){
            $cur_version = get_option('e2w_db_version', '');

            if(version_compare($cur_version, "1.1.0", '<')) {
                $this->migrate_to_110();
            }

            if(version_compare($cur_version, E2W()->version, '<')) {
                update_option('e2w_db_version', E2W()->version);
            }
        }

        private function migrate_to_110(){
            error_log('migrate to 1.1.0');
            
            e2w_set_setting('api_endpoint', 'https://api.ali2woo.com/ebay/v1/');
        }
    }
}
