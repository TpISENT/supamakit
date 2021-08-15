<?php
if ( ! function_exists( 'tokoo_product_1_8_block' ) ) :

function tokoo_product_1_8_block( $atts, $content = null ) {

	extract( shortcode_atts( array(
		'section_title'		=> '',
		'tab_title'			=> '',
		'shortcode_tag'     => 'recent_products',
        'per_page'          => 9,
        'show_cat_title'    => '',
        'orderby'           => 'date',
        'order'             => 'desc',
        'product_id'        => '',
		'cat_limit' 		=> '',
		'cat_slugs'			=> '',
		'hide_empty'        => false,
	), $atts ) );

	$shortcode_atts = function_exists( 'tokoo_get_atts_for_shortcode' ) ? tokoo_get_atts_for_shortcode( array( 'shortcode' => $shortcode_tag, 'product_category_slug' => $cat_slugs, 'products_choice' => 'ids', 'products_ids_skus' => $product_id ) ) : array();
	$args = array(
		'section_title' 	=> $section_title,
		'show_cat_title'    => $show_cat_title,
		'tab_title' 		=> $tab_title,
		'shortcode_tag'     => $shortcode_tag,
        'shortcode_atts'    => wp_parse_args( $shortcode_atts, array( 'order' => $order, 'orderby' => $orderby ) ),
		'category_args'		=> array(
			'number'		=> $cat_limit,
			'slugs'         => $cat_slugs,
			'hide_empty'    => $hide_empty,
		)
	);

	
	$html = '';
	if( function_exists( 'tokoo_1_8_block' ) ) {
		ob_start();
		tokoo_1_8_block( $args );
		$html = ob_get_clean();
	}

	return $html;
}

add_shortcode( 'tokoo_1_8_block' , 'tokoo_product_1_8_block' );

endif;