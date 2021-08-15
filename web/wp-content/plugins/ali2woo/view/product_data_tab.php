
<div class="a2w_product_tab_menu">
    <ul class="subsubsub" style="float: initial;margin-left:12px">
        <li><a href="#" data-tab="general" class="current">General</a> | </li>
        <li><a href="#" data-tab="variations">Manage Variations</a></li>
    </ul>
    <script>
    jQuery(".a2w_product_tab_menu li a").click(function () {
        jQuery(".a2w_product_tab_menu li a").removeClass('current');
        jQuery(this).addClass('current');
        
        jQuery(".a2w_product_tab").hide();
        jQuery(".a2w_product_tab."+jQuery(this).data('tab')).show();
        return false;
    });
    </script>
</div>

<div class="a2w_product_tab general">
    <?php $external_id = get_post_meta($post_id, '_a2w_external_id', true); ?>

    <div class="options_group">
        <?php 
        woocommerce_wp_text_input(array(
            'id' => '_a2w_external_id',
            'value' => $external_id,
            'label' => __('External Id', 'ali2woo'),
            'desc_tip' => true,
            'description' => __('External Aliexpress Product Id', 'ali2woo'),
        ));

        woocommerce_wp_text_input(array(
            'id' => '_a2w_orders_count',
            'value' => get_post_meta($post_id, '_a2w_orders_count', true),
            'label' => __('Orders count', 'ali2woo'),
            'desc_tip' => true,
            'description' => __('Aliexpress orders count', 'ali2woo'),
            'custom_attributes' => array('readonly'=>'readonly'),
        ));

        $disable_sync = get_post_meta($post_id, '_a2w_disable_sync', true);

        woocommerce_wp_checkbox(array(
            'id' => '_a2w_disable_sync',
            'value' => $disable_sync ? 'yes' : 'no',
            'label' => __('Disable synchronization?', 'ali2woo'),
            'description' => __('Disable global synchronization for this product', 'ali2woo'),
        ));
        ?>

        <script>jQuery("#_a2w_disable_sync").change(function () {if(jQuery(this).is(":checked")){jQuery("._a2w_disable_var_price_change_field, ._a2w_disable_var_quantity_change_field, ._a2w_disable_add_new_variants").hide();}else{jQuery("._a2w_disable_var_price_change_field, ._a2w_disable_var_quantity_change_field, ._a2w_disable_add_new_variants").show();}});</script>

        <?php
        woocommerce_wp_checkbox(array(
            'id' => '_a2w_disable_var_price_change',
            'value' => get_post_meta($post_id, '_a2w_disable_var_price_change', true) ? 'yes' : 'no',
            'label' => __('Disable price change?', 'ali2woo'),
            'description' => __('Disable variations price change', 'ali2woo'),
        ));
        woocommerce_wp_checkbox(array(
            'id' => '_a2w_disable_var_quantity_change',
            'value' => get_post_meta($post_id, '_a2w_disable_var_quantity_change', true) ? 'yes' : 'no',
            'label' => __('Disable quantity change?', 'ali2woo'),
            'description' => __('Disable variations quantity change', 'ali2woo'),
        ));
        woocommerce_wp_checkbox(array(
            'id' => '_a2w_disable_add_new_variants',
            'value' => get_post_meta($post_id, '_a2w_disable_add_new_variants', true) ? 'yes' : 'no',
            'label' => __('Disable add new variants?', 'ali2woo'),
            'description' => __('Disable add new variants if they appear.', 'ali2woo'),
        ));

        if ($disable_sync) {
            echo '<script>jQuery("._a2w_disable_var_price_change_field, ._a2w_disable_var_quantity_change_field, ._a2w_disable_add_new_variants").hide();</script>';
        }

        woocommerce_wp_text_input(array(
            'id' => '_a2w_product_url',
            'value' => get_post_meta($post_id, '_a2w_product_url', true),
            'label' => __('Product url', 'ali2woo'),
            'desc_tip' => true,
            'description' => __('Affiliate product url', 'ali2woo'),
            'custom_attributes' => array('readonly'=>'readonly'),
        ));

        woocommerce_wp_text_input(array(
            'id' => '_a2w_original_product_url',
            'value' => get_post_meta($post_id, '_a2w_original_product_url', true),
            'label' => __('Original product url', 'ali2woo'),
            'desc_tip' => true,
            'description' => __('Original product url', 'ali2woo'),
            'custom_attributes' => array('readonly'=>'readonly'),
        ));
        ?>
    </div>

    
    <?php if(a2w_get_setting('add_shipping_to_price')): ?>
    <div class="options_group">
        <?php
        // save shipping meta data
        $shipping_meta = new A2W_ProductShippingMeta($post_id);
        $shipping_cost = $shipping_meta->get_cost();
        $shipping_country_to = $shipping_meta->get_country_to();
        $shipping_method = $shipping_meta->get_method();
        
        $shiping_info = "";
        if($shipping_country_to && $shipping_method){
            $shiping_info = $shipping_country_to.", ".$shipping_method.", ".($shipping_cost ? $shipping_cost : 'free');
            $items = $shipping_meta->get_items(1,'', $shipping_country_to);
            if($items){
                foreach($items as $item){
                    if($item['serviceName'] == $shipping_method){
                        $shiping_info = $shipping_country_to.", ".$item['company'].", ".($shipping_cost ? (isset($item['localPriceFormatStr'])?$item['localPriceFormatStr']:$item['priceFormatStr']) : 'free');
                        break;
                    }
                }
            }
        }
        ?>
        <p class="form-field">
            <label><?php _e('Shipping', 'ali2woo'); ?></label>
            <span><span class="a2w-shiping-info"><?php echo $shiping_info; ?></span> <a href="#" class="a2w-shipping-update">Select shiping</a> / <a href="#" class="a2w-shipping-remove">Reset</a></span>
            <span class="woocommerce-help-tip" data-tip="This shipping cost will be included to the product price according to pricing rules"></span>
        </p>
        <script>
        jQuery(".a2w-shipping-remove").on("click", function () {
            if(confirm("Are you sure you want to reset shipping info?")){
                const data = { 'action': 'a2w_remove_product_shipping_info', 'id': '<?php echo $post_id; ?>'};
                jQuery.post(ajaxurl, data).done(function (response) {
                    const json = jQuery.parseJSON(response);
                    if (json.state !== 'ok') {
                        console.log(json);
                    }else{
                        jQuery('.a2w-shiping-info').html('');
                    }
                }).fail(function (xhr, status, error) {
                    console.log(error);
                });
            }
            return false;
        });
        jQuery(".a2w-shipping-update").on("click", function () {
            const onSelectCallback = function (product_id, items, country, method) {
                if(method && items){
                    jQuery.each(items, function (i, item) {
                        if(item.serviceName == method){
                            const cost = item.previewFreightAmount?item.previewFreightAmount.value:item.freightAmount.value
                            const data = { 'action': 'a2w_update_product_shipping_info', 'id': '<?php echo $post_id; ?>', country, method, cost, items };
                            jQuery.post(ajaxurl, data).done(function (response) {
                                const json = jQuery.parseJSON(response);
                                if (json.state !== 'ok') {
                                    console.log(json);
                                }else{
                                    jQuery('.a2w-shiping-info').html(country+", "+method+", "+(cost?(item.localPriceFormatStr?item.localPriceFormatStr:item.priceFormatStr):'free'));
                                }
                            }).fail(function (xhr, status, error) {
                                console.log(error);
                            });
                        }
                    });
                }
            }
            
            <?php if(!$shipping_country_to || !$shipping_method): ?>
            fill_modal_shipping_info('<?php echo $external_id; ?>', '', null, 'product', '', onSelectCallback);
            <?php else: ?>
            jQuery('.modal-shipping .shipping-method').html('<div class="a2w-load-container"><div class="a2w-load-speeding-wheel"></div></div>');
            a2w_load_shipping_info('<?php echo $external_id; ?>', '<?php echo $shipping_country_to; ?>', 'product', function (state, items, default_method, shipping_cost, variations) {
                fill_modal_shipping_info('<?php echo $external_id; ?>', '<?php echo $shipping_country_to; ?>', items, 'product', '<?php echo $shipping_method; ?>', onSelectCallback);
            })
            <?php endif; ?>
        
            jQuery(".modal-shipping").addClass('opened');
            return false;
        });
        </script>
    </div>
    <?php endif; ?>
    

    <div class="options_group">
        <?php $last_update = get_post_meta($post_id, '_a2w_last_update', true); ?>
        <p class="form-field _a2w_last_update_field ">
            <label>Last update</label>
            <?php if($last_update): ?>
                <span><?php echo date("F j, Y, H:i:s", $last_update); ?> <a href="#clean" id="_a2w_last_update_clean">Clean</a></span>
            <?php else: ?>
                <span>Not set</span>
            <?php endif; ?>
            <span class="woocommerce-help-tip" data-tip="Last update"></span>
            <input type="hidden" class="" name="_a2w_last_update" id="_a2w_last_update" value="<?php echo $last_update;?>" />
        </p>
        <script>jQuery("#_a2w_last_update_clean").click(function () {jQuery("#_a2w_last_update").val(""); jQuery(this).parents("span").html("Not set");jQuery.post(ajaxurl, {"action": "a2w_data_last_update_clean", "post_id":<?php echo $post_id; ?>, "type":"product"}); return false;});</script>
                
        <?php $reviews_last_update = get_post_meta($post_id, '_a2w_reviews_last_update', true); ?>
        <p class="form-field _a2w_reviews_last_update_field ">
            <label>Reviews last update</label>
            <?php if($reviews_last_update): ?>
                <span><?php echo date("F j, Y, H:i:s", $reviews_last_update); ?> <a href="#clean" id="_a2w_reviews_last_update_clean">Clean</a></span>
            <?php else: ?>
                <span>Not set</span>
            <?php endif; ?>
            <span class="woocommerce-help-tip" data-tip="Last update"></span>
            <input type="hidden" class="" name="_a2w_reviews_last_update" id="_a2w_reviews_last_update" value="<?php echo $reviews_last_update;?>" />
        </p>
        <script>jQuery("#_a2w_reviews_last_update_clean").click(function () {jQuery("#_a2w_reviews_last_update").val(""); jQuery(this).parents("span").html("Not set");jQuery.post(ajaxurl, {"action": "a2w_data_last_update_clean", "post_id":<?php echo $post_id; ?>, "type":"review"}); return false;});</script>
    </div>
</div>

<div class="a2w_product_tab variations" style="display:none">
    <div class="options_group">
        <p class="form-field _a2w_deleted_variations_attributes">
            <label for="_a2w_deleted_variations_attributes">Removed attributes</label>
            <span id="_a2w_deleted_variations_attributes">
                <?php
                $deleted_variations_attributes = get_post_meta($post_id, '_a2w_deleted_variations_attributes', true);
                if (empty($deleted_variations_attributes)) {
                    echo '<i>' . __('No deleted attributes of variations', 'ali2woo') . '</i>';
                } else {
                    foreach ($deleted_variations_attributes as $ka => $av) {
                        echo '<span class="va" style="display: inline-block;margin-right:10px;margin-bottom: 5px;background-color: #eee;padding: 0px 10px;" data-attr-id="' . urldecode($ka) . '"><i>' . $av['current_name'] . '</i> <a href="#" style="text-decoration: none;"><span class="dashicons dashicons-trash"></span></a></span> ';
                    }
                }
                ?>
            </span>
        </p>
        <script>jQuery("#_a2w_deleted_variations_attributes > span > a").click(function () {var this_v_a = jQuery(this).parents("span.va");jQuery.post(ajaxurl, {"action": "a2w_data_remove_deleted_attribute", "post_id":<?php echo $post_id; ?>, "id":jQuery(this_v_a).attr("data-attr-id")}).done(function (response) {jQuery(this_v_a).remove(); if(jQuery("#_a2w_deleted_variations_attributes > span").length==0){jQuery("#_a2w_deleted_variations_attributes").html("<i><?php _e('No deleted attributes of variations', 'ali2woo'); ?></i>");} }).fail(function (xhr, status, error) {console.log(error);});return false;});</script>
    </div>

                
    <div class="options_group">
        <p class="form-field _a2w_deleted_variations">
            <label for="_a2w_deleted_variations">Removed variations</label>
            <span id="_a2w_deleted_variations">
            <?php
            $skip_meta = get_post_meta($post_id, "_a2w_skip_meta", true);
            if (!empty($skip_meta['skip_vars']) && is_array($skip_meta['skip_vars'])) {
                echo '<span class="var" style="display: inline-block;margin-right:10px;margin-bottom: 5px;background-color: #eee;padding: 0px 10px;" data-attr-id="all"><a href="#" style="text-decoration: none;">RESET ALL <span class="dashicons dashicons-trash"></span></a></span> ';
                foreach ($skip_meta['skip_vars'] as $v) {
                    echo '<span class="var" style="display: inline-block;margin-right:10px;margin-bottom: 5px;background-color: #eee;padding: 0px 10px;" data-attr-id="' . $v . '"><i>' . $v . '</i> <a href="#" style="text-decoration: none;"><span class="dashicons dashicons-trash"></span></a></span> ';
                }
            } else {
                    echo '<i>' . __('No deleted variations', 'ali2woo') . '</i>';
            }
            ?>
            </span>
        </p>
        <script>jQuery("#_a2w_deleted_variations > span > a").click(function () {var this_v_a = jQuery(this).parents("span.var");var var_id = jQuery(this_v_a).attr("data-attr-id");if(var_id!='all' || confirm("Are you sure you want to reset all variations?")){jQuery.post(ajaxurl, {"action": "a2w_data_remove_deleted_variation", "post_id":<?php echo $post_id; ?>, "id":var_id}).done(function (response) {jQuery(this_v_a).remove(); if(var_id=='all'||jQuery("#_a2w_deleted_variations > span").length==0){jQuery("#_a2w_deleted_variations").html("<i>No deleted variations</i>");} }).fail(function (xhr, status, error) {console.log(error);});}return false;});</script>
    </div>

</div>

<div class="a2w-content">
<?php include_once 'includes/shipping_modal.php'; ?>
</div>

