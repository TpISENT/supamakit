<?php
/**
 * Cart functions
 */

if ( ! function_exists( 'tokoo_cart_item_product_detail' ) ) {
	function tokoo_cart_item_product_detail( $product_name, $cart_item, $cart_item_key ) {

		if ( ! is_cart() ) {
			return $product_name;
		}

		$_product          = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
		$product_permalink = apply_filters( 'woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink( $cart_item ) : '', $cart_item, $cart_item_key );

		$price = apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key );

		$rating = apply_filters( 'woocommerce_cart_item_rating', wc_get_rating_html( $_product->get_average_rating() ));

		return apply_filters( 'tokoo_cart_item_product_detail', wp_kses_post( sprintf( '%s%s%s',  $product_name , $rating, $price ) ), $cart_item, $cart_item_key );
	}
}