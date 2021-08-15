<?php

/* * class
 * Description of E2W_AbstractPage
 *
 * @author andrey
 * 
 * @position: 2
 */

if (!class_exists('E2W_AbstractAdminPage')) {

    abstract class E2W_AbstractAdminPage extends E2W_AbstractController {

        private $page_title;
        private $menu_title;
        private $capability;
        private $menu_slug;
        private $menu_as_link;

        public function __construct($page_title, $menu_title, $capability, $menu_slug, $priority = 10, $menu_as_link=false) {
            parent::__construct(E2W()->plugin_path . '/view/');
            
            if(is_admin()){
                $this->init($page_title, $menu_title, $capability, $menu_slug, $priority, $menu_as_link);

                add_action('e2w_admin_assets', array($this, 'admin_register_assets'), 1);

                add_action('e2w_admin_assets', array($this, 'admin_enqueue_assets'), 2);

                add_action('wp_loaded', array($this, 'before_render_action'));

                if ($this->is_current_page() && !E2W_Woocommerce::is_woocommerce_installed() && !has_action('admin_notices', array($this, 'woocomerce_check_error'))) {
                    add_action('admin_notices', array($this, 'woocomerce_check_error'));
                }

                if ($this->is_current_page() && !has_action('admin_notices', array($this, 'global_system_message'))) {
                    add_action('admin_notices', array($this, 'global_system_message'));
                }    
            }
        }
        
        function woocomerce_check_error() {
            echo '<div id="message2222" class="notice error is-dismissible"><p>'._x('Ebay2Woo notice! Please install the <a href="https://woocommerce.com/" target="_blank">WooCommerce</a> plugin first.', 'e2w').'</p><button type="button" class="notice-dismiss"><span class="screen-reader-text">Dismiss this notice.</span></button></div>';
        }
        
        function global_system_message() {
            $system_message = e2w_get_setting('system_message');
            if($system_message && !empty($system_message['message'])){
                $message_class='updated';
                if($system_message['type'] == 'error'){
                    $message_class='error';
                }
                echo '<div id="e2w-system-message" class="notice '.$message_class.' is-dismissible"><p>'.$system_message['message'].'</p><button type="button" class="notice-dismiss"><span class="screen-reader-text">Dismiss this notice.</span></button></div>';
            }
        }
        

        protected function init($page_title, $menu_title, $capability, $menu_slug, $priority, $menu_as_link) {
            $this->page_title = $page_title;
            $this->menu_title = $menu_title;
            $this->capability = $capability;
            $this->menu_slug = $menu_slug;
            $this->menu_as_link = $menu_as_link;
            add_action('e2w_init_admin_menu', array($this, 'add_submenu_page'), $priority);
        }

        public function add_submenu_page($parent_slug) {
            if($this->menu_as_link){
                add_submenu_page($parent_slug, $this->page_title, $this->menu_title, $this->capability, $this->menu_slug);
            } else {
                add_submenu_page($parent_slug, $this->page_title, $this->menu_title, $this->capability, $this->menu_slug, array($this, 'render'));
            }
            
        }

        public function before_render_action() {
            if ($this->is_current_page()) {
                $this->before_admin_render();
            }
        }

        public function before_admin_render() {
            
        }

        abstract public function render($params = array());

        public function admin_register_assets() {
            if ($this->is_current_page()) {
                if (!wp_style_is('e2w-admin-style', 'registered')) {
                    wp_register_style('e2w-admin-style', E2W()->plugin_url . 'assets/css/admin_style.css', array(), E2W()->version);
                }
                if (!wp_style_is('e2w-admin-style-new', 'registered')) {
                    wp_register_style('e2w-admin-style-new', E2W()->plugin_url . 'assets/css/admin_style_new.css', array(),  E2W()->version);
                }
                if (!wp_script_is('e2w-admin-script', 'registered')) {
                    wp_register_script('e2w-admin-script', E2W()->plugin_url . 'assets/js/admin_script.js', array('jquery'),  E2W()->version);
                    $lang_data = array();
                    wp_localize_script('e2w-admin-script', 'e2w_common_data', array('baseurl' => E2W()->plugin_url,'lang' => apply_filters('e2w_configure_lang_data', $lang_data)));
                }
                if (!wp_script_is('e2w-admin-svg', 'registered')) {
                    wp_register_script('e2w-admin-svg', E2W()->plugin_url . 'assets/js/svg.min.js', array('jquery'),  E2W()->version);
                }
                
                /* select2 */
                if (!wp_style_is('e2w-select2-style', 'registered')) {
                    wp_register_style('e2w-select2-style', E2W()->plugin_url . 'assets/js/select2/css/select2.min.css', array(),  E2W()->version);
                }
                if (!wp_script_is('e2w-select2-js', 'registered')) {
                    wp_register_script('e2w-select2-js', E2W()->plugin_url . 'assets/js/select2/js/select2.min.js', array('jquery'),  E2W()->version);
                }
                
                /*jquery.lazyload*/
                if (!wp_script_is('e2w-lazyload-js', 'registered')) {
                    wp_register_script('e2w-lazyload-js', E2W()->plugin_url . 'assets/js/jquery/jquery.lazyload.js', array('jquery'),  E2W()->version);
                }
                
                /* bootstrap */
                if (!wp_style_is('e2w-bootstrap-style', 'registered')) {
                    wp_register_style('e2w-bootstrap-style', E2W()->plugin_url . 'assets/js/bootstrap/css/bootstrap.min.css', array(),  E2W()->version);
                }
                if (!wp_script_is('e2w-bootstrap-js', 'registered')) {
                    wp_register_script('e2w-bootstrap-js', E2W()->plugin_url . 'assets/js/bootstrap/js/bootstrap.min.js', array('jquery'),  E2W()->version);
                }
            }
        }

        public function admin_enqueue_assets($page) {
            if ($this->is_current_page()) {
             
                wp_enqueue_script('jquery-effects-core');
                
                if (!wp_style_is('e2w-admin-style', 'enqueued')) {
                    wp_enqueue_style('e2w-admin-style');
                    wp_style_add_data( 'e2w-admin-style', 'rtl', 'replace' );
                }
                if (!wp_style_is('e2w-admin-style-new', 'enqueued')) {
                    wp_enqueue_style('e2w-admin-style-new');
                }
                if (!wp_script_is('e2w-admin-script', 'enqueued')) {
                    wp_enqueue_script('e2w-admin-script');
                }
                if (!wp_script_is('e2w-admin-svg', 'enqueued')) {
                    wp_enqueue_script('e2w-admin-svg');
                }
                
                /* select2 */
                if (!wp_style_is('e2w-select2-style', 'enqueued')) {
                    wp_enqueue_style('e2w-select2-style');
                }
                if (!wp_script_is('e2w-select2-js', 'enqueued')) {
                    wp_enqueue_script('e2w-select2-js');
                }
                
                /*jquery.lazyload*/
                if (!wp_script_is('e2w-lazyload-js', 'enqueued')) {
                    wp_enqueue_script('e2w-lazyload-js');
                }
                
                /* bootstrap */
                if (!wp_style_is('e2w-bootstrap-style', 'enqueued')) {
                    wp_enqueue_style('e2w-bootstrap-style');
                }
                if (!wp_script_is('e2w-bootstrap-js', 'enqueued')) {
                    wp_enqueue_script('e2w-bootstrap-js');
                }

            }
        }
        
        protected function is_current_page(){
            return /*strpos($_SERVER['REQUEST_URI'], 'wp-admin/admin.php') !== false*/is_admin() && isset($_REQUEST['page']) && $_REQUEST['page'] && $this->menu_slug == $_REQUEST['page'];
        }

    }

}
