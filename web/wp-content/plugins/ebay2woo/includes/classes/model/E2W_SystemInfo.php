<?php

/**
 * Description of E2W_SystemInfo
 *
 * @author Andrey
 */
if (!class_exists('E2W_SystemInfo')) {
    class E2W_SystemInfo {
        
        public static function server_ping(){
            $result = array();
            
            $ping_url = e2w_get_setting('api_endpoint').'ping.php?' . E2W_Account::getInstance()->build_params() . E2W_EbayLocalizator::getInstance()->build_params()."&r=".mt_rand();
            $request = e2w_remote_get($ping_url);
            if (is_wp_error($request)) {
                if(file_get_contents($ping_url)){
                    $result = E2W_ResultBuilder::buildError('e2w_remote_get error');
                }else{
                    $result = E2W_ResultBuilder::buildError($request->get_error_message());    
                }
            } else if (intval($request['response']['code']) != 200) {
                $result = E2W_ResultBuilder::buildError($request['response']['code'] . " " . $request['response']['message']);
            } else {
                $result = json_decode($request['body'], true);
            }
            
            return $result;
        }
        
        public static function php_check(){
            return E2W_ResultBuilder::buildOk();
        }
    }

}

