<?php

remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20 );
remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30 );
remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0 );

add_action( 'woocommerce_before_main_content',	'tokoo_shop_archive_jumbotron',	 30 );

add_action( 'woocommerce_before_shop_loop', 'tokoo_shop_control_bar', 30 );

add_action( 'tokoo_before_shop_control_bar', 'tokoo_wc_handheld_sidebar',  10 );
add_action( 'tokoo_shop_control_bar_left', 'tokoo_wc_result_count', 10 );
add_action( 'tokoo_shop_control_bar_right', 'tokoo_wc_catalog_ordering', 10 );
add_action( 'tokoo_shop_control_bar_right',  'tokoo_shop_view_switcher',  20 );

add_action( 'woocommerce_after_shop_loop',  'tokoo_shop_archive_bottom_jumbotron',  30 );

add_filter( 'woocommerce_catalog_orderby', 'tokoo_wc_catalog_orderby', 10 );

add_action( 'tokoo_before_site_content', 'tokoo_breadcrumb', 10 );

add_action( 'woocommerce_before_shop_loop', 'tokoo_wc_maybe_show_product_subcategories', 10 );

add_filter( 'woocommerce_breadcrumb_defaults', 'tokoo_modify_wc_breadcrumb_args', 10 );
add_filter( 'woocommerce_show_page_title', '__return_false', 10 );

add_action( 'woocommerce_before_shop_loop', 'tokoo_wc_products_header_title', 20 );

add_filter( 'woocommerce_product_loop_start', 'tokoo_check_for_loop_total', 10 );
add_filter( 'woocommerce_product_loop_end', 'tokoo_check_for_loop_total', 10 );
add_filter( 'woocommerce_product_categories_widget_args', 'tokoo_modify_wc_product_cat_widget_args', 10 );
add_filter( 'woocommerce_layered_nav_term_html', 'tokooo_wc_layered_nav_term_html', 10, 4 );

remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10 );
add_action( 'woocommerce_sidebar', 'tokoo_wc_get_sidebar', 10 );