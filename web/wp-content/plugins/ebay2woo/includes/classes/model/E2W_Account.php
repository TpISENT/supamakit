<?php

/**
 * Description of E2W_Account
 *
 * @author Andrey
 */
if (!class_exists('E2W_Account')) {

    class E2W_Account {
        private static $_instance = null;
        
        public $custom_account = false;
        
        public $account_data = array('app_id'=>'', 'tracking_id'=>'', 'network_id'=>'9', 'custom_id'=>'');
        
        static public function getInstance() {
            if (is_null(self::$_instance)) {
                self::$_instance = new self();
            }
            return self::$_instance;
        }

        protected function __construct() {
            $this->account_type = e2w_get_setting('account_type');
            $this->custom_account = e2w_get_setting('use_custom_account');
            $this->account_data = e2w_get_setting('account_data');
        }
        
        public function use_custom_account($use_custom_account = false) {
            $this->custom_account = $use_custom_account;
            e2w_set_setting('use_custom_account', $this->custom_account);
        }
        
        public function get_account() {
            return !empty($this->account_data)?$this->account_data:array('app_id'=>'', 'tracking_id'=>'', 'network_id'=>'9', 'custom_id'=>'');
        }
        
        public function save_account($app_id, $tracking_id, $network_id, $custom_id) {
            $this->account_data['app_id']=$app_id;
            $this->account_data['tracking_id']=$tracking_id;
            $this->account_data['network_id']=$network_id;
            $this->account_data['custom_id']=$custom_id;
            e2w_set_setting('account_data', $this->account_data);
        }
        
        public function build_params(){
            if (defined('E2W_ITEM_PURCHASE_CODE') && E2W_ITEM_PURCHASE_CODE) {
                $item_purchase_code = E2W_ITEM_PURCHASE_CODE;
            }else{
                $item_purchase_code = e2w_get_setting('item_purchase_code');
            }
            $result="token=".urlencode($item_purchase_code)."&version=".E2W()->version.($this->custom_account?("&appID={$this->account_data['app_id']}".(!empty($this->account_data['tracking_id'])?"&tracking_id={$this->account_data['tracking_id']}":'').(!empty($this->account_data['network_id'])?"&network_id={$this->account_data['network_id']}":'').(!empty($this->account_data['custom_id'])?"&custom_id={$this->account_data['custom_id']}":'')):'');
            return $result;
        }
    }

}