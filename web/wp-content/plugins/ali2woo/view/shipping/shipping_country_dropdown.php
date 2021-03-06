<?php
if(a2w_check_defined('A2W_USE_RAW_SELECTBOX')){
	$select='<p class="form-row chzn-drop" id="a2w_to_country_field_field" data-priority=""><label for="a2w_to_country_field" class="">'.__('Ship my order(s) to: ', 'ali2woo').'</label><span class="woocommerce-input-wrapper">';
	$select.='<select name="a2w_to_country_field" id="a2w_to_country_field" class="select " data-allow_clear="true">';
	foreach($countries as $key=>$val){
		$select.='<option value="'.$key.'" '.($key==$default_country?'selected="selected"':'').'>'.$val.'</option>';
	}
	$select.='</select></span></p>';
}else{
	$select = woocommerce_form_field('a2w_to_country_field', array(
		'type'       => 'select',
		'class'      => array( 'chzn-drop' ),
		'label'      => __('Ship my order(s) to: ', 'ali2woo'),
		'placeholder'    => __('Select a Country', 'ali2woo'),
		'options'    => $countries,
		'default' => $default_country,
		'return' => true
	));
}

$a2w_shipping_html = '<div id="a2w_to_country">' . $select . '</div>';
$a2w_shipping_html = str_replace(array("\r", "\n"), '', $a2w_shipping_html);
?>
<div class="a2w_shipping">
</div>
<script id="a2w_country_selector_html" type="text/html">
<?php echo $a2w_shipping_html; ?>
</script>
<script>
jQuery(document).ready(function($){
  $( "body" ).on('a2w_shipping_js_loaded', function(e, a2w_shipping_api){
    a2w_shipping_api.init_in_cart( $('#a2w_country_selector_html').html());      
  })   

});
</script>
