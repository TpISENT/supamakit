<?php
/**
 * Hooks for Cart page
 */

add_filter( 'woocommerce_cart_item_name',      'tokoo_cart_item_product_detail',     10, 3 );