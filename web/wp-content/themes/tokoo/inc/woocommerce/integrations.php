<?php
/**
 * WooCommerce Extensions Integrations
 *
 * @package tokoo
 */

if ( tokoo_is_yith_wcwl_activated() ) {

	global $yith_wcwl;

	function tokoo_add_to_wishlist_button() {
		echo do_shortcode( "[yith_wcwl_add_to_wishlist]" );
	}
	
	remove_action( 'woocommerce_single_product_summar',				'tokoo_add_to_wishlist_button', 30 );

	add_action( 'woocommerce_after_add_to_cart_button',				'tokoo_add_to_wishlist_button', 20 );
	add_action( 'woocommerce_before_shop_loop_item', 			'tokoo_add_to_wishlist_button',                     6 );

	if( property_exists( $yith_wcwl, 'wcwl_init' ) ) {
		remove_action( 'wp_enqueue_scripts', array( $yith_wcwl->wcwl_init, 'enqueue_styles_and_stuffs' ) );
	}

	if( ! function_exists( 'tokoo_get_wishlist_page_id' ) ){
		/**
		 * Gets the page ID of wishlist page
		 * 
		 * @return int
		 */
		function tokoo_get_wishlist_page_id() {
			$wishlist_page_id = yith_wcwl_object_id( get_option( 'yith_wcwl_wishlist_page_id' ) );
			return $wishlist_page_id;
		}
	}

	if( ! function_exists( 'tokoo_is_wishlist_page' ) ) {
		/**
		 * Conditional tag to determine if a page is a wishlist page or not
		 *
		 * @return boolean
		 */
		function tokoo_is_wishlist_page() {
			$wishlist_page_id = tokoo_get_wishlist_page_id();
			return is_page( $wishlist_page_id );
		}
	}

	if( ! function_exists( 'tokoo_get_wishlist_url') ) {
		/**
		 * Returns URL of wishlist page
		 *
		 * @return string
		 */
		function tokoo_get_wishlist_url(){
			$wishlist_page_id = tokoo_get_wishlist_page_id();
			return get_permalink( $wishlist_page_id );
		}
	}
}

if ( tokoo_is_yith_wcan_activated() ) {
	add_action( 'woocommerce_before_shop_loop', 'tokoo_wcan_wrap_start', 10 );
	add_action( 'woocommerce_after_shop_loop', 'tokoo_wcan_wrap_end', 91 );

	function tokoo_wcan_wrap_start() {
		?><div class="wcan-products-container"><?php
	}

	function tokoo_wcan_wrap_end() {
		?></div><!-- /.wcan-products-container --><?php
	}

	function tokoo_wcan_custom_scripts() {
		if ( yith_wcan_can_be_displayed() ) {
			$custom_script = "
				(function($) {
					$( document ).on( 'yith-wcan-ajax-filtered', function( e, response ) {
						if ( $(response).find( '.wcan-products-container' ).length > 0 ) {
							$( '.wcan-products-container' ).html( $(response).find( '.wcan-products-container' ).html() );
						} else if ( $(response).find( '.woocommerce-info' ).length > 0 ) {
							$( '.wcan-products-container' ).html( $(response).find( '.woocommerce-info' ) );
						}
					} );
				})(jQuery);
			";
			wp_add_inline_script( 'tokoo-scripts', $custom_script );
		}
	}

	add_action( 'wp_enqueue_scripts', 'tokoo_wcan_custom_scripts', 20 );
}

/**
 * WooCommerce Quantity Increment Plugin
 */
add_action( 'wp_enqueue_scripts', 'wcs_dequeue_quantity' );
function wcs_dequeue_quantity() {
    wp_dequeue_style( 'wcqi-css' );
}

add_filter( 'yith_wcwl_add_to_wishlist_button_classes', 'tk_remove_button_class_from_wishlist_button', 20 );

function tk_remove_button_class_from_wishlist_button( $classes ) {
	return 'add_to_wishlist';
}

if( tokoo_is_yith_woocompare_activated() ) {

	global $yith_woocompare;

	remove_action( 'woocommerce_single_product_summary', array( $yith_woocompare->obj , 'add_compare_link' ), 35 );

	function tokoo_add_compare_url_to_localize_data( $data ) {
		$data[ 'compare_page_url' ] = tokoo_get_compare_page_url();
		return $data;
	}

	add_filter( 'tokoo_localize_script_data', 'tokoo_add_compare_url_to_localize_data' );

	function tokoo_add_to_compare_link() {
		
		global $product, $yith_woocompare;
        $product_id = $product->get_id();

        $button_text = get_option( 'yith_woocompare_button_text', esc_html__( 'Add to Compare', 'tokoo' ) );
        $button_text = function_exists( 'icl_translate' ) ? icl_translate( 'Plugins', 'plugin_yit_compare_button_text', $button_text ) : $button_text;

        if( ! is_admin() ) {
        	echo apply_filters( 'tokoo_add_to_compare_link', sprintf( 
				'<a href="%s" class="%s" data-product_id="%d">%s</a>', 
				$yith_woocompare->obj->add_product_url( $product_id ),
				'add-to-compare-link',
				$product_id,
				$button_text
			) );
        }
	}

	add_action( 'woocommerce_before_shop_loop_item',	'tokoo_add_to_compare_link',	7 );
	add_action( 'woocommerce_before_shop_loop_item',	'tokoo_add_to_compare_link',	7 );
	add_action( 'woocommerce_after_add_to_cart_button',	'tokoo_add_to_compare_link',	30 );
	
	function tokoo_update_yith_compare_options( $options ) {
		
		foreach( $options['general'] as $key => $option ) {
			
			if( $option['id'] == 'yith_woocompare_auto_open' ) {
				$options['general'][$key]['std'] = 'no';
				$options['general'][$key]['default'] = 'no';
			}
		
		}
		
		return $options;
	}
	
	add_filter( 'yith_woocompare_tab_options', 'tokoo_update_yith_compare_options' );

	if( ! function_exists( 'tokoo_get_compare_page_id' ) ) {
		/**
		 * Gets page ID of product comparision page
		 *
		 * @return int
		 */
		function tokoo_get_compare_page_id() {
			$compare_page_id = apply_filters( 'tokoo_product_comparison_page_id', 0 );
			
			if( 0 !== $compare_page_id && function_exists( 'icl_object_id' ) ) {
				$compare_page_id = icl_object_id( $compare_page_id, 'page' );
			}

			return $compare_page_id;
		}
	}

	if( ! function_exists( 'tokoo_get_compare_page_url' ) ) {
		/**
		 * Returns URL of Product Comparision Page
		 *
		 * @return string
		 */
		function tokoo_get_compare_page_url() {
			$compare_page_id = tokoo_get_compare_page_id();
			$compare_page_url = '#';

			if( 0 !== $compare_page_id ) {
				$compare_page_url = get_permalink( $compare_page_id );
			}

			return $compare_page_url;
		}
	}
}