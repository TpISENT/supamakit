<?php
/**
 * Description of E2W_ProductDataTabController
 *
 * @author Andrey
 * 
 * @autoload: e2w_init
 */
if (!class_exists('E2W_ProductDataTabController')) {

    class E2W_ProductDataTabController {

        public $tab_class = '';
        public $tab_id = '';
        public $tab_title = '';
        public $tab_icon = '';

        public function __construct() {

            $this->tab_class = 'e2w_product_data';
            $this->tab_id = 'e2w_product_data';
            $this->tab_title = 'E2W Data';

            add_action('admin_head', array(&$this, 'on_admin_head'));

            add_action('woocommerce_product_write_panel_tabs', array(&$this, 'product_write_panel_tabs'), 99);
            add_action('woocommerce_product_data_panels', array(&$this, 'product_data_panel_wrap'), 99);
            add_action('woocommerce_process_product_meta', array(&$this, 'process_meta_box'), 1, 2);

            add_action('woocommerce_variation_options_pricing', array(&$this, 'variation_options_pricing'), 20, 3);

            add_action('wp_ajax_e2w_data_remove_deleted_attribute', array($this, 'ajax_remove_deleted_attribute'));
            add_action('wp_ajax_e2w_data_remove_deleted_variation', array($this, 'ajax_remove_deleted_variation'));
        }

        public function on_admin_head() {
            echo '<style type="text/css">#woocommerce-product-data ul.wc-tabs li.' . $this->tab_class . ' a::before {content: \'\f163\';}</style>';
        }

        public function product_write_panel_tabs() {
            ?>
            <li class="<?php echo $this->tab_class; ?>"><a href="#<?php echo $this->tab_id; ?>"><span><?php echo $this->tab_title; ?></span></a></li>
            <?php
        }

        public function product_data_panel_wrap() {
            ?>
            <div id="<?php echo $this->tab_id; ?>" class="panel <?php echo $this->tab_class; ?> woocommerce_options_panel wc-metaboxes-wrapper">
                <?php $this->render_product_tab_content(); ?>
            </div>
            <?php
        }

        public function render_product_tab_content() {
            global $post;

            echo '<div class="options_group">';
            woocommerce_wp_text_input(array(
                'id' => '_e2w_external_id',
                'value' => get_post_meta($post->ID, '_e2w_external_id', true),
                'label' => __('External Id', 'e2w'),
                'desc_tip' => true,
                'description' => __('External Ebay Product Id', 'e2w'),
            ));

            woocommerce_wp_text_input(array(
                'id' => '_e2w_orders_count',
                'value' => get_post_meta($post->ID, '_e2w_orders_count', true),
                'label' => __('Orders count', 'e2w'),
                'desc_tip' => true,
                'description' => __('Ebay orders count', 'e2w'),
            ));
            
            echo '<p class="form-field _e2w_site_code">';
            echo '<label for="_e2w_site_code">Site code</label>';
            echo '<span id="_e2w_site_code">'.get_post_meta($post->ID, '_e2w_site_code', true).'</span>';
            echo '</p>';

            $disable_sync = get_post_meta($post->ID, '_e2w_disable_sync', true);

            woocommerce_wp_checkbox(array(
                'id' => '_e2w_disable_sync',
                'value' => $disable_sync ? 'yes' : 'no',
                'label' => __('Disable synchronization?', 'e2w'),
                'description' => __('Disable global synchronization for this product', 'e2w'),
            ));

            echo '<script>jQuery("#_e2w_disable_sync").change(function () {if(jQuery(this).is(":checked")){jQuery("._e2w_disable_var_price_change_field, ._e2w_disable_var_quantity_change_field").hide();}else{jQuery("._e2w_disable_var_price_change_field, ._e2w_disable_var_quantity_change_field").show();}console.log(1234);});</script>';

            woocommerce_wp_checkbox(array(
                'id' => '_e2w_disable_var_price_change',
                'value' => get_post_meta($post->ID, '_e2w_disable_var_price_change', true) ? 'yes' : 'no',
                'label' => __('Disable price change?', 'e2w'),
                'description' => __('Disable variations price change', 'e2w'),
            ));
            woocommerce_wp_checkbox(array(
                'id' => '_e2w_disable_var_quantity_change',
                'value' => get_post_meta($post->ID, '_e2w_disable_var_quantity_change', true) ? 'yes' : 'no',
                'label' => __('Disable quantity change?', 'e2w'),
                'description' => __('Disable variations quantity change', 'e2w'),
            ));

            if ($disable_sync) {
                echo '<script>jQuery("._e2w_disable_var_price_change_field, ._e2w_disable_var_quantity_change_field").hide();</script>';
            }

            woocommerce_wp_text_input(array(
                'id' => '_e2w_product_url',
                'value' => get_post_meta($post->ID, '_product_url', true),
                'label' => __('Product url', 'e2w'),
                'desc_tip' => true,
                'description' => __('Affiliate product url', 'e2w'),
            ));

            woocommerce_wp_text_input(array(
                'id' => '_e2w_original_product_url',
                'value' => get_post_meta($post->ID, '_e2w_original_product_url', true),
                'label' => __('Original product url', 'e2w'),
                'desc_tip' => true,
                'description' => __('Original product url', 'e2w'),
            ));
            echo '</div>';

            echo '<div class="options_group">';
            woocommerce_wp_text_input(array(
                'id' => '_e2w_last_update',
                'value' => get_post_meta($post->ID, '_e2w_last_update', true),
                'label' => __('Last update', 'e2w'),
                'desc_tip' => true,
                'description' => __('Last update', 'e2w'),
            ));

            woocommerce_wp_text_input(array(
                'id' => '_e2w_reviews_last_update',
                'value' => get_post_meta($post->ID, '_e2w_reviews_last_update', true),
                'label' => __('Reviews last update', 'e2w'),
                'desc_tip' => true,
                'description' => __('Reviews last update', 'e2w'),
            ));
            /*
              woocommerce_wp_text_input(array(
              'id' => '_e2w_review_page',
              'value' => get_post_meta($post->ID, '_e2w_review_page', true),
              'label' => __('Review page', 'e2w'),
              'desc_tip' => true,
              'description' => __('Review page', 'e2w'),
              ));
             */
            echo '</div>';

            echo '<div class="options_group">';

            $deleted_variations_attributes = get_post_meta($post->ID, '_e2w_deleted_variations_attributes', true);
            echo '<p class="form-field _e2w_deleted_variations_attributes">';
            echo '<label for="_e2w_deleted_variations_attributes">Removed attributes</label>';
            echo '<span id="_e2w_deleted_variations_attributes">';
            if (empty($deleted_variations_attributes)) {
                echo '<i>' . __('No deleted attributes of variations', 'e2w') . '</i>';
            } else {
                foreach ($deleted_variations_attributes as $ka => $av) {
                    echo '<span class="va" style="display: inline-block;margin-right:10px;margin-bottom: 5px;background-color: #eee;padding: 0px 10px;" data-attr-id="' . urldecode($ka) . '"><i>' . $av['current_name'] . '</i> <a href="#" style="text-decoration: none;"><span class="dashicons dashicons-trash"></span></a></span> ';
                }
            }
            echo '</span>';
            echo '<script>jQuery("#_e2w_deleted_variations_attributes > span > a").click(function () {var this_v_a = jQuery(this).parents("span.va");jQuery.post(ajaxurl, {"action": "e2w_data_remove_deleted_attribute", "post_id":' . $post->ID . ', "id":jQuery(this_v_a).attr("data-attr-id")}).done(function (response) {jQuery(this_v_a).remove(); if(jQuery("#_e2w_deleted_variations_attributes > span").length==0){jQuery("#_e2w_deleted_variations_attributes").html("<i>' . __('No deleted attributes of variations', 'e2w') . '</i>");} }).fail(function (xhr, status, error) {console.log(error);});return false;});</script>';
            echo '</p>';

            echo '</div>';

            echo '<div class="options_group">';
            echo '<p class="form-field _e2w_deleted_variations">';
            echo '<label for="_e2w_deleted_variations">Removed variations</label>';
            echo '<span id="_e2w_deleted_variations">';
            $skip_meta = get_post_meta($post->ID, "_e2w_skip_meta", true);
            if (!empty($skip_meta['skip_vars']) && is_array($skip_meta['skip_vars'])) {
                foreach ($skip_meta['skip_vars'] as $v) {
                    echo '<span class="var" style="display: inline-block;margin-right:10px;margin-bottom: 5px;background-color: #eee;padding: 0px 10px;" data-attr-id="' . $v . '"><i>' . $v . '</i> <a href="#" style="text-decoration: none;"><span class="dashicons dashicons-trash"></span></a></span> ';
                }
            } else {
                echo '<i>' . __('No deleted variations', 'e2w') . '</i>';
            }
            echo '</span>';
            echo '<script>jQuery("#_e2w_deleted_variations > span > a").click(function () {var this_v_a = jQuery(this).parents("span.var");jQuery.post(ajaxurl, {"action": "e2w_data_remove_deleted_variation", "post_id":' . $post->ID . ', "id":jQuery(this_v_a).attr("data-attr-id")}).done(function (response) {jQuery(this_v_a).remove(); if(jQuery("#_e2w_deleted_variations > span").length==0){jQuery("#_e2w_deleted_variations").html("<i>' . __('No deleted variations', 'e2w') . '</i>");} }).fail(function (xhr, status, error) {console.log(error);});return false;});</script>';
            echo '</p>';
            echo '</div>';
        }

        public function process_meta_box($post_id, $post) {
            if (!empty($_POST['_e2w_external_id'])) {
                update_post_meta($post_id, '_e2w_external_id', $_POST['_e2w_external_id']);
            } else {
                delete_post_meta($post_id, '_e2w_external_id');
            }

            if (!empty($_POST['_e2w_orders_count'])) {
                update_post_meta($post_id, '_e2w_orders_count', $_POST['_e2w_orders_count']);
            } else {
                delete_post_meta($post_id, '_e2w_orders_count');
            }

            if (!empty($_POST['_e2w_product_url'])) {
                update_post_meta($post_id, '_product_url', $_POST['_e2w_product_url']);
            } else {
                delete_post_meta($post_id, '_product_url');
            }

            if (!empty($_POST['_e2w_original_product_url'])) {
                update_post_meta($post_id, '_e2w_original_product_url', $_POST['_e2w_original_product_url']);
            } else {
                delete_post_meta($post_id, '_e2w_original_product_url');
            }

            update_post_meta($post_id, '_e2w_disable_sync', !empty($_POST['_e2w_disable_sync']) ? 1 : 0);

            update_post_meta($post_id, '_e2w_disable_var_price_change', !empty($_POST['_e2w_disable_var_price_change']) ? 1 : 0);

            update_post_meta($post_id, '_e2w_disable_var_quantity_change', !empty($_POST['_e2w_disable_var_quantity_change']) ? 1 : 0);

            if (!empty($_POST['_e2w_last_update'])) {
                update_post_meta($post_id, '_e2w_last_update', $_POST['_e2w_last_update']);
            } else {
                delete_post_meta($post_id, '_e2w_last_update');
            }
            if (!empty($_POST['_e2w_reviews_last_update'])) {
                update_post_meta($post_id, '_e2w_reviews_last_update', $_POST['_e2w_reviews_last_update']);
            } else {
                delete_post_meta($post_id, '_e2w_reviews_last_update');
            }
            if (!empty($_POST['_e2w_review_page'])) {
                update_post_meta($post_id, '_e2w_review_page', $_POST['_e2w_review_page']);
            } else {
                delete_post_meta($post_id, '_e2w_review_page');
            }
        }

        public function variation_options_pricing($loop, $variation_data, $variation) {
            if (!empty($variation_data['_ebay_regular_price']) || !empty($variation_data['_ebay_price'])) {
                echo '<p class="form-field form-row form-row-first">';
                if (!empty($variation_data['_ebay_regular_price'])) {
                    $label = sprintf(__('Ebay Regular price (%s)', 'e2w'), get_woocommerce_currency_symbol());

                    echo '<label style="cursor: inherit;">' . $label . ':</label>&nbsp;&nbsp;<label style="cursor: inherit;">' . wc_format_localized_price(is_array($variation_data['_ebay_regular_price']) ? $variation_data['_ebay_regular_price'][0] : $variation_data['_ebay_regular_price']) . '</label>';
                }
                echo '&nbsp;</p>';
                echo '<p class="form-field form-row form-row-last">';
                if (!empty($variation_data['_ebay_price'])) {
                    $label = sprintf(__('Ebay Sale price (%s)', 'e2w'), get_woocommerce_currency_symbol());
                    echo '<label style="cursor: inherit;">' . $label . ':</label>&nbsp;&nbsp;<label style="cursor: inherit;">' . wc_format_localized_price(is_array($variation_data['_ebay_price']) ? $variation_data['_ebay_price'][0] : $variation_data['_ebay_price']) . '</label>';
                }
                echo '&nbsp;</p>';
            }
        }

        public function ajax_remove_deleted_attribute() {
            if (!empty($_POST['post_id']) && !empty($_POST['id'])) {
                $deleted_variations_attributes = get_post_meta($_POST['post_id'], '_e2w_deleted_variations_attributes', true);
                if ($deleted_variations_attributes) {
                    foreach ($deleted_variations_attributes as $k => $a) {
                        if ($k == sanitize_title($_POST['id'])) {
                            unset($deleted_variations_attributes[$k]);
                        }
                    }
                }
                update_post_meta($_POST['post_id'], '_e2w_deleted_variations_attributes', $deleted_variations_attributes);
            }
            echo json_encode(E2W_ResultBuilder::buildOk());
            wp_die();
        }

        public function ajax_remove_deleted_variation() {
            if (!empty($_POST['post_id']) && !empty($_POST['id'])) {
                $e2w_skip_meta = get_post_meta($_POST['post_id'], "_e2w_skip_meta", true);
                if ($e2w_skip_meta) {
                    $e2w_skip_meta['skip_vars'] = array_diff($e2w_skip_meta['skip_vars'], array($_POST['id']));
                    update_post_meta($_POST['post_id'], "_e2w_skip_meta", $e2w_skip_meta);
                }
            }
            echo json_encode(E2W_ResultBuilder::buildOk());
            wp_die();
        }

    }

}    