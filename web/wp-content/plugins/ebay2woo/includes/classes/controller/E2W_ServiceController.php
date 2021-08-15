<?php
/**
 * Description of E2W_ServiceController
 *
 * @author Andrey
 * 
 * @autoload: e2w_init
 */

if (!class_exists('E2W_ServiceController')) {

    class E2W_ServiceController {

        private $system_message_update_period = 7200; //60*60*2;

        public function __construct() {

            $system_message_last_update = intval(e2w_get_setting('system_message_last_update'));
            if (!$system_message_last_update || $system_message_last_update < time()) {
                e2w_set_setting('system_message_last_update', time() + $this->system_message_update_period);

                $request = e2w_remote_get('http://ma-group5.com/api/v1/system_message.php');
                if (!is_wp_error($request) && intval($request['response']['code']) == 200) {
                    $system_message = json_decode($request['body'], true);
                    e2w_set_setting('system_message', $system_message);
                }
            }
        }

    }

}