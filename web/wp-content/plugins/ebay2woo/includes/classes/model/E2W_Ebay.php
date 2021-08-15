<?php

/**
 * Description of E2W_Ebay
 *
 * @author Andrey
 */
if (!class_exists('E2W_Ebay')) {

    class E2W_Ebay {

        private $product_import_model;
        private $account;
        

        function __construct() {
            $this->product_import_model = new E2W_ProductImport();
            $this->account = E2W_Account::getInstance();
        }

        public function load_products($filter, $page = 1, $per_page = 20, $params = array()) {
            /** @var wpdb $wpdb */
            global $wpdb;

            $products_in_import = $this->product_import_model->get_product_id_list();

            $request_url = E2W_RequestHelper::build_request('get_products', array_merge(array('page' => $page, 'per_page' => $per_page), $filter));
            // error_log($request_url);
            $request = e2w_remote_get($request_url);

            if (is_wp_error($request)) {
                $result = E2W_ResultBuilder::buildError($request->get_error_message());
            } else if (intval($request['response']['code']) != 200) {
                $result = E2W_ResultBuilder::buildError($request['response']['code'] . " " . $request['response']['message']);
            } else {
                $result = json_decode($request['body'], true);
                //error_log(print_r($result,true));

                if (isset($result['state']) && $result['state'] !== 'error') {
                    $default_type = e2w_get_setting('default_product_type');
                    $default_status = e2w_get_setting('default_product_status');

                    foreach ($result['products'] as &$product) {
                        $product['post_id'] = $wpdb->get_var($wpdb->prepare("SELECT post_id FROM $wpdb->postmeta WHERE meta_key='_e2w_external_id' AND meta_value='%s' LIMIT 1", $product['id']));
                        $product['import_id'] = in_array($product['id'], $products_in_import) ? $product['id'] : 0;
                        $product['product_type'] = $default_type;
                        $product['product_status'] = $default_status;
                        $product['is_affiliate'] = true;
                    }
                }
            }
            return $result;
        }
        
        public function load_product($product_id, $site_id, $params = array()) {
            /** @var wpdb $wpdb */
            global $wpdb;
            $products_in_import = $this->product_import_model->get_product_id_list();

            $request_url = E2W_RequestHelper::build_request('get_product', array('product_id' => $product_id, 'site_id'=>$site_id));
            // error_log($request_url);
            $request = e2w_remote_get($request_url);

            if (is_wp_error($request)) {
                $result = E2W_ResultBuilder::buildError($request->get_error_message());
            } else {
                $result = json_decode($request['body'], true);

                if ($result['state'] !== 'error') {
                    $result['product']['post_id'] = $wpdb->get_var($wpdb->prepare("SELECT post_id FROM $wpdb->postmeta WHERE meta_key='_e2w_external_id' AND meta_value='%s' LIMIT 1", $result['product']['id']));
                    $result['product']['import_id'] = in_array($result['product']['id'], $products_in_import) ? $result['product']['id'] : 0;
                    
                    $site = E2W_EbaySite::get_site_by_id($site_id);
                    $result['product']['globalId'] = $site->sitecode;
                    
                    if (e2w_get_setting('use_random_stock')) {
                        $result['product']['disable_var_quantity_change'] = true;
                        foreach ($result['product']['sku_products']['variations'] as &$variation) {
                            $variation['original_quantity'] = intval($variation['quantity']);
                            $tmp_quantity = rand(intval(e2w_get_setting('use_random_stock_min')), intval(e2w_get_setting('use_random_stock_max')));
                            $tmp_quantity = ($tmp_quantity > $variation['original_quantity']) ? $variation['original_quantity'] : $tmp_quantity;
                            $variation['quantity'] = $tmp_quantity;
                        }
                    }

                    $tmp_description = '';
                    if (defined('E2W_SAVE_ATTRIBUTE_AS_DESCRIPTION') && E2W_SAVE_ATTRIBUTE_AS_DESCRIPTION) {
                        if ($result['product']['attribute'] && count($result['product']['attribute']) > 0) {
                            $tmp_description .= '<table class="shop_attributes"><tbody>';
                            foreach ($result['product']['attribute'] as $attribute) {
                                $tmp_description .= '<tr><th>' . $attribute['name'] . '</th><td><p>' . (is_array($attribute['value']) ? implode(", ", $attribute['value']) : $attribute['value']) . "</p></td></tr>";
                            }
                            $tmp_description .= '</tbody></table>';
                        }
                        // Uncoment if need empty attribute list
                        //$result['product']['attribute'] = array();
                    }

                    if (!e2w_get_setting('not_import_description')) {
                        $tmp_description .= $this->clean_description($result['product']['description']);
                    }

                    $result['product']['description'] = E2W_PhraseFilter::apply_filter_to_text($tmp_description);

                    $tmp_all_images = E2W_Utils::get_all_images_from_product($result['product']);

                    $not_import_gallery_images = false;
                    $not_import_variant_images = false;
                    $not_import_description_images = e2w_get_setting('not_import_description_images');
                    
                    
                    if (e2w_get_setting('сonvert_images_to_large')) {
                        preg_match('/\/\$_(.*)\.JPG.*/', $result['product']['thumb'], $output_array);
                        if(isset($output_array[1]) && intval($output_array[1]) && intval($output_array[1])<10){
                            $result['product']['thumb'] = str_replace('$_'.$output_array[1].'.JPG', '$_10.JPG', $result['product']['thumb']);
                        }
                        
                        foreach($result['product']['images'] as &$image){
                            preg_match('/\/\$_(.*)\.JPG.*/', $image, $output_array);
                            if(isset($output_array[1]) && intval($output_array[1]) && intval($output_array[1])<10){
                                $image = str_replace('$_'.$output_array[1].'.JPG', '$_10.JPG', $image);
                            }
                        }
                    }

                    $result['product']['skip_images'] = array();
                    foreach ($tmp_all_images as $img_id => $img) {
                        if (!in_array($img_id, $result['product']['skip_images']) && (($not_import_gallery_images && $img['type'] === 'gallery') || ($not_import_variant_images && $img['type'] === 'variant') || ($not_import_description_images && $img['type'] === 'description'))) {
                            $result['product']['skip_images'][] = $img_id;
                        }
                    }
                    
                }
            }

            return $result;
        }

        public function load_reviews($product_id, $page, $page_size = 20, $params = array()) {
            $request_url = E2W_RequestHelper::build_request('get_reviews', array('lang' => E2W_EbayLocalizator::getInstance()->language, 'product_id' => $product_id, 'page' => $page, 'page_size' => $page_size));

            $request = e2w_remote_get($request_url);

            if (is_wp_error($request)) {
                $result = E2W_ResultBuilder::buildError($request->get_error_message());
            } else {
                $result = json_decode($request['body'], true);

                if ($result['state'] !== 'error') {
                    $result = E2W_ResultBuilder::buildOk(array('reviews' => isset($result['reviews']['evaViewList']) ? $result['reviews']['evaViewList'] : array(), 'totalNum'=>isset($result['reviews']['totalNum']) ? $result['reviews']['totalNum'] : 0));
                }
            }

            return $result;
        }
        
        public function load_categories($site_id=0) {
            $request_url = E2W_RequestHelper::build_request('get_categories', array('site_id' => $site_id));

            $request = e2w_remote_get($request_url,array('timeout'=>120));

            if (is_wp_error($request)) {
                $result = E2W_ResultBuilder::buildError($request->get_error_message());
            } else {
                $result = json_decode($request['body'], true);
                if ($result['state'] !== 'error') {
                    E2W_Categories::save_categories($site_id, $result['categories']);
                }
                $result = E2W_ResultBuilder::buildOk();
            }

            return $result;
        }

        public function sync_products($product_ids, $params = array()) {
            $request_params = array('product_id' => implode(',', is_array($product_ids) ? $product_ids : array($product_ids)));
            if (!empty($params['manual_update'])) { $request_params['manual_update'] = 1; }
            if (!empty($params['pc'])) { $request_params['pc'] = $params['pc']; }
            $request_url = E2W_RequestHelper::build_request('sync_products', $request_params);
            //error_log($request_url);            
            $request = e2w_remote_get($request_url);
            if (is_wp_error($request)) {
                $result = E2W_ResultBuilder::buildError($request->get_error_message());
            } else {
                $result = json_decode($request['body'], true);
                
                $use_random_stock = e2w_get_setting('use_random_stock');
                if($use_random_stock){
                    $random_stock_min = intval(e2w_get_setting('use_random_stock_min'));
                    $random_stock_max = intval(e2w_get_setting('use_random_stock_max'));
                    
                    foreach ($result['products'] as &$product){
                        foreach ($product['sku_products']['variations'] as &$variation) {
                            $variation['original_quantity'] = intval($variation['quantity']);
                            $tmp_quantity = rand($random_stock_min, $random_stock_max);
                            $tmp_quantity = ($tmp_quantity > $variation['original_quantity']) ? $variation['original_quantity'] : $tmp_quantity;
                            $variation['quantity'] = $tmp_quantity;
                        }
                    }
                }
            }

            return $result;
        }

        public function load_shipping_info($product_id, $quantity, $country_code, $country_code_form = '') {
           
            $request_url = E2W_RequestHelper::build_request('get_shipping_info', array('product_id' => $product_id, 'quantity' => $quantity, 'country_code' => $country_code, 'country_code_from' => $country_code_form));

            $request = e2w_remote_get($request_url);
            if (is_wp_error($request)) {
                $result = E2W_ResultBuilder::buildError($request->get_error_message());
            } else {
                if (intval($request['response']['code']) == 200) {
                    $result = json_decode($request['body'], true);
                } else {
                    $result = E2W_ResultBuilder::buildError($request['response']['code'] . ' - ' . $request['response']['message']);
                }
            }

            return $result;
        }
        
        public static function clean_description($description) {
            $html = $description;
            
            if (function_exists('mb_convert_encoding')) {
                $html = trim(mb_convert_encoding($html, 'HTML-ENTITIES', 'UTF-8'));
            } else {
                $html = htmlspecialchars_decode(utf8_decode(htmlentities($html, ENT_COMPAT, 'UTF-8', false)));
            }

            if (function_exists('libxml_use_internal_errors')) { libxml_use_internal_errors(true); }
            $dom = new DOMDocument();
            @$dom->loadHTML($html);
            $dom->formatOutput = true;

            $tags = apply_filters('e2w_clean_description_tags', array('script', 'head', 'meta', 'style', 'map', 'noscript', 'object', 'iframe'));

            foreach ($tags as $tag) {
                $elements = $dom->getElementsByTagName($tag);
                for ($i = $elements->length; --$i >= 0;) {
                    $e = $elements->item($i);
                    if ($tag == 'a') {
                        while ($e->hasChildNodes()) {
                            $child = $e->removeChild($e->firstChild);
                            $e->parentNode->insertBefore($child, $e);
                        }
                        $e->parentNode->removeChild($e);
                    } else {
                        $e->parentNode->removeChild($e);
                    }
                }
            }

            if (!in_array('img', $tags)) {
                $elements = $dom->getElementsByTagName('img');
                for ($i = $elements->length; --$i >= 0;) {
                    $e = $elements->item($i);
                    $image_url = E2W_Utils::clear_image_url($e->getAttribute('src'));
                    if($image_url){
                        $e->setAttribute('src', add_query_arg('descimg', '1', $image_url));
                    }else{
                        $e->parentNode->removeChild($e);
                    }
                }
            }

            if (!defined('E2W_KEEP_DESCRIPTION_HTML_TAGS') || (defined('E2W_KEEP_DESCRIPTION_HTML_TAGS') && !E2W_KEEP_DESCRIPTION_HTML_TAGS )) {

                            $html = preg_replace('~<(?:!DOCTYPE|/?(?:html|body))[^>]*>\s*~i', '', $dom->saveHTML());

                            $html = preg_replace('/(<[^>]+) style=".*?"/i', '$1', $html);
                            $html = preg_replace('/(<[^>]+) class=".*?"/i', '$1', $html);
                            $html = preg_replace('/(<[^>]+) width=".*?"/i', '$1', $html);
                            $html = preg_replace('/(<[^>]+) height=".*?"/i', '$1', $html);
                            $html = preg_replace('/(<[^>]+) alt=".*?"/i', '$1', $html);
                            $html = preg_replace('/^<!DOCTYPE.+?>/', '$1', str_replace(array('<html>', '</html>', '<body>', '</body>'), '', $html));
                            $html = preg_replace("/<\/?div[^>]*\>/i", "", $html);

                            $html = preg_replace('#(<a.*?>).*?(</a>)#', '$1$2', $html);
                            $html = preg_replace('/<a[^>]*>(.*)<\/a>/iU', '', $html);
                            $html = preg_replace("/<\/?h1[^>]*\>/i", "", $html);
                            $html = preg_replace("/<\/?strong[^>]*\>/i", "", $html);
                            $html = preg_replace("/<\/?span[^>]*\>/i", "", $html);

                            //$html = str_replace(' &nbsp; ', '', $html);
                            $html = str_replace('&nbsp;', ' ', $html);
                            $html = str_replace('\t', ' ', $html);
                            $html = str_replace('  ', ' ', $html);


                            $html = preg_replace("/http:\/\/g(\d+)\.a\./i", "https://ae$1.", $html);

                            $pattern = "/<[^\/>]*[^td]>([\s]?|&nbsp;)*<\/[^>]*[^td]>/";
                            $html = preg_replace($pattern, '', $html);

                            $html = str_replace(array('<img', '<table'), array('<img class="img-responsive"', '<table class="table table-bordered'), $html);

            }

            $html = force_balance_tags($html);

            return html_entity_decode($html, ENT_COMPAT, 'UTF-8');
        }
    }

}
