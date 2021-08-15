<?php
/**
 * Template hooks used in Product Item i.e. content-product.php
 */
remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );

add_action( 'woocommerce_before_shop_loop',       'tokoo_shop_view_content_wrapper_open',    40 );
add_action( 'woocommerce_before_shop_loop_item', 'tokoo_product_item_wrap_open',                       1 );
add_action( 'woocommerce_before_shop_loop_item', 'tokoo_product_item_header_open',                     5 );
add_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_link_close', 80 );
add_action( 'woocommerce_before_shop_loop_item_title', 'tokoo_product_item_header_close',              90 );

add_action( 'woocommerce_shop_loop_item_title', 'tokoo_product_item_body_open',                         5 );
add_action( 'woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_link_open',          7 );
add_action( 'woocommerce_shop_loop_item_title', 'tokoo_product_item_rating',                            9 );
add_action( 'woocommerce_shop_loop_item_title', 'woocommerce_template_single_excerpt',                 15 );

add_action( 'woocommerce_after_shop_loop_item', 'tokoo_product_item_body_close',                        7 );

add_action( 'woocommerce_after_shop_loop_item', 'tokoo_product_item_footer_open',                       8 );
add_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_price',                      9 );
add_action( 'woocommerce_after_shop_loop_item', 'tokoo_product_item_footer_close',                      80 );

add_action( 'woocommerce_after_shop_loop_item', 'tokoo_product_item_wrap_close',                        90 );
add_action( 'woocommerce_after_shop_loop',  'tokoo_shop_view_content_wrapper_close',           PHP_INT_MAX );

add_filter( 'woocommerce_loop_add_to_cart_args', 'tokoo_modify_add_to_cart_args',                    10, 2 );
add_filter( 'woocommerce_subcategory_count_html', 'tokoo_subcategory_count_html',                    10, 2 );

add_action( 'woocommerce_after_add_to_cart_button', 'tokoo_single_product_wishlist_compare_open',   10 );
add_action( 'woocommerce_after_add_to_cart_button', 'tokoo_single_product_wishlist_compare_close',  40 );