<?php
/**
 * Hooks used in WooCommerce pages
 */

add_action( 'woocommerce_proceed_to_checkout', 'tokoo_display_cart_total', 10 );
add_filter( 'woocommerce_cart_shipping_method_full_label', 'tokoo_wrap_shipping_method_label', 10, 2 );
add_action( 'woocommerce_cart_contents', 'tokoo_disable_coupon', 10 );
add_action( 'woocommerce_cart_actions', 'tokoo_cart_coupon', 10 );

add_action( 'woocommerce_before_cart', 'tokoo_cart_header', 10 );
add_action( 'woocommerce_cart_is_empty', 'tokoo_cart_empty_icon', 5 );

add_action( 'woocommerce_before_checkout_shipping_form', 'tokoo_form_shipping_title', 10 );

remove_action( 'woocommerce_before_checkout_form', 'woocommerce_checkout_login_form', 10 );
add_action( 'woocommerce_before_checkout_form', 'tokoo_wc_checkout_login_form', 10 );

add_action( 'woocommerce_login_form', 'tokoo_login_form_footer_open', 0 );
add_action( 'woocommerce_login_form_end', 'tokoo_login_form_footer_close', 90 );

add_action( 'tokoo_page', 'tokoo_checkout_header', 10 );

add_action( 'woocommerce_checkout_before_customer_details', 'tokoo_customer_details_open', 0 );
add_action( 'woocommerce_checkout_after_customer_details', 'tokoo_customer_details_close', 90 );

add_action( 'woocommerce_checkout_before_order_review', 'tokoo_order_review_open', 0 );
add_action( 'woocommerce_checkout_after_order_review', 'tokoo_order_review_close', 90 );

add_filter( 'woocommerce_get_order_item_totals', 'tokoo_add_order_item_totals_title', 10, 3 );

add_action( 'woocommerce_review_order_before_payment', 'tokoo_payment_method_title', 10 );

add_filter( 'woocommerce_checkout_show_terms', '__return_false', 10 );

add_action( 'woocommerce_review_order_before_submit', 'tokoo_place_order_button_wrapper_open', 10 );
add_action( 'woocommerce_review_order_after_submit', 'tokoo_place_order_button_wrapper_close', 10 );
