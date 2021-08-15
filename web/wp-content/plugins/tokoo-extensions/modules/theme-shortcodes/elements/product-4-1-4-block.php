<?php
if ( ! function_exists( 'tokoo_product_4_1_4_block' ) ) :

function tokoo_product_4_1_4_block( $atts, $content = null ) {

	extract( shortcode_atts( array(
		'show_header'       => '',
		'section_title'		=> '',
		'header_aside_action_text'  => '',
		'header_aside_action_link'  => '',
		'shortcode_tag'     => 'recent_products',
        'per_page'          => 9,
        'orderby'           => 'date',
        'order'             => 'desc',
        'product_id'        => ''
	), $atts ) );

	$shortcode_atts = function_exists( 'tokoo_get_atts_for_shortcode' ) ? tokoo_get_atts_for_shortcode( array( 'shortcode' => $shortcode_tag, 'products_choice' => 'ids', 'products_ids_skus' => $product_id ) ) : array();
	$args = array(
		'header_args'  => array (
			'show_header'       => $show_header,
			'section_title' 	=> $section_title,
			'header_aside_action_text'      => $header_aside_action_text,
			'header_aside_action_link'      => $header_aside_action_link,
		),
		'shortcode_tag'     => $shortcode_tag,
        'shortcode_atts'    => wp_parse_args( $shortcode_atts, array( 'order' => $order, 'orderby' => $orderby ) ),
	);

	
	$html = '';
	if( function_exists( 'tokoo_4_1_4_block' ) ) {
		ob_start();
		tokoo_4_1_4_block( $args );
		$html = ob_get_clean();
	}

	return $html;
}

add_shortcode( 'tokoo_4_1_4_block' , 'tokoo_product_4_1_4_block' );

endif;