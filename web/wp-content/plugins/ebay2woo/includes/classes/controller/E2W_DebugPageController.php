<?php

/**
 * Description of E2W_DebugPageController
 *
 * @author andrey
 * 
 * @autoload: e2w_before_admin_menu
 */
if (!class_exists('E2W_DebugPageController')) {

    class E2W_DebugPageController extends E2W_AbstractAdminPage {
        public function __construct() {
            if (defined('E2W_DEBUG_PAGE') && E2W_DEBUG_PAGE) {
                parent::__construct("Debug", "Debug", 'manage_options', 'e2w_debug');
            }
        }

        public function render($params = array()) {
            echo "<br/><b>DEBUG</b><br/>";
        }
    }

}
