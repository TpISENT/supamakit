<?php echo $title; ?>

<?php if (isset($shipping_methods) && $shipping_methods) :  ?>
<?php
$e2w_shipping_html = '<div class="e2w_to_shipping">' .
     woocommerce_form_field('e2w_shipping_field'.$cart_item_key, array(
       'type'       => 'select',
       'class'      => array( 'chzn-drop' ),
       'label'      => __('Shipping method: ','e2w'),
       'placeholder'    => __('Select a Shipping method','e2w'),
       'options'    => $shipping_methods ,
       'default' => $default_shipping_method,
       'return' => true
        )
    ) . '</div>'; 
    
$e2w_shipping_html = str_replace(array("\r", "\n"), '', $e2w_shipping_html);         
?>
<div class="e2w_shipping_field<?php echo $cart_item_key; ?>_container">
<?php echo $e2w_shipping_html; ?>
</div>
<?php if (!defined('DOING_AJAX')) : ?>
<script>
jQuery(document).ready(function($){
   window.e2w_shipping_api.init_shipping_dropdown_in_cart('<?php echo $cart_item_key; ?>'); 
});
</script>
<?php endif; ?>
<?php endif; ?>