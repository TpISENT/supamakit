<?php
/**
 * Description of E2W_Settings
 *
 * @author andrey
 */

if (!class_exists('E2W_Settings')) {

    class E2W_Settings {
        private $settings;
        private $auto_commit = true;

		private $static_settings = array(
			'api_endpoint'=>'https://api.ali2woo.com/ebay/v1/',
		);

        private $default_settings = array(
            'item_purchase_code'=>'',
            'envato_personal_token'=>'',
            'use_custom_account'=>false,
            'account_data'=> array('appkey'=>'', 'trackingid'=>''),
            
            'products_per_page'=> '20',
            'default_sitecode'=> 'EBAY-US',
            'default_product_type'=> 'simple',
            'default_product_status'=> 'publish',
            'not_import_attributes'=> false,
            'not_import_description'=> false,
            'not_import_description_images'=> false,
            'import_extended_attribute'=> false,
            'import_extended_variation_attribute'=> false,
            'import_product_images_limit'=> 0,
            'use_external_image_urls'=> true,
            'use_random_stock'=> false,
            'use_random_stock_min'=> 5,
            'use_random_stock_max'=> 15,
            'split_attribute_values'=> true,
            'attribute_values_separator'=> ',',
            'currency_conversion_factor'=> 1,
            'auto_update'=> false,
            'not_available_product_status'=> 'trash',
            'sync_type'=> 'price_and_stock',
            'сonvert_images_to_large'=> false,
            
            'use_extended_price_markup'=> false,
            'use_compared_price_markup'=> false,
            'price_cents'=> -1,
            'price_compared_cents'=> -1,
            'default_formula'=> false,
            'formula_list'=> array(),
            
            'phrase_list'=> array(),
            
            'load_review'=> false,
            'review_status'=> false,
            'review_translated'=> false,
            'review_avatar_import'=> false,
            'review_max_per_product'=> 20,
            'review_raiting_from'=> 1,
            'review_raiting_to'=> 5,
            'review_noavatar_photo'=>'',
            'review_load_attributes'=> false,
            'review_show_image_list'=> false,
            'review_allow_country'=> '',
            
            'aliship_frontend'=> false,
            'aliship_shipto'=> 'US',
            
            'json_api_base'=> 'e2w_api',
            'json_api_controllers'=> 'core,auth',

            'system_message_last_update'=> 0,

			'fulfillment_phone_code'=> '',
			'fulfillment_phone_number'=> '',
			'fulfillment_custom_note'=> '',
        );

        private static $_instance = null;

        protected function __construct() {
            $this->load();
        }

        protected function __clone() {
            
        }

        static public function instance()
		{
			if (is_null(self::$_instance)) {
				self::$_instance = new self();
			}
			return self::$_instance;
		}
        
        public function auto_commit($auto_commit = true){
            $this->auto_commit = $auto_commit;
        }
        
        public function load(){
			$static_settings = $this->static_settings;
			if(e2w_check_defined("E2W_API_ENDPOINT")){
				$static_settings['api_endpoint'] = E2W_API_ENDPOINT;
			}

			if(e2w_check_defined("E2W_DO_NOT_USE_HTTPS")){
				$static_settings['api_endpoint'] = str_replace("https", "http", $static_settings['api_endpoint']);
			}
            $this->settings = array_merge($this->default_settings, get_option('e2w_settings', array()));
        }
        
        public function commit(){
            update_option('e2w_settings', $this->settings);
        }
        
        public function to_string() { }
        
        public function from_string($str) { }


        public function get($setting, $default=''){
            return isset($this->settings[$setting])?$this->settings[$setting]:$default;
        }
        
        public function set($setting, $value){
            $old_value = isset($this->settings[$setting])?$this->settings[$setting]:'';
            
            do_action('e2w_pre_set_setting_'.$setting, $old_value, $value, $setting);
            
            $this->settings[$setting] = $value;
            
            if($this->auto_commit){
                $this->commit();
            }
            
            do_action('e2w_set_setting_'.$setting, $old_value, $value, $setting);
        }
        
        public function del($setting){
            if(isset($this->settings[$setting])){
                unset($this->settings[$setting]);
                
                if($this->auto_commit){
                    $this->commit();
                }
            }
        }
    }
}

if (!function_exists('e2w_settings')) {
    function e2w_settings() {
        return E2W_Settings::instance();
    }
}

if (!function_exists('e2w_get_setting')) {
    function e2w_get_setting($setting, $default='') {
        return e2w_settings()->get($setting, $default);
    }
}

if (!function_exists('e2w_set_setting')) {
    function e2w_set_setting($setting, $value) {
        if (defined('E2W_DEMO_MODE') && E2W_DEMO_MODE && in_array($setting, array('use_external_image_urls'))) {
            return;
        }
        
        return e2w_settings()->set($setting, $value);
    }
}

if (!function_exists('e2w_del_setting')) {
    function e2w_del_setting($setting) {
        return e2w_settings()->del($setting);
    }
}
