<?php
/**
 * WooCommerce Header Hooks
 */
add_filter( 'woocommerce_add_to_cart_fragments', 'tokoo_cart_link_fragment' );

/**
 * Products Live Search
 */
add_action( 'wp_ajax_nopriv_products_live_search',              'tokoo_products_live_search' );
add_action( 'wp_ajax_products_live_search',                     'tokoo_products_live_search' );