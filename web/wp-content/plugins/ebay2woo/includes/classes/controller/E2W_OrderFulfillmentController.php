<?php

/**
 * Description of A2W_OrderFulfillmentController
 *
 * @autoload: true
 */
if (!class_exists('E2W_OrderFulfillmentController')) {

    class E2W_OrderFulfillmentController extends E2W_AbstractController  {

        public function __construct() {
            parent::__construct(E2W()->plugin_path . '/view/');
            if (is_admin() && isset($_REQUEST['post_type']) && $_REQUEST['post_type'] == "shop_order") {
                add_action('admin_enqueue_scripts', array($this, 'assets'));
                add_action('admin_footer', array($this, 'place_orders_bulk_popup'));
            }

            add_filter('e2w_wcol_bulk_actions_init', array($this, 'bulk_actions'));
            add_action('wp_ajax_e2w_get_ebay_order_data', array($this, 'get_ebay_order_data'));
        }

        function assets() {
            wp_enqueue_script('e2w-ebay-orderfulfill-js', E2W()->plugin_url . '/assets/js/orderfulfill.js', array(),  E2W()->version, true);

            wp_enqueue_script('e2w-sprintf-script', E2W()->plugin_url . '/assets/js/e2w_sprintf.js', array(), E2W()->version);

            $lang_data = array(
                'placing_orders_d_of_d' => _x('Placing orders %d/%d...', 'Status', 'e2w'),
                'please_wait_data_loads' => _x('Please wait, data loads..', 'Status', 'e2w'),

                'process_update_d_of_d_erros_d' => _x('Process update %d of %d. Errors: %d.', 'Status', 'e2w'),
                'complete_result_updated_d_erros_d' => _x('Complete! Result updated: %d; errors: %d.', 'Status', 'e2w'),
                'install_chrome_ext' => _x('Please install and connect to your website the eBay2Woo chrome extension to use this feature.', 'Status', 'e2w'),
                'please_connect_chrome_extension_check_d' => _x('Please connect the Chrome extension to your store and then continue. Need help? Check out <a href="%s">the instruction</a>', 'Status', 'e2w'),
                'we_found_old_order' => _x('We fouwe_found_old_ordernd an old order fulfillment process and removed it. Press the "Continue" button.', 'Status', 'e2w'),
            //    'login_into_aliexpress_account' => _x('Please switch to eBay tab and login into your EBay account.', 'Status', 'e2w'),
                'login_into_ebay_account' => _x('Please switch to eBay tab and login into your EBay account.', 'Status', 'e2w'),
            //    'detected_old_aliexpress_interface' => _x('Detected old eBay interface. Please contact eBay2Woo support.', 'Status', 'e2w'),
                'detected_old_ebay_interface' => _x('Detected old eBay interface. Please contact eBay2Woo support.', 'Status', 'e2w'),
                'your_customer_address_entered' => _x('Your customer address is entered. Wait...', 'Status', 'e2w'),
                'product_is_added_to_cart' => _x('Product (%d) is added to the cart. Wait...', 'Status', 'e2w'),
                'all_products_are_added' => _x('All products are added to the cart. Wait...', 'Status', 'e2w'),
                'cart_is_cleared' => _x('The previous cart data is cleared. Wait...', 'Status', 'e2w'),
                'get_no_responces_from_chrome_ext_d' => _x('Get no responces from the chrome extension for 30s. Check out <a href="%s">the instruction</a>', 'Status', 'e2w'),
                'fill_order_note' => _x('Filling order notes...', 'Status', 'e2w'),
                'cant_add_product_to_cart_d' => _x('Can`t add this product to the cart. Switch to eBay and choose another one or add a similar product from another supplier manually. Then continue. Check out <a href="%s">the instruction</a>', 'Status', 'e2w'),
                'please_type_customer_address' => _x('Please switch to eBay tab, type the address or skip this order.', 'Status', 'e2w'),
                'please_input_captcha' => _x('Please switch to eBay and input the Captcha code manually or wait for your Captcha solver to do the job...', 'Status', 'e2w'),
                'order_is_placed' => _x('The order is placed. Wait...', 'Status', 'e2w'),
            //    'internal_aliexpress_error' => _x('Internal eBay error. Please continue to try again or skip this order.', 'Status', 'e2w'),
                'internal_ebay_error' => _x('Internal eBay error. Please continue to try again or skip this order.', 'Status', 'e2w'),
                'all_orders_are_placed' => _x('All orders are placed! Click "Orders List" to be directed to the orders list on the eBay website.', 'Status', 'e2w'),
                'cant_process_your_orders' => _x('We can`t process your orders. Check out the "Status Page" for more details.', 'Status', 'e2w'),
                'cant_get_order_id' => _x('Can`t get the external order ID, please copy it manually to your WC order. Then continue.', 'Status', 'e2w'),
                'payment_is_failed' => _x('The payment is failed, please finish this order manually. Then continue.', 'Status', 'e2w'),
                'done_pay_manually' => _x('Please switch to eBay and pay for the order.', 'Status', 'e2w'),
                'choose_payment_method' => _x('Please switch to eBay and choose payment method.', 'Status', 'e2w'),

                'please_activate_right_store_apikey_in_chrome' => _x('This website is not connected to the eBay chrome extension. Please check that you choose right API key.', 'Status', 'e2w'),

                'bad_product_id' => _x('Can`t find the WC order with a given ID.', 'Status', 'e2w'),
                'no_variable_data' => _x('This order has a variable product but doesn`t contain the variable data for some reason. Check out <a href="%s">the instruction</a>', 'Status', 'e2w'),
                'no_product_url' => _x('This order doesn`t contain the `product_url` field for some reason. Check out <a href="%s">the instruction</a>', 'Status', 'e2w'),
            //    'no_ali_products' => _x('No eBay products in the current order. Check out <a href="%s">the instruction</a>', 'Status', 'e2w'),
                'no_ebay_products' => _x('No eBay products in the current order. Check out <a href="%s">the instruction</a>', 'Status', 'e2w'),

                'out_of_stock' => _x('Product is out of stock', 'Status', 'e2w'),
                'quantity_not_available' => _x('Quantity is not available', 'Status', 'e2w'),
                'auction_product' => _x('This is auction and it can\'be added to the cart', 'Status', 'e2w'),
                'retry' => _x('Cart is empty. Please to continue', 'Status', 'e2w'),
                'sign_in' => _x('Please log into your eBay account', 'Status', 'e2w'),
                'reg_update' => _x('Please fill in contact information', 'Status', 'e2w'),
                'error_shipping_details' => _x('Please fill in customer shipping details', 'Status', 'e2w'),
                'filling_customer_details' => _x('Filling customer details...', 'Status', 'e2w'),

                'unknown_error' => _x('Unknown error occured. Please contact support.', 'Status', 'e2w'),
                'server_error' => _x('Server error. Continue to try again.', 'Status', 'e2w')
            );

            wp_localize_script('e2w-ebay-orderfulfill-js', 'e2w_ebay_orderfulfill_js', array('lang' => $lang_data));

        }

        public function bulk_actions($params){
            $params[0][] = 'e2w_order_place_bulk';
            $params[1]['e2w_order_place_bulk'] = __("Place on eBay", 'e2w');

            return $params;
        }

        public function place_orders_bulk_popup()
        {
            $this->include_view('includes/place_orders_bulk_popup.php');
        }

        function get_ebay_order_data() {
            $result = array("state" => "ok", "data" => "", "action" => "");

            $post_id = isset($_POST['id']) ? $_POST['id'] : false;

            if (!$post_id) {
                $result['state'] = 'error';
                $result['error_code'] = -1;
                echo json_encode($result);
                wp_die();
            }

            $order = new WC_Order($post_id);

            $def_prefship = e2w_get_setting('fulfillment_prefship');
            $def_customer_note = e2w_get_setting('fulfillment_custom_note');
            $def_phone_number = e2w_get_setting('fulfillment_phone_number');
            $def_phone_code = e2w_get_setting('fulfillment_phone_code');
        //    $e2w_order_autopay = e2w_get_setting('order_autopay');
        //    $e2w_order_awaiting_payment = e2w_get_setting('order_awaiting_payment');

            $content = array(
                'id' => $post_id,
                'defaultShipping' => $def_prefship,
                'note' => $def_customer_note !== "" ? $def_customer_note : $this->get_customer_note($order),
                'products' => array(),
                'countryRegion' => $this->get_country_region($order),
                'region' => mb_strtolower($this->get_region($order)),
                'city' => $this->get_city($order),
                'first_name' => $this->get_firstName($order),
                'last_name' => $this->get_lastName($order),
            //    'contactName' => $this->get_contactName($order),
                'address1' => $this->get_address1($order),
                'address2' => $this->get_address2($order),
                'mobile' => $def_phone_number !== "" ? $def_phone_number : $this->get_phone($order),
                'mobile_code' => $def_phone_code !== "" ? $def_phone_code : '',
                'zip' => $this->get_zip($order),
            //    'autopay' => $e2w_order_autopay,
            //    'awaitingpay' => $e2w_order_awaiting_payment,
                'cpf' => $this->get_cpf($order),
                'storeurl' => get_site_url()
            );

            $items = $order->get_items();

            $k = 0;
            $total = 0;
            foreach ($items as $item) {

				$product_meta_data_array = $item->get_meta_data();
				$attributes = array();
				foreach ( $product_meta_data_array as $array_key => $meta ) {
					if ($meta->key === '_reduced_stock') {
						continue;
					}
					// remove woocomerce prefix "pa_"
					$curr_key = 'pa_' === substr($meta->key, 0, 3) ? substr( $meta->key, 3 ) : $meta->key;
					if (false === strpos($meta->value, '-')) {
						$attributes[] = array(
							'key' => rawurldecode($curr_key),
							'value' => $meta->value
						);

					} else {
						$term = get_term_by('slug', $meta->value, $meta->key);
						if ($term === false) {
							$attr_value = $meta->value;
						} else {
							$attr_value = $term->name;
						}
						$attributes[] = array(
							'key' => rawurldecode($curr_key),
							'value' => $attr_value
						);
					}
				}

				$normalized_item = new E2W_WooCommerceOrderItem($item);

                $product_id = $normalized_item->getProductID();
                $variation_id = $normalized_item->getVariationID();
                $quantity = $normalized_item->getQuantity();

                $external_id = get_post_meta($product_id, '_e2w_external_id', true);

                if ($external_id) {
                    $skuArray = $this->getSkuArray($normalized_item);

                    $shipping_code = $normalized_item->get_E2W_ShippingCode();

                    if (empty($skuArray) && $variation_id && $variation_id > 0) {
                        $result['error_code'] = -2;
                        $result['state'] = 'error';
                        echo json_encode($result);
                        wp_die();
                    }

                    $original_url = get_post_meta($product_id, '_e2w_original_product_url', true);

                    if (empty($original_url)) {
                        $result['error_code'] = -3;
                        $result['state'] = 'error';
                        echo json_encode($result);
                        wp_die();
                    }
                    // $skuArray[0] = 0;
                    $content['products'][$k] = array(
                        'url' => $original_url,
                        'productId' => $external_id,
                        'originalId' => $product_id,
                        'qty' => $quantity,
                        'sku' => $skuArray,
                        'attributes' => $attributes,
                        'shipping' => $shipping_code,
                    );

                    $k++;
                }
                $total++;
            }

            if ($k < 1) {
                $result['error_code'] = -4;
                $result['state'] = 'error';
                echo json_encode($result);
                wp_die();
            }

            if ($k == $total) {
                $result['action'] = 'upd_ord_status';
            }

            $result['data'] = array('content' => $content, 'id' => $post_id);

            echo json_encode($result);
            wp_die();
        }

        private function format_field($str) {
            $str = trim($str);

            if (!empty($str))
                $str = ucwords(mb_strtolower($str));

            return $str;
        }

        private function get_cpf($order) {
            $b_cpf = $order->get_meta('_billing_cpf');
            $s_cpf = $order->get_meta('_shipping_cpf');

            $cpf = $b_cpf ? $b_cpf : ($s_cpf ? $s_cpf : '');

            $cpf = $cpf ? preg_replace("/[^0-9]/", "", $cpf ) : '';
            return $cpf;
        }

        private function get_phone($order) {
            if (WC()->version < '3.0.0')
                $result = $order->billing_phone ? $order->billing_phone : $order->shipping_phone;
            else
                $result = $order->get_billing_phone();

            return $result;
        }

        private function get_customer_note($order) {
            if (WC()->version < '3.0.0')
                $result = $order->customer_note;
            else
                $result = $order->get_customer_note();

            return $this->translitirate($result);
        }

        private function get_country_region($order) {
            if (WC()->version < '3.0.0')
                $result = $order->shipping_country ? $this->format_field_country($order->shipping_country) : $this->format_field_country($order->billing_country);
            else
                $result = $order->get_shipping_country() ? $this->format_field_country($order->get_shipping_country()) : $this->format_field_country($order->get_billing_country());

            return $this->translitirate($result);
        }

        private function get_region($order) {
            if (WC()->version < '3.0.0')
                $result = $order->shipping_state ? $this->format_field_state($order->shipping_country, $order->shipping_state) : $this->format_field_state($order->billing_country, $order->billing_state);
            else
                $result = $order->get_shipping_state() ? $this->format_field_state($order->get_shipping_country(), $order->get_shipping_state()) : $this->format_field_state($order->get_billing_country(), $order->get_billing_state());

            return $this->translitirate($result);
        }

        private function get_city($order) {

            if (WC()->version < '3.0.0')
                $result = $order->shipping_city ? $this->format_field($order->shipping_city) : $this->format_field($order->billing_city);
            else
                $result = $order->get_shipping_city() ? $this->format_field($order->get_shipping_city()) : $this->format_field($order->get_billing_city());

            return $this->translitirate($result);
        }

        private function get_firstName($order) {
			if (WC()->version < '3.0.0') {
				if ( $order->shipping_first_name ) {
					$result = $order->shipping_first_name;
				} else {
					$result = $order->billing_first_name;
				}
			} else {
				$result = $order->get_shipping_first_name() ? $order->get_shipping_first_name() : $order->get_billing_first_name();
			}
			return $this->translitirate($result);
		}

		private function get_lastName($order) {
			if (WC()->version < '3.0.0') {
				if ( $order->shipping_last_name ) {
					$result = $order->shipping_last_name;
				} else {
					$result = $order->billing_last_name;
				}
			} else {
				$result = $order->get_shipping_last_name() ? $order->get_shipping_last_name() : $order->get_billing_last_name();
			}
			return $this->translitirate($result);
		}

        private function get_contactName($order) {
            if (WC()->version < '3.0.0') {

                if ( $order->shipping_first_name ) {
                    $result = $order->shipping_first_name . ' ' . $order->shipping_last_name;

                    if (isset($this->shipping_third_name)) {
                        $result .= ' '. $order->shipping_third_name;
                    }
                } else {
                    $result = $order->billing_first_name . ' ' . $order->billing_last_name;

                    if (isset($this->billing_third_name)) {
                        $result .= ' '. $order->billing_third_name;
                    }
                }
            }
            else
                $result = $order->get_shipping_first_name() ? $order->get_shipping_first_name() . ' ' . $order->get_shipping_last_name() . ' ' . $order->get_meta('_shipping_third_name') : $order->get_billing_first_name() . ' ' . $order->get_billing_last_name() . ' ' . $order->get_meta('_billing_third_name');

            return $this->translitirate($result);
        }

        private function get_address1($order) {
            if (WC()->version < '3.0.0')
                $result = $order->shipping_address_1 ? $order->shipping_address_1 : $order->billing_address_1;
            else
                $result = $order->get_shipping_address_1() ? $order->get_shipping_address_1() : $order->get_billing_address_1();

            return $this->translitirate($result);
        }

        private function get_address2($order) {
            if (WC()->version < '3.0.0')
                $result = $order->shipping_address_2 ? $order->shipping_address_2 : $order->billing_address_2;
            else
                $result = $order->get_shipping_address_2() ? $order->get_shipping_address_2() : $order->get_billing_address_2();

            return $this->translitirate($result);
        }

        private function get_zip($order) {
            if (WC()->version < '3.0.0')
                $result = $order->shipping_postcode ? $order->shipping_postcode : $order->billing_postcode;
            else
                $result = $order->get_shipping_postcode() ? $order->get_shipping_postcode() : $order->get_billing_postcode();

            return $result;
        }

        private function format_field_country($str) {
            $str = trim($str);

            if (!empty($str))
                $str = strtoupper($str);

            if ($str === "GB") $str = "UK";
            if ($str == "RS") $str = "SRB";
            if ($str == "ME") $str = "MNE";

            return $str;
        }

        private function format_field_state($country_code, $state_code) {
            if (isset(WC()->countries->states[$country_code]) && isset(WC()->countries->states[$country_code][$state_code]))
                $result = $this->format_field(WC()->countries->states[$country_code][$state_code]);
            else
                $result = $state_code;

            //WooCommerce translation file has html entities
            $result = html_entity_decode( (string) $result, ENT_QUOTES, 'UTF-8');

            return $result;
        }

        private function getSkuArray($item) {
            $sku = array();

            if ($item->getVariationID() !== 0) {

                $variation_id = $item->getVariationID();
                $sku = $this->getSkuArrayByVariationID($variation_id);

            } else {
                $product_id = $item->getProductID();
                $sku = $this->getSkuArrayByVariationID($product_id);

                if (empty($sku)){
                    //Backward-compatible code to get sku data for Simple type product
                    $handle = new WC_Product_Variable($product_id);
                    if ($handle){
                        $variations_ids=$handle->get_children();
                        if ($variations_ids && count($variations_ids) > 0){
                            $first_variation_id = $variations_ids[0];
                            $sku = $this->getSkuArrayByVariationID($first_variation_id);
                        }
                    }
                }

            }
            return $sku;
        }

        private function getSkuArrayByVariationID($variation_id){
            $sku = array();

            $external_var_data = get_post_meta($variation_id, '_e2w_external_sku_props', true);

            if (empty($external_var_data))
                return $sku;

            if ($external_var_data) {
                $items = explode(';', $external_var_data);

                foreach ($items as $item) {
                    list(, $sku[]) = explode(':', $item);
                }
            }

            return $sku;
        }

        private function translitirate($result){
            if (e2w_get_setting('order_translitirate')){
                $result = E2W_Utils::safeTransliterate($result);
            }

            return $result;
        }

    }

}
