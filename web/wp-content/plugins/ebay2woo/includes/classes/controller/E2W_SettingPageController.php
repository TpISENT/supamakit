<?php

/**
 * Description of E2W_SettingPage
 *
 * @author Andrey
 * 
 * @autoload: e2w_init 
 */
if (!class_exists('E2W_SettingPageController')) {


    class E2W_SettingPageController extends E2W_AbstractAdminPage {

        private $product_import_model;
        private $woocommerce_model;

        public function __construct() {
            parent::__construct("Setting", "Setting", 'manage_options', 'e2w_setting', 30);

            $this->product_import_model = new E2W_ProductImport();
            $this->woocommerce_model = new E2W_Woocommerce();

            add_action('wp_ajax_e2w_update_categories', array($this, 'ajax_update_categories'));
            
            add_action('wp_ajax_e2w_update_price_rules', array($this, 'ajax_update_price_rules'));

            add_action('wp_ajax_e2w_apply_pricing_rules', array($this, 'ajax_apply_pricing_rules'));

            add_action('wp_ajax_e2w_update_phrase_rules', array($this, 'ajax_update_phrase_rules'));

            add_action('wp_ajax_e2w_apply_phrase_rules', array($this, 'ajax_apply_phrase_rules'));

            add_action('wp_ajax_e2w_get_status_apply_phrase_rules', array($this, 'ajax_get_status_apply_phrase_rules'));


            add_action('wp_ajax_e2w_calc_external_images_count', array($this, 'ajax_calc_external_images_count'));
            add_action('wp_ajax_e2w_calc_external_images', array($this, 'ajax_calc_external_images'));
            add_action('wp_ajax_e2w_load_external_image', array($this, 'ajax_load_external_image'));

            add_filter('e2w_setting_view', array($this, 'setting_view'));

            add_filter('e2w_configure_lang_data', array($this, 'configure_lang_data'));
        }

        function configure_lang_data($lang_data) {
            if ($this->is_current_page()) {
                $lang_data = array(
                    'process_loading_d_of_d_erros_d' => _x('Process loading %d of %d. Errors: %d.', 'Status', 'e2w'),
                    'load_button_text' => _x('Load %d images', 'Status', 'e2w'),
                    'all_images_loaded_text' => _x('All images loaded', 'Status', 'e2w'),
                );
            }
            return $lang_data;
        }

        public function render($params = array()) {
            $current_module = isset($_REQUEST['subpage']) ? $_REQUEST['subpage'] : 'common';

            $this->model_put("modules", $this->getModules());
            $this->model_put("current_module", $current_module);

            $this->include_view(array("settings/settings_head.php", apply_filters('e2w_setting_view', $current_module), "settings/settings_footer.php"));
        }

        public function getModules() {
            return apply_filters('e2w_setting_modules', array(
                array('id' => 'common', 'name' => __('Common settings', 'e2w')),
                array('id' => 'account', 'name' => __('Account settings', 'e2w')),
                array('id' => 'price_formula', 'name' => __('Pricing Rules', 'e2w')),
                array('id' => 'phrase_filter', 'name' => __('Phrase Filtering', 'e2w')),
                array('id' => 'chrome_api', 'name' => __('API Keys', 'e2w')),
                array('id' => 'system_info', 'name' => __('System Info', 'e2w')),
            ));
        }

        public function setting_view($current_module) {
            $view = "";
            switch ($current_module) {
                case 'common':
                    $view = $this->common_handle();
                    break;
                case 'account':
                    $view = $this->account_handle();
                    break;
                case 'price_formula':
                    $view = $this->price_formula();
                    break;
                case 'phrase_filter':
                    $view = $this->phrase_filter();
                    break;
                case 'chrome_api':
                    $view = $this->chrome_api();
                    break;
                case 'system_info':
                    $view = $this->system_info();
                    break;
            }
            return $view;
        }

        private function common_handle() {
            global $e2w_settings;
            if (isset($_POST['setting_form'])) {
                e2w_settings()->auto_commit(false);
                e2w_set_setting('item_purchase_code', isset($_POST['e2w_item_purchase_code']) ? wp_unslash($_POST['e2w_item_purchase_code']) : '');
                e2w_set_setting('envato_personal_token', isset($_POST['e2w_envato_personal_token']) ? wp_unslash($_POST['e2w_envato_personal_token']) : '');
                
                
                $products_per_page = isset($_POST['e2w_products_per_page'])?intval($_POST['e2w_products_per_page']):20;
                $products_per_page = ($products_per_page<12?12:(($products_per_page>100?100:$products_per_page)));
                e2w_set_setting('products_per_page', $products_per_page);

                e2w_set_setting('default_sitecode', isset($_POST['e2w_default_sitecode']) ? wp_unslash($_POST['e2w_default_sitecode']) : 'en');
                e2w_set_setting('default_product_type', isset($_POST['e2w_default_product_type']) ? wp_unslash($_POST['e2w_default_product_type']) : 'simple');
                e2w_set_setting('default_product_status', isset($_POST['e2w_default_product_status']) ? wp_unslash($_POST['e2w_default_product_status']) : 'publish');

                e2w_set_setting('currency_conversion_factor', isset($_POST['e2w_currency_conversion_factor']) ? wp_unslash($_POST['e2w_currency_conversion_factor']) : '1');
                e2w_set_setting('import_product_images_limit', isset($_POST['e2w_import_product_images_limit']) && intval($_POST['e2w_import_product_images_limit']) ? intval($_POST['e2w_import_product_images_limit']) : '');
                e2w_set_setting('import_extended_attribute', isset($_POST['e2w_import_extended_attribute']) ? 1 : 0);
                e2w_set_setting('import_extended_variation_attribute', isset($_POST['e2w_import_extended_variation_attribute']) ? 1 : 0);
                
                e2w_set_setting('сonvert_images_to_large', isset($_POST['e2w_сonvert_images_to_large']));
                e2w_set_setting('use_external_image_urls', isset($_POST['e2w_use_external_image_urls']));
                e2w_set_setting('not_import_attributes', isset($_POST['e2w_not_import_attributes']));
                e2w_set_setting('not_import_description', isset($_POST['e2w_not_import_description']));
                e2w_set_setting('not_import_description_images', isset($_POST['e2w_not_import_description_images']));

                e2w_set_setting('use_random_stock', isset($_POST['e2w_use_random_stock']));
                if (isset($_POST['e2w_use_random_stock'])) {
                    $min_stock = (!empty($_POST['e2w_use_random_stock_min']) && intval($_POST['e2w_use_random_stock_min']) > 0) ? intval($_POST['e2w_use_random_stock_min']) : 1;
                    $max_stock = (!empty($_POST['e2w_use_random_stock_max']) && intval($_POST['e2w_use_random_stock_max']) > 0) ? intval($_POST['e2w_use_random_stock_max']) : 1;

                    if ($min_stock > $max_stock) {
                        $min_stock = $min_stock + $max_stock;
                        $max_stock = $min_stock - $max_stock;
                        $min_stock = $min_stock - $max_stock;
                    }
                    e2w_set_setting('use_random_stock_min', $min_stock);
                    e2w_set_setting('use_random_stock_max', $max_stock);
                }

				e2w_set_setting('placed_order_status', isset($_POST['e2w_placed_order_status']) ? wp_unslash($_POST['e2w_placed_order_status']) : '');

				e2w_set_setting('fulfillment_prefship', isset($_POST['e2w_fulfillment_prefship']) ? wp_unslash($_POST['e2w_fulfillment_prefship']) : '');
				e2w_set_setting('fulfillment_phone_code', isset($_POST['e2w_fulfillment_phone_code']) ? wp_unslash($_POST['e2w_fulfillment_phone_code']) : '');
				e2w_set_setting('fulfillment_phone_number', isset($_POST['e2w_fulfillment_phone_number']) ? wp_unslash($_POST['e2w_fulfillment_phone_number']) : '');
				e2w_set_setting('fulfillment_custom_note', isset($_POST['e2w_fulfillment_custom_note']) ? wp_unslash($_POST['e2w_fulfillment_custom_note']) : '');

                e2w_set_setting('auto_update', isset($_POST['e2w_auto_update']));
                e2w_set_setting('not_available_product_status', isset($_POST['e2w_not_available_product_status']) ? wp_unslash($_POST['e2w_not_available_product_status']) : 'trash');
                e2w_set_setting('sync_type', isset($_POST['e2w_sync_type']) ? wp_unslash($_POST['e2w_sync_type']) : 'price_and_stock');
                
                e2w_settings()->commit();
                e2w_settings()->auto_commit(true);
            }

			$this->model_put("order_statuses", function_exists('wc_get_order_statuses') ? wc_get_order_statuses() : array());
            return "settings/common.php";
        }

        private function account_handle() {
            $account = E2W_Account::getInstance();

            if (isset($_POST['setting_form'])) {
                $account->use_custom_account(isset($_POST['e2w_use_custom_account']));
                if ($account->custom_account) {
                    $account->save_account(isset($_POST['e2w_app_id']) ? $_POST['e2w_app_id'] : '', isset($_POST['e2w_tracking_id']) ? $_POST['e2w_tracking_id'] : '', isset($_POST['e2w_network_id']) ? $_POST['e2w_network_id'] : '', isset($_POST['e2w_custom_id']) ? $_POST['e2w_custom_id'] : '');
                }
            }

            $this->model_put("account", $account);

            return "settings/account.php";
        }

        private function price_formula() {
            $formulas = E2W_PriceFormula::load_formulas();

            if ($formulas) {
                $add_formula = new E2W_PriceFormula();
                $add_formula->min_price = floatval($formulas[count($formulas) - 1]->max_price) + 0.01;
                $formulas[] = $add_formula;
                $this->model_put("formulas", $formulas);
            } else {
                $this->model_put("formulas", E2W_PriceFormula::get_default_formulas());
            }

            $this->model_put("default_formula", E2W_PriceFormula::get_default_formula());

            $this->model_put('cents', e2w_get_setting('price_cents'));
            $this->model_put('compared_cents', e2w_get_setting('price_compared_cents'));

            return "settings/price_formula.php";
        }

        private function phrase_filter() {
            $phrases = E2W_PhraseFilter::load_phrases();

            if ($phrases) {
                $this->model_put("phrases", $phrases);
            } else {
                $this->model_put("phrases", array());
            }

            return "settings/phrase_filter.php";
        }

		private function chrome_api() {
			$api_keys = e2w_get_setting('api_keys', array());

			if (!empty($_REQUEST['delete-key'])) {
				foreach ($api_keys as $k => $key) {
					if ($key['id'] === $_REQUEST['delete-key']) {
						unset($api_keys[$k]);
						e2w_set_setting('api_keys', $api_keys);
						break;
					}
				}
				wp_redirect(admin_url('admin.php?page=e2w_setting&subpage=chrome_api'));
			} else if (!empty($_POST['e2w_api_key'])) {
				$key_id = $_POST['e2w_api_key'];
				$key_name = !empty($_POST['e2w_api_key_name']) ? $_POST['e2w_api_key_name'] : "New key";

				$is_new = true;
				foreach ($api_keys as &$key) {
					if ($key['id'] === $key_id) {
						$key['name'] = $key_name;
						$is_new = false;
						break;
					}
				}

				if ($is_new) {
					$api_keys[] = array('id' => $key_id, 'name' => $key_name);
				}

				e2w_set_setting('api_keys', $api_keys);

				wp_redirect(admin_url('admin.php?page=e2w_setting&subpage=chrome_api&edit-key=' . $key_id));
			} else if (isset($_REQUEST['edit-key'])) {
				$api_key = array('id' => md5("e2wkey" . rand() . microtime()), 'name' => "New key");
				$is_new = true;
				if (empty($_REQUEST['edit-key'])) {
					$api_keys[] = $api_key;
					e2w_set_setting('api_keys', $api_keys);

					wp_redirect(admin_url('admin.php?page=e2w_setting&subpage=chrome_api&edit-key=' . $api_key['id']));
				} else if (!empty($_REQUEST['edit-key']) && $api_keys && is_array($api_keys)) {
					foreach ($api_keys as $key) {
						if ($key['id'] === $_REQUEST['edit-key']) {
							$api_key = $key;
							$is_new = false;
						}
					}
				}
				$this->model_put("api_key", $api_key);
				$this->model_put("is_new_api_key", $is_new);
			}

			$this->model_put("api_keys", $api_keys);

			return "settings/chrome.php";
		}

        private function system_info() {
            
            
            $server_ip = '-';
            if(array_key_exists('SERVER_ADDR', $_SERVER))
                $server_ip =  $_SERVER['SERVER_ADDR'];
            elseif(array_key_exists('LOCAL_ADDR', $_SERVER))
                $server_ip =  $_SERVER['LOCAL_ADDR'];
            elseif(array_key_exists('SERVER_NAME', $_SERVER))
                $server_ip =  gethostbyname($_SERVER['SERVER_NAME']);
            else {
                // Running CLI
                if(stristr(PHP_OS, 'WIN')) {
                    $server_ip =  gethostbyname(php_uname("n"));
                } else {
                    $ifconfig = shell_exec('/sbin/ifconfig eth0');
                    preg_match('/addr:([\d\.]+)/', $ifconfig, $match);
                    $server_ip = $match[1];
                }
            }

            $this->model_put("server_ip", $server_ip);

            return "settings/system_info.php";
        }
        
        public function ajax_update_categories() {
            e2w_init_error_handler();
            try {
                $loader = new E2W_Ebay();
                $site = E2W_EbaySite::get_site_by_code($_POST['sitecode']);
                $result = $loader->load_categories($site->siteid);

                restore_error_handler();
            } catch (Exception $e) {
                $result = E2W_ResultBuilder::buildError($e->getMessage());
            }

            echo json_encode($result);

            wp_die();
        }

        public function ajax_update_phrase_rules() {
            e2w_init_error_handler();

            $result = E2W_ResultBuilder::buildOk();
            try {

                E2W_PhraseFilter::deleteAll();

                if (isset($_POST['phrases'])) {
                    foreach ($_POST['phrases'] as $phrase) {
                        $filter = new E2W_PhraseFilter($phrase);
                        $filter->save();
                    }
                }

                $result = E2W_ResultBuilder::buildOk(array('phrases' => E2W_PhraseFilter::load_phrases()));

                restore_error_handler();
            } catch (Exception $e) {
                $result = E2W_ResultBuilder::buildError($e->getMessage());
            }

            echo json_encode($result);

            wp_die();
        }

        public function ajax_apply_phrase_rules() {
            e2w_init_error_handler();

            $result = E2W_ResultBuilder::buildOk();
            try {

                $type = isset($_POST['type']) ? $_POST['type'] : false;
                $scope = isset($_POST['scope']) ? $_POST['scope'] : false;

                if ($type === 'products' || $type === 'all_types') {
                    if ($scope === 'all' || $scope === 'import') {
                        $products = $this->product_import_model->get_product_list(false);

                        foreach ($products as $product) {

                            $product = E2W_PhraseFilter::apply_filter_to_product($product);
                            $this->product_import_model->upd_product($product);
                        }
                    }

                    if ($scope === 'all' || $scope === 'shop') {
                        //todo: update attributes as well
                        E2W_PhraseFilter::apply_filter_to_products();
                    }
                }

                if ($type === 'all_types' || $type === 'reviews') {

                    E2W_PhraseFilter::apply_filter_to_reviews();
                }

                if ($type === 'all_types' || $type === 'shippings') {
                    
                }
                restore_error_handler();
            } catch (Exception $e) {
                $result = E2W_ResultBuilder::buildError($e->getMessage());
            }

            echo json_encode($result);

            wp_die();
        }

        public function ajax_update_price_rules() {
            e2w_init_error_handler();

            $result = E2W_ResultBuilder::buildOk();
            try {
                e2w_settings()->auto_commit(false);
                $use_extended_price_markup = isset($_POST['use_extended_price_markup']) ? filter_var($_POST['use_extended_price_markup'], FILTER_VALIDATE_BOOLEAN) : false;
                $use_compared_price_markup = isset($_POST['use_compared_price_markup']) ? filter_var($_POST['use_compared_price_markup'], FILTER_VALIDATE_BOOLEAN) : false;

                e2w_set_setting('price_cents', isset($_POST['cents']) && intval($_POST['cents']) > -1 && intval($_POST['cents']) <= 99 ? intval(wp_unslash($_POST['cents'])) : -1);
                if ($use_compared_price_markup)
                    e2w_set_setting('price_compared_cents', isset($_POST['compared_cents']) && intval($_POST['compared_cents']) > -1 && intval($_POST['compared_cents']) <= 99 ? intval(wp_unslash($_POST['compared_cents'])) : -1);
                else
                    e2w_set_setting('price_compared_cents', -1);

                e2w_set_setting('use_extended_price_markup', $use_extended_price_markup);
                e2w_set_setting('use_compared_price_markup', $use_compared_price_markup);
                
                e2w_settings()->commit();
                e2w_settings()->auto_commit(true);

                if (isset($_POST['rules'])) {
                    E2W_PriceFormula::deleteAll();
                    foreach ($_POST['rules'] as $rule) {
                        $formula = new E2W_PriceFormula($rule);
                        $formula->save();
                    }
                }

                if (isset($_POST['default_rule'])) {
                    E2W_PriceFormula::set_default_formula(new E2W_PriceFormula($_POST['default_rule']));
                }

                $result = E2W_ResultBuilder::buildOk(array('rules' => E2W_PriceFormula::load_formulas(), 'default_rule' => E2W_PriceFormula::get_default_formula(), 'use_extended_price_markup' => $use_extended_price_markup, 'use_compared_price_markup' => $use_compared_price_markup));

                restore_error_handler();
            } catch (Exception $e) {
                $result = E2W_ResultBuilder::buildError($e->getMessage());
            }

            echo json_encode($result);

            wp_die();
        }

        public function ajax_apply_pricing_rules() {
            e2w_init_error_handler();

            $result = E2W_ResultBuilder::buildOk();
            try {

                $type = isset($_POST['type']) ? $_POST['type'] : false;
                $scope = isset($_POST['scope']) ? $_POST['scope'] : false;

                if ($scope === 'all' || $scope === 'import') {
                    $products = $this->product_import_model->get_product_list(false);

                    foreach ($products as $product) {

                        if (!isset($product['disable_var_price_change']) || !$product['disable_var_price_change']) {
                            $product = E2W_PriceFormula::apply_formula($product, 2, $type);
                            $this->product_import_model->upd_product($product);
                        }
                    }
                }

                if ($scope === 'all' || $scope === 'shop') {
                    $product_ids = $this->woocommerce_model->get_sorted_products_ids("_e2w_last_update", 10000);
                    foreach ($product_ids as $product_id) {
                        $product = $this->woocommerce_model->get_product_by_post_id($product_id);
                        if (!isset($product['disable_var_price_change']) || !$product['disable_var_price_change']) {
                            $product = E2W_PriceFormula::apply_formula($product, 2, $type);
                            if (isset($product['sku_products']['variations']) && count($product['sku_products']['variations']) > 0) {
                                $this->woocommerce_model->update_price($product_id, $product['sku_products']['variations'][0]);

                                foreach ($product['sku_products']['variations'] as $var) {
                                    $variation_id = get_posts(array('post_type' => 'product_variation', 'fields' => 'ids', 'numberposts' => 100, 'post_parent' => $product_id, 'meta_query' => array(array('key' => 'external_variation_id', 'value' => $var['id']))));
                                    $variation_id = $variation_id ? $variation_id[0] : false;
                                    if ($variation_id) {
                                        $this->woocommerce_model->update_price($variation_id, $var);
                                    }
                                }
                                wc_delete_product_transients($product_id);
                            }
                        }
                    }
                }

                restore_error_handler();
            } catch (Exception $e) {
                $result = E2W_ResultBuilder::buildError($e->getMessage());
            }

            echo json_encode($result);

            wp_die();
        }

        public function ajax_calc_external_images_count() {
            echo json_encode(E2W_ResultBuilder::buildOk(array('total_images' => E2W_Attachment::calc_total_external_images())));
            wp_die();
        }

        public function ajax_calc_external_images() {
            $page_size = isset($_POST['page_size']) && intval($_POST['page_size']) > 0 ? intval($_POST['page_size']) : 1000;
            $result = E2W_ResultBuilder::buildOk(array('ids' => E2W_Attachment::find_external_images($page_size)));
            echo json_encode($result);
            wp_die();
        }

        public function ajax_load_external_image() {
            global $wpdb;

            e2w_init_error_handler();

            $attachment_model = new E2W_Attachment('local');

            $image_id = isset($_POST['id']) && intval($_POST['id']) > 0 ? intval($_POST['id']) : 0;

            if ($image_id) {
                try {
                    $attachment_model->load_external_image($image_id);

                    $result = E2W_ResultBuilder::buildOk();
                } catch (Exception $e) {
                    $result = E2W_ResultBuilder::buildError($e->getMessage());
                }
            } else {
                $result = E2W_ResultBuilder::buildError("load_external_image: waiting for ID...");
            }


            echo json_encode($result);
            wp_die();
        }

    }

}
