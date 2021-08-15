<?php
$e2w_shipping_html = '<div id="e2w_to_country">' .
	woocommerce_form_field('e2w_to_country_field', array(
		   'type'       => 'select',
		   'class'      => array( 'chzn-drop' ),
		   'label'      => __('Ship my order(s) to: ','e2w'),
		   'placeholder'    => __('Select a Country','e2w'),
		   'options'    => $countries,
		   'default' => $default_country,
		   'return' => true
			)
	 ) .
'</div>';
$e2w_shipping_html = str_replace(array("\r", "\n"), '', $e2w_shipping_html);
?>
<div class="e2w_shipping">
</div>
<script id="e2w_country_selector_html" type="text/html">
<?php echo $e2w_shipping_html; ?>
</script>
<script>
jQuery(document).ready(function($){
window.e2w_shipping_api.init_in_cart( $('#e2w_country_selector_html').html()); 
});
</script>
