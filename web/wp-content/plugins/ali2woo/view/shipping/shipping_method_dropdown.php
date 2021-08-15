<?php if(!empty($title)){echo $title;} ?>

<?php if (isset($shipping_methods) && $shipping_methods) :  ?>
    <?php
    $fid = 'a2w_shipping_field'.$cart_item_key;
    if(a2w_check_defined('A2W_USE_RAW_SELECTBOX')){
        $select='<p class="form-row chzn-drop" id="'.$fid.'_field" data-priority=""><label for="'.$fid.'" class="">'.__('Shipping method: ', 'ali2woo').'</label><span class="woocommerce-input-wrapper">';
        $select.='<select name="'.$fid.'" id="'.$fid.'" class="select " data-allow_clear="true">';
        foreach($shipping_methods as $key=>$val){
            $select.='<option value="'.$key.'" '.($key==$default_shipping_method?'selected="selected"':'').'>'.$val.'</option>';
        }
        $select.='</select></span></p>';
    }else{
        $select = woocommerce_form_field('a2w_shipping_field'.$cart_item_key, array(
                'type'       => 'select',
                'class'      => array( 'chzn-drop' ),
                'input_class' => array( 'select' ),
                'label'      => __('Shipping method: ', 'ali2woo'),
                'placeholder'    => __('Select a Shipping method', 'ali2woo'),
                'options'    => $shipping_methods ,
                'default' => $default_shipping_method,
                'return' => true
                )
            );
    }

    $a2w_shipping_html = '<div class="a2w_to_shipping">' .$select .'</div>'; 
    $a2w_shipping_html = str_replace(array("\r", "\n"), '', $a2w_shipping_html);         
    ?>
    <div class="a2w_shipping_field<?php echo $cart_item_key; ?>_container a2w_shipping_field_container">
    <?php echo $a2w_shipping_html; ?>
    </div>
    <?php if (!defined('DOING_AJAX')) : ?>
        <script>
        jQuery(document).ready(function($){
            $( "body" ).on('a2w_shipping_js_loaded', function(e, a2w_shipping_api){
                a2w_shipping_api.init_shipping_dropdown_in_cart('<?php echo $cart_item_key; ?>'); 
            });
        });
        </script>
    <?php endif; ?>
<?php endif; ?>
