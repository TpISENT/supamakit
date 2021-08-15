<?php

/**
 * Description of E2W_RequestHelper
 *
 * @author Andrey
 */
if (!class_exists('E2W_RequestHelper')) {

    class E2W_RequestHelper {
        public static function build_request($function, $params=array()){
            $request_url = e2w_get_setting('api_endpoint').$function.'.php?' . E2W_Account::getInstance()->build_params() /*. E2W_EbayLocalizator::getInstance()->build_params()*/."&su=".  urlencode(site_url());
            
            if(!empty($params) && is_array($params)){
                foreach($params as $key=>$val){
                    $request_url .= "&".str_replace("%7E", "~", rawurlencode($key))."=".str_replace("%7E", "~", rawurlencode($val));
                }    
            }
            return $request_url;
        }
    }
}
